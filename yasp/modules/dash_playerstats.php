<div class="well custom-well fixed-height" style="position: relative; padding: 10px; margin: 0px;">

<h3 style="text-align:center;">Player Statistics</h3>
<dl class="dl-horizontal">
	<dt style="width: 80px !important;"><span class="badge badge-info"><i class="icon-user"></i> <?php echo $serverObj->getAllPlayersOnlineCount(); ?></span></dt>
	<dd style="margin-left: 100px !important;">Currently online</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 80px !important;"><span class="badge badge-warning"><i class="icon-star"></i> <?php echo $serverObj->getAllPlayers(); ?></span></dt>
	<dd style="margin-left: 100px !important;">Tracked players</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 80px !important;"><span class="badge badge-success"><i class="icon-signal"></i> <?php echo $serverObj->getMaxPlayersEverOnline(); ?></span></dt>
	<dd style="margin-left: 100px !important;">Maximum players</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 80px !important;"><span class="badge badge-info"><i class="icon-fire"></i> <?php echo($serverObj->getNumberOfLoginsTotal()); ?></span></dt>
	<dd style="margin-left: 100px !important;">Number of logins</dd>
</dl>

</div>