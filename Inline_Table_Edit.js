$(document).ready(function(){
	$('#data_table').Tabledit({
		deleteButton: false,
		editButton: false,   		
		columns: {
		  identifier: [0, 'id'],                    
		  editable: [[1, 'C15'], [2, 'C16'], [3, 'C17']]
		},
		hideIdentifier: true,
		url: 'live_edit.php'		
	});
});