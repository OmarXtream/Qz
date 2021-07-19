<?php
require_once('config/phphead.php');
require_once('includes/header2.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
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
                        <h4 class="m-b-0 text-white"><b>البحث المتقدم عن الأعضاء</b></h4>
					</div>
                    <div class="card-body">			
					<br>
					<hr>
					<br>
					<input class="form-control text-center" dir="ltr" placeholder="DatabaseID [ DBID ]" type="text" name="user" id="00" autocomplete="off"><br>
					<br>
					
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="submit" class="btn btn-rounded btn-block btn-outline-success"> أبحث الأن </button>
                    </div></center>
					<br>	 
			</form>
					
					
                </div>
            </div>
		</center>


	<?php 
if(isset($_POST['submit']) && isset($_POST['user']) && is_numeric($_POST['user'])){
	$targetx = intval($_POST['user']);

	$host = "127.0.0.1";
	$user = "root";
	$pass = "qvaGN6vy9EaZMw5l";
	$db = "test";

	$con = new mysqli($host, $user, $pass, $db);
	$con->set_charset("utf8");		
	ini_set("default_charset", 'utf-8');	

	$sql = "SELECT * FROM userlog WHERE cldbid='$targetx'";
	$run = $con->query($sql);
	if($run->num_rows > 0){
		try {
			$clinfo = $ts3->clientInfoDb($targetx);
			$clname = strval($clinfo["client_nickname"]);
			$cldesc = strval($clinfo["client_description"]);
		}catch(Exception $e){
			// echo "<b dir='ltr'>$e</b>";
			$clname = "لم يتم العثور على الاسم";
			$cldesc = "- - -";
		}
		$iparray = array();
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
                                                <th>البلد</th>
                                                <th>وقت الدخول</th>
                                                <th>عدد مرات الدخول</th>
                                            </tr>
                                        </thead>
							<tbody>
									";
									while($data = $run->fetch_assoc()){
										$ip = strval($data["ip"]);
										if(!in_array($ip, $iparray)){
											array_push($iparray, $ip);
										}
										$lastjoin = date("Y/m/d g:i A",intval($data["lastjoin"]));
										$country = strval($data["country"]);
										if(!isset($country) || empty($country)){
											// $country = strval(geoip_country_name_by_name($ip)); 
											$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
											if($query && $query['status'] == 'success') {
											  $country = $query['country'];
											} else {
											  $country = strval(geoip_country_name_by_name($ip));
											}
										}
										$num = intval($data["num"]);
										echo "<tr> <td>$clname</td> <td>$cldesc</td> <td>$targetx</td> <td>$country</td> <td dir='ltr'>$lastjoin</td> <td>$num</td></tr>";
									}
									echo "
									<tbody>
                            </table>
                        </div>
                    </div>
					<hr>
				</div>		
			</div>";							
	echo"
		<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'>الأعضاء الى اتصلو بنفس الايبى</h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table warning-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>الدسكربشن</th>
                                                <th>رقم العضو</th>
                                                <th>البلد</th>
                                                <th>وقت الدخول</th>
                                                <th>عدد مرات الدخول</th>
                                            </tr>
                                        </thead>
							<tbody>"; 
							foreach($iparray as $ipx){
								$sql = "SELECT * FROM userlog WHERE cldbid <> '$targetx' AND ip='$ipx'";
								$res = $con->query($sql);
								if($res->num_rows > 0){
									while($data = $res->fetch_assoc()){
										$cldbid = strval($data["cldbid"]);

										try {
											$clinfo = $ts3->clientInfoDb($cldbid);
											$clname = strval($clinfo["client_nickname"]);
											$cldesc = strval($clinfo["client_description"]);
										}catch(Exception $e){
											$clname = "لم يتم العثور على الاسم";
											$cldesc = "- - -";
										}
										$lastjoin = date("Y/m/d g:i A",intval($data["lastjoin"]));
										$country = strval($data["country"]);
										if(!isset($country) || empty($country)){
											// $country = strval(geoip_country_name_by_name($ip)); 
											$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
											if($query && $query['status'] == 'success') {
											  $country = $query['country'];
											} else {
											  $country = strval(geoip_country_name_by_name($ip));
											}
										}
										$num = intval($data["num"]);
										echo "<tr> <td>$clname</td> <td>$cldesc</td> <td>$cldbid</td> <td>$country</td> <td dir='ltr'>$lastjoin</td> <td>$num</td></tr>";
									}
								}
							}

	echo "</tbody></table></div></div><hr></div> </div>";
									
									
	
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