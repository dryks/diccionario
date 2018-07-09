<?php
$word= htmlspecialchars($_GET["word"]);
include"model/photo.php";

//обработка страницы
$photostart=new Photo();

//$lom=$cat->gettext("Москва")->parse->headhtml->{'*'};
$photoget=$photostart->gettext($word); 
$photoclean=$photostart->cleantext(); 
//сборка страницы
echo $photostart->htmlhead; 
echo $photostart->texta;
include "view/footer.php";

//парсинг меню вики
//https://ru.wiktionary.org/w/api.php?action=parse&format=json&prop=sections&page=%D0%BC%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&redirects&
