<?php

$site = Config::get('site');
$site['url'] = URL::build('/');

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="robots" content="noindex,nofollow">
	<title><?php echo '[🔑] ' . $pageTitle . ' - ' . $site['name'] ?></title>
	<link href="<?php echo URL::buildStatic('/assets/admin/css/style.min.css'); ?>" rel="stylesheet">
</head>

<body>

	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	
	<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
		data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

		<header class="topbar" data-navbarbg="skin5">
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header" data-logobg="skin6">
					<a class="navbar-brand" href="<?php echo URL::build('/admin'); ?>">
						<span class="logo-text mx-auto">
							<img src="<?php echo URL::buildStatic('/assets/img/triplezone.png'); ?>" width="128px" alt="homepage" />
						</span>
					</a>
					<a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
						href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
				</div>
				<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
					<ul class="navbar-nav d-none d-md-block d-lg-none">
						<li class="nav-item">
							<a class="nav-toggler nav-link waves-effect waves-light text-white"
								href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-toggler nav-link waves-effect waves-light text-white" href="<?php echo $site['url']; ?>" target="_blank">Visit Site</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<aside class="left-sidebar" data-sidebarbg="skin6">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						<li class="sidebar-item">
							<a href="<?php echo URL::build('/admin'); ?>" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
								<i class="fas fa-clock fa-fw" aria-hidden="true"></i>
								<span class="hide-menu">Dashboard</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo URL::build('/admin/announcements'); ?>" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
								<i class="fas fa-bullhorn fa-fw" aria-hidden="true"></i>
								<span class="hide-menu">Announcements</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo URL::build('/admin/updates'); ?>" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
								<i class="fas fa-bolt fa-fw" aria-hidden="true"></i>
								<span class="hide-menu">Updates</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a href="<?php echo URL::build('/admin/rules'); ?>" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
								<i class="fas fa-ban fa-fw" aria-hidden="true"></i>
								<span class="hide-menu">Rules</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>

		<div class="page-wrapper" style="min-height: 250px;">

			<div class="page-breadcrumb bg-white">
				<div class="row align-items-center">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h4 class="page-title text-uppercase font-medium font-14"><?php echo $pageTitle; ?></h4>
					</div>
				</div>
			</div>