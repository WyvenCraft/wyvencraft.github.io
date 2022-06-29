<?php

require('_header.php');

$updates = Queries::orderAll('updates', 'id', 'DESC');

?>

<div class="container">
	<div class="triplezone-update-logs">
		<div class="triplezone-update-header">
			<h2>Update Logs</h2>
			<hr class="modul-hr">
		</div>
		<div class="triplezone-update-body">
		<?php if (!empty($updates)) { ?>
		<?php foreach ($updates as $update) { ?>
				<div class="triplezone-update-col continut">
					<p><?php echo $update->title; ?></p>
					<ul class="update-col">
					<p><i class="fas fa-folder-open"></i> <?php echo $update->update_server; ?></p>
					<p><i class="fas fa-user"></i> <?php echo $update->author; ?></p>
					<p><i class="fas fa-clock"></i> <?php echo date('d M Y', $update->createdAt); ?></p>
					</ul>
				</div>
		<?php } ?>
		<?php } 
		else { 
			echo("<div class='embed-error-updates'><p>No updates currently exist..</p></div>"); 
		} ?>
		<?php if (!empty($updates)) { ?>
			<div class="arata-mai-mult" style="margin-top: 10px;">
				<a href="#" id="arata-mult">Load more</a>
			</div>  
		<?php } ?>        
		</div>
	</div>
</div>

<?php

require('_footer.php');