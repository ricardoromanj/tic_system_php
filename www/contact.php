<?php

require 'includes/constants.php';

// Start with header and title
$page_title = 'Contacto';
$page_active = 'contact';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';
?>

<div class='container'>
	<br>
	<div class="row">
		<div class="col-md-2">
			<img class="img-circle" alt="" src="assets/img/dudas.png" style="width: 140px; height: 140px;">
		</div>
		<div class="col-md-10">
			<h1>¿Necesitas ayuda?</h1>
			<hr>
			<p class="lead">Estamos a tus órdenes, por favor contáctanos en:</p>
			<p class="lead"><a href="mailto:padres@ticnsp.org">padres@ticnsp.org</a></p>
		</div>
</div>

<? // Footer
include 'includes/_footer.php';
?>