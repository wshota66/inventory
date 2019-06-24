<?php
include_once("config.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';
	if(isset($input['C15'])) {
		$update_field.= "C15='".$input['C15']."'";
	} else if(isset($input['C16'])) {
		$update_field.= "C16='".$input['C16']."'";
	} else if(isset($input['C17'])) {
		$update_field.= "C17='".$input['C17']."'";
	}	
	if($update_field && $input['id']) {
		$sql_query = "UPDATE table1 SET $update_field WHERE id='" . $input['id'] . "'";	
		mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));		
	}
}