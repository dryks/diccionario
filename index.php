<?php
if(isset($_GET['category'])){
   include "category.php";
}elseif(isset($_GET['word'])){
    include "model/word.php";

}elseif(isset($_GET['categorymain'])){
    include "categorymain.php";
 }elseif(isset($_GET['id'])){
    include "news.php";
 }elseif($_SERVER['REQUEST_URI'] == '/' or $_SERVER['REQUEST_URI'] == '/index.php') {
    include "home.php";
}elseif(isset($_GET['home'])) {
    include "home.php";
 }else{
    header('Location: /404');
echo 'error url';
};
