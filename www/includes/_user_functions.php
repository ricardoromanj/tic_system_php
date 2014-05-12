<?php

/*
 * Functions for managing users, works for both tutors and
 * coordinators.
 *
 *
 */

// Include helper functions
require 'includes/helpers.php';

// Username generator
function generate_username($con, $new_name, $new_second_name, $new_lastname, $new_second_lastname) {

	$user_new_username = '';

	do {
		$user_new_username = strtolower(substr($new_name, 0, 1).($new_second_name!='' ? substr($new_second_name, 0, 1) : '').substr($new_lastname, 0, 1).($new_second_lastname!='' ? substr($new_second_lastname, 0, 1) : '')).generateRandomNumberString(4);

		$query_username_check = "SELECT * FROM user WHERE user_username='".$user_new_username."'";

		$r = @mysqli_query($con, $query_username_check);
	} while (mysqli_num_rows($r)!=0);

	return $user_new_username;
}

// Add new user
function add_user($con, $user_new_username, $user_new_password, $user_new_type, $user_new_active, $user_new_created_at, $user_new_lastlogin) {

	$alerts_local = array();

	$new_user_query = "INSERT INTO user (user_username, user_password, user_type, user_active, user_created_at, user_lastlogin) VALUES ('".$user_new_username."', '".SHA1($user_new_password)."', '".$user_new_type."', '".$user_new_active."', '".$user_new_created_at."', '".$user_new_lastlogin."')";

	if (!@mysqli_query($con, $new_user_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar usuario nuevo." . @mysqli_error($con)
		);
	} 

	return (empty($alerts_local) ? null : $alerts_local);	
}

// Change user type to
function change_user_type_to($con, $user_id, $new_type) {

	$alerts_local = array();

	$change_user_type_to_query = "UPDATE user SET user_type='".$new_type."' WHERE user_id='".$user_id."'";

	if (!@mysqli_query($con, $change_user_type_to_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo cambiar el tipo de usuario."
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Deactivate user
function deactivate_user($con, $user_id) {

	$alerts_local = array();

	$deactivate_user_query = "UPDATE user SET user_active='0' WHERE user_id='".$user_id."'";

	if (!@mysqli_query($con, $deactivate_user_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo desactivar al usuario."
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Restore user password - reactivate user
function restore_user_password($con, $user_id, $user_new_password) {

	$alerts_local = array();

	$restore_user_query = "UPDATE user SET user_password='".SHA1($user_new_password)."', user_lastlogin='".null."', user_active='1' WHERE user_id='".$user_id."'";

	if (!@mysqli_query($con, $restore_user_query)) {
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo reestablecer contraseña del usuario." . @mysqli_error($con)
		);
	} 	

	return (empty($alerts_local) ? null : $alerts_local);	
}

// Delete user
function delete_user($con, $user_id) {

	$alerts_local = array();

	$delete_user_query = "DELETE FROM user WHERE user_id='".$user_id."'";
	if(!@mysqli_query($con, $delete_user_query)){
		$alerts_local[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar el usuario."
		);
	}

	return (empty($alerts_local) ? null : $alerts_local);
}

// Get the tutor with the user id
function select_tutor_with_user_id($con, $user_id) {

	$result = null;

	$select_tutor_query = "SELECT * FROM tutor WHERE tutor_user_id='".$user_id."'";

	$r = @mysqli_query($con, $select_tutor_query);

	if (!@mysqli_num_rows($r)==1) {
		$result = false;
	} else {
		$result = mysqli_fetch_array($r);
	}

	return $result;
}

// Select coordinator with user_id
function select_coordinator_with_user_id($con, $coordinator_user_id) {


	$select_coordinator_query = "SELECT * FROM coordinator WHERE coordinator_user_id='".$coordinator_user_id."'";

	$sel_r = mysqli_query($con, $select_coordinator_query);
	$result = mysqli_fetch_assoc($sel_r);

	return $result;
}