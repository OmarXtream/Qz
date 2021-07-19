<?php
function buildBaseString($baseURI, $method, $params) {
    $r= array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[]= "$key=".rawurlencode($value);
    }
    return $method."&".rawurlencode($baseURI).'&'.rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r= 'Authorization: OAuth ';
    $values= array();
    foreach($oauth as $key=>$value) {
        $values[]= "$key=\"".rawurlencode($value)."\"";
    }
    $r.= implode(', ', $values);
    return $r;
}

function returnTweets($last_id) {
    $oauth_access_token         = "851910856933769216-3AiWPdw6c6QgPmCirLsddIe6YE6koWv";
    $oauth_access_token_secret  = "yj8m2rsvmEdB9ivJ1azIVZ1aQU8U2kMjiS7LZSEl42Lr2";
    $api_key                    = "CS6Pry0EkJ7KbTwUl6nh81kHP";
    $api_secret                 = "WO1SH3ojUc8gxVsutwQH6XKo05uVSXbDHf3hrzQbgPWAwEfnPX";
    $twitter_timeline           = "user_timeline";  //[mentions_timeline/user_timeline/home_timeline/retweets_of_me]
    //create request
    $request= array(
        'screen_name'       => 'runs_ES',
        'count'             => '3',
        'exclude_replies'   => 'true'
        );
    if (!is_null($last_id)) { //Add to the request if it exits a last_id
        $request['since_id']= $max_id;
    }
    $oauth = array(
        'oauth_consumer_key'        => $api_key,
        'oauth_nonce'               => time(),
        'oauth_signature_method'    => 'HMAC-SHA1',
        'oauth_token'               => $oauth_access_token,
        'oauth_timestamp'           => time(),
        'oauth_version'             => '1.0'
        );
    //merge request and oauth to one array
    $oauth= array_merge($oauth, $request);
    //do some magic
    $base_info=                 buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
    $composite_key=             rawurlencode($api_secret).'&'.rawurlencode($oauth_access_token_secret);
    $oauth_signature=           base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature']=  $oauth_signature;
    //make request
    $header= array(buildAuthorizationHeader($oauth), 'Expect:');
    $options= array(CURLOPT_HTTPHEADER => $header,
                    CURLOPT_HEADER => false,
                    CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false);
    $feed= curl_init();
    curl_setopt_array($feed, $options);
    $json= curl_exec($feed);
    curl_close($feed);
    return $json;
}

function parse_tweettext($tweet_text) {
    $text= substr($tweet_text, 0, -23);
    $short_url= substr($tweet_text, -23, 23);
    return array ('text'=>$text, 'short_url'=> $short_url);
}

function parse_tweetdatetime($tweetdatetime) {
    //Thu Aug 21 21:57:26 +0000 2014 Sun Mon Tue Wed Thu Fri Sat
    $months= array('Jan'=>'01', 'Feb'=>'02', 'Mar'=>'03', 'Apr'=>'04', 'May'=>'05', 'Jun'=>'06', 
                    'Jul'=>'07', 'Aug'=>'08', 'Sep'=>'09', 'Oct'=>'10', 'Nov'=>'11', 'Dec'=>'12');
    $GMT= substr($tweetdatetime, -10, 5);
    $year= substr($tweetdatetime, -4, 4);
    $month_str= substr($tweetdatetime, 4, 3);
    $month= $months[$month_str];
    $day= substr($tweetdatetime, 8, 2); 
    $dayofweek= substr($tweetdatetime, 0, 3);
    $time= substr($tweetdatetime, 11, 8);
    $date= $year.'-'.$month.'-'.$day;
    $datetime= $date.' '.$time;
    return array('datetime'=>$datetime, 'dayofweek'=>$dayofweek, 'GMT'=>$GMT);
    //datetime: "YYYY-MM-DD HH:MM:SS", dayofweek: Mon, Tue..., GMT: +####
}

//First check in the database the last id tweet:


$json= returnTweets($last_id);
$tweets= json_decode($json, TRUE);

foreach ($tweets as $tweet) {
    $tweet_id= $tweet['id'];
    if (!empty($tweet_id)) { //if array is not empty
        $tweet_parsetext= parse_tweettext($tweet['text']);
        $tweet_text= utf8_encode($tweet_parsetext['text']);
        $tweet_shorturl= $tweet_parsetext['short_url'];
        $tweet_parsedt= parse_tweetdatetime($tweet['created_at']);
        $tweet_datetime= $tweet_parsedt['datetime'];
        $tweet_dayofweek= $tweet_parsedt['dayofweek'];
        $tweet_GMT= $tweet_parsedt['GMT'];
        //Insert the tweet into the database:
        $fields = array(
            'id_tweet' => $tweet_id,
            'text_tweet' => $tweet_text,
            'datetime_tweet' => $tweet_datetime,
            'dayofweek_tweet' => $tweet_dayofweek,
            'GMT_tweet' => $tweet_GMT,
            'shorturl_tweet' => $tweet_shorturl
            );
        $new_id= mysql_insert('tweets', $fields);
    }
} //end of foreach
?>
