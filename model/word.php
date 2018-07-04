<?php
//$word="Россия";
class Word{
    public $wiki; //слово запроса
    public $texta;//text body страницы
    public $htmlhead ;

function __construct($wiki="Заглавная_страница")
{
$this->wiki=$wiki;
$this->texta=$texta;
$this->htmlhead=$htmlhead;
}


function gettext($wiki="Заглавная_страница"){
    
    $input=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=text|headhtml|sections&format=json&mobileformat&redirects=1&useskin=minerva&page=".$wiki);
    $this->texta=json_decode($input);
    $inputdecode=json_decode($input);
    $this->htmlhead=$inputdecode->parse->headhtml->{'*'};
    $this->title=$inputdecode->parse->title;
    $this->texta=$inputdecode->parse->text->{'*'};
    $this->section=$inputdecode->parse->sections;
  //  var_dump($this->section);
return $this->texta;

}


function cleantext(){
   $clean= $this->texta;
   $cleanhead=$this->htmlhead;
//форматирование head к выводу
//стили вывод в хеад
$headend=' <!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.1/cerulean/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  crossorigin="anonymous">
<link href="../css/style.css" rel="stylesheet"  crossorigin="anonymous">
<style>

   body {
background-image: url("http://diccionario.pro/img/light.png");
background-repeat: repeat;
}

</style>

</head>';
ob_start();
echo'
<div  class="container-fluid">
<div class="row">
    <div class="col-sm-3">
        <div class="nav-side-menu">
            <div class="brand">Brand Logo</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">';

    for ($i=0; $i<count($this->section) ; $i++) {
        $toc=$this->section[$i]->toclevel;
       
        
        echo'
        <li data-toggle="collapse" data-target="#'.$this->section[$i]->anchor.'" class="collapsed">
       
        <a href="#'.$this->section[$i]->anchor.'">'.$this->section[$i]->line.' </a> </li>';


    };

    echo'</ul>
    </div>
</div>
</div>

<div class="col-sm-9 col-sm-offset-1">';


    $navig=ob_get_clean();



$cleanhead = preg_replace("#</head>#",$headend,$cleanhead);
$cleanhead = preg_replace("#<title>(.*)</title>#","<title>{$this->title}</title>",$cleanhead);
$cleanhead = preg_replace("#<body (.*?)>#","<body $1>$navig",$cleanhead);
   //форматирование текста к выводу
   $clean = preg_replace("~<a .*>Править</a>~",'',$clean);
   $clean = preg_replace('~<a href="/w/index.php.*".*>(.*?)</a>~','$1',$clean);
   $this->texta=$clean;

  //return  $clean;
  $this->htmlhead=$cleanhead;
  return  $clean;

}







}



?>

