<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="tutor_new" name="tutor_new" value="tutor_new">
	<legend>Información del tutor</legend>
	<div class="form-group">
		<label for="tutor_new_name" class="col-sm-3 control-label">Nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_name" name="tutor_new_name" placeholder="Nombre" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_second_name" class="col-sm-3 control-label">Segundo nombre</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_second_name" name="tutor_new_second_name" placeholder="Segundo nombre">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_lastname" class="col-sm-3 control-label">Apellido paterno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_lastname" name="tutor_new_lastname" placeholder="Apellido paterno" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_second_lastname" class="col-sm-3 control-label">Apellido materno</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="tutor_new_second_lastname" name="tutor_new_second_lastname" placeholder="Apellido materno">
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_gender" class="col-sm-3 control-label">Género:</label>
		<div class="col-sm-2">
			<select class="form-control" id="tutor_new_gender" name="tutor_new_gender">
				<option value="M">H</option>
				<option value="F">M</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_role" class="col-sm-3 control-label">Rol del tutor:</label>
		<div class="col-sm-5">
			<select class="form-control" id="tutor_new_role" name="tutor_new_role">
				<option value="father">Papá</option>
				<option value="mother">Mamá</option>
				<option value="godfathermother">Padrino(a)</option>
				<option value="grandfathermother">Abuelo(a)</option>
				<option value="uncleaunt">Tío(a)</option>
				<option value="neighbor">Vecino(a)</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="tutor_new_createuser" id="tutor_new_createuser" value="1">  Crear usuario de sistema TIC
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="tutor_new_notes" class="col-sm-3 control-label">Notas:</label>
		<div class="col-sm-5">
			<textarea class="form-control" id="tutor_new_notes" name="tutor_new_notes" style="resize: none;"></textarea>
		</div>
	</div>
	<legend>Información de contacto</legend>
	<div id="tutor_new_phones_div"> 
		<div class="form-group">
			<label for="tutor_new_phone" class="col-sm-3 control-label">Teléfono:</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="tutor_new_phone" name="tutor_new_phone_number[]" placeholder="----------">
			</div>
			<div class="col-sm-3">
				<select class="form-control" name="tutor_new_phone_type">
					<option value="home">Domicilio</option>
					<option value="work">Oficina</option>
					<option value="mobile">Celular</option>
				</select>
			</div>
			<div class="col-sm-3">
				<a class="btn btn-default" href="#" id="add_phone_form">Agregar otro</a>
			</div>
		</div>
	</div>
	<div id="tutor_new_emails_div"> 
		<div class="form-group">
			<label for="tutor_email_phone" class="col-sm-3 control-label">e-mail:</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="tutor_new_email" name="tutor_new_email_address[]" placeholder="----------">
			</div>
			<div class="col-sm-3">
				<select class="form-control" name="tutor_new_email_type">
					<option value="home">Domicilio</option>
					<option value="work">Oficina</option>
				</select>
			</div>
			<div class="col-sm-3">
				<a class="btn btn-default" href="#" id="add_email_form">Agregar otro</a>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-5">
			<input type="submit" value="Guardar" class="btn btn-primary">
		</div>
	</div>
</form>
<script>
	var phones_wrapper = $("#tutor_new_phones_div");
	var emails_wrapper = $("#tutor_new_emails_div");
	var add_form_phone = $("#add_phone_form");
	var add_form_email = $("#add_email_form");
	var phone_index = 0;
	var email_index = 0;

	var get_form_phone = function(index) {
	    return $('\
	    	<div class="form-group">\
				<label for="tutor_new_phone_'+index+'" class="col-sm-3 control-label">Teléfono:</label>\
				<div class="col-sm-3">\
					<input type="text" class="form-control" id="tutor_new_phone_'+index+'" name="tutor_new_phone_number[]" placeholder="----------">\
				</div>\
				<div class="col-sm-3">\
					<select class="form-control" name="tutor_new_phone_type_'+index+'">\
						<option value="home">Domicilio</option>\
						<option value="work">Oficina</option>\
						<option value="mobile">Celular</option>\
					</select>\
				</div>\
				<a href="#" class="remove close pull-left">&times;</a>\
			</div>\
	    ');
	}

	var get_form_email = function(index) {
		return $('\
			<div class="form-group">\
				<label for="tutor_new_email_'+index+'" class="col-sm-3 control-label">e-mail:</label>\
				<div class="col-sm-3">\
					<input type="text" class="form-control" id="tutor_new_email_'+index+'" name="tutor_new_email_address[]" placeholder="----------">\
				</div>\
				<div class="col-sm-3">\
					<select class="form-control" name="tutor_new_email_type_'+index+'">\
						<option value="home">Domicilio</option>\
						<option value="work">Oficina</option>\
					</select>\
				</div>\
				<a href="#" class="remove close pull-left">&times;</a>\
			</div>\
			')
	}

	add_form_phone.on("click", function() {
	    var form = get_form_phone(phone_index);
	    form.find(".remove").on("click", function() {
	    	phone_index -= 1;
	       $(this).parent().remove();
	    });
	    if (phone_index<2) {
	    	phone_index += 1
	    	phones_wrapper.append(form);
		}
	});

	add_form_email.on("click", function() {
		var form = get_form_email(email_index);
	    form.find(".remove").on("click", function() {
	    	email_index -= 1;
	       $(this).parent().remove();
	    });
	    if (email_index<2) {
	    	email_index += 1
	    	emails_wrapper.append(form);
		}
	});
</script>