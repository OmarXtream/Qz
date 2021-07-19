<?php
function sendMessage($chatID, $messaggio, $token) {
  //  echo "sending message to " . $chatID . "\n";

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$token = "775374883:AAEyMm1_9z1DInUhmPbDSOvetO-gqgPeunY";
$chatid = "-329131497";
$que = sendMessage($chatid, "Hello World", $token);
echo $que ;

?>