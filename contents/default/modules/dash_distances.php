<div class="well custom-well fixed-height" style="position: relative; padding: 10px; margin: 0px;">

<h3 style="text-align:center;">Distances</h3>

<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-info"><i class="icon-globe"></i> <?php echo(QueryUtils::formatDistance($serverObj->getDistanceTraveledTotal())); ?></span></dt>
	<dd style="margin-left: 130px !important;">Total distance</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-info"><i class="icon-exchange"></i> <?php echo(QueryUtils::formatDistance($serverObj->getDistanceTraveledByFootTotal())); ?></span></dt>
	<dd style="margin-left: 130px !important;">By foot</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-info"><i class="icon-truck"></i> <?php echo(QueryUtils::formatDistance($serverObj->getDistanceTraveledByMinecartTotal())); ?></span></dt>
	<dd style="margin-left: 130px !important;">By minecart</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-info"><i class="icon-tablet"></i> <?php echo(QueryUtils::formatDistance($serverObj->getDistanceTraveledByBoatTotal())); ?></span></dt>
	<dd style="margin-left: 130px !important;">By boat</dd>
</dl>

</div>