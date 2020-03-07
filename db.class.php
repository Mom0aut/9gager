<?php
//include 'dbpassword.php';
class db
{
	private static $mysqli = null;

	public static function connect()
	{
		if(!self::$mysqli)
		{
			self::$mysqli = new mysqli('mysql.9gagrss.xyz', 'gagrss', 'havefun12', 'gagrss');
			self::$mysqli->set_charset('utf8');
		}
		return self::$mysqli;
	}
}