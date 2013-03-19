<?php
define('__INC__', dirname(__FILE__) . '/');

require_once (__INC__ . '../include/config/config.php');
require_once (__INC__ . '../include/config/version.php');
require_once (__INC__ . '../include/locale/' . LOCALE . '.php');
require_once (__INC__ . '../include/_serverObj.php');
require_once (__INC__ . '../include/_playerObj.php');
require_once (__INC__ . '../include/query_utils.php');
require_once (__INC__ . '../include/loader.php');

$start = microtime(true);

$sObj = new YASP();
$serverObj = $sObj->getServer();

$online = !($serverObj->getServerStatus() == 'Offline');

include("../include/security/init.php");

$url =  ($_SERVER['REQUEST_URI']);
if($url[strlen($url)-1] == "/") { $url = substr($url, 0, strlen($url)-1); }
$parts = Explode('/', $url);
$pName = $parts[count($parts) - 1];


$_player = $serverObj->getPlayerByName($pName);
if (!isset($_player)) { $_player = $serverObj->getPlayer($_GET['uuid']); }

$_playerName = $_player->getName();
$_online = $_player->isOnline();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo SERVER_NAME; ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="../../../media/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../media/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="../../../media/css/font-awesome.min.css" rel="stylesheet">
	<link href="../../../media/css/tablesorter.css" rel="stylesheet">
	<link href="../../../media/css/yasp.css" rel="stylesheet">
	
	<style type="text/css">
	.player-stats {
	        position: relative;
	}
	
	.player-stats:after {
	    	content: "";
		background: url('../yasp/util/player/skin/<?php echo $_playerName; ?>') no-repeat !important;
		opacity: 0.2;
		top: 0;
		left: 20px;
		bottom: 0;
		right: -20px;
		position: absolute;
		z-index: -1;  
	}
	</style>
	
	<!--[if lt IE 9]>
    <script src="../../../src/js/html5.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#menubar">

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
	<div class="container force-center">
		<a class="brand" href="">
			<img src="<?php echo LOGO_URL; ?>" class="logo-img" alt="<?php echo SERVER_NAME; ?>" />
			<?php echo SERVER_NAME; ?>
		</a>
	
	
		<ul class="nav pull-right">
			<li>
				<a> <?php if ($online) { echo "Server status: <span class='label label-success'>Online</span>"; }
				else { echo "Server status: <span class='label label-important'>Offline</span>"; } ?> </a>
			</li>
			<?php if ($login == "Guest") { echo '<li><a href="./login/">Log in</a></li>'; } else { ?>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdwn" data-target="#"><?php echo $login; ?><b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li role="menuitem"><a href="settings"><i class="icon-wrench"></i> Settings</a></li>
					<li role="menuitem"><a href="logout"><i class="icon-globe"></i> Log out</a></li>
				</ul>
			</li>
			
			<?php } ?>
		</ul>
	</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span2">
			<div class="nav sidebar-nav well" style="position: fixed;" id="menubar">
				<ul class="nav nav-list">
					<li><a href=""><i class="icon-tasks"></i> Dashboard</a></li>
					<li class="divider"></li>
					<li><a href="#players"><i class="icon-group"></i> Players</a></li>
					<li><a href="#world"><i class="icon-picture"></i> World</a></li>
					<li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
				</ul>
			</div>
		</div>
		<div class="span10 player-stats" id="content">
		
<!-- ===== Content Start ===== -->

	<h1>
	<?php 
	echo "<img src='../include/util/player/head/".$_playerName."' alt='".$_playerName."' /> ".$_playerName." ";
	if($_online) echo "<span class='label label-success'>In-Game</span>";
	else echo "<span class='label label-important'>Offline</span>";
	?>
	</h1>
	
	<?php @include ('../include/modules/players_search.php'); ?>
	
	<p><strong>Joined on:</strong> <?php echo(QueryUtils::formatDate($_player->getFirstLogin())); ?></p>
	<p><strong>Last seen:</strong> <?php echo(QueryUtils::formatDate($_player->getLastLogin())); ?></p>
	<p><strong>Playtime:</strong> <?php echo(QueryUtils::formatSecs($_player->getNumberOfSecondsLoggedOn())); ?></p>
	
			
	<div class="row-fluid" style="width:100% !important;">
		<div class="span4" style="width: 30% !important;">
			<h3>Distances</h3>
			<p><strong>Travelled:</strong> <?php echo $_player->getDistanceTraveledTotal(); ?> meters</p>
			<p><strong>Walked:</strong> <?php echo $_player->getDistanceTraveledByFoot(); ?> meters</p>
			<p><strong>Minecarted:</strong> <?php echo $_player->getDistanceTraveledByMinecart(); ?> meters</p>
			<p><strong>Boated:</strong> <?php echo $_player->getDistanceTraveledByBoat(); ?> meters</p>
			<p><strong>Piggybacked:</strong> <?php echo $_player->getDistanceTraveledByPig(); ?> meters</p>
		</div>
		
		<div class="span4" style="width: 30% !important;">
			<h3>Blocks</h3>
			<p><strong>Total Blocks Placed:</strong> <?php echo($_player->getBlocksPlacedTotal()); ?> Blocks</p>
			<p><strong>Most Popular Block Placed:</strong>
			
			<?php
				$block = $_player->getBlocksMostPlaced();
				echo QueryUtils::getResourceNameById($block['block_id']);
				echo " (".$block['sum'].")";
			?>
			
			</p>
			<p><strong>Total Blocks Destroyed:</strong> <?php echo($_player->getBlocksDestroyedTotal()); ?> Blocks</p>
			<p><strong>Most Popular Block Destroyed:</strong>
			
			<?php
				$block = $_player->getBlocksMostDestroyed();
				echo QueryUtils::getResourceNameById($block['block_id']);
				echo " (".$block['sum'].")";
			?>
			
			</p>
		</div>
		
		<div class="span4" style="width: 30% !important;">
			<h3>Items</h3>
			<p><strong>Total Items Picked Up:</strong> <?php echo($_player->getPickedUpTotal()); ?> Items</p>
			<p><strong>Most Popular Item Picked Up:</strong>
			
			<?php
				$block = $_player->getMostPickedUp();
				echo QueryUtils::getResourceNameById($block['block_id']);
				echo " (".$block['sum'].")";
			?>
			
			</p>
			<p><strong>Total Items Dropped:</strong> <?php echo($_player->getDroppedTotal()); ?> Items</p>
			<p><strong>Most Popular Item Dropped:</strong>
			
			<?php
				$block = $_player->getMostDropped();
				echo QueryUtils::getResourceNameById($block['block_id']);
				echo " (".$block['sum'].")";
			?>
			
			</p>
		</div>
		
	</div>
	<div class="row-fluid" style="width:100% !important;">
		
		<div class="span4" style="width: 30% !important;">
			<h3>PvP Stats</h3>
			<p><strong>Total Kills:</strong> <?php echo($_player->getPlayerKillTable() ? count($_player->getPlayerKillTable()) : 0); ?></p>
			<p><strong>Total Deaths:</strong> <?php echo($_player->getPlayerDeathTable() ? count($_player->getPlayerDeathTable()) : 0); ?></p>
			<p><strong>Favorite Weapon:</strong> 
			
			<?php
			$weapon = $_player->getMostDangerousWeapon();
			echo(QueryUtils::getResourceNameById($weapon['name']));
			echo " (".$weapon['count'].")";
			?>
	
			</p>
			
			<br />
			<p><strong>PvP Kills:</strong> <?php echo($_player->getPlayerKillTablePVP() ? count($_player->getPlayerKillTablePVP()) : 0); ?></p>
			<p><strong>PvP Deaths:</strong> <?php echo($_player->getPlayerDeathTablePVP() ? count($_player->getPlayerDeathTablePVP()) : 0); ?></p>
			<p><strong>Most Killed Player:</strong> 
			
			<?php
			$ar = $_player->getMostKilledPVP();
			$player = $serverObj->getPlayer($ar['name']);
			if($ar['count'] > 0) {
				echo "<a href='../player/".$player->getName()."'>".$player->getName()."</a> (".$ar['count']." times)";
			} else echo "<em>None!</em>";
			?>
			
			</p>
			<p><strong>Sworn Enemy:</strong> 
			
			<?php
			$ar = $_player->getMostKilledByPVP();
			$player = $serverObj->getPlayer($ar['name']);
			if($ar['count'] > 0) {
				echo "<a href='../player/".$player->getName()."'>".$player->getName()."</a> (".$ar['count']." times)";
			} else echo "<em>None!</em>";
			?>
			
			</p>
		</div>
		
		<div class="span4" style="width: 30% !important;">
			<h3>PvE Stats</h3>
			<p><strong>PVE Kills:</strong> <?php echo($_player->getPlayerKillTablePVE() ? count($_player->getPlayerKillTablePVE()) : 0); ?></p>
			<p><strong>PVE Deaths:</strong> <?php echo($_player->getPlayerDeathTablePVE() ? count($_player->getPlayerDeathTablePVE()) : 0); ?></p>
			<p><strong>Most Killed Creature:</strong> 
			
			<?php
			echo(QueryUtils::getCreatureNameById($_player->getPlayerMostKilledPVECreature()));
			?>
			
			</p>
			<p><strong>Most Dangerous Creature:</strong> 
			
			<?php
			echo(QueryUtils::getCreatureNameById($_player->getPlayerMostDangerousPVECreature()));
			?>
			
			</p>
		</div>
		
		<div class="span4" style="width: 30% !important;">
			<h3>Other deaths</h3>
			<p><strong>Other Type Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableOther() ? count($_player->getPlayerDeathTableOther()) : 0); ?>
			</p>
			<p><strong>Falling Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Fall")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Fall"))) : 0); ?>
			</p>
			<p><strong>Drowning Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Drowning")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Drowning"))) : 0); ?>
			</p>
			<p><strong>Suffocation Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Suffocation")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Suffocation"))) : 0); ?>
			</p>
			<p><strong>Lightning Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Lightening")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Lightening"))) : 0); ?>
			</p>
			<p><strong>Lava Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Lava")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Lava"))) : 0); ?>
			</p>
			<p><strong>Fire Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Fire")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Fire"))) : 0); ?>
			</p>
			<p><strong>Fire Tick Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Fire Tick")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Fire Tick"))) : 0); ?>
			</p>
			<p><strong>Explosion Deaths:</strong> 
			<?php echo($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Entity Explosion")) ? count($_player->getPlayerDeathTableType(QueryUtils::getKillTypeIdByName("Entity Explosion"))) : 0); ?>
			</p>
		</div>
	</div>
		
<!-- ===== Content End ===== -->
		
		</div>
	</div>
	
	<hr>
	
	<footer>
		<div class="row-fluid">
		<div class="span10 offset2">
			<div class="row-fluid">
				<div class="span2"><p><a href="https://github.com/bitWolfy/YetAnotherStatisticsPlugin"><img src="../../../media/img/plugin_logo_small.png" alt="YASP" /></a></p></div>
				<div class="span4"><p style="position:relative; top:5px;">&copy; 2013 Yet Another Statistics Plugin<br />Based on <a href="http://dev.bukkit.org/server-mods/statisticianv2/" target="_blank">Statistician 2</a> technology</p></div>
				<div class="span4 offset2" style="text-align: right;"><p>Running database version <?php echo ($sObj->getDatabaseVersion()); ?><br />YASP-WEB v.<?php echo VERSION; ?></p></div>
			</div>
		</div>
		</div>
	</footer>

</div>

<script src="../../../src/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../../../src/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../../src/js/jquery.tablesorter.js" type="text/javascript"></script>
<script src="../../../src/js/jquery.pajinate.js" type="text/javascript"></script>
<script src="../../../src/js/initialize.js" type="text/javascript"></script>
<script>
	<?php
	$player_array = $serverObj->getAllPlayerNames();
	?>
	
	
	var plArr = <?php echo json_encode($player_array); ?>;
	alert(plArr[0]);
	
	$('#playerSearch').typeahead(
		[source: plArr ]
	);
</script>

</body>
</html>