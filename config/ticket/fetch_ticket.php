<?php
//error_reporting(0);
//ini_set('display_errors', 0);
require 'ts3con.php';
require 'sql.php';
$passHash = $_POST["pS"];
$hash = $_SESSION["hash"];
$sql = "SELECT * FROM ticket_system WHERE hash='$hash'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$check = $row['client_uid'];
		}
}	

if ($check != $uid) {
	exit();
}

?>

<?php
$hash = $_SESSION['hash'];
if ($passHash == $hash ) {
	

                    $sql = "SELECT * FROM ticket_chat WHERE hash='$hash'";
				//	echo '<div class="general-item-list">';
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							$isA = $row['admin']; 
                            echo'<div class="item">';
							echo '<div class="item-head">';
							echo ' <div class="item-details">';
							if ( $isA =='y' ) {
							echo '<span class="badge badge-danger"> إداري </span> <a href="" class="item-name primary-link">Qz Technical Support</a>';								
							} else { echo '<span class="badge badge-success"> عضو </span> <a href="" class="item-name primary-link"> '.$row['name'].'</a>';}	
							echo '<span class="item-label">'.$row['date'].'</span>';
							echo ' </div>';
							echo '<span class="item-status">';
							if ( $isA =='y' ) {
							echo ' <span class="badge badge-empty badge-danger"></span> Admin</span>';							
							} else { echo ' <span class="badge badge-empty badge-success"></span> Client</span>';}	
							echo ' </div>';
							if ( $isA =='y' ) {
							echo '<div class="item-body"><strong> '. nl2br($row['msg']). '</strong> </div>';
							} else { echo '<div class="item-body">'. nl2br($row['msg']). '</div>';}	
							echo'</div>';
						}
					//	echo ' </div>';
						}
                            mysqli_free_result($result);
                        } 
		
} else {


					echo ' 
					<div class="item">
                    <div class="item-head">
                    <div class="item-details">
                    <a href="" class="item-name primary-link">نظام التذاكر</a>
                    </div>
                    <span class="item-status">
                    <span class="badge badge-empty badge-danger"></span> Error</span>
                    </div>
                    <div class="item-body" style="color: red;"> Error Loading Chat ..</div>
					<span class="badge badge-empty badge-danger"></span> <label>لايمكنك فتح اكثر من تذكرتين بالوقت نفسه ، الرجاء التأكد من ذلك وإعاده تحميل الصفحه</label>
                     </div>
				';
}	

?>