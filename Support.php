<?php
die();
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
require 'config/sqlconfig.php'; 
?>

        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
<?php
$xz = explode(',', $client_info["client_servergroups"]);
		if(!count(array_intersect($ban_support, $xz)) > 0){
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
<center>
<?php
$clientname = $client_info["client_nickname"];
$cliantID = $client_info["client_unique_identifier"];
$ID = '[B][COLOR=red][URL=client://82/'.$cliantID.']'.htmlspecialchars($clientname).'[/URL][/COLOR][/B]';
if (isset($_POST['submit'])){
$problem = $_POST['name'];
$case = $_POST['case'];
$someone = $_POST['someone'];
$info = $_POST['info'];
if (!empty($problem) and !empty($case) and !empty($someone) and !empty($info)){
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true))
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         يمنع السبام الرجاء إنتظار 20 ثواني لتكرار <strong>الطلب  ! </strong></center> 
                                </div>
	';

	$_SESSION['ts3_last_query'] = microtime(true)+20.0;
if($ts3_Client->cid != $SupportRoomID){
	$ts3_VirtualServer->clientGetByUid("$cliantID")->move("$SupportRoomID");
}
				$ts3_VirtualServer->clientGetByUid("$cliantID")->addServerGroup(1630);
				$ts3_VirtualServer->clientGetByUid("$cliantID")->message('الرجاء الإنتظار :)');
				$ts3_VirtualServer->serverGroupGetById("$SupportAccess")->message("
[B]
نوع الطلب :
$case

العنوان:
$problem
إسم العضو : 
$ID

إسم المتهم أو الذي يوافقه الرأي :
$someone

تنويه أو ملاحظة :
$info
[/B]
");
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         تم تقديم طلبك <strong>بنجاح  ! </strong></center> 
                                </div>
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         الرجاء إنتظار <strong>السبورت  ! </strong></center> 
                                </div>

';


}else{
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         الرجاء إكمال حقول <strong>الطلب  ! </strong></center> 
                                </div>
';


}
				}

?>			
				<div class="col-md-6"> 
                        <div class="card border-success">
                            <div class="card-header bg-success">
                               <center> <h4 class="m-b-0 text-white">Qz# Support | طلب المساعدة</h4> </center>
							</div>
							<br>
							                                    <form method="post">
							<div class="col-12">
								<label class="col-12" for="form-control">نوع الطلب</label>
								<select name="case" class="form-control">
								<option name="إقتراح" value="إقتراح">إقتراح</option>
								<option name="شكوى" value="شكوى">شكوى</option>
								<option name="طلب مساعدة" value="طلب مساعدة">طلب مساعدة</option>
								<option name="إستفسار" value="إستفسار">إستفسار</option>
								<option name="أخرى" value="أخرى">أخرى</option>
								</select>
							</div>
							<br>
							<div class="col-12">
								<label class="col-12" for="form-control">العنوان</label>
								<div class="input-group">
									<input type="text" class="form-control" id="text" name="name" placeholder="العنوان .. ">
								</div>
							</div>
							<br>
							<div class="col-12">
								<label class="col-12" for="form-control">إسم المتهم أو الذي يوافقه الرأي</label>
								<div class="col-12">
											<select name='someone' class='form-control'>
												<option name='لا يوجد' value='لا يوجد' :- لايوجد</option>
												 												 <?php
												foreach($ts3->clientList() as $chl){
												$system = $chl["client_platform"];
												if($system == ServerQuery){
												}else{
												$names = htmlspecialchars($chl["client_nickname"]);
												if($names != $client_info["client_nickname"]){
												echo'<option name="'.$names.'" value="'.$names.'"> '.$names.'</option>';
												}
												}


												}

												?>
											</select>
                                            </div>
							</div>
							<br>
							<div class="form-group row">
								<label class="col-12" for="contact1-msg">الموضوع</label>
								<div class="col-12">
									<textarea class="form-control" id="contact1-msg" name="info" placeholder="أكتب هنا كل ما يخص الموضوع" style="margin-top: 0px; margin-bottom: 0px; height: 149px;"></textarea>
								</div>
							</div>
							
							<div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-outline-success" name="submit">
                                                    <i class="fa fa-send"></i> تقديم الطلب
                                                </button>
                                            </div>
                                        </div>
							                                    </form>

						</div> 
			
			
<h2>:  قائمة السبورت المتصلين </h2>
<?php
try{
$ts3_VirtualServer->clientListReset();
$ts3_VirtualServer->channelListReset();
foreach ($ts3_VirtualServer->clientList() as $chl) {
$ggids = explode(",", $chl["client_servergroups"]);
if(in_array($SupportAccess,$ggids)){
$status = $chl->getIcon();
echo $chl;
echo'<img src="config/client_status/'.$status.'.png" style="width:20px;height:20px;"/>';
echo"<br>";
}
}
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }

?>
			
</center>
        </div>
        </div>
			
			
	 <?php						
if(isset($_POST['done_support'])){
	$msg = $_POST['msg'];
	$bctype = $_POST['BCType'];
	if($bctype == "support"){
	$ts3_VirtualServer->clientGetByUid($uid)->move(954);	
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke("[COLOR=#aa007f][B][COLOR=#aa007f][B]اهلا وسهلا بك[/B][/COLOR][/B][/COLOR]");
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke($nickname);
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke("[COLOR=#aa5500][B]نرجو الانتظار, استغل دقائق الانتظار بالاستغفار[/B][/COLOR]");
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#00557f][B]نوع الطلب: مساعدة[/B][/COLOR]");
	$ts3_VirtualServer->serverGroupGetById(901)->message("[U][COLOR=#ff0000][B]الرسالة[/B][/COLOR][/U]");
	$ts3_VirtualServer->serverGroupGetById(901)->message($msg);
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#00aa7f][B]:المشكلة من[/B][/COLOR]");
	$ts3_VirtualServer->serverGroupGetById(901)->message($nickname);
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#ff5500][B]نرجو مساعدته برومات المساعدة[/B][/COLOR]");
	}
	if($bctype == "report"){
	$ts3_VirtualServer->clientGetByUid($uid)->move(954);	
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke("[COLOR=#aa007f][B]اهلا وسهلا بك[/B][/COLOR]");
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke($nickname);
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke("نرجو الانتظار, استغل دقائق الانتظار بالاستغفار");
	$ts3_VirtualServer->serverGroupGetById(901)->message("نوع الطلب: شكوى");
	$ts3_VirtualServer->serverGroupGetById(901)->message("[U][COLOR=#ff0000][B]الرسالة[/B][/COLOR][/U]");
	$ts3_VirtualServer->serverGroupGetById(901)->message($msg);
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#00aa7f][B]:المشكلة من[/B][/COLOR]");
	$ts3_VirtualServer->serverGroupGetById(901)->message($nickname);
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#ff5500][B]نرجو مساعدته برومات المساعدة[/B][/COLOR]");
	}
	if($bctype == "problem"){
	$ts3_VirtualServer->clientGetByUid($uid)->move(954);	
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke("[COLOR=#aa007f][B]اهلا وسهلا بك[/B][/COLOR]");
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke($nickname);
	sleep(1);
	$ts3_VirtualServer->clientGetByUid($uid)->poke("نرجو الانتظار, استغل دقائق الانتظار بالاستغفار");
	$ts3_VirtualServer->serverGroupGetById(901)->message("نوع الطلب: مشكلة");
	$ts3_VirtualServer->serverGroupGetById(901)->message("[U][COLOR=#ff0000][B]الرسالة[/B][/COLOR][/U]");
	$ts3_VirtualServer->serverGroupGetById(901)->message($msg);
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#00aa7f][B]:المشكلة من[/B][/COLOR]");
	$ts3_VirtualServer->serverGroupGetById(901)->message($nickname);
	$ts3_VirtualServer->serverGroupGetById(901)->message("[COLOR=#ff5500][B]نرجو مساعدته برومات المساعدة[/B][/COLOR]");
	}
}
?>		
			

        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>