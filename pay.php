<?php

    $merchantId = '';            // https://www.anksoft.net/odemeapi.php -> Affiliate Merchant ID
    $merchantPassword = '';      // https://www.anksoft.net/odemeapi.php -> Affiliate Merchant Password

    $full_name = '';             // Full name of the paying user
    $ExtraInfo = '';             // Required field, you can send username or any other info
    $email = '';                 // Email address of the paying user
    $phone = '';                 // Phone number of the paying user

    $OkUrl = '';                 // URL to redirect after successful payment
    $FailUrl = '';               // URL to redirect after failed payment
    $callback_url = '';          // Callback URL after payment is completed

    $Amount = '';                // Payment amount -> If 1 TL, send as 1
    $userIp = '';                // User's IP address
    $orderId = '';               // Unique Order ID
    $method = '';                // Payment Method -> (credit)

    $postFields = array( 
        "merchantId" => $merchantId,
        "merchantPassword" => $merchantPassword,
        'amount' => $Amount,
        'orderId' => $orderId,
        'full_name' => $full_name,
        "email" => $email,
        "phone" => $phone,
        'user_ip' => $userIp,
        'success_url' => $OkUrl,
        'fail_url' => $FailUrl,
        'callback_url' => $callback_url,
        'method' => $method,
        'ExtraInfo' => $ExtraInfo 
    );

    $curls=curl_init();
    curl_setopt($curls, CURLOPT_URL, 'https://www.anksoft.net/odeme/payment.php'); 
    curl_setopt($curls, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curls, CURLOPT_POST, true);
    curl_setopt($curls, CURLOPT_POSTFIELDS, $postFields); 
    curl_setopt($curls, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curls, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curls, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($curls, CURLOPT_TIMEOUT, 30);
    curl_setopt($curls, CURLOPT_CONNECTTIMEOUT, 30);
    $result = curl_exec($curls);
    curl_close($curls);
    $result = json_decode($result, true);
    if($result['status'] == 'success'){
        header('Location: '.$result['link']);
    }else{
        echo $result['message'];
    }

?>