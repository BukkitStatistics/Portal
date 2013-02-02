<div class="well custom-well fixed-height500" style="padding: 10px; margin-top: 20px !important;">

<?php
if(!isset($totalKills)) {
	$totalKills = $serverObj->getTotalPVPKills();
	$totalDeaths = $serverObj->getTotalKills();
	$mostDangerousWeapon = $serverObj->getMostDangerousWeapon();
	$weaponMostDangerous = QueryUtils::getResourceNameById($mostDangerousWeapon['name']);
	$weaponMostDangerousImg = str_replace(" ", "%20", $weaponMostDangerous);
	

	$totalPVEKills = $serverObj->getTotalPVEKills();
	$mostDangerousCreature = $serverObj->getMostDangerousPVECreature();
	$creatureMostDangerous = QueryUtils::getCreatureNameById($mostDangerousCreature['name']);
	$creatureMostDangerousImg = str_replace(" ", "%20", $creatureMostDangerous);
	
	$mostKilledCreature = $serverObj->getMostKilledPVECreature();
	$creatureMostKilled = QueryUtils::getCreatureNameById($mostKilledCreature['name']);
	$creatureMostKilledImg = str_replace(" ", "%20", $creatureMostKilled);
	
	$totalPVPKills = $serverObj->getTotalPVPKills();
	$mostKillerPlayer = $serverObj->getMostKillerPVP();
	$playerMostKiller = new Player($mostKillerPlayer['name']);
	$mostKilledPlayer = $serverObj->getMostKilledPVP();
	$playerMostKilled = new Player($mostKilledPlayer['name']);
}
?>

<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-success"><?php echo $totalDeaths; ?></span></dt>
	<dd>Total Deaths</dd>
</dl>
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-success">
		<img src="./yasp/util/block/<?php echo $weaponMostDangerousImg; ?>"
		 class="img-thumb"
		 title="<?php echo $weaponMostDangerous; ?>"
		 alt="<?php echo $weaponMostDangerous; ?>"
		 />
	</span></dt>
	<dd>Best Weapon</dd>
</dl>
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-success"><?php echo $totalPVPKills; ?></span></dt>
	<dd>PvP Kills</dd>
</dl>		
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-success"><?php echo $totalPVEKills; ?></span></dt>
	<dd>PvE Kills</dd>
</dl>
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-important">
		<img src="./yasp/util/mob/<?php echo $creatureMostDangerousImg; ?>"
		 class="img-thumb"
		 title="<?php echo $creatureMostDangerous; ?>"
		 alt="<?php echo $creatureMostDangerous; ?>"
		 />
	</span></dt>
	<dd>Most Dangrous</dd>
</dl>
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-important">
		<img src="./yasp/util/mob/<?php echo $creatureMostKilledImg; ?>"
		 class="img-thumb"
		 title="<?php echo $creatureMostKilled; ?>"
		 alt="<?php echo $creatureMostKilled; ?>"
		 />
	</span></dt>
	<dd>Most Killed</dd>
</dl>
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-important">
		<a href="./player/?username=<?php echo $playerMostKiller->getName(); ?>">
		<img src="./yasp/util/player/head/<?php echo $playerMostKiller->getName(); ?>"
		 class="img-thumb"
		 alt="<?php echo $playerMostKiller->getName(); ?>"
		 title="<?php echo $playerMostKiller->getName(); ?>"
		 />
		</a>
	</span></dt>
	<dd>Most Kills</dd>
</dl>
<dl class="dl-horizontal dl-stats">
	<dt><span class="badge badge-important">
		<a href="./player/?username=<?php echo $playerMostKilled->getName(); ?>">
		<img src="./yasp/util/player/head/<?php echo $playerMostKilled->getName(); ?>"
		 class="img-thumb"
		 alt="<?php echo $playerMostKilled->getName(); ?>"
		 title="<?php echo $playerMostKilled->getName(); ?>"
		 />
		</a>
	</span></dt>
	<dd>Most Deaths</dd>
</dl>

</div>