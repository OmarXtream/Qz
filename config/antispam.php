<?php
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("TeamSpeak3/TeamSpeak3.php");
$Query_username = "serveradmin";
$Query_password = "vlQlZunI";
$Query_host = "193.70.17.6";
$Query_port = 10011;
$Server_port = 9987;
$nick = "Qz-AntiSpam2";
TeamSpeak3::init(); 

$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$nick&channel=84727");

// $ts3->notifyRegister("server",0); 
$ts3->notifyRegister("channel",165707);
// $ts3->notifyRegister("textserver"); 
// $ts3->notifyRegister("textchannel"); 
// $ts3->notifyRegister("textprivate"); 

TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifychannelcreated", "onChannelCreate");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifychanneledited", "onChannelEdit");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifychannelchanged", "onChannelChange");
TeamSpeak3_Helper_Signal::getInstance()->subscribe("notifychannelmoved", "onChannelMove");

while(1) $ts3->getAdapter()->wait();

function onChannelCreate(TeamSpeak3_Adapter_ServerQuery_Event $event, TeamSpeak3_Node_Host $host){
 print("<pre>".print_r($event, true)."</pre>");
 die;
}

function onChannelMove(TeamSpeak3_Adapter_ServerQuery_Event $event, TeamSpeak3_Node_Host $host){
 print("<pre>".print_r($event, true)."</pre>");
 die;
}

function onChannelChange(TeamSpeak3_Adapter_ServerQuery_Event $event, TeamSpeak3_Node_Host $host){
 print("<pre>".print_r($event, true)."</pre>");
 die;
}

function onChannelEdit(TeamSpeak3_Adapter_ServerQuery_Event $event, TeamSpeak3_Node_Host $host){
 print("<pre>".print_r($event, true)."</pre>");
 die;
}
?>