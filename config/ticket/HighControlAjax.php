<?php 
require '../phphead.php';
date_default_timezone_set('Asia/Riyadh');
$date = date("Y-m-d H:i:s");
$conn = $con ;
$BlcList = array(1755);
if(count(array_intersect($BlcList, $ggids)) > 0){ 
die('<script> swal({title: "عذرا",text: "عفوا ، انت محظور من نظام التذاكر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
}
ticketConfig($ggids); 
///////////////////////////
if(isset($_POST["Runsystem"])){
	$NewValue = $_POST["value"];
	$sql = "UPDATE ticket_config SET value='$NewValue' WHERE action='working'";
	if ($conn->query($sql) === TRUE) {
	echo 'true';
	} else { echo 'error'; }
} 

/////////////////////////
if(isset($_POST["DeleteClosed"])){
	$sql = "SELECT * FROM ticket_system WHERE status='closed'";
		if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					$hashToDelete = $row['hash'] ;
					$sql = "DELETE FROM ticket_chat WHERE hash='$hashToDelete'";
					$result = $con->query($sql);
			}
		$sql = "DELETE FROM ticket_system WHERE status='closed'";
		$result = $con->query($sql);
		echo 'true';
		}	
	}	
} 
////////////////////////////
if(isset($_POST["CreateNewEvent"])){
	$name = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["name"]))));
	$limt = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["limt"]))));
	$limtper = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["limtper"]))));
	$sql = "INSERT INTO ticket_comp (id, name, limt, limtper)
	VALUES (null, '$name', '$limt', '$limtper')";
	if ($con->query($sql) === TRUE) {
		echo "true," . $name . "," . $limt . "," . $limtper;

	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
		
	}
} 
/////////////////////////
if(isset($_POST["dbDel"])) {
		$db = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["dbDel"]))));
		$sql = "DELETE FROM ticket_comp WHERE id='$db'";
		$result = $con->query($sql);
		echo "true";
}
///////////////////
if(isset($_POST["ticketButtonDel"])) {
	//	$ids = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["var"]))));
		$sql = "DELETE FROM ticket_chat WHERE hash in ('".str_replace(",", "','", $_POST["var"])."');";
		if ($con->query($sql) === TRUE) {
		$sql = "DELETE FROM ticket_system WHERE hash in ('".str_replace(",", "','", $_POST["var"])."');";


			if ($con->query($sql) === TRUE) {
				echo 'true';
			}
		} else {
		
	}
  echo("\n\nError description: " . mysqli_error($con));

}














?>