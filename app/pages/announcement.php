<?php

if (count($routeBits) < 2) {
	URL::redirect(404);
}

$announcement = Queries::getFirst('announcements', ['id' => $routeBits[1]]);
if (!$announcement) {
	URL::redirect(404);
}

$pageTitle = $announcement->contentTitle;
require('_header.php');

?>

<div class="container">
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
			<p><?php echo $announcement->contentDescription; ?></p>
		</div>
	</div>
</div>

<?php

require('_footer.php');