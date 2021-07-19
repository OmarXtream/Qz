
<?php require 'config/phphead.php';
if(isset($_POST["userx"]) && is_numeric($_POST["userx"])){
	$userid = intval($_POST["userx"]);
	$protect = array(9529); // ارقام الناس الى لا يمكن حذف رتبها
	$protect2 = array(1989,1988,1987,1986,1985,1984,1983,1555,1672,2171,10,1548,1048,2156); // ارقام الرتب التي لايمكن حذفها
	if(!in_array($userid, $protect)){
		try{
			$groups = array_keys($ts3->clientGetServerGroupsByDbid($userid));
			if(count(array_intersect($protect2, $groups)) > 0){
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die();
			}
			foreach($groups as $grp){
				try{
					$ts3->serverGroupClientDel($grp, $userid);
				}catch(Exception $e){

				}
			}
			try{
				$ts3->serverGroupClientAdd(860, $userid);
			}catch(Exception $e){

			}
			// print("<pre>".print_r($groups, true)."</pre>");
		}catch(Exception $e){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
		}
		
	}else{
		header('HTTP/1.1 500 Internal Server Error');
		header('Content-Type: application/json; charset=UTF-8');
	}
	die();
}
 ?>
<?php
require_once('includes/header2.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<?php 
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>
<script>

window.onload = function(){
	$(".sf").click(function(){
		var userid = $(this).attr('name');
		var btn = $(this);
		$.ajax({
		  method: "POST",
		  url: "https://panel.q-z.us/A-searcher",
		  data: { userx: userid}
		}).done(function(msg) {
			swal({
				  title: "تمت العملية",
				  text: "تم حذف جميع رتبه",
				  icon: "success",
				  button: "شكرا",
				});
		}).fail(function() {
			swal({
			  title: "حدث خطأ",
			  text: "لا يمكنك حذف رتب هذا الشخص",
			  icon: "warning",
			  button: "إستكمال",
			});
		});
	});
};

</script>
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
	<?php 
$cgrp = explode(',', $client_info["client_servergroups"]);
seach($cgrp);  
?>
		
		<center>
			<div class="col-md-7">
				<form method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>البحث عن العضو</b></h4>
					</div>
                    <div class="card-body">
             <!--     <select name="type" class='form-control'>
                  <option value="UID">ايدي العضو</option>
                  <option value="DB">رقم العضو</option>
                </select>		 -->			
					<br>
					<hr>
					<br>
					<input class="form-control " placeholder="اسم العضو او الينك ايدي او الداتا بيز ايدي" type="text" name="user" id="00"><br>
					<br>
					
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="submit" class="btn btn-rounded btn-block btn-outline-success"> أبحث الأن </button>
                    </div></center>
					<br>	 </form>
					
					
                </div>
            </div>
		</center>


	<?php 
if(isset($_POST['submit']) and isset($_POST['user'])){
	$target = htmlspecialchars(stripcslashes(addslashes(trim($_POST['user']))));
	$type = $_POST['type'];

	$host = "127.0.0.1";
	$user = "root";
	$pass = "qvaGN6vy9EaZMw5l";
	$db = "Rankqz";

	$con = new mysqli($host, $user, $pass, $db);
	$con->set_charset("utf8");		
ini_set("default_charset", 'utf-8');	
	// if($type == 'UID'){
		// $sql = "SELECT * FROM user WHERE uuid='$target' LIMIT 1";
		// $run = $con->query($sql)->fetch_assoc();
		// $hisdb = $run["cldbid"];

	// }elseif($type == 'DB'){
		// $sql = "SELECT * FROM user WHERE cldbid='$target' LIMIT 1";
		// $run = $con->query($sql)->fetch_assoc();
		// $hisdb = $run["cldbid"];

	// }else{
		// echo'<META HTTP-EQUIV="refresh" CONTENT="1">';
		// echo 'Something goes Wrong !';
		// die;
	// }
	$sql = "SELECT * FROM user WHERE uuid='$target' OR cldbid='$target' OR name LIKE '%$target%' LIMIT 1";
	$run = $con->query($sql)->fetch_assoc();
	$hisdb = $run["cldbid"];
	if(!empty($hisdb)){
	$lastseen = $run["lastseen"];
	$status = $run["online"];
	if($status == '1'){
		$hisstatus = "<p style='color:green'> Online</p>";
	}else{
		$hisstatus = "<p style='color:red'> Offline </p>";
	}
	$system = $run["platform"];

	$cl = $ts3_VirtualServer->clientInfoDb($hisdb);
	$name = trim(strval($cl['client_nickname']));
	$hisdes = $cl['client_description'];
	$uerid = $cl['client_database_id'];
	$IP = $cl['client_lastip'];
	$uuix = $cl['client_unique_identifier'];
	$coins = $run["coins"];
	$csz = $run["nation"];
	$lastconnect = gmdate("Y-m-d\ h:i:s\ ",$lastseen);
	echo"
		<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'> Information Founded - المعلومات </h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table warning-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>الدسكربشن</th>
                                                <th>رقم العضو</th>
                                                <th>اخر ظهور للعضو</th>
                                                <th>حاله العضو</th>
                                                <th>نظام العضو</th>
                                                <th>البلد</th>
                                                <th>كوينز</th>
                                                <th>الرتب</th>
                                            </tr>
                                        </thead>
							<tbody>
								<tr>
									<td>$name</td>
									<td>$hisdes</td>
									<td>$uerid</td>
									
									<td>$lastconnect</td>
									<td>$hisstatus</td>
									<td>$system</td>
									<td>$csz</td>
									<td>$coins</td>
									";
									$remove = array(1989,1988,1987,1986,1985,1984,1983,1555,1672,2171,10);
											if(!count(array_intersect($remove, $ggids)) > 0){
												echo "<td><button type='button' class='btn btn-danger disabled delete btn-xs'>تصفية الرتب<i class='glyphicon glyphicon-remove'></i></button></td></tr>";
											}else{
												echo "<td> <button class='btn btn-danger sf' name='$hisdb'>تصفية الرتب</button> </td>		
												</tr></tbody></table>
                            </table>
                        </div>
                    </div>
					<hr>
					
		
        </div>		
        </div>";
											}	
											"
									";						
									
	echo"
		<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'> معلومات الاععضاء المتصلين بنفس الاي بي  </h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table warning-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>اخر ظهور لة</th>
                                                <th>رقم العضو</th>
                                                <th>حاله العضو</th>
                                                <th>نظام العضو</th>
                                                <th>البلد</th>
                                                <th>كوينز</th>
                                            </tr>
                                        </thead>
							<tbody>"; 
							
							$sql = "SELECT * FROM `test`.`userlog` WHERE ip='$IP'";
							$res = $con->query($sql);
							if($res->num_rows > 0){
								while($data = $res->fetch_assoc()){
									// $uidx = $data["uuid"];
									// $cdbx = $ts3->clientFindDb("$uidx",true)[0];
									$cdbx = $data["cldbid"];
									$sql2 = "SELECT * FROM user WHERE cldbid='$cdbx'";
									$resx = $con->query($sql2);
									if($resx->num_rows > 0){
										while($datax = $resx->fetch_assoc()){
											
											$name = $datax["name"];
											$uuid = $datax["uuid"];
											$dbid = $datax["cldbid"];
											$rank = $datax["rank"];
											$online = $datax["online"];
											$coins = $datax["coins"];
											$csz = $datax["nation"];							
											$lastseen = $datax["lastseen"];
											$status = $datax["online"];
											
											if($status == '1'){
												$hisstatus = "<p style='color:green'> Online</p>";
											}else{
												$hisstatus = "<p style='color:red'> Offline </p>";
											}								
											$lastconnect = gmdate("Y-m-d\ h:i:s\ ",$lastseen);
												
											echo "
											<tr>
											<td> $name </td>
											<td> $lastconnect </td>
											<td> $dbid </td>
											<td> $hisstatus </td>
											<td> $system </td>
											<td> $csz </td>
											<td> $coins </td>
											</tr>";	
										}
								    }
								}
							}else{
								echo "لا  يوجد اعضاء متصلين بنفس الايبى!";
							}
							// $sql = "SELECT * FROM user_iphash WHERE ip='$IP'";
							// $resuid = strval($con->query($sql)->fetch_assoc()["uuid"]);
							// $sql2 = "SELECT * FROM user WHERE uuid='$resuid'";
							// $res = $con->query($sql2);
							// if($res->num_rows > 0){
								
							// while($datax = $res->fetch_assoc()){
								// $name = $datax["name"];
								// $uuid = $datax["uuid"];
								// $dbid = $datax["cldbid"];
								// $rank = $datax["rank"];
								// $online = $datax["online"];
								// $coins = $datax["coins"];
								// $csz = $datax["nation"];							
								// $lastseen = $datax["lastseen"];
								// $status = $datax["online"];
								// if($status == '1'){
								// $hisstatus = "<p style='color:green'> Online</p>";
								// }else{
								// $hisstatus = "<p style='color:red'> Offline </p>";
								// }								
								// $lastconnect = gmdate("Y-m-d\ h:i:s\ ",$lastseen);

/*
									$yehhe1= array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($dbid));

								foreach($yehhe1 as $yehhe){
									
									$info1 = $ts3_VirtualServer->serverGroupGetById($yehhe);
									$theename1 = $info1["name"];
foreach($theename1 as $theename){
if($theename == 'Verified User'){
	$ishe = "<p style='color:green'> مفعل</p>";
break;
}elseif($theename == 'Multiple account  - تعدد حساب'){
	$ishe = "<p style='color:blue'> تعدد حسابات</p>";
break;
}
}
}

if(!$ishe){
	$ishe = "<p style='color:red'> غير مفعل</p>";
}*/


								// echo "
								// <tr>
								// <td> $name </td>
								// <td> SooN </td>
								// <td> $lastconnect </td>
								// <td> $dbid</td>
								// <td>  $hisstatus</td>
								// <td>$system</td>
								// <td> $csz </td>
								// <td>$coins</td>
								// <td>قريبأ</td>
								// </tr>";							}
							// }else{
								// echo "لا  يوجد اعضاء متصلين بنفس الايبى!";
							// }
								 // <tr>
									// <td>$name</td>
									// <td>$IP</td>
									// <td>$hisdes</td>
									// <td>$uerid</td>
									
									// <td>$lastconnect</td>
									// <td>$hisstatus</td>
									// <td>$system</td>
									// <td>$csz</td>
									// <td>$coins</td>
									// </tr>
	echo "</tbody></table></table></div></div><hr></div> </div>";
									
$banlist = $ts3_VirtualServer->banlist();
$ban = false;

function ago($time) {
    $timediff=$time; 

    $days=intval($timediff/86400);
    $remain=$timediff%86400;
    $hours=intval($remain/3600);
    $remain=$remain%3600;
    $mins=intval($remain/60);
    $secs=$remain%60;

    if ($secs>=0) $timestring = " 0دقاي ق ".$secs." ثوانى ";
    if ($mins>0) $timestring = $mins." دقايق ".$secs." ثوانى ";
    if ($hours>0) $timestring = $hours." ساعة ".$mins." دقايق ";
    if ($days>0) $timestring = $days." أيام ".$hours." ساعة ";

    return $timestring; 
}

foreach ($banlist as $row){
	 if($row["ip"] == $IP || $row["uid"] == $uuix){
		 $t = "<h3 class='text-danger'>محظور</h3>";
		 $baner = $row["invokername"];
		 $nick = $row["lastnickname"];
		 $idz = $row["banid"];
		 $dur = $row["duration"];
		 $remain = $row["created"];
		 //
			$remainz = time() - $remain;
			$temp = $remainz/86400;
			$days=floor($temp);
			
			$temp=24*($temp-$days); 
			$hours=floor($temp);
			
			$temp=60*($temp-$hours); 
			$minutes=floor($temp);
			
			$temp=60*($temp-$minutes); 
			$seconds=floor($temp);
			
			$mins = "$days أيام $hours ساعات $minutes دقائق $seconds ثوانى";
		 //
		 $reason = trim($row["reason"]);
		 if(empty($reason) || !isset($reason) || $reason == ""){
			 $reason = "لا يوجد سبب";
		 }
		 if(empty($nick) || !isset($nick) || $nick == ""){
			 $reason = "بدون أسم";
		 }
		 if($dur == 0){
			 $dur = "<h3 class='text-danger'>برمنتلى</h3>";
		 }else{
			//$seconds = $dur/1000;
			//$day = ($dur/60/60/24);
		//	$hour = (($dur/60/60)%24);
			//$min = (($dur/60)%60);
			//$sec = ($dur%60);
			$dur = ago($dur);
		 }
		 $ban = true;
		 break;
	 }
}
	 
	echo "
	
		<hr>
		<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'> Ban Information - معلومات الحظر </h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table warning-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>أخر اسم	</th>
                                                <th>الباند</th>
                                                <th>مبند من قبل</th>
                                                <th>سبب الباند</th>
                                                <th>وقت الباند</th>
                                                <th>مبند من</th>
                                            </tr>
                                        </thead><hr>
	";
	
	if($ban === true){
		echo "<tr>
				<td>$idz</td> <td>$nick</td> <td>$t</td> <td>$baner</td> <td>$reason</td> <td>$dur</td> <td>$mins</td>
			</tr></tbody></table></center>";		
	}else{
		echo "<tr>
				<td>#</td> <td>- - - -</td> <td>لا</td> <td>- - - -</td> <td>- - - -</td> <td>- - - -</td> <td>- - -</td>
			</tr></tbody></table></center> <hr>		
        </div>		
        </div>			
        </div>		
        </div>		
        </div>	";
	}
	
	$srg = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($uerid));
		echo"

		<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'> Server Groups - رتب العضو </h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table warning-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>اسم الرتبة</th>
                                                <th>الايقونة</th>
                                            </tr>
                                        </thead>
							<tbody>
								";
								
								foreach($srg as $srid){
									
									$info = $ts3_VirtualServer->serverGroupGetById($srid);
									$name = $info["name"];
									$imgb = base64_encode($info->iconDownload());
									echo "<tr class='text-center'><td>$srid</td> <td>$name</td> <td> <img src='data:image/gif;base64,$imgb' width='16' height='16' alt='لا يوجد ايقونة'> </td></tr>";
								}
								echo "								</tr>
                            </table>
                        </div>
                    </div>
					<hr>		
        </div>		
        </div>
							";
									
	
	}else{
echo('<script>
           swal({title: "عذراً",text: "لم يتم العثور علي العضو",icon: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
	}
}

?>
		
			
			
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>		
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>