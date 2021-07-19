<?php


 if (!isset($_SESSION)) {
         session_start();
 }

 if($_SESSION['last_session_request'] > (time() - 15)){
    if(empty($_SESSION['last_request_count'])){
        $_SESSION['last_request_count'] = 15;
    }elseif($_SESSION['last_request_count'] < 15){
        $_SESSION['last_request_count'] = $_SESSION['last_request_count'] + 1;
    }elseif($_SESSION['last_request_count'] >= 15){
          echo '
    <head>
        <meta charset="utf-8">
    <title> Qz - Control Panel - لوحه تحكم التيم سبيك </title>

        <meta name="description" content="Panel Teamspeak3 Qz">

        <meta property="og:title" content="Qz Panel Teamspeak3 ">
        <meta property="og:site_name" content="Qz panel">
        <meta property="og:description" content="Panel For Team Speak Qz To esy use teamspeak3">

        <link rel="shortcut icon" href="https://i.imgur.com/199Mmpo.png">
        <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">

        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
 <style>
 @font-face {
    font-family: myFirstFont;
    src: url("assets/AraJozoor-Regular.ttf") format("truetype");
}
</style>
    <body>
        <div id="page-container" class="main-content-boxed side-trans-enabled">
		<main id="main-container" style="min-height: 468px;">
                <!-- Page Content -->
                <div class="bg-image" style="background-image: url(assets/img/photos/photo34@2x.jpg);">
                    <div class="row mx-0 bg-default-op">
                        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                            <div class="p-30 js-appear-enabled animated fadeIn" data-toggle="appear">
                                <p class="font-size-h3 font-w600 text-white">
                                    Don’t worry, we’ve got your back
                                </p>
                                <p class="font-italic text-white-op">
                                    Copyright © <span class="js-year-copy">2017</span>
                                </p>
                            </div>
                        </div>
                        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white">
                            <div class="content content-full">
                                <!-- Header -->
                                <div class="px-30 py-10">
								<center>
                <span class="card-title text-xs-center">
        			<img src="https://i.imgur.com/bQErVEx.png" class="img-fluid mx-auto d-block pt-2" width="150" alt="logo">
        		</span>								
                                    <a class="link-effect font-w700" href="index.html">
                                        <i class="si si-fire"></i>
                                        <span class="font-size-xl text-primary-dark">Q</span><span class="font-size-xl">z</span>
                                    </a>
                                    <h1 class="h3 font-w700 mt-30 mb-10">اكتشفنا محاولات عديده من الاسبام.</h1>
                                    <h2 class="h5 font-w400 text-muted mb-0"> يمنع منعأ باتأ هذا حاول دخول اللوحه بعد 30 ثانيه</h2>
									</center>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>


  
		  ';
            exit;
         }
 }else{
    $_SESSION['last_request_count'] = 1;
 }

 $_SESSION['last_session_request'] = time();

?>

		  