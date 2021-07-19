<?php
die();
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');

$showPage = true ;
$showInvitePage = false ;

if (isset($_GET["InviteKey"])) {
		$key = $con->real_escape_string(stripslashes(htmlspecialchars($_GET["InviteKey"]))) ;
		$showPage = false ;
		$sql = "SELECT * FROM invites WHERE invitekey='$key'";
		$mysqli = new mysqli('localhost', 'root', 'qvaGN6vy9EaZMw5l', 'Rankqz');
		$res = $mysqli->query($sql);
if($res->num_rows > 0){
		$data = $res->fetch_assoc();
		$InviteBy = $data["nickname"];
		$showInvitePage = true ;
		$skipQuit = true ;
	} else { echo('<script>swal({title: "خطا",text: "رمز الاحاله غير صحيح",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); }
}	
?>


<?php
?>
<?php	
if (isset($_POST["createNewKey"])) {
		$sql = "SELECT * FROM invites WHERE cldbid='$dbid'";
		$res = $con->query($sql);
		if($res->num_rows <= 0){
		$datemicro = new DateTime();
		$lt = $datemicro->getTimestamp();
		$RandomKey = md5("4DXZ23UR3832F.LKFF" . $dbid . "DO24OQQZZZ.QZ" . $lt);
		insertKey ($con,$RandomKey,$dbid) ;
	} else { $showPage == true ; }
} 

function insertKey ($con,$string,$cld) {
	$string = $con->real_escape_string(stripslashes(htmlspecialchars($string)));
	$cld = $con->real_escape_string(stripslashes(htmlspecialchars($cld)));
$sql = "SELECT * FROM invites WHERE invitekey='$string' OR cldbid='$cld' ";
$res = $con->query($sql);
if($res->num_rows <= 0){
		$nickname = $con->real_escape_string(stripslashes(htmlspecialchars($_SESSION ['nkiv']))) ;
		$sql = "INSERT INTO invites (id, invitekey, nickname, cldbid, date) VALUES (NULL, '$string', '$nickname', '$cld', 'N')";
			if($con->query($sql) === true){
	//	die ('true') ;
		
		}
	}	
}
	
	
 //echo("Error description: " . mysqli_error($con));

 
if ( $showPage == true ) { 
 
 echo '        <div class="page-wrapper">
            <div class="container-fluid">
			</br>
			<center>
			</center>	
			
			<div class="row">';
$sql = "SELECT * FROM invites WHERE cldbid='$dbid'";
$res = $con->query($sql);
$data = $res->fetch_assoc();
$invitekey = $data["invitekey"];
$dateKey = $data["date"];
if($res->num_rows > 0){
echo '<div class="col-md-4">
	</div>

			<div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-success ">
                              <center> <h4 class="m-b-0 text-white">الاحاله</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
									<center><span class="btn btn-success">الاحاله تحسب لك في حال كان اول تفعيل للشخص</span></center>
										</p>
										<center>
										<a class="col-sm-8" for="block-form-username4" href="https://panel.q-z.us/ReferralOpen?InviteKey='.$invitekey.'">https://panel.q-z.us/ReferralOpen?InviteKey='.$invitekey.'</a>
										</center>
										</br>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="key" name="key" style="text-align:center;" class="form-control" name="https://panel.q-z.us/ReferralOpen?InviteKey='.$invitekey.'" value="'.$invitekey.'" aria-label="" aria-describedby="basic-addon1">
                                                    <div class="input-group-append">
                                            <input type="submit"  onclick="copyToClip()" value="نسخ الرمز" id="buttonClass" class="btn btn-success ">
										</div>													
                                    </div>
                                </div>
							</div>
						</div>
			</div>
			<div class="col-md-4">
	</div>

					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title">الاعضاء الذي تم إحالتهم بواسطتك</h3> </center>

							<div class="table-responsive">
                                    <table class="table m-t-30 table-hover table info-table contact-list footable-loaded footable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الأسم</th>
                                                <th>الأيدي الخاص به</th>
                                                <th>تاريخ التسجيل</th>
                                            </tr>
                                        </thead>
                                    <tbody>';
									 $sql = "SELECT * FROM invites_info WHERE cldbid='$dbid' AND status='active'";
									if($result = mysqli_query($con, $sql)){
										if(mysqli_num_rows($result) > 0){
											while($row = mysqli_fetch_array($result)){
											echo "<tr>";
											 echo "<td>" . $row['id'] . "</td>";
											 echo "<td>" . $row['nickname'] . "</td>";
											 echo "<td>" . $row['uid'] . "</td>";
											 echo "<td>" . $row['date'] . "</td>";
											 echo "</tr>";

											}
										} else {
											echo "<tr>";
											echo "<td>لايوجد</td>";
											echo "<td>لايوجد</td>";
											echo "<td>لايوجد</td>";
											echo "<td>لايوجد</td>";
											echo "</tr>";
										}	
									}
									 echo '
									  </tbody>
                                    </table>
                                </div>
                        </div>
					 </div>
                    </div>

				</div>

';


} else {
//echo('<script>
  //         swal({title: "خطا",text: "لأ يوجد لديك تذاكر دعم فني",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); 
echo '
<br>
<br>
<br>
<br>
<br>
<div class="col-md-4">
	</div>
			<div class="col-md-4">
                        <div class="card border-info">
                            <div class="card-header bg-success ">
                              <center> <h4 class="m-b-0 text-white">إنشاء رمز احاله خاص بك</h4> </center>
								</div>
							<div class="card-body">
										<div class="col-lg-12">
										<center><label class="col-sm-8" for="block-form-username4">يمكنك دعوة اصدقائك للتيم سبيك وربح كوينز عندما يتم تفعيل شخص منهم من الدعوه الخاصة بك </label></center>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="key" name="key" style="text-align:center;" class="form-control" value="لايوجد لديك رمز إحالة" aria-label="" aria-describedby="basic-addon1">
                                                    <div class="input-group-append">
                                          <form method="post">
										  <input type="submit" name="createNewKey" value="إنشاء رمز احاله جديد" id="buttonClass" class="btn btn-success "></center>
										</form>
										</div>													
                                    </div>
                                </div>
							</div>
						</div>
			</div>
		<div class="col-md-4">
	</div>
';
	}	
} 

		
?>
			<script>
				function copyToClip() {
				  var copyText = document.getElementById("key") ;
				  copyText.select();
				  document.execCommand("copy");
				  swal({title: "تمت العملية",text: " تم نسخ الرابط",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})
				}
				</script>
				
			</div>			
		</div>			
	</div>			
</div>

<?php require_once('includes/footer.php'); ?>























