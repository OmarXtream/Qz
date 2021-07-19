<?php require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php'; ?>

<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
        <div class="page-wrapper">
            <div class="container-fluid">
			</br>
<?php 
	$cldbid = $client_info["client_database_id"];
// if(isset($_POST["clan"])){
	// $clan = $_POST["clan"];		
	// if(is_array($clan)){
	// if(isset($_SESSION['join_C']) and $_SESSION['join_C'] >= microtime(true)){
	// echo'
                               // <center><meta http-equiv="refresh" content="3;url=c-clans"> <div class="alert alert-danger alert-outline alert-dismissable">
                                    // <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             // <center>          <strong>عذراً! لقد قمت بالدخول هذا الكلان او الخروج منه , الرجاء المحاولة في وقت آخر</strong></center> 
                                // </div>
// ';
// die;
// }else{
	// $_SESSION['join_C'] = microtime(true)+10;
// }			
		// $clx = key($clan);
		// $sql = "SELECT sgid FROM clans";
		// $res = $con->query($sql);
		// $crx = explode(',', $client_info["client_servergroups"]);
		// $clg = array();
		// while($data = $res->fetch_assoc()){
			// $sg = $data["sgid"];
			// array_push($clg, $sg);
		// }
		// if(!in_array($clx, $clg)){
			// die("Failed Wrong Clan ID");
		// }
		
		// if(in_array($clx, $crx)){
			
			// try{
				
				// $client_info->remServerGroup($clx);
						  // echo '<center><meta http-equiv="refresh" content="3;url=c-clans"><div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
						  // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// <span aria-hidden="true">×</span>
						  // </button>
						    // <a class="alert-link" href="javascript:void(0)">تم الخروج من الكلان</a>.<br><strong>
						// </div></center>';
				// $sql = "SELECT rooms, sgid FROM clans";
				// $res = $con->query($sql);
				// while($data = $res->fetch_assoc()){
					// $sgid = $data["sgid"];
					
					// if($sgid == $clx){	
						// $rom = unserialize($data["rooms"])[1];
						// $ts3_VirtualServer->clientSetChannelGroup($cldbid, $rom, 12);
					
					// }
				// }
				
				//$ts3_VirtualServer->clientSetChannelGroup($cldbid, $rom, 12);			
			// }catch(TeamSpeak3_Exception $e){
				// header("Location: c-clans");
			// }
			
		// }else{
			
			// try{
				// foreach($clg as $cln){
					// if(in_array($cln, $crx)){
						// die("<center><meta http-equiv='refresh' content='3;url=c-clans'><div class='alert dark alert-alt alert-danger alert-dismissible' role='alert'>
						  // <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							// <span aria-hidden='true'>×</span>
						  // </button>
						    // <a class='alert-link' href='javascript:void(0)'>لأ يمكنك دخول اكثر من كلأن</a>.<br><strong> 
						// </div></center>");
					// }
				// }
				// $sql = "SELECT rooms, sgid FROM clans";
				// $res = $con->query($sql);
				// while($data = $res->fetch_assoc()){
					// $sgid = $data["sgid"];
					
					// if($sgid == $clx){	
						// $rom = unserialize($data["rooms"])[1];
						//$client_info->move($rom);
						// $client_info->addServerGroup($clx);
						// $ts3_VirtualServer->clientSetChannelGroup($cldbid, $rom, 31);

						  // echo '<center><meta http-equiv="refresh" content="3;url=c-clans"><div class="alert dark alert-alt alert-success alert-dismissible" role="alert">
						  // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// <span aria-hidden="true">×</span>
						  // </button>
						    // <a class="alert-link" href="javascript:void(0)">تم دخول الكلان بنجاح</a>.<br><strong>
						// </div></center>';
					
					// }
				// }
				
				// header("Location: c-clans");
			// }catch(TeamSpeak3_Exception $e){
				// header("Location: c-clans");
			// }
			
		// }
	
	// }
// }
	?>			
<center>
<div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">قائمه كلانات السيرفر</h4>
                                <div class="table-responsive">
                                    <table class="table color-bordered-table info-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>رقم الكلان</th>
                                                <th>أسم الكلان</th>
												<th>نقاط الكلان</th>
                                                <th>عدد أعضاء الكلان</th>
                                                <th>حاله أنضمام الكلان</th>
                                                <th>صفحه الكلان</th>
												
                                            </tr>
                                        </thead>
<?php
	$sql = "SELECT * FROM clans ORDER BY points DESC";
	$res = $con->query($sql);
	$cgrp = explode(',', $client_info["client_servergroups"]);
	$ix = 0;
	while($data = $res->fetch_assoc()){
		$ix++;
		$own = $data["owner"];
		$points = ceil($data["points"]);		
		$stat = $data["status"];		
		$cname = $data["name"];
		$sgid = $data["sgid"];
		$room = unserialize($data["rooms"]);
		$rms = $room[1];
		try{
			$block = count($ts3_VirtualServer->channelGroupClientList(27, $rms, $cldbid));
		}catch(TeamSpeak3_Exception $e){
			$block = 0;
		}
		if(in_array($sgid, $cgrp)){
			$joined = true;
		}else{
			$joined = false;
		}
		$num = $data["num"];
		try{
			$cls = count($ts3_VirtualServer->serverGroupClientList($sgid));
		}catch(TeamSpeak3_Exception $e){
			$cls = 0;
		}
		
		echo "<tr class='border-bottom-success border-custom-color'>";
		echo "<td  class='ttd'><span class='font-w300'>$ix</span></td>
		<td ><span class='font-w600'>$cname</span></td>
		<td ><span class='font-w600'><div class='badge badge-success'>$points</div></span></td>";
		echo "<td  class='ttd'><span class='font-w300'><div class='badge badge-warning'>$cls</div></span></td>";
		if($own == $cldbid){
			echo "<td  class='ttd'><div class='badge badge-danger'>صاحب الكلان</div></span></td>";
			echo "
				<td  class='ttd'>
				  
			  <a href='clanat.php?view=$num' class='btn btn-outline-info btn-rounded'>  <i class='fa fa-sign-in'></i>صفحة الكلان</a>

			</td></tr>
			";continue;
		}
$status = 1;		
		if($block > 0){
			
			echo "<td  class='ttd'><span class='badge badge-danger'>محظور من الكلان</span></td>";
			echo "
				<td  class='ttd'>

		
				  <div class='btn-group'>
				  
			  <a href='clanat.php?view=$num' class='btn btn-outline-danger btn-rounded'>  <i class='fa fa-sign-in'></i>صفحة الكلان</a>
				  </div>
			</td></tr>
			";continue;
		}else if($joined === true){
				echo "<td  class='ttd'><div class='badge badge-success'>في الكلان</div></span></td>";
			echo "
				<td  class='ttd'>

			<form action='c-clans' method='post'>
				  <div class='btn-group'>
			  <a href='clanat.php?view=$num' class='btn btn-outline-success btn-rounded'>  <i class='fa fa-sign-in'></i>صفحة الكلان</a>
				  </div>
			</form>
			
			</td></tr>
			";continue;
		}else if($stat != 0){
			echo "<td  class='ttd'><div class='badge badge-danger'>ألانضمام مغلق</div></span></td>";
			echo "
				<td  class='ttd'>

		
				  <div class='btn-group'>
				  
			  <a href='clanat.php?view=$num' class='btn btn-outline-warning btn-rounded'>  <i class='fa fa-sign-in'></i>صفحة الكلان</a>
				  </div>
			</td></tr>
			
			";continue;
        }
		echo "<td  class='ttd'><div class='badge badge-info'>متأح</div></span></td>";
		echo "
			<td  class='ttd'>

		<form action='c-clans' method='post'>
			  <div class='btn-group'>
			  <a href='clanat.php?view=$num' class='btn btn-outline-success btn-rounded'>  <i class='fa fa-sign-in'></i>صفحة الكلان</a>

			  </div>
		</form>
		
	</td>
		";
		echo "</tr>";
		
	}
?>										
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>			
			
			
			

        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>