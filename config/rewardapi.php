<?PHP 
require 'phphead.php';
require 'sqlconfig.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$now = date("Y:m:j:H:i:s");
$token = "775374883:AAEyMm1_9z1DInUhmPbDSOvetO-gqgPeunY";
$time = strtotime("+5 min");
$spamTime = date("Y:m:j:H:i:s", $time);
$cldbid = $client_info["client_database_id"];
$sql = "SELECT name FROM tweat WHERE cdb='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["name"];
if(empty($res)){
	$username = "null";
}else{
	$username = $res ;
}
////////////////////////////////////Functions
function checkSpamAndAvalibity ($con,$cldbid,$chl) {
	$now = date("Y:m:j:H:i:s");
	$sql = "SELECT * FROM challengesQz WHERE cbd='$cldbid' AND chl='$chl'";
	if($result = mysqli_query($con, $sql)){
	if(mysqli_num_rows($result) >= 1){
	while($row = $result->fetch_assoc()) {
	$spam = $row["spam"] ;
	$value = $row["value"] ;
	}	
	if ($spam > $now){
	die("spam");
	}	
	if ($value == "true"){
	die("ald");
			}
		}
	}	
}
//////
function DbStuff ($con,$cldbid,$spamTime,$not,$chl,$st) {
	if ($st == true ) {
	$sql = "SELECT * FROM challengesQz WHERE cbd='$cldbid' AND chl='$chl'";
		if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) >= 1){
				$sql = "UPDATE challengesQz SET value='true' WHERE cbd='$cldbid' AND chl='$chl'";
				$con->query($sql);
				die('true');

		} else {
			$sql = "INSERT INTO challengesQz (id, chl, value, spam, cbd) VALUES (NULL, '$chl', 'true', '$now','$cldbid')";
			$con->query($sql);
			die('true');
		}
	}
	} else {
	$sql = "SELECT * FROM challengesQz WHERE cbd='$cldbid' AND chl='$chl'";
		if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result) >= 1){
				$sql = "UPDATE challengesQz SET spam='$spamTime' WHERE cbd='$cldbid' AND chl='$chl'";
				$con->query($sql);
				die('not');

		} else {
			$sql = "INSERT INTO challengesQz (id, chl, value, spam, cbd) VALUES (NULL, '$chl', 'false', '$spamTime','$cldbid')";
			$con->query($sql);
			die('not');
		}
	}
	}
}
//////
function checkInGroup($chatID, $userid, $token) {
    $url = "https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=" . $chatID . "&user_id=" . $userid ;
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
////////////////////////////////////////
function giveCoins ($con,$cldbid,$amount) {
	echo $amount . "d" ;
	$sql = "SELECT coins FROM user WHERE cldbid='$cldbid' LIMIT 1";
	$res = $con->query($sql)->fetch_assoc()["coins"];
	if(!empty($res)){
		$coins = $res;
	}else{
		$coins = 0;
	}
	$coins = $coins + $amount;
	$sql = "UPDATE user SET coins='$coins' WHERE cldbid='$cldbid'";
	$con->query($sql);
  echo("Error description: " . mysqli_error($con));

}







////////////////
if(isset($_POST["CheckTwitter"])){
	
	
checkSpamAndAvalibity($con,$cldbid,"twitter") ;

if ($username == "null"){
	
	die("error");
	
}
$token = '851910856933769216-3AiWPdw6c6QgPmCirLsddIe6YE6koWv';
$token_secret = 'yj8m2rsvmEdB9ivJ1azIVZ1aQU8U2kMjiS7LZSEl42Lr2';
$consumer_key = 'CS6Pry0EkJ7KbTwUl6nh81kHP';
$consumer_secret = 'WO1SH3ojUc8gxVsutwQH6XKo05uVSXbDHf3hrzQbgPWAwEfnPX';

$host = 'api.twitter.com';
$method = 'GET';
$path = '/1.1/followers/list.json'; // api call path
$query = array( // query parameters
    'screen_name' => "QzServer",
    'skip_status' => "true",
    'include_user_entities' => "false"
);

$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_token' => $token,
    'oauth_nonce' => (string)mt_rand(), // a stronger nonce is recommended
    'oauth_timestamp' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_version' => '1.0'
);

$oauth = array_map("rawurlencode", $oauth); // must be encoded before sorting
$query = array_map("rawurlencode", $query);

$arr = array_merge($oauth, $query); // combine the values THEN sort

asort($arr); // secondary sort (value)
ksort($arr); // primary sort (key)

// http_build_query automatically encodes, but our parameters
// are already encoded, and must be by this point, so we undo
// the encoding step
$querystring = urldecode(http_build_query($arr, '', '&'));

$url = "https://$host$path";

// mash everything together for the text to hash
$base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

// same with the key
$key = rawurlencode($consumer_secret)."&".rawurlencode($token_secret);

// generate the hash
$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

// this time we're using a normal GET query, and we're only encoding the query params
// (without the oauth params)
$url .= "?".http_build_query($query);
$url=str_replace("&amp;","&",$url); //Patch by @Frewuill

$oauth['oauth_signature'] = $signature; // don't want to abandon all that work!
ksort($oauth); // probably not necessary, but twitter's demo does it

// also not necessary, but twitter's demo does this too
function add_quotes($str) { return '"'.$str.'"'; }
$oauth = array_map("add_quotes", $oauth);

// this is the full value of the Authorization line
$auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

// if you're doing post, you need to skip the GET building above
// and instead supply query parameters to CURLOPT_POSTFIELDS
$options = array( CURLOPT_HTTPHEADER => array("Authorization: $auth"),
                  //CURLOPT_POSTFIELDS => $postfields,
                  CURLOPT_HEADER => false,
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);

// do our business
$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);
$input = json_decode($json);
for($i=0; $i<count($input->users); $i++) {
    $name = $input->users[$i]->screen_name ;
	if ($name == $username) {
		$followedus = true ; 
	}
}


if ( $followedus == true ) {
	giveCoins ($con,$cldbid,150);
	DbStuff ($con,$cldbid,$spamTime,$now,"twitter",true) ;

	//Prize
} else {
	DbStuff ($con,$cldbid,$spamTime,$now,"twitter",false) ;
}




}

/////////////////////////////////////////////////////////////////////////Telegram 

if(isset($_POST["CheckTelegram"])){
$TeleAcc = $_POST["CheckTelegram"];
checkSpamAndAvalibity($con,$cldbid,"telegram") ;
$CheckTelegram = checkInGroup("@QzPublicGroup", $TeleAcc, $token);
$obj = json_decode($CheckTelegram, true);
$status = $obj['ok'];
$bot = $obj['result']['user']['is_bot'];
$first_name = $obj['result']['user']['first_name'];
if ( $status == true ) {
		if ( $bot != true ) {
			$code = $_SESSION["TelegramCode"] ;
			if ( $first_name == $code ) {
			giveCoins ($con,$cldbid,150);
			DbStuff ($con,$cldbid,$spamTime,$now,"telegram",true) ;
			//Prize
			
			} else {
			DbStuff ($con,$cldbid,$spamTime,$now,"telegram",false) ;

			}
		} else { DbStuff ($con,$cldbid,$spamTime,$now,"telegram",false) ; }
	} else { DbStuff ($con,$cldbid,$spamTime,$now,"telegram",false) ; }
}


























?>














































