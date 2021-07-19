<?php
die;
    // ini_set('display_errors', 'On');
    // error_reporting(E_ALL);

    // session_start();
    // CONFIG
    $botname = 'Qz%20Panel%20['. mt_rand(0, 1000).']';
    $Query_username = "serveradmin";
    $Query_password = "vlQlZunI";
    $Query_host = "193.70.17.6";
    $Query_port = 10011;
    $Server_port = 9987;
require_once ("config/TeamSpeak3/TeamSpeak3.php");
    // Database Connect

    $db['type']="mysql";
    $db['host']="localhost";
    $db['user']="root";
    $db['pass']="qvaGN6vy9EaZMw5l";
    $db['dbname']="simple";
    $dbname = $db['dbname'];
    if ($db['type'] == 'mysql') {
        $dboptions = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true
        );
    } else {
        $dboptions = array();
    }

    $dbserver  = $db['type'].':host='.$db['host'];

    try {
        $mysqlcon = new PDO($dbserver, $db['user'], $db['pass'], $dboptions);
    } catch (PDOException $e) {
        $sqlconerr = "SQL Connection failed: ".$e->getMessage()."\n";
        echo $sqlconerr;
        // open function mail here and try to ts3 msg (perhaps uuid out of text file; mysqlconf?)
        exit;
    }

    $LEVELS_ARRAY = array (6);

    $MY_LEVEL = '0';

    // FUNCTIONS
    function getMyIP () {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    function hyphenate($str) {
        return implode("-", str_split($str, 3));
    }

    $ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");


    foreach($ts3_VirtualServer->clientList() as $client) {
        if( getMyIP() == $client['connection_client_ip']) {
            $client_verified = $client;
            $ggids = explode(",", $client_verified["client_servergroups"]);
            $nick = $client_verified['client_nickname']." ( ".$client_verified['client_database_id'].")";
        }
    }

    foreach($LEVELS_ARRAY as $LEVEL=>$LEVEL_iD){
        if(in_array($LEVEL_iD,$ggids)){
            $MY_LEVEL = $LEVEL;
        };
    }
    if(isset($_POST['SteamServerGroup'])) {
        if ( !in_array( 503,$ggids ) ){
            $client_verified->addServerGroup(503);
            echo 'success';
            die;
        }
    }
    if(isset($_POST['NickNameRegister'])) {
        if( !preg_match('/[^A-Za-z0-9]/', $_POST['NickNameRegister']) && strlen($_POST['NickNameRegister']) > 0 && strlen($_POST['NickNameRegister']) < 13) {
            $NickName_req = $_POST['NickNameRegister'];
            $User_UID = $client_verified['client_unique_identifier'];
            $User_DBID = $client_verified["client_database_id"];
            $User_UID = htmlspecialchars(stripslashes(strip_tags($User_UID)));
			$sql = "SELECT * FROM $dbname.Users 'WHERE UID = ?";
			$smt = $mysqlcon->prepare($sql);
			$smt->execute(array($User_UID));
            $SQLUsers = $smt->fetchAll();
            if ( isset ( $SQLUsers[0]['UID'] ) ){ echo 'already'; die; }
			
			$NickName_req = htmlspecialchars(stripslashes(strip_tags($NickName_req)));

			$sql = "SELECT * FROM $dbname.Users WHERE user LIKE ?";
            $smt = $mysqlcon->prepare($sql);
			$smt->execute(array("%".$NickName_req."%"));
            $SQLUsers = $smt->fetchAll();
			
            if ( isset ( $SQLUsers[0]['user'] ) ){ echo 'used'; die; }
            $MySq = "INSERT INTO $dbname.Users (`user`, `DBID`, `UID`) 
                VALUES ( :user, :DBID, :UID )";
            $sth = $mysqlcon->prepare($MySq);
            $sth->bindValue(':user', $_POST['NickNameRegister']);
            $sth->bindValue(':DBID', $User_DBID);
            $sth->bindValue(':UID', $User_UID);
            $sth->execute();
                // if successfull
            echo 'success';
            // $simple = $ts3_VirtualServer->clientGetByUid('rLsT0G5kuzvnsftf0jS39LVZUTY=');
            // $simple->message ( "[URL=client://0/".$User_UID."]".$client_verified['client_nickname']."[/URL] : Register with ".$_POST['NickNameRegister'] );
            die;
        }else{
            echo 'user';
            die;
        }
    }
?>
