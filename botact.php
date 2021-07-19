<?php
require 'config/phphead2.php';

if(isset($_POST["botid"]) && isset($_POST["botname"])){
	$botid = intval($_POST["botid"]);
	if(!empty($botid) && is_numeric($botid)){
		
		$sql = "SELECT * FROM `Rankqz`.`bots`";
		$res = $con->query($sql);
		if($res->num_rows > 0){
			$botactive = array();
			while($datax = $res->fetch_assoc()){
				$botcb = intval($datax["botcb"]);
				array_push($botactive, $botcb);
			}
		}
		
		if(in_array($botid, $botactive)){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			// die(json_encode(array('message' => 'xactivex')));
			die;
		}
		
		$sql = "SELECT * FROM `Rankqz`.`bots` WHERE owner='$dbid'";
		$res = $con->query($sql);
		if($res->num_rows >= 2){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('error' => '2')));
		}
		
		try{
			$boty = $ts3->clientGetByDbid($botid);
			$cfip = strtolower($boty["client_country"]);
			$allowed = array("fr","de","gb","it","us","ca","nl","ie","es");
			if($boty["cid"] !== 167492 || !in_array($cfip, $allowed)){
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die;
			}
		}catch(Exception $e){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die;
		}
		
		$botname = trim(htmlspecialchars(stripslashes(strip_tags($_POST["botname"]))));
		if(isset($botname) && !empty($botname)){
			$newbot = $botname."".mt_rand(1000,9999)."".mt_rand(0,99);
			echo $newbot;
			$_SESSION["botid"] = $botid; 
			$_SESSION["botx"] = $newbot;
			die;
		}else{
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die;
		}
	}
	header('HTTP/1.1 500 Internal Server Error');
	header('Content-Type: application/json; charset=UTF-8');
	die;
}else if(isset($_POST["tryact"])){
	// session_start();
	if(isset($_SESSION["botid"]) && isset($_SESSION["botx"])){
		// require 'config/phphead.php';
		try{
			$botid = intval($_SESSION["botid"]);
			$bot = $ts3->clientGetByDbid($botid);
			$curname = trim(strval($bot["client_nickname"]));
			if($curname === $_SESSION["botx"]){
				// require 'config/sqlconfig.php';
				
				try{
					$bot->addServerGroup(90);					
					$bot->addServerGroup(2274);
					$bot->addServerGroup(21);
					$bot->move(1136);
					$sql = "INSERT INTO `Rankqz`.`bots` (id, owner, botcb) VALUES (NULL, '$dbid', '$botid')";
					$con->query($sql);					
				}catch(Exception $e){
					unset($_SESSION["botid"]);
					unset($_SESSION["botx"]);
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					die;
				}
				unset($_SESSION["botid"]);
				unset($_SESSION["botx"]);
				echo "true";
				die;
			}else{
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die;
				// die(json_encode(array('message' => 'xnamex')));
			}
		}catch(Exception $e){
			unset($_SESSION["botid"]);
			unset($_SESSION["botx"]);
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			// die(json_encode(array('message' => 'xofflinex')));
			die;
		}
	}
	header('HTTP/1.1 500 Internal Server Booboo');
	header('Content-Type: application/json; charset=UTF-8');
	// die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
	die;
}else{
	// require 'config/phphead.php';
	// require 'config/sqlconfig.php'; 

	require_once('includes/header2.php');
	require_once('includes/topbar.php');
	require_once('includes/sidebar.php');
 }

// $cgrp = explode(',', $client_info["client_servergroups"]);
// $Ownererrr = array(2);
// if(!count(array_intersect($Ownererrr, $ggids)) > 0){ die('<script>
           // swal({title: "صيانه",text: "يوجد عمليات تصليح تجري الأن , نأسف ع الأزعاج ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								// }

?>
<script>
window.onload = function() {
    if (window.jQuery) {
       $(".act").click(function(){
		   var botx = $(".xbot").val();
		   var botn = $(".xbot").find('option:selected').text();
		   if(typeof(botx) != "undefined" && botx !== null){
				swal({
				  title: " ؟ هل انت متأكد من تفعيل هذا البوت",
				  icon: "success",
				buttons: ["لا", "نعم"],
				  dangerMode: true,
				})
				.then((act) => {
				  if (act) {
					$.ajax({
					  method: "POST",
					  url: "https://panel.q-z.us/botact",
					  data: { botid: botx, botname: botn}
					}).done(function(msg) {
						$(".lvl1").hide();
						$(".lvl2").show();
						$(".cn").text(botn);
						$(".nn").text("غير اسم البوت الى :  " + msg);
				    }).fail(function(xhr) {
						var error = JSON.parse(xhr.responseText).error;
						if(error == 2){
							swal({
							  title: "حدث خطأ",
							  text: "لا يمكنك تفعيل أكثر من بوتين",
							  icon: "error",
							  button: "إستكمال",
							});
						}else{
							swal({
							  title: "حدث خطأ",
							  text: "برجاء المحاولة مرة أخرى",
							  icon: "warning",
							  button: "إستكمال",
							});
						}
					});
				  }
				});
		   }
	   });
	   $(".act2").click(function(){
			$.ajax({
			  method: "POST",
			  url: "https://panel.q-z.us/botact",
			  data: { tryact: true}
			}).done(function(msg) {
				$(".lvl2").hide();	
				swal({
				  title: "تم تفعيل البوت بنجاح",
				  icon: "success",
				  button: "شكرا",
				});
				$(".lvl3").show();
			}).fail(function() {
				swal({
				  title: "حدث خطأ",
				  text: "برجاء التاكيد من تسمية البوت ",
				  icon: "warning",
				  button: "إستكمال",
				});
		    });
	   });
    }
}
</script>

        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
			
<center class="lvl1">
<div class="col-md-6">
<div class="card text-center">
                            <div class="card-header">
                                اختر البوت 
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">برجاء اختيار البوت المراد تفعيلة </h4>
<div class="form-group">
                                        <select class="form-control xbot" name="xbot" style="width: 50%; height:40px;">
                                            <?php
												$sql = "SELECT * FROM `Rankqz`.`bots`";
												$res = $con->query($sql);
												if($res->num_rows > 0){
													$botactive = array();
													while($datax = $res->fetch_assoc()){
														$botcb = intval($datax["botcb"]);
														array_push($botactive, $botcb);
													}
												}
												$cls = $ts3->channelGetById(167492)->clientList(array("client_platform" => "Linux"));
												foreach($cls as $clx){
													$dbidb = $clx["client_database_id"];
													$ranks = explode(",", $clx["client_servergroups"]);
													if(in_array($dbidb, $botactive) || !in_array(9, $ranks)){ continue; }
													echo "<option value='$dbidb'>$clx</value>";
												}						
											?>
                                        </select>
                                    </div>
                                <a href="javascript:void(0)" class="btn btn-info act">تفعيل البوت</a>
                            </div>
                            <div class="card-footer text-muted">
                               
                            </div>
                        </div>			
			
			
			
        </div>
</center>
		

<center class="lvl2" style="display: none;">
<div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">خطوة التحقيق لتفعيل البوت</h4>
                                <p class="card-text cn">اسم البوت المراد تفعيلة : اسم البوت هنا</p>
                                <p class="card-text nn">قم بتغير اسم الي : هنا اسم البوت</p>
                                <a href="javascript:void(0)" class="btn btn-primary act2">تفعيل البوت</a>
                            </div>
                        </div>
                    </div>
</center>

<center class="lvl3" style="display: none;">

<div class="col-md-6">
                        <div class="card border-dark">
                            <div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white">التحكم بالبوت</h4></div>
                            <div class="card-body">
                                <h3 class="card-title">اضغط علي الزر الاسفل لتفعيل البوت</h3>
                                <a href="botcontrol.php" class="btn btn-warning">التحكم بالبوت</a>
                            </div>
                        </div>
                    </div>
</center>
		
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>