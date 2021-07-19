<?php 
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "test";
$conM = new mysqli($host, $user, $pass, $db);
if($conM->connect_error){
	die("Database Error: ".$conM->connect_error);
}
?>