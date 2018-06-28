<?php
echo 100;
$word="москва";
class Word{
    public $wiki; //слово запроса
    public $texta="100";//text body страницы

function __construct($wiki="Заглавная_страница")
{
$this->wiki=$wiki;
$this->texta=$texta;
}


function gettext($wiki="Заглавная_страница"){
    
    $input=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=text|headhtml|categories&format=json&mobileformat&redirects=1&useskin=minerva&page=".$wiki);
    $this->texta=json_decode($input);
   
return $texta;

}


function cleantext(){
  return  $this->texta;

}




}


$cat=new Word();

$lom=$cat->gettext("Москва")->parse->headhtml->{'*'};
$lom=$cat->gettext($word)->parse->text->{'*'}; 
$clean=$cat->cleantext(); 
echo 222222;
var_dump($lom);
//var_dump($clean);