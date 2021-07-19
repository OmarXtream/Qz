
<?php require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
?>
        <div class="page-wrapper">
        <div class="container-fluid">
		</br>
<?php 
$arrclients = $ts3_VirtualServer->clientList(array("client_type" => 0));
$online = false;
foreach($arrclients as $cl){	
	if($cl["connection_client_ip"] == $_SERVER){
		$client = $cl;
		$online = true;
		break;
	}
}



$mdbid = $client_info["client_database_id"];

$sql = "SELECT * FROM clans";

$res = $con->query($sql);
$clanid = 0;
while($data = $res->fetch_assoc()){
	$owner = $data["owner"];
	if($owner == $mdbid){
		$banner = $data["banner"];
		$adv = $data["adv"];	
		$rules = $data["rules"];
		$updates = $data["updates"];		
		$g1 = $data["g1"];		
		$g2 = $data["g2"];	
		$g3 = $data["g3"];			
		$clanid = $data["id"];
		$froom = unserialize($data["rooms"]);
		$cname = $data["name"];
		$sgid = $data["sgid"];
		break;
	}
}

if($clanid == 0){
echo('<script>
           swal({title: "عذراً",text: "You Dont own any Clan! - ليس لديك كلان للتحكم به",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');			
}
if(isset($_GET["page"]) && $_GET["page"] > 1){
	$num = $_GET["page"];
	$max = 10;
	$next = $num * $max;
	$cls = array_slice($ts3_VirtualServer->serverGroupClientList($sgid), $next, 10);
}else{
	$cls = array_slice($ts3_VirtualServer->serverGroupClientList($sgid), 0, 10);
}


if(isset($_POST["remove"])){
	$sql = "SELECT * FROM clans";
	$res = $con->query($sql);
	$del = false;
	$numz = 0;
	while($data = $res->fetch_assoc()){
		if($data["owner"] == $mdbid){
			$numz = $data["num"];
			$ts3_VirtualServer->serverGroupDelete($data["sgid"], true);
			$rms = unserialize($data["rooms"]);
			foreach($rms as $room){
				$ts3_VirtualServer->channelDelete($room, true);
			}
			$id = $data["id"];
			$sql = "DELETE FROM clans WHERE id='$id'";
			$con->query($sql);
			$del = true;
			
		}
	}
	if($del === true){
		// $sql = "SELECT * FROM clans";
		// $res = $con->query($sql);
		// while($data = $res->fetch_assoc()){
			// $id = $data["id"];
			// $num = $data["num"];
			// if($num != 0 || $num != 1){
				// $num = $num -1;
				// $sql = "UPDATE clans SET num='$num' WHERE id='$id'";
			// }
			
		// }
		$sql = "SELECT * FROM clans WHERE num > $numz";
		$res = $con->query($sql);
		if($res->num_rows > 0){
			while($dataz = $res->fetch_assoc()){
				$numt = $dataz["num"];
				$idx = $dataz["id"];
				if($numt != 0 || $numt != 1){
					$numt = $numt - 1;
					$sqlz = "UPDATE clans SET num='$numt' WHERE id='$idx'";
					$con->query($sqlz);
				}
			}
		}
	}
	
echo('<script>
           swal({title: "حذف الكلان",text: "تم حذف الكلأن!",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');
		   
}else if(isset($_POST["block"])){
	
	$blx = key($_POST["block"]);
	if($blx == $owner || !in_array($blx, $cls)){
	}
	$brom = $froom[1];
	$ts3_VirtualServer->clientSetChannelGroup($blx, $brom, $Cantjoinclan);
	$ts3_VirtualServer->serverGroupClientDel($sgid, $blx);
		$client1 = $ts3_VirtualServer->clientInfoDb($blx);
		
	$sql = "SELECT blocked FROM clans WHERE id='$clanid'";
	$res = $con->query($sql)->fetch_assoc()["blocked"];
	if(!empty($res)){
		$ten = unserialize($res);
	}else{
		$ten = array();
	}
	array_push($ten, $blx);
	$nin = serialize($ten);
	$sql = "UPDATE clans SET blocked='$nin' WHERE id='$clanid'";
	$con->query($sql);
	
	try{$blxx = $ts3_VirtualServer->clientGetByDbid($blx);}catch (TeamSpeak3_Exception $e){
	}
	
	foreach($froom as $brm){
		$bb = $ts3_VirtualServer->channelGetById($brm);
		$brs = $bb->clientList(array("client_type" => 0));
		foreach($brs as $clo){
			$clod = $clo["client_database_id"];
			if($clod == $blx){
				$blxx->kick(TeamSpeak3::KICK_CHANNEL);
			}
		}
	}
	
	$bls = $ts3_VirtualServer->channelGetById($froom[1])->subChannelList();
	foreach($bls as $bl){
		$cbl = $bl->clientList(array("client_type" => 0));
		foreach($cbl as $dbl){
			$dbld = $dbl["client_database_id"];
			if($dbld == $blx){
				$blxx->kick(TeamSpeak3::KICK_CHANNEL);
			}
		}
	}
	
echo('<script>
           swal({title: "طرد الاعضاء",text: "تم طرد العضو بنجاح ![  '.$client1["client_nickname"].'  ]",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');	
		   
}else if(isset($_POST["add"])){
	$bli = key($_POST["add"]);
	$sql = "SELECT blocked FROM clans WHERE id='$clanid'";
	$res = $con->query($sql)->fetch_assoc()["blocked"];
	if(!empty($res)){
		$ten = unserialize($res);
		if(in_array($bli, $ten)){
			if(($key = array_search($bli, $ten)) !== false){
				array_splice($ten, $key, 1);
			}
			$nin = serialize($ten);
			$sql = "UPDATE clans SET blocked='$nin' WHERE id='$clanid'";
			$con->query($sql);
			$brom = $froom[1];
			$ts3_VirtualServer->clientSetChannelGroup($bli, $brom, $clanjoingroup);
			$ts3_VirtualServer->serverGroupClientAdd($sgid, $bli);
		}
	}
echo('<script>
           swal({title: "الاعفاء عن العضو",text: "تم الاعفاء عن العضو بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');	
}else if(isset($_POST["upso"]) && isset($_POST["upgrade"]) && isset($_POST["cgrop"])){
	$ccrp = array(114 ,10, 11, 31);
	$mem = $_POST["upgrade"];
	$grp = $_POST["cgrop"];
	if($mem == $owner || !in_array($grp, $ccrp) || !in_array($mem, $cls)){
echo('<script>
           swal({title: "ترقيه الاعضاء",text: "تم ترقية العضو بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
	}
	
	try{
		$ts3_VirtualServer->clientSetChannelGroup($mem, $froom[1], $grp);
	}catch (TeamSpeak3_Exception $e){
	}
	header("Location: c-control.php");
}else if(isset($_POST["submit"]) && isset($_FILES['iconz'])){
		if(isset($_SESSION['Room_icon']) and $_SESSION['Room_icon'] >= microtime(true)){
die('<script>
           swal({title: "خطأ",text: "عذراً! لقد قمت برفع صوره مؤخرآ , الرجاء المحاولة في وقت آخر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');				
}else{
	$_SESSION['Room_icon'] = microtime(true)+30;
}
	$upfolder = "inc/uploads".basename($_FILES["iconz"]["name"]);
	$imtype = pathinfo($upfolder, PATHINFO_EXTENSION);
	$check = getimagesize($_FILES["iconz"]["tmp_name"]);
	if($check === false) {
echo('<script>
           swal({title: "رفع الصور",text: "Invalid Image Type! - لم يتم وضع صوره !",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
	
    }	
	$width = $check[0];
	$height = $check[1];
	if($width > 16 || $height > 16){
	echo'<center>';

echo('<script>
           swal({title: "عذراً",text: "يجب ان يكون حجم الصوره 16×16",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');				
	
	}
	
	if (file_exists($upfolder)) {
echo('<script>
           swal({title: "عذراً",text: "Image Is Already Uploaded! - تم رفع الصوره من قبل!",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');			
		
	}
	
	if ($_FILES["iconz"]["size"] > 8192) {
die('<script>
           swal({title: "عذراً",text: "Image Is Too Large Max 8kb. - لأيتخطي حجم الصوره 8KB ",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');			
	}
	
	if(!$check['mime'] == 'image/png' || !$check['mime'] == 'image/gif'){
die('<script>
           swal({title: "عذراً",text: "You Only Can Upload Png - Gif Images! - لأيمكن رفع الأ GIF - Png ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');			
		
	}
	
	if(is_uploaded_file($_FILES["iconz"]["tmp_name"])){
        $img = file_get_contents($_FILES["iconz"]["tmp_name"]);
		try {
			$imgid = $ts3_VirtualServer->iconUpload($img);
		}catch(Exception $e) {
			$imgid = crc32($img);
		}
		$icon = "i_icon_id";
		$ts3_VirtualServer->serverGroupPermAssign($sgid, $icon, $imgid, false, true);
		$tkk = $ts3_VirtualServer->channelGetById($froom[1])->subChannelList();
		foreach($tkk as $tks){
			$tks->permAssign($icon, $imgid);
		}
    } else {
die('<script>
           swal({title: "عذراً",text: "لأ يمكن رفع هذه الصورة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/coins");}else {window.location.replace("https://panel.q-z.us/coins");}})</script>');		
    }
echo('<script>
           swal({title: "تم",text: "تعين الايقونه",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}else if(isset($_POST["chroom"]) && isset($_POST["roomc"]) && isset($_POST["dzl"])){
	$mode = $_POST["roomc"];
	$rm = $_POST["dzl"];
	$dbl = $ts3_VirtualServer->channelGetById($froom[1])->subChannelList();
	$xwz = array();
	foreach($dbl as $dwl){
		$cis = $dwl["cid"];
		array_push($xwz, $cis);
	}
	
	if(!in_array($rm, $xwz)){
		header("Location: c-control.php");
	}
	
	$rm = $ts3_VirtualServer->channelGetById($rm);
	
	if($mode == "music"){
		$rm->modify(array('channel_codec' => TeamSpeak3::CODEC_OPUS_MUSIC));
echo('<script>
           swal({title: "تم",text: "تحويل الروم الي ميوزك",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
	}else if($mode == "norm"){
		$rm->modify(array('channel_codec' => TeamSpeak3::CODEC_OPUS_VOICE));
echo('<script>
           swal({title: "تمت",text: "استرجاع الروم الي العادي",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
	}else if($mode == "mchat"){
		$rm->permAssign("b_client_channel_textmessage_send", 0);
echo('<script>
           swal({title: "تم",text: "قفل الشات",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
	}else if($mode == "pchat"){
		$rm->permRemove("b_client_channel_textmessage_send");
echo('<script>
           swal({title: "تم",text: "فتح الشات",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');					
	}else if($mode == "mmic"){
		$rm->permAssign("i_client_needed_talk_power", 999999999);
echo('<script>
           swal({title: "تم",text: "قفل المايكات",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
	}else if($mode == "pmic"){
		$rm->permRemove("i_client_needed_talk_power");  
echo('<script>
           swal({title: "تم",text: "ازالة قفل المايكات",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
	}else if($mode == "mch"){
		$rm->modify(array('channel_maxclients' => 0));
echo('<script>
           swal({title: "تم",text: "فتح الروم",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
	}else if($mode == "pch"){
		$rm->modify(array('channel_maxclients'=>-1));
echo('<script>
           swal({title: "تم",text: "اغلاق الروم",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');					
	}else if($mode == "nospam"){
		$rm->permAssign("b_client_ignore_antiflood", 0);
echo('<script>
           swal({title: "تم",text: "ايقاف الاسبام بالروم",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');					
	}else if($mode == "spam"){
		$rm->permRemove("b_client_ignore_antiflood", 0);
echo('<script>
           swal({title: "تم",text: "تم ارجاع الروم الي الوضع الطبيعي",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
	}else{
		header("Location: c-control.php");
	}
	header("Location: c-control.php");
}
?>
<?php
if(isset($_POST['msg']) and isset($_POST['sendmsg']) and isset($_POST['msgtype'])){
$msg = $_POST['msg'];
if($_POST['msgtype'] == 'msgpr'){
$ts3_VirtualServer->selfUpdate(array('client_nickname' => "QZ | $cname"));
$ts3_VirtualServer->serverGroupGetById($sgid)->message($msg);
}
if($_POST['msgtype'] == 'poke'){
try{
	$ts3_VirtualServer->selfUpdate(array('client_nickname' => "QZ | $cname"));
foreach($ts3_VirtualServer->clientList(array("client_type" => 0)) as $clients) {
$ggid = explode(",", $clients["client_servergroups"]);

if(in_array($sgid,$ggid)){

$clients->poke("$msg");


}
}
              }  catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }

}

echo('<script>
           swal({title: "تم",text: "تم إرسال الرسالة بنجاح![  '.$msg.'  ]",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		


}

?>


<?php 
if(isset($_POST["cloesclan"])){
	
	$blx = key($_POST["cloesclan"]);
	
	$sql = "SELECT status FROM clans WHERE id='$clanid'";
	$res = $con->query($sql)->fetch_assoc()["status"];
	array_push($ten, $blx);
	$sql = "UPDATE clans SET status='1' WHERE id='$clanid'";
	$con->query($sql);
echo('<script>
           swal({title: "تم",text: "قفل الانضمام",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
	
}

if(isset($_POST["openclan"])){
	
	$blx = key($_POST["openclan"]);
	
	$sql = "SELECT status FROM clans WHERE id='$clanid'";
	$res = $con->query($sql)->fetch_assoc()["status"];
	array_push($ten, $blx);
	$sql = "UPDATE clans SET status='' WHERE id='$clanid'";
	$con->query($sql);
	echo('<script>
           swal({title: "تم",text: "فتح الانضمام",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
?>	

<?php 
// البنر ورسالة الصفحة الرائسية

if(isset($_POST["submithome"]) && isset($_POST["news"]) && isset($_POST["img"])){
	$con->set_charset("utf-8");
	$news = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["news"])));
	if(strlen($news) > 100){
die('<script>
           swal({title: "خطأ",text: "كلمات شريط الاعلان كثيرة جدأ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');		
		
	}	
	$img = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["img"])));
	if(strlen($img) > 150){
die('<script>
           swal({title: "خطأ",text: "رابط الصورة كبير جدأ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');		
	}
	$sql = "SELECT banner FROM clans WHERE id='$clanid'";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE clans SET adv='$news', banner='$img' WHERE id='$clanid'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO clans (id, adv, banner) VALUES (NULL, '$news', '$img')";
		$con->query($sqlz);
	}
	echo('<script>
           swal({title: "تم",text: "تحديث صوره ورسائل الصفحة انضمام الكلان",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
?>							

<?php 
// اخبار وتحديثات الكلأان

if(isset($_POST["submitupdates"]) && isset($_POST["updates"])){
	$con->set_charset("utf-8");
	$updates = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["updates"])));
	if(strlen($updates) > 300){
die('<script>
           swal({title: "خطأ",text: "هذا الكلام كثير للغاية",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');
	}
	$sql = "SELECT updates FROM clans WHERE id='$clanid'";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE clans SET updates='$updates' WHERE id='$clanid'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO clans (id, updates) VALUES (NULL, '$updates')";
		$con->query($sqlz);
	}
		echo('<script>
           swal({title: "تم",text: "تحديث الاخبار التحديات",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}
?>

<?php 
// القوانين والاحكام

if(isset($_POST["submitrules"]) && isset($_POST["rules"])){
	$con->set_charset("utf-8");
	$rules = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["rules"])));
	if(strlen($rules) < 50){
die('<script>
           swal({title: "خطأ",text: "هذا الاعلان قصير جدأ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');
	}
	$sql = "SELECT rules FROM clans WHERE id='$clanid'";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE clans SET rules='$rules' WHERE id='$clanid'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO clans (id, rules) VALUES (NULL, '$rules')";
		$con->query($sqlz);
	}
		echo('<script>
           swal({title: "تم",text: "تحديث القوانين",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
?>

<?php 
if(isset($_POST["submitgames"]) && isset($_POST["g1"]) && isset($_POST["g2"])&& isset($_POST["g3"])){
	$con->set_charset("utf-8");
	$g1 = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["g1"])));
	if(strlen($g1) > 20){
die('<script>
           swal({title: "خطأ",text: "لأ يمكنك كتابة اكثر من 10 حروف",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');	
	}	
	$g2 = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["g2"])));
	if(strlen($g2) > 20){
die('<script>
           swal({title: "خطأ",text: "لأ يمكنك كتابة اكثر من 10 حروف",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');	
	}	
	$g3 = $con->real_escape_string(stripcslashes(htmlspecialchars($_POST["g3"])));	
	if(strlen($g3) > 20){
die('<script>
           swal({title: "خطأ",text: "لأ يمكنك كتابة اكثر من 10 حروف",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-control");}else {window.location.replace("https://panel.q-z.us/c-control");}})</script>');	
	}
	$sql = "SELECT g1 FROM clans WHERE id='$clanid'";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$id = $res->fetch_assoc()["id"];
		$sqlz = "UPDATE clans SET g1='$g1', g2='$g2' , g3='$g3' WHERE id='$clanid'";
		$con->query($sqlz);
	}else{
		$sqlz = "INSERT INTO clans (id, g1, g2, g3) VALUES (NULL, '$g1', '$g2', '$g3')";
		$con->query($sqlz);
	}
		echo('<script>
           swal({title: "تم",text: "تحديث الالعاب",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}
?>			
		<div class="row">
			<div class="col-md-6">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">ترقيه اعضاء الكلان</h4>
					</div>
                    <div class="card-body">
						                            <form method="post">

												<select class="form-control" name="upgrade">
												<?php
												$xy = $ts3_VirtualServer->serverGroupClientList($sgid);
												foreach($xy as $cly){
													$name = $cly["client_nickname"];
													$cldb = $cly["cldbid"];
													if($cldb == $owner){
													 continue;
													}
													echo "<option value='$cldb'>$name</option>";
												}
												
												// foreach($cls as $cl){
												// $name = $cl["client_nickname"];
												// $cldb = $cl["cldbid"];
												// if($cldb == $owner){
													// continue;
												// }
												// echo "<option value='$cldb'>$name</option>";
												// }
												?>
												</select>&nbsp; 

						<br>
						<br>
												<select class="form-control" name="cgrop"> 
												<option value="114">Head Leader</option>												
												<option value="10">Leader</option>
												<option value="11">Manager</option>
												<option value="31">Member</option>
												</select>
                    </div>				
					<center><div class="col-md-4">
                      <input class="btn btn-rounded btn-block btn-outline-success" type="submit" name="upso" id="sa-close16"  value="تحديث الرتبة">
                    </div></center>
					<br>
					
					
                </div>
            </div>
			<div class="col-md-6">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">التحكم برومات الكلأن</h4>
					</div>
					                            <form method="post">

                    <div class="card-body">
						
												<select class="form-control" name="dzl">
												<?php
												$romat = $ts3_VirtualServer->channelGetById($froom[1])->subChannelList();
												foreach($romat as $room){
													$cid = $room["cid"];
													echo "<option value='$cid'>$room</option>";
												}
												?>
												</select>&nbsp; 
						<br>
						<br>
												<select class="form-control" name="roomc"> 
												<option value="music">تحويل الروم الى ميوزك</option>
												<option value="norm">تحويل الروم الى عادى</option>
												<option value="mchat">قفل الشات</option>
												<option value="pchat">فتح الشات</option>
												<option value="mmic">قفل مايكات</option>
												<option value="pmic">فتح مايكات</option>
												<option value="mch">قفل الروم</option>
												<option value="pch">فتح الروم</option>
												<option value="nospam">الغاء الاسبام بالروم</option>
												<option value="spam">ارجاع الغاء الاسبام</option>			
												</select>	
                    </div>
					<center><div class="col-md-4">
                      <input  class="btn btn-rounded btn-block btn-outline-success" type="submit" name="chroom" id="sa-close16" value="تحديث الروم">
                    </div></center>
					<br>
					
					
                </div>
            </div>
			<div class="col-md-6">
			                            <form method="post">

                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">رساله جماعيه</h4>
					</div>
                    <div class="card-body">
						
												<select class="form-control" name="msgtype"> 
												<option value="msgpr">رسالة علخاص</option>
												<option value="poke">تنبيه | بوك</option>
												</select>
						<br>
						<br>
						<div class="col-md-8">
						<input type="text" class="form-control text-center" name="msg" style="width: 250px;position:absolute; right: 35%;" id="cname" placeholder="أدخل الرسالة..">
						</div>
					</div>
					<br>
					<div class="card-body">
					<center><div class="col-md-4">
					
                      <input type="submit" name="sendmsg" id="sa-close16" value="إرسال الرسالة" class="btn btn-rounded btn-block btn-outline-success">
                    </div></center>
					</div>
					<br>                            </form>

					
					
                </div>
            </div>
			<div class="col-md-6">
			<form action="c-control" method="post" enctype="multipart/form-data">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">رفع ايقونة للكلان</h4>
					</div>
                    <center><div class="card-body">
					<br>
												<input type="file" name="iconz"><br/>
					
					</div></center>
					<br>
					<div class="card-body">
					<center><div class="col-md-4">
                     <input value="رفع الايقونه" name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-primary">
                    </div></center>
					</div>
					<br>
                </div>
									                            </form>
            </div>
			
			<div class="col-md-6">
			                            <form method="post">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">تغير حاله الانضمام</h4>
					</div>
                    <center><div class="card-body">
						<br>
						<br>
<form method="post">&nbsp; 
					<div class="row">
					<div class="col-md-6">
                      <input type="submit" name="openclan" value="فتح الانضمام" class="btn btn-rounded btn-block btn-outline-info">
                    </div>
					<div class="col-md-6">
                      <input type="submit" name="cloesclan" value="غلق الانضمام" class="btn btn-rounded btn-block btn-outline-danger">
                    </div>
                    </div>
					</b></form>
                            </form>
					

					<br>
					</div></center>
					<br>
					<br>
                </div>
            </div>
			
			
			<div class="col-md-6">
				<form method="post">			
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">حذف الكلأان</h4>
					</div>
                    <center><div class="card-body">	
					<div class="col-md-6">
                      <span class="badge bg-danger">لأ يمكنك الارجاع علي الحذف برجاء التاكيد قبل الحذف</span>
                    </div>
					</div></center>
					<br>
					<div class="card-body">
					<center><div class="col-md-4">
                     <input type="submit" name="remove" id="sa-close16" value="حذف الكلأن" class="btn btn-rounded btn-block btn-outline-success">
                    </div></center>
					</div>
					<br>
                </div>
				                            </form>

            </div>
			
			<div class="col-md-6">
			<form class="form-horizontal" method="post">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">قوانين وأحكام الكلان</h4>
					</div>
					<div class="form-group col-md-12 m-t-12">
                    <div class="card-body">
    <input type="hidden" readonly="readonly" name="action" value="ann">
    <input type="hidden" name="Token">    <textarea class="form-control" name="rules" style="direction:rtl;" placeholder="قم بوضع الذي تريدة في قوانين وأحكام الكلان
 .."></textarea><br>
</div>
</div>
											<form class="form-horizontal" method="post">
											  <input type="hidden" readonly="readonly" name="action" value="clr">
											<input type="hidden" name="Token">  											  
											</form>						
					<div class="card-body">
					<center><div class="col-md-4">
                                            <button  name="submitrules" type="submit"  class="btn btn-rounded btn-block btn-outline-success">
                                                <i class="fa fa-check"></i> تحديث
                                            </button>                    </div></center>
					</div>		
                </div>
			</form>
            </div>
			
			
			
			<div class="col-md-6">
			<form class="form-horizontal" method="post">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">أخبار وتحديثات الكلان</h4>
					</div>
					
                    <div class="card-body">


					<div class="form-group col-md-12 m-t-12">
    <input type="hidden" readonly="readonly" name="action" value="ann">
    <input type="hidden" name="Token">    <textarea class="form-control" name="updates" style="direction:rtl;" placeholder="قم بوضع الذي تريدة في أخبار وتحديثات الكلان
 ..."></textarea><br>
</div>
</div>
										<center><div class="col-md-4">
                                            <button  name="submitupdates" type="submit" class="btn btn-rounded btn-block btn-outline-success">
                                                <i class="fa fa-check"></i> تحديث
                                            </button>
											<form class="form-horizontal" method="post">
											  <input type="hidden" readonly="readonly" name="action" value="clr">
											<input type="hidden" name="Token">  											  
											</form>
                                        </div>	</center>				
										<br>
                </div>
            </div>
			
			
			<div class="col-md-6">
<form class="form-horizontal" method="post">			
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">اعلانات الصفحه الرائسية</h4>
					</div>
                    <div class="card-body">
					<div class="form-group col-md-12 m-t-12">
    <input type="hidden" readonly="readonly" name="action" value="ann">
    <input type="hidden" name="Token">    <textarea class="form-control" name="news" style="direction:rtl;" placeholder="قم بوضع الكلام الذي تريدة تحت اسم الكلان ..."></textarea><br>
</div>
					<div class="form-group col-md-12 m-t-12">
    <input type="hidden" readonly="readonly" name="action" value="ann">
    <input type="hidden" name="Token">    <textarea class="form-control" name="img" style="direction:rtl;" placeholder=" قم بوضع رابط الصورة يفضل ان يكون مقاس الصوره 1630×330"></textarea><br>
</div>
</div>					
					<center><div class="col-md-4">
                                            <button  name="submithome" type="submit" class="btn btn-rounded btn-block btn-outline-success">
                                                <i class="fa fa-check"></i> تحديث
                                            </button>
											<form class="form-horizontal" method="post">
											  <input type="hidden" readonly="readonly" name="action" value="clr">
											<input type="hidden" name="Token">  											  
											</form>
											</div>	</center>
											<br><br><br>	
											</form>
											</div>
            </div>
			
			
			<div class="col-md-6">
				<form class="form-horizontal" method="post">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">العابكم</h4>
					</div>
					
                    <div class="card-body">
<div class="form-group">
<input type="text" class="form-control" id="example-text-input" name="g1" placeholder="أكتب اسم اللعبه الأولى هنا">
							<br>
							<br>
<input type="text" class="form-control" id="example-text-input" name="g2" placeholder="أكتب أسم اللعبه الثانيه هنا">
							<br>
							<br><input type="text" class="form-control" id="example-text-input" name="g3" placeholder="أكتب أسم اللعبه الثالثه هنا">
							<br>
							<br>
							<span class="badge bg-danger">حد أقصى فقط 3 ألعاب ولا يمكنك كتابه زياده عن 10 حروف</span>
</div>
					</div>
					
					

					<div class="card-body">
					<center><div class="col-md-4">
                                            <button name="submitgames" type="submit" class="btn btn-rounded btn-block btn-outline-success">
                                                <i class="fa fa-check"></i> تحديث
                                            </button>
											
											  <input type="hidden" readonly="readonly" name="action" value="clr">
											<input type="hidden" name="Token">  											  
											
                    </div></center>
					</div>
	</form>
</div>
            </div>
			
			
			
			
			
			
			
			
			
        </div>
		<div class="col-md-12">
<div class="card">
                            <div class="card-body">
                               <center> <h4 class="card-title">التحكم باعضاء الكلان</h4> </center>
                                <div class="table-responsive">
                                    <table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>المعروف الخاص بالعضو</th>
                                                <th>الرتبه بالرومات	</th>
                                                <th>حاله العضو</th>
                                                <th>حظر العضو من الكلان</th>
                                            </tr>
                                        </thead>
	<?php
	
		$sql = "SELECT blocked FROM clans WHERE id='$clanid'";
		$res = $con->query($sql)->fetch_assoc()["blocked"];
		if(!empty($res)){	
			$ten = unserialize($res);
			foreach($ten as $nin){
				$cli = $ts3_VirtualServer->clientInfoDb($nin);
				$cli["cldbid"] = $cli["client_database_id"];
				array_push($cls, $cli);
			}
		}
		foreach($cls as $cl){
			$name = $cl["client_nickname"];
			$uid = $cl["client_unique_identifier"];
			$clt = $cl["cldbid"];
			$rom = $froom[1];
			$blocked = false;
			$cgrp = end($ts3_VirtualServer->channelGroupClientList(null, $rom, $clt))["cgid"];
			$cgrpz = $ts3_VirtualServer->channelGroupGetById($cgrp)["name"];
			try{$clts = $ts3_VirtualServer->clientGetByDbid($clt);}catch (TeamSpeak3_Exception $e){
				$clts = null;
			}
			if($cgrp == 27){
				$blocked = true;
			}
			
			echo "<tr> <td ><b>$name</b></td> <td ><b>$uid</b></td> <td ><b>$cgrpz</b></td>";
			if($blocked === true){
				echo "<td class='text-warning' ><b>محظور</b></td>";
			}else if(in_array($clts, $arrclients)){
				echo "<td class='text-info' ><b>متصل</b></td>";
			}else{				
				echo "<td class='text-danger' ><b>غير متصل</b></td>";
			}
			
			if($clt == $owner){
				echo "<td >
				<button type='button'disabled class='btn btn-danger btn-circle'><i class='fa fa-heart' title='صحاب الكلان'></i> </button>
				<!-- <b><form method='post'><button type='submit' disabled class='btn btn-danger  delete btn-xs' title='حذف العضو من الكلأن '> <i class='icon-square-cross'></i></button></form></b></td>--></tr>";
			}else if($blocked === true){
				echo "<td ><b><form method='post'><button type='submit' name='add[".$cl["client_database_id"]."]' class='btn btn-success btn-circle' title='فك الحظر' ><i class='fa fa-check'></i></button></form></b></td></tr>";
			}else{
				echo "<td ><b><form method='post'><button type='submit' name='block[$clt]' class='btn btn-danger btn-circle' title='حذف العضو من الكلأن '> <i class='fa fa-plane'></i></i></button></form></b></td></tr>";
			}
			
		}
echo '<ul class="pagination">
				<li class="paginate_button page-item '; if($_GET["page"] == 1 || !isset($_GET["page"])){ echo "active"; } echo '"><a href="?page=1" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 2){ echo "active"; } echo '"><a href="?page=2" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 3){ echo "active"; } echo '"><a href="?page=3" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 4){ echo "active"; } echo '"><a href="?page=4" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 5){ echo "active"; } echo '"><a href="?page=5" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 6){ echo "active"; } echo '"><a href="?page=6" aria-controls="DataTables_Table_0" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 7){ echo "active"; } echo '"><a href="?page=7" aria-controls="DataTables_Table_0" data-dt-idx="7" tabindex="0" class="page-link">7</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 8){ echo "active"; } echo '"><a href="?page=8" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">8</a></li>		
				<li class="paginate_button page-item '; if($_GET["page"] == 9){ echo "active"; } echo '"><a href="?page=9" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">9</a></li>		
				<li class="paginate_button page-item '; if($_GET["page"] == 10){ echo "active"; } echo '"><a href="?page=10" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">10</a></li>		
				<li class="paginate_button page-item '; if($_GET["page"] == 11){ echo "active"; } echo '"><a href="?page=11" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">11</a></li>		
				<li class="paginate_button page-item '; if($_GET["page"] == 12){ echo "active"; } echo '"><a href="?page=12" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">12</a></li>		

				</ul>';			
	?> 										
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
			

			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>