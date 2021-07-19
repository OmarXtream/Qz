<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once("TeamSpeak3/TeamSpeak3.php");
require_once("config.php");
TeamSpeak3::init();
$zemo = "act-check[".mt_rand(1, 99999)."]";
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$zemo");
 // require 'inc/head.php'; 
 // require 'inc/sidebar.php'; 
 // require 'inc/headern.php'; 
 require 'sqlconfig.php';
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}
$sql = "SELECT * FROM actuser";
	$res = $con->query($sql);
	while($data = $res->fetch_assoc()){
		$idx = intval($data["id"]);
		$ip = strval($data["ip"]);
		$acts = $data["act"];
		$stime = $data["sdate"];
		$cx = intval($data["cldbid"]);
		$infox = $ts3->clientInfoDb($cx);
		$uidx = strval($infox["client_unique_identifier"]);
		
		$sql = "SELECT ip FROM user_iphash WHERE uuid='$uidx' LIMIT 1;";
		// $sql = "SELECT inet_ntoa(conv(HEX(`ip`), 16, 10)) AS ip FROM user WHERE cldbid='$cx' LIMIT 1";
		$ipx = strval($con->query($sql)->fetch_assoc()["ip"]);
		if($ip !== $ipx){
			$sqlx = "UPDATE actuser SET ip='$ipx' WHERE id='$idx' LIMIT 1;";
			$con->query($sqlx);
			// $ip = $ipx;
		}
	}
												
 ?>

 
 