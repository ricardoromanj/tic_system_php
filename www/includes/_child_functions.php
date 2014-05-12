<?php

/* 
 * Functions for managing children
 *
 *
 */

// Add child
function add_child($con, $new_child_name, $new_child_second_name, $new_child_lastname,  $new_child_second_lastname, $new_child_gender, $new_child_birthdate, $new_child_allergies, $new_child_medical_notes, $new_child_general_notes, $new_child_date_added) {

	$alerts_local = array();

	// Prepare the query with the new data
	$new_child_query = "INSERT INTO child (child_name, child_second_name, child_lastname, child_second_lastname, child_gender, child_birthdate, child_allergies, child_medical_notes, child_general_notes, child_picture, child_date_added, child_active) VALUES (
		'".$new_child_name."',
		'".$new_child_second_name."',
		'".$new_child_lastname."',
		'".$new_child_second_lastname."',
		'".$new_child_gender."',
		'".$new_child_birthdate."',
		'".$new_child_allergies."',
		'".$new_child_medical_notes."',
		'".$new_child_general_notes."',
		'',
		'".$new_child_date_added."',
		'1')";

	if (!@mysqli_query($con, $new_child_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo inscribir niño." . $new_child_query.@mysqli_error($con)
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Edit child information
function edit_child($con, $child_id, $data_attr) {

	$alerts_local = array();


	$edit_child_query = "UPDATE child SET ";

	foreach ($data_attr as $key => $value) {
		$edit_child_query .= $key."='".$value."', ";	
	}

	$edit_child_query = substr($edit_child_query, 0, -2);

	$edit_child_query .=  " WHERE child_id='".$child_id."'";	

	if (!@mysqli_query($con, $edit_child_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo editar información del niño." . $new_child_query.@mysqli_error($con)
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete child
function delete_child($con, $child_id) {

	$alerts_local = array();

	$delete_child_query = "DELETE FROM child WHERE child_id = '".$child_id."' "; 
	
	if(!@mysqli_query($con, $delete_child_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar al niño seleccionado."
		);
	}	

	return (empty($alerts_local) ? null : $alerts_local);
}

// Select child
function select_child_with_id($con, $child_id) {

	$result = null;

	$select_child_query = "SELECT * FROM child WHERE child_id='".$child_id."'";

	$r = @mysqli_query($con, $select_child_query);

	if (!@mysqli_num_rows($r)==1) {
		$result = false;
	} else {
		$result = mysqli_fetch_array($r);
	}

	return $result;
}

// Get all tutor names + ids for typeahead
function get_tutors_for_typeahead($con) {

	$result_array = array();

	$query = "SELECT tutor_id, tutor_name, tutor_lastname FROM tutor";
	$query_result = @mysqli_query($con, $query);

	while ($tutor_row = mysqli_fetch_array($query_result)) {
		$result_array[] = $tutor_row['tutor_id']." ".$tutor_row['tutor_name']." ".$tutor_row['tutor_lastname'];
	}

	return '["'.join('", "',$result_array).'"]';
}

// Assign child to tutor function
function assign_child_to_tutor($con, $child_id, $tutor_id) {

	$alerts_local = array();

	$childtutor_create_query = "INSERT INTO childtutor (childtutor_tutor_id, childtutor_child_id) VALUES('".$tutor_id."', '".$child_id."')";

	if(!@mysqli_query($con, $childtutor_create_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo asociar tutor con el niño seleccionado."
		);
	}


	return (empty($alerts_local) ? null : $alerts_local);
}

// Unassign child from tutor function
function unassign_child_from_tutor($con, $childtutor_id) {

	$alerts_local = array();

	$childtutor_delete_query = "DELETE FROM childtutor WHERE childtutor_id='".$childtutor_id."'";
	if(!@mysqli_query($con, $childtutor_delete_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar la información del niño seleccionado."
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete all childtutor associations of a child
function delete_childtutors_of_child($con, $child_id) {

	$alerts_local = array();

	$query = "DELETE FROM childtutor WHERE childtutor_child_id='".$child_id."'";

	if(!@mysqli_query($con, $query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar la información del niño seleccionado."
		);
	}	

	return (empty($alerts_local) ? null : $alerts_local);
}