<div class="well custom-well fixed-height" style="position: relative; padding: 10px; margin: 0px;">

<h3 style="text-align:center;">Items</h3>

<?php

$mostPickedUp = $serverObj->getMostPickedUp();
$mostPickedUpName = str_replace(" ", "%20", QueryUtils::getResourceNameById($mostPickedUp)); 
$mostPickedUpNum = $serverObj->getPickedUpOfTypeTotal($mostPickedUp);

$mostDropped = $serverObj->getMostDropped();
$mostDroppedName = str_replace(" ", "%20", QueryUtils::getResourceNameById($mostDropped)); 
$mostDroppedNum = $serverObj->getDroppedOfTypeTotal($mostDropped);

?>

<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-success"><i class="icon-plus"></i> <?php echo($serverObj->getPickedUpTotal()); ?></span></dt>
	<dd style="margin-left: 130px !important;">Total Picked up</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-success"><?php echo "<img src='./yasp/util/block/".$mostPickedUpName."' style='width:15px; height:15px;' alt='".$mostPickedUp."' title='".$mostPickedUpNum." times' /> ".$mostPickedUpNum; ?></span></dt>
	<dd style="margin-left: 130px !important;">Most Picked up</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-important"><i class="icon-minus"></i> <?php echo($serverObj->getDroppedTotal()); ?></span></dt>
	<dd style="margin-left: 130px !important;">Total Dropped</dd>
</dl>
<dl class="dl-horizontal">
	<dt style="width: 110px !important;"><span class="badge badge-important"><?php echo "<img src='./yasp/util/block/".$mostDroppedName."' style='width:15px; height:15px;' alt='".$mostDropped."' title='".$mostDroppedNum." times' /> ".$mostDroppedNum; ?></span></dt>
	<dd style="margin-left: 130px !important;">Most Dropped</dd>
</dl>

</div>