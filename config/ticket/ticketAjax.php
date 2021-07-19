<?PHP
require '../phphead.php';
date_default_timezone_set('Asia/Riyadh');
$date = date("Y-m-d H:i:s");
$BlcList = array(1755);
if(count(array_intersect($BlcList, $ggids)) > 0){ 
die('<script> swal({title: "عذرا",text: "عفوا ، انت محظور من نظام التذاكر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
}

if(isset($_POST["submitCreate"])) {
	if( $_POST["t-name"] != "" && $_POST["t-msg"] != "" ){		
		$TicketName = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-name"]))));
		$TicketType = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-type"]))));
		$TicketCuid = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["t-cuid"])));
		$TicketCuidN = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["t-cuidN"])));
		$TicketMessage = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-msg"]))));
		$TicketPR = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-pr"]))));
		//echo $TicketPR;
		$status = "";
		if ( $TicketPR == "n") {
			$TicketPR = "weak";
		} elseif  ( $TicketPR == "m") {
			$TicketPR = "modreatre";
		}elseif  ( $TicketPR == "h") {
			$TicketPR = "important";
		}
		$sql = "SELECT * FROM ticket_system WHERE client_uid = '$uid' AND (status = 'yet' OR status = 'true');";
		$result = $con->query($sql);
		if ($result->num_rows >= 5) {
			echo '3';
		} else {
		$rowcount = mysqli_num_rows($result);
		$finalHash = md5(uniqid(time(), true). $rowcount) ;
		$sql = "INSERT INTO ticket_system (id,title,type,date,status,client_uid,client_name,hash,priority,cuid,cc,admin)
		VALUES ('null','$TicketName', '$TicketType', '$date', 'yet','$uid','$nickname','$finalHash','$TicketPR','$TicketCuid','$TicketCuidN','n')";

			if($con->query($sql) === true){
			echo 'true';
		$sql = "INSERT INTO ticket_chat (id,hash,name,msg,admin,date)
		VALUES ('null','$finalHash', '$nickname', '$TicketMessage', 'n', '$date')";
		$result = $con->query($sql);
		if ( $TicketType == "شكوى" ) {
		NotfiyAdmins ($ts3,$nickname,$TicketName,$nickname,$finalHash);
		}
			}
			
		//echo("Error description: " . mysqli_error($con));
	
	}
		} else {
			echo 'error';
	}	
} 




if(isset($_POST["msgClient"])){
	//Check
	$passHash = $_SESSION['hash'];
	$hash = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hash"]))));
	if ($passHash == $hash ) {
	$sql = "SELECT * FROM ticket_system WHERE hash='$hash'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$check = $row['client_uid'];
			$status = $row['status'];
		}
	} else {
        exit();
	}	
	if ($check != $uid) {
	exit();
	}
	if ($status == 'closed') {
	echo 'closed';
	exit();
	}
	/////
	$msg = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["msgClient"]))));
	$hash = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["hash"]))));
    $nick = $nickname;
	$sql = "SELECT * FROM ticket_chat WHERE hash='$hash'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) >= 10) {
	echo 'limt';
	}else {
	$sql = "INSERT INTO ticket_chat (hash, name, msg,admin,date)
	VALUES ('$hash','$nick','$msg','n','$date')";
	if ($con->query($sql) === TRUE) {
	echo 'true';
	$sql = "UPDATE ticket_system SET status='trueClient' WHERE hash='$hash'";
	$result = $con->query($sql);

	} else { echo 'error';}
	}	
	if ($check != $uid) {
    exit();
		}
	} else {
			echo 'error';
	}
}


///////////////////////////////////////Functions
function NotfiyAdmins ($ts3,$nick,$title,$bywho,$hash)
{
			try {
			$ts3->clientListReset();
			foreach($ts3->clientList(array("client_type" => 0)) as $client){
			$groups = explode(",", $client['client_servergroups'] );
			if(in_array(2453, $groups) || ($client['client_type'] == 1)) {
			$uid = $client["client_unique_identifier"];
			$nickname = $client["client_nickname"];
			$ipuser = $client["connection_client_ip"];
			$platform = $client["client_platform"];
			$m = "\n" . '( Qz Ticket System )' . "\n" . 'تذكرة جديدة ' . "\n\n". $title .' : عنوان التذكرة ' . "\n". $bywho . ' : من قبل ' . "\n" .'[URl=https://panel.q-z.us/A-Ticket_open?id='. $hash.']هنا' . '[/URL] : للدخول الى التذكرة أضغط' . "\n" ; 
			$client->message($m);
			if(in_array(2474, $groups) || ($client['client_type'] == 1)) {
			$client->poke("( Qz Ticket System ) تذكرة جديدة ، للمزيد من التفاصيل راجع الخاص");
			}

		}	
	}	
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

}



 

$con->close();  


?>