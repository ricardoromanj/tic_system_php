<?php

/* 
 * Functions for managing coordinators
 *
 *
 */

// coordinator user functions
require 'includes/_user_functions.php';

// Add coordinator
function add_coordinator($con, $new_coordinator_name, $new_coordinator_second_name, $new_coordinator_lastname,  $new_coordinator_second_lastname, $new_coordinator_gender, $new_coordinator_notes, $new_coordinator_date_added, $new_coordinator_user_id) {

	$alerts_local = array();

	// Prepare the query with the new data
	$new_coordinator_query = "INSERT INTO coordinator (coordinator_name, coordinator_second_name, coordinator_lastname, coordinator_second_lastname, coordinator_gender, coordinator_notes, coordinator_picture, coordinator_date_added, coordinator_user_id) VALUES (
		'".$new_coordinator_name."',
		'".$new_coordinator_second_name."',
		'".$new_coordinator_lastname."',
		'".$new_coordinator_second_lastname."',
		'".$new_coordinator_gender."',
		'".$new_coordinator_notes."',
		'',
		'".$new_coordinator_date_added."',
		".$new_coordinator_user_id.")";

	if (!@mysqli_query($con, $new_coordinator_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar coordinador." . $new_coordinator_query.@mysqli_error($con)
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Edit coordinator information
function edit_coordinator($con, $coordinator_id, $data_attr) {

	$alerts_local = array();


	$edit_coordinator_query = "UPDATE coordinator SET ";

	foreach ($data_attr as $key => $value) {
		$edit_coordinator_query .= $key."='".$value."', ";	
	}

	$edit_coordinator_query = substr($edit_coordinator_query, 0, -2);

	$edit_coordinator_query .=  " WHERE coordinator_id='".$coordinator_id."'";	

	if (!@mysqli_query($con, $edit_coordinator_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar coordinator." . $new_coordinator_query.@mysqli_error($con)
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete coordinator
function delete_coordinator($con, $coordinator_id) {

	$alerts_local = array();

	$delete_coordinator_query = "DELETE FROM coordinator WHERE coordinator_id = '".$coordinator_id."' "; 
	
	if(!@mysqli_query($con, $delete_coordinator_query)){
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar al coordinador seleccionado."
		);
	}	

	return (empty($alerts_local) ? null : $alerts_local);
}

// Select coordinator
function select_coordinator_with_id($con, $coordinator_id) {

	$result = null;

	$select_coordinator_query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";

	$r = @mysqli_query($con, $select_coordinator_query);

	if (!@mysqli_num_rows($r)==1) {
		$result = false;
	} else {
		$result = mysqli_fetch_array($r);
	}

	return $result;
}

// Add coordinator email
function add_emailcoordinator($con, $email_address, $email_type, $coordinator_id) {

	$alerts_local = array();

	$new_emailcoordinator_query = "INSERT INTO emailcoordinator (emailcoordinator_address, emailcoordinator_type, emailcoordinator_primary, emailcoordinator_coordinator_id) VALUES (
		'".$email_address."',
		'".$email_type."',
		null,
		'".$coordinator_id."')";
	
	if (!@mysqli_query($con, $new_emailcoordinator_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar correo ".$email_address
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Edit coordinator email
function edit_emailcoordinator($con, $emailcoordinator_id, $email_address, $email_type) {

	$alerts_local = array();

	$edit_emailcoordinator_query = "UPDATE emailcoordinator SET emailcoordinator_address='".$email_address."', emailcoordinator_type='".$email_type."' WHERE emailcoordinator_id='".$emailcoordinator_id."'";

	if (!@mysqli_query($con, $edit_emailcoordinator_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo modificar correo electrónico ".$email
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete coordinator email
function delete_emailcoordinator($con, $emailcoordinator_id) {

	$alerts_local = array();

	$delete_emailcoordinator_query = "DELETE FROM emailcoordinator WHERE emailcoordinator_id='".$emailcoordinator_id."'";

	if (!@mysqli_query($con, $delete_emailcoordinator_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar correo electrónico de coordinator."
			);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Add coordinator phone
function add_phonecoordinator($con, $phone_number, $phone_type, $coordinator_id) {

	$alerts_local = array();

	$new_phonecoordinator_query = "INSERT INTO phonecoordinator (phonecoordinator_number, phonecoordinator_type, phonecoordinator_primary, phonecoordinator_coordinator_id) VALUES (
		'".$phone_number."',
		'".$phone_type."',
		null,
		'".$coordinator_id."')";

	if (!@mysqli_query($con, $new_phonecoordinator_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar teléfono ".$phone_number
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Edit coordinator phone
function edit_phonecoordinator($con, $phonecoordinator_id, $phone_number, $phone_type) {

	$alerts_local = array();

	$edit_phonecoordinator_query = "UPDATE phonecoordinator SET phonecoordinator_number='".$phone_number."', phonecoordinator_type='".$phone_type."' WHERE phonecoordinator_id='".$phonecoordinator_id."'";

	if (!@mysqli_query($con, $edit_phonecoordinator_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo modificar teléfono ".$phone
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete coordinator phone
function delete_phonecoordinator($con, $phonecoordinator_id) {

	$alerts_local = array();

	$delete_phonecoordinator_query = "DELETE FROM phonecoordinator WHERE phonecoordinator_id='".$phonecoordinator_id."'";

	if (!@mysqli_query($con, $delete_phonecoordinator_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar teléfono de coordinator."
			);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Delete coordinator contact information
function delete_coordinator_contact_information($con, $coordinator_id) {

	$alerts_local = array();

	$delete_emailcoordinator_query = "DELETE FROM emailcoordinator WHERE emailcoordinator_coordinator_id = '".$coordinator_id."'";
	if(!@mysqli_query($con, $delete_emailcoordinator_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudieron borrar los correos electrónicos asociados al coordinador."
		);
	}

	$delete_phonecoordinator_query = "DELETE FROM phonecoordinator WHERE phonecoordinator_coordinator_id = '".$coordinator_id."'";
	if(!@mysqli_query($con, $delete_phonecoordinator_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudieron borrar los números telefónicos asociados al coordinador."
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}