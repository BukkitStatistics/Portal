<?php

$past = time() - 100; 
setcookie(StatsLogin, gone, $past, "/", "", false);
setcookie(StatsPass, gone, $past, "/", "", false);
header("Location: ./"); 

?>