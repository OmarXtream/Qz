<?php
//screen -S Panelmanger php Panelmanger.php
set_time_limit(0);
require_once('TeamSpeak3/TeamSpeak3.php');
require_once('config.php');
require_once('sqlconfig.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$inactive = "inactive";
$con = new mysqli($host, $user, $pass, $db);
if($con->connect_error){
	die("Database Error: ".$con->connect_error);
}

while(true){
	$sql = "SELECT * FROM codes";
	$res = $con->query($sql);
	$num = $res->num_rows;
	if($num > 0){
		$nowt = date("Y:m:j:H:i:s");
		while($data = $res->fetch_assoc()){
			$ti = $data["etime"];
			$dbid = $data["cldbid"];
			$sgid = $data["sgid"];
			$stat = $data["status"];
			$chlsArray = $data["chl"];
			if($nowt == $ti){
			$id = $data["id"];
			  if($stat == "active" && $dbid != 0){
				try{
					$Coins =  'Coinsbot['. mt_rand(0, 5000).']';
                    $ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&nickname=$Coins");
					$ts3->serverGroupClientDel($sgid, $dbid);
					if(!empty($chlsArray)){
					$chls = explode(",", $chlsArray);
					$ts3->channelDelete($chls[0], true);
					$ts3->channelDelete($chls[3], true);
					}
					$sql = "UPDATE codes SET status='$inactive' WHERE id='$id'";
					$con->query($sql);
					$ts3->logout();
					unset($ts3);
				}catch (TeamSpeak3_Exception $e) { 
					echo $e ;
				}
			  }
			}
			
		}
	
	}
	
	$sql = "SELECT * FROM act WHERE status='active'";
	$res = $con->query($sql);	
	$num = $res->num_rows;
	
	if($num > 0){
		$nowt = date("Y:m:j:H:i:s");
		while($datax = $res->fetch_assoc()){
			$ti = $datax["etime"];
			$tne = $datax["time"];
			$user = $datax["user"];
			$sgid = $datax["sgid"];
			$stat = $datax["status"];
			$id = $datax["id"];
			if($nowt == $ti || $ti == $tne){
			  if($stat == "active" && $user != 0){
				try{
					$Coodes =  'Panel-TaskS['. mt_rand(0, 99999).']';					
                    $ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&nickname=$Coodes");
					$ts3->serverGroupClientDel($sgid, $user);
					$sql = "UPDATE act SET status='$inactive' WHERE id='$id'";
					$con->query($sql);
					$ts3->logout();
					unset($ts3);
				}catch (TeamSpeak3_Exception $e) { 
					
				}
			  }
			}
			
		}
	}

	$sql = "SELECT * FROM jail";
	$res = $con->query($sql);	
	$num = $res->num_rows;
	if($num > 0){
		$nowt = date("Y:m:j:H:i:s");
		$sgid = 75; // رتبة المسجون jail
		$msgid = 216; // رتبة بعد فك السجن
		$mroom = 2300; // روم بعد فك السجن
		while($datax = $res->fetch_assoc()){		
			$user = $datax["cldbid"];
			$id = $datax["id"];
			$ti = $datax["etime"];
			if($nowt == $ti){
				try{
					$JailM =  'Jail-Manager['. mt_rand(0, 5000).']';
                    $ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&nickname=$JailM");
					$ts3->serverGroupClientAdd($msgid, $user);
					$sql = "DELETE FROM jail WHERE id='$id'";
					try{
						$ts3->serverGroupClientDel($sgid, $user);
						$ts3->clientGetByDbid($user)->move($mroom);
					}catch (TeamSpeak3_Exception $e) { 
					}		
					$con->query($sql);
					$ts3->logout();
					unset($ts3);
				}catch (TeamSpeak3_Exception $e) { 
				}
				
				
			}
		}
		
	}	
	
	
	
	
	$sqln = "SELECT * FROM bad WHERE status='active'";
	$res = $con->query($sqln);
	$num = $res->num_rows;
	if($num > 0){
		$nowt = date("Y:m:j:H:i:s");
		while($data = $res->fetch_assoc()){
			$ti = $data["etime"];
			$dbid = $data["cldbid"];
			$sgid = $data["sgid"];
			$stat = $data["status"];
			if($nowt == $ti){
			$id = $data["id"];
			  if($stat == "active" && $dbid != 0){
				try{
					$Punishment =  'Panel-Tasks['. mt_rand(0, 99999).']';
                    $ts3 = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&nickname=$Punishment");
					$ts3->serverGroupClientDel($sgid, $dbid);
					$sql = "UPDATE bad SET status='$inactive' WHERE id='$id'";
					$con->query($sql);
					$ts3->logout();
					unset($ts3);
				}catch (TeamSpeak3_Exception $e) { 
					
				}
			  }
			}
			
		}
	
	}
	
	sleep(1);
}
?>