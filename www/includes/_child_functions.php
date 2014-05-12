<?php

/* 
 * Functions for managing children
 *
 *
 */

// Add child
function add_child($con, $new_child_name, $new_child_second_name, $new_child_lastname,  $new_child_second_lastname, $new_child_gender, $new_child_role, $new_child_notes, $new_child_date_added, $new_child_user_id) {

	$alerts_local = array();

	// Prepare the query with the new data
	$new_child_query = "INSERT INTO child (child_name, child_second_name, child_lastname, child_second_lastname, child_gender, child_role, child_notes, child_picture, child_date_added, child_user_id) VALUES (
		'".$new_child_name."',
		'".$new_child_second_name."',
		'".$new_child_lastname."',
		'".$new_child_second_lastname."',
		'".$new_child_gender."',
		'".$new_child_role."',
		'".$new_child_notes."',
		'',
		'".$new_child_date_added."',
		".$new_child_user_id.")";

	if (!@mysqli_query($con, $new_child_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar child." . $new_child_query.@mysqli_error($con)
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
			"message" => "No se pudo agregar child." . $new_child_query.@mysqli_error($con)
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete child
function delete_child($con, $child_id) {

	$alerts_local = array();

	$delete_child_query = "DELETE FROM child WHERE child_id = '".$child_id."' "; 
	
	if(!@mysqli_query($con, $delete_child_query)){
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar al child seleccionado."
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

// Add child email
function add_emailchild($con, $email_address, $email_type, $child_id) {

	$alerts_local = array();

	$new_emailchild_query = "INSERT INTO emailchild (emailchild_address, emailchild_type, emailchild_primary, emailchild_child_id) VALUES (
		'".$email_address."',
		'".$email_type."',
		null,
		'".$child_id."')";
	
	if (!@mysqli_query($con, $new_emailchild_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar correo ".$email_address
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Edit child email
function edit_emailchild($con, $emailchild_id, $email_address, $email_type) {

	$alerts_local = array();

	$edit_emailchild_query = "UPDATE emailchild SET emailchild_address='".$email_address."', emailchild_type='".$email_type."' WHERE emailchild_id='".$emailchild_id."'";

	if (!@mysqli_query($con, $edit_emailchild_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo modificar correo electrónico ".$email
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete child email
function delete_emailchild($con, $emailchild_id) {

	$alerts_local = array();

	$delete_emailchild_query = "DELETE FROM emailchild WHERE emailchild_id='".$emailchild_id."'";

	if (!@mysqli_query($con, $delete_emailchild_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar correo electrónico de child."
			);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Add child phone
function add_phonechild($con, $phone_number, $phone_type, $child_id) {

	$alerts_local = array();

	$new_phonechild_query = "INSERT INTO phonechild (phonechild_number, phonechild_type, phonechild_primary, phonechild_child_id) VALUES (
		'".$phone_number."',
		'".$phone_type."',
		null,
		'".$child_id."')";

	if (!@mysqli_query($con, $new_phonechild_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar teléfono ".$phone
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Edit child phone
function edit_phonechild($con, $phonechild_id, $phone_number, $phone_type) {

	$alerts_local = array();

	$edit_phonechild_query = "UPDATE phonechild SET phonechild_number='".$phone_number."', phonechild_type='".$phone_type."' WHERE phonechild_id='".$phonechild_id."'";

	if (!@mysqli_query($con, $edit_phonechild_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo modificar teléfono ".$phone
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete child phone
function delete_phonechild($con, $phonechild_id) {

	$alerts_local = array();

	$delete_phonechild_query = "DELETE FROM phonechild WHERE phonechild_id='".$phonechild_id."'";

	if (!@mysqli_query($con, $delete_phonechild_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar teléfono de child."
			);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete child contact information
function delete_child_contact_information($con, $child_id) {

	$alerts_local = array();

	$delete_emailchild_query = "DELETE FROM emailchild WHERE emailchild_child_id = '".$child_id."'";
	if(!@mysqli_query($con, $delete_emailchild_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudieron borrar los correos electrónicos asociados al child."
		);
	}

	$delete_phonechild_query = "DELETE FROM phonechild WHERE phonechild_child_id = '".$child_id."'";
	if(!@mysqli_query($con, $delete_phonechild_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudieron borrar los números telefónicos asociados al child."
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}