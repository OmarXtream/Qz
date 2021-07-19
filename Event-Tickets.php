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

$detected_clients = $ts3->clientList(array('client_type' => '0'));
ticketEvent($ggids); 

?>



<div class="page-wrapper">
        <div class="container-fluid"></br>
					
			<?PHP
			
			if ( $main  == true ) {

				echo '<center>				
				<div class="col-md-12">
				<div class="card">
				<div class="card-body">
				<center> <h3 class="card-title">تذاكر الأعضاء</h3>
 				</center>
				</br>
				
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-rounded btn-block btn-outline-danger" onclick="return searchData(\'reset\');" style="margin-right: 10px" id="searchButtonDel" type="button">إظهار جميع التذاكر</button>
				  </span>	
				</div></br>
			  
				<div class="input-group">
					<div class="col-2">
						<select id="t-type" name="t-type"  style="text-align:right;" class="bs-select form-control">
						<option value="all" selected>الكل</option>
					';
					$sql = "SELECT * FROM ticket_comp";
							if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							echo '1' ;
						echo"<option>".$row['name']."</option> " ;
							}}}					
					echo '
						</select>
					</div>
				<span class="input-group-btn">
					<button class="btn btn-rounded btn-block btn-outline-success" onclick="return ticketsFilter();" style="margin-right: 5px" id="searchButton" type="button">تطبيق التصفية</button>
				 </span> 

				 

				</div></br>
				 

				
				
				<div class="table-responsive">
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th class="text-center">رقم التذكرة</th>
				<th class="text-center">العنوان</th>
				<th class="text-center">نوع التذكرة</th>
				<th class="text-center">تاريخ إنشاء التذكرة</th>
				<th class="text-center">صاحب التذكرة</th>
				<th class="text-center">الحالة</th>
				<th class="text-center">التحكم [ مشاهدة - رد ]</th>
				</tr>
				</thead>
				<tbody id="modalContent">';
				/////////////////////////////////
				if(isset($_GET["filter"])){
				$TicketType = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_GET["filter"]))));	
		if ( $TicketType != "شكوى" && $TicketType != "اخرى" && $TicketType != "أقتراح") {
				$sql = "SELECT * FROM ticket_system WHERE type='$TicketType' ORDER BY `id` DESC";
					} elseif ($TicketType == 'all')  {
				$sql = "SELECT * FROM ticket_system WHERE type NOT IN ('شكوى','أقتراح','اخرى') ORDER BY `id` DESC";
				} 
				}  else {
				$sql = "SELECT * FROM ticket_system WHERE type NOT IN ('شكوى','أقتراح','اخرى') ORDER BY `id` DESC";
				}
				/////////////////////////////
				$mytickets = 0;
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						   echo '<td align="center">#'. $row['id'] .'</td>';
						   echo '<td align="center"><B>'. $row['title'] .'</B>
						   ';
						   if ( $row['priority'] == "weak") {
							   echo '<span class="badge badge-info">عادي</span>';
						   }elseif ( $row['priority'] == "modreatre") {
							   echo '<span class="badge badge-warning">متوسط الأهمية</span>';
						   }elseif ( $row['priority'] == "important") {
							   echo '<span class="badge badge-danger">مهم جدا</span>';
						   }
						   echo '</td>';
						   echo '<td align="center">'. $row['type'] .'</td>';
                           echo '<td align="center"> '. $row['date'] .' </td>';
						   try {
							$client = $ts3->clientGetByUid($row['client_uid']);
							echo '<td align="center" class="center"> '. htmlspecialchars($row['client_name']) .' <span class="badge badge-success">Online</span> </td>';
							} catch (TeamSpeak3_Exception $e) { echo '<td align="center" class="center"> '. htmlspecialchars($row['client_name']) .' <span class="badge badge-danger">Offline</span> </td>'; }
				  if ($row['status'] == "closed" ) {										
							echo "<td align='center'><span class='badge badge-danger'>مغلق</span></td>";
							} elseif ($row['status'] == "true" ) {										
							echo "<td align='center'><span class='badge badge-success'>رد الادمن</span></td>";
							} elseif ($row['status'] == "yet" ) {										
							echo "<td align='center'><span class='badge badge-info'>غير مستجاب</span></td>";
							}
							elseif ($row['status'] == "trueClient" ) {										
							echo "<td align='center'><span class='badge badge-info'>رد العضو</span></td>";
					}
						 echo "<td><a href='A-Ticket_open?id=" .$row["hash"]."' class='btn btn-rounded btn-block btn-outline-success'>مشاهدة التذكرة</a></td>";
						 echo "</tr>";

				}
						} else {
						echo "<tr>";
						echo "<td align='center'>لايوجد</td>";
						echo "<td align='center'>لايوجد</td>";
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
			

			
	






			?>
			

		
		
		
	 <script src='https://www.google.com/recaptcha/api.js'></script>

	</div>			
</div>	


<script type="text/javascript">
function CreateTicket()
{
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
		if (sub == '' ||  type == '' || msg == '') {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		document.getElementById("submitCreate").innerHTML = "الرجاء الأنتظار..";
		var params = "submitCreate&t-name=" + encodeURIComponent(sub) + "&t-type=" +encodeURIComponent(type)+"&t-cuid="+encodeURIComponent(cuid)+"&t-cuidN="+encodeURIComponent(cuidN)+"&t-msg=" + encodeURIComponent(msg) + "&nick=" +encodeURIComponent(nick) ;
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
				var max = str.includes("3");
				if (tr) { swal({title: "تم",text: " تم إنشاء التذكرة ، انتظر رد طاقم الأداره",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/QTicket");}else {window.location.replace("https://panel.q-z.us/QTicket");}})}	
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
				if (max) {swal('! خطأ ', 'لديك 5 تذاكر غير مستجابة بالفعل ، انتظر الرد عليهم ثم بأمكانك التقديم ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/ticket/ticketAjax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} 
	
	
function ticketsFilter()
{
		var type = document.getElementById('t-type').value
		window.location.href = "https://panel.q-z.us/Event-Tickets?filter=" + type;  
	return false;
} 
	
	
function searchData(sq) {
		if ( sq == "reset" ) {
		var title = "" ;	
		document.getElementById("searchButtonDel").innerHTML = "إنتظر ..";
		} else {
		var title = document.getElementById("searchquery").value;
		document.getElementById("searchButton").innerHTML = "إنتظر ..";
		}
        var request= new XMLHttpRequest();
        request.onreadystatechange= function() {
            if (request.readyState == 4 && request.status == 200) {
				document.getElementById("searchButton").innerHTML = "بحث";
				document.getElementById("searchButtonDel").innerHTML = "إظهار جميع التذاكر";
                document.getElementById("modalContent").innerHTML=request.responseText;  
					console.log(request.responseText);
            } 
        }


        request.open("POST", "config/ticket/search", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("searchTickets="+title);
    }

</script>
		
<?php require_once('includes/footer.php'); ?>























