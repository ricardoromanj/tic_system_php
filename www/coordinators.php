<?php

/*
 * COORDINATORS.PHP
 * 
 * DESC: THIS IS THE WEBAPP COORDINATORS PAGE
 * (ONLY AVAILABLE TO  ADMIN)
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

if (!($_COOKIE['user_type'] == ADMINISTRATOR_STRING)) {
	require 'includes/sign_in_functions.php';
	redirect_user('not_found.php');
}
// If the user is logged in, display the coordinators page

// Require connection
require '../connection.php';

// Utilities
require 'includes/semester_functions.php';



// Include coordinator specific functions
require 'includes/_coordinator_functions.php';

// Prepare alert array in case of alerts
$alerts = array();

/*
* Form functions
*/ 
// Add coordinator
if (isset($_POST['coordinator_new'])) {

	// Prepare data for insert query
	$new_coordinator_name = $_POST['coordinator_new_name'];
	$new_coordinator_second_name = $_POST['coordinator_new_second_name'];
	$new_coordinator_lastname = $_POST['coordinator_new_lastname'];
	$new_coordinator_second_lastname = $_POST['coordinator_new_second_lastname'];
	$new_coordinator_gender = $_POST['coordinator_new_gender'];
	$new_coordinator_notes = $_POST['coordinator_new_notes'];
	$new_coordinator_date_added = date("Y-m-d H:i:s", time());

	// If new_coordinator_createuser, then create a new user for the coordinator
	$new_coordinator_createuser = true;

	if ($new_coordinator_createuser) {

		$user_new_username = generate_username($con, $new_coordinator_name, $new_coordinator_second_name, $new_coordinator_lastname, $new_coordinator_second_lastname);

		$user_new_password = generateRandomString(8);
		$user_new_type = 'coordinator';
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
				"message" => "Se ha agregado nuevo coodrdinador con usuario: '".$user_new_username."' y contraseña: '".$user_new_password."'"
			);
			// Send email with username and password to the new user using admin account
		}
	}

	$new_coordinator_user_id = ($new_coordinator_createuser ? get_max_index_of_table($con, "user") : "null");

	// With data ready, add coordinator
	$continue = true;

	$results_alerts = add_coordinator($con, $new_coordinator_name, $new_coordinator_second_name, $new_coordinator_lastname,  $new_coordinator_second_lastname, $new_coordinator_gender, $new_coordinator_notes, $new_coordinator_date_added, $new_coordinator_user_id);

	$new_coordinator_index = mysqli_insert_id($con);

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
			"message" => "Se ha agregado a un nuevo coordinador."
		);

		// If successful, then insert the corresponding phone and email
		$phones = $_POST['coordinator_new_phone_number'];
		$phones_types = $_POST['coordinator_new_phone_type'];

		foreach ($phones as $key => $phone) {

			if (!empty($phone)) {
				$results_alerts = add_phonecoordinator($con, $phone, $phones_types[$key], $new_coordinator_index);

				if (!empty($results_alerts)) {
					foreach ($results_alerts as $ra) {
						$alerts[] = $ra;	
					}
				}
			}

		}

		$emails = $_POST['coordinator_new_email_address'];
		$emails_types = $_POST['coordinator_new_email_type'];
		
		foreach ($emails as $key => $email) {
			
			if (!empty($email)) {
				$results_alerts = add_emailcoordinator($con, $email, $emails_types[$key], $new_coordinator_index);

				if (!empty($results_alerts)) {
					foreach ($results_alerts as $ra) {
						$alerts[] = $ra;	
					}
				}
			}
		}

	}

}

// Edit coordinator -- This function will be in the detail page.

// Delete coordinator
if (isset($_POST['coordinator_delete'])) {

	/*
	 * This will delete the coordinator in the following sequence:
	 *   First delete contact information (emails and phones)
	 *   Delete the coordinator
	 *   Delete associated users
	 */

	$coordinator_id = $_POST['coordinator_id'];

	$coordinator_row = select_coordinator_with_id($con, $coordinator_id);

	if (!$coordinator_row) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "Coordinador no encontrado."
		);
	} else {

		// Delete contact information
		$results_alerts = delete_coordinator_contact_information($con, $coordinator_row['coordinator_id']);
		if (!empty($results_alerts)) {
			foreach ($results_alerts as $ra) {
				$alerts[] = $ra;	
			}	
		}

		// Delete the coordinator
		$results_alerts = delete_coordinator($con, $coordinator_row['coordinator_id']);
		if (!empty($results_alerts)) {
			foreach ($results_alerts as $ra) {
				$alerts[] = $ra;	
			}	
		}

		// Delete associated users if any
		$results_alerts = delete_user($con, $coordinator_row['coordinator_user_id']);
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
			"message" => "Se ha eliminado al coordinador satisfactoriamente."
		);
	}


}

// Start with header and title
$page_title = 'Coordinadores';
$page_active = 'coordinators';
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
			<h2>Administracion de coordinatores</h2>
			<a class="btn btn-success btn-sm pull-right" href="#coordinator_new_form_modal" data-toggle="modal">Agregar coordinator nuevo</a>
			<br>
			<br>
			<div id="coordinators_alerts_div">
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
			<div class="modal fade" id="coordinator_new_form_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_new_form_modal_label" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h3 class="modal-title" id="coordinator_new_form_modal_label">Agregar coordinator nuevo</h3>
			      </div> <!-- Close modal header -->
			      <div class="modal-body">
			      	<br>
			        <? include 'includes/_coordinator_new_form.php'; ?>
			      </div> <!-- Close modal body -->
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div> <!-- Close modal footer -->
			    </div><!-- Close modal content -->
			  </div> <!-- Close modal dialog -->
			</div> <!-- Close modal -->
			<br>
			<div id="coordinator_table_div">
				<table class="table table-striped table-hover table-condensed">
					<thead>
						<th>ID</th>
						<th width="35%">Nombre</th>
						<th>Género</th>
						<th>Fecha de ingreso</th>
						<th>¿Activo?</th>
						<th width="5%" class="text-danger">BORRAR</th>
					</thead>
					<tbody>
						<?
							$query = "SELECT * FROM coordinator ORDER BY coordinator_lastname";
							$coordinator_result = mysqli_query($con, $query);
							while($coordinator_row = mysqli_fetch_array($coordinator_result)) {
								include 'includes/_coordinator_table_row.php';
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