<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST" remote="true">
	<input type="text" id="announcement_new" name="announcement_new" value="announcement_new" style="display: none;">
	<div class="form-group">
		<label for="announcement_new_heading" class="col-sm-3 control-label">Encabezado:</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="announcement_new_heading" name="announcement_new_heading" placeholder="Encabezado" required="true">
		</div>
	</div>
	<div class="form-group">
		<label for="announcement_new_text" class="col-sm-3 control-label">Contenido:</label>
		<div class="col-sm-7" style="height: 70px;">
			<textarea class="form-control" id="announcement_new_text" name="announcement_new_text" placeholder="Mensaje" style="resize: none;" required="true"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="announcement_new_audience" class="col-sm-3 control-label">Público:</label>
		<div class="col-sm-5">
			<select class="form-control" id="announcement_new_audience" name="announcement_new_audience">
				<option value="">Todos</option>
				<option value="coordinator">Coordinadores</option>
				<option value="tutor">Tutores</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="announcement_new_type" class="col-sm-3 control-label">Tipo:</label>
		<div class="col-sm-5">
			<select class="form-control" id="announcement_new_type" name="announcement_new_type">
				<option value="">Normal</option>
				<option value="info">Información</option>
				<option value="success">Éxito</option>
				<option value="warning">Advertencia</option>
				<option value="danger">Urgencia</option>
			</select>
		</div>
	</div>
	<div class="form-group">
    	<div class="col-sm-offset-3 col-sm-10">
      		<button type="submit" class="btn btn-success">Publicar</button>
    	</div>
  	</div>
</form>