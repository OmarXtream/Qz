<?php
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
		die("Failed TO Connect");
}
$x = strval(getclientip());
if(!filter_var($x, FILTER_VALIDATE_IP)){
	die("Failed TO Connect");
}
sleep(mt_rand(1,2));

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "test";
	
	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	
usleep(90000);

	
	$sql = "SELECT * FROM userlog WHERE ip='$x'";
	$res = $con->query($sql);
	if($res->num_rows === 0){
			require 'includes/header.php'; 
		die('
		
	    <div class="page-wrapper">
        <div class="container-fluid">	
		<br>
		<br>
		<center>
		<div class="display-1 text-warning"><b>ERROR</b></div>
		<hr>
			<div class="col-md-12">
                        <div class="card text-white bg-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">يوجد خطاء</h4></div>
                            <div class="card-body">
                                <div class="alert">
									<p class=" push-50 fadeInRightBig animated">.لا تستطيع دخول لوحة التحكم الان لوجود خطاء برجاء التواصل مع ادارة التيم  سبيك لحل المشكلة</p>
									<p class=" push-50 fadeInRightBig animated">لحل المشكلة قم باغلاق التيم سبيك واعد فتحة مره اخره واذا استمرت المشكلة تواصل مع الادارة </p>
									<a class=" push-50 fadeInRightBig animated" href="ts3server://q-z.us/?port=9987"><img src="../assets/join.png" onmouseover="this.src=&quot;../assets/join-active.png&quot;" onmouseout="this.src=&quot;../assets/join.png&quot;" alt=""></a>
								</div>
                            </div>
                        </div>
            </div>
			
			<div class="col-md-12">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="alert">
									<p class=" push-50 fadeInRightBig animated">اعادة التجربة  لدخول لوحة التحكم</p>
									<p class=" push-50 fadeInRightBig animated"><a class="btn btn-warning" href="https://panel.q-z.us/">
<i class="fa fa-arrow-left mr-10"></i> اعاده التجربه
</a></p>
</div> </a>
								</div>
                            </div>
                        </div>
            </div>
		
		
		
		
		
		
		
		
		
		</div>
		</div>
<center>
						
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>');
	}else{
		$last_id = intval($res->fetch_assoc()["id"]);
	}
	
		$sql = "SELECT * FROM attack WHERE ip='$x'";
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
				$sql = "UPDATE attack SET ban='0' WHERE ip='$x'";
				$con->query($sql);
				header("Location: index.php");
			}else{
				 require 'includes/sweetalert.php'; 
				die('<script>
			   swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة - You were banned from Panel because of spam ,('.$bdiff.' Second) ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
			}
			
		}else if($warn >= 3){  // عدد التحذيرات
			
			$sql = "UPDATE attack SET warn='0', ban='$banz' WHERE ip='$x'";
			$con->query($sql);
			require 'includes/sweetalert.php'; 

			die('<script>
			   swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
		}
		if($diff <= 1 && $nums > 4){
			$warn = $warn +1;
			$sql = "UPDATE attack SET warn='$warn' WHERE ip='$x'";
			$con->query($sql);
			 require 'includes/sweetalert.php'; 

			die('<script>
			   swal({title: "تم اكتشاف",text: "محاولات عديدة من السبام ان تم تكريرها سوف يتم تبنيدك لمدة من اللوحة",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');  // رسالة التحذير
		}else if($nums < 5){
			$nums = $nums + 1;
			$sql = "UPDATE attack SET nums='$nums', last='$now' WHERE ip='$x'";
			if($con->query($sql) === false){ die("Failed To Insert!"); }
		}else{
			$nums = 0;
			$sql = "UPDATE attack SET nums='$nums', last='$now' WHERE ip='$x'";
			if($con->query($sql) === false){ die("Failed To Insert!"); }
		}
		// $last_id = $res->fetch_assoc()["id"];
	}else if($res->num_rows <= 0){
		$sql = "INSERT INTO attack (id, ip, nums, last, warn, ban) VALUES (NULL, '$x', '1', '$now', '0', '0')";
		if($con->query($sql) === false){
			 require 'includes/sweetalert.php'; 
			die("Failed TO Insert!");
		}
		// $last_id = $con->insert_id;
	}
	
// }
usleep(90000);
session_start();
require_once ("config/TeamSpeak3/TeamSpeak3.php");
require_once('config/config.php');
require 'includes/sweetalert.php'; 

$result = array();
$verfied = "0";
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
//------------------------------------------------------------------------//
				
foreach($ts3_VirtualServer->clientList() as $client) {
if($x == $client['connection_client_ip']) {
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
}
}

//------------------------------------------------------------------------//	
//------------------------------------------------------------------------//				
if($verfied == "0"){
// مش موجود بالتيم سبيك
{
		echo ' <META HTTP-EQUIV="Refresh" CONTENT="1;URL=Error/notonline.php"> ';
		die();

}	echo "</div>";
       }
//------------------------------------------------------------------------//	
                if($_SESSION['verfied'] == 1){   }
			
//------------------------------------------------------------------------//	
$filename = $_SERVER['PHP_SELF'];
$homename = 'usertow';

if(!isset($_SESSION['userone']) and $_SESSION['verfied'] > 1 and !stristr($filename,$homename)){
echo'<meta http-equiv="refresh" content="0; url=./usertow.php" />';
die;
}
	
					
						
//------------------------------------------------------------------------//

//------------------------------------------------------------------------//
// باند من اللوحه	 
if(in_array($banad,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=Error/ban.php">  ';
	die;
        } else 				
//------------------------------------------------------------------------//
// سجن 
if(in_array($jailhead,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=Error/ban.php">  ';
	die;
        } else 
if(in_array($jailhead2,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=Error/ban.php">  ';
	die;
        } else 				
//------------------------------------------------------------------------//
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}
$xx = $client_info["client_database_id"];
$xz = explode(',', $client_info["client_servergroups"]);
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="https://i.imgur.com/199Mmpo.png">
    <title>Qz - Control Panel - لوحه تحكم التيم سبيك</title>
	<link rel="stylesheet" href="assets/node_modules/dropify/dist/css/dropify.min.css">
    <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <link href="assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
	    <!-- chartist CSS -->
    <link href="assets/node_modules/css-chart/css-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
	<link rel="stylesheet" href="assets/css/font.css">
	<link href="assets/dist/css/pages/user-card.css" rel="stylesheet">
    <link href="assets/dist/css/style.min.css" rel="stylesheet">
    <link href="assets/dist/css/pages/dashboard1.css" rel="stylesheet">
	<link href="assets/dist/css/pages/widget-page.css" rel="stylesheet">
	<link href="assets/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
	<link href="assets/dist/css/pages/bootstrap-switch.css" rel="stylesheet">
    <link href="assets/node_modules/prism/prism.css" rel="stylesheet">
	<link href="assets/dist/css/pages/ribbon-page.css" rel="stylesheet">
	<link href="assets/dist/css/pages/floating-label.css" rel="stylesheet">
	<link href="assets/dist/css/pages/easy-pie-chart.css" rel="stylesheet">
    <link href="assets/dist/css/pages/widget-page.css" rel="stylesheet">
	<link href="assets/dist/css/pages/stylish-tooltip.css" rel="stylesheet">
</head>
		<body>
		
	    <div class="page-wrapper">
        <div class="container-fluid">	
		<br>
		<br>
<?php
// if(isset($_POST["actv"])){
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL,"http://v2.api.iphub.info/ip/$ip");
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $headers = [
		// 'X-Key: Mjk4OmRodDlMMGpOUnN5TGxOaDIxdzZ5Q05SaWRDR1Y0enE3'
	// ];
	// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// $json = json_decode(curl_exec($ch), true);
	// curl_close ($ch);
	// $x = $json["block"];
	// if($x == 1){
// die('<script>
           // swal({title: "خطاء",text: "برجاء غلق اى برامج vpn و المحاولة مرة اخرى!",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');		
	// }
	// $sql = "SELECT * FROM actuser WHERE ip='$ip' OR cldbid='$xx' LIMIT 1";
	// $res = $con->query($sql);
	// if($res->num_rows > 0){
		// $result = $res->fetch_assoc();
		// $stat = $result["status"];
		// $ipz = $result["ip"];
		// $acti = $result["act"];
		// $dbz = $result["cldbid"];
		 // if($ipz == $client_info['connection_client_ip'] && $dbz != $client_info["client_database_id"]){
					// try {			 
	        // $client_info->poke("انت مفعل من قبل برجاء انتظار ادمن ..");			 
			 // $client_info->move(868);
			 // $ts3_VirtualServer->serverGroupClientAdd(860, $client_info["client_database_id"]);
					// } catch(Exception $e) {
							
					// }			 
			 // header("Location: activated.php");
		 // }
		// if($stat == 0){
// die('<script>
           // swal({title: "خطاء",text: "انت محظور لأ يمكنك تفعيل نفسك",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');	
		   
		// }else if($acti == $client_info["client_database_id"] && $client_info["client_description"] == $client_info["client_nickname"]){
// echo('<script>
           // swal({title: "تم",text: "تفعيل بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');				
		// }else if($acti != 0){

// die('<script>
           // swal({title: "خطاء",text: "انت مفعل من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');	
		// }
		// $now = date("Y/m/d  h:i");
		// $sql = "UPDATE actuser SET act='$xx', sdate='$now', status='-2' WHERE cldbid='$xx'";
		// $con->query($sql);
					// try {		
		// $client_info->poke("جارى التفعيل");
		// sleep(2);
		// $os = $client_info["client_platform"];
		// if($os == "Windows"){
			// $ts3_VirtualServer->serverGroupClientAdd(20, $xx);
		// }else if($os == "Android"){
			// $ts3_VirtualServer->serverGroupClientAdd(213, $xx);
		// }else if($os == "iOS"){
			// $ts3_VirtualServer->serverGroupClientAdd(212, $xx);
		// }else if($os == "OS X"){
			// $ts3_VirtualServer->serverGroupClientAdd(488, $xx);
        // }else if($os == "Linux"){
			// $ts3_VirtualServer->serverGroupClientAdd(21, $xx);						
		// }
		// $ts3_VirtualServer->serverGroupClientAdd(11, $xx);		
		// $client_info->move(821);		
		// $client_info["client_description"] = $client_info["client_nickname"];
		
						// } catch(Exception $e) {
							
					// }	
// echo('<script>
           // swal({title: "تم",text: "تفعيلك بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');		
		// $client_info->poke("تم تفعيلك ب نجاح");
		// header("Location: activated.php");
	// }else{
		// $now = date("Y/m/d  h:i");
		// $sql = "INSERT INTO actuser (id, cldbid, ip, vpn, act, status, sdate) VALUES (NULL, '$xx', '$ip', '$x', '$xx', '-2', '$now')";
		// $con->query($sql);
					// try {
		
		// $client_info->poke("جارى التفعيل");
		// sleep(2);
		// $os = $client_info["client_platform"];
		// if($os == "Windows"){
			// $ts3_VirtualServer->serverGroupClientAdd(20, $xx);
		// }else if($os == "Android"){
			// $ts3_VirtualServer->serverGroupClientAdd(213, $xx);
		// }else if($os == "iOS"){
			// $ts3_VirtualServer->serverGroupClientAdd(212, $xx);
		// }else if($os == "OS X"){
			// $ts3_VirtualServer->serverGroupClientAdd(488, $xx);
        // }else if($os == "Linux"){
			// $ts3_VirtualServer->serverGroupClientAdd(90, $xx);						
			// $ts3_VirtualServer->serverGroupClientAdd(21, $xx);						
		// }
		// $ts3_VirtualServer->serverGroupClientAdd(11, $xx);				
		// $client_info->move(821);		
		// $client_info["client_description"] = $client_info["client_nickname"];
						// } catch(Exception $e) {
							
					// }			
// echo('<script>
           // swal({title: "تم",text: "تفعيلك بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');	
		// $client_info->poke("تم تفعيلك ب نجاح");
						
	// }

	// header("Location: activated.php");	
// }



if(isset($_POST["hasact"])){
		$client_info->move(76301);
		$ts3_VirtualServer->serverGroupClientAdd(1630, $xx);
		$client_info->poke("الرجاء انتظار الدعم لحل مشكلتك وتفعيلك");
die;
}


if(isset($_POST["verified"])){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://v2.api.iphub.info/ip/$ip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$headers = [
		'X-Key: Mjk4OmRodDlMMGpOUnN5TGxOaDIxdzZ5Q05SaWRDR1Y0enE3'
	];
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$json = json_decode(curl_exec($ch), true);
	curl_close ($ch);
	$x = $json["block"];
	if($x == 1){
die('<script>
           swal({title: "خطاء",text: "برجاء غلق اى برامج vpn و المحاولة مرة اخرى!",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');		
	}
	$sql = "SELECT * FROM actuser WHERE ip='$ip' OR cldbid='$xx' LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$result = $res->fetch_assoc();
		$stat = $result["status"];
		$ipz = $result["ip"];
		$acti = $result["act"];
		$dbz = $result["cldbid"];
 if($acti == $client_info["client_database_id"] && $client_info["client_description"] == $client_info["client_nickname"]){
echo('<script>
           swal({title: "تم",text: "التوثيق بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');				
		}else if($acti != 0){

die('<script>
           swal({title: "خطاء",text: "انت مفعل من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');	
		}
		$now = date("Y/m/d  h:i");
		$sql = "UPDATE actuser SET act='$xx', sdate='$now', status='-2' WHERE cldbid='$xx'";
		$con->query($sql);
					try {
		
		$client_info->poke("جارى التوثيق لحظات");
		sleep(2);
		$ts3_VirtualServer->serverGroupClientDel(1952, $xx);		
		$ts3_VirtualServer->serverGroupClientAdd(1953, $xx);	
						} catch(Exception $e) {
							
					}			
echo('<script>
           swal({title: "تم",text: "تفعيلك بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');		
		$client_info->poke("تم تفعيلك ب نجاح");
		header("Location: activated.php");
	}else{
		$now = date("Y/m/d  h:i");
		$sql = "INSERT INTO actuser (id, cldbid, ip, vpn, act, status, sdate) VALUES (NULL, '$xx', '$ip', '$x', '$xx', '-2', '$now')";
		$con->query($sql);
					try {
		
		$client_info->poke("جارى التوثيق لحظات");
		sleep(2);
		$ts3_VirtualServer->serverGroupClientDel(1952, $xx);		
		$ts3_VirtualServer->serverGroupClientAdd(1953, $xx);
						} catch(Exception $e) {
							
					}			
echo('<script>
           swal({title: "تم",text: "تفعيلك بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activated");}else {window.location.replace("https://panel.q-z.us/activated");}})</script>');	
		$client_info->poke("تم التوثيق بنجاح");
						
	}

	header("Location: activated.php");	
}
?>		
		<center>
					<div class="col-md-6">
                        <div class="card border-success">
                            <div class="card-header bg-success">
                                <h4 class="m-b-0 text-white">قائمه التفعيل</h4></div>
                            <div class="card-body">
								
				       <h2>Welcome : <font color="319db5"> <strong> <?php echo $client_info["client_nickname"]; ?></strong></font></h2>
<h2> هل انت غير <font color="red">مفعل</font></h2>
<br><strong>
يوجد لديك مشكلة ولا تستطيع دخول اللوحة يمكنك التواصل مع الدعم عند حصول اي خطأ في تفعيلك بالضغط على الزر بالاسفل .‬‎
<br></strong><br>
<form method="POST">
			<?php
				$block = false;
				$actb = false;
				$sql = "SELECT * FROM actuser WHERE ip='$ip' OR cldbid='$xx' LIMIT 1";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					$result = $res->fetch_assoc();
					$stat = $result["status"];
					$ipz = $result["ip"];
					if($ipz == $client_info["connection_client_ip"]){
						$actb = true;
					}
					//$acti = $result["act"];
					if($stat == 0){
						$block = true;
					}
					//else if($acti != 0){
						//$act = true;
					//}
				}
					if(in_array(1952, $xz)){
						echo '<a href="#" ><button name="verified" style="width:300px" type="submit" class="btn btn-success btn-md">انت مفعل بل تحتاج توثيق حسابك</button></a>';
					}else if(in_array(860, $xz)){
						echo "<a href='#' ><button name='hasact' style='width:300px' type='button' class='btn disabled btn-warning btn-md'>تعدد حسابات - اضغط هنا لتواصل مع الدعم</button></a>";

					}else if(in_array(11, $xz)){
						echo "<a href='#' ><button style='width:300px' type='button' class='btn disabled btn-warning btn-md'>انت مفعل من قبل</button></a>";
					}else if($actb === true){
						echo '<a href="#" ><button name="actv" style="width:300px" type="submit" disabled class="btn btn-danger btn-md">للتفعيل اضغط هنا</button></a>';
					}else if($block == true){
						echo "<a href='#' ><button style='width:300px' type='button' class='btn disabled btn-danger btn-md'>انت محظور لا يمكنك تفعيل نفسك</button></a>";
					}else{
						echo '<a href="#" ><button name="actv" style="width:300px" type="submit" disabled class="btn btn-primary btn-md">للتفعيل اضغط هنا</button></a>';
					}
			?>							
							
							
							
                            </div>
                        </div>
                    </div>
		
		
		
		
		</div>
		</div>
		</body>






	<script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/dist/js/waves.js"></script>
    <script src="assets/dist/js/sidebarmenu.js"></script>
	<script src="assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/dist/js/custom.min.js"></script>
    <script src="assets/node_modules/prism/prism.js"></script>
    <script src="assets/node_modules/raphael/raphael-min.js"></script>
   <!--  <script src="assets/node_modules/morrisjs/morris.min.js"></script> -->
    <script src="assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/node_modules/d3/d3.min.js"></script>
    <script src="assets/node_modules/c3-master/c3.min.js"></script>
    <script src="assets/node_modules/toast-master/js/jquery.toast.js"></script>
   <!--  <script src="assets/dist/js/dashboard1.js"></script> -->
	<script src="assets/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
	<script src="assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
    <script src="assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <script src="assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>
	<!-- <script src="assets/node_modules/gauge/gauge.min.js"></script> 
    <script src="assets/dist/js/pages/widget-data.js"></script>-->
</body>


</html>