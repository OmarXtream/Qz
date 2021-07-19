<?php
require 'config/phphead.php';
//require 'config/sqlconfig.php'; 
$BlcList = array(1755);
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
//ini_set('display_errors', 1);
///ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if (isset($_GET["action"])) {
if ( $_GET["action"] == "create" ) {
	$create = true ;
	}
} elseif (isset($_GET["id"])) {
	$view = true ;
} else { $main = true ; }

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
if(count(array_intersect($BlcList, $ggids)) > 0){ 
die('<script> swal({title: "عذرا",text: "عفوا ، انت محظور من نظام التذاكر",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
}

$detected_clients = $ts3->clientList(array('client_type' => '0'));
//ticketNew($ggids); 

?>

    
<div class="page-wrapper">
<style>

</style>
        <div class="container-fluid"></br>
					
			<?PHP
			
			if ( $main  == true ) {

				echo '<center>	
			<div class="row">;			
		<div class="col-md-4">
	</div>

			<div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-success ">
                              <center> <h4 class="m-b-0 text-white">تعليمات</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-success">النظام قيد التجربة للأن</span></center>
										</p>
										<center>
										<strong>
				<label>- لايمكنك عمل اكثر من 5 تذاكر في حال لديك 5 تذاكر غير مستجابه</label></br>
				<label>- هنالك حد للرسائل بالتذكرة الواحدة ، لذلك أختصر مشكتلك</label></br>
				<label>- النظام للأن غير مستقر ، في حال واجهت اي مشكلة تواصل مع الادارة</label>
				</strong>
										</center>
										</br>
                                </div>
							</div>
						</div>
			</div>

<div class="col-md-4">
	</div>

			</div>
		
		
				
				
				
				<div class="col-md-12">
				<div class="card">
				<div class="card-body">
				<center> <h3 class="card-title">التذاكر الخاصه بك</h3>
				<label><strong>اضغط على العنوان الخاص بالتذكرة للدخول</strong></label>
				</br>
				<div class="col-lg-4 col-md-4">
				<a href="Tickets.php?action=create" class="btn btn-rounded btn-block btn-outline-info">إنشاء تذكرة جديده</a>
				</div>	
 				</center>
				</br>
				<div class="table-responsive">
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th class="text-center">رقم التذكرة</th>
				<th class="text-center">العنوان</th>
				<th class="text-center">نوع التذكرة</th>
				<th class="text-center">تاريخ إنشاء التذكرة</th>
				<th class="text-center">الحالة</th>
				<th class="text-center">مشاهدة</th>
				</tr>
				</thead>
				<tbody>';
                $sql = "SELECT * FROM ticket_system WHERE client_uid='$uid' ORDER BY `id` DESC";
				$mytickets = 0;
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							$mytickets ++ ;
						echo "<tr>";
                           echo '<td align="center"><a href="Ticket_open.php?id='. $row["hash"] .'">'. $mytickets .'</a></td>';
                           echo	'<td align="center"><a href="Ticket_open.php?id='. $row["hash"] .'">'. $row["title"] .'</a></td>';
						   echo '<td align="center">'. $row['type'] .'</td>';
                           echo '<td align="center"> '. $row['date'] .' </td>';
			
					if ($row['status'] == "closed" ) {										
                                
										echo "<td align='center'><span class='badge badge-danger'>مغلق</span></td>";
                                     
										} elseif ($row['status'] == "true" ) {										
	                              
							echo "<td align='center'><span class='badge badge-success'>رد الادمن</span></td>";
                               
										} elseif ($row['status'] == "yet" ) {										
	         
							echo "<td align='center'><span class='badge badge-info'>غير مستجاب</span></td>";
										} elseif ($row['status'] == "trueClient" ) {										
										echo "<td align='center'><span class='badge badge-info'>رد العضو</span></td>";
										}
							echo "<td><a href='Ticket_open?id=" .$row["hash"]."' class='btn btn-rounded btn-block btn-outline-success'>مشاهدة التذكرة</a></td>";
										echo "</tr>";
					 echo "</tr>";
		
				}
						} else {
						echo "<tr>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
						echo "</tr>";

					}	
				}
				echo '
									</tbody>
								</table>
							</div>
						</div>
					</div>				
			</center>
			';
			
			}
			

			
	if ( $create == true ) {
	
	echo ' 
	
	<div class="row">
			<div class="col-md-3">
			</div>
				<div class="col-md-6"> 
                        <div class="card border-info">
                            <div class="card-header bg-warning">
                               <center> <h4 class="m-b-0 text-white">التذاكر ( إنشاء )</h4> </center>
								</div>
							<div class="card-body">
								
								<div class="form-group row">
								<div class="col-12">
								<input type="text" class="form-control" id="t-name" name="t-name" placeholder="أسم تذكرة">
								</div>
								</div>							
								<div class="form-group row">
								<div class="col-12">
								<label>الأيدي الخاص بك</label>
								<input disabled type="text" class="form-control" id="t-uid" name="t-uid" value="'.$uid.'">
								</div>
								</div>
								


								<label><strong>ملاحظة : يجب عليك إختيار نوع التذكرة ، ويفضل تحديد اهمية التذكرة لسرعة الأستجاوب</strong></label>
								<label>في حال عدم وجود المتهم بالخيارات بأمكانك إرفاق الايدي الخاص به بالرسالة</label>
								<div class="form-group row">
								<div class="col-4">
								<select id="t-type" name="t-type"  style="text-align:right;" class="bs-select form-control">
								<option selected>نوع التذكره</option>
								<option>شكوى</option>
								<option>أقتراح</option>
								<option>اخرى</option>
								';
								$sql = "SELECT * FROM ticket_comp";
							if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							echo '1' ;
						echo"<option value=".$row['id'].">".$row['name']." - ( فعالية )</option> " ;
							}}}
								echo '
								</select>
								</div>
								
								<div class="col-4">
								<select class="form-control" style="text-align:right;" id="clid">
								<option>المتهم</option>
								';
								foreach ($detected_clients as $client) {
								echo"<option value=".$client->client_unique_identifier ." id=".$client->client_nickname .">" . $client->client_nickname ."</option> " ;
								}	
					    	echo '</select>
								</div>
								
								<div class="col-4">
								<select id="t-pr" name="t-pr"  style="text-align:right;" class="bs-select form-control">
								<option value="none" selected>أهمية التذكرة</option>
								<option value="n">عادي</option>
								<option value="m">متوسط</option>
								<option value="h">عاجل</option>
								</select>
								</div>

								</div>
								
								<div class="col-12">
							<label><strong>ملاحظة مهمة : يجب عليك إرفاق الدليل هنا في حال تود إنشاء شكوى</strong><label>
								</div>


								<div class="col-13">
								<textarea class="form-control" id="t-msg" name="t-msg" rows="6" placeholder="الرساله .."></textarea>
								</div>
								</br>
								
								<center><div class="g-recaptcha" data-sitekey="6LcV6H0UAAAAAD6huL4K8wUx6y_XvcaWYD3Aajn9"></div><center></br>
							<input type="checkbox" id="check1" name="check1"></input>
							  <label for="check1">هل انت متأكد من جميع معلومات التذكرة ؟</label>

                                <div class="form-group row">
                                    <div class="col-12 text-center">
								  <button id="submitCreate"  name="submitCreate"  onclick="return CreateTicket();" class="btn btn-outline-success">
                                            <i class="fa fa-plus"></i> إنشاء قيمه جديده
                                        </button>

								<a href="https://panel.q-z.us/Tickets" class="btn btn-outline-warning">
								 <i class="fa fa-home"></i> الرجوع للجدول
								</a>		


                                    </div>

							</div>
						</div>
			</div> </center>
			
			
			

        </div>
        </div>
	
	';
	
	
}	






			?>
			

		
		
		
	 <script src='https://www.google.com/recaptcha/api.js'></script>

	</div>			
</div>	


<script type="text/javascript">
function CreateTicket()
{
	  if (document.getElementsByName("check1")[0].checked == true) {

		var response = grecaptcha.getResponse();
		if(response.length == 0) {
		swal('خطأ', 'الرجاء التحقق من انك لست روبوت ', 'error'); 
		return false ;
		}
		var cuid = document.getElementById('clid').value;
		var t = document.getElementById('clid');
		var cuidN = t.options[t.selectedIndex].text;
		var uid = '<?php echo $uid; ?>'
		var nick = "<?php echo htmlspecialchars($nickname) ?>"
		var sub = document.getElementById('t-name').value
		var type = document.getElementById('t-type').value
		var msg = document.getElementById('t-msg').value
		var pr = document.getElementById('t-pr').value
		if (sub == '' ||  type == 'نوع التذكره' || msg == '') {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		if ( pr == "none" ) {
			pr = "n" ;
		}
		document.getElementById("submitCreate").innerHTML = "الرجاء الأنتظار..";
		var params = "submitCreate&t-name=" + encodeURIComponent(sub) + "&t-type=" +encodeURIComponent(type)+"&t-cuid="+encodeURIComponent(cuid)+"&t-cuidN="+encodeURIComponent(cuidN)+"&t-msg=" + encodeURIComponent(msg) +"&t-pr=" + encodeURIComponent(pr) + "&nick=" +encodeURIComponent(nick) ;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("submitCreate").innerHTML = "إنشاء قيمه جديده";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var limtper = str.includes("lmp");
				var limt = str.includes("limt");
				var max = str.includes("3");
				if (tr) { swal({title: "تم",text: " تم إنشاء التذكرة ، انتظر رد طاقم الأداره",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/Tickets");}else {window.location.replace("https://panel.q-z.us/Tickets");}})}	
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
				if (max) {swal('! خطأ ', 'لديك 5 تذاكر غير مستجابة بالفعل ، انتظر الرد عليهم ثم بأمكانك التقديم ', 'error');}
				if (limtper) {swal('! خطأ ', 'لا يمكنك إنشاء المزيد من التذاكر بالفعالية ', 'error');}
				if (limt) {swal('! خطأ ', 'الفعالية أصبحت ممتلئة ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/ticket/QticketAjax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} {
	swal('! خطأ ', 'يجب عليك الموافقه على التأكيد ', 'error');
	}
} 
</script>
		
<?php require_once('includes/footer.php'); ?>























