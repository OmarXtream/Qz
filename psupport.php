<?php 
require 'config/phphead.php';
require_once('includes/header2.php');
$canview = array(10,2171,1555,1048,1672,1983,1984,1985,1986,1987,1988,1989);
if(count(array_intersect($ggids, $canview)) == 0){
	die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
}

require_once('includes/topbar.php');
require_once('includes/sidebar.php');

if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
	session_destroy();
	die('<script>
   swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}

if(isset($_POST["actx"]) && !in_array(1989, $ggids)){
	try {
		$client_info->addServerGroup(2475);
	}catch(Exception $e){
		
	}
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=psupport.php">  ';
	die; 
}else if(isset($_POST["actr"]) && !in_array(1989, $ggids)){
	try {
		$client_info->remServerGroup(2475);
	}catch(Exception $e){
		
	}
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=psupport.php">  ';
	die; 
}else if(isset($_POST["hx"])){
	try {
		$client_info->addServerGroup(2474);
	}catch(Exception $e){
		
	}
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=psupport.php">  ';
	die; 
}else if(isset($_POST["hr"])){
	try {
		$client_info->remServerGroup(2474);
	}catch(Exception $e){
		
	}
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=psupport.php">  ';
	die; 
}
?>
<html>
<head>
<meta charset="utf-8">
<title>Support Notification</title>
</head>
<body>
<div class="page-wrapper">
        <div class="container-fluid">
		<br/><br/><br/><br/><br/><br/><br/>
		<center>
			<form method="post">
				<?php
					if(in_array(1989, $ggids)){
						echo '<button type="button" class="btn btn-lg btn-success disabled" disabled>التفعيل</button>';
					}else if(in_array(2475,$ggids)){
						echo '<button type="submit" name="actr" class="btn btn-lg btn-warning">التفعيل</button>';
					}else{
						echo '<button type="submit" name="actx" class="btn btn-lg btn-success">التفعيل</button>';
					}
					echo "&nbsp;&nbsp;&nbsp;";
					if(in_array(2474,$ggids)){
						echo '<button type="submit" name="hr" class="btn btn-lg btn-warning">المساعدة</button>';
					}else{
						echo '<button type="submit" name="hx" class="btn btn-lg btn-success">المساعدة</button>';
					}
				?>
				
			</form>
		</center>
	</div>
</div>
</body>
</html>
<?php require_once('includes/footer.php'); ?>