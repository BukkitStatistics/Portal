<?php
$url =  ($_SERVER['REQUEST_URI']);
if($url[strlen($url)-1] == "/") { $url = substr($url, 0, strlen($url)-1); }
$parts = Explode('/', $url);
$mob = $parts[count($parts) - 1];

$mob = strtolower($mob);
$mob = str_replace(" ", "", $mob);
$mob = str_replace("-", "", $mob);
$mob = str_replace("'", "", $mob);
$mob = str_replace("\"", "", $mob);
$mob = str_replace("%20", "", $mob);

$image = imagecreatefrompng("./img/".$mob.".png");
imagealphablending ($image, false);
imagesavealpha ($image, true);
header("Content-Type: image/png"); 
ImagePng($image); 
ImageDestroy($image); 
exit();

?>