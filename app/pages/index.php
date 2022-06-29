<?php

require('_header.php');

// $announcements = Config::get('announcements', 'announcements');
$announcements = Queries::orderAll('announcements', 'id', 'DESC');

?>

<div class="container">
	<?php if (!empty($announcements)) { ?>
	<?php foreach ($announcements as $announcement) { ?>
		<div class="anunt-catalin continut">
			<div class="header-anunt">
				<ul class="date">
					<li>
						<p><?php echo date('M', $announcement->createdAt); ?></p>
					</li>
					<li>
						<p><?php echo date('d', $announcement->createdAt); ?></p>
					</li>
				</ul>
				<ul class="informations">
					<li>
						<h3><?php echo $announcement->title; ?></h3>
					</li>
					<li>
						<p><?php echo $announcement->description; ?></p>
					</li>
				</ul>
			</div>
			<div class="anunt-scris">
				<h3><?php echo $announcement->contentTitle; ?></h3>
				<p><?php echo Util::truncate($announcement->contentDescription); ?></p>
			</div>
			<div class="footer-anunt">
				<a href="<?php echo URL::build('/announcement/' . $announcement->id); ?>">
					<i class="fas fa-book"></i> Keep reading
				</a>
			</div>
		</div>
	<?php } ?>
	<?php } 
    else { 
        echo("<div class='embed-error'><p>No announcements currently exist..</p></div>"); 
    } ?>
	<?php if (!empty($announcements)) { ?>
	<div class="arata-mai-mult">
		<a href="#" id="arata-mult">Load More</a>
	</div>
	<?php } ?>
</div>

<?php

require('_footer.php');