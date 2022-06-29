<?php

$config = [

	'database' => [
		'host' => '127.0.0.1',
		'port' => '3306',
		'database' => 'triplezone',
		'username' => 'root',
		'password' => '',
	],

	'site' => [
		'name' => 'TripleZone',
		'tagline' => 'Best Developer',
		'description' => 'Lorem ipsum dolor sit amet.',
		'author' => 'TripleZone',
		'color' => '#ccc',
		'logo' => URL::buildStatic('/assets/img/logo.png'),
		'image' => URL::buildStatic('/assets/img/logo.png'),
		'icon' => URL::buildStatic('/assets/img/icon.png'),
	],

	'store_button_name' => 'Store',
	
	'minecraftServer' => [
		'ip' => 'eu.hypixel.net',
		'port' => '25565',
		'refresh' => false,
	],

	'discordServer' => [
		'id' => '505081670815186946',
		'inviteLink' => '#',
	],

	'loader' => [
		'enabled' => false
	],

	'sale' => [
		'enabled' => true,
		'title' => 'Mega Sale 100%',
		'description' => 'Lorem ipsum dolor sir amet.Lorem ipsum dolor sir amet.',
		'meta' => '<a href="#" target="_blank">Go to store <i class="fas fa-arrow-alt-circle-right"></i></a>',
	],

	'footer' => [
		'copyright' => '© 2020 Website All Rights Reserved.',
		'icon' => 'https://cdn.discordapp.com/attachments/282810617880903680/687299755113709592/Group_1.png',
	],

	'particles' => [
		'color' => "#fff",
		'enabled' => false,
	],

	'resultsCount' => 3,

];