<?php
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
require 'config/sqlconfig.php'; 
?>
<?php
$cldbid = $client_info["client_database_id"];
$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["coins"];
if(!empty($res)){
	$coins = $res;
}else{
	$coins = 0;
}
if(!in_array($CoinsAdmin,$_SESSION['ggids'])){
	$resp = false;
}else{
	$resp = true;
}
?>
        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
			<br>
			<br>
			<br>
			
<?php 
$xx = explode(',', $client_info["client_servergroups"]);
$sql = "SELECT * FROM codes WHERE cldbid='$cldbid'";
$result = $con->query($sql);
if(isset($_POST["submit"]) && isset($_POST["code"])){
// منععععع الاسبام
if(isset($_SESSION['code']) and $_SESSION['code'] >= microtime(true)){
die('<script>
           swal({title: "عذراً!",text: " لقد قمت بذالك العمليه قبل , الرجاء المحاولة بعد 5 ثواني",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');	
}else{
	$_SESSION['code'] = microtime(true)+5;
}

// منععععع الاسبام	
	$code = $_POST["code"];
	$code = $con->real_escape_string($code);
	$code = stripslashes($code);
	$code = strip_tags($code);
	$codex = htmlentities($code);
	
	$sql = "SELECT id, code, sgid, user FROM act WHERE code='$codex'";
	$res = $con->query($sql);
	$num = $res->num_rows;
	$activated = false;
	
	$sql = "SELECT * FROM coins WHERE code='$codex'";
	$res2 = $con->query($sql);
	$act = false;
	

/*
				$sql2 = "SELECT * FROM act WHERE user='$cldbid' LIMIT 1";
	                                $res2 = $con->query($sql2);
	$num2 = $res2->num_rows;
	if($num2 > 0){

die('<script>
           swal({title: "عذراً!",text: " لا يمكنك تفعيل اكثر من كود ",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');	



}*/

	if($num > 0){
		while($data = $res->fetch_assoc()){
			$nnow = $data["now"];
			$eetime = $data["etime"];
			$cod = $data["code"];
			$sgid = $data["sgid"];
			$id = $data["id"];
			$user = $data["user"];
			$checkCml = $data["cml"];
			if($cod == $codex){
				if($user != 0){
die('<script>
           swal({title: "عذراً!",text: " هذا الكود مستخدم من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');	
		   
				}else if(in_array($sgid, $xx)){
die('<script>
           swal({title: "عذراً!",text: " لا يمكنك استخدام هذا الكود انت بالفعل لديك الرتبة من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');					

				}
				$ts3_VirtualServer->serverGroupClientAdd($sgid, $cldbid);
				$sql = "UPDATE act SET user='$cldbid' WHERE id='$id'";
				$con->query($sql);
				$activated = true;
				if ( $checkCml == 1 ) {

				}

				$rrz = $ts3_VirtualServer->serverGroupGetById($sgid);
				$sql = "SELECT etime FROM act WHERE code='$codex' LIMIT 1";
				$eztime = $con->query($sql)->fetch_assoc()["etime"];			
				$ztimez = DateTime::createFromFormat('Y:m:j:H:i:s', $eztime); 
				$datetime1 = new DateTime();
				$interval = $datetime1->diff($ztimez);
				$elapsed = $interval->format('%a أيام %h ساعات %i دقائق %s ثوانى');
				//• [b][COLOR=#00aa00]تم تفعيل الرتبة [Rank][/COLOR][/b]
				//• [B][COLOR=#005100]مدة صلاحية الرتبة : [Time][/COLOR][/B]
				$client_info->message("[b][COLOR=#00aa00]تم تفعيل الرتبة [$rrz][/COLOR][/b]");
				$client_info->message("[B][COLOR=#005100]مدة صلاحية الرتبة : [$elapsed][/COLOR][/B]");
				break;
			}
		}
	}else if($res2->num_rows > 0){
		while($dataz = $res2->fetch_assoc()){
			
			$cod = $dataz["code"];			
			$coins = $dataz["coins"];
			$status = $dataz["status"];
			$idz = $dataz["id"];
			$con->query($sql);
			$user = $dataz["user"];	
				if($status == "inactive" && $user != 0){
die('<script>
           swal({title: "عذراً!",text: " هذا الكود مستخدم من قبل",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');	
				}			
			$sql = "UPDATE user SET coins=coins +'$coins' WHERE cldbid='$cldbid'";
			$con->query($sql);
			$act = true;
			
			$sqlz = "UPDATE `coins` SET user='$cldbid' , status='inactive' WHERE id='$idz'";
			if($test = $con->query($sqlz) === false){
				printf("Error: %s\n", $con->error);
				die();
			}
			$actz = true;
			$sqlzx = $con->query("SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1")->fetch_assoc()["coins"];


			$client_info->message("[b][COLOR=#00aa00]تم تفعيل كود كوينز : [$coins][/COLOR][/b]");
			$client_info->message("[B][COLOR=#005100]عدد الكوينز المتوفر لديك : [$sqlzx][/COLOR][/B]");
			break;
			
		}

	}
	
	if($activated === false && $act === false){
die('<script>
           swal({title: "عذراً!",text: "كود خاطئ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');	
	}else if($act === true || $activated === true){

	echo('<script>
           swal({title: "حركات",text: "تم تفعيل الكود بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
	
	}else{
die('<script>
           swal({title: "عذراً!",text: "كود خاطئ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/activecode");}else {window.location.replace("https://panel.q-z.us/activecode");}})</script>');	
	}
	
			
}
?>
<div class="row">

<!-- small card -->
<div class="col-md-4">
	</div>
<!-- center card -->
			<div class="col-md-4">
			                            <form method="post">

                        <div class="card border-info">
                            <div class="card-header bg-success ">
                               <center> <h4 class="m-b-0 text-white">تفعيل الأكواد</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-warning">يتم تفعيل كل من الكوينز والاكواد العاديه</span></center>
										</p>
										<center><label class="col-sm-8" for="block-form-username4">ضع الكود هنا</label></center>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="code" name="code" class="form-control" placeholder="XXX-XXX-XXX-XXXX" aria-label="" aria-describedby="basic-addon1">
													
                                                    <div class="input-group-append">
                                            <input type="submit" name="submit"  value="تفعيل" id="buttonClass" class="btn btn-success ">
                                                

                                        </div>													
												
                                                </div>
                                        </div>
                            </form>

							</div>
						</div>
			</div>
<!-- small card -->
				<div class="col-md-4">
					</div>


				</div>
			</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>