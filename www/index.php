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

// Check if user is logged in
if (!isset($_COOKIE['user_id'])) {
	require 'includes/sign_in_functions.php';
	redirect_user('sign_in.php');
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
</div>

<? // Footer
include 'includes/_footer.php';
?>