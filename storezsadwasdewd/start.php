<?php

require 'vendor/autoload.php';
// $siteurl = "https://panel.q-z.us/store";
$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AWeLIF-kAsjyPvNRTDff8ZHfRLSIrZUHPbf6M9mwjspe1wylx7UG9yqfAuDUcL5Qk-qZr2v9nrTmUVvd',     // ClientID
            'ECQT5mcsg7pIxtN1mfz5Wu-RFDWma42FpTYMp57BVHW2-hbFbSiaA9neomVKm_iPW2YauvUzm8mecxOV'     // ClientSecret
        )
);
$apiContext->setConfig(array('mode' => 'live'));
?>