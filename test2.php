<?php
die;
require 'config/phphead.php';

// require 'config/sqlconfig.php';
// $cdb = "9529";
// $ipx = strval($ts3->clientGetByDbid($cdb)["connection_client_ip"]);
// $sql = "SELECT * FROM user_iphash WHERE ip='$ipx'";
// $res = $con->query($sql);
// if($res->num_rows > 0){
	// while($data = $res->fetch_assoc()){
		// $uidx = $data["uuid"];
		// try {
			// echo $ts3->clientGetByUid($uidx)."<br/>";
			// echo $uidx."<br/>";
		// }catch(Exception $e){
				// try{
					// $cdbx = $ts3->clientFindDb("$uidx",true)[0];
					// $nick = $ts3->clientInfoDb($cdbx)["client_nickname"];
					// echo $nick."<br/>";
					// echo $uidx."<br/>";
				// }catch(Exception $e){
					
				// }
		// }
	// }
// }else{
	// echo "No Members On The Server IP!";
// }

// $con->close();

// $banlist = $ts3->banlist();
// print("<pre>".print_r($banlist, true)."</pre>");
// foreach($banlist as $row){
	// print("<pre>".print_r($row, true)."</pre>");
// }
function generatePassword($length = 12) {
        $possibleChars = "abcdefghijklmnopqrstuvwxyz";
        $password = '';

        for($i = 0; $i < $length; $i++) {
            $rand = rand(0, strlen($possibleChars) - 1);
            $password .= substr($possibleChars, $rand, 1);
        }

        return $password;
    }

if(isset($_POST["submit"])){
	if(isset($_POST["sps"]) && is_numeric($_POST["sps"])){
		$sps = intval($_POST["sps"]);
		$chid = $ts3->channelSpacerCreate("T1".mt_rand(1000,9999)."T2".mt_rand(1,100), TeamSpeak3::SPACER_ALIGN_CENTER, TeamSpeak3::SPACER_DASHLINE, $sps, 0);
		
		$chid2 = $ts3->channelCreate(array( 
			"channel_name" => generatePassword(),
			"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE, 
			"channel_codec_quality"  => 0x08,
			"channel_flag_permanent" => TRUE,
			"cpid"                   => $chid, 
		));
		$chid3 = $ts3->channelCreate(array( 
			"channel_name" => generatePassword(),
			"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE, 
			"channel_codec_quality"  => 0x08,
			"channel_flag_permanent" => TRUE,
			"cpid"                   => $chid, 
		));
		$chid4 = $ts3->channelCreate(array( 
			"channel_name" => generatePassword(),
			"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE, 
			"channel_codec_quality"  => 0x08,
			"channel_flag_permanent" => TRUE,
			"cpid"                   => $chid, 
		));
		$chid5 = $ts3->channelCreate(array( 
			"channel_name" => generatePassword(),
			"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE, 
			"channel_codec_quality"  => 0x08,
			"channel_flag_permanent" => TRUE,
			"cpid"                   => $chid, 
		));
	}
	// echo $chid;
	exit(header("Location: test2.php"));
}
$chls = $ts3->channelList();
echo "<center><form method='post'><br/><br/> <select name='sps'>";
foreach($chls as $ch){
	$cid = $ch["cid"];
	echo "<option value='$cid'>$ch</option>";
}
echo "</select><br/><br/><button type='submit' name='submit'>Create Subs</button><br/></form></center>";

?>