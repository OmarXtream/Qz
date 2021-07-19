<?php
session_start();
require 'sqlconfig.php';

if(isset($_POST["lg"])) {
	if( $_POST["t-username"] != "" && $_POST["t-password"] != "" ){		
		$username = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-username"]))));
		$Beforepassword = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-password"]))));
		$password = md5($Beforepassword) ;
		$db = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-db"]))));
		$sql = "SELECT * FROM secure_login WHERE username='$username' AND password='$password'";
		if($result = mysqli_query($con, $sql)){
			if(mysqli_num_rows($result)== 1){
			while($row = mysqli_fetch_array($result)){
			 if ( $row['db'] == $db ) {
				echo "true";
				$_SESSION['logged'] = TRUE;
						} else { echo "error2" ; }
					} 
				} else {
				echo "error" ;			
			}
		}
	}
}
///////////////////////////
if(isset($_POST["dbDel"])) {
		$db = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["dbDel"]))));
		$sql = "DELETE FROM secure_login WHERE db='$db'";
		if ($con->query($sql) === TRUE) {
		echo "true";
	}
}
//////////////////////
if(isset($_POST["lgC"])) {
	if( $_POST["t-username"] != "" && $_POST["t-password"] != "" && $_POST["t-db"] != "" ){		
		$username = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-username"]))));
		$Beforepassword = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-password"]))));
		$password = md5($Beforepassword) ;
		$db = $con->real_escape_string(htmlspecialchars(stripslashes(strip_tags($_POST["t-db"]))));
		$sql = "INSERT INTO secure_login (id ,username, password, db)
		VALUES (NULL, '$username', '$password', '$db')";
		if ($con->query($sql) === TRUE) {
			echo "true," . $username . "," . $password . "," . $db;
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}
}
////////////////////
if(isset($_POST["lgCreateCd"])) {
		$tkn = md5(uniqid(rand(), true)) ;
		$sql = "INSERT INTO token_credentials (id ,token)
		VALUES (NULL, '$tkn')";
		if ($con->query($sql) === TRUE) {
			$finalLink = "https://panel.q-z.us/credentials?token=" . $tkn;
			echo $finalLink ;
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;

		}
}



?>