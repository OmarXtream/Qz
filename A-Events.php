<?php
require 'config/phphead.php';
//require 'config/sqlconfig.php'; 
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
// ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$cgrp = explode(',', $client_info["client_servergroups"]);
brodcast($cgrp); 
if (isset($_GET["action"])) {
if ( $_GET["action"] == "create" ) {
	$create = true ;
	}
} elseif (isset($_GET["view"])) {
	$view = true ;
} else { $main = true ; }

$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "test";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
die("Database Error: ".$con->connect_error);
}
date_default_timezone_set('Asia/Riyadh');
$now = date("Y-m-j");

if(isset($_POST["submitCreate"])) {
	if( $_POST["e-name"] != "" && $_POST["a-name"] != "" ){		
		$eventName = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["e-name"]))));
		$Date = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["date"]))));
		$Hour = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hour"]))));
		$eventDes = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["e-des"])));
		$adminName = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["a-name"]))));
		$Dat1e = $_POST["date"] ; 
		$status = "";
		if (!$Hour) {
			$Hour = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags("N"))));
		}
		if ( $_POST["date"]  ) {
			$diff = round((strtotime($Dat1e) - strtotime($now)) /24 /60 /60);
			if ($diff == 0) {
			$status = "today";
			} elseif ( $diff > 0) {
			$status = "yet";
			} elseif ( $diff < 0) {
			$status = "finshed";
			}	
		} else {
			$status = "unk";
			$Date = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags("N"))));
		}	
		$sql = "INSERT INTO events (id, eName, eDate, eHour, aName, description, status) VALUES (NULL, '$eventName', '$Date', '$Hour', '$adminName', '$eventDes', '$status')";
		if($con->query($sql) === true){
		echo('<script>
           swal({title: "تم",text: " تم تسجيل الفعاليه بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Events.php");}else {window.location.replace("https://panel.q-z.us/A-Events.php");}})</script>');	

		
		}
		echo("Error description: " . mysqli_error($con));
	} else {
echo('<script>
swal({title: "خطأ",text: "املأ الفراغات المطلوبه",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Events.php");}else {window.location.replace("https://panel.q-z.us/A-Events.php");}})</script>');	
}	
} elseif(isset($_POST["submitEdit"])) {
	if(isset($_POST["e-name"]) && isset($_POST["a-name"])){		
		$id = $con->real_escape_string(stripslashes(htmlspecialchars($_GET["view"])));
		$eventName = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["e-name"]))));
		$Date = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["date"]))));
		$Hour = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hour"]))));
		$eventDes = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["e-des"])));
		$adminName = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["a-name"]))));
		$Dat1e = $_POST["date"] ; 
		$status = "";
		if (!$Hour) {
			$Hour = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags("N"))));
		}
		if ( $_POST["date"]  ) {
			$diff = round((strtotime($Dat1e) - strtotime($now)) /24 /60 /60);
			if ($diff == 0) {
			$status = "today";
			} elseif ( $diff > 0) {
			$status = "yet";
			} elseif ( $diff < 0) {
			$status = "finshed";
			}	
		} else {
			$status = "unk";
			$Date = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags("N"))));
		}	
	//	$sql = "INSERT INTO events (id, eName, eDate, eHour, aName, description, status) VALUES (NULL, '$eventName', '$Date', '$Hour', '$adminName', '$eventDes', '$status')";
		$sql = "UPDATE `events` SET eName='$eventName', eDate='$Date', eHour='$Hour', aName='$adminName', description='$eventDes', status='$status' WHERE id='$id'";

		if($con->query($sql) === true){
		echo('<script>
           swal({title: "تم",text: " تم حفظ التعديلات بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Events.php");}else {window.location.replace("https://panel.q-z.us/A-Events.php");}})</script>');	

		
		}
		echo("Error description: " . mysqli_error($con));
	} 
} elseif(isset($_POST["submitDelete"])) {
$id = $con->real_escape_string(stripslashes(htmlspecialchars($_GET["view"])));
$sql = "DELETE FROM events WHERE id=$id";
if($con->query($sql) === true){
		echo('<script>
           swal({title: "تم",text: " تم حذف الفعاليه بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Events.php");}else {window.location.replace("https://panel.q-z.us/A-Events.php");}})</script>');	

		
	}
} 
?>

<div class="page-wrapper">
        <div class="container-fluid"></br>

			<?PHP
			
if ( $main  == true ) {
				echo '		<center>				
				<div class="col-md-7">
				<div class="card">
				<div class="card-body">
				<center> <h3 class="card-title">جدول الفعاليات</h3> </center>
				<div class="col-lg-4 col-md-4">
				<a href="A-Events.php?action=create" class="btn btn-rounded btn-block btn-outline-info">إنشاء قيمه جديده</a>
				</div>	
				</br>
				<div class="table-responsive">
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th>#</th>
				<th>أسم الفعالية</th>
				<th>تاريخ بدء الفعاليه</th>
				<th>مقدم الفعالية</th>
				<th>حاله الفعاليه [ بدت - أنتهت ]</th>
				<th>[تحكم - حذف]</th>
				</tr>
				</thead>
				<tbody>';
				$sql = "SELECT * FROM events ORDER BY id DESC";
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['eName'] . "</td>";
						echo "<td>" . $row['eDate'] . "</td>";
						echo "<td>" . $row['aName'] . "</td>";
						$status =  $row['status'] ; 
						$id =  $row['id'] ; 
						$diff = round((strtotime($row['eDate']) - strtotime($now)) /24 /60 /60);
			
			
					if ( $row['eDate'] != "N" ) {
						if ($diff == 0) {
							if ($row['eHour'] != "N") {
							echo "<td><span class='badge badge-success'>الفعاليه سوف تبدأ اليوم في الساعه ".$row['eHour']."</span></td>";
							} elseif ( $diff == 0) {
							echo "<td><span class='badge badge-success'>الفعاليه سوف تبدأ اليوم</span></td>";
							}
							} elseif ( $diff > 0) {
							echo "<td><span class='badge badge-info'>الفعاليه سوف تبدأ بعد ، ".$diff." أيام</span></td>";
							} elseif ( $diff < 0) {
							echo "<td><span class='badge badge-danger'>أنتهت الفعاليه</span></td>";
							} 
							} else {
							echo "<td><span class='badge badge-warning'>لم يتم تحديد تاريخ الفعاليه للأن</span></td>";
					}	


					
					
					echo "<td><a href='?view=$id' class='btn btn-rounded btn-outline-success'>تعديل</a></td>";
					 echo "</tr>";
					 }
						} else {
						echo "<tr>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "</tr>";

					}	
				}
				echo '
									</tbody>
								</table>
							</div>
						</div>
					</div>				
			</center>
			';
}

if ( $create == true ) {
	
	echo ' 
	
	<div class="row">
			<div class="col-md-4">
			</div>
				<div class="col-md-4"> 
                        <div class="card border-info">
                            <div class="card-header bg-warning">
                               <center> <h4 class="m-b-0 text-white">جدول الفعاليات ( إنشاء )</h4> </center>
								</div>
							<div class="card-body">
								<form class="font-w300 form-horizontal push-10-t" method="post">
								
								<div class="form-group row">
								<div class="col-12">
								<br>
								<input type="text" class="form-control" id="e-name" name="e-name" placeholder="أسم الفعالية">
								</div>
								</div>

								<label>بأمكانك تجاهل التاريخ والوقت ، لكن سوف يتم تسجيلها على انها فعاليه غير محدده التاريخ</label>
								<label><strong>ملاحظه : يجب مراعاه ان الساعه بتوقت المكه المكرمه</strong></label>

								<div class="form-group row">
								<div class="col-6">
								<input type="date" class="form-control" name="date" placeholder="التاريخ">
								</div>
								
								<div class="col-6">
								<input type="text" class="form-control" name="hour" placeholder="توقيت الفعاليه ( مثل : 9:30 مساء )">
								</div>
								</div>

								
								<div class="form-group">
								<div class="row">
								<div class="col-12">
								<input type="text" class="form-control" name="a-name" placeholder="مقدم الفعالية">
								</div>
								</div>
								</div>	
																
								<div class="col-13">
								<textarea class="form-control" id="example-textarea-input" name="e-des" rows="6" placeholder="وصف مختصر للفعالية .."></textarea>
								</div>
								</br>
								
                                <div class="form-group row">
                                    <div class="col-12 text-center">
								<a href="https://panel.q-z.us/A-Events" class="btn btn-outline-warning">
								 <i class="fa fa-home"></i> الرجوع للجدول
								</a>		

                                        <button id="form_submit_btn"  name="submitCreate" type="submit" class="btn btn-outline-success">
                                            <i class="fa fa-plus"></i> إنشاء قيمه جديده
                                        </button>
        </form>								
                                    </div>

							</div>
						</div>
			</div> </center>
			
			
			

        </div>
        </div>
	
	';
	
	
}

if ( $view == true ) {
		$key = $con->real_escape_string(stripslashes(htmlspecialchars($_GET["view"])));
		$sql = "SELECT * FROM events WHERE id='$key'";
		$res = $con->query($sql);
		if($res->num_rows > 0){
			$data = $res->fetch_assoc();
			$eName = $data["eName"];
			$eDate = $data["eDate"];
			$eHour = $data["eHour"];
			$aName = $data["aName"];
			$description = $data["description"];
		}
		
		
//	if ( $eDate == "N" ) { $eDate = "لم يتم تحديد التاريخ" ; }
	//if ( $eHour == "N" ) { $eHour = "لم يتم تحديد التوقيت" ; }
	
	
	echo ' 
	
	<div class="row">
			<div class="col-md-4">
			</div>
				<div class="col-md-4"> 
                        <div class="card border-info">
                            <div class="card-header bg-warning">
                               <center> <h4 class="m-b-0 text-white">جدول الفعاليات ( تعديل )</h4> </center>
								</div>
							<div class="card-body">
								<form class="font-w300 form-horizontal push-10-t" method="post">
								
								<div class="form-group row">
								<div class="col-12">
								<br>
								<label for="e-name">أسم الفعاليه</label>
								<input type="text" class="form-control" id="e-name" name="e-name" value="'.$eName.'" placeholder="أسم الفعالية">
								</div>
								</div>
							<div class="form-group row">

 ';



						if 	( $eDate == "N" ) {
								echo '
								<div class="col-6">
								<label>لم يتم تحديد تاريخ الفعاليه</label>
								<input type="date" class="form-control" name="date" placeholder="التاريخ">
								</div>
								';
							} else {
								echo '
								<div class="col-6">
								<label>تاريخ الفعاليه ( يجب مراعاه التنسيق )</label>
								<input type="text" class="form-control" name="date" value="'.$eDate.'" placeholder="التاريخ">
								</div>
								';
							
							}	
							
					
					if 	( $eHour == "N" ) {
								echo '
								<div class="col-6">
								<label>لم يتم تحديد وقت الفعاليه</label>
								<input type="text" class="form-control" name="hour"  placeholder="توقيت بدء الفعاليه ">
								</div>
								';
							} else {
								echo '
								<div class="col-6">
								<label>توقيت بدء الفعاليه</label>
								<input type="text" class="form-control" name="hour" value="'.$eHour.'" placeholder="توقيت بدء الفعاليه ">
								</div>
								';
							
					}	


				echo '		</div>		
								<div class="form-group">
								<div class="row">
								<div class="col-12">
								<label>مقدم الفعاليه</label>
								<input type="text" class="form-control" value="'.$aName.'" name="a-name" placeholder="مقدم الفعالية">
								</div>
								</div>
								</div>	
																
								<div class="col-13">
								<label>وصف الفعاليه</label>
								<textarea class="form-control" id="example-textarea-input" value="'.$description.'" name="e-des" rows="6" placeholder="وصف مختصر للفعالية .."></textarea>
								</div>
								</br>
                                <div class="form-group row">
                                    <div class="col-12 text-center">
								<a href="https://panel.q-z.us/A-Events" class="btn btn-outline-warning">
								 <i class="fa fa-home"></i> الرجوع للجدول
								</a>		

                                        <button id="form_submit_btn"  name="submitEdit" type="submit" class="btn btn-outline-success">
                                            <i class="fa fa-save"></i> حفظ التعديلات
                                        </button>
                                        <button id="form_submit_btn"  name="submitDelete" type="submit" class="btn btn-outline-danger">
                                            <i class="fa fa-trash"></i> حذف الفعاليه
                                        </button>
        </form>										
                                    </div>

							</div>
						</div>
			</div> </center>
			
			
			

        </div>
        </div>
	
	';
	
	
}
			
			?>
			
		</div>			
	</div>			
</div>			
<?php require_once('includes/footer.php'); ?>























