<?php
echo 100;
$word="москва";
class Word{
    public $wiki; //слово запроса
    public $texta;//text body страницы

function __construct($wiki="Заглавная_страница")
{
$this->wiki=$wiki;
$this->texta=$texta;
}


function gettexta($wiki="Заглавная_страница"){
    
    $input=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=text|headhtml|categories&format=json&mobileformat&redirects=1&useskin=minerva&page=".$wiki);
    $texta=json_decode($input);
    
return $texta;

}

function cleantexta(){

}



}


$cat=new Word();

$lom=$cat->getwiki("Москва")->parse->headhtml->{'*'};
$lom=$cat->getwiki($word)->parse->text->{'*'}; 
echo 222222;
var_dump($lom);