<?php
require 'config.php';

// Prevent non login user
if ( !isset( $_SESSION['user'])) {
    header('Location:login.php');
}
// Check if _POST request was not sent
if ( !isset( $_POST)) {
    header('Location:wallet.php');
}

$curl = curl_init();

$email = $_SESSION['user']['email'];
$amount = 100 * $_POST['amount'];  // the amount in kobo. 

// url to go to after payment
$callback_url = BASE . '/addfund.php';  

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
    'callback_url' => $callback_url,
    'metadata' => [
      'custom_fields' => [
      ]
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer " . PAYSTACK_SECRET, //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if( $err ){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$responseMsg = json_decode($response, true);

if ( ! $responseMsg->status ) {
  // there was an error from the API
  print_r('API returned error: ' . $responseMsg['message']);
}
// View response
// print_r($responseMsg);

// redirect to page so User can pay
// Redirct User topaystack payment page 
header('Location: ' . $responseMsg['data']['authorization_url']);
