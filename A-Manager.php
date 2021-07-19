<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<?php require 'config/sqlconfig.php';?>
<?php 
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
		<?php 
		
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
		
manager($ggids) 
	?>
	
<?php 
$cldbid = $client_info["client_database_id"];
$con = new mysqli($host, $user, $pass, $db);
$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["coins"];
if(!empty($res)){
	$coins = $res;
}else{
	$coins = 0;
}
if(isset($_POST["submit"]) && isset($_POST["group"]) && (isset($_POST["mins"]) || isset($_POST["hours"]) || isset($_POST["days"]))){
	
	 $grp = intval($_POST["group"]);
		
		$deny = array(2,10,1672,1048); // كل الرتب المراد حجبها
		if(in_array($grp, $deny)){
			die('<center> <meta http-equiv="refresh" content="1;url=index.php"><div class="alert alert-danger alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center><strong>غير متاح لك</center></strong>
                                </div>');
								exit;
		}
	$code = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(10, 17));
	
	$mins = intval($_POST["mins"]);
	$hours = intval($_POST["hours"]);
	$days = intval($_POST["days"]);
	
	if(empty($mins) && empty($hours) && empty($days)){
die('<script>
           swal({title: "ركز !!",text: "كيف تبي تنشئ كود وانت ما حطيت معلومات ؟؟",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');
	}else if(!isset($mins) && !isset($hours) && !isset($days)){
die('<script>
           swal({title: "ركز !!",text: "كيف تبي تنشئ كود وانت ما حطيت معلومات ؟؟",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');
	}
	
	 if(empty($mins) || !isset($mins) || $mins < 0){ $mins = 0; }
	if(empty($hours) || !isset($hours) || $hours < 0){ $hours = 0; }
	if(empty($days) || !isset($days) || $days < 0){ $days = 0; }
	if($mins > 60 || $hours > 60 || $days > 60){
die('<script>
           swal({title: "خطأ",text: "لا يمكنك أعطاء رتبه لمده أكثر من 60 يوم ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');		
	}
	$st = "active";
	$timez = strtotime("+$mins minutes +$hours hours +$days days");
	$tdate = date("Y:m:j:H:i:s", $timez);
	$now = date("Y:m:j:H:i:s");
		
	$sql = "INSERT INTO act (id, owner, user, code, time, etime, status, sgid, hidden) VALUES (NULL, '$cldbid', '0', '$code', '$now', '$tdate', '$st', '$grp', 4)";
	$con->query($sql);

		echo('<script>
           swal({title: "تم انشاء الكود بنجاح",text: "[  '.$code.'  ]",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
}

if(isset($_POST["remove"])){
	    if(is_array($_POST["remove"])){
				$codeid = key($_POST["remove"]);
				$sql = "SELECT * FROM act WHERE id='$codeid' LIMIT 1";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					$result = $res->fetch_assoc();
					$codeuser = $result["user"];
					$codesgid = $result["sgid"];
					try{
						$sql = "DELETE FROM act WHERE id='$codeid'";
						$con->query($sql);
						$ts3_VirtualServer->serverGroupClientDel($codesgid, $codeuser);
					}catch (TeamSpeak3_Exception $e){ 
								
					}		

		echo('<script>
           swal({title: "تم",text: "ازالة الكود وحذف العضو",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
					}
			
		}
}
?>		

<?php 
//$xz = array(1007,75,1146,861,77,1411,76,78,79,80,91,169); // رتب المعاقبة
$xx = explode(',', $client_info["client_servergroups"]);
$removez = array(2,10,1555,1672,2171); // يقدر يحذف
//$unpunish = array(10,1555,1557,1554,1556,1553,1548,1048); // ما يتعاقب
if(isset($_POST["submit1"]) && isset($_POST["group"]) && isset($_POST["rclient"]) && (isset($_POST["mins"]) || isset($_POST["hours"]) || isset($_POST["days"]))){
	
	
	$grp = intval($_POST["group"]);
	if(!in_array($grp, $xz)){	
		header("Location: A-Manager.php");
	}
	
	$mins = intval($_POST["mins"]);
	$hours = intval($_POST["hours"]);
	$days = intval($_POST["days"]);
	$rclient = trim(strip_tags($_POST["rclient"]));
	$reason = htmlspecialchars(stripslashes(strip_tags($_POST["reason"])));
	if(!isset($reason) || empty($reason)){
		$reason = "بدون سبب";
	}else{
		$reason = $con->real_escape_string($reason);
	}
	
	if(empty($mins) && empty($hours) && empty($days)){
die('<script>
           swal({title: "ركز !!",text: "كيف تعطي الرتبه بدون مده ؟؟",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');
	}else if(!isset($mins) && !isset($hours) && !isset($days)){
die('<script>
           swal({title: "ركز !!",text: "كيف تعطي الرتبه بدون معلومات ؟؟",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');
	}
	
	
	 if(empty($mins) || !isset($mins) || $mins < 0){ $mins = 0; }
	if(empty($hours) || !isset($hours) || $hours < 0){ $hours = 0; }
	if(empty($days) || !isset($days) || $days < 0){ $days = 0; }
	if($mins > 60 || $hours > 60 || $days > 60){
die('<script>
           swal({title: "خطأ",text: "لا يمكنك أعطاء رتبه لمده أكثر من 60 يوم ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');	
	}
	
	$st = "active";
	$timez = strtotime("+$mins minutes +$hours hours +$days days");
	$tdate = date("Y:m:j:H:i:s", $timez);
	$now = date("Y:m:j:H:i:s");
	
		try{
			$remotedb = $ts3_VirtualServer->clientFindDb($rclient, true)[0];
		}catch(TeamSpeak3_Exception $e){
			try{
				$remotedbz = $ts3_VirtualServer->clientInfoDb($rclient);
				$remotedb = $rclient;
			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "لحدث خطأ برجاء المحاولة مرة اخرى",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');	

			}
		}
		$xhim = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($remotedb));
		if(count(array_intersect($xhim, $unpunish)) > 0){
die('<script>
           swal({title: "اووبس",text: "لا يمكنك أعطاء هذا الشخص الرتبه",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');				
		}
		
	$ts3_VirtualServer->serverGroupClientAdd($grp, $remotedb);
	$sql = "INSERT INTO bad (id, cldbid, stime, etime, reason, punisher, sgid, status, hidden) VALUES (NULL, '$remotedb', '$now', '$tdate', '$reason', '$dbid', '$grp', '$st', 2)";
	$con->query($sql);
echo('<script>
           swal({title: "تم",text: " اعطاء الرتبه بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
}

if(isset($_POST["remove"])){
	    if(is_array($_POST["remove"]) && count(array_intersect($removez, $ggids)) > 0){
				$idzx = key($_POST["remove"]);	
				$sql = "SELECT * FROM bad WHERE id='$idzx' LIMIT 1";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					
					$result = $res->fetch_assoc();
					$cuser = $result["cldbid"];
					$sgidz = $result["sgid"];
					try{
						$ts3_VirtualServer->serverGroupClientDel($sgidz, $cuser);
						$sql = "DELETE FROM bad WHERE id='$idzx'";
						$con->query($sql);
					}catch (TeamSpeak3_Exception $e){ 
								
					}

echo('<script>
           swal({title: "تم",text: "إزاله الرتبه بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
				}
			
		}else{
			
die('<script>
           swal({title: "خطأ",text: "حدث خطأ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Manager");}else {window.location.replace("https://panel.q-z.us/A-Manager");}})</script>');	
		   
		}
}
?>	
		<center>
		<div class="row">
			<div class="col-md-6">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>انشاء الاكواد</b></h4>
					</div>
                             <form method="post">					
                    <div class="card-body">
						<span><h5>يمكنك أنشاء أكواد للمسابقات بمده محدده</h5></span>
						<span><h5>يمنع انشاء كود لمصالح شخصيه يستخدم هذا للمسابقات*</h5></span>
						<hr >
<!-- <div class="form-group">
<div class="input-group">
<input type="text" class="form-control" id="code" style="text-align: center;" placeholder="XXXXXXXXXXXX">
<span class="input-group-btn">
<button class="btn yellow btn-outline" onclick="return randomcode();" type="button">كود عشوائي</button>
</span>
</div>
</div>	 -->					
						<div class="form-group row">
                          <div class="col-4">
                            <input type="number" class="form-control"  name="mins" placeholder="دقائق">
                          </div>
                          <div class="col-4">
                            <input type="number" class="form-control" name="hours" placeholder="ساعات">
                          </div>
                          <div class="col-4">
                            <input type="number" class="form-control" name="days" placeholder="أيام">
                          </div>
                        </div>	
						<br>
						<select class="js-select2 form-control select2-hidden-accessible" id="group" name="group" style="width: 100%; height:40px;">
                <?php
					$sgz = $ts3_VirtualServer->serverGroupList(array("type" => 1));
					$prevx = array(2,10,1672,1048,17,12,1681,1851,1832,1839,1826,1040,197,1682,23,780,1116,1522,88,52,789,1729,104,1787,1776,74,63,918,919,917,920,921,791,923,247,124,1179,1562,1606,1869,1588,1592,1575,924,1546,1547,1347,1398,1684,1865,130,1645,697,1293); // الرتب الى ما تطلع فى الجدول
					foreach($sgz as $sg){
						$sgi = intval($sg["sgid"]);
						if(in_array($sgi, $prevx)){ continue; }
						echo "<option value='$sgi'>$sg</option>";
					}				
				?>
						</select>
                    </div>
					<center><div class="col-md-4">
                      <button name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-success">توفير الكود</button>
                    </div></center>
					<br>
					<br>
					<br>
								  </form>

					
                </div>
                </div>
			<form method="post">			
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>اعطاء رتبة لشخص بوقت محدد</b></h4>
					</div>
                    <div class="card-body">
						<div class="form-group row">
                          <div class="col-4">
                            <input type="number" class="form-control"  name="mins" placeholder="دقائق">
                          </div>
                          <div class="col-4">
                            <input type="number" class="form-control" name="hours" placeholder="ساعات">
                          </div>
                          <div class="col-4">
                            <input type="number" class="form-control" name="days" placeholder="أيام">
                          </div>
                        </div>	
						<br>
						<select class="js-select2 form-control select2-hidden-accessible" id="group" name="group" style="width: 100%; height:40px;">
                <?php
					$sgz = $ts3_VirtualServer->serverGroupList(array("type" => 1));
					$prevx = array(2,10,1672,1048,17,12,1681,1851,1832,1839,1826,1040,197,1682,23,780,1116,1522,88,52,789,1729,104,1787,1776,74,63,918,919,917,920,921,791,923,247,124,1179,1562,1606,1869,1588,1592,1575,924,1546,1547,1347,1398,1684,1865,130,1645,697,1293); // الرتب الى ما تطلع فى الجدول
					foreach($sgz as $sg){
						$sgi = intval($sg["sgid"]);
						if(in_array($sgi, $prevx)){ continue; }
						echo "<option value='$sgi'>$sg</option>";
					}				
				?>
						</select>
						<br>
						<br>
						<input type="text" name="rclient" class="form-control" placeholder="ادخل ID العضو مثل rLsT0G5kuzvnsftf0jS39LVZUTY= " /><br/><br/>
						<input type="text" name="reason" class="form-control" placeholder="سبب أعطاء الرتبه" />
						
						
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="submit1" class="btn btn-rounded btn-block btn-outline-success"> أعطاء الرتبه المحدده </button>
                    </div></center> </form>
					<br>
					
					
                </div>
							  </form>				
                </div>
				</center>
				
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> سجل انشاء الاكواد </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الكود</th>
                                                <th>المنشئ</th>
                                                <th>الرتبه</th>
                                                <th>المستخدم</th>
                                                <th>المدة المتبقية للكود</th>
                                                <th>وقت الكود</th>
                                                <th>حذف الكود</th>
                                            </tr>
                                        </thead>
                                        <tbody>
						<?php
						
							$sql = "SELECT COUNT(id) FROM act";
							$res = $con->query($sql);
							$rz = $res->fetch_row();
							$numrow = $rz[0];
							$perPage = 15;
							$totalp = ceil($numrow / $perPage);
							
							if(isset($_GET["page"]) && is_numeric($_GET["page"])){
								$page = (int)$_GET["page"];
							}else{
								$page = 1;
							}
							if($page > $totalp){
								$page = $totalp; 
							}else if($page < 1){
								$page = 1;
							}
							$offset = ($page - 1) * $perPage;
							
							$sql = "SELECT * FROM act WHERE hidden='4' ORDER BY id DESC LIMIT $offset,$perPage";					
							$res = $con->query($sql);

							while($data = $res->fetch_assoc()){
								$idu = $data["id"];
								$owner = $data["owner"];
																
								$user = $data["user"];
								$code = $data["code"];
								$timezx = $data["time"];
								$etime = $data["etime"];
								$status = $data["status"];
								$sgid = $data["sgid"];
								
								try{
									$name = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
									$nameg = $ts3_VirtualServer->serverGroupGetById($sgid);
									$own = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
									if($user != 0){
										$use = $ts3_VirtualServer->clientInfoDb($user)["client_nickname"];
									}else {
										$use = "غير مستعمل";
									}
								}catch(TeamSpeak3_Exception $e){}
								//$time = explode(':', $time);
								$timezz = explode(':', $timezx);
								if($status == "active" && $user == 0){
									$remain = "غير مستعمل";
									
									
									$etime = explode(':', $etime);
									$rend = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
									$rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
									$rzstart = new DateTime('@'.$rendxx);
									$rendzn = new DateTime('@'.$rend);
									$diffz = $rzstart->diff($rendzn);
									$codtime = $diffz->format('%a أيام %h ساعات %i دقائق %S ثوانى');
								}else if($status == "inactive"){
									$remain = "منتهى";
									
									
									$etime = explode(':', $etime);
									$rend = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
									$rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
									$rzstart = new DateTime('@'.$rendxx);
									$rendzn = new DateTime('@'.$rend);
									$diffz = $rzstart->diff($rendzn);
									$codtime = $diffz->format('%a أيام %h ساعات %i دقائق %S ثوانى');
								}else if($status == "active" && $user != 0){
									
									$etimez = explode(':', $etime);
									$rend = mktime($etimez[3],$etimez[4],$etimez[5],$etimez[1],$etimez[2],$etimez[0]);
									$rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
									
									$rzstart = new DateTime('@'.$rendxx);
									$rendzn = new DateTime('@'.$rend);
									$diffz = $rzstart->diff($rendzn);
									$codtime = $diffz->format('%a أيام %h ساعات %i دقائق %S ثوانى');
									
									 $etime = explode(':', $etime);
									 $rendv = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
									// $rstart = time();
									// $seconds = $rend - $rstart;
									// $days    = floor($seconds / 86400);
									// $hours   = floor(($seconds - ($days * 86400)) / 3600);
									// $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
									// if($minutes == 0){
										// $secs = floor(($seconds - ($days * 86400) - ($hours * 3600)));
									// }else{
										// $secs = 0;
									// }
									
									
									
									
									$rstartz = new DateTime();
									$rendz = new DateTime('@'.$rendv);
									$diffx = $rstartz->diff($rendz);
									
									$remain = $diffx->format('%a أيام %h ساعات %i دقائق %S ثوانى');
								}
								
								echo "<tr class=''> <td>$code</th> <td>$own</td> <td>$nameg</th>  <td>$use</td> <td>$remain</td> <td>$codtime</td>";
											$remove = array(2,10,1555,1048,1672,2171);
											if(!count(array_intersect($remove, $ggids)) > 0){
												echo "<td><button type='button' class='btn btn-danger disabled delete btn-xs'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
											}else{
												echo "<td><form method='post'><button type='submit' name='remove[$idu]' class='btn btn-success delete btn-xs'><img src='https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png'><i class='glyphicon glyphicon-remove'></i></button></form></td> </tr>";
											}
							}	
						?>
                                        </tbody>
                                    </table>
							<center>
						<ul class="pagination pagination-lg">
							<?php
								for($i = 1; $i <= $totalp; $i++){
									if($page === $i){
										echo "<li class='paginate_button page-item active'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}else{
										echo "<li class='paginate_button page-item'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}
								}
							?>
					  </ul>
					  		</center>										
                                </div>
                        </div>
					 </div>
                    </div>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> سجل توفير الرتب </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الرتبة</th>
                                                <th>الادمن</th>
                                                <th>العضو</th>
                                                <th>الايدي</th>
                                                <th>السبب</th>
                                                <th>التاريخ‬‎</th>
                                                <th>مده الرتبة</th>
                                                <th>المدة المتبقية	</th>
                                                <th>حذف</th>
                                            </tr>
                                        </thead>
                        <tbody>
						<?php
						//الرتبة - المنشئ - الايدي - الاسم - السبب - المدة - مسح الرتبة‬‎
							$sql = "SELECT COUNT(id) FROM bad";
							$res = $con->query($sql);
							$rz = $res->fetch_row();
							$numrow = $rz[0];
							$perPage = 15;
							$totalp = ceil($numrow / $perPage);
							
							if(isset($_GET["page"]) && is_numeric($_GET["page"])){
								$page = (int)$_GET["page"];
							}else{
								$page = 1;
							}
							if($page > $totalp){
								$page = $totalp; 
							}else if($page < 1){
								$page = 1;
							}
							$offset = ($page - 1) * $perPage;
							
							$sql = "SELECT * FROM bad WHERE hidden='2' ORDER BY id DESC LIMIT $offset,$perPage";												
							$res = $con->query($sql);

							while($data = $res->fetch_assoc()){
								
								$idz = $data["id"];
								$owner = $data["punisher"];		
								$user = $data["cldbid"];
								
								$reason = $data["reason"];
								$time = explode(':', $data["stime"]);								
								$timezx = $data["stime"];
								$etime = $data["etime"];
								$status = $data["status"];
								$sgid = $data["sgid"];
									$noz = $time[0]."/".$time[1]."/".$time[2];							
								try{
									$ownz = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
									$nameg = $ts3_VirtualServer->serverGroupGetById($sgid);
									$userz = $ts3_VirtualServer->clientInfoDb($user)["client_nickname"];
									$userid = $ts3_VirtualServer->clientInfoDb($user)["client_unique_identifier"];
									
								}catch(TeamSpeak3_Exception $e){}

								$timezz = explode(':', $timezx);
								if($status == "active"){
									
									$etimez = explode(':', $etime);
									$rend = mktime($etimez[3],$etimez[4],$etimez[5],$etimez[1],$etimez[2],$etimez[0]);
									$rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
									
									$rzstart = new DateTime('@'.$rendxx);
									$rendzn = new DateTime('@'.$rend);
									$diffz = $rzstart->diff($rendzn);
									$codtime = $diffz->format('%a أيام %h ساعات %i دقائق');
									
									 $etime = explode(':', $etime);
									 $rendv = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
									// $rstart = time();
									// $seconds = $rend - $rstart;
									// $days    = floor($seconds / 86400);
									// $hours   = floor(($seconds - ($days * 86400)) / 3600);
									// $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
									// if($minutes == 0){
										// $secs = floor(($seconds - ($days * 86400) - ($hours * 3600)));
									// }else{
										// $secs = 0;
									// }
									
									
									
									
									$rstartz = new DateTime();
									$rendz = new DateTime('@'.$rendv);
									$diffx = $rstartz->diff($rendz);
									
									$remain = $diffx->format('%a أيام  %h ساعات  %i دقائق  %S ثوانى');
									
								}else{
									$etimez = explode(':', $etime);
									$rend = mktime($etimez[3],$etimez[4],$etimez[5],$etimez[1],$etimez[2],$etimez[0]);
									$rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
									
									$rzstart = new DateTime('@'.$rendxx);
									$rendzn = new DateTime('@'.$rend);
									$diffz = $rzstart->diff($rendzn);
									$codtime = $diffz->format('%a أيام %h ساعات  %i دقائق');
									
									 $etime = explode(':', $etime);
									 $rendv = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
				
									$rstartz = new DateTime();
									$rendz = new DateTime('@'.$rendv);
									$diffx = $rstartz->diff($rendz);										
									$remain = "منتهية";							
								}
								echo "<tr class=''> 
								<td>$nameg</td> 
								<td>$ownz</td> 
								<td>$userz</td> 																
								<td>$userid</td> 
								<td>$reason</td>  
								<td>$noz</td>																
								<td>$codtime</td>
								<td>$remain</td>
								";

											
											if(!count(array_intersect($removez, $ggids)) > 0  || $remain === "منتهية"){
												echo "<td ><button type='submit' disabled class='btn btn-warning'><img src='image/Cross-16.png'></button></td> </tr>";
											}else{
												echo "<td> <form method='post'><button  type='submit' name='remove[$idz]' class='btn btn-success'><img src='image/Cross-16.png'></button></form></td> </tr>";
											}
							}	
						?>
                        </tbody>
                                    </table>
							<center>
						<ul class="pagination">
							<?php
								for($i = 1; $i <= $totalp; $i++){
									if($page === $i){
										echo "<li class='paginate_button page-item active'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}else{
										echo "<li class='paginate_button page-item'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}
								}
							?>
					  </ul>
					  		</center>									
                                </div>
                        </div>
					 </div>
                    </div>
			

			
			
			
			
			
			
			</div>
			
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>