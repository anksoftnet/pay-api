<?php

    $merchantId = '';            // https://www.anksoft.net/odemeapi.php -> Satış Ortaklığı Merchant ID'si
    $merchantPassword = '';      // https://www.anksoft.net/odemeapi.php -> Satış Ortaklığı merchantPassword

    $full_name = '';             // Ödeme Yapan Kullanıcının Tam Adı
    $ExtraInfo = '';             // Zorunlu Alandır, kullanıcı adı ve ya herhangi bir şey gönderebilirsiniz.
    $email = '';                 // Ödeme Yapan Kullanıcının Mail Adresi
    $phone = '';                 // Ödeme Yapan Kullanıcının Telefon Numarası

    $OkUrl = '';                 // Ödeme tamamlandıktan sonra başarılı dönecek adres
    $FailUrl = '';               // Ödeme tamamlandıktan sonra hata dönecek adres
    $callback_url = '';          // Ödeme tamamlandıktan sonra dönecek callback adres

    $Amount = '';                // Ödeme Tutarı -> 1 TL ise 1 olarak gönderilecek
    $userIp = '';                // Kullanıcının ip adresi
    $orderId = '';               // Benzersiz Sipariş ID'si
    $method = '';                // Ödeme Methodu -> (credit)

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
    curl_setopt($curls, CURLOPT_POST, true) ;
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
        header('Location: '.$result['url']);
    }else{
        echo $result['message'];
    }

?>