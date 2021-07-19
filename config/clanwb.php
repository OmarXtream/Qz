<?php
//screen -S clanwb php clanwb.php
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();

$nick = "Clan-WB";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$nick");

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
$ts3->notifyRegister("textchannel", 0);
TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifyCliententerview", "onJoin");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("serverqueryWaitTimeout", "onTimeout");
while(1){
	// $ts3->channelListReset();
	// $ts3->clientListReset();
	$ts3->getAdapter()->wait();
	try{
		$ts3->getAdapter()->request("clientupdate");
	}catch(Exception $e){
		TeamSpeak3_Transport_TCP::connect();
	}
	$ts3->getAdapter()->request("clientupdate");
	
} 
function onTimeout($seconds, TeamSpeak3_Adapter_ServerQuery $adapter){
    $adapter->request("clientupdate");
}
function onJoin(TeamSpeak3_Adapter_ServerQuery_Event $event, TeamSpeak3_Node_Host $host){
   global $ts3;
   global $con;
//if($event["client_type"] <= 0){
	// sleep(5);
   $dbid = $event["client_database_id"];
   $clx = $ts3->clientGetByDbid($dbid);
   $csgroup = explode(',', $clx["client_servergroups"]);
   //echo $clx["client_nickname"]."\n";
  // print("<pre>".print_r($csgroup, true)."</pre>");
   //exit;
   
   $ign = array(1502);
   if(count(array_intersect($csgroup, $ign)) > 0){ return; }
   $sql = "SELECT sgid,wlc FROM clans";
   $res = $con->query($sql);
    if($res->num_rows > 0){
	    while($data = $res->fetch_assoc()){
		    $sgz = intval($data["sgid"]);
		    $wlc = intval($data["wlc"]);
		    if(in_array($sgz, $csgroup)){
				try{
					$clx->move($wlc);
					return;
				}catch(TeamSpeak3_Exception $e){ return; }

		    }
		  
	    }
    }
	
} 

?>