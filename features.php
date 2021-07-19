<?php require 'config/phphead.php'; ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">
            <div class="container-fluid">
<br>
<?php 
if(isset($_POST['add'])){

// منع الاسبام
if(isset($_SESSION['Ad_G']) and $_SESSION['Ad_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=features.php"> 
';
die;
}else{
	$_SESSION['Ad_G'] = microtime(true)+5;
}	
// منع الاسبام

// تم التفعيل
echo '<center>';

						  echo '<div class="alert dark alert-alt alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">تم تفعيل الايقونه</a>.<br><strong>
						</div>';

echo '</center>'; 
// تم التفعيل
	
				if($_SESSION['hisgames'] >= 1){
							echo'<div class="alert alert-danger alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         <strong>عذراً!</strong> لأ يمكنك اضافه اكثر من ايقونه</center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=features.php"> ';
						}else{	
$game = $_POST['idgame'];
if(in_array($game,$icon_VIP1_ids)){
$ts3_VirtualServer->clientGetByUid($uid)->addservergroup($game);
}
		}

}
if(isset($_POST['rm'])){

// منع الاسبام
if(isset($_SESSION['Rd_G']) and $_SESSION['Rd_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=features.php"> 
';
die;
}else{
	$_SESSION['Rd_G'] = microtime(true)+5;
}	

// منع الاسبام
	
// تم التعطيل	
echo '<center>';

						  echo '<div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">تم حذف الايقونه</a>.<br><strong>
						</div>';

echo '</center>';
// تم التعطيل	

$game = $_POST['idgame'];
if(in_array($game,$icon_VIP1_ids)){

$ts3_VirtualServer->clientGetByDbid($dbid)->remservergroup($game);
	}

}
?>
			
			
<?php 
if(isset($_POST['addanddos'])){

// منع الاسبام
if(isset($_SESSION['Ad_G']) and $_SESSION['Ad_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=features.php"> 
';
die;
}else{
	$_SESSION['Ad_G'] = microtime(true)+5;
}	
// منع الاسبام

// تم التفعيل
echo '<center>';

						  echo '<div class="alert dark alert-alt alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">تم تفعيل الخاصيه</a>.<br><strong>
						</div>';

echo '</center>'; 
// تم التفعيل
	
				if($_SESSION['hisanddos'] >= 5){
							echo'<div class="alert alert-danger alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         <strong>عذراً!</strong> لأ يمكنك اضافه اكثر من 4 خصائص</center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=features.php">';
						}else{	
$anddos = $_POST['idanddos'];
if(in_array($anddos,$anddos_user_Addos)){
$ts3_VirtualServer->clientGetByUid($uid)->addservergroup($anddos);
}
		}

}
if(isset($_POST['rmanddos'])){

// منع الاسبام
if(isset($_SESSION['Rd_G']) and $_SESSION['Rd_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بذالك العمليه قبل , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
								 <META HTTP-EQUIV="Refresh" CONTENT="2;URL=features.php"> 
';
die;
}else{
	$_SESSION['Rd_G'] = microtime(true)+5;
}	

// منع الاسبام
	
// تم التعطيل	
echo '<center>';

						  echo '<div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)">تم حذف الخاصيه</a>.<br><strong>
						</div>';

echo '</center>';
// تم التعطيل	

$anddos = $_POST['idanddos'];
if(in_array($anddos,$anddos_user_Addos)){

$ts3_VirtualServer->clientGetByDbid($dbid)->remservergroup($anddos);
	}

}
?>
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
                if(in_array($group["sgid"], $anddos_user_Addos)) {
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
					$anddos = $group["id"];
					$anddosname = $group["name"];
					$players = CountClientsGroup($anddos);
				    $icon_image = '<img src="image/'.$anddos.'.png"></img> ';
					

                if($estaengrupo) {
                     $iconosm++;			
			// Here Add 
echo'
			<div class="col-md-4">
                        <center> <div class="card border-success">
                            <div class="card-header bg-success">
                                <h4 class="m-b-0 text-white"> '.$anddosname.'</h4></div>
                            <div class="card-body">
								<img  class="img-circle" width="100" height="100" '.$icon_image.'
								<hr>
                                <span class="badge badge-success">مفعل</span>
								<hr>
								
                                      <form method="post">
  <input type="hidden" name="idanddos" value="'.$anddos.'">
<input type="submit" name="rmanddos" value="ازالة" title="اضغط ل تفعيل الخاصية" class="btn mr-1 mb-1 btn-outline-danger">
                  </form> 										
                            </div>
                        </div>
						</center>
            </div>	
			
';
                } else {
//Here Remove
			echo'
			
			<div class="col-md-4">
                        <center> <div class="card border-warning">
                            <div class="card-header bg-warning">
                                <h4 class="m-b-0 text-white"> '.$anddosname.'</h4></div>
                            <div class="card-body">
								<img  class="img-circle" width="100" height="100" '.$icon_image.'
								<hr>
                                <span class="badge badge-warning">غير مفعل</span>
								<hr>
								
                                      <form method="post">
  <input type="hidden" name="idanddos" value="'.$anddos.'">
<input type="submit" name="addanddos" value="أضافه" title="اضغط ل تفعيل الخاصية" class="btn mr-1 mb-1 btn-outline-success">
                  </form> 										
                            </div>
                        </div>
						</center>
            </div>			
			
		
';

                }
			}
			
 $_SESSION['hisanddos'] = $iconosm;

?>				
                </div>
            </div>
        </div>
<?php require_once('includes/footer.php'); ?>