<?php
/**
 * Created by Malik Abiola.
 * Date: 28/02/2016
 * Time: 15:47
 * IDE: PhpStorm
 */
//Load composer autoload
require_once __DIR__ . '/vendor/autoload.php';
//load environment variables
(new \Dotenv\Dotenv(__DIR__))->load();


try {
    //create paystack lib object
    $paystack_lib_object = \MAbiola\Paystack\Paystack::make();
    $verification = $paystack_lib_object->verifyTransaction($_GET['trxref']);
    //if verification successful
    if ($verification) {
        //update customer records in db, probably add authorization for next time

        //redirect to a thank you page
        header('Location: thank_you.php');
    } else {
        header('Location: error.php');
    }

} catch (Exception $e) {
    header("Location: error.php?error={$e->getMessage()}");
}