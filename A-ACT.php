<?php 

require 'config/phphead.php';
require 'config/sqlconfig.php';
 
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}
$xx = $client_info["client_database_id"];
$xz = explode(',', $client_info["client_servergroups"]);
if(in_array(0,$xz)){
	die();
}
$os = $client_info["client_platform"];
$arrclients = $ts3_VirtualServer->clientList(array("client_type" => 0));

		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}

 ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
        <div class="page-wrapper">
        <div class="container-fluid">
		<br>
<?php 
if(isset($_POST["act"])){
	
	if(is_array($_POST["act"])){
		$now = date("Y/m/d  h:i");
		$actz = intval(key($_POST["act"]));
		$sql = "UPDATE actuser SET act='$xx', status='1', sdate='$now' WHERE cldbid='$actz'";
		$con->query($sql);
		try{
			sleep(2);						
			$client_info = $ts3_VirtualServer->clientGetByDbid($actz);
			if($os == "Windows"){
				$ts3_VirtualServer->serverGroupClientAdd(20, $actz);
			}else if($os == "Android"){
				$ts3_VirtualServer->serverGroupClientAdd(213, $actz);
			}else if($os == "iOS"){
				$ts3_VirtualServer->serverGroupClientAdd(212, $actz);
			}else if($os == "OS X"){
				$ts3_VirtualServer->serverGroupClientAdd(488, $actz);
			}else if($os == "Linux"){
				$ts3_VirtualServer->serverGroupClientAdd(90, $actz);
				$ts3_VirtualServer->serverGroupClientAdd(21, $actz);
			$client_info->poke("انت من نظام ليكنس");				
			}	
			////////Invite Check
			$CheckInvite = $client_info['connection_client_ip'] ; 
			$ClientNickname = $con->real_escape_string(stripslashes(htmlspecialchars($client_info["client_nickname"]))) ;
			$ClientUID = $client["client_unique_identifier"];
			$sql = "SELECT * FROM invites_info WHERE ip='$CheckInvite' AND status='pending'";
			$res = $con->query($sql);
			$data = $res->fetch_assoc();
			$InviterClbid = $data["cldbid"];
			if($res->num_rows > 0){
			$sql = "UPDATE invites_info SET nickname='$ClientNickname', uid='$ClientUID', status='active' WHERE ip='$CheckInvite'";
			$con->query($sql);
			$sql = "UPDATE `Rankqz`.`user` SET coins = coins + 100 WHERE cldbid='$InviterClbid' LIMIT 1;";
			$con->query($sql);
				}
			///////////////////////
			$client_info->move(821);
			$ts3_VirtualServer->serverGroupClientAdd(11, $actz);					
			$client_info->poke("تم تفعيلك");
			$client_info["client_description"] = $client_info["client_nickname"];	
		}catch(TeamSpeak3_Exception $e){
			die('<script>
           swal({title: "هذا العضو",text: "غير متصل حاليأ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');			
		}
			echo('<script>
           swal({title: "تم",text: "تفعيل العضو",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');		
	}
}else if(isset($_POST["blc"])){
	
	if(is_array($_POST["blc"])){
		$blocked = intval(key($_POST["blc"]));
		$sql = "UPDATE actuser SET act='$xx', status='0' WHERE cldbid='$blocked'";
		$con->query($sql);
	}
		echo('<script>
           swal({title: "تم",text: "حظر العضو بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');			
}else if(isset($_POST["ublc"])){
	
	if(is_array($_POST["ublc"])){
		$ublock = intval(key($_POST["ublc"]));
		$sql = "UPDATE actuser SET act='$xx', status='-1' WHERE cldbid='$ublock'";
		$con->query($sql);
	}
		echo('<script>
           swal({title: "تم",text: "فك الحظر بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');		
} elseif(isset($_POST["actWithoutInvite"])){
	
	if(is_array($_POST["actWithoutInvite"])){
		$now = date("Y/m/d  h:i");
		$actz = intval(key($_POST["actWithoutInvite"]));
		$sql = "UPDATE actuser SET act='$xx', status='1', sdate='$now' WHERE cldbid='$actz'";
		$con->query($sql);
		try{
			sleep(2);						
			$client_info = $ts3_VirtualServer->clientGetByDbid($actz);
			if($os == "Windows"){
				$ts3_VirtualServer->serverGroupClientAdd(20, $actz);
			}else if($os == "Android"){
				$ts3_VirtualServer->serverGroupClientAdd(213, $actz);
			}else if($os == "iOS"){
				$ts3_VirtualServer->serverGroupClientAdd(212, $actz);
			}else if($os == "OS X"){
				$ts3_VirtualServer->serverGroupClientAdd(488, $actz);
			}else if($os == "Linux"){
				$ts3_VirtualServer->serverGroupClientAdd(90, $actz);
				$ts3_VirtualServer->serverGroupClientAdd(21, $actz);
			$client_info->poke("انت من نظام ليكنس");				
			}	
			$client_info->move(821);
			$ts3_VirtualServer->serverGroupClientAdd(11, $actz);					
			$client_info->poke("تم تفعيلك");
			$client_info["client_description"] = $client_info["client_nickname"];	
		}catch(TeamSpeak3_Exception $e){
			die('<script>
           swal({title: "هذا العضو",text: "غير متصل حاليأ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');			
		}
			echo('<script>
           swal({title: "تم",text: "تفعيل العضو",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');		
	}
}

if(isset($_POST["remove"]) and isset($_POST["dbuser"])){
	$remuser = $_POST["dbuser"];
		$sql = "DELETE FROM actuser WHERE cldbid='$remuser'";
		$con->query($sql);
	echo('<script>
           swal({title: "تم",text: "حذف العضو بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ACT");}else {window.location.replace("https://panel.q-z.us/A-ACT");}})</script>');			
}


function isHeInvited ($ip,$con) {
$obj = false ;
$sql = "SELECT * FROM invites_info WHERE ip='$ip' AND status='pending'";
$res = $con->query($sql);
$data = $res->fetch_assoc();
$InviteBy = $data["invitedby"];
if($res->num_rows > 0){
$obj = $InviteBy ;
	} else { $obj = false ; }
	return $obj ;
}	
?>
			
  			  
<?php 
act($ggids) 
?>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> قائمة أعضاء بأنتظار التفعيل </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الأسم</th>
                                                <th>ip</th>
                                                <th>Vpn</th>
												<th>[ تفعيل | تفعيل بدون احالة | حظر |  حالة الاحالة  ] العضو</th>
                                                <th>حالة العضو</th>
                                                <th>حذف العضو</th>
                                            </tr>
                                        </thead>
										<?php
											$sql = "SELECT * FROM actuser ORDER BY id DESC";
											$res = $con->query($sql);
											while($data = $res->fetch_assoc()){
												$cldbid = $data["cldbid"];
												$vpn = $data["vpn"];
												$ip = $data["ip"];
												$isInvited = isHeInvited ($ip,$con);
												$status = $data["status"];
												$act = $data["act"];
												if($act != 0 && $status == 1){
													continue;
												}else if($status == -2){ continue; }
												
												try{
													$name = $ts3_VirtualServer->clientInfoDb($cldbid)["client_nickname"];
												}catch(TeamSpeak3_Exception $e){
													continue;
												}
												//$name = $ts3_VirtualServer->clientInfoDb($cldbid)["client_nickname"];
												if($vpn == 1){
													$vpn = "Yes";
												}else{
													$vpn = "No";
												}
												
												try{
													$col = $ts3_VirtualServer->clientGetByDbid($cldbid);
												}catch(TeamSpeak3_Exception $e){
													$col = false;
												}
												
												if($col == false && $status == 1){
												$stat = "<button type='button' class='disabled btn btn-danger'>تفعيل</button>";
												}else if($status == 0){
												$stat = "<form method='post'><button type='submit' name='ublc[$cldbid]' class='btn btn-warning'>فك الحظر</button></form>";
												}else{
												if ($isInvited) {
												$stat = "<form method='post'><button type='submit' name='act[$cldbid]' class='btn btn-success'>تفعيل</button>&nbsp;&nbsp;<button type='submit' name='actWithoutInvite[$cldbid]' class='btn btn-warning'>تفعيل بدون احاله</button>&nbsp;&nbsp;<button type='submit' name='blc[$cldbid]' class='btn btn-danger'>حظر</button>&nbsp;&nbsp;<b class='badge badge-warning'>$isInvited : لديه احاله من قبل</b></form> ";
												} else {
												$stat = "<form method='post'><button type='submit' name='act[$cldbid]' class='btn btn-success'>تفعيل</button>&nbsp;&nbsp;<button type='submit' name='blc[$cldbid]' class='btn btn-danger'>حظر</button></form>";
													}
												}
												$deleteusuer = "<form method='post'><input type='hidden' name='dbuser' value='$cldbid'><button type='submit' name='remove[$cldbid]' class='btn btn-info'>حذف العضو</button></form>";

												if($col == false){ $sta = "<b class='badge badge-danger'>غير متصل</b>"; }else{ $sta = "<b class='badge badge-success'>متصل</b>"; }
												
												echo "<tr> <td>$name</td> <td >$ip</td> <td >$vpn</td> <td >$stat</td> <td >$sta</td> <td >$deleteusuer</td></tr>";
											}
										?>										
                                <!--        <tbody>
                                            <tr>
                                                <td>Osama</td>
                                                <td>81.22.42.29</td>
                                                <td>NO</td>
                                                <td><button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="تفعيل">تفعيل  |  <img src="image/Tick-16.png">  </button>  ||  <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="حظر">حظر  |  <img src="image/Cross-16.png"> </button></td>												
                                                <td><span class="font-w600"><div class="badge badge-success"><b>متصل</b></div></span></td>
                                                <td><button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف">حذف  |  <img src="image/Cross-16.png"> </button></td>
                                            </tr>
									</tbody> -->
								 </table> 
                                </div>
                        </div>
					 </div>
            </div>
			
						
				
		
		
		
		
		
		
		
		</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>