<?php
function getclientip() {
	if (!empty($_SERVER['Cf-Connecting-IP']))
		return $_SERVER['Cf-Connecting-IP'];
	else if(!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(!empty($_SERVER['HTTP_X_FORWARDED']))
		return $_SERVER['HTTP_X_FORWARDED'];
	else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
		return $_SERVER['HTTP_FORWARDED_FOR'];
	else if(!empty($_SERVER['HTTP_FORWARDED']))
		return $_SERVER['HTTP_FORWARDED'];
	else if(!empty($_SERVER['REMOTE_ADDR']))
		return $_SERVER['REMOTE_ADDR'];
	else
		die("Failed TO Connect");
}

$x = strval(getclientip());
if(!filter_var($x, FILTER_VALIDATE_IP)){
	die("Failed TO Connect");
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "qvaGN6vy9EaZMw5l";
$dbname = "test";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($con->connect_error){
	die("Failed TO COnnect to database: ".$con->connect_error);
}

	$sql = "SELECT * FROM attack WHERE ip='$x'";
	$res = $con->query($sql);
	$now = time();
	if($res->num_rows === 1){
		$data = $res->fetch_assoc();
		$nums = intval($data["nums"]);
		$last = intval($data["last"]);
		$warn = intval($data["warn"]);
		$ban = intval($data["ban"]);
		$diff = abs($last - $now);
		$banz = strtotime("+10 minutes"); // عدد دقائق البان
		
		if($ban !== 0){
			$bdiff = $ban - $now;
			if($bdiff <= 1){
				$sql = "UPDATE attack SET ban='0' WHERE ip='$x'";
				$con->query($sql);
				header("Location: index.php");
			}else{
				 require 'includes/sweetalert.php'; 
				die('<script>
			   swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة - You were banned from Panel because of spam ,('.$bdiff.' Second) ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
			}
			
		}else if($warn >= 3){  // عدد التحذيرات
			
			$sql = "UPDATE attack SET warn='0', ban='$banz' WHERE ip='$x'";
			$con->query($sql);
			require 'includes/sweetalert.php'; 

			die('<script>
			   swal({title: "تم تبنيدك",text: "تم تبنيدك من اللوحة بسبب السبام لمدة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>'); // رسالة البان
		}
		if($diff <= 1 && $nums > 4){
			$warn = $warn +1;
			$sql = "UPDATE attack SET warn='$warn' WHERE ip='$x'";
			$con->query($sql);
			 require 'includes/sweetalert.php'; 

			die('<script>
			   swal({title: "تم اكتشاف",text: "محاولات عديدة من السبام ان تم تكريرها سوف يتم تبنيدك لمدة من اللوحة",type: "info",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');  // رسالة التحذير
		}else if($nums < 5){
			$nums = $nums + 1;
			$sql = "UPDATE attack SET nums='$nums', last='$now' WHERE ip='$x'";
			if($con->query($sql) === false){ die("Failed To Insert!"); }
		}else{
			$nums = 0;
			$sql = "UPDATE attack SET nums='$nums', last='$now' WHERE ip='$x'";
			if($con->query($sql) === false){ die("Failed To Insert!"); }
		}
		
	}else if($res->num_rows <= 0){
		$sql = "INSERT INTO attack (id, ip, nums, last, warn, ban) VALUES (NULL, '$x', '1', '$now', '0', '0')";
		if($con->query($sql) === false){
			 require 'includes/sweetalert.php'; 
			die("Failed TO Insert!");
		}
	}

session_start();

require_once ("TeamSpeak3/TeamSpeak3.php");
require_once ("function.php");
$Query_username = "serveradmin";
$Query_password = "vlQlZunI";
$Query_host = "193.70.17.6";
$Query_port = 10011;
$Server_port = 9987;
$botname = 'Qz-Panel['. mt_rand(0, 100).']';

 $db['type']="mysql";
    $db['host']="localhost";
    $db['user']="root";
    $db['pass']="qvaGN6vy9EaZMw5l";
    $dbname = "simple";
    $dbname2 = "simple";
    $dbname3 = "Rankqz";	
    if ($db['type'] == 'mysql') {
        $dboptions = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true
        );
    } else {
        $dboptions = array();
    }

    $dbserver  = $db['type'].':host='.$db['host'].';';

    try {
        $mysqlcon = new PDO($dbserver, $db['user'], $db['pass'], $dboptions);
    } catch (PDOException $e) {
        $sqlconerr = "ERROR cfg #97 - Please Contact Administrators.";
        echo $sqlconerr;
        exit;
    }


    try {
        $cloud_sql = new PDO('mysql:host=localhost;', 'root', 'qvaGN6vy9EaZMw5l',
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_PERSISTENT => true
            )
        );
    } catch (PDOException $e) {
        $sqlconerr = "ERROR cfg #106 - Please Contact Administrators.";
        echo $sqlconerr;
        exit;
    }

function getDBIDUserName ( $my_dbid ){
	if ( isset ( $my_dbid ) ){
		global $mysqlcon, $dbname;
		$my_dbid = intval(htmlspecialchars(stripslashes(strip_tags($my_dbid))));
		$sql = "SELECT * FROM $dbname.Users WHERE DBID = ?";
		$smt = $mysqlcon->prepare($sql);
		$smt->execute(array($my_dbid));
		$UserInfo = $smt->fetchAll();
		if ( $sql !== false and isset ( $UserInfo[0]['user'] ) ){
			return $UserInfo[0]['user'];
		}else{
			return false;
		}
	}
	return false;
}

$sql = "SELECT val FROM `Rankqz`.`stats` WHERE prop='panelopen' LIMIT 1";
$res = $con->query($sql);
$valx = intval($res->fetch_assoc()["val"]);
if($valx === 0){
require 'includes/header.php'; 
	
	die(' 
<div id="page-container" class="main-content-boxed side-trans-enabled">
<main id="main-container" style="min-height: 467px;">

<div class="hero bg-white bg-pattern" style="background-image: url(http://www.pptgrounds.com/wp-content/uploads/2012/08/Under-construction-Powerpoint-Backgrounds-PPT.jpg);">	
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		<br>
		<center>
		<h1><p class=" push-50 fadeInRightBig animated text-warning"><b>اللوحة تحت الصيانة المؤقته</b></p></h1>
		<hr>
			<div class="col-md-12">
                        <div class="card text-white bg-warning">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">اللوحة تحت الصيانة المؤقته</h4></div>
                            <div class="card-body">
                                <div class="alert">
									<h1><p class=" push-50 fadeInRightBig animated">نعتذر علي ازعاجكم اللوحه تحت التطوير والصيانه</p>
									<p class=" push-50 fadeInRightBig animated">Sorry, the Panel right know is on maintenance mode!</p></h1>
								</div>
                            </div>
                        </div>
								<br>

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		<br>
		<br>
	
            </div>
			
			
		
		
		
	

</main>
</div>
	');
}

try {
$result = array();
$verfied = 0;
$_SESSION['verfied'] = 0;
 
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
$ts3 = $ts3_VirtualServer;

//------------------------------------------------------------------------//
if(isset($_SESSION['userone']) == 1){
foreach($ts3->clientList() as $client) {
if($client['client_unique_identifier'] == $_SESSION['ci']) {
		
$verfied++;
$client_info = $client;	
$result[] = $client->client_nickname;
$client_verified = $client;
$nicknames[] = $client["client_nickname"];
$nickname = $client["client_nickname"];
$description = $client["client_description"];
$totalconnections = $client["client_totalconnections"];
$platform = $client["client_platform"];
$country = strtolower($client["client_country"]);
$_SESSION ['ggids'] = explode(",", $client_verified["client_servergroups"]);
$dbid = $client["client_database_id"];
$uid = $client["client_unique_identifier"];
$ggids = explode(",", $client["client_servergroups"]);
$clients_online = $ts3_VirtualServer["virtualserver_clientsonline"];
$r = explode(',',$client["client_servergroups"]);
$move = $ts3_VirtualServer->clientGetByDbid($dbid);
$poke = $ts3_VirtualServer->clientGetByDbid($dbid);
$clid = $client["clid"];
$client_db = $dbid;
$ts3_Client = $ts3_VirtualServer->ClientGetByUid($uid);
$_SESSION['verfied'] = $verfied;

}
}
}else{	
foreach($ts3_VirtualServer->clientList() as $client) {
if(getclientip() == $client['connection_client_ip']) {
$verfied++;
$client_info = $client;	
$result[] = $client->client_nickname;
$client_verified = $client;
$nicknames[] = $client["client_nickname"];
$nickname = $client["client_nickname"];
$_SESSION ['nkiv'] = $nickname ;
$description = $client["client_description"];
$totalconnections = $client["client_totalconnections"];
$platform = $client["client_platform"];
$country = strtolower($client["client_country"]);
$_SESSION ['ggids'] = explode(",", $client_verified["client_servergroups"]);
$dbid = $client["client_database_id"];
$uid = $client["client_unique_identifier"];
$ggids = explode(",", $client["client_servergroups"]);
$clients_online = $ts3_VirtualServer["virtualserver_clientsonline"];
$r = explode(',',$client["client_servergroups"]);
$move = $ts3_VirtualServer->clientGetByDbid($dbid);
$poke = $ts3_VirtualServer->clientGetByDbid($dbid);
$clid = $client["clid"];
$client_db = $dbid;
$_SESSION['verfied'] = $verfied;
$count = $ts3_VirtualServer->getProperty("virtualserver_clientsonline");
$max = $ts3_VirtualServer->getProperty("virtualserver_maxclients");
$status = $ts3_VirtualServer->getProperty("virtualserver_status");
$servername = $ts3_VirtualServer->getProperty("virtualserver_name");
$time = $ts3_VirtualServer->getProperty("virtualserver_uptime");
$unid = $client_info["client_unique_identifier"];
$timeup = TeamSpeak3_Helper_Convert::seconds($ts3_VirtualServer->virtualserver_uptime);
$port = $ts3_VirtualServer->getProperty("virtualserver_port");
                                                $ts3_Client = $ts3_VirtualServer->ClientGetByUid($uid);
}
}
}
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
//------------------------------------------------------------------------//				
if($verfied == "0"){
// مش موجود بالتيم سبيك
{
	require 'includes/header.php'; 
		die('
		
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
<button type="button" class="btn btn-alt-warning" data-toggle="modal" data-target="#modal-fromleft">موجود بالسيرفر بالفعل ؟؟قم بي اغلاق IP6 واعد المحاولة ..</button>
</div> </a>
								</div>
                            </div>
                        </div>
            </div>
		
		
		
		
		
		
		
		
		
		</div>
		</div>
<center>
<div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" class=" push-50 animated fadeInUp">Server Status</h3>
                        </div>
                        <div class="block-content">
                            <table class="table table-sm table-vcenter">
                                <thead class="thead-default">
											  <th class=" push-50 animated fadeInUp" class="text-center" style="width: 50px;">Name</th>
											  <th class=" push-50 animated fadeInUp" class="text-center" style="width: 50px;">Status</th>
											  <th class=" push-50 animated fadeInUp" class="text-center" style="width: 50px;">Uptime</th>
											  <th class=" push-50 animated fadeInUp" class="text-center" style="width: 50px;">Clients Online</th>
											  <th class=" push-50 animated fadeInUp" class="text-center" style="width: 50px;">Network Port</th>
                                </thead>
												</tr>
											<tr class="table-info">
											  <td class=" push-50 animated fadeInUp" class="text-center" style="width: 1px;">'.  $ts3_VirtualServer->getProperty("virtualserver_name")  .'</td>
											  <td class=" push-50 animated fadeInUp" class="text-center" style="width: 1px;"><font color="green">'.  $ts3_VirtualServer->getProperty("virtualserver_status").'</font></td>
											  <td class=" push-50 animated fadeInUp" class="text-center" style="width: 1px;"> '.  TeamSpeak3_Helper_Convert::seconds($ts3_VirtualServer->virtualserver_uptime) .'</td>
											  <td class=" push-50 animated fadeInUp" class="text-center" style="width: 1px;"> '.  $ts3_VirtualServer->getProperty("virtualserver_clientsonline") .'</td>
											  <td class=" push-50 animated fadeInUp" class="text-center" style="width: 1px;"> '.  $ts3_VirtualServer->getProperty("virtualserver_port") .'</td>
											</tr>							
                            </table>
                        </div>
                    </div>

						
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
		<center>
        <div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-info">
                            <h3 class="block-title">حل مشكله عدم فتح اللوحه</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
											<h5> السلأأم عليكم ورحمه الله وبركاته</h5>
											<p>حل مشكله عدم الدخول للوحه وانت بالفعل موجود بالسيرفر تابع الصور وبتظبط معك ان شاء الله</p>
											<p><img src="https://i.imgur.com/LebJsja.png"></p>
											<p>
اذهب الي لوحه التحكم ومن ثم الشبكه والانترنت

<hr>
</p>											
											<p><img src="https://i.imgur.com/dw9zSz7.png"></p>
											<p>ومن ثم اختار مركز الشبكة والمشاركة 

<hr>
</p>												
											<p><img src="https://i.imgur.com/UCaLFjH.png"></p>
											<p>
ومن ثم اضغط علي اسم الشبكه وبطلع لك لوحه وتابع ..

<hr>

</p>												
											<p><img src="https://i.imgur.com/GMGXbY2.png"></p>
											<p> 
اضغط علي خصائص 

<hr>

</p>												
											<p><img src="https://i.imgur.com/JxaMC2B.png"></p>
											<p>
ثم ابحث عن الكلام الي موجهه عليه السهم وشيل من عليه علامه الصح 

<hr>
</p>												
											<p><img src="https://i.imgur.com/wRIeh2r.png"></p>	
											<p>خلها مثل هالصوره واضغط موافق 

وان شاء الله بتشتغل معاك اللوحه 100%
</p>												
											<hr>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                            <i class="fa fa-check"></i> تم
                        </button>
                    </div>
                </div>
            </div>
        </div>	
		</center>');

}
       }

$filename = $_SERVER['PHP_SELF'];
$homename = 'usertow';

if(!isset($_SESSION['userone']) and $_SESSION['verfied'] > 1 and !stristr($filename,$homename)){
	echo'<meta http-equiv="refresh" content="0; url=./usertow.php" />';
	die;
}

$multi = 860;	

if(in_array($multi,$_SESSION['ggids'])){
	echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=activated.php">  ';
	die; 
} 
				
//------------------------------------------------------------------------//
// التفعيل من اللوحه
if(in_array($act,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=activated.php">  ';
	die; 
 } else 
	 
//------------------------------------------------------------------------//
// التفعيل من اللوحه
if(in_array($notact,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=activated.php">  ';
	die; 
 } else 
	 
//------------------------------------------------------------------------//
// التفعيل من اللوحه
if(in_array($nnotact,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=activated.php">  ';
	die; 
 } else 
	 
//------------------------------------------------------------------------//
// التفعيل من اللوحه
if(in_array($NeedVerifiedPanel,$_SESSION['ggids'])){
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=activated.php">  ';
	die; 
 } else 
	 
//------------------------------------------------------------------------//
// باند من اللوحه	 
if(in_array($banad,$_SESSION['ggids'])){
require 'includes/header.php'; 
		echo '
		
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

</html>';
	die;
        } else 				
//------------------------------------------------------------------------//
// سجن 
if(in_array($jailhead,$_SESSION['ggids'])){
require 'includes/header.php'; 
		echo '
		
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

</html>';
	die;
        } else 
if(in_array($jailhead2,$_SESSION['ggids'])){
require 'includes/header.php'; 
		echo '
		
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

</html>';
	die;
} 				

?>