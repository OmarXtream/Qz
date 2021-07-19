<?php
require 'config/phphead.php'; 
// function getclientip() {
	// if (!empty($_SERVER['Cf-Connecting-IP']))
		// return $_SERVER['Cf-Connecting-IP'];
	// else if(!empty($_SERVER['HTTP_CLIENT_IP']))
		// return $_SERVER['HTTP_CLIENT_IP'];
	// else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		// return $_SERVER['HTTP_X_FORWARDED_FOR'];
	// else if(!empty($_SERVER['HTTP_X_FORWARDED']))
		// return $_SERVER['HTTP_X_FORWARDED'];
	// else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
		// return $_SERVER['HTTP_FORWARDED_FOR'];
	// else if(!empty($_SERVER['HTTP_FORWARDED']))
		// return $_SERVER['HTTP_FORWARDED'];
	// else if(!empty($_SERVER['REMOTE_ADDR']))
		// return $_SERVER['REMOTE_ADDR'];
	// else
		// return false;
// }
	
// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "qvaGN6vy9EaZMw5l";
// $dbname = "Rankqz";

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

	// $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	// if($con->connect_error){
		// die("Failed TO COnnect to database: ".$con->connect_error);
	// }

	// $sql = "SELECT * FROM attack WHERE ip='$x'";
	// $res = $con->query($sql);
	// $now = time();
	// if($res->num_rows === 1){
		// $data = $res->fetch_assoc();
		// $nums = intval($data["nums"]);
		// $last = intval($data["last"]);
		// $warn = intval($data["warn"]);
		// $ban = intval($data["ban"]);
		// $diff = abs($last - $now);
		// $banz = strtotime("+10 minutes"); // عدد دقائق البان
		
		// if($ban !== 0){
			// $bdiff = $ban - $now;
			// if($bdiff <= 1){
				// $sql = "UPDATE attack SET ban='0' WHERE ip='$x'";
				// $con->query($sql);
				// header("Location: index.php");
			// }else{
				 // require 'includes/sweetalert.php'; 
				// die('<script>
			   // swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة - You were banned from Panel because of spam ,('.$bdiff.' Second) ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
			// }
			
		// }else if($warn >= 3){  // عدد التحذيرات
			
			// $sql = "UPDATE attack SET warn='0', ban='$banz' WHERE ip='$x'";
			// $con->query($sql);
			// require 'includes/sweetalert.php'; 

			// die('<script>
			   // swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
		// }
		// if($diff <= 1 && $nums > 4){
			// $warn = $warn +1;
			// $sql = "UPDATE attack SET warn='$warn' WHERE ip='$x'";
			// $con->query($sql);
			 // require 'includes/sweetalert.php'; 

			// die('<script>
			   // swal({title: "تم اكتشاف",text: "محاولات عديدة من السبام ان تم تكريرها سوف يتم تبنيدك لمدة من اللوحة",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');  // رسالة التحذير
		// }else if($nums < 5){
			// $nums = $nums + 1;
			// $sql = "UPDATE attack SET nums='$nums', last='$now' WHERE ip='$x'";
			// if($con->query($sql) === false){ die("Failed To Insert!"); }
		// }else{
			// $nums = 0;
			// $sql = "UPDATE attack SET nums='$nums', last='$now' WHERE ip='$x'";
			// if($con->query($sql) === false){ die("Failed To Insert!"); }
		// }
		
	// }else if($res->num_rows <= 0){
		// $sql = "INSERT INTO attack (id, ip, nums, last, warn, ban) VALUES (NULL, '$x', '1', '$now', '0', '0')";
		// if($con->query($sql) === false){
			 // require 'includes/sweetalert.php'; 
			// die("Failed TO Insert!");
		// }
	// }
// }
// require_once("config/function.php");
// require_once ("config/TeamSpeak3/TeamSpeak3.php");
// require_once('config/config.php');
// require 'config/sqlconfig.php'; 

// $ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
// $ts3 = $ts3_VirtualServer;
// foreach($ts3_VirtualServer->clientList() as $client) {
// if(getclientip() == $client['connection_client_ip']) {
// $verfied++;
// $client_info = $client;	
// $result[] = $client->client_nickname;
// $client_verified = $client;
// $nicknames[] = $client["client_nickname"];
// $nickname = $client["client_nickname"];
// $description = $client["client_description"];
// $totalconnections = $client["client_totalconnections"];
// $platform = $client["client_platform"];
// $country = strtolower($client["client_country"]);
// $_SESSION ['ggids'] = explode(",", $client_verified["client_servergroups"]);
// $dbid = $client["client_database_id"];
// $uid = $client["client_unique_identifier"];
// $ggids = explode(",", $client["client_servergroups"]);
// $clients_online = $ts3_VirtualServer["virtualserver_clientsonline"];
// $r = explode(',',$client["client_servergroups"]);
// $move = $ts3_VirtualServer->clientGetByDbid($dbid);
// $poke = $ts3_VirtualServer->clientGetByDbid($dbid);
// $clid = $client["clid"];
// $client_db = $dbid;
// $_SESSION['verfied'] = $verfied;
// }
// }

 ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>

 
 	<?php 
		
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
		
		
$cgrp = explode(',', $client_info["client_servergroups"]);
$brodcast = array(10,2171,1672,1555,1048);
if(!count(array_intersect($brodcast, $cgrp)) > 0){
	die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
}
	?>
	
<?php
if(isset($_POST["openx"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	
	$sql = "UPDATE stats SET val='1' WHERE prop='panelopen'";
	$con->query($sql);
	
	$con->close();
}else if(isset($_POST["closex"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	$sql = "UPDATE stats SET val='0' WHERE prop='panelopen'";
	$con->query($sql);
	$con->close();
}else if(isset($_POST["opens"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	$sql = "UPDATE stats SET val='1' WHERE prop='antispam'";
	$con->query($sql);
	$con->close();
}else if(isset($_POST["closes"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	$sql = "UPDATE stats SET val='0' WHERE prop='antispam'";
	$con->query($sql);
	$con->close();
}else if(isset($_POST["ticketopen"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	$sql = "UPDATE stats SET val='1' WHERE prop='ticketopen'";
	$con->query($sql);
	$con->close();
}else if(isset($_POST["ticketcoles"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	$sql = "UPDATE stats SET val='0' WHERE prop='ticketopen'";
	$con->query($sql);
	$con->close();
}else if(isset($_POST["actuserDel"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "qvaGN6vy9EaZMw5l";
	$dbname = "Rankqz";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($con->connect_error){
		die("Failed TO COnnect to database: ".$con->connect_error);
	}
	$sql = "DELETE FROM actuser WHERE sdate=''";
	$con->query($sql);
	$con->close();
}

?>
        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
			<br>
			<br>
			<br>

			<center>
			<div class="row">
			<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-dark">
                               <center> <h4 class="m-b-0 text-white">قفل وفتح اللوحة</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-info">يتم أغلاق وفتح اللوحه من هنا ..</span>
									<br>
									<br>
									<h3><b> .↓. .↓. .↓. .↓. </b></h3>
									</center>
										</p>
                                                
                                        </div>
										<br>
										<br>
									<div class="row">
										<div class="col-md-6">
																				<form method="post">									
										  <button type="submit" name="openx"  class="btn btn-rounded btn-block btn-outline-info">فتح اللوحه </button>
										</div>
										<div class="col-md-6">
										  <button type="submit" name="closex" class="btn btn-rounded btn-block btn-outline-danger">غلق اللوحه</button>
										</div>
											 </form>

									</div>	

							</div>
						</div>
			</div>
			
<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-dark">
                               <center> <h4 class="m-b-0 text-white">قفل وفتح السبام</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-info">يتم تعطيل نظام سبام اللوحة وفتحة من هنا</span>
									<br>
									<br>
									<h3><b> .↓. .↓. .↓. .↓. </b></h3>
									</center>
										</p>
                                                
                                        </div>
										<br>
										<br>
									<div class="row">
										<div class="col-md-6">
										<form method="post">									
										  <button type="submit" name="opens"  class="btn btn-rounded btn-block btn-outline-info">فتح السبام </button>
										</div>
										<div class="col-md-6">
										  <button type="submit" name="closes" class="btn btn-rounded btn-block btn-outline-danger">غلق الاسبام</button>
										</div>
											 </form>

									</div>	

							</div>
						</div>
			</div>
<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-dark">
                               <center> <h4 class="m-b-0 text-white">فتح وغلق تذاكر الدعم الفني</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-info">يتم فتح وغلق تذاكر الدعم الفني من هنا .</span>
									<br>
									<br>
									<h3><b> .↓. .↓. .↓. .↓. </b></h3>
									</center>
										</p>
                                                
                                        </div>
										<br>
										<br>
									<div class="row">
										<div class="col-md-6">
										<form method="post">									
										  <button type="submit" name="ticketopen"  class="btn btn-rounded btn-block btn-outline-info">فتح التذاكر</button>
										</div>
										<div class="col-md-6">
										  <button type="submit" name="ticketcoles" class="btn btn-rounded btn-block btn-outline-danger">غلق التذاكر</button>
										</div>
											 </form>

				<?php
										
										// $sql = "SELECT val FROM `Rankqz`.`stats` WHERE prop='ticketopen' LIMIT 1";
										// $valx = intval($res->fetch_assoc()["val"]);
										// if($valx === 1){
											// echo '
												// <div class="col-md-6">
											 // <form method="post">									
										  // <button type="submit" name="ticketopen"  class="btn btn-rounded btn-block btn-outline-info">فتح التذاكر</button>
										// </div></form>';
										// }else if($valx === 0){
									// echo '<div class="col-md-6"> <form method="post">	
										  // <button type="submit" name="ticketcoles" class="btn btn-rounded btn-block btn-outline-danger">غلق التذاكر</button>
										// </div></form>';	
										
									// }
											
											 
?> 
									</div>	

							</div>
						</div>
			</div>
			<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-dark">
                               <center> <h4 class="m-b-0 text-white">التفعيل</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-info">---</span>
									<br>
									<br>
									<h3><b> .↓. .↓. .↓. .↓. </b></h3>
									</center>
										</p>
                                                
                                        </div>
										<br>
										<br>
									<div class="row">
										<div class="col-md-12">
											<form method="post">									

										  <button type="submit" name="actuserDel" class="btn btn-rounded btn-block btn-outline-danger">حذف</button>
										</div>
											 </form>

				<?php
										
										// $sql = "SELECT val FROM `Rankqz`.`stats` WHERE prop='ticketopen' LIMIT 1";
										// $valx = intval($res->fetch_assoc()["val"]);
										// if($valx === 1){
											// echo '
												// <div class="col-md-6">
											 // <form method="post">									
										  // <button type="submit" name="ticketopen"  class="btn btn-rounded btn-block btn-outline-info">فتح التذاكر</button>
										// </div></form>';
										// }else if($valx === 0){
									// echo '<div class="col-md-6"> <form method="post">	
										  // <button type="submit" name="ticketcoles" class="btn btn-rounded btn-block btn-outline-danger">غلق التذاكر</button>
										// </div></form>';	
										
									// }
											
											 
?> 
									</div>	

							</div>
						</div>
			</div>
			</div>
			</center>


			</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>