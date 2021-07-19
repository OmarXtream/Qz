<?php
// pstree | grep php
//  ps xuww | grep php
//  kill -9 9922
//  kill -9 10041
//  ps xuww | grep php

//screen -S actbot php b-actadmin.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
require_once("sqlconfigv2.php");
TeamSpeak3::init();
$Activator =  'Activator-Bot';
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$Activator");
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
	  $conM = $GLOBALS['conM'];

	  $ts3->clientListReset();
	  if($event["client_type"] == 1){
		  return;
	  }
		$dbid = $event["client_database_id"];
		$cl = $ts3->clientGetByDbid($dbid);
		///Ticket Notfication -Q
		$uid = $event["client_unique_identifier"];
		$sql = "SELECT * FROM ticket_notification WHERE uid='$uid'";
		$res = $conM->query($sql);
		if($res->num_rows > 0){
		while($row = mysqli_fetch_array($res)){
		$id = $row["id"] ;
		$cl->message($row["msg"]);
		$cl->poke("هنالك رد جديد بالتذكرة الخاصة بك ، الخاص للمزيد من التفاصيل");
		$sql = "DELETE FROM ticket_notification WHERE id='$id'";
		$res = $conM->query($sql);

			}
		}	
		////////
		$cgrp = explode(',', $cl["client_servergroups"]);
		if(!in_array(9, $cgrp)){
			return;
		}
		$ip = $cl["connection_client_ip"];
		$con = $GLOBALS['con'];
		$sql = "SELECT * FROM actuser WHERE ip='$ip' OR cldbid='$dbid'";
		$res = $con->query($sql);
		if($res->num_rows > 0){
			return;
		}	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://v2.api.iphub.info/ip/$ip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$headers = [
		'X-Key: Mjk4OmRodDlMMGpOUnN5TGxOaDIxdzZ5Q05SaWRDR1Y0enE3'
	];
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$json = json_decode(curl_exec($ch), true);
	curl_close ($ch);
	$x = $json["block"];
		$sql = "INSERT INTO actuser (id, cldbid, ip, vpn, act, status) VALUES (NULL, '$dbid', '$ip', '$x', '0', '1')";
		$con->query($sql);
		NotfiyAdmins ($ts3) ;
	}catch(TeamSpeak3_Transport_Exception $e){
		unset($ts3);
		sleep(1);
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$Activator");
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
 
function NotfiyAdmins ($ts3)
{
			try {
			$ts3->clientListReset();
			foreach($ts3->clientList(array("client_type" => 0)) as $client){
			$groups = explode(",", $client['client_servergroups'] );
			if(in_array(2475, $groups) || ($client['client_type'] == 1)) {
			$client->poke("هنالك عضو يحتاج للتفعيل !");
		}	
	}	
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

}
?>