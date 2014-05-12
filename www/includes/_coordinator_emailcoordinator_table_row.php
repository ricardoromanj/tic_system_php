<tr>
	<td><?= $emailcoordinator_row['emailcoordinator_address']; ?></td>
	<td>
		<?
		 	if ($emailcoordinator_row['emailcoordinator_type']=="work") {
		 		?><span class="glyphicon glyphicon-briefcase"></span><?
		 	} else {
		 		?><span class="glyphicon glyphicon-send"></span><?
		 	}
		?>
	</td>
	<td class="text-center">
		<a href="#emailcoordinator_edit_<?= $emailcoordinator_row['emailcoordinator_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-file"></span>
</a>
		<a href="#emailcoordinator_confirm_delete_<?= $emailcoordinator_row['emailcoordinator_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-remove"></span></a>
		<? // Edit modal ?>
		<div class="modal fade" id="emailcoordinator_edit_<?= $emailcoordinator_row['emailcoordinator_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
		 	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h3 class="modal-title" id="emailcoordinator_edit_form_modal_label">Editar correo electrónico</h3>
		      		</div> <? // Close modal header ?>
		      		<div class="modal-body">
		      			<br>
		        		<? include 'includes/_coordinator_emailcoordinator_edit_form.php'; ?>
		      		</div> <? // Close modal body ?>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      		</div> <? // Close modal footer ?>
		    		</div><? // Close modal content ?>
		  		</div> <? // Close modal dialog ?>
			</div> <? // Close modal ?>
		<? // Delete modal ?> 
		<div class="modal fade" id="emailcoordinator_confirm_delete_<?= $emailcoordinator_row['emailcoordinator_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="coordinator_new_form_modal_label" aria-hidden="true">
		  	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h3 class="modal-title text-danger" id="coordinator_new_form_modal_label">¡Alerta!</h3>
		      		</div> <? // Close modal header ?>
		      		<div class="modal-body">
		      			<h4>¿Realmente desea borrar el correo <?= $emailcoordinator_row['emailcoordinator_address']; ?>?</h4>
		      			<br>
		      			<form class="form-inline" role="form" method="POST" action="<?php $_PHP_SELF ?>">
		      				<input type="text" id="emailcoordinator_delete" name="emailcoordinator_delete" value="emailcoordinator_delete" style="display: none;">
		        			<input type="text" id="emailcoordinator_id" name="emailcoordinator_id" value="<?= $emailcoordinator_row['emailcoordinator_id']; ?>" style="display: none;">
		        			<button type="submit" class="btn btn-danger pull-left">Borrar correo electrónico</button>
		        			<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
		    			</form>
		    			<br>
		    			<br>
		      		</div> <? // Close modal body ?> 
			    </div><? // Close modal content ?>
			</div> <? // Close modal dialog ?>
		</div> <? // Close modal ?>
	</td>
</tr>