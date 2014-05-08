<?php
/*
 * This page processes the sign in form submission
 * If successful, the user is redirected
 * Two included files are successful
 * Send NOTHING to the web browser prior to the setcookie likes!
 */

 // Check if the form has been submitted
 if ($_SERVER['REQUEST_METHOD']=='POST') {
 	// For processing the sign in
 	require ('includes/sign_in_functions.php');
	
	// Need the database connection
 	require ('../connection.php');
	
	// Check the sign in
	list ($check, $data) = check_sign_in($con, $_POST['username'], $_POST['pass']);
	
	if ($check) {
		// Set the cookies!
		setcookie('user_id', $data['user_id']);
		setcookie('user_username', $data['user_username']);
		setcookie('user_type', $data['user_type']);
		
		// Redirect
		redirect_user ();
	} else {
		// Unsuccessful
		$errors = $data;
	}
	
	// Close the database connection
	mysqli_close($con);
 }
 
 // Create the page

$page_active = 'sign_in';
$page_title = 'Sign in';
include 'includes/_header.php';
include 'includes/_menu.php';
include 'includes/_sign_in_form.php';
include 'includes/_footer.php';

?>