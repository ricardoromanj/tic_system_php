<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="coordinator_edit" name="coordinator_edit" value="coordinator_edit">
	<input type="hidden" id="coordinator_id" name="coordinator_id" value="<?= $coordinator['coordinator_id'] ?>">
	<div class="form-group">
		<label for="coordinator_new_name" class="col-sm-3 control-label">Nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="coordinator_new_name" name="coordinator_new_name" value="<?= $coordinator['coordinator_name']; ?>" placeholder="Nombre" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="coordinator_new_second_name" class="col-sm-3 control-label">Segundo nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="coordinator_new_second_name" name="coordinator_new_second_name" value="<?= $coordinator['coordinator_second_name']; ?>" placeholder="Segundo nombre">
		</div>
	</div>
	<div class="form-group">
		<label for="coordinator_new_lastname" class="col-sm-3 control-label">Apellido paterno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="coordinator_new_lastname" name="coordinator_new_lastname" value="<?= $coordinator['coordinator_lastname']; ?>" placeholder="Apellido paterno" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="coordinator_new_second_lastname" class="col-sm-3 control-label">Apellido materno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="coordinator_new_second_lastname" name="coordinator_new_second_lastname" value="<?= $coordinator['coordinator_second_lastname']; ?>" placeholder="Apellido materno">
		</div>
	</div>
	<div class="form-group">
		<label for="coordinator_new_gender" class="col-sm-3 control-label">Género:</label>
		<div class="col-sm-2">
			<select class="form-control" id="coordinator_new_gender" name="coordinator_new_gender">
				<option <?= $coordinator['coordinator_gender']=="M" ? "selected='selected'" : ""; ?> value="M">H</option>
				<option <?= $coordinator['coordinator_gender']=="F" ? "selected='selected'" : ""; ?> value="F">M</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="coordinator_new_notes" class="col-sm-3 control-label">Notas:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="coordinator_new_notes" value="<?= $coordinator['coordinator_notes']; ?>" name="coordinator_new_notes" style="resize: none;"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-3">
			<input type="submit" value="Guardar cambios" class="btn btn-success btn-block">
		</div>
	</div>
</form>