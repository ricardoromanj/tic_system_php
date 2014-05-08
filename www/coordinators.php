<?php

/*
 * TUTORS.PHP
 * 
 * DESC: THIS IS THE WEBAPP TUTORS PAGE
 * (ONLY AVAILABLE TO COORDINATORS AND ADMIN)
 * AUTHOR: RICARDO ROMAN (C) 2014
 * 
 * CHANGE LOG
 * 20140228 - RICARDO ROMAN - FIRST RELEASE
 * 
 */

// Check if user is logged in
if (!isset($_COOKIE['user_id'])) {
	require 'includes/sign_in_functions.php';
	redirect_user('sign_in.php');
} else if (!($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING)) {
	//redirect_user('not_found.php');
}
// If the user is logged in, display the tutors page

// Require connection
require '../connection.php';

// Utilities
require 'includes/semester_functions.php';

// Include helper functions
include 'includes/helpers.php';

// Prepare alert array in case of alerts
$alerts = array();

/*
* Form functions
*/ 
// Add tutor
if (isset($_POST['tutor_new'])) {
	foreach ($_POST['tutor_new_email_address'] as $email) {
		?><pre><? echo $email; ?></pre><?
	}

	// Prepare data for insert query
	$new_tutor_index = get_max_index_of_table($con, "tutor")+1;
	$new_tutor_name = $_POST['tutor_new_name'];
	$new_tutor_second_name = $_POST['tutor_new_second_name'];
	$new_tutor_lastname = $_POST['tutor_new_lastname'];
	$new_tutor_second_lastname = $_POST['tutor_new_second_lastname'];
	$new_tutor_gender = $_POST['tutor_new_gender'];
	$new_tutor_role = $_POST['tutor_new_role'];
	$new_tutor_notes = $_POST['tutor_new_notes'];
	$new_tutor_date_added = date("Y-m-d H:i:s", time());

	// If new_tutor_createuser, then create a new user for the tutor
	$new_tutor_createuser = isset($_POST['tutor_new_createuser']) && $_POST['tutor_new_createuser']  ? true : false;
	if ($new_tutor_createuser) {

		$user_new_index = get_max_index_of_table($con, "user")+1;
		$user_new_username = '';
		
		do {
			$user_new_username = strtolower(substr($new_tutor_name, 0, 1).($new_tutor_second_name!='' ? substr($new_tutor_second_name, 0, 1) : '').substr($new_tutor_lastname, 0, 1).($new_tutor_second_lastname!='' ? substr($new_tutor_second_lastname, 0, 1) : '')).generateRandomNumberString(4);

			$query_username_check = "SELECT * FROM user WHERE user_username='".$user_new_username."'";

			$r = @mysqli_query($con, $query_username_check);
		} while (mysqli_num_rows($r)!=0);

		$user_new_password = generateRandomString(8);
		$user_new_type = 'tutor';
		$user_new_active = 1;
		$user_new_created_at = date("Y-m-d H:i:s", time());
		$user_new_lastlogin = '';

		$new_user_query = "INSERT INTO user (user_id, user_username, user_password, user_type, user_active, user_created_at, user_lastlogin) VALUES ('".$user_new_index."', '".$user_new_username."', '".SHA1($user_new_password)."', '".$user_new_type."', '".$user_new_active."', '".$user_new_created_at."', '".$user_new_lastlogin."')";

		if (!@mysqli_query($con, $new_user_query)) {
			$alerts[] = array(
				"status" => "danger",
				"subject" => "¡Error!",
				"message" => "No se pudo agregar usuario nuevo." . @mysqli_error($con)
			);
		} 
		if (empty($alerts)) {
			$alerts[] = array(
				"status" => "info",
				"subject" => "¡Enhorabuena!",
				"message" => "Se ha agregado nuevo usuario con usuario: '".$user_new_username."'' y contraseña: '".$user_new_password."'"
			);
		}
	}

	$new_tutor_user_id = ($new_tutor_createuser ? get_max_index_of_table($con, "user") : "null");

	// Prepare the query with the new data
	$new_tutor_query = "INSERT INTO tutor (tutor_id, tutor_name, tutor_second_name, tutor_lastname, tutor_second_lastname, tutor_gender, tutor_role, tutor_notes, tutor_picture, tutor_date_added, tutor_user_id) VALUES (
		'".$new_tutor_index."',
		'".$new_tutor_name."',
		'".$new_tutor_second_name."',
		'".$new_tutor_lastname."',
		'".$new_tutor_second_lastname."',
		'".$new_tutor_gender."',
		'".$new_tutor_role."',
		'".$new_tutor_notes."',
		'',
		'".$new_tutor_date_added."',
		".$new_tutor_user_id.")";

	if (!@mysqli_query($con, $new_tutor_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo agregar tutor." . $new_tutor_query.@mysqli_error($con)
		);
	} else {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado a un nuevo tutor."
		);

		// If successful, then insert the corresponding phone and email
		foreach ($_POST['tutor_new_phone_number'] as $phone) {
			?><pre><? echo $phone; ?></pre><?
		}
		foreach ($_POST['tutor_new_email_address'] as $email) {
			?><pre><? echo $email; ?></pre><?
		}

	}

}

// Edit tutor
if (isset($_POST['tutor_edit'])) {

}

// Delete tutor
if (isset($_POST['tutor_delete'])) {
	
}
if( isset($_REQUEST['action']) == 'deleteTutor' )
{
	$delete_query = "DELETE FROM tutor WHERE tutor_id = '".$_REQUEST['rowid']."' "; 
	if(!@mysqli_query($con, $delete_query)){
		$response = @mysqli_error($con) ." ". $delete_query; 
	}
	else{
		$response = "tutor_deleted";
	}
	echo $response;
	exit();
}




if(isset($_REQUEST['tutor_delete_success'])){
	$alerts[] = array(
		"status" => "success",
		"subject" => "¡Enhorabuena!",
		"message" => "Se ha borrado tutor."
	);
}


// Start with header and title
$page_title = 'Tutores';
$page_active = 'tutors';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';

// Main contents of page
?>
<div class='container'>
	<div class="row">
		<div class="col-sm-2">
			<br>	
			<? include 'includes/_sidebar.php'; ?>
		</div>
		<div class="tic-sidebar col-sm-10">
			<h2>Administracion de tutores</h2>
			<a class="btn btn-success btn-sm pull-right" href="#tutor_new_form_modal" data-toggle="modal">Agregar tutor nuevo</a>
			<br>
			<br>
			<div id="tutors_alerts_div">
				<? if (isset($alerts) && !empty($alerts)) { ?>
					<? foreach ($alerts as $alert) { ?>
						<div class="alert alert-<? echo $alert['status']; ?>">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><? echo $alert['subject']; ?></strong> <? echo $alert['message']; ?>
						</div>
					<? } ?>
				<? } ?>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="tutor_new_form_modal" tabindex="-1" role="dialog" aria-labelledby="tutor_new_form_modal_label" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h3 class="modal-title text-success" id="tutor_new_form_modal_label">Agregar tutor nuevo</h3>
			      </div> <!-- Close modal header -->
			      <div class="modal-body">
			      	<br>
			        <? include 'includes/_tutor_new_form.php'; ?>
			      </div> <!-- Close modal body -->
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div> <!-- Close modal footer -->
			    </div><!-- Close modal content -->
			  </div> <!-- Close modal dialog -->
			</div> <!-- Close modal -->
			<br>
			<div id="tutor_table_div">
				<table class="table table-striped table-hover table-condensed">
					<thead>
						<th>ID</th>
						<th width="35%">Nombre</th>
						<th>Género</th>
						<th>Rol</th>
						<th>Fecha de inscripción</th>
						<th>¿Activo?</th>
						<th width="5%" class="text-danger">BORRAR</th>
					</thead>
					<tbody>
						<?
							$query = "SELECT * FROM tutor ORDER BY tutor_lastname";
							$tutor_result = mysqli_query($con, $query);
							while($tutor_row = mysqli_fetch_array($tutor_result)) {
								include 'includes/_tutor_table_row.php';
							}
						?>
					</tbody>
				</table>
			</div>
		</div> <? // Close the column ?>
	</div> <? // Close the row ?>
</div><? // Close the container ?>
<? 
// Close any open connections
mysqli_close($con);

// Footer
include 'includes/_footer.php';
?>



<script type='text/javascript'>

function deleteTutor( tutorID )
{
	$.ajax({
		urL: 'tutors.php',
		method: 'post',
		data:
		{
			action: 'deleteTutor',
			rowid: tutorID
		},
		success: function(data)
		{
			$('#tutor_confirm_delete_'+tutorID).modal('hide'); //hide confirm dialog
			window.location.href = "tutors.php?tutor_delete_success";
		}
	});
}

</script>