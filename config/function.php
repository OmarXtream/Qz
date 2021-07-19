<?php 


function OnlineOf($sgid) {
		global $ts3_VirtualServer;
$online = 0; 
foreach($ts3_VirtualServer->serverGroupGetById($sgid)->clientList() as $ct) { 
if($ts3_VirtualServer->clientList($ct)) {
 $online++; 
}
}
return $online;
}
function secure($str){

         return htmlspecialchars(addslashes(trim($str)));
         
}



function Coniscode($cgrp) { // اكواد الكوينز
$cancoins = array(10,2171,1672,1548,2212,2);	
if(count(array_intersect($cgrp, $cancoins)) > 0 || in_array(2, $cgrp)|| in_array(0, $cgrp)){
	
}else{
die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
}
}

function reedem($cgrp) { // اكواد المسابقات
$canreedem = array(10,2171,1672,1548,2212);	
if(count(array_intersect($cgrp, $canreedem)) > 0 || in_array(2, $cgrp)|| in_array(0, $cgrp)){
	
}else{
die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
}
}

function seach($cgrp) { // البحث عن العضو
$cansaerch = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);	
if(count(array_intersect($cgrp, $cansaerch)) > 0 || in_array(2, $cgrp)){
	
}else{
die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
}
}
function act($ggids) { // صفحة تفعيلات
$canactact = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);
if(!count(array_intersect($canactact, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
	 
function clan($ggids) { // التحكم بالكلانات
$canclan = array(10,2171,1672,1884);
if(!count(array_intersect($canclan, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
	 
function ccoins($ggids) { // التحكم بالكوينز
$cancoins = array(10,2171,1672);
if(!count(array_intersect($cancoins, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
	 
function adv($ggids) { // صفحة  الاعلانات
$canadv = array(10,2171,1672,2213);
if(!count(array_intersect($canadv, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }	 

function room($ggids) { // التحكم بالرومات
$canadv = array(10,2171,1672,1048,1885);
if(!count(array_intersect($canadv, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }	 	 
function Punishmen($ggids) { // العقوبات
$Punishmen = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);
if(!count(array_intersect($Punishmen, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }	

function ticket($ggids) { // تذاكر الدعم الفني
$ticket = array(10,2171,1555,1672,1557,1887,1048,2163);
if(!count(array_intersect($ticket, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
function ticketNew($ggids) { // تذاكر الدعم الفني
$ticket = array(1989,1988,1987,1986,1985,1984,1983,1555,1048,1672,2171,10);
if(!count(array_intersect($ticket, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
function ticketConfig($ggids) { // تذاكر الدعم الفني
$ticketConfig = array(10,2171,1048,1672);
if(!count(array_intersect($ticketConfig, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
function ticketEvent($ggids) { // تذاكر الدعم الفني
$ticketEvent = array(2156,1548,1555,1048,1672,2171,10);
if(!count(array_intersect($ticketEvent, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
function ticketEventConfig($ggids) { // تذاكر الدعم الفني
$ticketEventConfig = array(10,2171,1048,1672,1548);
if(!count(array_intersect($ticketEventConfig, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
function users_page($ggids) { // تذاكر الدعم الفني
$users_page = array(1555,1672,1048,2171,10);
if(!count(array_intersect($users_page, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
function icon($ggids) { // ايقونات الرومات والرتب
$icon = array(10,2171,1672);
if(!count(array_intersect($icon, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }	 
function brodcast($ggids) { // صفحة البرودكاست
$brodcast = array(10,2171,1672,1027,1548);
if(!count(array_intersect($brodcast, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
 function yt($ggids) { // صفحة التحكم باليوتيوبر
$yt = array(10,2171,1672,1883);
if(!count(array_intersect($yt, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
 function manager($ggids) { // صفحة المانجر
$manager = array(10,2171,1672);
if(!count(array_intersect($manager, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
	 
	 
	 function comment($ggids) { // صفحه التحكم بالتعليقات
$comment = array(10,2171,1672);
if(!count(array_intersect($comment, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
	 function cprofile($ggids) { // صفحه التحكم بالبروفايلات
$cprofile = array(10,2171,1672);
if(!count(array_intersect($cprofile, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }
 function cloinsmanager($ggids) { // صفحة مشتريات الكوينز
$cloinsmanager = array(10,2171,1672,2661);
if(!count(array_intersect($cloinsmanager, $ggids)) > 0){ die('<script>
           swal({title: "اوووف",text: "غير مصرح لك بدخول هذة الصفحة اطلع بسرعة ",type: "error",allowOutsideClick: false,allowEscapeKey: false,showCloseButton: false,confirmButtonText: "حسنأ",}).then((result) => {if (result.value) {window.location.replace("https://panel.q-z.us/");}else {window.location.replace("https://panel.q-z.us/");}})</script>');	
								}
	 }		 

function getpk($pkname){
$url = 'https://www.instagram.com/web/search/topsearch/?context=blended&query='.$pkname.'&count=1';
$html = file_get_contents($url);

$obj = json_decode($html , true);
$userpk = $obj["users"][0]["user"]["pk"];

         return $userpk;
         
}

?>