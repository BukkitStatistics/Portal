$(document).ready(function() {
	$('.dropdown-toggle').dropdown();
	$('#content').scrollspy();
	
	
	$("#worldBlocksTable").tablesorter( {sortList: [[1,1], [2,1]]} );
	$("#worldBlocks").pajinate( { items_per_page: 7 } );
	
	$("#worldItemsTable").tablesorter( {sortList: [[1,1], [2,1]]} );
	$("#worldItems").pajinate( { items_per_page: 7 } );
	
	$("#playersTable").tablesorter( {sortList: [[0,0]]} );
	$("#playersBlock").pajinate( { items_per_page: 10 } );
	
	$("#deathsBlock").pajinate( { items_per_page: 6 } );
});