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
$con->set_charset("utf8");		
try 
{
  $db = new PDO('mysql:host=localhost;dbname=yt;charset=utf8', 'root', 'qvaGN6vy9EaZMw5l');
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
                                <h4 class="card-title">VIP Youtuber</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
									<table id="demo-foo-addrow" class="table m-t-30 table-hover color-table red-table contact-list footable-loaded footable" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th class="footable-sortable">الاسم<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">عدد المشتركين<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">عدد المقاطع<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">عدد المشاهدات<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">الاسم بالتيم سبيك<span class="footable-sort-indicator"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php					$hideit = array();
						 $auto = array(11);
						 $vipx = 628;
							 $hostz = "localhost";
							 $userz = "root";
							 $passz = "qvaGN6vy9EaZMw5l";
						     $dbz = "yt"; 
							$con = new mysqli($hostz, $userz, $passz, $dbz);
							if($con->connect_error){
								die("Failed To COnnect!");
							}
							$sql = "SELECT * FROM youtube";
							$res = $con->query($sql);
							while($data = $res->fetch_assoc()){
								$idz = $data["id"];
								// if(!in_array($idz, $auto)){ continue; }
								$subsz = $data["sub"];
								$viewz = $data["views"];
								$cdb = $data["cdb"];
								$xserv = array_keys($ts3_VirtualServer->clientGetServerGroupsByDbid($cdb));
								if(!in_array($vipx, $xserv)){
									continue;
								}
								array_push($hideit, $cdb);
								$tsnamez = $ts3_VirtualServer->clientGetNameByDbid("$cdb");
								$vidsz = $data["videos"];
								$namez = $data["name"];
								$imgz = $data["img"];
								$IDChannelz = $data['YTID'];
								echo '<tr class="footable-odd" style="">
								<td class="text-center"  ><a target="_blank" href="https://www.youtube.com/channel/'.$IDChannelz.'"><a class="avatar avatar-online" target="_blank" href="https://www.youtube.com/channel/'.$IDChannelz.'">
								<img class="img-avatar img-avatar48" src="'.$imgz .'" alt="user" width="40" class="img-circle">
								<strong>'.htmlspecialchars($namez).'</strong></a></td>
								<td class="text-center"  >'.$subsz.'</span> </td>
								<td class="text-center"  >'.$vidsz.'</span></td>
								<td class="text-center"  >'.$viewz.'</span></td>
								<td class="hidden-phone" class="text-center"  ><strong>'.htmlspecialchars($tsnamez['name']).'</strong></td>
								</tr>';
							}	
							$con->close();
?>											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">افضل ( 10 ) قنوات</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
									<table id="demo-foo-addrow" class="table m-t-30 table-hover color-table red-table contact-list footable-loaded footable" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th class="footable-sortable">اسم القناه<span class="footable-sort-indicator"></span></th>											
                                                <th class="footable-sortable">المركز<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">عدد المشتركين<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">عدد المقاطع<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">عدد المشاهدات<span class="footable-sort-indicator"></span></th>
                                                <th class="footable-sortable">الاسم بالتيم سبيك<span class="footable-sort-indicator"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php


$response = $db->prepare('SELECT *
FROM youtube 
ORDER BY sub DESC LIMIT 10
           ');
$response->execute();
$tops = $response->fetchAll();
$response->CloseCursor();

if($response->rowCount() > 0 )
{
$mrkz = 0;
    foreach($tops as $top) 
    {
$mrkz++;
        $id = (int)$top['id'];
        $name = htmlspecialchars($top['name']);
        $img = $top['img'];
        $cdb = (int)$top['cdb'];
		if(in_array($cdb, $hideit)){
			continue;
		}
        $sgroup = (int)$top['sgroup'];
        $followers = $top['sub'];
        $IDChannel = $top['YTID'];
        $tari5 = htmlspecialchars($top['creation_date']);

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

$tsname = $ts3_VirtualServer->clientGetNameByDbid("$cdb");
$icon = $ts3_VirtualServer->serverGroupGetById($sgroup)->iconDownload();
if (!empty($icon)){
$sicon = '<img src="config/icon?id='. $sgroup . '">';
}
if($sub != $followers){
        $stmt = $db->prepare('UPDATE youtube 
                SET sub = :sb
                WHERE YTID = :ch
                ');
        $stmt->bindValue(':sb', $sub, PDO::PARAM_STR);
        $stmt->bindValue(':ch', $IDChannel,  PDO::PARAM_INT);
        $stmt->execute();        
        $stmt->CloseCursor();
}
echo'
								<tr class="footable-odd">
								<td class="text-center" style="width: 1px;" ><a target="_blank" href="https://www.youtube.com/channel/'.$IDChannel.'"><a class="avatar avatar-online" target="_blank" href="https://www.youtube.com/channel/'.$IDChannel.'"><img class="img-avatar img-avatar48" src="'.$img .'" alt="user" width="40" class="img-circle"><strong>'.htmlspecialchars($name).'</strong></a></td>
								<td class="text-center" style="width: 1px;" >'.$mrkz.'</span></td>
                                <td class="text-center" style="width: 1px;" >'.$followers.'</span></td>
								<td class="text-center" style="width: 1px;" >'.$videoCount.'</span></td>	
								<td class="text-center" style="width: 1px;" >'.$view.'</span></td>
								<td class="hidden-phone" class="text-center" style="width: 1px;" ><strong>'.htmlspecialchars($tsname['name']).'</strong></td>								
								</tr>
								<tr>
';
    }
}
else
{
    echo '<h2 class="errors"> لا يوجد اي قناة مرتبطه حاليا  </h2><hr>';
}

?>													
										
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
<?php require_once('includes/footer.php'); ?>