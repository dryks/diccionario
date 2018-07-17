<?php
//$word="Россия";
class Word {
    public $wiki; //слово запроса
    public $texta; //text body страницы
    public $htmlhead;

    function __construct($wiki = "Wikcionario:Portada") {
        $this -> wiki = $wiki;
        $this -> texta = $texta;
        $this -> htmlhead = $htmlhead;
    }

    function gettext($wiki = "Wikcionario:Portada") {

        $input = file_get_contents("https://es.wiktionary.org/w/api.php?action=parse&prop=text|headhtml|sections&format=json&mobileformat&redirects=1&useskin=minerva&page=".$wiki);
        $this -> texta = json_decode($input);
        $inputdecode = json_decode($input);
        $this -> htmlhead = $inputdecode -> parse -> headhtml -> {
            '*'
        };
        $this -> title = $inputdecode -> parse -> title;
        $this -> texta = $inputdecode -> parse -> text -> {
            '*'
        };
        $this -> section = $inputdecode -> parse -> sections;
        // $this->section=1; var_dump($this->texta);
        return $this -> texta;

    }


function cleantext() {
    $clean = $this -> texta;
    $cleanhead = $this -> htmlhead;
//форматирование head к выводу стили вывод в хеад
$headend = ' <!-- Bootstrap CSS -->
 <link href = "https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.1/cerulean/bootstrap.min.css" rel = "stylesheet" crossorigin = "anonymous" >
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet"
            crossorigin="anonymous">
            <link href="/css/style.css" rel="stylesheet" crossorigin="anonymous">
                <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">  
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
                <script src="https://diccionario.pro/js/jquery.easy-autocomplete.min.js" type="text/javascript"></script>
                
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-29275243-30"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "UA-29275243-30");
</script>


</head>';
ob_start();
echo'
<div  class="container-fluid">
<div class="row">
    <div class="col-sm-3">
        <div class="nav-side-menu">
            <div class="brand"><a href="https://diccionario.pro" ><img src="/img/logo.png" class="brand" alt="diccionario.pro"></a></div>
            <div class="nav-item  d-lg-block d-xs-block d-sm-block  col-xs-12 col-sm-11 col-md-11 col-lg-11 "></br>
                                <input id="data-links" class="form-control fa fa-search d-md-block " placeholder="escribe la palabra">
                                </div>
                                <script src="https://diccionario.pro/js/search.js" type="text/javascript"></script>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out"> ';
            
if(isset($this->section[0]->number)){

          echo '<li data-toggle="collapse" data-target="#'.(int)($this->section[0]->number).'" class="collapsed">
               
                <a href="#'.$this->section[0]->anchor.'"><i class="fa fa-arrow-circle-down fa-lg"></i>'.$this->section[0]->line.' <span class="arrow"></span> </a> </li>
                <ul class="sub-menu collapse" id="'.(int)($this->section[0]->number).'">
                ';
}



    for ($i=1; $i<count($this->section) ; $i++) {
        $toc=$this->section[$i]->toclevel;
       
        if ($toc==1) {
            echo'
            </ul> <li data-toggle="collapse" data-target="#'.(int)($this->section[$i]->number).'" class="collapsed">
           
            <a href="#'.$this->section[$i]->anchor.'"><i class="fa fa-arrow-circle-down fa-lg"></i>'.$this->section[$i]->line.' <span class="arrow"></span> </a> </li>
            <ul class="sub-menu collapse" id="'.(int)($this->section[$i]->number).'">
            ';
        }else{
echo '
<li><a href="#'.$this->section[$i]->anchor.'">'.$this->section[$i]->line.' </a> </li>
';

        }

   
       

    };

    echo'</ul>

 
    <li data-toggle="collapse" data-target="#Lemario" class="collapsed">
   
    <a href="/wiki/Apéndice:Lemario"><i class="fa fa-arrow-circle-down fa-lg"></i>Lemario del español <span class="arrow"></span> </a> </li>
    <ul class="sub-menu collapse" id="#Lemario">  </ul>
    
    <li data-toggle="collapse" data-target="#Swadesh" class="collapsed">
   
    <a href="/wiki/Apéndice:Lista_Swadesh"><i class="fa fa-arrow-circle-down fa-lg"></i>Lista Swadesh<span class="arrow"></span> </a> </li>
    <ul class="sub-menu collapse" id="#Swadesh">  </ul>



    </div>
</div>
</div>

<div class="col-sm-9 col-sm-offset-1">
<h1 id="firstHeading" class="firstHeading" lang="ru">'.$this->title.'</h1>';


    $navig=ob_get_clean();

    
$cleanhead = preg_replace("#es.wiktionary.org#","diccionario.pro",$cleanhead);
$cleanhead = preg_replace("#</head>#",$headend,$cleanhead);
$cleanhead = preg_replace("#<title>(.*)</title>#","<title>{$this->title}</title>",$cleanhead);
$cleanhead = preg_replace("#<body (.*?)>#","<body $1>$navig",$cleanhead);
   //форматирование текста к выводу
   $clean = preg_replace("~<a .*>Editar</a>~",'',$clean);
   $clean = preg_replace('~<a href="/w/index.php.*".*>(.*?)</a>~','$1',$clean);
   $this->texta=$clean;

  //return  $clean;
  $this->htmlhead=$cleanhead;
  return  $clean;

}







}



?>