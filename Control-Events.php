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
ticketEventConfig($ggids); 
?>



<div class="page-wrapper">
        <div class="container-fluid"></br>
					
			
<center>	

	<div class="row">
			<div class="col-md-3">
			</div>
			
				<div class="col-md-6"> 
					   <div class="card border-info">
					   <div class="card-header bg-success">
					   <center> <h4 class="m-b-0 text-white">إنشاء فعاليه جديده</h4> </center>
					   </div>
					   <div class="card-body">
					   <div class="form-group row">
					   <div class="col-12">
					   <input type="text" class="form-control" style="text-align:center" placeholder="أسم الفعالية" id="t-username" name="t-uid">
					   </div>
					   </div>	  
					   <div class="form-group row">
					   <div class="col-12">
					   <input type="text" class="form-control" style="text-align:center" placeholder="حد التذاكر" id="t-password" name="t-uid">
					   </div>
					   </div>						
					   <div class="form-group row">
					   <div class="col-12">
					   <input type="text" class="form-control" style="text-align:center" placeholder="حد التذاكر للشخص الواحد" id="t-db" name="t-uid">
					   </div>
					   </div>						
						<center><input type="checkbox" id="check1" name="check1"></input>
						<label for="check1">are you sure ?</label></center>
					  
					  <div class="form-group row">
                       <div class="col-12 text-center">
					   <button id="submitCreate"  name="submitCreate"  onclick="return CreateNewValue();" class="btn btn-outline-success">
                       <i class="fa fa-plus"></i> إضافة الفعالية
                       </button>
				    	</div>
					   </div>						

				</div>
			</div> 
        </div>
		
			</div>
		
		<hr>
			
	<div class="col-md-12"> 
					   <div class="card border-info">
					   <div class="card-header bg-success">
					   <center> <h4 class="m-b-0 text-white">الفعاليات المسجلة بنظام التذاكر</h4> </center>
					   </div>
					   <div class="card-body">
					  
					  <?php 
					  echo '<center>				
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th class="text-center">#</th>
				<th class="text-center">الأسم</th>
				<th class="text-center">عدد التذاكر المسموحه للجميع</th>
				<th class="text-center">عدد التذاكر المسموحه للشخص</th>
				<th class="text-center">حذف</th>
				</tr>
				</thead>
				<tbody id="myTable" >';
				error_reporting(E_ALL);
				ini_set('display_errors', 1);

				$sql = "SELECT * FROM ticket_comp";
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						   echo '<td align="center">#'. $row['id'] .'</td>';
						   echo '<td align="center"><B>'. $row['name'] .'</B>';
						   echo '<td align="center"><B>'. $row['limt'] .'</B>';
						   echo '<td align="center"><B>'. $row['limtper'] .'</B>';
						  echo "<td><input type='button' onclick='LgI(" .$row['id'].",this);' class='btn btn-rounded btn-block btn-outline-danger' value ='Delete User'></input></td>";
						 echo "</tr>";

				}
						} else {

						
					}	
				}
				echo '
									</tbody>
								</table>
			</center>
			';
			
					  
					  
					  ?>
					  
					  
			</div> 
        </div>
		
	 <script src='https://www.google.com/recaptcha/api.js'></script>

	</div>			
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
		xmlhttp.open("POST","config/ticket/HighControlAjaxEV",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} 
	
	function CreateNewValue()
{
		var Name = document.getElementById('t-username').value;
		var limt = document.getElementById('t-password').value;
		var limtper = document.getElementById('t-db').value;
		var params = "CreateNewEvent&name=" + encodeURIComponent(Name) + "&limt=" + encodeURIComponent(limt)+ "&limtper=" + encodeURIComponent(limtper);
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
				var max = str.includes("3");
				if (tr) {swal(' تم ', 'تم تطبيق التغيرات ', 'success');		
				var res = str.split(',');
				var tableRef = document.getElementById("myTable");
				document.getElementById('myTable').style.textAlign="center";

			    var newRow  = tableRef.insertRow(tableRef.rows.length);
				 var newCel0  = newRow.insertCell(0);
				 var newCell1  = newRow.insertCell(1);
				 var newCell2  = newRow.insertCell(2);
				 var newCell3  = newRow.insertCell(3);
				 var newCell4  = newRow.insertCell(4);

				 var newText1  = document.createTextNode('#')
				 var newText2  = document.createTextNode(res[1])
				 var newText3 = document.createTextNode(res[2])
				 var newText4  = document.createTextNode(res[3])
				// var newText5  = document.createTextNode('<a onclick="LgI(' + res[3] + ',this);" class="btn btn-rounded btn-block btn-outline-danger">Delete User</a>')


				   newCel0.appendChild(newText1);
				   newCell1.appendChild(newText2);
				   newCell2.appendChild(newText3);
				   newCell3.appendChild(newText4);
				   newElem = document.createElement( 'input' );
				   newElem.setAttribute("type", "button");
				   newElem.setAttribute("value", "Delete user");
				   newElem.setAttribute("class", "btn btn-rounded btn-block btn-outline-danger");
				   newElem.setAttribute("onclick", 'LgI(' + res[1] + ',this)')
				   newCell4.appendChild(newElem);

					
				   newCell1.style.fontWeight = 'bold';
				   newCell2.style.fontWeight = 'bold';




				}
				if (error) {swal('! خطأ ', 'لقد حدث خطأ ما ، تواصل مع الادارة ', 'error');}
			} 
		  }
		xmlhttp.open("POST","config/ticket/HighControlAjaxEV",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	} 
	
function LgI(db,btn)
{
 	
		var params = "dbDel=" + db ;
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
				if (tr) {swal('تم ', 'تم حذف الفعالية ', 'success');
				var row = btn.parentNode.parentNode;
				row.parentNode.removeChild(row);
				}
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/ticket/HighControlAjaxEV",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 
	
</script>
		
<?php require_once('includes/footer.php'); ?>























