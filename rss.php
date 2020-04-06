<?php
require_once 'db.class.php';
require_once 'posts.class.php';
header('Content-Type: text/xml');

// get parameters
$channel = isset($_GET['channel']) ? $_GET['channel'] : null;
$limit   = isset($_GET['limit']) ? $_GET['limit'] : 10;
$from    = isset($_GET['from']) ? $_GET['from'] : 0;

$posts = posts::posts_per_channel($channel, $from, $limit);

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n<rss version=\"2.0\">";
echo "<channel>\r\n";
echo "<title><![CDATA[9gagrss.xyz RSS for 9gag.com channel:$channel]]></title>
<link>https://9gagrss.xyz</link>
<description><![CDATA[9gagrss.xyz RSS for 9gag.com channel:$channel]]></description>\r\n";
foreach($posts as $item)
{
	echo "<item>\r\n";
	foreach($item as $key=>$value)
		echo "<$key><![CDATA[$value]]></$key>\r\n";
	echo "</item>\r\n";
}
echo "</channel></rss>";