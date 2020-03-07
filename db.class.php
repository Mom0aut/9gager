<?php
include 'dbpassword.php';

class db
{
	private static $mysqli = null;

	public static function connect()
	{
		if(!self::$mysqli)
		{
			self::$mysqli = new mysqli($db[0], $db[1], $db[2], $db[3]);
			self::$mysqli->set_charset('utf8');
		}
		return self::$mysqli;
	}
}