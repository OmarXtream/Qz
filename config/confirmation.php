<?php
    session_start();
    
    if (empty($_SESSION['pin'])) {
        require_once('TeamSpeak3/TeamSpeak3.php');
        require_once("config.php");
        try {
            TeamSpeak3::init();
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
$ts3 = $ts3_VirtualServer;
        } catch(Exception $e) {
            exit();
        };
        // $_SESSION['pin'] = generateRandomString();
           $_SESSION['pin'] = getToken(20);
        $ts3->clientGetByUid($_SESSION['uid'])->poke("Verification Pin: [b]". $_SESSION['pin'] ."[/b]");
    }
    
	
		function getToken($length){
			 $token = "";
			 // $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			 // $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
			 // $codeAlphabet.= "0123456789";
			 // $codeAlphabet.= "!@#$%^&*_+";			 
			 // $max = strlen($codeAlphabet);

			// for ($i=0; $i < $length; $i++) {
				// $token .= $codeAlphabet[mt_rand(0, $max-1)];
			// }
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			$token = substr( str_shuffle( $chars ), 0, $length );
			// $token = substr(md5(uniqid(mt_rand(), true)) , 0q, 8);
			return $token;
	    }
	
    
    // function generateRandomString() {
        // $characters = '0123456789';
        // $charactersLength = strlen($characters);
        // $randomString = '';
        // for ($i = 0; $i < 4; $i++) {
            // $randomString .= $characters[rand(0, $charactersLength - 1)];
        // }
        // return $randomString;
    // }
?>