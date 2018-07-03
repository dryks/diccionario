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
