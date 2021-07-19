<?php
die();
 require 'config/phphead.php'; ?>

<?php 
require 'handler.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
$xz = explode(',', $client_info["client_servergroups"]);
		if(!count(array_intersect($Profile_Register, $xz)) > 0){
			}else 
				
			die ('<script>
           swal({
            title: "خطا",
            text: "انت محظور من دخول هذه الصفحة",
            type: "error",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/index.php");
            }else {
              window.location.replace("https://panel.q-z.us/index.php");
            }
          })
           </script>');	
		   
   $my_name = getDBIDUserName ( $client_verified["client_database_id"] );
                                     $my_uid = $client_verified["client_unique_identifier"];
                                    if ( isset ( $my_name ) && $my_name !== false){
                                         $my_scmts = $cloud_sql->query("SELECT * FROM $dbname.Profile_Comments WHERE Commented_UID='$my_uid' AND status=0")->fetchAll();
                                        $echo_this = "profile/".$my_name;
                                        	die ('<script>
           swal({
            title: "خطا",
            text: "يوجد لديك معروف !!",
            type: "error",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCloseButton: false,
			confirmButtonText: "حسنأ",
          }).then((result) => {
            if (result.value) {
              window.location.replace("https://panel.q-z.us/index.php");
            }else {
              window.location.replace("https://panel.q-z.us/index.php");
            }
          })
           </script>');	
                                    }else{
                                        echo '';                                 
                                    }		   
 ?>		
        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
			<br>
			<br>
			<br>
<!-- small card -->
<!-- center card -->

		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-cyan ">
                               <center> <h4 class="m-b-0 text-white">حجز أسم المعرف الخاص بالملف الشخصي</h4> </center>
								</div>
							<div class="card-body">
								<form class="form-horizontal">
									<div class="form-group">
									<div class="col-md-12" style="padding-left: 100px; padding-right: 100px;">
									<input class="form-control" id="NickNameForm" name="NickNameForm" placeholder="النك نيم المراد حجزه" style="text-align: center;" type="text">
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-7">
									<button class="btn btn-sm btn-cyan" type="button" onclick="register();"><font face="Hcdd">تكوين الملف الشخصي</font></button>
									</div>
									</div>
								</form>		

							</div>
						</div>
			</div> </center>


			</div>
        </div>
        <script>function register(){$.post("handler",{NickNameRegister:$("input[type='text'][name='NickNameForm']").val()},
            function(response,status){
                if (response == 'success'){
                    swal(
                      'تم حجز المعرف',
                      '',
                      'success'
                    )
                }else if (response == 'used'){
                    swal(
                      'هذا الإسم محجوز',
                      '',
                      'error'
                    )
                }else if (response == 'already'){
                    swal(
                      'لديك أسم محجوز بالفعل',
                      '',
                      'error'
                    )
                }else if (response == 'user'){
                    swal(
                      'حدث خطأ',
                      'يجب أن يكون الأسم مابين 3 إلى 12 أحرف , وأن يكون إنجليزي',
                      'error'
                    )
                }else{
                    swal(
                      'يرجى تحديث الصفحة وإعادة المحاوله',
                      '',
                      'error'
                    )
                }
                ;}
            );}
        </script>		
<?php require_once('includes/footer.php'); ?>