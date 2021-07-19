<?php
	require 'config/phphead.php';
	require 'config/sqlconfig.php';

	require_once('includes/header2.php');
	require_once('includes/topbar.php');
	require_once('includes/sidebar.php');
?>
        <div class="container-fluid">
		</br>
		</br>
		</br>
<div class="page-wrapper">
<center>
<div class="col-md-8">
	<div class="container-fluid">
	<div class="card text-center">
                            <div class="card-header">
                                التحكم ببوت الفعاليات
                            </div>
                            <div class="card-body">
							<h5>حالة البوت : <span class="badge badge-success">متصل</span>
							<center>
							<br>
							<div class="col-lg-2 col-md-4">
                                        <button type="button" class="btn waves-effect waves-light btn-block btn-danger">قفل البوت</button>
                                    </div>	
							<br>

							حالة البوت : <span class="badge badge-danger">غير متصل</span>
							<br><br>
							<div class="col-lg-2 col-md-4">
                                        <button type="button" class="btn waves-effect waves-light btn-block btn-success">تشغيل البوت</button>
                                    </div></center>
							</h5>
								<hr>
							<h4 class="card-title">التحكم بالبوت</h4>
				<form method="post" class="form-inline text-center" role="form">
									<label for="nick">الاسم: </label> &nbsp;&nbsp;
									<input type="text" class="form-control input-lg" name="nick" id="nick" required> &nbsp;&nbsp;
									<div class="col-lg-2 col-md-4">
                                        <button type="button" class="btn btn-block btn-outline-info">تحديث الاسم</button>
                                    </div>
				</form> 
				<hr>
								<form method="post" class="form-inline text-center" role="form">
									<label for="nick">تحميل اغنية يوتيوب: </label> &nbsp;&nbsp;
									<input type="text" class="form-control input-lg" name="nick" id="nick" required> &nbsp;&nbsp;
									<div class="col-lg-2 col-md-4">
                                        <button type="button" class="btn btn-block btn-outline-info">تحميل الان</button>
								</div>	
				</form> 
				<hr>
								<form method="post" class="form-inline text-center" role="form">
									<label for="nick">تعديل الصوت: </label> &nbsp;&nbsp;
									<input type="text" class="form-control input-lg" name="nick" id="nick" required> &nbsp;&nbsp;
									<div class="col-lg-2 col-md-4">
                                        <button type="button" class="btn btn-block btn-outline-info">تعديل الان</button>
								</div>	
				</form> 
                            </div>
                            <div class="card-footer text-muted">
                                NEWWW
                            </div>
		</div>
	</div>
	</div>
	</center>
</div>
</div>
		
<?php require_once('includes/footer.php'); ?>