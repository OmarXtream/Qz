<?php
require 'config/phphead.php';
set_time_limit(0);
require_once ("config/TeamSpeak3/TeamSpeak3.php");
$Query_username = "serveradmin";
$Query_password = "vlQlZunI";
$Query_host = "193.70.17.6";
$Query_port = 10011;
$Server_port = 9987;
$botname = 'Iconizer';
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
// while(true){
	// $ts3->clientListReset();
	// $cls = array_keys($ts3->serverGroupClientList(2315));
	$cls = array(4326,12581);
	// foreach($cls as $cl){
		// try {
		// $cl = $ts3->clientGetByDbid($cl);
		// $cl->permAssign("i_icon_id", 75877921);
		// }catch(Exception $e){}
	// }
	// usleep(0.6 * 1000000);
	// foreach($cls as $cl){
		// try {
			// $cl = $ts3->clientGetByDbid($cl);
			// $cl->permAssign("i_icon_id", 2001828828);
		// }catch(Exception $e){}
	// }
	// usleep(0.6	* 1000000);
	// foreach($cls as $cl){
		// try {
			// $cl = $ts3->clientGetByDbid($cl);
			// $cl->permAssign("i_icon_id", -1133413354);
		// }catch(Exception $e){}
	// }
	// usleep(0.6 * 1000000);
// }

$cs = $ts3->clientList(array("client_type" => 0));
foreach($cls as $cx){
	$ts3->clientPermRemove($cx, "i_icon_id");
	$icid = $cx["client_icon_id"];
	if($icid == 2001828828 || $icid == -1133413354 || $icid == 75877921){
		$cx->permRemoveByName("i_icon_id");
	}
}

// Green : 2001828828
// Red : -1133413354
// Yellow : 75877921

?>