<div class="row-fluid">
	<div class="span3">
	<div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
		<h1 style="text-align:center;"><i class="icon-group icon-large"></i></h1>
		<h3 style="text-align:center;"><?php echo $serverObj->getAllPlayersOnlineCount(); ?> online</h3>
	</div>
	</div>
	
	
	<div class="span3">
	<div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
		<h1 style="text-align:center;"><i class="icon-pencil icon-large"></i></h1>
		<h3 style="text-align:center;"><?php echo $serverObj->getAllPlayers(); ?> tracked</h3>
	</div>
	</div>
	
	
	<div class="span3">
	<div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
		<h1 style="text-align:center;"><i class="icon-remove-sign icon-large"></i></h1>
		<h3 style="text-align:center;"><?php echo $serverObj->getTotalPVPKills(); ?> killed</h3>
	</div>
	</div>
	
	
	<div class="span3">
	<div class="well" style="padding: 10px; margin: 0px; background: #FFE0C2;">
		<h1 style="text-align:center;"><i class="icon-tint icon-large"></i></h1>
		<h3 style="text-align:center;"><?php echo $serverObj->getTotalKills(); ?> died</h3>
	</div>
	</div>
</div>