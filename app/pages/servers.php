<?php

$pageTitle = 'Servers';
require('_header.php');

$servers = Config::get('servers', 'servers');

?>

<div class="container">
	<div class="server-list-container">
		<div class="server-list-header">
			<p>Server List</p>
		</div>
		<?php foreach ($servers as $server) { ?>
			<div class="server-list-corp">
				<div class="server-list-stanga">
					<div class="server-logo">
						<img src="<?php echo $server['icon']; ?>" alt="server-icon">
					</div>
				</div>
				<div class="server-list-dreapta">
					<div class="server-list-dreapta-block">
						<h1>
							<?php echo $server['title']; ?>
							<div class="server-cutie-jucatori">
								<span class="jucatori-counter" id="<?php echo $server['id']; ?>"></span> Players online
							</div>
						</h1>
					</div>
					<p class="server-description"><?php echo $server['description']; ?></p>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		<?php foreach ($servers as $server) { ?>
			$.getJSON("https://api.minetools.eu/ping/" + "<?php echo $server['ip']; ?>" + "/" + "<?php echo $server['port']; ?>", function(status) {
				var jucatoriOnline = status.players.online;
				var maxPlayers = " / " + status.players.max;
				$("#<?php echo $server['id']; ?>").html(((jucatoriOnline = jucatoriOnline.toString().split("."))[0] = jucatoriOnline[0].replace(/\B(?=(\d{3})+(?!\d))/g, ","), jucatoriOnline.join(".")));
				$("#<?php echo $server['id']; ?>").append(((maxPlayers = maxPlayers.toString().split("."))[0] = maxPlayers[0].replace(/\B(?=(\d{3})+(?!\d))/g, ","), maxPlayers.join(".")));
			});
		<?php } ?>
	});
</script>

<?php

require('_footer.php');