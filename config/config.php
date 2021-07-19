<?php
	//--------------------------------------------------------------/  Start Info /-------------------------------------------------------------
$sitename = "Qz TeamSpeak Panel";
	//--------------------------------------------------------------/  Site Name /-------------------------------------------------------------				

	//--------------------------------------------------------------/  connection_code  /-------------------------------------------------------------				
	
	$tsConfig = array(
	'user' => 'serveradmin',
	'password' => 'vlQlZunI',
	'address' => '193.70.17.6',
	'queryport' => '10011',
	'port' => '9987',
	'nickname' => rawurlencode('Qz Panel ('.substr(str_shuffle(str_repeat("123456789$", 5)), 0, 2).')')
);

	    $Query_username = "serveradmin";
	    $Query_password = "vlQlZunI";
	    $Query_host = "193.70.17.6";
		$Query_port = 10011;
		$Server_port = 9987;
	    $botname = 'Qz-Panel['. mt_rand(0, 100).']';
		$maintenance = false;			
		$sitename = "Qz - TeamSpeak Panel";
		
	//--------------------------------------------------------------/  import_Groupe  /-------------------------------------------------------------				
    // $LEVELS_ARRAY = array (171,132,133,134,135,136,145,146,147,148,149,150,151,152,153,890,891,192,893,894,1254,1255,1256,1257,11258,1259,1260,1261,1262,1263,1264,305);
    
    $PRESTIGE_ARRAY = array (10,1648,1647,1646);
	$vip = array(38,39,40,2386);
	// $PRESTIGE_ARRAY = array(38,39,40,903);
    $LEVELS_ARRAY = array (171,132,133,134,136,145,146,147,148,149,150,151,152,153,890,891,192,893,894,1254,1255,1256,1257,1256,1257,1258,1259,1260,1261,1262,1264,305);

	//--------------------------------------------------------------/  Side_bar  /-------------------------------------------------------------				

$prestige = array(1648,1647,1646);
$testers = array(1413,1414,1415,1416,1417,1418,1419);
$clanm = array(2,10,1672);	
$ytt = array(2,10,1672);	
$admintab = array(10,1555,1672,1557,1554,1556,1553,1548,1027);	
$Code = array(10,1555,1672,1548);	
$jailsarch = array(10,1555,1672,1557,1554,1556,1553,1893);
$Punishmen = array(10,1555,1672,1557,1554,1556,1553,1988,1989);		
$msgmembers = array(10,1555,1672,1557,1554,1548,1027);		
$actmembers = array(10,1555,1672,1557,1554,1556,1553);
$canadv = array(10,1672,1557,1893);
$rooms = array(10,1672,1557);
//$exm = array(10,84,14,790,1413,1414,1415,1416,1417,1418,1419);
$owner = array(10);
$ticket = array(10,1555,1672,1557);
$icon = array(10,1555,1672,1557,1554);
$CoinsAdmin = 10;
$PublicRelation= 1893;
	
	//--------------------------------------------------------------/  Grups  /-------------------------------------------------------------				

        $game_groups_ids = array(1008,632,633,634,635,636,639,641,642,644,645,646,647,652,736,764,648,650,762,653,655,657,658,659,661,662,664,1487,2603,2605,2607,2604,2606,1487);	
		$game_groups_ids_Max = 3;
		$icon_groups_ids = array(278,964,1721,1722,1723,1724,1725,1726,1727,1728,1730,1731,1732,1733,1734,1735,1741,1742,1743,1744,1745,1747,1748,1749,17520);		
		$icon_groups_ids_Max = 1;
		$anddos_vip_Addos = array(66,902,69,67,214,82);
		$anddos_vip_Addos_Max = 3;
		$anddos_user_Addos = array(64,65,73);

		$icon_VIP1_ids = array(717,1458,1459,1460,1463,1465,1466,1467,1468,1469,1470,1471,1472,1473,1475,1476);
		$icon_VIP1_ids_Max = 2;
		$SupportRoomID = 76301;
		$SupportAccess = 901;
		$Admintopbar = array(10,1672,1555,1983,1984,1985,1986,1987,1988,1989,1548,2156,1889,1882,1883,1884,1885,2028,1048,790);
		$banad = 169;
		$act = 9;
		$notact = 860;
		$NeedVerifiedPanel  = 1952;		
		$nnotact = 19;		
		$jailhead = 75;
		$jailhead2 = 276;	
		$ban_support = array(1755);	
		$Profile_Register = array(1753);		
		$Profile_Edit = array(1754);				
		$Profile_Comment = array(1752);		
	//--------------------------------------------------------------/  Clan  /-------------------------------------------------------------				
$Roomownerclan = 101;
$botclan = 90;
$maxuser = 15; 
$Gourpsortid = 6500;
$clanowner = 9;
$clanmember = 31;
$Cantjoinclan = 27; // محظور من الدخول	
$laveclan = 12; // خرج من الكلان
$clanjoingroup = 31; // رتبة دخول الكلان

	//--------------------------------------------------------------/  Twitter  /-------------------------------------------------------------	
$tweat1k   = 1999;
$tweat5k   = 1998;
$tweat10k  = 1997;
$tweat20k  = 1996;
$tweat50k  = 1995;
$tweat100k = 1994;
$tweat250k = 1993;
$tweat500k = 1992;
	
	//--------------------------------------------------------------/  Instagram  /-------------------------------------------------------------				
$insta1k   = 2009;
$insta5k   = 2008;
$insta10k  = 2007;
$insta20k  = 2006;
$insta50k  = 2005;
$insta100k = 2004;
$insta250k = 2003;
$insta500k = 2002;
$insta1m   = 2001;
	//--------------------------------------------------------------/  Clans  /-------------------------------------------------------------				

function cspacer($name, $type, $order = NULL, $top = NULL){
	$rnd = mt_rand(1, 99999) * 2;
	if($type == "spacer"){
		$xclan = array(
		   "channel_name" => "[cspacer".$rnd."]".$name,
		   "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,		   
		   "channel_codec_quality" => 0x05,
		   "channel_flag_permanent" => TRUE,
		   "channel_flag_maxclients_unlimited" => FALSE,
		   "channel_flag_maxfamilyclients_unlimited" => FALSE,
		   "channel_flag_maxfamilyclients_inherited" => FALSE,
		   "channel_maxclients" => 0,
		   "channel_order" => $order
	   );
	}else if($type == "room"){
		$xclan = array(
		   "channel_name" => $name,
		   "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,		   
		   "channel_codec_quality" => 0x05,
		   "channel_flag_permanent" => TRUE,
		   "channel_flag_maxclients_unlimited" => TRUE,
		   "channel_flag_maxfamilyclients_unlimited" => TRUE,
		   "channel_flag_maxfamilyclients_inherited" => TRUE,
		   "channel_order" => $order,
		   "cpid" => $top
		);
	}
	
	$x = $GLOBALS['ts3_VirtualServer']->channelCreate($xclan);
	return $x;
}
	//--------------------------------------------------------------/  Room creat  /-------------------------------------------------------------				
$roomcid = 791;
$roomowner = 179;
$canmakeroom = array (149,150,151,152,153,890,891,892,893,894,1254,1255,1256,1257,1258,1259,1260,1261,1262,1263,1264,1648,1647,1646);
$chid = array("129", "33", "104" , "103", "15" , "179");
$skipjoin = 28;
$cban = 27;
$muteplus = 25;
$nochat = 24;
$mute = 23;
$mod = 16;
$normal = 12;

$images = 
array(
"https://i.imgur.com/gRKa8gq.jpg",
"https://i.imgur.com/Thwcpsc.jpg",
"https://i.imgur.com/0XO8XD8.jpg",
"https://i.imgur.com/pm0Npg5.jpg",
"https://i.imgur.com/HhjgE7d.jpg",
"https://i.imgur.com/zw1zCQh.jpg",
);	

$home = 
array(
"https://i.imgur.com/BoY8bZW.jpg",
"https://i.imgur.com/4vmhB7d.jpg",
"https://i.imgur.com/mn3M9Vq.jpg",
"https://i.imgur.com/sTImgRI.jpg",
"https://i.imgur.com/IgE4DXJ.jpg",
);


$sidbarr = 
array(
"https://i.imgur.com/WilqD4T.jpg",
"https://i.imgur.com/bw2XfwS.jpg",
"https://i.imgur.com/3LcDcQv.jpg",
"https://i.imgur.com/5aoIJrl.jpg",
"https://i.imgur.com/W8vP0X7.jpg",
"https://i.imgur.com/Iwof5KF.jpg",
"https://i.imgur.com/0wwztLR.jpg",
"https://i.imgur.com/XNfbdw4.jpg",
"https://i.imgur.com/tasCz6T.jpg",
"https://i.imgur.com/dZAEnsk.jpg",
"https://i.imgur.com/Iy0wn2X.jpg",
"https://i.imgur.com/hXmfng6.jpg",
);		

$font = 
array(
"assets/Cocon® Next Arabic-Light.otf",
// "assets/try1.otf",
// "assets/AraJozoor-Regular.ttf",
);		

$indexxx = 
array(
"class='zoomInDown animated'",
"class='bounce animated'",
"class='flash animated'",
"class='pulse animated'",
"class='rubberBand animated'",
"class='shake animated'",
"class='swing animated'",
"class='tada animated'",
"class='wobble animated'",
"class='jello animated'",
"class='bounceIn animated'",
"class='bounceInDown animated'",
"class='bounceInLeft animated'",
"class='bounceInRight animated'",
"class='bounceInUp animated'",
"class='fadeIn animated'",
"class='fadeInDown animated'",
"class='fadeInDownBig animated'",
"class='fadeInLeft animated'",
"class='fadeInLeftBig animated'",
"class='fadeInRight animated'",
"class='fadeInRightBig animated'",
"class='fadeInUp animated'",
"class='fadeInUpBig animated'",
"class='flip animated'",
"class='flipInX animated'",
"class='flipInY animated'",
"class='lightSpeedIn animated'",
"class='rotateIn animated'",
"class='rotateInDownLeft animated'",
"class='rotateInDownRight animated'",
"class='rotateInUpLeft animated'",
"class='rotateInUpRight animated'",
"class='slideInUp animated'",
"class='slideInDown animated'",
"class='slideInLeft animated'",
"class='slideInRight animated'",
"class='zoomIn animated'",
"class='zoomInDown animated'",
"class='zoomInLeft animated'",
"class='zoomInRight animated'",
"class='zoomInUp animated'",
"class='rollIn animated'",
);	


    $MY_LEVEL = 'N/A';
    
    foreach($LEVELS_ARRAY as $LEVEL=>$LEVEL_iD){
        if(in_array($LEVEL_iD,$ggids)){
            $MY_LEVEL = $LEVEL;
        };
    }
    
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

    function getDBIDCoins ( $dbid ){
        if ( isset ( $dbid ) ){
            global $mysqlcon, $dbname3;
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
			$sql = "SELECT * FROM $dbname3.user WHERE cldbid = ?";
            $smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $UserCoins = $smt->fetchAll();
            if ( $sql !== false and isset ( $UserCoins[0]['coins'] ) ){
                return $UserCoins[0]['coins'];
            }else{
                return 0;
            }
        }
    }

    function getUserNameDBID ( $username ){
        if ( isset ( $username ) ){
            global $mysqlcon, $dbname;
			$username = htmlspecialchars(stripslashes(strip_tags($username)));
            // $strii = '=\''.$username.'\'';
			//$strii = $mysqlcon->real_escape_string(htmlspecialchars(stripslashes(strip_tags($strii))));
			
            $sql = "SELECT * FROM $dbname.Users WHERE user = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($username));
            $UserInfo = $smt->fetchAll();
            if ( $sql !== false and isset ( $UserInfo[0]['DBID'] ) ){
                return $UserInfo[0]['DBID'];
            }else{
                return -999999;
            }
        }
    }

    function getDBIDSettings ( $dbid ){
        if ( isset ( $dbid ) ){
            global $mysqlcon, $dbname;
			$dbid = intval(htmlspecialchars(stripslashes(strip_tags($dbid))));
			$sql = "SELECT * FROM $dbname.Profile_Settings WHERE DBID = ?";
            $smt = $mysqlcon->prepare($sql);
			$smt->execute(array($dbid));
            $UserSetting = $smt->fetchAll();
            if ( $sql !== false and isset ( $UserSetting[0]['DBID'] ) ){
                return $UserSetting[0];
            }else{
                return 0;
            }
        }
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

    function getUIDDB ( $my_uid ){
        if ( isset ( $my_uid ) ){
            global $mysqlcon, $dbname;
			
			$my_uid = htmlspecialchars(stripslashes(strip_tags($my_uid)));
			$sql = "SELECT * FROM $dbname.Users WHERE UID = ?";
            $smt = $mysqlcon->prepare($sql);
			$smt->execute(array($my_uid));
            $UserInfo = $smt->fetchAll();
            if ( $sql !== false and isset ( $UserInfo[0]['user'] ) ){
                return $UserInfo[0]['DBID'];
            }else{
                return false;
            }
        }
        return false;
    }

    function getUIDUserName ( $my_uid ){
        if ( isset ( $my_uid ) ){
            global $mysqlcon, $dbname;
			
			$my_uid = htmlspecialchars(stripslashes(strip_tags($my_uid)));
			$sql = "SELECT * FROM $dbname.Users WHERE UID = ?";
            $smt = $mysqlcon->prepare($sql);
			$smt->execute(array($my_uid));
            $UserInfo = $smt->fetchAll();
            if ( $sql !== false and isset ( $UserInfo[0]['user'] ) ){
                return $UserInfo[0]['user'];
            }else{
                return false;
            }
        }
        return false;
    }
?>	

  