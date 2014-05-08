<?php

/*
 * TUTOR_DETAIL.PHP
 * 
 * DESC: THIS IS THE WEBAPP TUTORS DETAILS PAGE
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

// Prepare alert array in case of alerts
$alerts = array();

// Tutor in detail
$tutor_id = $_GET['tutor_id'];
$query = "SELECT * FROM tutor WHERE tutor_id='".$tutor_id."'";
// Get tutor from DB
$query_result = mysqli_query($con, $query);
$tutor = mysqli_fetch_assoc($query_result);

/*
* Form functions
*/ 

// Edit tutor
if (isset($_POST['tutor_edit'])) {

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
	</br>
	<div class="row">
		<div class="col-sm-12">
			<a href="tutors.php" class="btn btn-default pull-right">Regresar</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 text-center">
			<div class="row">
				<img class="img-circle" alt="" src="assets/img/TIC_LOGO.jpg" style="width: 140px; height: 140px;">
			</div>
			<div class="row">
				<br>
				<a href="#" class="btn btn-default btn-block btn-xs">Cambiar foto de perfil</a>
				<a href="#" class="btn btn-default btn-block btn-xs">Cambiar información</a>
				<hr>
				<?
					if ($tutor['tutor_user_id']) {
						?>
							<a href="#" class="btn btn-warning btn-block btn-xs">Reestablecer usuario</a>
							<a href="#" class="btn btn-danger btn-block btn-xs">Desactivar usuario</a>		
						<?
					} else {
						?>
							<a href="#" class="btn btn-info btn-block btn-xs">Crear usuario</a>
						<?
					}

				?>
			</div>
		</div>
		<div class="col-md-10">
			<h1><? echo $tutor['tutor_lastname'].", ".$tutor['tutor_name']; ?></h1>
			<hr>
			<dl class="dl-horizontal">
				<dt>ID:</dt>
				<dd><? echo $tutor['tutor_id']; ?></dd>
				<dt>Nombre:</dt>
				<dd><? echo $tutor['tutor_name']; ?></dd>
				<dt>Segundo nombre:</dt>
				<dd><? echo $tutor['tutor_second_name'] ? $tutor['tutor_second_name'] : "<br>"; ?></dd>
				<dt>Apellido paterno:</dt>
				<dd><? echo $tutor['tutor_lastname']; ?></dd>
				<dt>Apellido materno:</dt>
				<dd><? echo $tutor['tutor_second_lastname'] ? $tutor['tutor_second_lastname'] : "<br>"; ?></dd>
				<dt>Género:</dt>
				<dd><? echo $tutor['tutor_gender']; ?></dd>
				<dt>Rol del tutor:</dt>
				<dd><? echo $tutor['tutor_role']; ?></dd>
				<dt>Notas:</dt>
				<dd><? echo $tutor['tutor_notes'] ? $tutor['tutor_notes'] : "<br>"; ?></dd>
				<dt>Ingresado en:</dt>
				<dd><? echo $tutor['tutor_date_added']; ?></dd>
			</dl>
		</div>
	</div>
</div>
<? 
// Close any open connections
mysqli_close($con);

// Footer
include 'includes/_footer.php';
?>