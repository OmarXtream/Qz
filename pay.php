<?php

require 'config/phphead.php';
// die("x");
require 'includes/sweetalert.php'; 
require 'storezsadwasdewd/start.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
 if($con->connect_error){
	 die("Database Error: ".$con->connect_error);
 }
$x = strval(getclientip());
$cldbid = $dbid ;

if(!isset($_GET["success"]) || !isset($_GET["paymentId"]) || !isset($_GET["PayerID"])){
		die('<script>
           swal({title: "خطا",text: "فشل دخول الصفحة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); 
}

if($_GET["success"] == false){
		die('<script>
           swal({title: "خطا",text: "فشلت عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');
}

$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$result = $con->query($sql) or die($con->error);
while($row = $result->fetch_assoc()) {
$coins = $row["coins"] ;
}
if(!empty($coins)){
	$coins = $coins;
}else{
	$coins = 0;
}

$paymentId = strval($con->real_escape_string(htmlspecialchars(stripslashes(strip_tags(trim($_GET["paymentId"]))))));
$payerId = strval($con->real_escape_string(htmlspecialchars(stripslashes(strip_tags(trim($_GET["PayerID"]))))));

$payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
$execute = new \PayPal\Api\PaymentExecution();
$execute->setPayerId($payerId);

try {
	$result = $payment->execute($execute, $apiContext);
	$sql = "SELECT * FROM store_coins WHERE payment='$paymentId' AND ip='$x' AND status!= '1'";
	$res = $con->query($sql);
	if($res->num_rows === 1){
		$data = $res->fetch_assoc();
		$id = intval($data["id"]);
		$rank = intval($data["value"]);
		$user = intval($data["buyer"]);
		$sql = "UPDATE store_coins SET status='1' WHERE id='$id'";
		if(!$con->query($sql) === true){
die('<script>
           swal({title: "خطا",text: "فشلت عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');
		}
			$coins = $coins + $rank ;
			$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
			$con->query($sql);
			try {
				$ts3->clientGetByDbid($user)->poke("تمت عملية الشراء بنجاح!");
			}catch(Exception $e){
				
			
		}
	}else{
die('<script>
           swal({title: "خطا",text: "لم يتم العثور على عمليةالدفع المسبقة!",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');
	}
}catch(Exception $e){
die('<script>
           swal({title: "خطا",text: "فشلت عملية الشراء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');
}

echo '<script>
           swal({title: "تم",text: "عملية الشراء بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/store");}else {window.location.replace("https://panel.q-z.us/store");}})</script>';
?>