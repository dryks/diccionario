<?php

include "config.php";
include "classes/page.php";
include "classes/database.php";

$page = new Page();

if (isset($_GET["id"])) {
    $id=$_GET['id'];

if (id==0) {
    $text=$page->get_one($id);

}else{
exit('error parameter');

}

$text=$page->get_one();
print_r($text);
}else{
$text=$page->get_all();
//print_r($text);
echo $page->get_body($text,"main");

}

?>