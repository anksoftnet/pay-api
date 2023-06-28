<?php
$merchantId = '';            // https://www.anksoft.net/odemeapi.php -> Satış Ortaklığı ID'si
$merchantPassword = '';      // https://www.anksoft.net/odemeapi.php -> Satış Ortaklığı Parolası

if (isset($_POST["status"]) && isset($_POST["order_id"]) && isset($_POST["merchant_id"]) && isset($_POST['hash']) && isset($_POST['amount']) && isset($_POST['full_name'])) { // Callback ile gelen değerleri kontrol ediyoruz. 

    $hash = base64_encode(hash_hmac('sha256', 'true' .('order_id') . $merchantId, $merchantPassword, true));

    if (post("hash") == $hash) {    // Gelen hash değeri ile oluşturduğumuz hash değerini karşılaştırıyoruz.
        if ($_POST["status"] == true) {  // Ödeme başarılı ise devam ediyoruz. 

            $paymentData = post("merchant_oid"); // Ödeme Yapan Kullanıcının Kullanıcı Adı
            $transID = post("order_id"); // Bu değer benzersiz olmalıdır. 
            $method = "credit_card"; // Ödeme methodu 
            $credit = post("amount"); // Kullanıcının ödediği tutarı alıyoruz. 
            $username = post("ExtraInfo"); // Kullanıcı adı veya herhangi bir şey göndermiş olabilirsiniz.

            #######################################################################
            #  CALLBACK PARAMETRE ÖRNEKLERİ                                       #
            #  BU SAYFAYA POST METHODU İLE GELECEK VERİLER AŞAĞIDA BELİRTİLMİŞTİR #
            #                                                                     #
            # [status]          ->  true (Başarılı) | false (Başarısız)           #
            # [order_id]        ->  string | Sipariş Numarası                     #
            # [merchant_id]     ->  string | Müşteri ID                           #
            # [amount]          ->  int    | Ödeme Miktarı                        #
            # [ExtraInfo]       ->  string | Kullanıcı Adı veya herhangi bir veri #
            # [hash]            ->  string | Kontrol amaçlı şifrelenmiş özel veri #
            #######################################################################

            // Ödeme başarılı ise kredi verme işlemlerini yapabilirsiniz.
            // Örnek olarak verdiğimiz kodlar ile kredi verme işlemlerini yapabilirsiniz.
            // Bu kodlar sadece örnek amaçlıdır. Kendi sistemlerinize göre düzenleyebilirsiniz.

            echo "OK"; // Bu kodu silmeyiniz. Bu kodu silerseniz ödeme işlemi başarısız olarak işaretlenir.
        } else {  // Ödeme başarısız ise devam ediyoruz. 
            echo "OK";
        }
    } else {  // Hash değerleri eşleşmiyorsa devam ediyoruz.
        echo "OK";
    }
} else { // Callback ile gelen değerler eksik ise devam ediyoruz. 
    echo "OK";
}
