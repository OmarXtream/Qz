<?php
//0 2 * * * php /var/www/html/config/yt.php >/dev/null 2>&1
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();
$zemo = "yt-Sorter[".mt_rand(1, 99999)."]";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$zemo");
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "yt";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}

$sql = "SELECT * FROM youtube ORDER BY sub DESC";
$res = $con->query($sql);
if($res->num_rows > 0){
	try{
			$orderz = array();
			$chs = array();
			while($data = $res->fetch_assoc()){
				$chs[] = $data;
			}
			$channel = $ts3->channelGetById(2351)->subChannelList();
			foreach($channel as $ckey => $chz){
				array_push($orderz, $chz["channel_order"]);
			}
			$i = 0;
			foreach($chs as $rm){
				try{
					$ts3->channelGetById($rm["CID"])["channel_order"] = $orderz[$i];
					$i++;
				}catch (Exception $e) {
					continue;
				}
			}
			//$sql = "UPDATE roomz SET points=0"; $con->query($sql);
			
		}catch (Exception $e) {
			echo $e->getMessage();
        }
}
?>