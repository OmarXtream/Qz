

<aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <center><span><img src="assets/images/logo1.png" alt="elegant admin template"></span></center>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
					<li>
<?php 
$my_name = getDBIDUserName ( $client_verified["client_database_id"] );
                                    $my_uid = $client_verified["client_unique_identifier"];
                                    if ( isset ( $my_name ) && $my_name !== false){
                                         $my_scmts = $cloud_sql->query("SELECT * FROM $dbname.Profile_Comments WHERE Commented_UID='$my_uid' AND status=0")->fetchAll();
                                        $echo_this = "profile/".$my_name;
								echo '
								<center class="m-t-0">  ';
                                    }else{
echo '										
								<center class="m-t-0"> 
								';                                 
                                    } 
?>					<?php 

			  if($client_verified["client_flag_avatar"])
		{
			try{
				$imgz = $client_info->avatarDownload();
				$imgz = $imgz->toBase64();	
				$download = $ts3_VirtualServer->transferInitDownload($client_verified->getId(), 0, $client_verified->avatarGetName());
							echo "<img src='data:config/png;base64,$imgz'  class='img-circle' width='100' width='100' height='100'>";			  
			}catch (Exception $e) {	
				echo "<img src='assets/images/nophoto.jpeg' class='img-circle' width='100' width='100' height='100' />";
			}
		}else{
			echo "<img src='assets/images/nophoto.jpeg' class='img-circle' width='100' width='100' height='100'/>";
		}
			  
			  ?> </center></a></li>
			  
<?php
$prestige = array(10,2171,1648,1647,1646,1048);
$vip = array(10,2171,38,39,40,2386,1048);
$testers = array(10,1803,1804,1805,1806,1807,1808,1809,1820,1879,1873,2314,1824,1889,1883,790);
$clanm = array(10,2171,1672,1884);	
$coinsm = array(10,2171,1672);	
$coinslist = array(10,2171,1672,2661);	
$ytt = array(10,2171,1672,1883);	
$comment = array(10,2171,1672);	
$cprofile = array(10,2171,1672);	
// $admintab = array(10,2171,1555,1672,1557,1554,1556,1553,1548,1027,1048,1989,1988,1987,1986,1985,1984,1983,2505,1882,1883,1884,1885,2163,2171,2212,2213);	
$admintab = array(10,2171,1555,1672,1557,1554,1556,1553,1548,1027,1048,1988,1987,1986,1985,1984,1983,2505,1882,1883,1884,1885,2163,2171,2212,2213,1989);	
$Code = array(10,2171,1672,1548,2212,2);	
// $jailsarch = array(10,2171,1555,1672,1557,1554,1556,1553,1989,1988,1987,1986,1985,1984,1983,2505,1893,1048);
$jailsarch = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);
$Punishmen = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);		
$msgmembers = array(10,2171,1672,1027,1548);		
// $actmembers = array(10,2171,1555,1672,1557,1554,1556,1553,1989,1988,1987,1986,1985,1984,1983,2505,1048);
$actmembers = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);
$canadv = array(10,2171,1672,2213);
$rooms = array(10,2171,1672,1885);
//$exm = array(10,84,14,790,1413,1414,1415,1416,1417,1418,1419);
$owner = array(10,2171);
$mananger = array(10,2171,1672);
//$ticket = array(10,2171,1555,1672,1557,1887,1048,2163);
$icon = array(10,2171,1672);
$ticket = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);
$users_page = array(10,2171,1672);

$CoinsAdmin = 10;
?>					  
					<div class="dropdown-divider"></div>
				<?php if(count(array_intersect($ggids, $admintab)) || count(array_intersect($ggids, $testers)))  { ?>
                        <li> <a class="has-arrow waves-effect waves-dark" style="color:#ff0000" href="javascript:void(0)" aria-expanded="false"><i class="ti-headphone-alt"></i><span class="hide-menu">الادارة</a>
                            <ul aria-expanded="false" class="collapse">
<?php if(count(array_intersect($ggids, $owner)))  { ?>																	
							    <li><a style="color:#f62d51"  href="A-Owner.php">الأونرية   <span class="badge badge-pill badge-danger">  خاص</span></a></li>
<?php } ?>	
<?php if(count(array_intersect($ggids, $mananger)))  { ?>																	
							    <li><a style="color:#ffbc34"  href="A-Manager.php"> ‎‫مسؤولين‬‎ الادارة <span class="badge badge-pill badge-warning">  خاص</span></a></li>
							    <li><a style="color:#ffbc34"  href="open.php">التحكم باللوحة </a></li>							    
								<li><a style="color:#ffbc34"  href="A-Points.php"> تصفير النقاط</a></li>
							    <li><a style="color:#03deff"  href="A-Store.php">سجل مشتريات المتجر</a></li>
<?php } ?>	
<?php if(count(array_intersect($ggids, $ticket)))  { ?>										
                                <li><a style="color:#36bea6" href="A-Tickets.php">تذاكر الدعم الفني</a></li>
								<?php } ?>	
<?php if(count(array_intersect($ggids, $users_page)))  { ?>										
                                <li><a style="color:#FF0000" href="Control-Login.php">صفحة المستخدمين</a></li>
								<?php } ?>	
<?php if(count(array_intersect($ggids, $actmembers)))  { ?>										
								
                                <li><a href="A-ACT.php">التفعيل </a></li>
                                <li><a href="A-ACTLOG.php">احصائيات التفعيل </a></li>
<?php } ?>	
<?php if(count(array_intersect($ggids, $exm)))  { ?>										
								<li><a href="A-exam.php">الأختبارات</a></li>
 <?php } ?>										
<?php if(count(array_intersect($ggids, $Punishmen)) || count(array_intersect($ggids, $jailsarch)))  { ?>	
								
                                <li><a href="A-Punishmen.php">العقوبات </a></li>
								<?php } ?>									
<?php if(count(array_intersect($ggids, $msgmembers)))  { ?>																			
								<li><a href="A-msg.php">ساعي البريد </a></li>
								<li><a href="A-Events.php">التحكم بالفعاليات </a></li>
								<?php } ?>
<?php if(count(array_intersect($ggids, $Code)))  { ?>																		
                                <li><a href="A-ReedemCoins.php">اكواد الكوينز </a></li>
								<?php } ?>		
<?php if(count(array_intersect($ggids, $canadv)) or in_array($ggids,$PublicRelation))  { ?>																				
                                <li><a href="A-adv.php">اعلانات اللوحة </a></li>
								<?php } ?>		
<?php if(count(array_intersect($ggids, $jailsarch)) or in_array($ggids,$PublicRelation))  { ?>																			
                                <li><a href="A-searcher.php">البحث عن عضو</a></li>
                                <li><a href="A-Asearcher.php">البحث عن العضو المتقدم</a></li>
								<?php } ?>		
								
<?php if(count(array_intersect($ggids, $icon)))  { ?>																		
                                <li><a href="A-ICon.php">نظام الايقونات</a></li>
								<?php } ?>	
<?php if(count(array_intersect($ggids, $testers)))  { ?>																		
                                <li><a href="A-exam.php">صفحة الاختبارات</a></li>
								<?php } ?>								
<?php if(count(array_intersect($ggids, $coinsm)))  { ?>																	
                                <li><a href="A-Coins">التحكم بالكوينز </a></li>
								<?php } ?>
<?php if(count(array_intersect($ggids, $clanm)))  { ?>										
                                <li><a href="A-Clan.php">التحكم بالكلانات</a></li>
																<?php } ?>		
<?php if(count(array_intersect($ggids, $rooms)))  { ?>											
                                <li><a href="A-Rooms.php">التحكم بالرومات</a></li>
<?php } ?>							
<?php if(count(array_intersect($ggids, $Code)))  { ?>																		
                                <li><a href="A-Reedem.php">اكواد المسابقات </a></li>
<?php } ?>		
<?php if(count(array_intersect($ggids, $ytt)))  { ?>										

								<li><a href="A-Youtuber.php">التحكم باليوتيوبر</a></li>
<?php } ?>
<?php if(count(array_intersect($ggids, $comment)) or in_array($ggids,$PublicRelation))  { ?>										

								<li><a href="A-ProfileComment.php">التحكم بالتعليقات</a></li>
<?php } ?>
<?php if(count(array_intersect($ggids, $cprofile)))  { ?>										

								<li><a href="A-Profile.php">التحكم بالبروفايلات</a></li>
<?php } ?>	
<?php if(count(array_intersect($ggids, $coinslist)))  { ?>																	
                                <li><a href="A-Coinslist.php">قائمة مشتريات الكوينز</a></li> 
<?php } ?>										
							</ul>
                        </li>
						
						<div class="dropdown-divider"></div>
						<?php } ?>	

						<li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">الرئيسية</span></a></li>
						<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layers-alt"></i><span class="hide-menu">التواصل الاجتماعي</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="Youtuber.php">ربط اليوتيوب</a></li>
                                <li><a href="y-top.php">توب اليوتيوبر</a></li>
                                <li><a href="Twitter.php">ربط التويتر</a></li>
                                <li><a href="t-top.php">توب التويتر </a></li>		
                                <li><a href="Instagram.php">ربط الانستقرام</a></li>
                                <li><a href="i-top.php">توب الانستقرام</a></li>									
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-headphone-alt"></i><span class="hide-menu">الدعم الفني</span><span class="badge badge-pill badge-danger">جديد</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="Tickets.php">نظام التذاكر </a></li>
                               <!--  <li><a href="Ticket.php">انشاء تذكرة </a></li> -->
                             <!--    <li><a href="Support.php">تقديم طلب بالتيم سبيك </a></li> -->
                            </ul>
                        </li>
                          <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-social-reddit"></i><span class="hide-menu">البوتات</span><span class="badge badge-pill badge-info">محدث !</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="botact.php">تفعيل البوت </a></li>
                                <li><a href="botcontrol.php">التحكم بالبوت </a></li>
                             <!--    <li><a href="Support.php">تقديم طلب بالتيم سبيك </a></li> -->
                            </ul>
                        </li>	 
					<div class="dropdown-divider"></div>
					<li>
						<a class="waves-effect waves-warning" href="store.php" aria-expanded="false"><i class="fa fa-circle-o text-warning"></i><span class="hide-menu"><b>متجر السيرفر</b></span><span class="badge badge-pill badge-warning">جديد</span></a>
					</li>

				<!-- 	<li>
						<a class="waves-effect waves-success" href="Support.php" aria-expanded="false"><i class="fa fa-circle-o text-success"></i><span class="hide-menu"><b>لطلب المساعدة</b></span><span class="badge badge-pill badge-success">مهم</span></a>
					</li> -->
					<!-- <li>
						<a class="waves-effect waves-warning" href="fnc.php" aria-expanded="false"><i class="fa fa-circle-o text-warning"></i><span class="hide-menu">بطولة فورتنايت</span><span class="badge badge-pill badge-warning">جديد</span></a>
					</li> -->					
                              <?php
                                //    $my_name = getDBIDUserName ( $client_verified["client_database_id"] );
                              //       $my_uid = $client_verified["client_unique_identifier"];
                             //       if ( isset ( $my_name ) && $my_name !== false){
                            //             $my_scmts = $cloud_sql->query("SELECT * FROM $dbname.Profile_Comments WHERE Commented_UID='$my_uid' AND status=0")->fetchAll();
                          //              $echo_this = "profile/".$my_name;
                        //                echo '
			//		<li>
			//			<a class="waves-effect waves-dark" href="'.$echo_this.'" aria-expanded="false"><i class="fa fa-circle-o text-danger"></i><span class="hide-menu">ملفي الشخصي</span><span class="badge badge-pill badge-danger">'.sizeof($my_scmts).'</span></span></a>
			//		</li>	
				//	<li>
			//			<a class="waves-effect waves-dark" href="editprofile.php" aria-expanded="false"><i class="fa fa-circle-o text-info"></i><span class="hide-menu">تعديل ملفك</span><span class="badge badge-pill badge-info">جديد</span></a>
				//	</li>';  
                 //                   }else{
                 //                       echo '
				//	<li>
				//		<a class="waves-effect waves-dark" href="nicknames.php" aria-expanded="false"><i class="fa fa-circle-o text-info"></i><span class="hide-menu">المٌعرفات الشخصية</span><span class="badge badge-pill badge-info">جديد</span></a>
				//	</li>';                                 
                             //       }
                                ?>	
					
					
								
					<li>
						<a class="waves-effect waves-dark" href="activecode.php" aria-expanded="false"><i class="fa fa-circle-o text-cyan"></i><span class="hide-menu">تفعيل الاكواد</span><span class="badge badge-pill badge-cyan">مهم</span></a>
					</li>
<?php if(count(array_intersect($ggids, $vip)))  { ?>										
					
					<li> 
						<a class="waves-effect waves-dark" href="vip.php" aria-expanded="false"><i class="fa fa-circle-o text-warning"></i><span class="hide-menu">المنطقة الملكية</span><span class="badge badge-pill badge-warning">مميز</span></a>
					</li> 
	<?php } ?>		
				<?php if(count(array_intersect($ggids, $prestige)))  { ?>										

					<li> 
						<a class="waves-effect waves-dark" href="Prestige.php" aria-expanded="false"><i class="fa fa-circle-o text-primary"></i><span class="hide-menu"> البرستيجات</span><span class="badge badge-pill badge-primary">مميز</span></a>
					</li>
	<?php } ?>		
	
					<div class="dropdown-divider"></div>
					<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">الغرف</span></a>
                      <ul aria-expanded="false" class="collapse">
                          <li><a href="r-prem.php">انشاء روم مثبت</a></li>
                         <li><a href="r-top.php">افضل الرومات </a></li>
                         <li><a href="r-control.php">التحكم بالروم </a></li>
                      </ul>
                    </li>
					<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">النقاط</span></a>
                        <ul aria-expanded="false" class="collapse">
                           <li><a href="coins.php">أستبدال النقاط</a></li>
                           <li><a href="coinstop.php">اعلى النقاط </a></li>
                        </ul>
                    </li>
						<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">الكلانات</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="c-clan.php">انشاء كلان</a></li>
                                <li><a href="c-clans.php">قائمة الكلانات </a></li>
<?php require 'config/sqlconfig.php'; ?>

								<?php 

$mdbid = $client_info["client_database_id"];
$sql = "SELECT owner FROM clans";
$res = $con->query($sql);
while($data = $res->fetch_assoc()){
	if($data["owner"] == $mdbid){
		$red = true;
	}
}


?>	
													<?php
if($red == true){
echo ('<li><a href="c-control.php">التحكم بالكلان</a></li>');
 }
 //else{
// echo ('<div class="input-group-append"><button type="submit" name="submit" class="btn btn-primary">انشاء</button>  </div>');
// }


?>							
                            </ul>
                        </li>
						<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-brush"></i><span class="hide-menu">مظهرك</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="games.php">الألعاب</a></li>
                                <li><a href="features.php">الخصائص </a></li>
                                <li><a href="icons.php">الايقونات </a></li>
                               <!-- <li><a href="usericon.php">الحالة الشخصية </a></li> -->
                            </ul>
                        </li>
						<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-level-up"></i><span class="hide-menu">افضل الاعضاء</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="top.php?top=week">خلال الاسبوع</a></li>
                                <li><a href="top.php?top=month">خلال الشهر </a></li>
                                <li><a href="top.php">طوال وقت </a></li>
                            </ul>
                        </li>					
						
						
						
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>