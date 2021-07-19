<!DOCTYPE html>
<html lang="en" dir="rtl">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="https://i.imgur.com/199Mmpo.png">
    <title>Qz - Control Panel - لوحه تحكم التيم سبيك</title>
	<link rel="stylesheet" href="assets/node_modules/dropify/dist/css/dropify.min.css">
    <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <link href="assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
	    <!-- chartist CSS -->
    <link href="assets/node_modules/css-chart/css-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
	<link rel="stylesheet" href="assets/css/font.css">
	<link href="assets/dist/css/pages/user-card.css" rel="stylesheet">
    <link href="assets/dist/css/style.min.css" rel="stylesheet">
    <link href="assets/dist/css/pages/dashboard1.css" rel="stylesheet">
	<link href="assets/dist/css/pages/widget-page.css" rel="stylesheet">
	<link href="assets/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
	<link href="assets/dist/css/pages/bootstrap-switch.css" rel="stylesheet">
    <link href="assets/node_modules/prism/prism.css" rel="stylesheet">
	<link href="assets/dist/css/pages/ribbon-page.css" rel="stylesheet">
	<link href="assets/dist/css/pages/floating-label.css" rel="stylesheet">
	<link href="assets/dist/css/pages/easy-pie-chart.css" rel="stylesheet">
    <link href="assets/dist/css/pages/widget-page.css" rel="stylesheet">
	<link href="assets/dist/css/pages/stylish-tooltip.css" rel="stylesheet">
</head>
		<body>
		
	    <div class="page-wrapper">
        <div class="container-fluid">	
		<br>
		<br>
		<center>
		<div class="display-1 text-warning"><b>Not Online</b></div>
		<hr>
			<div class="col-md-12">
                        <div class="card text-white bg-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">غير متصل</h4></div>
                            <div class="card-body">
                                <div class="alert">
									<p class=" push-50 fadeInRightBig animated">.لا تستطيع دخول لوحة التحكم وانت خارج سيرفر التيم سبيك&#8236;&lrm;</p>
									<p class=" push-50 fadeInRightBig animated">Can not use the control panel while outside of Teamspeak 3 server.</p>
									<a class=" push-50 fadeInRightBig animated" href="ts3server://q-z.us/?port=9987"><img src="../assets/join.png" onmouseover="this.src=&quot;../assets/join-active.png&quot;" onmouseout="this.src=&quot;../assets/join.png&quot;" alt=""></a>
								</div>
                            </div>
                        </div>
            </div>
			
			<div class="col-md-12">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="alert">
									<p class=" push-50 fadeInRightBig animated">.في حاله دخول السيرفر اضغط هنا</p>
									<p class=" push-50 fadeInRightBig animated"><a class="btn btn-warning" href="https://panel.q-z.us/">
<i class="fa fa-arrow-left mr-10"></i> اعاده التجربه
</a></p>
									<a class=" push-50 fadeInRightBig animated"> <div class="block-content block-content-full">
<button type="button" class="btn btn-alt-warning" data-toggle="modal" data-target="#modal-fromleft">موجود بالسيرفر بالفعل ؟؟ اضغط هنا ..</button>
</div> </a>
								</div>
                            </div>
                        </div>
            </div>
		
		
		
		
		
		
		
		
		
		</div>
		</div>
		</body>






	<script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/dist/js/waves.js"></script>
    <script src="assets/dist/js/sidebarmenu.js"></script>
	<script src="assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/dist/js/custom.min.js"></script>
    <script src="assets/node_modules/prism/prism.js"></script>
    <script src="assets/node_modules/raphael/raphael-min.js"></script>
   <!--  <script src="assets/node_modules/morrisjs/morris.min.js"></script> -->
    <script src="assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/node_modules/d3/d3.min.js"></script>
    <script src="assets/node_modules/c3-master/c3.min.js"></script>
    <script src="assets/node_modules/toast-master/js/jquery.toast.js"></script>
   <!--  <script src="assets/dist/js/dashboard1.js"></script> -->
	<script src="assets/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
	<script src="assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
    <script src="assets/node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <script src="assets/node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>
	<!-- <script src="assets/node_modules/gauge/gauge.min.js"></script> 
    <script src="assets/dist/js/pages/widget-data.js"></script>-->
</body>


</html>