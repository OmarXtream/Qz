<?php 
require 'config/phphead.php';
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

$reqlink = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(endsWith($reqlink, "/")){
	exit(header("Location: https://panel.q-z.us/games"));
	die;
}

 ?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">	

            <div class="container-fluid">
<br>
<div class="row el-element-overlay">
<?php 

if (isset($_POST['newgame']))
{
$newgame = $_POST['newgame'];
if(in_array($newgame,$game_groups_ids)){

$ts3->serverGroupClientAdd($newgame, $client_db);
$newgamename = $ts3->serverGroupGetById($newgame);
$switchon = 1;
}
}

if (isset($_POST['add'])) {
    //  
        $game = $_POST['idgame'];

    if (isset($_SESSION['Ad_G']) and $_SESSION['Ad_G'] >= microtime(true)) {
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("خطأ","يجب عليك الانتظار بين محاولاتك","error");';
	echo '}, 1000);</script>';
    } else {
        $_SESSION['Ad_G'] = microtime(true) + 5;
        //  
		$srv = explode(",", $client_verified["client_servergroups"]);
	if($_SESSION['hisgames'] >= $game_groups_ids_Max && !empty($_SESSION['hisgames'])){



















	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("خطأ","لقد تجاوزت الحد الاقصى للألعاب قم بالاستبدال","info");';
	echo '}, 1000);</script>';

            $server_groups = $ts3->serverGroupList();
            $servergroups = array();
 
            foreach($server_groups as $group) {
                if($group->type != 1) { continue; }
                if(in_array($group["sgid"], $game_groups_ids)) {
                    $servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type);
                }
            } 
			$_SESSION['grupos'] = $servergroups;
        
            foreach($servergroups as $group) {      
                
                $miembros = $ts3->serverGroupClientList($group["id"]);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $uid) { 
                        $estaengrupo = True; 
                    }                                   
                }
                
                if($estaengrupo) {
                     echo '					 
				<center><div class="col-md-12">
                <div class="card text-white bg-dark">
                    <div class="card-header text-center">
                        <h4 class="m-b-0 text-white">قم بالأستبدال</h4>
					</div>
                    <div class="card-body">
						<div class="col-md-12">
						<img src="image/'.$group['id'].'.png?v=134" class="img-responsive">
						<br>
                                <div class="el-card-content">
                                    <h3 class="box-title">'.$gamename.'</h3> <span class="badge badge-info">استبدل</span>
                                    <br> </div>	
									<hr>
                                <div class="el-card-content">
                                     <span class="badge badge-info">'. CountClientsGroup($group['id']) .' : عدد الاعبين</span>
                                    <br> </div>										
						<br>
						
						
						<div class="col-md-12">
	<form method="post">
                             <input type="hidden" name="idgame" value="'.$group["id"].'">
                             <input type="hidden" name="newgame" value="'.$game.'">


	 	<input class="btn btn-rounded btn-block btn-info" type="submit" name="rm" value="إزالة اللعبة وإستبدالها">




	 </form>
						</div>	
                    </div>
                    </div>
					<br>	
                </div>
            </div></center>';
}
}



















    }else if(count(array_intersect($srv, $game_groups_ids)) >= $game_groups_ids_Max){
		echo '<script type="text/javascript">';
		echo 'setTimeout(function () { swal("خطأ","لايمكنك إضافة اكثر من لعبتين","error");';
		echo '}, 1000);</script>';
	} else {
            $game = $_POST['idgame'];
            $check = $game;
            if (in_array($check, $game_groups_ids)) {
                $ts3->clientGetByUid($uid)->addservergroup($game);
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("تم","تنفيذ طلبك واضافة اللعبة","success");';
	echo '}, 1000);</script>';
            }
        }
    }
}


if (isset($_POST['rm'])) {
    //  
    if (isset($_SESSION['Rd_G']) and $_SESSION['Rd_G'] >= microtime(true)) {
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("خطأ","يجب عليك الانتظار بين محاولاتك","error");';
	echo '}, 1000);</script>';

    } else {
        $_SESSION['Rd_G'] = microtime(true) + 5;
        //  
        $game = $_POST['idgame'];
        $check = $game;
        if (in_array($check, $game_groups_ids)) {
            $ts3->clientGetByDbid($dbid)->remservergroup($game);
if (isset($switchon))
{

	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("تم","الإستبدال بنجاح","success");';
	echo '}, 1000);</script>';
}else{
	echo '<script type="text/javascript">';
	echo 'setTimeout(function () { swal("تم","تنفيذ طلبك وإزالة اللعبة","success");';
	echo '}, 1000);</script>';
        }
    }
}
}
?>	
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
                if(in_array($group["sgid"], $game_groups_ids)) {
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
				    $icon_image = '<img src="image/'.$gameid.'.png?v=213"></img> ';
					

                if($estaengrupo) {
                     $iconosm++;			
			// Here Remove 
echo'
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img '.$icon_image.'
                                    <div class="el-overlay">
                                        <ul class="el-info">
	<form method="post">
<button type="submit" name="rm" value="إضافة اللعبه" title="ازالة اللعبه" class="btn btn-outline-danger btn-rounded" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">ازالة</button>	
  <input type="hidden" name="idgame" value="'.$gameid.'">
					                  </form> 	
									  
											<p></p>
											<p> عدد الاعبين : '.$players.'</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title">'.$gamename.'</h3> <span class="badge badge-success">مفعل</span>
                                    <br> </div>
                            </div>
                        </div>
                    </div>	


                       
';
                } else {
//Here Add
			echo'
			
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img '.$icon_image.'
                                    <div class="el-overlay">
                                        <ul class="el-info">
	<form method="post">
<button type="submit" name="add" value="إضافة اللعبه" title="اضغط ل اضافة اللعبه" class="btn btn-outline-success btn-rounded" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;">اضافه</button>	
  <input type="hidden" name="idgame" value="'.$gameid.'">
					                  </form> 	
									  
											<p></p>
											<p> عدد الاعبين : '.$players.'</p>
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <h3 class="box-title">'.$gamename.'</h3> <span class="badge badge-danger">غير مفعل</span>
                                    <br> </div>
                            </div>
                        </div>
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