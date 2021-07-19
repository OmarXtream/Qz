<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz"; 
$con->set_charset("utf8");		
try 
{
  $db = new PDO('mysql:host=localhost;dbname=Rankqz;charset=utf8', 'root', 'qvaGN6vy9EaZMw5l');
} 
catch(PDOException $e)
{
  die('خطأ:'. $e->getMessage());
}

?>

<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">
            <div class="container-fluid">
<br>

						<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">افضل ( 10 ) حسابات</h4>
                                <div class="table-responsive">
									<table id="demo-foo-addrow" class="table m-t-30 table-hover table color-table info-table contact-list footable-loaded footable" data-page-size="10">
                                        <thead>
                                    <tr style="background-color: #01c0c8;">
                                        <th><i class="fa fa-bookmark"></i> المركز</th>	
                                        <th><i class="fa fa-user"></i> الإسم</th>
                                        <th class="hidden-phone"><i class="fa fa-group"></i> عدد المتابعين</th>
                                        <th><i class="fa fa-header"></i> آخر هاشتاق </th>
                                        <th><i class="fa fa-bullhorn"></i> الإسم ب تيم سبيك</th>										
                                    </tr>
                                        </thead>
                                <tbody>
<?php


$response = $db->prepare('SELECT *
FROM tweat 
ORDER BY follow DESC LIMIT 10
           ');
$response->execute();
$tops = $response->fetchAll();
$response->CloseCursor();

if($response->rowCount() > 0 )
{
$mrkz = 0;
function add_quotes($str) { return '"'.$str.'"'; }

    foreach($tops as $top) 
    {
$mrkz++;
        $id = (int)$top['id'];
        $name = htmlspecialchars($top['name']);
        $username = htmlspecialchars($top['username']);
        $img = $top['img'];
        $cdb = (int)$top['cdb'];
        $sgroup = (int)$top['sgroup'];
        $followers = $top['follow'];
        $tari5 = htmlspecialchars($top['creation_date']);
$tsname = $ts3_VirtualServer->clientGetNameByDbid("$cdb");
$icon = $ts3_VirtualServer->serverGroupGetById($sgroup)->iconDownload();
if (!empty($icon)){
$sicon = '<img src="icon.php?id='. $sgroup . '">';
}
$token = '851910856933769216-3AiWPdw6c6QgPmCirLsddIe6YE6koWv';
$token_secret = 'yj8m2rsvmEdB9ivJ1azIVZ1aQU8U2kMjiS7LZSEl42Lr2';
$consumer_key = 'CS6Pry0EkJ7KbTwUl6nh81kHP';
$consumer_secret = 'WO1SH3ojUc8gxVsutwQH6XKo05uVSXbDHf3hrzQbgPWAwEfnPX';

$host = 'api.twitter.com';
$method = 'GET';
$path = '/1.1/statuses/user_timeline.json'; // api call path

$query = array( // query parameters
    'screen_name' => "$name",
    'count' => '2'
);

$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_token' => $token,
    'oauth_nonce' => (string)mt_rand(), 
    'oauth_timestamp' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_version' => '1.0'
);

$oauth = array_map("rawurlencode", $oauth); 
$query = array_map("rawurlencode", $query);

$arr = array_merge($oauth, $query); // combine the values THEN sort

asort($arr); // secondary sort (value)
ksort($arr); // primary sort (key)

$querystring = urldecode(http_build_query($arr, '', '&'));

$url = "https://$host$path";

$base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

$key = rawurlencode($consumer_secret)."&".rawurlencode($token_secret);

$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

$url .= "?".http_build_query($query);
$url=str_replace("&amp;","&",$url); //Patch by @Frewuill

$oauth['oauth_signature'] = $signature; // don't want to abandon all that work!
ksort($oauth); // probably not necessary, but twitter's demo does it

$oauth = array_map("add_quotes", $oauth);

$auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

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
$twitter_data = json_decode($json);
if($twitter_data){
$lasthashtag = $twitter_data[0]->entities->hashtags[0]->text;
}
echo'

                                    <tr>
                                        <td><span class="label label-info label-mini">'.$mrkz.'</span></td>				
                                        <td><img class="img-circle" width="60" src="'.$img .'" alt=""><a target="_blank" href="https://twitter.com/'.$name.'"><strong>'.$username.'</strong><a class="task-thumb" target="_blank" href="https://twitter.com/'.$name.'"></a></td>
                                        <td><span class="label label-info label-mini">'.$followers.'</span></td>
                                        <td class="hidden-phone"><strong>'.htmlspecialchars($lasthashtag).'</strong></td>										
                                        <td class="hidden-phone"><strong>'.htmlspecialchars($tsname['name']).'</strong></td>

                                    </tr>


';
echo'<br>';
    }
}
else
{
    echo '<h2 class="errors"> لا يوجد اي حساب  </h2><hr>';
}

?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
            </div>
        </div>
<?php require_once('includes/footer.php'); ?>