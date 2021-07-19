<?PHP 
require 'phphead.php';
require 'sqlconfig.php';
$allowedRanks = array(39,38,40,2386);
$xx = explode(',', $client_info["client_servergroups"]);
$cldbid = $client_info["client_database_id"];
$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["coins"];
if(!empty($res)){
	$coins = $res;
}else{
	$coins = 0;
}
$sql = "SELECT * FROM codes WHERE chl != '' AND status='active'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$ChlArray = $row["chl"] ;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["CheckAndSubmitRANKS"])){
	
	$t = $_POST["rtime"];
	$c = $_POST["rid"];
	
	if(!in_array($c, $allowedRanks)){
		die("error");
	}
	if(!$t == "24H" || !$t == "7D" || !$t == "1M"){
		die("error");
	}else if(in_array($c, $xx)){
		die("ald");
	}
	
	if ($c == "2386" ) {
		$coinsNeeded = 10000 ;
		$t = "unlimted" ;
	} elseif ($c == "38" ) {
		if ($t == "24H" ) {
			$coinsNeeded = 1500 ;
		} elseif ($t == "7D" ) {
			$coinsNeeded = 3000 ;
		} elseif ($t == "1M" ) {
			$coinsNeeded = 7500 ;
		}
	}elseif ($c == "39" ) {
		if ($t == "24H" ) {
			$coinsNeeded = 1250 ;
		} elseif ($t == "7D" ) {
			$coinsNeeded = 2500 ;
		} elseif ($t == "1M" ) {
			$coinsNeeded = 6000 ;
		}
	}elseif ($c == "40" ) {
		if ($t == "24H" ) {
			$coinsNeeded = 800 ;
		} elseif ($t == "7D" ) {
			$coinsNeeded = 1500 ;
		} elseif ($t == "1M" ) {
			$coinsNeeded = 4500 ;
		}
	}
	
	
 if($t == "24H" && $coins >= $coinsNeeded){
		$time = strtotime("+1 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - $coinsNeeded;
		$client_info->addServerGroup($c);
	}else if($t == "7D" && $coins >= $coinsNeeded){
		$time = strtotime("+7 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - $coinsNeeded;
		$client_info->addServerGroup($c);
	}else if($t == "1M" && $coins >= $coinsNeeded){
		$time = strtotime("+1 min");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st')";
		$con->query($sql);
		$coins = $coins - $coinsNeeded;
		$client_info->addServerGroup($c);
	}else if($t == "unlimted" && $coins >= $coinsNeeded){
		if  ($c != "2386"){
	die ("error");			
		}
		$tdate = "unlimted";
		$spacer = $_POST["chl0"];
		$ch1 = $_POST["chl1"];
		$ch2 = $_POST["chl2"];
		$psd = $_POST["psd"];

		$time = strtotime("+30 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$avoideRep = "[" . rand(1, 1000000) . "]" ;
				
				
		try {
		$check1 = $ts3_VirtualServer->channelGetByName($ch1);
		die ("tk,".$ch1);
		}catch(Exception $e){
			
		}
		try {
		$check2 = $ts3_VirtualServer->channelGetByName($ch2);
		die ("tk,".$ch2);
		}catch(Exception $e){
			
		}

				if(!empty($ChlArray)){
					$chls = explode(",", $ChlArray);
					$rnd = rand() ;
					try {
					$cid1 = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => "[cspacer".$rnd."]". $spacer,
						"channel_password" => "141243124234234",
						"channel_order"    => $chls[3],
						"channel_flag_permanent" => TRUE,
					 ));
					$cid2 = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => $ch1,
						"channel_password" => $psd,
						"channel_flag_permanent" => TRUE,
						"cpid" => $cid1,
					));
					$cid3 = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => $ch2 ,
						"channel_password" => $psd,
						"channel_flag_permanent" => TRUE,
						"cpid" => $cid1,
					));
					$cid1C = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => "[cspacer".$rnd."]┄┉┉═══ ═══┉┉┄",
						"channel_password" => "7567657567",
						"channel_order"    => $cid1,
						"channel_flag_permanent" => TRUE,

					 ));
					} catch(Exception $e){
			
					die ("1".$e) ;

					}
					$finalChl = $cid1 . "," . $cid2 . "," .$cid3 . "," . $cid1C  ;
					$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status, chl) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st', '$finalChl')";

					$con->query($sql);
					$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid1, '33');
					$ts3_VirtualServer->clientMove($client_info, $cid1);

					}else{
					$rnd = rand() ;
					try {

					$cid1 = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => "[cspacer".$rnd."]". $spacer,
						"channel_password" => "7567657567",
						"channel_order"    => "253642",
						"channel_flag_permanent" => TRUE,
					 ));
					$cid2 = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => $ch1 ,
						"channel_password" => $psd,
						"channel_flag_permanent" => TRUE,
						"cpid" => $cid1,
					));
					$cid3 = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => $ch2 ,
						"channel_password" => $psd,
						"channel_flag_permanent" => TRUE,
						"cpid" => $cid1,
					));
					$cid1C = $ts3_VirtualServer->channelCreate(array(
						"channel_name" => "[cspacer".$rnd."]┄┉┉═══ ═══┉┉┄",
						"channel_password" => "7567657567",
						"channel_order"    => $cid1,
						"channel_flag_permanent" => TRUE,

					 ));
					} catch(Exception $e){

					die ("2".$e) ;

					}

					$finalChl = $cid1 . "," . $cid2 . "," .$cid3 . "," . $cid1C  ;
					$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status, chl) VALUES (NULL, '$cldbid', '$c', '$now', '$tdate', '$st', '$finalChl')";
					$con->query($sql);
					$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid1, '33');
					$ts3_VirtualServer->clientMove($client_info, $cid1);

					}

		$coins = $coins - $coinsNeeded;
		$client_info->addServerGroup($c);
		$client_info->addServerGroup(2396);
		$client_info->addServerGroup(2397);
	}else{
	die ("en") ;
	}
	$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	$con->query($sql);
	echo "true" ;
/////////////////////////////////////////////////////////////////////////////////////////////////
}elseif(isset($_POST["CheckAndSubmitRANKSCode"])){
	$allowedRanks = array(39,38,40);
	$t = $_POST["rtime"];
	$c = $_POST["rid"];
	
	if(!in_array($c, $allowedRanks)){
		die("error");
	}
	if(!$t == "24H" || !$t == "7D" || !$t == "1M"){
		die("error");
	}else if(in_array($c, $xx)){
		die("ald");
	}
	
	if ($c == "2386" ) {
		$coinsNeeded = 10000 ;
	} elseif ($c == "38" ) {
		if ($t == "24H" ) {
			$coinsNeeded = 1500 ;
		} elseif ($t == "7D" ) {
			$coinsNeeded = 3000 ;
		} elseif ($t == "1M" ) {
			$coinsNeeded = 7500 ;
		}
	}elseif ($c == "39" ) {
		if ($t == "24H" ) {
			$coinsNeeded = 1250 ;
		} elseif ($t == "7D" ) {
			$coinsNeeded = 2500 ;
		} elseif ($t == "1M" ) {
			$coinsNeeded = 6000 ;
		}
	}elseif ($c == "40" ) {
		if ($t == "24H" ) {
			$coinsNeeded = 800 ;
		} elseif ($t == "7D" ) {
			$coinsNeeded = 1500 ;
		} elseif ($t == "1M" ) {
			$coinsNeeded = 4500 ;
		}
	}
	
	
 if($t == "24H" && $coins >= $coinsNeeded){
	 	$code = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(10, 17));
		$time = strtotime("+1 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$coins = $coins - $coinsNeeded;
		$sql = "INSERT INTO act (id, owner, user, code, time, etime, status, sgid, hidden, cml) VALUES (NULL, '$cldbid', '0', '$code', '$now', '$tdate', '$st', '$c', 4, 1)";
		$con->query($sql);
		
	}else if($t == "7D" && $coins >= $coinsNeeded){
		$code = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(10, 17));
		$time = strtotime("+7 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$coins = $coins - $coinsNeeded;
		$sql = "INSERT INTO act (id, owner, user, code, time, etime, status, sgid, hidden, cml) VALUES (NULL, '$cldbid', '0', '$code', '$now', '$tdate', '$st', '$c', 4, 1)";
		$con->query($sql);
	} else if($t == "1M" && $coins >= $coinsNeeded){
		$code = substr(md5(uniqid(mt_rand(), true)) , 0, mt_rand(10, 17));
		$time = strtotime("+30 days");
		$tdate = date("Y:m:j:H:i:s", $time);
		$now = date("Y:m:j:H:i:s");
		$st = "active";
		$coins = $coins - $coinsNeeded;
		$sql = "INSERT INTO act (id, owner, user, code, time, etime, status, sgid, hidden, cml) VALUES (NULL, '$cldbid', '0', '$code', '$now', '$tdate', '$st', '$c', 4, 1)";
		$con->query($sql);
	}else{
	die ("en") ;
	}
	$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	$con->query($sql);
	echo "true," . $code ;
	$s = "\nالكود الذي قمت بطلبة : \n\n " . $code ;  
	$client_info->message($s);

}


/////////////////

if(isset($_POST["trbtn"]) && isset($_POST["amount2"]) && isset($_POST["userrespid"])){
	$amountBefore = intval($_POST["amount2"]);
	$amount = intval($_POST["amount2"]);
	$vatToPay = ($amount / 100) * 10.0;
	$amount = $amount - $vatToPay;
	$transferto = intval($_POST["userrespid"]);
	if(is_int($transferto) ){
		$mdbd = $client_info["client_database_id"];
		$tndb = $ts3_VirtualServer->clientGetByDbId($transferto);
			if($amount == 0 || $amount < 100){
			die ("les");
		   	}
		if($transferto != $mdbd){
			if($coins >= $amount){
				$newcoins = $coins - $amountBefore;
				$sql = "UPDATE user SET coins='$newcoins' WHERE cldbid='$mdbd'";
				$con->query($sql);
				$sqlz = "UPDATE user SET coins = coins + '$amount' WHERE cldbid='$transferto'";
				$con->query($sqlz);
				//2017-08-25 19:24:29
				$tnow = date("Y-m-d g:i:s");
				$sqly = "INSERT INTO transfer (id, sender, geter, amount, stime) VALUES (NULL, '$mdbd', '$transferto', '$amount', '$tnow')";
				$con->query($sqly);
				try {
				//	$ts3->clientGetByDbid(13865)->poke("تم تحويل لك : [COLOR=#298510]" . $amount . " نقطة[/COLOR] ، بواسطة -> " . $nickname);
					$tndb->poke("تم تحويل لك : [COLOR=#298510]" . $amount . " نقطة[/COLOR] ، بواسطة -> " . $nickname);

				}catch(Exception $e){
				}
				
				echo 'true' ;
				}else{
				die ("error");
				}
		}
	}
}








?>