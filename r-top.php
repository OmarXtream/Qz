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
                               <center> <h3 class="card-title">أفضل 5 رومات</h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table info-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>أسم الروم</th>
                                                <th>صاحب الروم</th>
                                                <th>عدد الأعضاء</th>
                                                <th>النقاط</th>
                                                <th>أخر تفاعل</th>
                                            </tr>
                                        </thead>
                          <?php
							function agoz($mtime){
							$xtime = $mtime;

							if ($xtime < 1)
							{
								return 'الأن';
							}

							$a = array( 12 * 30 * 24 * 60 * 60  =>  'سنين',
										30 * 24 * 60 * 60       =>  'شهور',
										24 * 60 * 60            =>  'أيام',
										60 * 60                 =>  'ساعة',
										60                      =>  'دقائق',
										1                       =>  'ثوانى'
										);

							foreach ($a as $secs => $str)
							{
								$d = $xtime / $secs;
								if ($d >= 1)
								{
									$r = round($d);
									return 'منذ '.$r . ' ' . $str . ($r > 1 ? '' : '');
								}
							}}
							$sql = "SELECT * FROM roomz WHERE blocked='0' ORDER BY points DESC LIMIT 5";
							$res = $con->query($sql);
							if($res->num_rows <= 0){
								echo "<tr> <td>$i</td> <td>- - - -</td> <td>- - - -</td> <td>- - - -</td> <td>- - - -</td> </tr>";
							}else{
								// $colors = array(1 => "bg-info", 2 => "bg-warning", 3 => "bg-active active", 4 => "bg-danger", 5 => "bg-success");
								$i = 0;
								while($data = $res->fetch_assoc()){
									$idz = $data["id"];
									$owner = $data["owner"];
									$room = $data["room"];
									$points = ceil(intval($data["points"]));
									try {
										$ownernick = htmlspecialchars($ts3_VirtualServer->clientInfoDb($owner)["client_nickname"]);
										$chz = $ts3_VirtualServer->channelGetById($room);
										$roomnick = $chz["channel_name"];
										$roomt = intval($chz["total_clients"]);
										$rem = agoz($chz["seconds_empty"]);
									}catch (Exception $e){}
									$i++;
									echo "<tr class='".$colors[$i]."'> <td>$i</td> <td>$roomnick</td> <td>$ownernick</td> <td>$roomt</td> <td>$points</td> <td>$rem</td></tr>";
								}
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