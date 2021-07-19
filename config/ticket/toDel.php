<?PHP 
require '../phphead.php';
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "qvaGN6vy9EaZMw5l";
$dbname = "Rankqz";
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = "SELECT * FROM codes WHERE chl != ''";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$ChlArray = $row["chl"] ;
}
echo  $ChlArray ;
$ac = false ;
if ($ac == true ) {
if(!empty($ChlArray)){
$chls = explode(",", $ChlArray);
$rnd = rand() ;
$cid1 = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "[cspacer]231",
	"channel_password" => "7567657567",
	"channel_order"    => $chls[3],
	"channel_flag_permanent" => TRUE,
 ));
$cid2 = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "31",
	"channel_flag_permanent" => TRUE,
    "cpid" => $cid1,
));
$cid3 = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "12",
	"channel_flag_permanent" => TRUE,
    "cpid" => $cid1,
));
$cid1C = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "[cspacer".$rnd."]┄┉┉═══ ═══┉┉┄",
	"channel_password" => "7567657567",
	"channel_order"    => $cid1,
	"channel_flag_permanent" => TRUE,

 ));
 
$finalChl = $cid1 . "," . $cid2 . "," .$cid3 . "," . $cid1C  ;
$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status, chl) VALUES (NULL, 'NULL', 'NULL', 'NULL', 'unlimted', 'active', '$finalChl')";
$con->query($sql);

}else{
$rnd = rand() ;
$cid1 = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "[cspacer]248955",
	"channel_password" => "7567657567",
	"channel_order"    => "248955",
	"channel_flag_permanent" => TRUE,
 ));
$cid2 = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "123",
	"channel_flag_permanent" => TRUE,
    "cpid" => $cid1,
));
$cid3 = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "321",
	"channel_flag_permanent" => TRUE,
    "cpid" => $cid1,
));
$cid1C = $ts3_VirtualServer->channelCreate(array(
    "channel_name" => "[cspacer".$rnd."]┄┉┉═══ ═══┉┉┄",
	"channel_password" => "7567657567",
	"channel_order"    => $cid1,
	"channel_flag_permanent" => TRUE,

 ));

$finalChl = $cid1 . "," . $cid2 . "," .$cid3 . "," . $cid1C  ;
$sql = "INSERT INTO codes (id, cldbid, sgid, time, etime, status, chl) VALUES (NULL, 'NULL', 'NULL', 'NULL', 'unlimted', 'active', '$finalChl')";
$con->query($sql);

}

} else {
	
$sql = "SELECT * FROM codes WHERE etime='unlimted'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$id = $row["id"] ;
$ChlArray = $row["chl"] ;
$chls = explode(",", $ChlArray);
try {
//$ts3_VirtualServer->channelDelete($chls[0]);
//ts3_VirtualServer->channelDelete($chls[3]);
//$sql = "DELETE FROM codes WHERE id='$id'";

if ($con->query($sql) === TRUE) {
    //
	
} else {
    
	//
}

  } 
 catch (Exception $e) { 
  echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
 }


 
 
 }
	
}

?>