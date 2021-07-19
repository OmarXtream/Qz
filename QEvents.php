<?php
require 'config/phphead.php';
//require 'config/sqlconfig.php'; 
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
date_default_timezone_set('Asia/Riyadh');
$now = date("Y-m-j");

?>

<div class="page-wrapper">
        <div class="container-fluid"></br>
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
				</center>
				</br>
				<div class="table-responsive">
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th>أسم الفعالية</th>
				<th>تاريخ بدء الفعاليه</th>
				<th>مقدم الفعالية</th>
				<th>حاله الفعاليه [ بدت - أنتهت ]</th>
				</tr>
				</thead>
				<tbody>';
				$sql = "SELECT * FROM events";
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							
						echo "<tr>";
						echo "<td>" . $row['eName'] . "</td>";
						if ( $row['eDate'] != "N" ) {
						echo "<td>" . $row['eDate'] . "</td>";
						} else {
						echo "<td>لم يتم تحديد التاريخ</td>";
						}	
						echo "<td>" . $row['aName'] . "</td>";
						$status =  $row['status'] ; 
						$id =  $row['id'] ; 
						$diff = round((strtotime($row['eDate']) - strtotime($now)) /24 /60 /60);
			
			
					if ( $row['eDate'] != "N" ) {
						if ($diff == 0) {
							if ($row['eHour'] != "N") {
							echo "<td><span class='badge badge-success'>الفعاليه سوف تبدأ اليوم في الساعه ".$row['eHour']."</span></td>";
							} elseif ( $diff == 0) {
							echo "<td><span class='badge badge-success'>الفعاليه سوف تبدأ اليوم</span></td>";
							}
							} elseif ( $diff > 0) {
							echo "<td><span class='badge badge-info'>الفعاليه سوف تبدأ بعد ، ".$diff." أيام</span></td>";
							} elseif ( $diff < 0) {
							echo "<td><span class='badge badge-danger'>أنتهت الفعاليه</span></td>";
							} 
							} else {
							echo "<td><span class='badge badge-warning'>لم يتم تحديد تاريخ الفعاليه للأن</span></td>";
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
	</div>			
</div>			
<?php require_once('includes/footer.php'); ?>























