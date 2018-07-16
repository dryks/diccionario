<?php
$z="100";
//!== "null"
if (isset($_GET["text"])) {
	$z=htmlspecialchars($_GET["text"]);
};
$xmlsearch= json_decode(file_get_contents("https://es.wiktionary.org/w/api.php?action=opensearch&search=".$z));
//var_dump($xmlsearch[2][1]);
$name=$xmlsearch[1][0];
$text=$xmlsearch[2][0];
$countryName=$xmlsearch[3][0];
echo '[';
for ($i=0; $i <=9 ; $i++) { 
	$name=$xmlsearch[1][$i];
	$text=$xmlsearch[2][$i];
	$url=$xmlsearch[3][$i];
    $url = strstr($url, '/wiki/');
	//$url=	preg_replace("#/wiki/#","/word/",$url);
	echo '{
		"text": "'.$name.'",
		"site": "https://diccionario.pro'.$url.'"
		},';
};
echo '{
	"text": "  ",
	"site": ""
	}]';
