<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
require 'config/sqlconfig.php';
$cldbid = $client_info["client_database_id"];
$con = new mysqli($host, $user, $pass, $db);

$cldbid = $client_info["client_database_id"];
$con = new mysqli($host, $user, $pass, $db);

if(!count(array_intersect($ggids, $Code)))  {
	$resp = false;
}else{
	$resp = true;
}

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
Coniscode($cgrp);  ?>
<?php

$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";

if(isset($_POST["submit"]) && isset($_POST["coins"]) && $resp == true){
	$coins = strip_tags($con->real_escape_string($_POST["coins"]));
	$coins = stripslashes($coins);
	$coins = intval($coins);
	if($coins == 0 || $coins < 1 || $coins > 100){
die('<script>
           swal({title: "اوبس خطاء",text: "لا يمكن إنشاء كود قيمتة أقل من 1 او أكثر من 100",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-ReedemCoins");}else {window.location.replace("https://panel.q-z.us/A-ReedemCoins");}})</script>');		
	}
	$code = substr(mt_rand(0, 99999).md5(mt_rand(0, 9999) + mt_rand(0, 9999)).mt_rand(0, 99999), 0, mt_rand(15, 25));
	$st = "active";
	$sql = "INSERT INTO coins (id, owner, user, status, code, coins) VALUES (NULL, '$cldbid', '0', '$st', '$code', '$coins')";
	$con->query($sql);

	echo('<script>
           swal({title: "تم انشاء الكود بنجاح",text: "[  '.$code.'  ]",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
	
}

?>		
		<center>
							<?php
		if($resp == true){
			echo '		
			<div class="col-md-7">
			                            <form method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>انشاء الاكواد</b></h4>
					</div>
                    <div class="card-body">
					
					<h5>يمكنك انشاء كود بعدد خاص من الكوينز ويتم العضو بتفعيله لشراء المزيد من الرتب</h5>
					<h5>يمنع أنشاء أكواد لمصالح شخصيه / كل الأكواد مراقبه من قبل الأداره العليا</h5>
					<hr>
					<label><h2><b>ادخل عدد الكوينز</b></h2></label>
					<br>
					<br>
					
					<input class="form-control" style="width: 50%; height:40px type=" text"="" name="coins" placeholder="عدد الكوينز....">		  
					
					<br>
					<br>
					
						
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="submit" class="btn btn-rounded btn-block btn-outline-danger"> أنشاء الكود </button>
                    </div></center>
					<br>
					
					
                </div>
            </div>
		</form>

			';
		}
	?>	
		</center>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> السجل </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الكود</th>
                                                <th>المنشئ</th>
                                                <th>الكوينز</th>
                                                <th>المستخدم</th>
                                                <th>حالة الكود</th>
                                            </tr>
                                        </thead>
                        <tbody>
						<?php
                            if(isset($_GET["page"]) && $_GET["page"] > 1){
								$numf = $_GET["page"] ;
								$max = 100;
								$mnext = $numf * $max;
								$sql = "SELECT * FROM coins ORDER BY id DESC LIMIT $max OFFSET $mnext";
							//	$sql = "SELECT * FROM coins WHERE status = 'inactive'";
							}else{
								$sql = "SELECT * FROM coins ORDER BY id DESC LIMIT 50";
							//	$sql = "SELECT * FROM coins WHERE status='inactive'";
							}							
							$res = $con->query($sql);
							while($data = $res->fetch_assoc()){
								$owner = $data["owner"];
								$user = $data["user"];
								$code = $data["code"];
								$status = $data["status"];
								$coins = $data["coins"];
								$own = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
								if($user != 0){
									$use = $ts3_VirtualServer->clientInfoDb($user)["client_nickname"];
								}else {
									$use = "غير مستعمل";
								}
								if($status == "active" && $user == 0){
									$remain = "غير مستعمل";
								}else if($status == "inactive"){
									$remain = "منتهى";
								}else if($status == "active" && $user != 0){
								}
								
								echo "<tr> <td>$code</td> <td>$own</td> <td>$coins</td>  <td>$use</td> <td>$remain</td> </tr>";
							}
						?>
                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>65900fa99ccdbea597263</td>
                                                <td>! 亗Qz,1</td>
                                                <td>20</td>
                                                <td>آلمؤحترمم عٌبُڊآلُرحمْنْ	</td>
                                                <td>منتهى</td>
                                            </tr>
                                        </tbody>
                                    </table>
                <?php 
						echo '
										<ul class="pagination">
				<li class="paginate_button page-item '; if($_GET["page"] == 1 || !isset($_GET["page"])){ echo "active"; } echo '"><a href="?page=1" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 2){ echo "active"; } echo '"><a href="?page=2" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 3){ echo "active"; } echo '"><a href="?page=3" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 4){ echo "active"; } echo '"><a href="?page=4" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 5){ echo "active"; } echo '"><a href="?page=5" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 6){ echo "active"; } echo '"><a href="?page=6" aria-controls="DataTables_Table_0" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 7){ echo "active"; } echo '"><a href="?page=7" aria-controls="DataTables_Table_0" data-dt-idx="7" tabindex="0" class="page-link">7</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 8){ echo "active"; } echo '"><a href="?page=8" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">8</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 9){ echo "active"; } echo '"><a href="?page=9" aria-controls="DataTables_Table_0" data-dt-idx="9" tabindex="0" class="page-link">9</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 10){ echo "active"; } echo '"><a href="?page=10" aria-controls="DataTables_Table_0" data-dt-idx="10" tabindex="0" class="page-link">10</a></li>
				</ul>
						';				
				?>								
                    
                                </div>
                        </div>
					 </div>
                    </div>
		
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>