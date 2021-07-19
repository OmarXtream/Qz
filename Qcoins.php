<?php require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
    <div class="page-wrapper">
        <div class="container-fluid">
			<br>
<?php 
$transfer = 50707; //رقم روم تحويل النقاط 
$cldbid = $client_info["client_database_id"];
$con = new mysqli($host, $user, $pass, $db);
$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["coins"];
if(!empty($res)){
	$coins = $res;
}else{
	$coins = 0;
}
$xx = explode(',', $client_info["client_servergroups"]);
$sql = "SELECT * FROM codes WHERE cldbid='$cldbid'";
$result = $con->query($sql);
if(isset($_POST["iconz"]) && isset($_POST["booster"])){
	$c = intval($_POST["iconz"]);
	$lvlboost = array(1945,1946,1947,2243);
	if(!in_array($c, $lvlboost) || in_array($c, $xx)){
		
			die('<script>
           swal({title: "عذراً",text: "انت بالفعل لديك هذه الرتبه من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		

	}

	if($c === 1945 && $coins >= 520){
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', 'continue', '$st')";
		$con->query($sql);
		$coins = $coins - 520;
		$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
		$con->query($sql);
		$client_info->addServerGroup($c);
	}else if($c === 1946 && $coins >= 480){
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', 'continue', '$st')";
		$con->query($sql);
		$coins = $coins - 480;
		$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
		$con->query($sql);
		$client_info->addServerGroup($c);
	}else if($c === 1947 && $coins >= 360){
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', 'continue', '$st')";
		$con->query($sql);
		$coins = $coins - 360;
		$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
		$con->query($sql);
		$client_info->addServerGroup($c);
	}else if($c === 2243 && $coins >= 250){
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', 'continue', '$st')";
		$con->query($sql);
		$coins = $coins - 250;
		$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
		$con->query($sql);
		$client_info->addServerGroup($c);
	}else{
		die('<script>
           swal({title: "عذراً",text: "ليس لديك نقاط كافية للشراء",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');	
	}
	// $sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	// $con->query($sql);
	echo('<script>
			   swal({title: "تمت",text: "عملية الشراء بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
	
}else if(isset($_POST["icon"]) && isset($_POST["time"]) && isset($_POST["iconz"])){
	$Coins_Groups_Ides = array(1309,1310,1311,1312,896,161,713,715,716,717,722,725,732,733,33,167,626,1027,1523,1524,1525,1527,1528,1529,1531);
	$t = $_POST["time"];
	$c = $_POST["iconz"];
	if(!$t == "12H" || !$t == "24H" || !$t == "7D"){
		header("Location: coins.php");
	}else if(!in_array($c, $Coins_Groups_Ides) || in_array($c, $xx)){
		
			die('<script>
           swal({title: "عذراً",text: "انت بالفعل لديك هذه الرتبه من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		

	}
	
	if($t == "12H" && $coins >= 90){
		$timez = time() + (12*60*60);
		$tdate = date("Y:m:j:H:i:s", $timez);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 90;
		$client_info->addServerGroup($c);
	}else if($t == "24H" && $coins >= 135){
		$time = strtotime("+1 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 135;
		$client_info->addServerGroup($c);
	}else if($t == "7D" && $coins >= 500){
		$time = strtotime("+7 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 500;
		$client_info->addServerGroup($c);
	}else{
		die('<script>
           swal({title: "عذراً",text: "ليس لديك نقاط كافية للشراء",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');			   
	}

// بدايه استبدل ايقونات	
	$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	$con->query($sql);
echo('<script>
           swal({title: "تمت",text: "عملية الشراء بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
}else if(isset($_POST["vip"]) && isset($_POST["timevip"])){
	$t = $_POST["timevip"];
	if(!$t == "12H" || !$t == "24H" || !$t == "7D"){
		header("Location: coins.php");
	}else if(in_array($c, $xx)){
die('<script>
           swal({title: "عذراً",text: "انت بالفعل لديك هذه الرتبه من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');	
	}
	$c = 965;
	if($t == "12H" && $coins >= 180 ){
		$timez = time() + (12*60*60);
		$tdate = date("Y:m:j:H:i:s", $timez);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 180;
		$client_info->addServerGroup($c);
	}else if($t == "24H" && $coins >= 270){
		$time = strtotime("+1 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 270;
		$client_info->addServerGroup($c);
	}else if($t == "7D" && $coins >= 1000){
		$time = strtotime("+7 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 1000;
		$client_info->addServerGroup($c);
	}else{
die('<script>
           swal({title: "عذراً",text: "ليس لديك نقاط كافية للشراء",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		
	}
	$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	$con->query($sql);
echo('<script>
           swal({title: "تمت",text: "عملية الشراء بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}else if(isset($_POST["boostercoins"]) && isset($_POST["timeboostercoins"])){
	$t = $_POST["timeboostercoins"];
	if(!$t == "12H" || !$t == "24H" || !$t == "7D"){
		header("Location: coins.php");
	}else if(in_array($c, $xx)){
die('<script>
           swal({title: "عذراً",text: "انت بالفعل لديك هذه الرتبه من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');	
	}
	$c = 1892;
	if($t == "12H" && $coins >= 320 ){
		$timez = time() + (12*60*60);
		$tdate = date("Y:m:j:H:i:s", $timez);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 320;
		$client_info->addServerGroup($c);
	}else if($t == "24H" && $coins >= 660){
		$time = strtotime("+1 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 660;
		$client_info->addServerGroup($c);
	}else if($t == "7D" && $coins >= 2500){
		$time = strtotime("+7 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - 2500;
		$client_info->addServerGroup($c);
	}else{
die('<script>
           swal({title: "عذراً",text: "ليس لديك نقاط كافية للشراء",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		
	}
	$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	$con->query($sql);
echo('<script>
           swal({title: "تمت",text: "عملية الشراء بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}else if(isset($_POST["submit"]) && isset($_FILES['pico'])){
	if(isset($_SESSION['UPDATE_ICon']) and $_SESSION['UPDATE_ICon'] >= microtime(true)){
	echo'
                               <center><meta http-equiv="refresh" content="3;url=coins.php"> <div class="alert alert-danger alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بمحاوله رفع ايقونه او قمت برفع ايقونه , الرجاء المحاولة بعد 10 دقائق</strong></center> 
                                </div>
';
die;
}else{
	$_SESSION['UPDATE_ICon'] = microtime(true)+1;
}		
	if($coins >= 500){
		$check = getimagesize($_FILES["pico"]["tmp_name"]);
		if($check === false) {      
die('<script>
           swal({title: "عذراً",text: "حدث خطاء اعد المحاولة",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');	
		}	
		$width = $check[0];
		$height = $check[1];
	if($width > 16 || $height > 16){
die('<script>
           swal({title: "عذراً",text: "يجب ان يكون حجم الصوره 16×16",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');				
		}
		
		if ($_FILES["pico"]["size"] > 8192) {
die('<script>
           swal({title: "عذراً",text: "Image Is Too Large Max 8kb. - لأيتخطي حجم الصوره 8KB ",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');						
		}
		
		if(!$check['mime'] == 'image/png' || !$check['mime'] == 'image/gif') {
die('<script>
           swal({title: "عذراً",text: "You Only Can Upload Png - Gif Images! - لأيمكن رفع الأ GIF - Png ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');				
		}
		
		if(is_uploaded_file($_FILES["pico"]["tmp_name"])){
			$img = file_get_contents($_FILES["pico"]["tmp_name"]);
			try {
				$imgid = $ts3_VirtualServer->iconUpload($img);
			}catch(Exception $e) {
				$imgid = crc32($img);
			}
			
			try {
				 $icon = "i_icon_id";
				 $client_info["client_icon_id"] = $imgid;
				 $ts3_VirtualServer->clientPermRemove($cldbid, $icon);
				 $client_info->permAssign($icon, $imgid);
			}catch(Exception $e) {
				  try {				 
					 $ts3_VirtualServer->clientPermAssign($cldbid, $icon, $imgid);
				  }catch(Exception $e) {
die('<script>
           swal({title: "عذراً",text: "لأ يمكن رفع هذه الصورة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');						  
				   }
			}
			
		} else {
die('<script>
           swal({title: "عذراً",text: "حدث خطاء اثناء الرفع",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');				
		}
echo('<script>
           swal({title: "تم",text: "عملية استبدل ايقونة دائمة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
			$now = date("Y:m:j:H:i:s");
			$st = "active";
			$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', 'private', '$now', 'continue', '$st')";
			$con->query($sql);
			$coins = $coins - 500;
			$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
			$con->query($sql);
	}else{
		die('<script>
				   swal({title: "عذراً",text: "You Need More Coins To Buy This Item! - تحتاج الي مزيد من الكوينز",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');	
	}
}else if(isset($_POST["mvtransfer"])){
	$xz = explode(',', $client_info["client_servergroups"]);
	$cansee2 = array(136,145,146,147,148,149,150,151,152,153,890,891,892,893,894,1254,1255,1256,1257,1258,1259,1260,1261,1262,1264,1648,1647,1646,305,927,15,144,14,84,10,1672,1555,1557,1554,1556,1553);
	if(count(array_intersect($cansee2, $xz)) > 0){
		if($client_info["cid"] != $transfer){
			$client_info->move($transfer);
		}
	}
echo('<script>
           swal({title: "تم",text: "سحبك الي روم استقبال النقاط",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}else if(isset($_POST["trbtn"]) && isset($_POST["amount2"]) && isset($_POST["userrespid"])){
	$amount = intval($_POST["amount2"]);
	$transferto = intval($_POST["userrespid"]);
	if(is_int($amount) && is_int($transferto) ){
		$mdbd = $client_info["client_database_id"];
		$tndb = $ts3_VirtualServer->clientGetByDbId($transferto);
			if($amount == 0 || $amount < 100){
				die('<script>
				swal({title: "خطأ",text: "لاتستطيع التحويل اقل من 100 نقطة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');
		   	}
		if($transferto != $mdbd){
			if($coins >= $amount){
				$newcoins = $coins - $amount;
				$sql = "UPDATE user SET coins='$newcoins' WHERE cldbid='$mdbd'";
				$con->query($sql);
				$sqlz = "UPDATE user SET coins = coins + '$amount' WHERE cldbid='$transferto'";
				$con->query($sqlz);
				//2017-08-25 19:24:29
				$tnow = date("Y-m-d g:i:s");
				$sqly = "INSERT INTO transfer (id, sender, geter, amount, stime) VALUES (NULL, '$mdbd', '$transferto', '$amount', '$tnow')";
				$con->query($sqly);
				try {
				//	$ts3->clientGetByDbid(13865)->poke("تم تحويل لك : [COLOR=#298510]" . $amount . " نقطة[/COLOR] ، بواسطة -> " . $nickname);
					$tndb->poke("تم تحويل لك : [COLOR=#298510]" . $amount . " نقطة[/COLOR] ، بواسطة -> " . $nickname);

				}catch(Exception $e){
				}

				echo('<script>
						swal({title: "تم",text: "التحويل بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
				echo("<script> window.location.replace('https://panel.q-z.us/coins'); </script>");
			}else{
				die('<script>
				swal({title: "عذراً",text: "ليس لديك نقاط كافية",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		
			}
		}
	}
}


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// if(isset($_POST["icon24"])){
	// $t = $_POST["timeicon24"];
 // if(in_array(2399, $xx)){
// die('<script>
           // swal({title: "عذراً",text: "انت بالفعل لديك هذه الرتبه من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');	
	// }
	// $c = 2399;
	// if($coins >= 100){
		// $st = "active";
		// $sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', 'continue', '$st')";		
		// $sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		// $con->query($sql);
		// $coins = $coins - 100;
		// $client_info->addServerGroup($c);
	// }else{
// die('<script>
           // swal({title: "عذراً",text: "ليس لديك نقاط كافية للشراء",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		
	// }
	// $sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	// $con->query($sql);
// echo('<script>
           // swal({title: "تمت",text: "عملية الشراء بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
// }
?>

<script>
	window.onload = function() {
		if (window.jQuery) {
			$(".rtbh").change(function(){
				var rtx = $(".rtbh").val();
				if(rtx == 1945){
					$(".price").html('<b>Level Booster x5 - 1 Hours - <span class="text-danger">520</span> coins</b>');
				}else if(rtx == 1946){
					$(".price").html('<b>Level Booster x4 - 1 Hours - <span class="text-danger">480</span> coins</b>');
				}else if(rtx == 1947){
					$(".price").html('<b>Level Booster x3 - 1 Hours - <span class="text-danger">360</span> coins</b>');
				}else if(rtx == 2243){
					$(".price").html('<b>Level Booster x2 - 1 Hours - <span class="text-danger">250</span> coins</b>');
				}
			});
		}
	};
	
</script>

<script>
function CheckAndSubmitRANKS()
{

		var RankTime = document.getElementById('timevip').value;
		var RankIDV = document.getElementById('TypeG').value;
		var RankID = document.getElementById('TypeG');
		var RankName = RankID.options[RankID.selectedIndex].text;
		if ( RankName == "None" ) {
			swal('! خطأ ', 'يرجى اختيار رتبة ', 'error');
			return false ; 
		}
		if ( RankIDV == "2386")  {

const {value: formValues} = swal({
  title: 'إعدادات الروم الخاص بك',
  html:
    '<input id="swal-input1" placeholder="أسم السبيسر" class="swal2-input">' +
    '<input id="swal-input2" placeholder="أسم الروم الاول" class="swal2-input">'+
    '<input id="swal-input3" placeholder="أسم الروم الثاني" class="swal2-input">'+
    '<input id="swal-input4" placeholder="( Password ) باسورد الرومات" class="swal2-input">',
  focusConfirm: false,
  preConfirm: () => {
	input1 = document.getElementById('swal-input1').value;
	input2 = document.getElementById('swal-input2').value;
	input3 = document.getElementById('swal-input3').value;
	input4 = document.getElementById('swal-input4').value;
	if ( input1 == "" || input2 == "" || input3 == "" ) {
		swal('! خطأ ', 'يرجى تعبئة الفراغات اللازمه ', 'error');
		return false ; 
	}
	var params = "CheckAndSubmitRANKS&rtime=" + encodeURIComponent(RankTime) + "&rid=" +encodeURIComponent(RankIDV)+ "&chl0=" +encodeURIComponent(input1)+ "&chl1=" +encodeURIComponent(input2)+ "&chl2=" +encodeURIComponent(input3)+ "&psd=" +encodeURIComponent(input4) ;
 SendInfAjax (params)
 }
})
} else {
	var params = "CheckAndSubmitRANKS&rtime=" + encodeURIComponent(RankTime) + "&rid=" +encodeURIComponent(RankIDV) ;
SendInfAjax (params)
}

	
}

function SendInfAjax (params) {
		document.getElementById("vipbtn").innerHTML = "الرجاء الأنتظار..";
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("vipbtn").innerHTML = "أستبدال";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var ald = str.includes("ald");
				var en = str.includes("en");
				var tk = str.includes("tk");
				if (tr) {swal('! تم ', 'تم إعطائك الرتبة بنجاح ', 'success');}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
				if (ald) {swal('! خطأ ', 'لديك هذه الرتبة بالفعل ', 'error');}
				if (en) {swal('! خطأ ', 'ليس لديك كمية كافية من النقاط ', 'error');}
				if (tk) {
					var partsOfStr = str.split(',');
					swal('! خطأ ', 'أسم الروم مستخدم من قبل  : ' + partsOfStr[1] , 'error');
				}

			} 
		  }
		xmlhttp.open("POST","config/coinajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

}
function CheckAndSubmitRANKSCodes()
{

		var RankTime = document.getElementById('timevip').value;
		var RankIDV = document.getElementById('TypeG').value;
		var RankID = document.getElementById('TypeG');
		var RankName = RankID.options[RankID.selectedIndex].text;
		if ( RankName == "None" ) {
			swal('! خطأ ', 'يرجى اختيار رتبة ', 'error');
			return false ; 
		}
		document.getElementById("vipbtnC").innerHTML = "الرجاء الأنتظار..";
		var params = "CheckAndSubmitRANKSCode&rtime=" + encodeURIComponent(RankTime) + "&rid=" +encodeURIComponent(RankIDV) ;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("vipbtnC").innerHTML = "شراء الرتبة بشكل كود";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var ald = str.includes("ald");
				var en = str.includes("en");
				if (tr) {
					var partsOfStr = str.split(',');
					swal('! تم ', 'تم إنشاء الكود  : ' + partsOfStr[1] , 'success');
				}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
				if (ald) {swal('! خطأ ', 'لديك هذه الرتبة بالفعل ', 'error');}
				if (en) {swal('! خطأ ', 'ليس لديك كمية كافية من النقاط ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/coinajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
} 

function displayAmount() {
  var time = document.getElementById("timevip").value;
  var group = document.getElementById("TypeG").value;
  
	if (group == "2386" ) {
	document.getElementById("timevip").disabled = true;
	document.getElementById('amount').innerHTML = '10000 ( شهر واحد فقط )  ';
	} else 	if (group == "38" ) {
		document.getElementById("timevip").disabled = false;
		if (time == "24H" ) {
			document.getElementById('amount').innerHTML = '1500';
		} else if (time == "7D" ) {
			document.getElementById('amount').innerHTML = '3000';
		}else if (time == "1M" ) {
			document.getElementById('amount').innerHTML = '7500';
		}
	}	else if (group == "39" ) {
		document.getElementById("timevip").disabled = false;
		if (time == "24H" ) {
			document.getElementById('amount').innerHTML = '1250';
		} else if (time == "7D" ) {
			document.getElementById('amount').innerHTML = '2500';
		}else if (time == "1M" ) {
			document.getElementById('amount').innerHTML = '6000';
		}
	}
		else if (group == "40" ) {
		document.getElementById("timevip").disabled = false;
		if (time == "24H" ) {
			document.getElementById('amount').innerHTML = '800';
		} else if (time == "7D" ) {
			document.getElementById('amount').innerHTML = '1500';
		}else if (time == "1M" ) {
			document.getElementById('amount').innerHTML = '4500';
		}
	}
}
</script>
			<center><h2 class="content-heading">أستبدال النقاط</h2><hr></center>
			
			<center><div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-inverse">
                                    <h3 class="text-white box m-b-0"><i class="fa fa-money"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0"><?php echo ceil(intval($coins)); ?></h3>
                                    <h5 class="text-muted m-b-0">عدد نقاطك الحاليه</h5></div>
                            </div>
                        </div>
                    </div>
			</center>		
<!-- <center>
				<div class="col-lg-6 col-md-6">
<div class="alert alert-info">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
<h3 class="text-info"><i class="fa fa-exclamation-circle"></i> ملاحظة مهمة جدأ .</h3> ‫هذه مجرد ايقونة مميزة تكون معك للابد ، مدة شراء الرتبة 24 ساعة وسوف يتم إزالتها من المتجر وسوف تظل فقط مع الاعضاء الي شرو الرتبة فقط‬‎
<hr>

                                <div class="card">
								<div class="col-lg-6 col-md-6">
                                    <img class="card-img-top img-responsive" src="https://i.imgur.com/toR9xvm.png" alt="Card image cap">
										</div>
                                    <center><div class="card-body">
                                        <h4 class="card-title">ايقونة مميزه </h4>
										<hr>								
										<form method="post">										
                                    <select disabled="" class="js-select2 form-control select2-hidden-accessible" title="Time" style="width:80%"> 
												<option value="12H">For Ever - 100 Coins</option>
									</select>
									<br>
									<br>
									<select disabled="" class="js-select2 form-control select2-hidden-accessible" style="width:80%"> 
												<option>ايقونة مميزه للأبد</option>	
											</select>
									<br><br>
                                        <button type="submit" name="icon24" class="btn btn-outline-warning btn-rounded"><i class="fa fa-check"></i> أستبدال</button>
                                    </div></center>
																			</form>	
                                </div>

</p></div></div> </center>	 -->		
			<div class="row">
			
			
				<div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="image/vip1.png" alt="Card image cap">
                                    <center><div class="card-body">
                                        <h4 class="card-title">عضويه VIP خاصه</h4>
										<hr>									
										
                                    <select id="timevip" onchange="displayAmount()" class="js-select2 form-control select2-hidden-accessible" name="timevip" title="Time" style="width:80%"> 
												<option value="24H">يوم كامل</option>
												<option value="7D">اسبوع</option>
												<option value="1M">شهر</option>
									</select>
									<br>
									<br>
									<select id="TypeG" onchange="displayAmount()" class="js-select2 form-control select2-hidden-accessible" style="width:80%"> 
												<option selected>None</option>	
												<option value="2386">Vip-Prime</option>	
												<option value="38">Vip-Gold</option>	
												<option value="39">Vip-Silver</option>	
												<option value="40">Vip-Bronze</option>	

											</select>
									<br><br>
										<label>المجموع : <label style="color:#279E07;" id="amount">0</label> نقطة</label><br>
                                        <button type="submit" onclick="return CheckAndSubmitRANKS();"  name="vip "id="vipbtn" class="btn btn-outline-warning btn-rounded"><i class="fa fa-check"></i> أستبدال</button>
									<br><br>
                                        <button type="submit" onclick="return CheckAndSubmitRANKSCodes();"  id="vipbtnC" class="btn btn-outline-info btn-rounded"><i class="fa fa-check"></i> شراء الرتبة بشكل كود</button>
                                    </div></center>
                                </div>
				</div>	


				
				<div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="image/icons1.png" alt="Card image cap">
                                    <center><div class="card-body">
                                        <h4 class="card-title">أيقونايه مميزه</h4>
										<hr>
                                        <p class="card-text">مجرد أيقونات تعطي العضويه الخاصه بك شكل مميز </p>
										<hr>
										<form method="post">										
                                    <select id="time" class="js-select2 form-control select2-hidden-accessible" name="time" title="Time" style="width:80%"> 
												<option value="12H">12 ساعة - 90 نقطة</option>
												<option value="24H">يوم - 135 نقطة</option>
												<option value="7D">اسبوع - 500 نقطة</option>
									</select>
									<br>
									<br>
									<select id="icon" class="js-select2 form-control select2-hidden-accessible" name="iconz" title="Icon" style="width:80%"> 
												<option value="1309">● Panda</option>
												<option value="1310">● Flower</option>
												<option value="1311">● Football</option>
												<option value="1312">● joker</option>
												<option value="896">● سيفين ونخله</option>
												<option value="161">● Cool</option>
												<option value="713">● !!!</option>
												<option value="715">● Wow</option>
												<option value="716">● delicious</option>
												<option value="722">&lrm;&#8235;● iLove money&#8236;&lrm;</option>
												<option value="725">● :)</option>
												<option value="732">● :@</option>
												<option value="733">● Smart</option>
												<option value="33">● آلشيخخء</option>	
												<option value="167">● Pepsi</option>	
												<option value="626">● Smoke</option>	
												<option value="1531">● Moon | القمر </option>	
											</select>
									<br><br>
                                        <button type="submit" name="icon" class="btn btn-outline-success btn-rounded"><i class="fa fa-check"></i> أستبدال</button>
                                    </div></center>
																			</form>	
                                </div>
				</div>	


				
				<div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="image/tools1.png" alt="Card image cap">
                                    <center><div class="card-body">
                                        <h4 class="card-title">خصائص مميزه</h4>
										<hr>
                                        <p class="card-text">تتيح لك أستبدال نقاطك بخصايه مثل السبام وألخ...</p>
										<hr>
										<form method="post">										
                                    <select id="time" class="js-select2 form-control select2-hidden-accessible" name="time" title="Time" style="width:80%"> 
												<option value="12H">12 ساعة - 90 نقطة</option>
												<option value="24H">يوم - 135 نقطة</option>
												<option value="7D">اسبوع - 500 نقطة</option>
									</select>
									<br>
									<br>
									<select id="icon" class="js-select2 form-control select2-hidden-accessible" name="iconz" title="Icon" style="width:80%"> 
												<option value="1523">● » No AFK Move</option>	
												<option value="1524">● » Skip No Private</option>	
												<option value="1525">● » Skip No Poke</option>	
												<!--  <option value="1526">● » Spam</option>	 -->
												<option value="1527">● » No Whisper</option>	
												<option value="1528">● » Up Talk Power</option>	
												<option value="1529">● » Channel Commander</option>	
											</select>
									<br><br>
                                        <button type="submit" name="icon" class="btn btn-outline-info btn-rounded"><i class="fa fa-check"></i> أستبدال</button>
                                    </div></center>
																			</form>	
                                </div>
				</div>	


				
				<div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="image/icon1.png" alt="Card image cap">
                                   <center><div class="card-body">
                                        <h4 class="card-title">أيقونه خاصه دائمه</h4>
										<hr>
                                        <p class="card-text">مجرد أيقونه دائمه يتم رفعها من خلالك..</p>
										<hr>
									<form method="post" enctype="multipart/form-data">
											<input type="file" name="pico"><br>
											
                                            
										<br>
									<select disabled="" class="js-select2 form-control select2-hidden-accessible" style="width:80%"> 
												<option>دائمه - 500 نقطه</option>	
									</select>
									<br>
									<br>
                                        <button type="submit" name="submit" class="btn btn-outline-primary btn-rounded"><i class="fa fa-check"></i>‎‫‎‫ابدأ‬‎ الرفع</button>
                                    </div></center>
																			</form>
                                </div>
				</div>	

				
			<!--	<div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="https://i.imgur.com/cyunaGd.png" alt="Card image cap">
                                   <center><div class="card-body">
                                        <h4 class="card-title">رتب بوستر اللفل</h4>
									<form method="post" enctype="multipart/form-data">											
                                            
										<hr>
										<form method="post">	
<div class="alert alert-warning">سوف تتحمل المصاريف عند استبدالك شئ غلط احسن التركيز</div>		
<hr>									
									<h5 class="text-info price"><b>Level Booster x5 - <span class="text-danger">520</span> coins</h5></b>
									<hr>
									<select id="icon" class="js-select2 form-control select2-hidden-accessible rtbh" name="iconz" title="Icon" style="width:80%"> 
												<option value="1945">● » Level Booster x5</option>	
												<option value="1946">● » Level Booster x4</option>	
												<option value="1947">● » Level Booster x3</option>	
												<option value="2243">● » Level Booster x2</option>	
									</select>
									<br><br>
                                        <button type="submit" name="booster" class="btn btn-outline-info btn-rounded"><i class="fa fa-check"></i> أستبدال</button>
                                    </div></center>
																			</form>	
                                    </div></center>
																			</form>
                </div> -->
								
			<!--	<div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="https://i.imgur.com/cyunaGd.png" alt="Card image cap">
                                    <center><div class="card-body">
                                        <h4 class="card-title">بوستر الكوينز</</h4>
										<hr>
                                        <p class="card-text">يتيح لك سرعة اكبر للحصول علي الكوينز في الثانية</p>
										<hr>									
										
										<form method="post">										
                                    <select id="timevip" class="js-select2 form-control select2-hidden-accessible" name="timeboostercoins" title="Time" style="width:80%"> 
												<option value="12H">12 ساعة - 320 نقطة</option>
												<option value="24H">يوم - 660 نقطة</option>
												<option value="7D">اسبوع - 2500 نقطة</option>
									</select>
									<br>
									<br>
									<select disabled="" class="js-select2 form-control select2-hidden-accessible" style="width:80%"> 
												<option>Coins Booster</option>	
											</select>
									<br><br>
                                        <button type="submit" name="boostercoins" class="btn btn-outline-warning btn-rounded"><i class="fa fa-check"></i> أستبدال</button>
                                    </div></center>
																			</form>	
                                </div>
				</div>	-->
								
				</div>
				</div> 
			
			
			<center><h2 class="content-heading">تحويل نقاط</h2><hr></center>
			<div class="row">
			<div class="col-md-4">
			<div class="block">
			</div>
			</div>
			
			
			
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-danger">تحويل النقاط</div>
<?php
$xz = explode(',', $client_info["client_servergroups"]);
	$cansee2 = array(136,145,146,147,148,149,150,151,152,153,890,891,892,893,894,1254,1255,1256,1257,1258,1259,1260,1261,1262,1264,1648,1647,1646,305,927,15,144,14,84,10,1672,1555,1557,1554,1556,1553);
		if(count(array_intersect($cansee2, $xz)) > 0){
 ?>				   
				   <center>
						<hr><input name="amount2" id="amount2" type="range" min="0" max="<?php echo $coins; ?>" value="0" step="1" oninput="outputUpdat1e(value)">
						<p><i class="fa fa-credit-card" aria-hidden="true"></i>المبلغ المراد تحويلة <output class="grblue" name="amount" for="fader" id="volume1">0</output> </p>
						<label><strong>هنالك ضريبة 10%</strong></label>
						<div id="total_price"></div><br>
						<hr>
<select id="respuser" name="userrespid" style="width:100%">						
<?php
	$detected_clients = $ts3->clientList(array('client_type' => '0'));
	foreach ($detected_clients as $client) {
		$czdb = $client["client_database_id"];
		$czdN = $client->client_nickname ;
		echo"<option value='$czdb'>$czdN</option> " ;
	}	

?>
</select>
						<br>
						<br>
						<button id="t7weel" style="width: 50%;" type="submit" onclick="return sendCoins();" name="trbtn" class="btn mr-1 mb-1 btn-outline-primary"><i class="fa fa-credit-card" aria-hidden="true"></i> تحويل </button>
				   </center>
<?php }else echo '<div class="alert alert-warning alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                      <strong> لأ يمكنك ارسال او استقبال النقاط بعد لفل 5</strong></div>'; ?>					
               </div>
            </div>
			
			

<script>
              var jp2 = jQuery.noConflict();
              function outputUpdat1e(vol) {  
               document.querySelector('#volume1').value =  vol;
               var a1 = parseInt(jp2('input[name=amount2]').val());
               var b1 = parseInt(jp2('input[name=clancred3]').val());
               var sum = a1 + b1;

               document.querySelector('#tradetotal').value = sum;
              }
			  
              jp2(document).ready(function() {
                      jp2("#t7weel").click(function(event){
						var a1 = parseInt(jp2('input[name=amount2]').val());
                        var u1 = jp2('select[name=userrespid]').val();
                        var uname = jp2("#respuser option:selected").text();
						});
                });
				
				
				
function sendCoins() {
var respuser = document.getElementById('respuser').value
var valueB = document.getElementById('amount2').value
var vat = 10.0 ;
var vatToPay = (valueB / 100) * vat;
var valAfterDiscount = valueB - vatToPay ; 

swal({
  title: "هل أنت متأكد ؟",
  html: " المبلغ قبل الضريبة : " + valueB + "<br> المبلغ بعد الضريبة : " + valAfterDiscount ,
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: "نعم ، قم بتحويل المبلغ",
  cancelButtonText: "لا ، رجاء إلغاء العملية",
}).then((result) => {
  if (result.value) {
		var params = "trbtn&amount2=" + encodeURIComponent(valueB) + "&userrespid=" + encodeURIComponent(respuser) ;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var les = str.includes("les");
				if (tr) {swal(' تم ', 'تم تحويل المبلغ بنجاح ', 'success');}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
				if (lse) {swal('! خطأ ', 'لاتستطيع التحويل اقل من 100 نقطة ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/coinajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

    } else if (result.dismiss === Swal.DismissReason.cancel) {
    swal(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})

}
		
				
</script>
						
			
			
			</div>
			<center><hr><h2 class="content-heading">سجل التحويلات</h2></center>
			<div class="row">
				<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table color-table primary-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>أسم الشخص</th>
												<th>نوع التحويل</th>
                                                <th>النقاط</th>
                                                <th>التاريخ - الوقت المرسل</th>
                                            </tr>
                                        </thead>
										
                                        <tbody>
<?php
$sql = "SELECT * FROM transfer WHERE sender='$cldbid' OR geter='$cldbid' LIMIT 11";	
$res = $con->query($sql);
$numz = $res->num_rows;
$id = 0 ;
if($numz >= 1){
	while($data = $res->fetch_assoc()){
		$id ++ ;
		if ($data["geter"] == $cldbid ) {
		$getz = $ts3_VirtualServer->clientInfoDb($data["sender"])["client_nickname"];
		$stauts = "أرسل لك";
		$statusColor ='text-success' ;
		} elseif ( $data["sender"] == $cldbid )  {
		$getz = $ts3_VirtualServer->clientInfoDb($data["geter"])["client_nickname"];
		$stauts = "أرسلت له"; 
		$statusColor ='text-warning' ;
		}
		$timy = $data["stime"];
		$zcoins = $data["amount"];
		echo "<tr> <td>$id</td> <td>$getz</td> <td class='$statusColor'>$stauts</td> <td><i class='fa fa-money'></i> $zcoins</td> <td>$timy</td></tr>";		
	}	
}
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
				
				<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <center><h4 class="card-title">سجل المشتريات</h4></center>
                                <div class="table-responsive">
                                    <table class="table color-table danger-table">
                                        <thead>
                                            <tr>
                                                <th>المنتج</th>
                                                <th>تاريخ الشراء</th>
                                                <th>المدة</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
						<?php //"Y:m:j:h:i:s"
							$boosters = array(1945,1946,1947,2243);
							while($data = $result->fetch_assoc()){
								$status = $data["status"];
								$time = explode(':', $data["time"]);
								$noz = $time[0]."/".$time[1]."/".$time[2]." ".$time[3].":".$time[4];
								if($data["etime"] == "continue" && in_array($data["sgid"], $boosters)) {
									$sgidx = $ts3_VirtualServer->serverGroupGetById($data["sgid"]);
									echo "<tr ><th scope='row'>$sgidx</th>";
									echo "<td>$noz</td> <td >00:00</td> <td >تنسحب تلقائي</td>";
									echo "<td class='text-success'>تلقائي</td> </tr>";
									continue;	
								}else if($data["etime"] == "continue"){
									echo "<tr ><th scope='row'>ايقونة خاصة</th>";
									echo "<td>$noz</td> <td >00:00</td> <td >دائم</td>";
									echo "<td class='text-success'>فعال</td> </tr>";
									continue;
								} 						
								$etime = explode(':', $data["etime"]);
								$eoz = $etime[0]."/".$etime[1]."/".$etime[2]." ".$etime[3].":".$etime[4];
								$sgid = $ts3_VirtualServer->serverGroupGetById($data["sgid"]);
								$rend = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
								$rstart = time();
								$seconds = $rend - $rstart;
								$days    = floor($seconds / 86400);
								$hours   = floor(($seconds - ($days * 86400)) / 3600);
								$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
								$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
								if($status == "inactive"){
									echo "<tr><th scope='row'>$sgid</th>";
									echo "<td class='text-warning' >$noz</td> <td >00:00</td> <td >$eoz</td>";
									echo "<td class='text-danger'>انتهى</td> </tr>";
									continue;
								}
								$remain = "$days يوم $hours ساعة $minutes دقيقة";
								echo "<tr ><th scope='row'>$sgid</th>";
								echo "<td >$noz</td> <td >$remain</td> <td>$eoz</td>";
								if($status == "active"){
									echo "<td class='text-success'>فعال</td> </tr>";
								}
							}
						?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
				
				
				
			</div>
		</div>
    </div>
		
<?php require_once('includes/footer.php'); ?>