<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<?php require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
			<br>
			<br>
			<br>
<!-- small card -->
<!-- center card -->
<?php 

$mdbid = $client_info["client_database_id"];
$sql = "SELECT owner FROM clans";
$res = $con->query($sql);
while($data = $res->fetch_assoc()){
	if($data["owner"] == $mdbid){
		$red = true;
	}
}

if(isset($_POST["cname"]) && isset($_POST["submit"])){


$cname = $_POST["cname"];


$cid = $client_info["cid"];
$chgid = $client_info["client_channel_group_id"];
$sql = "SELECT sgid FROM clans";
$res = $con->query($sql);
$cgrp = explode(',', $client_info["client_servergroups"]);
$clgrp = array();
while($row = $res->fetch_assoc()){
	array_push($clgrp, $row["sgid"]);
}

if(array_intersect($clgrp, $cgrp)){
die('<script>
           swal({title: "عذراً",text: "You Are in Another Clan! - انت بكلان اخر ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-clan");}else {window.location.replace("https://panel.q-z.us/c-clan");}})</script>');		
}

//يجب ان تكون مسوال الروم
 
if($chgid !== $Roomownerclan){
die('<script>
           swal({title: "عذراً",text: "You Must Be The Room Admin! - يجب ان تكون مسوال الروم ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-clan");}else {window.location.replace("https://panel.q-z.us/c-clan");}})</script>');		
}

// عدم عد اعضاء الكلانات الاخر والبوتات

$ch = $ts3_VirtualServer->channelGetById($cid);
$chc = $ch->clientList(array("client_type" => 0)); // هنا بعد لأزم يتعدل عشان تساوي الكلان عدد الاشخاص 
$cnum = array();
$ippool = array();
foreach($chc as $c){
	$cgrp2 =  explode(',', $c["client_servergroups"]);
	if(array_intersect($clgrp, $cgrp2)){
echo("<script>
           swal({title: 'عذراً',text: 'Warning is Member in Another Clan! - هذا العضو في كلان اخر لم يتم احتسابه <br/></a>.<br><strong>[$c]',type: 'error',allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: 'حسنأ',})</script>");			
		continue;
	}else if(in_array($botclan, $cgrp2)){
		
echo("<script>
           swal({title: 'عذراً',text: 'Warning iS a Bot! - يوجد بوتات لم يتم احتسبهم <br/></a>.<br><strong>[$c]',type: 'error',allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: 'حسنأ',})</script>");					
		continue;
	}
	array_push($ippool, $c["connection_client_ip"]);
	array_push($cnum, $c["client_database_id"]);
	
}

$arr2 = array();
$counter = 0;
for($arr = 0; $arr < count($ippool); $arr++){
    if (in_array($ippool[$arr], $arr2)) {
        ++$counter;
        continue;
    }
    else{
        $arr2[] = $ippool[$arr];
    }
}

if($counter > 0){
	
	
die("<script>
           swal({title: 'خطاء فادح اووفف',text: ' Dont Can Make Clan while user ip more 1 - لأ تحاول انك تلعب علينا متصل باكثر من ايدتني [$counter]',type: 'error',allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: 'حسنأ',}).then((result) => {if (result.value) {window.location.replace('https://panel.q-z.us/c-clan');}else {window.location.replace('https://panel.q-z.us/c-clan');}})</script>");
}



// عدد الاشخاص الذين يجب ان يكونو بالروم لانشاء كلان

if(count($cnum) < $maxuser){ // عدد الاشخاص المطلوبين

die('<script>
           swal({title: "عدد الاعضاء + 15",text: "You Need More Member Clients! - يمكن انشاء كلان عند وجود 15اشخاص",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-clan");}else {window.location.replace("https://panel.q-z.us/c-clan");}})</script>');	

die('<script>
           swal({title: "عدد الاعضاء",text: "You Need More Clients! - تحتاج الي مزيد من الاعضاء",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-clans");}else {window.location.replace("https://panel.q-z.us/c-clan");}})</script>');			   

}
$sql = "SELECT chid FROM clans ORDER BY id DESC LIMIT 1;";
$res = $con->query($sql)->fetch_assoc()["chid"];
$order = (isset($res) && $res != 0 ? $res : 2703);
$x = array();
$x[0] = intval(cspacer("◢◤━━━━━━◤◢◆◣◥━━━━━━◥◣", "spacer", $order));
$x[1] = intval(cspacer("ıı $cname ıı ", "spacer", $x[0]));
$wlc = cspacer("Room 1", "room", NULL, $x[1]);
cspacer("Room 2", "room", NULL, $x[1]);
cspacer("Room 3", "room", NULL, $x[1]);
$afk = cspacer("Room 4", "room", NULL, $x[1]);
$x[2] = intval(cspacer("◥◣━━━━━━◣◥◆◤◢━━━━━━◢◤", "spacer", $x[1]));

$csg = $ts3_VirtualServer->serverGroupCreate($cname);
$csgz = $ts3_VirtualServer->serverGroupGetById($csg);
$csgz->permAssignByName("i_group_sort_id", $Gourpsortid +1);
$csgz->permAssignByName("i_group_show_name_in_tree", TRUE);
foreach($cnum as $cn){
	$cs = $ts3_VirtualServer->clientGetByDbid($cn);
	$cs->move($x[1]);
	$cs->addServerGroup($csg);
	if($cn == $client_info["client_database_id"]){
		$cs->setChannelGroup($x[1], $clanowner);
		continue;
	}	  
	$cs->setChannelGroup($x[1], $clanmember);
}  

$clanroom = serialize($x);
$owner = $client_info["client_database_id"];
$chid = $x[2];

$sql = "SELECT num FROM clans ORDER BY id DESC LIMIT 1;";
$num = $con->query($sql)->fetch_assoc()["num"];
if(!isset($num)){
	$num = 0;
}
$num = $num +1;

$sql = "INSERT INTO clans (id, name, num, owner, rooms, chid, sgid, afk, wlc) VALUES (NULL,'$cname', '$num', '$owner', '$clanroom', '$chid', '$csg', '$afk', '$wlc')";
$con->query($sql);

die('<script>
           swal({title: "حركات",text: "تم انشاء الكلان ",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/c-clan");}else {window.location.replace("https://panel.q-z.us/c-clan");}})</script>');			   

}

?>
		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-primary ">
                               <center> <h4 class="m-b-0 text-white">أنشاء كلان</h4> </center>
								</div>
							<div class="card-body">
							<form class="form-horizontal text-center" action="c-clan" method="post">
										<div class="col-lg-12">
										<center><label class="col-sm-8" for="block-form-username4"> ضع أسم الكلان </label></center>
                                                <div class="input-group mb-3">
                                                    <input type="text"  name="cname"  class="form-control" placeholder="أسم الكلان" id="cname" aria-label="" aria-describedby="basic-addon1">
													<?php
if($red == true){
echo ('
<div class="input-group-append"><button href="c-control" class="btn btn-danger">لوحة التحكم</button>  </div>');
}else{
echo ('<div class="input-group-append"><button type="submit" name="submit" class="btn btn-primary">انشاء</button>  </div>');
}


?>
													
                                                </div>
												<center><br>
									  <h3> <h style="color:#ff0007" <="" h="">شروط انشاء كلأن</h></h3></center>
									  <hr>
									  <ul>
                                        <h style="color:#42a5f5" <="" h="">    <br><br>عدم وجود أي سوابق تمنعك من إنشاء كلان <strong> حظر انشاء كلأان .</strong>
                                            <h style="color:#42a5f5" <="" h=""><br><br><strong>( Member 15+)</strong> يجب توفر 15 اعضاء فما فوق
                                            <h style="color:#42a5f5" <="" h=""><br><br>* تطبق علي انشاء الكلأنات &#8236;&lrm;<strong> قوانين السيرفر</strong> 
                                            <h style="color:#42a5f5" <="" h=""><br><br><strong>( Member 15+)</strong> Must be available for <strong>Member 15+</strong>
                                            <h style="color:#42a5f5" <="" h=""><br><br><strong>Server Rules</strong> apply to all personal Clan conditions ! *
											</h></h></h></h></h>
                                        </ul>
                                        </div>

							</div>
						</div>
			</div> </center>
<!-- small card -->
				<div class="col-md-4">
					</div>


			</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>