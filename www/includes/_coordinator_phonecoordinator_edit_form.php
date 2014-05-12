<form class="form-inline" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="coordinator_id" name="coordinator_id" value="<?= $coordinator['coordinator_id'] ?>">
	<input type="hidden" id="phonecoordinator_edit" name="phonecoordinator_edit" value="phonecoordinator_edit">
	<input type="hidden" id="phonecoordinator_id" name="phonecoordinator_id" value="<?= $phonecoordinator_row['phonecoordinator_id'] ?>">
	<input class="form-control" type="text" name="phonecoordinator_new_phone" value="<?= $phonecoordinator_row['phonecoordinator_number']; ?>" placeholder="6561234567" required="true">
	<select class="form-control" name="phonecoordinator_new_type">
		<option <?= $phonecoordinator_row['phonecoordinator_type']=="home" ? "selected='selected'" : ""; ?> value="home">Domicilio</option>
		<option <?= $phonecoordinator_row['phonecoordinator_type']=="work" ? "selected='selected'" : ""; ?> value="work">Oficina</option>
		<option <?= $phonecoordinator_row['phonecoordinator_type']=="mobile" ? "selected='selected'" : ""; ?> value="mobile">Celular</option>
	</select>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
</form>