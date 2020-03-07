<?php
header('Content-Type: application/json');

$type = 'nsfw';
if(isset($_GET['type']))
	$type = $_GET['type'];

$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Host: 9gag.com\r\n".
			   "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:73.0) Gecko/20100101 Firefox/73.0\r\n".
			   "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\r\n".
			   "Accept-Language: en-US,en;q=0.5\r\n".
		       "Accept-Encoding: gzip, deflate, br\r\n".
			   "DNT: 1\r\n".
			   "Connection: keep-alive\r\n".
			   "Upgrade-Insecure-Requests: 1\r\n"
    // 'header'=>"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\n".
    // 		  "accept-encoding: gzip, deflate, br\r\n".
    // 		  "accept-language: en,en-US;q=0.9,he;q=0.8\r\n".
    // 		  //"referer: https://9gag.com/$type\r\n".
    // 		  "sec-fetch-dest: document\r\n".
			 //  "sec-fetch-mode: navigate\r\n".
			 //  "sec-fetch-site: none\r\n".
			 //  "sec-fetch-user: ?1\r\n".
			 //  "upgrade-insecure-requests: 1	\r\n".
			 //  "cache-control: max-age=0\r\n".
			 //  "Referrer Policy: no-referrer-when-downgrade\r\n".
			 //  //":authority: 9gag.com\r\n".
			 //  //":method: GET\r\n".
				// // :path: /v1/group-posts/group/nsfw/type/hot?after=ayomedb%2Ca7wmWoL%2CaBgbmjZ&c=20
			 //  //":scheme: https\r\n".
			 //  "user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/80.0.3987.87 Chrome/80.0.3987.87 Safari/537.36\r\n".
			 //  "cookie: __cfduid=d289bdbc3d314b90c49faa3806b33124f1573641567; gag_tz=2; sign_up_referer=http%3A%2F%2Flocalhost%2F9gager%2F9gager.git%2F; _ga=GA1.2.610151665.1573641570; d7s_uid=k2x5k67wwxvbi9; _fbp=fb.1.1573641569906.510237421; __gads=ID=cbb09d7c7e77d62c:T=1577266226:S=ALNI_MZIWxEsvwIGjsVGNxYz3xYf3Z9y2Q; PHPSESSID=q49i6ojr7vq8nhr8l82cm56226; ts1=2195ddbf75b39e51f58bbfd2ecf74d64b613f1e6; ____ri=4982; ____lo=IL; cnx_userId=43597bc281204201e8211582814415367_1585406415367; _gid=GA1.2.1945156957.1582906969; _gat=1; __rtgt_sid=k76dxu4b305g5k; d7s_spc=1; session=eyJpdiI6InRrU3ppeWZuMXZOUmY1QkkyWmh0RnVDRHhzZyt6ODdyM1JyaEV1andHeDQ9IiwidmFsdWUiOiJ6Y0FoOUZ4Q0dqRDBSQU1Dc1daS28xcWVKV1pIcGtlRTBIVlViVkp1aU92QlV6R0pGSTVTT3pmQWhkVFBmQ0tsRWZNcXFSR0VKZFJUaW1sbVwvbjllY2hqTjVaTkdodisxSGFZOXBSbk1kTkoxUVF5VVd0dTZ6TzRnMzZaQTdVVU95cHRsa1VtT3dIKzI5U0tiUWhPUndlcFJodHpZN2pnbWFCbGduTmR2cnI0bng5aDRySTNlWlBQNm1TTXdlVThwXC9cL0Q4anZ2c2NwUDFYUFJyU3U3VVZZa0c1cW5VRGd3dytqZ1hWVUE1OVpqekd0U0kzUFM3XC9DRHJ6UlNJdndnaEdST2dMT1N5NXN3QVcwVkVxaTVWSkxQUjJFWDFVVnJuZ2pBZDFBWmh3Ulk9IiwibWFjIjoiYTI3NWI5MGJkNTVmNzk5ODgzMTQ3MTk2YzBkYzg3Mjc0ZjA3NDhjYmM4ZmY4NGJiZjFjZTJhNGUwNjk4NjhlMiJ9; _pk_ref.7.f7ab=%5B%22%22%2C%22%22%2C1582906969%2C%22http%3A%2F%2Flocalhost%2F9gager%2F9gager.git%2F%22%5D; _pk_ses.7.f7ab=*; _pk_id.7.f7ab=0aa290f4b9b4ec46.1573641570.41.1582906979.1582906969.\r\n"
    //           // "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
    //           //"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad 
  )
);




// cookie: __cfduid=d289bdbc3d314b90c49faa3806b33124f1573641567; gag_tz=2; sign_up_referer=http%3A%2F%2Flocalhost%2F9gager%2F9gager.git%2F; _ga=GA1.2.610151665.1573641570; d7s_uid=k2x5k67wwxvbi9; _fbp=fb.1.1573641569906.510237421; __gads=ID=cbb09d7c7e77d62c:T=1577266226:S=ALNI_MZIWxEsvwIGjsVGNxYz3xYf3Z9y2Q; PHPSESSID=q49i6ojr7vq8nhr8l82cm56226; ts1=2195ddbf75b39e51f58bbfd2ecf74d64b613f1e6; ____ri=4982; ____lo=IL; cnx_userId=43597bc281204201e8211582814415367_1585406415367; _gid=GA1.2.1945156957.1582906969; _gat=1; __rtgt_sid=k76dxu4b305g5k; d7s_spc=1; session=eyJpdiI6InRrU3ppeWZuMXZOUmY1QkkyWmh0RnVDRHhzZyt6ODdyM1JyaEV1andHeDQ9IiwidmFsdWUiOiJ6Y0FoOUZ4Q0dqRDBSQU1Dc1daS28xcWVKV1pIcGtlRTBIVlViVkp1aU92QlV6R0pGSTVTT3pmQWhkVFBmQ0tsRWZNcXFSR0VKZFJUaW1sbVwvbjllY2hqTjVaTkdodisxSGFZOXBSbk1kTkoxUVF5VVd0dTZ6TzRnMzZaQTdVVU95cHRsa1VtT3dIKzI5U0tiUWhPUndlcFJodHpZN2pnbWFCbGduTmR2cnI0bng5aDRySTNlWlBQNm1TTXdlVThwXC9cL0Q4anZ2c2NwUDFYUFJyU3U3VVZZa0c1cW5VRGd3dytqZ1hWVUE1OVpqekd0U0kzUFM3XC9DRHJ6UlNJdndnaEdST2dMT1N5NXN3QVcwVkVxaTVWSkxQUjJFWDFVVnJuZ2pBZDFBWmh3Ulk9IiwibWFjIjoiYTI3NWI5MGJkNTVmNzk5ODgzMTQ3MTk2YzBkYzg3Mjc0ZjA3NDhjYmM4ZmY4NGJiZjFjZTJhNGUwNjk4NjhlMiJ9; _pk_ref.7.f7ab=%5B%22%22%2C%22%22%2C1582906969%2C%22http%3A%2F%2Flocalhost%2F9gager%2F9gager.git%2F%22%5D; _pk_ses.7.f7ab=*; _pk_id.7.f7ab=0aa290f4b9b4ec46.1573641570.41.1582906979.1582906969.


$context = stream_context_create($options);

if(isset($_GET['after']) && isset($_GET['c']))
	$data = file_get_contents2("https://9gag.com/v1/group-posts/group/$type/type/fresh?after=$_GET[after]&c=$_GET[c]");
else
{
	$data = file_get_contents2("https://9gag.com/v1/group-posts/group/$type/type/fresh");
	// https://9gag.com/v1/group-posts/group/nsfw/type/fresh

	//$data = file_get_contents2("https://www.9gag.com/nsfw");
}

echo $data;

exit;

function file_get_contents2($url)
{
	$response = null;
	if (curl_version()["features"] & CURL_VERSION_HTTP2 !== 0)
	{
	    $ch = curl_init();
	    
	    curl_setopt_array($ch, [
	        CURLOPT_URL            =>'https://9gag.com/favicon.ico',
	        // CURLOPT_HEADER         =>true,
	        // CURLOPT_NOBODY         =>true,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_RETURNTRANSFER =>true,
	        CURLOPT_HTTPHEADER=>array(
				// "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36",
				"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.74 Safari/537.36 Edg/79.0.309.43",
				
	        	"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
	        	"accept-encoding: gzip,deflate,br", // br
	        	"accept-language: en-US,en;q=0.5",
	        	"connection: keep-alive",
	        	"upgrade-Insecure-Requests: 1",
	        	"host: 9gag.com",
				"pragma: no-cache",
				"sec-fetch-dest: image",
				"sec-fetch-mode: no-cors",
				"sec-fetch-site: same-origin",
				"referer: https://9gag.com/v1/group-posts/group/nsfw/type/fresh",
	        	"cookie: __cfduid=de865418f4061d7ed41996703a5e72d1d1582907863; ____ri=7870; ____lo=IL; gag_tz=2; _ga=GA1.2.1078381762.1582909110; _fbp=fb.1.1582909111621.1131917456; d7s_uid=k2x5k67wwxvbi9; sign_up_referer=https%3A%2F%2Fwww.yabs.io%2Fa%2Fview.php%3Fuser%3Dxxx%26tag%255B%255D%3Dsongs; __gads=ID=c11b0d35a1aa2d11:T=1582924375:S=ALNI_MYQsXhz9Hei_1-IXeD0pyNFg6Nx8Q; _pk_ref.7.f7ab=%5B%22%22%2C%22%22%2C1583517321%2C%22https%3A%2F%2Fwww.yabs.io%2Fa%2Fview.php%3Fuser%3Dxxx%26tag%5B%5D%3Dsongs%22%5D; _gid=GA1.2.315911891.1583517321; PHPSESSID=o6rj7cqj0a07bv2svn8tc2766m; session=eyJpdiI6ImdMdXpSeWNEME92eHFQa3Rra3dwOFwvaU03OHpOTHZOdDYwbWhYQ1lCbUFFPSIsInZhbHVlIjoiaGljR2g3R2tMWnN6R29PNklDMjMrYTdieW44MDluNDBhN0J4YUFrU2dwcERjNTgzRGY5U0s5QlpkTFZhUWZ5M3ZGcGV5NXRsXC95OVA3M0NHYVgrM2lXQnRtXC82WkU0bHVZMWJxSDBjRFJZNkpBbitCNXprUHZUWGRaYnlxKzFvUjZBZ3hiNEQ5ZjBEQUJMUU5GRmlBNFlcL2VobWNmenROTGxPM2IzZ2lyUmgrbHV2aTFHWW5iamVIZ0VBUkg4SjdXM0U1QkhrSE9nRG9FTnFSeFwvRmV1QmEyc3orYTYyVTBWaTRJbmVUYVRTcDFQSXB3SHl5WEZXWUtEb2ttSW1FZCt0aGlNazhnUmJHUDFqTXI1RVwvVU5Kbk9qMVwvNU1JTFB6UG02WGgxXC93cGw4PSIsIm1hYyI6ImFiMzk1NjJjZTUzMGVhMDYxMDA4ZmE0OGJhNjE2NTdlYjFkN2U2NDg1ZjIyNjJkYzNjOGEzODM4ZGZmYTAxNmIifQ%3D%3D; ts1=d4c8e6e4c6315f77ac6f2813d7aa2ce582a0d817; _pk_id.7.f7ab=0aa290f4b9b4ec46.1582909110.3.1583517842.1583517321.",
	        	),
	        CURLOPT_HTTP_VERSION   =>CURL_HTTP_VERSION_2_0,
	    ]);
		curl_exec($ch);
		
	    curl_setopt_array($ch, [
	        CURLOPT_URL            =>$url,
	        // CURLOPT_HEADER         =>true,
	        // CURLOPT_NOBODY         =>true,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_RETURNTRANSFER =>true,
	        CURLOPT_HTTPHEADER=>array(
				// "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36",
				"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.74 Safari/537.36 Edg/79.0.309.43",
				
	        	"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
	        	"accept-encoding: gzip,deflate,br", // br
	        	"accept-language: en-US,en;q=0.5",
	        	"connection: keep-alive",
	        	"upgrade-Insecure-Requests: 1",
	        	"host: 9gag.com",
				"pragma: no-cache",
				"sec-fetch-dest: document",
				"sec-fetch-mode: navigate",
				"sec-fetch-site: none",
				"sec-fetch-user: ?1",
	        	"cookie: __cfduid=de865418f4061d7ed41996703a5e72d1d1582907863; ____ri=7870; ____lo=IL; gag_tz=2; _ga=GA1.2.1078381762.1582909110; _fbp=fb.1.1582909111621.1131917456; d7s_uid=k2x5k67wwxvbi9; sign_up_referer=https%3A%2F%2Fwww.yabs.io%2Fa%2Fview.php%3Fuser%3Dxxx%26tag%255B%255D%3Dsongs; __gads=ID=c11b0d35a1aa2d11:T=1582924375:S=ALNI_MYQsXhz9Hei_1-IXeD0pyNFg6Nx8Q; _pk_ref.7.f7ab=%5B%22%22%2C%22%22%2C1583517321%2C%22https%3A%2F%2Fwww.yabs.io%2Fa%2Fview.php%3Fuser%3Dxxx%26tag%5B%5D%3Dsongs%22%5D; _gid=GA1.2.315911891.1583517321; PHPSESSID=o6rj7cqj0a07bv2svn8tc2766m; session=eyJpdiI6ImdMdXpSeWNEME92eHFQa3Rra3dwOFwvaU03OHpOTHZOdDYwbWhYQ1lCbUFFPSIsInZhbHVlIjoiaGljR2g3R2tMWnN6R29PNklDMjMrYTdieW44MDluNDBhN0J4YUFrU2dwcERjNTgzRGY5U0s5QlpkTFZhUWZ5M3ZGcGV5NXRsXC95OVA3M0NHYVgrM2lXQnRtXC82WkU0bHVZMWJxSDBjRFJZNkpBbitCNXprUHZUWGRaYnlxKzFvUjZBZ3hiNEQ5ZjBEQUJMUU5GRmlBNFlcL2VobWNmenROTGxPM2IzZ2lyUmgrbHV2aTFHWW5iamVIZ0VBUkg4SjdXM0U1QkhrSE9nRG9FTnFSeFwvRmV1QmEyc3orYTYyVTBWaTRJbmVUYVRTcDFQSXB3SHl5WEZXWUtEb2ttSW1FZCt0aGlNazhnUmJHUDFqTXI1RVwvVU5Kbk9qMVwvNU1JTFB6UG02WGgxXC93cGw4PSIsIm1hYyI6ImFiMzk1NjJjZTUzMGVhMDYxMDA4ZmE0OGJhNjE2NTdlYjFkN2U2NDg1ZjIyNjJkYzNjOGEzODM4ZGZmYTAxNmIifQ%3D%3D; ts1=d4c8e6e4c6315f77ac6f2813d7aa2ce582a0d817; _pk_id.7.f7ab=0aa290f4b9b4ec46.1582909110.3.1583517842.1583517321.",
	        	),
	        CURLOPT_HTTP_VERSION   =>CURL_HTTP_VERSION_2_0,
	    ]);
	    
	    $response = curl_exec($ch);
	    // file_put_contents('test.png', $response);
	    // $fp = fopen('test2.png', 'wb');
	    // fwrite($fp, $response);
	    // fclose($fp);
	    // if ($response !== false && strpos($response, "HTTP/2") === 0)
	    // {
	    //     // echo "HTTP/2 support!";
	    // }
	    // elseif ($response !== false)
	    // {
	    //     $response = "No HTTP/2 support on server.";
	    // }
	    // else
	    // {
	    //     echo curl_error($ch);
	    // }

	    curl_close($ch);
	}
	else
	{
	    $response = "No HTTP/2 support on client.";
	}

	return brotli_uncompress($response);
}