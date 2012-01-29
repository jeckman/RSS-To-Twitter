<?php
/* 
RSS to Twitter v0.1
by paul stamatiou 
of http://paulstamatiou.com
based on code from
http://morethanseven.net/posts/posting-to-twitter-using-php
*/
include('parse.php');
$uname = 'username';//example "blah" for twitter.com/blah, or your email address
$pwd = 'password';

$twitter_url = 'http://twitter.com/statuses/update.xml';
$feed = 'http://FeedUrlGoesHereEndsIn.xml'; //the feed you want to micro-syndicate
$rss = new lastRSS;
if ($rs = $rss->get($feed)){
    $title = $rs[items][0][title];
    $definition = $rs[items][0][description];
    $url = $rs[items][0][link];
} else { die('Error: RSS file not found, dude.'); }
$tiny_url =  curlGet("http://tinyurl.com/api-create.php?url=" . $url);
$status = $title . " (" . $tiny_url . "): ". $definition;
echo $status; //just for status if you are directly viewing the script
$curl_handle = curl_init();
curl_setopt($curl_handle,CURLOPT_URL,"$twitter_url");
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl_handle,CURLOPT_POST,1);
curl_setopt($curl_handle,CURLOPT_POSTFIELDS,"status=$status");
curl_setopt($curl_handle,CURLOPT_USERPWD,"$uname:$pwd");
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);
if (empty($buffer)){echo '<br/>message';}else{echo '<br/>success';}?>


