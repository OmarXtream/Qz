<?php

//fk you spirke hhhhhhhhhhhhh ksomk

// screen -S Prestige php Prestige.php
// ps xuww | grep php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();

$nick = "Prestige";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$nick");


while(true){
	
   $ts3->channelListReset();
   $ts3->clientListReset();
   
    try{
		
		$clx = $ts3->clientList(array("client_type" => 0));
		foreach($clx as $cl){
			$srv = explode(",", $cl["client_servergroups"]);
			
			if(in_array(131, $srv)){ // الرتب المعفية من هالنظام
				continue;
			}else if(in_array(1646, $srv)){
				continue;
			}else if(in_array(10, $srv)){
				continue;
			}else if(in_array(1555, $srv)){
				continue;
			}else if(in_array(1557, $srv)){
				continue;
			}else if(in_array(1554, $srv)){
				continue;
			}else if(in_array(1556, $srv)){
				continue;
			}else if(in_array(1553, $srv)){
				continue;
			}
			
			if(in_array(305, $srv)){ // رتبة لفل ماكس هنا 
			
			    $host = "localhost";
				$user = "root";
				$pass = "qvaGN6vy9EaZMw5l";
				$db = "Rankqz";
				$con = new mysqli($host, $user, $pass, $db);
				if($con->connect_error){
					die("Failed To Connect To Database!");
				}
				
				$dbid = $cl["client_database_id"];
				$uid = $cl["client_unique_identifier"];
				
				$sql = "SELECT count FROM user WHERE cldbid='$dbid' LIMIT 1;";
				$conum = intval($con->query($sql)->fetch_assoc()["count"]);
				
				$now = time();
				$timex = ($conum * -1);
				
				$sql = "INSERT INTO admin_addtime (uuid, timestamp, timecount) VALUES ('$uid', '$now', '$timex');";
				$con->query($sql);
				// if (!$con->query($sql)) {
					// printf("Error: %s\n", $con->error);
				// }
				$con->close();
				
				try{
					$ts3->serverGroupClientDel(305, $dbid); // يحذف الرتبة منة 
				}catch (Exception $e) {
						
				}
				
				sleep(1);
				
				if(in_array(1648, $srv)){ // برستيج واحد
				  
				  try{
					  $ts3->serverGroupClientDel(1648, $dbid); // حذف برستيج واحد
					  $ts3->serverGroupClientAdd(1647, $dbid); // يحط له برستيج اثنين بعد حذف واحد
				  }catch (Exception $e) {
						
				  }
				  
				  
				
				}else if(in_array(1647, $srv)){ // برستيج اثنين
				
				  try{
					  $ts3->serverGroupClientDel(1647, $dbid); // يحذف برستيج 2
					  $ts3->serverGroupClientAdd(1646, $dbid); // يحط له برستيج ماكس
				  }catch (Exception $e) {
						
				  }
				  
				  
					
				}else{
					try{
						$ts3->serverGroupClientAdd(1648, $dbid); // تشيك لو ماعنده برستيج
					}catch (Exception $e) {
							
					}
				}
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
	sleep(1);		
}

function onTimeout($seconds, TeamSpeak3_Adapter_ServerQuery $adapter){
    $adapter->request("clientupdate");
}

?>