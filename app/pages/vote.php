<?php

$pageTitle = 'Vote';
require('_header.php');

$voteSites = Config::get('voteSites', 'votes');
$voteRewards = Config::get('voteRewards', 'votes');

?>

<div class="container">
	<div class="vote-content">
		<div class="vote-big-box" id="vote-big-box">
			<h3 class="vote-title">Vote Rewards</h3>
			<p>
				Voting daily for our servers helps us become ranked higher and attract more players!
				<br />
				To vote for the server, visit one of the links on the right and enter your Minecraft username.
				<br />
				You will automatically be rewarded in-game!
			</p>
			<div class="vote-rewards">
				<hr width="50%" style="margin: 0 auto 0 auto;">
				<?php foreach ($voteRewards as $reward) { ?>
					<div class="vote-reward">
						<p><?php echo $reward; ?></p>
					</div>
				<?php } ?>
			</div>
			<hr width="25%" style="margin: 10px auto;">
		</div>
		<div class="vote-medium-box" id="vote-medium-box">
			<div class="vote-medium-box-header">
				<h3>
					<i class="fas fa-hand-spock"></i> Vote
				</h3>
			</div>
			<div class="vote-medium-box-body">
				<?php foreach ($voteSites as $site) { ?>
					<a href="<?php echo $site['link']; ?>" target="<?php echo $site['target']; ?>">
						<i class="fas fa-thumbs-up"></i> <?php echo $site['title']; ?>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php

require('_footer.php');