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

require 'includes/constants.php';

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
		"child_birthdate" => $_POST['child_new_birthdate'],
		"child_allergies" => $_POST['child_new_allergies'],
		"child_medical_notes" => $_POST['child_new_medical_notes'],
		"child_general_notes" => $_POST['child_new_general_notes']
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
			"message" => "Se ha editado la información del niño."
		);
	}

	// child in detail
	$child_id = $_GET['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);

}

if (isset($_POST['assign_child_tutor'])) {
	$child_id = $_POST['child_id'];
	$tutor_pieces = explode(" ", $_POST['child_new_tutor']);

	$results_alerts = assign_child_to_tutor($con, $child_id, $tutor_pieces[0]);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha asignado el tutor al niño."
		);
	}

	// child in detail
	$child_id = $_GET['child_id'];
	$query = "SELECT * FROM child WHERE child_id='".$child_id."'";
	// Get child from DB
	$query_result = mysqli_query($con, $query);
	$child = mysqli_fetch_assoc($query_result);

}

if (isset($_GET['unassign_child_tutor'])) {

	$childtutor_id = $_GET['childtutor_id'];

	$results_alerts = unassign_child_from_tutor($con, $childtutor_id);
	if (!empty($results_alerts)) {
		foreach ($results_alerts as $ra) {
			$alerts[] = $ra;	
		}	
	}

	if (empty($alerts)) {
		$alerts[] = array(
			"status" => "success",
			"subject" => "¡Enhorabuena!",
			"message" => "Se ha borrado la asignación del tutor al niño."
		);
	}

	// child in detail
	$child_id = $_GET['child_id'];
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
			"message" => "Se ha cambiado la foto del niño."
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
$page_title = $child['child_lastname'].", ".$child['child_name'];
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
						<dt>Alergias</dt>
						<dd><?= ($child['child_allergies'] ? $child['child_allergies'] : "<br>"); ?></dd>
						<dt>Notas médicas:</dt>
						<dd><?= ($child['child_medical_notes'] ? $child['child_medical_notes'] : "<br>") ?></dd>
						<dt>Notas generales:</dt>
						<dd><? echo $child['child_general_notes'] ? $child['child_general_notes'] : "<br>"; ?></dd>
						<dt>Ingresado en:</dt>
						<dd><? echo $child['child_date_added']; ?></dd>
						<dt>Activo:</dt>
						<dd><?= ($child['child_active']==1 ? "Sí" : "No"); ?></dd>
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
					<? // Assign tutor modal ?>
					<div class="modal fade" id="child_assign_tutor_form_modal" tabindex="-1" role="dialog" aria-labelledby="child_assign_tutor_modal_label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h3 class="modal-title" id="child_assign_tutor_modal_label">Asignar tutor a <?= $child['child_lastname'].", ".$child['child_name']; ?></h3>
					      </div> <? // Close modal header ?>
					      <div class="modal-body">
					      	<br>
					        <? include 'includes/_child_assign_tutor_form.php'; ?>
					      </div> <? // Close modal body ?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div> <? // Close modal footer ?>
					    </div><? // Close modal content ?>
					  </div> <? // Close modal dialog ?>
					</div> <? // Close modal ?>
				</div> <? // Close column?>
				<div class="col-md-5">
					<table class="table table-striped table-hover table-condensed">
						<thead>
							<th>Responsabilidad de:</th>
							<th style="width: 60px;"><a href="#child_assign_tutor_form_modal" class="btn btn-primary btn-xs" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span> Assignar a tutor</a></th>
						</thead>
						<tbody>
							<?
								$query = "SELECT * FROM tutor, childtutor WHERE childtutor.childtutor_child_id='".$child['child_id']."' AND tutor.tutor_id = childtutor.childtutor_tutor_id ORDER BY tutor.tutor_lastname";
								$childtutor_result = mysqli_query($con, $query);
								while($childtutor_row = mysqli_fetch_array($childtutor_result)) {
									include 'includes/_childtutor_table_row.php';
								}
							?>
						</tbody>
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