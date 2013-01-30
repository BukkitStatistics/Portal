<?php

$url =  ($_SERVER['REQUEST_URI']);
if($url[strlen($url)-1] == "/") { $url = substr($url, 0, strlen($url)-1); }
$parts = Explode('/', $url);
$block = $parts[count($parts) - 1];

$block = strtolower($block);
$block = str_replace(" ", "", $block);
$block = str_replace("-", "", $block);
$block = str_replace("'", "", $block);
$block = str_replace("\"", "", $block);
$block = str_replace("%20", "", $block);

$image = imagecreatefrompng("./img/".$block.".png");
imagealphablending ($image, false);
imagesavealpha ($image, true);
header("Content-Type: image/png"); 
ImagePng($image); 
ImageDestroy($image); 
exit();
?>