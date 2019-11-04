<?php
	header('Content-Type: application/json');

	$type = 'nsfw';
	if(isset($_GET['type']))
		$type = $_GET['type'];

	if(isset($_GET['after']) && isset($_GET['c']))
		$data = file_get_contents("https://9gag.com/v1/group-posts/group/$type/type/fresh?after=$_GET[after]&c=$_GET[c]");
	else
		$data = file_get_contents("https://9gag.com/v1/group-posts/group/$type/type/fresh");

	echo $data;
