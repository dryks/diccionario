<?php
echo 100;
class Word{
    public $wiki="Wikcionario:Portada";

function __construct($wiki)
{
$this->wiki=$wiki;
}


function getwiki($wiki){
    
    $input=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=text|headhtml|categories&format=json&mobileformat&redirects=1&useskin=minerva&page=".$wiki);
    $texta=json_decode($input);
return $texta;

}



}


$cat=new Word("Wikcionario:Portada");

$lom=$cat->getwiki("Москва");

echo 222222;
var_dump($lom);