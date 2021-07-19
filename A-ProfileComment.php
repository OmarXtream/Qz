<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
die();

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
?>
		<?php 
				comment($ggids) 
		?>
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> التحكم التعليقات</h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                           <tr>
                                                <th>رقم التعليق</th>
                                                <th>المرسل</th>
                                                <th>المستقبل</th>
                                                <th>التعليق 	</th>
                                                <th>التاريخ</th>												
                                                <th>حذف</th>
                                                <th>حظر</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php

							 $hostz = "localhost";
							 $userz = "root";
							 $passz = "qvaGN6vy9EaZMw5l";
						     $dbz = "simple"; 
							$con = new mysqli($hostz, $userz, $passz, $dbz);
							if($con->connect_error){
								die("Failed To COnnect!");
							}
							$con->set_charset("utf8");
							if(isset($_POST["del"])){
								if(is_array($_POST["del"])){
									$key = $con->real_escape_string(htmlspecialchars(intval(key($_POST["del"]))));
									$sql = "DELETE FROM Profile_Comments WHERE Comment_ID='$key'";
									$con->query($sql);
								}
								
echo('<script>
           swal({title: "تم",text: "حذف التعليق بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
							}else if(isset($_POST["block"])){
								if(is_array($_POST["block"])){
									$key = $con->real_escape_string(htmlspecialchars(intval(key($_POST["block"]))));
									$sql = "SELECT * FROM Profile_Comments WHERE Comment_ID='$key'";
									$res = $con->query($sql);
									if($res->num_rows === 1){
										$uidx = trim(htmlspecialchars(stripslashes(strip_tags($res->fetch_assoc()["Commenter_UID"]))));
										try{
											$x = $ts3_VirtualServer->clientFindDb("$uidx",true)[0];
											$ts3_VirtualServer->serverGroupClientAdd(1752, $x);
											// $sql = "DELETE FROM Profile_Comments WHERE Comment_ID='$key'";
											// $con->query($sql); بطفى الكود الى يحذف هنا شوية
										}catch(Exception $e){
											
										}
									}
									// $sql = "DELETE FROM Profile_Comments WHERE Comment_ID='$key'";
									// $con->query($sql);
								}
								
echo('<script>
           swal({title: "تم",text: "حظر العضو بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>'); 
		   }
							$sql = "SELECT * FROM Profile_Comments";
							$res = $con->query($sql);
							$ix = 1;
							while($data = $res->fetch_assoc()){
								$idz = htmlspecialchars($data["Comment_ID"]);
								$subsz = htmlspecialchars($data["Commenter_UID"]);
								$viewz = htmlspecialchars($data["Commented_UID"]);
								$cdb = strval(htmlspecialchars($data["Comment"]));
								try{
									$x = $ts3_VirtualServer->clientFindDb("$subsz",true)[0];
									$x2 = $ts3_VirtualServer->clientInfoDb($x)["client_nickname"];
									// print("<pre>".print_r($x, true)."</pre>");
									// die;
									// $tsnamez = $ts3_VirtualServer->clientGetNameByUid("rLsT0G5kuzvnsftf0jS39LVZUTY=");
									$x3 = $ts3_VirtualServer->clientFindDb("$viewz",true)[0];
									$x4 = $ts3_VirtualServer->clientInfoDb($x3)["client_nickname"];									
								}catch(Exception $e){
										
									}	
								$imgz = $data["Comment_Date"];		
									$grpx = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($x));
									if(in_array(1752, $grpx)){
										$btnblock = '<form method="post"><button type="submit" class="btn btn-primary" name="ublock['.$idz.']">ك الحظر</button></form>';
									}else{
										$btnblock = '<form method="post"><button type="submit" class="btn btn-danger" name="block['.$idz.']">حظر</button></form>';
									}
									 // print("<pre>".print_r($x, true)."</pre>");
									 // die;
									
								
								echo '<tr class="border-bottom-danger border-custom-color">
								<td><span class="label label-info label-mini">'.$ix.'</span></td>
								<td><span class="label label-info label-mini">'.$x2.'</span> </td>
								<td><span class="label label-warning label-mini">'.$x4.'</span></td>
								<td><span class="label label-warning label-mini">'.$cdb.'</span></td>
								<td><span class="label label-warning label-mini">'.$imgz.'</span></td>
								<td> <form method="post"><button type="submit" class="btn btn-warning" name="del['.$idz.']">حذف</button></form></td>
								<td> '.$btnblock.' </td>
								
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