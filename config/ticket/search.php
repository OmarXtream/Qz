<?php
require '../phphead.php';
ticketNew($ggids);
$ShowAllTicktes = array(1555,1672,1048,2171,10);
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "test";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
die("Database Error: ".$con->connect_error);
}
$conn = $con ;


///
if (isset($_POST['searchTickets'])) {
$stringSearch= $_POST["searchTickets"];
if(count(array_intersect($ShowAllTicktes, $ggids)) > 0){ 
$queryA = "SELECT * FROM ticket_system WHERE client_name LIKE '%$stringSearch%' OR client_uid LIKE '%$stringSearch%' OR title LIKE '%$stringSearch%' ORDER BY `id` DESC"; 
} else {
$queryA = "SELECT * 
 FROM ticket_system 
WHERE type='شكوى' 
AND (client_name LIKE '%$stringSearch%' OR client_uid LIKE '%$stringSearch%' OR title LIKE '%$stringSearch%') 
ORDER BY `id` DESC"; 
}

$result= mysqli_query($conn, $queryA);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
		$mytickets = 0;
				if($result = mysqli_query($con, $queryA)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
						$mytickets ++ ;
						echo "<tr>";
						   echo '<td align="center">#'. $row['id'] .'</td>';
						   echo '<td align="center"><B>'. $row['title'] .'</B>
						   ';
						   if ( $row['priority'] == "weak") {
							   echo '<span class="badge badge-info">عادي</span>';
						   }elseif ( $row['priority'] == "modreatre") {
							   echo '<span class="badge badge-warning">متوسط الأهمية</span>';
						   }elseif ( $row['priority'] == "important") {
							   echo '<span class="badge badge-danger">مهم جدا</span>';
						   }
						   echo '</td>';
						   echo '<td align="center">'. $row['type'] .'</td>';
                           echo '<td align="center"> '. $row['date'] .' </td>';
						   try {
							$client = $ts3->clientGetByUid($row['client_uid']);
							echo '<td align="center" class="center"> '. htmlspecialchars($row['client_name']) .' <span class="badge badge-success">Online</span> </td>';
							} catch (TeamSpeak3_Exception $e) { echo '<td align="center" class="center"> '. htmlspecialchars($row['client_name']) .' <span class="badge badge-danger">Offline</span> </td>'; }
				  if ($row['status'] == "closed" ) {										
							echo "<td align='center'><span class='badge badge-danger'>مغلق</span></td>";
							} elseif ($row['status'] == "true" ) {										
							echo "<td align='center'><span class='badge badge-success'>تم الرد</span></td>";
							} elseif ($row['status'] == "yet" ) {										
							echo "<td align='center'><span class='badge badge-info'>غير مستجاب</span></td>";
					}
						 echo "<td><a href='A-Ticket_open?id=" .$row["hash"]."' class='btn btn-rounded btn-block btn-outline-success'>مشاهدة التذكرة</a></td>";
						 echo "</tr>";

				}
						} else {
						echo "<tr>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "</tr>";

					}	
				}
    }
	echo "نتائج البحث : " . $mytickets;
?>
 
