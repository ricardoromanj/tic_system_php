<div class="panel panel-<? echo $announcement_row['announcement_type'] ? $announcement_row['announcement_type']:"default"; ?>">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#announcements-semestral-accordion" href="#announcement-<? echo $announcement_row['announcement_id']; ?>">
				<strong><? echo $announcement_row['announcement_heading']; ?></strong>
			</a>
		</h4>
	</div>
	<div id="announcement-<? echo $announcement_row['announcement_id']; ?>" class="panel-collapse collapse in">
		<div class="panel-body">
			<strong>Publish date:</strong> <? echo $announcement_row['announcement_date']; ?>
			<? if ($_COOKIE['user_type'] == COORDINATOR_STRING || $_COOKIE['user_type'] == ADMINISTRATOR_STRING) { ?>
				<p><strong>Audience:</strong> <? echo $announcement_row['announcement_audience'] ? ucfirst($announcement_row['announcement_audience']."s"):"All"; ?></p>
			<? } ?>
			<p><? echo $announcement_row['announcement_text']; ?></p>
		</div>
	</div>
</div>