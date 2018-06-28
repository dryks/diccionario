<?php
$word= htmlspecialchars($_GET["word"]);
$morfij=preg_match_all("#^словарь:#",$word,$res);
if($morfij==1){
    $word="Вики".$word; 
};
urldecode($word);
include("./include/conf.php");
$title="Категории словаря сленга";


$input=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=text&format=json&mobileformat&redirects=1&useskin=minerva&page=".$word);
$texta=json_decode($input);

$input2=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=headhtml&mobileformat&format=json&redirects=1&useskin=minerva&page=".$word);
$texta2=json_decode($input2);

$input3=file_get_contents("https://ru.wiktionary.org/w/api.php?action=parse&prop=categories&mobileformat&format=json&redirects=1&useskin=minerva&page=".$word);
$category=json_decode($input3);
//var_dump($texta);


//вывести категории в кейвордс и вывести список снизу например
$headtexture=$texta2->parse->headhtml->{'*'}; 
//var_dump($texta->parse->text->{'*'});
$texture=$texta->parse->text->{'*'}; 
$title=$texta->parse->title; 
$title= preg_replace('#Вики#','',$title);
$textim2 = preg_replace("~<a .*>Править</a>~",'',$texture);
//$textim2 = preg_replace('~<a href="https://ru.wikipedia.org/wiki/.*>.*</a>~','',$textim2);
$textim2 = preg_replace('~<a href="https://.*.wikipedia.org/wiki/.*>.*</a>~','',$textim2);
//$textim2 = preg_replace('#<a href="/w/index.php?title.*" class=".*" title=".*">.*</a>#','',$textim2);
$textim2 = preg_replace('#<a href="/w/.*redlink=1" class="new" title=".*">.*</a>#','',$textim2);
//$textim2 = preg_replace('#<td class=\"mbox-text\" style=\"\">.*#','',$textim2);
//$textim2 = preg_replace('#<table class=\"plainlinks fmbox fmbox-editnotice stub-main-footer\" style=\".*">.*</table>#','',$textim2);


$textim2 = preg_replace('#<div class=\"noresize\">.*#','',$textim2);
$textim2 = preg_replace('#<td class=\"mbox-text\".*#','',$textim2);
$textim2 = preg_replace('#<td class=\"mbox-image\">.*#','',$textim2);
$textim2 = preg_replace('#<tr style="height:25px;">.*#','',$textim2);
$textim2 = preg_replace('#<li></li>#','',$textim2);


$textim2 = preg_replace('#<li>Добавить.*\<\/li\>#','',$textim2);
//$textim2 = preg_replace('#Викисловарь#','словарь',$textim2);
$textim2 = preg_replace('#%D0%92%D0%B8%D0%BA%D0%B8%D1%81%D0%BB%D0%BE%D0%B2%D0%B0%D1%80%D1%8C#','словарь',$textim2);
//параграфы поиск
$morf=preg_match_all("#Морфологические_и_синтаксические_свойства#",$textim2,$res);
$proiznoc=preg_match_all('#id="Произношение"#',$textim2,$res);
$znach=preg_match_all('#id="Значение"#',$textim2,$res);
$sinonim=preg_match_all('#id="Синонимы"#',$textim2,$res);
$etimology=preg_match_all('#id="Этимология"#',$textim2,$res);

$textim2 = preg_replace('~<a href="/wiki/~','<a href="/word/',$textim2);
$textim2 = preg_replace("~<a .*>Править</a>~",'',$textim2);
   //$textim = preg_replace('#Править|вики-текст#', '', $texture);
   //$textim = preg_replace('#Править#', '', $textim);
  // $textim2 = preg_replace('##', '', $textim);
   $textim2short=strip_tags($textim2);
 
   //$textim2short=trim($textim2short);
   $textim2short = preg_replace('/\s+/', ' ', $textim2short);
   $textim2short = substr($textim2short, 0, 150);
   $textim2short = preg_replace('#"#', '', $textim2short);
   //убрать из title нижний дефис
   //$wordtitle = preg_replace('#_#', ' ', $word);

   $headtexture1 = preg_replace('#<!DOCTYPE html> .* <head>#', '', $headtexture);

   $headtexture = preg_replace('#<html.*>#', '', $headtexture);
   $headtexture = preg_replace('#<!DOCTYPE html>#', '', $headtexture);
   $headtexture = preg_replace('#<meta charset="UTF-8"/>#', '', $headtexture);
   $headtexture = preg_replace('#<head>#', '', $headtexture);
   $headtexture = preg_replace('#<title>.*</title>#', '', $headtexture);
   $headtexture = preg_replace('#</head>#', '', $headtexture);
   $headtexture = preg_replace('#<body.*>#', '', $headtexture);
 
   //echo ddddddddddddddddddddddddddddddddddddd;
   //echo $headcategory;

   //var_dump($category);
   $categoryarray=$category->parse->categories;
   //число категорий с 0
  $z=count($categoryarray)-1;








?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=" <?php if (isset($title)){echo $title;}?> ">
  <meta property="og:title" content="<?php if (isset($title)){echo $title;}?>, СЕО">
  <meta property="og:description" content="<?php if (isset($title)){echo $title;}?> ">
  <?php if (isset($parsiteinfo["imgurl"])) { echo  '<meta property="og:image" content="'.$parsiteinfo["imgurl"].'">';     };?>
    <meta property="og:type" content="website">
    <?php  if (isset($pathname)) { echo  ' <meta property="og:url" content= "https://slowari.ru'.$pathname.'.html">';     };?>
 
    <title><?php if (isset($title)){echo $title;}?></title>
 
                
               
                <?php
                include("include/topmenu.php");
                // блок параграфов текста
             if($morf==1){ 

                 echo '<li class="nav-item"><a class="nav-link" href="https://slowari.ru/word/'.$word.'#Морфологические_и_синтаксические_свойства"><img class="menu-icon"  width="17px" src="../images/menu_icons/05.png" alt="Падежи слова '.$word.'"> <span class="menu-title">Падежи</span></a></li>';
              };

              if($proiznoc==1){ 

                echo '<li class="nav-item"><a class="nav-link" href="https://slowari.ru/word/'.$word.'#Произношение"><img class="menu-icon"  width="17px" src="../images/menu_icons/09.png" alt="Произношение слова '.$word.'"> <span class="menu-title">Произношение</span></a></li>';
                          };   
                          
                   if($znach==1){ 

                            echo '<li class="nav-item"><a class="nav-link" href="https://slowari.ru/word/'.$word.'#Значение"><img class="menu-icon"  width="17px" src="../images/menu_icons/06.png" alt="Значение слова '.$word.'"> <span class="menu-title">Значение</span></li></a>';
                                      };     
                                      
                    if($sinonim==1){ 

                           echo '<li class="nav-item"><a class="nav-link" href="https://slowari.ru/word/'.$word.'#Синонимы"><img class="menu-icon"  width="17px" src="../images/menu_icons/04.png" alt="Синонимы слова '.$word.'"> <span class="menu-title">Синонимы</span></a></li>';
                            }; 
                     if($etimology==1){ 

                                echo '<li class="nav-item"><a class="nav-link" href="https://slowari.ru/word/'.$word.'#Этимология"><img class="menu-icon"  width="17px" src="../images/menu_icons/02.png" alt="Происхождение слова '.$word.'"> <span class="menu-title">Происхождение</span></a></li>';
                             };     
                      ?>




            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
               



                    <div class="row" id="description">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4" id="rating"><?php if (isset($title)){echo $title;}?></h4>
                                    <div class="row">
                                      
                                       
                                    <div class="row">
<?php

  

echo $textim2;


?>
     </div>                                                      
                                       
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


  <?php include("include/footer.php");?>
 



    <!-- End custom js for this page-->
</body>

</html>