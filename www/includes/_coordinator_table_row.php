<tr>
	<td><? echo $coordinator_row['coordinator_id']; ?></td>
	<td>
		<a href="coordinator_detail.php?coordinator_id=<? echo $coordinator_row['coordinator_id']; ?>">
			<? 
				$coordinator_name_str = "";
				$coordinator_name_str .= $coordinator_row['coordinator_lastname'];
				if (isset($coordinator_row['coordinator_second_lastname']) && $coordinator_row['coordinator_second_lastname'] !== "") {
					$coordinator_name_str .= " ".$coordinator_row['coordinator_second_lastname'].", ";
				} else {
					$coordinator_name_str .= ", ";
				}
				$coordinator_name_str .= $coordinator_row['coordinator_name'];
				if (isset($coordinator_row['coordinator_second_name']) && $coordinator_row['coordinator_second_name'] !== "") {
					$coordinator_name_str .= " ".$coordinator_row['coordinator_second_name'];
				}
				echo $coordinator_name_str;
			?>
		</a>
	</td>
	<td>
		<?
			if ($coordinator_row['coordinator_gender'] == 'M') {
				echo 'H';
			} else {
				echo 'M';
			}
		?>
	</td>
	<td><? echo $coordinator_row['coordinator_date_added']; ?></td>
	<td>
		<?
			$coordinator_user_query = "SELECT * FROM user WHERE user.user_id='".$coordinator_row['coordinator_user_id']."'";
			$coordinator_user_result = mysqli_query($con, $coordinator_user_query);
			if (mysqli_num_rows($coordinator_user_result)==1) {
				$coordinator_user_row = mysqli_fetch_array($coordinator_user_result);
				if ($coordinator_user_row['user_active']==1) {
					echo "Sí";
				} else {
					echo "No";
				}
			} else {
				echo "N/A";
			}
		?>
	</td>
	<td>
		<a href="#coordinator_confirm_delete_<?=$coordinator_row['coordinator_id'];?>" class="btn btn-danger btn-xs" data-toggle="modal">BORRAR</a>
		<!-- Modal -->
		<div class="modal fade" id="coordinator_confirm_delete_<?=$coordinator_row['coordinator_id'];?>" tabindex="-1" role="dialog" aria-labelledby="coordinator_new_form_modal_label" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title text-danger" id="coordinator_new_form_modal_label">¡Alerta!</h3>
		      </div> <!-- Close modal header -->
		      <div class="modal-body">
		      	<p class="lead">¿Realmente desea borrar al coordinator <?= $coordinator_name_str; ?>?</p>
		      	<br>
		      	<form class="form-inline" role="form" method="POST" action="<?php $_PHP_SELF ?>">
		      		<input type="text" id="coordinator_delete" name="coordinator_delete" value="coordinator_delete" style="display: none;">
		        	<input type="text" id="coordinator_id" name="coordinator_id" value="<? echo $coordinator_row['coordinator_id']; ?>" style="display: none;">
		        	<button type="submit" class="btn btn-danger pull-left">Borrar coordinator</button>
		        	<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
		    	</form>
		    	<br>
		    	<br>
		      </div> <!-- Close modal body -->
		     
		    </div><!-- Close modal content -->
		  </div> <!-- Close modal dialog -->
		</div> <!-- Close modal -->
	</td>
</tr>