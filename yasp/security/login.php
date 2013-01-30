<?php

if (isset($_POST['signin'])) {
	if ($_POST['cuser'] != CONFIG_USER || $_POST['cpass'] != CONFIG_PASS) {
		echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
		echo "<strong>Error!</strong> Invalid username-password pair";
		echo "</div>";
	} else {
	 	$hour = time() + 3600; 
		setcookie(StatsLogin, $_POST['cuser'], $hour, "/", "", false);
		setcookie(StatsPass, $_POST['cpass'], $hour, "/", "", false);
		
		$origin = $_POST['origin'];
		header("Location: ../".$origin); 
 	} 
}

?>