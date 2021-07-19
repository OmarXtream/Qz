<?php 
require('config/sqlconfig.php');
//ini_set("default_charset", 'utf-8');
?>
<body class="fixed-layout lock-nav mini-sidebar skin-default-dark">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== 
       <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Qz - panel</p>
        </div>
    </div> -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="assets/images/qzdark.png" alt="homepage" class="dark-logo">
                         <!-- Light Logo text -->    
                         <img src="assets/images/qzwhite.png" class="light-logo" alt="homepage"></span> </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                        <!-- Comment -->
                       <!--  <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul>
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">أخر الأخبار والتحديثات</h4>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center">
										
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>O S A M A ~ A L S B 3</h5> <span class="mail-desc">سيتم أصدار النسخه المطوره من اللوحه بأول رمضان أنتظرونا</span> <span class="time">4/7/2018</span> </div>
                                            </a>

                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5" href="javascript:void(0);">  <i class="fa fa-bell fa-3x"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->
                        <!-- Messages -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-note"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                                <span class="with-arrow"><span class="bg-danger"></span></span>
                                <ul>
                                    <li>
                                        <div class="drop-title text-white bg-danger">
                                            <h4 class="m-b-0 m-t-5">عندك مشكلة ؟ تواصل مع الأدارة</h4>
                                            <span class="font-light"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                              <div class="mail-contnet">
	 <form method="post"> 
<?php
// هنا ما قدر احط الا رقم رتبة واحد بس ؟ الي هوا دا ؟؟
$supportx = array();
try{
$ts3_VirtualServer->clientListReset();
$ts3_VirtualServer->channelListReset();
foreach ($ts3_VirtualServer->clientList() as $chl){
	// $ID = '[B][COLOR=red][URL=client://82/'.$cliantID.']'.htmlspecialchars($clientname).'[/URL][/COLOR][/B]';
	$ggidss = explode(",", $chl["client_servergroups"]);
	$dbidx = $chl["client_database_id"];
	if(count(array_intersect($Admintopbar, $ggidss)) > 0){
		$status = $chl->getIcon();
		array_push($supportx, $dbidx);
		$chl = htmlspecialchars($chl) ;
		echo "<h5>$chl</h5> <p></p>
		<p></p> <button type='submit' name='send[$dbidx]' class='btn btn-sm waves-effect waves-light btn-outline-danger'>ارسال الايدنتي</button>";
		echo'<img src="config/client_status/'.$status.'.png" style="width:20px;height:20px;"/>';
		echo"<br>";
	}
}

if(isset($_POST["send"])){
	
	if(is_array($_POST["send"])){
// منععععع الاسبام
if(isset($_SESSION['Supppp']) and $_SESSION['Supppp'] >= microtime(true)){
die('<script>
           swal({
            title: "خطا",
            text: "لقد حاولت استخدام هذة الميزه من قبل حاول بعد فتره",
            type: "error",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("index.php");
            }else {
              window.location.replace("index.php");
            }
          })
           </script>'); 	
}else{
	$_SESSION['Supppp'] = microtime(true)+3600;
}
// منععععع الاسبام			
		$adara = intval(key($_POST["send"]));
		
		if(in_array($adara, $supportx)){
			
			$cx = $ts3_VirtualServer->clientGetByDbid($adara);
			$clientname = $cx["client_nickname"];
			$cliantID = $cx["client_unique_identifier"];
			$ID = '[B][COLOR=red][URL=client://82/'.$cliantID.']'.htmlspecialchars($clientname).'[/URL][/COLOR][/B] سوف يساعدك فى اسرع وقت ممكن';
			$client_info->message("$ID");
			$clientname = $client_info["client_nickname"];
			$cliantID = $client_info["client_unique_identifier"];
			$ID = '[B][COLOR=red][URL=client://82/'.$cliantID.']'.htmlspecialchars($clientname).'[/URL][/COLOR][/B] يطلب المساعدة';
			$cx->message("$ID");
		}
			echo('<script>
           swal({title: "تم ارسال الايدتني بنجاح",text: "لأتحاول تكرار الارسال لعدم حصولك علي حظر يمنعك من استخدام هذة الميزة",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
	}
	
		   }

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }

?>
</form>												
 </div>
                                            </a>

                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link m-b-5" href="Support.php"> <b>طلب مساعده بالتيم سبيك</b> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Messages -->
						
						
						<center>
<?php
		$sql = "SELECT * FROM adv LIMIT 1";
		$text = $con->query($sql)->fetch_assoc()["topic"];
		if(isset($text) && !empty($text)){
			echo "
						<br><div class='col-md-12'>
<p><marquee onmouseover='this.stop()' onmouseout='this.start()' scrollamount='5' scrolldelay='5' direction='right'><b><a title='<h style='color:#ac0000 '></a></b><b><a title='' target='_blank'><span id='movetitle'> 🔴 <h style='color:#ac0000' <='' h=''>$text 🔴
</h></span></a> </b><b><a title='#MahmouD :المسؤول عن اللوحة ' target='_blankB.Qz.G#' لاتزال='' اللوحة='' تحت='' التطوير='' والبرمجة)='' ..<='' a=''> </a></b></marquee></p>
</div>			
				";
		}
		
	?>						</center>
						
						
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- mega menu 
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-layout-width-default"></i></a>
                            <div class="dropdown-menu animated bounceInDown">
                                <center>
		<div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white">								<?php
		$sql = "SELECT * FROM adv LIMIT 1";
		$text = $con->query($sql)->fetch_assoc()["topic"];
		if(isset($text) && !empty($text)){
			echo "<center> <center><small class='font-w300' style='color:#ffc600'><strong>$text</strong></small></center>
			</center>	";
		}
		
	?>
			</h4>
		</div>

                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php 

			  if($client_verified["client_flag_avatar"])
		{
			try{
				$imgz = $client_info->avatarDownload();
				$imgz = $imgz->toBase64();	
				$download = $ts3_VirtualServer->transferInitDownload($client_verified->getId(), 0, $client_verified->avatarGetName());
							echo "<img src='data:config/png;base64,$imgz'  alt='user' class='img-circle' width='25' height='25'>";			  
			}catch (Exception $e) {	
				echo "<img src='assets/images/nophoto.jpeg' alt='user' class='img-circle' width='25' height='25' />";
			}
		}else{
			echo "<img src='assets/images/nophoto.jpeg' alt='user' class='img-circle' width='25' height='25' />";
		}
			  
			  ?></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-cyan"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-cyan text-white m-b-10">
                                    <div class=""><?php 

			  if($client_verified["client_flag_avatar"])
		{
			try{
				$imgz = $client_info->avatarDownload();
				$imgz = $imgz->toBase64();	
				$download = $ts3_VirtualServer->transferInitDownload($client_verified->getId(), 0, $client_verified->avatarGetName());
							echo "<img src='data:config/png;base64,$imgz'  alt='user' class='img-circle' width='25' height='25'>";			  
			}catch (Exception $e) {	
				echo "<img src='assets/images/nophoto.jpeg' alt='user' class='img-circle' width='25' height='25' />";
			}
		}else{
			echo "<img src='assets/images/nophoto.jpeg' alt='user' class='img-circle' width='25' height='25' />";
		}
			  
			  ?></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo (htmlspecialchars(stripslashes(strip_tags($client_info["client_nickname"]))));?></h4>
                                    </div>
                                </div>
								<center>
                                <a class="dropdown-item" href="coins.php"><i class="ti-wallet m-r-5 m-l-5"></i> أستبدال النقاط</a>
                                <a class="dropdown-item" href="activecode.php"><i class="ti-email m-r-5 m-l-5"></i> تفعيل الأكواد</a>
                                <div class="dropdown-divider"></div>
								</center>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>