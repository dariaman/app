<?php
/*
 * ____________________________________________________________
 *
 * Copyright (C) 2016 NICE IT&T
 *
 *
 * This config file may used as it is, there is no warranty.
 *
 * @ description : PHP SSL Client module
 * @ name        : NicepayLite.php
 * @ author      : NICEPAY I&T (tech@nicepay.co.kr)
 * @ date        :
 * @ modify      : 29.07.2016
 *
 * 29.07.2016 Update Log
 *
 * ____________________________________________________________
 */

// Please set the following
// Default MID & Merchant Key
define("NICEPAY_IMID",              "IONPAYTEST");                                                  // Merchant ID
define("NICEPAY_MERCHANT_KEY",      "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A=="); // API Key

//define("NICEPAY_CALLBACK_URL",      "http://example.com/result.html");                       // Merchant's result page URL
//define("NICEPAY_DBPROCESS_URL",     "https://hookb.in/va3ne3Vm");          // Merchant's notification handler URL
define("NICEPAY_CALLBACK_URL",     $_SERVER['HTTP_REFERER'] );                       // Merchant's result page URL
//define("NICEPAY_DBPROCESS_URL",     "http://202.169.43.67/webservice/InputPaymentGateway.asmx");          // Merchant's notification handler URL
//define("NICEPAY_DBPROCESS_URL",     "http://202.169.43.67/webservice/InputPaymentGateway.asmx?op=UpdateResultNicePayinXML");          // Merchant's notification handler URL

define("NICEPAY_DBPROCESS_URL",     "http://103.24.12.244/ApiRest/input_notifikasi_nicepay");          // Merchant's notification handler URL

/* TIMEOUT - Define as needed (in seconds) */
define( "NICEPAY_TIMEOUT_CONNECT", 15 );
define( "NICEPAY_TIMEOUT_READ", 25 );

// Please do not change

define("NICEPAY_PROGRAM",                       "NicepayLite");
define("NICEPAY_VERSION",                       "1.16");
define("NICEPAY_BUILDDATE",                     "20160719");
define("NICEPAY_REQ_CC_URL",                    "https://www.nicepay.co.id/nicepay/api/orderRegist.do");            // Credit Card API URL
define("NICEPAY_REQ_VA_URL",                    "https://www.nicepay.co.id/nicepay/api/onePass.do");                // Request Virtual Account API URL
define("NICEPAY_CANCEL_VA_URL",                 "https://www.nicepay.co.id/nicepay/api/onePassAllCancel.do");       // Cancel Virtual Account API URL
define("NICEPAY_ORDER_STATUS_URL",              "https://www.nicepay.co.id/nicepay/api/onePassStatus.do");          // Check payment status URL
define("NICEPAY_FIX_REG_CUSTOMER_ID",           "https://www.nicepay.co.id/nicepay/api/vacctCustomerRegist.do");    // Register customer ID (Fix Account)
define("NICEPAY_FIX_RETRIEVE_VA_INFO",          "https://www.nicepay.co.id/nicepay/api/vacctCustomerInquiry.do");   // List customer ID (Fix Account)
define("NICEPAY_FIX_LIST_DEPOSIT_CUSTOMERID",   "https://www.nicepay.co.id/nicepay/api/vacctCustomerIdInquiry.do"); // List Status VA by Customer ID (Fix Account)
define("NICEPAY_FIX_LIST_DEPOSIT_VA",           "https://www.nicepay.co.id/nicepay/api/vacctInquiry.do"); // List Status VA (Fix Account)


// define("NICEPAY_PROGRAM",                       "NicepayLite");
// define("NICEPAY_VERSION",                       "1.16");
// define("NICEPAY_BUILDDATE",                     "20160719");
// define("NICEPAY_REQ_CC_URL",                    "https://dev.nicepay.co.id/nicepay/api/orderRegist.do");            // Credit Card API URL
// define("NICEPAY_REQ_VA_URL",                    "https://dev.nicepay.co.id/nicepay/api/onePass.do");                // Request Virtual Account API URL
// define("NICEPAY_CANCEL_VA_URL",                 "https://dev.nicepay.co.id/nicepay/api/onePassAllCancel.do");       // Cancel Virtual Account API URL
// define("NICEPAY_ORDER_STATUS_URL",              "https://dev.nicepay.co.id/nicepay/api/onePassStatus.do");          // Check payment status URL
// define("NICEPAY_FIX_REG_CUSTOMER_ID",           "https://dev.nicepay.co.id/nicepay/api/vacctCustomerRegist.do");    // Register customer ID (Fix Account)
// define("NICEPAY_FIX_RETRIEVE_VA_INFO",          "https://dev.nicepay.co.id/nicepay/api/vacctCustomerInquiry.do");   // List customer ID (Fix Account)
// define("NICEPAY_FIX_LIST_DEPOSIT_CUSTOMERID",   "https://dev.nicepay.co.id/nicepay/api/vacctCustomerIdInquiry.do"); // List Status VA by Customer ID (Fix Account)
// define("NICEPAY_FIX_LIST_DEPOSIT_VA",           "https://dev.nicepay.co.id/nicepay/api/vacctInquiry.do"); // List Status VA (Fix Account)


define("NICEPAY_READ_TIMEOUT_ERR",  "10200");

/* LOG LEVEL */

define("NICEPAY_LOG_CRITICAL", 1);
define("NICEPAY_LOG_ERROR", 2);
define("NICEPAY_LOG_NOTICE", 3);
define("NICEPAY_LOG_INFO", 5);
define("NICEPAY_LOG_DEBUG", 7);
