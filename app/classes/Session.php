<?php

class Session
{
	public static function exists($name)
	{
		return (isset($_SESSION[$name]) ? true : false);
	}

	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}
	
	public static function get($name)
	{
		return (isset($_SESSION[$name]) ? $_SESSION[$name] : null);
	}	
	
	public static function delete($name)
	{
		if (self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

	public static function flash($name, $string = null)
	{
		if (!is_null($string)) {
			self::put($name, $string);
			return true;
		}

		$session = self::get($name);
		self::delete($name);
		return $session;
	}
}