<?php
$word= htmlspecialchars($_GET["word"]);
include"model/word.php";

//обработка страницы
$wordstart=new Word();

//$lom=$cat->gettext("Москва")->parse->headhtml->{'*'};
$wordget=$wordstart->gettext($word); 
$wordclean=$wordstart->cleantext(); 
//сборка страницы
echo $wordstart->htmlhead; 
echo $wordstart->texta;
include "view/footer.php";

//парсинг меню вики
//https://ru.wiktionary.org/w/api.php?action=parse&format=json&prop=sections&page=%D0%BC%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&redirects&
