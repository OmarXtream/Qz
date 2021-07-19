<?php
/**
 * https://github.com/Wruczek/TeamSpeak-HiddenPermsChecker
 * Made by Wruczek (github.com/Wruczek)
 * Licensed under MIT
 */

require_once ("TeamSpeak3/TeamSpeak3.php");
error_reporting(0);
ini_set('display_errors', 0);

// Edit this
	    $Query_username = "serveradmin";
	    $Query_password = "vlQlZunI";
	    $Query_host = "193.70.17.6";
		$Query_port = 10011;
		$Server_port = 9987;
	    $botname = 'Qz-Panel['. mt_rand(0, 100).']';
		// =========

try {
	$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$Query_username:$Query_password@$Query_host:$Query_port/?server_port=$Server_port&blocking=0&nickname=$botname");
    $tsServer = $ts3_VirtualServer ;
} catch (Exception $e) {
    msg("Exception while connecting to server: {$e->getMessage()}");
    msg(); // New line
    echo $e;
    exit;
}

// A little hack for PHPStorm to let it know that
// tsServer is a TeamSpeak3_Node_Server instance.
// It adds code inspection and code completion.
if(!($tsServer instanceof TeamSpeak3_Node_Server)) {
    exit;
}

msg("Loading users, 100 at a time...");

$clientslist = [];

// Get number of clients known by TeamSpeak server
$total = array_values($tsServer->clientListDb(0, 1))[0]["count"];

msg("Detected $total users, loading started");

$offset = 0;

// Load users
//while(($count = count($clientslist)) < $total) {
while(($count = count($clientslist)) < $total) {
    msg(" > Loading part $count / $total");
    $clientslist = array_merge($clientslist, $tsServer->clientListDb($count,200));
}

msg("Loaded " . count($clientslist) . " out of $total users.");
msg("Scanning, this might take a few minutes...");
msg();
$i = 0;
foreach ($clientslist as $client) {
    try {
		$dbid = $client["cldbid"] ;
        $nickname = $client["client_nickname"];
        $uuid = $client["client_unique_identifier"];
        $cc = $tsServer->clientPermList($dbid);
		if (count($cc) == 1 && $cc[145]["permid"] ) {

		} else {
		if ($dbid == 13865) { } else {
		removePerm ($tsServer,$dbid) ;
		msg("Client UUID \"$uuid\" (\"$nickname\") have hidden permissions");
        $i++;

			}
		}
    } catch (Exception $e) {
        if($e->getCode() !== 1281) {
            echo $e;
            exit;
        }
    }
}

if($i > 0) msg();
msg("Finished. Found $i users with hidden permissions.");

function removePerm ($ts3,$dbid) 
{
	$perms = array();
	$cc = $ts3->clientPermList($dbid);
    foreach ($cc as $value) {
    $id = $value["permid"] ;
     array_push($perms,$id);
	}
	 $ts3->clientPermRemove($dbid,$perms);

}	

function msg($msg = "") {
    echo $msg . PHP_EOL;
}