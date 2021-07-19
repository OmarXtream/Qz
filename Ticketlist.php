<?php
die();
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
require 'config/sqlconfig.php';

 echo '        <div class="page-wrapper">
            <div class="container-fluid">
			</br>
			<center>
			<div class="col-lg-4 col-md-4">
               <a href="Ticketlist.php" class="btn btn-rounded btn-block btn-outline-info">ارجع الي قائمه التذاكر</a>
            </div>	
			</center>	
			<br>
			<br>
			
			<div class="row">';
			
if(isset($_GET["view"]) && is_numeric($_GET["view"]) && !empty($_GET["view"])){
				$viewid = $_GET["view"];
				$sql = "SELECT * FROM apply WHERE id='$viewid' LIMIT 1";
				$res = $con->query($sql);
				if(!$res->num_rows > 0){ die('<script>
           swal({title: "خطا",text: "حدث خطاء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/Ticketlist");}else {window.location.replace("https://panel.q-z.us/Ticketlist");}})</script>');  }
				$data = $res->fetch_assoc();
				$id = $data["id"];
				$fullname = $data["fullname"];
				$country = $data["country"];
				$group = $data["group"];
				$telegram = $data["telegram"];
				$why = $data["why"];
				$whatcanu = $data["whatcanu"];
				$special = $data["special"];
				$denyreason = $data["denyreason"];
				$age = $data["age"];
				$network = $data["network"];
				$status = $data["status"];
				$cldbid = $data["cldbid"];
				//$timez = $data["time"];
				$admin = $data["admin"];
		if($status == 1 && $admin !== 0){
			try{
				 $adminz = $ts3_VirtualServer->clientInfoDb($admin)["client_nickname"];
			}catch(Exception $e){
				$adminz = "لا يوجد اسم";
			}
			if(!isset($denyreason) || empty($denyreason)){
			   $denyreason = "بدون سبب";
		   }
		  
		   echo "
			<div class='col-md-6'>
                        <div class='card border-info'>
                            <div class='card-header bg-danger'>
                               <center> <h4 class='m-b-0 text-white'>تقديم $fullname</h4> </center>
								</div>
							<div class='card-body'>
										<div class='col-lg-12'>			   
		  		  <hr>
              <ul><p class='font-w600 text-success'>القابل <br>
              </p><p class='font-w300 text-success'>$adminz</p></ul>	  
		  		  <hr>					  
              <ul><p class='font-w600 text-success'>سبب القبول <br>
              </p><p class='font-w300 text-success'>$denyreason</p></ul>	  
		  		  <hr>			  
              <ul><p class='font-w600'>الاسم الكامل<br>
              </p><p class='font-w300'>$fullname</p></ul>
		  <hr>
              <ul><p class='font-w600'>اي طريقه يمكن التواصل معك بها مثل تلقرام او رقمك<br>
              </p><p class='font-w300'>$telegram</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>البلد<br>
              </p><p class='font-w300'>$country</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>السن<br>
              </p><p class='font-w300'>$age</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>نوع المشكله او الاقتراح او الشكوه او الطلب<br>
              </p><p class='font-w300'>$group</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>معلومات مختصره عن الطلب<br>
              </p><p class='font-w300'>$why</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل تعرض للمشكله من قبل ؟<br>
              </p><p class='font-w300'>$whatcanu</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>المشكله بالكامل <br>
              </p><p class='font-w300'><br>$network</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل كان بحوذته دليل ؟<br>
              </p><p class='font-w300'>$special</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>رقم ايدي التيمسبيك<br>
              </p><p class='font-w300'>$cldbid</p></ul>
			  		  <hr>
              <br>
												<img src='image/AC.png' style='width: 150px;'>
                                        </div>

							</div>
						</div>
			</div>
			</center>
		   ";
		   
	   }else if($status == 2 && $admin !== 0){
		   try{
				 $adminz = $ts3_VirtualServer->clientInfoDb($admin)["client_nickname"];
			}catch(Exception $e){
				$adminz = "لا يوجد اسم";
			}
		  
		   if(!isset($denyreason) || empty($denyreason)){
			   $denyreason = "بدون سبب";
		   }
		   
		   echo "
			<div class='col-md-6'>
                        <div class='card border-info'>
                            <div class='card-header bg-danger'>
                               <center> <h4 class='m-b-0 text-white'>تقديم $fullname</h4> </center>
								</div>
							<div class='card-body'>
										<div class='col-lg-12'>	
		  		  <hr>
		  <ul><p class='font-w600 text-danger'>الرافض<br>
              </p><p class='font-w300'>$adminz</p></ul>	  
		  		  <hr>
		  <ul><p class='font-w600 text-danger'>سبب الرفض<br>
              </p><p class='font-w300'>$denyreason</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>الاسم الكامل<br>
              </p><p class='font-w300'>$fullname</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>اي طريقه يمكن التواصل معك بها مثل تلقرام او رقمك<br>
              </p><p class='font-w300'>$telegram</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>البلد<br>
              </p><p class='font-w300'>$country</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>السن<br>
              </p><p class='font-w300'>$age</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>نوع المشكله او الاقتراح او الشكوه او الطلب<br>
              </p><p class='font-w300'>$group</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>معلومات مختصره عن الطلب<br>
              </p><p class='font-w300'>$why</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل تعرض للمشكله من قبل ؟<br>
              </p><p class='font-w300'>$whatcanu</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>المشكله بالكامل <br>
              </p><p class='font-w300'><br>$network</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل كان بحوذته دليل ؟<br>
              </p><p class='font-w300'>$special</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>رقم ايدي التيمسبيك<br>
              </p><p class='font-w300'>$cldbid</p></ul>
			  		  <hr>
              <br>
												<img src='image/de.png' style='width: 150px;'>
                                        </div>

							</div>
						</div>
			</div>
			</center>
		   ";
		   
	   }else{
		   die('<center><meta http-equiv="refresh" content="2;url=Ticketkist.php"> <div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
						    <a class="alert-link" href="javascript:void(0)">حدث خطأ</a>.<br><strong>
						</div></center> ');
	   }
}	else{
	 $sql = "SELECT * FROM apply WHERE cldbid='$dbid'";
	 $res = $con->query($sql);
	 if(!$res->num_rows > 0){
echo('<script>
           swal({title: "خطا",text: "لأ يوجد لديك تذاكر دعم فني",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); 
	}

echo '
					<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title">قائمه التذاكر المفتوحه لديك</h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table info-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>اسمك بالتذكره	</th>
                                                <th>الحاله</th>
                                                <th>مشاهده التذكره</th>
                                            </tr>
                                        </thead>
                                    <tbody>';
                                      
										 while($data = $res->fetch_assoc()){
													$id = $data["id"];
													$fullname = $data["fullname"];
													//$country = $data["country"];
													//$group = $data["group"];
													//$telegram = $data["telegram"];
													//$why = $data["why"];
													//$whatcanu = $data["whatcanu"];
													//$special = $data["special"];
													$denyreason = $data["denyreason"];
													//$age = $data["age"];
													//$network = $data["network"];
													$status = $data["status"];
													//$cldbid = $data["cldbid"];
													//$timez = $data["time"];
													$admin = $data["admin"];
													
													echo "<tr>
														<td  >$fullname</td>
														";
														if($status == 0){
															echo "<td  ><span class='badge badge-warning'>قيد المراجعة</span></td>";
															echo "<td  ><button type='button' class='btn disabled btn-rounded btn-block btn-outline-warning'>قيد المراجعة</button></td>";
														}else if($status == 1){
															echo "<td  ><span class='badge badge-success'>تمت الموافقه </span></td>";
															echo "<td  ><a href='?view=$id' class='btn btn-rounded btn-block btn-outline-success'>مشاهدة الطلب</a></td>";
														}else if($status == 2){
															echo "<td  ><span class='badge badge-danger'>مرفوض</span></td>";
															echo "<td  ><a href='?view=$id' class='btn btn-rounded btn-block btn-outline-danger'>مشاهدة الطلب</a></td>";
														}
														
													echo "</tr>";
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

}
		
?>
						</div>				</div>				</div>				</div>
<?php require_once('includes/footer.php'); ?>