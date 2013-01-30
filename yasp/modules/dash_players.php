<div class="well custom-well fixed-height" style="padding: 10px; margin: 0px;">

<h3 style="text-align:center;">Online Players</h3>

<?php

$cnt = $serverObj->getAllPlayersOnlineCount();

if($cnt > 0) {
	$playerOnlineArray = $serverObj->getAllPlayersOnline();
	foreach($playerOnlineArray as $player) {
		echo "<a href='./player/".$player->getName()."'><img src='./yasp/util/player/head/".$player->getName()."'  class='img-polaroid player-heads'/></a>";
	}
} else {
	echo "<div class='force-center'><em>No players online</em></div>";
}

?>

</div>