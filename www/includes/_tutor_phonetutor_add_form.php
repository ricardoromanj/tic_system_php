<form class="form-inline" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="tutor_id" name="tutor_id" value="<?= $tutor['tutor_id'] ?>">
	<input type="hidden" id="phonetutor_add" name="phonetutor_add" value="phonetutor_add">
	<input class="form-control" type="text" name="phonetutor_new_phone" value="<?= $phonetutor_row['phonetutor_number']; ?>" placeholder="6561234567" required="true">
	<select class="form-control" name="phonetutor_new_type">
		<option <?= $phonetutor_row['phonetutor_type']=="home" ? "selected='selected'" : ""; ?> value="home">Domicilio</option>
		<option <?= $phonetutor_row['phonetutor_type']=="work" ? "selected='selected'" : ""; ?> value="work">Oficina</option>
		<option <?= $phonetutor_row['phonetutor_type']=="mobile" ? "selected='selected'" : ""; ?> value="mobile">Celular</option>
	</select>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
</form>