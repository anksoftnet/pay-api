<?php
$merchantId = '';           // Satış Ortaklığı ID'si (https://www.anksoft.net/odemeapi.php'den alınabilir)
$merchantPassword = '';     // Satış Ortaklığı Parolası (https://www.anksoft.net/odemeapi.php'den alınabilir)

// Gelen POST isteği parametrelerini kontrol ediyoruz
if (isset($_POST["status"]) && isset($_POST["order_id"]) && isset($_POST["merchant_id"]) && isset($_POST['hash']) && isset($_POST['amount']) && isset($_POST['full_name'])) {

    // Gelen parametrelerle hash değerini oluşturuyoruz
    $hash = base64_encode(hash_hmac('sha256', 'true' . $_POST['order_id'] . $merchantId, $merchantPassword, true));

    // Gelen hash değerini oluşturduğumuz hash ile karşılaştırıyoruz
    if ($_POST["hash"] == $hash) {

        // Ödeme başarılıysa devam ediyoruz
        if ($_POST["status"] == true) {

            // Gerekli ödeme verilerini alıyoruz
            $paymentData = $_POST["full_name"];    // Ödeme yapan kullanıcının tam adı
            $transID = $_POST["order_id"];         // Benzersiz sipariş numarası
            $method = "credit_card";                // Ödeme yöntemi
            $credit = $_POST["amount"];            // Ödenen miktar
            $username = $_POST["ExtraInfo"];       // Kullanıcı adı veya diğer ekstra bilgiler

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

            // Kredi verme işlemlerini burada gerçekleştirebilirsiniz
            // Örnek olarak verilen kodlar sadece bir örnek olup, kendi sistemlerinize göre düzenlemeniz gerekmektedir

            echo "OK"; // Bu kodu silmeyin, aksi takdirde ödeme işlemi başarısız olarak işaretlenir
        } else {
            // Ödeme başarısız ise yine "OK" mesajı gönderiyoruz
            echo "OK";
        }
    } else {
        // Hash değerleri eşleşmiyorsa yine "OK" mesajı gönderiyoruz
        echo "OK";
    }
} else {
    // Gelen POST isteği parametreleri eksikse yine "OK" mesajı gönderiyoruz
    echo "OK";
}
