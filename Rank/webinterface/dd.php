<?php
$pwd = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#*+;:-_~?=%&$§!()"),0,12);
$cfg['webinterface_pass'] = password_hash($pwd, PASSWORD_DEFAULT);
echo $pwd . "<br>";
echo $cfg['webinterface_pass']; 








?>