<?php

/* 
 * SIGN_IN_FUNCTIONS.PHP
 * 
 * DESC: FUNCTIONS USED BY SIGN IN / SIGN OUT PROCEDURES
 * AUTHOR: RICARDO ROMAN (C) 2014
 * 
 * CHANGE LOG
 * 20140228 - RICARDO ROMAN - FIRST RELEASE
 * 
 */
 
 /*
  * This function determines an URL and redirects the
  * user there.
  * It takes the user there
  * It defaults to index.php
  * 
  */

function redirect_user ($page = 'index.php') {
	//Prepare the url
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/'.$page;
	
	//Redirect the user
	header("Location: $url");
	exit(); //Quit the script
}

/*
 * The following function validates the form data
 * Requires a database conection '$con'
 * Returns an array of information:
 *    TRUE/FALSE for indicating success
 *    Information about the user or list of errors
 */

function check_sign_in ($con, $username ='', $pass='') {
	$errors = array();
	
	//Validate username
	if (empty($username)) {
		$errors[] = 'No username entered.';
	} else {
		// $u stands for username retrieved from database
		$u = mysqli_real_escape_string($con, trim($username));
	}
	
	//Validate password
	if (empty($pass)) {
		$errors[] = 'No password entered.';
	} else {
		// $p stands for password retrieved from database
		$p = mysqli_real_escape_string($con, trim($pass));
	}
	
	//If everything is ok
	if (empty($errors)) {
		//Retrieve data from the user
		$query = "SELECT user_id, user_username, user_type, user_active FROM user WHERE user_username='".$u."' AND  user_password='".SHA1($p)."'";
		$r = @mysqli_query($con, $query);
		
		//Check result
		if (mysqli_num_rows($r)==1) {
			//Fetch the record
			$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
			if ($row['user_active'] == FALSE) {
				$errors[] = "Your account has been disabled. Please contact an administrator.";
				return array(FALSE, $errors);
			}
			$q = "UPDATE user SET user_lastlogin='".date("Y-m-d H:i:s", time())."' WHERE user_id=".$row['user_id'];
			if (!@mysqli_query($con, $q)) {
				$errors[] = "Error logging you in, contact administrator. Server Error 500";
				return array(FALSE, $errors);
			} 
			//Return TRUE value and the record recovered
			return array(TRUE, $row);
		} else {
			//Not a match!!!
			$errors[] = 'Email or password not found.';
		}		
	}
	
	//Return FALSE and errors
	return array(FALSE, $errors);
}