<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> <?php if (isset($text)) {
        # code...
  
  foreach($text as $item){
    echo' 
    <h2> <a href="/index.php?id='.$item["id"].'">'.$item["title"].'</a></h2>';
    echo "<br>описание:" .$item["category"];

}
}
   
   ?>    </h1>
</body>
</html>