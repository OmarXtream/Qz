<?php
die("تجربة");
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once 'phphead.php'; 

$hostz = "localhost";
$userz = "root";
$passz = "qvaGN6vy9EaZMw5l";
$dbz = "yt"; 
$con = new mysqli($hostz, $userz, $passz, $dbz);
if($con->connect_error){
	die("Failed To COnnect!");
}

require_once 'google_api/Google_Client.php';
require_once 'google_api/contrib/Google_YoutubeService.php';

$channel_id = "uPqJkPdCiKafQkyClDAt8GU_";
$api_key = "uPqJkPdCiKafQkyClDAt8GU_";
$api_response = file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$channel_id.'&fields=items/statistics/subscriberCount&key='.$api_key);
$api_response_decoded = json_decode($api_response, true);
echo $api_response_decoded['items'][0]['statistics']['subscriberCount'];

$con->close();
?>