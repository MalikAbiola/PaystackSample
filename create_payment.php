<?php
/**
 * Created by Malik Abiola.
 * Date: 28/02/2016
 * Time: 14:58
 * IDE: PhpStorm
 */

//Load composer autoload
require_once __DIR__ . '/vendor/autoload.php';
//load environment variables
(new \Dotenv\Dotenv(__DIR__))->load();

//get customer email
$customer_email = $_POST['email'];

//create paystack lib object
$paystack_lib_object = \MAbiola\Paystack\Paystack::make();

//create transaction
try {
    $authorization = $paystack_lib_object->startOneTimeTransaction('20000', $customer_email);
    //we should probably save the reference and email here so we can match/update records
    //redirect to payment authorization URL
    header('Location: ' . $authorization['authorization_url']);
} catch (Exception $e) {
    header("Location: error.php?error={$e->getMessage()}");
}
