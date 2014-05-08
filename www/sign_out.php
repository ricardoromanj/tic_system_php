<?php
/*
 * This will let the user sign out
 */

require 'includes/sign_in_functions.php';


if (!isset($_COOKIE['user_id'])) {
	// If no cookie is present, redirect the user
	redirect_user('sign_in.php');
} else {
	// If it is, delete the cookie
	//setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
	//setcookie ('user_username', '', time()-3600, '/', '', 0, 0);
	if (isset($_SERVER['HTTP_COOKIE'])) {
    	$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    	foreach($cookies as $cookie) {
        	$parts = explode('=', $cookie);
        	$name = trim($parts[0]);
        	setcookie($name, '', time()-1000);
        	setcookie($name, '', time()-1000, '/');
    	}
	}
	redirect_user();
}


 
 
?>