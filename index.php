<?php
define('__INC__', dirname(__FILE__) . '/');

require_once (__INC__ . './yasp/config/config.php');

if(SETUP_COMPLETE == false) header('Location: ./settings/');

require_once (__INC__ . './yasp/config/version.php');
require_once (__INC__ . './yasp/locale/' . LOCALE . '.php');
require_once (__INC__ . './yasp/_serverObj.php');
require_once (__INC__ . './yasp/_playerObj.php');
require_once (__INC__ . './yasp/query_utils.php');
require_once (__INC__ . './yasp/yasp.php');

$start = microtime(true);

$sObj = new YASP();
$serverObj = $sObj->getServer();

$online = !($serverObj->getServerStatus() == 'Offline');

include("./yasp/security/init.php");

if(isset($_GET['search'])) {
	$search = $_GET['search'];
	header('Location: ./player/'.$search);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo SERVER_NAME; ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="./src/css/bootstrap.min.css" rel="stylesheet">
	<link href="./src/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="./src/css/font-awesome.min.css" rel="stylesheet">
	<link href="./src/css/tablesorter.css" rel="stylesheet">
	<link href="./src/css/yasp.css" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="./src/js/html5.min.js"></script>
	<![endif]-->
</head>

<body data-spy="scroll" data-target="#menubar">

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
	<div class="container force-center">
		<a class="brand" href="../">
			<img src="../<?php echo LOGO_URL; ?>" class="logo-img" alt="<?php echo SERVER_NAME; ?>" />
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
					<li role="menuitem"><a href="./settings/"><i class="icon-wrench"></i> Settings</a></li>
					<li role="menuitem"><a href="./logout/"><i class="icon-globe"></i> Log out</a></li>
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
					<li><a href="#dashboard"><i class="icon-tasks"></i> Dashboard</a></li>
					<li class="divider"></li>
					<li><a href="#players"><i class="icon-group"></i> Players</a></li>
					<li><a href="#world"><i class="icon-picture"></i> World</a></li>
					<li><a href="#deaths"><i class="icon-tint"></i> Death Log</a></li>
				</ul>
			</div>
		</div>
		<div class="span10" id="content">
			<!-- ===== Notifications ===== -->
			<section id="dashboard">
				<?php @include ('./yasp/notifications.php'); ?>
			
			<!-- ===== Header ===== -->
				<?php @include ('./yasp/modules/header.php'); ?>
			
			
			<!-- ===== Dashboard ===== -->
				<div class="section-split"></div>
				<h1><i class="icon-tasks icon-large"></i> Dashboard</h1>
				
				<div class="row-fluid dashboard">
					<div class="span4"><?php @include ('./yasp/modules/dash_serverstats.php'); ?></div>
					<div class="span4"><?php @include ('./yasp/modules/dash_playerstats.php'); ?></div>
					<div class="span4"><?php @include ('./yasp/modules/dash_distances.php'); ?></div>
				</div>
				
				<div class="row-fluid dashboard">
					<div class="span4"><?php @include ('./yasp/modules/dash_blocks.php'); ?></div>
					<div class="span8"><?php @include ('./yasp/modules/dash_players.php'); ?></div>
				</div>
				
				<div class="row-fluid dashboard">
					<div class="span8"><?php @include ('./yasp/modules/dash_deaths.php'); ?></div>
					<div class="span4"><?php @include ('./yasp/modules/dash_items.php'); ?></div>
				</div>
			</section>
			
			<!-- ===== Players ===== -->
			<section id="players">
				<div class="section-split"></div>
				<h1><i class="icon-group icon-large"></i> Player Information</h1>
				<?php @include ('./yasp/modules/players_search.php'); ?>
				
				<?php @include ('./yasp/modules/players_table.php'); ?>
			</section>
			<!-- ===== World ===== -->
			<section id="world">
			<div class="section-split"></div>
				<div class="row-fluid">
					<div class="span6">
						<h1><i class="icon-picture icon-large"></i> Blocks</h1>
						<?php @include ('./yasp/modules/world_blocks.php'); ?>
					</div>
					<div class="span6">
						<h1><i class="icon-legal icon-large"></i> Items</h1>
						<?php @include ('./yasp/modules/world_items.php'); ?>
					</div>
				</div>
			</section>
			
			<!-- ===== Deaths ===== -->
			<section id="deaths">
				<div class="section-split"></div>
				<div class="row-fluid">
					<div class="span8">
						<h1><i class="icon-tint icon-large"></i> Death Log</h1>
						<?php @include ('./yasp/modules/deaths_log.php'); ?>
					</div>
					<div class="span4">
						<h1> Death Statistics</h1>
						<?php @include ('./yasp/modules/deaths_stats.php'); ?>
					</div>
				</div>
			</section>
		</div>
	</div>
	
	<hr>
	
	<footer>
		<div class="row-fluid">
		<div class="span10 offset2">
			<div class="row-fluid">
				<div class="span2"><p><a href="https://github.com/bitWolfy/YetAnotherStatisticsPlugin"><img src="./src/img/plugin_logo_small.png" alt="YASP" /></a></p></div>
				<div class="span4"><p style="position:relative; top:5px;">&copy; 2013 Yet Another Statistics Plugin<br />Based on <a href="http://dev.bukkit.org/server-mods/statisticianv2/" target="_blank">Statistician 2</a> technology</p></div>
				<div class="span4 offset2" style="text-align: right;"><p>Running database version <?php echo ($sObj->getDatabaseVersion()); ?><br />YASP-WEB v.<?php echo VERSION; ?></p></div>
			</div>
		</div>
		</div>
	</footer>

</div>

<script src="src/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="./src/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./src/js/jquery.tablesorter.js" type="text/javascript"></script> 
<script src="./src/js/jquery.pajinate.js" type="text/javascript"></script> 
<script src="./src/js/initialize.js" type="text/javascript"></script>
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