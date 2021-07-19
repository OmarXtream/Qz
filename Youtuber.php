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
$db = "yt";
try 
{
  $db = new PDO('mysql:host=localhost;dbname=yt;charset=utf8', 'root', 'qvaGN6vy9EaZMw5l');
} 
catch(PDOException $e)
{
  die('خطأ:'. $e->getMessage());
}

?>


<?php
require_once 'config/google_api/Google_Client.php';
require_once 'config/google_api/contrib/Google_YoutubeService.php';

/* You can acquire an OAuth 2 ID/secret pair from the API Access tab on the Google APIs Console
  <http://code.google.com/apis/console#access>
For more information about using OAuth2 to access Google APIs, please visit:
  <https://developers.google.com/accounts/docs/OAuth2>
Please ensure that you have enabled the YouTube Data API for your project. */
$OAUTH2_CLIENT_ID = '258052010444-elna8o825d4pi8bm7mpk77av1a0q2rdj.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = 'uPqJkPdCiKafQkyClDAt8GU_';

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube.readonly');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
  FILTER_SANITIZE_URL);
  $client->setRedirectUri($redirect);
$youtube = new Google_YoutubeService($client);

if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
	echo "<p>خطاً بدخول اللوحة بشكل غير قانوني</p>";
    die;
  }

  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: ' . $redirect);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);

}

//$client->getAccessToken()."<br><br><br>"; 
//$token = $client->getAccessToken();

//$json = file_get_contents($token);
$json_output = json_decode($client->getAccessToken());
$token = $json_output->access_token;   



//youtubefollowers($user)

if ($client->getAccessToken()) {
    
    $userid = getYoutubeData($token);



} else {
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;

  $authUrl = $client->createAuthUrl();
}
function getYoutubeData($token)
{   
    $json_url ='https://www.googleapis.com/youtube/v3/channels?part=contentDetails&mine=true&access_token='.$token.'';
    $json = file_get_contents($json_url);
    $json_output = json_decode($json);
    
    //print_r($json_output);
    
    //Extract the likes count from the JSON object
    if($json_output->items[0]->id){
            $id = $json_output->items[0]->id;
    }else{
            $id = "";
    }
    return $id;
}

?>



<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">
            <div class="container-fluid">
<br>
<?php 
if (isset($_POST['rem'])){

    $response = $db->prepare('SELECT * FROM youtube');
    $response->execute();
    $yt = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($yt as $check) {

        if ($check['cdb'] == $client_db){
			$room = $check['CID'];
			$ytrank = $check['sgroup'];

			$hisname = '[B][COLOR=red][URL=client://82/'.$client_info["client_unique_identifier"].']'.$client_info["client_nickname"].'[/URL][/COLOR][/B]';
				if($room != 0){
					$ts3_VirtualServer->channelGetById($room)->message("[B] ". $hisname." تم حذف الغرفة من قبل المالك : ");
					$ts3_VirtualServer->channelDelete($room, $force=TRUE);
				}
			$ts3->serverGroupClientDel($ytrank, $client_db);
				$stmt = $db->prepare('DELETE FROM youtube WHERE cdb = :cb');
				$stmt->bindValue(':cb',$client_db,PDO::PARAM_INT);
				$stmt->execute();
				$stmt->CloseCursor(); 
			unset($_SESSION['state']);
			unset($_SESSION['token']);


			$ts3_VirtualServer->clientGetByDbid($client_db)->poke("[B]تم الغاء ربط حسابك في اليوتيوب !");

			echo'
					<center><meta http-equiv="refresh" content="4;url=Youtuber"><div class="alert alert-info alert-danger alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
				 <center>        <strong>تم الغاء ربط حسابك في اليوتيوب ! </strong></center> 
					</div>
			';
				$_SESSION['yt'] = microtime(true)+1;
			die;
		}
	}
}


 $response = $db->prepare('SELECT * FROM youtube WHERE cdb = :db');
    $response->bindValue(':db',$client_db,PDO::PARAM_STR);

    $response->execute();
    $yt = $response->fetch();
    $response->CloseCursor();
		    if($yt) {


$sub = $yt['sub'];
$view = $yt['views'];
$vid = $yt['videos'];
$img = $yt['img'];
$username = $yt['name'];
$sgroup = $yt['sgroup'];


echo '<center>
<div class="col-lg-3 col-md-6">
<div class="card-header">
                                معلومات حسابك
                            </div>
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="'.$img.'" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">'.$username.'</h4>
                                  <p style="background-color:white"> <strong>عدد المتابعين :'.$sub.'</p> 
                                  <p style="background-color:white"> <strong>عدد مقاطع الفيديو :'.$vid.'</p> 
                                  <p style="background-color:white"> <strong>عدد مشاهدات القناة : '.$view.'</p> ';
								  echo '
								<form method="post">

<button type="submit" name="rem" class="btn btn-danger delete" title="'.$username.' "><i class="glyphicon glyphicon-remove"></i> إلغاء ربط قناتي</button></form> 
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>  </div>  </div></center>';


require('includes/footer.php');



die;
}



if(isset($userid)){

$smallrand = rand(1, 99);

$IDChannel = $userid;

$chytowner = 103;
$yt500 = 1245;
$yt1k = 55;
$yt3k = 56;
$yt5k = 57;
$yt10k = 58;
$yt20k = 60;
$yt30k = 1246;
$yt50k = 59;
$yt80k = 61;
$yt100k = 1247;
$yt300k = 62;
$yt500k = 54;
$yt600k = 1248;
$yt800k = 1243;
$yt1m = 1244;
$ytrooms = 2351;

 $response = $db->prepare('SELECT * FROM youtube');
    $response->execute();
    $yt = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($yt as $check) {

        if ($check['YTID'] == $IDChannel and $check['cdb'] != $client_db) {

echo'
                               <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-danger alert-bordered alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <center><strong>لقد تم ربط هذه القناة سابقا من قبل احد الأعضاء !</strong>   </center>
                                </div>
';
        require_once("includes/footer.php");
die;
}elseif($check['YTID'] == $IDChannel and $check['cdb'] == $client_db){
$sub = $check['sub'];
$view = $check['views'];
$vid = $check['videos'];
$img = $check['img'];
$username = $check['name'];
$sgroup = $check['sgroup'];


echo '
<center>
<div class="col-lg-3 col-md-6">
                                <!-- Card -->
                                <div class="card">
                                    <img class="card-img-top img-responsive" src="'.$img.'" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">'.$username.'</h4>
                                  <p style="background-color:white"> <strong>عدد المتابعين :'.$sub.'</p> 
                                  <p style="background-color:white"> <strong>عدد مقاطع الفيديو :'.$vid.'</p> 
                                  <p style="background-color:white"> <strong>عدد مشاهدات القناة : '.$view.'</p> ';
								  echo '
								<form method="post">

<button type="submit" name="rem" class="btn btn-danger delete" title="'.$username.' "><i class="glyphicon glyphicon-remove"></i> إلغاء ربط قناتي</button></form> 
                                    </div>
                                </div>
                                <!-- Card -->
                            </div>  </div>  </div>
</center>

';


require('includes/footer.php');



die;




}
}
echo '<br>' ;
$url_yt = "https://www.googleapis.com/youtube/v3/channels?part=statistics&id=$IDChannel&key=AIzaSyBGXgUQTzO_KqDJ0bcqN3h-Ao9xDRMoKIA";
    $yt_array = file_get_contents($url_yt);
    $ytcount = json_decode($yt_array, true);
    $followed_by = $ytcount['items'][0]['statistics']['subscriberCount'];
$sub = $followed_by;
    $view = $ytcount['items'][0]['statistics']['viewCount'];
    $videoCount = $ytcount['items'][0]['statistics']['videoCount'];
$vid = $videoCount;

    $url_yt = "https://www.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails&id=$IDChannel&key=AIzaSyBGXgUQTzO_KqDJ0bcqN3h-Ao9xDRMoKIA";
    $yt_array = file_get_contents($url_yt);
    $ytcount = json_decode($yt_array, true);
    $des = $ytcount['items'][0]['snippet']['description'];
    $user = $ytcount['items'][0]['snippet']['title'];
    $publishedAt = $ytcount['items'][0]['snippet']['publishedAt'];
    $img = $ytcount['items'][0]['snippet']['thumbnails']["high"]["url"];




	function sgicon($sgid) {
		global $ts3_VirtualServer;

        try {


    $pergroup = $ts3_VirtualServer->serverGroupPermList($sgid,'i_icon_id');
    foreach($pergroup as $per => $key)
    {
if($per == 'i_icon_id'){

return $key['permvalue'];

}
}
                }      
                catch (Exception $e) { 
                        }
}







$yticon1k = sgicon($yt1k);
$yticon5k = sgicon($yt5k);
$yticon3k = sgicon($yt3k);
$yticon10k = sgicon($yt10k);
$yticon20k = sgicon($yt20k);
$yticon30k = sgicon($yt30k);
$yticon50k = sgicon($yt50k);
$yticon80k = sgicon($yt80k);
$yticon100k = sgicon($yt100k);
$yticon300k = sgicon($yt300k);
$yticon500k = sgicon($yt500k);
$yticon600k = sgicon($yt600k);
$yticon800k = sgicon($yt800k);
$yticon1m = sgicon($yt1m);
$yticon500 = sgicon($yt500);
if($followed_by < 1000 && $followed_by >= 500){
$ts3->serverGroupClientAdd($yt500, $client_db);
$rankname = $ts3->serverGroupGetById($yt5k);
echo'
                            <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt5k . '"> '.$rankname.'  

                                </div>
</center>
';

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt500", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';
}elseif($followed_by < 5000 && $followed_by >= 1000){
$ts3->serverGroupClientAdd($yt1k, $client_db);
$rankname = $ts3->serverGroupGetById($yt1k);
echo'
                              <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt1k . '"> '.$rankname.'  

                                </div>
</center>
';

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt1k", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 5000 && $followed_by >= 3000){
$ts3->serverGroupClientAdd($yt3k, $client_db);
$rankname = $ts3->serverGroupGetById($yt5k);
echo'
                            <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt5k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon3k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt3k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';


}elseif($followed_by < 5000 && $followed_by >= 1000){
$ts3->serverGroupClientAdd($yt1k, $client_db);
$rankname = $ts3->serverGroupGetById($yt1k);
echo'
                              <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt1k . '"> '.$rankname.'  

                                </div>
</center>
';

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt1k", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 10000 && $followed_by >= 5000){
$ts3->serverGroupClientAdd($yt5k, $client_db);
$rankname = $ts3->serverGroupGetById($yt5k);
echo'
                            <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt5k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon5k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt5k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 20000 && $followed_by >= 10000){
$ts3->serverGroupClientAdd($yt10k, $client_db);
$rankname = $ts3->serverGroupGetById($yt10k);
echo'
                                <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt10k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon10k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt10k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 30000 && $followed_by >= 20000){
$ts3->serverGroupClientAdd($yt20k, $client_db);
$rankname = $ts3->serverGroupGetById($yt20k);
echo '
                               <center><meta http-equiv="refresh" content="1;url=Youtuber">  <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt20k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3->clientGetByUid($uid)->move($cid);
	$ts3->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon20k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt20k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 50000 && $followed_by >= 30000){
$ts3->serverGroupClientAdd($yt30k, $client_db);
$rankname = $ts3->serverGroupGetById($yt30k);
echo'
                                <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt30k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon30k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt30k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 100000 && $followed_by >= 50000){
$ts3->serverGroupClientAdd($yt50k, $client_db);
try{
$rankname = $ts3->serverGroupGetById($yt50k);
                }      
                catch (Exception $e) { 
                        }

echo'
                                <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt50k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon50k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt50k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 100000 && $followed_by >= 50000){
$ts3->serverGroupClientAdd($yt80k, $client_db);
$rankname = $ts3->serverGroupGetById($yt80k);
echo'
                              <center><meta http-equiv="refresh" content="1;url=Youtuber">   <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt80k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon80k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt80k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 200000 && $followed_by >= 100000){
$ts3->serverGroupClientAdd($yt100k, $client_db);
$rankname = $ts3->serverGroupGetById($yt100k);
echo'
                                <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt250k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon100k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt100k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 500000 && $followed_by >= 200000){
$ts3->serverGroupClientAdd($yt300k, $client_db);
$rankname = $ts3->serverGroupGetById($yt300k);
echo'
                             <center><meta http-equiv="refresh" content="1;url=Youtuber"> <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt300k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon300k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt300k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 600000 && $followed_by >= 500000){
$ts3->serverGroupClientAdd($yt500k, $client_db);
$rankname = $ts3->serverGroupGetById($yt500k);
echo'
                               <center><meta http-equiv="refresh" content="1;url=Youtuber">  <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt500k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon500k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt500k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 800000 && $followed_by >= 600000){
$ts3->serverGroupClientAdd($yt800k, $client_db);
$rankname = $ts3->serverGroupGetById($yt800k);
echo'
                              <center><meta http-equiv="refresh" content="1;url=Youtuber">   <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt800k . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon800k));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt800k", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();
echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by >= 1000000){
$ts3->serverGroupClientAdd($yt1m, $client_db);
$rankname = $ts3->serverGroupGetById($yt1m);
echo'
                              <center><meta http-equiv="refresh" content="1;url=Youtuber">   <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط القناة بنجاح <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $yt1m . '"> '.$rankname.'  

                                </div>
</center>
';
$cid = $ts3_VirtualServer->channelCreate(array(
	"channel_name" =>  ''.$nickname.''.$smallrand.'',
	"channel_topic" => "YouTuber |Sub $followed_by +",
	"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
	"channel_flag_permanent" => TRUE,
	"cpid"                   => "$ytrooms",
	));
	$ts3_VirtualServer->clientGetByUid($uid)->move($cid);
	$ts3_VirtualServer->clientGetByUid($uid)->setChannelGroup($cid , $chytowner);
try{
$ts3->channelGetById($cid)->modify(array("channel_icon_id" => $yticon1m));
                }      
                catch (Exception $e) { 
                        }

        $stmt= $db->prepare('INSERT INTO youtube ( name, img, cdb, creation_date, publishedAt, sub, views, videos, sgroup, CID, YTID) 
                             VALUES (:nem, :img, :cdb, NOW(), :At, :sb, :view, :vid, :group, :cid, :ytid)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':At',"$publishedAt",PDO::PARAM_STR);
        $stmt->bindValue(':sb',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':view',"$view", PDO::PARAM_INT);
        $stmt->bindValue(':vid',"$videoCount", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$yt1m", PDO::PARAM_INT);
        $stmt->bindValue(':cid',"$cid", PDO::PARAM_INT);
        $stmt->bindValue(':ytid',"$IDChannel", PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->CloseCursor();

echo'<META HTTP-EQUIV="refresh" CONTENT="2">';

}elseif($followed_by < 1000){
echo'
                              <center><meta http-equiv="refresh" content="3;url=Youtuber">   <div class="alert alert-danger alert-bordered alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                   <center> <strong>للأسف!</strong> لا يوجد عدد كافي من المشتركين الحد الأدنى  ألف مشترك.</center>
                                </div>
';
 require 'includes/footer.php'; 
die;
}


}
?>
				<div class="row">
				
					<div class="col-md-4">
					</div>
					
				<!-- Youtube Link Card -->
					<div class="col-md-4">
                        <div class="card border-danger animated swing">
                            <div class="card-header bg-danger">
                             <center>   <h4 class="m-b-0 text-white">ربط القناة</h4> </center>
							</div>
							<?php if(isset($error_message)){
echo $error_message; 
}?>
                            <div class="card-body">
                                <center><img class="flash animated" src="assets/images/yt-logo1.gif" width="300" height="300"></center>
								<hr>
                                <p class="card-text">فائدة رتبت اليوتيوب : توثيق حسابك في التيم سبيك وتمكنك من انشاء روم خاص بك للاعلان عن جميع نشاطات قناتك</p>
                                <center><a  href="<?php echo $authUrl; ?>" class="btn waves-effect waves-light btn-outline-danger"> <i class="fa fa-youtube fa-4x "></i> </a></center>
                            </div>
                        </div>
                    </div>
					
					<div class="col-md-4">
					</div>
				</div>
            </div>
        </div>
<?php require_once('includes/footer.php'); ?>