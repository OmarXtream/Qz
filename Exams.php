<?php
die();
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
require 'config/sqlconfig.php'; 
require 'includes/sweetalert.php'; 
if(isset($_POST["octest"])){
	if(time() <= intval($_SESSION["cspam"])){
		die ('<script>
			   swal({
				title: "خطأ",
				text: "برجاء الانتظار 60 ثانية قبل عمل طلب اخر",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
	}
	try {
		$_SESSION["cspam"] = (time() + 60);
		$client_info->move(105793);
			die ('<script>
			   swal({
				title: "تمت العملية بنجاح",
				text: "تم نقلك الى منطقة الاختبارات المطلوبة",
				type: "success",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');
			   
	}catch(Exception $e){
		
	}
	$_SESSION["cspam"] = (time() + 60);
		die ('<script>
			   swal({
				title: "خطأ",
				text: "حدث خطأ اثناء نقلك الى منطقة الاختبارات",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
}else if(isset($_POST["sendx"])){
	if(time() <= intval($_SESSION["cspam"])){
		die ('<script>
			   swal({
				title: "خطأ",
				text: "برجاء الانتظار 60 ثانية قبل عمل طلب اخر",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
	}
		try {
			$_SESSION["cspam"] = (time() + 60);
			$client_info->message("[URL=client://28/Ad8BuJ91PadHtcSNmmlDGwU1/j8=~%E2%80%8E%E2%80%AB%D8%B9%D8%A8%D8%AF%D8%A7%D9%84%D9%84%D9%87%E2%80%AC%E2%80%8E]‎‫عبدالله‬‎[/URL]");
				die ('<script>
				   swal({
					title: "تمت العملية بنجاح",
					text: "تم إرسال الأيدينيتي على الخاص",
					type: "success",
					allowOutsideClick: false,
					allowEscapeKey: false,
					showCloseButton: false,
					confirmButtonText: "حسنأ",
				  }).then((result) => {
					if (result.value) {
					  window.location.replace("https://panel.q-z.us/Exams.php");
					}else {
					  window.location.replace("https://panel.q-z.us/Exams.php");
					}
				  })
				   </script>');	
				   
		}catch(Exception $e){
			
		}
			$_SESSION["cspam"] = (time() + 60);
		die ('<script>
			   swal({
				title: "خطأ",
				text: "فشل إرسال الأيدينيتي على الخاص",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
}else if(isset($_POST["entest"])){
		if(time() <= intval($_SESSION["cspam"])){
		die ('<script>
			   swal({
				title: "خطأ",
				text: "برجاء الانتظار 60 ثانية قبل عمل طلب اخر",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
	}
	try {
		$_SESSION["cspam"] = (time() + 60);
		$client_info->move(105791);
			die ('<script>
			   swal({
				title: "تمت العملية بنجاح",
				text: "تم نقلك الى منطقة الاختبارات المطلوبة",
				type: "success",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
			   
	}catch(Exception $e){
		
	}
	$_SESSION["cspam"] = (time() + 60);
		die ('<script>
			   swal({
				title: "خطأ",
				text: "حدث خطأ اثناء نقلك الى منطقة الاختبارات",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
}else if(isset($_POST["gmtest"])){
		if(time() <= intval($_SESSION["cspam"])){
		die ('<script>
			   swal({
				title: "خطأ",
				text: "برجاء الانتظار 60 ثانية قبل عمل طلب اخر",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
	}
	try {
		$_SESSION["cspam"] = (time() + 60);
		$client_info->move(211565);
			die ('<script>
			   swal({
				title: "تمت العملية بنجاح",
				text: "تم نقلك الى منطقة الاختبارات المطلوبة",
				type: "success",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');
			   
	}catch(Exception $e){
		
	}
	$_SESSION["cspam"] = (time() + 60);
		die ('<script>
			   swal({
				title: "خطأ",
				text: "حدث خطأ اثناء نقلك الى منطقة الاختبارات",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
}else if(isset($_POST["dstest"])){
	if(time() <= intval($_SESSION["cspam"])){
		die ('<script>
			   swal({
				title: "خطأ",
				text: "برجاء الانتظار 60 ثانية قبل عمل طلب اخر",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
	}
	try {
		$_SESSION["cspam"] = (time() + 60);
		$client_info->move(176552);
			die ('<script>
			   swal({
				title: "تمت العملية بنجاح",
				text: "تم نقلك الى منطقة الاختبارات المطلوبة",
				type: "success",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
			   
	}catch(Exception $e){
		
	}
	$_SESSION["cspam"] = (time() + 60);
		die ('<script>
			   swal({
				title: "خطأ",
				text: "حدث خطأ اثناء نقلك الى منطقة الاختبارات",
				type: "error",
				allowOutsideClick: false,
				allowEscapeKey: false,
				showCloseButton: false,
				confirmButtonText: "حسنأ",
			  }).then((result) => {
				if (result.value) {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}else {
				  window.location.replace("https://panel.q-z.us/Exams.php");
				}
			  })
			   </script>');	
}

?>
<link href="dist/css/pages/user-card.css" rel="stylesheet">

        <div class="page-wrapper">
        <div class="container-fluid">
		
		</br>
		</br>
		<center>
			<div class="flipInX animated">
					<div <?php echo $indexxx[array_rand($indexxx)];?>>
						<img src="https://e.top4top.net/s_851ceyfv1.png" class="img-responsive" alt="user">
						<img src="https://i.imgur.com/nPqxBBu.png" class="img-responsive" alt="user">
						</br>
						<img src="https://i.imgur.com/6CLGSyS.png" class="img-responsive" alt="user">
					</span>
			</div>
		</center>
		
		</br>
		</br>
		<center>
			<div class="col-lg-3 col-md-6">
               <form method="post"><button type="submit" class="btn btn-rounded btn-block btn-outline-info" name="sendx">أرسال أيدنتي المسؤول</button></form>
            </div>
			</br>
			<hr>
		</center>
		</br>
		<center>
			<div class="flipInX animated">
					<div <?php echo $indexxx[array_rand($indexxx)];?>>
						<img src="https://i.imgur.com/ojW1XYC.png" class="img-responsive" alt="user">
					</span>
			</div>
		</center>
		
<div class="row el-element-overlay">

			<div class="col-md-3">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="https://i.imgur.com/joYVH36.png" alt="user">
                                    <div class="el-overlay scrl-dwn">
                                        <ul class="el-info">
											<form method="post">
												<li><button type="submit" name="octest" class="btn btn-rounded btn-block btn-outline-danger">أضغط لطلب المسؤول</button></li>
											</form>
									   </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
								<h4 class="h4 font-w400 text-white-op js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" style="color:#211e1e"><b>[ Otaku Community Tester ]</b></h4>
                                    <br> </div>
                            </div>
                        </div>
            </div>
			<div class="col-md-3">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="https://i.imgur.com/PpcGqS8.png" alt="user">
                                    <div class="el-overlay scrl-dwn">
                                        <ul class="el-info">
										<form method="post">
                                            <li><button type="submit" name="entest" class="btn btn-rounded btn-block btn-outline-danger">أضغط لطلب المسؤول</button></li>
                                       </form>
									   </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
								<h4 class="h4 font-w400 text-white-op js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" style="color:#211e1e"><b>[ English Speak Tester ]</b></h4>
                                    <br> </div>
                            </div>
                        </div>
            </div>
			<div class="col-md-3">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="https://i.imgur.com/Fqj35dG.png" alt="user">
                                    <div class="el-overlay scrl-dwn">
                                        <ul class="el-info">
										<form method="post">
                                            <li><button type="submit" name="gmtest" class="btn btn-rounded btn-block btn-outline-danger">أضغط لطلب المسؤول</button></li>
                                        </form>
										</ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
								<h4 class="h4 font-w400 text-white-op js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" style="color:#211e1e"><b>[ Games Tester ]</b></h4>
                                    <br> </div>
                            </div>
                        </div>
            </div>
				<div class="col-md-3">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="https://i.imgur.com/ETvUFal.png" alt="user">
                                    <div class="el-overlay scrl-dwn">
                                        <ul class="el-info">
										<form method="post">
                                           <li><button type="submit" name="dstest" class="btn btn-rounded btn-block btn-outline-danger">أضغط لطلب المسؤول</button></li>
                                        </form>
										</ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
								<h4 class="h4 font-w400 text-white-op js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" style="color:#211e1e"><b>[ Designers Tester ]</b></h4>
                                    <br> </div>
                            </div>
                        </div>
            </div>
 </div>
			
        </div>
        </div>
		
<?php require_once('includes/footer.php'); ?>