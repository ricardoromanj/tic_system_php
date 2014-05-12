<form class="form-inline" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="coordinator_id" name="coordinator_id" value="<?= $coordinator['coordinator_id'] ?>">
	<input type="hidden" id="emailcoordinator_add" name="emailcoordinator_add" value="emailcoordinator_add">
	<input class="form-control" type="text" name="emailcoordinator_new_address" value="<?= $emailcoordinator_row['emailcoordinator_address']; ?>" placeholder="email@example.com" required="true">
	<select class="form-control" name="emailcoordinator_new_type">
		<option <?= $emailcoordinator_row['emailcoordinator_type']=="home" ? "selected='selected'" : ""; ?> value="home">Domicilio</option>
		<option <?= $emailcoordinator_row['emailcoordinator_type']=="work" ? "selected='selected'" : ""; ?> value="work">Oficina</option>
	</select>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
</form>