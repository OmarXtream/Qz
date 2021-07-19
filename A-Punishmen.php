<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
require 'config/sqlconfig.php';
$arrclients = $ts3_VirtualServer->clientList(array("client_type" => 0));
if(isset($_SESSION['logged']) == TRUE) {
 	//unset($_SESSION['logged']);
	$Access = true ;
} 

?>
<?php
 Punishmen($ggids) ;
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>






<div class="page-wrapper">
<div class="container-fluid">




<?php if ( $Access == true ) { ?>

	
<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// <                               السجن                               >

$cldbid = $client_info["client_database_id"];
$cgrp = explode(',', $client_info["client_servergroups"]);
$canjail = array(10,2171,1672,1555,1983,1984,1985,1986,1987,1988,1989);
$igjail = array(10,2171,1672,1555,1983,1984,1985,1986,1987);
if(count(array_intersect($cgrp, $canjail)) >= 0 || in_array(10, $cgrp)|| in_array(2, $cgrp)){
	
}else{
	die('<center><meta http-equiv="refresh" content="3;url=index.php"><div class="alert alert-danger alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center><strong>لأ يمكنك دخول هذه الصفحه</center></strong>
                                </div>');
}


// <                               السجن                               >

?>	



<?php
$xz = array(861,77,1411,76,78,79,80,91,2154,169,1755,131,2340); // رتب المعاقبة
$xx = explode(',', $client_info["client_servergroups"]);
$removez = array(2,2171,10,1672,1555,1983,1984,1985,1986,1987,1048); // يقدر يحذف
$unpunish = array(10,2171,1672,1555,1983,1984,1985,1986,1987,1988); // ما يتعاقب

?>				
				
		</br>
		<center>
		<div class="row">

			
			<div class="col-md-5">

			<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>الباندات</b></h4>
					</div>
                    <div class="card-body">
					
					<h5>يمكنك معاقبة الأعضاء لفترة من الزمن</h5>
					<h5>جميع العقوبات مراقبه من قبل الأداره العليا الرجاء وضع السبب</h5>
					<hr>
					<select class="js-select2 form-control select2-hidden-accessible" id="groupB" name="groupB" style="width: 100%; height:50px;">
					<?php
					$sql = "SELECT * FROM ban_reassosn";
					$blackLISTAccess = array(1983,1555,1048,1672,2171,10);
					
					$result = $con->query($sql);
					while($row = $result->fetch_assoc()) {
						if ( $row['id'] == 4 ) {
							if(count(array_intersect($blackLISTAccess, $ggids)) > 0){
								echo " '<option value = '" .$row['id']. "'>".$row['name']."</option>' ";
							}
						} else {
								echo " '<option value = '" .$row['id']. "'>".$row['name']."</option>' ";
						}
					}
					?>
					</select>
					<br>
					<br>
					<input type="text" name="rclientB" id="rclientB" class="form-control" placeholder="ادخل ID العضو مثل rLsT0G5kuzvnsftf0jS39LVZUTY= "><br>
					<br>
					<input type="text" name="evd" id="evd" class="form-control" placeholder="الدليل"><br>
					<br>
					<input type="text" name="reason" id="telegramAcc" class="form-control" placeholder="حسابك تلقرام بدون @"><br>
					<br>
					<input type="text" name="note" id="note" class="form-control" placeholder="الملاحظات ، اختياري"><br>

					
					
						
                    </div>
					<center><div class="col-md-4">
                      <button name="submitBanned" id="submitBanned" type="submit" onclick="return CreateBan();" class="btn btn-rounded btn-block btn-outline-danger"> إنشاء الباند </button>
                    </div></center>
					<br>

			              		
                </div>
            </div>
			

				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>العقوبات</b></h4>
					</div>
                    <div class="card-body">
					
					<h5>يمكنك معاقبة الأعضاء لفترة من الزمن</h5>
					<h5>جميع العقوبات مراقبه من قبل الأداره العليا الرجاء وضع السبب</h5>
					<hr>
					<label class="col-md-4 control-label" for="example-select2">نوع المدة</label>
					<br>
					<div class="form-group row">
						<div class="col-4">
						<input type="number" class="form-control" name="mins" id="mins" placeholder="دقائق">
						</div>
						<div class="col-4">
						<input type="number" class="form-control" name="hours" id="hours" placeholder="ساعات">
						</div>
						<div class="col-4">
						<input type="number" class="form-control" name="days" id="days" placeholder="أيام">
						</div>
					</div>
					<br>
					<select class="js-select2 form-control select2-hidden-accessible" id="group" name="group" style="width: 100%; height:50px;">
						<option>اختر العقوبة .....</option>
                <?php
					foreach($xz as $xf){
						$xm = $ts3_VirtualServer->serverGroupGetById($xf)["name"];
						echo "<option value='$xf'>$xm</option>";
					}
				?>
						</select>
					<br>
					<br>
					<input type="text" name="rclient" id="rclient" class="form-control" placeholder="ادخل ID العضو مثل rLsT0G5kuzvnsftf0jS39LVZUTY= "><br>
					<label id="punshResult"></label>
					<br>
					<input type="text" name="reason" id="telegramAccPu" class="form-control" placeholder="حسابك تلقرام بدون @"><br>
					<br>
					<input type="text" name="reason" id="reason" class="form-control" placeholder="السبب"><br>
					<br>
					<input type="text" name="evdPu" id="evdPu" class="form-control" placeholder="الدليل"><br>
					<br>
					
					
					
						
                    </div>
					<center><div class="col-md-4">
                      <button name="submit" id="submitCreatePunsh" onclick="return PunshAdd();" type="submit" class="btn btn-rounded btn-block btn-outline-danger"> أنشاء العقوبة </button>
                    </div></center>
					<br>

					
                </div>
			
			
            </div>
		</center>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> سجل الباندات </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المنشئ</th>
                                                <th>السبب</th>
                                                <th>العضو</th>
                                                <th>المدة</th>
                                                <th>حالة الباند</th>
                                                <th>حذف</th>
                                            </tr>
                                        </thead>
                        <tbody>
						<?php
					
					function isClientBanned ($clientUID,$ts3_VirtualServer) {
							$banlist = $ts3_VirtualServer -> banlist();
							 foreach ($banlist as $data) {
								$uid = $data["uid"];
								if ( $uid == $clientUID ) {
									return $data["banid"] ;
								}
							}	
						}


										$sql = "SELECT * FROM banned ORDER BY id DESC LIMIT 15;";
										$res = $con->query($sql);
										$banlist = $ts3_VirtualServer -> banlist();
										while($data = $res->fetch_assoc()){
											$clc = $data["cldbid"];
											try{
											$tsname = $ts3_VirtualServer->clientGetNameByUid($clc);
											$name = $tsname['name'] ;
											}catch(TeamSpeak3_Exception $e){ $name = "Wrong UID" ;}
											$own = $data["punisher"];
											$id = $data["id"];
											$time = $data["time"];
											$reason = $data["reason"];
											$banID = $data["banID"];
											$jailer = $ts3_VirtualServer->clientInfoDb($own)["client_nickname"];	
											echo "<tr> <td>$id</td> <td>$jailer</td> <td><strong>$reason</strong></td> <td>$name</td> <td>$time</td> ";
											$remove = array(2,10,2171,1672,1555,1983,1048,1984,1985,1986,1987);
											$iSBanned = isClientBanned($clc,$ts3_VirtualServer) ;
											if ( $iSBanned ==  $banID ) {
												echo "<td><span class='badge badge-success'>مفعل</span></td>";
											if(!count(array_intersect($remove, $ggids)) > 0){
												echo "<td><button type='button' class='btn btn-danger disabled delete btn-xs'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
											}else{
												echo "<td><form method='post'><button type='submit' onclick='return BannedRemove(".$iSBanned.")' class='btn btn-warning btn-danger'> <img src='https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png'><i class='glyphicon glyphicon-remove'></i></button></form></td> </tr>";
											}	
							} else {
								echo "<td><span class='badge badge-danger'>منتهي</span></td>";
								echo "<td><button type='button' class='btn btn-danger disabled delete btn-xs'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
							}
						}
						
						
						
						?>
                        </tbody>										
                                    </table>
                                </div>
                        </div>
					 </div>
                    </div>
					
					
					
		
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> سجل العقوبات </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>العقوبة</th>
                                                <th>المنشئ</th>
                                                <th>السبب</th>
                                                <th>العضو</th>
                                                <th>وقت العقوبة	</th>
                                                <th>إنهاء العقوبة</th>
                                            </tr>
                                        </thead>
						<?php
						
							$sql = "SELECT COUNT(id) FROM bad";
							$res = $con->query($sql);
							$rz = $res->fetch_row();
							$numrow = $rz[0];
							$perPage = 15;
							$totalp = ceil($numrow / $perPage);
							
							if(isset($_GET["page"]) && is_numeric($_GET["page"])){
								$page = (int)$_GET["page"];
							}else{
								$page = 1;
							}
							if($page > $totalp){
								$page = $totalp; 
							}else if($page < 1){
								$page = 1;
							}
							$offset = ($page - 1) * $perPage;
							$sql = "SELECT * FROM bad WHERE hidden='0' ORDER BY id DESC LIMIT $offset,$perPage";												
							$res = $con->query($sql);

							while($data = $res->fetch_assoc()){
								
								$idz = $data["id"];
								$owner = $data["punisher"];		
								$user = $data["cldbid"];
								
								$reason = $data["reason"];
								
								$timezx = $data["stime"];
								$etime = $data["etime"];
								$status = $data["status"];
								$sgid = $data["sgid"];
								
								try{
									$ownz = $ts3_VirtualServer->clientInfoDb($owner)["client_nickname"];
									$nameg = $ts3_VirtualServer->serverGroupGetById($sgid);
									$userz = $ts3_VirtualServer->clientInfoDb($user)["client_nickname"];
								}catch(TeamSpeak3_Exception $e){}

								$timezz = explode(':', $timezx);
								if($status == "active"){
									
									$etimez = explode(':', $etime);
									$rend = mktime($etimez[3],$etimez[4],$etimez[5],$etimez[1],$etimez[2],$etimez[0]);
									$rendxx = mktime($timezz[3],$timezz[4],$timezz[5],$timezz[1],$timezz[2],$timezz[0]);
									
									$rzstart = new DateTime('@'.$rendxx);
									$rendzn = new DateTime('@'.$rend);
									$diffz = $rzstart->diff($rendzn);
									$codtime = $diffz->format('%a أيام %h ساعات %i دقائق %S ثوانى');
									
									 $etime = explode(':', $etime);
									 $rendv = mktime($etime[3],$etime[4],$etime[5],$etime[1],$etime[2],$etime[0]);
				
									$rstartz = new DateTime();
									$rendz = new DateTime('@'.$rendv);
									$diffx = $rstartz->diff($rendz);
									
									$remain = $codtime;
								}else{
									$remain = "منتهية";
								}
								
								echo "<tr class=''> 
								<td>$nameg</td> 
								<td>$ownz</td> 
								<td>$reason</td>  
								<td>$userz</td> 
								<td>$remain</td>";

											
											if(!count(array_intersect($removez, $ggids)) > 0  || $remain === "منتهية"){
												echo "<td><button type='submit' class='btn btn-success btn-danger disabled'><img src='https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png'><i class='glyphicon glyphicon-remove'></i></button></td> </tr>";
											}else{
												echo "<td><button type='submit' id='submitRemovePunshPunsh' onclick='return PunshRemove(".$idz.")' class='btn btn-success btn-success'><img src='https://cdn1.iconfinder.com/data/icons/media-player-long-shadow/50/Cross-16.png'><i class='glyphicon glyphicon-remove'></i></button></td> </tr>";
											}
							}	
						?>										
							<center>
						<ul class="pagination">
							<?php
								for($i = 1; $i <= $totalp; $i++){
									if($page === $i){
										echo "<li class='paginate_button page-item active'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}else{
										echo "<li class='paginate_button page-item'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}
								}
							?>
					  </ul>
					  		</center>										
                                    </table>
                                </div>
                        </div>
					 </div>
                    </div>
		<!--  <center>
			<div class="col-md-7">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>الباند</b></h4>
					</div>
                    <div class="card-body">
					
					<h5>يمكنك تبنيد الأعضاء لفتره من الزمن</h5>
					<h5>جميع الباندات مراقبه من قبل الأدارة العليا الرجاء وضع السبب</h5>
					<hr>
					<label class="col-md-4 control-label" for="example-select2">نوع المدة</label>
					<br>
					<select class="js-select2 form-control select2-hidden-accessible" id="type" name="type" style="width: 100%; height:40px;">
					  <option value="D">الأيــام</option>
					  <option value="M">الدقــائق</option>
					  <option value="H">الســاعات</option>
					  <option value="P">مؤبد</option>
					</select>
					<br>
					<br>
					<input class="form-control " placeholder="رقم العضو او ايدي العضو " type="text" name="uiz" id="00"><br>
					<br>
					<input class="form-control" placeholder="السبب" type="text" name="reason" id="reason"><br>
					<br>
					<input class="js-datepicker form-control" type="number" id="expiredate" name="time" placeholder="ضع المدة هنا"><br>
					
					
					
						
                    </div>
					<center><div class="col-md-4">
                      <button type="button" class="btn btn-rounded btn-block btn-outline-danger"> حظر العضو </button>
                    </div></center>
					<br>
					
					
                </div>
            </div>
		</center>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> السجل </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>سبب الباند</th>
                                                <th>المتبند</th>
                                                <th>الوقت المتبقي</th>
                                                <th>المده الأساسيه للباند</th>
                                                <th>حذف</th>
                                            </tr>
                                        </thead>
                                    </table>										
                                </div>
                        </div>
					 </div>
            </div> -->
		
<?php } else { ?>
		</br>
		<div class="row">
			<div class="col-md-3">
			</div>
			
				<div class="col-md-6"> 
					   <div class="card border-info">
					   <div class="card-header bg-success">
					   <center> <h4 class="m-b-0 text-white">لوحه تسجيل الدخول</h4> </center>
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
					   <button id="submitCreate"  name="submitCreate"  onclick="return LgI();" class="btn btn-outline-success">
                       <i class="fa fa-plus"></i> تسجيل دخول
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
		var params = "lg&t-username=" + encodeURIComponent(username) + "&t-password=" +encodeURIComponent(password)+ "&t-db=" +encodeURIComponent(dbid);
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
				if (tr) { swal({title: "تم",text: " تم تسجيل دخولك ، يرجى الضغط على حسنا",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-Punishmen");}else {window.location.replace("https://panel.q-z.us/A-Punishmen");}})}	
				if (error) {swal('! خطأ ', 'المعلومات الذي أدخلتها غير صحيحة ', 'error');}
				if (error) {swal('! خطأ ', 'المعلومات ليست خاصة بك ! ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/lg-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 
function CreateBan()
{
		var clientUid = document.getElementById('rclientB').value;
		var accT = document.getElementById('telegramAcc').value
		var evd = document.getElementById('evd').value
		var note = document.getElementById('note').value
		var e = document.getElementById("groupB").value;
		alert(e);
		if (clientUid == '' ||  accT == '' ||  evd == '' ) {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		if ( note == '' ) {
			note = "none"
		}
		document.getElementById("submitBanned").innerHTML = "الرجاء الأنتظار..";
		var params = "submitBanned&rclient=" + encodeURIComponent(clientUid) + "&evd=" +encodeURIComponent(evd)+ "&tlacc=" +encodeURIComponent(accT)+ "&BanID=" +encodeURIComponent(e)+ "&note=" +encodeURIComponent(note);
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

function PunshAdd()
{
		var group = document.getElementById('group').value;
		var client = document.getElementById('rclient').value;
		var mins = document.getElementById('mins').value;
		var hours = document.getElementById('hours').value;
		var days = document.getElementById('days').value;
		var reason = document.getElementById('reason').value;
		var evd = document.getElementById('evdPu').value;
		var accT = document.getElementById('telegramAccPu').value
		var t = document.getElementById('group');
		var cuidN = t.options[t.selectedIndex].text;
		if (group == ''|| client == '' ) {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		if (mins == '' && hours == '' && days == '' ) {
		swal('! خطأ ', 'املأ الفراغات المطلوبة ', 'error'); return;
		} 
		
		document.getElementById("submitCreatePunsh").innerHTML = "الرجاء الأنتظار..";
		var params = "submitPunsh&group=" + encodeURIComponent(group) + "&rclient=" +encodeURIComponent(client)+ "&mins=" +encodeURIComponent(mins)+ "&reason=" +encodeURIComponent(reason)+ "&days=" +encodeURIComponent(days)+ "&hours=" +encodeURIComponent(hours)+ "&tlacc=" +encodeURIComponent(accT)+ "&PType=" +encodeURIComponent(cuidN)+ "&evd=" +encodeURIComponent(evd);
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
				if (tr) {swal('! تم ', 'تم معاقبه العضو بنجاح ', 'success');}
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}
				document.getElementById("submitCreatePunsh").innerHTML = "أنشاء العقوبة ";

			} 
		  }
		xmlhttp.open("POST","config/punsh-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 
function PunshRemove(Punsh)
{

		if (Punsh == null ) {
		swal('! خطأ ', 'حدث خطأ ما ', 'error'); return;
		} 
		var params = "removePunsh=" + encodeURIComponent(Punsh) ;
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
				if (tr) {swal('! تم ', 'تم إزالة العقوبة بنجاح ', 'success');}
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/punsh-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

}
 function BannedRemove(Punsh)
{

		if (Punsh == null ) {
		swal('! خطأ ', 'حدث خطأ ما ', 'error'); return;
		} 
		var params = "removeBanned=" + encodeURIComponent(Punsh) ;
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
				if (tr) {swal('! تم ', 'تم إزالة الباند ', 'success');}
				if (error) {swal('! خطأ ', 'حدث خطأ ما ', 'error');}

			} 
		  }
		xmlhttp.open("POST","config/punsh-ajax",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
		xmlhttp.send(params);
    return false;

} 


///
var textBox = document.getElementById('rclient'),
resultContainer = document.getElementById('punshResult')
var ajax = null;

textBox.onkeyup = function() {
		var val = this.value;
		val = val.replace(/^\s|\s+$/, "");
		if (val !== "") {	
		 if (val.length > 27) {
			searchForData(val);
		 }
		} else {
						resultContainer.innerHTML = "" ; 
	}
}
		
function searchForData(value, isLoadMoreMode) {
	if (ajax && typeof ajax.abort === 'function') {
				ajax.abort(); 
			}

			if (isLoadMoreMode !== true) {
						resultContainer.innerHTML = "" ; 
			}

			ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200) {
					try {
						var json = this.responseText;
					} catch (e) {
						return;
					}

					if (json.length === 0) {
						if (isLoadMoreMode) {
						resultContainer.innerHTML = "User Not Found" ; 
						} else {
						//	noUsers();
						}
					} else {
						//showUsers(json);
						resultContainer.innerHTML = json ; 

					}
				}
			}
			ajax.open('GET', 'config/punsh-ajax?client=' + value , true);
			ajax.send();
}

</script>
<?php require_once('includes/footer.php'); ?>





















