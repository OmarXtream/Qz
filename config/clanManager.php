<?php
// ياسباركي نسينا نعمل الكلان ولكم يعني اول ما العضو يدخل ينسحب اول روم بالكلان ونساوي لها خصاصيه يعني رتبه بالتيم سبيك الي معاه Skip clan walcome ما ينسحب للروم
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();

$nick = "Clan-Manager";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$nick");

$afkseconds = 300; // عدد الثوانى الأفك التى لا يجب تخطيها
$expect = array(89, 90); // الرتب التى لا تحسب 
$pointperone = 0.0005; // عدد النقاط لكل العضو نضرب في 5 عشان الاسليب القيمة الاصلية 0.0001
$afkmove = 3600; // عدد الثوانى لسحب العضو الى روم الافك
$ignoreafk = array(67,1505,75,1146,1523); // الرتب اللى ما تنسحب للأفك

$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}

function getRooms($cid, &$array = array()){
	global $ts3;
	if(count($ts3->channelGetById($cid)->subChannelList()) > 0){
		$rooms = $ts3->channelGetById($cid)->subChannelList();
		foreach($rooms as $room){
			$x = $room["cid"];
			array_push($array, $room);
			if(count($ts3->channelGetById($x)->subChannelList()) > 0){
				getRooms($x, $array);
			}	
		}
	}
	return $array;
}

$ts3->notifyRegister("server");
$ts3->notifyRegister("textserver");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("serverqueryWaitTimeout", "onTimeout");


while(1){
   $ts3->channelListReset();
   $ts3->clientListReset();
    try{	
		 $sql = "SELECT * FROM clans";
		 $res = $con->query($sql);
		 if($res->num_rows > 0){
			while($data = $res->fetch_assoc()){
			
			 $idx = intval($data["id"]);
			 $sgid = intval($data["sgid"]);
			 $afkroom = $ts3->channelGetById(intval($data["afk"]));
			 $mainroom = intval(unserialize($data["rooms"])[1]);
			 $xx = getRooms($mainroom);
			 $total = $data["points"]; 
			 
			 if(in_array($afkroom, $xx)){
				 $ix = array_search($afkroom, $xx);
				 unset($xx[$ix]);
			 }
			
			$cx = 0;
			foreach($xx as $ch){
				$cz = $ch->clientList(array("client_type" => 0));
				if(count($cz) > 0){
					foreach($cz as $cl){
						$idle = ceil($cl["client_idle_time"] / 1000);
						$xsg = explode(",", $cl["client_servergroups"]);
						if(count(array_intersect($xsg, $expect)) <= 0 && $idle < $afkseconds && in_array($sgid, $xsg)){
							$cx += 1;
						}
					}
				}
			}
			
			$call = $ts3->serverGroupClientList($sgid);
			
			foreach($call as $cli){
				$cdb = intval($cli["cldbid"]);
				try{
					$cln = $ts3->clientGetByDbid($cdb);
					$idle = ceil($cln["client_idle_time"] / 1000);
					$clng = explode(",", $cln["client_servergroups"]);
					if(count(array_intersect($clng, $ignoreafk)) <= 0 && $idle >= $afkmove){
						$cln->move(intval($data["afk"]));
					}
				}catch(Exception $e){}
			}
			
			$total = $total + ($cx * $pointperone);
			$sql = "UPDATE clans SET points='$total' WHERE id='$idx'";
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