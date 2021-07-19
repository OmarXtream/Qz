<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
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
			  			  <?php reedem($ggids) ?>				
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
$xx = explode(',', $client_info["client_servergroups"]);
if(isset($_POST["submit"]) && isset($_POST["group"]) && (isset($_POST["mins"]) || isset($_POST["hours"]) || isset($_POST["days"]))){
	
	$xz = array(30, 709, 85, 86, 87 , 1965 , 1501 , 999 , 555);
	$grp = intval($_POST["group"]);
	//$t = $_POST["time"];
	if(!in_array($grp, $xz , $xr )){	
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
	}
	
	if($grp == 999){
			$xr = array(1309, 1310, 1311, 1312,713,715,716,722,725,732,733,33,167,626);
			shuffle($xr);
			$grpz = array_rand($xr);
			$grp = $xr[$grpz];
	}else if($grp == 555){
			$xr = array(30,85,86,87,1965,1501);
			shuffle($xr);
			$grpz = array_rand($xr);
			$grp = $xr[$grpz];
	}
	
	$code = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(10, 17));
	
	$mins = intval($_POST["mins"]);
	$hours = intval($_POST["hours"]);
	$days = intval($_POST["days"]);
	
	if(empty($mins) && empty($hours) && empty($days)){
		
die('<script>
           swal({title: "ركز !!",text: "كيف تبي تنشئ كود وانت ما حطيت معلومات ؟؟",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Reedem");}else {window.location.replace("https://panel.q-z.us/A-Reedem");}})</script>');		
		   

	}else if(!isset($mins) && !isset($hours) && !isset($days)){
die('<script>
           swal({title: "ركز !!",text: "كيف تبي تنشئ كود وانت ما حطيت معلومات ؟؟",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Reedem");}else {window.location.replace("https://panel.q-z.us/A-Reedem");}})</script>');
	}
	
	 if(empty($mins) || !isset($mins) || $mins < 0){ $mins = 0; }
	if(empty($hours) || !isset($hours) || $hours < 0){ $hours = 0; }
	if(empty($days) || !isset($days) || $days < 0){ $days = 0; }
	if($mins > 60 || $hours > 60 || $days > 14){
die('<script>
           swal({title: "خطاء",text: "لأ يمكنك انشاء كود اكثر من 14 يوم ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Reedem");}else {window.location.replace("https://panel.q-z.us/A-Reedem");}})</script>');		
		
	}
	$st = "active";
	$timez = strtotime("+$mins minutes +$hours hours +$days days");
	$tdate = date("Y:m:j:H:i:s", $timez);
	$now = date("Y:m:j:H:i:s");
	
	//die("<div dir'ltr'>Edited: $tdate <br/><br/> Now: $now   <br/><br/>  $mins:$hours:$days</div>");
	
	$sql = "INSERT INTO act (id, owner, user, code, time, etime, status, sgid) VALUES (NULL, '$cldbid', '0', '$code', '$now', '$tdate', '$st', '$grp')";
	$con->query($sql);

		echo('<script>
           swal({title: "تم انشاء الكود بنجاح",text: "['.$code.']",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
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
		<center>
			<div class="col-md-7">
			                             <form method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>انشاء الاكواد</b></h4>
					</div>
                    <div class="card-body">
					
					<h5>يمكنك أنشاء أكواد للمسابقات بمده محدده</h5>
					<h5>يمنع أنشاء أكواد لمصالح شخصيه / كل الأكواد مراقبه من قبل الأداره العليا</h5>
					<hr>
					<br>
					<br>
					<div class="form-group row">
						<div class="col-4">
						<input type="number" class="form-control" name="mins" placeholder="دقائق">
						</div>
						<div class="col-4">
						<input type="number" class="form-control" name="hours" placeholder="ساعات">
						</div>
						<div class="col-4">
						<input type="number" class="form-control" name="days" placeholder="أيام">
						</div>
					</div>		  
					<select class="js-select2 form-control select2-hidden-accessible" id="group" name="group" style="width: 100%; height:40px;">
						<option>اختر الميزة...</option>
						<option value="1965">● [ Platinum Membership ]</option>
						<option value="85">● [ Gold Membership ]</option>
						<option value="86">● [ Silver Membership ]</option>
						<option value="87">● [ Bronze Membership ]</option>
						<option value="30">● Special User</option>
						<option value="1501">● V.I.P | Gift</option>
						<option value="999">أيقونة عشوائيه</option>
						<option value="555">رتبة عشوائيه</option>
					</select>
					<br>
					<br>
                    </div>
					<center><div class="col-md-4">
                      <button name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-danger"> أنشاء الكود </button>
                    </div></center>
					<br>			  </form>

					
					
                </div>
            </div>
		</center>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> قائمه الاكواد </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الكود</th>
                                                <th>المنشئ</th>
                                                <th>الرتبه</th>
                                                <th>المستخدم</th>
                                                <th>حالة الكود</th>
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
							
							$sql = "SELECT * FROM act WHERE status = 'inactive' ORDER BY id DESC LIMIT $offset,$perPage ";					
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
								//$hidden = $data["hidden"];
								
								try{
									$name = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
									$nameg = $ts3_VirtualServer->serverGroupGetById($sgid);
								//	$chown = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($owner));
								   // if($hidden === 1){ continue; }
									$own = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
									if($user != 0){
										$use = $ts3_VirtualServer->clientInfoDb($user)["client_nickname"];
									}else {
										$use = "غير مستعمل";
									}
								// if(in_array(10, $chown)){ continue; }
								}catch(TeamSpeak3_Exception $e){}

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
								
								echo "<tr class=''> <td>$code</td> <td>$own</td> <td>$nameg</th>  <td>$use</td> <td>$remain</td> <td>$codtime</td>";
											$remove = array(2,10,84,1052,1314,11);
											if(!count(array_intersect($remove, $ggids)) > 0){
												echo "<td><button type='button' class='btn btn-danger disabled delete btn-xs'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
											}else{
												echo "<td><form method='post'><button type='submit' name='remove[$idu]' class='btn btn-warning btn-danger'><img src='https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png'>حذف<i class='glyphicon glyphicon-remove'></i></button></form></td> </tr>";
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
		
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>