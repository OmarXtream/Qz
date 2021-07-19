<?php 

 require 'config/phphead.php'; 
 require 'config/sqlconfig.php'; 
 require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');

		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}

 if(isset($_POST["accept"])){
	 if(is_array($_POST["accept"])){
		 $acc = key($_POST["accept"]);
		 if(is_numeric($acc)){
			 
			  if(isset($_POST["denyreason"]) && !empty($_POST["denyreason"])){
				 $denyreason = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["denyreason"]))));
				  $sql = "UPDATE apply SET denyreason='$denyreason',status='1',admin='$dbid' WHERE id='$acc'";
			 }else{
				 $sql = "UPDATE apply SET denyreason='بدون سبب',status='1',admin='$dbid' WHERE id='$acc'";
			 }

			 if(!$res = $con->query($sql) === true){
				 die("حدث خطأ");
			 }else{
				$viewid = $_GET["view"];
				$sql = "SELECT * FROM apply WHERE id='$viewid' LIMIT 1";
				$res = $con->query($sql);
				if(!$res->num_rows > 0){ die("اعادة توجية"); }
				$data = $res->fetch_assoc();
				
				$id = $data["id"];
				$cldbid = intval($data["cldbid"]);
		 $infox = $ts3_VirtualServer->clientInfoDb($dbidz);
		 $uidx = strval($infox["client_unique_identifier"]);
		 $clientname = strval($infox["client_nickname"]);
		 $dbx = strval($client_info["client_unique_identifier"]);
		 $msgggg = '[B][COLOR=red][URL=client://82/'.$dbx.']'.htmlspecialchars($nickname).'[/URL][/COLOR]  تم الرد على طلبك الرجاء مراجعة قائمة التذاكر لديك: [/B]';
		 try{
			 $ts3_VirtualServer->clientGetByUid($uidx)->message($msgggg);
		 }catch(Exception $e){
			 
		 }

				 // اعادة توجية
				 header("Location: https://panel.q-z.us/A-Ticket");
			 }
			 
		 }else{
			 //die
			  die("حدث خطأ");
		 }
	 }else{
		 //die
		  die("حدث خطأ");
	 }
 }else if(isset($_POST["reject"])){
	 if(is_array($_POST["reject"])){
		 $rej = key($_POST["reject"]);
		 if(is_numeric($rej)){
			 if(isset($_POST["denyreason"]) && !empty($_POST["denyreason"])){
				 $denyreason = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["denyreason"]))));
				  $sql = "UPDATE apply SET denyreason='$denyreason',status='2',admin='$dbid' WHERE id='$rej'";
			 }else{
				 $sql = "UPDATE apply SET denyreason='بدون سبب',status='2',admin='$dbid' WHERE id='$rej'";
			 }

			 if(!$res = $con->query($sql) === true){
				 die("حدث خطأ");
			 }else{
				$viewid = $_GET["view"];
				$sql = "SELECT * FROM apply WHERE id='$viewid' LIMIT 1";
				$res = $con->query($sql);
				if(!$res->num_rows > 0){ die("اعادة توجية"); }
				$data = $res->fetch_assoc();
				
				$id = $data["id"];
				$cldbid = intval($data["cldbid"]);

		 $infox = $ts3_VirtualServer->clientInfoDb($cldbid);
		 $uidx = strval($infox["client_unique_identifier"]);
		 $clientname = strval($infox["client_nickname"]);
		 $dbx = strval($client_info["client_unique_identifier"]);
		 $msgggg2 = '[B][COLOR=red][URL=client://82/'.$dbx.']'.htmlspecialchars($nickname).'[/URL][/COLOR]  تم الرد على طلبك الرجاء مراجعة قائمة التذاكر لديك: [/B]';
		 try{
			 $ts3_VirtualServer->clientGetByUid($uidx)->message($msgggg2);
		 }catch(Exception $e){
			 
		 }

				 // اعادة توجية
				 header("Location: https://panel.q-z.us/A-Ticket");
			 }
			 
		 }else{
			 //die
			  die("حدث خطأ");
		 }
	 }else{
		 //die
		  die("حدث خطأ");
	 }
 } 
 if(isset($_POST["sendticket"])){
	 if(is_array($_POST["sendticket"])){
		 $dbidz = intval(key($_POST["sendticket"]));
		 $infox = $ts3_VirtualServer->clientInfoDb($dbidz);
		 $uidx = strval($infox["client_unique_identifier"]);
		 $clientname = strval($infox["client_nickname"]);
		 $dbx = strval($client_info["client_unique_identifier"]);
		 $ID = '[B][COLOR=red][URL=client://82/'.$uidx.']'.htmlspecialchars($clientname).'[/URL][/COLOR][/B] ايدي الشخص الي مقدم تذكره سيدي ';
		 $ID2 = '[B][COLOR=red][URL=client://82/'.$dbx.']'.htmlspecialchars($nickname).'[/URL][/COLOR][/B]  شاهد الادمن طلبك وطلب ارسال الايديي برجاء مشاهده قائمة التذاكر لديك';
		 $client_info->message("$ID");
		 try{
			 $ts3_VirtualServer->clientGetByUid($uidx)->message($ID2);
		 }catch(Exception $e){
			 
		 }
		 // print_r($infox);
		 // die;
		 // $uidx = $infox[""]
	echo('<script>
           swal({title: "تم",text: "ارسال الايدتني بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		 
	 }

 }
if(isset($_POST["del"])){
			if(is_array($_POST["del"])){
				$rdel = intval(key($_POST["del"]));
				$sql = "SELECT blocked FROM apply WHERE id='$rdel' LIMIT 1";
				$sql = "DELETE FROM apply WHERE id='$rdel' LIMIT 1";
				$con->query($sql);
			}echo('<script>
           swal({title: "تم",text: "حذف الطلب بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
		} 
?>
<?php
?>
        <div class="page-wrapper">
            <div class="container-fluid">
		<?php 
$cgrp = explode(',', $client_info["client_servergroups"]);
ticket($cgrp); 
 
		?>			
			</br>
	<center>
				<div class="col-lg-4 col-md-4">

	<button type="button" class="btn btn-rounded btn-block btn-outline-info">    <a href='A-Ticket.php'><i class='si si-action-undo'></i>ارجع الي قائمه التذاكر</a>
	</button>
	            </div>	

	</center>
	<br><Br>	

	<?php
			if(isset($_GET["view"]) && is_numeric($_GET["view"]) && !empty($_GET["view"])){
				
				$viewid = $_GET["view"];
				$sql = "SELECT * FROM apply WHERE id='$viewid' LIMIT 1";
				$res = $con->query($sql);
				if(!$res->num_rows > 0){ die("اعادة توجية"); }
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
				$status = intval($data["status"]);
				$cldbid = intval($data["cldbid"]);
				//$timez = $data["time"];
				$admin = $data["admin"];
				
			if($admin == 0 && $status == 0){
				echo "
			<center>
			<div class='col-md-6'>
                        <div class='card border-info'>
                            <div class='card-header bg-warning'>
                               <center> <h4 class='m-b-0 text-white'>تقديم $fullname</h4> </center>
								</div>
							<div class='card-body'>
										<div class='col-lg-12'>
												<hr>
<div class='form-group row'>
                                            <div class='col-4'>
             <ul><p class='font-w600'>الاسم الكامل - اسم الفريق<br>
              </p><p class='font-w300'>$fullname</p></ul>
                                            </div>
                                            <div class='col-4'>
              <ul><p class='font-w600'>البلد - اسم قائد الفريق باللعبة<br>
              </p><p class='font-w300'>$country</p></ul>	
                                            </div>
                                            <div class='col-4'>
              <ul><p class='font-w600'>السن<br>
              </p><p class='font-w300'>$age</p></ul>                                            </div>
                                        </div>		  
			  <hr>
              <ul><p class='font-w600'>اي طريقه يمكن التواصل معك بها مثل تلقرام او رقمك - اسم العضو الثاني باللعبة<br>
              </p><p class='font-w300'>$telegram</p></ul>
				<hr>		  
              <ul><p class='font-w600'>نوع المشكله او الاقتراح او الشكوه او الطلب - ايدي العضو الثاني<br>
              </p><p class='font-w300'>$group</p></ul>
			                 <hr>
              <ul><p class='font-w600'>معلومات مختصره عن الطلب - ايدي القائد <br>
              </p><p class='font-w300'>$why</p></ul>
	               <hr>		  
              <ul><p class='font-w600'>هل تعرض للمشكله من قبل ؟<br>
              </p><p class='font-w300'>$whatcanu</p></ul>
			                 <hr>
              <ul><p class='font-w600'>المشكله بالكامل - اسم العضو الثاني <br>
              </p><p class='font-w300'><br>$network</p></ul>
			                 <hr>
              <ul><p class='font-w600'>هل كان بحوذته دليل ؟ - اسم قائد الفريق<br>
              </p><p class='font-w300'>$special</p></ul>
			                 <hr>
              <ul><p class='font-w600'>ارسال ايدتني العضو بالخاص لك<br>
              </p><p class='font-w300'><form method='post'><button type='submit' name='sendticket[$cldbid]' class='btn btn-sm waves-effect waves-light btn-outline-danger'>ارسال الايدنتي</button></form></p></ul>
			  <hr>
              <br>

                            </div>			
              <form class='font-w300 form-horizontal push-10-t' method='post'> 								
<div class='row items-push text-center text-sm-left'>	
  
												<hr>
												<br>  
								<div class='col-md-4'>												
                                    <button type='submit' name='accept[$id]' class='btn btn-rounded btn-block btn-outline-info' data-toggle='click-ripple' style='overflow: hidden; position: relative; z-index: 1;'>اقبل</button>
			  															</div>
						<div class='col-md-4'>
	              <form class='font-w300 form-horizontal push-10-t' method='post'>
                                    <button type='submit' name='reject[$id]' class='btn btn-rounded btn-block btn-outline-danger' data-toggle='click-ripple' style='overflow: hidden; position: relative; z-index: 1;'>ارفض</button>
												</div></div></div>
												<br>								
                            <div class='col-xs-6 text-left block-content'>							
							
<div class='form-group row'>
                                            <div class='col-12'>
                                                <textarea class='form-control' id='example-textarea-input' name='denyreason' rows='6' placeholder='السبب‬‎..'></textarea>
                                            </div>
                                        </div>							

            </form>
          </div>
        
          </div>
      </div>
  </div> 
  ";
				
	   }else if($status == 1 && $admin !== 0){
		   			try{
				 $adminz = $ts3_VirtualServer->clientInfoDb($admin)["client_nickname"];
			}catch(Exception $e){
				$adminz = "لا يوجد اسم";
			}
		   		   if(!isset($denyreason) || empty($denyreason)){
			   $denyreason = "بدون سبب";
		   }
		   
		   echo "
			<center>
			<div class='col-md-6'>
                        <div class='card border-info'>
                            <div class='card-header bg-success'>
                               <center> <h4 class='m-b-0 text-white'>تقديم $fullname</h4> </center>
								</div>
							<div class='card-body'>
										<div class='col-lg-12'>
												<hr>
              <ul><p class='font-w600'>القابل <br>
              </p><p class='font-w300'>$adminz</p></ul>	  	  
		  		   <hr>
		  <ul><p class='font-w600 text-success'>سبب القبول<br>
              </p><p class='font-w300 text-success'>$denyreason</p></ul>
		  		  <hr>
              <ul><p class='font-w600'>الاسم الكامل - اسم الفريق<br>
              </p><p class='font-w300'>$fullname</p></ul>
		  <hr>
              <ul><p class='font-w600'>اي طريقه يمكن التواصل معك بها مثل تلقرام او رقمك - اسم العضو الثاني باللعبة<br>
              </p><p class='font-w300'>$telegram</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>البلد - اسم قائد الفريق باللعبة<br>
              </p><p class='font-w300'>$country</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>السن<br>
              </p><p class='font-w300'>$age</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>نوع المشكله او الاقتراح او الشكوه او الطلب - ايدي العضو الثاني<br>
              </p><p class='font-w300'>$group</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>معلومات مختصره عن الطلب - ايدي القائد <br>
              </p><p class='font-w300'>$why</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل تعرض للمشكله من قبل ؟<br>
              </p><p class='font-w300'>$whatcanu</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>المشكله بالكامل - اسم العضو الثاني <br>
              </p><p class='font-w300'><br>$network</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل كان بحوذته دليل ؟ - اسم قائد الفريق<br>
              </p><p class='font-w300'>$special</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>ارسال ايدتني العضو بالخاص لك<br>
              </p><p class='font-w300'><form method='post'><button type='submit' name='sendticket[$cldbid]' class='btn btn-sm waves-effect waves-light btn-outline-danger'>ارسال الايدنتي</button></form></p></ul>
			  <hr>
              <br>
				<img src='image/AC.png' style='width: 150px;'>
          </div>
      </div>   </div>   </div>
  </div></center>
		   ";
		   
	   }else if($status === 2 && $admin !== 0){
		   
		   if(!isset($denyreason) || empty($denyreason)){
			   $denyreason = "بدون سبب";
		   }
		   
		   try{
				 $adminz = $ts3_VirtualServer->clientInfoDb($admin)["client_nickname"];
			}catch(Exception $e){
				$adminz = "لا يوجد اسم";
			}
		  
		   
		   echo "			<center>
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
              <ul><p class='font-w600'>الاسم الكامل - اسم الفريق<br>
              </p><p class='font-w300'>$fullname</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>اي طريقه يمكن التواصل معك بها مثل تلقرام او رقمك - اسم العضو الثاني باللعبة<br>
              </p><p class='font-w300'>$telegram</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>البلد - اسم قائد الفريق باللعبة<br>
              </p><p class='font-w300'>$country</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>السن<br>
              </p><p class='font-w300'>$age</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>نوع المشكله او الاقتراح او الشكوه او الطلب - ايدي العضو الثاني<br>
              </p><p class='font-w300'>$group</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>معلومات مختصره عن الطلب - ايدي القائد <br>
              </p><p class='font-w300'>$why</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل تعرض للمشكله من قبل ؟<br>
              </p><p class='font-w300'>$whatcanu</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>المشكله بالكامل - اسم العضو الثاني <br>
              </p><p class='font-w300'><br>$network</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>هل كان بحوذته دليل ؟ - اسم قائد الفريق<br>
              </p><p class='font-w300'>$special</p></ul>
			  		  <hr>
              <ul><p class='font-w600'>ارسال ايدتني العضو بالخاص لك<br>
              </p><p class='font-w300'><form method='post'><button type='submit' name='sendticket[$cldbid]' class='btn btn-sm waves-effect waves-light btn-outline-danger'>ارسال الايدنتي</button></form></p></ul>
			  		  <hr>
              <br>
												<img src='image/de.png' style='width: 150px;'>
          </div>
      </div>
  </div>  </div> </div> </center>
		   ";
		   
	   }
			}else{
				
			echo "
			
			<div class='row'>

					<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'>سجل Change Fortnite - بطولة فورت نايت</h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table info-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>اسم الفريق</th>
                                                <th>ايدي الينك ايدي التابع لمدير الفريق</th>
                                                <th>الاسم بالتيم سبيك</th>
                                                <th>حاله التقديم</th>
                                                <th>الادمن</th>
                                                <th>الدخول على التقديم</th>
                                                <th>حذف الطلب</th>
                                            </tr>
                                        </thead>
    <tbody>";
							$sql = "SELECT COUNT(id) FROM apply";
							$res = $con->query($sql);
							$rz = $res->fetch_row();
							$numrow = $rz[0];
							$perPage = 25;
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
							
							$sql = "SELECT * FROM apply WHERE hidden='1' ORDER BY id DESC LIMIT $offset,$perPage ";					
							$res = $con->query($sql);
										
											// $sql = "SELECT * FROM apply ORDER BY id DESC";
											// $res = $con->query($sql);
											while($data = $res->fetch_assoc()){
												$idz = $data["id"];
												$name = $data["fullname"];
												$age = $data["age"];
												$why = $data["why"];
												$anwer = intval($data["admin"]);
												$username = $data["cldbid"];
												$stat = intval($data["status"]);
									try{
										$username = $ts3_VirtualServer->clientInfoDb($username)["client_nickname"];
										$ts3_VirtualServer->clientGetByDbid($data["cldbid"]);											
										$ownernick = $ts3_VirtualServer->clientInfoDb($anwer)["client_nickname"];
										$ts3_VirtualServer->clientGetByDbid($data["admin"]);									
									}catch(Exception $e){
										
									}																			
												echo "<tr>
													<td>$name</td> 
													<td>$why</td> 
													<td>$username</td> ";
													
												if($stat === 0){
													echo "<td><span class='badge badge-warning'>قيد المراجعة</span></td>";
													$ownernick = "<span class='badge badge-warning'>قيد المراجعة</span>";
												}else if($stat  === 1){
													echo "<td><span class='badge badge-success'>مقبول</span></td>";
													try{							
														$ownernick = $ts3_VirtualServer->clientInfoDb($anwer)["client_nickname"];								
													}catch(Exception $e){
														
													}
												}else if($stat === 2){
													echo "<td><span class='badge badge-danger'>مرفوض</span></td>";
													try{							
														$ownernick = $ts3_VirtualServer->clientInfoDb($anwer)["client_nickname"];								
													}catch(Exception $e){
														
													}
												}
												
												echo"
													<td>$ownernick</td>																												
													<td><a class='btn btn-rounded btn-block btn-outline-primary' href='?view=$idz'>مشاهدة الطلب</a></td>";
											$remove = array(2,10,1555,1557,1672,1048);
											if(!count(array_intersect($remove, $ggids)) > 0){
												echo "<td class='text-center' style='width: 1px;'><button type='button' class=' disabled btn btn-rounded btn-block btn-outline-primary   '><i class='glyphicon glyphicon-remove'>غير مصرح لك بالحذف</i></button></td></tr>";
											}else{
												echo "<td class='text-center' style='width: 1px;'><form method='post'><button type='submit' name='del[$idz]' class='btn btn-rounded btn-block btn-outline-danger'>حذف هذا الطلب</button></form></td>
												</tr>";
											}							
											}
																				echo"		
									</tbody>
                            </table>
							<center>
					  		</center>							
                        </div>
                    </div>		  </div>	  </div>	  </div>											
											
										";	
											
											
											
											echo"
			<div class='row'>

					<div class='col-md-12'>
						<div class='card'>
                            <div class='card-body'>
                               <center> <h3 class='card-title'>سجل تذاكر الدعم الفني الاداري</h3> </center>

							<div class='table-responsive'>
                                    <table class='table color-bordered-table info-bordered-table'>
                                        <thead>
                                            <tr>
                                                <th>الاسم الكامل</th>
                                                <th>العمر</th>
                                                <th>الاسم بالتيم سبيك</th>
                                                <th>حاله التقديم</th>
                                                <th>الادمن</th>
                                                <th>الدخول على التقديم</th>
                                                <th>حذف الطلب</th>
                                            </tr>
                                        </thead>
    <tbody>";
							$sql = "SELECT COUNT(id) FROM apply WHERE hidden='0'";
							$res = $con->query($sql);
							$rz = $res->fetch_row();
							$numrow = $rz[0];
							$perPage = 25;
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
							
							$sql = "SELECT * FROM apply WHERE hidden='0' ORDER BY id DESC LIMIT $offset,$perPage ";					
							$res = $con->query($sql);
										
											// $sql = "SELECT * FROM apply ORDER BY id DESC";
											// $res = $con->query($sql);
											while($data = $res->fetch_assoc()){
												$idz = $data["id"];
												$name = $data["fullname"];
												$age = $data["age"];
												$anwer = intval($data["admin"]);
												$username = $data["cldbid"];
												$stat = intval($data["status"]);
									try{
										$username = $ts3_VirtualServer->clientInfoDb($username)["client_nickname"];
										$ts3_VirtualServer->clientGetByDbid($data["cldbid"]);											
										$ownernick = $ts3_VirtualServer->clientInfoDb($anwer)["client_nickname"];
										$ts3_VirtualServer->clientGetByDbid($data["admin"]);									
									}catch(Exception $e){
										
									}																			
												echo "<tr>
													<td>$name</td> 
													<td>$age</td> 
													<td>$username</td> ";
													
												if($stat === 0){
													echo "<td><span class='badge badge-warning'>قيد المراجعة</span></td>";
													$ownernick = "<span class='badge badge-warning'>قيد المراجعة</span>";
												}else if($stat  === 1){
													echo "<td><span class='badge badge-success'>مقبول</span></td>";
													try{							
														$ownernick = $ts3_VirtualServer->clientInfoDb($anwer)["client_nickname"];								
													}catch(Exception $e){
														
													}
												}else if($stat === 2){
													echo "<td><span class='badge badge-danger'>مرفوض</span></td>";
													try{							
														$ownernick = $ts3_VirtualServer->clientInfoDb($anwer)["client_nickname"];								
													}catch(Exception $e){
														
													}
												}
												
												echo"
													<td>$ownernick</td>																												
													<td><a class='btn btn-rounded btn-block btn-outline-primary' href='?view=$idz'>مشاهدة الطلب</a></td>";
											$remove = array(2,10,1555,1557,1672);
											if(!count(array_intersect($remove, $ggids)) > 0){
												echo "<td class='text-center' style='width: 1px;'><button type='button' class=' disabled btn btn-rounded btn-block btn-outline-primary   '><i class='glyphicon glyphicon-remove'>غير مصرح لك بالحذف</i></button></td></tr>";
											}else{
												echo "<td class='text-center' style='width: 1px;'><form method='post'><button type='submit' name='del[$idz]' class='btn btn-rounded btn-block btn-outline-danger'>حذف هذا الطلب</button></form></td>
												</tr>";
											}							
											}											
										
											
											
											}
											
										?>

									</tbody>
                            </table>
							<center>
						<ul class="pagination pagination-lg">
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
                        </div>
                    </div>		  </div>	  </div>	  </div>	  </div>		
			
        		
				
				
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>