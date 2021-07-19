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
              // window.location.replace("https://panel.q-z.us/fnc");
            // }else {
              // window.location.replace("https://panel.q-z.us/fnc");
            // }
          // })
           // </script>'); 	
// }else{
	// $_SESSION['Ticket12'] = microtime(true)+3600;
// }
// منععععع الاسبام	
  if(isset($_POST["fullname"]) && isset($_POST["country"]) && isset($_POST["why"]) && isset($_POST["group"]) && isset($_POST["telegram"])  && isset($_POST["network"]) && isset($_POST["special"])
	  && !empty($_POST["fullname"]) && !empty($_POST["country"]) && !empty($_POST["why"]) && !empty($_POST["group"]) && !empty($_POST["telegram"]) && !empty($_POST["network"]) && !empty($_POST["special"])){
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
		$network = $con->real_escape_string(htmlspecialchars(strip_tags($_POST["network"])));
		$special = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["special"]))));
		
		$sql = "INSERT INTO `Rankqz`.`apply` (`id`, `fullname`, `country`, `group`, `telegram`, `why`, `whatcanu`, `network`, `special`, `denyreason`, `age`, `status`, `cldbid`, `timex`, `admin`, `hidden`) VALUES (NULL, '$fullname', '$country', '$group', '$telegram', '$why', '0', '$network', '$special', NULL, '0', '0', '$dbid', '$now', '0', '1')";
		if($res = $con->query($sql) === true){
		echo('<script>
           swal({title: "تقديم طلب بطولة فورتنايت",text: "تم التقديم بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>'); 			
		}else{
		die('<script>
           swal({title: "خطا",text: "حدث خطاء",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/fnc");}else {window.location.replace("https://panel.q-z.us/fnc");}})</script>'); 
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
              window.location.replace("https://panel.q-z.us/fnc");
            }else {
              window.location.replace("https://panel.q-z.us/fnc");
            }
          })
           </script>'); 	
	//	 die('<center><meta http-equiv="refresh" content="5;url=fnc.php"> <div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
	//					    <a class="alert-link" href="javascript:void(0)">لأ يمكنك اعاده تقديم طلب دعم فني الأ بعد مرور يوم علي الطلب القديم</a>.<br><strong>
	//					</div></center>');
	 }
  }else{
die('<script>
           swal({title: "خطا",text: "برجاء ملئ كامل الخانات للتقديم",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/fnc");}else {window.location.replace("https://panel.q-z.us/fnc");}})</script>'); 	  
  }
}
 
?>
        <div class="page-wrapper">
            <div class="container-fluid">
			</br>
			
			<div class="row">
				<div class="col-md-4"> 
                        <div class="card border-info">
                            <div class="card-header bg-info">
                               <center> <h4 class="m-b-0 text-white">Change Fortnite - بطولة فورت نايت</h4> </center>
								</div>
							<div class="card-body">
									<form class="font-w300 form-horizontal push-10-t" method="post">
									
								<div class="form-group row">
								<div class="col-12">
								<br>
								<input type="text" class="form-control" id="be-contact-name" name="fullname" placeholder="اسم الفريق">
								</div>
								</div>
								
								<div class="form-group row">
								<div class="col-12">
								<br>
								<input type="text" class="form-control" id="be-contact-name" name="special" placeholder="اسم قائد الفريق">
								</div>
								</div>
			
								<div class="form-group row">
								<div class="col-6">							
								<input type="text" class="form-control" name="why" placeholder="UniqID القائد">
								</div>
								
								<div class="col-6">
								<input type="text" class="form-control" name="country" placeholder="حساب القائد في EPIC">
								</div>
								</div>


								<div class="form-group row">
								<div class="col-12">
								<br>
								<input type="text" class="form-control" id="be-contact-name" name="network" placeholder="اسم العضو الثاني">
								</div>
								</div>
			
								<div class="form-group row">
								<div class="col-6">
								<input type="text" class="form-control" name="group" placeholder="UniqID العضو الثاني">
								</div>
								
								<div class="col-6">
								<input type="text" class="form-control" name="telegram" placeholder="حساب العضو الثاني في EPIC">
								</div>
								</div>
								
                                <div class="form-group row">
                                    <div class="col-12 text-center">
								<!--	disabled -->
                                        <button id="form_submit_btn"  disabled name="submit" type="submit" class="btn btn-outline-danger">
                                            <i class="fa fa-send"></i> مغلق
											<BR>
											<P>غدأ اول مبارة الساعة 7 بتوقيت مكة 
<P>
لمشاهدة مبارتك شاهد الجدول 
                                        </button>
        </form>										
                                    </div>

							</div>
						</div>
			</div> </center>
			
			
			

        </div>
				<div class="col-md-8"> 
                        <div class="card">
                            <div class="card-body">
                                        <h4 class="card-title">الجدول - ترتيب الفرق </h4>
                                        <h6 class="card-subtitle"></h6>
                                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                                <li data-target="#carouselExampleIndicators2" data-slide-to="1" class=""></li>
                                                <li data-target="#carouselExampleIndicators2" data-slide-to="2" class=""></li>
                                                <li data-target="#carouselExampleIndicators2" data-slide-to="3" class=""></li>
                                                <li data-target="#carouselExampleIndicators2" data-slide-to="4" class=""></li>
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <img class="img-responsive" src="<?php
		$sql = "SELECT * FROM change1 LIMIT 1";
		$img = $con->query($sql)->fetch_assoc()["img"];		
		if(isset($img) && !empty($img)){
			echo "$img";
		} else  { 
		
		echo "لم يتم وضع الصور للأن";
		
		}
	?>" alt="First slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="img-responsive" src="<?php
		$sql = "SELECT * FROM change1 LIMIT 1";
		$text = $con->query($sql)->fetch_assoc()["news"];
		if(isset($text) && !empty($text)){
			echo "$text";
		} else  { 
		
		echo "لم يتم وضع الصور للأن";
		
		}
		
	?>" alt="Second slide">
                                                </div>
													

												<div class="carousel-item">
                                                    <img class="img-responsive" src="https://i.imgur.com/aX5viTz.png" alt="Third slide">
                                                </div>	

												<div class="carousel-item">
                                                    <img class="img-responsive" src="https://i.imgur.com/hZuU61E.jpg" alt="Third slide">
                                                </div>												
                                                <div class="carousel-item">
                                                    <img class="img-responsive" src="https://i.imgur.com/RYORQ8t.png" alt="Third slide">
                                                </div>
												
												<div class="carousel-item">
                                                    <img class="img-responsive" src="https://i.imgur.com/6camqTo.png" alt="Third slide">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                            </div>
                        </div>
			

        </div>		
        </div>
		<center>
<div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                            <div class="card-body">
                                <h4 class="card-title">
								<hr>
<img class="card-img" src="https://i.imgur.com/g9JoRWb.png" height="500" alt="Card image">								
<!--نظام البطولة خروج المغلوب ( حسب عدد الكيلات )
راح يكون نظام اللعب Squad 
وعدد المشاركين 2 وعدد الحكام 2
مع بداية القيم الحكام ينتحرون ويبقون المشاركين ويتم احتساب الكيلز وأعلى كيلز راح يكون هو الفايز
<hr>
<br>
* يجب التواجد في التيم سبيك أثناء البطولة
<br>
* مافي أي إعادة سواء شخص فصل نته أو كرشت اللعبه Blah Blah Blah ...
<br>
* في حالة إكتشاف غش سواء شخص يلعب ومو مسجل خويه أو شيء راح يسجل خساره
<br>
 </h4>
<hr>
                                <p class="card-text">

المركز الأول :
<br>
20 يوم - VIP GOLD
<br>
5000 كوينز
<br>
روم في المنطقه الملكيه
<hr>
<br>
المركز الثاني :
<br>
20 يوم - VIP SILVER
<br>
2500 كوينز	
<br>
روم في المنطقه الملكيه	
<br>	
<hr>				
								</p>

                                <h3 class="card-title">
* لمشاهدة الرد علي طلبك للبطولة توجهة الي < الدعم الفني < تذاكري
 </h3>								-->
								
                            </div>
                        </div>
                    </div>		
                    </div>
<div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
					
                    </div>		
                    </div>		
		
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>