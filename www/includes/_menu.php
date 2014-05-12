<?php

/*
 * _MENU.PHP
 * 
 * DESC: FILE THAT CREATES MENU ACCORDING TO USER TYPE
 *       TO BE INCLUDED
 *       4 TYPES OF MENUBARS:
 * 		 	- LOGGED OUT
 * 			- LOGGED IN TUTOR
 * 			- LOGGED IN COORDINATOR
 * 			- LOGGED IN ADMIN
 * 
 * AUTHOR: RICARDO ROMAN (C) 2014
 * 
 * CHANGE LOG
 * 20140228 - RICARDO ROMAN - FIRST RELEASE
 * 
 */

// Prepare the menubar/navbar. This part of code is used by all navs.
?>
<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
	<div class='container'>
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<a class='navbar-brand' href='index.php'><img src="assets/img/tictelecom_logo_gray.png" width="23px"> ticnsp.org</a>
		</div>
		<div class='collapse navbar-collapse'>
			<? if (isset($_COOKIE['user_id']) && $_SERVER['PHP_SELF'] != 'sign_out.php') { ?>
				<ul class='nav navbar-nav'>
					<li <? echo $page_active=='index' ? 'class="active"' : ''; ?> ><a href='index.php'>Inicio</a></li>
					<li <? echo ($page_active=='announcements' || $page_active=='children_enrolled' || $page_active=='tutors' || $page_active=='coordinators' || $page_active=="semester_administration") ? 'class="active"' : ''; ?> ><a href='announcements.php'>Curso</a></li>
					<li <? echo $page_active=='contact' ? 'class="active"' : ''; ?> ><a href='contact.php'>Ayuda y contacto</a></li>
				</ul>
				<ul class='nav navbar-nav navbar-right'>
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
							<? echo $_COOKIE['user_username']; ?>
							<b class='caret'></b>
						</a>
						<ul class='dropdown-menu'>
							<li><a href='#'>Mi información</a></li>
							<li><a href='sign_out.php'>Cerrar sesión</a></li>
						</ul>
					</li>
				</ul>
			<?	} else { ?>
				<ul class='nav navbar-nav navbar-right'>
					<li <? echo $page_active=='contact' ? 'class="active"' : ''; ?> ><a href='contact.php'>Ayuda y contacto</a></li>
				</ul>
			<? } ?>
		</div>
	</div>
</div>