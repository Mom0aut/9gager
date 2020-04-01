<?php
class posts
{
	public static function load_channels()
	{
		$mysqli = db::connect();
		$q = "SELECT channel,count(*) AS c FROM posts GROUP BY channel";
		$results = $mysqli->query($q)
					or die($mysqli->error);
		$channels = array();
		while($row = $results->fetch_assoc())
		{
			$channels[] = $row;
		}
		$results->free();

		return $channels;
	}

	public static function last_updated()
	{
		static $last_updated = null;
		if(!$last_updated)
		{
			$mysqli = db::connect();
			$q = "SELECT CONVERT_TZ(creation_date, @@global.time_zone, '+00:00') AS creation_date FROM posts ORDER BY creation_date DESC LIMIT 1";
			$results = $mysqli->query($q)
						or die($mysqli->error);
			$row = $results->fetch_assoc();
			//$last_updated = $row['creation_date'];
			$last_post = str_replace(' ', 'T', $row['creation_date']).'.000Z';
			$results->free();
		}
		return $last_post;
	}

	public static function last_post()
	{
		static $last_post = null;
		if(!$last_post)
		{
			$mysqli = db::connect();
			$q = "SELECT CONVERT_TZ(creationTs, @@global.time_zone, '+00:00') AS creationTs FROM posts ORDER BY creationTs DESC LIMIT 1";
			$results = $mysqli->query($q)
						or die($mysqli->error);
			$row = $results->fetch_assoc();
			$last_post = str_replace(' ', 'T', $row['creationTs']).'.000Z';
			$results->free();
		}
		return $last_post;
	}

	public static function posts_per_channel($channel, $from, $limit, $order_by = 'creationTs')
	{
		$mysqli = db::connect();

		// sanity check
		if(!is_numeric($from))
			$from = 0;
		if(!is_numeric($limit))
			$limit = 10;
		if($limit > 100)
			$limit = 100;

		$where = array();
		if($channel)
			$where[] = "channel='".$mysqli->real_escape_string($channel)."'";
		$where = !empty($where) ? ' WHERE '.implode(' AND ', $where) : null;

		$q = "SELECT * FROM posts $where ORDER BY $order_by DESC LIMIT $from,$limit";

		$results = $mysqli->query($q)
					or die($mysqli->error);
		$posts = array();
		while($row = $results->fetch_assoc())
		{
			$posts[] = $row;
		}
		$results->free();

		return $posts;
	}
}