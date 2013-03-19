<?php

if(isset($_COOKIE['StatsLogin'])) {
	$login = $_COOKIE['StatsLogin']; 
	$pass = $_COOKIE['StatsPass'];
	
} else {
	$login = "Guest";
	$pass = "";
}

?>