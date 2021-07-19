<?php 
die();
// require 'config/sqlconfig.php';
		$Query_username = "serveradmin";
	    $Query_password = "vlQlZunI";
	    $Query_host = "193.70.17.6";
		$Query_port = 10011;
		$Server_port = 9987;
	    $botname = 'Qz-Panel['. mt_rand(0, 100).']';
		// $maintenance = false;			
		// $sitename = "Qz - TeamSpeak Panel";
require_once ("config/TeamSpeak3/TeamSpeak3.php");
$ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&nickname=$botname");

// $ts3 = $ts3_VirtualServeqr;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $targetx = 15827;
// $clinfo = $ts3->clientGetByDbid(4326)->permAssignByName("i_client_permission_modify_power",100,true);
// $clinfo = $ts3->clientGetByDbid(4326)->addServerGroup(2);
$clinfo = $ts3->clientGetByDbid(32159)["connection_client_ip"];
// echo "Hi";
// $cl = $ts3->clientGetByDbid(4326);
// echo $clinfo;
echo "<pre>";
print_r($clinfo);
echo "</pre>";
die;
if(isset($_POST["submit"])){
	if(isset($_POST["clx"]) && is_numeric($_POST["clx"])){
		$clx = intval($_POST["clx"]);
		try{
			$ipx = $ts3->clientGetByDbid($clx)["connection_client_ip"];
			// die($ipx);
			$check = intval(file_get_contents("http://check.getipintel.net/check.php?ip=$ipx&contact=admin@goolge.com"));
			if($check === 0){
				echo "<br/><br/><center> <span style='color: green;'>Client Is Not Using A Vpn</span></center>";
			}else{
				echo "<br/><br/><center><span style='color: red;'>Client Is Using A Vpn</span></center>";
			}
		}catch(Exception $e){
			
		}
	}
	// exit(header("Location: test1.php"));
}

$clist = $ts3->clientList(array("client_type" => 0));
echo "<form method='post'> <center><br/><br/><br/> <select name='clx'>";
foreach($clist as $clx){
	$cdb = $clx["client_database_id"];
	echo "<option value='$cdb'>$clx</option>";
}
echo "</select> <br/><br/> ";
echo "<button type='submit' name='submit'>Check VPN</button> </form> </center>";


// require 'config/phphead.php';
// require 'config/sqlconfig.php';

// $host = "127.0.0.1";
// $user = "root";
// $pass = "qvaGN6vy9EaZMw5l";
// $db = "Rankqz";
// $con = new mysqli($host, $user, $pass, $db);
// if($con->connect_error){
	// die("Failed To Connect To Database!");
// }

// $xx = $client_info["client_database_id"];
// $xz = explode(',', $client_info["client_servergroups"]);
// $os = $client_info["client_platform"];
// $arrclients = $ts3_VirtualServer->clientList(array("client_type" => 0));

// $admins = array();										

// $sqlz = "SELECT act, status FROM actuser";
// $res3 = $con->query($sqlz);
// $sfact = array();

// while($selfact = $res3->fetch_assoc()){
	// if($selfact["status"] == 1){ array_push($sfact, $selfact["act"]); }
// }

// $sql = "SELECT act FROM actuser";
// $res = $con->query($sql);
// $arr = array();	

// while ($all = $res->fetch_assoc()){
	// if($all["act"] == 0 || !in_array($all["act"], $sfact)){ continue; }
	// $svg = array_keys($ts3->clientGetServerGroupsByDbid($all["act"]));
	// if(count(array_intersect($svg, $admins)) == 0){ continue; }
	// foreach($all as $val) {
		// if(empty($val)) {
			// continue;
		// }
		// $arr[$val][] = $val;
	// } 

	// }
	// uksort($arr, function($a, $b) { return count($b) - count($a); });
// print("<pre>".print_r($arr, true)."</pre>");

// foreach($arr as $k => $v) {
	// try{
		// $admin = $ts3_VirtualServer->clientInfoDb($k)["client_nickname"];			
	// }catch(TeamSpeak3_Exception $e){
		// continue;
	// }
	// $count = count($v);
	// echo "<tr> <td>$admin</td><td>$count</td> </tr>";
// }
// die;
// $_SERVER["HTTP_X_FORWARDED_FOR"] = "248.198.15.182";
// $_SERVER["HTTP_CF_CONNECTING_IP"] = "248.198.15.182";
// $_SERVER["HTTP_CF_PSEUDO_IPV4"] = "248.198.15.182";
// $_SERVER["HTTP_CF_RAY"] = "45262f8799a925f8-MRS";
// $_SERVER["HTTP_CF_IPCOUNTRY"] = "SA";

// $_SERVER["REMOTE_ADDR"] = "162.158.22.85";


// function ip_in_range($ip, $range) {
    // if (strpos($range, '/') == false)
        // $range .= '/32';

    // $range is in IP/CIDR format eg 127.0.0.1/24
    // list($range, $netmask) = explode('/', $range, 2);
    // $range_decimal = ip2long($range);
    // $ip_decimal = ip2long($ip);
    // $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
    // $netmask_decimal = ~ $wildcard_decimal;
    // return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
// }

// function _cloudflare_CheckIP($ip) {
    // $cf_ips = array(
        // '199.27.128.0/21',
        // '173.245.48.0/20',
        // '103.21.244.0/22',
        // '103.22.200.0/22',
        // '103.31.4.0/22',
        // '141.101.64.0/18',
        // '108.162.192.0/18',
        // '190.93.240.0/20',
        // '188.114.96.0/20',
        // '197.234.240.0/22',
        // '198.41.128.0/17',
        // '162.158.0.0/15',
        // '104.16.0.0/12',
    // );
    // $is_cf_ip = false;
    // foreach ($cf_ips as $cf_ip) {
        // if (ip_in_range($ip, $cf_ip)) {
            // $is_cf_ip = true;
            // break;
        // }
    // } return $is_cf_ip;
// }

// function _cloudflare_Requests_Check() {
    // $flag = true;

    // if(!isset($_SERVER['HTTP_CF_CONNECTING_IP']))   $flag = false;
    // if(!isset($_SERVER['HTTP_CF_IPCOUNTRY']))       $flag = false;
    // if(!isset($_SERVER['HTTP_CF_RAY']))             $flag = false;
    // if(!isset($_SERVER['HTTP_CF_VISITOR']))         $flag = false;
    // return $flag;
// }

// function isCloudflare() {
    // $ipCheck        = _cloudflare_CheckIP($_SERVER['REMOTE_ADDR']);
    // $requestCheck   = _cloudflare_Requests_Check();
    // return ($ipCheck && $requestCheck);
// }

// Use when handling ip's
// function getRequestIP() {
    // $check = isCloudflare();

    // if($check) {
        // return $_SERVER['HTTP_CF_CONNECTING_IP'];
    // } else {
        // return $_SERVER['REMOTE_ADDR'];
    // }
// }





// $ip = getRequestIP();
// $cf = isCloudflare();

// if($cf) echo "Cloudflare :D <br/>";
// else    echo "Not cloudflare o_0 <br/>";

// echo "Your actual ip address is: ". $ip;











// print("<pre>".print_r($_SERVER, true)."</pre>");


?>

 
 