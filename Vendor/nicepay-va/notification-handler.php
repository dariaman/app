<?php
/*
 * ____________________________________________________________
 *
 * Copyright (C) 2016 NICE IT&T
 *
 * Please do not modify this module.
 * This module may used as it is, there is no warranty.
 *
 * @ description : PHP SSL Client module.
 * @ name        : notification-handler.php
 * @ author      : NICEPAY I&T (tech@nicepay.co.kr)
 * @ date        :
 * @ modify      : 21.07.2016
 *
 * 21.07.2016 Update Log
 * Please contact it.support@ionpay.net for inquiry
 *
 * ____________________________________________________________
 */
// Include the Transferpay class
include_once('lib/NicepayLib.php');

$nicepay = new NicepayLib();

// Listen for parameters passed
$pushParameters = array('tXid',
    'referenceNo',
    'merchantToken',
    'amt',
    'status',
    'matchCl',
    'bankCd',
    'vacctNo'
);

$nicepay->extractNotification($pushParameters);

$iMid               = $nicepay->iMid;
$tXid               = $nicepay->getNotification('tXid');
$referenceNo        = $nicepay->getNotification('referenceNo');     // customerId
$amt                = $nicepay->getNotification('amt');             // paid amt
$pushedToken        = $nicepay->getNotification('merchantToken');   // SHA256( Concatenate(iMid + customerId + amt + merchantKey) )
$matchAmount        = $nicepay->getNotification('matchCl');
$status             = $nicepay->getNotification('status');
$vacctNo            = $nicepay->getNotification('vacctNo');
$bankCd             = $nicepay->getNotification('bankCd');

$nicepay->set('tXid', $tXid);
$nicepay->set('referenceNo', $referenceNo);
$nicepay->set('amt', $amt);
$nicepay->set('iMid',$iMid);

$merchantToken = $nicepay->merchantTokenC();
$nicepay->set('merchantToken', $merchantToken);

// <RESQUEST to NICEPAY>
$paymentStatus = $nicepay->checkPaymentStatus($tXid, $referenceNo, $amt);

// <RESPONSE from NICEPAY>
// Please update the payment status in your database right after you get the latest payment status
if($pushedToken == $merchantToken) {
    // Print only OK, no HTML, no UI, no beauty poem. Also make sure HTTP code = 200
    echo "OK";

    // Update the payment status in your database based on $paymentStatus->StatusDescription,
    // Send email notification to customer to notify payment succeed

    // <RESPONSE from NICEPAY>
    // Please update the payment status in your database right after you get the latest payment status
    // For Virtual Account, there are reversal posibilities even  it's rare
    // Whenever you got status  $paymentStatus->status == 1, then it become failed transaction
    // echo "<pre>";
    // echo "$paymentStatus->status\n"; // This is Payment Status main reference to update Payment Status in merchant database
    /**
     **=========================================================================================================
     ** Credit Card
     **=========================================================================================================
     ** $paymentStatus->status == 0 // Success
     ** $paymentStatus->status == 1 // Void
     ** $paymentStatus->status == 2 // Refund
     ** $paymentStatus->status == 9 // Initialization or Unpaid
     **=========================================================================================================
     *
     **=========================================================================================================
     ** Virtual Account
     **=========================================================================================================
     ** $paymentStatus->status == 0 // Paid
     ** $paymentStatus->status == 1 // Reversal
     ** $paymentStatus->status == 3 // Unpaid
     ** $paymentStatus->status == 4 // Expired/Canceled by Merchant before Paid
     **=========================================================================================================
     */
    // echo "$paymentStatus->tXid\n";
    // echo "$paymentStatus->iMid\n";
    // echo "$paymentStatus->referenceNo\n";
    // echo "$paymentStatus->amt\n";
    // var_dump for more information
    // var_dump($paymentStatus);
    // echo "</pre>";
    switch ($paymentStatus->status) {
        case '0':
        // TODO Action if payment = Success/Paid
        break;

        case '1':
        // TODO Action if payment = Void/Reversal
        break;

        case '2':
        // TODO Action if payment = Refund
        break;

        case '3':
        // TODO Action if payment = Unpaid
        break;

        case '4':
        // TODO Action if payment = Expired/Canceled by Merchant before Paid
        break;

        case '9':
        // TODO Action if payment = Initialization or Unpaid
        break;

        default:
        // TODO Undefined status, log error
        break;
    }

}
