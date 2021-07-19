<?php
	require 'config/phphead2.php';
	if(isset($_POST["mv"])){
		if(time() <= intval($_SESSION["botspam"])){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('error' => '3')));
		}
			$_SESSION["botspam"] = (time() + 10);
			if(is_numeric($_POST["mv"])){
				$botx = intval($_POST["mv"]);
				$bots = array();
				$sql = "SELECT * FROM `Rankqz`.`bots` WHERE owner='$dbid'";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					while($datax = $res->fetch_assoc()){
						$idx = intval($datax["id"]);
						$botid = intval($datax["botcb"]);
						array_push($bots, $botid);
					}
				}else{
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					die;
					// die(json_encode(array('message' => 'xofflinex')));
				}
				if(in_array($botx, $bots)){
					try{
						$croom = $client_info["cid"];
						$ts3->clientGetByDbid($botx)->move($croom);
						die;
					}catch(Exception $e){
						header('HTTP/1.1 500 Internal Server Error');
						header('Content-Type: application/json; charset=UTF-8');
						die;
						// die(json_encode(array('message' => 'xofflinex')));
					}
				}
			}else{
				echo var_dump($_POST["mv"]);
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die;
				// die(json_encode(array('message' => 'xofflinex')));
			}
			die;
	}else if(isset($_POST["kc"])){
		if(time() <= $_SESSION["botspam"]){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('error' => '3')));
		}else{
			$_SESSION["botspam"] = (time() + 10);
		}
		if(is_numeric($_POST["kc"])){
			$botx = intval($_POST["kc"]);
				$bots = array();
				$sql = "SELECT * FROM `Rankqz`.`bots` WHERE owner='$dbid'";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					while($datax = $res->fetch_assoc()){
						$idx = intval($datax["id"]);
						$botid = intval($datax["botcb"]);
						array_push($bots, $botid);
					}
				}else{
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					die;
					// die(json_encode(array('message' => 'xofflinex')));
				}
			if(in_array($botx, $bots)){
				try{
					$ts3->clientGetByDbid($botx)->kick(TeamSpeak3::KICK_CHANNEL);
					die;
				}catch(Exception $e){
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					die;
				}
			}
		}else{
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die;
		}
		die;
	}else if(isset($_POST["del"])){
		if(time() <= $_SESSION["botspam"]){
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('error' => '3')));
		}else{
			$_SESSION["botspam"] = (time() + 10);
		}
		if(is_numeric($_POST["del"])){
			$botx = intval($_POST["del"]);
			$bots = array();
			$sql = "SELECT * FROM `Rankqz`.`bots` WHERE owner='$dbid'";
			$res = $con->query($sql);
			if($res->num_rows > 0){
				while($datax = $res->fetch_assoc()){
					$idx = intval($datax["id"]);
					$botid = intval($datax["botcb"]);
					array_push($bots, $botid);
				}
			}else{
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die;
				// die(json_encode(array('message' => 'xofflinex')));
			}
			if(in_array($botx, $bots)){
				try{
					
					try{
						$ts3->serverGroupClientDel(90, $botx);
					}catch(Exception $e){
						try{
							$ts3->serverGroupClientDel(89, $botx);
						}catch(Exception $e){
							header('HTTP/1.1 500 Internal Server Error');
							header('Content-Type: application/json; charset=UTF-8');
							die;
						}
					}
					
					$ts3->serverGroupClientDel(2274, $botx);
					$ts3->serverGroupClientDel(21, $botx);
					$sql = "DELETE FROM `Rankqz`.`bots` WHERE botcb='$botx' LIMIT 1;";
					$con->query($sql);	
					die;
				}catch(Exception $e){
					header('HTTP/1.1 500 Internal Server Error');
					header('Content-Type: application/json; charset=UTF-8');
					die;
				}
			}else{
				header('HTTP/1.1 500 Internal Server Error');
				header('Content-Type: application/json; charset=UTF-8');
				die;
			}
		}else{
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json; charset=UTF-8');
			die;
		}
		die;
	}

require_once('includes/header2.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');

?>

<script>
window.onload = function() {
	$(".mv").click(function(){
		var botid = $(this).attr("name");
		$.ajax({
			  method: "POST",
			  url: "https://panel.q-z.us/botcontrol",
			  data: { mv: botid}
			}).done(function(msg) {
				swal({
				  title: "تمت العملية بنجاح",
				  text: "تم سحب البوت الى الروم",
				  icon: "success",
				  button: "Ok",
				});
			}).fail(function(xhr) {
				if(typeof xhr.responseText !== 'undefined' && xhr.responseText != null && xhr.responseText != ""){
					var error = JSON.parse(xhr.responseText).error;
					if(error == 3){
						swal({
						  title: "حدث خطأ",
						  text: "برجاء الأنتظار 10 ثواني بين كل طلب",
						  icon: "warning",
						  button: "إستكمال",
						});
					}else{
						swal({
						  title: "حدث خطأ",
						  text: "تعذر سحب البوت",
						  icon: "warning",
						  button: "إستكمال",
						});
					}
				}else{
					swal({
						  title: "حدث خطأ",
						  text: "تعذر سحب البوت",
						  icon: "warning",
						  button: "إستكمال",
						});
				}	
		    });
	});
	$(".kc").click(function(){
	var botid = $(this).attr("name");
	$.ajax({
		  method: "POST",
		  url: "https://panel.q-z.us/botcontrol",
		  data: { kc: botid}
		}).done(function(msg) {
			swal({
			  title: "تمت العملية بنجاح",
			  text: "تم طرد البوت من الروم",
			  icon: "success",
			  button: "Ok",
			});
		}).fail(function(xhr) {
				if(typeof xhr.responseText !== 'undefined' && xhr.responseText != null && xhr.responseText != ""){
					var error = JSON.parse(xhr.responseText).error;
					if(error == 3){
						swal({
						  title: "حدث خطأ",
						  text: "برجاء الأنتظار 10 ثواني بين كل طلب",
						  icon: "warning",
						  button: "إستكمال",
						});
					}else{
						swal({
						  title: "حدث خطأ",
						  text: "تعذر طرد البوت",
						  icon: "warning",
						  button: "إستكمال",
						});
					}
				}else{
					swal({
						  title: "حدث خطأ",
						  text: "تعذر طرد البوت",
						  icon: "warning",
						  button: "إستكمال",
						});
				}
		});
	});
	$(".del").click(function(){
	var botid = $(this).attr("name");
	var btn = $(this);
	$.ajax({
		  method: "POST",
		  url: "https://panel.q-z.us/botcontrol",
		  data: { del: botid}
		}).done(function(msg) {
			btn.parent().parent().fadeOut(800, function(){ $(this).remove();});
			swal({
			  title: "تمت العملية بنجاح",
			  text: "تم حذف البوت بنجاح",
			  icon: "success",
			  button: "Ok",
			});
			
		}).fail(function(xhr) {
			if(typeof xhr.responseText !== 'undefined' && xhr.responseText != null && xhr.responseText != ""){
					var error = JSON.parse(xhr.responseText).error;
					if(error == 3){
						swal({
						  title: "حدث خطأ",
						  text: "برجاء الأنتظار 10 ثواني بين كل طلب",
						  icon: "warning",
						  button: "إستكمال",
						});
					}else{
						swal({
						  title: "حدث خطأ",
						  text: "تعذر حذف البوت",
						  icon: "warning",
						  button: "إستكمال",
						});
					}
				}else{
					swal({
						  title: "حدث خطأ",
						  text: "تعذر حذف البوت",
						  icon: "warning",
						  button: "إستكمال",
						});
				}
		});
	});
}
</script>
<div class="page-wrapper">
	<div class="container-fluid">
	
	<br/><br/>
	<h3 class="text-warning text-center" style="display: none;">ليست لديك بوتات للتحكم بهم</h3>
	<?php
		$bots = array();
		$sql = "SELECT * FROM `Rankqz`.`bots` WHERE owner='$dbid'";
		$res = $con->query($sql);
		if($res->num_rows > 0){
			// $croom = $client_info["cid"];
			while($datax = $res->fetch_assoc()){
				$idx = intval($datax["id"]);
				$botid = intval($datax["botcb"]);
				array_push($bots, $botid);
				echo '<div class="col-md-4 cn"> <div class="card border-dark text-center"> <div class="card-header bg-dark">
				<h4 class="m-b-0 text-white">التحكم بالبوت</h4></div> <div class="card-body">';
				try{
					$botz = $ts3->clientGetByDbid($botid);
					$nick = $botz["client_nickname"];
					$chr = $botz["cid"];
					
					echo "<h3 class='card-title' style='color: green;'>$nick</h3>";
					// if($chr === $croom){
						// echo "<button class='btn btn-success' disabled>سحب</button>\n";
					// }else{
						echo "<button type='submit' class='btn btn-success mv' name='$botid'>سحب</button>\n";
					// }
					echo "<button type='submit' class='btn btn-warning kc' name='$botid'>طرد</button>\n";
					echo "<button type='submit' class='btn btn-danger del' name='$botid'>حذف البوت</button>\n";
				}catch(Exception $e){
					$nick = $ts3->clientInfoDb($botid)["client_nickname"];
					echo "<h3 class='card-title' style='color: red;'>$nick</h3>";
					echo "<button class='btn btn-success' disabled>سحب</button>\n";
					echo "<button class='btn btn-warning' disabled>طرد</button>\n";
					echo "<button type='submit' class='btn btn-danger del' name='$botid'>حذف البوت</button>\n";
				}
				
				
				echo '</div> </div> </div>';
			}
		}else{
			echo '
			<center>
			<hr>
			<div class="col-md-6">
<div class="card text-center">
<div class="card-header">
التحكم بالبوتات
</div>
<div class="card-body">
<h3 class="text-warning text-center">ليست لديك بوتات للتحكم بهم</h3>
</div>
<div class="card-footer text-muted">
</div>
</div>
</div>
</center>
<hr>
			';
		}
		
		// if(isset($_POST["mv"])){
			// if(is_array($_POST["mv"])){
				// $botx = intval(key($_POST["mv"]));
				// if(in_array($botx, $bots)){
					// try{
						// $croom = $client_info["cid"];
						// $ts3->clientGetByDbid($botx)->move($croom);
					// }catch(Exception $e){
						
					// }
					
				// }
			// }
			// exit(header("Location: botcontrol"));
		// }else 
			// if(isset($_POST["kick"])){
			// if(is_array($_POST["kick"])){
				// $botx = intval(key($_POST["kick"]));
				// if(in_array($botx, $bots)){
					// try{
						// $ts3->clientGetByDbid($botx)->kick(TeamSpeak3::KICK_CHANNEL);
					// }catch(Exception $e){
						
					// }
					
				// }
			// }
			// exit(header("Location: botcontrol"));
		// }else if(isset($_POST["del"])){
			// if(is_array($_POST["del"])){
				// $botx = intval(key($_POST["del"]));
				// if(in_array($botx, $bots)){
					// try{
						// $ts3->serverGroupClientDel(90, $botx);
						// $ts3->serverGroupClientDel(2274, $botx);
						// $ts3->serverGroupClientDel(21, $botx);
					// }catch(Exception $e){
					
					// }
					// $sql = "DELETE FROM bots WHERE botcb='$botx' LIMIT 1;";
					// $con->query($sql);
				// }
			// }
			
		// }
	?>
	</div>
</div>
		
<?php require_once('includes/footer.php'); ?>