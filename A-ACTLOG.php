<?php 

require 'config/phphead.php';
require 'config/sqlconfig.php';
 
$host = "127.0.0.1";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Failed To Connect To Database!");
}
$xx = $client_info["client_database_id"];
$xz = explode(',', $client_info["client_servergroups"]);
$os = $client_info["client_platform"];
$arrclients = $ts3_VirtualServer->clientList(array("client_type" => 0));

		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}

 ?>		
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
        <div class="page-wrapper">
        <div class="container-fluid">
		<br>

			
						<center> <div class="col-md-6">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title">الاحصائيات</h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>الادمن</th>
                                                <th>عدد التفعيلات</th>
                                            </tr>
                                        </thead>
									<?php
									
										$admins = array();										
											
										
										$sqlz = "SELECT act, status FROM actuser";
										$res3 = $con->query($sqlz);
										$sfact = array();
										
										while($selfact = $res3->fetch_assoc()){
											if($selfact["status"] == 1){ array_push($sfact, $selfact["act"]); }
										}
										
										$sql = "SELECT act FROM actuser";
										$res = $con->query($sql);
										$arr = array();	
										
										while ($all = $res->fetch_assoc()){
											if($all["act"] == 0 || !in_array($all["act"], $sfact)){ continue; }
											// $svg = array_keys($ts3->clientGetServerGroupsByDbid($all["act"]));
											// if(count(array_intersect($svg, $admins)) == 0){ continue; }
											foreach($all as $val) {
												if(empty($val)) {
													continue;
												}
												$arr[$val][] = $val;
											} 
										}
										uksort($arr, function($a, $b) { return count($b) - count($a); });
										foreach($arr as $k => $v) {
											try{
												$admin = $ts3_VirtualServer->clientInfoDb($k)["client_nickname"];			
											}catch(TeamSpeak3_Exception $e){
												continue;
											}
											//$admin = $ts3_VirtualServer->clientInfoDb($k)["client_nickname"];								
											$count = count($v);
											echo "<tr> <td>$admin</td><td>$count</td> </tr>";
										}
									?>										
                                    </table>
                                </div>
                        </div>
					 </div>
            </div></center>

<?php
	$cansee2 = array(14,282,10,84,11);
		if(count(array_intersect($cansee2, $xz)) > 0){
			echo '
			<center>
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title">السجل</h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table dark-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>اسم العضو</th>
                                                <th>داتا بيس العضو</th>
                                                <th>VPN</th>
                                                <th>ip</th>
                                                <th>المفعل</th>
                                                <th>تاريخ التفعيل</th>
                                            </tr>
                                </thead>
								
                                    <tbody>';
											if(isset($_GET["page"]) && $_GET["page"] > 1){
												$numf = $_GET["page"];
												$max = 50;
												$mnext = $numf * $max;
												$sql = "SELECT * FROM actuser ORDER BY id DESC LIMIT $max OFFSET $mnext";
											}else{
												$sql = "SELECT * FROM actuser ORDER BY id DESC LIMIT 50";
												}
											
											$res = $con->query($sql);
											while($data = $res->fetch_assoc()){
												try{
													$user = $ts3_VirtualServer->clientInfoDb($data["cldbid"])["client_nickname"];		
												}catch(TeamSpeak3_Exception $e){
													continue;
												}
												//$user = $ts3_VirtualServer->clientInfoDb($data["cldbid"])["client_nickname"];
												$vpn = $data["vpn"];
												if($vpn == 1){ $vpn = "Yes"; }else{ $vpn = "No"; }
												if($data["cldbid"] == $data["act"]){ // يحذف الاعضاء المفعلين نفسهم
													continue; // يحذف الاعضاء المفعلين نفسهم
													} // يحذف الاعضاء المفعلين نفسهم
												$idx = intval($data["id"]);
												$cldbidR = intval($data["cldbid"]);
												$ip = strval($data["ip"]);
												$acts = $data["act"];
												$stime = $data["sdate"];
												if($acts == 0){ $acts = "غير مفعل"; }else{
													try{
													$acts = $ts3_VirtualServer->clientInfoDb($data["act"])["client_nickname"];
												}catch(TeamSpeak3_Exception $e){
													continue;
												}
													//$acts = $ts3_VirtualServer->clientInfoDb($data["act"])["client_nickname"]; 
													
												}
												$cx = intval($data["cldbid"]);
												
												// $sql = "SELECT inet_ntoa(conv(HEX(`ip`), 16, 10)) AS ip FROM user WHERE cldbid='$cx' LIMIT 1";
												// $ipx = strval($con->query($sql)->fetch_assoc()["ip"]);
												// if($ip !== $ipx){
													// $sqlx = "UPDATE actuser SET ip='$ipx' WHERE id='$idx' LIMIT 1;";
													// $con->query($sqlx);
													// $ip = $ipx;
												// }
												
												if(empty($stime) || $stime == 0 || $stime == ""){ $stime = "غير مفعل"; }
												echo "<tr class='border-bottom-pink border-bottom-darken-2 border-custom-color'> <td class='text-center' style='width: 50px;'>$user</td><td class='text-center' style='width: 50px;'>$cldbidR</td> <td class='text-center' style='width: 50px;'>$vpn</td> <td class='text-center' style='width: 50px;'>$ip</td> <td class='text-center' style='width: 50px;'>$acts</td> <td class='text-center' style='width: 50px;'>$stime</td></tr>";
											}
											
				echo '
                                    </tbody>					
					</table>
				<ul class="pagination">
				<li class="paginate_button page-item '; if($_GET["page"] == 1 || !isset($_GET["page"])){ echo "active"; } echo '"><a href="?page=1" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 2){ echo "active"; } echo '"><a href="?page=2" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 3){ echo "active"; } echo '"><a href="?page=3" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 4){ echo "active"; } echo '"><a href="?page=4" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 5){ echo "active"; } echo '"><a href="?page=5" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 6){ echo "active"; } echo '"><a href="?page=6" aria-controls="DataTables_Table_0" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 7){ echo "active"; } echo '"><a href="?page=7" aria-controls="DataTables_Table_0" data-dt-idx="7" tabindex="0" class="page-link">7</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 8){ echo "active"; } echo '"><a href="?page=8" aria-controls="DataTables_Table_0" data-dt-idx="8" tabindex="0" class="page-link">8</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 9){ echo "active"; } echo '"><a href="?page=9" aria-controls="DataTables_Table_0" data-dt-idx="9" tabindex="0" class="page-link">9</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 10){ echo "active"; } echo '"><a href="?page=10" aria-controls="DataTables_Table_0" data-dt-idx="10" tabindex="0" class="page-link">10</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 11){ echo "active"; } echo '"><a href="?page=11" aria-controls="DataTables_Table_0" data-dt-idx="11" tabindex="0" class="page-link">11</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 12){ echo "active"; } echo '"><a href="?page=12" aria-controls="DataTables_Table_0" data-dt-idx="12" tabindex="0" class="page-link">12</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 13){ echo "active"; } echo '"><a href="?page=13" aria-controls="DataTables_Table_0" data-dt-idx="13" tabindex="0" class="page-link">13</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 14){ echo "active"; } echo '"><a href="?page=14" aria-controls="DataTables_Table_0" data-dt-idx="14" tabindex="0" class="page-link">14</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 15){ echo "active"; } echo '"><a href="?page=15" aria-controls="DataTables_Table_0" data-dt-idx="15" tabindex="0" class="page-link">15</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 16){ echo "active"; } echo '"><a href="?page=16" aria-controls="DataTables_Table_0" data-dt-idx="16" tabindex="0" class="page-link">16</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 17){ echo "active"; } echo '"><a href="?page=17" aria-controls="DataTables_Table_0" data-dt-idx="17" tabindex="0" class="page-link">17</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 18){ echo "active"; } echo '"><a href="?page=18" aria-controls="DataTables_Table_0" data-dt-idx="18" tabindex="0" class="page-link">18</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 19){ echo "active"; } echo '"><a href="?page=19" aria-controls="DataTables_Table_0" data-dt-idx="19" tabindex="0" class="page-link">19</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 20){ echo "active"; } echo '"><a href="?page=20" aria-controls="DataTables_Table_0" data-dt-idx="20" tabindex="0" class="page-link">20</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 21){ echo "active"; } echo '"><a href="?page=21" aria-controls="DataTables_Table_0" data-dt-idx="21" tabindex="0" class="page-link">21</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 22){ echo "active"; } echo '"><a href="?page=22" aria-controls="DataTables_Table_0" data-dt-idx="22" tabindex="0" class="page-link">22</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 23){ echo "active"; } echo '"><a href="?page=23" aria-controls="DataTables_Table_0" data-dt-idx="23" tabindex="0" class="page-link">23</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 24){ echo "active"; } echo '"><a href="?page=24" aria-controls="DataTables_Table_0" data-dt-idx="24" tabindex="0" class="page-link">24</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 25){ echo "active"; } echo '"><a href="?page=25" aria-controls="DataTables_Table_0" data-dt-idx="25" tabindex="0" class="page-link">25</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 26){ echo "active"; } echo '"><a href="?page=26" aria-controls="DataTables_Table_0" data-dt-idx="26" tabindex="0" class="page-link">26</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 27){ echo "active"; } echo '"><a href="?page=27" aria-controls="DataTables_Table_0" data-dt-idx="27" tabindex="0" class="page-link">27</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 28){ echo "active"; } echo '"><a href="?page=28" aria-controls="DataTables_Table_0" data-dt-idx="28" tabindex="0" class="page-link">28</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 29){ echo "active"; } echo '"><a href="?page=29" aria-controls="DataTables_Table_0" data-dt-idx="29" tabindex="0" class="page-link">29</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 30){ echo "active"; } echo '"><a href="?page=30" aria-controls="DataTables_Table_0" data-dt-idx="30" tabindex="0" class="page-link">30</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 31){ echo "active"; } echo '"><a href="?page=31" aria-controls="DataTables_Table_0" data-dt-idx="31" tabindex="0" class="page-link">31</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 32){ echo "active"; } echo '"><a href="?page=32" aria-controls="DataTables_Table_0" data-dt-idx="32" tabindex="0" class="page-link">32</a></li>
				<li class="paginate_button page-item '; if($_GET["page"] == 33){ echo "active"; } echo '"><a href="?page=33" aria-controls="DataTables_Table_0" data-dt-idx="33" tabindex="0" class="page-link">33</a></li>

				</ul>	
				</div>
			</div>
</center>	
				';
		}
?>
				
		
		
		
		
		
		
		
		</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>