<tr>
	<? 
		$tutor_name_str = $childtutor_row['tutor_lastname'].( $childtutor_row['tutor_second_lastname'] ? " ".$childtutor_row['tutor_second_lastname'].", " : ", " ).$childtutor_row['tutor_name'].( $childtutor_row['tutor_second_name'] ? " ".$childtutor_row['tutor_second_name'] : "" );
	?>
	<td><?= $tutor_name_str; ?></td>
	<td class="text-center">
		<a href="#child_unassign_tutor_modal_<?= $childtutor_row['childtutor_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-remove"></span></a>
		<? // Unassign tutor modal ?>
		<div class="modal fade" id="child_unassign_tutor_modal_<?= $childtutor_row['childtutor_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="child_unassign_tutor_modal_label_<?= $childtutor_row['childtutor_id']; ?>" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title" id="child_unassign_tutor_modal_label_<?= $childtutor_row['childtutor_id']; ?>">Desasignar como tutor a <?= $tutor_name_str; ?> </h3>
		      </div> <? // Close modal header ?>
		      <div class="modal-body">
		      	<br>
		        <p class="lead">Desea desasignar como tutor de <?= $child['child_lastname'].", ".$child['child_name']; ?> a <?= $tutor_name_str; ?>?</p>
		      </div> <? // Close modal body ?>
		      <div class="modal-footer">
		      	<a href="<? $_PHP_SELF ?>?unassign_child_tutor=true&childtutor_id=<?= $childtutor_row['childtutor_id']; ?>&child_id=<?= $child['child_id']; ?>" class="btn btn-warning pull-left">Desasignar</a>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div> <? // Close modal footer ?>
		    </div><? // Close modal content ?>
		  </div> <? // Close modal dialog ?>
		</div> <? // Close modal ?>
	</td>
</tr>