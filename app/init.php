<?php

// error_reporting(0);

session_start();

spl_autoload_register(function($class) {
	$classPath = APP_PATH . '/classes/' . $class . '.php';
	if (file_exists($classPath)) {
		require($classPath);
	}
});

$route = '/';
if (isset($_GET['route'])) {
	$route = rtrim(strtok($_GET['route'], '?'), '/');
}

$routeBits = ['index'];
if ($route !== '/') {
	$routeBits = explode('/', ltrim($route, '/'));
}

$redirect = Config::get($route, 'redirects');
if (!is_null($redirect)) {
	header('Location: ' . $redirect);
	die();
}

Queries::init();

$pageFilePath = APP_PATH . '/pages/' . $routeBits[0] . '.php';
if (!file_exists($pageFilePath) || strpos(pathinfo($pageFilePath, PATHINFO_FILENAME), '_') === 0) {
	URL::redirect(404);
}

require($pageFilePath);