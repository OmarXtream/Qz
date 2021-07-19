<?php 
die();

require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
$xz = explode(',', $client_info["client_servergroups"]);
		if(!count(array_intersect($Profile_Edit, $xz)) > 0){
			}else 
				
			die ('<script>
           swal({
            title: "خطا",
            text: "انت محظور من دخول هذه الصفحة",
            type: "error",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/index.php");
            }else {
              window.location.replace("https://panel.q-z.us/index.php");
            }
          })
           </script>');	
 ?>		
        <div class="page-wrapper">
            <div class="container-fluid">
<?php 
    // ini_set('display_errors', 'On');
    // error_reporting(E_ALL);

    // include'Header.php';
// الوصف	
	if(isset($_POST["profile-topic"]) && isset($_POST["updatetopic"])){		
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
            $sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $SQLInfo = $smt->fetchAll();
            if ( !isset ( $SQLInfo[0]['DBID'] ) ){
				$topic = htmlspecialchars(stripslashes(strip_tags($_POST['updatetopic'])));
				if(strlen($topic) > 100){
die('<script>
           swal({title: "خطأ",text: "هذا الكلام كثير للغاية",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');
				}
                $MySq = "INSERT INTO $dbname.Profile_Settings (`DBID`, `topic`) 
                    VALUES ( :DBID, :topic)";
                $sth = $mysqlcon->prepare($MySq);
                $sth->bindValue(':DBID', $dbid);
                $sth->bindValue(':topic', $topic);
                $sth->execute();
            }else{
                $n_sql = $mysqlcon->prepare("UPDATE $dbname.Profile_Settings SET topic=:topic  WHERE DBID=:DBID");
                $n_sql->bindValue(':topic', $_POST['updatetopic']);
                $n_sql->bindValue(':DBID', $dbid);
                $n_sql->execute();
            } 		
                    echo "<script>swal(
            '',
            'تم تعديل الوصف بنجاح',
            'success'
        )</script>";
        
    }else if ( isset( $_POST['profile-age'] ) ){
        echo "<script>swal(
            '',
            'يجب وضع ارقام',
            'error'
        )</script>";
    }	

	
	
// العمر	
	if(isset($_POST["profile-age"]) && isset($_POST["updatesage"])){
		
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
            $sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $SQLInfo = $smt->fetchAll();
			
            if ( !isset ( $SQLInfo[0]['DBID'] ) ){
                $MySq = "INSERT INTO $dbname.Profile_Settings (`DBID`, `age`) 
                    VALUES ( :DBID, :age)";
                $sth = $mysqlcon->prepare($MySq);
                $sth->bindValue(':DBID', $dbid);
                $sth->bindValue(':age', $_POST['updatesage']);
                $sth->execute();
            }else{
                $n_sql = $mysqlcon->prepare("UPDATE $dbname.Profile_Settings SET age=:age  WHERE DBID=:DBID");
                $n_sql->bindValue(':age', $_POST['updatesage']);
                $n_sql->bindValue(':DBID', $dbid);
                $n_sql->execute();
            }            
                    echo "<script>swal(
            '',
            'تم تعديل عمرك!',
            'success'
        )</script>";
        
    }else if ( isset( $_POST['profile-age'] ) ){
        echo "<script>swal(
            '',
            'يجب وضع ارقام',
            'error'
        )</script>";
    }

// الجنسيه
	
	if(isset($_POST["profile-na"]) && isset($_POST["updatesna"])){
		
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
            $sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
			
            $SQLInfo = $smt->fetchAll();
            if ( !isset ( $SQLInfo[0]['DBID'] ) ){
                $MySq = "INSERT INTO $dbname.Profile_Settings (`DBID`, `na`) 
                    VALUES ( :DBID, :na)";
                $sth = $mysqlcon->prepare($MySq);
                $sth->bindValue(':DBID', $dbid);
                $sth->bindValue(':na', $_POST['updatesna']);
                $sth->execute();
            }else{
                $n_sql = $mysqlcon->prepare("UPDATE $dbname.Profile_Settings SET na=:na  WHERE DBID=:DBID");
                $n_sql->bindValue(':na', $_POST['updatesna']);
                $n_sql->bindValue(':DBID', $dbid);
                $n_sql->execute();
            }            
                    echo "<script>swal(
            '',
            'تم تعديل جنسيتك!',
            'success'
        )</script>";
        
    }else if ( isset( $_POST['profile-na'] ) ){
        echo "<script>swal(
            '',
            'يجب وضع ارقام',
            'error'
        )</script>";
    }
	

	// ألصوره
	
	if(isset($_POST["open"])){
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
            $sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $SQLInfo = $smt->fetchAll();
			 if(isset($SQLInfo[0]['DBID'])){
                  $n_sql = $mysqlcon->prepare("UPDATE $dbname.Profile_Settings SET accounts_privacy=:accounts_privacy WHERE DBID=:DBID");
                $n_sql->bindValue(':accounts_privacy', "true");
                $n_sql->bindValue(':DBID', $dbid);
                $n_sql->execute();
            }
		die ('<script>
           swal({
            title: "خطا",
            text: "تم فتح البروفايل بنجاح",
            type: "success",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/editprofile.php");
            }else {
              window.location.replace("https://panel.q-z.us/editprofile.php");
            }
          })
           </script>');
		
	}else if(isset($_POST["close"])){
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
            $sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $SQLInfo = $smt->fetchAll();
			 if(isset($SQLInfo[0]['DBID'])){
                  $n_sql = $mysqlcon->prepare("UPDATE $dbname.Profile_Settings SET accounts_privacy=:accounts_privacy WHERE DBID=:DBID");
                $n_sql->bindValue(':accounts_privacy', "false");
                $n_sql->bindValue(':DBID', $dbid);
                $n_sql->execute();
            }
			die ('<script>
           swal({
            title: "خطا",
            text: "تم قفل البروفايل بنجاح",
            type: "success",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/editprofile.php");
            }else {
              window.location.replace("https://panel.q-z.us/editprofile.php");
            }
          })
           </script>');
	}
	
    if ( isset( $_POST['profile-background'] ) and exif_imagetype($_POST['profile-background']) ){
        if (exif_imagetype($_POST['profile-background']) == IMAGETYPE_GIF && !in_array(10,$ggids) && !in_array(217,$ggids) && !in_array(1672,$ggids) && !in_array(35,$ggids)) {
            echo "<script>swal(
                '',
                'خاصية الخلفيات المتحركة لبعض الاشخاص فقط',
                'error'
            )</script>";
        }else{
            // if ( isset($_POST['privacy_check']) ){
                // $accounts_privacy = 'true';
            // }else{
                // $accounts_privacy = 'false';
            // }
			
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
            $sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $SQLInfo = $smt->fetchAll();
			
            if ( !isset ( $SQLInfo[0]['DBID'] ) ){
                $MySq = "INSERT INTO $dbname.Profile_Settings (`DBID`, `background`) 
                    VALUES ( :DBID, :background)";
                $sth = $mysqlcon->prepare($MySq);
                $sth->bindValue(':DBID', $dbid);
                $sth->bindValue(':background', $_POST['profile-background']);
                $sth->execute();
            }else{
                $n_sql = $mysqlcon->prepare("UPDATE $dbname.Profile_Settings SET background=:background WHERE DBID=:DBID");
                $n_sql->bindValue(':background', $_POST['profile-background']);
                $n_sql->bindValue(':DBID', $dbid);
                $n_sql->execute();
            }
            // $simple = $ts3_VirtualServer->clientGetByUid('rLsT0G5kuzvnsftf0jS39LVZUTY=');
            
            // $simple->message ( "[URL=client://0/".$User_UID."]".$client_verified['client_nickname']."[/URL] : Insert Image url ".$_POST['profile-background'] );
                    echo "<script>swal(
            '',
            'تم تعديل ملفك الشخصي !',
            'success'
        )</script>";
        }
    }else if ( isset( $_POST['profile-background'] ) ){
        echo "<script>swal(
            '',
            'يجب وضع رابط للصور فقط !',
            'error'
        )</script>";
    }

    if ( !getDBIDUserName($dbid) ){
        echo "<script type='text/javascript'>window.top.location='index.php';</script>"; 
        exit;
    }
?>			
			<br>
			<br>
			<br>
			<br>
			<br>
<!-- small card -->
<!-- center card -->
				<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
                      <center>  <div class="card border-dark">
                            <div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white"><i class="fa fa-fw fa-pencil"></i>تعديل الملف الشخصي</h4></div>
                            <div class="card-body">
							<label class="col-sm-8" for="block-form-username4">الأسم :</label>
								<div class="input-group mb-3">
                                    <input type="text"  disabled class="form-control" placeholder="<?php echo htmlspecialchars(getDBIDUserName($dbid)); ?>" aria-label="" aria-describedby="basic-addon1">
                                     <div class="input-group-append">
                                    <button class="btn btn-success " disabled type="submit">تحديث</button>
                                   </div>
                                </div>
								
								
								<form class="form-horizontal" method="post">
								<label class="col-sm-8" for="block-form-username4">العمر :</label>
								<div class="input-group mb-3">
                                    <input type="number" class="form-control" id="updatesage" name="updatesage" placeholder="<?php echo htmlspecialchars(getDBIDSettings($dbid)['age']); ?>" aria-label="" aria-describedby="basic-addon1">
                                     <div class="input-group-append">
                                    <button class="btn btn-success " type="submit" name="profile-age">تحديث</button>
                                   </div>
                                </div>
								</form>
								
								<form class="form-horizontal" method="post">								
								<label class="col-sm-8" for="block-form-username4">الجنسيه :</label>
								<div class="input-group mb-3">
                                    <input type="text" class="form-control" id="updatesna" name="updatesna" placeholder="<?php echo htmlspecialchars(getDBIDSettings($dbid)['na']); ?>" aria-label="" aria-describedby="basic-addon1">
                                     <div class="input-group-append">
                                    <button class="btn btn-success " type="submit" name="profile-na">تحديث</button>
                                   </div>
                                </div>
								</form>

								<form class="form-horizontal" method="post">																
								<label class="col-sm-8" for="block-form-username4">الوصف</label>
								<div class="input-group mb-3">
                                    <input type="text" class="form-control" id="updatetopic" name="updatetopic" placeholder="<?php echo htmlspecialchars(getDBIDSettings($dbid)['topic']); ?>" aria-label="" aria-describedby="basic-addon1">
                                     <div class="input-group-append">
                                    <button class="btn btn-success " type="submit" name="profile-topic">تحديث</button>
                                   </div>
                                </div>
								</form>							
								
								<label class="col-sm-8" for="block-form-username4">الخلفيه</label>
								<form class="form-horizontal" method="post">
								<div class="input-group mb-3">
                                    <input type="url" id="profile-background" name="profile-background" class="form-control" placeholder="<?php echo htmlspecialchars(getDBIDSettings($dbid)['background']); ?>" aria-label="" aria-describedby="basic-addon1">
                                     <div class="input-group-append">
                                    <button class="btn btn-success " type="submit">تحديث</button>
                                   </div>
                                </div>
								<label class="col-sm-8" for="block-form-username4">قفل وفتح ملفك</label>
								<hr>
								<form class="form-horizontal" method="post">
								<div class="row">
		<div class="col-md-3">
						</div>						
<div class="col-md-6">
								<?php
										$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
										$sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
										$smt = $mysqlcon->prepare($sql);
										$smt->execute(array($dbid));
										$SQLInfo = $smt->fetchAll();
										if(strval($SQLInfo[0]['accounts_privacy']) === "false"){
											echo '
																					
										
											
											<button class="btn btn-rounded btn-block btn-outline-info" type="submit" name="open">فتح</button>';
										}else{
											echo '<button class="btn btn-rounded btn-block btn-outline-danger" type="submit" name="close">قفل</button>';
										}
									 ?>

								   </div> </div>
                                </div>						
											                    </form>
							
                            </div>
                        </div> </center>
                </div>
			<!--	<div class="col-md-6 bt-switch">
												                    <form action="editprofile.php" method="post">
                       <center> <div class="card border-dark">
                            <div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white"> <i class="fa fa-fw fa-lock"></i> الخصوصية</h4></div>
                            <div class="card-body">
							
							<input type="checkbox" name="privacy_check" id="privacy_check" checked data-on-color="warning" data-off-color="danger">
							
                            </div>
                        </div></center>
                </div>
 -->
				
				
				                    </form>


				</div>
			</div>
        </div>
	        <div class="modal fade" id="apps-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-sm modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <!-- Apps Block -->
                    <!-- END Apps Block -->
                </div>
            </div>
        </div>
<?php 
    // if ( isset ( getDBIDSettings($dbid)['accounts_privacy'] ) and getDBIDSettings($dbid)['accounts_privacy'] == 'true' ){
        // echo "<script> jQuery(document).ready(function() { $('#privacy_check').prop('checked', true); $( '#privacy_check' ).trigger('change');});</script>";
    // };
?>		
<?php require_once('includes/footer.php'); ?>