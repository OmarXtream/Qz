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
<?php 
ini_set("default_charset", 'utf-8');
if(isset($_POST["stext"]) && isset($_POST["search"])){
	$search = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["stext"])));
	$con->set_charset("utf8");
	$sql = "SELECT * FROM user WHERE name LIKE '%$search%' OR uuid LIKE '%$search%' LIMIT 10";
	$res = $con->query($sql);
		echo('<script>
           swal({title: "تم",text: "العثور علي العضو",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');

}else if(isset($_POST["cup"]) && isset($_POST["ncup"])){
	if(is_array($_POST["cup"])){
		$ncd = intval(key($_POST["cup"]));
		$ncc = intval($_POST["ncup"]);
		if(is_numeric($ncd) && is_numeric($ncc)){
			$sql = "SELECT coins FROM user WHERE cldbid='$ncd' LIMIT 1";
			$coins = ($con->query($sql)->fetch_assoc()["coins"]);
			$sql = "UPDATE user SET coins='$ncc' WHERE cldbid='$ncd'";
			$con->query($sql);
			$now = time();
			$sql = "INSERT INTO addcoins (id, owner, user, cbefore, cafter, datex) VALUES (NULL, '$client_db', '$ncd', '$coins', '$ncc', '$now')";
			$con->query($sql);
			echo('<script>
             swal({title: "تم",text: "تعديل الكوينز بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
	}	
	
	
}
?>
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
			<?php 
$cgrp = explode(',', $client_info["client_servergroups"]);
ccoins($cgrp);  ?>	
		<center>
			<div class="col-md-12">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>البحث عن العضو</b></h4>
					</div>
                    <div class="card-body">
						<label><h3><b>يمكنك التحكم بالكوينز لجميع الاعضاء</h3></b></label>
						<label><h3><b>*برجاء التاكد من عدم الاستخدام في المصالح الشخصيه جميع اللوحه مراقبه</h3></b></label>
					<br>
					<hr>
					<br>
	<form method="post">					
					<input class="form-control" placeholder="اكتب اسم العضو او الادينتى" type="text" name="stext"  id="00"><br>
					<br>
					
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="search" class="btn btn-rounded btn-block btn-outline-success"> أبحث الأن </button>
                    </div></center>
					<br>
					<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>اجمالي عدد الكوينز</th>
                                                <th>تعديل الكوينز</th>
                                                <th>تحديث</th>
                                            </tr>
                                        </thead>
                        <tbody>
						<?php
							if($res->num_rows > 0){
								while($data = $res->fetch_assoc()){
									$name = $data["name"];
									$coinz = $data["coins"];
									$cldbid = $data["cldbid"];
									echo "<tr> 
									<td><div class='tag tag-pill tag-border border-success success'>$name</div></td>
									<td><div class='tag tag-glow tag-pill tag-primary'>$coinz</div></td> 
									<td><input type='text' class='form-control primary' id='textColor' name='ncup' value='$coinz' placeholder='ادخل قيمه الكوينز' style='width: 50%;'></td> 
									<td><button class='btn btn-rounded btn-block btn-outline-info' name='cup[$cldbid]' data-style='expand-up'><span class='ladda-label'>تحديث</span><span class='ladda-spinner'></span></button></td> </tr>";
								}
							}
						?>


                        </tbody>										
                                    </table>
                                </div>
                        </div>
					 </div>
        </div>
					
                </div>
            </div>
			
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title">سجل اضافة الكوينز للاعضاء </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الادمن المحول</th>
                                                <th>العضو المحول الية</th>
                                                <th>الكوينز قبل التحويل</th>
                                                <th>الكوينز بعد التحويل</th>
                                                <th>التاريخ</th>
                                            </tr>
                                        </thead>
                        <tbody>
						<?php
						
							$sql = "SELECT * FROM addcoins ORDER BY id DESC";
							$res = $con->query($sql);
							while($data = $res->fetch_assoc()){
								$owner = $data["owner"];
								$user = $data["user"];
								try {
									$ownernick = $ts3->clientInfoDb($owner)["client_nickname"];
								}catch(Exception $e){
									$ownernick = "<b>لم يتم العثور علية</b>";
								}
								try {
									$usernick = $ts3->clientInfoDb($user)["client_nickname"];
								}catch(Exception $e){
									$usernick = "<b>لم يتم العثور علية</b>";
								}
								
								$cbefore = $data["cbefore"];
								$cafter = $data["cafter"];
								$datax = date("Y/m/d",intval($data["datex"]));
								
								echo "<tr class=''> 
								<td>$ownernick</td> 
								<td>$usernick</td> 
								<td>$cbefore</td> 																
								<td>$cafter</td> 
								<td>$datax</td> </tr>
								";
							}
						?>
                        </tbody>
                                    </table>
							<center>
						<ul class="pagination">
							<?php
								// for($i = 1; $i <= $totalp; $i++){
									// if($page === $i){
										// echo "<li class='paginate_button page-item active'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									// }else{
										// echo "<li class='paginate_button page-item'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									// }
								// }
							?>
					  </ul>
					  		</center>									
                                </div>
                        </div>
					 </div>
                    </div>
			
			
		</center>
		</form>
		
		
			
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>