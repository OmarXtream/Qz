<?php
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>

    <div class="page-wrapper">
        <div class="container-fluid">
			<br>
<?php
					//////////
if(count(array_intersect($ggids, $PRESTIGE_ARRAY)))	
{	
				}else
					
				{
		echo '
		<br><br>
		<center>	<div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-primary ">
                               <center> <h4 class="m-b-0 text-white">منطقه البرستيج</h4> </center>
								</div>
							<div class="block-content">
							<br>
<h2> منطقه أعلى المتفاعلين فالسيرفر </h2>
<title>Qz - Dont Have VIP </title>


<center>
<img src="../assets/error1.png">
<div class="panel"><div class="panel-content">
<center><br><h2>
يمكنك الحصول علي مميزات البرستيج عند الحصول عليها عن طريق تفاعلك فالسيرفر وهو ما يسمي بنظام الليفلات الجديد الخاص ب Qz 

</h2><br></center></div>
</div>
<div class="alert alert-success">
<p>قم بالرجوع الي لوحه الاعضاء !</p>
</div>
<p>Copyright © 2018 | Qz Community | Server All rights reserved.</p> </center></div>

							</div>
						</div>
			</div> </center></div></div></div></div></div></div></div></div></div></div></div></div></div>



	  
	   </div>

			</div>
		</div>
</div>
</div>
</div>
</div></div></div></div>


		
		';
		die();
		}
			?>
			
			
			
			
<?php 

if (isset($_POST['addanddos'])) {
    //  
    if (isset($_SESSION['Ad_A']) and $_SESSION['Ad_A'] >= microtime(true)) {
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("خطأ","يجب عليك الانتظار بين محاولاتك","error");';
	echo '}, 1000);</script>';
    } else {
        $_SESSION['Ad_A'] = microtime(true) + 5;
        //  
	if($_SESSION['hisanddos'] >= $anddos_vip_Addos_Max){
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("خطأ","لايمكنك إضافة اكثر من 3 خصائص","error");';
	echo '}, 1000);</script>';
        } else {
            $anddos = $_POST['idanddos'];
            $check = $anddos;
            if (in_array($check, $anddos_vip_Addos)) {
                $ts3->clientGetByUid($uid)->addservergroup($anddos);
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("تم","تنفيذ طلبك واضافة الخاصية","success");';
	echo '}, 1000);</script>';
            }
        }
    }
}


if (isset($_POST['rmanddos'])) {
    //  
    if (isset($_SESSION['Rd_A']) and $_SESSION['Rd_A'] >= microtime(true)) {
	echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("خطأ","يجب عليك الانتظار بين محاولاتك","error");';
	echo '}, 1000);</script>';

    } else {
        $_SESSION['Rd_G'] = microtime(true) + 5;
        //  
        $anddos = $_POST['idanddos'];
        $check = $anddos;
        if (in_array($check, $anddos_vip_Addos)) {
            $ts3->clientGetByDbid($dbid)->remservergroup($anddos);
	echo '<script type="text/javascript">';
	echo 'setTimeout(function () { swal("تم","تنفيذ طلبك وإزالة الخاصية","success");';
	echo '}, 1000);</script>';
        }
    }
}

?>			
			
		<center>
		<div class="col-md-10">	
		<div class="card card-themed card-rounded">
			<div class="card-header bg-dark">
			<h3 class="card-title">خصائص البرستيج المفضله</h3>
			</div>
		<div class="block-content">
		<div class="content">
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
                if(in_array($group["sgid"], $anddos_vip_Addos)) {
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
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">'.$anddosname.'</div>
				   <center>
				   <hr>
				   <span class="badge badge-pill badge-success"><i class="fa fa-check "></i>مفعل</span>
				   <hr>
						  <form method="post">	   
						    <input type="hidden" name="idanddos" value="'.$anddos.'">

						<input type="submit" name="rmanddos" value="ازاله"   class="btn mr-1 mb-1 btn-outline-danger">  
				    </form></center>
               </div>
            </div>
		
';
                } else {
//Here Remove
			echo'
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">'.$anddosname.'</div>
				   <center>
				   <hr>
				   <span class="badge badge-pill badge-warning"><i class="fa fa-check "></i>غير مفعل</span>
				   <hr>
						  <form method="post">	   
						    <input type="hidden" name="idanddos" value="'.$anddos.'">

						<input type="submit" name="addanddos" value="تفعيل"   class="btn mr-1 mb-1 btn-outline-primary">  
				    </form></center>
               </div>
            </div>			
                        ';

                }
			}
			
 $_SESSION['hisanddos'] = $iconosm;

?>		
<!--
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">● » No Poke Plus!</div>
				   <center>
				   <hr>
				   <span class="badge badge-warning"><i class="fa fa-exclamation-circle">  </i>غير مفعل</span>
				   <hr>
						<button id="t7weel" style="width: 50%;" type="submit" name="trbtn" class="btn mr-1 mb-1 btn-outline-success"> تفعيل </button>
				    </form></center>
               </div>
            </div>
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">● » Skip No Private</div>
				   <center>
				   <hr>
				   <span class="badge badge-warning"><i class="fa fa-exclamation-circle">  </i>غير مفعل</span>
				   <hr>
						<button id="t7weel" style="width: 50%;" type="submit" name="trbtn" class="btn mr-1 mb-1 btn-outline-success"> تفعيل </button>
				    </form></center>
               </div>
            </div>
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">● » Skip No Poke</div>
				   <center>
				   <hr>
				   <span class="badge badge-warning"><i class="fa fa-exclamation-circle">  </i>غير مفعل</span>
				   <hr>
						<button id="t7weel" style="width: 50%;" type="submit" name="trbtn" class="btn mr-1 mb-1 btn-outline-success"> تفعيل </button>
				    </form></center>
               </div>
            </div>
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">● » No AFK Move</div>
				   <center>
				   <hr>
				   <span class="badge badge-warning"><i class="fa fa-exclamation-circle">  </i>غير مفعل</span>
				   <hr>
						<button id="t7weel" style="width: 50%;" type="submit" name="trbtn" class="btn mr-1 mb-1 btn-outline-success"> تفعيل </button>
				    </form></center>
               </div>
            </div>
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">● Busy</div>
				   <center>
				   <hr>
				   <span class="badge badge-warning"><i class="fa fa-exclamation-circle">  </i>غير مفعل</span>
				   <hr>
						<button id="t7weel" style="width: 50%;" type="submit" name="trbtn" class="btn mr-1 mb-1 btn-outline-success"> تفعيل </button>
				    </form></center>
               </div>
            </div>
			<div class="col-md-4">
               <div class="ribbon-wrapper-reverse card">
                   <div class="ribbon ribbon-bookmark ribbon-right ribbon-primary ">● spam</div>
				   <center>
				   <hr>
				   <span class="badge badge-pill badge-success"><i class="fa fa-check "></i>مفعل</span>
				   <hr>
						<button id="t7weel" style="width: 50%;" type="submit" name="trbtn" class="btn mr-1 mb-1 btn-outline-danger"> أزاله </button>
				    </form></center>
               </div>
            </div>
		
		
		
		</div>
		</div>
		</div>
		</div>
		</div>
		
		
		
			
		</center> -->
		






			</div>	</div>	</div>	</div>	</div>
		</div>
    </div>
  <script>
var maxicon = "2 <?PHP //Here you put the number of max games user can select and get ! :) ?>" ; 
var icons = "0" ;

$(document).ready(function () {
    //set initial state.

    $('input[type=checkbox]').change(function () {
		var id = $(this).prop('id');
        if ($(this).is(":checked")) {
            if (icons >= maxicon) {
      {
         $(this).prop("checked", "");
         alert('Sorry you cannot select more!');
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
     }
				//alert("Maximo");
                $(this).prop('checked', false);

            } else {
                icons++;
				<?php 
					$_SESSION['numiconos'] += 1;
				?>
            }

        } else {
            icons--;
            			<?php 
					$_SESSION['numiconos'] -= 1;
				?>
        }
        //$('.txt').val(icons);
    });

});
</script>		
<?php require_once('includes/footer.php'); ?>