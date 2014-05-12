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

require 'includes/constants.php';

// Check if user is logged in
if (!isset($_COOKIE['user_id'])) {
	require 'includes/sign_in_functions.php';
	redirect_user('sign_in.php');
} 

if (!($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING)) {
	require 'includes/sign_in_functions.php';
	redirect_user('not_found.php');
}


// If the user is logged in, display the tutors page

// Require connection
require '../connection.php';

// Utilities
require 'includes/semester_functions.php';



// Include tutor specific functions
require 'includes/_tutor_functions.php';

// Prepare alert array in case of alerts
$alerts = array();

/*
* Form functions
*/ 
// Add tutor
if (isset($_POST['tutor_new'])) {

	// Prepare data for insert query
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

		$user_new_username = generate_username($con, $new_tutor_name, $new_tutor_second_name, $new_tutor_lastname, $new_tutor_second_lastname);

		$user_new_password = generateRandomString(8);
		$user_new_type = 'tutor';
		$user_new_active = 1;
		$user_new_created_at = date("Y-m-d H:i:s", time());
		$user_new_lastlogin = '';

		$results_alerts = add_user($con, $user_new_username, $user_new_password, $user_new_type, $user_new_active, $user_new_created_at, $user_lastlogin);
		
		if (!empty($results_alerts)) {
			foreach ($results_alerts as $ra) {
				$alerts[] = $ra;	
			}	
		}

		if (empty($alerts)) {
			$alerts[] = array(
				"status" => "info",
				"subject" => "¡Enhorabuena!",
				"message" => "Se ha agregado nuevo usuario con usuario: '".$user_new_username."'' y contraseña: '".$user_new_password."'"
			);
			// Send email with username and password to the new user using admin account
		}
	}

	$new_tutor_user_id = ($new_tutor_createuser ? get_max_index_of_table($con, "user") : "null");

	// With data ready, add tutor
	$continue = true;

	$results_alerts = add_tutor($con, $new_tutor_name, $new_tutor_second_name, $new_tutor_lastname,  $new_tutor_second_lastname, $new_tutor_gender, $new_tutor_role, $new_tutor_notes, $new_tutor_date_added, $new_tutor_user_id);

	$new_tutor_index = mysqli_insert_id($con);

	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}
		$continue = false;
	}

	if($continue) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado a un nuevo tutor."
		);

		// If successful, then insert the corresponding phone and email
		$phones = $_POST['tutor_new_phone_number'];
		$phones_types = $_POST['tutor_new_phone_type'];

		foreach ($phones as $key => $phone) {

			if (!empty($phone)) {
				$results_alerts = add_phonetutor($con, $phone, $phones_types[$key], $new_tutor_index);

				if (!empty($results_alerts)) {
					foreach ($results_alerts as $ra) {
						$alerts[] = $ra;	
					}
				}
			}

		}

		$emails = $_POST['tutor_new_email_address'];
		$emails_types = $_POST['tutor_new_email_type'];
		
		foreach ($emails as $key => $email) {
			
			if (!empty($email)) {
				$results_alerts = add_emailtutor($con, $email, $emails_types[$key], $new_tutor_index);

				if (!empty($results_alerts)) {
					foreach ($results_alerts as $ra) {
						$alerts[] = $ra;	
					}
				}
			}
		}

	}

}

// Edit tutor -- This function will be in the detail page.

// Delete tutor
if (isset($_POST['tutor_delete'])) {

	/*
	 * This will delete the tutor in the following sequence:
	 *   First delete contact information (emails and phones)
	 *   Delete the tutor
	 *   Delete associated users
	 */

	$tutor_id = $_POST['tutor_id'];

	$tutor_row = select_tutor_with_id($con, $tutor_id);

	if (!$tutor_row) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "Tutor no encontrado."
		);
	} else {

		// Delete contact information
		$results_alerts = delete_tutor_contact_information($con, $tutor_row['tutor_id']);
		if (!empty($results_alerts)) {
			foreach ($results_alerts as $ra) {
				$alerts[] = $ra;	
			}	
		}

		// Delete the tutor
		$results_alerts = delete_tutor($con, $tutor_row['tutor_id']);
		if (!empty($results_alerts)) {
			foreach ($results_alerts as $ra) {
				$alerts[] = $ra;	
			}	
		}

		// Delete associated users if any
		$results_alerts = delete_user($con, $tutor_row['tutor_user_id']);
		if (!empty($results_alerts)) {
			foreach ($results_alerts as $ra) {
				$alerts[] = $ra;	
			}	
		}
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha eliminado al tutor satisfactoriamente."
		);
	}


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
						<br>
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
			        <h3 class="modal-title" id="tutor_new_form_modal_label">Agregar tutor nuevo</h3>
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