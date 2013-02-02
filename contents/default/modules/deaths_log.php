<div class="well custom-well" style="padding: 10px;" id="deathsBlock">	
		
<div class="content">	

<?php
$query=$serverObj->getAllKills();
		
while($row=mysql_fetch_assoc($query)){
	$time = QueryUtils::formatDate($row['time']);
	$killerType = $row['killer'];
	$victimType = $row['killed'];
	$weapon = $row['weapon'];
	
	echo "<div class='well well-small'>";
	echo "<div class='row-fluid'>";
	echo "<div class='span5'>".$time."</div>";
	echo "<div class='span3' style='text-align:right;'>";
		echo "<span class='label label-success'>";
		if($killerType == 'Player') {
			$killerName = $row['killer_player'];
			echo "<img src='./yasp/util/player/head/".$killerName."' class='img-thumb img-polaroid' title='".$killerName."' alt='".$killerName."' /> ";
			echo "<a href='./player/?username=".$killerName."' style='color: white !important;'>".$killerName."</a>";
		} else {
			$killerName = str_replace(" ", "%20", $killerType);
			echo "<img src='./yasp/util/mob/".$killerName."' class='img-thumb img-polaroid' title='".$killerType."' alt='".$killerType."' /> ";
			echo $killerType;
		}
		echo "</span>";
	echo "</div>";
	echo "<div class='span1' style='text-align:center;'>";
		if($weapon == "None" || $weapon == "Hand") { 
			echo "<img src='./yasp/util/block/none' class='img-thumb' title='".$weapon."' alt='".$weapon."' />";
		} else {
			$weaponName = str_replace(" ", "%20", $weapon);
			echo "<img src='./yasp/util/block/".$weaponName."' class='img-thumb' title='".$weapon."' alt='".$weapon."' />";
		}
	echo "</div>";
	echo "<div class='span3'>";
		echo "<span class='label label-important'>";
		if($victimType == 'Player') {
			$victimName = $row['killed_player'];
			echo "<img src='./yasp/util/player/head/".$victimName."' class='img-thumb img-polaroid' title='".$victimName."' alt='".$victimName."' /> ";
			echo "<a href='./player/?username=".$victimName."' style='color: white !important;'>".$victimName."</a>";
		} else {
			$victimName = str_replace(" ", "%20", $victimType);
			echo "<img src='./yasp/util/mob/".$victimName."' class='img-thumb img-polaroid' title='".$victimType."' alt='".$victimType."' /> ";
			echo $victimType;
		}
		echo "</span>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "\n";
}
		
?>
</div>

<div class="pagination force-center"></div>

</div>