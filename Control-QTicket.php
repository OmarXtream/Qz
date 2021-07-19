<?php
require 'config/phphead.php';
//require 'config/sqlconfig.php'; 
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
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
$detected_clients = $ts3->clientList(array('client_type' => '0'));
ticketConfig($ggids); 
$sql = "SELECT * FROM ticket_system";
$result = $con->query($sql);
$allTicktets=mysqli_num_rows($result);
$sql="SELECT * FROM ticket_system WHERE status='closed'";
$result = $con->query($sql);
$closedTicktets=mysqli_num_rows($result);

?>



<div class="page-wrapper">
        <div class="container-fluid"></br>
					
			
<center>				
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">لوحه التحكم ( التذاكر )</h3></br>
				<hr>
			<div class="row">;			
					<div class="col-2">
					</div>

					<div class="col-4">
						<div class="card border-dark">
						<div class="card-header bg-danger">
                        <h4 class="m-b-0 text-white"><b>إيقاف \ تشغيل النظام</b></h4>
						</div></br>
						<label>حالة النظام : <?php if ( $STicket == "true" ) { ?> <span id="statusLb" class='badge badge-success'>مفعل</span> <?php } else { ?> <span id="statusLb" class='badge badge-danger'>معطل</span> <?php } ?> </label>
						<select id="t-pr" name="t-pr"  style="text-align:right;width :70%" class="bs-select form-control">
						<option value="true">تشغيل</option>
						<option value="false">إيقاف</option>
						</select>
						<div class="col-md-5">
						</br>
						<a class="btn btn-rounded btn-block btn-outline-success" style="width:100%" id="submit1" onclick="ChangeStatus()">تطبيق التغيرات</a>
						</div>
						</div>
					</div>
					
					<div class="col-4">
						<div class="card border-dark">
						<div class="card-header bg-danger">
                        <h4 class="m-b-0 text-white"><b>تحكم بالتذاكر</b></h4>
						</div></br>
						<label id ="nonClosed">عدد التذاكر : <?php echo $allTicktets ;?>  </label>
						<label id ="Closed">عدد التذاكر المغلقة : <?php echo $closedTicktets ;?> </label>
						<div class="col-md-5">
						</br>
						<a class="btn btn-rounded btn-block btn-outline-success" style="width:100%" id="submit1" onclick="DeleteTickets()">مسح جميع التذاكر المغلقة</a>
						</div>
						</div>
					</div>
					
				</div>
					
					

					<hr>

					
				
				
				 
				
				
			
		</div>
	</div>				
</center>

			
			
		
		

	</div>			
</div>	


<script type="text/javascript">
function ChangeStatus()
{
		var valueC = document.getElementById('t-pr').value;
		document.getElementById("submit1").innerHTML = "جارى التطبيق ..";
		var params = "Runsystem&value=" + encodeURIComponent(valueC);
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("submit1").innerHTML = "تطبيق التغيرات";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var max = str.includes("3");
				if (tr) {swal(' تم ', 'تم تطبيق التغيرات ', 'success');
				if ( valueC == 'true' ) {
					document.getElementById('statusLb').className  = 'badge badge-success';
					document.getElementById('statusLb').innerHTML  = 'مفعل';
					} else {
					document.getElementById('statusLb').className  = 'badge badge-danger';
					document.getElementById('statusLb').innerHTML  = 'معطل';
					}
				}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
			} 
		  }
		xmlhttp.open("POST","config/ticket/HighControlAjax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} 
	
	function DeleteTickets()
{
		var valueC = document.getElementById('t-pr').value;
		document.getElementById("submit1").innerHTML = "جارى التطبيق ..";
		var params = "DeleteClosed=1";
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("submit1").innerHTML = "تطبيق التغيرات";
				var str = xmlhttp.responseText;
				var tr = str.includes("true");
				var error = str.includes("error");
				var max = str.includes("3");
				if (tr) {swal(' تم ', 'تم تطبيق التغيرات ', 'success');	
				var Closed = document.getElementById("Closed").value;
				var nonClosed = document.getElementById("nonClosed").value;
				document.getElementById("Closed").innerHTML = "0";
				document.getElementById("nonClosed").innerHTML = nonClosed - Closed;

				}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
			} 
		  }
		xmlhttp.open("POST","config/ticket/HighControlAjax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} 
</script>
		
<?php require_once('includes/footer.php'); ?>























