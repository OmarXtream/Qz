<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
    <div class="page-wrapper">
        <div class="container-fluid">
<?php 
if(isset($_POST['icons'])){

// منع الاسبام
if(isset($_SESSION['Ad_G']) and $_SESSION['Ad_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=icons.php"> 
';
die;
}else{
	$_SESSION['Ad_G'] = microtime(true)+5;
}	
// منع الاسبام
				$protc = false;
				$gzid = explode(",", $client_verified["client_servergroups"]);
				if(count(array_intersect($gzid, $icon_groups_ids)) >= 2){
					$protc = true;
				}
				if($_SESSION['hisgames'] >= 2 || $protc === true){
							echo'
							<center><div class="alert dark alert-alt alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">لأ يمكنك اختيار اكثر من ايقونتين</a>.<br><strong>
						</div></center> ';
						
						}else{	
$game = $_POST['idgame'];
if(in_array($game,$icon_groups_ids)){
$ts3_VirtualServer->clientGetByUid($uid)->addservergroup($game);
// تم التفعيل


						  echo '<center><div class="alert dark alert-alt alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">تم تفعيل الايقونه</a>.<br><strong>
						</div></center>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=icons.php"> 
						';
// تم التفعيل
}
		}

}
if(isset($_POST['ricons'])){

// منع الاسبام
if(isset($_SESSION['Rd_C']) and $_SESSION['Rd_C'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=icons.php"> 
';
die;
}else{
	$_SESSION['Rd_C'] = microtime(true)+5;
}	

// منع الاسبام
	
// تم التعطيل	
echo '<center>';

						  echo '<div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">تم حذف الايقونه</a>.<br><strong>
						</div>
						<META HTTP-EQUIV="Refresh" CONTENT="2;URL=icons.php"> 
						';

echo '</center>';
// تم التعطيل	

$game = $_POST['idgame'];
if(in_array($game,$icon_groups_ids)){

$ts3_VirtualServer->clientGetByDbid($dbid)->remservergroup($game);
	}

}
?>		
			<br>
		<div class="row">
<?php 
function CountClientsGroup($sgroup) {
global $ts3_VirtualServer;
$servergroup = $ts3_VirtualServer->serverGroupClientList($sgroup);
foreach ($servergroup as $group) {
$result[] = array($group['client_nickname'], $group['client_unique_identifier']); 
}
return count($result);
}
            $iconosm = 0;
            
            $server_groups = $ts3_VirtualServer->serverGroupList();
            $servergroups = array();
            foreach($server_groups as $group) {
                if($group->type != 1) { continue; }
                if(in_array($group["sgid"], $icon_groups_ids)) {
                    $servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type);
                }
            } 
			$_SESSION['grupos'] = $servergroups;
        
            foreach($servergroups as $group) {      
                
                $miembros = $ts3_VirtualServer->serverGroupClientList($group["id"]);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $uid) { 
                        $estaengrupo = True;
                    }                                   
                }
					$gameid = $group["id"];
					$gamename = $group["name"];
					$players = CountClientsGroup($gameid);
				    $icon_image = '<img src="image/'.$gameid.'.png"></img> ';
					

                if($estaengrupo) {
                     $iconosm++;			
			// Here Add 
echo'
			<div class="col-md-4">
                        <center> <div class="card border-success">
                            <div class="card-header bg-success">
                                <h4 class="m-b-0 text-white">'.$gamename.'</h4></div>
                            <div class="card-body">
								<img  class="img-circle" width="100" height="100" '.$icon_image.'
								<hr>
                                <span class="badge badge-success">مفعل</span>
								<hr>
                                      <form method="post">
								  <input type="hidden" name="idgame" value="'.$gameid.'">	  
											<input type="submit" name="ricons" value="أزالة الايقونة" title="اضافه الايقونه" class="btn mr-1 mb-1 btn-outline-danger">
                  </form> 								
							</div>
                        </div>
						</center>
            </div>';
                } else {
//Here Remove
			echo'
			<div class="col-md-4">
                        <center> <div class="card border-warning">
                            <div class="card-header bg-warning">
                                <h4 class="m-b-0 text-white">'.$gamename.'</h4></div>
                            <div class="card-body">
								<img  class="img-circle" width="100" height="100" '.$icon_image.'
								<hr>
                                <span class="badge badge-warning">غير مفعل</span>
								<hr>
                                      <form method="post">
								  <input type="hidden" name="idgame" value="'.$gameid.'">	  
											<input type="submit" name="icons" value="اضافه الايقونه" title="اضافه الايقونه" class="btn mr-1 mb-1 btn-outline-success">
                  </form> 								
							</div>
                        </div>
						</center>
            </div>			
			';

                }
			}
			
 $_SESSION['hisgames'] = $iconosm;

?>		
					
					
					
					
					
        </div>
			
			
		</div>
    </div>
		
<?php require_once('includes/footer.php'); ?>