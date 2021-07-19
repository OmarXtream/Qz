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
users_page($ggids); 

?>



<div class="page-wrapper">
        <div class="container-fluid"></br>
					
			
			
	<div class="row">
			<div class="col-md-3">
			</div>
			
				<div class="col-md-6"> 
					   <div class="card border-info">
					   <div class="card-header bg-success">
					   <center> <h4 class="m-b-0 text-white">إنشاء مستخدم جديد</h4> </center>
					   </div>
					   <div class="card-body">
					   <div class="form-group row">
					   <div class="col-12">
					   <input type="text" class="form-control" style="text-align:center" placeholder="Username" id="t-username" name="t-uid">
					   </div>
					   </div>	  
					   <div class="form-group row">
					   <div class="col-12">
					   <input type="text" class="form-control" style="text-align:center" placeholder="Password" id="t-password" name="t-uid">
					   </div>
					   </div>						
					   <div class="form-group row">
					   <div class="col-12">
					   <input type="text" class="form-control" style="text-align:center" placeholder="Admin Database id" id="t-db" name="t-uid">
					   </div>
					   </div>						
						<center><input type="checkbox" id="check1" name="check1"></input>
						<label for="check1">are you sure ?</label></center>
					  
					  <div class="form-group row">
                       <div class="col-12 text-center">
					   <button id="submitCreate"  name="submitCreate"  onclick="return LgIC();" class="btn btn-outline-success">
                       <i class="fa fa-plus"></i> Create new user
                       </button>
					   <button id="submitCreate"  name="submitCreate"  onclick="return lgCreateCd();" class="btn btn-outline-success">
                       <i class="fa fa-plus"></i> Create Link
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
					   <center> <h4 class="m-b-0 text-white">المستخدمين المسجلين</h4> </center>
					   </div>
					   <div class="card-body">
					  
					  <?php 
					  echo '<center>				
				<table class="table color-bordered-table">
				<thead>
				<tr>
				<th class="text-center">#</th>
				<th class="text-center">Username</th>
				<th class="text-center">Password</th>
				<th class="text-center">Admin Name</th>
				<th class="text-center">Action</th>
				</tr>
				</thead>
				<tbody id="myTable" >';
				$sql = "SELECT * FROM secure_login";
				if($result = mysqli_query($con, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
						try {
						$tsname = $ts3_VirtualServer->clientGetNameByDbid($row['db']);
						} catch (TeamSpeak3_Exception $e) { $tsname['name'] = "Error !" ; }

						echo "<tr>";
						   echo '<td align="center">#'. $row['id'] .'</td>';
						   echo '<td align="center"><B>'. $row['username'] .'</B>';
						   echo '<td align="center"><B>'. $row['password'] .'</B>';
						   try {
							$client = $ts3->clientGetByDbid($row['db']);
							echo '<td align="center" class="center"> '. htmlspecialchars($tsname['name']) .' <span class="badge badge-success">Online</span> </td>';
							} catch (TeamSpeak3_Exception $e) { echo '<td align="center" class="center"> '. htmlspecialchars($tsname['name']) .' <span class="badge badge-danger">Offline</span> </td>'; }
					 echo "<td><input type='button' onclick='LgI(" .$row['db'].",this);' class='btn btn-rounded btn-block btn-outline-danger' value ='Delete User'></input></td>";
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
				if (tr) {swal('تم ', 'تم حذف المستخدم بنجاح ', 'success');
				var row = btn.parentNode.parentNode;
				row.parentNode.removeChild(row);
				}
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/lg-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 

function LgIC()
{
	
if (document.getElementsByName("check1")[0].checked == true) {

		var username = document.getElementById('t-username').value;
		var password = document.getElementById('t-password').value;
		var dbid = document.getElementById('t-db').value;
		if (username == '' ||  password == '' ||  dbid == '' ) {
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
				if (tr) {swal('تم ', 'تم إنشاء مستخدم جديد ', 'success');
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
				 var newText4  = document.createTextNode("Refresh Page")
				// var newText5  = document.createTextNode('<a onclick="LgI(' + res[3] + ',this);" class="btn btn-rounded btn-block btn-outline-danger">Delete User</a>')


				   newCel0.appendChild(newText1);
				   newCell1.appendChild(newText2);
				   newCell2.appendChild(newText3);
				   newCell3.appendChild(newText4);
				   newElem = document.createElement( 'input' );
				   newElem.setAttribute("type", "button");
				   newElem.setAttribute("value", "Delete user");
				   newElem.setAttribute("class", "btn btn-rounded btn-block btn-outline-danger");
				   newElem.setAttribute("onclick", 'LgI(' + res[3] + ',this)')
				   newCell4.appendChild(newElem);

					
				   newCell1.style.fontWeight = 'bold';
				   newCell2.style.fontWeight = 'bold';

				 }
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/lg-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	
	 } else {
		 
			swal('! خطأ ', 'يجب عليك الموافقه على التأكيد ', 'error');
 
	 }
} 


function lgCreateCd()
{
	

	
		var params = "lgCreateCd";
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var str = xmlhttp.responseText;
				var tr = str.includes("panel");
				var error = str.includes("error");
				if (tr) {swal('تم ', str, 'success');}
				if (error) {swal('! خطأ ', 'المعلومات الذي أدخلتها غير صحيحة ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/lg-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;
	
} 

</script>
		
<?php require_once('includes/footer.php'); ?>























