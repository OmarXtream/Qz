<?php
  //  require ('steamauth/steamauth.php');
?>
<!DOCTYPE html>
<html>
<style>
img:hover {
  opacity: 0.5;
  filter: alpha(opacity=50); 
}

</style>
<head>
    <title>page</title>
</head>
<body>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require '../config/phphead.php';

$servername = "localhost";
$username = "root";
$password = "qvaGN6vy9EaZMw5l";
$dbname = "steam";
$steamdb = new mysqli($servername, $username, $password, $dbname);
if ($steamdb->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 



if (isset($_GET['login'])){
	require 'steamauth/openid.php';
	try {
		require 'steamauth/SteamConfig.php';
		$openid = new LightOpenID($steamauth['domainname']);
		if(!$openid->mode) {
			$openid->identity = 'https://steamcommunity.com/openid';
			header('Location: ' . $openid->authUrl());
		} elseif ($openid->mode == 'cancel') {
			echo 'User has canceled authentication!';
		} else {
			if($openid->validate()) { 
				$id = $openid->identity;
				$ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
				preg_match($ptn, $id, $matches);
				$_SESSION['steamid'] = $matches[1];
				$idS = $matches[1];
				$sql = "SELECT * FROM steam_userid WHERE db='$dbid' OR steamid='$idS' ";
				$result = $steamdb->query($sql);
				if ($result->num_rows >= 1) {	
				die ("Registerd ! " ) ;
				}
			////////
			$url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$_SESSION['steamid']); 
			$content = json_decode($url, true);
			$steamid = $content['response']['players'][0]['steamid'];
			$personaname = $content['response']['players'][0]['personaname'];
			$profileurl = $content['response']['players'][0]['profileurl'];
			$avatar = $content['response']['players'][0]['avatar'];
			$loccountrycode =	$content['response']['players'][0]['loccountrycode'];
			////////
			$url = file_get_contents("https://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?steamid=".$_SESSION['steamid']."&include_appinfo=1&include_played_free_games=1&key=494F715B505CCD286BB57ADAE822219D&format=json"); 
			$obj = json_decode($url, true);
			$limt = $obj['response']['game_count'] ; 
			for ($x = 0; $x <= $limt; $x++) {
			  $game = $obj['response']['games'][$x]["name"] ; 
			  $id = $obj['response']['games'][$x]["appid"] ; 
			  $output[] = $id;
			}
			$dbPush = implode(',', $output);
			$OGames = $dbPush ;
			////////
			$sql = "INSERT INTO steam_userid (id, steamid , personaname, profileurl, avatar, country, ownedgames, db)
				VALUES ('null','$steamid','$personaname','$profileurl','$avatar','$loccountrycode','$OGames','$dbid')";
			if ($steamdb->query($sql) === TRUE) {

			echo "true ";
			}
			} else {
				echo "User is not logged in.\n";
			}
		}
	} catch(ErrorException $e) {
		echo $e->getMessage();
	}
} else {
$singed = false ; 
$sql = "SELECT * FROM steam_userid WHERE db='$dbid'";
$result = $steamdb->query($sql);
if ($result->num_rows >= 1) {
	$singed = true ; 
	while($row = $result->fetch_assoc()) {
		$steamprofile['steamid'] = $row['steamid'];
		$steamprofile['personaname'] = $row['personaname'];
		$steamprofile['profileurl'] = $row['profileurl'];
		$steamprofile['avatar'] = $row['avatar'];
		$steamprofile['OGames'] = $row['ownedgames'];
		$steamprofile['country'] = $row['country'];
	}
} 


if ( $singed ==  true ) {

$Games = explode(',', $steamprofile['OGames']);
echo "<center>";
foreach ($Games as $id) {
	echo '
	<a target="_blank" href="https://store.steampowered.com/app/'.$id.'">
		 <img src="https://steamcdn-a.akamaihd.net/steam/apps/'.$id.'/header.jpg" />
	</a><br>
';


}
echo "</center>";

	
} else {
	header('Location: https://panel.q-z.us/steam/index?login');
}

}
/*
if(isset($_SESSION['steamid'])) {
    include ('steamauth/userInfo.php');
	$steamid = htmlspecialchars($steamprofile['steamid']) ;
	$personaname = htmlspecialchars($steamprofile['personaname']) ;
	$avatar = htmlspecialchars($steamprofile['avatar']) ;
	$url = htmlspecialchars($steamprofile['profileurl']) ;
	$loccountrycode = htmlspecialchars($steamprofile['loccountrycode']) ;
	$sql = "INSERT INTO steam_userid (id, steamid , personaname, profileurl, avatar, country, db)
	VALUES ('null','$steamid','$personaname','$url','$avatar','$loccountrycode','$dbid')";
	if ($steamdb->query($sql) === TRUE) {
	try{
		//$ts3 = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");
	//	$ts3->serverGroupClientAdd(267, $_SESSION['dbid']);
		//$ts3->logout();
		//header("Location: https://www.g-wc.com/Betapanel/v1/social_media.php");
	//	unset($ts3);
	echo "done";
		}catch (TeamSpeak3_Exception $e) { 
			echo $e;
		}
	}
}  
*/



?>  
</body>
</html>
<!--Version 4.0-->























