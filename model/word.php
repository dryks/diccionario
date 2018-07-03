<?php
$word="Россия";
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


$wordstart=new Word();

//$lom=$cat->gettext("Москва")->parse->headhtml->{'*'};
$wordget=$wordstart->gettext($word); 
$wordclean=$wordstart->cleantext(); 
//echo 222222;
//var_dump($lom);
//var_dump($clean);

?>
<?php /*
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
     <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-0Mou2qXGeXK7k/Ue/a1hspEVcEP2zCpoQZw8/MPeUgISww+VmDJcy2ri9tX0a6iy" crossorigin="anonymous">
    <style>

        body {
  background-image: url("http://diccionario.pro/img/light.png");
  background-repeat: repeat;
}
  
</style>
     <title>Hello, world!</title>
      </head>
*/?>

<?php echo $wordstart->htmlhead; ?>


 


<?php /* 
  <body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
*/?>

<?php echo $wordstart->texta; ?>
<?php
include "view/footer.php";


?>

