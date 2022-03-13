<?php 
$merchantId = '';            // https://www.anksoft.net/odemeapi.php -> Satış Ortaklığı ID'si
$merchantPassword = '';      // https://www.anksoft.net/odemeapi.php -> Satış Ortaklığı Parolası

if (isset($_POST["status"]) && isset($_POST["order_id"]) && isset($_POST["merchant_id"]) && isset($_POST['hash']) && isset($_POST['amount']) && isset($_POST['full_name'])) { // Gelen dataları kontrol ediyoruz.

    $hash = base64_encode(hash_hmac('sha256', true.post('order_id').$merchantId, $merchantPassword, true)); // Gelen Dataları şifreleyiyoruz.

    if (post("hash") == $hash) { // Kontrol ettiriyoruz doğruysa devam ediyoruz.
        if ($_POST["status"] == true) { // Eğer ödeme başarılı ise kredi verme işlemlerine geçiyoruz.

            $paymentData = post("merchant_oid");
            $transID = post("order_id");
            $method = "credit_card";
            $credit = post("amount");
            $username = post("ExtraInfo");

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


            echo "OK";
        } else {
            echo "OK";
            //die("Ödeme işlemi iptal edildi!");
        }
    } else {
        echo "OK";
        //die("Ödeme işlemi güvenlik kontrolünden geçemedi!");
    }
} else {
    echo "OK";
    // die("Ödeme verileri hatalı!");
}

?>