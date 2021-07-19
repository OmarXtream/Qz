<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
require 'config/sqlconfig.php';
if(isset($_GET["token"])) {
$token = $con->real_escape_string($_GET["token"]);
$data = $con->query("SELECT id FROM token_credentials WHERE token='$token'");
 if ($data->num_rows > 0) {
$sql = "DELETE FROM token_credentials WHERE token='$token'";
if ($con->query($sql) === TRUE) {
$Ac = true ;
	} 
	} else {
	die('<script>
	swal({title: "عذرا",text: "الرابط لايعمل",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
	}
} else {
	die () ;
}

Punishmen($ggids) ;
?>


<div class="page-wrapper">
<div class="container-fluid">



<?php if ( $Ac == true ) { ?>

		</br>
		<div class="row">
			<div class="col-md-3">
			</div>
			
				<div class="col-md-6"> 
					   <div class="card border-info">
					   <div class="card-header bg-success">
					   <center> <h4 class="m-b-0 text-white">لوحة إنشاء مستخدم جديد</h4> </center>
					   </div>
					   <div class="card-body">
					   <div class="form-group row">
					   <div class="col-12">
					   <center><label>أسم مستخدم</label></center>
					   <input type="text" class="form-control" style="text-align:center" placeholder="Username" id="t-username" name="t-uid">
					   </div>
					   </div>	  
					   <div class="form-group row">
					   <div class="col-12">
					   <center><label>الرمز السري</label></center>
					   <input type="password" class="form-control" style="text-align:center" placeholder="Password" id="t-password" name="t-uid">
					   </div>
					   </div>						
					   <center><div class="g-recaptcha" data-sitekey="6LcV6H0UAAAAAD6huL4K8wUx6y_XvcaWYD3Aajn9"></div></center></br>
                       <div class="col-12 text-center">
					   <label><strong>ملاحظه الرابط صالح للأستخدام مره واحده فقط</strong></label></br>
					   <label>ملاحظة : سوف يتم تشفير باسوردك الخاص ب MD5 لذلك جميع معلوماتك بأمان</label>
						</br>
					   <button id="submitCreate"  name="submitCreate"  onclick="return LgI();" class="btn btn-outline-success">
                       <i class="fa fa-plus"></i> إنشاء مستخدم جديد
                       </button>
					</div>
				</div>
			</div> 
        </div>
		
			</div>
			
<?php } ?>


	 <script src='https://www.google.com/recaptcha/api.js'></script>

	</div>
</div>

<script type="text/javascript">
function LgI()
{
		var response = grecaptcha.getResponse();
		if(response.length == 0) {
		swal('خطأ', 'الرجاء التحقق من انك لست روبوت ', 'error'); 
		return false ;
		}
		var username = document.getElementById('t-username').value;
		var password = document.getElementById('t-password').value
		var dbid = '<?php echo $dbid; ?>'

		if (username == '' ||  password == 'نوع التذكره' ) {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		var params = "lgC&t-username=" + encodeURIComponent(username) + "&t-password=" +encodeURIComponent(password)+ "&t-db=" +encodeURIComponent(dbid);
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				if (tr) { swal({title: "تم",text: " تم إنشاء مستخدم جديد بالداتا بيس الخاص بك",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})}	
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/lg-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 
</script>
<?php require_once('includes/footer.php'); ?>





















