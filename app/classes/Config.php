<?php

class Config
{
	private static $configs = [];
	private static $configFile = null;

	public static function get($key, $file = null)
	{
		if (is_null($file)) {
			$file = 'config';
			if (!is_null(self::$configFile)) {
				$file = self::$configFile;
			}
		}
		
		if (!isset(self::$configs[$file])) {
			$configPath = APP_PATH . '/configs/' . $file . '.php';
			if (file_exists($configPath)) {
				require($configPath);
				self::$configs[$file] = $config;
			} else {
				return null;
			}
		}
		
		$keys = explode('.', $key);
		$value = self::$configs[$file];
		foreach ($keys as $bit) {
			if (isset($value[$bit])) {
				$value = $value[$bit];
			} else {
				$value = null;
				break;
			}
		}
		
		return $value;
	}
	
	public static function setFile($file)
	{
		self::$configFile = $file;
	}
}