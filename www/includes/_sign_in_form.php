<?php

/*
 * This php file will generate the login form
 * and print out any errors (if any)
 */

?>

<div class='container'>
<? if (isset($errors) && !empty($errors)) { ?>
 	<br>
 	<div class='alert alert-danger'>
 		<strong>Error!</strong> The following errors occurded:<br>
 		<ul>
 			<? foreach ($errors as $msg) { ?>
				<li><? echo $msg ?></li>
			<? } ?>
		</ul>
	</div>
<? } ?>
 
<? // Display the sign in form ?>
	<br>
 	<div class='row'>
 		<div class='col-md-2'>
 			<img src='assets/img/minion_priest.jpg' width='150'/>
 		</div>
 		<div class='col-md-4'>
 			<form action='sign_in.php' method='POST' class='form-horizontal' role='form'>
 				<legend>Ingrese su usuario y contraseña:</legend>
 				<div class='form-group'>
 					<label for="username" class='col-sm-3 control-label'>Username:</label>
 					<div class='col-sm-8'>
 						<input id="username" type='text' class='form-control' placeholder='Username' name='username' required autofocus/>
 					</div>
 				</div>
 				<div class='form-group'>
 					<label for='password' class='col-sm-3 control-label'>Password:</label>
 					<div class='col-sm-8'>
 						<input id='password' type='password' class='form-control' placeholder='Password' name='pass' required/>
 					</div>
 				</div>
 				<div class='form-group'>
 					<div class='col-sm-offset-3 col-sm-8'>
						<button class='btn btn-success' type='submit' name='submit' value='Sign_in'>Ingresar</button>
					</div>
				</div>
	 		</form>
	 	</div>
	 	<div class='col-md-6'>
	 		<div class='jumbotron'>
	 			<h1>¡Bienvenido!</h1>
	 			<p>
	 				Este es el portal de administración del curso de los Talleres Infantiles Católicos.
	 			</p>
	 		</div>
	 	</div>
 	</div>
</div>