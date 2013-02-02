<div class="search form-search pull-right player-search">

<?php
	$player_array = $serverObj->getAllPlayerNames();
?>

	<form action="../../../build" method="get">
    	<div class="input-append">
		<input type="text" name="search" placeholder="Username" class="span2" style="width: 150px;" data-provide="typeahead" data-source='<?php echo json_encode($player_array); ?>' id="playerSearch" />
		<button type="submit" class="btn"><i class="icon-search"></i></button>
	</div>
	</form>
</div>