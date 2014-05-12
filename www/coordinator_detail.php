<?php

/*
 * COORDINATOR_DETAIL.PHP
 * 
 * DESC: THIS IS THE WEBAPP coordinatorS DETAILS PAGE
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

// If the user is logged in, display the coordinators page

// Require connection
require '../connection.php';

// Utilities
require 'includes/semester_functions.php';

// coordinator funtions
require 'includes/_coordinator_functions.php';

// Prepare alert array in case of alerts
$alerts = array();

// coordinator in detail
$coordinator_id = $_GET['coordinator_id'];
$query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";
// Get coordinator from DB
$query_result = mysqli_query($con, $query);
$coordinator = mysqli_fetch_assoc($query_result);

/*
* Form functions
*/ 

// Edit coordinator
if (isset($_POST['coordinator_edit'])) {

	// Get coordinator
	$coordinator_id = $_POST['coordinator_id'];
	
	// Prepare data for insert query
	$coordinator_data = array(
		"coordinator_name" => $_POST['coordinator_new_name'],
		"coordinator_second_name" => $_POST['coordinator_new_second_name'],
		"coordinator_lastname" => $_POST['coordinator_new_lastname'],
		"coordinator_second_lastname" => $_POST['coordinator_new_second_lastname'],
		"coordinator_gender" => $_POST['coordinator_new_gender'],
		"coordinator_role" => $_POST['coordinator_new_role'],
		"coordinator_notes" => $_POST['coordinator_new_notes']
		);

	$results_alerts = edit_coordinator($con, $coordinator_id, $coordinator_data);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información del coordinator"
		);
	}

	// coordinator in detail
	$coordinator_id = $_GET['coordinator_id'];
	$query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";
	// Get coordinator from DB
	$query_result = mysqli_query($con, $query);
	$coordinator = mysqli_fetch_assoc($query_result);

}

if (isset($_POST['phonecoordinator_add'])) {

	$phonecoordinator_number = $_POST['phonecoordinator_new_phone'];
	$phonecoordinator_type = $_POST['phonecoordinator_new_type'];
	$phonecoordinator_coordinator_id = $_POST['coordinator_id'];

	$results_alerts = add_phonecoordinator($con, $phonecoordinator_number, $phonecoordinator_type, $phonecoordinator_coordinator_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado un teléfono de contacto del coordinator."
		);
	}

}

if (isset($_POST['phonecoordinator_edit'])) {

	$phonecoordinator_id = $_POST['phonecoordinator_id'];
	$phonecoordinator_number = $_POST['phonecoordinator_new_phone'];
	$phonecoordinator_type = $_POST['phonecoordinator_new_type'];

	$results_alerts = edit_phonecoordinator($con, $phonecoordinator_id, $phonecoordinator_number, $phonecoordinator_type);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información de contacto del coordinator."
		);
	}
}

if (isset($_POST['phonecoordinator_delete'])) {

	$phonecoordinator_id = $_POST['phonecoordinator_id'];

	$results_alerts = delete_phonecoordinator($con, $phonecoordinator_id);
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

if (isset($_POST['emailcoordinator_add'])) {

	$emailcoordinator_address = $_POST['emailcoordinator_new_address'];
	$emailcoordinator_type = $_POST['emailcoordinator_new_type'];
	$emailcoordinator_coordinator_id = $_POST['coordinator_id'];

	$results_alerts = add_emailcoordinator($con, $emailcoordinator_address, $emailcoordinator_type, $emailcoordinator_coordinator_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado un correo electrónico de contacto del coordinator."
		);
	}

}

if (isset($_POST['emailcoordinator_edit'])) {

	$emailcoordinator_id = $_POST['emailcoordinator_id'];
	$emailcoordinator_address = $_POST['emailcoordinator_new_address'];
	$emailcoordinator_type = $_POST['emailcoordinator_new_type'];

	$results_alerts = edit_emailcoordinator($con, $emailcoordinator_id, $emailcoordinator_address, $emailcoordinator_type);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información de contacto del coordinator."
		);
	}

}

if (isset($_POST['emailcoordinator_delete'])) {

	$emailcoordinator_id = $_POST['emailcoordinator_id'];

	$results_alerts = delete_emailcoordinator($con, $emailcoordinator_id);
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

	$coordinator_id = $_GET['coordinator_id'];
	$select_query = "SELECT coordinator_user_id FROM coordinator WHERE coordinator_id ='".$coordinator_id."'";
	$query_result = mysqli_query($con, $select_query);
	$coordinator_user_id = mysqli_fetch_assoc($query_result);

	$user_new_password = generateRandomString(8);

	// Reset the user's password
	$results_alerts = restore_user_password($con, $coordinator_user_id['coordinator_user_id'], $user_new_password);
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

	$coordinator_id = $_GET['coordinator_id'];
	$select_query = "SELECT coordinator_user_id FROM coordinator WHERE coordinator_id ='".$coordinator_id."'";
	$query_result = mysqli_query($con, $select_query);
	$coordinator_user_id = mysqli_fetch_assoc($query_result);

	// Deactivate the user so he can't log in
	$results_alerts = deactivate_user($con, $coordinator_user_id['coordinator_user_id']);
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

	// coordinator in detail
	$coordinator_id = $_POST['coordinator_id'];
	$query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";
	// Get coordinator from DB
	$query_result = mysqli_query($con, $query);
	$coordinator = mysqli_fetch_assoc($query_result);

}

if (isset($_GET['create_user'])) {

	// coordinator in detail
	$coordinator_id = $_GET['coordinator_id'];
	$query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";
	// Get coordinator from DB
	$query_result = mysqli_query($con, $query);
	$coordinator = mysqli_fetch_assoc($query_result);


	// Create a new user 
	$user_new_username = generate_username($con, $coordinator['coordinator_name'], $coordinator['coordinator_second_name'], $coordinator['coordinator_lastname'], $coordinator['coordinator_second_lastname']);
	$user_new_password = generateRandomString(8);
	$user_new_type = 'coordinator';
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
	edit_coordinator($con, $coordinator_id, array("coordinator_user_id" => $new_user_index));

	// coordinator in detail
	$coordinator_id = $_POST['coordinator_id'];
	$query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";
	// Get coordinator from DB
	$query_result = mysqli_query($con, $query);
	$coordinator = mysqli_fetch_assoc($query_result);

}

if(isset($_POST['edit_coordinator_picture'])) {

	$coordinator_id = $_GET['coordinator_id'];

	if ($_FILES["coordinator_picture_new"]["error"] > 0) {
		echo "Error: " . $_FILES["coordinator_picture_new"]["error"] . "<br>";
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "Por favor seleccione un archivo."
		);

	} else {
		$allowed_exts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["coordinator_picture_new"]["name"]);
		$extension = end($temp);

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["coordinator_picture_new"]["type"] == "image/jpeg")
		|| ($_FILES["coordinator_picture_new"]["type"] == "image/jpg")
		|| ($_FILES["coordinator_picture_new"]["type"] == "image/pjpeg")
		|| ($_FILES["coordinator_picture_new"]["type"] == "image/x-png")
		|| ($_FILES["coordinator_picture_new"]["type"] == "image/png"))
		&& ($_FILES["coordinator_picture_new"]["size"] < 200000)
		&& in_array($extension, $allowed_exts)) {
	  		if ($_FILES["coordinator_picture_new"]["error"] > 0) {
	    		//echo "Error: " . $_FILES["file"]["error"] . "<br>";
	    		$alerts[] = array(
					"status" => "danger",
					"subject" => "¡Error!",
					"message" => "No se pudo guardar el archivo, favor de intentarlo de nuevo o contactar al administrador"
				);
	  		} else {
	    		move_uploaded_file($_FILES['coordinator_picture_new']['tmp_name'], "../file_uploads/coordinator_pictures/".$coordinator_id.".".$extension);
	    		// Set the new picture to appear on the user's profile
				edit_coordinator($con, $coordinator_id, array("coordinator_picture" => "../file_uploads/coordinator_pictures/".$coordinator_id.".".$extension));
	  		}	
		} else {
			if ($_FILES["coordinator_picture_new"]["size"] > 200000) {
				$alerts[] = array(
					"status" => "danger",
					"subject" => "¡Error!",
					"message" => "El archivo excede el tamaño permitido de 200000 bytes."
				);
			} else {
		  		$alerts[] = array(
					"status" => "danger",
					"subject" => "¡Error!",
					"message" => "El tipo de archivo es inválido: ".$extension
				);
	  		}
		}
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha cambiado la foto del usuario."
		);
	}

	// coordinator in detail
	$coordinator_id = $_POST['coordinator_id'];
	$query = "SELECT * FROM coordinator WHERE coordinator_id='".$coordinator_id."'";
	// Get coordinator from DB
	$query_result = mysqli_query($con, $query);
	$coordinator = mysqli_fetch_assoc($query_result);

}

// Start with header and title
$page_title = $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name'];
$page_active = 'coordinators';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';

// Main contents of page
?>
<div class='container'>
	</br>
	<div class="row">
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
	</div>
	<div class="row">
		<div class="col-sm-12">
			<a href="coordinators.php" class="btn btn-default pull-right">Regresar</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 text-center">
			<div class="row">
				<img class="img-circle" alt="" src="<?= (empty($coordinator['coordinator_picture']) ? "assets/img/TIC_LOGO.jpg" : $coordinator['coordinator_picture']); ?>" style="width: 140px; height: 140px;">
			</div>
			<div class="row">
				<br>
				<a href="#coordinator_upload_form_modal" class="btn btn-default btn-block btn-xs" data-toggle="modal">Cambiar foto de perfil</a>
				<a href="#coordinator_edit_form_modal" class="btn btn-default btn-block btn-xs" data-toggle="modal">Cambiar información</a>
				<hr>
				<?
					if ($coordinator['coordinator_user_id']) {
						?>
							<a href="#coordinator_confirm_reset_password_modal" class="btn btn-warning btn-block btn-xs" data-toggle="modal">Reestablecer usuario</a>
							<a href="#coordinator_confirm_deactivate_user_modal" class="btn btn-danger btn-block btn-xs" data-toggle="modal">Desactivar usuario</a>		
						<?
					} else {
						?>
							<a href="#coordinator_confirm_create_user_modal" class="btn btn-info btn-block btn-xs" data-toggle="modal">Crear usuario</a>
						<?
					}

				?>
			</div>
		</div>
		<div class="col-md-10">
			<div class="row">
				<h1><? echo $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?></h1>
				<hr>
			</div><? // Close row ?>
			<div class="row">
				<div class="col-md-5">
					<dl class="dl-horizontal">
						<dt>ID:</dt>
						<dd><? echo $coordinator['coordinator_id']; ?></dd>
						<dt>Nombre:</dt>
						<dd><? echo $coordinator['coordinator_name']; ?></dd>
						<dt>Segundo nombre:</dt>
						<dd><? echo $coordinator['coordinator_second_name'] ? $coordinator['coordinator_second_name'] : "<br>"; ?></dd>
						<dt>Apellido paterno:</dt>
						<dd><? echo $coordinator['coordinator_lastname']; ?></dd>
						<dt>Apellido materno:</dt>
						<dd><? echo $coordinator['coordinator_second_lastname'] ? $coordinator['coordinator_second_lastname'] : "<br>"; ?></dd>
						<dt>Género:</dt>
						<dd><? echo $coordinator['coordinator_gender']; ?></dd>
						<dt>Notas:</dt>
						<dd><? echo $coordinator['coordinator_notes'] ? $coordinator['coordinator_notes'] : "<br>"; ?></dd>
						<dt>Fecha de ingreso:</dt>
						<dd><? echo $coordinator['coordinator_date_added']; ?></dd>
						<?
							if ($coordinator['coordinator_user_id']) {
								$select_query = "SELECT * FROM user WHERE user_id ='".$coordinator['coordinator_user_id']."'";
								$query_result = mysqli_query($con, $select_query);
								$coordinatoruser = mysqli_fetch_assoc($query_result);

								echo "<dt>Nombre de ususario:</dt><dd>".$coordinatoruser['user_username']."</dd>";
								echo "<dt>Usuario activo:</dt><dd>".( $coordinatoruser['user_active'] == 0 ? "Desactivado" : "Activo")."</dd>";
							}
						?>
					</dl>
					<? // Edit modals ?>
					<div class="modal fade" id="coordinator_edit_form_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="coordinator_edit_form_modal_label">Editar información de <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_coordinator_edit_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Edit picture modal ?>
					<div class="modal fade" id="coordinator_upload_form_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="coordinator_upload_form_modal_label">Editar fotografía de <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_coordinator_upload_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Create user ?>
					<div class="modal fade" id="coordinator_confirm_create_user_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-info" id="coordinator_edit_form_modal_label">Creación de usuario</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea crear un usuario para el coordinator <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?create_user=true&coordinator_id=<?= $coordinator['coordinator_id']; ?>" class="pull-left btn btn-primary">Crear usuario</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Reset user password ?>
					<div class="modal fade" id="coordinator_confirm_reset_password_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-warning" id="coordinator_edit_form_modal_label">¡Alerta!</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea reestablecer la contraseña del coordinator <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?reset_user=true&coordinator_id=<?= $coordinator['coordinator_id']; ?>" class="pull-left btn btn-warning">Reestablecer</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Deactivate user ?>
					<div class="modal fade" id="coordinator_confirm_deactivate_user_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-danger" id="coordinator_edit_form_modal_label">¡Alerta!</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea desactivar la contraseña del coordinator <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?deactivate_user=true&coordinator_id=<?= $coordinator['coordinator_id']; ?>" class="pull-left btn btn-danger">Desactivar</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
				</div><? // Close column ?>
				<? // Add phone modal ?>
				<div class="modal fade" id="phonecoordinator_add_form_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h3 class="modal-title" id="coordinator_edit_form_modal_label">Agregar teléfono para <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?></h3>
				      </div> <? // Close modal header ?>
				      <div class="modal-body">
				      	<br>
				        <? include 'includes/_coordinator_phonecoordinator_add_form.php'; ?>
				      </div> <? // Close modal body ?>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				      </div> <? // Close modal footer ?>
				    </div><? // Close modal content ?>
				  </div> <? // Close modal dialog ?>
				</div> <? // Close modal ?>
				<? // Add email modal ?>
				<div class="modal fade" id="emailcoordinator_add_form_modal" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h3 class="modal-title" id="coordinator_edit_form_modal_label">Agregar correo electrónico para <?= $coordinator['coordinator_lastname'].", ".$coordinator['coordinator_name']; ?></h3>
				      </div> <? // Close modal header ?>
				      <div class="modal-body">
				      	<br>
				        <? include 'includes/_coordinator_emailcoordinator_add_form.php'; ?>
				      </div> <? // Close modal body ?>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				      </div> <? // Close modal footer ?>
				    </div><? // Close modal content ?>
				  </div> <? // Close modal dialog ?>
				</div> <? // Close modal ?>
				<div class="col-md-5">
					<table class="table table-striped table-hover table-condensed">
						<thead>
							<th>Número</th>
							<th>Tipo</th>
							<th style="width: 40px;"><a href="#phonecoordinator_add_form_modal" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span> Nuevo</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM phonecoordinator WHERE phonecoordinator_coordinator_id='".$coordinator['coordinator_id']."' ORDER BY phonecoordinator_id";
								$phonecoordinator_result = mysqli_query($con, $query);
								while($phonecoordinator_row = mysqli_fetch_array($phonecoordinator_result)) {
									include 'includes/_coordinator_phonecoordinator_table_row.php';
								}
							?>
						</tbody>
						<table class="table table-striped table-hover table-condensed">
						<thead>
							<th>Correo</th>
							<th>Tipo</th>
							<th style="width: 40px;"><a href="#emailcoordinator_add_form_modal" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span> Nuevo</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM emailcoordinator WHERE emailcoordinator_coordinator_id='".$coordinator['coordinator_id']."' ORDER BY emailcoordinator_id";
								$emailcoordinator_result = mysqli_query($con, $query);
								while($emailcoordinator_row = mysqli_fetch_array($emailcoordinator_result)) {
									include 'includes/_coordinator_emailcoordinator_table_row.php';
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