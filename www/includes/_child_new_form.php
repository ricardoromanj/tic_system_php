<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="child_new" name="child_new" value="child_new">
	<div class="form-group">
		<label for="child_new_name" class="col-sm-3 control-label">Nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_name" name="child_new_name" placeholder="Nombre" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_second_name" class="col-sm-3 control-label">Segundo nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_second_name" name="child_new_second_name" placeholder="Segundo nombre">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_lastname" class="col-sm-3 control-label">Apellido paterno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_lastname" name="child_new_lastname" placeholder="Apellido paterno" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_second_lastname" class="col-sm-3 control-label">Apellido materno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_second_lastname" name="child_new_second_lastname" placeholder="Apellido materno">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_gender" class="col-sm-3 control-label">Género:</label>
		<div class="col-sm-2">
			<select class="form-control" id="child_new_gender" name="child_new_gender">
				<option value="M">H</option>
				<option value="F">M</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_birthdate" class="col-sm-3 control-label">Fecha de nacimiento:</label>
		<div class="col-sm-5">
			<input type="text" required="true" class="form-control datepicker-tic" id="child_new_birthdate" name="child_new_birthdate" placeholder="aaaa-mm-dd">
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_allergies" class="col-sm-3 control-label">Alergias:</label>
		<div class="col-sm-5">
			<textarea required="true" class="form-control" id="child_new_allergies" name="child_new_allergies" style="resize: none;"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_medical_notes" class="col-sm-3 control-label">Notas médicas:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="child_new_medical_notes" name="child_new_medical_notes" style="resize: none;"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="child_new_general_notes" class="col-sm-3 control-label">Notas generales:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="child_new_general_notes" name="child_new_general_notes" style="resize: none;"></textarea>
		</div>
	</div>
	<legend>Tutores</legend>
	<div id="child_new_tutors_div"> 
		<div class="form-group">
			<label for="child_new_tutor" class="col-sm-3 control-label">Tutor:</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="child_new_tutor" name="child_new_tutor[]" placeholder="Nombre de tutor" data-provide="typeahead" data-items="5" data-source='<?= get_tutors_for_typeahead($con); ?>'>
			</div>
			<div class="col-sm-3">
				<a class="btn btn-default" href="#" id="add_tutor_form">Agregar otro</a>
			</div>
		</div>
	</div>
	<hr>
	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-3">
			<input type="submit" value="Inscribir niño" class="btn btn-success btn-block">
		</div>
	</div>
</form>
<script language='Javascript' type='text/javascript'>
	var tutors_wrapper = $("#child_new_tutors_div");
	var add_form_tutor = $("#add_tutor_form");
	var tutor_index = 0;

	var get_form_tutor = function(index) {
	    return $('\
	    	<div class="form-group">\
				<label for="child_new_tutor_'+index+'" class="col-sm-3 control-label">Tutor:</label>\
				<div class="col-sm-5">\
					<input type="text" class="form-control" id="child_new_tutor_'+index+'" name="child_new_tutor[]" placeholder="Nombre de tutor" data-provide="typeahead" data-items="5" data-source=\'<?= get_tutors_for_typeahead($con); ?>\'>\
				</div>\
				<a href="#" class="remove close pull-left">&times;</a>\
			</div>\
	    ');
	}
	add_form_tutor.on("click", function() {
	    var form = get_form_tutor(tutor_index);
	    form.find(".remove").on("click", function() {
	    	tutor_index -= 1;
	       $(this).parent().remove();
	    });
	    if (tutor_index<2) {
	    	tutor_index += 1
	    	tutors_wrapper.append(form);
		}
	});
</script>