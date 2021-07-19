<?PHP
require '../phphead.php';
date_default_timezone_set('Asia/Riyadh');
$date = date("Y-m-d H:i:s");
$conn = $con ;
$BlcList = array(1755);
if(count(array_intersect($BlcList, $ggids)) > 0){ 
die('<script> swal({title: "عذرا",text: "عفوا ، انت محظور من نظام التذاكر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
}
ticketEvent($ggids); 


if(isset($_POST["msg"])){
	$passHash = $_SESSION['hash'];
	$msg = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["msg"]))));
	$hash = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hash"]))));
	if ($passHash == $hash ) {
    $nick = $nickname;
	$sql = "SELECT * FROM ticket_chat WHERE hash='$hash'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) >= 35) {
	echo 'limt';
	}else {
		
	$sql = "SELECT * FROM ticket_system WHERE hash='$hash'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$admin = $row['admin'];
			$tp = $row['type'];
		}
	} else {
        exit();
	}	
	
	if ( $type == "شكوى" || $type == "اخرى" || $type == "أقتراح") {
	exit();
	}
	$canReply = true ;
	
	if ( $canReply == true ) {
	$sql = "INSERT INTO ticket_chat (id, hash, name, msg,admin,date)
	VALUES (Null,'$hash','$nick','$msg','y','$date')";
	if ($conn->query($sql) === TRUE) {
	echo 'true';
	$sql = "UPDATE ticket_system SET status='true' WHERE hash='$hash'";
	$result = $conn->query($sql);
	try {
	$sql = "SELECT * FROM ticket_system WHERE hash='$hash'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
	$ccLient = $row['client_uid'];
	$title = $row['title'];
	}
	$client = $ts3->clientGetByUid($ccLient); 
$s = "\n" . '( Qz Ticket System )' . "\n" . 'هنالك رد جديد بالتذكرة ' . "\n\n". $title .' : عنوان التذكرة ' . "\n" .'[URl=https://panel.q-z.us/Ticket_open?id='. $hash.']هنا' . '[/URL] : للدخول الى التذكرة أضغط' . "\n" ; $client->message($s);
	}	catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
	
	echo mysqli_error($conn);
	} else { echo 'error';}
	}	else {
		echo 'repF' ;
	}
	}
	} else {
		echo 'error' ;
	}
}


if(isset($_POST["type"])){
	$type = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["type"]))));
	$hash = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hash"]))));
	$sql = "UPDATE ticket_system SET status='$type' WHERE hash='$hash'";
	if ($conn->query($sql) === TRUE) {
	echo 'true';
	} else { echo 'error'; }
} 


if(isset($_POST["hashIDC"])){
	$hash = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hash"]))));

	$sql = "SELECT * FROM ticket_system WHERE hash='$hash'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) >= 1) {
	while($row = mysqli_fetch_assoc($result)) {
		$cuid = $row['cuid'];
		$cuidN = $row['cc'];
		}	
	$client = $ts3_VirtualServer->clientGetByUid($uid); 
	$s = "\n" . '( Qz Ticket System )' . "\n" . 'طلب أيدي المتهم ' . "\n\n". 'ID : ' . '[URL=client:///'.$cuid.']'.$cuidN.'[/URL]' ;
	$client->message($s);

	}	else {echo 'error';}
} 


if(isset($_POST["Runsystem"])){
	$NewValue = $_POST["value"];
	$sql = "UPDATE ticket_config SET value='$NewValue' WHERE action='working'";
	if ($conn->query($sql) === TRUE) {
	echo 'true';
	} else { echo 'error'; }
} 

?>















