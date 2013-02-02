<?php
$username = $_GET['username'];
//$string = "../login.php?headOnly=true&displayHairs=false&ratio=4&login=".$username;

header("Location: https://minotar.net/avatar/".$username."/32");

?>