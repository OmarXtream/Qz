<?php 
require('config/sqlconfig.php');
//ini_set("default_charset", 'utf-8');
?>
<body class="fixed-layout lock-nav mini-sidebar skin-default-dark">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== 
       <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Qz - panel</p>
        </div>
    </div> -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="assets/images/qzdark.png" alt="homepage" class="dark-logo">
                         <!-- Light Logo text -->    
                         <img src="assets/images/qzwhite.png" class="light-logo" alt="homepage"></span> </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                        <!-- Comment -->
                       <!--  <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul>
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">أخر الأخبار والتحديثات</h4>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center">
										
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>O S A M A ~ A L S B 3</h5> <span class="mail-desc">سيتم أصدار النسخه المطوره من اللوحه بأول رمضان أنتظرونا</span> <span class="time">4/7/2018</span> </div>
                                            </a>

                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5" href="javascript:void(0);">  <i class="fa fa-bell fa-3x"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->
                        <!-- Messages -->
                      
                        <!-- End Messages -->
						
						
						<center>
<?php
		$sql = "SELECT * FROM adv LIMIT 1";
		$text = $con->query($sql)->fetch_assoc()["topic"];
		if(isset($text) && !empty($text)){
			echo "
						<br><div class='col-md-12'>
<p><marquee onmouseover='this.stop()' onmouseout='this.start()' scrollamount='5' scrolldelay='5' direction='right'><b><a title='<h style='color:#ac0000 '></a></b><b><a title='' target='_blank'><span id='movetitle'> 🔴 <h style='color:#ac0000' <='' h=''>$text 🔴
</h></span></a> </b><b><a title='#MahmouD :المسؤول عن اللوحة ' target='_blankB.Qz.G#' لاتزال='' اللوحة='' تحت='' التطوير='' والبرمجة)='' ..<='' a=''> </a></b></marquee></p>
</div>			
				";
		}
		
	?>						</center>
						
						
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- mega menu 
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-layout-width-default"></i></a>
                            <div class="dropdown-menu animated bounceInDown">
                                <center>
		<div class="card-header bg-dark">
                                <h4 class="m-b-0 text-white">								<?php
		$sql = "SELECT * FROM adv LIMIT 1";
		$text = $con->query($sql)->fetch_assoc()["topic"];
		if(isset($text) && !empty($text)){
			echo "<center> <center><small class='font-w300' style='color:#ffc600'><strong>$text</strong></small></center>
			</center>	";
		}
		
	?>
			</h4>
		</div>

                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    
                    </ul>
                </div>
            </nav>
        </header>