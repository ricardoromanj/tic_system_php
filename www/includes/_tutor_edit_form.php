<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="tutor_edit" name="tutor_edit" value="tutor_edit">
	<input type="hidden" id="tutor_id" name="tutor_id" value="<?= $tutor['tutor_id'] ?>">
	<div class="form-group">
		<label for="tutor_new_name" class="col-sm-3 control-label">Nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_name" name="tutor_new_name" value="<?= $tutor['tutor_name']; ?>" placeholder="Nombre" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_second_name" class="col-sm-3 control-label">Segundo nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_second_name" name="tutor_new_second_name" value="<?= $tutor['tutor_second_name']; ?>" placeholder="Segundo nombre">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_lastname" class="col-sm-3 control-label">Apellido paterno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_lastname" name="tutor_new_lastname" value="<?= $tutor['tutor_lastname']; ?>" placeholder="Apellido paterno" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_second_lastname" class="col-sm-3 control-label">Apellido materno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_second_lastname" name="tutor_new_second_lastname" value="<?= $tutor['tutor_second_lastname']; ?>" placeholder="Apellido materno">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_gender" class="col-sm-3 control-label">Género:</label>
		<div class="col-sm-2">
			<select class="form-control" id="tutor_new_gender" name="tutor_new_gender">
				<option <?= $tutor['tutor_gender']=="M" ? "selected='selected'" : ""; ?> value="M">H</option>
				<option <?= $tutor['tutor_gender']=="F" ? "selected='selected'" : ""; ?> value="F">M</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_role" class="col-sm-3 control-label">Rol del tutor:</label>
		<div class="col-sm-5">
			<select class="form-control" id="tutor_new_role" name="tutor_new_role">
				<option <?= $tutor['tutor_role']=="father" ? "selected='selected'" : ""; ?> value="father">Papá</option>
				<option <?= $tutor['tutor_role']=="mother" ? "selected='selected'" : ""; ?> value="mother">Mamá</option>
				<option <?= $tutor['tutor_role']=="godfathermother" ? "selected='selected'" : ""; ?> value="godfathermother">Padrino(a)</option>
				<option <?= $tutor['tutor_role']=="grandfathermother" ? "selected='selected'" : ""; ?> value="grandfathermother">Abuelo(a)</option>
				<option <?= $tutor['tutor_role']=="uncleaunt" ? "selected='selected'" : ""; ?> value="uncleaunt">Tío(a)</option>
				<option <?= $tutor['tutor_role']=="neighbor" ? "selected='selected'" : ""; ?> value="neighbor">Vecino(a)</option>
				<option <?= $tutor['tutor_role']=="other" ? "selected='selected'" : ""; ?> value="other">Otro(a)</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_notes" class="col-sm-3 control-label">Notas:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="tutor_new_notes" value="<?= $tutor['tutor_notes']; ?>" name="tutor_new_notes" style="resize: none;"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-3">
			<input type="submit" value="Guardar cambios" class="btn btn-success btn-block">
		</div>
	</div>
</form>