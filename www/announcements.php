<?php

/*
 * ANNOUNCEMENTS.PHP
 * 
 * DESC: THIS IS THE WEBAPP ANNOUNCEMENTS PAGE
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
// If the user is logged in, display the announcements page

// Require connection
require '../connection.php';

// Utilities
require 'includes/semester_functions.php';

// Prepare alert array in case of alerts
$alerts = array();

/*
* Form functions
*/ 
// Add announcement
if (isset($_POST['announcement_new'])) {
	// Prepare data for insert query
	$new_announcement_index = get_max_index_of_table($con, "announcement")+1;
	$new_announcement_date = date("Y-m-d H:i:s", time());
	$new_announcement_heading = $_POST['announcement_new_heading'];
	$new_announcement_text = $_POST['announcement_new_text'];
	$new_announcement_audience = $_POST['announcement_new_audience'];
	$new_announcement_type = $_POST['announcement_new_type'];

	// Prepare the query with new data
	$new_announcement_query = "INSERT INTO announcement (announcement_id,
		announcement_date, announcement_heading,
		announcement_text,announcement_audience, 
		announcement_type) VALUES (
		'".$new_announcement_index."',
		'".$new_announcement_date."',
		'".$new_announcement_heading."',
		'".$new_announcement_text."',
		'".$new_announcement_audience."',
		'".$new_announcement_type."'
		)";

	$new_announcementsemester_index = get_max_index_of_table($con, "announcementsemester")+1;
	$current_semester = get_current_semester($con);
	$new_semester_semester_id = $current_semester['semester_id'];
	$new_announcement_announcement_id = $new_announcement_index;

	$new_announcementsemester_query = "INSERT INTO announcementsemester (
		announcementsemester_id, semester_semester_id,
		announcement_announcement_id) VALUES  (
		'".$new_announcementsemester_index."',
		'".$new_semester_semester_id."',
		'".$new_announcement_announcement_id."'
		)";

	// Execute the query
	if (!@mysqli_query($con, $new_announcement_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "Error!",
			"message" => "Could not insert data."
		);
	} 
	if (!@mysqli_query($con, $new_announcementsemester_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "Error!",
			"message" => "Could not relate data."
		);
	}
	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha publicado el nuevo aviso."
		);
	}
	$management_tab_active = true;
}

// Edit announcement
if (isset($_POST['announcement_edit'])) {
	// Get original contents to check for changes
	$query = "SELECT * FROM announcement WHERE announcement_id='".$_POST['announcement_id']."'";
	$query_result = mysqli_query($con, $query);
	$original_announcement = mysqli_fetch_row($query_result);

	// Prepare data for update query
	$new_announcement_date = date("Y-m-d H:i:s", time());
	$new_announcement_heading = $_POST['announcement_new_heading'];
	$new_announcement_text = $_POST['announcement_new_text'];
	$new_announcement_audience = $_POST['announcement_new_audience'];
	$new_announcement_type = $_POST['announcement_new_type'];

	// Compare versions of announcement to edit
	if ($original_announcement['announcement_heading'] == $new_announcement_heading &&
		$original_announcement['announcement_text'] == $new_announcement_text &&
		$original_announcement['announcement_audience'] == $new_announcement_audience &&
		$original_announcement['announcement_type'] == $new_announcement_type) {

		$alerts[] = array(
				"status" => "warning",
				"subject" => "¡Advertencia!",
				"message" => "No se detectaron cambios."
			);
	}

	// Prepare the query with new data
	$edit_announcement_query = "
		UPDATE announcement
		SET announcement_date='".$new_announcement_date."',
			announcement_heading='".$new_announcement_heading."',
			announcement_text='".$new_announcement_text."',
			announcement_audience='".$new_announcement_audience."',
			announcement_type='".$new_announcement_type."'
		WHERE announcement_id=".$_POST['announcement_id'];

	// Execute the query
	if (!@mysqli_query($con, $edit_announcement_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo actualizar la información."
		);
	} 
	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado el aviso."
		);
	}
	$management_tab_active = true;
}

// Delete announcement
if (isset($_POST['announcement_delete'])) {
	$delete_announcementsemester_query = "DELETE FROM announcementsemester WHERE announcement_announcement_id=".$_POST['announcement_id'];

	if (!@mysqli_query($con, $delete_announcementsemester_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar la relación de información."
		);
	} 
	
	$delete_announcement_query = "DELETE FROM announcement WHERE announcement_id=".$_POST['announcement_id'];
	
	if (!@mysqli_query($con, $delete_announcement_query)) {
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "No se pudo borrar la información."
		);
	} 
	
	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha borrado el aviso."
		);
	
	}
	$management_tab_active = true;
}



// Start with header and title
$page_title = 'Avisos';
$page_active = 'announcements';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';

// Main contents of page
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<br>
			<? include 'includes/_sidebar.php'; ?>
		</div>
		<div class="col-sm-10 tic-sidebar">
			<? // This file displays the announcements corresponding to audience ?>
			<h2>Avisos del curso</h2>
			<ul class="nav nav-tabs">
				<li class="<? echo $management_tab_active ? "" : "active"; ?>"><a href="#view-announcements-div" data-toggle="tab">Avisos semestrales</a></li>
				<? if ($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING) { ?>
					<li class="<? echo $management_tab_active ? "active" : ""; ?>"><a href='#manage-announcements-div' data-toggle='tab'>Administración de avisos</a></li>
				<? } ?>	
			</ul>
			<div class='tab-content'>
				<div class='tab-pane <? echo $management_tab_active ? "" : "active"; ?>' id='view-announcements-div'>
					<br>
					<div class="panel-group" id="announcements-semestral-accordion">
						<? 
							$current_semester = get_current_semester($con);
							if ($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING) { 
								$query = "SELECT * FROM announcement, announcementsemester WHERE announcementsemester.announcement_announcement_id = announcement.announcement_id and announcementsemester.semester_semester_id='".$current_semester['semester_id']."' ORDER BY announcement_date DESC";
							} else {
								$query = "SELECT * FROM announcement, announcementsemester WHERE announcementsemester.announcement_announcement_id = announcement.announcement_id and announcementsemester.semester_semester_id='".$current_semester['semester_id']."' and (announcement_audience='tutor' or announcement_audience='') ORDER BY announcement_date DESC";
							}
							$announcement_result = mysqli_query($con, $query);
							while ($announcement_row = mysqli_fetch_array($announcement_result)) {
								include 'includes/_announcement.php';
							}
						?>
					</div>
				</div>
			<? if ($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING) { ?>
				<div class='tab-pane <? echo $management_tab_active ? "active" : ""; ?>' id='manage-announcements-div'>	
					<br>
					<a class="btn btn-success btn-sm pull-right" href="#announcement_new_form_modal" data-toggle="modal">Publicar nuevo aviso</a>
					<br>
					<br>
					<div id="announcements_alerts_div">
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
					<div class="modal fade" id="announcement_new_form_modal" tabindex="-1" role="dialog" aria-labelledby="announcement_new_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="announcement_new_form_modal_label">Publicar nuevo aviso</h3>
					      </div> <!-- Close modal header -->
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_announcement_new_form.php'; ?>
					      </div> <!-- Close modal body -->
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <!-- Close modal footer -->
					    </div><!-- Close modal content -->
					  </div> <!-- Close modal dialog -->
					</div> <!-- Close modal -->
					<br>
					<div id="announcements_table_div">
						<table class="table table-striped table-condensed table-hover">
							<thead>
								<th>Encabezado</th>
								<th>Semestre</th>
								<th>Fecha de publicación</th>
								<th>Dirigido a</th>
								<th width="5%" class="text-danger">BORRAR</th>
							</thead>
							<tbody>
								<? 
									$query = "SELECT * FROM announcement ORDER BY announcement_date DESC"; 
									$announcement_result = mysqli_query($con, $query);
									while ($announcement_row = mysqli_fetch_array($announcement_result)) {
										include 'includes/_announcement_table_row.php';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			<? } ?>
			</div>
		</div><? // Close column ?>
	</div><? // Close row ?>
<? // Close container and set footer ?>
</div>
<? 
// Close any open connections
mysqli_close($con);

// Footer
include 'includes/_footer.php';
?>