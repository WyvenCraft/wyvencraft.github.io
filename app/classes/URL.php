<?php

class URL
{
	public static function build($path, $params = '', $full = false)
	{
		$url = '';

		if ($full === true) {

			$protocol = 'http';
			if ($_SERVER['REQUEST_SCHEME'] === 'https' || $_SERVER['SERVER_PORT'] == 443) {
				$protocol = 'https';
			}

			$host = $_SERVER['HTTP_HOST'];
			$url .= $protocol . '://' . $host;

		}

		$base = dirname($_SERVER['SCRIPT_NAME']);
		$url .= rtrim($base, '/') . rtrim($path, '/') . $params;

		return $url;
	}

	public static function buildStatic($path, $full = false)
	{
		return self::build($path, '', $full);
	}

	public static function redirect($location, $delay = 0)
	{
		if (is_numeric($location) && $location === 404) {

			http_response_code(404);

			if (file_exists(APP_PATH . '/pages/404.php')) {
				require(APP_PATH . '/pages/404.php');
			} else {
				echo '<pre>Error 404: Page not found!</pre>';
			}

			die();
			
		}

		echo '
			<script data-cfasync="false">
				setTimeout(function() {
					window.location.replace("' . str_replace('&amp;', '&', htmlspecialchars($location)) . '");
				}, ' . $delay * 1000 . ');
			</script>
		';

		die();
	}
}