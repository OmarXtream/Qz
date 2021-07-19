<a title="web analytics" href="http://statcounter.com/"
target="_blank"><img
src="//c.statcounter.com/11437337/0/7bc5821d/1/" alt="web
analytics" style="border:none;"></a>
        <!-- footer -->
			<footer class="footer">
				<center>
					<span><img src="assets/images/logo2.png" alt="Qz Control Panel"></span>
				<center>  <a href="#" target="_blank">Qz Developer 2018 ©</a></center>					
				</center>
			</footer>
			<!-- End footer -->
		</div>
    <!-- End Wrapper -->
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
	<script src="assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
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