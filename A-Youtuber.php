<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require 'config/phphead.php'; 
?>
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
		if(isset($_POST["rma"]) && is_array($_POST["rma"])){
				 $hostz = "localhost";
				 $userz = "root";
				 $passz = "qvaGN6vy9EaZMw5l";
				 $dbz = "yt"; 
				$con = new mysqli($hostz, $userz, $passz, $dbz);
				if($con->connect_error){
				die("Failed To COnnect!");
				}
			
			$rma = intval(key($_POST["rma"]));
			$sql = "SELECT * FROM youtube WHERE cdb='$rma'";
			$res = $con->query($sql);
			if($res->num_rows === 1){
				$data = $res->fetch_assoc();
				$idx = intval($data["id"]);
				$cid = intval($data["CID"]);
				$sgix = intval($data["sgroup"]);
				
					if($cid > 0){
						try {
							$ts3_VirtualServer->channelDelete($cid, true);
						} catch(Exception $e) {
							
						}
					}
					try {
						$ts3_VirtualServer->serverGroupClientDel($sgix, $rma);
					} catch(Exception $e) {
							
					}
					$sql = "DELETE FROM youtube WHERE id='$idx'";
					$con->query($sql);
				
					
				
			}
			$con->close();
			echo('<script>
           swal({title: "تم",text: "الحظر بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>
        <div class="page-wrapper">
        <div class="container-fluid">
			<?php 
$cgrp = explode(',', $client_info["client_servergroups"]);
yt($cgrp);  ?>		
		</br>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> التحكم باليوتيوبر الرابطين </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>اسم القناه</th>
                                                <th>المركز</th>
                                                <th>عدد المشتركين</th>
                                                <th>عدد المقاطع	</th>
                                                <th>عدد المشاهدات</th>
                                                <th>اخر تواجد لة</th>
                                                <th>الاسم بالتيم سبيك</th>
                                                <th>DATABASE ID	</th>
                                                <th>الغاء ربط القناة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php

					    // $hideit = array();
						 // $auto = array(11);
						 // $vipx = 628;
							 $hostz = "localhost";
							 $userz = "root";
							 $passz = "qvaGN6vy9EaZMw5l";
						     $dbz = "yt"; 
							$con = new mysqli($hostz, $userz, $passz, $dbz);
							if($con->connect_error){
								die("Failed To COnnect!");
							}
							$sql = "SELECT * FROM youtube ORDER BY sub DESC";
							$res = $con->query($sql);
							$ix = 1;
							while($data = $res->fetch_assoc()){
								
								$idz = $data["id"];
								// if(!in_array($idz, $auto)){ continue; }
								$subsz = $data["sub"];
								$viewz = $data["views"];
								$cdb = $data["cdb"];
								$xserv = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($cdb));
								// if(!in_array($vipx, $xserv)){
									// continue;
								// }
								// array_push($hideit, $cdb);
								$tsnamez = $ts3_VirtualServer->clientGetNameByDbid("$cdb");
								$vidsz = $data["videos"];
								$namez = $data["name"];
								$imgz = $data["img"];
								$datax = $con->query("SELECT online,lastseen FROM `Rankqz`.`user` WHERE cldbid='$cdb' LIMIT 1")->fetch_assoc();
								$lastseen = intval($datax["online"]);
								$lastseenx = intval($datax["lastseen"]);
								if($lastseen === 1){
									$lastseen = "<span class='text-success'>متواجد الان</span>";
								}else{
									// $lastseen = "<span class='text-danger'>غير موجود</span>";
										$datetime1 = new DateTime(date("Y-m-d H:i:s", $lastseenx));
										$datetime2 = new DateTime();
										$interval = $datetime1->diff($datetime2);
										$lastseen = $interval->format('%a يوم, %H ساعة, %I دقيقة و %S ثانية  ');
								}
							
																
								$IDChannelz = $data['YTID'];
								echo '<tr class="border-bottom-danger border-custom-color">
								<td ><a target="_blank" href="https://www.youtube.com/channel/'.$IDChannelz.'"><a class="avatar avatar-online" target="_blank" href="https://www.youtube.com/channel/'.$IDChannelz.'"><img alt="user" width="40" class="img-circle" src="'.$imgz .'" alt=""><strong>'.htmlspecialchars($namez).'</strong></a></td>
								<td><span class="label label-info label-mini">'.$ix.'</span></td>
								<td><span class="label label-info label-mini">'.$subsz.'</span> </td>
								<td><span class="label label-info label-mini">'.$vidsz.'</span></td>
								<td><span class="label label-warning label-mini">'.$viewz.'</span></td>
								<td><span class="label label-warning label-mini">'.$lastseen.'</span></td>
								<td><strong>'.htmlspecialchars($tsnamez['name']).'</strong></td>
								<td><span class="label label-warning label-mini">'.$cdb.'</span></td>
								<td><form method="post"><button type="submit" class="btn btn-warning btn-danger" name="rma['.$cdb.']">الغاء الربط</button></form></td>
								</tr>';
								$ix++;
							}	
							$con->close();

?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
					 </div>
                    </div>
		
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>