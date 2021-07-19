<?php
if(isset($_GET['id']) and !empty($_GET['id']) and ctype_digit($_GET['id'])) {
        require_once("config.php");

$rand = rand(100,900);

require_once("libraries/TeamSpeak3/TeamSpeak3.php");
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");

$group = $ts3_VirtualServer->serverGroupGetById($_GET['id']);
$icon = $group->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}
if(isset($_GET['cid']) and !empty($_GET['cid']) and ctype_digit($_GET['cid'])) {
        require_once("config.php");

$rand = rand(100,900);

require_once("libraries/TeamSpeak3/TeamSpeak3.php");
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");

$group = $ts3_VirtualServer->channelGroupGetById($_GET['cid']);
$icon = $group->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}

if(isset($_GET['chn']) and !empty($_GET['chn']) and ctype_digit($_GET['chn'])) {
        require_once("config.php");

$rand = rand(100,900);

require_once("libraries/TeamSpeak3/TeamSpeak3.php");
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");

$group = $ts3_VirtualServer->channelGetById($_GET['chn']);
$icon = $group->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}
if(isset($_GET['ic']) and !empty($_GET['ic']) and ctype_digit($_GET['ic'])) {
        require_once("config.php");

$rand = rand(100,900);

require_once("libraries/TeamSpeak3/TeamSpeak3.php");
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");

$group = $ts3_VirtualServer->clientGetByDbid($_GET['ic']);
$icon = $group->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}
if(isset($_GET['sr']) and !empty($_GET['sr']) and ctype_digit($_GET['sr'])) {
        require_once("config.php");

$rand = rand(100,900);

require_once("libraries/TeamSpeak3/TeamSpeak3.php");
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");
$icon = $ts3_VirtualServer->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}


?>
 