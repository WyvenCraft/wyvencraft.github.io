<?php

class Output {

	public static function getClean($input) {
		return str_replace('&amp;', '&', htmlspecialchars($input, ENT_QUOTES));
	}

	public static function getDecoded($input) {
		return htmlspecialchars_decode($input, ENT_QUOTES);
	}

}