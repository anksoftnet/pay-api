<?php
$merchantId = '';           // Merchant ID (can be obtained from https://www.anksoft.net/odemeapi.php)
$merchantPassword = '';     // Merchant Password (can be obtained from https://www.anksoft.net/odemeapi.php)

// Check incoming POST request parameters
if (isset($_POST["status"]) && isset($_POST["order_id"]) && isset($_POST["merchant_id"]) && isset($_POST['hash']) && isset($_POST['amount']) && isset($_POST['full_name'])) {

    // Create hash value with incoming parameters
    $hash = base64_encode(hash_hmac('sha256', 'true' . $_POST['order_id'] . $merchantId, $merchantPassword, true));

    // Compare the incoming hash value with the one we created
    if ($_POST["hash"] == $hash) {

        // If payment is successful, continue
        if ($_POST["status"] == true) {

            // Get required payment data
            $paymentData = $_POST["full_name"];    // Full name of the payer
            $transID = $_POST["order_id"];         // Unique order number
            $method = "credit_card";               // Payment method
            $credit = $_POST["amount"];            // Paid amount
            $username = $_POST["ExtraInfo"];       // Username or other extra info

            #######################################################################
            #  CALLBACK PARAMETER EXAMPLES                                        #
            #  THE DATA THAT WILL BE SENT TO THIS PAGE VIA POST METHOD IS BELOW   #
            #                                                                     #
            # [status]          ->  true (Success) | false (Failed)               #
            # [order_id]        ->  string | Order Number                         #
            # [merchant_id]     ->  string | Merchant ID                          #
            # [amount]          ->  int    | Payment Amount                       #
            # [ExtraInfo]       ->  string | Username or any data                 #
            # [hash]            ->  string | Encrypted special data for control   #
            #######################################################################

            // You can perform the crediting process here
            // The example code below is just a sample, you should adapt it to your own system

            echo "OK"; // Do not remove this code, otherwise the payment will be marked as failed
        } else {
            // If payment failed, still send "OK" message
            echo "OK";
        }
    } else {
        // If hash values do not match, still send "OK" message
        echo "OK";
    }
} else {
    // If POST request parameters are missing, still send "OK" message
    echo "OK";
}
