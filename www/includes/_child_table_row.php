<tr>
	<td><? echo $child_row['child_id']; ?></td>
	<td>
		<a href="child_detail.php?child_id=<? echo $child_row['child_id']; ?>">
			<? 
				$child_name_str = "";
				$child_name_str .= $child_row['child_lastname'];
				if (isset($child_row['child_second_lastname']) && $child_row['child_second_lastname'] !== "") {
					$child_name_str .= " ".$child_row['child_second_lastname'].", ";
				} else {
					$child_name_str .= ", ";
				}
				$child_name_str .= $child_row['child_name'];
				if (isset($child_row['child_second_name']) && $child_row['child_second_name'] !== "") {
					$child_name_str .= " ".$child_row['child_second_name'];
				}
				echo $child_name_str;
			?>
		</a>
	</td>
	<td>
		<?
			if ($child_row['child_gender'] == 'M') {
				echo 'H';
			} else {
				echo 'M';
			}
		?>
	</td>
	<td><? echo $child_row['child_date_added']; ?></td>
	<td><?= ($child_row['child_active']==1 ? "Sí" : "No"); ?></td>
	<td>
		<a href="#child_confirm_delete_<?=$child_row['child_id'];?>" class="btn btn-danger btn-xs" data-toggle="modal">BORRAR</a>
		<!-- Modal -->
		<div class="modal fade" id="child_confirm_delete_<?=$child_row['child_id'];?>" tabindex="-1" role="dialog" aria-labelledby="child_new_form_modal_label" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title text-danger" id="child_new_form_modal_label">¡Alerta!</h3>
		      </div> <!-- Close modal header -->
		      <div class="modal-body">
		      	<p class="lead">¿Realmente desea borrar al niño <?= $child_name_str; ?>?</p>
		      	<br>
		        <a href="children.php?child_delete=true&child_id=<?= $child_row['child_id'] ?>" class="btn btn-danger pull-left">Borrar niño</a>
		    	<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
		    	<br>
		    	<br>
		      </div> <!-- Close modal body -->
		     
		    </div><!-- Close modal content -->
		  </div> <!-- Close modal dialog -->
		</div> <!-- Close modal -->
	</td>
</tr>