<tr>
	<td class="text-<? echo $announcement_row['announcement_type'] ? $announcement_row['announcement_type']:"muted"; ?>">
		<a href="#announcement_view_modal_<? echo $announcement_row['announcement_id'];?>" data-toggle="modal">
			<? 
				echo (strlen($announcement_row['announcement_heading']) > 25) ? substr($announcement_row['announcement_heading'], 0, 20)."..." : $announcement_row['announcement_heading']; 
			?>
		</a>
	</td>
	<? 
		$query = "SELECT * FROM semester, announcementsemester WHERE announcementsemester.semester_semester_id = semester.semester_id AND announcementsemester.announcement_announcement_id =".$announcement_row['announcement_id'];
		$semester_result = mysqli_query($con, $query);
		$semester_row = mysqli_fetch_array($semester_result);
	?>
	<td class="text-<? echo $announcement_row['announcement_type'] ? $announcement_row['announcement_type']:"muted"; ?>"><? echo $semester_row['semester_name']; ?></td>
	<td class="text-<? echo $announcement_row['announcement_type'] ? $announcement_row['announcement_type']:"muted"; ?>"><? echo $announcement_row['announcement_date']; ?></td>
	<td class="text-<? echo $announcement_row['announcement_type'] ? $announcement_row['announcement_type']:"muted"; ?>"><? echo $announcement_row['announcement_audience'] ? ucfirst($announcement_row['announcement_audience']."s"):"All"; ?></td>
	<td>
		<a href="#announcement_delete_confirm_modal_<? echo $announcement_row['announcement_id']; ?>" class="btn btn-danger btn-xs" data-toggle="modal">BORRAR</a>
		<!-- Modal DETAIL -->
		<div class="modal fade" id="announcement_view_modal_<? echo $announcement_row['announcement_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="announcement_view_modal_label_<? echo $announcement_row['announcement_id']; ?>" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title" id="announcement_view_modal_label_<? echo $announcement_row['announcement_id']; ?>">Detalles <? echo $announcement_row['announcement_heading']; ?></h3>
		      </div> <!-- Close modal header -->
		      <div class="modal-body">
		      	<div class="tab-content">
		      		<div class="tab-pane active" id="announcement_<? echo $announcement_row['announcement_id']; ?>_text">
		      			<p><strong>Fecha de publicación: </strong><? echo $announcement_row['announcement_date']; ?> | <? echo $semester_row['semester_name']; ?></p>
		      			<p><strong>Dirigido a: </strong><? echo $announcement_row['announcement_audience']; ?></p>
		      			<p><strong>Contenido: </strong></p>
		      			<p><? echo $announcement_row['announcement_text']; ?></p>
		      			<a class="btn btn-info" href="#announcement_<? echo $announcement_row['announcement_id']; ?>_edit" data-toggle="tab">Editar aviso</a>
		      		</div>
		      		<div class="tab-pane" id="announcement_<? echo $announcement_row['announcement_id']; ?>_edit">
		      			<? include 'includes/_announcement_edit_form.php'; ?>
		      			<a class="btn btn-default" href="#announcement_<? echo $announcement_row['announcement_id']; ?>_text" data-toggle="tab">Cancelar</a>
		      		</div>
		      	</div>
		      	
		      </div> <!-- Close modal body -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div> <!-- Close modal footer -->
		    </div><!-- Close modal content -->
		  </div> <!-- Close modal dialog -->
		</div> <!-- Close modal -->
		<!-- Modal DELETE -->
		<div class="modal fade" id="announcement_delete_confirm_modal_<? echo $announcement_row['announcement_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="announcement_delete_confirm_modal_label_<? echo $announcement_row['announcement_id']; ?>" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title text-danger" id="announcement_delete_confirm_modal_label_<? echo $announcement_row['announcement_id']; ?>">Borrar aviso <? echo $announcement_row['announcement_heading']; ?></h3>
		      </div> <!-- Close modal header -->
		      <div class="modal-body">
		      	<p>¿Realmente desea <strong>borrar</strong> este aviso?</p>
		      	<form class="form-inline" role="form" method="POST" action="<?php $_PHP_SELF ?>">
		      		<input type="text" id="announcement_delete" name="announcement_delete" value="announcement_delete" style="display: none;">
		        	<input type="text" id="announcement_id" name="announcement_id" value="<? echo $announcement_row['announcement_id']; ?>" style="display: none;">
		        	<button type="submit" class="btn btn-danger btn-xs pull-left">Borrar aviso</button>	
		    	</form>
		      </div> <!-- Close modal body -->
		      <div class="modal-footer">
		    	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div> <!-- Close modal footer -->
		    </div><!-- Close modal content -->
		  </div> <!-- Close modal dialog -->
		</div> <!-- Close modal -->
	</td>
</tr>