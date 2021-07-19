<?php require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php';?>
<?php 
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
<?php 
ini_set("default_charset", 'utf-8');
if(isset($_POST["rmg"])){
	$rmg = $_POST["rmg"];
	if(!empty($rmg) && is_array($rmg)){
		$rmz = explode(":", key($rmg));
		$rmdb = $rmz[0];
		$rmsv = $rmz[1];
		$idx = $rmz[2];
		$chls = $rmz[3];
		if(!empty($chls)){
		$chl = explode(",", $chls);
		$ts3->channelDelete($chl[0], true);
		$ts3->channelDelete($chl[3], true);
		}

		$ts3->serverGroupClientDel($rmsv, $rmdb);
		$sql = "UPDATE codes SET removed='Yes',status='inactive' WHERE id='$idx' LIMIT 1";
		$con->query($sql);
		
	}
	echo('<script>
           swal({title: "تم",text: "حذف المشتريات من العضو بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}else if(isset($_POST["rma"])){
		$rmg = $_POST["rma"];
	if(!empty($rmg) && is_array($rmg)){
		$rmz = explode(":", key($rmg));
		$rmdb = $rmz[0];
		$rmsv = $rmz[1];
		$idx = $rmz[2];
		$chls = $rmz[3];
		if(!empty($chls)){
		$chl = explode(",", $chls);
		$ts3->channelDelete($chl[0], true);
		$ts3->channelDelete($chl[3], true);
		}

		try { 
			$ts3->serverGroupClientDel($rmsv, $rmdb);
		}catch(Exception $e) {} 
		$sql = "DELETE FROM codes WHERE id='$idx' LIMIT 1";
		$con->query($sql);
		
	}	echo('<script>
           swal({title: "تم",text: "ازالة المشتريات من السجل",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
?>
        <div class="page-wrapper">
        <div class="container-fluid">
			  			  <?php cloinsmanager($ggids) ?>	
		
		</br>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> قائمه مشتريات الكوينز </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>اسم العضو</th>
                                                <th>عدد الكوينز الحالي	</th>
                                                <th>المنتج</th>
                                                <th>تاريخ الشراء</th>
                                                <th>المده</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>الحاله</th>
                                                <th>حذف</th>
                                                <th>حذف من سجل المشتريات</th>
                                            </tr>
                                        </thead>
										
<tbody>

						<?php
						$sql = "SELECT COUNT(id) FROM codes";
							$res = $con->query($sql);
							$rz = $res->fetch_row();
							$numrow = $rz[0];
							$perPage = 50;
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
							
							$sql = "SELECT * FROM codes ORDER BY id DESC LIMIT $offset,$perPage ";					
							$res = $con->query($sql);
							
														$boosters = array(1945,1946,1947,2243);

							while($data = $res->fetch_assoc()){
									$status = $data["status"];
									$time = explode(':', $data["time"]);
									$cldbid = $data["cldbid"];
									$chls = $data["chl"];
									$nn = $ts3->clientInfoDb($cldbid)["client_nickname"];
									$sqlz = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
									$idz = $data["id"];
									$coins = $con->query($sqlz)->fetch_assoc()["coins"];

									$noz = $time[0]."/".$time[1]."/".$time[2]." ".$time[3].":".$time[4];							
									$etime = explode(':', $data["etime"]);
									$eoz = $etime[0]."/".$etime[1]."/".$etime[2]." ".$etime[3].":".$etime[4];
									try { 
										$sgid = $ts3->serverGroupGetById($data["sgid"]);
									} 
									catch(Exception $e) { 
										$sgid = "ErrorG: ".$data["sgid"];
									} 
									
									$sgidz = $data["sgid"];
									$rend = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
									$rstart = time();
									$seconds = $rend - $rstart;
									$days    = floor($seconds / 86400);
									$hours   = floor(($seconds - ($days * 86400)) / 3600);
									$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
									$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
									$remain = "<td>$days يوم $hours ساعة $minutes دقيقة</td>";
									$remd = $data["removed"];
									 if($status == "inactive"){
										 $remain = "<td class='text-warning'>00:00</td>";
										 $stat = "<td class='text-danger'>انتهى</td>";
									 }
									
									 if($status == "active"){
										 $stat = "<td class='text-success'>فعال</td>";
									 }
								// if($data["etime"] == "continue" && in_array($data["sgid"], $boosters)) {
									// $sgidx = $ts3_VirtualServer->serverGroupGetById($data["sgid"]);
									// echo "<tr ><th scope='row'>$sgidx</th>";
									// echo "<td>$noz</td> <td >00:00</td> <td >تنسحب تلقائي</td>";
									// echo "<td class='text-success'>تلقائي</td> </tr>";
									// continue;	
								// }else if($data["etime"] == "continue"){
									// echo "<tr ><th scope='row'>ايقونة خاصة</th>";
									// echo "<td>$noz</td> <td >00:00</td> <td >دائم</td>";
									// echo "<td class='text-success'>فعال</td> </tr>";
									// continue;
								// }									 
									 if($data["etime"] == "continue" && in_array($data["sgid"], $boosters)) {
										  $sgidx = $ts3_VirtualServer->serverGroupGetById($data["sgid"]);
										  $sgid = "$sgidx";
										  $remain = "<td>00:00</td>";
										  $eoz = "دائم";
										  $stat = "<td class='text-success'>فعال</td>";
									 }else if($data["etime"] == "continue"){
										  $sgid = "ايقونة خاصة";
										  $remain = "<td>00:00</td>";
										  $eoz = "دائم";
										  $stat = "<td class='text-success'>فعال</td>";
									 }
									 if($remd === "No"){
										 $zxz = "<form method='post'><button type='submit' class='btn btn-warning btn-warning' name='rmg[$cldbid:$sgidz:$idz:$chls]'>حذف</button></form>";
									 }else{
										 $zxz = "<h3 class='text-warning'>محذوف</h3>";
									 }
									 
									echo "<tr> <td>$nn</td> <td>$coins</td> <td>$sgid</td> <td>$noz</td> $remain <td>$eoz</td> $stat <td>$zxz</td> <td><form method='post'><button type='submit' class='btn btn-warning btn-danger' name='rma[$cldbid:$sgidz:$idz:$chls]'>حذف نهائى</button></form></td></tr>";
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
		
<?php require_once('includes/footer.php'); ?>