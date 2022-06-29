<?php

$footerNav = Config::get('footerNav', 'navigation');
$mediaNav = Config::get('mediaNav', 'navigation');
$particles = Config::get('particles');

$footer = Config::get('footer');

?>
		<input type="text" id="ipServer" value="<?php echo $minecraftServer['ip']; ?>"/>
		
		<div class="footer-premium">
			<div class="container">
				<div class="footer-premium-flex">
					<div class="col-footer">
						<h3><i class="fas fa-caret-square-right"></i> About us</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum corporis eum quidem voluptate incidunt ab quisquam iste maiores vero, est labore cumque delectus odit, dolor ex earum accusamus aspernatur voluptatibus.</p>
					</div>
					<div class="col-footer">
						<h3><i class="fas fa-info-circle"></i> Other Links</h3>
						<ul>
							<?php foreach ($footerNav as $nav) { ?>
								<li>
									<a href="<?php echo $nav['link']; ?>" target="<?php echo $nav['target']; ?>"><?php echo $nav['icon']; ?><?php echo $nav['title']; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="col-footer">
						<h3><i class="fas fa-hand-holding-usd"></i> Support the server</h3>
						<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia sequi possimus animi nemo? Placeat sed voluptate earum possimus hic veniam repellendus quod voluptas, doloremque molestias itaque, a, deleniti dolores est!</p>
						<a href="#" class="footer-store">Go to Store</a>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<div class="footer-copyright-flex">
						<p id="copyright_server_minecraft"><?php echo $footer['copyright']; ?></p>
						<a href="<?php echo $discordServer['inviteLink']; ?>">
							<img src="<?php echo $footer['icon']; ?>" style="width: 20px;">
						</a>
						<ul>
							<?php foreach ($mediaNav as $nav) { ?>
								<li>
									<a href="<?php echo $nav['link']; ?>" target="<?php echo $nav['target']; ?>"><?php echo $nav['icon']; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>

	<button class="mergisus" style="display: inline-block;">
		<span></span>
	</button>

	<script type="text/javascript">
		var player = "<?php echo $minecraftServer['ip']; ?>";
		var port = "<?php echo $minecraftServer['port']; ?>";
		var raspuns_reload = "<?php echo ($minecraftServer['refresh'] ? 'yes' : 'no'); ?>";
		var discord_widget = "<?php echo $discordServer['id']; ?>";
		var particle_color = "<?php echo $particles['color']; ?>";
		var result_count = "<?php echo Config::get('resultsCount'); ?>";
	</script>

	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
	<script src="<?php echo URL::buildStatic('/assets/js/script.js'); ?>"></script>

</body>

</html>