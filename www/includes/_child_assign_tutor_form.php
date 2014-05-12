<form class="form-horizontal" role="form" action="<? $_PHP_SELF ?>" method="POST">
	<input type="hidden" id="assign_child_tutor" name="assign_child_tutor" value="assign_child_tutor">
	<input type="hidden" id="child_id" name="child_id" value="<?= $child['child_id']; ?>">
	<div class="form-group">
		<label for="child_new_tutor" class="col-sm-3 control-label">Tutor:</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="child_new_tutor" name="child_new_tutor" placeholder="Nombre de tutor" data-provide="typeahead" data-items="5" data-source='<?= get_tutors_for_typeahead($con); ?>'>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-3">
			<button type="submit" class="btn btn-success">Asignar tutor</button>
		</div>
	</div>
</form>