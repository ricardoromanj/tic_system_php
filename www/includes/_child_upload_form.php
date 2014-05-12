<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="child_id" name="child_id" value="<?= $child['child_id'] ?>">
	<input type="hidden" id="edit_child_picture" name="edit_child_picture" value="edit_child_picture">
	<div class="form-group">
	    <label for="child_picture_new" class="col-sm-3 control-label">Seleccione el archivo:</label>
	    <div class="col-sm-9">
	    	<input type="file" id="child_picture_new" name="child_picture_new">
	    	<p class="help-block">Seleccione la imagen para usar como perfil, de preferencia mantenga un tamaño de 140 x 140 pixeles.</p>
	    </div>
  	</div>
  	<div class="form-group">
  		<div class="col-sm-9 col-sm-offset-3">
  			<button type="submit" class="btn btn-success">Enviar imagen</button>
  		</div>
  	</div>
</form>