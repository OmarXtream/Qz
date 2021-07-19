<?php
 // ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
 // error_reporting(E_ALL);
require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php
$host = "localhost";
$user = "root";
$pass = "qvaGN6vy9EaZMw5l";
$db = "Rankqz";
try 
{
  $db = new PDO('mysql:host=localhost;dbname=Rankqz;charset=utf8', 'root', 'qvaGN6vy9EaZMw5l');
} 
catch(PDOException $e)
{
  die('خطأ:'. $e->getMessage());
}

?>

<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">
            <div class="container-fluid">
<br>



<?php


if (isset($_POST['rem'])){
    $response = $db->prepare('SELECT * FROM insta');
    $response->execute();
    $instas = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($instas as $checkd) {

        if ($checkd['cdb'] == $client_db) {
$followed_by = $checkd['follow'];
$user = secure($checkd['name']);
$user_name = secure($checkd['username']);
$img = $checkd['img'];
$instarank = $checkd['sgroup'];


$ts3->serverGroupClientDel($instarank, $client_db);
    $stmt = $db->prepare('DELETE FROM insta WHERE cdb = :cb');
    $stmt->bindValue(':cb',$client_db,PDO::PARAM_INT);
    $stmt->execute();
    $stmt->CloseCursor(); 
$ts3_VirtualServer->clientGetByDbid($client_db)->poke("[B]تم الغاء ربط حسابك في الانستقرام !");

echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>        <strong>تم الغاء ربط حسابك في الانستقرام ! </strong></center> 
                                </div>
                                </div>
                                </div>
                                </div>
';
	$_SESSION['insta'] = microtime(true)+600;
        require_once("includes/footer.php");
die;

}
}
}

if (isset($_POST['send']))
{
$user = secure($_POST['user']);
if (empty($user)){
echo'
                                <div class="alert alert-info alert-bordered alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <center><strong>الرجاء وضع إسم حسابك في الخانة</strong>   </center>
                                </div>
';
}else{
    $response = $db->prepare('SELECT * FROM insta');
    $response->execute();
    $insta = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($insta as $check) {
        if ($check['pk'] == getpk($user)) {

echo'
                                <div class="alert alert-danger alert-bordered alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <center><strong>لقد تم ربط هذا الحساب سابقا من قبل احد الأعضاء !</strong>   </center>
                                </div>
';
        require_once("includes/footer.php");
die;
}
}
echo '<br>' ;

$url = 'https://www.instagram.com/'.$user;
$html = file_get_contents($url);
$arr = explode('window._sharedData = ',$html);
$arr = explode(';</script>',$arr[1]);
$obj = json_decode($arr[0] , true);
$userinfo = $obj["entry_data"]["ProfilePage"][0]["graphql"]["user"];
/*
		$res["username"] = $user["username"];
		$res["full_name"] = $user["full_name"];
		$res["id"] = $user["id"];
		$res["is_private"] = $user["is_private"];
		$res["profile_pic_url"] = $user["profile_pic_url"];
		$res["profile_pic_url_hd"] = $user["profile_pic_url_hd"];
		$res["biography"] = $user["biography"];
		$res["count"] = $user["edge_followed_by"]["count"];
*/


$followed_by = $userinfo["edge_followed_by"]["count"];
$des = $userinfo["biography"];
$img = $userinfo["profile_pic_url"];
$user_name = $userinfo ["username"];
$ts3_VirtualServer->clientListReset();
$ts3_VirtualServer->channelListReset();
$uid = $client_info["client_unique_identifier"];
$hispk = getpk($user);
  if(stristr($des, "$uid") == FALSE) { 

echo"

                                <div class='alert alert-danger alert-bordered alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'><i class='fa fa-times'></i></button>
                                    <center><strong>
									الرجاء التأكد من وضع رقم التحقق الخاص بك في وصف الحساب</strong>   </center>
                                </div>
";
}else{

if($followed_by < 5000 && $followed_by >= 1000){
$ts3->serverGroupClientAdd($insta1k, $client_db);
$rankname = $ts3->serverGroupGetById($insta1k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta1k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)

                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta1k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);


        $stmt->execute();        
        $stmt->CloseCursor();



}elseif($followed_by < 10000 && $followed_by >= 5000){
$ts3->serverGroupClientAdd($insta5k, $client_db);
$rankname = $ts3->serverGroupGetById($insta5k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta5k . '"> '.$rankname.'  

                                </div>
</center>
';


        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');

        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta5k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by < 20000 && $followed_by >= 10000){
$ts3->serverGroupClientAdd($insta10k, $client_db);
$rankname = $ts3->serverGroupGetById($insta10k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta10k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta10k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by < 50000 && $followed_by >= 20000){
$ts3->serverGroupClientAdd($insta20k, $client_db);
$rankname = $ts3->serverGroupGetById($insta20k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta20k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta20k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by < 100000 && $followed_by >= 50000){
$ts3->serverGroupClientAdd($insta50k, $client_db);
$rankname = $ts3->serverGroupGetById($insta50k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta50k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta50k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by < 250000 && $followed_by >= 100000){
$ts3->serverGroupClientAdd($insta100k, $client_db);
$rankname = $ts3->serverGroupGetById($insta100k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta100k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta100k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by < 500000 && $followed_by >= 250000){
$ts3->serverGroupClientAdd($insta250k, $client_db);
$rankname = $ts3->serverGroupGetById($insta250k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta250k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta250k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by < 1000000 && $followed_by >= 500000){
$ts3->serverGroupClientAdd($insta500k, $client_db);
$rankname = $ts3->serverGroupGetById($insta500k);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta500k . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta500k", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();

}elseif($followed_by >= 1000000){
$ts3->serverGroupClientAdd($insta1m, $client_db);
$rankname = $ts3->serverGroupGetById($insta1m);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     تم ربط الحساب <strong>بنجاح ! </strong> <br> <img src="icon.php?id='. $insta1m . '"> '.$rankname.'  

                                </div>
</center>
';
        $stmt= $db->prepare('INSERT INTO insta ( name, img, cdb, creation_date, follow, sgroup, username,pk) 
                             VALUES (:nem, :img, :cdb, NOW(), :follw, :group, :usrname, :pkk)
                           ');
        $stmt->bindValue(':nem',"$user",PDO::PARAM_STR);
        $stmt->bindValue(':img',"$img",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':follw',"$followed_by", PDO::PARAM_INT);
        $stmt->bindValue(':group',"$insta1m", PDO::PARAM_INT);
        $stmt->bindValue(':usrname',"$user_name", PDO::PARAM_STR);
        $stmt->bindValue(':pkk',"$hispk", PDO::PARAM_INT);

        $stmt->execute();        
        $stmt->CloseCursor();


}elseif($followed_by < 1000){
echo'
                                <div class="alert alert-danger alert-bordered alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                   <center> <strong>للأسف!</strong> لا يوجد عدد كافي من المتابعين الحد الأدنى  ألف متابع.</center>
                                </div>
';
        require_once("includes/footer.php");
die;
}


echo'
<center>
<div class="col-lg-3 col-md-6">
<div class="card-header">
                                معلومات حسابك
                            </div>
              
                                <div class="card">
                            <div class="panel-body">
                                <div class="text-center" id="author">
                                   <strong> <img src="'.$img.'">
								   <hr>
                                    <h3>'.$user_name.'</h3>
                                    								   <hr>

									<p>'.$user.'</p>
								   <hr>

                                    عدد المتابعين  : <small class="label label-primary">'.$followed_by.' </small> 
																	   <hr>

                                    <div class="text-center">
                                    <p style="background-color:white">'.$des.'</p>
</div>
								   <hr>

                                </div>
	';
echo' <center>
<form method="post">

<button type="submit" name="rem" class="btn btn-danger delete" title="'.$user.' "><i class="glyphicon glyphicon-remove"></i> إلغاء ربط حسابي</button></form>
<br>	<br><br>						
                            </div>
                        </div>

</div><div class="col-lg-4">
                        <div class="well well-success">
                            <h3><strong>تم التنفيذ بنجاح</h3>
                            تم ربط حسابك بنجاح <br> يمكنك إرجاع الوصف الخاص بك كما كان 
                        </div>
                        </div>
</div>
</div>
</div>
</div

';

        require_once("includes/footer.php");
die;
}
}
}

    $response = $db->prepare('SELECT * FROM insta');
    $response->execute();
    $insta = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($insta as $check) {

        if ($check['cdb'] == $client_db) {
$followed_by = $check['follow'];
$user = secure($check['name']);
$user_name = secure($check['username']);
$img = $check['img'];
$sgroup = $check['sgroup'];



$url = 'https://www.instagram.com/'.$user;
$html = file_get_contents($url);
$arr = explode('window._sharedData = ',$html);
$arr = explode(';</script>',$arr[1]);
$obj = json_decode($arr[0] , true);
$userinfo = $obj["entry_data"]["ProfilePage"][0]["graphql"]["user"];


$followed_by = $userinfo["edge_followed_by"]["count"];
$des = $userinfo["biography"];

echo'
<center>
<div class="col-lg-3 col-md-6">
<div class="card-header">
                                معلومات حسابك
                            </div>
              
                                <div class="card">
                            <div class="panel-body">
                                <div class="text-center" id="author">
                                   <strong> <img src="'.$img.'">
								   <hr>
                                    <h3>'.$user_name.'</h3>
                                    								   <hr>

									<p>'.$user.'</p>
								   <hr>

                                    عدد المتابعين  : <small class="label label-primary">'.$followed_by.' </small> 
																	   <hr>

                                    <div class="text-center">
                                    <p style="background-color:white">'.$des.'</p>
</div>
								   <hr>

                                </div>
	';
echo' <center>
<form method="post">

<button type="submit" name="rem" class="btn btn-danger delete" title="'.$user.' "><i class="glyphicon glyphicon-remove"></i> إلغاء ربط حسابي</button></form>
<br>	<br><br>						
                            </div>
                        </div>

</div><div class="col-lg-4">
                        <div class="well well-info">
                            <h3><strong>تم ربط حسابك بالفعل !</h3>
                        </div>
						</div>
</div>
</div>
</div>
</div>
';

        require_once("includes/footer.php");
die;

        }
    }
?>

<div class="row">
<div class="col-md-6">
                        <div class="card text-white bg-warning">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">بوت الانستقرام
</h4></div>
                            <div class="card-body">
<center>=================================================
<br>
<font face="VIP" size="4"> <font color="#d22d2d"><?php echo $client_info["client_unique_identifier"];?></font>  : رقم التحقق الخاص بك</font>
<br>
<br>

=================================================
<h4>
<br>
( قم بوضع كود التحقق فقط في وصف حسابك.)<br>
( Accounts->Edit Profile->Bio-><?php echo $unid ;?> )<br>
(2) قم بكتابه معرف حسابك في وصف الحساب في الحقل.<br>
( Name = https://instagram.com/accounts/edit/(Your Name Here) )<br>
(3) قم بالضغط على الزر "ربط الحساب" لربط الحساب الخاص بك في الإنستقرام.<br><br><br>

</h4>

</center>
                            </div>
                        </div>
                    </div>


<div class="col-md-6">
                        <div class="card text-white bg-warning">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">بوت الانستقرام
</h4></div>
                            <div class="card-body">
<center>
<form method="post">

                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
<center><img src="assets/IN.png" /></center>

<hr>
                            </header>

                        <section class="panel">
                            <div class="panel-body">
                                    <div class="form-group">

                                <form class="form-horizontal" role="form">



                                        <label>نموذج الربط</label>
                                        <div class="col-lg-9">
                                <form role="form">
                                    <div class="form-group">
                                        <div class="iconic-input"><center>
     <form method='post'>

                                            <input type="text" class="form-control" placeholder="إسم الحساب" name='user'><br>


                                        </div>
											<br><br>
                            <button type="submit" name="send" class="btn waves-effect waves-light btn-block btn-success"><i class="fa fa-search"></i> ربط الحساب</button>

</form>

                                    </div>
                                    </div>


</div>

                                        </div>

                        </section>

                    </div>
                </div>
                </div>
                </div>
                </div>

            </div>
        </div>

            </div>
        </div>
        </div>
        </div>
<?php require_once('includes/footer.php'); ?>