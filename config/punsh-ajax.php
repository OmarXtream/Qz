<?php
//
require 'phphead.php';
require 'sqlconfig.php';
Punishmen($ggids) ;
$token = "775374883:AAEyMm1_9z1DInUhmPbDSOvetO-gqgPeunY";
$chatid = "-1001460268357";
$xz = array(861,77,1411,76,78,79,80,91,2154,169,1752,1753,1754,1755,131,2340); // رتب المعاقبة
$removez = array(2,2171,10,1672,1555,1983,1984,1985,1048,1986,1987,1048); // يقدر يحذف
$unpunish = array(10,2171,1672,1555,1983,1984,1985,1986,1987,1988); // ما يتعاقب
$xx = explode(',', $client_info["client_servergroups"]);
$igjail = array(10,2171,1672,1555,1983,1984,1985,1986,1048,1987,1988);

error_reporting(E_ALL);
ini_set('display_errors', 1);

function sendMessage($chatID, $messaggio, $token) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function editMessage($chatID, $messaggio, $msgid) {
	$token = "775374883:AAEyMm1_9z1DInUhmPbDSOvetO-gqgPeunY";
    $url = "https://api.telegram.org/bot" . $token . "/editMessageText?chat_id=" . $chatID . "&message_id=" . $msgid ;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function isClientBanned ($clientUID,$ts3_VirtualServer) {
	$banlist = $ts3_VirtualServer -> banlist();
		foreach ($banlist as $data) {
			$uid = $data["uid"];
			if ( $uid == $clientUID ) {
				return $data["banid"] ;
		}
	}	
}
        
  
if(isset($_POST["submitBanned"])){
		$note = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["note"]))));
		$BanID = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["BanID"]))));
		$evd = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["evd"]))));
		$tlacc = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["tlacc"]))));
		$rclient = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["rclient"]))));
		$udz = strval($_POST["rclient"]); 
		$tsname = $ts3_VirtualServer->clientGetNameByUid($udz);
		$cl = $ts3_VirtualServer->clientFindDb($udz, true)[0];
		$clp = explode(',', $ts3_VirtualServer->clientGetByDbid($cl)["client_servergroups"]);
		echo $BanID ;
		$sql = "SELECT * FROM ban_reassosn WHERE id='$BanID'";												
		$res = $con->query($sql);
		while($data = $res->fetch_assoc()){
		$reasonB = $data["name"];
		$BanValue = $data["value"];		
		$shownas = $data["ShownAs"];		
		}
		if(count(array_intersect($clp, $igjail)) > 0){
		die('error');
		}
		$reason = $reasonB ;
		if ( $note != "none" ) {
		$telegramMsg = "[ الأيدنتي ] : - " . $udz . "\n\n[ الاسم ] : -  ".$tsname['name']." \n\n[ النوع ] : - Banned \n\n[ المدة ] : - ".$shownas."\n\n [ السبب ] : - " .$reasonB." \n\n[ الدليل ] : - ". $evd ."\n\n [صاحب العقوبه] :- @" . $tlacc . "\n\n [ الملاحظات ] : - " . $note . "\n\n\n Requested By : " . $nickname;
		} else {
		$telegramMsg = "[ الأيدنتي ] : - " . $udz . "\n\n[ الاسم ] : -  ".$tsname['name']." \n\n[ النوع ] : - Banned \n\n[ المدة ] : - ".$shownas."\n\n [ السبب ] : - " .$reasonB." \n\n[ الدليل ] : - ". $evd ."\n\n [صاحب العقوبه] :- @" . $tlacc . "\n\n\n Requested By : " . $nickname ;
		}
		$banSetting = array(
			"time" => $BanValue,
			"reason" => $reason,
			"uid" => $udz,
		);
		$BtES = $ts3_VirtualServer->banCreate($banSetting,$BanValue,$reason);  
		$sql = "INSERT INTO banned (id, cldbid,	time, reason, punisher, banID, evd, note, teleacc )
		VALUES (null, '$udz', '$shownas', '$reasonB', '$dbid', '$BtES', '$evd', '$note', '$tlacc')";
		if ($con->query($sql) === TRUE) {
			 echo "true";
			 $que = sendMessage($chatid, $telegramMsg, $token);
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

}

if(isset($_POST["submitPunshOLD"])){
	
	$grp = intval($_POST["group"]);
	if(!in_array($grp, $xz)){	
		die('error');
	}
	
//	$tlacc = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["tlacc"]))));
	$mins = intval($_POST["mins"]);
	$hours = intval($_POST["hours"]);
	$days = intval($_POST["days"]);
	$rclient = trim(strip_tags($_POST["rclient"]));
	$reason = htmlspecialchars(stripslashes(strip_tags($_POST["reason"])));
	//$evd = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["evd"]))));
//	$PType = htmlspecialchars(stripslashes(strip_tags($_POST["PType"])));
	$tsname = $ts3_VirtualServer->clientGetNameByUid($rclient);

	if(!isset($reason) || empty($reason)){
		$reason = "بدون سبب";
	}else{
		$reason = $con->real_escape_string($reason);
	}
	
	
	if(empty($mins) || !isset($mins) || $mins < 0){ $mins = 0; }
	if(empty($hours) || !isset($hours) || $hours < 0){ $hours = 0; }
	if(empty($days) || !isset($days) || $days < 0){ $days = 0; }
	if($mins > 60 || $hours > 60 || $days > 14){
		die('<script>
				   swal({title: "خطاء",text: "لأ يمكنك انشاء عقوبة اكثر من 14 يوم ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Punishmen");}else {window.location.replace("https://panel.q-z.us/A-Punishmen");}})</script>');	
	}
	
	$st = "active";
	$timez = strtotime("+$mins minutes +$hours hours +$days days");
	$tdate = date("Y:m:j:H:i:s", $timez);
	$now = date("Y:m:j:H:i:s");
	
		try{
			$remotedb = $ts3_VirtualServer->clientFindDb($rclient, true)[0];
		}catch(TeamSpeak3_Exception $e){
			try{
				$remotedbz = $ts3_VirtualServer->clientInfoDb($rclient);
				$remotedb = $rclient;
			}catch(TeamSpeak3_Exception $e){
				die('error');

			}
		}
		$xhim = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($remotedb));
		if(count(array_intersect($xhim, $unpunish)) > 0){
			die('error');
		}
		
	$ts3_VirtualServer->serverGroupClientAdd($grp, $remotedb);
	$sql = "INSERT INTO bad (id, cldbid, stime, etime, reason, punisher, sgid, status) VALUES (NULL, '$remotedb', '$now', '$tdate', '$reason', '$dbid', '$grp', '$st')";
	$con->query($sql);
	//$telegramMsg = "[ الأيدنتي ] : - " . $rclient . "\n\n[ الاسم ] : -  ".$tsname['name']." \n\n[ النوع ] : - ".$PType." \n\n[ المدة ] : Days : ".$days.", Hours : ".$hours.", Mins : ".$mins."\n\n [ السبب ] : - " .$reason." \n\n[ الدليل ] : - ". $evd ."\n\n [صاحب العقوبه] :- @" . $tlacc ."\n\n\n Requested By : " . $nickname;
	//$que = sendMessage($chatid, $telegramMsg, $token);

echo 'true';
}

if(isset($_POST["submitPunsh"])){
	
	$grp = intval($_POST["group"]);
	if(!in_array($grp, $xz)){	
		die('error');
	}
	
	$tlacc = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["tlacc"]))));
	$mins = intval($_POST["mins"]);
	$hours = intval($_POST["hours"]);
	$days = intval($_POST["days"]);
	$rclient = trim(strip_tags($_POST["rclient"]));
	$reason = htmlspecialchars(stripslashes(strip_tags($_POST["reason"])));
	$evd = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["evd"]))));
	$PType = htmlspecialchars(stripslashes(strip_tags($_POST["PType"])));
	$tsname = $ts3_VirtualServer->clientGetNameByUid($rclient);
	$cl = $ts3_VirtualServer->clientFindDb($rclient, true)[0];
	$clp = explode(',', $ts3_VirtualServer->clientGetByDbid($cl)["client_servergroups"]);
	if(count(array_intersect($clp, $igjail)) > 0){
	die('error');
	}

	if(!isset($reason) || empty($reason)){
		$reason = "بدون سبب";
	}else{
		$reason = $con->real_escape_string($reason);
	}
	
	
	if(empty($mins) || !isset($mins) || $mins < 0){ $mins = 0; }
	if(empty($hours) || !isset($hours) || $hours < 0){ $hours = 0; }
	if(empty($days) || !isset($days) || $days < 0){ $days = 0; }
	if($mins > 60 || $hours > 60 || $days > 14){
		die('<script>
				   swal({title: "خطاء",text: "لأ يمكنك انشاء عقوبة اكثر من 14 يوم ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Punishmen");}else {window.location.replace("https://panel.q-z.us/A-Punishmen");}})</script>');	
	}
	
	$st = "active";
	$timez = strtotime("+$mins minutes +$hours hours +$days days");
	$tdate = date("Y:m:j:H:i:s", $timez);
	$now = date("Y:m:j:H:i:s");
	
		try{
			$remotedb = $ts3_VirtualServer->clientFindDb($rclient, true)[0];
		}catch(TeamSpeak3_Exception $e){
			try{
				$remotedbz = $ts3_VirtualServer->clientInfoDb($rclient);
				$remotedb = $rclient;
			}catch(TeamSpeak3_Exception $e){
				die('error');

			}
		}
		$xhim = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($remotedb));
		if(count(array_intersect($xhim, $unpunish)) > 0){
			die('error');
		}
		
	$ts3_VirtualServer->serverGroupClientAdd($grp, $remotedb);
	$sql = "INSERT INTO bad (id, cldbid, stime, etime, reason, punisher, sgid, status) VALUES (NULL, '$remotedb', '$now', '$tdate', '$reason', '$dbid', '$grp', '$st')";
	$con->query($sql);
	$telegramMsg = "[ الأيدنتي ] : - " . $rclient . "\n\n[ الاسم ] : -  ".$tsname['name']." \n\n[ النوع ] : - ".$PType." \n\n[ المدة ] : Days : ".$days.", Hours : ".$hours.", Mins : ".$mins."\n\n [ السبب ] : - " .$reason." \n\n[ الدليل ] : - ". $evd ."\n\n [صاحب العقوبه] :- @" . $tlacc ."\n\n\n Requested By : " . $nickname;
	$que = sendMessage($chatid, $telegramMsg, $token);
//	echo $que ;
echo 'true';
}
  //echo("Error description: " . mysqli_error($con));

/////////////////
if(isset($_POST["removePunsh"])){
			if(count(array_intersect($ggids, $removez)) > 0){
				$idzx = htmlspecialchars(stripslashes(strip_tags($_POST["removePunsh"])));
				$sql = "SELECT * FROM bad WHERE id='$idzx' LIMIT 1";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					$result = $res->fetch_assoc();
					$cuser = $result["cldbid"];
					$sgidz = $result["sgid"];
				try{
					$ts3_VirtualServer->serverGroupClientDel($sgidz, $cuser);
					$sql = "DELETE FROM bad WHERE id='$idzx'";
					$con->query($sql);
				}catch (TeamSpeak3_Exception $e){ 
					echo 'error';
				}
					echo 'true';
				}
				} else {
					die( var_dump($removez) . '\n\nerror');		  
		}
}
///////////////////////////
if(isset($_POST["removeBanned"])){
			if(count(array_intersect($ggids, $removez)) > 0){
				$idzx = htmlspecialchars(stripslashes(strip_tags($_POST["removeBanned"])));
				try{
					$ts3_VirtualServer->banDelete($idzx);
				echo 'true';
					}catch (TeamSpeak3_Exception $e){ 
					echo 'error';
				}
	}
}
//////////////////////////
if(isset($_GET["client"])){
	$idzx = htmlspecialchars(stripslashes(strip_tags($_GET["client"])));
	try{
	$cl = $ts3_VirtualServer->clientFindDb($idzx, true)[0];
	$tsname = $ts3_VirtualServer->clientGetNameByDbid($cl);
	echo( $tsname['name'] );
	}catch (TeamSpeak3_Exception $e){ 

	}
}
//////////////////////////
























?>






























