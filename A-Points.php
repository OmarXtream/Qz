<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// require_once("TeamSpeak3/TeamSpeak3.php");
// TeamSpeak3::init();

// هنا تتأكد انة ادارة علشان ما يخترق الصفحة

if(isset($_POST["clan"])){ // تصفير نقاط الكلانات
	$host = "localhost";
	$user = "root";
	$pass = "qvaGN6vy9EaZMw5l";
	$db = "Rankqz";
	$con = new mysqli($host, $user, $pass, $db);
	if($con->connect_error){
		die("Failed To Connect To Database!");
	}
	
	$sql = "UPDATE clans SET points='0';";
	$con->query($sql);
	
	$con->close();

echo('<script>
           swal({title: "تم",text: "تصفير نقاط الكلانات بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}else if(isset($_POST["rooms"])){ // تصفير نقاط الرومات
	$host = "localhost";
	$user = "root";
	$pass = "qvaGN6vy9EaZMw5l";
	$db = "Rankqz";
	$con = new mysqli($host, $user, $pass, $db);
	if($con->connect_error){
		die("Failed To Connect To Database!");
	}
	
	$sql = "UPDATE roomz SET points='0';";
	$con->query($sql);
	
	$con->close();
echo('<script>
           swal({title: "تم",text: "تصفير نقاط الرومات بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
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
				  			  <?php manager($ggids) ?>	
							  <br><br><br>
<center><h1 class="page-header">تصفير النقاط </h1></center>
<hr>							  
<br><br><br><br><br><br><br><br><br>
<center>

<div class="col-md-2">
	<form method="post">
<button class="btn btn-block btn-outline-danger" type="submit" name="clan"  >تصفير نقاط الكلانات</button>
<hr>
<button class="btn btn-block btn-outline-success" type="submit" name="rooms" >تصفير نقاط الرومات</button>
	</form>
</div>

	<br/><br/>
<!--	<form method="post">
		<button type="submit" name="clan">تصفير الكلانات</button><br/><br/>
		<button type="submit" name="rooms">تصفير الرومات</button>
	</form> -->
</center>


			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>