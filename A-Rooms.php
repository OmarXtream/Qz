<?php require 'config/phphead.php'; ?>

<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
require 'config/sqlconfig.php';
ini_set("default_charset", 'utf-8');
?>
<?php 
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>
        <div class="page-wrapper">
        <div class="container-fluid">
			<?php 
$cgrp = explode(',', $client_info["client_servergroups"]);
room($cgrp);  ?>
		</br>
	<?php
		// شيك الادمنية هنا قبل ما يسوى الاوامر
		if(isset($_POST["del"])){
			if(is_array($_POST["del"])){
				$rdel = intval(key($_POST["del"]));
				$sql = "SELECT blocked FROM roomz WHERE room='$rdel' LIMIT 1";
				$blocked = $con->query($sql)->fetch_assoc()["blocked"];
				if($blocked == 0){
					$sql = "DELETE FROM roomz WHERE room='$rdel' LIMIT 1";
					$con->query($sql);
				}
				try{
					$ts3->channelDelete($rdel, true);
					// اعادة توجية
				}catch(Exception $e) {
		  
				}
			}echo('<script>
           swal({title: "تم",text: "الحذف بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
		}else if(isset($_POST["ublock"])){
			if(is_array($_POST["ublock"])){
				try{
					$user = intval(key($_POST["ublock"]));
					$sql = "SELECT room FROM roomz WHERE owner='$user' LIMIT 1";
					$data = $con->query($sql)->fetch_assoc();
					$roomx = $data["room"];	
					$ts3->channelDelete($roomx, true);
					$ts3->serverGroupClientAdd(1433, $user);
					$sql = "UPDATE roomz SET blocked='1' WHERE owner='$user' LIMIT 1";
					$con->query($sql);
					// اعادة توجية
				}catch(Exception $e) {
		  
				}
			}echo('<script>
           swal({title: "تم",text: "الحظر بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
		}else if(isset($_POST["nblock"])){
			if(is_array($_POST["nblock"])){
				$nblock = intval(key($_POST["nblock"]));
				try{
					$sql = "DELETE FROM roomz WHERE owner='$nblock' LIMIT 1";
					$con->query($sql);
					$ts3->serverGroupClientDel(1433, $nblock);
					// اعادة توجية
				}catch(Exception $e) {
		  
				}			
			} 	echo('<script>
           swal({title: "تم",text: "فك الحظر",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
		}
		
	?>		
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> قائمه رومات السيرفر </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>أسم الروم</th>
                                                <th>أخر تفاعل</th>
                                                <th>النقاط</th>
                                                <th>مالك الروم</th>
                                                <th>داتا بيس</th>
                                                <th>حذف الروم نهائي</th>
                                                <th>حظر من أنشاء الرومات</th>
                                                <th>فك الحضر</th>
                                            </tr>
                                        </thead>
<tbody>

<?php

$sql = "SELECT * FROM roomz ORDER BY points DESC LIMIT 100";
$res = $con->query($sql);

function ago($mtime){
	$xtime = $mtime;

	if ($xtime < 1)
	{
		return '0 ثوانى';
	}

	$a = array( 12 * 30 * 24 * 60 * 60  =>  'سنة',
				30 * 24 * 60 * 60       =>  'شهر',
				24 * 60 * 60            =>  'يوم',
				60 * 60                 =>  'ساعة',
				60                      =>  'دقيقة',
				1                       =>  'ثانية'
				);

	foreach ($a as $secs => $str){
		$d = $xtime / $secs;
		if ($d >= 1)
		{
			$r = round($d);
			return $r . ' ' . $str . ($r > 1 ? '' : '');
		}
	}
}

if($res->num_rows > 0){
	while($data = $res->fetch_assoc()){
		$roomid = $data["room"];
		$idz = $data["id"];
		$owner = $data["owner"];
		$blocked = intval($data["blocked"]);
		$points = ceil(intval($data["points"]));
		try{
			$ownernick = $ts3->clientInfoDb($owner)["client_nickname"];
			if($blocked === 0){
				$roomnick = $ts3->channelGetById($roomid)["channel_name"];			
				$lastact = $ts3->channelGetById($roomid)["seconds_empty"];
				if($lastact <= 0){
					$lastact = "الأن";
				}else if($lastact <= 60){
					$lastact = $lastact." ثوانى";
				}else{
					$lastact = ago($lastact);
				}
			}else{
				$roomnick = "<div class='badge badge-danger'>محظور بالفعل</div>";
				$lastact = "<div class='badge badge-danger'>محظور بالفعل</div>";
			}
		}catch(Exception $e) {
		  
		}
		echo "<tr class='info'> <td>$roomnick</td> <td>$lastact</td> <td>$points</td>  <td>$ownernick</td><td>$owner</td>";
		echo "<td><form method='post'><button type='submit' name='del[$roomid]' class='btn btn-warning btn-danger'>حذف</button></form></td>";
		//if($ts3->channelGetById($roomid))
		$sgz = array_keys($ts3->clientGetServerGroupsByDbid($owner));
		if(!in_array(1433, $sgz)){
			echo "<td><form method='post'><button type='submit' name='ublock[$owner]' class='btn btn-warning btn-warning'>حظر</button></form></td> <td class='text-success'>غير محظور</td>";
		}else { 
			echo "<td class='text-warning text-center' style='width: 1px;'><div class='badge badge-danger'>محظور بالفعل</div></td> <td><form method='post'><button type='submit' name='nblock[$owner]' class='btn btn-success'>فك الحظر</button></form></td>"; 
		}
		echo "</tr>";
	}
}else{
	echo "<tr class='mute'><td>- - - -</td><td>- - - -</td><td>- - - -</td><td>- - - -</td><td>- - - -</td><td>- - - -</td><td>- - - -</td></tr>";
}
?>				 
</tbody>																	
                                    </table>
                                </div>
                        </div>
					 </div>
                    </div>
		
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>