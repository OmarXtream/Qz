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
ticketNew($ggids); 

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
						<button class="btn btn-rounded btn-block btn-outline-info" onclick="return searchData(\'reset\');"  id="searchButtonDel" type="button">إظهار جميع التذاكر</button>
				  </span>	
				  ';
			$DelAllTicktes = array(1555,1672,1048,2171,10);
			if(count(array_intersect($DelAllTicktes, $ggids)) > 0){ 
			echo '
			<span class="input-group-btn">
			<button class="btn btn-rounded btn-block btn-outline-danger" onclick="return deleteFunction();" style="margin-right: 10px" id="ticketButtonDel" type="button">مسح التذاكر المحددة</button>
			 </span>	';
			} else {
			echo '
			<span class="input-group-btn">
			<button disabled class="btn btn-rounded btn-block btn-outline-danger" onclick="return deleteFunction();" style="margin-right: 10px" id="ticketButtonDel" type="button">مسح التذاكر المحددة</button>
			 </span>	';

			}
				  
				  echo '
				</div></br>
			  
				<div class="input-group">

				<label><input type="search" size="35" class="form-control input-sm input-small input-inline" placeholder="Client UID/Name" id="searchquery" name="searchquery" aria-controls="sample_1"></label>
				  <span class="input-group-btn">
					<button class="btn btn-rounded btn-block btn-outline-success" onclick="return searchData(\'normal\');" style="margin-right: 5px" id="searchButton" type="button">بحث</button>
				  </span> 
				  
				</div>
				<div class="input-group">
					<div class="col-4">
						<select id="t-filter" name="t-filter"  style="text-align:right;" class="bs-select form-control">
						<option value="none" selected>التذاكر الغير مستجابة</option>
						<option value="mine">التذاكر المستجاب عليها من قبلك</option>
						<option value="closed">التذاكر المغلقه</option>
						<option value="unclosed">تذاكر قيد التعامل معها</option>
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
				<th class="text-center">TK</th>
				<th class="text-center">العنوان</th>
				<th class="text-center">نوع التذكرة</th>
				<th class="text-center">تاريخ إنشاء التذكرة</th>
				<th class="text-center">صاحب التذكرة</th>
				<th class="text-center">الحالة</th>
				<th class="text-center">التحكم [ مشاهدة - رد ]</th>
				<th class="text-center">-</th>
				</tr>
				</thead>
				<tbody id="modalContent">';
				$ShowAllTicktes = array(1555,1672,1048,2171,10);
				/////////////////////////////////
				if(isset($_GET["filter"])){
				$filter = $_GET["filter"];
				if ( $filter == "mine" ) {
					$sql = "SELECT *  FROM `ticket_system` 
					WHERE find_in_set($dbid, `admin`) > 0
				    ORDER BY `id` DESC";
				} elseif  ( $filter == "none" ) {
					if(count(array_intersect($ShowAllTicktes, $ggids)) > 0){ 
					$sql = "SELECT * FROM ticket_system WHERE status='yet' AND type IN ('شكوى','أقتراح','اخرى') ORDER BY `id` DESC";
					} else {
					$sql = "SELECT * FROM ticket_system WHERE status='yet' AND type='شكوى' ORDER BY `id` DESC";
					}
				} elseif  ( $filter == "closed" ) {
					if(count(array_intersect($ShowAllTicktes, $ggids)) > 0){ 
					$sql = "SELECT * FROM ticket_system WHERE status='closed' AND type IN ('شكوى','أقتراح','اخرى')  ORDER BY `id` DESC";
					} else {
					$sql = "SELECT * FROM ticket_system WHERE status='closed' AND type='شكوى' ORDER BY `id` DESC";
					}
				} elseif  ( $filter == "unclosed" ) {
					if(count(array_intersect($ShowAllTicktes, $ggids)) > 0){ 
					$sql = "SELECT * FROM ticket_system WHERE status NOT IN ('closed','yet') AND type IN ('شكوى','أقتراح','اخرى')  ORDER BY `id` DESC";
					} else {
					$sql = "SELECT * FROM ticket_system WHERE status NOT IN ('closed','yet') AND type='شكوى' ORDER BY `id` DESC";
					}
					}
				} elseif(isset($_GET["show"])){
				$showID = htmlspecialchars(stripslashes(strip_tags($_GET["show"])));
				$sql = "SELECT *  FROM `ticket_system` 
				WHERE find_in_set($showID, `admin`) > 0
				ORDER BY `id` DESC";
				}else {
					if(count(array_intersect($ShowAllTicktes, $ggids)) > 0){ 
						$sql = "SELECT * FROM ticket_system WHERE type IN ('شكوى','أقتراح','اخرى') ORDER BY `id` DESC";
					} else {
						$sql = "SELECT * FROM ticket_system WHERE type='شكوى' ORDER BY `id` DESC";
					} 
				}
				/////////////////////////////
				$mytickets = 0;
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						if(count(array_intersect($DelAllTicktes, $ggids)) > 0){ 
						   echo '<td align="center"><input name="checkboxIDS[]" type="checkbox" id="'. $row['title'] .'"  value="'. $row['hash'] .'"/></td>';

						} else {
							echo '<td align="center"><input name="checkboxIDS[]" type="checkbox" id="'. $row['title'] .'"  value="'. $row['hash'] .'"/disabled></td>';

						}
						   echo '<td align="center"><B>'. $row['title'] .'</B> ';
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


<script>
function deleteFunction() {
	var checkboxes = document.getElementsByName('checkboxIDS[]');
	var vals = "" ;
	var valsID = "\n" ;
	for (var i=0, n=checkboxes.length;i<n;i++) 
	{
	if (checkboxes[i].checked) 
		{
			vals += ","+checkboxes[i].value;
			valsID += "- " + checkboxes[i].id + "<br>";
		}
	}
swal({
  title: "هل أنت متأكد ؟",
  html: valsID + "سوف يتم مسح التذاكر ولا يمكن إسترجاعها من جديد<br>" ,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "نعم ، قم بمسح التذاكر",
  cancelButtonText: "لا ، رجاء إلغاء العملية",
}).then((result) => {
  if (result.value) {
	if (vals) vals = vals.substring(1);
		if (vals == '') {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		document.getElementById("ticketButtonDel").innerHTML = "الرجاء الأنتظار..";
		var params = "ticketButtonDel&var=" + encodeURIComponent(vals) ;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("ticketButtonDel").innerHTML = "مسح التذاكر المحددة";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				if (tr) {swal(' تم ', 'تم حذف التذاكر المحدده ', 'success');}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/ticket/HighControlAjax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

    } else if (result.dismiss === Swal.DismissReason.cancel) {
    swal(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})

}

function deleteFunction11() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "هل أنت متأكد ؟",
  text: "سوف يتم مسح التذاكر ولا يمكن إسترجاعها من جديد",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "نعم ، قم بمسح التذاكر",
  cancelButtonText: "لا ، رجاء إلغاء العملية",
},
function(isConfirm){
  if (isConfirm) {

	
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
}



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
	
function ticketsRemove()
{

var checkboxes = document.getElementsByName('checkboxIDS[]');
var vals = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
    if (checkboxes[i].checked) 
    {
        vals += ","+checkboxes[i].value;
    }
}
if (vals) vals = vals.substring(1);
		if (vals == '') {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		document.getElementById("ticketButtonDel").innerHTML = "الرجاء الأنتظار..";
		var params = "ticketButtonDel&var=" + encodeURIComponent(vals) ;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("ticketButtonDel").innerHTML = "مسح التذاكر المحددة";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var max = str.includes("3");
				if (tr) {swal(' تم ', 'تم حذف التذاكر المحدده ', 'success');}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/ticket/HighControlAjax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} 
	
	
function ticketsFilter()
{
		var pr = document.getElementById('t-filter').value;
		if (pr == 'mine') {
			window.location.href = "https://panel.q-z.us/A-Tickets?filter=mine";  
		} else if ( pr == "none" ) {
			window.location.href = "https://panel.q-z.us/A-Tickets?filter=none";  
		} else if ( pr == "closed" ) {
			window.location.href = "https://panel.q-z.us/A-Tickets?filter=closed";  
		} else if ( pr == "unclosed" ) {
			window.location.href = "https://panel.q-z.us/A-Tickets?filter=unclosed";  
		}
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























