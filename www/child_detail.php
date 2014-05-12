<?php

/*
 * CHILD_DETAIL.PHP
 * 
 * DESC: THIS IS THE WEBAPP CHILD DETAILS PAGE
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

// If the user is logged in, display the children page

// Require connection
require '../connection.php';

// Utilities
require 'includes/semester_functions.php';

// child funtions
require 'includes/_child_functions.php';

// Prepare alert array in case of alerts
$alerts = array();

// child in detail
$child_id = $_GET['child_id'];
$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
// Get child from DB
$query_result = mysqli_query($con, $query);
$child = mysqli_fetch_assoc($query_result);

/*
* Form functions
*/ 

// Edit child
if (isset($_POST['child_edit'])) {

	// Get child
	$child_id = $_POST['child_id'];
	
	// Prepare data for insert query
	$child_data = array(
		"child_name" => $_POST['child_new_name'],
		"child_second_name" => $_POST['child_new_second_name'],
		"child_lastname" => $_POST['child_new_lastname'],
		"child_second_lastname" => $_POST['child_new_second_lastname'],
		"child_gender" => $_POST['child_new_gender'],
		"child_role" => $_POST['child_new_role'],
		"child_notes" => $_POST['child_new_notes']
		);

	$results_alerts = edit_child($con, $child_id, $child_data);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información del child"
		);
	}

	// child in detail
	$child_id = $_GET['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);

}

if (isset($_POST['phonechild_add'])) {

	$phonechild_number = $_POST['phonechild_new_phone'];
	$phonechild_type = $_POST['phonechild_new_type'];
	$phonechild_child_id = $_POST['child_id'];

	$results_alerts = add_phonechild($con, $phonechild_number, $phonechild_type, $phonechild_child_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado un teléfono de contacto del child."
		);
	}

}

if (isset($_POST['phonechild_edit'])) {

	$phonechild_id = $_POST['phonechild_id'];
	$phonechild_number = $_POST['phonechild_new_phone'];
	$phonechild_type = $_POST['phonechild_new_type'];

	$results_alerts = edit_phonechild($con, $phonechild_id, $phonechild_number, $phonechild_type);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información de contacto del child."
		);
	}
}

if (isset($_POST['phonechild_delete'])) {

	$phonechild_id = $_POST['phonechild_id'];

	$results_alerts = delete_phonechild($con, $phonechild_id);
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

if (isset($_POST['emailchild_add'])) {

	$emailchild_address = $_POST['emailchild_new_address'];
	$emailchild_type = $_POST['emailchild_new_type'];
	$emailchild_child_id = $_POST['child_id'];

	$results_alerts = add_emailchild($con, $emailchild_address, $emailchild_type, $emailchild_child_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha agregado un correo electrónico de contacto del child."
		);
	}

}

if (isset($_POST['emailchild_edit'])) {

	$emailchild_id = $_POST['emailchild_id'];
	$emailchild_address = $_POST['emailchild_new_address'];
	$emailchild_type = $_POST['emailchild_new_type'];

	$results_alerts = edit_emailchild($con, $emailchild_id, $emailchild_address, $emailchild_type);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha editado la información de contacto del child."
		);
	}

}

if (isset($_POST['emailchild_delete'])) {

	$emailchild_id = $_POST['emailchild_id'];

	$results_alerts = delete_emailchild($con, $emailchild_id);
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

	$child_id = $_GET['child_id'];
	$select_query = "SELECT child_user_id FROM child WHERE child_id ='".$child_id."'";
	$query_result = mysqli_query($con, $select_query);
	$child_user_id = mysqli_fetch_assoc($query_result);

	$user_new_password = generateRandomString(8);

	// Reset the user's password
	$results_alerts = restore_user_password($con, $child_user_id['child_user_id'], $user_new_password);
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

	$child_id = $_GET['child_id'];
	$select_query = "SELECT child_user_id FROM child WHERE child_id ='".$child_id."'";
	$query_result = mysqli_query($con, $select_query);
	$child_user_id = mysqli_fetch_assoc($query_result);

	// Deactivate the user so he can't log in
	$results_alerts = deactivate_user($con, $child_user_id['child_user_id']);
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

	// child in detail
	$child_id = $_POST['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);

}

if (isset($_GET['create_user'])) {

	// child in detail
	$child_id = $_GET['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);


	// Create a new user 
	$user_new_username = generate_username($con, $child['child_name'], $child['child_second_name'], $child['child_lastname'], $child['child_second_lastname']);
	$user_new_password = generateRandomString(8);
	$user_new_type = 'child';
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
	edit_child($con, $child_id, array("child_user_id" => $new_user_index));

	// child in detail
	$child_id = $_POST['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);

}

if(isset($_POST['edit_child_picture'])) {

	$child_id = $_GET['child_id'];

	if ($_FILES["child_picture_new"]["error"] > 0) {
		echo "Error: " . $_FILES["child_picture_new"]["error"] . "<br>";
		$alerts[] = array(
			"status" => "danger",
			"subject" => "¡Error!",
			"message" => "Por favor seleccione un archivo."
		);

	} else {
		$allowed_exts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["child_picture_new"]["name"]);
		$extension = end($temp);

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["child_picture_new"]["type"] == "image/jpeg")
		|| ($_FILES["child_picture_new"]["type"] == "image/jpg")
		|| ($_FILES["child_picture_new"]["type"] == "image/pjpeg")
		|| ($_FILES["child_picture_new"]["type"] == "image/x-png")
		|| ($_FILES["child_picture_new"]["type"] == "image/png"))
		&& ($_FILES["child_picture_new"]["size"] < 200000)
		&& in_array($extension, $allowed_exts)) {
	  		if ($_FILES["child_picture_new"]["error"] > 0) {
	    		//echo "Error: " . $_FILES["file"]["error"] . "<br>";
	    		$alerts[] = array(
					"status" => "danger",
					"subject" => "¡Error!",
					"message" => "No se pudo guardar el archivo, favor de intentarlo de nuevo o contactar al administrador"
				);
	  		} else {
	    		move_uploaded_file($_FILES['child_picture_new']['tmp_name'], "../file_uploads/child_pictures/".$child_id.".".$extension);
	    		// Set the new picture to appear on the user's profile
				edit_child($con, $child_id, array("child_picture" => "../file_uploads/child_pictures/".$child_id.".".$extension));
	  		}	
		} else {
			if ($_FILES["child_picture_new"]["size"] > 200000) {
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

	// child in detail
	$child_id = $_POST['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);

}

// Start with header and title
$page_title = 'childes';
$page_active = 'children';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';

// Main contents of page
?>
<div class='container'>
	</br>
	<div class="row">
		<div id="children_alerts_div">
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
			<a href="children.php" class="btn btn-default pull-right">Regresar</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 text-center">
			<div class="row">
				<img class="img-circle" alt="" src="<?= (empty($child['child_picture']) ? "assets/img/TIC_LOGO.jpg" : $child['child_picture']); ?>" style="width: 140px; height: 140px;">
			</div>
			<div class="row">
				<br>
				<a href="#child_upload_form_modal" class="btn btn-default btn-block btn-xs" data-toggle="modal">Cambiar foto de perfil</a>
				<a href="#child_edit_form_modal" class="btn btn-default btn-block btn-xs" data-toggle="modal">Cambiar información</a>
				<hr>
				<?
					if ($child['child_user_id']) {
						?>
							<a href="#child_confirm_reset_password_modal" class="btn btn-warning btn-block btn-xs" data-toggle="modal">Reestablecer usuario</a>
							<a href="#child_confirm_deactivate_user_modal" class="btn btn-danger btn-block btn-xs" data-toggle="modal">Desactivar usuario</a>		
						<?
					} else {
						?>
							<a href="#child_confirm_create_user_modal" class="btn btn-info btn-block btn-xs" data-toggle="modal">Crear usuario</a>
						<?
					}

				?>
			</div>
		</div>
		<div class="col-md-10">
			<div class="row">
				<h1><? echo $child['child_lastname'].", ".$child['child_name']; ?></h1>
				<hr>
			</div><? // Close row ?>
			<div class="row">
				<div class="col-md-5">
					<dl class="dl-horizontal">
						<dt>ID:</dt>
						<dd><? echo $child['child_id']; ?></dd>
						<dt>Nombre:</dt>
						<dd><? echo $child['child_name']; ?></dd>
						<dt>Segundo nombre:</dt>
						<dd><? echo $child['child_second_name'] ? $child['child_second_name'] : "<br>"; ?></dd>
						<dt>Apellido paterno:</dt>
						<dd><? echo $child['child_lastname']; ?></dd>
						<dt>Apellido materno:</dt>
						<dd><? echo $child['child_second_lastname'] ? $child['child_second_lastname'] : "<br>"; ?></dd>
						<dt>Género:</dt>
						<dd><? echo $child['child_gender']; ?></dd>
						<dt>Rol del child:</dt>
						<dd><? echo $child['child_role']; ?></dd>
						<dt>Notas:</dt>
						<dd><? echo $child['child_notes'] ? $child['child_notes'] : "<br>"; ?></dd>
						<dt>Ingresado en:</dt>
						<dd><? echo $child['child_date_added']; ?></dd>
						<?
							if ($child['child_user_id']) {
								$select_query = "SELECT * FROM user WHERE user_id ='".$child['child_user_id']."'";
								$query_result = mysqli_query($con, $select_query);
								$childuser = mysqli_fetch_assoc($query_result);

								echo "<dt>Nombre de ususario:</dt><dd>".$childuser['user_username']."</dd>";
								echo "<dt>Usuario activo:</dt><dd>".( $childuser['user_active'] == 0 ? "Desactivado" : "Activo")."</dd>";
							}
						?>
					</dl>
					<? // Edit modals ?>
					<div class="modal fade" id="child_edit_form_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="child_edit_form_modal_label">Editar información de <?= $child['child_lastname'].", ".$child['child_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_child_edit_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Edit picture modal ?>
					<div class="modal fade" id="child_upload_form_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="child_upload_form_modal_label">Editar fotografía de <?= $child['child_lastname'].", ".$child['child_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_child_upload_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Create user ?>
					<div class="modal fade" id="child_confirm_create_user_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-info" id="child_edit_form_modal_label">Creación de usuario</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea crear un usuario para el child <?= $child['child_lastname'].", ".$child['child_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?create_user=true&child_id=<?= $child['child_id']; ?>" class="pull-left btn btn-primary">Crear usuario</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Reset user password ?>
					<div class="modal fade" id="child_confirm_reset_password_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-warning" id="child_edit_form_modal_label">¡Alerta!</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea reestablecer la contraseña del child <?= $child['child_lastname'].", ".$child['child_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?reset_user=true&child_id=<?= $child['child_id']; ?>" class="pull-left btn btn-warning">Reestablecer</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
					<? // Deactivate user ?>
					<div class="modal fade" id="child_confirm_deactivate_user_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title text-danger" id="child_edit_form_modal_label">¡Alerta!</h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <p>¿Realmente desea desactivar la contraseña del child <?= $child['child_lastname'].", ".$child['child_name']; ?>?</p>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					      	<a href="<? $_PHP_SELF ?>?deactivate_user=true&child_id=<?= $child['child_id']; ?>" class="pull-left btn btn-danger">Desactivar</a>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
				</div><? // Close column ?>
				<? // Add phone modal ?>
				<div class="modal fade" id="phonechild_add_form_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h3 class="modal-title" id="child_edit_form_modal_label">Agregar teléfono para <?= $child['child_lastname'].", ".$child['child_name']; ?></h3>
				      </div> <? // Close modal header ?>
				      <div class="modal-body">
				      	<br>
				        <? include 'includes/_child_phonechild_add_form.php'; ?>
				      </div> <? // Close modal body ?>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				      </div> <? // Close modal footer ?>
				    </div><? // Close modal content ?>
				  </div> <? // Close modal dialog ?>
				</div> <? // Close modal ?>
				<? // Add email modal ?>
				<div class="modal fade" id="emailchild_add_form_modal" tabindex="-1" role="dialog" aria-labelledby="child_edit_form_modal_label" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h3 class="modal-title" id="child_edit_form_modal_label">Agregar correo electrónico para <?= $child['child_lastname'].", ".$child['child_name']; ?></h3>
				      </div> <? // Close modal header ?>
				      <div class="modal-body">
				      	<br>
				        <? include 'includes/_child_emailchild_add_form.php'; ?>
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
							<th style="width: 40px;"><a href="#phonechild_add_form_modal" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span> Nuevo</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM phonechild WHERE phonechild_child_id='".$child['child_id']."' ORDER BY phonechild_id";
								$phonechild_result = mysqli_query($con, $query);
								while($phonechild_row = mysqli_fetch_array($phonechild_result)) {
									include 'includes/_child_phonechild_table_row.php';
								}
							?>
						</tbody>
						<table class="table table-striped table-hover table-condensed">
						<thead>
							<th>Correo</th>
							<th>Tipo</th>
							<th style="width: 40px;"><a href="#emailchild_add_form_modal" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span> Nuevo</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM emailchild WHERE emailchild_child_id='".$child['child_id']."' ORDER BY emailchild_id";
								$emailchild_result = mysqli_query($con, $query);
								while($emailchild_row = mysqli_fetch_array($emailchild_result)) {
									include 'includes/_child_emailchild_table_row.php';
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