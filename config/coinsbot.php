<?php
// screen -S coinsbot php coinsbot.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();

$nick = "CoinsBot";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$nick");

$afkseconds = 3600; // عدد الثوانى الأفك التى لا يجب تخطيها لو تخطها ينحسب لة مورو افك بونت
$boost = array(1892); // رتب البوست
$expect = array(75,1146,19,9,860,90,89,21,131); // الرتب التى لا تحسب 
$pointperone = 0.003; // عدد النقاط لكل العضو
$boostpoints = 0.006; // عدد نقاط البوست
$moreafkpoints = 0.0001; // عدد نقاط بعد الوقت المحدد والاقل من ساعة

$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}

$ts3->notifyRegister("server");
$ts3->notifyRegister("textserver");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("serverqueryWaitTimeout", "onTimeout");


while(1){
   $ts3->channelListReset();
   $ts3->clientListReset();
    try{
			
		$cls = $ts3->clientList(array("client_type" => 0));
		foreach($cls as $cl){
			$idle = ceil($cl["client_idle_time"] / 1000);
			$uid = $cl["client_unique_identifier"];
			// if($uid != "CUQTzCzzIWAbKhGn6WFzNHEjIhY="){
				// continue;
			// }
			$srvg = explode(",", $cl["client_servergroups"]);
			if(count(array_intersect($srvg, $boost)) > 0 && $idle < $afkseconds){
					$sql = "UPDATE user SET coins = coins + '$boostpoints' WHERE uuid='$uid' LIMIT 1";
					$con->query($sql);
			}else if(count(array_intersect($srvg, $expect)) <= 0 && $idle < $afkseconds){
					$sql = "UPDATE user SET coins = coins + '$pointperone' WHERE uuid='$uid' LIMIT 1";
					$con->query($sql);
			}else if(count(array_intersect($srvg, $expect)) <= 0 && $idle > $afkseconds && $idle < 7200){
					$sql = "UPDATE user SET coins = coins + '$moreafkpoints' WHERE uuid='$uid' LIMIT 1";
					$con->query($sql);
			}
		}
		
	}catch (Exception $e) {
		echo $e->getMessage();
	}
	
	try{
		$ts3->getAdapter()->request("clientupdate");
	}catch(Exception $e){
		TeamSpeak3_Transport_TCP::connect();
	}
	$ts3->getAdapter()->request("clientupdate");
	sleep(5);
}

function onTimeout($seconds, TeamSpeak3_Adapter_ServerQuery $adapter){
    $adapter->request("clientupdate");
}
?>