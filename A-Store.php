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
        <div class="page-wrapper">
        <div class="container-fluid">
			  			  <?php cloinsmanager($ggids) ?>	
		
		</br>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> قائمة مشتريات المتجر </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>اسم العضو</th>
                                                <th>عدد الكوينز الحالي</th>
                                                <th>المنتج</th>
                                                <th>تاريخ الشراء</th>
                                                <th>المده</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>الحاله</th>
                                            </tr>
                                        </thead>
										
<tbody>

	<?php
		$sql = "SELECT COUNT(id) FROM `test`.`store`";
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
		//$sql = "SELECT * FROM `test`.`store` ORDER BY status DESC";
		$sql = "SELECT * FROM `test`.`store` ORDER BY id DESC LIMIT $offset,$perPage";
		$res = $con->query($sql);
		while($data = $res->fetch_assoc()){
			$user = intval($data["buyer"]);
			
			try{
				$usernick = $ts3->clientInfoDb($user)["client_nickname"];
			}catch(Exception $e){
				$usernick = "<b>فشل العثور على اسم العضو</b>";
			}
			
			$sqlx = "SELECT coins FROM `Rankqz`.`user` WHERE cldbid='$user'";
			$coins = $con->query($sqlx)->fetch_assoc()["coins"];
			$rank = intval($data["rank"]);
			if($rank === -1){
				$rankx = "1000 كوينز";
			}else{
				try{
					$rankx = $ts3->serverGroupGetById($rank);
				}catch(Exception $e){
					$rankx = "فشل العثور على اسم الرتبة";
				}
				
			}
			$buytime = intval($data["buytime"]);
			$stime = date("Y/m/d h:i:s", $buytime);
			if($rank === -1 || $rank === 2386){
				$etime = '<div class="badge badge-">دائم</div>';
				$xtime = '<div class="badge badge-">دائم</div>';
			}else{
				$status = intval($data["status"]);
				if($status === 0){
					$status = "<div class='badge badge-danger'>لم يتم الدفع</div>";
					$xtime = "- - -";
				}else if($status === 1){
					$status = "<div class='badge badge-success'>تم الدفع</div>";
					$payid = strval($data["payment"]);
				
					$sql = "SELECT * FROM `Rankqz`.`act` WHERE code='$payid' AND hidden='5'";
					$datax = $con->query($sql)->fetch_assoc();
					$stat = strval($datax["status"]);
					$idxo = intval($datax["id"]);
					if($stat == "inactive"){
						$xtime = "<div class='badge badge-danger'>منتهي</div>";
					}else{
						// $timezx = $datax["time"];
						$etime = $datax["etime"];
						// $timezz = explode(':', $timezx);
						$etime = explode(':', $etime);
						$rend = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
						// $rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
						try {
							$rzstart = new DateTime('@'.time());
							$rendzn = new DateTime('@'.$rend);
							$diffz = $rzstart->diff($rendzn);
							$xtime = $diffz->format('<div class="badge badge-info">%a أيام %h ساعات %i دقائق %S ثوانى</div>');
						}catch(Exception $e){
							// die("Problem ID: $idxo || $sql");
							continue;
						}
						
						// $xtime = "hax";
					}
				}
				
				$etime = '<div class="badge badge-">شهر</div>';
			}
			echo "<tr> <td>$usernick</td> <td>$coins</td> <td>$rankx</td> <td>$stime</td> <td>$etime</td> <td>$xtime</td> <td>$status</td> </tr>";
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