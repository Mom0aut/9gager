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

	public static function posts_per_channel($channel, $from, $limit)
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

		$q = "SELECT * FROM posts $where ORDER BY creation_date DESC LIMIT $from,$limit";

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