<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();

$nick = "Room-Manager1";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$nick");
$token = "775374883:AAEyMm1_9z1DInUhmPbDSOvetO-gqgPeunY";
$chatid = "-1001289703108";

$afkseconds = 18000; // عدد الثوانى الأفك التى لا يجب تخطيها
$expect = array(89, 90); // الرتب التى لا تحسب 
$pointperone = 0.0001; // عدد النقاط لكل العضو نضرب في عشان ال cpu
$delroom = 86400; // الوقت بالثوانى لحذف الروم غير المتفاعل
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
		 $sql = "SELECT * FROM roomz WHERE blocked='0'";
		 $res = $con->query($sql);
		 if($res->num_rows > 0){
			while($data = $res->fetch_assoc()){
			
			 $idx = intval($data["id"]);
			 $room = intval($data["room"]);
			 $total = $data["points"]; 

		
			$cx = 0;

				$ch = $ts3->channelGetById($room);
				if($ch["seconds_empty"] >= $delroom){
			//	DeleteRoom ($idx, $room , $ts3 , $con) ;
				//	$ts3->channelDelete($room, true);
					//$sql = "DELETE FROM roomz WHERE id='$idx'";
				//	$con->query($sql);
				}
				$cz = $ch->clientList(array("client_type" => 0));
				if(count($cz) > 0){
					foreach($cz as $cl){
						$idle = ceil($cl["client_idle_time"] / 1000);
						$xsg = explode(",", $cl["client_servergroups"]);
						if(count(array_intersect($xsg, $expect)) <= 0 && $idle < $afkseconds ){
							$cx += 1;
						}
					}
				}

			
			$total = $total + ($cx * $pointperone);
			$sql = "UPDATE roomz SET points='$total' WHERE id='$idx'";
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

function DeleteRoom ($id, $room , $ts3 , $con) {
	$ch = $ts3->channelGetById($room);
	$RoomName = $ch["channel_name"] ; 
	$seconds_empty = $ch["seconds_empty"] ; 
	$sql = "SELECT * FROM roomz WHERE blocked='0' AND room='$room'";
	$res = $con->query($sql);
	if($res->num_rows > 0){
	while($data = $res->fetch_assoc()){
		$ClientDb = $data["owner"];
		}
	$remotedb = $ts3->clientInfoDb($ClientDb);
	$ClientNickName = $remotedb["client_nickname"] ;
	
	//Delete Stuff
		//	$ts3->channelDelete($room, true);
	//$sql = "DELETE FROM roomz WHERE id='$idx'";
				//	$con->query($sql);
	$msg = "\n\n\n[ Room ] : ". $RoomName . "\n[ Client ] : " . $ClientNickName . " \n\n تم حذف الروم بسبب عدم تفاعلة لمدة يوم" ;
	sendMessage("-1001289703108", $msg, "775374883:AAEyMm1_9z1DInUhmPbDSOvetO-gqgPeunY") ; 
	
	
	///////
	
	
	}
}


function sendMessage($chatID, $messaggio, $token) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
















?>