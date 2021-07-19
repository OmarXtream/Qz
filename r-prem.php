
<?php require 'config/phphead.php'; ?>
<?php require 'config/sqlconfig.php'; ?>

<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
        <div class="page-wrapper">
            <div class="container-fluid">
						<br>
			<br>
			<br>
			<br>
			<br>
<?php					
$res = $con->query("SELECT * FROM roomz WHERE owner='$dbid'"); 
$resultnum = $res->num_rows;
if($resultnum > 0){
	 	echo '
		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-primary ">
                               <center> <h4 class="m-b-0 text-white">خطاء</h4> </center>
								</div>
							<div class="card-body">
										<a class="block block-link-pop" href="javascript:void(0)">
			<div class="card border-top-danger box-shadow-0 border-bottom-danger">
				<div class="card-header">
<h4 class="card-title"><center><h2>يوجد لديك <font color="#8e0f0f">روم</font> مثبت <font color="#8e0f0f">  مسبقأ او تم حظرك من انشاء الرومات</font></h2><center/>
				</div>
											<hr>
<div class="alert alert-warning">
<center>    <button type="button" class="btn mr-1 mb-1 btn-warning"><i class="icon-circle-check"></i> <a href="r-control.php"></i><span data-i18n="nav.dash.main">ألتحكم بالرومات</span></a></button>   
       	</div>											<br>
											<div class="alert alert-success">
<p>او قم بالتواصل مع الاداره بالتيم سبيك لمعرفة سبب حظرك من انشاء الرومات</p>
</div>
											</a>

							</div>
						</div>
			</div> </center></div></div></div></div></div></div></div></div></div></div></div></div></div>';
			
			require_once('includes/footer.php');
		die;
 }
?> 

<?php

if(isset($_POST['perm'])){
$top_cid = $ts3_VirtualServer->channelCreate(array(
"channel_name"          => "Qz | $nickname",
  "channel_topic"          => "Permanent|| $uid",
  "channel_codec"          => TeamSpeak3::CODEC_OPUS_VOICE,
  "channel_codec_quality"  => 0x05,
  "channel_flag_permanent" => TRUE,
  "channel_password" => "qz-pW-",
  "cpid"                  => $roomcid,
));
$ts3_VirtualServer->ClientMove($move,$top_cid);
$ts3_VirtualServer->Clientpoke($poke,"[COLOR=#00aaff][B]تم انشاء روم , [COLOR=#00557f]مثبت[/COLOR][/B][/COLOR]");
$ts3_VirtualServer->clientSetChannelGroup($dbid,$top_cid,$roomowner);
	
	$query = "INSERT INTO `roomz` (`id`, `owner`, `room`, `points`) VALUES (NULL, '$dbid', '$top_cid', '0')";
	$con->query($query);
	
	echo('<script>
           swal({title: "تم",text: "تم انشاء روم مثبت",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/r-prem");}else {window.location.replace("https://panel.q-z.us/r-prem");}})</script>'); 
}

?>

<?php
if(count(array_intersect($ggids, $canmakeroom)))	
{	
	echo '			<br><br>
		<br><br>
		<br><br>
     <br><br><br> <form method="POST">
<center><button   type="submit" name="perm" value="تثبيت غرفة" type="button" id="buttonClass" style="width:50%;" class="btn btn-outlined btn-block btn-danger deror">تثبيت الغرفة</button> </center>
      </form>
		
		<br><br>		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>


</div></div>';
				}else	
	
				{

echo '
		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-primary ">
                               <center> <h4 class="m-b-0 text-white">انشاء الغرف</h4> </center>
								</div>
							<div class="card-body">
										<a class="block block-link-pop" href="javascript:void(0)">
											<div class="block-header">
											<h3 class="block-title"><center><h2>شروط انشاء<font color="#8e0f0f">روم</font> مثبت <font color="#8e0f0f">شخصي</font></h2><center></center></center></h3>
											</div>
											<hr>
											<h2 <strong=""> خطاْ  </h2>
											<br>
											<div class="panel-body">
											<h style="color:#0d2dff" <="" h=""> يجب تطبيق الشروط بالاسفل لتتمكن من انشاء غرفه مثبته
											</h></div>
											<hr>
											<div class="panel-heading">
											<h style="color:#303f9f" <="" h=""> <center><h3 class="panel-title">شروط إنشاء غرفة شخصية</h3>
											</center></h></div>
											<hr>
											<div class="panel-body">
											<ul>
											<center>
											<h style="color:#8e0f0f" <="" h=""> <li>عدم وجود أي سوابق تمنعك من إنشاء روم <strong> .حظر إنشاء الغرف.</strong></li>
											<h style="c10or:#8e0f0f" <="" h=""><li><strong>( Level 10+)</strong> يجب توفر1فل 10 وما فوق</li>
											<h style="color:#8e0f0f" <="" h=""><li>* ! تتطبق على شروط الغرف الشخصية جميعها &#8236;&lrm;<strong> قوانين السيرفر</strong> </li>
											<h style="color:#8e0f0f" <="" h=""><li>There are no precedents preventing you from <strong>creating a room.</strong></li>
											<h style="color:#8e0f0f" <="" h=""><li><strong>( Level 10+)</strong> Must be available for <strong>Level 10+</strong></li>
											<h style="color:#8e0f0f" <="" h=""><li><strong>Server Rules</strong> apply to all personal Room conditions ! *</li>
											</h></h></h></h></h></h></center>
											</ul>
											<hr>
											<br><br>
											</div>
											</a>

							</div>
						</div>
			</div> </center>
';   
}
			?>			

<!-- small card -->
<!-- center card -->

<!-- small card -->
				<div class="col-md-4">
					</div>


			</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>