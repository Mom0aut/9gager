<?php
require_once 'db.class.php';
require_once 'posts.class.php';

$channels = posts::load_channels();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="favicon.ico" />
 	<title>9gag RSS</title>
	<script>
	</script>
	<style>
		html, body {font-family: Arial; padding: 0; margin: 0;}
		h1,h2,h3,h4,h5,h6 {margin: 0; padding: 0;}
		main {width: 50%; padding: 0 1%; margin: 0 auto; background-color: #ddd;}
		.channels {display: flex; flex-wrap: wrap; justify-content: space-evenly;}
		.channel {margin: 1%; padding: 1%; width: 20%; border: 1px solid black;}
		.channel h2 {font-size: 110%;}
		.channel ul {margin: 0; padding: 0; list-style: none;}
	</style>
</head>
<body>
	<main>
		<img src="9gag-logo.png" alt="9gag rss logo" height="100px" /><br>
		<h1>9gag RSS</h1>
		<p>
			<a href="https://9agag.com">9gag</a> on the 27th of February 2020 blocked direct access to their JSON stream. Hence trying to reach
			for <a href="https://9gag.com/v1/group-posts/group/girl/type/fresh">https://9gag.com/v1/group-posts/group/girl/type/fresh</a> directly
			will fail with 403 forbidden error when not accessed from the browser.
		</p>
		<p>
			This is quite annoying. I don't understand why in 2020 website do not publish a free RSS/ATOM feed or json access of their data.
		</p>
		<p>
			So I have found a way to bypass this and created a RSS feed of 9gag.com, JSON feed for 9gag.com and even a clean lite viewer for 9gag.com 
			which remembers which posts you have already seen (using localstorage) so you will know where to stop and also without the annoying 
			reload scroll. You can also view the code on <a href="https://github.com/caviv/9gager">git: 9gager</a>
		</p>

		<article class="channels">
			<?php
				foreach($channels as $channel)
				{
					$vc = urlencode($channel['channel']);
					?>
					<section class="channel">
						<h2><?php echo $channel['channel']; ?></h2>
						<ul>
							<li><a href="viewer.php?channel=<?php echo $vc; ?>" title="View feed for 9gag.com rss in channel <?php echo $vc; ?>">View</a></li>
							<li><a href="rss.php?channel=<?php echo $vc; ?>" title="rss feed for 9gag.com rss in channel <?php echo $vc; ?>">RSS</a></li>
							<li><a href="json.php?channel=<?php echo $vc; ?>" title="json feed for 9gag.com rss in channel <?php echo $vc; ?>">JSON</a></li>
						</ul>
					</section>
					<?php
				}
			?>
		</article>
	</main>

	<footer>
		&copy; <?php echo '2020',' - ',date('Y'); ?>
	</footer>
</body>
</html>
