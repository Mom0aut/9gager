<?php
class db
{
	private static $mysqli = null;

	public static function connect()
	{
		if(!self::$mysqli)
		{
			self::$mysqli = new mysqli('localhost', 'admin', 'earth12', '9gagrss');
			self::$mysqli->set_charset('utf8');
		}
		return self::$mysqli;
	}
}