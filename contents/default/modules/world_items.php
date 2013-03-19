<div class="well custom-well" id="worldItems">

<table class="table table-bordered table-hover tablesorter" id="worldItemsTable">
	<thead>
	<tr>
		<th style="text-align: center;">Block Type</th>
		<th style="text-align: center;">Picked up</th>
		<th style="text-align: center;">Dropped</th>
	</tr>
	</thead>
	<tbody class="content">
	
	<?php
	$query = QueryUtils::getItemList();
	
	while($row = mysql_fetch_assoc($query)) {
		if($row['name'] == "") continue;
		$blockName = str_replace(" ", "%20", $row['name']);
		echo "<tr>";
		echo "<td style='height:33px;text-align: center;'><img src='./include/util/block/".$blockName."' alt='".$row['name']."' /></td>";
		echo "<td style='text-align: center;'>".$row['picked']."</td>";
		echo "<td style='text-align: center;'>".$row['dropped']."</td>";
		echo "</tr>";
	}	
	?>
		
	</tbody>
</table>

<div class="page_navigation pagination force-center"></div>
		
</div>
	