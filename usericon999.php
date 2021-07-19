<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
    <div class="page-wrapper">
        <div class="container-fluid">
<?php
##حذف الايقونه
if(isset($_POST['iR'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permRemove("i_icon_id");
}
}
//////////////////////////////////////////////////

// ألحالات //
if(isset($_POST['i1'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2499546878);
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
} 
}

if(isset($_POST['i2'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 1731868119);
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['i3'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 1660229352);
}
}

if(isset($_POST['i4'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 1802985974);
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['i5'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2464222446);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['i6'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 234663222);	
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
	
}
}

if(isset($_POST['i7'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 598058610);	
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
}

if(isset($_POST['i8'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 1365726410);	
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
}

if(isset($_POST['i9'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 3220734816);
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
}

if(isset($_POST['i10'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2464222446);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['i11'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2464222446);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

///////// الدول ///////

if(isset($_POST['d'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 1914224293);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['d1'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 3161553942);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['d2'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 338597784);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['d3'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2195966656);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['d4'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 1224382450);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

if(isset($_POST['d5'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2018686427);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}

/// الاشكال ///

if(isset($_POST['styl'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 297104604);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}
if(isset($_POST['styl1'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 990896452);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}
if(isset($_POST['styl2'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 845998103);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}
if(isset($_POST['styl3'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2720290078);
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
}
if(isset($_POST['styl4'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 796712545);
	echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
}
if(isset($_POST['styl5'])) {
$get = $ts3_VirtualServer->clientGetByUid($uid);
if(($get = $ts3_VirtualServer->clientGetByUid($uid))){
    $get->permAssign("i_icon_id", 2058641289);	
		echo('<script>
           swal({title: "تمت",text: "العملية بننجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
}


?>			
			<br>
		<center><h4 class="content-heading">♥♥ • الحاله • ♥♥</h4></center><hr>	
			<div class="col-md-12 button-group">
                        <div class="card text-right">
<br>
                            <div class="card-body">
								<div class="card">
									<div class="box bg-dark text-center">
	<form method="post">
                             <input type="hidden" name="i2" >									
									<button type="submit"  name="submit" class="btn btn-success  btn-circle btn-lg"> <img src="image/713.png"> </button>

                             <input type="hidden" name="i3" >
									<button type="submit"  name="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/715.png"> </button>
                             <input type="hidden" name="i4" >
									<button type="submit"  name="submit" class="btn btn-primary btn-circle btn-lg"> <img src="image/716.png"> </button>
                             <input type="hidden" name="i6" >
									<button type="submit"  name="submit" class="btn btn-info btn-circle btn-lg"> <img src="image/722.png"> </button>
                             <input type="hidden" name="i7" >
									<button type="submit"  name="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/725.png"></i> </button>
                             <input type="hidden" name="i8" >
									<button type="submit"  name="submit" class="btn btn-success btn-circle btn-lg"> <img src="image/732.png"> </button>
									</br>
									</br>
									</form>
									<form method="post">
									<button type="submit" name="iR" class="btn btn-danger delete btn-lg" title="إزالة الحالة"> - <img src="https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png"><i class="glyphicon glyphicon-remove"></i></button></form>
									</div>
								</div>
                            </div>
                        </div>
            </div>		
			<center><h4 class="content-heading">♥♥ • الدول • ♥♥</h4></center><hr>	
			<div class="col-md-12 button-group">
                        <div class="card text-right">
<br>
                            <div class="card-body">
								<div class="card">
									<div class="box bg-dark text-center">
	<form method="post">
                             <input type="hidden" name="d">	
									<button type="submit" class="btn btn-success  btn-circle btn-lg"> <img src="image/ms.png"> </submit>
                             <input type="hidden" name="d1">	
									<button type="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/KSA.png"> </button>
                             <input type="hidden" name="d2">	
									<button type="submit" class="btn btn-primary btn-circle btn-lg"> <img src="image/b7.png"> </button>
                             <input type="hidden" name="d3">	
									<button type="submit" class="btn btn-info btn-circle btn-lg"> <img src="image/sr.png"> </button>
                             <input type="hidden" name="d4">	
									<button type="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/qa.png"></i> </button>
                             <input type="hidden" name="d5">	
									<button type="submit" class="btn btn-warning btn-circle btn-lg"> <img src="image/ard.png"> </button>
									</br>
									</br>
									</form>
									<form method="post">
									<button type="submit" name="iR" class="btn btn-danger delete btn-lg" title="إزالة الحالة"> - <img src="https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png"><i class="glyphicon glyphicon-remove"></i></button></form>
									</div>
								</div>
                            </div>
                        </div>
            </div>
			<center><h4 class="content-heading">♥♥ • الأشكال • ♥♥</h4></center><hr>	
			<div class="col-md-12 button-group">
                        <div class="card text-right">
<br>
                            <div class="card-body">
								<div class="card">
									<div class="box bg-dark text-center">
	<form method="post">									
                             <input type="hidden" name="styl">
									<button type="submit" class="btn btn-success  btn-circle btn-lg"> <img src="image/907.png"> </button>
                             <input type="hidden" name="styl">
									<button type="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/L.png"> </button>
                             <input type="hidden" name="styl">
									<button type="submit" class="btn btn-primary btn-circle btn-lg"> <img src="image/S.png"> </button>
                             <input type="hidden" name="styl">
									<button type="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/W.png"> </button>
                             <input type="hidden" name="styl">
									<button type="submit" class="btn btn-danger btn-circle btn-lg"> <img src="image/A.png"> </button>
                             <input type="hidden" name="styl">
									<button type="submit" class="btn btn-success btn-circle btn-lg"> <img src="image/X.png"> </button>
									</br>
									</br>
									</form>									
									<form method="post">
									<button type="submit" name="iR" class="btn btn-danger delete btn-lg" title="إزالة الحالة"> - <img src="https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png"><i class="glyphicon glyphicon-remove"></i></button></form>
									</div>
								</div>
                            </div>
                        </div>
            </div>
		
		
		
			
			
		</div>
    </div>
		
<?php require_once('includes/footer.php'); ?>