<?php
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
$Access = false ;


?>

        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
			
<center>

<div id="step1" class="col-md-6">
<div class="card text-center">
                            <div class="card-header">
                                أدخل المعلومات اللازمة 
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">أدخل ايدي الشخص الذي عاقبته </h4>
							<div class="form-group">
                                 <input type="text" name="uid" id="uid" value="" class="form-control" placeholder="Client UID / Ex. A9JtvxebP4tZzwBXIJSTwaHuSqU="> <br />

								 </div>
                           <button id="submitCreate"  name="submitCreate"  onclick="return LgI();" class="btn btn-info act">
						   <i class="fa fa-next"></i> الخطوه التالية
						   </button>

							</div>
                            <div class="card-footer text-muted">
                               
                            </div>
                        </div>			
			
			
        </div>
		

<div id="step2" style="display: none;" class="col-md-6">
<div class="card text-center">
                            <div class="card-header">
                                تعديل المعلومات 
                            </div>
                            <div class="card-body">
							<div class="form-group">
								<label>السبب</label>
								<input type="text" style="text-align:center;"  id="reason" class="form-control"><br>
                            </div>
							<div class="form-group">
								<label>الدليل</label>
								<input type="text" style="text-align:center;"  id="evd" class="form-control" ><br>
                            </div>
							<div class="form-group">
								<label>الملاحظات</label>
								<input type="text" style="text-align:center;"  id="note" class="form-control" ><br>
                            </div>
                           <button id="submitEdit"  name="submitCreate"  onclick="" class="btn btn-info act">
						   <i class="fa fa-next"></i> الخطوه التالية
						   </button>
                            </div>
                            <div class="card-footer text-muted">
                               
                            </div>
                        </div>			
			
			
			
        </div>
		
		
		
</center>
		

		
        </div>
        </div>
		<script type="text/javascript">
function LgI()
{
		var uid = document.getElementById('uid').value;
		if (uid == '') {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		var params = "uidCheckForChange=" + encodeURIComponent(uid) ;
		if (window.XMLHttpRequest)
		  xmlhttp=new XMLHttpRequest();
		else
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var str = xmlhttp.responseText;
				var data = JSON.parse(xmlhttp.responseText);				
				if (data.status == "true") {
				var x = document.getElementById("step1");
			    var x2 = document.getElementById("step2");
				x.style.display = "none";
				x2.style.display = "block";
				var reason = data.reason ;
				var evd = data.evd ;
				var note = data.note ;
				var typeQ = data.type ;
				var idQ = data.id ;
				document.getElementById("reason").value = reason ;
				document.getElementById("evd").value = evd ;
				if ( note == "null" ) {
				document.getElementById("note").value = "لايوجد";
				document.getElementById("note").disabled = true;
				} else {
				document.getElementById("note").value = note ;
				}
				document.getElementById('submitEdit').setAttribute( "onClick", "LgI1('"+typeQ+"',"+idQ+")" );

				} else if (data.status == "ald") {
					swal('! خطأ ', 'يمكنك تعديل العقوبه مره واحده فقط ', 'error');
				} else {
					swal('! خطأ ', 'حدث خطأ ما تواصل مع الادارة ', 'error');
				}

			} 
		  }
		xmlhttp.open("POST","config/punsh-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 

function LgI1(type,id)
{
		var reason = document.getElementById("reason").value  ;
		var evd = document.getElementById("evd").value  ;
		var note = document.getElementById('note').value
		if (reason == '' ||  evd == '' ) {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		document.getElementById("submitEdit").innerHTML = "الرجاء الأنتظار..";
		var params = "applyTelegramEdit&id=" + encodeURIComponent(id) + "&type=" +encodeURIComponent(type)+ "&reason=" +encodeURIComponent(reason)+ "&evd=" +encodeURIComponent(evd)+ "&note=" +encodeURIComponent(note);
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
				var error2 = str.includes("error2");
				if (tr) {swal('! تم ', 'تم تبنيد العضو بنجاح ! ', 'success');}
				if (error) {swal('! خطأ ', 'حدث خطأ ما	', 'error');}
				document.getElementById("submitBanned").innerHTML = "إنشاء الباند";

			} 
		  }
		xmlhttp.open("POST","config/punsh-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 

</script>
<?php require_once('includes/footer.php'); ?>


