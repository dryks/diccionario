<?php
<<<<<<< HEAD
//glavnaya page index
=======
//spatb pora
>>>>>>> a6b9c8cc4e57713606fd3276e9c5dd5ec350a3f0
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
