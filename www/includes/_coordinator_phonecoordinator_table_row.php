<tr>
	<td><?= $phonecoordinator_row['phonecoordinator_number']; ?></td>
	<td>
		<?
		 	if ($phonecoordinator_row['phonecoordinator_type']=="mobile") {
		 		?><span class="glyphicon glyphicon-phone"></span><?
		 	} elseif ($phonecoordinator_row['phonecoordinator_type']=="work") {
		 		?><span class="glyphicon glyphicon-briefcase"></span><?
		 	} else {
		 		?><span class="glyphicon glyphicon-earphone"></span><?
		 	}
		?>
	</td>
	<td class="text-center">
		<a href="#phonecoordinator_edit_<?= $phonecoordinator_row['phonecoordinator_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-file"></span>
</a>
		<a href="#phonecoordinator_confirm_delete_<?= $phonecoordinator_row['phonecoordinator_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-remove"></span></a>
		<? // Edit modal ?>
		<div class="modal fade" id="phonecoordinator_edit_<?= $phonecoordinator_row['phonecoordinator_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="coordinator_edit_form_modal_label" aria-hidden="true">
		 	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h3 class="modal-title" id="coordinator_edit_form_modal_label">Editar teléfono</h3>
		      		</div> <? // Close modal header ?>
		      		<div class="modal-body">
		      			<br>
		        		<? include 'includes/_coordinator_phonecoordinator_edit_form.php'; ?>
		      		</div> <? // Close modal body ?>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      		</div> <? // Close modal footer ?>
		    		</div><? // Close modal content ?>
		  		</div> <? // Close modal dialog ?>
			</div> <? // Close modal ?>
		<? // Delete modal ?> 
		<div class="modal fade" id="phonecoordinator_confirm_delete_<?= $phonecoordinator_row['phonecoordinator_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="coordinator_new_form_modal_label" aria-hidden="true">
		  	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h3 class="modal-title text-danger" id="coordinator_new_form_modal_label">¡Alerta!</h3>
		      		</div> <? // Close modal header ?>
		      		<div class="modal-body">
		      			<p class="lead">¿Realmente desea borrar el teléfono <?= $phonecoordinator_row['phonecoordinator_number']; ?>?</p>
		      			<br>
		      			<form class="form-inline" role="form" method="POST" action="<?php $_PHP_SELF ?>">
		      				<input type="text" id="phonecoordinator_delete" name="phonecoordinator_delete" value="phonecoordinator_delete" style="display: none;">
		        			<input type="text" id="phonecoordinator_id" name="phonecoordinator_id" value="<?= $phonecoordinator_row['phonecoordinator_id']; ?>" style="display: none;">
		        			<button type="submit" class="btn btn-danger pull-left">Borrar teléfono</button>
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