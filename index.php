<?php
require 'config/phphead.php';
require 'config/sqlconfig.php'; 
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
date_default_timezone_set('Asia/Riyadh');
$now = date("Y-m-j");

?>

        <div class="page-wrapper">
            <div class="container-fluid">
			<?php 
require 'config/sqlconfig.php'; 			
$cldbid = $client_info["client_database_id"];
$con = new mysqli($host, $user, $pass, $db);
$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["coins"];
if(!empty($res)){
	$coins = $res;
}else{
	$coins = 0;
}
?>	
			
			

			
			<div class="card text-center">
                         <img class="card-img" src=<?php
		$sql = "SELECT * FROM home LIMIT 1";
		$img = $con->query($sql)->fetch_assoc()["img"];		
		if(isset($img) && !empty($img)){
			echo "$img";
		} else  { 
		
		echo "https://i.imgur.com/ZQ1hDrf.gif";
		
		}
	?> height="200" alt="Card image">
                            <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                              <div class="pt-50 pb-20"></br></br>
                                <h1 class="font-w700 text-white mb-10 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp">أهلاً وسهلاً بكم</h1>
                                <h2 class="h4 font-w400 text-white-op js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" style="color:#ffc600"><b>🔴 <?php
		$sql = "SELECT * FROM home LIMIT 1";
		$text = $con->query($sql)->fetch_assoc()["news"];
		if(isset($text) && !empty($text)){
			echo "$text";
		} else  { 
		
		echo "لم يتم وضع اخبار ليتم عرضها";
		
		}
		
	?> 🔴</b></h2>
							  </div>
                            </div>

            </div>
			 <div class="row">
			 
			 <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-8"><span class="display-6"><?php 
									
										$serverInfo = $ts3_VirtualServer->getInfo();
  $On = $serverInfo["virtualserver_clientsonline"];
  $slotsReserved = $serverInfo["virtualserver_queryclientsonline"];
  $slotsAvailable = $On - $slotsReserved;
             echo $slotsAvailable;
?> <i class="ti-angle-up font-14 text-success"></i></span>
                                        <h6>الأعضاء المتصلين</h6></div>
                                    <div class="col-4 align-self-center text-right p-l-0">
                                        <i class="fa fa-users fa-3x text-body-bg-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-8"><span class="display-6"><?php echo $totalconnections; ?> <i class="ti-angle-up font-14 text-success"></i></span>
                                        <h6>عدد مرات دخولك السيرفر</h6></div>
                                    <div class="col-4 align-self-center text-right p-l-0">
                                        <i class="fa fa-th-large fa-3x text-body-bg-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-8"><span class="display-6"><?php
										$xx = 0;
										$x = $ts3->serverGroupClientList(2453);
										foreach($x as $z){
											try{
												$dbid = $z["cldbid"];
												$ts3->clientGetByDbid($dbid);
												$xx = $xx + 1;
											}catch(Exception $e){
												continue;
											}
										}
										echo $xx;
									//echo OnlineOf(901); ?> <i class="ti-angle-up font-14 text-success"></i></span>
                                        <h6>عددالمساعدين المتصلين</h6></div>
                                    <div class="col-4 align-self-center text-right p-l-0">
                                        <i class="fa fa-support fa-3x text-body-bg-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					
            </div> 
			
			<br>
<?PHP
			$host = "127.0.0.1";
			$user = "root";
			$pass = "qvaGN6vy9EaZMw5l";
			$db = "test";
			$con = new mysqli($host, $user, $pass, $db);
			if($con->connect_error){
				die("Database Error: ".$con->connect_error);
			}

				echo '		<center>				
				<div class="col-md-12">
				<div class="card">
				<div class="card-body">
				<center> <h3 class="card-title">جدول الفعاليات</h3>
				<strong>التواريخ والأوقات ( بتوقيت السعوديه )</strong>
				</br><strong>اخر 5 فعاليات فقط</strong>
				</center>
				</br>
				<div class="table-responsive">
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th class="text-center" >#</th>
				<th class="text-center" >أسم الفعالية</th>
				<th class="text-center" >تاريخ بدء الفعاليه</th>
				<th class="text-center" >مقدم الفعالية</th>
				<th class="text-center" >حاله الفعاليه [ بدت - أنتهت ]</th>
				</tr>
				</thead>
				<tbody>';
				$sql = "SELECT * FROM events ORDER BY id DESC LIMIT 5";
				$QC = 0 ;
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
						$QC ++ ;
						echo "<tr>";
						echo "<td align='center'><b>" . $QC . "</b></td>";
						echo "<td align='center'><b>" . $row['eName'] . "</b></td>";
						if ( $row['eDate'] != "N" ) {
						echo "<td align='center'>" . $row['eDate'] . "</td>";
						} else {
						echo "<td align='center'>لم يتم تحديد التاريخ</td>";
						}	
						echo "<td align='center'>" . $row['aName'] . "</td>";
						$status =  $row['status'] ; 
						$id =  $row['id'] ; 
						$diff = round((strtotime($row['eDate']) - strtotime($now)) /24 /60 /60);
			
			
					if ( $row['eDate'] != "N" ) {
						if ($diff == 0) {
							if ($row['eHour'] != "N") {
							echo "<td align='center'><span class='badge badge-success'>الفعاليه سوف تبدأ اليوم في الساعه ".$row['eHour']."</span></td>";
							} elseif ( $diff == 0) {
							echo "<td align='center'><span class='badge badge-success'>الفعاليه سوف تبدأ اليوم</span></td>";
							}
							} elseif ( $diff > 0) {
							echo "<td align='center'><span class='badge badge-info'>الفعاليه سوف تبدأ بعد ، ".$diff." أيام</span></td>";
							} elseif ( $diff < 0) {
							echo "<td align='center'><span class='badge badge-danger'>أنتهت الفعاليه</span></td>";
							} 
							} else {
							echo "<td align='center'><span class='badge badge-warning'>لم يتم تحديد تاريخ الفعاليه للأن</span></td>";
					}	


					
					
					 echo "</tr>";
					 }
						} else {
						echo "<tr>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "<td>لايوجد</td>";
						echo "</tr>";

					}	
				}
				echo '
									</tbody>
								</table>
							</div>
						</div>
					</div>				
			</center>
			';
			?>
		</div>					
			 <center>
<!---
<div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-twitch"></i> Live Stream</h3>
                  </div>
                  <div class="table-responsive">

				  
				  <iframe src="https://player.twitch.tv/?channel=da7m" frameborder="0" allowfullscreen="true" scrolling="no" width="783" height="370"></iframe><iframe src="https://www.twitch.tv/embed/da7m/chat" frameborder="0" scrolling="no" height="370" width="390"></iframe>
				  
				  
                  </div>
                </div>

              </div> -->
			</center>  
		

			
			
			
			
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>