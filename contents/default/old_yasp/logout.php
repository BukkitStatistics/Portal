<?php
include("../yasp/config/config.php");
include("../yasp/security/logout.php");

$origin = $_POST['origin'];
header("Location: ../".$origin); 
?>