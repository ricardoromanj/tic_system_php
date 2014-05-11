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

// Tutor funtions
require 'includes/_tutor_functions.php';

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

	// Get tutor
	$tutor_id = $_POST['tutor_id'];
	
	// Prepare data for insert query
	$tutor_data = array(
		"tutor_name" => $_POST['tutor_new_name'],
		"tutor_second_name" => $_POST['tutor_new_second_name'],
		"tutor_lastname" => $_POST['tutor_new_lastname'],
		"tutor_second_lastname" => $_POST['tutor_new_second_lastname'],
		"tutor_gender" => $_POST['tutor_new_gender'],
		"tutor_role" => $_POST['tutor_new_role'],
		"tutor_notes" => $_POST['tutor_new_notes']
		);

	$results_alerts = edit_tutor($con, $tutor_id, $tutor_data);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado editado la información del tutor"
		);
	}

	// Tutor in detail
	$tutor_id = $_GET['tutor_id'];
	$query = "SELECT * FROM tutor WHERE tutor_id='".$tutor_id."'";
	// Get tutor from DB
	$query_result = mysqli_query($con, $query);
	$tutor = mysqli_fetch_assoc($query_result);

}

if (isset($_POST['phonetutor_add'])) {

}

if (isset($_POST['phonetutor_edit'])) {

	$phonetutor_id = $_POST['phonetutor_id'];
	$phonetutor_number = $_POST['phonetutor_new_phone'];
	$phonetutor_type = $_POST['phonetutor_new_type'];

	$results_alerts = edit_phonetutor($con, $phonetutor_id, $phonetutor_number, $phonetutor_type);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información de contacto del tutor."
		);
	}
}

if (isset($_POST['phonetutor_delete'])) {

	$phonetutor_id = $_POST['phonetutor_id'];

	$results_alerts = delete_phonetutor($con, $phonetutor_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha borrado el teléfono de contacto."
		);
	}
}

if (isset($_POST['emailtutor_add'])) {

}

if (isset($_POST['emailtutor_edit'])) {

	$emailtutor_id = $_POST['emailtutor_id'];
	$emailtutor_address = $_POST['emailtutor_new_address'];
	$emailtutor_type = $_POST['emailtutor_new_type'];

	$results_alerts = edit_emailtutor($con, $emailtutor_id, $emailtutor_address, $emailtutor_type);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información de contacto del tutor."
		);
	}

}

if (isset($_POST['emailtutor_delete'])) {

	$emailtutor_id = $_POST['emailtutor_id'];

	$results_alerts = delete_emailtutor($con, $emailtutor_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha borrado el correo de contacto."
		);
	}

}

if (isset($_GET['reset_user'])) {

	$tutor_id = $_GET['tutor_id'];
	$select_query = "SELECT tutor_user_id FROM tutor WHERE tutor_id ='".$tutor_id."'";
	$query_result = mysqli_query($con, $select_query);
	$tutor_user_id = mysqli_fetch_assoc($query_result);

	$user_new_password = generateRandomString(8);

	// Reset the user's password
	$results_alerts = restore_user_password($con, $tutor_user_id['tutor_user_id'], $user_new_password);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha reestablecido la contraseña del usuario. Nueva contraseña: ".$user_new_password
		);
	}

}

if (isset($_GET['deactivate_user'])) {

	$tutor_id = $_GET['tutor_id'];
	$select_query = "SELECT tutor_user_id FROM tutor WHERE tutor_id ='".$tutor_id."'";
	$query_result = mysqli_query($con, $select_query);
	$tutor_user_id = mysqli_fetch_assoc($query_result);

	// Deactivate the user so he can't log in
	$results_alerts = deactivate_user($con, $tutor_user_id['tutor_user_id']);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha desactivado el usuario."
		);
	}

}

if (isset($_GET['create_user'])) {

	// Tutor in detail
	$tutor_id = $_GET['tutor_id'];
	$query = "SELECT * FROM tutor WHERE tutor_id='".$tutor_id."'";
	// Get tutor from DB
	$query_result = mysqli_query($con, $query);
	$tutor = mysqli_fetch_assoc($query_result);


	// Create a new user 
	$user_new_username = generate_username($con, $tutor['tutor_name'], $tutor['tutor_second_name'], $tutor['tutor_lastname'], $tutor['tutor_second_lastname']);
	$user_new_password = generateRandomString(8);
	$user_new_type = 'tutor';
	$user_new_active = 1;
	$user_new_created_at = date("Y-m-d H:i:s", time());
	$user_new_lastlogin = '';

	$results_alerts = add_user($con, $user_new_username, $user_new_password, $user_new_type, $user_new_active, $user_new_created_at, $user_new_lastlogin);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado nuevo usuario con usuario: '".$user_new_username."'' y contraseña: '".$user_new_password."'"
		);
	}

	// And assign it to the user
	$new_user_index = mysqli_insert_id($con);
	edit_tutor($con, $tutor_id, array("tutor_user_id" => $new_user_index));

}

if(isset($_POST['edit_tutor_picture'])) {

	$tutor_id = $_GET['tutor_id'];

	if ($_FILES["tutor_picture_new"]["error"] > 0) {
		echo "Error: " . $_FILES["tutor_picture_new"]["error"] . "<br>";
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "Por favor seleccione un archivo."
		);

	} else {
		$allowed_exts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["tutor_picture_new"]["name"]);
		$extension = end($temp);

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["tutor_picture_new"]["type"] == "image/jpeg")
		|| ($_FILES["tutor_picture_new"]["type"] == "image/jpg")
		|| ($_FILES["tutor_picture_new"]["type"] == "image/pjpeg")
		|| ($_FILES["tutor_picture_new"]["type"] == "image/x-png")
		|| ($_FILES["tutor_picture_new"]["type"] == "image/png"))
		&& ($_FILES["tutor_picture_new"]["size"] < 200000)
		&& in_array($extension, $allowed_exts)) {
	  		if ($_FILES["file"]["error"] > 0) {
	    		//echo "Error: " . $_FILES["file"]["error"] . "<br>";
	    		$alerts[] = array(
					"status" => "danger",
					"subject" => "¡Error!",
					"message" => "No se pudo guardar el archivo, favor de intentarlo de nuevo o contactar al administrador"
				);
	  		} else {
	    		move_uploaded_file($_FILES['tutor_picture_new']['tmp_name'], "../file_uploads/tutor_pictures/".$tutor_id.".".$extension);
	    		// Set the new picture to appear on the user's profile
				edit_tutor($con, $tutor_id, array("tutor_picture" => "../file_uploads/tutor_pictures/".$tutor_id.".".$extension));
	  		}	
		} else {

	  		$alerts[] = array(
				"status" => "danger",
				"subject" => "¡Error!",
				"message" => "El tipo de archivo es inválido: ".$extension
			);
		}
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha cambiado la foto del usuario."
		);
	}

	// Tutor in detail
	$tutor_id = $_GET['tutor_id'];
	$query = "SELECT * FROM tutor WHERE tutor_id='".$tutor_id."'";
	// Get tutor from DB
	$query_result = mysqli_query($con, $query);
	$tutor = mysqli_fetch_assoc($query_result);

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
	</div>
	<div class="row">
		<div class="col-sm-12">
			<a href="tutors.php" class="btn btn-default pull-right">Regresar</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 text-center">
			<div class="row">
				<img class="img-circle" alt="" src="<?= (empty($tutor['tutor_picture']) ? "assets/img/TIC_LOGO.jpg" : $tutor['tutor_picture']); ?>" style="width: 140px; height: 140px;">
			</div>
			<div class="row">
				<br>
				<a href="#tutor_upload_form_modal" class="btn btn-default btn-block btn-xs" data-toggle="modal">Cambiar foto de perfil</a>
				<a href="#tutor_edit_form_modal" class="btn btn-default btn-block btn-xs" data-toggle="modal">Cambiar información</a>
				<hr>
				<?
					if ($tutor['tutor_user_id']) {
						?>
							<a href="#tutor_confirm_reset_password_modal" class="btn btn-warning btn-block btn-xs" data-toggle="modal">Reestablecer usuario</a>
							<a href="#tutor_confirm_deactivate_user_modal" class="btn btn-danger btn-block btn-xs" data-toggle="modal">Desactivar usuario</a>		
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
			<div class="row">
				<h1><? echo $tutor['tutor_lastname'].", ".$tutor['tutor_name']; ?></h1>
				<hr>
			</div><? // Close row ?>
			<div class="row">
				<div class="col-md-5">
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
						<?
							if ($tutor['tutor_user_id']) {
								$select_query = "SELECT * FROM user WHERE user_id ='".$tutor['tutor_user_id']."'";
								$query_result = mysqli_query($con, $select_query);
								$tutoruser = mysqli_fetch_assoc($query_result);

								echo "<dt>Nombre de ususario:</dt><dd>".$tutoruser['user_username']."</dd>";
								echo "<dt>Usuario activo:</dt><dd>".( $tutoruser['user_active'] == 0 ? "Desactivado" : "Activo")."</dd>";
							}
						?>
					</dl>
					<? // Edit modals ?>
					<div class="modal fade" id="tutor_edit_form_modal" tabindex="-1" role="dialog" aria-labelledby="tutor_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="tutor_edit_form_modal_label">Editar información de <?= $tutor['tutor_lastname'].", ".$tutor['tutor_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_tutor_edit_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Edit picture modal ?>
					<div class="modal fade" id="tutor_upload_form_modal" tabindex="-1" role="dialog" aria-labelledby="tutor_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="tutor_upload_form_modal_label">Editar fotografía de <?= $tutor['tutor_lastname'].", ".$tutor['tutor_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_tutor_upload_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Reset user password ?>
					<div class="modal fade" id="tutor_confirm_reset_password_modal" tabindex="-1" role="dialog" aria-labelledby="tutor_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-warning" id="tutor_edit_form_modal_label">¡Alerta!</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea reestablecer la contraseña del tutor <?= $tutor['tutor_lastname'].", ".$tutor['tutor_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?reset_user=true&tutor_id=<?= $tutor['tutor_id']; ?>" class="pull-left btn btn-warning">Reestablecer</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Deactivate user ?>
					<div class="modal fade" id="tutor_confirm_deactivate_user_modal" tabindex="-1" role="dialog" aria-labelledby="tutor_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-danger" id="tutor_edit_form_modal_label">¡Alerta!</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea desactivar la contraseña del tutor <?= $tutor['tutor_lastname'].", ".$tutor['tutor_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?deactivate_user=true&tutor_id=<?= $tutor['tutor_id']; ?>" class="pull-left btn btn-danger">Desactivar</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
				</div><? // Close column ?>
				<div class="col-md-5">
					<table class="table table-striped table-hover table-condensed">
						<thead>
							<th>Número</th>
							<th>Tipo</th>
							<th style="width: 40px;"><a href="#" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-asterisk"></span> Nuevo</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM phonetutor WHERE phonetutor_tutor_id='".$tutor['tutor_id']."' ORDER BY phonetutor_id";
								$phonetutor_result = mysqli_query($con, $query);
								while($phonetutor_row = mysqli_fetch_array($phonetutor_result)) {
									include 'includes/_tutor_phonetutor_table_row.php';
								}
							?>
						</tbody>
						<table class="table table-striped table-hover table-condensed">
						<thead>
							<th>Correo</th>
							<th>Tipo</th>
							<th style="width: 40px;"><a href="#" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-asterisk"></span> Nuevo</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM emailtutor WHERE emailtutor_tutor_id='".$tutor['tutor_id']."' ORDER BY emailtutor_id";
								$emailtutor_result = mysqli_query($con, $query);
								while($emailtutor_row = mysqli_fetch_array($emailtutor_result)) {
									include 'includes/_tutor_emailtutor_table_row.php';
								}
							?>
						</tbody>
					</table>
					</table>
				</div><? // Close column?>
			</div><? // Close row ?>
		</div><? // Close column size 10 ?>
	</div>
</div>
<? 
// Close any open connections
mysqli_close($con);

// Footer
include 'includes/_footer.php';
?>