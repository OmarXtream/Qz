<?php
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
//ini_set('display_errors', 1);
///ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
die("Database Error: ".$con->connect_error);
}
$cldbid = $client_info["client_database_id"];
$sql = "SELECT name FROM tweat WHERE cdb='$cldbid' LIMIT 1";
$res = $con->query($sql)->fetch_assoc()["name"];
if(empty($res)){
	$username = "null";
}else{
	$username = $res ;
}

/////////
$sql = "SELECT * FROM challengesQz WHERE cbd='$cldbid'";
if($result = mysqli_query($con, $sql)){
	if(mysqli_num_rows($result) >= 1){
		while($row = $result->fetch_assoc()) {
		if ( $row["chl"] == "twitter"){
		$twitter = $row["value"] ;
		} elseif ( $row["chl"] == "telegram") {
		$telegram = $row["value"] ;
			}
		}	
	}
}

////////

function generateRandomString($length = 14) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$TelegramVerfiy = generateRandomString() ;
$_SESSION["TelegramCode"] = $TelegramVerfiy;
?>

<style>
.modal-window {
  position: fixed;
  background-color: rgba(255, 255, 255, 0.25);
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 999;
  opacity: 0;
  pointer-events: none;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transition: all 0.3s;
  &:target {
    opacity: 1;
    pointer-events: auto;
  }
  &>div {
    width: 400px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 2em;
    background: #ffffff;
    color: #333333;
  }
  header {
    font-weight: bold;
  }
  h1 {
    font-size: 150%;
    margin: 0 0 15px;
    color: #333333;
  }
}

.modal-close {
  color: #aaa;
  line-height: 50px;
  font-size: 80%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  width: 70px;
  text-decoration: none;
  &:hover {
    color: #000;
  }
}

#clickableAwesomeFont {
     cursor: pointer
}


</style>
    
	
<div class="page-wrapper">
        <div class="container-fluid"></br>
					
 <center>
 

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Qz Challange System</h4>
        </div>
        <div class="modal-body">
          <p>
		  <strong>يجب عليك تطبيق هذه الخطوات اولا ثم التأكيد</strong>
		 <br> 1- قم بتغير الأسم الاول الخاص بك ( First name ) بالتلقرام الي : -
	<br>	<strong> <?php echo $TelegramVerfiy ;?> </strong>
<br>		<br> <strong>يمكنك إرجاع الأسم الاول القديم في حال الانتهاء من التأكيد</strong>

		 <br> 2 - يجب عليك معرفة أيدي الخاص بك بالتليقرام عن طريق هذه الخطوات : -
		 <br> قم بإرسال /start الي هذا المستخدم <a target="_blank" href="https://web.telegram.org/#/im?p=@userinfobot">Userinfo</a> 
		 <br> سوف يقوم بالرد عليك برسالة توجد فيها معلوماتك الخاصة
		 <br> Id = الأيدي الذي يجب عليك نسخه ، ومن ثم بأمكانك التأكيد 		 

		  <br><br><input type="text" style="text-align:center;" class="form-control" id="TeleId" placeholder="Id الخاص ">

		<br> <br> <button type="button" onclick="return TelegramVerfiy();" id="submitVerTelegram" class="btn btn-info ">تأكيد التحدي</button>

		  </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>		
		
							<div class="col-md-6">

				
						<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">الجوائز المتاحة</h4>
                                <h4 class="card-title">( نقاط / Coints ) </h4>
								<label><strong>( تنويه في حال وددت ربط حساباتك معنا بمواقع تواصل الاجتماعي )</strong></label>
								<label><strong>يجب ان تكون اسماء حساباتك مثل الاسماء المسجلة لدينا ( التي قمت بربطها مسبقا )</strong></label>
                                <div class="table-responsive">
									<table id="demo-foo-addrow" class="table m-t-30 table-hover table color-table success-table contact-list footable-loaded footable" data-page-size="10">
                                        <thead>
                                    <tr style="background-color: #01c0c8;">
                                        <th align="center" width="90%" ><i class="fa fa-bookmark"></i> التحدي المطلوب</th>	
                                        <th align="center">تأكيد <i class="fa fa-check-square-o"></i> </th>										
                                    </tr>
                                        </thead>
                                <tbody>
								
								    <tr>
									
									<?php
									if ($twitter != "true" ) {
										if ($username != "null") {
										echo '<td>قم بمتابعة حسابنا الرسمي على تويتر <a target="_blank" href="https://twitter.com/QzServer">QzServers</a> <span class="label label-warning label-mini">Reward : 150</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" onclick="return TwitterVerfiy();"  id="submitVerTwitter" type="button">تأكيد</button></span></td>		
										</tr>';
										} else {
										echo '<td> قم بمتابعة حسابنا الرسمي بتويتر ( يجب عليك ربط حسابك معنا اولا من <a target="_blank" href="https://panel.q-z.us/Twitter.php">هنا</a> ) <span class="label label-warning label-mini">Reward : 150</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" onclick="return TwitterVerfiy();"  id="submitVerTwitter" type="button" disabled>تأكيد</button></span></td>		
										</tr>';
										}
										
									} else {
										echo '<td>قم بمتابعة حسابنا الرسمي على تويتر <a target="_blank" href="https://twitter.com/QzServer">QzServers</a> <span class="label label-warning label-mini">Reward : 150</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" onclick="return TwitterVerfiy();"  id="submitVerTwitter" type="button" disabled>تأكيد</button></span></td>		
										</tr>';

										
									}
									?>
									
									<?php
									if ($telegram != "true" ) {
										echo '<tr>
								       <td>قم بدخول الي قناتنا الرسمية بالتليقرام  <a target="_blank" href="https://web.telegram.org/#/im?p=@QzPublicGroup">هنا</a> <span class="label label-warning label-mini">Reward : 150</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#myModal"  id="ticketButtonDel" type="button">تأكيد</button></span></td>		
										</tr>
											';
									} else {
										echo '<tr>
								       <td>قم بدخول الي قناتنا الرسمية بالتليقرام  <a target="_blank" href="https://web.telegram.org/#/im?p=@QzPublicGroup">هنا</a> <span class="label label-warning label-mini">Reward : 150</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#myModal"  id="ticketButtonDel" type="button"  disabled>تأكيد</button></span></td>		
										</tr>
											';
										
									}
									?>
									
									
									
								    <tr>
								       <td><span class="label label-danger label-mini">قريبا</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" onclick="return deleteFunction();"  id="ticketButtonDel" type="button">تأكيد</button></span></td>		
                                    </tr>
								    <tr>
								       <td><span class="label label-danger label-mini">قريبا</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" onclick="return deleteFunction();"  id="ticketButtonDel" type="button">تأكيد</button></span></td>		
                                    </tr>
								    <tr>
								       <td><span class="label label-danger label-mini">قريبا</span></td>				
                                        <td><span class="input-group-btn"><button class="btn btn-block btn-outline-success" onclick="return deleteFunction();"  id="ticketButtonDel" type="button">تأكيد</button></span></td>		
                                    </tr>
			 

                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>

			
	
	
			

		
		
		
	 <script src='https://www.google.com/recaptcha/api.js'></script>

	</div>			
</div>	


<script type="text/javascript">
function TwitterVerfiy()
{

		document.getElementById("submitVerTwitter").innerHTML = "..." ; 
		var params = "CheckTwitter=0";
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("submitVerTwitter").innerHTML = "تأكيد";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var spam = str.includes("spam");
				var ald = str.includes("ald");
				var not = str.includes("not");
				if (tr) {swal(' تم ', 'تم التأكيد وإعطائك الجائزة ', 'success');}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تأكد من اسم حسابك ', 'error');}
				if (spam) {swal('! خطأ ', 'تمهل قليلا ، يمكنك إعادة المحاولة بعد قليل ', 'error');}
				if (ald) {swal('! خطأ ', 'حسابك مربوط معنا مسبقا ومتابعنا ', 'error');}
				if (not) {swal('! خطأ ', 'يجب عليك متابعة حسابنا بالأول ثم يمكنك التأكيد ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/rewardapi",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 
function TelegramVerfiy()
{
		var TeleAcc = document.getElementById('TeleId').value
		if ( TeleAcc == "" ) {
			swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error');
		}
		document.getElementById("submitVerTelegram").innerHTML = "..." ; 
		
		var params = "CheckTelegram=" + TeleAcc;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("submitVerTelegram").innerHTML = "تأكيد";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var spam = str.includes("spam");
				var ald = str.includes("ald");
				var not = str.includes("not");
				if (tr) {swal(' تم ', 'تم التأكيد وإعطائك الجائزة ', 'success');}
				if (not) {swal('! خطأ ', 'لقد حدث خطأ ما ، تأكد انك بالقروب والاسم الاول كما مطلوب ', 'error');}
				if (spam) {swal('! خطأ ', 'تمهل قليلا ، يمكنك إعادة المحاولة بعد قليل ', 'error');}
				if (ald) {swal('! خطأ ', 'تم التأكيد مسبقا ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/rewardapi",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 
</script>
		
<?php require_once('includes/footer.php'); ?>























