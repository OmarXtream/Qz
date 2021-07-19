<?php
die();
$username = 'omar.kool';
$url = "https://www.instagram.com/".$username;
$html = file_get_contents($url);
$arr = explode('window._sharedData = ',$html);
$arr = explode(';</script>',$arr[1]);
$obj = json_decode($arr[0] , true);


$des = $obj->user->biography;
$img = $obj->user->profile_pic_url;
$user_name = $obj->user->full_name;

		$user = $obj["entry_data"]["ProfilePage"][0]["graphql"]["user"];

		$res["username"] = $user["username"];
		$res["full_name"] = $user["full_name"];
		$res["id"] = $user["id"];
		$res["is_private"] = $user["is_private"];
		$res["profile_pic_url"] = $user["profile_pic_url"];
		$res["profile_pic_url_hd"] = $user["profile_pic_url_hd"];
		$res["biography"] = $user["biography"];
		$res["count"] = $user["edge_followed_by"]["count"];

echo $res["count"];
?>