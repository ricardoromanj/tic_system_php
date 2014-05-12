<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="child_edit" name="child_edit" value="child_edit">
	<input type="hidden" id="child_id" name="child_id" value="<?= $child['child_id']; ?>">
	<div class="form-group">
		<label for="child_new_name" class="col-sm-3 control-label">Nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_name" name="child_new_name" placeholder="Nombre" value="<?= $child['child_name']; ?>" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_second_name" class="col-sm-3 control-label">Segundo nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_second_name" name="child_new_second_name" placeholder="Segundo nombre" value="<?= $child['child_second_name']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_lastname" class="col-sm-3 control-label">Apellido paterno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_lastname" name="child_new_lastname" placeholder="Apellido paterno" value="<?= $child['child_lastname']; ?>" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_second_lastname" class="col-sm-3 control-label">Apellido materno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_second_lastname" name="child_new_second_lastname" value="<?= $child['child_second_lastname']; ?>" placeholder="Apellido materno">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_gender" class="col-sm-3 control-label">Género:</label>
		<div class="col-sm-2">
			<select class="form-control" id="child_new_gender" name="child_new_gender">
				<option <?= ($child['child_name']=="M" ? "selected='selected'" : ""); ?> value="M">H</option>
				<option <?= ($child['child_name']=="F" ? "selected='selected'" : ""); ?> value="F">M</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_birthdate" class="col-sm-3 control-label">Fecha de nacimiento:</label>
		<div class="col-sm-5">
			<input type="text" required="true" class="form-control datepicker-tic" id="child_new_birthdate" name="child_new_birthdate" value="<?= $child['child_birthdate']; ?>" placeholder="aaaa-mm-dd">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_allergies" class="col-sm-3 control-label">Alergias:</label>
		<div class="col-sm-5">
			<textarea required="true" class="form-control" id="child_new_allergies" name="child_new_allergies" style="resize: none;" required="true"><?= $child['child_allergies']; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_medical_notes" class="col-sm-3 control-label">Notas médicas:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="child_new_medical_notes" name="child_new_medical_notes" style="resize: none;"><?= $child['child_medical_notes']; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_general_notes" class="col-sm-3 control-label">Notas generales:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="child_new_general_notes" name="child_new_general_notes" style="resize: none;"><?= $child['child_general_notes']; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-3">
			<input type="submit" value="Guardar información" class="btn btn-success btn-block">
		</div>
	</div>
</form>
<script language='Javascript' type='text/javascript'>
	$( document ).ready(function() {
		$('.datepicker-tic').datepicker({
			format: "yyyy-mm-dd"
		});
	});
</script>