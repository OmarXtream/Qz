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
                                        <th><i class="fa fa-bullhorn"></i> الإسم ب تيم سبيك</th>
                                    </tr>
                                        </thead>
                                <tbody>
<?php


$response = $db->prepare('SELECT *
FROM insta 
ORDER BY follow DESC LIMIT 10
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
        $username = htmlspecialchars($top['username']);
        $img = $top['img'];
        $cdb = (int)$top['cdb'];
        $sgroup = (int)$top['sgroup'];
        $followers = $top['follow'];
        $tari5 = htmlspecialchars($top['creation_date']);
$tsname = $ts3_VirtualServer->clientGetNameByDbid("$cdb");
$icon = $ts3_VirtualServer->serverGroupGetById($sgroup)->iconDownload();
if (!empty($icon)){
$sicon = '<img  src="icon.php?id='. $sgroup . '">';
}

echo'

                                    <tr>
                                        <td><span class="label label-danger label-mini">'.$mrkz.'</span></td>
                                        <td><a target="_blank" href="https://www.instagram.com/'.$name.'"> <img class="img-circle" width="60" src="'.$img .'" alt=" "width="40"><strong>'.$username.'</strong><a class="task-thumb" target="_blank" href="https://www.instagram.com/'.$name.'"></a></td>
                                        <td><span class="label label-info label-mini">'.$followers.'</span> </td>
                                        <td class="hidden-phone"><strong>'.secure($tsname['name']).'</strong></td>

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
