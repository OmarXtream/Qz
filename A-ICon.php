<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
 require 'config/phphead.php';
 ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
  require 'config/sqlconfig.php';
 
 if(isset($_POST["submit"]) && isset($_POST["chicon"]) && is_numeric($_POST["chicon"]) && !empty($_POST["chicon"])){
	 
	 $chicon = $_POST["chicon"];
	 
	 if(isset($_POST["chgroup"]) && is_numeric($_POST["chgroup"]) && !empty($_POST["chgroup"])){
		 
		 $chgroup = intval($_POST["chgroup"]);
		 $zzx = $ts3->serverGroupGetById($chgroup);
		 $zzx->permAssignByName("i_icon_id", $chicon, false, true);
	 } 
	 
	 
	 if(isset($_POST["chroom"]) && is_numeric($_POST["chroom"]) && !empty($_POST["chroom"])){
		 
		 $chroom = intval($_POST["chroom"]);
		 $chz = $ts3->channelGetById($chroom);
		 $chz->permAssignByName("i_icon_id", $chicon);
		 
	 }
	 
	 
	 
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
							  			  <?php icon($ggids) ?>
		
		<center>
			<div class="col-md-7">
<form method="post">			
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>تغير الايقونات</b></h4>
					</div>
                    <div class="card-body">
						<label><h4><b>يمكنك تغير أيقونات الرتب أو الرومات بس بضغطه زر</h4></b></label>
					<br>
					<hr>
					<h3><br><input class="form-control" style="width: 50%; height:40px;" type="text" name="chicon" placeholder="451126499 رقم الايقونه مثل "></h3>
					<br>
					<h3><input class="form-control" style="width: 50%; height:40px;" type="text" name="chgroup" placeholder="رقم الرتبه "></h3>
					<br>
					<h3><input class="form-control" style="width: 50%; height:40px;" type="text" name="chroom" placeholder="رقم الروم "></h3>
					<br>
					
                    </div>
					<center><div class="col-md-8">
                      <button name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-success">أضغط هنا لتغير أيقونه الروم او الرتبه او الأثنين معاً</button>
                    </div></center>
					<br></form>

					
					
                </div>
            </div>
		</center>
		
		
			
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>