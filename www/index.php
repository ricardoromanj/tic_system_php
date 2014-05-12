<?php

/*
 * INDEX.PHP
 * 
 * DESC: THIS IS THE WEBAPP MAIN PAGE
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

// Includes for functionality
require '../connection.php';
require 'includes/semester_functions.php';
require 'includes/_user_functions.php';

// Determine type of user and depending on that show corresponding data
if ($_COOKIE['user_type'] == COORDINATOR_STRING) {
	$user_data = select_coordinator_with_user_id($con, $_COOKIE['user_id']);
	$user_full_name = $user_data['coordinator_name']." ".($user_data['coordinator_second_name'] ? $user_data['coordinator_second_name']." " : "").$user_data['coordinator_lastname']." ".($user_data['coordinator_second_lastname'] ? $user_data['coordinator_second_lastname'] : "");
	$user_picture = $user_data['coordinator_picture'];
	$user_gender = $user_data['coordinator_gender'];
} elseif ($_COOKIE['user_type'] == TUTOR_STRING) {
	$user_data = select_tutor_with_user_id($con, $_COOKIE['user_id']);
	$user_full_name = $user_data['tutor_name']." ".($user_data['tutor_second_name'] ? $user_data['tutor_second_name']." " : "").$user_data['tutor_lastname']." ".($user_data['tutor_second_lastname'] ? $user_data['tutor_second_lastname'] : "");
	$user_picture = $user_data['tutor_picture'];
	$user_gender = $user_data['tutor_gender'];
} else {
	$user_full_name = "Administrator";
	$user_picture = 'assets/img/TIC_LOGO.jpg';
	$user_gender = "M";
}

// If the user is logged in, display the main page

// Start with header and title
$page_title = 'Inicio';
$page_active = 'index';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';
?>

<div class='container'>
	<div class="page-header">
  		<h1>TIC<small> Talleres Infantiles Católicos</small></h1>
	</div>

	<? // Display the three most recent announcements ?>
	<div class="row">
		<div class="col-md-2">
			<img class="img-circle" alt="" src="<? echo (empty($user_picture) ? "assets/img/TIC_LOGO.jpg" : $user_picture) ; ?>" style="width: 140px; height: 140px;">
		</div>
		<div class="col-md-10">
			<h1>Bienvenid<? echo ($user_gender == F ? "a" : "o").", ".$user_full_name?></h1>
			<h3>Avisos recientes:</h3>
			<div class="panel-group" id="announcements-semestral-accordion">
				<? 
					$current_semester = get_current_semester($con);
					if ($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING) { 
						$query = "SELECT * FROM announcement, announcementsemester WHERE announcementsemester.announcement_announcement_id = announcement.announcement_id and announcementsemester.semester_semester_id='".$current_semester['semester_id']."' ORDER BY announcement_date DESC LIMIT 5";
					} else {
						$query = "SELECT * FROM announcement, announcementsemester WHERE announcementsemester.announcement_announcement_id = announcement.announcement_id and announcementsemester.semester_semester_id='".$current_semester['semester_id']."' and (announcement_audience='tutor' or announcement_audience='') ORDER BY announcement_date DESC LIMIT 5";
					}
					$announcement_result = mysqli_query($con, $query);
					while ($announcement_row = mysqli_fetch_array($announcement_result)) {
						include 'includes/_announcement.php';
					}
				?>
			</div>
		</div>
	</div>

</div>

<? // Footer
include 'includes/_footer.php';
?>