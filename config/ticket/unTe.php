<?PHP
require '../phphead.php';
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "qvaGN6vy9EaZMw5l";
$dbname = "Rankqz";
$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($con->connect_error){
	die("Failed TO COnnect to database: ".$con->connect_error);
}
$arrayToR = array ("10300", "18052", "21512", "3867", "8475", "22145", "29491", "7042", "27870", "17692", "26316", "14999", "24776", "18326", "25027", "28325", "13865", "29283", "26840", "24149", "17828", "27141", "4326", "3719", "4088", "27339", "21152", "27138", "24559", "6834", "4705", "3731", "27336", "26633", "27337", "17142", "18198", "27335", "15998", "3808", "3949", "17581", "6202", "23143", "8744", "3858", "18628", "28622", "17883", "26671", "12012", "19391", "18790", "16549", "5076", "27448", "23129", "6283", "24905", "19595", "13172", "15195", "19575", "30233", "11932", "23716", "4091", "4294", "18010", "13577", "11879", "22122", "5264", "7596", "3713", "15837", "17294", "25355", "6756", "15432", "22657", "21633", "17270", "24828", "26704", "16878", "18758", "12217", "4882");
$loll = true ; 

if ( $loll == true ) {
$sql = "SELECT * FROM user";
$result = $con->query($sql);
while($row = mysqli_fetch_assoc($result)) {
	$cldbid = $row['cldbid'];
	 try {
	$check = $ts3_VirtualServer->clientPermList($cldbid);
	if ($check) {
	$check2 = $check[142]["permvalue"] ;
	if (!$check2) {
	//echo $ts3_VirtualServer->clientInfoDb($cldbid)["client_unique_identifier"]  ."\n";
	echo $cldbid . "\n";
		}
	}
	 }catch (Exception $e) { 
   	
   }
}


} else {
	
foreach($arrayToR as $item) {
		if ( $item != 13865 ) {
			$check = $ts3_VirtualServer->clientPermList($item);
			foreach($check as $item1) {
			echo $item . "\n : Removed" ; 
			$id = $item1['permid'] ; 
			$ts3_VirtualServer->clientPermRemove($item,$id) ;
			}
		}
	}
	echo "Done"; 
}

  







?>
