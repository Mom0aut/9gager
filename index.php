<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="favicon.ico" />
 	<title>9gager</title>
	<script>
		var article = `<article id="{id}" class="{class}">
			<a href="{url}" target="_blank">{media}</a>
			<h1>{title}</h1>
			<h2>{type} - {commentsCount}</h2>
			<p>{descriptionHtml}</p>
			<ul>{tags}</ul>
		</article>`;

		var nextCursor = {}; 

		function loadMore(size) {
			size = size || 1;

	  	   	var xhr = new XMLHttpRequest();
			var type = document.getElementById('type').value;
			if(!(type in nextCursor))
				nextCursor[type] = '';
			xhr.open('GET', 'read9gag.php?type=' + type + '&' + nextCursor[type]);

			// Track the state changes of the request.
			xhr.onreadystatechange = function () {
				var DONE = 4; // readyState 4 means the request is done.
				var OK = 200; // status 200 is a successful return.
				if (xhr.readyState === DONE) {
					if (xhr.status === OK) {
						console.log(xhr.responseText); // 'This is the output.'
						var data = JSON.parse(xhr.responseText);
						viewPosts(data);
						updateNextCursor(type, data.data.nextCursor);
						if(size > 1)
							loadMore(--size);
					} else {
						console.log('Error: ' + xhr.status); // An error occurred during the request.
					}
				}
			};	

			// Send the request to send-ajax-data.php
			xhr.send(null);
    	}

    	function viewPosts(result) {
    		var div = document.createElement('div');
    		div.setAttribute('class', 'posts');
    		var html = '';
    		result.data.posts.forEach(function(postData) {
    			html += buildPost(postData);
    		});
    		div.innerHTML = html;
    		document.getElementById('main').appendChild(div);
    	}

    	function buildPost(postData) {
    		var articleT = article.replace('{title}', postData.title);
    		articleT = articleT.replace('{type}', postData.type);
    		articleT = articleT.replace('{url}', postData.url);
    		articleT = articleT.replace('{descriptionHtml}', postData.descriptionHtml);
    		articleT = articleT.replace('{commentsCount}', postData.commentsCount);
    		articleT = articleT.replace('{id}', postData.id);

    		if(postData.id in localStorage)
    			articleT = articleT.replace('{class}', 'watched');
    		else {
    			localStorage[postData.id] = true;
    			articleT = articleT.replace('{class}', '');
    		}


    		if(postData.images) {
    			if(postData.images.image460sv && postData.type === 'Animated')
    				articleT = articleT.replace('{media}', videoText(postData.images.image460sv.url));
    			if(postData.images.image700)
    				articleT = articleT.replace('{media}', '<img src="'+postData.images.image700.url+'" />');
    			else if(postData.images.image460)
    				articleT = articleT.replace('{media}', '<img src="'+postData.images.image460.url+'" />');
    		}

    		var tags = '';
    		postData.tags.forEach(tag => {
    			tags += '<li><a href="https://9gag.com'+tag.url+'" target="_blank">'+tag.key+'</a></li>';
    		});

    		articleT = articleT.replace('{tags}', tags);

    		return articleT;
    	}

    	function videoText(url) {
    		return '<video controls="controls"><source src="'+url+'" type="video/mp4"></video>';
    	}

    	function updateNextCursor(type, newCursor) {
    		nextCursor[type] = newCursor;
    	}

    	function clearAllWatched() {
    		if(!confirm('Are you sure ?'))
    			return;
    		localStorage.clear();
    	}


	</script>
	<style>
		body {font-family: Arial;}
		main {padding: 20px 50px;}
		.posts {display: flex; flex-wrap: wrap; align-items: center;}
		.posts article {padding: 20px; width: 350px; border-bottom: 1px solid gray; transition: all 0.5s;}
		/*.posts article:hover {background-color: gray; width: 500px; }
		.posts article:hover img, .posts article:hover video {width: 500px;}*/
		.posts article img, .posts article video {width: 350px; transition: all 0.5s;}
		.posts article h1 {font-size: 100%;}
		.posts article h2 {font-size: 80%;}
		.posts article ul {padding: 0; margin: 0; list-style: none;}
		.posts article li {padding: 0; margin: 2px 0 0 0; font-size: 80%;}
		.posts article.watched {background-color: red;}

		.buttons {text-align: center; font-size: 200%;}
		.buttons select, .buttons button {font-size: 100%;}
	</style>
</head>
<body>
	<h1>9gag drink</h1>
	<button onclick="clearAllWatched();"> Clear all watched </button>
	<main id="main">
	</main>
	<br><br><br><br>
	<div class="buttons">
		Pages: <input type="number" id="pages" value="1" style="font-size: 100%; width: 60px;" />
		Type: <select name="type" id="type"><option>nsfw</option><option>girl</option></select>
		<button onclick="loadMore(document.getElementById('pages').value);"> -= Load More =- </button><br>
		<br>
	</div>
</body>
</html>
