<div class="well custom-well" id="playersBlock">


<table class="table table-bordered table-hover tablesorter"  id="playersTable">
	<thead>
	<tr>
		<th>Name</th>
		<th>Last Seen</th>
		<th>Date Joined</th>
	</tr>
	</thead>
	<tbody class="content">

	<?php
	
	
		$query = $serverObj->getAllPlayersForRealNow();
	
		while($row = mysql_fetch_assoc($query)) {
			
			$player = new PLAYER($row['uuid']);
			
			echo "<tr>";
			echo "<td><img src='./include/util/player/head/".$player->getName()."' alt='".$player->getName()."' class='img-thumb' /> <a href='./player/".$player->getName()."' >".$player->getName()."</a></td>";
			echo "<td>".QueryUtils::formatDate($player->getLastLogin())."</td>";
			echo "<td>".QueryUtils::formatDate($player->getFirstLogin())."</td>";
			echo "</tr>";
		}
	 ?>
	
	</tbody>
</table>

<div class="pagination force-center"></div>

</div>