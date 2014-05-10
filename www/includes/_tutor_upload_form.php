<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="tutor_id" name="tutor_id" value="<?= $tutor['tutor_id'] ?>">
	<input type="hidden" id="edit_tutor_picture" name="edit_tutor_picture" value="edit_tutor_picture">
	<div class="form-group">
	    <label for="tutor_picture_new" class="col-sm-3 control-label">Seleccione el archivo:</label>
	    <div class="col-sm-9">
	    	<input type="file" id="tutor_picture_new" name="tutor_picture_new">
	    	<p class="help-block">Seleccione la imagen para usar como perfil, de preferencia mantenga un tamaño de 140 x 140 pixeles.</p>
	    </div>
  	</div>
  	<div class="form-group">
  		<div class="col-sm-9 col-sm-offset-3">
  			<button type="submit" class="btn btn-success">Enviar imagen</button>
  		</div>
  	</div>
</form>