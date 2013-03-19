<?php
include("../include/config/config.php");
include("../include/security/logout.php");

$origin = $_POST['origin'];
header("Location: ../".$origin); 
?>