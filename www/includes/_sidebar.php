<div class="tic-sidemenu">
	<ul class="nav nav-pills affix col-sm-1 nav-stacked" role="navigation" data-spy="affix" >
		<li <? echo $page_active=='announcements' ? 'class="active"' : ''; ?> ><a href='announcements.php'>Avisos</a></li>
		<li <? echo $page_active=='children' ? 'class="active"' : ''; ?> ><a href='children.php'>Niños inscritos</a></li>
		<?  
			// Menu for coordinator
			if (($_COOKIE['user_type']==COORDINATOR_STRING) || ($_COOKIE['user_type']==ADMINISTRATOR_STRING)) {
		?>
				<li <? echo $page_active=='tutors' ? 'class="active"' : ''; ?> ><a href='tutors.php'>Tutores</a></li>
		<? 
			} 
			// Menu for admin
			if ($_COOKIE['user_type']==ADMINISTRATOR_STRING) {
		?>
				<li <? echo $page_active=='coordinators' ? 'class="active"' : ''; ?> ><a href='coordinators.php'>Coordinadores</a></li>
				<!-- <li <? echo $page_active=='semester_administration' ? 'class="active"' : ''; ?> ><a href='#'>Administración Semestral</a></li> -->
		<?
			}
		?>
	</ul>
</div>