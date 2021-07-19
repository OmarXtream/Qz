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
		<div class="display-4 text-danger"><b>تم حظرك من الدخول إلى اللوحة</b></div>
		<hr>
			<div class="col-md-12">
                        <div class="card text-white bg-dark">
                            <div class="card-header">
                                <h2>You Are <font color="red">Banned</font> &amp; <font color="red">Blacklisted</font></h2>
							</div>
                            <div class="card-body">
                                <div class="alert alert-success">
<h2>تم حظرك من دخول الموقع , ل أسباب&#8236;&lrm; </h2><h2>
<hr>
<center>
<br>
<font color="red"><font color="red">❖-❖-❖-❖-❖</font></font>
<br>تواصل مع الاداره بالتيم سبيك لمعرفه السبب
<br>
<font color="red"><font color="red">❖-❖-❖-❖-❖</font></font>
<br> </center>
</h2></div>
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