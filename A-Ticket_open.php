<?php
require 'config/phphead.php';
//require 'config/sqlconfig.php'; 
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
//ini_set('display_errors', 1);
///ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "test";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
die("Database Error: ".$con->connect_error);
}
$sql = "SELECT value FROM ticket_config WHERE action='working'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$STicket = $row["value"];
}
if ( $STicket == "false" ) {
	die('<script>
	swal({title: "عذرا",text: "النظام حاليا معطل ، الرجاء محاولة في وقتا اخر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
}

if(isset($_GET["id"])){
    $hash = $_GET["id"];
	$sql = "SELECT * FROM ticket_system WHERE hash='$hash'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
	$tid = $row['hash'];
	$title = $row['title'];
	$type = $row['type'];
	$hash = $row['hash'];
	$date = $row['date'];
	$status = $row['status'];
	$check = $row['client_uid'];
	$client_name = $row['client_name'];
	$cuid = $row['cuid'];
	$cuidN = $row['cc'];
	}
	}	else {
		echo('<script>swal({title: "خطا",text: "عذرا قد حدث خطأ ما",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Tickets");}else {window.location.replace("https://panel.q-z.us/A-Tickets");}})</script>'); 
        exit();
	}	
} else{
		echo('<script>swal({title: "خطا",text: "عذرا قد حدث خطأ ما",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Tickets");}else {window.location.replace("https://panel.q-z.us/A-Tickets");}})</script>'); 
    exit();
}	

//echo("Error description: " . mysqli_error($con));
$_SESSION ['hash'] = $tid;
if ( $type == "شكوى" || $type == "اخرى" || $type == "أقتراح") {
ticketNew($ggids); 
$urlRed = "https://panel.q-z.us/A-Tickets" ;
$ajaxTYPE = "Q-ticketAjax" ;
} else {
ticketEvent($ggids); 
$urlRed = "https://panel.q-z.us/Event-Tickets" ;
$ajaxTYPE = "Event-ticketAjax" ;
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
var complex = '<?php echo $_GET["id"]; ?>';

$(document).ready(function(e){
	$.ajaxSetup({
		cache: false
	});
	setInterval( function(){ $('#fetch').load('config/ticket/Q-fetch_ticket',{"pS": complex}); }, 2000 );
});


function RemoveR()
{
var s = document.getElementById("QViewBy");	
if ( s[s.selectedIndex].value == 'مغلق') 
{ 
var type = 'closed';
} 
if ( s[s.selectedIndex].value == 'غير مستجاب') 
{ 
var type = 'yet';
} 
var hash = s[s.selectedIndex].id ;
var params = "hash=" + encodeURIComponent(hash) + "&type=" + encodeURIComponent(type) ;
document.getElementById("ChangeStatus").innerHTML = "إنتظر ..";
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
		var max = str.includes("limt");
		var closed = str.includes("closed");
		if (tr) {swal('! تمت العملية ', ' تم تحديث الحالة بنجاح ، قم بتحديث الصفحة لرؤية التغيرات ', 'success');	}	
		if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
		if (max) {swal('! خطأ ', 'حد الرسائل بالتذكرة الواحدة 10 فقط  ', 'error');}
		if (closed) {swal('! خطأ ', 'التذكرة تم إغلاقها من قبل أحد الادمنية  ', 'error');}
		document.getElementById("ChangeStatus").innerHTML = "تطبيق";

    }
  }
xmlhttp.open("POST","config/ticket/<?php echo $ajaxTYPE ; ?>",true);
xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xmlhttp.send(params);
    return false;
	} 
	
function SendID(hash)
{

var params = "hashIDC=DSADSA" + "&hash=" + encodeURIComponent(hash) ;
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
		if (tr) {swal('! تمت العملية ', ' تم إرسال لك أيدي المتهم في خاص التيم سبيك ', 'success');
		}	
			
    }
  }
xmlhttp.open("POST","config/ticket/<?php echo $ajaxTYPE ; ?>",true);
xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xmlhttp.send(params);
    return false;
	} 

function Remove(hash)
{
var msg = document.getElementById('msg').value
if (msg == '') {
swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
} 
document.getElementById("InsertChat").innerHTML = "الرجاء الأنتظار..";
var params = "msg=" + encodeURIComponent(msg) + "&hash=" + encodeURIComponent(hash) ;
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
		var max = str.includes("limt");
		var closed = str.includes("closed");
		var rep = str.includes("repF");
		if (tr) {swal('! تمت العملية ', ' تم إضافة ردك بنجاح ، انتظر ثواني لكي يظهر ', 'success');
		document.getElementById('msg').value = '';
		}	
		if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
		if (max) {swal('! خطأ ', 'حد الرسائل بالتذكرة الواحدة 10 فقط  ', 'error');}
		if (closed) {swal('! خطأ ', 'التذكرة تم إغلاقها من قبل أحد الادمنية  ', 'error');}
		if (rep) {swal('! خطأ ', 'التذكرة مستجابة من قبل أدمن اخر  ', 'error');}
		document.getElementById("InsertChat").innerHTML = " إرسال";

    }
  }
xmlhttp.open("POST","config/ticket/<?php echo $ajaxTYPE ; ?>",true);
xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xmlhttp.send(params);
    return false;
} 
		

</script>
<style>
/* width */
::-webkit-scrollbar {
    width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
}
.wrap {
  display: flex;
}

</style>
	
<link href="assets/componentsTicket.min.css?v=13" rel="stylesheet" id="style_components" type="text/css" />
<link href="assets/pluginsTicket.min.css" rel="stylesheet" id="style_components" type="text/css" />


<div class="page-wrapper">
        <div class="container-fluid"></br>
						</br>
						<div class="row">

		
			<div class="col-md-7">
                     <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-purple-plum">
                                            <i class="icon-speech"></i>
                                            <span class="caption-subject bold uppercase"> تفاصيل التذكرة</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body" >
									<?php						
									if ($status == "closed" ) {										
                                        echo" <td>";
										echo" <span class='badge badge-danger'> مغلق </span>";
                                        echo" </td>";
										} elseif ($status == "true" ) {										
	                                    echo" <td>";
                                        echo" <span class='badge badge-success'> رد الادمن </span>";
                                        echo" </td>";
										} elseif ($status == "yet" ) {										
	                                    echo" <td>";
                                        echo" <span class='badge badge-info'> غير مستجاب </span>";
                                        echo" </td>";
										} elseif ($status == "trueClient" ) {										
	                                    echo" <td>";
                                        echo" <span class='badge badge-info'> رد العضو </span>";
                                        echo" </td>";
										} 

									?>
									
                                    <ul class="list-unstyled" style="text-align:right;">
                                        <li style="text-align:right;">
											 أسم التذكرة : <strong><?php echo $title;?> </strong> </li>
                                        <li style="text-align:right;">
											 نوع التذكرة : <strong><?php echo $type;?> </strong> </li>
                                        <li style="text-align:right;">
											 تاريخ إنشاء التذكرة : <strong><?php echo $date;?> </strong> </li>
                                    </ul>																						
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
							<div class="full-height-content-body" data-initialized="1" style="height: auto; overflow: hidden; width: auto;">

<div style="overflow-y: scroll; height:400px;">
					<div class="general-item-list" id='fetch'>

									
															<div class="item">
                                                                <div class="item-head">
                                                                    <div class="item-details">
                                                                        <a href="" class="item-name primary-link">نظام التذاكر</a>
                                                                    </div>
                                                                    <span class="item-status">
                                                                        <span class="badge badge-empty badge-success"></span> جاري تحميل الرسائل</span>
                                                                </div>
                                                                <div class="item-body">  الرجاء الانتظار .... </div>
                                                            </div>


					
															

															


						</div>
					</div>
														
													</br>	<div class="input-group">
                                                            <div class="input-icon">
                          <textarea cols="120"  rows="5" style="text-align:right;" class="form-control" id="msg" placeholder="الرسالة"></textarea>


						  </div>
						                
                                    </div></br>
																			
																			
																		
																		
										<center>
                                        <button id="InsertChat"  name="InsertChat" style="width:70%" onclick="return Remove('<?php echo $_GET['id']; ?>');" class="btn btn-circle btn-success">
                                            <i class="fa fa-plus"></i> إرسال
                                        </button></br></br>
										</center>                                                            </span>

                                </div>
                            </div>
                            </div>

	
	<div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 29px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 62.1235px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
	
	
	
	
	

	
	

                                </div>
							
							
			
				


            </div>
				<div class="col-md-5">
			 <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-purple-plum">
                                            <i class="icon-user"></i>
                                            <span class="caption-subject bold uppercase"> تفاصيل التذكرة</span>
											
                                        </div>
										
                                    </div>
								<?php						
									if ($status == "closed" ) {										
                                        echo" <td>";
										echo" <span class='badge badge-danger'> مغلق </span></br>";
                                        echo" </td>";
										} elseif ($status == "true" ) {										
	                                    echo" <td>";
                                        echo" <span class='badge badge-success'> رد الادمن </span></br>";
                                        echo" </td>";
										} elseif ($status == "yet" ) {										
	                                    echo" <td>";
                                        echo" <span class='badge badge-info'> غير مستجاب </span></br>";
                                        echo" </td>";
										} elseif ($status == "trueClient" ) {										
	                                    echo" <td>";
                                        echo" <span class='badge badge-info'> رد العضو </span>";
                                        echo" </td>";
										} 

									?>

                                    <div class="portlet-body" >
							<div class="row">
                                       <div class="col-xs-12">
                                               <div class="ticket-id bold font-blue" style="text-align:right;"> <?php echo $tid ; ?>: رمز التذكرة</div>
											  </div>
										</div>

									
							               <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="ticket-cust">

																
                                                            </div>
                                                        </div>
                                                    </div>
                                    <ul class="list-unstyled" style="text-align:right;">
                                        <li style="text-align:right;">
											<strong><?php echo $title;?> </strong> : أسم التذكرة  </li>
                                        <li style="text-align:right;">
											  نوع التذكرة : <strong><?php echo $type;?> </strong> </li>
										<li style="text-align:right;">
											<strong><?php echo $client_name;?> </strong> : صاحب التذكرة  </li>
										
										<?php if ($type =='شكوى'){ ?>
											<li style="text-align:right;">
											<?php 
											$Fclient = $cuid . ' <strong> : ' . $cuidN . '</strong>' ;
											echo $Fclient ;
											?>
											: المتهم  </li>								
										<?php } ?>
                                    </ul>
							  <h4 class="modal-title">الأعدادات</h4>
								<?php
					echo '
						<div class="wrap">
						  <select class="bs-select form-control" id="QViewBy" data-width="100%">
                          <option>الحالة</option>
                          <option id='.$hash.'>مغلق</option>
						  <option id='.$hash.'>غير مستجاب</option>
                          </select>
						 <a class="btn purple btn-outline" style="width:15%" id="ChangeStatus" onclick="RemoveR()">تطبيق</a>
						</div>
						 ';
						?>
						
						<center>	

										<?php if ($type =='شكوى'){ ?>
					</br>	
				<button type="button" style='width:80%' class="btn purple btn-outline" onclick="return SendID('<?php echo $_GET['id']; ?>');">إرسال أيدي المتهم بالتيم سبيك</button>
										<?php } ?>
						</br>	
						</br>	
						<a class="btn purple" href="<?php echo $urlRed ; ?>">الرجوع الي الجدول</a>

						</center>			
									
                                    </div>
                                </div>
			</div>

						<div class="col-md-4">
			</div>


            </div>
			
			
			
			

		  <div id="form_modal11" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">الأعدادات</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="#" class="form-horizontal" role="form">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">الحالة</label>
                                                                <div class="col-md-8">
																<?php
																
										echo '
										      <select class="bs-select form-control" id="QViewBy" data-width="100%">
                                                                <option>-</option>
                                                                <option id='.$hash.'>مغلق</option>
                                                                <option id='.$hash.'>غير مستجاب</option>
                                                            </select>
															</br>
													<a class="btn btn-rounded btn-block btn-outline-success" onclick="RemoveR()">حفظ</a>

										';

																
																?>
																	</div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
		
		
	 <script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="assets/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="assets/jquery.min.js" type="text/javascript"></script>
		<script src="assets/app.min.js" type="text/javascript"></script>

	</div>			
</div>	



<?php require_once('includes/footer.php'); ?>























