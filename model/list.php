<?php
if (isset($_GET["id"]) and intval($_GET["id"])<85){
	$page= htmlspecialchars($_GET["id"]);
}elseif(intval($_GET["id"])>85){
$page=1;
//die();	
}else{
$page=1;
};
$end=intval($page."0000");
$start=intval($end)-9999 ;

echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n';

$link = mysqli_connect("localhost", "diccionario", "diccionario", "diccionario");
$query = mysqli_query($link, "SET NAMES 'utf8'");
if ($result = mysqli_query($link, "SELECT id , title  FROM base WHERE id BETWEEN ".$start." AND ".$end." ")) { 
  while($row = mysqli_fetch_array($result))
{
	if (isset($row['id'])){ echo "<url>\n
  <loc>https://diccionario.pro/wiki/".$row['title']."</loc>\n
<priority>0.5</priority>\n
<changefreq>weekly</changefreq>\n
</url>\n";};	
};
};

echo "</urlset>";