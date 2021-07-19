<?php
// require('phphead.php');
// require('sqlconfig.php');
// $con = new mysqli($host, $user, $pass, $db);
// if($con->connect_error){
	// die("Database Error: ".$con->connect_error);
// }
// if(isset($_POST["clan"])){
	// $cid = intval($_POST["clan"]);
	// $sql = "SELECT * FROM clans WHERE id='$cid' LIMIT 1";
	// $sgid = $con->query($sql)->fetch_assoc()["sgid"];
	// if(isset($sgid) && !empty($sgid)){
		// $cls = $ts3_VirtualServer->serverGroupClientList($sgid);
		// foreach($cls as $cl){
			// $cname = $cl["client_nickname"];
			// $mdbid = $cl["cldbid"];
			// echo "<option value='$mdbid'>$cname</option>";
		// }
	// }
// }
?>

<?php
function getclientip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        else if(!empty($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];
        else if(!empty($_SERVER['REMOTE_ADDR']))
            return $_SERVER['REMOTE_ADDR'];
        else
            return false;
    }
// require_once("function.php");
require_once ("TeamSpeak3/TeamSpeak3.php");
require_once('config.php');
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
$ts3 = $ts3_VirtualServer;
foreach($ts3_VirtualServer->clientList() as $client) {
if(getclientip() == $client['connection_client_ip']) {
$verfied++;
$client_info = $client;	
$result[] = $client->client_nickname;
$client_verified = $client;
$nicknames[] = $client["client_nickname"];
$nickname = $client["client_nickname"];
$description = $client["client_description"];
$totalconnections = $client["client_totalconnections"];
$platform = $client["client_platform"];
$country = strtolower($client["client_country"]);
$_SESSION ['ggids'] = explode(",", $client_verified["client_servergroups"]);
$dbid = $client["client_database_id"];
$uid = $client["client_unique_identifier"];
$ggids = explode(",", $client["client_servergroups"]);
$clients_online = $ts3_VirtualServer["virtualserver_clientsonline"];
$r = explode(',',$client["client_servergroups"]);
$move = $ts3_VirtualServer->clientGetByDbid($dbid);
$poke = $ts3_VirtualServer->clientGetByDbid($dbid);
$clid = $client["clid"];
$client_db = $dbid;
$_SESSION['verfied'] = $verfied;
}
}
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}

if(isset($_POST["clan"])){
	$cid = intval($_POST["clan"]);
	$sql = "SELECT * FROM clans WHERE id='$cid' LIMIT 1";
	$sgid = $con->query($sql)->fetch_assoc()["sgid"];
	if(isset($sgid) && !empty($sgid)){
		$cls = $ts3_VirtualServer->serverGroupClientList($sgid);
		foreach($cls as $cl){
			$cname = $cl["client_nickname"];
			$mdbid = $cl["cldbid"];
			echo "<option value='$mdbid'>$cname</option>";
		}
	}
}
?>