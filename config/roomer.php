<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();
$zemo = "Room-Sorter[".mt_rand(1, 99999)."]";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$zemo");
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}

$sql = "SELECT * FROM roomz ORDER BY points DESC";
$res = $con->query($sql);
if($res->num_rows > 0){
	try{
			$orderz = array();
			$chs = array();
			while($data = $res->fetch_assoc()){
				$chs[] = $data;
			}
			$channel = $ts3->channelGetById(791)->subChannelList();
			foreach($channel as $ckey => $chz){
				array_push($orderz, $chz["channel_order"]);
			}
			$i = 0;
			foreach($chs as $rm){
				try{
					$ts3->channelGetById($rm["room"])["channel_order"] = $orderz[$i];
					$i++;
				}catch (Exception $e) {
					continue;
				}
			}
			// $sql = "UPDATE roomz SET points=0"; $con->query($sql);
			
		}catch (Exception $e) {
			echo $e->getMessage();
        }
}
?>