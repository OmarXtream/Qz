<?php
$starttime = microtime(true);
require 'config/phphead.php';
require 'config/sqlconfig.php'; 
?>
<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
date_default_timezone_set('Asia/Riyadh');
$now = date("Y-m-j");
?>

<div class="page-wrapper">
	<div class="container-fluid">
<?php
$endtime = microtime(true); 
printf("Page loaded in %f seconds", $endtime - $starttime );

?>
	</div>			
</div>			
		
