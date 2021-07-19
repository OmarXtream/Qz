<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');						
?>

<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">
            <div class="container-fluid">
<?php

// die('الصفحة تحت الصيانة والتطوير');
if(isset($_POST['change'])){
$name = $_POST['name'];
$pass = $_POST['pass'];
$ch = $ts3_Client->cid;
$channel = $ts3->channelGetById($ch);
if(!$channel->isSpacer()){
try{
if($name =! $ts3_VirtualServer->channelGetById($ch)->channel_name){
$ts3->channelGetById($ch)->modify(array("channel_name" => $name));
}
if(!empty($pass)){
$ts3->channelGetById($ch)->modify(array("channel_password" => $pass));
}
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }

}else{

echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         <strong>لا يمكنك تعديل معلومات هذه الغرفة !</strong></center> 
                                </div>
';

}
}
global $chid;
$trtr = $ts3_VirtualServer->channelGroupGetById($ts3_Client->client_channel_group_id)->name;
			if (in_array ($ts3_Client->client_channel_group_id, $chid)){

			   }else{
echo '
<br><br><br>
		<center>
<div class="col-md-6">


<div class="card text-center">
                            <div class="card-header">
                                خطأ
                            </div>

<div class="block block-themed block-rounded">
<div class="block-header bg-gd-lake">
</div>
<div class="block-content">

					</div>
		<title>Qz - Dont Have Room </title>
<img src="assets/error1.png">


	  
<center><h2><i class="fa fa-exclamation-triangle"></i> لا يمكنك <font color="red">التحكم بروم </font> بروم <font color="red">غير رومك</font></h2><center/>
<br >
<center><h2><i class="fa fa-exclamation-triangle"></i>لتحكم بالروم<font color="red">لخاص بك</font>  عليك  <font color="red">دخول رومك</font></h2><center/>
<br>
<center><h2> <font color="red"><i class="fa fa-exclamation-triangle"></i>' . $trtr.' </font> رتبتك الحالية <font color="red"> داخل </font>  الروم المتواجد به  </h2><center/>
<br>
<div class="alert alert-success">
<p><i class="fa fa-exclamation-triangle"></i>لأ تمتلك روم قم بالرجوع الي لوحه الاعضاء !</p>
</div>
											<p>Copyright © 2018 |  Qz Community | Server All rights reserved.</p>			
</div>
</div>
                        </div>

</div>';
echo'</div></div></div></div>';
        require_once("includes/footer.php");
die;
}
if ($_POST['openc'])
{
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{

$ts3_VirtualServer->channelGetById($ts3_Client->cid)->permRemove("b_client_channel_textmessage_send");		
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B] تم فتح الشات من قبل    ". $client_info["client_nickname"]." ");

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
if ($_POST['closec'])
{
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{

$ts3_VirtualServer->channelGetById($ts3_Client->cid)->permAssign("b_client_channel_textmessage_send", 0);			
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B]". $client_info["client_nickname"]." تم إغلاق الشات من قبل  ");
				
			

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
if ($_POST['closek'])
{
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{

$ts3_VirtualServer->channelGetById($ts3_Client->cid)->permAssign('i_client_needed_talk_power',999999999);			
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B] ". $client_info["client_nickname"]." تم إغلاق المايكات من قبل ");
				
			

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
if ($_POST['openk'])
{
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{

$ts3_VirtualServer->channelGetById($ts3_Client->cid)->permRemove("i_client_needed_talk_power");		
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B] تم فتح المايكات من قبل ". $client_info["client_nickname"]." ");
				
			

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
if ($_POST['openr'])
{
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{
$hiss = $ts3_VirtualServer->channelGetById($ts3_Client->cid); 
if($hiss->getProperty('channel_flag_permanent') == 1){

$ts3_VirtualServer->channelGetById($ts3_Client->cid)->modify(array("channel_maxclients=99999"));
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B] تم فتح الروم من قبل ". $client_info["client_nickname"]." ");
}else{
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>لا يمكنك تفعيل هذه الخاصية في غرفة غير مثبته </strong></center> 
                                </div>
';

}	
			

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
if ($_POST['closer'])
{
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{
$hiss = $ts3_VirtualServer->channelGetById($ts3_Client->cid); 
if($hiss->getProperty('channel_flag_permanent') == 1){


$ts3_VirtualServer->channelGetById($ts3_Client->cid)->modify(array("channel_maxclients=0"));
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B] تم إغلاق الروم من قبل ". $client_info["client_nickname"]." ");
		}else{
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>لا يمكنك تفعيل هذه الخاصية في غرفة غير مثبته </strong></center> 
                                </div>
';

}	
		
			

                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
if(isset($_POST['music'])){
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['ts3_last_query'] = microtime(true);
	
	if($_SESSION['ts3_last_query'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['ts3_last_query'] = microtime(true)+5.0;

try{
$hiss = $ts3_VirtualServer->channelGetById($ts3_Client->cid); 
if($hiss->getProperty('channel_codec') == 5){
$hiss["channel_codec"] = 4;
}else{
$hiss["channel_codec"] = 5;
}
$ts3_VirtualServer->channelGetById($ts3_Client->cid)->message("[B] تم تغيير نوع الروم من قبل ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
$cg = $_POST['cg'];
$clientuidch = $_POST['cid'];
if (isset($_POST['submit'])){
	if(!isset($_SESSION['ts3_last_query']))
    $_SESSION['form'] = microtime(true);
	
	if($_SESSION['form'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['form'] = microtime(true)+5.0;
	
	date_default_timezone_set('Asia/Riyadh'); //Change Here!

	if(empty($_POST['cid'])) {
				header("refresh: 1; url = r-control.php"); 
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>        <strong>You have to put the uid ! | عليك وضع الايدنتي المراد التعامل معه </strong></center> 
                                </div>
';
echo'<meta http-equiv="refresh" content="2; url=r-control.php" />';
die;		
		}
try{
                foreach ($ts3_VirtualServer->clientList() as $clg) {
                                        if ($clg['client_unique_identifier'] == $_POST['cid']) {
                                         $found = 1;

}
}
if(!$found){
				header("refresh: 1; url = r-control.php"); 
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>        <strong>Wrong UID Given ! | خطأ الرجاء التحقق من الأيدي </strong></center> 
                                </div>
';
// die("echo $cl");
echo'<meta http-equiv="refresh" content="2; url=r-control.php" />';

die;		
		
}                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
				if($ts3_Client['client_unique_identifier'] == $cid ) {
				header("refresh: 1; url = r-control.php"); 
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>        <strong>You can not control your self !! | لا يمكنك التعامل مع نفسك !!  </strong></center> 
                                </div>
';
echo'<meta http-equiv="refresh" content="2; url=r-control.php" />';

die;		

		}
					   		    if(isset($_POST['cid'])) {
			$get = $ts3_VirtualServer->ClientGetByUid($_POST['cid']);
            if($ts3_VirtualServer->channelGroupGetById($ts3_Client->client_channel_group_id)->sortid >= $ts3_VirtualServer->channelGroupGetById($get->client_channel_group_id)->sortid) {
	        				header("refresh: 2; url = r-control.php"); 
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>        <strong>You can not remove the rank of like your rank or higher you !! | لا يمكنك ازالة رتبة مثل الرتبة الخاصة بك او الاعلى منك  </strong></center> 
                                </div>
';
echo'<meta http-equiv="refresh" content="2; url=r-control.php" />';

die;		


}
$channelid = ($ts3_Client->cid);
$ChannelName = $ts3_VirtualServer->channelGetById($ts3_Client->cid)->channel_name;

	if($cg == "clear"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$normal");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("تم سحب جميع رتبك في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
	elseif($cg == "mod"){
try{

$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$mod");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B] تم اعطائك مود في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}

	elseif($cg == "mute"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$mute");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B] تم اعطائك حظر صوتي في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}

	elseif($cg == "mute2"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$nochat");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B]تم اعطائك حظر نصي في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}

	elseif($cg == "mute+"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$muteplus");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B]تم اعطائك حظر من الدرجة الأولى  في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}

	elseif($cg == "ban"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$cban");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B]تم  حظرك من دخول روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}

	elseif($cg == "skip"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->setChannelGroup($channelid, "$skipjoin");
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B]تم اعطائك  خاصية الدخول الحر في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
	elseif($cg == "mike-"){
try{


$ts3_VirtualServer->clientGetByUid($clientuidch)->channelClientPermRemove($channelid,b_client_is_priority_speaker);		
$ts3_VirtualServer->clientGetByUid($clientuidch)->message("[B] تم إزالة خاصية أفضلية الصوت لك في روم".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}

	elseif($cg == "mike+"){
try{
 foreach($ts3_VirtualServer->clientList() as $Clientt){
 if($Clientt['client_unique_identifier'] == $cid) {
 $dbinfo = $Clientt->infoDb();
 $cluid = $dbinfo['client_unique_identifier'];
 $cldb = $dbinfo['client_database_id'];

$ts3_VirtualServer->channelClientPermAssign($channelid,$cldb,b_client_is_priority_speaker);		
}
}
$ts3_VirtualServer->clientGetByUid($cid)->message("تم  اضافة خاصية أفضلية الصوت لك في روم    ".$ChannelName." من قبل| ". $client_info["client_nickname"]." ");
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
}
}
}
}
?>			
<br>
<center><h1 class="page-header">Qz# ChannelControl | بوت التحكم بروم </h1></center>
<hr>
<div class="row">
			<div class="col-md-7">
                        <div class="card border-dark">
                            <div class="card-header bg-dark">
                            <center>    <h2 class="m-b-0 text-white">رتبتك : <?php 
$icon = $ts3_VirtualServer->channelGroupGetById($ts3_Client->client_channel_group_id)->iconDownload();
if (!empty($icon)){
                        // echo'
// <img src="config/geticon.php?cid='. $ts3_Client->client_channel_group_id . '">';
}

echo $ts3_VirtualServer->channelGroupGetById($ts3_Client->client_channel_group_id)->name?> </h2></div> </center>
                            
							
							<div class="card-body">
								<center>	<h1 class="card-title">خيارات التحكم</h1> </center>
									<hr>
										<form method="post">
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-2">
                                        <input class="btn btn-block btn-outline-danger" type="submit" name="closec" value="اغلاق الشات" title="اضغط هنا لإغلاق الشات">
                                        <input class="btn btn-block btn-outline-success" type="submit" name="openc" value="فتح الشات" title="اضغط هنا لفتح الشات">
									</div>
									<div class="col-md-2">
									</div>
									<div class="col-md-2">
                                        <input class="btn btn-block btn-outline-danger" type="submit" name="closek" value="إغلاق المايكات " title="اضغط هنا لإغلاق المايكات">
                                        <input class="btn btn-block btn-outline-success" type="submit" name="openk" value="فتح المايكات" title="اضغط هنا لفتح المايكات">
									</div>							
									<div class="col-md-2">
									</div>
									<div class="col-md-2">
                                        <input class="btn btn-block btn-outline-danger" type="submit" name="closer" value="إغلاق  الروم " title="اضغط هنا لإغلاق الروم">
                                        <input class="btn btn-block btn-outline-success" type="submit" name="openr" value="فتح الروم" title="اضغط هنا لفتح الروم">
									</div>
								</div>
														<center>
							<div class="card-body">
							
								<div class="col-md-2">
<?php
$hiss = $ts3_VirtualServer->channelGetById($ts3_Client->cid); 
if($hiss->getProperty('channel_codec') == 5){
   echo'<button type="submit"  name="music" class="btn btn-success btn-circle btn-lg" title="اضغط هنا لإرجاع  نوع الروم إلى العادي "><i class="fa fa-music"></i></button>';
}else{
echo '<button type="submit"  name="music" class="btn btn-warning btn-circle btn-lg" title="اضغط هنا ل تغيير نوع الروم الى ميوزك "><i class="fa fa-music"></i></button>';

}

?>
								</div>
							</div>									
										 </form>	
                            </div>
							
							
							<center>
							<hr>
							<div class="card-body">
								<div class="col-md-8">
	                       <br>
<form method="post">
<select name='cg' class='form-control' >";
<option name='clear' value='clear'>إزالة جميع الرتب</option>
<option name='mod' value='mod'>• Channel Moderator إضافة </option>
<option name='mute' value='mute'>[ Mute ] Microphone إضافة</option>
<option name='mute2' value='mute2'>[ Mute ] Keyboard/Chat إضافة </option>
<option name='mute+' value='mute+'>[ Mute+ ] Microphone/Keyboard إضافة </option>
<option name='ban' value='ban'>[ Block ] You Are Not Welcome إضافة  </option>
<option name='skip' value='skip'>• Skip Maximum & Password إضافة </option>
<option name='mike+' value='mike+'> إضافة أفضلية الصوت </option>
<option name='mike-' value='mike-'> إزالة أفضلية الصوت </option>
</select><br><br>
<input class="form-control" type="text" placeholder="أيدي الشخص" size="50" name="cid"><br>

<br>
<center>
        					<div class="col-md-4"> <input class="btn btn-rounded btn-block btn-outline-success" type="submit" name="submit" value="تشغيل" title="تشغيل العملية"></div>
</form><br/>
<br>
							</div>
							<div class="card-body">
							<center>	
								
								<br>
							<hr>
							<br>
								<div class="col-md-4">
<form method="post">								
								<label class="col-sm-8" for="block-form-username4"><b>أسم الروم</b></label>
									<input type="text" class="form-control" id="example-text-input" placeholder="<?php 


echo ' '.$ts3_VirtualServer->channelGetById($ts3_Client->cid)->channel_name.'';
?>
" name='name' value="<?php 


echo ' '.$ts3_VirtualServer->channelGetById($ts3_Client->cid)->channel_name.'';

?>
">
								</div>
								<br><form method="post">
								<div class="col-md-4">
								<label class="col-sm-8" for="block-form-username4"><b>كلمه السر</b></label>
									<input type="password" class="form-control" id="example-text-input" placeholder="كلمه السر" name='pass'>
									
								</div>
								<br>
								<div class="col-md-4">
                                        <button type="submit" name="change" class="btn btn-rounded btn-block btn-outline-success">حفظ التعديلات</button>
                                </div>
					</form>
</form>
							</center>
							</div>
                        </div>
            </div>
		
	</div>	
				<div class="col-md-5">

<div class="card">
                            <div class="card-body">
                               <center> <h2 class="card-title">قائمة الأعضاء المتصلين بالروم</h2> </center>
                                <div class="table-responsive">

				<table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>العضو</th>
                                                <th>المعروف الخاص بالعضو</th>
                                                <th>الرتبه بالرومات	</th>
                                            </tr>
                                        </thead>
                                <tbody>

<?php
try{
$ts3_VirtualServer->clientListReset();
$ts3_VirtualServer->channelListReset();
foreach($ts3_VirtualServer->channelGetById($ts3_Client->cid)->clientList() as $clientlist) {
$status = $clientlist->getIcon();
                                              $system = $clientlist["client_platform"];
if($system == ServerQuery){
}else{

	
	echo'	
                                    <tr>
                                        <td><a><img src="config/client_status/'.$status.'.png" style="width:16px;height:16px;"/>  </a><b>'. $clientlist['client_nickname'] .' </td>
<td><b>'.$clientlist['client_unique_identifier'].'</b></td>                                       
 <td>'; 
$icon = $ts3_VirtualServer->channelGroupGetById($clientlist->client_channel_group_id)->iconDownload();
if (!empty($icon)){
}
echo'<b>'. $ts3_VirtualServer->channelGroupGetById($clientlist->client_channel_group_id)->name .'</b></td>
                                    </tr>

<br>';
}
}
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }




?>
</table>
                                </tbody>
										</table>
                                </div>
                            </div>
                        </div>
		
		
		
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	
<?php require_once('includes/footer.php'); ?>