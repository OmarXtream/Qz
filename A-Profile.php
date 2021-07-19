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
				cprofile($ggids) 
		?>
		
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title">التحكم بالبروفايلات</h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                           <tr>
                                                <th>رقم العضو</th>
                                                <th>اسم العضو</th>
                                                <th>الداتا بيز ايدي</th>
                                                <th>الينك ايدي</th>
                                                <th>الاسم بالتيم سبيك</th>
                                                <th>حذف</th>
                                         <!--        <th>حظر</th> -->
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
							if(isset($_POST["del"])){
								if(is_array($_POST["del"])){
									$key = $con->real_escape_string(htmlspecialchars(intval(key($_POST["del"]))));
									$sql = "DELETE FROM Users WHERE DBID='$key'";
									$con->query($sql);
								}
								
echo('<script>
           swal({title: "تم",text: "حذف يوزر العضو ب",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>'); 
							}
							
							$sql = "SELECT * FROM Users";
							$res = $con->query($sql);
							$ix = 1;
							while($data = $res->fetch_assoc()){
								$idz = $data["user"];
								$subsz = $data["DBID"];
								$viewz = $data["UID"];	
								$adminz = $ts3_VirtualServer->clientInfoDb($subsz)["client_nickname"];
								
								echo '<tr class="border-bottom-danger border-custom-color">
								<td><span class="label label-info label-mini">'.$ix.'</span></td>
								<td><span class="label label-primary label-mini">'.$idz.'</span> </td>								
								<td><span class="label label-warning label-mini">'.$subsz.'</span> </td>
								<td><span class="label label-danger label-mini">'.$viewz.'</span></td>
								<td><span class="label label-info label-mini">'.$adminz.'</span></td>
								<td> <form method="post"><button type="submit" class="btn btn-danger" name="del['.$subsz.']">حذف</button></form></td>								
								
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