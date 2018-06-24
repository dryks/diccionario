<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php if (isset($title)){echo $title;}?></title>
    <meta name="description" content=" <?php if (isset($title)){echo $title;}?> ">
  <meta property="og:title" content="<?php if (isset($title)){echo $title;}?>, СЕО">
  <meta property="og:description" content="<?php if (isset($title)){echo $title;}?> ">
  <?php if (isset($parsiteinfo["imgurl"])) { echo  '<meta property="og:image" content="'.$parsiteinfo["imgurl"].'">';     };?>
    <meta property="og:type" content="website">
    <?php  if (isset($pathname)) { echo  ' <meta property="og:url" content= "https://slenga.ru'.$pathname.'.html">';     };?>
 
    <title><?php if (isset($title)){echo $title;}?></title>



    <!-- Bootstrap CSS -->
     <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-0Mou2qXGeXK7k/Ue/a1hspEVcEP2zCpoQZw8/MPeUgISww+VmDJcy2ri9tX0a6iy" crossorigin="anonymous">
    <style>

        body {
  background-image: url("http://diccionario.pro/img/light.png");
  background-repeat: repeat;
}
  
</style>
    
  </head>