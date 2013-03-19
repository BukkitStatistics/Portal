<div class="well custom-well fixed-height" style="padding: 10px; margin: 0px;">

<h3 style="text-align:center;">Blocks</h3>

<?php

$mostPlaced = $serverObj->getBlocksMostPlaced();
$mostPlacedName = str_replace(" ", "%20", QueryUtils::getResourceNameById($mostPlaced));
$mostPlacedNum = $serverObj->getBlocksPlacedOfTypeTotal($mostPlaced);

$mostDestroyed = $serverObj->getBlocksMostDestroyed();
$mostDestroyedName = str_replace(" ", "%20", QueryUtils::getResourceNameById($mostDestroyed)); 
$mostDestroyedNum = $serverObj->getBlocksPlacedOfTypeTotal($mostDestroyed);

?>

<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-success"><i class="icon-plus"></i> <?php echo($serverObj->getBlocksPlacedTotal()); ?></span></dt>
	<dd style="margin-left: 130px !important;">Total Placed</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-success"><?php echo "<img src='./include/util/block/".$mostPlacedName."' style='width:15px; height:15px;' alt='".$mostPlaced."' title='".$mostPlacedNum." times' /> ".$mostPlacedNum; ?></span></dt>
	<dd style="margin-left: 130px !important;">Most Placed</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-important"><i class="icon-minus"></i> <?php echo($serverObj->getBlocksDestroyedTotal()); ?></span></dt>
	<dd style="margin-left: 130px !important;">Total Destroyed</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-important"><?php echo "<img src='./include/util/block/".$mostDestroyedName."' style='width:15px; height:15px;' alt='".$mostDestroyed."' title='".$mostDestroyedNum." times' /> ".$mostDestroyedNum; ?></span></dt>
	<dd style="margin-left: 130px !important;">Most Destroyed</dd>
</dl>

</div>