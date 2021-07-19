<?php
// if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || 
   // $_SERVER['HTTPS'] == 1) ||  
   // isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   
   // $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
// {
   // $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   // header('HTTP/1.1 301 Moved Permanently');
   // header('Location: ' . $redirect);
   // exit();
// }
error_reporting(E_ALL | E_STRICT);
require_once ("TeamSpeak3/TeamSpeak3.php");
TeamSpeak3::init();
$ftdata = TeamSpeak3_Helper_Uri::getUserParam("ftdata");
try
{
  if(!$ftdata = unserialize(base64_decode($ftdata)))
  {
    throw new Exception("unable to decode file transfer data");
  }
  
  $test = TeamSpeak3::factory("filetransfer://" . $ftdata["host"] . ":" . $ftdata["port"])->download($ftdata["ftkey"], $ftdata["size"], TRUE);
}
catch(Exception $e)
{
  echo file_get_contents("assets/no");
}
?>