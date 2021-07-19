<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php require 'config/sqlconfig.php'; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
			<br>
			<br>
<div class="row">

					<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> أعلى النقاط </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الترتيب</th>
                                                <th>الاسم</th>
                                                <th>الحاله</th>
                                                <th>عدد النقاط</th>
                                            </tr>
                                        </thead>
                          <?php
							$sql = "SELECT * FROM user ORDER BY coins DESC LIMIT 100";
							$res = $con->query($sql);
							if($res->num_rows > 0){
								$i = 0;
								while($data = $res->fetch_assoc()){
									$owner = $data["cldbid"];
									
									$points = ceil(intval($data["coins"]));
									$i++;
									$onb = "<span class='badge badge-success'>متصل</span>";
									try{
										$ownernick = (htmlspecialchars(stripslashes(strip_tags($ts3_VirtualServer->clientInfoDb($owner)["client_nickname"]))));
										$ts3->clientGetByDbid($data["cldbid"]);
									}catch(Exception $e){
										$onb = "<span class='badge badge-danger'>غير متصل</span>";
									}
									echo "<tr> 
									<td>$i</td>
									<td>$ownernick</td>
									<td>$onb</td>
									<td><span class='badge badge-info'>$points</span></td>
									</tr>";
								}
							}else{
								echo "<tr>  <td>-- -- --</td> <td>-- -- --</td> <td>-- -- --</td> <td>-- -- --</td></tr>";
							}
						  ?>										
                                    </table>
                                </div>
                        </div>
					 </div>
                    </div>

				</div>
			</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>