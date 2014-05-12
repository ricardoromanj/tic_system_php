<?php
// Start with header and title
$page_title = '404';
include 'includes/_header.php';

// Display the menu according to user type
include 'includes/_menu.php';
?>

<div class='container'>

	<br>
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-2">
				<img class="img-circle" alt="" src="assets/img/TIC_LOGO.jpg" style="width: 140px; height: 140px;">
			</div>
			<div class="col-md-10">
				<h1>404</h1>
				<p class="lead">Lo sentimos, ¡la página solicitada no se ha encontrado!</p>
			</div>
		</div>
	</div>

</div>

<? // Footer
include 'includes/_footer.php';
?>