<?php 
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Database Error: ".$con->connect_error);
}
$admingroup = '266';	

?>