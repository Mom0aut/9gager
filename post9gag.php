<?php
header("Access-Control-Allow-Origin: https://9gag.com");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: *"); // Content-Type, Authorization

// read the data from the POST
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


require_once 'db.class.php';

// go over all posts
$error_counter = 0;
if(isset($request->data) && isset($request->data->posts))
{
	$posts = $request->data->posts;
	if(is_array($posts))
	{
		foreach($posts as $post)
		{
			$insert_id = save_post($post);
			if(is_null($insert_id))
				$error_counter++;
		}
	}
}

// set return
if(isset($request->data->nextCursor) && $error_counter < 20)
	$rv = array('next'=>$request->data->nextCursor);
else
	$rv = array('next'=>null);


die(json_encode($rv));

/////////////////////////////////////////

function save_post($post)
{
	$mysqli = db::connect();

	$channel       = trim($mysqli->real_escape_string($post->postSection->name));
	$creationTs    = trim($mysqli->real_escape_string($post->creationTs));
	$external_id   = trim($mysqli->real_escape_string($post->id));
	$url           = trim($mysqli->real_escape_string($post->url));
	$title         = trim($mysqli->real_escape_string($post->title));
	$type          = trim($mysqli->real_escape_string($post->type));
	$nsfw          = ($post->nsfw == 1) ? 'TRUE' : 'FALSE';
	$description_html = trim($mysqli->real_escape_string($post->descriptionHtml));

	$tags = array();
	if($post->tags && is_array($post->tags))
	{
		foreach($post->tags as $tag)
			$tags[] = trim($mysqli->real_escape_string($tag->key));
	}
	if(!empty($tags))
		$tags = "'".implode(',', $tags)."'";
	else
		$tags = 'NULL';

	$image = null;
	if(isset($post->images->image460sv))
		$content_url = trim($mysqli->real_escape_string($post->images->image460sv->url));
	else if(isset($post->images->image700))
		$content_url = trim($mysqli->real_escape_string($post->images->image700->url));
	else if(isset($post->images->image460))
		$content_url = trim($mysqli->real_escape_string($post->images->image460->url));
	else
		return -1;	

	$q = "INSERT INTO posts SET
		creation_date=NOW(),
		creationTs='$creationTs',
		external_id='$external_id',
		channel='$channel',
		url='$url',
		title='$title',
		type='$type',
		nsfw=$nsfw,
		description_html='$description_html',
		tags=$tags,
		content_url='$content_url'";
	$res = $mysqli->query($q);
	if(!$res)
		return null;
	return $mysqli->insert_id;
}

// {
//   "meta": {
//     "timestamp": 1583597515,
//     "status": "Success",
//     "sid": "9gVQ01EVjlHTUVkMMRVSxwEVFhnTn1TY"
//   },
//   "data": {
//     "posts": [
//       {
//         "id": "ag5bEWr",
//         "url": "http:\/\/9gag.com\/gag\/ag5bEWr",
//         "title": "Blonde or brunette?",
//         "type": "Animated",
//         "nsfw": 1,
//         "upVoteCount": 11,
//         "downVoteCount": 0,
//         "creationTs": 1583597326,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 460,
//             "height": 258,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ag5bEWr_460s.jpg"
//           },
//           "image460": {
//             "width": 460,
//             "height": 258,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ag5bEWr_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/ag5bEWr_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ag5bEWr_fbthumbnail.jpg"
//           },
//           "image460sv": {
//             "width": 460,
//             "height": 258,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ag5bEWr_460sv.mp4",
//             "hasAudio": 1,
//             "duration": 10,
//             "vp8Url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ag5bEWr_460svwm.webm"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 1,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "Natalie Mars",
//             "url": "\/tag\/natalie-mars"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "a6Nzj0R",
//         "url": "http:\/\/9gag.com\/gag\/a6Nzj0R",
//         "title": "Airbags for road safety",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 8,
//         "downVoteCount": 0,
//         "creationTs": 1583597236,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 873,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/a6Nzj0R_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/a6Nzj0R_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 574,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/a6Nzj0R_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/a6Nzj0R_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/a6Nzj0R_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 0,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "boobs",
//             "url": "\/tag\/boobs"
//           },
//           {
//             "key": "sexy",
//             "url": "\/tag\/sexy"
//           },
//           {
//             "key": "nsfw",
//             "url": "\/tag\/nsfw"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "aZ7KzY3",
//         "url": "http:\/\/9gag.com\/gag\/aZ7KzY3",
//         "title": "Chimi",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 21,
//         "downVoteCount": 1,
//         "creationTs": 1583596682,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 1014,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aZ7KzY3_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aZ7KzY3_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 666,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aZ7KzY3_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aZ7KzY3_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aZ7KzY3_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 0,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "Chimi",
//             "url": "\/tag\/chimi"
//           },
//           {
//             "key": "Newhalf",
//             "url": "\/tag\/newhalf"
//           },
//           {
//             "key": "Kathoey",
//             "url": "\/tag\/kathoey"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "aPR01qB",
//         "url": "http:\/\/9gag.com\/gag\/aPR01qB",
//         "title": "Step aside Jesus, there&#039;s a new Messiah in town.",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 7,
//         "downVoteCount": 3,
//         "creationTs": 1583596671,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 597,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aPR01qB_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aPR01qB_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 392,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aPR01qB_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aPR01qB_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aPR01qB_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 1,
//         "postSection": {
//           "name": "Funny",
//           "url": "https:\/\/9gag.com\/funny",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557376304.186_U5U7u5_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557376304.186_U5U7u5_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "Wine",
//             "url": "\/tag\/wine"
//           },
//           {
//             "key": "Jesus",
//             "url": "\/tag\/jesus"
//           },
//           {
//             "key": "Italy",
//             "url": "\/tag\/italy"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "aAg7O9R",
//         "url": "http:\/\/9gag.com\/gag\/aAg7O9R",
//         "title": "Not sure you built that right!",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 12,
//         "downVoteCount": 2,
//         "creationTs": 1583596631,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 604,
//             "height": 742,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aAg7O9R_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aAg7O9R_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 565,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aAg7O9R_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aAg7O9R_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aAg7O9R_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 4,
//         "postSection": {
//           "name": "Funny",
//           "url": "https:\/\/9gag.com\/funny",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557376304.186_U5U7u5_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557376304.186_U5U7u5_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "NSFW",
//             "url": "\/tag\/nsfw"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "aMY6O71",
//         "url": "http:\/\/9gag.com\/gag\/aMY6O71",
//         "title": "Imagine getting a wank from her",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 28,
//         "downVoteCount": 4,
//         "creationTs": 1583596266,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 700,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aMY6O71_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aMY6O71_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 460,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aMY6O71_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aMY6O71_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aMY6O71_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 4,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "death by snu snu",
//             "url": "\/tag\/death-by-snu-snu"
//           },
//           {
//             "key": "sexy",
//             "url": "\/tag\/sexy"
//           },
//           {
//             "key": "fit chick",
//             "url": "\/tag\/fit-chick"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "a4R8W8v",
//         "url": "http:\/\/9gag.com\/gag\/a4R8W8v",
//         "title": "Need help cap!!!",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 16,
//         "downVoteCount": 6,
//         "creationTs": 1583596237,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 1516,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/a4R8W8v_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/a4R8W8v_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 996,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/a4R8W8v_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/a4R8W8v_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/a4R8W8v_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 0,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "redhead",
//             "url": "\/tag\/redhead"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "aDgLOr7",
//         "url": "http:\/\/9gag.com\/gag\/aDgLOr7",
//         "title": "Nice View",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 22,
//         "downVoteCount": 1,
//         "creationTs": 1583595517,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 925,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aDgLOr7_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aDgLOr7_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 607,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aDgLOr7_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aDgLOr7_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aDgLOr7_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 2,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
          
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "ayoAYVV",
//         "url": "http:\/\/9gag.com\/gag\/ayoAYVV",
//         "title": "Hourglass",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 61,
//         "downVoteCount": 9,
//         "creationTs": 1583595331,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 838,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ayoAYVV_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/ayoAYVV_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 550,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ayoAYVV_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/ayoAYVV_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/ayoAYVV_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 2,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "sexy",
//             "url": "\/tag\/sexy"
//           },
//           {
//             "key": "boobs",
//             "url": "\/tag\/boobs"
//           },
//           {
//             "key": "thicc",
//             "url": "\/tag\/thicc"
//           },
//           {
//             "key": "Neiva Mara",
//             "url": "\/tag\/neiva-mara"
//           },
//           {
//             "key": "Neiva",
//             "url": "\/tag\/neiva"
//           }
//         ],
//         "descriptionHtml": ""
//       },
//       {
//         "id": "aV08VRy",
//         "url": "http:\/\/9gag.com\/gag\/aV08VRy",
//         "title": "Lucy Pinder. If only she did...",
//         "type": "Photo",
//         "nsfw": 1,
//         "upVoteCount": 64,
//         "downVoteCount": 4,
//         "creationTs": 1583594925,
//         "promoted": 0,
//         "isVoteMasked": 1,
//         "hasLongPostCover": 0,
//         "images": {
//           "image700": {
//             "width": 700,
//             "height": 1050,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aV08VRy_700b.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aV08VRy_700bwp.webp"
//           },
//           "image460": {
//             "width": 460,
//             "height": 690,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aV08VRy_460s.jpg",
//             "webpUrl": "https:\/\/img-9gag-fun.9cache.com\/photo\/aV08VRy_460swp.webp"
//           },
//           "imageFbThumbnail": {
//             "width": 220,
//             "height": 220,
//             "url": "https:\/\/img-9gag-fun.9cache.com\/photo\/aV08VRy_fbthumbnail.jpg"
//           }
//         },
//         "sourceDomain": "",
//         "sourceUrl": "",
//         "commentsCount": 3,
//         "postSection": {
//           "name": "NSFW",
//           "url": "https:\/\/9gag.com\/nsfw",
//           "imageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//           "webpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp"
//         },
//         "tags": [
//           {
//             "key": "Lucy Pinder",
//             "url": "\/tag\/lucy-pinder"
//           }
//         ],
//         "descriptionHtml": ""
//       }
//     ],
//     "group": {
//       "name": "NSFW",
//       "url": "nsfw",
//       "description": "Not Safe For Work. No sexually explicit content.",
//       "ogImageUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100.jpg",
//       "ogWebpUrl": "https:\/\/miscmedia-9gag-fun.9cache.com\/images\/thumbnail-facebook\/1557297099.4728_VeSAvU_100x100wp.webp",
//       "userUploadEnabled": true,
//       "isSensitive": true,
//       "location": ""
//     },
//     "tags": [
      
//     ],
//     "featuredAds": [
      
//     ],
//     "nextCursor": "after=aV08VRy%2CayoAYVV%2CaDgLOr7&c=10"
//   }
// }