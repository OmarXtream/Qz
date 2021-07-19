<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php require 'config/sqlconfig.php';
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
$cgrp = explode(',', $client_info["client_servergroups"]);
clan($cgrp);  ?>
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
<?php
$mdbid = $client_info["client_database_id"];
$sql = "SELECT * FROM clans";
$res = $con->query($sql);
$clans = array();
while($data = $res->fetch_assoc()){
	$name = $data["name"];
	$cid = $data["id"];
	$clans[$name] = $cid;
}

if(isset($_POST["remove"]) && isset($_POST["cgrop"])){
	
	$xc = intval($_POST["cgrop"]);
	$sql = "SELECT * FROM clans WHERE id='$xc' LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows !== 1){
		// header("Location: A-Clan");
		die("خطأ لم يتم العثور على الكلان <script> window.location = 'A-Clan.php'; </script>");
	}
	$del = false;
	$data = $res->fetch_assoc();
	$ts3_VirtualServer->serverGroupDelete($data["sgid"], true);
	$numz = $data["num"];
	$rms = unserialize($data["rooms"]);
	foreach($rms as $room){
		$ts3_VirtualServer->channelDelete($room, true);
	}
	$sql = "DELETE FROM clans WHERE id='$xc'";
	$con->query($sql);
	$del = true;
	if($del === true){
		// $sql = "SELECT * FROM clans";
		// $res = $con->query($sql);
		// while($data = $res->fetch_assoc()){
			// $id = $data["id"];
			// $num = $data["num"];
			// if($num != 0 || $num != 1){
				// $num = $num -1;
				// $sql = "UPDATE clans SET num='$num' WHERE id='$id'";
			// }
			
		// }
		
		$sql = "SELECT * FROM clans WHERE num > $numz";
		$res = $con->query($sql);
		if($res->num_rows > 0){
			while($dataz = $res->fetch_assoc()){
				$numt = $dataz["num"];
				$idx = $dataz["id"];
				if($numt != 0 || $numt != 1){
					$numt = $numt - 1;
					$sqlz = "UPDATE clans SET num='$numt' WHERE id='$idx'";
					$con->query($sqlz);
				}
			}
		}
		
	}
}else if (isset($_POST["rooms"]) && isset($_POST["cgrop"])){
	$xc = intval($_POST["cgrop"]);
	$sql = "SELECT * FROM clans WHERE id='$xc' LIMIT 1";
	$res = $con->query($sql);
	if($res->num_rows !== 1){
		// header("Location: A-Clan");
		die("خطأ لم يتم العثور على الكلان <script> window.location = 'A-Clan.php'; </script>");
	}
	$data = $res->fetch_assoc();
	$rms = unserialize($data["rooms"]);

	$ts3_VirtualServer->channelCreate(array(
	  "channel_name"          => "Room1",
	  "channel_codec"          => TeamSpeak3::CODEC_OPUS_VOICE,
	  "channel_codec_quality"  => 0x05,
	  "channel_flag_permanent" => TRUE,
	  "cpid"                  => $rms[1],
	));
	$ts3_VirtualServer->channelCreate(array(
	  "channel_name"          => "Room2",
	  "channel_codec"          => TeamSpeak3::CODEC_OPUS_VOICE,
	  "channel_codec_quality"  => 0x05,
	  "channel_flag_permanent" => TRUE,
	  "cpid"                  => $rms[1],
	));	
}else if(isset($_POST["chroom"]) && isset($_POST["dzl"]) && isset($_POST["roomc2"])){
	$clm = $_POST["dzl"];
	$clanid = $_POST["roomc2"];
	$sqlz = "SELECT rooms FROM clans WHERE id='$clanid' LIMIT 1";
	$res = $con->query($sqlz);
	$data = $res->fetch_assoc();
	$rms = unserialize($data["rooms"]);
	$sql = "UPDATE clans SET owner='$clm' WHERE id='$clanid'";
	$con->query($sql);
	try{
		$ts3_VirtualServer->clientSetChannelGroup($clm, $rms[1], 9);
		$ts3_VirtualServer->clientGetByDbid($clm)->move($rms[1]);

	}catch (TeamSpeak3_Exception $e){
		
	}	
}else if(isset($_POST["changec"]) && isset($_POST["chname"]) && isset($_POST["roomc3"])){
	$clanid = $_POST["roomc3"];
	$newname = $con->real_escape_string(htmlspecialchars(stripcslashes(strip_tags($_POST["chname"]))));
	$sqlz = "SELECT rooms, sgid FROM clans WHERE id='$clanid' LIMIT 1";
	$res = $con->query($sqlz);
	$data = $res->fetch_assoc();
	$rms = unserialize($data["rooms"]);
	$sgid = $data["sgid"];
	$rnd = mt_rand(1, 99999) * 2;
	$ts3_VirtualServer->channelGetById($rms[1])["channel_name"] = "[cspacer".$rnd."]".$newname;
	$sql = "UPDATE clans SET name='$newname' WHERE id='$clanid'";
	$ts3_VirtualServer->serverGroupRename($sgid, $newname);
	$con->query($sql);
}else if(isset($_POST["submit"]) && isset($_FILES['iconz']) && isset($_POST['roomc5'])){
	$clanid = $_POST['roomc5'];
	$upfolder = "uploads/".basename($_FILES["iconz"]["name"]);
	$imtype = pathinfo($upfolder, PATHINFO_EXTENSION);
	$check = getimagesize($_FILES["iconz"]["tmp_name"]);
	if($check === false) {      
		die("Invalid Image Type!");	
    }	
	$width = $check[0];
	$height = $check[1];
	if($width > 16 || $height > 16){
		die("Image Must Be 16x16");
	}
	
	if (file_exists($upfolder)) {
		die("Image Is Already Uploaded");
	}
	
	if ($_FILES["iconz"]["size"] > 99999999999999999) {
		die("Image Is Too Large Max 8kb.");
	}
	
	if(!$check['mime'] == 'image/png' || !$check['mime'] == 'image/gif') {
		die("You Only Can Upload Png Images!");
	}
	
	if(is_uploaded_file($_FILES["iconz"]["tmp_name"])){
        $img = file_get_contents($_FILES["iconz"]["tmp_name"]);
		try {
			$imgid = $ts3_VirtualServer->iconUpload($img);
		}catch(Exception $e) {
			$imgid = crc32($img);
		}
		$sql = "SELECT * FROM clans WHERE id='$clanid' LIMIT 1";
		$res = $con->query($sql);
		$data = $res->fetch_assoc();
		$sgid = $data["sgid"];
		$rms = unserialize($data["rooms"]);
		$icon = "i_icon_id";
		$ts3_VirtualServer->serverGroupPermAssign($sgid, $icon, $imgid, false, true);
		$tkk = $ts3_VirtualServer->channelGetById($rms[1])->subChannelList();
		foreach($tkk as $tks){
			$tks->permAssign($icon, $imgid);
		}
    } else {
        die("Error Upload Image");
    }
	header("Location: A-Clan");
}

?>
<head>
		<script>
			function getSubs(evz){
				var clanId = evz.value;
				$.ajax({   
				  url: 'config/clinet',     
				  type: 'POST',
				  data : {
					clan : clanId
				  },                  
				  success: function(data) {
					$("#dzl").children().remove();
					$("#dzl").append(data);
				  }
				});
			}
		</script>
</head>			
		<div class="row">
			<div class="col-md-6">
						<form method="post">
                <div class="card border-dark">
                  <center>  <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white">التحكم بالكلانات</h4>
					</div> </center> 
                    <div class="card-body">
						<br>
						<br>
						<br>
					<center><select name="cgrop" class="form-control" style="width: 50%; height:40px;"> 
						<option value="Choose">اختر كلان...</option>
			<?php
				foreach($clans as $cname => $ciz){
					echo "<option value='$ciz'>$cname</option>";
				}
			?>	</select>
					</center></div><br>
					<center>
					<div class="col-md-6">
                      <span class="badge bg-warning"><b>لأ يمكنك الارجاع علي الحذف برجاء التاكيد قبل الحذف</b></span>
                    </div>
					</center>
					<br>
					<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
                      <button type="submit" name="remove" class="btn btn-rounded btn-block btn-outline-danger">حذف</button>
                    </div>
					<div class="col-md-4">
                      <button type="submit" name="rooms"  class="btn btn-rounded btn-block btn-outline-success">أضافه رومين</button>
                    </div>
                    </div>
					<br> </form>
                </div>
            </div>
			                  

			
			<div class="col-md-6">
                <div class="card border-dark">
                  <center>  <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white">رفع ايقونة للكلان</h4>
					</div> </center> 
                    <div class="card-body">
						<br>
						<br><form action="A-Clan" method="post" enctype="multipart/form-data">			
					<center><select name="roomc5" id="group" name="time" class="form-control" style="width: 50%; height:40px;">
			<option value="Choose">اختر كلان...</option>
	<?php
				foreach($clans as $cname => $ciz){
					echo "<option value='$ciz'>$cname</option>";
				}
			?>	</select>
						<br>
						<br><input type="file" name="iconz"><br/>
						</center> </div>
					<br><br>
					<center><div class="col-md-4">
                      <button name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-success">رفع الأيقونة</button>
                    </div></center>
					<br>
					</form>
                </div>
            </div>
			
			<div class="col-md-6">
					<div class="card border-dark">
                  <center>  <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white">تغير اونر الكلان</h4>
					</div> </center> 
                    <div class="card-body">
						<br><br>
				<form method="post">						
						<center><h5>يمكنك تغير الأونر من هنا ..</h5>
						<h5>*برجاء اختيار الكلان الصحيح</h5></center>
						<br>	<br>						
						<center><select name="roomc2" onchange="getSubs(this)"  class="form-control" style="width: 50%; height:40px;">
			<option value="Choose">اختر كلان...</option>
			<?php
				foreach($clans as $cname => $ciz){
					echo "<option value='$ciz'>$cname</option>";
				}
			?>					</select><br><br>
		<select name="dzl" id="dzl" class="form-control" style="width: 50%; height:40px;">
			</select>&nbsp;</center>
                    </div><br><br>
					<center><div class="col-md-4">
                      <button  type="submit" name="chroom"  class="btn btn-rounded btn-block btn-outline-success">تغير الأونر</button>
                    </div></center>
					<br></form>
                </div>
            </div>
			
			<div class="col-md-6">
                <div class="card border-dark">
                  <center>  <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white">تغير اسم الكلان</h4>
					</div> </center> 
                    <div class="card-body">
						<br><br>
						<center><h5>يمكنك تغير أسم الكلان من هنا ..</h5>
						<h5>*برجاء اختيار الكلان الصحيح</h5></center>
						<br><br>
												<form action="A-Clan" method="post">						

					<center><select name="roomc3" id="group" name="time" class="form-control" style="width: 50%; height:40px;">
								<option value="Choose">اختر كلان...</option>
						<?php
						foreach($clans as $cname => $ciz){
						echo "<option value='$ciz'>$cname</option>";
						}
						?>
							</select>
							<br>
							<br>
							<input class="form-control" style="width: 50%; height:40px;" type="text" name="chname" placeholder="اسم الكلان الجديد ..">
					</center>	
                    </div>
					<br>
					<br>
					<center><div class="col-md-4">
                      <button type="submit" name="changec" class="btn btn-rounded btn-block btn-outline-success">تغير الأسم</button>
                    </div></center>
					<br> </form>
                </div>
            </div>
			
			

			
        </div>
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>