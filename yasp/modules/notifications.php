<?php

if (!$online) {
	echo "<div class='alert'>";
	echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
	echo "<i class='icon-warning-sign'></i> <strong>Warning!</strong> The server seems to be either offline or inaccessible. Statistical data is reproduced from cached files.";
	echo "</div>";
}
			
?>