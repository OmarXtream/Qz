<?php
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
require 'config/sqlconfig.php'; 
if(isset($_POST["submit"])){
// منععععع الاسبام
// if(isset($_SESSION['Ticket12']) and $_SESSION['Ticket12'] >= microtime(true)){
// die('<script>
           // swal({
            // title: "خطا",
            // text: "عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة بعد ساعة ",
            // type: "info",
            // allowOutsideClick: false,
            // allowEscapeKey: false,
            // showCloseButton: false,
			// confirmButtonText: "حسنأ",
          // }).then((result) => {
            // if (result.value) {
              // window.location.replace("https://panel.q-z.us/Ticket");
            // }else {
              // window.location.replace("https://panel.q-z.us/Ticket");
            // }
          // })
           // </script>'); 	
// }else{
	// $_SESSION['Ticket12'] = microtime(true)+3600;
// }
// منععععع الاسبام	
  if(isset($_POST["fullname"]) && isset($_POST["country"]) && isset($_POST["age"]) && isset($_POST["group"]) && isset($_POST["telegram"]) && isset($_POST["why"]) && isset($_POST["whatcanu"]) && isset($_POST["network"]) && isset($_POST["special"])
	  && !empty($_POST["fullname"]) && !empty($_POST["country"]) && !empty($_POST["age"]) && !empty($_POST["group"]) && !empty($_POST["telegram"]) && !empty($_POST["why"]) && !empty($_POST["whatcanu"]) && !empty($_POST["network"]) && !empty($_POST["special"])){
	 $age = $_POST["age"];
	 if(!is_numeric($age)){
die('<script>
           swal({
            title: "خطا",
            text: "يجب ان يكون العمر بالارقام من فضلك",
            type: "error",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/Ticket");
            }else {
              window.location.replace("https://panel.q-z.us/Ticket");
            }
          })
           </script>'); 		 			 
	 }else if($age < 14 || $age > 40){
die('<script>
           swal({title: "خطا",text: "اقل عمرو لتقديم تذكره هوا 14",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/Ticket");}else {window.location.replace("https://panel.q-z.us/Ticket");}})</script>'); 		 		 
	 }
		$nowx = (time() - 3600);
		$check = "SELECT * FROM `Rankqz`.`apply` WHERE cldbid='$dbid' and timex > '$nowx'";
		$res = $con->query($check);
	 if($res->num_rows === 0){
		$now = time();
		
		$fullname = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["fullname"]))));
		$group = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["group"]))));
		$country = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["country"]))));
		$telegram = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["telegram"])));
		$why = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["why"]))));
		$whatcanu = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["whatcanu"]))));
		$network = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["network"])));
		$special = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["special"]))));
		
		$sql = "INSERT INTO `Rankqz`.`apply` (`id`, `fullname`, `country`, `group`, `telegram`, `why`, `whatcanu`, `network`, `special`, `denyreason`, `age`, `status`, `cldbid`, `timex`, `admin`) VALUES (NULL, '$fullname', '$country', '$group', '$telegram', '$why', '$whatcanu', '$network', '$special', NULL, '$age', '0', '$dbid', '$now', '0')";
		if($res = $con->query($sql) === true){
$thename = '[B][COLOR=red][URL=client://'.$dbid.'/'.$uid.']'.htmlspecialchars($nickname).'[/URL][/COLOR][/B]';

				$ts3_VirtualServer->serverGroupGetById(2155)->message("
تم تقديم تذكرة من قبل:
$fullname

الإسم بتيم سبيك :
$thename

نوع الطلب:
$why

الرجاء الذهاب الى قسم التذاكر والرد بأقصى سرعة ممكنه :)
");

		echo('<script>
           swal({title: "تقديم تذكرة",text: "تم التقديم بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>'); 			
		}else{
		die('<script>
           swal({title: "خطا",text: "حدث خطاء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/Ticket");}else {window.location.replace("https://panel.q-z.us/Ticket");}})</script>'); 
		}
	 }else{
		 die('<script>
           swal({
            title: "خطا",
            text: "لأيمكنك التقديم الا بعد مرور ساعة",
            type: "error",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/Ticket");
            }else {
              window.location.replace("https://panel.q-z.us/Ticket");
            }
          })
           </script>'); 	
	//	 die('<center><meta http-equiv="refresh" content="5;url=Ticket.php"> <div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
	//					    <a class="alert-link" href="javascript:void(0)">لأ يمكنك اعاده تقديم طلب دعم فني الأ بعد مرور يوم علي الطلب القديم</a>.<br><strong>
	//					</div></center>');
	 }
  }else{
die('<script>
           swal({title: "خطا",text: "برجاء ملئ كامل الخانات للتقديم",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/Ticket");}else {window.location.replace("https://panel.q-z.us/Ticket");}})</script>'); 	  
  }
}
 
?>
		
        <div class="page-wrapper">
            <div class="container-fluid">
			<?php 
$sql = "SELECT val FROM `Rankqz`.`stats` WHERE prop='ticketopen' LIMIT 1";
$res = $con->query($sql);
$valx = intval($res->fetch_assoc()["val"]);
if($valx === 0){				
			die('<script>
           swal({title: " لا يوجد مجال للتقديم حالياً ",text: " عند وجود أي تقديم سوف يتم فتح الصفحة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');
		}
				
				
		?>
			</br>
			<div class="row">
			<div class="col-md-4">
			</div>
				<div class="col-md-4"> 
                        <div class="card border-info">
                            <div class="card-header bg-info">
                               <center> <h4 class="m-b-0 text-white">تقديم طلب اداره - اقتراح - مشكله - شكوه - استفسار</h4> </center>
								</div>
							<div class="card-body">
									<form class="font-w300 form-horizontal push-10-t" method="post">
									
								<div class="form-group row">
								<div class="col-12">
								<br>
								<input type="text" class="form-control" id="be-contact-name" name="fullname" placeholder="ضع اسمك هنا">
								</div>
								</div>
			
								<div class="form-group row">
								<div class="col-6">
								<input type="text" class="form-control" name="age" placeholder="عمرك ؟">
								</div>
								
								<div class="col-6">
								<input type="text" class="form-control" name="country" placeholder="الجنسية">
								</div>
								</div>
										
								<div class="form-group">
								<div class="row">
								<div class="col-12">
								<input type="text" class="form-control" name="group" placeholder="نوع المشكله او الاقتراح او الشكوه او الطلب">
								</div>
								</div>
								</div>
								
								<div class="form-group">
								<div class="row">
								<div class="col-12">
								<input type="text" class="form-control" name="telegram" placeholder="اي طريقه يمكن التواصل معك بها مثل تلقرام او رقمك">
								</div>
								</div>
								</div>	
								
								<div class="col-13">
								<textarea class="form-control" id="example-textarea-input" name="why" rows="6" placeholder="‎ اكتب لنا معلومات مختصره عن طلبك او مشكلتك ؟  ‎"></textarea>
								</div>
<br>
								<div class="col-13">
								<textarea class="form-control" id="example-textarea-input" name="whatcanu" rows="6" placeholder="‎‫هل سبق وتعرضت لي نفس المشكله او الشكوه او الطلب ؟؟‬‎"></textarea>
								</div>
<br>
								<div class="col-13">
								<textarea class="form-control" id="example-textarea-input" name="network" rows="6" placeholder="ضع جميه ما تريد كتابته هنا من طلب او اقتراح او شكوه‬‎"></textarea>
								</div>
<br>
								<div class="col-13">
								<textarea class="form-control" id="example-textarea-input" name="special" rows="6" placeholder="اذا لديك دليل يجعلنا نتاكد من طلبك او اقتراحك .."></textarea>
								</div>
<br>							
                                <div class="form-group row">
                                    <div class="col-12 text-center">
									
                                        <button id="form_submit_btn"  name="submit" type="submit" class="btn btn-outline-info">
                                            <i class="fa fa-send"></i> قدم
                                        </button>
        </form>										
                                    </div>

							</div>
						</div>
			</div> </center>
			
			
			

        </div>
        </div>
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>