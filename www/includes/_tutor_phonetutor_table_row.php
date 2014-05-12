<tr>
	<td><?= $phonetutor_row['phonetutor_number']; ?></td>
	<td>
		<?
		 	if ($phonetutor_row['phonetutor_type']=="mobile") {
		 		?><span class="glyphicon glyphicon-phone"></span><?
		 	} elseif ($phonetutor_row['phonetutor_type']=="work") {
		 		?><span class="glyphicon glyphicon-briefcase"></span><?
		 	} else {
		 		?><span class="glyphicon glyphicon-earphone"></span><?
		 	}
		?>
	</td>
	<td class="text-center">
		<a href="#phonetutor_edit_<?= $phonetutor_row['phonetutor_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-file"></span></a>
		<a href="#phonetutor_confirm_delete_<?= $phonetutor_row['phonetutor_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-remove"></span></a>
		<? // Edit modal ?>
		<div class="modal fade" id="phonetutor_edit_<?= $phonetutor_row['phonetutor_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tutor_edit_form_modal_label" aria-hidden="true">
		 	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h3 class="modal-title" id="tutor_edit_form_modal_label">Editar teléfono</h3>
		      		</div> <? // Close modal header ?>
		      		<div class="modal-body">
		      			<br>
		        		<? include 'includes/_tutor_phonetutor_edit_form.php'; ?>
		      		</div> <? // Close modal body ?>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      		</div> <? // Close modal footer ?>
		    		</div><? // Close modal content ?>
		  		</div> <? // Close modal dialog ?>
			</div> <? // Close modal ?>
		<? // Delete modal ?> 
		<div class="modal fade" id="phonetutor_confirm_delete_<?= $phonetutor_row['phonetutor_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tutor_new_form_modal_label" aria-hidden="true">
		  	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h3 class="modal-title text-danger" id="tutor_new_form_modal_label">¡Alerta!</h3>
		      		</div> <? // Close modal header ?>
		      		<div class="modal-body">
		      			<p class="lead">¿Realmente desea borrar el teléfono <?= $phonetutor_row['phonetutor_number']; ?>?</p>
		      			<br>
		      			<form class="form-inline" role="form" method="POST" action="<?php $_PHP_SELF ?>">
		      				<input type="text" id="phonetutor_delete" name="phonetutor_delete" value="phonetutor_delete" style="display: none;">
		        			<input type="text" id="phonetutor_id" name="phonetutor_id" value="<?= $phonetutor_row['phonetutor_id']; ?>" style="display: none;">
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