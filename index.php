<?php
//spatb pora
if(isset($_GET['category'])){
   include "category.php";
}elseif(isset($_GET['word'])){
    include "controller/word.php";

}elseif(isset($_GET['photo'])){
    include "controller/photo.php";
}elseif(isset($_GET['list0'])){
    include "controller/list0.php";
}elseif(isset($_GET['id'])){
    include "controller/list.php";
}else{
    header('Location: /404');
echo 'error url';
};
