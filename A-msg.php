<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
require 'config/sqlconfig.php';
$arrclients = $ts3_VirtualServer->clientList(array("client_type" => 0));

?>
<?php 
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>
<?php 

                        if(isset($_POST['editor'])){
                            $ts3_VirtualServer->request('clientupdate client_nickname=Qz-Panel'); 
                            foreach ($ts3_VirtualServer->clientList() as $css) {
                                if ($css["client_type"]) continue;
                        $css->message("[B]Message sent by [COLOR=#aa0000][URL=client://0/".$uid."]".$nickname."[/URL][/COLOR] :

".$_POST['editor']."[/B]");

                            }
                        }
?>
<head>
<!-- Load jQuery  -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Load WysiBB JS and Theme -->
<script src="assets/wysibb/jquery.wysibb.min.js"></script>
		<!-- Init WysiBB BBCode editor -->
 <script>
$(document).ready(function() {
var wbbOpt = {
  buttons: "bold,italic,underline,strike,fontcolor,|,link,"
}
$("#editor").wysibb(wbbOpt);
});
</script> 
<link rel="stylesheet" href="assets/wysibb/theme/default/wbbtheme.css" />

<!-- Init WysiBB BBCode editor -->
<script>
$(function() {
$("#editor").wysibb();
})
</script>
</head>


        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
<?php 

$cgrp = explode(',', $client_info["client_servergroups"]);
brodcast($cgrp);  

if(isset($_POST['submit'])){
	
	if(empty($_POST['textm'])){
		
		
	} else {
		$textofmessage = $_POST['textm'];
		$pokee9 = $_POST['poke'];
		if($pokee9 == 1){
			
			
			if($_POST['nor1'] == 1){
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$logoeee = "[COLOR=#55557f]broadcast ".htmlspecialchars($client_info->client_nickname)." : ".$textofmessage." [/COLOR]";
						$newtextofmessage = substr($logoeee, 0, 100);
						$css->poke($newtextofmessage);

					}	
				
			} else {
				
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$css->poke($textofmessage);
					}
				
			}
		}
		$message9 = $_POST['message'];
		if($message9 == 1){			
			
			if($_POST['nor1'] == 1){
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$css->message("[B][COLOR=#55557f]broadcast from[/COLOR] [COLOR=#55aaff]".htmlspecialchars($client_info->client_nickname)."[/COLOR] [COLOR=#ff557f]:[/COLOR] [COLOR=#55aa7f] ".$textofmessage." [/COLOR][/B]");

					}	
				
			} else {
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$css->message($textofmessage);
					}
			
			}
		
		}

		$room9 = $_POST['room'];
		if($room9 == 1){						
			if($_POST['room'] == 1){
				
			try{
				foreach ($ts3_VirtualServer->channelList() as $channel) {
						// skip query clients
						// send test message if client build is outdated
						$channel->message("[B][COLOR=#55557f]broadcast from[/COLOR] [COLOR=#55aaff]".htmlspecialchars($client_info->client_nickname)."[/COLOR] [COLOR=#ff557f]:[/COLOR] [COLOR=#55aa7f] ".$textofmessage." [/COLOR][/B]");

					}
					
						}catch (Exception $e) {
        echo $e->getCode();

						}	
			} else {
					try{		
				foreach ($ts3_VirtualServer->channelList() as $channel) {
						// skip query clients
						// send test message if client build is outdated
						$channel->message($textofmessage);
						
					}
	

									}catch (Exception $e) {
        echo $e->getCode();

									}	
			}
		
		}		
		
	}

}
if(isset($_POST['sg']) and isset($_POST['send']) and isset($_POST['sendtext']) and isset($_POST['typesend'])){
try{
if($_POST['typesend'] == msg){

$ts3->serverGroupGetByName($_POST['sg'])->message($_POST['sendtext']);

}else{
$idsg = $ts3->serverGroupGetByName($_POST['sg'])->sgid;
foreach($ts3_VirtualServer->clientList(array("client_type" => 0)) as $clients) {
$ggid = explode(",", $clients["client_servergroups"]);

if(in_array($idsg,$ggid)){

$clients->poke($_POST['sendtext']);
}
}
}

									}catch (Exception $e) {
echo $e->getMessage();

									}	


}

?>
		<center>

			<div class="col-md-7">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>الرسالة المطورة</b></h4>
					</div>
                    <form method="post" style="direction: ltr;">
                        <textarea id="editor" name="editor"></textarea>
						<br>
						<div class="col-md-4">
                        <button class="btn btn-rounded btn-block btn-outline-success" type="submit"><i class="fa fa-comment-o"></i> إرسال</button>
						</div>
                    </form>
                </div>
				             </div>
		
			<div class="col-md-7">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>ارسال رسالة جماعية</b></h4>
					</div>
                          <form method="post" role="form" action="">					
                    <div class="card-body">
					<br>
					<div class="form-group form-material row">
						<div class="col-sm-4">
						<label class="control-label" for="inputGrid1">عرض اسمك</label>
						<input type="text" class="form-control" id="nor1" name="nor1" placeholder="تبي حط 1">
						</div>
						<div class="col-sm-4">
						<label class="control-label" for="inputGrid2">رسالة خاصة</label>
						<input type="text" class="form-control" id="message" name="message" placeholder="تبي حط 1">
						</div>
						<div class="col-sm-4">
						<label class="control-label" for="inputGrid2">كل الرومات</label>
						<input type="text" class="form-control" id="room" name="room" placeholder="تبي حط 1">
						</div>
					</div>			  
					
					<div class="form-group">
						<div class="col-xs-12">
						<input type="hidden" readonly="readonly" name="action" value="ann">
						<input type="hidden" name="Token"> <textarea class="form-control" name="textm" style="direction:rtl;" placeholder=" يلزم الرساله .. "></textarea><br>
						</div>
					</div>
					
					
					
						
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="submit" class="btn btn-rounded btn-block btn-outline-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="أرسال"> أرسال </button>
					  </form>

                    </div></center>
					<br>
					
					
                </div>
            </div>
		</center>
		
		
		<center>
			<div class="col-md-7">
			<form method='post'>
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>إرسال رسالة لرتبة محدده</b></h4>
					</div>
                             <form method='post'>					
                    <div class="card-body">
					<br>
					<select name="typesend" class="form-control" style="width: 100%; height:40px;">
						<option name="poke" value="poke"> poke</option>

						<option name="msg" value="msg"> msg</option>
					</select>			  
					<br>
					<br>
					<select name="sg" class="form-control" style="width: 100%; height:40px;">
<?php
foreach($ts3->serverGroupList(array("type" => 1)) as $chl){
echo'<option name="'.$chl.'" value="'.$chl.'"> '.$chl.'</option>';



}


?>
					</select>
					<br>
					<br>
					<div class="form-group">
						<div class="col-xs-12">
								<input type="text" class="form-control" id="textm" name="sendtext" placeholder="محتوى الرسالة" required>
						</div>
					</div>	
                    </div>
					<center><div class="col-md-4">
                      <button type="submit" name="send" class="btn btn-rounded btn-block btn-outline-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="أرسال"> أرسال </button>
                    </div></center>
					<br>
							  </form>
					</form>
                </div>
            </div>
		</center>
			
		
		
			
        </div>
        </div>













        <!-- footer -->
			<footer class="footer">
				<center>
					<span><img src="assets/images/logo2.png" alt="Qz Control Panel"></span>
					<center>Qz Developer 2018 ©</center>
				</center>
			</footer>
			<!-- End footer -->
		</div>
    <!-- End Wrapper -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/dist/js/waves.js"></script>
    <script src="assets/dist/js/sidebarmenu.js"></script>
	<script src="assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/dist/js/custom.min.js"></script>
    <script src="assets/node_modules/prism/prism.js"></script>
    <script src="assets/node_modules/raphael/raphael-min.js"></script>
   <!--  <script src="assets/node_modules/morrisjs/morris.min.js"></script> -->
    <script src="assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/node_modules/d3/d3.min.js"></script>
    <script src="assets/node_modules/c3-master/c3.min.js"></script>
    <script src="assets/node_modules/toast-master/js/jquery.toast.js"></script>
   <!--  <script src="assets/dist/js/dashboard1.js"></script> -->
	<script src="assets/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
	<script src="assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <script src="assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>
		<!-- Load WysiBB JS and Theme -->

		<!-- Init WysiBB BBCode editor --> 
</body>


</html>
</html>