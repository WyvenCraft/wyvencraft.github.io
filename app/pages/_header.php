<?php

$site = Config::get('site');
$site['url'] = URL::build('/', '', true);

$topNav = Config::get('topNav', 'navigation');
$sale = Config::get('sale');
$loader = Config::get('loader');
$particles = Config::get('particles');

$minecraftServer = Config::get('minecraftServer');
$discordServer = Config::get('discordServer');

if (!isset($pageTitle)) {
	$pageTitle = $site['name'] . ' - ' . $site['tagline'];
} else {
	$pageTitle .= ' - ' . $site['name'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<title><?php echo $pageTitle; ?></title>

	<meta name="author" content="<?php echo $site['author']; ?>">
	<meta name="description" content="<?php echo $site['description']; ?>">
	<meta name="theme-color" content="<?php echo $site['color']; ?>">

	<meta property="og:title" content="<?php echo $pageTitle; ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?php echo $site['name']; ?>">
	<meta property="og:url" content="<?php echo $site['url']; ?>">
	<meta property="og:image" content="<?php echo $site['image']; ?>">
	<meta property="og:description" content="<?php echo $site['description']; ?>">
	
	<meta name="twitter:title" content="<?php echo $pageTitle; ?>">
	<meta name="twitter:description" content="<?php echo $site['description']; ?>">
	<meta name="twitter:image" content="<?php echo $site['image']; ?>">
	<meta name="twitter:image:alt" content="<?php echo $site['name']; ?>">
	
	<link rel="icon" type="image/png" href="<?php echo $site['icon']; ?>">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="<?php echo URL::buildStatic('/assets/theme_css/style.min.css'); ?>">
		
</head>

<body>

	<?php if ($loader['enabled']) { ?>
	<div class="animatie">
		<div class="element-animatie"></div>
		<div class="element-animatie-2">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	<?php } ?>

	<?php if ($sale['enabled']) { ?>
		<div class="notifications" id="notifications-sh">
			<button id="notifications"><i class="fas fa-tag"></i></button>
			<div class="notification-box" id="not-box">
				<div class="notification-header">
					<p><?php echo $sale['title']; ?></p>
				</div>
				<div class="notification-description">
					<p><?php echo $sale['description']; ?></p>
				</div>
				<div class="notification-footer">
					<?php echo $sale['meta']; ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="" id="shadow-open">
		<div class="mobile-navigation" id="mobile-nav">
			<button type="button" name="button" id="close-nav">
				<i class="fas fa-arrow-left"></i>
			</button>
			<div class="header-mobile-navigation">
				<a href="<?php echo $site['url']; ?>">
					<img src="<?php echo $site['logo']; ?>" class="logo-counter" style="width: 200px;">
				</a>
			</div>
			<div class="body-mobile-navigation">
				<div class="navigatie-mobil">
					<p>Navigation</p>
				</div>
				<ul>
					<?php foreach ($topNav as $nav) { ?>
						<li>
							<a href="<?php echo $nav['link']; ?>" target="<?php echo $nav['target']; ?>" class="<?php echo $nav['class']; ?>"><?php echo $nav['icon']; ?><?php echo $nav['title']; ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="catalin-header" id="catalin-header">

		<div class="header-hover" id="header-hover-triplezone"></div>

		<?php if($particles['enabled']) {?>
			<div id="particles-js"></div>
		<?php } ?>

		<nav class="catalin-navigatie">
			<div class="container">
				<ul class="catalin-nav-links" id="nav-links">
					<li id="button-open">
						<button type="button" id="open-nav" name="button">
							<i class="fas fa-bars"></i>
						</button>
					</li>
					<div id="testare-hide">
						<?php foreach ($topNav as $nav) { ?>
							<li>
								<a href="<?php echo $nav['link']; ?>" target="<?php echo $nav['target']; ?>" class="<?php echo $nav['class']; ?>"><?php echo $nav['icon']; ?><?php if ($nav['title'] == Config::get('store_button_name')) { echo ("<i class='fas fa-star steluta'></i>");}?><?php echo $nav['title']; ?></a>
							</li>
						<?php } ?>
					</div>
				</ul>
			</div>
		</nav>

		<div class="catalin-header-content">
			<div class="container">
				<div class="coloana-3" id="coloana-3">
					<div class="cutie-1" id="cutie-1">
						<ul>
							<a href="<?php echo $discordServer['inviteLink']; ?>" target="_blank" style="text-decoration: none;">
								<ul class="directia-elementelor-secundare">
									<li class="element-secundar">
										<h3>Discord Server</h3>
									</li>
									<li class="element-secundar">
										<p>
											<span id="discord-count">?</span> online now
										</p>
									</li>
								</ul>
								<ul class="directie-elemente">
									<li class="principalul-element">
										<i class="fab fa-discord discord-spatiu" id="discord-panza-1"></i>
									</li>
								</ul>
							</a>
						</ul>
					</div>
					<div class="cutie-2" id="cutie-2">
						<a href="<?php echo $site['url']; ?>">
							<img src="<?php echo $site['logo']; ?>" id="logo-server" class="logo-counter">
						</a>
					</div>
					<div class="cutie-3" id="cutie-3">
						<a href="#" style="text-decoration: none;" id="copiazaIP">
							<ul class="directie-elemente">
								<li class="principalul-element">
									<i class="fas fa-play-circle server-spatiu" id="discord-panza-2"></i>
								</li>
							</ul>
							<ul class="directia-elementelor-secundare" style="margin-right: 0px;">
								<li class="element-secundar">
									<h3 class="play-button-design">
										<span class="player-count">?</span> players online
									</h3>
								</li>
								<li class="element-secundar">
									<p class="play-button-design-gray">Start your adventure now</p>
								</li>
							</ul>
						</a>
					</div>
				</div>
			</div>
		</div>

	</div>