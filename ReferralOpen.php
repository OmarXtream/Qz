<?php 
die();

function getclientip() {
	if (!empty($_SERVER['Cf-Connecting-IP']))
		return $_SERVER['Cf-Connecting-IP'];
	else if(!empty($_SERVER['HTTP_CLIENT_IP']))
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
	
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "qvaGN6vy9EaZMw5l";
$dbname = "Rankqz";

// $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// if($con->connect_error){
	// die("Failed TO COnnect to database: ".$con->connect_error);
// }
// $sql = "SELECT val FROM `Rankqz`.`stats` WHERE prop='antispam' LIMIT 1";
// $res = $con->query($sql);
// $valn = intval($res->fetch_assoc()["val"]);
// if($valn === 1){
	
	
	// $dbhost = "localhost";
	// $dbuser = "root";
	// $dbpass = "qvaGN6vy9EaZMw5l";
	// $dbname = "test";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}

	$sql = "SELECT * FROM `test`.`attack` WHERE ip='$x'";
	$res = $con->query($sql);
	$now = time();
	if($res->num_rows === 1){
		$data = $res->fetch_assoc();
		$nums = intval($data["nums"]);
		$last = intval($data["last"]);
		$warn = intval($data["warn"]);
		$ban = intval($data["ban"]);
		$diff = abs($last - $now);
		$banz = strtotime("+10 minutes"); // عدد دقائق البان
		
		if($ban !== 0){
			$bdiff = $ban - $now;
			if($bdiff <= 1){
				$sql = "UPDATE `test`.`attack` SET ban='0' WHERE ip='$x'";
				$con->query($sql);
				header("Location: index.php");
			}else{
				 require 'includes/sweetalert.php'; 
				die('<script>
			   swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة - You were banned from Panel because of spam ,('.$bdiff.' Second) ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
			}
			
		}else if($warn >= 3){  // عدد التحذيرات
			
			$sql = "UPDATE `test`.`attack` SET warn='0', ban='$banz' WHERE ip='$x'";
			$con->query($sql);
			require 'includes/sweetalert.php'; 

			die('<script>
			   swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
		}
		if($diff <= 1 && $nums > 4){
			$warn = $warn +1;
			$sql = "UPDATE `test`.`attack` SET warn='$warn' WHERE ip='$x'";
			$con->query($sql);
			 require 'includes/sweetalert.php'; 

			die('<script>
			   swal({title: "تم اكتشاف",text: "محاولات عديدة من السبام ان تم تكريرها سوف يتم تبنيدك لمدة من اللوحة",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');  // رسالة التحذير
		}else if($nums < 5){
			$nums = $nums + 1;
			$sql = "UPDATE `test`.`attack` SET nums='$nums', last='$now' WHERE ip='$x'";
			if($con->query($sql) === false){ die("Failed To Insert!"); }
		}else{
			$nums = 0;
			$sql = "UPDATE `test`.`attack` SET nums='$nums', last='$now' WHERE ip='$x'";
			if($con->query($sql) === false){ die("Failed To Insert!"); }
		}
		
	}else if($res->num_rows <= 0){
		$sql = "INSERT INTO `test`.`attack` (id, ip, nums, last, warn, ban) VALUES (NULL, '$x', '1', '$now', '0', '0')";
		if($con->query($sql) === false){
			 require 'includes/sweetalert.php'; 
			die("Failed TO Insert!");
		}
	}
// }
require_once("config/function.php");
require_once ("config/TeamSpeak3/TeamSpeak3.php");
require_once('config/config.php');
// require 'config/sqlconfig.php'; 

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

 ?>
<?php
require_once('includes/header.php');
// require_once('includes/topbar.php');
// require_once('includes/sidebar.php');
?>	
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$showInvitePage = false ;
$error = false ;

if (isset($_GET["InviteKey"])) {
		$key = $con->real_escape_string(stripslashes(htmlspecialchars($_GET["InviteKey"])));
		$showPage = false ;
		$sql = "SELECT * FROM invites WHERE invitekey='$key'";
		$res = $con->query($sql);
if($res->num_rows > 0){
		$data = $res->fetch_assoc();
		$InviteBy = $data["nickname"];
		$InviteBycldbid = $data["cldbid"];
		if($verfied == "0"){
		$showInvitePage = true ;
		} else {
		if(in_array(11,$_SESSION['ggids'])){
			$error = true ;
		} else { 
			$ClientIp = getclientip() ;
			$sql = "SELECT * FROM invites_info WHERE ip='$ClientIp'";
			$res = $con->query($sql);
			if($res->num_rows == 0){
				$sql = "INSERT INTO invites_info (id, nickname, uid, cldbid, invitedby, date, ip, status) VALUES (NULL, 'none', 'none', '$InviteBycldbid', '$InviteBy', 'N', '$ClientIp', 'pending')";
					if($con->query($sql) === true){
					//die ('true') ;
					}
				}
			$showInvitePage = true ; 
			}			
		}	
	} else { echo('<script>swal({title: "خطا",text: "رمز الاحاله غير صحيح",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); }
}	

 // echo("Error description: " . mysqli_error($con));


echo ' <br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br><div class="page-wrapper">
       <div class="container-fluid">
	   </br>
	   <center>
	  </center>	
	<div class="row">';

if ( $showInvitePage == true ) { 
echo '

<br>
<br>
<br>
<br>
<br>
<div class="col-md-4">
	</div>
			<div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-success ">
                              <center> <h4 class="m-b-0 text-white">نظام الاحاله</h4> </center>
								</div>
							<div class="card-body">
										
										<center>
										<span class="badge badge-success">تم دعوتك من قبل : '.$InviteBy.'</span></br></br>
										<label class="col-sm-8"><strong>مرحبا بك ! ، نتمنى ان تستمع معنا </strong></label>
										</br><a href="ts3server://q-z.us">أضغط هنا للدخول الي السيرفر</a>
										</center>
							</div>
						</div>
			</div>
		<div class="col-md-4">
	</div>
';
} elseif ( $error = true ) {
echo '

<br>
<br>
<br>
<br>
<br>
<div class="col-md-4">
	</div>
			<div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-danger  ">
                              <center> <h4 class="m-b-0 text-white">نظام الاحاله</h4> </center>
								</div>
							<div class="card-body">

										<center>
										<label class="col-sm-8"><strong>لقد حدث خطأ ما </strong></label>
										<label class="col-sm-8"><strong>* نظام الاحاله يعمل في حال انك لست مفعل مسبقا بالسيرفر </strong></label>
									</br><a href="index.php" class="btn btn-warning">اضغط لرجوع لوحة التحكم</a>
										
										</center>
							</div>
						</div>
			</div>
		<div class="col-md-4">
	</div>
';
	
	
	
	
}	

		
?>
			</div>			
		</div>			
	</div>			
</div>























