<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 

$usertow = 1;
if($_SESSION['userone'] == 1 or $_SESSION['verfied'] == 1){
echo'<meta http-equiv="refresh" content="0; url=./" />';
}
?>

        <div class="page-wrapper">
            <div class="container-fluid">
			<br>


			<center><div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-dark">
                               <center> <h4 class="m-b-0 text-white"><b>التحقق من العضو</b></h4> </center>
								</div>
<?php
    
    if (!empty($_GET['reset'])) {
        unset($_SESSION);
    };
    
    if (empty($_SESSION['do'])) {
        $_SESSION['do'] = '0';
    }
    
    
    $error = array();
    $continue = true;
    
    
    
    if (($_SESSION['do'] == 0 and !empty($_POST['uid'])) or ($_SESSION['do'] == 1 and !empty($_SESSION['uid']))) {
        if ((!empty($_SESSION['uid']) and strlen($_SESSION['uid']) == 28 and $_SESSION['uid'][27] == "=") or (strlen($_POST['uid']) == 28 and $_POST['uid'][27] == "=")) {
            $groups = array();
            if (!empty($_POST['uid'])) {
                $_SESSION['uid'] = $_POST['uid'];
            }
            try {
                TeamSpeak3::init();
                $filter = array('client_unique_identifier' => str_replace('/','\/', str_replace('+', '\+', str_replace('-', '\-', str_replace('&', '\&', $_SESSION['uid'])))));
                if ($config['teamspeak']['ip-verify']) {
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    $filter['connection_client_ip'] = $ip;
                }
                if (count($ts3->clientList($filter)) > 0) {
                    $_SESSION['do'] = '1';
					
$uidlist = array();
			$clients = $ts3->clientList(array("client_type" => 0));
			foreach($clients as $client){
				if(strval(getclientip()) === strval($client['connection_client_ip'])){
					$cuid = strval($client["client_unique_identifier"]);
					array_push($uidlist, $cuid);
				}
			}
			
			if(!in_array($_SESSION['uid'],$uidlist)){
				session_destroy();
				echo'<meta http-equiv="refresh" content="0; url=./" />';
			die('<script>
           swal({title: "تخسي وتعقب",text: "كانك موجوده وخلصنا منها ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
			}
                    foreach ($ts3->clientList($filter) as $client) {
                    $_SESSION['name'] = $client['client_nickname'];

                        break;
                    }
                } else {
                    unset($_SESSION);
                    $_SESSION['do'] = '0';
                    $error[] = array('type' => 'danger', 'msg' => 'No Online Client found!');
                    $continue = false;
                }
            } catch(Exception $e) {
                $error[] = array('type' => 'danger', 'msg' => 'Error: '. $e->getCode() . ": " . $e->getMessage());
            };
        } else {
            $error[] = array('type' => 'danger', 'msg' => 'Error: Wrong UID given!');
        }
    }
    
    
    if ($_SESSION['do'] == 1 and (!empty($_POST['assign']))) {
        if ((!empty($_SESSION['verified']) and $_SESSION['verified']) or $_SESSION['pin'] == $_POST['pin']) {
echo "<center> <img src='image/AjaxLoader.gif'> </center>";
echo'<meta http-equiv="refresh" content="3; url=./" />';
                    $_SESSION['name'] = $client['client_nickname'];
                    $_SESSION['ci'] = $_SESSION['uid'];
$_SESSION['userone'] = 1;
            $error[] = array('type' => 'success', 'msg' => '!تمت العملية بنجاح');
}else{
            unset($_SESSION['pin']);
            $error[] = array('type' => 'danger', 'msg' => '!خطأ : هناك خطا الرجاء المحاولة مرة أخرى');
        }

        }     

    
?>								
							<div class="card-body">
										<div class="col-lg-12">
									<center><h1 class="h2 font-w700 mt-50 mb-10"><b>المتصلين حالياً</b></h1>
									<br>
									<h3><b> .↓. .↓. .↓. .↓. </b></h3>
									<br>
									</center>
										</p>
									<h2 class="h4 font-w400 text-muted mb-30"><p class="font-w300"><?php
                                foreach ($ts3_VirtualServer->clientList() as $client) {
									if(getclientip() == $client['connection_client_ip']) {
                           //     if ($client->getProperty('connection_client_ip') == $_SERVER['REMOTE_ADDR']) {
                                  print "<p class=\"font-w300\"><hr>اسمك : ".$client['client_nickname']."<br> المعرف الخاص بك : ".$client['client_unique_identifier']."</font><br>";}}?></h2>

									<hr>
									<h1 class="h2 font-w700 mt-50 mb-10"><b>تأكيد العضوية</b></h1>		
									<hr>
                        <noscript>
                            <div class="alert alert-danger" role="alert">!عليك تفعيل الجافا سكربت آولا</div>
                        </noscript>
                        <?php foreach ($error as $err) { ?>
                            <div class="alert alert-<?php echo $err['type']; ?>" role="alert"><?php echo $err['msg']; ?></div>        
                        <?php } ?>
                        <!-- Error Displaying Ends -->
                        <?php if ($_SESSION['do'] == 0) { ?>
							<form class="js-validation-lock"  method="POST" novalidate="novalidate">						
										<label for="InputUid">
										<br><b>قم بوضع المعرف الخاص بك في الأسفل
										PjuN43MopI3D3pzg0z6BS04DC50= : مثل</b></label>
										
										
										
										<div class="col-12">
											<div class="form-material floating">
												<input type="text" class="form-control" name="uid" id="uid" placeholder="ضع المعرف الخاص بك هنا">
											</div>
										</div>
									
										
										</div>
										<br>
										<br>
										<div class="col-md-6">
										  <button type="submit" class="btn btn-rounded btn-block btn-outline-success">الخطوة التالية</button>
										</div>
                            </form>	

							</div>
						</div>
			</div>
			</center>
			                        <?php }; ?>

                        <?php if ($_SESSION['do'] == 1) { ?>
                            <form action="" method="POST" class="form-horizontal">
                                <b><?php echo $_SESSION['name']; ?></b>
                                <br/><br/>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-8">
                                </div>
                                <div class="col-xs-2"></div>
                                <br/><br/>
                                <?php if (!empty($_SESSION['verified']) and $_SESSION['verified']) { ?>
                                    <button type="submit" class="btn btn-primary">تطبيق</button>
                                <?php } else { ?>
                                    <a onclick="openconfirmation();" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#setgrps">تحقق</a>
                                <?php }; ?>
                                <div class="modal fade" id="setgrps">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">رمز التحقق</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <center>
                                                    <div style="max-width:40%" class="form-group">
                                                        <label for="pin">ضع رمز التحقق هنا</label>
                                                        <input type="text" class="form-control" id="pin" name="pin" placeholder="Pin">
                                                        <input type="hidden" name="assign" value="1"></input>
                                                    </div>
                                                </center>
                                            </p>
                                        </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">تطبيق</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>                    
                        <?php }; ?>
				<!--		<center><div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-dark">
                               <center> <h4 class="m-b-0 text-white"><b>التحقق من العضو</b></h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><h1 class="h2 font-w700 mt-50 mb-10"><b>المتصلين حالياً</b></h1>
									<br>
									<h3><b> .↓. .↓. .↓. .↓. </b></h3>
									<h1 class="h2 font-w700 mt-50 mb-10"><b>المرحله الثانيه‬‎</b></h1>
									<br>
									</center>
										</p>
                                            

									<h2 class="h4 font-w400 text-muted mb-30"><p class="font-w300"></p><hr><b>اسمك : # ~亗Osama-M<br> المعرف الخاص بك : NCj6mK8705tYOBkvi2GwHnvSa2g=<br><p class="font-w300"></p><hr>اسمك : ! 亗Qz,<br> المعرف الخاص بك : V/WqIa+l/VOPo0eivWN6VFtA/Z8=<b><br></h2>

									<hr>
									<h1 class="h2 font-w700 mt-50 mb-10"><b>تأكيد العضوية</b></h1>		
									<hr>

										<label for="InputUid">
										<br><b>! 亗Qz, </b></label>
									
										
										</div>
										<br>
										<br>
										<div class="col-md-6">
										  <button type="button" class="btn btn-rounded btn-block btn-outline-info">تحقق</button>
										</div>

							</div>
						</div>
			</div>
			</center> -->


			</div></div></div></div></div></div></div></div>
        </div>
	    <script type="text/javascript">
        function openconfirmation() {
            $.get("config/confirmation");
            return false;
        }
    </script>		
<?php require_once('includes/footer.php'); ?>