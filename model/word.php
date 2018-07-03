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
<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-0Mou2qXGeXK7k/Ue/a1hspEVcEP2zCpoQZw8/MPeUgISww+VmDJcy2ri9tX0a6iy" crossorigin="anonymous">
<style>

   body {
background-image: url("http://diccionario.pro/img/light.png");
background-repeat: repeat;
}

</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>';
//вывод в боди после тега body
$navig='
<div class="navbar navbar-expand-lg navbar-dark bg-primary">
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
</div>';


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


$cat=new Word();

//$lom=$cat->gettext("Москва")->parse->headhtml->{'*'};
$lom=$cat->gettext($word); 
$clean=$cat->cleantext(); 
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

<?php echo $cat->htmlhead; ?>


 


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

<?php echo  $cat->texta; ?>
<?php
function get_footer(){
  ob_start();
include "view/footer.php";


return ob_get_clean();
echo "199";

}; 
echo get_footer();

?>

