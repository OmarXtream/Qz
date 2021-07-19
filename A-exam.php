<?php require 'config/phphead.php'; ?>

<?php
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
?>
<?php 
		if(isset($_SESSION['name']) || $_SESSION["userone"] == 1 || isset($_SESSION['ci'])){
			session_destroy();
			die('<script>
           swal({title: "مستحيل الي تبي تسوية",text: "لا يمكنك دخول الصفحة و انت مفعل خاصية يوزر تو",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
		}
?>
<?php 
require 'config/sqlconfig.php';
$csgrp = explode(',', $client_info["client_servergroups"]);

$testers = array(10,1803,1804,1805,1806,1807,1808,1809,1820,1879,1873,1824,1883,790,2314,1889,2403);

if(count(array_intersect($csgrp, $testers)) <= 0){
	die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
}
$manager = array(1803,2403,1804,1805,1806,1807,1808,1809,1820,1823,1824,1797,1798,1799,1800,1801,1779,1780,1802,1795,1796,1810,1811,1814,1781,1788,1789,1794,1775,1774,1778,1777,1812,1813,1790,1791,1792,1793,1782,1783,1784,1785,1786,1815,1816,1817,1818,1819,1852,1853,1854,1864,1870,1865,1867,1821,1822,628,2025,2024,2026,2022,2021,2020,2019,2018,2017,2016,2015,2014,2013,1627,709);

$csgo = array(1797,1798,1799,1800,1801,1802,1795,1796,1810,1811,1794,1775,1774,1778,1777,1812,1813,1790,1791,1792,1793,1782,1783,1784,1785,1786,1815,1816,1817,1818,1819,2256,2257,2258,2259,2260,2261,2262,2263,2264,2265,2266,2267,2268,1814,1781,1788,1789);

// $csgo = array(2256,2257,2258,2259,2260,2261,2262,2263,2264,2265,2266,2267,2268);
// $rush = array(1797,1798,1799,1800,1801);
$ensp = array(1779,1780);
$otako = array(1802,1795,1796,1810,1811);
// $braw = array(1814,1781,1788,1789);
// $lol = array(1794,1775,1774,1778,1777);
// $rocket = array(1812,1813,1790,1791,1792,1793);
// $over = array(1782,1783,1784,1785,1786);
// $for = array(1815,1816,1817,1818,1819);
$min = array(1852,1853,1854,1864,1870,1865,1867);
$tv = array(1821,1822);
$yt = array(628,2025,2024,2026,2022,2021,2020,2019,2018,2017,2016,2015,2014,2013);
$des = array(2410,1627);
$army = array(709);
?>

        <div class="page-wrapper">
        <div class="container-fluid">
		<br>

<?php 
$cldbid = $client_info["client_database_id"];

if(isset($_POST["submit"]) && isset($_POST["rgroup"]) && isset($_POST["uiz"])){
	$rgroup = intval($_POST["rgroup"]);
	$uidz = htmlspecialchars(strip_tags($_POST["uiz"]));
	if(is_numeric($rgroup) && !empty($uidz) && $rgroup !== 0){
		
		if(in_array(1805, $csgrp) && in_array($rgroup, $rush)){ //rushteam check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
				$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]");
			}catch(TeamSpeak3_Exception $e){
				die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');				
		}else if(in_array(1803, $csgrp) && in_array($rgroup, $ensp)){   //english check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
			$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1804, $csgrp) && in_array($rgroup, $otako)){   //Outako check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
				$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]");
				
			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1806, $csgrp) && in_array($rgroup, $braw)){   //Brawhalla check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1807, $csgrp) && in_array($rgroup, $lol)){   //LOL check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
		}else if(in_array(1808, $csgrp) && in_array($rgroup, $rocket)){   //RocketLeague check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1820, $csgrp) && in_array($rgroup, $for)){   //for check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1873, $csgrp) && in_array($rgroup, $min)){   //min check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1824, $csgrp) && in_array($rgroup, $tv)){   //tv check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1889, $csgrp) && in_array($rgroup, $manager)){   //manager check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1883, $csgrp) && in_array($rgroup, $yt)){   //yt check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(790, $csgrp) && in_array($rgroup, $des)){   //des check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(2314, $csgrp) && in_array($rgroup, $army)){   //army check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(2403, $csgrp) && in_array($rgroup, $csgo)){   //csgo check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else if(in_array(1809, $csgrp) && in_array($rgroup, $over)){   //OverWatch check
			try{
				$ts3_VirtualServer->clientGetByUid($uidz)->addServerGroup($rgroup);	
				$cbdid = $ts3_VirtualServer->clientGetByUid($uidz)["client_database_id"];
				$sql = "INSERT INTO testers (id, tester, idz) VALUES (NULL, '$cldbid', '$cbdid:$rgroup')";
				$con->query($sql);
								$ts3_VirtualServer->clientGetByUid($uidz)->poke("‎‫‎‫تم الأختبار والتوثيق بواسطه : [COLOR=#c81933] $nickname [/COLOR]‬‎");

			}catch(TeamSpeak3_Exception $e){
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
			}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');			
		}else{
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
		}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');		
	}else{
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
	}
echo('<script>
           swal({title: "تم",text: "اعطاء العضو الرتبة بنجاح",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');
}else if(isset($_POST["del"])){
	$gz = $_POST["del"];
	if(is_array($gz)){
		$gzkey = explode(':', key($gz));
		$cbsg = intval($gzkey[0]);
		$sgidz = intval($gzkey[1]);
		if(in_array($sgidz, $rush) && in_array(1805, $csgrp)){ //rushteam tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $ensp) && in_array(1803, $csgrp)){ //english tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $otako) && in_array(1804, $csgrp)){ //Outako tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $braw) && in_array(1806, $csgrp)){ //Brawhalla tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $lol) && in_array(1807, $csgrp)){ //LOL tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $rocket) && in_array(1808, $csgrp)){ //RocketLeague tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $for) && in_array(1820, $csgrp)){ //for tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $min) && in_array(1873, $csgrp)){ //min tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $tv) && in_array(1824, $csgrp)){ //tv tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $manager) && in_array(1889, $csgrp)){ //Manager tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $yt) && in_array(1883, $csgrp)){ //yt tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $des) && in_array(790, $csgrp)){ //des tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $army) && in_array(2314, $csgrp)){ //army tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $csgo) && in_array(2403, $csgrp)){ //csgo tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);
		}else if(in_array($sgidz, $over) && in_array(1809, $csgrp)){ //OverWatch tester
			$ts3_VirtualServer->serverGroupClientDel($sgidz, $cbsg);
			$sql = "DELETE FROM testers WHERE idz='$cbsg:$sgidz' LIMIT 1";
			$con->query($sql);			
		}else{
die('<script>
           swal({title: "خطاء",text: "حدث خطاء اعد التجربة",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/A-exam.php");}else {window.location.replace("https://panel.q-z.us/A-exam.php");}})</script>');
		}
	}
echo('<script>
           swal({title: "تم",text: "حذف الرتبة من العضو",type: "success",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",})</script>');	
}

?>			
			
		<center>
			<div class="col-md-7">
				 <form class="form-horizontal push-10-t" method="post">
				<div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white"><b>نظام الاختبارات</b></h4>
					</div>
                    <div class="card-body">
					
					<h5>‎‫بعد أختبار الشخص والتأكد من صحه كلامه بالأختبار تقدر تعطيه الرتبه الذي تم اختباره عليها من هنا‬‎</h5>
					<h5>*يمنع توثيق اى شخص بدون اختبارة او لمصالح شخصية و يتم معاقبتة و سحب الرتبة*</h5>
					<hr>					
					<br>
					<input class="form-control " placeholder="ايدي العضو" type="text" name="uiz"><br>
					<br>
					<br>
					<select class="js-select2 form-control select2-hidden-accessible" name="rgroup" style="width: 100%; height:40px;">
					  <option value="A">أختر الرتبه ...</option>
 <?php
				   if(count(array_intersect($csgrp, $testers)) > 1){ // More Than 1 Tester ServerGroup
						//$tanks = array_intersect($csgrp, $testers);
						//foreach($tanks as $tankz){
							$tank = array();
							if(in_array(1805, $csgrp)){ foreach($rush as $ru){ array_push($tank, $ru); } }
							if(in_array(1803, $csgrp)){ foreach($ensp as $ru){ array_push($tank, $ru); } }
							if(in_array(1804, $csgrp)){ foreach($otako as $ru){ array_push($tank, $ru); } }
							if(in_array(1806, $csgrp)){ foreach($braw as $ru){ array_push($tank, $ru); } }
							if(in_array(1807, $csgrp)){ foreach($lol as $ru){ array_push($tank, $ru); } }
							if(in_array(1808, $csgrp)){ foreach($rocket as $ru){ array_push($tank, $ru); } }
							if(in_array(1820, $csgrp)){ foreach($for as $ru){ array_push($tank, $ru); } }							
							if(in_array(1873, $csgrp)){ foreach($min as $ru){ array_push($tank, $ru); } }							
							if(in_array(1824, $csgrp)){ foreach($tv as $ru){ array_push($tank, $ru); } }							
							if(in_array(1889, $csgrp)){ foreach($manager as $ru){ array_push($tank, $ru); } }							
							if(in_array(1883, $csgrp)){ foreach($yt as $ru){ array_push($tank, $ru); } }							
							if(in_array(790, $csgrp)){ foreach($des as $ru){ array_push($tank, $ru); } }							
							if(in_array(2314, $csgrp)){ foreach($army as $ru){ array_push($tank, $ru); } }							
							if(in_array(2403, $csgrp)){ foreach($csgo as $ru){ array_push($tank, $ru); } }							
							if(in_array(1809, $csgrp)){ foreach($over as $ru){ array_push($tank, $ru); } }
							foreach($tank as $zi){
								// $ru = $zi["sgid"];
								$ruz = $ts3_VirtualServer->serverGroupGetById($zi)["name"];
								echo "<option value='$zi'>$ruz</option>";
							}
						//}
					}else if(in_array(1805, $csgrp)){ // RushTeam Tester
						foreach($rush as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1803, $csgrp)){ //english tester
						foreach($ensp as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1804, $csgrp)){ //Outako tester
						foreach($otako as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1806, $csgrp)){ //Brawhalla tester
						foreach($braw as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1807, $csgrp)){ //LOL tester
						foreach($lol as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1808, $csgrp)){ //RocketLeague tester
						foreach($rocket as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1820, $csgrp)){ //for tester
						foreach($for as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1873, $csgrp)){ //min tester
						foreach($min as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1824, $csgrp)){ //tv tester
						foreach($tv as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1889, $csgrp)){ //manager tester
						foreach($manager as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1883, $csgrp)){ //yt tester
						foreach($yt as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(790, $csgrp)){ //des tester
						foreach($des as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(2314, $csgrp)){ //army tester
						foreach($army as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(2403, $csgrp)){ //csgo tester
						foreach($csgo as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}else if(in_array(1809, $csgrp)){ //OverWatch tester
						foreach($over as $ru){
							$ruz = $ts3_VirtualServer->serverGroupGetById($ru)["name"];
							echo "<option value='$ru'>$ruz</option>";
						}
					}
				  ?>					  
					</select>
					<br>
					<br>
					
					
					
						
                    </div>
					<center><div class="col-md-4">
                      <button name="submit" type="submit" class="btn btn-rounded btn-block btn-outline-success">  تم الأختبار </button>
                    </div></center>
					<br>
								  </form>

					
                </div>
            </div>
		</center>
			
			<div class="col-md-12">
						<div class="card">
                            <div class="card-body">
                               <center> <h3 class="card-title"> سجل الأختبارات </h3> </center>

							<div class="table-responsive">
                                    <table class="table color-bordered-table warning-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>رقم العضو	</th>
                                                <th>الاسم</th>
                                                <th>المختبر</th>
                                                <th>الرتبة</th>
                                                <th>حذف</th>
                                            </tr>
                                        </thead>
                        <tbody>
						<?php
							if(count(array_intersect($csgrp, $testers)) > 1){
								$tank = array();
								if(in_array(1805, $csgrp)){ foreach($rush as $ru){ array_push($tank, $ru); } }
								if(in_array(1803, $csgrp)){ foreach($ensp as $ru){ array_push($tank, $ru); } }
								if(in_array(1804, $csgrp)){ foreach($otako as $ru){ array_push($tank, $ru); } }
								if(in_array(1806, $csgrp)){ foreach($braw as $ru){ array_push($tank, $ru); } }
								if(in_array(1807, $csgrp)){ foreach($lol as $ru){ array_push($tank, $ru); } }
								if(in_array(1808, $csgrp)){ foreach($rocket as $ru){ array_push($tank, $ru); } }
								if(in_array(1820, $csgrp)){ foreach($for as $ru){ array_push($tank, $ru); } }
								if(in_array(1873, $csgrp)){ foreach($min as $ru){ array_push($tank, $ru); } }
								if(in_array(1824, $csgrp)){ foreach($tv as $ru){ array_push($tank, $ru); } }
								if(in_array(1889, $csgrp)){ foreach($manager as $ru){ array_push($tank, $ru); } }
								if(in_array(1883, $csgrp)){ foreach($yt as $ru){ array_push($tank, $ru); } }
								if(in_array(790, $csgrp)){ foreach($des as $ru){ array_push($tank, $ru); } }
								if(in_array(2314, $csgrp)){ foreach($army as $ru){ array_push($tank, $ru); } }
								if(in_array(2403, $csgrp)){ foreach($csgo as $ru){ array_push($tank, $ru); } }
								if(in_array(1809, $csgrp)){ foreach($over as $ru){ array_push($tank, $ru); } }
								$gzid = array();
								foreach($tank as $zi){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($zi);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $zi;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1805, $csgrp)){ //rush team
								$gzid = array();
								foreach($rush as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
								
							}else if(in_array(1803, $csgrp)){ //english speaker
								$gzid = array();
								foreach($ensp as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1804, $csgrp)){ //Outako speaker
								$gzid = array();
								foreach($otako as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1806, $csgrp)){ //Brawhalla speaker
								$gzid = array();
								foreach($braw as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1807, $csgrp)){ //LOL speaker
								$gzid = array();
								foreach($lol as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1808, $csgrp)){ //RocketLeague speaker
								$gzid = array();
								foreach($rocket as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1820, $csgrp)){ //for speaker
								$gzid = array();
								foreach($for as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1873, $csgrp)){ //min speaker
								$gzid = array();
								foreach($min as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1824, $csgrp)){ //tv speaker
								$gzid = array();
								foreach($tv as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1889, $csgrp)){ //manger speaker
								$gzid = array();
								foreach($manager as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1883, $csgrp)){ //yt speaker
								$gzid = array();
								foreach($yt as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(790, $csgrp)){ //des speaker
								$gzid = array();
								foreach($des as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(2314, $csgrp)){ //army speaker
								$gzid = array();
								foreach($army as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(2403, $csgrp)){ //csgo speaker
								$gzid = array();
								foreach($csgo as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}else if(in_array(1809, $csgrp)){ //OverWatch speaker
								$gzid = array();
								foreach($over as $rz){
									$gzidz = $ts3_VirtualServer->serverGroupClientList($rz);
									if(empty($gzidz)){ continue; }
									foreach($gzidz as &$gzz){
										$gzz["sgid"] = $rz;
									}
									array_push($gzid, $gzidz);
								}
							}
							
							if(!empty($gzid) && count($gzid) > 0){
								foreach($gzid as $gzs){
										foreach($gzs as $gz){
										$dbz = $gz["cldbid"];
										$nick = $gz["client_nickname"];
										$sgid = $gz["sgid"];
										try{
																
											$sql = "SELECT tester FROM testers WHERE idz='$dbz:$sgid' LIMIT 1";
											$testername = intval($con->query($sql)->fetch_assoc()["tester"]);
											if(empty($testername) || strlen($testername) <= 0){
												$testername = "- - - -";
											}else{
												$testername = $ts3_VirtualServer->clientGetByDbid($testername)["client_nickname"];
											}
										}catch(TeamSpeak3_Exception $e){
											$testername = "- - - ( $testername ) - - -";
										}
										$sql = "SELECT tester FROM testers WHERE idz='$dbz:$sgid' LIMIT 1";
										//$testername = intval($con->query($sql)->fetch_assoc()["tester"]);
										
										$sgnick = $ts3_VirtualServer->serverGroupGetById($sgid)["name"];
										echo "<tr>  <td>$dbz</td> <td>$nick</td>  <td>$testername</td> <td><span dir='ltr'>$sgnick</span></td> <td><form method='post'> <button class='btn btn-warning btn-danger' name='del[$dbz:$sgid]'>حذف</button> </form></td> </tr>";
									}
								}
							}else{
								echo "<tr>  <td>لم تختبر احد الي الان</td> <td>لم تختبر احد الي الان</td> <td>لم تختبر احد الي الان</td> <td>لم تختبر احد الي الان</td> <td>لم تختبر احد الي الان</td> </tr>";
							}
						?>


                        </tbody>										
                                    </table>
								<center>
						<ul class="pagination">
							<?php
								for($i = 1; $i <= $totalp; $i++){
									if($page === $i){
										echo "<li class='paginate_button page-item active'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}else{
										echo "<li class='paginate_button page-item'><a aria-controls='DataTables_Table_0' data-dt-idx='2' tabindex='$i' class='page-link' href='?page=$i'>$i</a></li>";
									}
								}
							?>
					  </ul>
					  		</center>									
                                </div>
                        </div>
					 </div>
                    </div>
		
		
		
		
		
		
		
		
		</div>
        </div>
		
<?php require_once('includes/footer.php'); ?>