<div class="well custom-well" id="worldBlocks">

<table class="table table-bordered table-hover tablesorter" id="worldBlocksTable">
	<thead>
	<tr>
		<th style="text-align: center;">Block Type</th>
		<th style="text-align: center;">Destroyed</th>
		<th style="text-align: center;">Placed</th>
	</tr>
	</thead>
	<tbody class="content">
	
	<?php
	$query = QueryUtils::getBlockList();
	
	while($row = mysql_fetch_assoc($query)) {
		if($row['name'] == "") continue;
		$blockName = str_replace(" ", "%20", $row['name']);
		echo "<tr>";
		echo "<td style='height:33px;text-align: center;'><img src='./yasp/util/block/".$blockName."' alt='".$row['name']."' /></td>";
		echo "<td style='text-align: center; padding-top: 15px;'>".$row['destroyed']."</td>";
		echo "<td style='text-align: center; padding-top: 15px;'>".$row['placed']."</td>";
		echo "</tr>";
	}
	?>
	
	</tbody>
</table>

<div class="page_navigation pagination force-center"></div>
		
</div>