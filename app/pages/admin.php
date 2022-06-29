<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_POST['action']) && $_POST['action'] === 'authorize') {

		if (!isset($_POST['key'])) {
			http_response_code(401);
			die();
		}

		if ($_POST['key'] !== Config::get('adminCode', 'credentials')) {
			http_response_code(401);
			die();
		}

		$_SESSION['authorized'] = 1;

		http_response_code(200);
		die();

	}

}

if (!isset($_SESSION['authorized'])) {
	echo "
		<script>

			const authorizationPrompt = () => {
				var authorizationKey = prompt('Please enter the authorization key', '');
				if (authorizationKey !== null) {
					authorize(authorizationKey);
				}
			}

			const authorize = (authorizationKey) => {

				let requestURL = window.location.href;
				let requestParams = 'action=authorize&key=' + authorizationKey;

				let request = new XMLHttpRequest();
				request.onreadystatechange = () => {
					if (request.readyState == 4) {
						console.log(request.status);
						switch (request.status) {
							case 200:
								location.reload();
								break;
							default:
								authorizationPrompt();
								break;
						}
					}
				}
			
				request.open('POST', requestURL, true);
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.send(requestParams);

			}

			authorizationPrompt();

		</script>
	";
	die();
}

define('BACKEND', true);

if (count($routeBits) < 2) {
	$routeBits[1] = 'index';
}

$pageFilePath = APP_PATH . '/pages/' . $routeBits[0] . '/' . $routeBits[1] . '.php';
if (!file_exists($pageFilePath) || strpos(pathinfo($pageFilePath, PATHINFO_FILENAME), '_') === 0) {
	URL::redirect(404);
}

require($pageFilePath);