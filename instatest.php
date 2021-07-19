<?php


function getpk($pkname){
$url = 'https://www.instagram.com/web/search/topsearch/?context=blended&query='.$pkname.'&count=1';
$html = file_get_contents($url);

$obj = json_decode($html , true);
$userpk = $obj["users"][0]["user"]["pk"];

         return $userpk;
         
}

$name = 'size_42_';
echo getpk($name);

/*
$url = 'https://www.instagram.com/web/search/topsearch/?context=blended&query=size_42_&count=1';
$html = file_get_contents($url);

$obj = json_decode($html , true);
$userinfo = $obj["users"][0]["user"]["pk"];


		$res["username"] = $user["username"];
		$res["full_name"] = $user["full_name"];
		$res["id"] = $user["id"];
		$res["is_private"] = $user["is_private"];
		$res["profile_pic_url"] = $user["profile_pic_url"];
		$res["profile_pic_url_hd"] = $user["profile_pic_url_hd"];
		$res["biography"] = $user["biography"];
		$res["count"] = $user["edge_followed_by"]["count"];


$followed_by = $userinfo["edge_followed_by"]["count"];
$des = $userinfo["biography"];
$img = $userinfo["profile_pic_url"];
$user_name = $userinfo ["username"];
*/

?>
