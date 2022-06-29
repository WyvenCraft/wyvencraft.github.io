<?php

$config = [

	'topNav' => [

		[
			'title' => 'Home',
			'icon' => '',
			'link' => URL::build('/'),
			'target' => '_self',
			'class' => '',
		],
	
		[
			'title' => 'Forum',
			'icon' => '',
			'link' => "https://google.com",
			'target' => '_self',
			'class' => '',
		],
	
		[
			'title' => 'Vote',
			'icon' => '',
			'link' => URL::build('/vote'),
			'target' => '_self',
			'class' => '',
		],
	
		[
			'title' => 'Store',
			'icon' => '',
			'link' => URL::build('/store'),
			'target' => '_self',
			'class' => 'store',
		],
	
		[
			'title' => 'Servers',
			'icon' => '',
			'link' => URL::build('/servers'),
			'target' => '_self',
			'class' => '',
		],
	
		[
			'title' => 'Updates',
			'icon' => '',
			'link' => URL::build('/updates'),
			'target' => '_self',
			'class' => '',
		],

		[
			'title' => 'Rules',
			'icon' => '',
			'link' => URL::build('/rules'),
			'target' => '_self',
			'class' => '',
		],

	],

	'footerNav' => [

		[
			'title' => 'Home',
			'icon' => '',
			'link' => '#',
			'target' => '',
		],
	
		[
			'title' => 'Forum',
			'icon' => '',
			'link' => '#',
			'target' => '',
		],
	
		[
			'title' => 'Store',
			'icon' => '',
			'link' => '#',
			'target' => '',
		],

	],

	'mediaNav' => [

		[
			'icon' => '<i class="fab fa-twitter"></i>',
			'link' => URL::build('/twitter'),
			'target' => '',
		],

		[
			'icon' => '<i class="fab fa-youtube"></i>',
			'link' => URL::build('/youtube'),
			'target' => '',
		],

		[
			'icon' => '<i class="fab fa-twitter"></i>',
			'link' => URL::build('/facebook'),
			'target' => '',
		],

	],

];