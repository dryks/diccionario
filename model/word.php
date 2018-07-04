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
    
    $input=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=text|headhtml|categories&format=json&mobileformat&redirects=1&useskin=minerva&page=".$wiki);
    $this->texta=json_decode($input);
    $inputdecode=json_decode($input);
    $this->htmlhead=$inputdecode->parse->headhtml->{'*'};
    $this->title=$inputdecode->parse->title;
    $this->texta=$inputdecode->parse->text->{'*'};
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
include"view/menu.php";

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

