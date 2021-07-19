<?php
die();
require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
        <div class="page-wrapper">
        <div class="container-fluid">
<?php
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);	
    echo '<base href="https://panel.q-z.us/profile.php">';
	
	
    if( isset($_GET['id'])){
        try {
            $info = $ts3_VirtualServer->clientInfoDb(getUserNameDBID (htmlspecialchars($_GET['id'])) );

            $profile_name = htmlspecialchars($info['client_nickname']);
			$dbid = $info['client_database_id'];
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
			$sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
			$SQLInfo = $smt->fetchAll();
			if(strval($SQLInfo[0]['accounts_privacy']) === "false"){
					die ('<script>
				   swal({
					title: "خطا",
					text: "هذا البروفايل مقفل",
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
			}
			
            $profile_description = htmlspecialchars($info['client_description']);
            $profile_uid = $info['client_unique_identifier'];
            $profile_avatar = 'https://panel.q-z.us/Rank/avatars/'.$info['client_base64HashClientUID'].'.png';
            if ( file_exists($profile_avatar) ){
                $profile_avatar = "assets/images/nophoto.jpeg";
            }
            $profile_total = $info['client_totalconnections'];
            $profile_dbid = $info['client_database_id'];

            $dbname2 = 'Rankqz';
			
			$profile_dbid = htmlspecialchars(stripslashes(strip_tags($profile_dbid)));
            $searchstring = 'WHERE cldbid LIKE \'%'.$profile_dbid.'%\'';
			$sql = "SELECT * FROM $dbname2.user WHERE cldbid LIKE ?";
            $smt = $mysqlcon->prepare($sql);
			$smt->execute(array("%".$profile_dbid."%"));
            $run = $smt->fetchAll();
            foreach ( $run as $db_client){
                if ( $db_client['uuid'] == $profile_uid ){ 
                    $profile_groups = explode(",", $db_client['cldgroup']);
                    break;
                }
            }

            $config = $mysqlcon->query("SELECT * FROM $dbname2.config");
            $config = $config->fetchAll();

            if(empty($config[0]['grouptime'])) {
                $grouptime = null;
            } else {
                $grouptimearr = explode(',', $config[0]['grouptime']);
                foreach ($grouptimearr as $entry) {
                    list($key, $value) = explode('=>', $entry);
                    $grouptime[$key] = $value;
                }
            }


            if ($substridle == 1) {
              $activetime = $run[0]['count'] - $run[0]['idle'];
            } else {
              $activetime = $run[0]['count'];
            }

            krsort($grouptime);

            foreach ($grouptime as $time => $groupid) {
              // $grpcount++;
              $actualgrp = $time;
              if ($activetime > $time) {
                break;
              } else {
                $nextup = $time - $activetime;
                $nextgrp = $time;
              }
            }
            if($actualgrp==$nextgrp) {
              $actualgrp = 0;
            }
            if($activetime>$nextgrp) {
              $percentage_rankup = 100;
            } else {
              $takedtime = $activetime - $actualgrp;
              $neededtime = $nextgrp - $actualgrp;
              $percentage_rankup = round($takedtime/$neededtime*100);
            }
            if ( $percentage_rankup > 100 ){
                $percentage_rankup = 100;
            }elseif ($percentage_rankup < 0) {
                $percentage_rankup = 100;
            }


            $profile_level = 'N/A';
                
            foreach($LEVELS_ARRAY as $LEVEL=>$LEVEL_iD){
                if(in_array($LEVEL_iD,$profile_groups)){
                    $profile_level = $LEVEL;
                };
            }

            $profile_level_id = '171';
                
            foreach($LEVELS_ARRAY as $LEVEL=>$LEVEL_iD){
                if(in_array($LEVEL_iD,$profile_groups)){
                    $profile_level_id = $LEVEL_iD;
                };
            }

            $profile_prestige = '0';
                
            foreach($PRESTIGE_ARRAY as $PRESTIGE=>$PRESTIGE_ID){
                if(in_array($PRESTIGE_ID,$profile_groups)){
                    $profile_prestige = $PRESTIGE + 1;
                };
            }
            if(isset($_POST['comment-textarea']) & !empty($_POST['comment-textarea']) ){
				
				if(strlen($_POST['comment-textarea']) >= 1024){
					die('<script>
				   swal({
					title: "دز امها بس",
					text: "مسوي ذكي ؟ اقول ضف وجهك الكلام فل ياحلو",
					type: "error",
					allowOutsideClick: false,
					allowEscapeKey: false,
					showCloseButton: false,
					confirmButtonText: "حسنأ",
				  })
				   </script>');
				}
				
				// DELETE FROM `Profile_Comments` WHERE Comment_ID='2'
                if($_SESSION['last_comment_send'] > time() - 50){
                      echo '<script type="text/javascript">';
                      echo 'setTimeout(function () { swal("إنتظر قليلاً","يجب عليك الإنتظار 50 ثانيه قبل أنت تضع تعليق جديد !","error");';
                      echo '}, 1000);</script>';
                }else
				{
                    $cloud_pc_con = $cloud_sql->prepare("INSERT INTO $dbname.Profile_Comments (`Comment_ID`,`Commenter_UID`, `Commented_UID`, `Comment`, `Likes`, `Dislikes`, `Comment_Date`,`status`) 
                            VALUES ( :Comment_ID,:Commenter_UID, :Commented_UID, :Comment, :Likes, :Dislikes, :Comment_Date, :status )");
                    $count_cmts = $cloud_sql->query("SELECT * FROM $dbname.Profile_Comments")->fetchAll();
                    $cloud_pc_con->bindValue(':Comment_ID', sizeof($count_cmts) + 1 );
                    $cloud_pc_con->bindValue(':Commenter_UID', $client_verified['client_unique_identifier']);
                    $cloud_pc_con->bindValue(':Commented_UID', $profile_uid);
                    $cloud_pc_con->bindValue(':Comment', $_POST['comment-textarea']);
                    $cloud_pc_con->bindValue(':Likes', 0);
                    $cloud_pc_con->bindValue(':Dislikes', 0);
                    $cloud_pc_con->bindValue(':Comment_Date', date("Y-m-d H:i:s"));
                    $cloud_pc_con->bindValue(':status', 0);
                    $cloud_pc_con->execute();

                    $_SESSION['last_comment_send'] = time();
                }
            }			
        }catch (TeamSpeak3_Exception $e ){
        echo '<br><br><br><br><br>
		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-primary ">
                               <center> <h4 class="m-b-0 text-white">خطاء هذا المٌعرف غير موجود</h4> </center>
								</div>
        <div class="content bg-white text-center pulldown overflow-hidden">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-3">
                    <!-- Error Titles -->
                    <h1 class="font-s128 font-w300 text-modern animated zoomInDown">404</h1>
                    <h2 class="h3 font-w300 push-50 animated fadeInUp">هذا المٌعرف غير موجود</h2>
                    <!-- END Error Titles -->

                </div>
            </div>
											<hr>

							</div>
						</div>
			</div> </center></div></div></div></div></div></div></div></div></div></div></div></div></div>';
			
			require_once('includes/footer.php');
		die;
        }
    }else{
        echo '<br><br><br><br><br>
		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-primary ">
                               <center> <h4 class="m-b-0 text-white">خطاء هذا المٌعرف غير موجود</h4> </center>
								</div>
        <div class="content bg-white text-center pulldown overflow-hidden">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-3">
                    <!-- Error Titles -->
                    <h1 class="font-s128 font-w300 text-modern animated zoomInDown">404</h1>
                    <h2 class="h3 font-w300 push-50 animated fadeInUp">هذا المٌعرف غير موجود</h2>
                    <!-- END Error Titles -->

                </div>
            </div>
											<hr>

							</div>
						</div>
			</div> </center></div></div></div></div></div></div></div></div></div></div></div></div></div>';
			
			require_once('includes/footer.php');
		die;
    }
?>		
		</br>
        <script type="text/javascript"> 
            var myname = "<?php echo htmlspecialchars ( $profile_name ); ?>";
            document.title = ''+ myname +' | Qz Network'; 
        </script>
        <style type="text/css">

        .terminal {
            color: #00fd55;
            letter-spacing: 2px;
        }

        .terminal::before {
            content: ">";
            margin-right: 10px;
        }
        </style>

    <link href='https://fonts.googleapis.com/css?family=Orbitron:900' rel='stylesheet' type='text/css'>

                <div class="content content-boxed">
                    <div class="block">

                        <?php 
                            if ( isset ( getDBIDSettings($profile_dbid)['age'] ) ) {
                                $profile_age = getDBIDSettings($profile_dbid)['age'];
                            }else{
                                $profile_age = 'لم يتم التحديد الي الان';
                            }
                        ?>
                        <?php 
                            if ( isset ( getDBIDSettings($profile_dbid)['na'] ) ) {
                                $profile_na = getDBIDSettings($profile_dbid)['na'];
                            }else{
                                $profile_na = 'لم يتم التحديد الي الان';
                            }
                        ?>
                        <?php 
                            if ( isset ( getDBIDSettings($profile_dbid)['topic'] ) ) {
                                $profile_topic = getDBIDSettings($profile_dbid)['topic'];
                            }else{
                                $profile_topic = 'لم يتم التحديد الي الان';
                            }
                        ?>						
                        <?php 
                            if ( isset ( getDBIDSettings($profile_dbid)['background'] ) ) {
                                $profile_wallpaper = getDBIDSettings($profile_dbid)['background'];
                            }else{
                                $profile_wallpaper = 'https://www.fibozachi.com/images/elite-trader-package-slide-background.jpeg';
                            }
                        ?>						
                        <style type="text/css">.demo4 {
                            height: 13px;
                            width: 13px;
                            padding: 0;
                            background-color: transparent;
                            position: relative;
                        }
                        .w3-border {
                            border: 1px solid #ccc !important;
                        }
                        .w3-badge {
                            border-radius: 50%;
                        }
                        .w3-white, .w3-hover-white:hover {
                            color: #000 !important;
                        }
                        .w3-white, .w3-hover-white:hover {
                            color: #000 !important;
                        }

                        .inner-circle {
                            position: absolute;
                            background: #fff;
                            border-radius: 50%;
                            height: 9px;
                            width: 9px;
                            /* top: 50%; */
                            /* left: 50%; */
                            margin: -4px 0px 0px 1px;
                        }
                        </style>
		
			<div class="col-md-12">
                        <div class="card"> <img class="card-img" src="<?php echo $profile_wallpaper; ?>" height="250" alt="Card image">
                            <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                                <div class="align-self-center"> <?php echo '<img class="img-circle" src="'.$profile_avatar.'" alt="" width="100" height="100">'; ?>
                                    <br>
                                    <br>								
									<h4 class="card-title">
									<?php
                                            if ( $profile_uid == 'rLsT0G5kuzvnsftf0jS39LVZUTY=' or $profile_uid == 'V/WqIa+l/VOPo0eivWN6VFtA/Z8=' or $profile_uid == 'vlrseRf0ZrTGnCyPI1zSychG/Tc=' or $profile_uid == 'CUQTzCzzIWAbKhGn6WFzNHEjIhY=' or $profile_uid == '48J0S2sMHEQAt9QNNrLuk2hnzzs=' ) {
                                                echo '<div class="terminal"></div>';
                                            }else{
                                                echo htmlspecialchars($profile_name);
                                            }

                                        ?></h4>
                                    <h6 class="card-subtitle"><?php echo htmlspecialchars($profile_description); ?></h6>
									<h3 class="h6 text-gray"> <?php echo '<img src="https://panel.q-z.us/Rank/icons/'.$profile_level_id.'.png">'; ?>  : Level  </h3>
									<h3 class="h6 text-gray">  <?php echo $profile_prestige; ?>  : Prestige   </h3>
								</div>

                            </div>
                        </div>
            </div>

			<br>
			<div class="row">
			
			<div class="col-md-4">
                <div class="card border-success">
                    <center><div class="card-header bg-success">
                                <h4 class="m-b-0 text-white"><?php echo htmlspecialchars ( $profile_name ); ?> : STATS</h4>
							</div></center>
                            <div class="card-body">
                               <center> <h3 class="card-title">Qz Ranking</h3> </center>
								<div class="card-header">
									<div class="text-center text-muted">
										<div class="animated fadeInUp" style="direction: initial;">
									<?php
                                            if ( $profile_uid == 'rLsT0G5kuzvnsftf0jS39LVZUTY=' or $profile_uid == '' ) {
                                                echo '
												<img src="https://i.imgur.com/EhvUiVP.gif" data-toggle="tooltip" title="" data-original-title="Qz">
												
												<img src="https://panel.q-z.us/Rank/icons/1351.png" data-toggle="tooltip" title="" data-original-title="kING">
												<img src="https://panel.q-z.us/Rank/icons/1119.png" data-toggle="tooltip" title="" data-original-title="M"></i>
												<img src="https://panel.q-z.us/Rank/icons/1120.png" data-toggle="tooltip" title="" data-original-title="A">
												<img src="https://panel.q-z.us/Rank/icons/1121.png" data-toggle="tooltip" title="" data-original-title="7">
												<img src="https://panel.q-z.us/Rank/icons/1122.png" data-toggle="tooltip" title="" data-original-title="M">
												<img src="https://panel.q-z.us/Rank/icons/1123.png" data-toggle="tooltip" title="" data-original-title="O">
												<img src="https://panel.q-z.us/Rank/icons/1125.png" data-toggle="tooltip" title="" data-original-title="U">
												<img src="https://panel.q-z.us/Rank/icons/1124.png" data-toggle="tooltip" title="" data-original-title="D">
												<img src="https://panel.q-z.us/Rank/icons/1353.png" data-toggle="tooltip" title="" data-original-title="Qz">
																								
												';
                                            }

                                        ?>
										<?php
                                            if ( $profile_uid == 'V/WqIa+l/VOPo0eivWN6VFtA/Z8=' or $profile_uid == '' ) {
                                                echo '
												<img src="https://panel.q-z.us/Rank/icons/1351.png" data-toggle="tooltip" title="" data-original-title="kING">
												<img src="https://panel.q-z.us/Rank/icons/o.png" data-toggle="tooltip" title="" data-original-title="O"></i>
												<img src="https://panel.q-z.us/Rank/icons/s.png" data-toggle="tooltip" title="" data-original-title="S">
												<img src="https://panel.q-z.us/Rank/icons/A.png" data-toggle="tooltip" title="" data-original-title="A">
												<img src="https://panel.q-z.us/Rank/icons/M.png" data-toggle="tooltip" title="" data-original-title="M">
												<img src="https://panel.q-z.us/Rank/icons/A.png" data-toggle="tooltip" title="" data-original-title="A">
												<img src="https://panel.q-z.us/Rank/icons/1353.png" data-toggle="tooltip" title="" data-original-title="Qz">
																								
												';
                                            }

                                        ?>
												<?php
												
                                                    if(in_array(10,$profile_groups)){
                                                        echo '
														<p><img src="https://panel.q-z.us/Rank/icons/servericon.png" data-toggle="tooltip" title="" data-original-title=" ●⌠ Qz / President ⌡● ">
														';
                                                    }elseif(in_array(901,$profile_groups) ){ 
                                                        echo '<img src="https://panel.q-z.us/Rank/icons/servericon.png" data-toggle="tooltip" title="" data-original-title="» ⌠ Qz - Developer ⌡"></i>';
                                                    }elseif(in_array(1048,$profile_groups) ){ 
                                                        echo '<img src="https://panel.q-z.us/Rank/icons/1048.png" data-toggle="tooltip" title="" data-original-title=" » ⌠ Qz - Developer ⌡"></i>';
                                                    }elseif(in_array(709,$profile_groups) ){ 
                                                        echo '<i class="fa fa-star text-warning" data-toggle="tooltip" title="" data-original-title=" » ⌠ Qz - Army ⌡"></i>';
                                                    }elseif(in_array(35,$profile_groups) ){ 
                                                        echo '<i class="fa fa-star text-warning" data-toggle="tooltip" title="" data-original-title=" » ⌠ Qz - Special Agent ⌡"></i>';
                                                    }else{
                                                        echo 'Qz Member';
                                                    }
                                                ?>										</div>
									</div>
								</div>
							<div class="card-body">
								<center><h3 class="card-title">Nextup</h3></center>
								<br>
								<center>
							<div class="chart easy-pie-chart-1" data-percent="<?php echo $percentage_rankup; ?>"> <span><?php echo '<img class="img-circle" src="'.$profile_avatar.'" alt="" width="100" height="100">'; ?></span> <canvas height="125" width="125" style="height: 100px; width: 100px;"></canvas></div></center>								
								<center><h3 class="card-title"><i class="fa fa-level-up text-success"></i><?php echo $percentage_rankup; ?>%</h3></center>
<div class="progress m-t-20">
                                    <div class="progress-bar bg-success" style="width: <?php echo $percentage_rankup; ?>%; height:15px;" role="progressbar"><?php echo $percentage_rankup; ?>%</div>
                                </div>
								<br>
					<div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Total Connections">
                                <div class="p-10 bg-inverse">
                                    <h3 class="text-white box m-b-0"><i class="fa fa-plug"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0"><?php echo $client_verified['client_totalconnections']; ?></h3>
                                    <h5 class="text-muted m-b-0"></h5></div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Coins">
                                <div class="p-10 bg-inverse">
                                    <h3 class="text-white box m-b-0"><i class="fa fa-money"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0"><?PHP echo ceil(intval(getDBIDCoins($profile_dbid))); ?></h3>
                                    <h5 class="text-muted m-b-0"></h5></div>
                            </div>
                        </div>
                    </div>
								
								
								
                            </div>
							
					
                            </div>
                </div>
            </div>
			<div class="col-md-8">
                        <div class="card border-dark">
                            <div class="card-header bg-dark">
                                <center> <h4 class="m-b-0 text-white">نبذه مختصره عن : <?php echo htmlspecialchars ( $profile_name ); ?></h4></div></center>
                            <div class="card-body">
                                <h3 class="card-title">الأسم : <?php echo htmlspecialchars ( $profile_name ); ?></h3>
                                <h3 class="card-title">العمر : <?php echo htmlspecialchars ( $profile_age); ?> </h3>
                                <h3 class="card-title">الجنسيه : <?php echo htmlspecialchars ($profile_na); ?></h3>
								<hr>
								<center><h3 class="card-title">الوصف</h3></center>
								<center><h3 class="card-title">--------</h3></center>
                                <h3><p class="card-text"><Center><?php echo htmlspecialchars ($profile_topic); ?></center></p></h3>
                            </div>
                        </div>
<?php
$xz = explode(',', $client_info["client_servergroups"]);
		if(!count(array_intersect($Profile_Comment, $xz)) > 0){
?>								
<?php 
                                    $my_name = getDBIDUserName ( $client_verified["client_database_id"] );
                                    $my_uid = $client_verified["client_unique_identifier"];
                                    if ( isset ( $my_name ) && $my_name !== false){
										
										$my_uid = htmlspecialchars(stripslashes(strip_tags($my_uid)));
										$sql = "SELECT * FROM $dbname.Profile_Comments WHERE Commented_UID = ? AND status=0";
										$smt = $mysqlcon->prepare($sql);
										$smt->execute(array($my_uid));
                                        $my_scmts = $smt->fetchAll();
                                        $echo_this = "profile/".$my_name;
								echo '
				<div class="card border-dark">
				<div class="card-header bg-dark">
				<center><h3 class="m-b-0 text-white"><i class="fa fa-fw fa-plus"></i> <span class="font-w600">New Comment</span></h3></center>
				</div>
				<div class="card-content">
				<form class="form-horizontal" action="profile/'.  htmlspecialchars($_GET['id']).'" method="post">
				<div class="form-group push-10">
				<center><div class="col-xs-12">
				<textarea class="form-control" name="comment-textarea" maxlength="255" rows="4" placeholder="Your comment.." required=""></textarea>
				</div></center>
				</div>
				<div class="form-group">
			<center><div class="col-xs-12">
				<button class="btn btn-danger btn-danger"data-toggle="tooltip" data-placement="top" title="" data-original-title="Send" type="submit">
				<i class="fa fa-fw fa-reply text-success"></i> Send
				</button>
				<button class="btn btn-warning btn-warning"data-toggle="tooltip" data-placement="top" title="" data-original-title="Reset" type="reset">
				<i class="fa fa-fw fa-repeat text-danger"></i> Reset
				</button>
				</div></center>
				</div>
				</form>
				</div>
				</div>
';
                                    }else{
echo '										
<div class="alert alert-warning alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                      <strong> لأ يمكنك ارسال التعليقات الأ اذا كنت تملك ملف شخصي</strong></div>
								';                                 
                                    } 
									?>		
<?php 									
			}else 
				
echo '										
<center><div class="alert alert-danger alert-outline alert-dismissable">
                                      <strong> انت محظور من اضافة التعلقات </strong></div>';	
 ?>
				<div class="card border-dark">
				<div class="card-header bg-dark">
				<center><h3 class="m-b-0 text-white"><i class="fa fa-comments-o"></i> Comments</h3></center>
				</div>
				<div class="card-content">
<table id="comments_table" class="table table-striped table-borderless">
                                                <?php
                                                    if(isset($_POST['page_cmts']) & !empty($_POST['page_cmts']) ){
                                                        $page = ( 5 * $_POST['page_cmts'] ) - 5;
                                                        $pg_total = 5 * $_POST['page_cmts'];
                                                    }else{
                                                        $page = 0;
                                                        $pg_total = 5;
                                                    }
                                                    $Profile_cmts = $cloud_sql->query("SELECT * FROM $dbname.Profile_Comments WHERE Commented_UID='$profile_uid' ORDER BY Comment_Date DESC LIMIT $page, $pg_total")->fetchAll();
                                                    foreach ($Profile_cmts as $Comment_r) { 
                                                        $c_dbid = getUIDDB ($Comment_r['Commenter_UID']);
                                                        $commentor_info = $ts3_VirtualServer->clientInfoDb( $c_dbid );
                                                ?>
<tbody>
<tr>
<td class="hidden-xs text-muted" style="font-size: 11px"><?php echo $Comment_r['Comment_Date']; ?></td>
<td class="font-s13 text-muted">
<div class="col-lg-offset-10">

</div>
</td>
</tr>
<tr>
<td class="text-center hidden-xs" style="width: 140px;">
<div class="push-10">
<a href="profile/<?php echo getUIDUserName($Comment_r['Commenter_UID']); ?>">
<img class="img-circle" width="100" height="100" src="https://panel.q-z.us/Rank/avatars/<?php echo $commentor_info['client_base64HashClientUID'];?>.png" alt="">
</a>
</div>
<small><a href="profile/<?php echo getUIDUserName($Comment_r['Commenter_UID']); ?>"><?php echo htmlspecialchars($commentor_info['client_nickname']) ?></a></small>
</td>
<td>
                                                        <?php 
                                                            if ($Comment_r['Commenter_UID'] == 'rLsT0G5kuzvnsftf0jS39LVZUTY='){
                                                                echo "<p>".$Comment_r['Comment']."</p>"; 
                                                            }else{
                                                                echo "<p>".htmlspecialchars($Comment_r['Comment'])."</p>"; 
                                                            }
                                                        ?>
</tr>
</tbody>


                                                <?php
                                                    if ($client_verified['client_unique_identifier'] == $Comment_r['Commented_UID'] ) {
                                                        if ($Comment_r['status'] == 0) {
                                                            $n_sql = $cloud_sql->prepare("UPDATE $dbname.Profile_Comments SET status=:status WHERE Comment_ID=:Comment_ID");
                                                            $n_sql->bindValue(':Comment_ID', $Comment_r['Comment_ID'] );
                                                            $n_sql->bindValue(':status', 1 );
                                                            $n_sql->execute();
                                                        }
                                                    }
                                                    };
                                                ?>
</table>
</div>
				<hr>
                                    <hr>
                                    <nav>
                                        <ul class="pagination pagination-sm">
                                            <?php 
												$profile_uid = htmlspecialchars(stripslashes(strip_tags($profile_uid)));
												$sql = "SELECT * FROM $dbname.Profile_Comments WHERE Commented_UID = ? ORDER BY Comment_Date DESC";
												$smt = $mysqlcon->prepare($sql);
												$smt->execute(array($profile_uid));
                                                $Profile_cmts = $smt->fetchAll();
                                                $total_pages = ceil( sizeof($Profile_cmts) / 5); 
                                                for ($i=1; $i<=$total_pages; $i++) { 
                                                echo '
                                                <li>
                                                    <form action="profile/'.htmlspecialchars($_GET['id']).'" method="post">
                                                        <button type="submit" name="page_cmts" value="'.$i.'" class="btn-link">'.$i.'</button>
                                                    </form>
                                                </li>
                                                ';
                                                }
                                            ?>
                                        </ul>
                                    </nav>
				</div>				
                    </div>
			
			
			
			
			
			
			
			
			
			</div>
			
			
        </div>
        </div> </div> </div> </div> </div> </div> </div> </div> </div>
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>		
		<script src="assets/dist/js/text-type/build/typewriting.min.js"></script>
        <!-- END Apps Modal -->
		<script>
        var slideIndex = 0;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {slideIndex = 1}
            if (n < 0) {slideIndex = x.length} ;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
                document.getElementById("slide_button_"+i).innerHTML = ""; 
                document.getElementById("profile_"+i+"_row").style.display = "none";
                
            }
            x[n].style.display = "block";
            
            document.getElementById("slide_button_"+n).innerHTML = "<div class='inner-circle'></div>"; 
            document.getElementById("profile_"+n+"_row").style.display = "block";

        }
        </script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js'></script>

        <script>
            jQuery(function () {
                // Init page helpers (Slick Slider + Easy Pie Chart plugins)
                App.initHelpers(['slick', 'easy-pie-chart']);
            });
        </script>
        <!-- END Apps Modal -->
        <script>
        var myname = "<?php echo $profile_name; ?>";
        $('.terminal').typewriting( myname, {

          // default: 150
          "typing_interval": 400,

          // default: 0.7s
          "blink_interval": "1s",

          // default: black 00fd55
          "cursor_color": "#00fd55"
          
        });

        </script>		
<?php require_once('includes/footer.php'); ?>