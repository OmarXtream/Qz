<?php
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();
$botnick =  'Fox-Bot2';
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botnick");
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "test";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}
$ts3->notifyRegister("server");
$ts3->notifyRegister("textserver");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifyCliententerview", "onJoin");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("serverqueryWaitTimeout", "onTimeout");

while(1){
	try{
		$ts3->getAdapter()->wait();
		$ts3->getAdapter()->request("clientupdate");
	}catch(Exception $e){
		TeamSpeak3_Transport_TCP::connect();
	}
}

function onJoin(TeamSpeak3_Adapter_ServerQuery_Event $event, TeamSpeak3_Node_Host $host){
	try{
	  $ts3 = $GLOBALS['ts3'];
	  $ts3->clientListReset();
	  if($event["client_type"] == 1){
		  return;
	  }
		$dbid = $event["client_database_id"];
		$cl = $ts3->clientGetByDbid($dbid);
		$clc = $cl["client_country"];
		// $cgrp = explode(',', $cl["client_servergroups"]);
		// if(!in_array(9, $cgrp)){
			// return;
		// }
		$ip = $cl["connection_client_ip"];
		$con = $GLOBALS['con'];
		$sql = "SELECT * FROM userlog WHERE ip='$ip' AND cldbid='$dbid'";
		$res = $con->query($sql);
		if($res->num_rows === 1){
			$ix = intval($res->fetch_assoc()["id"]);
			$now = time();
			$sql = "UPDATE userlog SET lastjoin='$now', num = num + 1 WHERE id='$ix'";
			$con->query($sql);
		}else{
			$now = time();
			$sql = "INSERT INTO userlog (id,cldbid,ip,lastjoin,country,num) VALUES (NULL, '$dbid', '$ip', '$now','$clc', '1')";
			$con->query($sql);
		}
		
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL,"http://v2.api.iphub.info/ip/$ip");
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $headers = [
			// 'X-Key: Mjk4OmRodDlMMGpOUnN5TGxOaDIxdzZ5Q05SaWRDR1Y0enE3'
		// ];
		// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// $json = json_decode(curl_exec($ch), true);
		// curl_close ($ch);
		// $x = $json["block"];
		// $sql = "INSERT INTO actuser (id, cldbid, ip, vpn, act, status) VALUES (NULL, '$dbid', '$ip', '$x', '0', '1')";
		// $con->query($sql);
	}catch(TeamSpeak3_Transport_Exception $e){
		unset($ts3);
		sleep(1);
		$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botnick");
		$ts3->notifyRegister("server");
		TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifyCliententerview", "onJoin");
		$ts3->getAdapter()->wait();
	}
 $ts3->getAdapter()->request("clientupdate");
}
function onTimeout($seconds, TeamSpeak3_Adapter_ServerQuery $adapter)
{
    $adapter->request("clientupdate");
}
?>