<div class="well custom-well fixed-height" style="padding: 10px; margin: 0px;">

<h3 style="text-align:center;">Server Statistics</h3>

<dl class="dl-horizontal">
	<dt><span class="label label-success"><i class="icon-bell"></i> <?php echo(QueryUtils::formatDate($serverObj->getStartupTime())); ?></span></dt>
	<dd>Startup</dd>
</dl>
<dl class="dl-horizontal">
	<dt><span class="label label-warning"><i class="icon-lock"></i> <?php echo(QueryUtils::formatDate($serverObj->getLastShutdownTime())); ?></span></dt>
	<dd>Shutdown</dd>
</dl>
<dl class="dl-horizontal">
	<dt><span class="label label-<?php if($online) {echo "success";} else {echo "important";} ?>"><i class="icon-calendar"></i> <?php echo $serverObj->getUptimeInSeconds(); ?></span></dt>
	<dd>Uptime</dd>
</dl>
<dl class="dl-horizontal">
	<dt><span class="label label-info"><i class="icon-bullhorn"></i> <?php echo(QueryUtils::formatSecs($serverObj->getNumberOfSecondsLoggedOnTotal())); ?></span></dt>
	<dd>Gameplay</dd>
</dl>

</div>