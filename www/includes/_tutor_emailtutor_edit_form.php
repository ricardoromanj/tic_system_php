<form class="form-inline" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="tutor_id" name="tutor_id" value="<?= $tutor['tutor_id'] ?>">
	<input type="hidden" id="emailtutor_edit" name="emailtutor_edit" value="emailtutor_edit">
	<input class="form-control" type="text" name="emailtutor_new_address" value="<?= $emailtutor_row['emailtutor_address']; ?>" placeholder="email@example.com" required="true">
	<select class="form-control" name="emailtutor_new_type">
		<option <?= $emailtutor_row['emailtutor_type']=="home" ? "selected='selected'" : ""; ?> value="home">Domicilio</option>
		<option <?= $emailtutor_row['emailtutor_type']=="work" ? "selected='selected'" : ""; ?> value="work">Oficina</option>
	</select>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
</form>