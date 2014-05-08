<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="text" id="announcement_edit" name="announcement_edit" value="announcement_edit" value="announcement_edit" style="display: none;">
	<input type="text" id="announcement_id" name="announcement_id" value="<? echo $announcement_row['announcement_id']; ?>" style="display: none;">
	<div class="form-group">
		<label for="announcement_new_heading" class="col-sm-3 control-label">Encabezado:</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="announcement_new_heading" name="announcement_new_heading" placeholder="Encabezado" required="true" value="<? echo $announcement_row['announcement_heading']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="announcement_new_text" class="col-sm-3 control-label">Contenido:</label>
		<div class="col-sm-7">
			<textarea class="form-control" id="announcement_new_text" name="announcement_new_text" rows="10" cols="40" placeholder="Mensaje" style="resize: none;" required="true"><? echo $announcement_row['announcement_text']; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="announcement_new_audience" class="col-sm-3 control-label">Público:</label>
		<div class="col-sm-5">
			<select class="form-control" id="announcement_new_audience" name="announcement_new_audience" >
				<option <? echo $announcement_row['announcement_audience']=="" ? "selected='true'" : ""; ?> value="">Todos</option>
				<option <? echo $announcement_row['announcement_audience']=="coordinator" ? "selected='true'" : ""; ?> value="coordinator">Coordinadores</option>
				<option <? echo $announcement_row['announcement_audience']=="tutor" ? "selected='true'" : ""; ?> value="tutor">Tutores</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="announcement_new_type" class="col-sm-3 control-label">Tipo:</label>
		<div class="col-sm-5">
			<select class="form-control" id="announcement_new_type" name="announcement_new_type">
				<option <? echo $announcement_row['announcement_type']=="" ? "selected='true'" : ""; ?>value="">Normal</option>
				<option <? echo $announcement_row['announcement_type']=="info" ? "selected='true'" : ""; ?>value="info">Información</option>
				<option <? echo $announcement_row['announcement_type']=="success" ? "selected='true'" : ""; ?>value="success">Éxito</option>
				<option <? echo $announcement_row['announcement_type']=="warning" ? "selected='true'" : ""; ?>value="warning">Advertencia</option>
				<option <? echo $announcement_row['announcement_type']=="danger" ? "selected='true'" : ""; ?>value="danger">Urgencia</option>
			</select>
		</div>
	</div>
	<div class="form-group">
    	<div class="col-sm-offset-3 col-sm-10">
      		<button type="submit" class="btn btn-primary">Guardar cambios</button>
    	</div>
  	</div>
</form>