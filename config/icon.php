<?php

if(isset($_GET['id']) and !empty($_GET['id']) and ctype_digit($_GET['id'])) {
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once ("TeamSpeak3/TeamSpeak3.php");
require_once('config.php');
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");

$group = $ts3_VirtualServer->serverGroupGetById($_GET['id']);
$icon = $group->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}


?>