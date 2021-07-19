<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<?php ob_start(); require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>


        <div class="page-wrapper">
            <div class="container-fluid">
<?php
	 if(!isset($_GET["view"]) || empty($_GET["view"]) || !is_numeric($_GET["view"])){
		 exit(header("Location: c-clans"));
		}else{
		   $cnum = intval($_GET["view"]);
		   $sql = "SELECT * FROM clans WHERE num='$cnum'";
		   $res = $con->query($sql);
		   $cgrp = explode(',', $client_info["client_servergroups"]);
		  if($res->num_rows === 1){
			$data = $res->fetch_assoc();
			try {
				
				$stat = $data["status"];
				$banner = $data["banner"];
				$adv = $data["adv"];
				$updates = $data["updates"];
				$rules = $data["rules"];
				$g1 = $data["g1"];	
				$g2 = $data["g2"];	
				$g3 = $data["g3"];					
				$owner = intval($data["owner"]);
				$points = ceil($data["points"]);
				$name = strval($data["name"]);
				$sgid = intval($data["sgid"]);
				$num = intval($data["num"]);
				$room = unserialize($data["rooms"]);
				$car = $ts3->serverGroupClientList($sgid);
				$own = $ts3->clientInfoDb($owner)["client_nickname"];
				$online = array();
				foreach($car as $cl){
					try {
						$dbz = $cl["cldbid"];
						$clz = $ts3->clientGetByDbid($dbz);
						if($clz == NULL){ continue; }
						array_push($online, $dbz);
					}catch(Exception $e){  }
				}
				$on = count($online);
					$rms = $room[1];
					try{
						$block = count($ts3->channelGroupClientList($Cantjoinclan, $rms, $client_info["client_database_id"]));
					}catch(TeamSpeak3_Exception $e){
						$block = 0;
					}
				
			}catch(Exception $e){  }
		}else{
			exit(header("Location: c-clans"));
		}
	 }
	$cldbid = $client_info["client_database_id"];
if(isset($_POST["clan"])){
	$clan = $_POST["clan"];		
	if(is_array($clan)){
	if(isset($_SESSION['join_C']) && $_SESSION['join_C'] >= microtime(true)){
die('<script>
           swal({title: "عذراً",text: "! لقد قمت بالدخول هذا الكلان او الخروج منه , الرجاء المحاولة في وقت آخر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}else {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}})</script>');		
}else{
	$_SESSION['join_C'] = microtime(true)+10;
}			
		$clx = key($clan);
		$sql = "SELECT sgid FROM clans";
		$res = $con->query($sql);
		$crx = explode(',', $client_info["client_servergroups"]);
		$clg = array();
		while($data = $res->fetch_assoc()){
			$sg = $data["sgid"];
			array_push($clg, $sg);
		}
		if(!in_array($clx, $clg)){
			die("Failed Wrong Clan ID");
		}
		
		if(in_array($clx, $crx)){
			
			try{
				
				$client_info->remServerGroup($clx);
echo('<script>
           swal({title: "الخروج من الكلان",text: "تم الخروج من الكلان",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}else {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}})</script>');
				$sql = "SELECT rooms, sgid FROM clans";
				$res = $con->query($sql);
				while($data = $res->fetch_assoc()){
					$sgid = $data["sgid"];
					
					if($sgid == $clx){	
						$rom = unserialize($data["rooms"])[1];
						$cgrp = end($ts3_VirtualServer->channelGroupClientList(null, $rom, $cldbid))["cgid"];
						if($cgrp == 27){
							$blocked = true;
						}else{
							$ts3_VirtualServer->clientSetChannelGroup($cldbid, $rom, $laveclan);
						}
					}
				}
				
				// $ts3_VirtualServer->clientSetChannelGroup($cldbid, $rom, $laveclan);			
			}catch(TeamSpeak3_Exception $e){
			//	header("Location: c-clans");
			}
			
		}else{
			
			try{
				foreach($clg as $cln){
					if(in_array($cln, $crx)){
						die('<script>
           swal({title: "خطا",text: "لأ يمكنك دخول اكثر من كلان",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}else {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}})</script>');
					}
				}
				$sql = "SELECT rooms, sgid FROM clans";
				$res = $con->query($sql);
				while($data = $res->fetch_assoc()){
					$sgid = $data["sgid"];
					
					if($sgid == $clx){	
						$rom = unserialize($data["rooms"])[1];
						$client_info->move($rom);
						$client_info->addServerGroup($clx);
						$ts3->clientSetChannelGroup($cldbid, $rom, $clanjoingroup);
echo('<script>
           swal({title: "انضمام الكلان",text: "تم دخول الكلان بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}else {window.location.replace("https://panel.q-z.us/clanat?view='. $cnum .'");}})</script>');
					
					}
				}
				
			//	header("Location: c-clans");
			}catch(TeamSpeak3_Exception $e){
				//header("Location: c-clans");
				// var_dump($e);
				// die;
			}
			
		}
	
	}
}
?>			
			</br>
						<div class="card text-center">
                         <img class="card-img" src="<?php echo $banner; ?>" height="200" alt="Card image">
                            <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                              <div class="pt-50 pb-20"></br></br></br>
                                <h1 class="font-w700 text-white mb-10 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp"><?php echo $name; ?></h1>
                                <h2 class="h4 font-w400 text-white-op js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp"><?php echo  $adv; ?> </h2>
							  </div>
                            </div>

                        </div>	
<center>						
<div class="card w-80">
<div class="block">
<div class="block-content">
<div class="block">
<div class="block-content">
<table class="table table-vcenter">
<tbody>
</tbody><tbody>
<tr>
<td>صاحب الكلان </td>
<td class="d-none d-sm-table-cell">
<span class="badge badge-danger"><?php echo $own ?></span>
</td>
</tr>
<tr>
<td>عدد النقاط</td>
<td class="d-none d-sm-table-cell">
<span class="badge badge-primary"><?php echo $points ?></span>
</td>
</tr>
<tr>
<td>الأعضاء المتصلين</td>
<td class="d-none d-sm-table-cell">
<span class="badge badge-info"><?php echo $on; ?></span>
</td>
</tr>
<tr>
<td>عدد الأعضاء</td>
<td class="d-none d-sm-table-cell">
<span class="badge badge-info"><?php echo count($car); ?></span>
</td>
</tr>
<tr>
<td>ترتيب الكلان علي السيرفر</td>
<td class="d-none d-sm-table-cell">
<span class="badge badge-warning"><?php echo $num; ?></span>
</td>
</tr>
<tr>

</tr>
<tr>
<td>حاله الانضمام</td>
<td class="d-none d-sm-table-cell">
<?php 
		if($block > 0){
			
			echo '<div class="badge badge-danger">محظور من الانضمام</div>';
		}else if($joined === true){
				echo '<div class="badge badge-success">في الكلان</div>';
		}else if($stat != 0){
			echo '<div class="badge badge-warning">الانضمام مغلق</div>';
        }else 
			echo '<div class="badge badge-info">متأح</div>';
?>
</tr>
<tr>
<td>للأنضمام</td>
<td class="d-none d-sm-table-cell">
										<form method="post" action="clanat?view=<?php echo $cnum; ?>">
											<!--
											<button type="button" class="btn btn-outline-success min-width-125">أنضمام</button>                                        
											<button type="button" class="btn btn-outline-danger min-width-125">خروج</button>	-->
											<?php
											$status = 1;		
												if($dbid == $owner){
													echo "<a href='c-control.php' class='btn btn-outline-danger min-width-125'>التحكم فى الكلان</a>";
												}else if(in_array($sgid, $cgrp)){
													echo "<button type='submit' name='clan[$sgid]' class='btn btn-outline-danger min-width-125'>خروج</button>";
												}else if($block > 0){
													echo "<button type='button' class='btn btn-outline-danger min-width-125 disabled' disabled>محظور</button>";
												}else if($stat != 0){
													echo "<button type='button' class='btn btn-outline-warning min-width-125 disabled' disabled>الانضمام مغلق</button>";
												}else{
													echo "<button type='submit' name='clan[$sgid]' class='btn btn-outline-success min-width-125'>دخول</button>";
												}
											?>
                                        </form>
</td></tr>
 

</tbody>
</table>
</div>
</div>
</div>
</div>
                        </div>			
			</center>
<center>
<div class="row">
<div class="col-md-3">
                        <div class="card border-danger">
                            <div class="card-header bg-danger">
                                <h4 class="m-b-0 text-white">ألعاب الكلان</h4></div>
									<div class="card-body">
                                    <p><?php echo $g1; ?></p>
                                    <p><?php echo $g2; ?></p>
                                    <p><?php echo $g3; ?></p>
									</div>
                        </div>
                    </div>
<div class="col-md-9">
                        <div class="card border-success">
                            <div class="card-header bg-success">
                                <h4 class="m-b-0 text-white">قوانين واحكام الكلان</h4></div>
                            <div class="card-body">
                                    <p><?php echo $rules; ?></p>

                            </div>
                        </div>
                    </div>
<div class="col-md-12">
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">أخبار وتحديثات الكلان</h4></div>
                            <div class="card-body">
                                    <p><?php echo $updates; ?></p>
                            </div>
                        </div>
                    </div></div> 
<center>
<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">اعضاء الكلان</h4>
                                <div class="table-responsive">
                                    <table class="table color-table info-table">
                                        <thead>
                                            <tr>
                                        <th >#</th>
                                        <th >الاسم</th>
                                        <th >رتبته فالكلان</th>
                                        <th >اللفل </th>
                                        <th >الحاله </th>
                                            </tr>
                                        </thead>
											<?php
											$i = 0;
												foreach($car as $clz){
													
													try{
														$dbx = $clz["cldbid"];
														$nick = htmlspecialchars($ts3->clientInfoDb($dbx)["client_nickname"]);
														$cgrp = end($ts3->channelGroupClientList(null, $rms, $dbx))["cgid"];
														$cgrpz = $ts3->channelGroupGetById($cgrp)["name"];
														$sql = "SELECT grpid FROM user WHERE cldbid='$dbx' LIMIT 1";
														$res = $con->query($sql);
														if($res->num_rows > 0){
															$grp = intval($res->fetch_assoc()["grpid"]);
														}else{
															$lvl = "LvL-0";
														}
														$lvl = $ts3->serverGroupGetById($grp)["name"];
														$stat = "<b class='text-danger'>غير متصل</b>";
														if(in_array($dbx, $online)){
															$stat = "<b class='text-success'>متصل</b>";
														}
														//$sgg = $ts3->clientInfoDb($dbx)["client_servergroups"];
														$i++;
														echo "<tr> <td>$i</td> <td>$nick</td> <td>$cgrpz</td> <td>$lvl</td> <td>$stat</td></tr>";
													}catch(TeamSpeak3_Exception $e){
														continue;
													}
												}
											?>										
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</center>		

        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>