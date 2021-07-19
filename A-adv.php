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
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
<?php
// الهيدر
if(isset($_POST["submit"]) && isset($_POST["topic"])){
	$con->set_charset("utf-8");
	$topic = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["topic"])));
	if(strlen($topic) < 50){
die('<script>
           swal({title: "هذا",text: "الاعلان قصير جدأ ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-adv");}else {window.location.replace("https://panel.q-z.us/A-A-adv");}})</script>');		
	}
	$sql = "SELECT * FROM adv LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE adv SET topic='$topic', maker='$dbid' WHERE id='$id'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO adv (id, topic, maker) VALUES (NULL, '$topic', '$dbid')";
		$con->query($sqlz);
	}

echo('<script>
           swal({title: "تم",text: "الاعلان بنجاح ",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
}else if(isset($_POST["rmadv"])){
	$sql = "SELECT * FROM adv LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "DELETE FROM adv WHERE id='$id'";
		$con->query($sqlz);
echo('<script>
           swal({title: "تم",text: "حذف الاعلان بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-adv");}else {window.location.replace("https://panel.q-z.us/A-A-adv");}})</script>');			
	
	}else 
echo('<script>
           swal({title: "لأ يوجد",text: "اعلانات ليتم حذفها",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
}

// اعلانات الصفحه الرائسية

if(isset($_POST["submithome"]) && isset($_POST["news"]) && isset($_POST["img"])){
	$con->set_charset("utf-8");
	$news = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["news"])));
	$img = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["img"])));
	if(strlen($news) < 50){
die('<script>
           swal({title: "هذا",text: "الاعلان قصير جدأ ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-adv");}else {window.location.replace("https://panel.q-z.us/A-A-adv");}})</script>');
	}
	$sql = "SELECT * FROM home LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE home SET news='$news', maker='$dbid', img='$img' WHERE id='$id'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO home (id, news, maker, img) VALUES (NULL, '$news', '$dbid', '$img')";
		$con->query($sqlz);
	}
echo('<script>
           swal({title: "تم",text: "الاعلان بنجاح ",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}else if(isset($_POST["rmhome"])){
	$sql = "SELECT * FROM home LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "DELETE FROM home WHERE id='$id'";
		$con->query($sqlz);
echo('<script>
           swal({title: "تم",text: "حذف الاعلان بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-adv");}else {window.location.replace("https://panel.q-z.us/A-A-adv");}})</script>');	
	}else 
echo('<script>
           swal({title: "لأ يوجد",text: "اعلانات ليتم حذفها",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	

	echo "Error message = ".mysql_error();
	   
}


//اعلانات بالبطولة

if(isset($_POST["submitclange"]) && isset($_POST["newss"]) && isset($_POST["imgg"])){
	$con->set_charset("utf-8");
	$newss = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["newss"])));
	$imgg = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["imgg"])));
	// if(strlen($news) < 5){
// die('<script>
           // swal({title: "هذا",text: "الاعلان قصير جدأ ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-adv");}else {window.location.replace("https://panel.q-z.us/A-A-adv");}})</script>');
	// }
	$sql = "SELECT * FROM change1 LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE change1 SET news='$newss', maker='$dbid' WHERE id='$id', img='$imgg'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO change1 (id, news, maker, img) VALUES (NULL, '$newss', '$dbid', '$imgg')";
		$con->query($sqlz);
	}
echo('<script>
           swal({title: "تم",text: "الاعلان بنجاح ",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}else if(isset($_POST["rmclange"])){
	$sql = "SELECT * FROM change1 LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "DELETE FROM change1 WHERE id='$id'";
		$con->query($sqlz);
echo('<script>
           swal({title: "تم",text: "حذف الاعلان بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-adv");}else {window.location.replace("https://panel.q-z.us/A-A-adv");}})</script>');	
	}else 
echo('<script>
           swal({title: "لأ يوجد",text: "اعلانات ليتم حذفها",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
?>
<?php 
$cgrp = explode(',', $client_info["client_servergroups"]);
adv($cgrp);  ?>				
		<center>
			<div class="col-md-7">
			<form class="form-horizontal" method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>القيام باعلان</b></h4>
					</div>
                    <div class="card-body">
					<label class="col-md-4 control-label" for="example-select2">ضع الأعلان هنا</label>
					<br>
					<div class="col-xs-12">
						<input type="hidden" readonly="readonly" name="action" value="ann">
						<input type="hidden" name="Token"> <textarea class="form-control" name="topic" style="direction:rtl;" placeholder="<?php echo $text ?>"></textarea><br>
					</div>			  
					
					
					
						
                    </div>
					<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
                      <button name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-info">أعلن الأن</button>
                    </div>
					<div class="col-md-4">
                      <button name="rmadv" type="submit" class="btn btn-rounded btn-block btn-outline-danger">حذف الأعلان</button>
                    </div>
                    </div>
					<br>
					
					
                </div>
            </div>
			                            </form>
		</center>
		<br>
		<br>
		<center>
		
		
			<div class="col-md-7">
<form class="form-horizontal" method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>اعلانات الصفحه الرائسية
</b></h4>
					</div>
                    <div class="card-body">
					<label class="col-md-4 control-label" for="example-select2">شريط الأخبار</label>
					<br>
					<div class="col-xs-12">
						<input type="hidden" readonly="readonly" name="action" value="ann">
						<input type="hidden" name="Token"> <textarea class="form-control" name="news" style="direction:rtl;" placeholder="رابط الصوره .."></textarea><br>
					</div>
					<label class="col-md-4 control-label" for="example-select2">رابط الصوره</label>
					<br>
					<div class="col-xs-12">
						<input type="hidden" readonly="readonly" name="action" value="ann">
						<input type="hidden" name="Token"> <textarea class="form-control" name="img" style="direction:rtl;" placeholder="رابط الصوره .."></textarea><br>
					</div>			  
					
					
					
						
                    </div>
					<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
                      <button name="submithome" type="submit" class="btn btn-rounded btn-block btn-outline-info">أعلن الأن</button>
                    </div>
					<div class="col-md-4">
                      <button name="rmhome" type="submit" class="btn btn-rounded btn-block btn-outline-danger">حذف الأعلان</button>
                    </div>
                    </div>
					<br>
					                            </form>			
					
                </div>
            </div>
		</center>
			
	
		<br>
		<br>
		<center>
		
		
			<div class="col-md-7">
<form class="form-horizontal" method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>اعلانات بالبطولة
</b></h4>
					</div>
                    <div class="card-body">
					<label class="col-md-4 control-label" for="example-select2">رابط الصورة 1</label>
					<br>
					<div class="col-xs-12">
						<input type="hidden" readonly="readonly" name="action" value="ann">
						<input type="hidden" name="Token"> <textarea class="form-control" name="newss" style="direction:rtl;" placeholder="ضع ما تريد كتابته في شريط الاخبار هنا"></textarea><br>
					</div>
					<label class="col-md-4 control-label" for="example-select2">رابط الصورة 2</label>
					<br>
					<div class="col-xs-12">
						<input type="hidden" readonly="readonly" name="action" value="ann">
						<input type="hidden" name="Token"> <textarea class="form-control" name="imgg" style="direction:rtl;" placeholder="رابط الصوره .."></textarea><br>
					</div>			  
					
					
					
						
                    </div>
					<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
                      <button name="submitclange" type="submit" class="btn btn-rounded btn-block btn-outline-info">أعلن الأن</button>
                    </div>
					<div class="col-md-4">
                      <button name="rmclange" type="submit" class="btn btn-rounded btn-block btn-outline-danger">حذف الأعلان</button>
                    </div>
                    </div>
					<br>
					                            </form>			
					
                </div>
            </div>
		</center>
			
	
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>