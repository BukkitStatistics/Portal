<?php
	if(!isset($_COOKIE['StatsLogin']) ||
	($login == "Guest" && $pass == "") ||
	($login != CONFIG_USER || $pass != CONFIG_PASS)) {
		header("Location: ../login/?origin=settings");
	}
?>