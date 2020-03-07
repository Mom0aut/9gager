<?php
require_once 'db.class.php';
require_once 'posts.class.php';
header('Content-Type: application/json');

// get parameters
$channel = isset($_GET['channel']) ? $_GET['channel'] : null;
$limit   = isset($_GET['limit']) ? $_GET['limit'] : 10;
$from    = isset($_GET['from']) ? $_GET['from'] : 0;

$rv = array(
	'meta'=>array('timestamp'=>time(), 'status'=>'success', 'sid'=>null),
	'data'=>array(
		'posts'=>posts::posts_per_channel($channel, $from, $limit),
		'nextCursor'=>"from=".($from+10)."&limit=10"
	)
);

die(json_encode($rv));