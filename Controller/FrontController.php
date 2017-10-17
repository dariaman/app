<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');
App::uses('NicePay', 'nicepay-va');

class FrontController extends AppController {

    public $uses = array('Survey', 'ApiXml', 'User', 'Product', 'News', 'MetaTitle', 'sendEmail', 'Val', 'Mudik', 'Black', 'Banner', 'Quotejai', 'Payment', 'JadwalPray', 'Promo', 'Rawat', 'SurveyVisitor', 'Linequiz', 'Cinema', 'Jadwal', 'Ticket', 'Ticket_Log', 'Egift', 'Egift_log');
    public $components = array(
        'Session',
        'Captcha' => array(
            'type' => array('alpha'),
            'rotate' => false,
            'theme' => 'green',
            'height' => 40,
            'width' => 120,
        ),
        'Security' => array('csrfUseOnce' => false),
        'Cookie',
        'RequestHandler',
        'Auth' => array(
            'loginAction' => array('controller' => 'front', 'action' => 'login'),
            'logoutAction' => array('controller' => 'front', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'front', 'action' => 'home'),
            'authError' => "you can't access that page",
        )
    );
    public $captchas = array('captcha');
    public $helpers = array('Js' => array('Jquery'), 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->authenticate = array('Form');
        $this->Auth->authorize = array('Controller');
        $this->Security->validatePost = false;
        $this->Security->blackHoleCallback = 'redirectBC';
        // //$this->Security->unlockAction=array('thanks_cimbclick');
        //$this->Security->csrfCheck=false;	
        $this->Security->csrfExpires = '+10 hour';
        $this->Auth->allow();
        $_metaTitle = $this->MetaTitle->getMeta($this->params['action']);
        if (!$this->Auth->loggedIn())
            $this->Auth->deny('premium_payment', 'claim');  //action apa saja yang harus login terlebih dahulu
        $this->Security->unlockedActions = array('response_creditcard', 'response_purchase', 'response_premi', 'response_creditcard_premi', 'ajax_getCoveragePolicy', 'form_promotion', 'thanks_cimbclick', 'backend_cimb', 'jagaamanbersamaMRA', 'response_bca_inquiry', 'response_bca_flag', 'submitSurveyVisitor', 'jagaamanmudik', 'jagojek_isi', 'jagojek_daftar', 'jmk_cek_SI', 'jmk_cal_non_unitlink_ajax', 'send_our_data', 'jmk_add_your_beneficery', 'step1_add_ah', 'cal_non_unitlink_ajax', 'step1_non_unitlink', 'step4_checkout');
        $this->layout = 'front';

        if ($this->Session->read('Auth.User.role') == 'admin')
            $this->redirect(array('controller' => 'adm', 'action' => 'logout'));

        $_menu['accidental'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 1, 'Product.quote_id !=' => 'jaga-aman-plus7', 'Product.publish' => 1)));
        $_menu['life'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 2, 'Product.quote_id !=' => 'jaga-jiwa-plus7', 'Product.publish' => 1)));
        $_menu['health'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 3, 'Product.publish' => 1)));
        $_menu['unitlink'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 4, 'Product.publish' => 1)));
        //$_menu['general'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 5, 'Product.publish' => 1)));
        //news
        $_news = $this->News->find('all', array('limit' => 3, 'order' => array('created DESC')));
        $_mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Agu", 9 => "Sep", 10 => "Okt", 11 => "Nov", 12 => "Dec");

        /* GetData Flexy Link */
        $_dataFund = $this->ApiXml->getDataFund();
        $this->set(compact('_menu', '_metaTitle', '_dataFund', '_news', '_mons'));
    }

    public function form_promotion() {
        $data = $this->request->data;
        if ($this->request->is('post') && (isset($data['token']) && $data['token'] == '3fb5d2c5f1558e5ab26117fec206c6f6db3c4028')) {
            $data = $this->request->data;
            $this->ApiXml->sendLeaveNumber($data);
            //$this->ApiXml->pushCTS($data['contact_name'], $data['contact_phone'], 'Gmail Sponsored Promotions', '');
            $this->redirect(array('controller' => 'front', 'action' => 'home'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function isAuthorized($user) {
        return (bool) ($user['role'] === 'frontCAF');
        return false;
    }

    public function response_purchase() {
        $this->autoRender = false;
        if ($this->request->is('post') && isset($this->request->data['klikPayCode'])) {
            $data_sprint = $this->request->data;
            $this->request->data['approvalCode'] = isset($this->request->data['approvalCode']['fullTransaction']) ? $this->request->data['approvalCode']['fullTransaction'] : '';
            try {
                if (substr($data_sprint['transactionNo'], 0, 1) == 'J') { // JAI
                    $transactionNo = $data_sprint['transactionNo'];
                    $totalAmount = $data_sprint['totalAmount'];
                    $authKey = $data_sprint['authKey'];
                    $approvalCode = $this->request->data['approvalCode'];
                    $transactionDate = date_format(date_create_from_format('d/m/Y H:i:s', $data_sprint['transactionDate']), 'Y-m-d H:i:s');
                    $rescount = $this->Payment->find('first', array('fields' => array('Payment.id, Payment.klikPayCode, Payment.status, Payment.totalAmount, Payment.authKey'), 'conditions' => compact('transactionDate', 'transactionNo')));
                    if (count($rescount) == 1) {
                        if ($data_sprint['klikPayCode'] != $rescount['Payment']['klikPayCode']) {
                            $id = 2;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' klikPayCode tidak cocok');
                        } else if ($totalAmount != $rescount['Payment']['totalAmount']) {
                            $id = 2;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' Total Amount tidak cocok');
                        } else if ($authKey != $rescount['Payment']['authKey']) {
                            $id = 2;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' authKey tidak cocok');
                        } else if ($rescount['Payment']['status'] == '00') {
                            $id = 3;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' Transaksi sudah pernah dibayar');
                        } else {
                            $id = 1;
                            $status = '00';
                            $this->Payment->updateAll(
                                    array('approvalCode' => "'" . $approvalCode . "'", 'status' => "'" . $status . "'", 'reason_id' => "'" . $id . "'", 'reason_ind' => "'Sukses'", 'reason_en' => "'Success'"), array('transactionNo' => $data_sprint['transactionNo']));
                        }
                    } else {
                        $id = 2;
                        CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' transactionNo dan transactionDate tidak cocok');
                    }

                    if ($id == 2) {
                        $this->Payment->updateAll(
                                array('reason_id' => "'" . $id . "'", 'reason_ind' => "'Transaksi Anda tidak dapat diproses.'", 'reason_en' => "'Your transaction cannot be processed.'"), array('transactionNo' => $data_sprint['transactionNo']));
                    } else if ($id == 3) {
                        $this->Payment->updateAll(
                                array('reason_id' => "'" . $id . "'", 'reason_ind' => "'Transaksi Anda sudah dibayar.'", 'reason_en' => "'Your transaction has been paid.'"), array('transactionNo' => $data_sprint['transactionNo']));
                    }
                } else if (strlen($data_sprint['transactionNo']) <= 10) {
                    $id = $this->ApiXml->updatePaymentKlikBCA($this->request->data); //utk pembayaran 1
                    CakeLog::write('klikpay', '[APIResponse] ' . $id . ' [transactionNo] ' . $data_sprint['transactionNo']);
                } else
                    $id = $this->ApiXml->updatePaymentKlikBCAPremi($this->request->data); //utk pembayaran 2
            } catch (Exception $e) {
                $id = 7;
                CakeLog::write('error', $e);
            }
            if ($id == 1) {
                $status = '00';
                $reason = array('english' => 'Success', 'indonesian' => 'Sukses');
            } else {
                $status = '01';
                if ($id == 3) {
                    $reason = array('english' => 'Your transaction has been paid.', 'indonesian' => 'Transaksi Anda sudah dibayar.');
                } else if ($id == 4) {
                    $reason = array('english' => 'Your transaction has been canceled.', 'indonesian' => 'Transaksi Anda telah dibatalkan.');
                } else if ($id == 6) {
                    $reason = array('english' => 'Your transaction already expired.', 'indonesian' => 'Transaksi Anda telah kedaluarsa.');
                } else {
                    $reason = array('english' => 'Your transaction cannot be processed.', 'indonesian' => 'Transaksi Anda tidak dapat diproses.');
                }
            }
            $this->RequestHandler->respondAs('xml');
            $xmlArray = array(
                'OutputPaymentIPAY' => array(
                    'status' => $status,
                    'reason' => $reason,
                    'klikPayCode' => $data_sprint['klikPayCode'],
                    'transactionDate' => $data_sprint['transactionDate'],
                    'currency' => $data_sprint['currency'],
                    'totalAmount' => $data_sprint['totalAmount'],
                    'payType' => $data_sprint['payType'],
                    'additionalData' => '',
                    'approvalCode' => array(
                        'fullTransaction' => (isset($data_sprint['approvalCode']['fullTransaction'])) ? $data_sprint['approvalCode']['fullTransaction'] : '',
                        'installmentTransaction' => (isset($data_sprint['approvalCode']['installmentTransaction'])) ? $data_sprint['approvalCode']['installmentTransaction'] : ''
                    )
                )
            );
            $xmlObject = Xml::fromArray($xmlArray, array('format' => 'tags'));
            $xmlString = $xmlObject->asXML();
            echo $xmlString;
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function nicepay_purchaseX() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('post')) {
            $id = $this->request->query['id'];
            echo $id;
        }
    }

    /* --------------------------------------------------
     * 	NICEPAY VA - PAYMENT - Initial
     * 	Created by - JOJO
     * 	28 Sept 2017 -> go live 3 okt 2017
     * ---------------------------------------------------
     */

    public function nicepay_payment() {

        $tXid = $this->Session->read('VA.tXid');
        $callback = $this->Session->read('VA.callbackUrl');
        $desc = $this->Session->read('VA.description');
        $date = $this->Session->read('VA.payment_date');
        $time = $this->Session->read('VA.payment_time');
        $va_no = $this->Session->read('VA.virtual_account_no');
        $amount = $this->Session->read('VA.amount');
        $rcode = $this->Session->read('VA.result_code');
        $rmsg = $this->Session->read('VA.result_message');
        $refno = $this->Session->read('VA.reference_no ');
        $paymthd = $this->Session->read('VA.payment_method');
        $quoteid = $this->Session->read('VA.QuoteID');
        $quoterefno = $this->Session->read('VA.quoterefno');
        $nama = $this->Session->read('VA.name');
        $bankcode = $this->Session->read('VA.bank');
        $produk = $this->Session->read('VA.produk');
        $banklist = array(
            'CENA' => 'BCA',
            'BNIN' => 'BNI',
            'BMRI' => 'Mandiri',
            'HNBN' => 'KEB Hana Bank',
            'BBBA' => 'Permata',
            'IBBK' => 'BII Maybank',
            'BNIA' => 'Cimb Niaga',
            'BRIN' => 'BRI',
            'BDMN' => 'Danamon',
        );
        $bank = $banklist[$bankcode];


        $this->set(compact('tXid', 'desc', 'date', 'time', 'va_no', 'amount', 'refno', 'quoteid', 'bank', 'nama', 'quoterefno', 'produk'));

        $hardcopy = $this->Session->read('Purchase.step1.HARD_COPY');
        $cashless = $this->Session->read('Purchase.step1.CASHLESS');
        $cashlessFee = $this->Session->read('Purchase.step1.cashlessFee');
        $this->set(compact('cashless', 'hardcopy', 'cashlessFee'));

        $this->Session->delete('Purchase');
    }

    public function nicepay_purchase() {
        $this->autoRender = false;
        $this->layout = "ajax";

        include_once "../Vendor/nicepay-va/checkout.php";

//$quote = $this->ApiXml->getQuoteByID( $this->Session->read('Purchase.QUOTE_ID') );
//$quoterefno= $quote['QuoteNo'];

        if ($this->Session->read('Purchase.step1.product_id') != 7) {
            $quote = $this->ApiXml->getQuoteByID($this->Session->read('Purchase.QUOTE_ID'));
            $quoterefno = $quote['QuoteNo'];
        } else {
            $this->Quotejai->getDataSource()->begin();
            $this->Quotejai->save();
            $this->Quotejai->getDataSource()->commit();
            $this->Session->write('Purchase.QUOTE_ID', 'J' . $this->Quotejai->id);
            $quote['QuoteNo'] = 'J' . $this->Quotejai->id;
            $quoterefno = $quote['QuoteNo'];
        }

        if ($this->Session->read('Purchase.step1.product_id') == 24) {  // jaga motorku
            $this->Session->write('Purchase.step2.PROSPECT_NAME', $this->Session->read('Purchase.step1.PROSPECT_NAME'));
            $this->Session->write('Purchase.step2.PROSPECT_DOB', $this->Session->read('Purchase.step1.PROSPECT_DOB'));
            $this->Session->write('Purchase.step2.PROSPECT_GENDER', $this->Session->read('Purchase.step1.PROSPECT_GENDER'));
            $this->Session->write('Purchase.step2.PROSPECT_ADDRESS', $this->Session->read('Purchase.step1.PROSPECT_ADDRESS'));
            $this->Session->write('Purchase.step2.PROSPECT_EMAIL', $this->Session->read('Purchase.step1.PROSPECT_EMAIL'));
            $this->Session->write('Purchase.step2.PROSPECT_MOBILE_PHONE', $this->Session->read('Purchase.step1.PROSPECT_MOBILE_PHONE'));
        }

        /*
         * ____________________________________________________________
         *
         * Virtual Account Payment Method
         * ____________________________________________________________
         */
        //  if(isset($_POST['payMethod'])
        //      && $_POST['payMethod'] == '02'
        //      && isset($_POST['bankCd'])
        //      && $_POST['bankCd']
        //      )
        //  {
        $bankCd = $this->request->query['bankCd']; //$_POST['bankCd'];
        $amount = $this->request->query['Amount']; //$_POST['Amount'];
        $dateNow = date('Ymd');
        $vaExpiryDate = date('Ymd', strtotime($dateNow . ' +3 day')); // Set VA expiry date +1 day (optional)
        //$iMid		= "VACCTCLOSE";
        $iMid = "IONPAYTEST";
        //$iMid		= "JAGADIRI77";

        $merchantKey = "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A=="; // ionpaytest
        //$merchantKey	= "wCTyQTMtKM6wi4L4sGQdZKAUajjCJaoQpRkpylo+2DgMspCHsWZ1Q8BT3l1Mc8uZOIhGCHQG/AwwBT3Y1BfDtA==";//jagadiri77
        $merchantToken = hash('sha256', $iMid . $quoterefno . $amount . $merchantKey);

        // Populate Mandatory parameters to send
        $nicepay->iMid = $iMid; // Set MID
        $nicepay->merchantKey = $merchantKey; // Set Merchant Key
        $nicepay->set('payMethod', '02');
        $nicepay->set('currency', 'IDR');
        $nicepay->set('amt', $amount); // Total gross amount
        //$nicepay->set('referenceNo', generateReference()); // Invoice Number or Referenc Number Generated by merchant
        //$nicepay->set('description', 'Payment of Invoice /No '.$nicepay->get('referenceNo')); // Transaction description
        $nicepay->set('referenceNo', $quoterefno); // Invoice Number or Referenc Number Generated by merchant
        $nicepay->set('description', 'CAF Premi Pertama'); // Transaction description

        $nicepay->set('bankCd', $bankCd);

        $nicepay->set('billingNm', $this->Session->read('Purchase.step2.PROSPECT_NAME')); // Customer name  
        $nicepay->set('billingPhone', $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE')); // Customer phone number
        $nicepay->set('billingEmail', $this->Session->read('Purchase.step2.PROSPECT_EMAIL')); //
        $nicepay->set('billingAddr', $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'));
        $nicepay->set('billingCity', 'N/A');
        $nicepay->set('billingState', 'N/A');
        $nicepay->set('billingPostCd', 'N/A');
        $nicepay->set('billingCountry', 'Indonesia');

        $nicepay->set('deliveryNm', $this->Session->read('Purchase.step2.PROSPECT_NAME')); // Delivery name
        $nicepay->set('deliveryPhone', $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE'));
        $nicepay->set('deliveryEmail', $this->Session->read('Purchase.step2.PROSPECT_EMAIL'));
        $nicepay->set('deliveryAddr', $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'));
        $nicepay->set('deliveryCity', 'N/A');
        $nicepay->set('deliveryState', 'N/A');
        $nicepay->set('deliveryPostCd', 'N/A');
        $nicepay->set('deliveryCountry', 'Indonesia');
        $nicepay->set('vacctValidDt', $vaExpiryDate); // Set VA expiry date example: +1 day
        $nicepay->set('vacctValidTm', date('His')); // Set VA Expiry Time
        // Send Data
        $response = $nicepay->requestVA();

        //var_dump($nicepay->requestData);
        //var_dump($response);
        //exit();
        // Response from NICEPAY
        //print_r($response); exit;

        if (isset($response->resultCd) && $response->resultCd == "0000") {
            $this->Session->write('VA.tXid', $response->tXid);
            $this->Session->write('VA.callbackUrl', $response->callbackUrl);
            $this->Session->write('VA.description', $response->description);
            $this->Session->write('VA.payment_date', $response->transDt);
            $this->Session->write('VA.payment_time', $response->transTm);
            $this->Session->write('VA.virtual_account_no', $response->bankVacctNo);
            $this->Session->write('VA.amount', $response->amount);
            $this->Session->write('VA.result_code', $response->resultCd);
            $this->Session->write('VA.result_message', $response->resultMsg);
            $this->Session->write('VA.reference_no ', $response->referenceNo);
            $this->Session->write('VA.payment_method', $response->payMethod);
            $this->Session->write('VA.QuoteID', $this->Session->read('Purchase.QUOTE_ID'));
            $this->Session->write('VA.quoterefno', $quoterefno);
            $this->Session->write('VA.bank', $bankCd);
            $this->Session->write('VA.name', $this->Session->read('Purchase.step2.PROSPECT_NAME'));
            $this->Session->write('VA.produk', $this->Session->read('Purchase.produk'));
            $this->Session->write('VA.seo', $this->Session->read('Purchase.flow.name'));

            $dataVA = array(
                'TX_ID' => $response->tXid,
                'IMID' => $iMid,
                'CURRENCY' => 'IDR',
                'AMOUNT' => $amount,
                'INSTMNTMOM' => 'INSTMNTMOM',
                'INSTMNTTYPE' => 'INSTMNTTYPE',
                'REFNO' => $quoterefno,
                'GOODSNM' => 'GOODSNM',
                'PAYMETHOD' => '02',
                'BILINGNM' => $this->Session->read('Purchase.step2.PROSPECT_NAME'),
                'BILLINGPHONE' => $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE'),
                'BILLINGEMAIL' => $this->Session->read('Purchase.step2.PROSPECT_EMAIL'),
                'BILLINGADDR' => $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'),
                'BILLINGCITY' => 'Jakarta Barat',
                'BILLINGSTATE' => 'DKI Jakarta',
                'BILLINGPOSTCD' => '11410',
                'BILLINGCOUNTRY' => 'Indonesia',
                'DELIVERYNM' => $this->Session->read('Purchase.step2.PROSPECT_NAME'),
                'DELIVERYPHONE' => $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE'),
                'DELIVERYADDRESS' => $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'),
                'DELIVERYCITY' => 'Jakarta Barat',
                'DELIVERYSTATE' => 'DKI Jakarta',
                'DELIVERYPOSTCD' => '11410',
                'DELIVERYCOUNTRY' => 'Indonesia',
                'VAT' => '0',
                'FEE' => '0',
                'NOTAXADMIN' => '0',
                'DESC' => $response->description,
                'MERCHANTTOKEN' => $merchantToken,
                'REGDT' => $response->transDt,
                'REGTM' => $response->transTm,
                'RESULTMSG' => $response->resultMsg,
                'RESULTCODE' => $response->resultCd,
                'MERFIXACCID' => 'MERFIXACCID',
                'VACCTVALIDDT' => $response->transDt,
                'VACCTVALIDTM' => $response->transTm,
                'CALLBACKURL' => $response->callbackUrl
            );

            //call ws to save data
            $id_NICE = $this->ApiXml->savePaymentNicePay($dataVA);

            //if(isset($id_NICE))

            if ($id_NICE) {
                echo "7";
            } else {
                echo "1";
            }

            //var_dump($id_NICE);
            /*
              echo "<pre>";
              echo "tXid              : $response->tXid (Save to your database to check status) \n";
              echo "callbackUrl       : $response->callbackUrl\n";
              echo "description       : $response->description\n";
              echo "payment date      : $response->transDt\n"; // YYMMDD
              echo "payment time      : $response->transTm\n"; // HH24MISS
              echo "virtual account   : $response->bankVacctNo (For customer to transfer) \n";
              echo "amount            : $response->amount (For customer to transfer) \n";
              echo "result code       : $response->resultCd\n";
              echo "result message    : $response->resultMsg\n";
              echo "reference no      : $response->referenceNo\n";
              echo "payment method    : $response->payMethod";
              echo "</pre>";
             */
        } elseif (isset($response->resultCd)) {
            // API data not correct, you can redirect back to checkout page or echo error message.
            // In this sample, we echo error message
            echo "<pre>";
            echo "result code       :" . $response->resultCd . "\n";
            echo "result message    :" . $response->resultMsg . "\n";
            echo "</pre>";
        } else {
            // Timeout, you can redirect back to checkout page or echo error message.
            // In this sample, we echo error message
            echo "<pre>Connection Timeout. Please Try again.</pre>";
        }

        //}else echo "not post";
    }

    /* --------------------------------------------------
     * 	NICEPAY VA - PAYMENT - end
     * 	Created by - JOJO
     * 	28 Sept 2017
     * ---------------------------------------------------
     */

    public function Rnicepay_reversal() {
        $this->autoRender = false;
        $this->layout = "ajax";
//	if ($this->request->is('post')){
        $jsondata = '[{"customerId" : "891011101",
				"merchantToken" : "141fd2368aa80ea0e600b1b4d7a42c1e731e74a27a03521e8e28150cc00bc05b",
				"referenceNo" : "ref100000001",
				"prefix" : "7015102",
				"bankCd" : "CENA",
				"amt" : "50000",
				"tXid" : "FIXOPEN0010000000006"
				}]';
        $obj = json_decode($jsondata, true);
        /* 	//In case have multiple array
          foreach ($obj as $k){
          echo $k['customerId'];
          }
          //else */
        //echo $obj[0]['customerId'];
        //echo $obj[0]['merchantToken'];
        //echo $obj[0]['prefix'];
        //echo $obj[0]['bankCd'];



        /* 	//if 
          $jsondata = '{"name": "ram"}';
          $obj = json_decode($jsondata,true);
          //use
          echo $obj['name']; */

        $return = array('billingNm' => "Nama",
            'goodsNm' => "CAF Premi Pertama",
            'referenceNo' => "TransactionNO",
            'amt' => 'amount',
            'resultCd' => '0000',
            'resultMsg' => 'SUCCESS');

        echo json_encode($return, JSON_UNESCAPED_SLASHES);

//	}else
//            throw new NotFoundException('Could not find that page');
    }

    public function Rnicepay_payment() {
        $this->autoRender = false;
        $this->layout = "ajax";
//	if ($this->request->is('post')){
        $jsondata = '[{"customerId" : "891011101",
				"merchantToken" : "141fd2368aa80ea0e600b1b4d7a42c1e731e74a27a03521e8e28150cc00bc05b",
				"referenceNo" : "ref100000001",
				"prefix" : "7015102",
				"bankCd" : "CENA",
				"amt" : "50000",
				"tXid" : "FIXOPEN0010000000006"
				}]';
        $obj = json_decode($jsondata, true);
        /* 	//In case have multiple array
          foreach ($obj as $k){
          echo $k['customerId'];
          }
          //else */
        //echo $obj[0]['customerId'];
        //echo $obj[0]['merchantToken'];
        //echo $obj[0]['prefix'];
        //echo $obj[0]['bankCd'];

        /* 	//if 
          $jsondata = '{"name": "ram"}';
          $obj = json_decode($jsondata,true);
          //use
          echo $obj['name']; */

        $return = array('billingNm' => "Nama",
            'goodsNm' => "CAF Premi Pertama",
            'referenceNo' => "TransactionNO",
            'amt' => 'amount',
            'resultCd' => '0000',
            'resultMsg' => 'SUCCESS');

        echo json_encode($return, JSON_UNESCAPED_SLASHES);

//	}else
//            throw new NotFoundException('Could not find that page');
    }

    public function Rnicepay_inquiry() {
        $this->autoRender = false;
        $this->layout = "ajax";
//	if ($this->request->is('post')){
        $jsondata = '[{"customerId" : "891011101",
				"merchantToken" : "141fd2368aa80ea0e600b1b4d7a42c1e731e74a27a03521e8e28150cc00bc05b",
				"prefix" : "7015102",
				"bankCd" : "CENA"
				}]';
        $obj = json_decode($jsondata, true);
        /* 	//In case have multiple array
          foreach ($obj as $k){
          echo $k['customerId'];
          }
          //else */
        //echo $obj[0]['customerId'];
        //echo $obj[0]['merchantToken'];
        //echo $obj[0]['prefix'];
        //echo $obj[0]['bankCd'];

        $hashed = hash('sha256', $obj[0]['merchantToken']);
        $hashed2 = hash('sha256', "MerchantID" . "CustID" . "MeKey");
        echo $hashed2;



        /* 	//if 
          $jsondata = '{"name": "ram"}';
          $obj = json_decode($jsondata,true);
          //use
          echo $obj['name']; */

        $return = array('billingNm' => "Nama",
            'goodsNm' => "CAF Premi Pertama",
            'referenceNo' => "TransactionNO",
            'amt' => 'amount',
            'resultCd' => '0000',
            'resultMsg' => 'SUCCESS');

        echo json_encode($return, JSON_UNESCAPED_SLASHES);

//	}else
//            throw new NotFoundException('Could not find that page');
    }

    public function response_bca_inquiry() {
        $this->autoRender = false;
        if ($this->request->is('post') && isset($this->request->data['klikPayCode'])) {
            $data_sprint = $this->request->data;
            $transactionNo = $data_sprint['transactionNo'];
            $klikPayCode = $data_sprint['klikPayCode'];
            $signature = $data_sprint['signature'];

            try {
                if (substr($data_sprint['transactionNo'], 0, 1) == 'J') { // JAI
                    $inquiry = $this->ApiXml->inquiryJAIPaymentKlikBCA($this->request->data); //utk pembayaran 1
                } else if (strlen($data_sprint['transactionNo']) <= 10) {
                    $inquiry = $this->ApiXml->inquiryPaymentKlikBCA($this->request->data); //utk pembayaran 1
                    //CakeLog::write('klikpay', '[APIResponse] ' . $inquiry . ' [transactionNo] ' . $data_sprint['transactionNo']);
                } else {
                    $inquiry = $this->ApiXml->inquiryPaymentKlikBCAPremi($this->request->data); //utk pembayaran 2
                }
            } catch (Exception $e) {
                CakeLog::write('error', $e);
            }

            $this->RequestHandler->respondAs('xml');
            if ($inquiry['CBCAKlikPay']['id_no'] > 0) {
                $xmlArray = array(
                    'OutputListTransactionIPAY' => array(
                        'klikPayCode' => $klikPayCode,
                        'transactionNo' => $transactionNo,
                        'currency' => "IDR",
                        'fullTransaction' => array(
                            'amount' => $inquiry['CBCAKlikPay']['totalAmount'],
                            'description' => $inquiry['CBCAKlikPay']['descp'],
                        ),
                        'installmentTransaction' => array(
                        //	'itemName' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['itemName'],
                        //	'quantity' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['quantity'],
                        //	'amount' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['amount'],
                        //	'tenor' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['tenor'],
                        //	'codePlan' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['codePlan'],
                        //	'merchantId' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['merchantId'],
                        ),
                        'miscFee' => $inquiry['CBCAKlikPay']['miscFee'],
                    )
                );
            } else {
                $xmlArray = array(
                    'OutputListTransactionIPAY' => array(
                        'klikPayCode' => $klikPayCode,
                        'transactionNo' => "",
                        'currency' => "",
                        'fullTransaction' => array(
                            'amount' => "",
                            'description' => "",
                        ),
                        'installmentTransaction' => array(
                        //	'itemName' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['itemName'],
                        //	'quantity' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['quantity'],
                        //	'amount' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['amount'],
                        //	'tenor' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['tenor'],
                        //	'codePlan' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['codePlan'],
                        //	'merchantId' => $inquiry['CBCAKlikPay']['InfoInstallmentTransactions']['InfoInstallmentTransactions']['merchantId'],
                        ),
                        'miscFee' => "",
                    )
                );
            }

            $xmlObject = Xml::fromArray($xmlArray, array('format' => 'tags'));
            $xmlString = $xmlObject->asXML();
            echo $xmlString;
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function response_bca_flag() {

        $this->autoRender = false;
        if ($this->request->is('post') && isset($this->request->data['klikPayCode'])) {
            $data_sprint = $this->request->data;
            $this->request->data['approvalCode'] = isset($this->request->data['approvalCode']['fullTransaction']) ? $this->request->data['approvalCode']['fullTransaction'] : '';
            try {
                if (substr($data_sprint['transactionNo'], 0, 1) == 'J') { // JAI
                    $transactionNo = $data_sprint['transactionNo'];
                    $totalAmount = $data_sprint['totalAmount'];
                    $authKey = $data_sprint['authKey'];
                    $approvalCode = $this->request->data['approvalCode'];
                    $transactionDate = date_format(date_create_from_format('d/m/Y H:i:s', $data_sprint['transactionDate']), 'Y-m-d H:i:s');
                    $rescount = $this->Payment->find('first', array('fields' => array('Payment.id, Payment.klikPayCode, Payment.status, Payment.totalAmount, Payment.authKey'), 'conditions' => compact('transactionDate', 'transactionNo')));
                    if (count($rescount) == 1) {
                        if ($data_sprint['klikPayCode'] != $rescount['Payment']['klikPayCode']) {
                            $id = 2;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' klikPayCode tidak cocok');
                        } else if ($totalAmount != $rescount['Payment']['totalAmount']) {
                            $id = 2;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' Total Amount tidak cocok');
                        } else if ($authKey != $rescount['Payment']['authKey']) {
                            $id = 2;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' authKey tidak cocok');
                        } else if ($rescount['Payment']['status'] == '00') {
                            $id = 3;
                            CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' Transaksi sudah pernah dibayar');
                        } else {
                            $id = 1;
                            $status = '00';
                            $this->Payment->updateAll(
                                    array('approvalCode' => "'" . $approvalCode . "'", 'status' => "'" . $status . "'", 'reason_id' => "'" . $id . "'", 'reason_ind' => "'Sukses'", 'reason_en' => "'Success'"), array('transactionNo' => $data_sprint['transactionNo']));
                        }
                    } else {
                        $id = 2;
                        CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' transactionNo dan transactionDate tidak cocok');
                    }

                    if ($id == 2) {
                        $this->Payment->updateAll(
                                array('reason_id' => "'" . $id . "'", 'reason_ind' => "'Transaksi Anda tidak dapat diproses.'", 'reason_en' => "'Your transaction cannot be processed.'"), array('transactionNo' => $data_sprint['transactionNo']));
                    } else if ($id == 3) {
                        $this->Payment->updateAll(
                                array('reason_id' => "'" . $id . "'", 'reason_ind' => "'Transaksi Anda sudah dibayar.'", 'reason_en' => "'Your transaction has been paid.'"), array('transactionNo' => $data_sprint['transactionNo']));
                    }
                } else if (strlen($data_sprint['transactionNo']) <= 10) {
                    $id = $this->ApiXml->updatePaymentKlikBCA($this->request->data); //utk pembayaran 1
                    CakeLog::write('klikpay', '[APIResponse] ' . $id . ' [transactionNo] ' . $data_sprint['transactionNo'] . ' ');
                } else
                    $id = $this->ApiXml->updatePaymentKlikBCAPremi($this->request->data); //utk pembayaran 2
            } catch (Exception $e) {
                $id = 7;
                CakeLog::write('error', $e);
            }

            if ($id == 1) {
                $status = '00';
                $reason = array('english' => 'Success', 'indonesian' => 'Sukses');
            } else {
                $status = '01';
                if ($id == 3) {
                    $reason = array('english' => 'Your transaction has been paid.', 'indonesian' => 'Transaksi Anda sudah dibayar.');
                } else if ($id == 4) {
                    $reason = array('english' => 'Your transaction has been canceled.', 'indonesian' => 'Transaksi Anda telah dibatalkan.');
                } else if ($id == 6) {
                    $reason = array('english' => 'Your transaction already expired.', 'indonesian' => 'Transaksi Anda telah kedaluarsa.');
                } else {
                    $reason = array('english' => 'Your transaction cannot be processed.', 'indonesian' => 'Transaksi Anda tidak dapat diproses.');
                }
            }

            $this->RequestHandler->respondAs('xml');
            $xmlArray = array(
                'OutputPaymentIPAY' => array(
                    'status' => $status,
                    'reason' => array(
                        'english' => $reason['english'],
                        'indonesian' => $reason['indonesian'],
                    ),
                )
            );
            $xmlObject = Xml::fromArray($xmlArray, array('format' => 'tags'));
            $xmlString = $xmlObject->asXML();
            echo $xmlString;
        } else
            throw new NotFoundException('Could not find that page');
    }

    /*
      public function response_bca_flag() {
      $this->autoRender = false;
      if ($this->request->is('post') && isset($this->request->data['klikPayCode'])) {
      $data_sprint = $this->request->data;
      $this->request->data['approvalCode'] = isset($this->request->data['approvalCode']['fullTransaction']) ? $this->request->data['approvalCode']['fullTransaction'] : '';

      $klikPayCode = $data_sprint['klikPayCode'];
      $transactionDate= $data_sprint['transactionDate'];
      $transactionNo = $data_sprint['transactionNo'];
      $Currency= $data_sprint['Currency'];
      $totalAmount= $data_sprint['totalAmount'];
      $payType= $data_sprint['payType'];
      $approvalCode = $this->request->data['approvalCode'];
      //                    $approvalCode= $data_sprint['approvalCode']['fullTransaction'];
      $signature= $data_sprint['signature'];

      try {
      if (substr($data_sprint['transactionNo'], 0, 1) == 'J') { // JAI
      $transactionNo = $data_sprint['transactionNo'];
      $totalAmount = $data_sprint['totalAmount'];
      $authKey = $data_sprint['authKey'];
      $approvalCode = $this->request->data['approvalCode'];
      $transactionDate = date_format(date_create_from_format('d/m/Y H:i:s', $data_sprint['transactionDate']), 'Y-m-d H:i:s');
      $rescount = $this->Payment->find('first', array('fields' => array('Payment.id, Payment.klikPayCode, Payment.status, Payment.totalAmount, Payment.authKey'), 'conditions' => compact('transactionDate', 'transactionNo')));
      if (count($rescount) == 1) {
      if ($data_sprint['klikPayCode'] != $rescount['Payment']['klikPayCode']) {
      $id = 2;
      CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' klikPayCode tidak cocok');
      } else if ($totalAmount != $rescount['Payment']['totalAmount']) {
      $id = 2;
      CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' Total Amount tidak cocok');
      } else if ($authKey != $rescount['Payment']['authKey']) {
      $id = 2;
      CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' authKey tidak cocok');
      } else if ($rescount['Payment']['status'] == '00') {
      $id = 3;
      CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' Transaksi sudah pernah dibayar');
      } else {
      $id = 1;
      $status = '00';
      $this->Payment->updateAll(
      array('approvalCode' => "'" . $approvalCode . "'", 'status' => "'" . $status . "'", 'reason_id' => "'" . $id . "'", 'reason_ind' => "'Sukses'", 'reason_en' => "'Success'"), array('transactionNo' => $data_sprint['transactionNo']));
      }
      } else {
      $id = 2;
      CakeLog::write('error', $transactionNo . ' ' . $transactionDate . ' transactionNo dan transactionDate tidak cocok');
      }

      if ($id == 2) {
      $this->Payment->updateAll(
      array('reason_id' => "'" . $id . "'", 'reason_ind' => "'Transaksi Anda tidak dapat diproses.'", 'reason_en' => "'Your transaction cannot be processed.'"), array('transactionNo' => $data_sprint['transactionNo']));
      } else if ($id == 3) {
      $this->Payment->updateAll(
      array('reason_id' => "'" . $id . "'", 'reason_ind' => "'Transaksi Anda sudah dibayar.'", 'reason_en' => "'Your transaction has been paid.'"), array('transactionNo' => $data_sprint['transactionNo']));
      }
      } else if (strlen($data_sprint['transactionNo']) <= 10) {
      $id = $this->ApiXml->updatePaymentKlikBCA($this->request->data); //utk pembayaran 1
      CakeLog::write('klikpay', '[APIResponse] ' . $id . ' [transactionNo] ' . $data_sprint['transactionNo']);
      }
      else
      $id = $this->ApiXml->updatePaymentKlikBCAPremi($this->request->data); //utk pembayaran 2
      } catch (Exception $e) {
      $id = 7;
      CakeLog::write('error', $e);
      }

      if ($id == 1) {
      $status = '00';
      $reason = array('english' => 'Success', 'indonesian' => 'Sukses');
      } else {
      $status = '01';
      if ($id == 3) {
      $reason = array('english' => 'Your transaction has been paid.', 'indonesian' => 'Transaksi Anda sudah dibayar.');
      } else if ($id == 4) {
      $reason = array('english' => 'Your transaction has been canceled.', 'indonesian' => 'Transaksi Anda telah dibatalkan.');
      } else if ($id == 6) {
      $reason = array('english' => 'Your transaction already expired.', 'indonesian' => 'Transaksi Anda telah kedaluarsa.');
      } else {
      $reason = array('english' => 'Your transaction cannot be processed.', 'indonesian' => 'Transaksi Anda tidak dapat diproses.');
      }
      }




      $this->RequestHandler->respondAs('xml');
      $xmlArray = array(
      'OutputPaymentIPAY' => array(
      'status' => $klikPayCode ,


      'reason' => array(
      'english' => $inquiry['CBCAKlikPay']['totalAmount'],
      'indonesian' => $inquiry['CBCAKlikPay']['descp'],
      ),


      )
      );
      $xmlObject = Xml::fromArray($xmlArray, array('format' => 'tags'));
      $xmlString = $xmlObject->asXML();
      echo $xmlString;
      } else
      throw new NotFoundException('Could not find that page');
      }
     */

    public function response_creditcard() {
        $this->disableCache();
        if ($this->request->is('post') && $this->Session->read('Purchase.prod') != null) {
            var_dump($this->Session->read('Purchase.prod'));
            // echo "0#";
            // var_dump($id);
            if ($this->Session->read('Purchase.id_CC') == 'J') { // JAI
                try {
                    $id = $this->ApiXml->updateShortTermPolicyCC($this->Session->read('Purchase.idPolicy'), $this->request->data, $this->Session->read('Purchase.CC.transactionDate'));
                    CakeLog::write('visamaster', "[merchantTransactionID] " . $this->request->data['merchantTransactionID'] . " [idPolicy] " . $this->Session->read('Purchase.idPolicy') . " [transactionStatus] " . $this->request->data['transactionStatus'] . " [APIResponse] " . $id);
                    // echo "if01#";
                    // var_dump($id);
                } catch (Exception $e) {
                    CakeLog::write('visamaster', "[merchantTransactionID]: " . $this->request->data['merchantTransactionID'] . " [idPolicy] " . $this->Session->read('Purchase.idPolicy') . " [transactionStatus] " . $this->request->data['transactionStatus'] . " [APIResponse] " . $id . " [Error]" . $e);
                    // echo "if02#";
                    // var_dump($id);
                }
            } else {
                try {
                    $id = $this->ApiXml->updatePaymentCreditCard($this->request->data);
                    CakeLog::write('visamaster', "[merchantTransactionID] " . $this->request->data['merchantTransactionID'] . " [transactionStatus] " . $this->request->data['transactionStatus'] . " [APIResponse] " . $id);
                    // echo "if101#";
                    // var_dump($id);
                } catch (Exception $e) {
                    CakeLog::write('visamaster', "[merchantTransactionID]: " . $this->request->data['merchantTransactionID'] . " [transactionStatus] " . $this->request->data['transactionStatus'] . " [APIResponse] " . $id . "[Error]" . $e);
                    // echo "if102#";
                    // var_dump($id);
                }
            }

            $status = $this->request->data['transactionStatus'];
            $s = $this->Session->read('Purchase.flow.name');
            $prod = $this->Session->read('Purchase.prod');
            $ctthankspurchase = '1';
            var_dump($s);
            if ($status == 'PENDING') {
                $status = 'Pending';
                $this->redirect(array('controller' => 'front', 'action' => 'cc_gagal', 'id' => $s, '?' => array('status' => $status, 'prod' => $prod)));
            } else if ($status == 'APPROVED') {
                $status = 'Berhasil';
                // $this->Session->delete('Purchase.flow');
                // $this->Session->delete('Purchase.step1');
                // $this->Session->delete('Purchase.step2');
                // $this->Session->delete('Purchase.token');

                $this->redirect(array('controller' => 'front', 'action' => 'cc_sukses', 'id' => $s, '?' => array('status' => $status, 'prod' => $prod)));
            } else {
                //$status='Gagal';
                $status = 'Belum Berhasil';
                $this->redirect(array('controller' => 'front', 'action' => 'cc_gagal', 'id' => $s, '?' => array('status' => $status, 'prod' => $prod)));
            }

            // $ctthankspurchase = '1';
            // $prod = $this->Session->read('Purchase.prod');
            // $this->Session->delete('Purchase.prod');
            // $this->set(compact('status', 'ctthankspurchase', 'prod'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function cc_gagal($id = '') {
        // $this->Session->destroy('Purchase');
        $ctthankspurchase = '1';
        if ($this->Session->check('Purchase.id_CC')) {

            $this->Session->delete('Purchase.id_CC');
            $status = $this->request->query['status'];
            $prod = $this->request->query['prod'];
            $this->set(compact('status', 'ctthankspurchase', 'prod'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function cc_sukses($id = '') {
        if ($this->Session->check('Purchase.id_CC')) {
            $ctthankspurchase = '1';
            $this->Session->delete('Purchase.id_CC');
            $this->Session->delete('Purchase.flow');
            $this->Session->delete('Purchase.step1');
            $this->Session->delete('Purchase.step2');
            $this->Session->delete('Purchase.token');
            $prod = $this->Session->read('Purchase.produk');
            $this->Session->destroy();
            $this->Session->write('Survey', "siap");
            $status = $this->request->query['status'];
            $prod = $this->request->query['prod'];
            $survey = 0;
            $this->set(compact('status', 'ctthankspurchase', 'prod', 'survey'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function response_creditcard_premi() {
        $this->disableCache();
        if ($this->request->is('post') && $this->Session->check('Purchase.polisNopremi')) {
            $policy = $this->ApiXml->getPolicyDetail($this->Session->read('Purchase.polisNopremi'));
            $id = $this->ApiXml->updatePaymentCreditCardPremi(array_merge($this->request->data, array('ReceiptTransactionCode' => 'RP', 'DueDatePre' => $policy['PolicyDueDatePremium'])));
            $status = $this->request->data['transactionStatus'];
            if ($status == 'PENDING') {
                $status = 'Pending';
            } else if ($status == 'APPROVED') {
                $status = 'Berhasil';
            } else {
                $status = 'Gagal';
            }
            $ctthankspurchase = '1';
            $premi = $this->Session->read('Purchase.polisNopremi');
            $this->Session->delete('Purchase.polisNopremi');
            $this->set(compact('status', 'ctthankspurchase', 'premi'));
            $this->render('response_creditcard');
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function cal_non_unitlink_ajax() {
        $this->layout = "ajax";
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $data = $this->request->data['Personal'];
            $up = preg_replace("/[^0-9]/", "", $data['SUM_INSURED']);
            if ($data['product_id'] == 7) {
                $subjai = substr($data['DURATION_JAI'], 0, 4);
                $valjai = substr($data['DURATION_JAI'], 4);
                if ($subjai == 'hour') {
                    $data['QUOTE_DURATION_HOUR'] = $valjai;
                    unset($data['QUOTE_DURATION_DAYS']);
                    unset($data['QUOTE_PREMIUM_LIFESPAN']);
                } else if ($subjai == 'days') {
                    $data['QUOTE_DURATION_DAYS'] = $valjai;
                    unset($data['QUOTE_DURATION_HOUR']);
                    unset($data['QUOTE_PREMIUM_LIFESPAN']);
                } else {
                    $data['QUOTE_PREMIUM_LIFESPAN'] = $valjai;
                    unset($data['QUOTE_DURATION_HOUR']);
                    unset($data['QUOTE_DURATION_DAYS']);
                }
            }

            if ($data['product_id'] == 17 || $data['product_id'] == 18) {
                if ($data['QUOTE_PREMIUM_LIFESPAN'] == 5) {
                    $data['product_id'] = 17;
                    $data['COVERAGE_TYPE_ID'] = 19;
                } else {
                    $data['product_id'] = 18;
                    $data['COVERAGE_TYPE_ID'] = 20;
                }
            }

            if ($data['product_id'] == 14 || $data['product_id'] == 15) {
                if ($data['QUOTE_PREMIUM_LIFESPAN'] == 5) {
                    $data['product_id'] = 14;
                    $data['COVERAGE_TYPE_ID'] = 14;
                } else {
                    $data['product_id'] = 15;
                    $data['COVERAGE_TYPE_ID'] = 15;
                }
            }

            // JSK
            if ($data['product_id'] == 21) {
                $cashlessFee = ($data['CASHLESS'] == 'Y' ? 35000 : 0);

                if ($data['PROSPECT_DOB2'] == "") {
                    $umurtertua = $this->ApiXml->getAge($data['PROSPECT_DOB']);
                    $_SESSION['qtytertanggung'] = 1;
                    $gender = $data['PROSPECT_GENDER'];
                    $_SESSION['PROSPECT_DOB2_FOR_ENTRY'] = ""; //jika dob spouse tidak keisi maka tidak muncul di add tertanggung
                    // Hitung Premi berdasarkan usia tertua tertanggung utama
                    $premium = $this->ApiXml->getPremiumRate($data['COVERAGE_TYPE_ID'], $data['QUOTE_PREMIUM_MODE'], $umurtertua, $gender, isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0, $up, isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0);
                } else {
                    if ($this->ApiXml->getAge($data['PROSPECT_DOB']) > $this->ApiXml->getAge($data['PROSPECT_DOB2'])) {
                        $umurtertua = $this->ApiXml->getAge($data['PROSPECT_DOB']);
                        $_SESSION['qtytertanggung'] = 2;
                        $gender = $data['PROSPECT_GENDER'];
                        $_SESSION['PROSPECT_DOB2_FOR_ENTRY'] = $data['PROSPECT_DOB2'];
                        $_SESSION['PROSPECT_GENDER2'] = $data['PROSPECT_GENDER2'];
                    } else {
                        $umurtertua = $this->ApiXml->getAge($data['PROSPECT_DOB2']);
                        $_SESSION['qtytertanggung'] = 2;
                        $gender = $data['PROSPECT_GENDER2'];
                        $_SESSION['PROSPECT_DOB2_FOR_ENTRY'] = $data['PROSPECT_DOB2'];
                        $_SESSION['PROSPECT_GENDER2'] = $data['PROSPECT_GENDER2'];
                    }
                    $premium = $this->ApiXml->getPremiumRate($data['COVERAGE_TYPE_ID'], $data['QUOTE_PREMIUM_MODE'], $umurtertua, $gender, isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0, $up, isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0);
                    $same_age = ($data['PROSPECT_DOB'] == $data['PROSPECT_DOB2'] ? 'Y' : 'N');
                }

                if ($data['QUOTE_PREMIUM_MODE'] == 12) {
                    $this->Session->write('Purchase.step1', array('cashlessFee' => $cashlessFee * 12, 'sameAgeFlag' => $same_age, 'premiTertua' => $premium));
                } elseif ($data['QUOTE_PREMIUM_MODE'] == 1) {
                    $this->Session->write('Purchase.step1', array('cashlessFee' => $cashlessFee, 'sameAgeFlag' => $same_age, 'premiTertua' => $premium));
                }
            } else {
                $premium = $this->ApiXml->getPremiumRate($data['COVERAGE_TYPE_ID'], $data['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($data['PROSPECT_DOB']), $data['PROSPECT_GENDER'], isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0, $up, isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0);
            }
            $this->Session->write('Purchase.premi', array('mode' => $data['QUOTE_PREMIUM_MODE'], 'total_premi' => round($premium, 0), 'frek' => $this->ApiXml->dataPremimode($data['QUOTE_PREMIUM_MODE'])));
            $this->set(compact('data', 'valjai', 'premium', 'cashlessFee'));
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function cal_unitlink_ajax() {
        $this->layout = "ajax";
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $data = $this->request->data['Personal']; //var_dump($data);die();
            $premium = preg_replace("/[^0-9]/", "", $data['PREMI']);
            $data[1]['SUM_INSURED'] = preg_replace("/[^0-9]/", "", $data[1]['SUM_INSURED']);
            if (isset($data[3]['SUM_INSURED']))
                $data[3]['SUM_INSURED'] = preg_replace("/[^0-9]/", "", $data[3]['SUM_INSURED']);
            if (isset($data[4]['SUM_INSURED']))
                $data[4]['SUM_INSURED'] = preg_replace("/[^0-9]/", "", $data[4]['SUM_INSURED']);
            $this->ApiXml->storeUnitLink($data);
            $chart = $this->ApiXml->GetGrafikUnitLink($this->Session->read('Purchase.QUOTE_ID'));
            $this->set(compact('data', 'premium', 'chart'));
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function step1_unitlink($name = "") {
        $id = $this->ApiXml->getMappingProd($name, 'unit-link');
        $token = $this->Session->read('Purchase.token');
        $tok = (isset($this->request->query['sid'])) ? $this->request->query['sid'] : "0";
        $product = $this->ApiXml->getProductbyID($id['product_id']);
        $_metaTitle = $this->MetaTitle->getMetaQuote($product['product_description']);
        /* if($name!=$this->Session->read('Purchase.flow.name')) {
          $this->Session->delete('Purchase.Tertanggung');
          $this->Session->delete('Purchase.step2.me');
          } */
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Session->delete('Purchase.Tertanggung');
            $this->Session->delete('Purchase.step2.me');
            $this->Session->delete('Purchase.Ahliwaris');
            $sess = $this->request->data['Personal'];
            $sess['PREMI'] = preg_replace("/[^0-9]/", "", $sess['PREMI']);
            $this->Session->write('Purchase.step1', $sess);
            $this->Session->write('Purchase.produk', $product['product_description']);
            $this->Session->write('Purchase.flow', array('cat' => 'unit-link', 'name' => $name));
            if (null == $this->Session->read('Purchase.token')) {
                $token = md5(time());
                $this->Session->write('Purchase.token', $token);
            }
            $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $token, 'cat' => 'unit-link')));
        } else {
            if (isset($this->request->query['sid']) && $tok == $token) {
                $this->request->data['Personal'] = $this->Session->read('Purchase.step1');
            } else if ($this->Auth->loggedIn()) {
                $tmp = $this->ApiXml->setProspectCust();
                $this->request->data['Personal'] = $this->Session->read('Purchase.step1');
            } else {
                $this->request->data['Personal'] = null;
            }
        }
        $coverage[1] = $this->ApiXml->getCoveragebyID(1);
        $coverage[3] = $this->ApiXml->getCoveragebyID(3);
        $coverage[4] = $this->ApiXml->getCoveragebyID(4);
        $optFrek = $this->ApiXml->GetOptPremiModeByID($id['product_id']);
        $optFund = $this->ApiXml->getFundList();
        if ($coverage[1]['MaxDurationDays'] == 0 && $coverage[1]['MinDurationDays'] == 0) {
            $optPP = $this->ApiXml->getOptPP($coverage[1]['MinDuration'], $coverage[1]['MaxDuration']);
        } else {
            $optPP = array($coverage[1]['MinDurationDays'] => $coverage[1]['MinDurationDays'] . ' Hari', $coverage[1]['MaxDurationDays'] => $coverage[1]['MaxDurationDays'] . ' Hari');
        }
        $optUp[1] = $this->ApiXml->getOptUp($coverage[1]['MinSumInsured'], $coverage[1]['MaxSumInsured'], $coverage[1]['SumInsuredMultiply']);
        $optUp[3] = $this->ApiXml->getOptUp($coverage[3]['MinSumInsured'], $coverage[3]['MaxSumInsured'], $coverage[3]['SumInsuredMultiply']);
        $optUp[4] = $this->ApiXml->getOptUp($coverage[4]['MinSumInsured'], $coverage[4]['MaxSumInsured'], $coverage[4]['SumInsuredMultiply']);
        $this->set(compact('data', 'optFrek', 'product', 'coverage', 'name', 'id', 'optPP', 'optFund', 'optUp', '_metaTitle'));
    }

    // public function check_email() {
    //     $this->autoRender = false;
    //     $this->layout = "ajax";
    //     if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
    //         $email = $this->request->query['email'];
    //         $name = $this->request->query['name'];
    //         $data = $this->Session->read('Purchase.step1');
    //         $id_prospect = $this->ApiXml->saveProspect($email, $name, $data['PROSPECT_DOB'], $data['PROSPECT_GENDER']);
    //         if (is_numeric($id_prospect))
    //             echo "1";
    //     } else
    //         throw new NotFoundException('Could not find that page');
    // }


    public function check_email() { //prod punya
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
            $email = $this->request->query['email'];
            $name = $this->request->query['name'];
            $data = $this->Session->read('Purchase.step1');
            $id_prospect = $this->ApiXml->saveProspect($email, $name, $data['PROSPECT_DOB'], $data['PROSPECT_GENDER']);



            /*
              $tertanggung = $this->Session->read('Purchase.Tertanggung');
              $ahliwaris = $this->Session->read('Purchase.Ahliwaris');
              $num_tertanggung = count($this->Session->read('Purchase.Tertanggung'));
              $num_ahliwaris = count($this->Session->read('Purchase.Ahliwaris'));
              if(($num_tertanggung)>=0) {
              for($i=1; $i<=$num_ahliwaris; $i++) {
              if ($tertanggung[0]['PROSPECT_NAME'] == $ahliwaris[$i]['PROSPECT_NAME']) {
              echo "11";
              }
              }
              } */


            if (is_numeric($id_prospect))
                echo "1";
            else
                echo "0";
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function check_valid_dns_email() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            App::import('Vendor', 'emailverify', array('file' => 'utility' . DS . 'emailverify.php'));
            $email_valid = $this->request->query['email_valid'];

            $verify = new EmailVerify();
            //$verify->debug_on = true;

            $verify->local_user = 'mail.andiwinarno'; //username of your address from which you are sending message to verify
            $verify->local_host = 'gmail.com';    //domain name of your address

            if ($verify->verify($email_valid))
                echo '1';
            else
                echo '2';
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function check_emailAH() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
            $PROSPECT_EMAIL = $this->request->query['email'];
            $PROSPECT_NAME = $this->request->query['name'];
            $PROSPECT_DOB = $this->request->query['dob'];
            $PROSPECT_GENDER = $this->request->query['gender'];
            $PROSPECT_MOBILE_PHONE = $this->request->query['mobile'];
            $id_prospect = $this->ApiXml->saveCustomer(array(), compact('PROSPECT_MOBILE_PHONE', 'PROSPECT_EMAIL', 'PROSPECT_NAME', 'PROSPECT_DOB', 'PROSPECT_GENDER'));
            if (is_numeric($id_prospect))
                echo "1";
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function checkAcumulation() {//ORI
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $cust_name = $this->request->query['cust_name'];
            $cust_dob = $this->request->query['cust_dob'];
            $cust_gender = $this->request->query['cust_gender'];
            $cust_benefitID = $this->request->query['cust_benefitID'];
            if ($cust_benefitID == 2)
                $cust_benefitID = 11;


            $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($cust_name, $cust_dob);
            if ($IsExistCustomerBlackList == "True") {
                echo '2';
            } else {



                $getAcumulate = $this->ApiXml->getAcumulation($cust_name, $cust_dob, $cust_gender, $cust_benefitID);
                $total_insured = $this->Session->read('Purchase.step1.SUM_INSURED');
                if (isset($getAcumulate['CCustomerSumInsured'])) {
                    $getAcumulate = $getAcumulate['CCustomerSumInsured'];
                    $this->Session->write('tes.yangLama', $getAcumulate['TotalSumInsured']);
                    $this->Session->write('tes.beli', $total_insured);
                    $this->Session->write('tes.jadinya', $getAcumulate['TotalSumInsured'] + $total_insured);
                    $this->Session->write('tes.MaxSumInsured', $getAcumulate['MaxSumInsured']);
                    $this->Session->write('tes.sisaLimit', $getAcumulate['MaxSumInsured'] - ($getAcumulate['TotalSumInsured'] + $total_insured));
                    if (($getAcumulate['TotalSumInsured'] + $total_insured) >= $getAcumulate['MaxSumInsured']) {
                        echo "0"; // temp disable during uat klik bca
                        //echo "1";
                    } else {
                        echo "1";
                    }
                    //if (($getAcumulate['TotalSumInsured'] + $total_insured) > 900000 && ($cust_benefitID==2 || $cust_benefitID==11|| $cust_benefitID==23)) //maksimal 900000 untuk rumah sakit
                    //{
                    //    echo "0";
                    //}
                    //elseif (($getAcumulate['TotalSumInsured'] + $total_insured) > 5000000 && ($cust_benefitID==5)) //maksimal 5jt untuk DBD
                    //{
                    //    echo "0";
                    //}
                    //elseif (($getAcumulate['TotalSumInsured'] + $total_insured) > 100000000 && ($cust_benefitID==3)) //maksimal 100jt meninggal karena kecelakaan
                    //{
                    //    echo "0";
                    //}
                    //else
                    //{
                    //    echo "1";
                    //}
                } else
                    echo "1";
            }//else echo2
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function checkAcumulationMUL() { //MUL
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $cust_name = $this->request->query['cust_name'];
            $cust_dob = $this->request->query['cust_dob'];
            $cust_gender = $this->request->query['cust_gender'];
            $cust_benefitID = $this->request->query['cust_benefitID'];
            if ($cust_benefitID == 2)
                $cust_benefitID = 11;

            $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($cust_name, $cust_dob);
            if ($IsExistCustomerBlackList == "True") {
                echo '2';
            } else {
                $total_insured = $this->Session->read('Purchase.step1.SUM_INSURED');
                $CoverageTypeID = $this->Session->read('Purchase.step1.COVERAGE_TYPE_ID');

                try {
                    $getAcumulate = $this->ApiXml->getAcumulationMUL($cust_name, $cust_dob, $cust_gender, $CoverageTypeID, $total_insured);
                    //var_dump( $getAcumulate); 
                    if ($getAcumulate['CResult']['Result'] == 1) {
                        echo "1";
                    } else {
                        echo "0";
                    }
                } catch (Exception $e) {
                    //  echo 'Message: ' .$e->getMessage();
                    CakeLog::write('error', $e);
                }

                /* ===== di komen yg lama ========== 
                  if (isset($getAcumulate['CCustomerSumInsured'])) {
                  $getAcumulate = $getAcumulate['CCustomerSumInsured'];
                  $this->Session->write('tes.yangLama', $getAcumulate['TotalSumInsured']);
                  $this->Session->write('tes.beli', $total_insured);
                  $this->Session->write('tes.jadinya', $getAcumulate['TotalSumInsured'] + $total_insured);
                  $this->Session->write('tes.MaxSumInsured', $getAcumulate['MaxSumInsured']);
                  $this->Session->write('tes.sisaLimit', $getAcumulate['MaxSumInsured']-($getAcumulate['TotalSumInsured'] + $total_insured));
                  if (($getAcumulate['TotalSumInsured'] + $total_insured) >= $getAcumulate['MaxSumInsured'])
                  {
                  echo "0";// temp disable during uat klik bca
                  //echo "1";
                  }
                  else
                  {echo "1";}

                  } else
                  echo "1";
                  ======= dikomen yg lama ========= */
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function StatusQuote() {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];
        $status = $this->request->query['status'];
        if ($this->request->is('ajax') && $this->Session->read('Purchase.QUOTE_ID') == $id) {
            $result = $this->ApiXml->updateStatusQuote($id, $status);
            echo $result;
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function sendCCRecurring() {
        $this->autoRender = false;
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $this->ApiXml->sendRecurringCard($this->request->data);
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function getBCAtoken($name = '') {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];
        if ($this->request->is('ajax') && $this->Session->read('Purchase.QUOTE_ID') == $id) {
            if ($this->Session->read('Purchase.step1.product_id') != 7)
                $quote = $this->ApiXml->getQuoteByID($id);
            //if ($this->Session->read('Purchase.step1.product_id') == 24)//sam
            //$quote['QuoteNo']=$quote[0]['QuoteNo'];//sam
            else {
                $this->Quotejai->getDataSource()->begin();
                $this->Quotejai->save();
                $this->Quotejai->getDataSource()->commit();
                $this->Session->write('Purchase.QUOTE_ID', 'J' . $this->Quotejai->id);
                $quote['QuoteNo'] = 'J' . $this->Quotejai->id;
            }
            $totalpremi = $this->Session->read('Purchase.premi.total_premi');
            $cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21) ? $this->Session->read('Purchase.step1.cashlessFee') : 0 );
            $totalAmount = number_format($totalpremi + $cashlessFee, 2, '.', '');
            $miscFee = number_format(0, 2, '.', '');
            $klikPayCode = $this->ApiXml->getConfig('klikPayCode');
            $clearKey = $this->ApiXml->getConfig('clearKey');
            $transactionDate = date('d/m/Y H:i:s');
            $descp = 'CAF PREMI PERTAMA';
            $transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');
            $signature = floatval($this->ApiXml->getSignatureBCA($klikPayCode, $quote['QuoteNo'], 'IDR', $clearKey, $transactionDate, $totalAmount));
            $url = Router::url(array('controller' => 'front', 'action' => 'thanks_klikpaybca', 'id' => $name), true);
            $tokBCA = array('klikPayCode' => $klikPayCode, 'transactionNo' => $quote['QuoteNo'], 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'payType' => '01', 'callback' => $url, 'transactionDate' => $transactionDateCAF, 'descp' => $descp, 'miscFee' => $miscFee, 'signature' => $signature);

            if ($this->Session->read('Purchase.step1.product_id') == 7) {
                $this->Payment->getDataSource()->begin();
                $tokBCA['authKey'] = $this->ApiXml->getAuth($klikPayCode, $quote['QuoteNo'], 'IDR', $transactionDate, $clearKey);
                $this->Payment->save($tokBCA);
                $this->Payment->getDataSource()->commit();
                $id_BCA = $this->Payment->id;
                $idCustomer = $this->ApiXml->saveCustomer($this->Session->read('Purchase'));
                $idPolicy = $this->ApiXml->saveShortTermPolicy($idCustomer, $tokBCA);
                $tot = count($this->Session->read('Purchase.Ahliwaris'));
                $i = 1;
                if ($idPolicy != "ERROR_ACCUMULATION_FAILED") {
                    while ($i <= $tot) {
                        $idBeneficary = $this->ApiXml->saveCustomer(array(), $this->Session->read('Purchase.Ahliwaris.' . $i));
                        $this->ApiXml->ShortTermBeneficairy($idPolicy, $idBeneficary, $this->Session->read('Purchase.Ahliwaris.' . $i . '.RELATIONSHIP_ID'));
                        $i++;
                    }
                }

                //$this->Session->delete('Purchase');
                $this->Session->write('Purchase.idCustomer', $idCustomer);
                $this->Session->write('Purchase.idPolicy', $idPolicy);
                $this->Session->write('Purchase.step1.product_id', 7);
            } else {
                $id_BCA = $this->ApiXml->savePaymentKlikBCA($tokBCA);
            }

            $tokBCA['transactionDate'] = $transactionDate;

            //if($this->Session->read('Purchase.step1.product_id')!=7) {$this->Session->delete('Purchase');}


            $this->Session->write('Purchase.id_BCA', $id_BCA);
            if (isset($idPolicy) && $idPolicy == "ERROR_ACCUMULATION_FAILED") {
                echo "1";
            } else {
                echo json_encode($tokBCA, JSON_UNESCAPED_SLASHES);
            }
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    //init cimb
    public function getCIMBtoken($name = '') {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];
        if ($this->request->is('ajax') /* && $this->Session->read('Purchase.QUOTE_ID') == $id */) {
            if ($this->Session->read('Purchase.step1.product_id') != 7)
                $quote = $this->ApiXml->getQuoteByID($id);
            else {
                $this->Quotejai->getDataSource()->begin();
                $this->Quotejai->save();
                $this->Quotejai->getDataSource()->commit();
                $this->Session->write('Purchase.QUOTE_ID', 'J' . $this->Quotejai->id);
                $quote['QuoteNo'] = 'J' . $this->Quotejai->id;
            }
            $totalpremi = $this->Session->read('Purchase.premi.total_premi');
            $cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21) ? $this->Session->read('Purchase.step1.cashlessFee') : 0 );
            $miscFee = number_format(0, 2, '.', '');
            $merchantCode = $this->ApiXml->getConfig('merchantCode');
            $paymentId = 7;
            $merchantKey = $this->ApiXml->getConfig('merchantKey');
            $refno = $quote['QuoteNo'];
            $totalAmountCaf = $totalpremi + $cashlessFee;
            $totalAmount = $totalAmountCaf . '00';
            $tmp_signature = $merchantKey . $merchantCode . $refno . $totalAmount . 'IDR';
            $signature = base64_encode(sha1($tmp_signature, true));
            $this->Session->write('Cimb.signature_req', $signature);
            // $this->Session->write('temp signature', $tmp_signature);
            // $this->Session->write('signature', $signature);
            $userName = $this->Session->read('Purchase.step2.PROSPECT_NAME');
            $userEmail = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
            $userContact = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
            $transactionDate = date('d/m/Y H:i:s');
            // $descp='CAF PREMI PERTAMA';
            $descp = $this->Session->read('Purchase.produk');
            $remark = 'CAF PREMI PERTAMA';
            $transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');

            $return_url = Router::url(array('controller' => 'front', 'action' => 'thanks_cimbclick', 'id' => $name), true);
            $backend_url = Router::url(array('controller' => 'front', 'action' => 'backend_cimb'), true);
            $tokCIMB = array('merchantCode' => $merchantCode, 'paymentId' => $paymentId, 'refNo' => $refno, 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'descp' => $descp, 'userName' => $userName, 'userEmail' => $userEmail, 'userContact' => $userContact, 'remark' => $remark, 'signature' => $signature, 'responseUrl' => $return_url, 'backendUrl' => $backend_url, 'transactionDate' => $transactionDate);


            if ($this->Session->read('Purchase.step1.product_id') == 7) {
                //$this->Payment->getDataSource()->begin();
                // $tokBCA['authKey'] = $this->ApiXml->getAuth($klikPayCode, $quote['QuoteNo'], 'IDR', $transactionDate, $clearKey);
                //$this->Payment->save($tokCIMB);
                //$this->Payment->getDataSource()->commit();
                //$id_CIMB = $this->Payment->id;
                $id_CIMB = $quote['QuoteNo'];
                $idCustomer = $this->ApiXml->saveCustomer($this->Session->read('Purchase'));
                $this->Session->write('Purchase.idCustomer', $idCustomer);

                //$idPolicy = $this->ApiXml->saveShortTermPolicy($idCustomer, $tokCIMB);
                //	$idPolicy = $this->ApiXml->saveShortTermPolicyCIMB($idCustomer, $tokCIMB);

                try {
                    $idPolicy = $this->ApiXml->saveShortTermPolicyCIMB($idCustomer, $tokCIMB, $transactionDateCAF, $totalAmountCaf);
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                }


                //$tot = count($this->Session->read('Purchase.Ahliwaris'));
                //$i = 1;
                //if ($idPolicy != "ERROR_ACCUMULATION_FAILED") {
                //    while ($i <= $tot) {
                //        $idBeneficary = $this->ApiXml->saveCustomer(array(), $this->Session->read('Purchase.Ahliwaris.' . $i));
                //        $this->ApiXml->ShortTermBeneficairy($idPolicy, $idBeneficary, $this->Session->read('Purchase.Ahliwaris.' . $i . '.RELATIONSHIP_ID'));
                //        $i++;
                //    }
                //}
                //$this->Session->delete('Purchase');
                $this->Session->write('Purchase.idCustomer', $idCustomer);
                $this->Session->write('Purchase.idPolicy', $idPolicy);
                $this->Session->write('Purchase.step1.product_id', 7);
            } else {
                $id_CIMB = $this->ApiXml->savePaymentCIMBClick($tokCIMB);
            }

            // $tokCIMB['transactionDate'] = $transactionDateCAF;
            //if($this->Session->read('Purchase.step1.product_id')!=7) {$this->Session->delete('Purchase');}


            $this->Session->write('Purchase.id_CIMB', $id_CIMB);
            $this->Session->write('Purchase.tokCIMB', $tokCIMB);
            if (isset($idPolicy) && $idPolicy == "ERROR_ACCUMULATION_FAILED") {
                echo "1";
            } else {
                $this->Session->write('tokCIMB', $tokCIMB);
                echo json_encode($tokCIMB, JSON_UNESCAPED_SLASHES);
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    //end cimb
    //backend cimb - start
    public function backend_cimb() {
        $this->layout = "ajax";
        $this->autoRender = false;
        try {
            //if ($this->Session->check('Purchase.id_CIMB')) {
            $data = $this->request->data;
            //var_dump($data);
            $MerchantCode = $_REQUEST["MerchantCode"];
            $PaymentId = $_REQUEST["PaymentId"];
            $RefNo = $_REQUEST["RefNo"];
            $Amount = $_REQUEST["Amount"];
            $Currency = $_REQUEST["Currency"];
            $Remark = $_REQUEST["Remark"];
            $TransId = $_REQUEST["TransId"];
            $AuthCode = $_REQUEST["AuthCode"];
            $Status = $_REQUEST["Status"];
            $ErrDesc = $_REQUEST["ErrDesc"];
            $Signature = $_REQUEST["Signature"];
            $this->Session->write('Cimb.signature_return', $Signature);

            $merchantCode = $this->ApiXml->getConfig('merchantCode');
            //$paymentId=$this->Session->read('tokCIMB.paymentId');
            $merchantKey = $this->ApiXml->getConfig('merchantKey');
            //$refno = $this->Session->read('tokCIMB.refNo');
            //$totalAmount=$this->Session->read('tokCIMB.totalAmount');
            //$tmp_signature=  $merchantKey.$merchantCode.$paymentId.$refno.$totalAmount.'IDR1';
            $tmp_signature = $merchantKey . $merchantCode . $PaymentId . $RefNo . $Amount . 'IDR1';
            $signature = base64_encode(sha1($tmp_signature, true));
            //$this->Session->write('Cimb.signature_gen', $signature);

            /* if (substr($RefNo,0,1)== "J" || substr($RefNo,0,1)== "j") { // JAI
              //echo $RefNo;
              //$res = $this->Payment->find('first', array('conditions' => array('Payment.id' => $this->Session->read('Purchase.id_CIMB'))));
              //$status = $res['Payment'];
              $result = $this->ApiXml->updateShortTermPolicyCIMB($this->Session->read('Purchase.idPolicy'), $data);
              if($Status==1){$status='Sukses';}else{$status='Gagal';}
              CakeLog::write('cimbclick', ' [JAI Payment.id] ' . $this->Session->read('Purchase.id_CIMB') . ' [APIResponse] ' . $result);
              } else{
              $id = $this->ApiXml->updatePaymentCIMBClicks($this->request->data); //utk pembayaran 1
              //$id = $this->ApiXml->updatePaymentCIMBClicks($MerchantCode,$PaymentId,$RefNo,$Amount,$Currency,$Remark,$TransId,$AuthCode,$Status,$ErrDesc,$Signature); //utk pembayaran 1
              $status = $this->ApiXml->getPaymentCIMBClick($this->Session->read('Purchase.id_CIMB'));
              } */
            //}else{
            //	$id = $this->ApiXml->updatePaymentCIMBClicksPremi($this->request->data); //utk pembayaran 2
            //	//$id = $this->ApiXml->updatePaymentCIMBClicksPremi($MerchantCode,$PaymentId,$RefNo,$Amount,$Currency,$Remark,$TransId,$AuthCode,$Status,$ErrDesc,$Signature); //utk pembayaran 2
            //	$status = $this->ApiXml->getPaymentCIMBClickPremi ($this->Session->read('Purchase.id_CIMBpremi'));
            //}
            //$prod = strtoupper(str_replace('-', ' ', $id));
            //$ctthankspurchase = '1';
            //$this->set(compact('status', 'ctthankspurchase', 'prod','data','Status'));
            //$s=$this->Session->read('Purchase.flow.name');
            //$prod=$this->Session->read('Purchase.prod');
            if ($Status == 1) {
                if ($Signature == $signature) {
                    echo "OK";
                } else {
                    
                }
            } else {
                
            }
            //
        } catch (Exception $e) {
            CakeLog::write('error', $e);
            $status = 'Gagal';
        }
    }

    //backend_cimb - end

    public function getECashtoken($name = '') {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];
        if ($this->request->is('ajax') && $this->Session->read('Purchase.QUOTE_ID') == $id) {
            if ($this->Session->read('Purchase.step1.product_id') != 7)
                $quote = $this->ApiXml->getQuoteByID($id);
            else {
                $this->Quotejai->getDataSource()->begin();
                $this->Quotejai->save();
                $this->Quotejai->getDataSource()->commit();
                $this->Session->write('Purchase.QUOTE_ID', 'J' . $this->Quotejai->id);
                $quote['QuoteNo'] = 'J' . $this->Quotejai->id;
            }
            $amount = number_format($this->Session->read('Purchase.premi.total_premi'), 2, '.', '');
            $description = 'CAF PREMI PERTAMA';
            $return_url = Router::url(array('controller' => 'front', 'action' => 'thanks_ecash', 'id' => $name), true);

            if ($this->Session->read('Purchase.step1.product_id') == 7) {
                $id_ecash = $this->Payment->id;
                $idCustomer = $this->ApiXml->saveCustomer($this->Session->read('Purchase'));
                $tokEM['transactionDate'] = date('Y-m-d H:i:s');
                $tokEM['totalAmount'] = $amount;
                $tokEM['miscFee'] = "0.00";
                $tokEM['currency'] = 'IDR';
                $tokEM['transactionNo'] = $quote['QuoteNo'];
                $idPolicy = $this->ApiXml->saveShortTermPolicy($idCustomer, $tokEM, 'EM');
                $tot = count($this->Session->read('Purchase.Ahliwaris'));
                $i = 1;
                if ($idPolicy != "ERROR_ACCUMULATION_FAILED") {
                    while ($i <= $tot) {
                        $idBeneficary = $this->ApiXml->saveCustomer(array(), $this->Session->read('Purchase.Ahliwaris.' . $i));
                        $this->ApiXml->ShortTermBeneficairy($idPolicy, $idBeneficary, $this->Session->read('Purchase.Ahliwaris.' . $i . '.RELATIONSHIP_ID'));
                        $i++;
                    }
                }

                //$this->Session->delete('Purchase');
                $this->Session->write('Purchase.idCustomer', $idCustomer);
                $this->Session->write('Purchase.idPolicy', $idPolicy);
                $this->Session->write('Purchase.step1.product_id', 7);
            } else
                $idCafEcash = $this->ApiXml->savePaymentEcash($return_url, $amount, $description, $quote['QuoteNo']);

            $id_ecash = (string) $this->ApiXml->EcashPush($return_url, $amount, $description, $quote['QuoteNo']);
            $this->Session->write('Purchase.id_ecash', $id_ecash);
            if (isset($idPolicy) && $idPolicy == "ERROR_ACCUMULATION_FAILED") {
                echo "1";
            } else {
                echo $id_ecash;
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function getBCAtokenPremi() {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];
        $name = 'premium-payment';
        if ($this->request->is('ajax') && $this->Auth->loggedIn()) {
            $policy = $this->ApiXml->getPolicyDetail($id);
            $tempo = str_replace("T", " ", $policy['PolicyDueDatePremium']);
            $totalAmount = $policy['PolicyRegulerPremium'];
            $miscFee = number_format(0, 2, '.', '');
            $klikPayCode = '03CENT0213';
            $transactionNo = $id . date_format(date_create_from_format('Y-m-d H:i:s', $tempo), 'dmy');
            $transactionDate = date('d/m/Y H:i:s');
            $descp = "CAF" . $id . '-' . $policy['ProductCode'] . '-' . strtoupper(date_format(date_create_from_format('Y-m-d H:i:s', $tempo), 'My'));
            $transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');
            $signature = $this->ApiXml->getSignatureBCA($klikPayCode, $transactionNo, 'IDR', '0EC3NT021EC4FP4Y', $transactionDate, $totalAmount);
            $url = Router::url(array('controller' => 'front', 'action' => 'thanks_klikpaybca', 'id' => $name), true);
            $tokBCA = array('klikPayCode' => $klikPayCode, 'transactionNo' => $transactionNo, 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'payType' => '01', 'callback' => $url, 'transactionDate' => $transactionDateCAF, 'descp' => $descp, 'miscFee' => $miscFee, 'signature' => $signature);
            $id_BCA = $this->ApiXml->savePaymentKlikBCAPremi(array_merge($tokBCA, array('ReceiptTransactionCode' => 'RP', 'DueDatePre' => $policy['PolicyDueDatePremium'], 'policy_no' => $id)));
            $tokBCA['transactionDate'] = $transactionDate;

            $this->Session->write('Purchase.id_BCApremi', $id_BCA);
            echo json_encode($tokBCA, JSON_UNESCAPED_SLASHES);
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function getVisaMastertoken($name = '') {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];

        if ($this->Session->read('Purchase.step1.product_id') == 24) {  // jaga motorku
            $this->Session->write('Purchase.step2.PROSPECT_NAME', $this->Session->read('Purchase.step1.PROSPECT_NAME'));
            $this->Session->write('Purchase.step2.PROSPECT_DOB', $this->Session->read('Purchase.step1.PROSPECT_DOB'));
            $this->Session->write('Purchase.step2.PROSPECT_GENDER', $this->Session->read('Purchase.step1.PROSPECT_GENDER'));
            $this->Session->write('Purchase.step2.PROSPECT_ADDRESS', $this->Session->read('Purchase.step1.PROSPECT_ADDRESS'));
            $this->Session->write('Purchase.step2.PROSPECT_EMAIL', $this->Session->read('Purchase.step1.PROSPECT_EMAIL'));
            $this->Session->write('Purchase.step2.PROSPECT_MOBILE_PHONE', $this->Session->read('Purchase.step1.PROSPECT_MOBILE_PHONE'));
        }

        //backup baris
        //if($this->request->is('ajax') && $this->Session->read('Purchase.QUOTE_ID')==$id){
        if ($this->request->is('ajax') && $this->Session->read('Purchase.QUOTE_ID') == $id) {
            //var_dump( $id.' | '. $this->Session->read('Purchase.QUOTE_ID'));die();
            //var_dump('masuk sini'); return ('aha'); die();
            if ($this->Session->read('Purchase.step1.product_id') != 7)
                $quote = $this->ApiXml->getQuoteByID($id);
            else {
                $this->Quotejai->getDataSource()->begin();
                $this->Quotejai->save();
                $this->Quotejai->getDataSource()->commit();
                $this->Session->write('Purchase.QUOTE_ID', 'J' . $this->Quotejai->id);
                $quote['QuoteNo'] = 'J' . $this->Quotejai->id;
            }
            $totalpremi = $this->Session->read('Purchase.premi.total_premi');
            $cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21) ? $this->Session->read('Purchase.step1.cashlessFee') : 0 );

            $amount = $totalpremi + $cashlessFee;
            $siteID = "jagadiri";
            $serviceVersion = "1.2";
            $merchantTransactionID = $quote['QuoteNo'];
            $currency = "IDR";
            $merchantTransactionNote = "CAF PREMI PERTAMA";
            $userDefineValue = "Asuransi Online";
            $billingName = $this->Session->read('Purchase.step2.PROSPECT_NAME');
            $billingAddress = " ";
            $billingCity = "";
            $billingState = "";
            $billingPostalCode = "";
            $billingCountry = "";
            $billingPhone = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
            $billingEmail = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
            $deliveryName = "";
            $deliveryAddress = "";
            $deliveryCity = "";
            $deliveryState = "";
            $deliveryPostalCode = "";
            $deliveryCountry = "";
            $soml = "";
            $transactionType = "AUTHORIZATION";
            $ProfileCode = "64FCA9E2-D4E0-0DD8-294EE216C0190233"; //training
            // $ProfileCode = "A869FF2A-E63E-232D-F513D72FE093AE4D";//production
            $checkSum = md5($amount . $currency . $merchantTransactionID . $serviceVersion . $siteID . $soml . $transactionType . $ProfileCode);

            $tokCC = compact('amount', 'siteID', 'serviceVersion', 'currency', 'merchantTransactionID', 'merchantTransactionNote', 'userDefineValue', 'billingName', 'billingAddress', 'billingCity', 'billingState', 'billingPostalCode', 'billingCountry', 'billingPhone', 'billingEmail', 'deliveryName', 'deliveryAddress', 'deliveryCity', 'deliveryState', 'deliveryPostalCode', 'deliveryCountry', 'soml', 'MerchantProfileCode', 'checkSum');
            if ($this->Session->read('Purchase.step1.product_id') == 7) {
                $tokCC['transactionDate'] = date('Y-m-d H:i:s');
                $tokCC['totalAmount'] = $amount;
                $tokCC['miscFee'] = "0.00";
                $tokCC['transactionNo'] = $quote['QuoteNo'];
                $tokCC['currency'] = $currency;
                $tokCC['checkSum'] = $checkSum;
                $idCustomer = $this->ApiXml->saveCustomer($this->Session->read('Purchase'));
                $idPolicy = $this->ApiXml->saveShortTermPolicy($idCustomer, $tokCC, "CC");
                //var_dump($idPolicy);
                //get failed message
                $tot = count($this->Session->read('Purchase.Ahliwaris'));
                $i = 1;
                if ($idPolicy != "ERROR_ACCUMULATION_FAILED") {
                    while ($i <= $tot) {
                        $idBeneficary = $this->ApiXml->saveCustomer(array(), $this->Session->read('Purchase.Ahliwaris.' . $i));
                        $this->ApiXml->ShortTermBeneficairy($idPolicy, $idBeneficary, $this->Session->read('Purchase.Ahliwaris.' . $i . '.RELATIONSHIP_ID'));
                        $i++;
                    }
                }

                $prod = $this->Session->read('Purchase.produk');
                //$this->Session->delete('Purchase');
                $this->Session->write('Purchase.idCustomer', $idCustomer);
                $this->Session->write('Purchase.idPolicy', $idPolicy);
                $this->Session->write('Purchase.step1.product_id', 7);
                $this->Session->write('Purchase.CC.transactionDate', $tokCC['transactionDate']);
                $id_CC = "J";
                //}else if($this->Session->read('Purchase.step1.product_id') == 24)  {
                //	$id_CC = $this->ApiXml->savePaymentVisaMasterJMK($merchantTransactionID , $amount );
                //    $prod = $this->Session->read('Purchase.produk');
            } else {
                $id_CC = $this->ApiXml->savePaymentVisaMaster($tokCC);
                $prod = $this->Session->read('Purchase.produk');
            }
            //if($this->Session->read('Purchase.step1.product_id')!=7) $this->Session->delete('Purchase');
            $this->Session->write('Purchase.id_CC', $id_CC);
            $this->Session->write('Purchase.prod', $prod);

            if (isset($idPolicy) && $idPolicy == "ERROR_ACCUMULATION_FAILED") {
                echo "1";
            } else {
                echo json_encode($tokCC, JSON_UNESCAPED_SLASHES);
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function getVisaMastertokenPremi() {
        $this->autoRender = false;
        $this->layout = "ajax";
        $id = $this->request->query['id'];
        if ($this->request->is('ajax') && $this->Auth->loggedIn()) {
            $policy = $this->ApiXml->getPolicyDetail($id);
            $tempo = str_replace("T", " ", $policy['PolicyDueDatePremium']);
            $amount = round($policy['PolicyRegulerPremium'], 0);
            $siteID = "jagadiri";
            $serviceVersion = "1.2";
            $merchantTransactionID = $id . date_format(date_create_from_format('Y-m-d H:i:s', $tempo), 'dmy');
            $currency = "IDR";
            $merchantTransactionNote = "CAF" . $id . '-' . $policy['ProductCode'] . '-' . strtoupper(date_format(date_create_from_format('Y-m-d H:i:s', $tempo), 'My'));
            $userDefineValue = "Asuransi Online";
            $billingName = $this->Session->read('Auth.User.CustomerName');
            $billingAddress = " ";
            $billingCity = "";
            $billingState = "";
            $billingPostalCode = "";
            $billingCountry = "";
            $billingPhone = $this->Session->read('Auth.User.CustomerMobilePhone');
            $billingEmail = $this->Session->read('Auth.User.CustomerEmail');
            $deliveryName = "";
            $deliveryAddress = "";
            $deliveryCity = "";
            $deliveryState = "";
            $deliveryPostalCode = "";
            $deliveryCountry = "";
            $soml = "";
            $transactionType = "AUTHORIZATION";
            $ProfileCode = "A869FF2A-E63E-232D-F513D72FE093AE4D";
            $checkSum = md5($amount . $currency . $merchantTransactionID . $serviceVersion . $siteID . $soml . $transactionType . $ProfileCode);

            $tokCC = compact('amount', 'siteID', 'serviceVersion', 'currency', 'merchantTransactionID', 'merchantTransactionNote', 'userDefineValue', 'billingName', 'billingAddress', 'billingCity', 'billingState', 'billingPostalCode', 'billingCountry', 'billingPhone', 'billingEmail', 'deliveryName', 'deliveryAddress', 'deliveryCity', 'deliveryState', 'deliveryPostalCode', 'deliveryCountry', 'soml', 'MerchantProfileCode', 'checkSum');
            $id_CC = $this->ApiXml->savePaymentVisaMasterPremi(array_merge($tokCC, array('ReceiptTransactionCode' => 'RP', 'DueDatePre' => $policy['PolicyDueDatePremium'], 'policy_no' => $id)));
            $this->Session->write('Purchase.polisNopremi', $id);
            $this->Session->write('Purchase.id_CC', $id_CC);
            echo json_encode($tokCC, JSON_UNESCAPED_SLASHES);
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function thanks_klikpaybca($id = '') {
        //    echo '<script language="javascript">';
        //  echo 'alert("Data Anda Tidak Terpilih Sebagai Pemenang")';
        //  echo '</script>';
        if ($this->Session->check('Purchase.id_BCA') || $this->Session->check('Purchase.id_BCApremi')) {
            try {
                if ($this->Session->check('Purchase.id_BCA')) {
                    if ($this->Session->read('Purchase.step1.product_id') == 7) { // JAI
                        $res = $this->Payment->find('first', array('conditions' => array('Payment.id' => $this->Session->read('Purchase.id_BCA'))));
                        $status = $res['Payment'];
                        $result = $this->ApiXml->updateShortTermPolicyBCA($this->Session->read('Purchase.idPolicy'), $status);
                        CakeLog::write('klikpay', ' [JAI Payment.id] ' . $this->Session->read('Purchase.id_BCA') . ' [APIResponse] ' . $result);
                    } else
                        $status = $this->ApiXml->getPaymentKlikBCA($this->Session->read('Purchase.id_BCA'));
                } else
                    $status = $this->ApiXml->getPaymentKlikBCAPremi($this->Session->read('Purchase.id_BCApremi'));

                // if ($status['reason_id'] == '1') {
                //     $this->Session->delete('Purchase.flow');
                //     $this->Session->delete('Purchase.step1');
                //     $this->Session->delete('Purchase.step2');
                //     $this->Session->delete('Purchase.token');
                // }
            } catch (Exception $e) {
                CakeLog::write('error', $e);
                $status = 'Gagal';
            }
            // $this->Session->delete('Purchase.id_BCA');
            // $this->Session->delete('Purchase.id_BCApremi');
            $prod = strtoupper(str_replace('-', ' ', $id));
            $ctthankspurchase = '1';
            // var_dump($status);
            // $this->set(compact('status', 'ctthankspurchase', 'prod'));
//	$this->redirect(array('controller' => 'front', 'action' => 'klikpaybca_sukses', 'id' => $id, '?' => array('status' => "sukses", 'prod' => $prod)));//hardcode sukses bca


            if ($status == 'Gagal' || $status["reason_ind"] != "Sukses") {
                $this->redirect(array('controller' => 'front', 'action' => 'klikpaybca_gagal', 'id' => $id, '?' => array('status' => $status, 'prod' => $prod)));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'klikpaybca_sukses', 'id' => $id, '?' => array('status' => $status, 'prod' => $prod)));
            }
        }
        // else
        //$this->redirect("/");
    }

    public function klikpaybca_gagal($id = '') {
        // $this->Session->destroy('Purchase');
        if ($this->Session->check('Purchase.id_BCA') || $this->Session->check('Purchase.id_BCApremi')) {

            $this->Session->delete('Purchase.id_BCA');
            $this->Session->delete('Purchase.id_BCApremi');
            $status = $this->request->query['status'];
            $prod = $this->request->query['prod'];
            $this->set(compact('status', 'ctthankspurchase', 'prod'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function klikpaybca_sukses($id = '') {
        if ($this->Session->check('Purchase.id_BCA') || $this->Session->check('Purchase.id_BCApremi')) {
            $this->Session->delete('Purchase.flow');
            $this->Session->delete('Purchase.step1');
            $this->Session->delete('Purchase.step2');
            $this->Session->delete('Purchase.token');
            $this->Session->delete('Purchase.id_BCA');
            $this->Session->delete('Purchase.id_BCApremi');
            $prod = $this->Session->read('Purchase.produk');

            $this->Session->destroy();
            $this->Session->write('Survey', "siap");
            $status = $this->request->query['status'];
//            $prod = $this->request->query['prod'];
            $survey = 0;
            $this->set(compact('status', 'ctthankspurchase', 'prod', 'survey'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function cimb_gagal($id = '') {
        // $this->Session->destroy('Purchase');
        if ($this->Session->check('Purchase.id_CIMB') || $this->Session->check('Purchase.id_CIMBpremi')) {

            $this->Session->delete('Purchase.id_CIMB');
            $this->Session->delete('Purchase.id_CIMBpremi');
            $status = $this->request->query['status'];
            $prod = $this->request->query['prod'];
            $this->set(compact('status', 'ctthankspurchase', 'prod'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function cimb_sukses($id = '') {
        if ($this->Session->check('Purchase.id_CIMB') || $this->Session->check('Purchase.id_CIMBpremi')) {

            $this->Session->delete('Purchase.flow');
            $this->Session->delete('Purchase.step1');
            $this->Session->delete('Purchase.step2');
            $this->Session->delete('Purchase.token');

            $this->Session->delete('Purchase.id_CIMB');
            $this->Session->delete('Purchase.id_CIMBpremi');

            //$this->Session->delete('Purchase');
            $this->Session->destroy();
            $this->Session->write('Survey', "siap");
            $status = $this->request->query['status'];
            $prod = $this->request->query['prod'];
            $survey = 0;
            $this->set(compact('status', 'ctthankspurchase', 'prod', 'survey'));
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function thanks_cimbclick($id = '') {

        $from = $_SERVER["HTTP_REFERER"];
        //if ($from != 'https://payment.e2pay.co.id' || $from != 'https://sandbox.e2pay.co.id') {
        //     //throw new NotFoundException('Could not find that page');
        $this->Session->write('from_referer', $from);
        //}else{
        //}
        //var_dump($this->Session->check('Purchase.id_CIMB'));
        //var_dump($this->Session->read('Purchase.id_CIMB'));
        if ($this->Session->check('Purchase.id_CIMB') || $this->Session->check('Purchase.id_CIMB')) {
            try {
                if ($this->Session->check('Purchase.id_CIMB')) {
                    $data = $this->request->data;
                    //var_dump($data);
                    $MerchantCode = $_REQUEST["MerchantCode"];
                    $PaymentId = $_REQUEST["PaymentId"];
                    $RefNo = $_REQUEST["RefNo"];
                    $Amount = $_REQUEST["Amount"];
                    $Currency = $_REQUEST["Currency"];
                    $Remark = $_REQUEST["Remark"];
                    $TransId = $_REQUEST["TransId"];
                    $AuthCode = $_REQUEST["AuthCode"];
                    $Status = $_REQUEST["Status"];
                    $ErrDesc = $_REQUEST["ErrDesc"];
                    $Signature = $_REQUEST["Signature"];
                    $this->Session->write('Cimb.signature_return', $Signature);

                    $merchantCode = $this->ApiXml->getConfig('merchantCode');
                    $paymentId = $this->Session->read('tokCIMB.paymentId');
                    $merchantKey = $this->ApiXml->getConfig('merchantKey');
                    $refno = $this->Session->read('tokCIMB.refNo');
                    $totalAmount = $this->Session->read('tokCIMB.totalAmount');
                    $tmp_signature = $merchantKey . $merchantCode . $paymentId . $refno . $totalAmount . 'IDR1';
                    $signature = base64_encode(sha1($tmp_signature, true));
                    $this->Session->write('Cimb.signature_gen', $signature);

                    if ($this->Session->read('Purchase.step1.product_id') == 7) { // JAI
                        //$res = $this->Payment->find('first', array('conditions' => array('Payment.id' => $this->Session->read('Purchase.id_CIMB'))));
                        //$status = $res['Payment'];
                        $result = $this->ApiXml->updateShortTermPolicyCIMB($this->Session->read('Purchase.idPolicy'), $data);
                        if ($Status == 1) {
                            $status = 'Sukses';
                        } else {
                            $status = 'Gagal';
                        }
                        CakeLog::write('cimbclick', ' [JAI Payment.id] ' . $this->Session->read('Purchase.id_CIMB') . ' [APIResponse] ' . $result);
                    } else {
                        $id = $this->ApiXml->updatePaymentCIMBClicks($this->request->data); //utk pembayaran 1
                        //$id = $this->ApiXml->updatePaymentCIMBClicks($MerchantCode,$PaymentId,$RefNo,$Amount,$Currency,$Remark,$TransId,$AuthCode,$Status,$ErrDesc,$Signature); //utk pembayaran 1
                        //$status = $this->ApiXml->getPaymentCIMBClick($this->Session->read('Purchase.id_CIMB'));
                    }
                } else {
                    $id = $this->ApiXml->updatePaymentCIMBClicksPremi($this->request->data); //utk pembayaran 2
                    //$id = $this->ApiXml->updatePaymentCIMBClicksPremi($MerchantCode,$PaymentId,$RefNo,$Amount,$Currency,$Remark,$TransId,$AuthCode,$Status,$ErrDesc,$Signature); //utk pembayaran 2

                    $status = $this->ApiXml->getPaymentCIMBClickPremi($this->Session->read('Purchase.id_CIMBpremi'));
                }
                $prod = strtoupper(str_replace('-', ' ', $id));
                $ctthankspurchase = '1';
                $this->set(compact('status', 'ctthankspurchase', 'prod', 'data', 'Status'));
                $s = $this->Session->read('Purchase.flow.name');
                //$prod=$this->Session->read('Purchase.prod');
                if ($Status == 1) {
                    //$this->redirect(array('controller' => 'front', 'action' => 'backend_cimb' ));
                    //if($this->Session->read('Cimb.signature_gen') == $this->Session->read('Cimb.signature_return')) //signature
                    if ($Signature == $signature) {
                        $this->redirect(array('controller' => 'front', 'action' => 'cimb_sukses', 'id' => $s, '?' => array('status' => "Sukses", 'prod' => $prod)));
                    } else {
                        throw new NotFoundException('Could not find that page');
                    }
                } else {
                    $this->redirect(array('controller' => 'front', 'action' => 'cimb_gagal', 'id' => $s, '?' => array('status' => "Gagal", 'prod' => $prod)));
                }
                //
            } catch (Exception $e) {
                CakeLog::write('error', $e);
                $status = 'Gagal';
            }
        } else {
            $this->redirect(array('controller' => 'front', 'action' => 'cimb_gagal', 'id' => '0000', '?' => array('status' => 'Transaksi Gagal', 'prod' => 'unknown product')));
            //$this->redirect("/"); //ganti redirect ke gagal
        }
    }

    public function thanks_ecash($id = '') {
        if ($this->Session->check('Purchase.id_ecash')) {
            try {
                $res = $this->ApiXml->getResultEcash($this->request->query['id']);
                $result = explode(",", $res);
                $status = trim($result[4]);
                if ($this->Session->read('Purchase.step1.product_id') == 7) {
                    $this->ApiXml->updateShortTermPolicyEcash($this->Session->read('Purchase.idPolicy'), $result);
                } else
                    $status = $this->ApiXml->updateEcash($result[3], $res, $status);

                if ($status == 'SUCCESS') {
                    $this->Session->delete('Purchase.flow');
                    $this->Session->delete('Purchase.step1');
                    $this->Session->delete('Purchase.step2');
                    $this->Session->delete('Purchase.token');
                    $this->Session->delete('Purchase.id_ecash');
                }
            } catch (Exception $e) {
                CakeLog::write('error', $e);
                $status = 'FAILED';
            }


            $prod = strtoupper(str_replace('-', ' ', $id));
            $ctthankspurchase = '1';
            $this->set(compact('status', 'ctthankspurchase', 'prod'));
        } else
            $this->redirect("/");
    }

    public function step1_non_unitlink($name = "") {
//$this->redirect(array('controller' => 'front', 'action' => 'undermaintanance' ));

        $this->disableCache();

//$this->Session->delete('Purchase');

        if ($name == "jaga-motorku") {//hardcose jaga motor
            if (!$this->Session->check('Purchase.cekjmk')) {
                $this->Session->delete('Purchase');
            }
            $this->Session->write('Purchase.cekjmk', 'JMK');

            $id = $this->ApiXml->getMappingProd($name, 'non-unit-link');
            $token = $this->Session->read('Purchase.token');
            $tok = (isset($this->request->query['sid'])) ? $this->request->query['sid'] : "0";
            $product = $this->ApiXml->getProductbyID($id['product_id']);
            $_metaTitle = $this->MetaTitle->getMetaQuote('Jaga Motorku', 12); // ga efek tetep default
            $this->Session->write('Purchase.produk', $name);

            //var_dump(date('Y'));
            $optTahun = array();
            for ($i = 0; $i < 10; $i++) {
                $optTahun[date('Y') - $i] = date('Y') - $i;
            }
            //var_dump($ph_thn_mtr); 

            $prod_det = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.quote_id' => $name)));

            $coverage1 = $this->ApiXml->getCoveragebyID($product['coverage_type_id']);

            //$coverage1 = $this->ApiXml->getCoveragebyID($product[0]['coverage_type_id']);
            //$coverage2 = $this->ApiXml->getCoveragebyID($product[1]['coverage_type_id']);
            //$coverage3 = $this->ApiXml->getCoveragebyID($product[2]['coverage_type_id']);

            $optHub = $this->ApiXml->getRelationAHList(); //time out - 500
            $optProvinsi = array("BANTEN", "BENGKULU", "DI  YOGYAKARTA", "DKI JAKARTA", "GORONTALO", "IRIAN JAYA BARAT", "JAMBI", "JAWA BARAT", "JAWA TENGAH", "JAWA TIMUR", "KALIMANTAN BARAT", "KALIMANTAN SELATAN", "KALIMANTAN TENGAH", "KALIMANTAN TIMUR", "KALIMANTAN UTARA", "BANGKA BELITUNG", "KEPULAUAN RIAU", "LAMPUNG", "MALUKU", "MALUKU UTARA", "NANGGROE ACEH DARUSSALAM", "NUSA TENGGARA BARAT", "NUSA TENGGARA TIMUR", "PAPUA", "BALI", "RIAU", "SULAWESI BARAT", "SULAWESI SELATAN", "SULAWESI TENGAH", "SULAWESI TENGGARA", "SULAWESI UTARA", "SUMATRA BARAT", "SUMATRA SELATAN", "SUMATRA UTARA");

            $relasi_AH = $this->ApiXml->getJMKRelationAHList();
            $merek = $this->ApiXml->getJMKMerek();
            $provinsi = $this->ApiXml->getProvinsi();

            /*
              $ph_kel=array(''=>'');
              $ph_kec=array(''=>'');
              $ph_kota=array(''=>'');

              $kor_kel=array(''=>'');
              $kor_kec=array(''=>'');
              $kor_kota=array(''=>'');

              $insured_kel=array(''=>'');
              $insured_kec=array(''=>'');
              $insured_kota=array(''=>'');
             */
            $type_motor = array('' => '');


            if ($this->Session->check('jmk.checkout')) {
                $this->Session->delete('Purchase');
                $this->Session->delete('jmk');
            }


            if ($this->Session->check('Purchase.step1')) {
                $this->request->data['Personal'] = $this->Session->read('Purchase.step1');
                $ph_provinsi_desc = $provinsi[$this->Session->read('Purchase.step1.PROSPECT_PROVINSI')];
//var_dump($ph_provinsi_desc);
                $ph_kota = $this->ApiXml->getKotaOpt($ph_provinsi_desc);
                $ph_kota_desc = $ph_kota[$this->Session->read('Purchase.step1.PROSPECT_KOTA')];
//var_dump($ph_kota_desc);
                $ph_kec = $this->ApiXml->getKecamatanOpt($ph_provinsi_desc, $ph_kota_desc);
                $ph_kec_desc = $ph_kec[$this->Session->read('Purchase.step1.PROSPECT_KEC')];
//var_dump($ph_kec_desc);
                $ph_kel = $this->ApiXml->getKelurahanOpt($ph_provinsi_desc, $ph_kota_desc, $ph_kec_desc);
                $ph_kel_desc = $ph_kel[$this->Session->read('Purchase.step1.PROSPECT_KEL')];
//var_dump($ph_kel);
//var_dump($ph_kel_desc);
                $ph_region = $this->ApiXml->getRegionOpt($ph_provinsi_desc, $ph_kota_desc, $ph_kec_desc, $ph_kel_desc);


                $kor_provinsi_desc = $provinsi[$this->Session->read('Purchase.step1.KORESPONDENSI_PROVINSI')];
//var_dump($kor_provinsi_desc);
                $kor_kota = $this->ApiXml->getKotaOpt($ph_provinsi_desc);
                $kor_kota_desc = $kor_kota[$this->Session->read('Purchase.step1.KORESPONDENSI_KOTA')];
//var_dump($kor_kota_desc);
                $kor_kec = $this->ApiXml->getKecamatanOpt($kor_provinsi_desc, $kor_kota_desc);
                $kor_kec_desc = $kor_kec[$this->Session->read('Purchase.step1.KORESPONDENSI_KEC')];
//var_dump($kor_kec_desc);
                $kor_kel = $this->ApiXml->getKelurahanOpt($kor_provinsi_desc, $kor_kota_desc, $kor_kec_desc);
                $kor_kel_desc = $kor_kel[$this->Session->read('Purchase.step1.KORESPONDENSI_KEL')];
//var_dump($kor_kel_desc);
                $kor_region = $this->ApiXml->getRegionOpt($kor_provinsi_desc, $kor_kota_desc, $kor_kec_desc, $kor_kel_desc);

                $insured_provinsi_desc = $provinsi[$this->Session->read('Purchase.step1.PROSPECT_PROVINSI2')];
//var_dump($insured_provinsi_desc);
                $insured_kota = $this->ApiXml->getKotaOpt($insured_provinsi_desc);
                $insured_kota_desc = $insured_kota[$this->Session->read('Purchase.step1.PROSPECT_KOTA2')];
//var_dump($insured_kota_desc);
                $insured_kec = $this->ApiXml->getKecamatanOpt($insured_provinsi_desc, $insured_kota_desc);
                $insured_kec_desc = $insured_kec[$this->Session->read('Purchase.step1.PROSPECT_KEC2')];
//var_dump($insured_kec_desc);
                $insured_kel = $this->ApiXml->getKelurahanOpt($insured_provinsi_desc, $insured_kota_desc, $insured_kec_desc);
                $insured_kel_desc = $insured_kel[$this->Session->read('Purchase.step1.PROSPECT_KEL2')];
//var_dump($insured_kel_desc);         
                $insured_region = $this->ApiXml->getRegionOpt($insured_provinsi_desc, $insured_kota_desc, $insured_kec_desc, $insured_kel_desc);

                $type_motor = $this->ApiXml->getJMKSeriesOpt($this->Session->read('Purchase.step1.MEREK_MOTOR'));
//var_dump($type_motor);

                $relasi_AH[0] = 'tertanggung utama';
            } else {

                $ph_kel = array('' => '');
                $ph_kec = array('' => '');
                $ph_kota = array('' => '');

                $kor_kel = array('' => '');
                $kor_kec = array('' => '');
                $kor_kota = array('' => '');

                $insured_kel = array('' => '');
                $insured_kec = array('' => '');
                $insured_kota = array('' => '');
            }


            $this->set(compact('ph_kota', 'ph_kec', 'ph_kel', 'kor_kel', 'kor_kec', 'kor_kota', 'insured_kel', 'insured_kec', 'insured_kota', 'type_motor', 'optTahun'));

            $plat = $this->ApiXml->getJMKPlate();
//var_dump($plat[20]);

            $this->set(compact('relasi_AH', 'merek', 'plat', 'provinsi'));
            $allphone = $this->Val->find('all', array('conditions' => array()));
            $this->set(compact('allphone'));



            $this->set(compact('product', 'prod_det', 'coverage1', 'coverage2', 'coverage3', 'name', 'premMode', 'id', '_metaTitle', 'optProvinsi', 'optHub'));

            if ($this->request->is('post') || $this->request->is('put')) {
                if (null == $this->Session->read('Purchase.token')) {
                    $token = md5(time());
                    $this->Session->write('Purchase.token', $token);

                    $this->Session->write('Purchase.flow', array(
                        'cat' => $id['cat'],
                        'name' => $name,
                    ));
                }
                $this->redirect(array('controller' => 'front', 'action' => 'step4_checkout', '?' => array('sid' => $token, 'cat' => $id['cat'], 'name' => $name)));
            }
        } else {//hardcoe jaga motor
            $id = $this->ApiXml->getMappingProd($name, 'non-unit-link');
            $token = $this->Session->read('Purchase.token');
            $tok = (isset($this->request->query['sid'])) ? $this->request->query['sid'] : "0";
            $product = $this->ApiXml->getProductbyID($id['product_id']);

            if ($name == 'jaga-jiwa-plus' || $name == 'jaga-aman-plus')
                $prod_name = $name . '5';
            else
                $prod_name = $name;


            if ($name == 'jaga-jiwa-plus' && (isset($this->request->data['Personal']['QUOTE_PREMIUM_LIFESPAN']) && $this->request->data['Personal']['QUOTE_PREMIUM_LIFESPAN'] == '7')) {
                $this->request->data['Personal']['product_id'] = '15';
            }
            if ($name == 'jaga-aman-plus' && (isset($this->request->data['Personal']['QUOTE_PREMIUM_LIFESPAN']) && $this->request->data['Personal']['QUOTE_PREMIUM_LIFESPAN'] == '7')) {
                $this->request->data['Personal']['product_id'] = '18';
            }
            $prod_det = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.quote_id' => $prod_name)));

            $_metaTitle = $this->MetaTitle->getMetaQuote($product['product_description'], $product['product_id']);
            /* if($name!=$this->Session->read('Purchase.flow.name')) {
              $this->Session->delete('Purchase.Tertanggung');
              $this->Session->delete('Purchase.step2.me');
              } */
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Session->delete('Purchase.Tertanggung');
                $this->Session->delete('Purchase.step2.me');
                $this->Session->delete('Purchase.Ahliwaris');
                $sess = $this->request->data['Personal'];
                if ($sess['product_id'] == 7) {
                    $subjai = substr($sess['DURATION_JAI'], 0, 4);
                    $valjai = substr($sess['DURATION_JAI'], 4);
                    if ($subjai == 'hour') {
                        $sess['QUOTE_DURATION_HOUR'] = $valjai;
                        unset($sess['QUOTE_DURATION_DAYS']);
                        unset($sess['QUOTE_PREMIUM_LIFESPAN']);
                    } else if ($subjai == 'days') {
                        $sess['QUOTE_DURATION_DAYS'] = $valjai;
                        unset($sess['QUOTE_DURATION_HOUR']);
                        unset($sess['QUOTE_PREMIUM_LIFESPAN']);
                    } else {
                        $sess['QUOTE_PREMIUM_LIFESPAN'] = $valjai;
                        unset($sess['QUOTE_DURATION_HOUR']);
                        unset($sess['QUOTE_DURATION_DAYS']);
                    }
                }
                $sess['SUM_INSURED'] = preg_replace("/[^0-9]/", "", $sess['SUM_INSURED']);

                if ($this->Session->check('Purchase.step1')) {
                    $this->Session->write('Purchase.step1', am($this->Session->read('Purchase.step1'), $sess));
                } else {
                    $this->Session->write('Purchase.step1', $sess);
                }

                //$this->Session->write('Purchase.step1', $sess);
                $this->Session->write('Purchase.produk', $product['product_description']);
                $this->Session->write('Purchase.manfaat', $prod_det['Product']['manfaat']);

                if ($name == 'jaga-jiwa-plus') {

                    if ($this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN') == 5)
                        $next_name = $name . '5';
                    else
                        $next_name = $name . '7';
                }
                elseif ($name == 'jaga-aman-plus') {

                    if ($this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN') == 5)
                        $next_name = $name . '5';
                    else
                        $next_name = $name . '7';
                }
                else {
                    $next_name = $name;
                }
                $this->Session->write('Purchase.flow', array('cat' => 'non-unit-link', 'name' => $next_name));
                // $this->Session->write('Purchase.flow', array('cat'=>'non-unit-link','name'=>$name));
                if (null == $this->Session->read('Purchase.token')) {
                    $token = md5(time());
                    $this->Session->write('Purchase.token', $token);
                }
                $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $next_name, '?' => array('sid' => $token, 'cat' => 'non-unit-link')));
            } else {
                if (isset($this->request->query['sid']) && $tok == $token) {
                    $this->request->data['Personal'] = $this->Session->read('Purchase.step1');
                } else if ($this->Auth->loggedIn()) {
                    $tmp = $this->ApiXml->setProspectCust();
                    $this->request->data['Personal'] = $this->Session->read('Purchase.step1');
                } else {
                    $this->request->data = null;
                }
            }
            $coverage = $this->ApiXml->getCoveragebyID($product['coverage_type_id']);
            $optFrek = $this->ApiXml->GetOptPremiModeByID($id['product_id']);
            if ($product['product_id'] == 7) {
                $optPP = $this->ApiXml->getPeriodAmanInstan($product['coverage_type_id']);
            } else if ($product['product_id'] == 17 || $product['product_id'] == 18 || $product['product_id'] == 14 || $product['product_id'] == 15) {

                $optPP = $this->ApiXml->getOptPPAnd(5, 7);
            } else if ($coverage['MaxDurationDays'] == 0 && $coverage['MinDurationDays'] == 0) {
                $optPP = $this->ApiXml->getOptPP($coverage['MinDuration'], $coverage['MaxDuration']);
            } else {
                $optPP = array($coverage['MinDurationDays'] => $coverage['MinDurationDays'] . ' Hari', $coverage['MaxDurationDays'] => $coverage['MaxDurationDays'] . ' Hari');
            }
            $optUp = $this->ApiXml->getOptUp($coverage['MinSumInsured'], $coverage['MaxSumInsured'], $coverage['SumInsuredMultiply']);


//$home= $_SERVER["HTTP_REFERER"];

            $this->set(compact('optFrek', 'product', 'prod_det', 'coverage', 'name', 'premMode', 'id', 'optPP', 'optUp', /* 'home', */ '_metaTitle'));
        }//end hardcode jaga motor
    }

//fixed


    public function step2_your_detail($name = "") {
        $this->disableCache();
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
//$link_req=Router::url( $this->here, true );
//$a=$link_req.'?sid='.$sid.'&cat='.$cat;
//var_dump( $a);
//$b=$_SERVER['HTTP_REFERER'];
//var_dump($b);
//if($b==null){$this->redirect(array('controller'=>'front','action'=>'step2_your_detail','?'=>array('sid'=>$sid, 'cat'=$cat) ));}
//if($b==null){$this->redirect($a);}
//if (null == $this->Session->read('Purchase.token')) {
// $token = md5(time());
// $this->Session->write('Purchase.token', $token);
//}
//$this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $next_name, '?' => array('sid' => $token, 'cat' => 'non-unit-link')));

        $_metaTitle = $this->MetaTitle->getMetaCust($this->Session->read('Purchase.produk'));
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            if ($this->Session->check('Purchase.step2')) {
                $this->request->data['Detail'] = $this->Session->read('Purchase.step2');
            }
            $statTU = $this->ApiXml->getTertanggungUtamaStat(); //var_dump($statTU);
            $arrayID = $this->ApiXml->getArrayRelation($this->Session->read('Purchase.Tertanggung')); //var_dump($arrayID);
            //start untuk JSK
            if ($this->Session->read('Purchase.step1.product_id') == 21 && $this->Session->read('PROSPECT_DOB2_FOR_ENTRY') == "")
                array_push($arrayID, 2);
            //end untuk JSK
            $prodListID = array(11, 12, 13, 21, 23);
            if ((in_array($this->Session->read('Purchase.step1.product_id'), $prodListID)) && $arrayID == null)
                $arrayID = array('1');
            //$optInsureRel=($statTU!=-1)?$this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'),$arrayID):array('1'=>'Tertanggung Utama');
            $optInsureRel = $this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'), $arrayID);
            $optHub = $this->ApiXml->getRelationAHList();
            $product = $this->ApiXml->getProductbyID($this->Session->read('Purchase.step1.product_id'), array('min_adult_age', 'max_adult_age', 'coverage_type_benefit_id'));
            $countRelInsure = count($this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id')));
            $this->set(compact('sid', 'cat', 'name', 'optHub', '_metaTitle', 'optInsureRel', 'product', 'countRelInsure', 'statTU'));
            $optProvinsi = array("BANTEN", "BENGKULU", "DI  YOGYAKARTA", "DKI JAKARTA", "GORONTALO", "IRIAN JAYA BARAT", "JAMBI", "JAWA BARAT", "JAWA TENGAH", "JAWA TIMUR", "KALIMANTAN BARAT", "KALIMANTAN SELATAN", "KALIMANTAN TENGAH", "KALIMANTAN TIMUR", "KALIMANTAN UTARA", "BANGKA BELITUNG", "KEPULAUAN RIAU", "LAMPUNG", "MALUKU", "MALUKU UTARA", "NANGGROE ACEH DARUSSALAM", "NUSA TENGGARA BARAT", "NUSA TENGGARA TIMUR", "PAPUA", "BALI", "RIAU", "SULAWESI BARAT", "SULAWESI SELATAN", "SULAWESI TENGAH", "SULAWESI TENGGARA", "SULAWESI UTARA", "SUMATRA BARAT", "SUMATRA SELATAN", "SUMATRA UTARA");
            $this->set(compact('optProvinsi'));
        } else {
            $this->redirect("/");
        }
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
        if (!$this->Auth->loggedIn())
            $this->set('captcha_fields', $this->captchas);
    }

    public function step4_checkout() {
        try {
            $this->disableCache();
            $sid = $this->request->query['sid'];
            $cat = $this->request->query['cat'];
            $name = $this->request->query['name'];
            $_metaTitle = $this->MetaTitle->getMetaCust($this->Session->read('Purchase.produk'));
            $prod_det = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.quote_id' => $name)));
            $email_black = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
            $phone_black = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
            $birth_black = $this->Session->read('Purchase.step1.PROSPECT_DOB');
            $emph = $this->Black->find('first', array('conditions' => array('Black.email' => $email_black)));
            //$embir=$this->Black->find('first', array('conditions' => array('Black.email' => $email_black,'Black.tanggal_lahir'=>$birth_black)));
            $phbir = $this->Black->find('first', array('conditions' => array('Black.phone' => $phone_black)));

            if ($emph == null AND $phbir == null) {

                if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {

                    if ($this->request->is('post') || $this->request->is('put') || $this->Session->read('Purchase.step1.product_id') == 24) {

                        if ($this->Session->read('Purchase.step1.product_id') != 24)
                            $sess = $this->request->data['Detail']; //gat data dari step2

                            /* Try HardCode Andi */
                        if (!isset($sess['me']))
                            $sess['me'] = 'Y';
                        //$this->Session->write('beetwen', 'xcv');
                        if ($cat == 'unit-link') {
                            $_tmp = $this->ApiXml->storeUnitLink($this->Session->read('Purchase.step1'), $sess);
                        } else if ($this->Session->read('Purchase.step1.product_id') == '7') {  // jaga aman instan
                            $this->Session->write('Purchase.QUOTE_ID', time());
                            $step1 = $this->Session->read('Purchase.step1');
                            $up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
                            $premi = $this->ApiXml->getPremiumRate($step1['COVERAGE_TYPE_ID'], $step1['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($step1['PROSPECT_DOB']), $step1['PROSPECT_GENDER'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);
                            $premi = $this->Session->read('Purchase.premi.total_premi');
                            if ($step1['HARD_COPY'] == 'Y') {
                                $premi = $premi + 50000;
                            } else if (isset($step1['QUOTE_DURATION_DAYS']) && $step1['QUOTE_DURATION_DAYS'] >= 180) {
                                //$premi = $premi + 25000;
                                $premi = $premi;
                            }
                            $this->Session->write('Purchase.premi.total_premi', $premi);
                        } else if ($this->Session->read('Purchase.step1.product_id') == 24) {  // jaga motorku
                            $this->Session->write('jmk.checkout', 'true');
                            //$this->Session->write('Purchase.QUOTE_ID', time());//quote id by time

                            $step1_jmk = $this->Session->read('Purchase.jmk');
                            //$premi = $this->Session->read('Purchase.premi');
                            //$up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
                            //$premi = $this->ApiXml->getPremiumRate('24', $premi['mode'], $this->ApiXml->getAge($step1['insured_dob']), $step1['insured_gender'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);
                            //$premi = $this->ApiXml->getPremiumRateJMK('24', $premi['mode'], $this->ApiXml->getAge($step1_jmk['insured_dob']), $step1_jmk['insured_gender'], isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 1, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0,  isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0,  '75');
                            //if(isset($premi) || $premi == null || $premi==0){
                            //echo "<script>alert('Maaf, terjadi kesalahan. Mohon ulangi proses pembelian hanya dengan menggunakan 1 tab pada browser anda. Terima Kasih');</script>";
                            //	}
                            //if ($step1_jmk['ph_reqbook'] == 'Y') {
                            //    $premi = $premi + 50000;
                            //}

                            try {
                                $_tmp = $this->ApiXml->storeJMK($step1_jmk);
                            } catch (Exception $e) {
                                //echo 'Message: ' .$e->getMessage();
                                CakeLog::write('error', $e->getMessage());
                            }



                            $sess['PROSPECT_NAME'] = $this->Session->read('Purchase.step1.PROSPECT_NAME');
                            $sess['PROSPECT_DOB'] = $this->Session->read('Purchase.step1.PROSPECT_DOB');
                            $sess['PROSPECT_GENDER'] = $this->Session->read('Purchase.step1.PROSPECT_GENDER');
                            $sess['PROSPECT_ADDRESS'] = $this->Session->read('Purchase.step1.PROSPECT_ADDRESS');
                            $sess['PROSPECT_EMAIL'] = $this->Session->read('Purchase.step1.PROSPECT_EMAIL');
                            $sess['PROSPECT_MOBILE_PHONE'] = $this->Session->read('Purchase.step1.PROSPECT_MOBILE_PHONE');


                            //$this->Session->write('Purchase.premi.total_premi', $premi);
                        } else {
                            //$this->Session->write('else', 'xcv');
                            $step1_sess = $this->Session->read('Purchase.step1');

                            if ($step1_sess['product_id'] == 17 || $step1_sess['product_id'] == 18) {
                                if ($step1_sess['QUOTE_PREMIUM_LIFESPAN'] == 5) {
                                    $step1_sess['product_id'] = 17;
                                    $step1_sess['COVERAGE_TYPE_ID'] = 19;
                                } else {
                                    $step1_sess['product_id'] = 18;
                                    $step1_sess['COVERAGE_TYPE_ID'] = 20;
                                }
                            }

                            if ($step1_sess['product_id'] == 14 || $step1_sess['product_id'] == 15) {
                                if ($step1_sess['QUOTE_PREMIUM_LIFESPAN'] == 5) {
                                    $step1_sess['product_id'] = 14;
                                    $step1_sess['COVERAGE_TYPE_ID'] = 14;
                                } else {
                                    $step1_sess['product_id'] = 15;
                                    $step1_sess['COVERAGE_TYPE_ID'] = 15;
                                }
                            }

                            if ($step1_sess['product_id'] == 24) {
                                $step1_sess['product_id'] = 24;
                                $step1_sess['COVERAGE_TYPE_ID'] = 24;
                                $_tmp = $this->ApiXml->storeJMK($step1_sess, $sess);
                            } else
                                $_tmp = $this->ApiXml->storeNonUnitLink($step1_sess, $sess);
                        }

                        $this->Session->write('Purchase.step2', $sess);
                    }

                    if ($cat == 'unit-link')
                        $chart = $this->ApiXml->GetGrafikUnitLink($this->Session->read('Purchase.QUOTE_ID'));
                    else
                        $chart = null;

                    $urlKlikPay = $this->ApiXml->getConfig('klikPayUrl');
                    $urlCimbClick = $this->ApiXml->getConfig('cimbClick');
                    $NicePayUrl = $this->ApiXml->getConfig('NicePayUrl');

                    $urlDO = $this->ApiXml->getConfig('DOurl');
                    $ECashPayUrl = $this->ApiXml->getConfig('ecashPayment');
                    $optInsureRel = $this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'));

                    //$totalpremi = $this->Session->read('Purchase.premi.total_premi');
                    //$cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21)? $this->Session->read('Purchase.step1.cashlessFee') : 0 );
                    //$miscFee = number_format(0, 2, '.', '');
                    //$merchantCode=$this->ApiXml->getConfig('merchantCode');
                    //$paymentId=7;
                    //$merchantKey=$this->ApiXml->getConfig('merchantKey');
                    //$totalAmount = $totalpremi + $cashlessFee;
                    //$totalAmount= $totalAmount.'00';
                    //$tmp_signature=  $merchantKey.$merchantCode.$paymentId.$refno.$totalAmount.'IDR'.'1';
                    //$signature=sha1($tmp_signature);
                    //$userName = $this->Session->read('Purchase.step2.PROSPECT_NAME');
                    //$userEmail = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
                    //$userContact = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
                    //$quote = $this->ApiXml->getQuoteByID($id);
                    //$refNo= $quote['QuoteNo'];
                    //$transactionDate = date('d/m/Y H:i:s');
                    //$descp = 'CAF PREMI PERTAMA';
                    //$transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');
                    //$return_url = Router::url(array('controller' => 'front', 'action' => 'thanks_cimbclick', 'id' => $name), true);
                    //$backend_url= Router::url(array('controller' => 'front', 'action' => 'backend_cimb'), true);
                    //$tokCIMB = array('merchantCode' => $merchantCode, 'paymentId'=>$paymentId, 'refNo' => $quote['QuoteNo'], 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'descp' => 'descp', 'userName' => $userName, 'userEmail' => $userEmail, 'userContact' => $userContact, 'remark' => $descp, 'signature' => $signature, 'responseUrl'=>$return_url , 'backendUrl'=>$backend_url);
                    ////
                    $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'NicePayUrl', 'urlDO', 'ECashPayUrl', 'optInsureRel', 'prod_det'));
                    // $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'urlDO', 'ECashPayUrl', 'optInsureRel','merchantCode', 'paymentId','merchantKey','totalAmount','signature','userName','userEmail','userContact','descp','return_url','backend_url','refNo'));   
                }else {
                    $this->redirect("/");
                }
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
            $cashlessFee = $this->Session->read('Purchase.step1.cashlessfee');
            $this->set(compact('emph', 'embir', 'phbir', 'email_black', 'phone_black', 'birth_black', 'cashlessFee'));
        } catch (Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            CakeLog::write('error', $e->getMessage());
        }
    }

    public function step4_checkout_cermatixx() {
        $this->disableCache();
        //$sid = $this->request->query['sid'];
        //$cat = $this->request->query['cat'];
        //$name = $this->request->query['name'];
        $_metaTitle = $this->MetaTitle->getMetaCust($this->Session->read('Purchase.produk'));
        $prod_det = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.quote_id' => $name)));
        $email_black = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
        $phone_black = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
        $birth_black = $this->Session->read('Purchase.step1.PROSPECT_DOB');
        $emph = $this->Black->find('first', array('conditions' => array('Black.email' => $email_black)));
        //$embir=$this->Black->find('first', array('conditions' => array('Black.email' => $email_black,'Black.tanggal_lahir'=>$birth_black)));
        $phbir = $this->Black->find('first', array('conditions' => array('Black.phone' => $phone_black)));

        if ($emph == null AND $phbir == null) {
            //if ($this->ApiXml->getValidUrl($sid, $cat, $name)) 
            //{
            if ($this->request->is('post') || $this->request->is('put') || $this->Session->read('Purchase.step1.product_id') == 24) {
                if ($this->Session->read('Purchase.step1.product_id') != 24)
                    $sess = $this->request->data['Detail']; //gat data dari step2
                    /* Try HardCode Andi */
                if (!isset($sess['me']))
                    $sess['me'] = 'Y';
                //$this->Session->write('beetwen', 'xcv');
                if ($cat == 'unit-link') {
                    $_tmp = $this->ApiXml->storeUnitLink($this->Session->read('Purchase.step1'), $sess);
                } else if ($this->Session->read('Purchase.step1.product_id') == '7') {  // jaga aman instan
                    $this->Session->write('Purchase.QUOTE_ID', time());
                    $step1 = $this->Session->read('Purchase.step1');
                    $up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
                    $premi = $this->ApiXml->getPremiumRate($step1['COVERAGE_TYPE_ID'], $step1['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($step1['PROSPECT_DOB']), $step1['PROSPECT_GENDER'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);
                    $premi = $this->Session->read('Purchase.premi.total_premi');

                    if ($step1['HARD_COPY'] == 'Y') {
                        $premi = $premi + 50000;
                    } else if (isset($step1['QUOTE_DURATION_DAYS']) && $step1['QUOTE_DURATION_DAYS'] >= 180) {
                        //$premi = $premi + 25000;
                        $premi = $premi;
                    }
                    $this->Session->write('Purchase.premi.total_premi', $premi);
                } else if ($this->Session->read('Purchase.step1.product_id') == 24) {  // jaga motorku
                    $this->Session->write('jmk.checkout', 'true');
                    //$this->Session->write('Purchase.QUOTE_ID', time());//quote id by time

                    $step1_jmk = $this->Session->read('Purchase.jmk');
                    //$premi = $this->Session->read('Purchase.premi');
                    //$up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
                    //$premi = $this->ApiXml->getPremiumRate('24', $premi['mode'], $this->ApiXml->getAge($step1['insured_dob']), $step1['insured_gender'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);
                    //$premi = $this->ApiXml->getPremiumRateJMK('24', $premi['mode'], $this->ApiXml->getAge($step1_jmk['insured_dob']), $step1_jmk['insured_gender'], isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 1, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0,  isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0,  '75');
                    //if(isset($premi) || $premi == null || $premi==0){
                    //echo "<script>alert('Maaf, terjadi kesalahan. Mohon ulangi proses pembelian hanya dengan menggunakan 1 tab pada browser anda. Terima Kasih');</script>";
                    //	}
                    //if ($step1_jmk['ph_reqbook'] == 'Y') {
                    //    $premi = $premi + 50000;
                    //}

                    try {
                        $_tmp = $this->ApiXml->storeJMK($step1_jmk);
                    } catch (Exception $e) {
                        //echo 'Message: ' .$e->getMessage();
                        CakeLog::write('error', $e->getMessage());
                    }

                    $sess['PROSPECT_NAME'] = $this->Session->read('Purchase.step1.PROSPECT_NAME');
                    $sess['PROSPECT_DOB'] = $this->Session->read('Purchase.step1.PROSPECT_DOB');
                    $sess['PROSPECT_GENDER'] = $this->Session->read('Purchase.step1.PROSPECT_GENDER');
                    $sess['PROSPECT_ADDRESS'] = $this->Session->read('Purchase.step1.PROSPECT_ADDRESS');
                    $sess['PROSPECT_EMAIL'] = $this->Session->read('Purchase.step1.PROSPECT_EMAIL');
                    $sess['PROSPECT_MOBILE_PHONE'] = $this->Session->read('Purchase.step1.PROSPECT_MOBILE_PHONE');


                    //$this->Session->write('Purchase.premi.total_premi', $premi);
                } else {
                    //$this->Session->write('else', 'xcv');
                    $step1_sess = $this->Session->read('Purchase.step1');

                    if ($step1_sess['product_id'] == 17 || $step1_sess['product_id'] == 18) {
                        if ($step1_sess['QUOTE_PREMIUM_LIFESPAN'] == 5) {
                            $step1_sess['product_id'] = 17;
                            $step1_sess['COVERAGE_TYPE_ID'] = 19;
                        } else {
                            $step1_sess['product_id'] = 18;
                            $step1_sess['COVERAGE_TYPE_ID'] = 20;
                        }
                    }

                    if ($step1_sess['product_id'] == 14 || $step1_sess['product_id'] == 15) {
                        if ($step1_sess['QUOTE_PREMIUM_LIFESPAN'] == 5) {
                            $step1_sess['product_id'] = 14;
                            $step1_sess['COVERAGE_TYPE_ID'] = 14;
                        } else {
                            $step1_sess['product_id'] = 15;
                            $step1_sess['COVERAGE_TYPE_ID'] = 15;
                        }
                    }

                    if ($step1_sess['product_id'] == 24) {
                        $step1_sess['product_id'] = 24;
                        $step1_sess['COVERAGE_TYPE_ID'] = 24;
                        $_tmp = $this->ApiXml->storeJMK($step1_sess, $sess);
                    } else
                        $_tmp = $this->ApiXml->storeNonUnitLink($step1_sess, $sess);
                }

                $this->Session->write('Purchase.step2', $sess);
            }

            if ($cat == 'unit-link')
                $chart = $this->ApiXml->GetGrafikUnitLink($this->Session->read('Purchase.QUOTE_ID'));
            else
                $chart = null;

            $urlKlikPay = $this->ApiXml->getConfig('klikPayUrl');
            $urlCimbClick = $this->ApiXml->getConfig('cimbClick');
            $NicePayUrl = $this->ApiXml->getConfig('NicePayUrl');

            $urlDO = $this->ApiXml->getConfig('DOurl');
            $ECashPayUrl = $this->ApiXml->getConfig('ecashPayment');
            $optInsureRel = $this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'));

            //$totalpremi = $this->Session->read('Purchase.premi.total_premi');
            //$cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21)? $this->Session->read('Purchase.step1.cashlessFee') : 0 );      
            //$miscFee = number_format(0, 2, '.', '');
            //$merchantCode=$this->ApiXml->getConfig('merchantCode');
            //$paymentId=7;
            //$merchantKey=$this->ApiXml->getConfig('merchantKey');
            //$totalAmount = $totalpremi + $cashlessFee;
            //$totalAmount= $totalAmount.'00';
            //$tmp_signature=  $merchantKey.$merchantCode.$paymentId.$refno.$totalAmount.'IDR'.'1';
            //$signature=sha1($tmp_signature);
            //$userName = $this->Session->read('Purchase.step2.PROSPECT_NAME');
            //$userEmail = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
            //$userContact = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
            //$quote = $this->ApiXml->getQuoteByID($id);
            //$refNo= $quote['QuoteNo'];
            //$transactionDate = date('d/m/Y H:i:s');
            //$descp = 'CAF PREMI PERTAMA';
            //$transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');
            //$return_url = Router::url(array('controller' => 'front', 'action' => 'thanks_cimbclick', 'id' => $name), true);
            //$backend_url= Router::url(array('controller' => 'front', 'action' => 'backend_cimb'), true);
            //$tokCIMB = array('merchantCode' => $merchantCode, 'paymentId'=>$paymentId, 'refNo' => $quote['QuoteNo'], 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'descp' => 'descp', 'userName' => $userName, 'userEmail' => $userEmail, 'userContact' => $userContact, 'remark' => $descp, 'signature' => $signature, 'responseUrl'=>$return_url , 'backendUrl'=>$backend_url);

            $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'NicePayUrl', 'urlDO', 'ECashPayUrl', 'optInsureRel', 'prod_det'));
            // $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'urlDO', 'ECashPayUrl', 'optInsureRel','merchantCode', 'paymentId','merchantKey','totalAmount','signature','userName','userEmail','userContact','descp','return_url','backend_url','refNo'));   
            //}else {
            //$this->redirect("/");
            //}
        } else {
            $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
        }
        $cashlessFee = $this->Session->read('Purchase.step1.cashlessfee');
        $this->set(compact('emph', 'embir', 'phbir', 'email_black', 'phone_black', 'birth_black', 'cashlessFee'));
    }

    public function step4_checkout_cermati() {
        $this->disableCache();
        //$sid = $this->request->query['sid'];
        //$cat = $this->request->query['cat'];
        //$name = $this->request->query['name'];
        $_metaTitle = $this->MetaTitle->getMetaCust($this->Session->read('Purchase.produk'));
//    $prod_det = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.quote_id' => $name)));
//    $email_black = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
//    $phone_black = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
//    $birth_black = $this->Session->read('Purchase.step1.PROSPECT_DOB');
//    $emph = $this->Black->find('first', array('conditions' => array('Black.email' => $email_black)));
        //$embir=$this->Black->find('first', array('conditions' => array('Black.email' => $email_black,'Black.tanggal_lahir'=>$birth_black)));
//    $phbir = $this->Black->find('first', array('conditions' => array('Black.phone' => $phone_black)));
//    if ($emph == null AND $phbir == null) 
//    {
        //        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) 
        //        {
//            if ($this->request->is('post') || $this->request->is('put') ||$this->Session->read('Purchase.step1.product_id') == 24) 
//            {
//                if ($this->Session->read('Purchase.step1.product_id') != 24)
//                    $sess = $this->request->data['Detail'];//gat data dari step2
        /* Try HardCode Andi */
//                if (!isset($sess['me']))
//                    $sess['me'] = 'Y';
        //$this->Session->write('beetwen', 'xcv');
//                if ($cat == 'unit-link') 
//                {
//                    $_tmp = $this->ApiXml->storeUnitLink($this->Session->read('Purchase.step1'), $sess);
//                } else if ($this->Session->read('Purchase.step1.product_id') == '7') {  // jaga aman instan
//
//                    $this->Session->write('Purchase.QUOTE_ID', time());
//                    $step1 = $this->Session->read('Purchase.step1');
//                    $up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
//                    $premi = $this->ApiXml->getPremiumRate($step1['COVERAGE_TYPE_ID'], $step1['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($step1['PROSPECT_DOB']), $step1['PROSPECT_GENDER'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);
//                    $premi = $this->Session->read('Purchase.premi.total_premi');
//
//                    if ($step1['HARD_COPY'] == 'Y') {
//                        $premi = $premi + 50000;
//                    } else if (isset($step1['QUOTE_DURATION_DAYS']) && $step1['QUOTE_DURATION_DAYS'] >= 180) {
//                        //$premi = $premi + 25000;
//                        $premi = $premi;
//                    }
//                    $this->Session->write('Purchase.premi.total_premi', $premi);
//
//                } else if ($this->Session->read('Purchase.step1.product_id') == 24) {  // jaga motorku
//
//                    $this->Session->write('jmk.checkout', 'true');
//                    //$this->Session->write('Purchase.QUOTE_ID', time());//quote id by time
//
//                    $step1_jmk = $this->Session->read('Purchase.jmk');
//                    //$premi = $this->Session->read('Purchase.premi');
//                    //$up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
//                    //$premi = $this->ApiXml->getPremiumRate('24', $premi['mode'], $this->ApiXml->getAge($step1['insured_dob']), $step1['insured_gender'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);
//                    //$premi = $this->ApiXml->getPremiumRateJMK('24', $premi['mode'], $this->ApiXml->getAge($step1_jmk['insured_dob']), $step1_jmk['insured_gender'], isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 1, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0,  isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0,  '75');
//
//                    //if(isset($premi) || $premi == null || $premi==0){
//                    //echo "<script>alert('Maaf, terjadi kesalahan. Mohon ulangi proses pembelian hanya dengan menggunakan 1 tab pada browser anda. Terima Kasih');</script>";
//                    //	}
//
//                    //if ($step1_jmk['ph_reqbook'] == 'Y') {
//                    //    $premi = $premi + 50000;
//                    //}
//
//                    try{
//                            $_tmp = $this->ApiXml->storeJMK($step1_jmk);                             
//
//                    }catch(Exception $e) {
//                      //echo 'Message: ' .$e->getMessage();
//                      CakeLog::write('error', $e->getMessage());
//                    }
//
//                    $sess['PROSPECT_NAME'] =  $this->Session->read('Purchase.step1.PROSPECT_NAME');
//                    $sess['PROSPECT_DOB'] = $this->Session->read('Purchase.step1.PROSPECT_DOB');
//                    $sess['PROSPECT_GENDER'] = $this->Session->read('Purchase.step1.PROSPECT_GENDER');
//                    $sess['PROSPECT_ADDRESS'] =  $this->Session->read('Purchase.step1.PROSPECT_ADDRESS');
//                    $sess['PROSPECT_EMAIL'] = $this->Session->read('Purchase.step1.PROSPECT_EMAIL');
//                    $sess['PROSPECT_MOBILE_PHONE'] = $this->Session->read('Purchase.step1.PROSPECT_MOBILE_PHONE');
//
//			
//                        //$this->Session->write('Purchase.premi.total_premi', $premi);
//
//                } else {
//                    //$this->Session->write('else', 'xcv');
//                    $step1_sess = $this->Session->read('Purchase.step1');
//
//                    if ($step1_sess['product_id'] == 17 || $step1_sess['product_id'] == 18) {
//                        if ($step1_sess['QUOTE_PREMIUM_LIFESPAN'] == 5) {
//                            $step1_sess['product_id'] = 17;
//                            $step1_sess['COVERAGE_TYPE_ID'] = 19;
//                        } else {
//                            $step1_sess['product_id'] = 18;
//                            $step1_sess['COVERAGE_TYPE_ID'] = 20;
//                        }
//                    }
//
//                    if ($step1_sess['product_id'] == 14 || $step1_sess['product_id'] == 15) {
//                        if ($step1_sess['QUOTE_PREMIUM_LIFESPAN'] == 5) {
//                            $step1_sess['product_id'] = 14;
//                            $step1_sess['COVERAGE_TYPE_ID'] = 14;
//                        } else {
//                            $step1_sess['product_id'] = 15;
//                            $step1_sess['COVERAGE_TYPE_ID'] = 15;
//                        }
//                    }
//
//                    if ($step1_sess['product_id'] == 24 ) {
//                            $step1_sess['product_id'] = 24;
//                            $step1_sess['COVERAGE_TYPE_ID'] = 24;
//                            $_tmp = $this->ApiXml->storeJMK($step1_sess, $sess);                             
//                    }else 
//                        $_tmp = $this->ApiXml->storeNonUnitLink($step1_sess, $sess);
//
//                }
//
//                    $this->Session->write('Purchase.step2', $sess);
//            }
//            if ($cat == 'unit-link')
//                $chart = $this->ApiXml->GetGrafikUnitLink($this->Session->read('Purchase.QUOTE_ID')); 
//            else
//                $chart = null;

        $urlKlikPay = $this->ApiXml->getConfig('klikPayUrl');
        $urlCimbClick = $this->ApiXml->getConfig('cimbClick');
        $NicePayUrl = $this->ApiXml->getConfig('NicePayUrl');

        $urlDO = $this->ApiXml->getConfig('DOurl');
        $ECashPayUrl = $this->ApiXml->getConfig('ecashPayment');
//          $optInsureRel = $this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'));
        //$totalpremi = $this->Session->read('Purchase.premi.total_premi');
        //$cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21)? $this->Session->read('Purchase.step1.cashlessFee') : 0 );      
        //$miscFee = number_format(0, 2, '.', '');
        //$merchantCode=$this->ApiXml->getConfig('merchantCode');
        //$paymentId=7;
        //$merchantKey=$this->ApiXml->getConfig('merchantKey');
        //$totalAmount = $totalpremi + $cashlessFee;
        //$totalAmount= $totalAmount.'00';
        //$tmp_signature=  $merchantKey.$merchantCode.$paymentId.$refno.$totalAmount.'IDR'.'1';
        //$signature=sha1($tmp_signature);
        //$userName = $this->Session->read('Purchase.step2.PROSPECT_NAME');
        //$userEmail = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
        //$userContact = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
        //$quote = $this->ApiXml->getQuoteByID($id);
        //$refNo= $quote['QuoteNo'];
        //$transactionDate = date('d/m/Y H:i:s');
        //$descp = 'CAF PREMI PERTAMA';
        //$transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');
        //$return_url = Router::url(array('controller' => 'front', 'action' => 'thanks_cimbclick', 'id' => $name), true);
        //$backend_url= Router::url(array('controller' => 'front', 'action' => 'backend_cimb'), true);
        //$tokCIMB = array('merchantCode' => $merchantCode, 'paymentId'=>$paymentId, 'refNo' => $quote['QuoteNo'], 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'descp' => 'descp', 'userName' => $userName, 'userEmail' => $userEmail, 'userContact' => $userContact, 'remark' => $descp, 'signature' => $signature, 'responseUrl'=>$return_url , 'backendUrl'=>$backend_url);

        $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'NicePayUrl', 'urlDO', 'ECashPayUrl', 'optInsureRel', 'prod_det'));
        // $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'urlDO', 'ECashPayUrl', 'optInsureRel','merchantCode', 'paymentId','merchantKey','totalAmount','signature','userName','userEmail','userContact','descp','return_url','backend_url','refNo'));   
//        }else {
//            $this->redirect("/");
//        }
//    } else {
//            $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
//    }
//    $cashlessFee = $this->Session->read('Purchase.step1.cashlessfee');
        $this->set(compact('emph', 'embir', 'phbir', 'email_black', 'phone_black', 'birth_black', 'cashlessFee'));
    }

    public function step6_finish() {
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        $name = $this->request->query['name'];
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            //$this->Session->destroy('Purchase');
        } else {
            $this->redirect("/");
        }
    }

    public function send_our_data() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $sess = $this->request->data['Detail'];
            $this->Session->write('Purchase.step2', $sess);
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function step2_add_ah($name = "") {
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Ahliwaris']['hubungan'] = $this->ApiXml->getRelationAHListById($this->request->data['Ahliwaris']['RELATIONSHIP_ID']);
                $aw = $this->request->data['Ahliwaris'];
                if (null == ($this->Session->read('Purchase.Ahliwaris.1'))) {
                    $this->Session->write('Purchase.Ahliwaris.1', $aw);
                } elseif (null == ($this->Session->read('Purchase.Ahliwaris.2'))) {
                    $this->Session->write('Purchase.Ahliwaris.2', $aw);
                } elseif (null == ($this->Session->read('Purchase.Ahliwaris.3'))) {
                    $this->Session->write('Purchase.Ahliwaris.3', $aw);
                } elseif (null == ($this->Session->read('Purchase.Ahliwaris.4'))) {
                    $this->Session->write('Purchase.Ahliwaris.4', $aw);
                } elseif (null == ($this->Session->read('Purchase.Ahliwaris.5'))) {
                    $this->Session->write('Purchase.Ahliwaris.5', $aw);
                }
                $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
            }
        } else {
            $this->redirect("/");
        }
    }

    public function step2_add_ta($name = "") {
        // debug($_POST); die();
        if ($this->request->data['Tertanggung']['INSURED_RELATIONSHIP_ID'] == 1) {
            //$this->request->data['Tertanggung']['PROSPECT_DOB'] = $this->request->data['Tertanggung']['PROSPECT_DOB'];
            $this->request->data['Tertanggung']['PROSPECT_DOB'] = ($this->request->data['Tertanggung']['PROSPECT_DOB'] != "" ? $this->request->data['Tertanggung']['PROSPECT_DOB'] : $this->request->data['Tertanggung']['PROSPECT_DOB_ANAK']);
        } else if ($this->request->data['Tertanggung']['INSURED_RELATIONSHIP_ID'] == 2) {
            $this->request->data['Tertanggung']['PROSPECT_DOB'] = ($this->request->data['Tertanggung']['PROSPECT_DOB2'] != "" ? $this->request->data['Tertanggung']['PROSPECT_DOB2'] : $this->request->data['Tertanggung']['PROSPECT_DOB']);
        } else {
            $this->request->data['Tertanggung']['PROSPECT_DOB'] = $this->request->data['Tertanggung']['PROSPECT_DOB_ANAK'];
        }

        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Tertanggung']['hubungan'] = $this->ApiXml->getRelationInsuredById($this->request->data['Tertanggung']['INSURED_RELATIONSHIP_ID'], $this->Session->read('Purchase.step1.product_id'));
                if (!isset($this->request->data['Tertanggung']['PROSPECT_GENDER']) || $this->request->data['Tertanggung']['PROSPECT_GENDER'] == null)
                    $this->request->data['Tertanggung']['PROSPECT_GENDER'] = $this->Session->read('Purchase.step1.PROSPECT_GENDER');

                $this->request->data['Tertanggung']['AGE'] = $this->ApiXml->getAge($this->request->data['Tertanggung']['PROSPECT_DOB']);
                $dataTA = $this->request->data['Tertanggung'];

                $validBlackList = false;
                $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($dataTA['PROSPECT_NAME'], $dataTA['PROSPECT_DOB']);
                if ($IsExistCustomerBlackList['CResult'] == 'T') {
                    $validBlackList = true;
                    $this->Session->setFlash('Maaf penambahan tertanggung ini belum dapat diproses, silakan menghubungi CS kami untuk informasi lebih lanjut.');
                    $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
                }

                if ($validBlackList == false) {
                    $product = $this->ApiXml->getProductbyID($this->Session->read('Purchase.step1.product_id'), array('min_adult_age', 'max_adult_age', 'coverage_type_benefit_id'));
                    $cust_benefitID = $product['coverage_type_benefit_id'];
                    if ($cust_benefitID == 2)
                        $cust_benefitID = 11;

                    //$getAcumulate = $this->ApiXml->getAcumulation($dataTA['PROSPECT_NAME'], $dataTA['PROSPECT_DOB'], $dataTA['PROSPECT_GENDER'], $cust_benefitID);
                    $total_insured = $this->Session->read('Purchase.step1.SUM_INSURED');
                    /*
                      if (isset($getAcumulate['CCustomerSumInsured'])) {
                      $getAcumulate = $getAcumulate['CCustomerSumInsured'];
                      //if (($getAcumulate['TotalSumInsured'] + $total_insured) >= $getAcumulate['MaxSumInsured'])
                      if (($getAcumulate['TotalSumInsured'] + $total_insured) > 900000 && ($cust_benefitID==2 || $cust_benefitID==11|| $cust_benefitID==23)) //maksimal 900000 untuk rumah sakit
                      {
                      $this->Session->setFlash('Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.');
                      $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
                      }
                      elseif (($getAcumulate['TotalSumInsured'] + $total_insured) > 5000000 && ($cust_benefitID==5)) //maksimal 5jt untuk DBD
                      {
                      $this->Session->setFlash('Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.');
                      $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
                      }
                      elseif (($getAcumulate['TotalSumInsured'] + $total_insured) > 100000000 && ($cust_benefitID==3)) //maksimal 100jt meninggal karena kecelakaan
                      {
                      $this->Session->setFlash('Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.');
                      $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
                      }
                      } */
                }

                $this->request->data['Tertanggung']['ID_PROSPECT'] = $this->ApiXml->saveTertanggung($dataTA['PROSPECT_NAME'], $dataTA['PROSPECT_NRIC'], $dataTA['PROSPECT_DOB'], $dataTA['PROSPECT_GENDER']);
                $aw = $this->request->data['Tertanggung'];

                $searchTU = -1;
                if ($aw['INSURED_RELATIONSHIP_ID'] == 1) {
                    $searchTU = $this->ApiXml->getTertanggungUtamaStat();
                }
                if ($searchTU != -1) {
                    $this->Session->write('Purchase.Tertanggung.' . $searchTU, $aw);
                } else if (null == ($this->Session->read('Purchase.Tertanggung.1'))) {
                    $this->Session->write('Purchase.Tertanggung.1', $aw);
                } else if (null == ($this->Session->read('Purchase.Tertanggung.2'))) {
                    $this->Session->write('Purchase.Tertanggung.2', $aw);
                } else if (null == ($this->Session->read('Purchase.Tertanggung.3'))) {
                    $this->Session->write('Purchase.Tertanggung.3', $aw);
                } else if (null == ($this->Session->read('Purchase.Tertanggung.4'))) {
                    $this->Session->write('Purchase.Tertanggung.4', $aw);
                } else if (null == ($this->Session->read('Purchase.Tertanggung.5'))) {
                    $this->Session->write('Purchase.Tertanggung.5', $aw);
                }
                $all = $this->Session->read('Purchase.Tertanggung');
                $result = Hash::sort($all, '{n}.INSURED_RELATIONSHIP_ID', 'asc');
                $result = Hash::sort($result, '{n}.AGE', 'desc');
                $this->Session->write('Purchase.Tertanggung', $result);
                $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
            }
        } else {
            $this->redirect("/");
        }
    }

    public function step2_del_aw($name = "") {
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            $this->Session->delete('Purchase.Ahliwaris.' . $this->request->query['id']);
            $temp = $this->Session->read('Purchase.Ahliwaris');
            $i = 1;
            $n = 1;
            while ($i <= 5) {
                if (isset($temp[$i])) {
                    $newData[$n] = $temp[$i];
                    $n++;
                }
                $i++;
            }
            $this->Session->delete('Purchase.Ahliwaris');
            $this->Session->write('Purchase.Ahliwaris', $newData);
            $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
        } else {
            $this->redirect("/");
        }
    }

    public function step2_del_ta($name = "") {
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            if ($this->Session->read('Purchase.Tertanggung.' . $this->request->query['id'] . '.INSURED_RELATIONSHIP_ID') == 1)
                $this->Session->write('Purchase.step2.me', 'T');
            $this->Session->delete('Purchase.Tertanggung.' . $this->request->query['id']);
            $temp = $this->Session->read('Purchase.Tertanggung');
            $i = 0;
            $n = 1;
            while ($i <= 5) {
                if (isset($temp[$i])) {
                    $newData[$n] = $temp[$i];
                    $n++;
                }
                $i++;
            }
            $this->Session->delete('Purchase.Tertanggung');
            if (isset($newData)) {
                $result = Hash::sort($newData, '{n}.INSURED_RELATIONSHIP_ID', 'asc');
                $result = Hash::sort($result, '{n}.AGE', 'desc');
                $this->Session->write('Purchase.Tertanggung', $result);
            }
            $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
        } else {
            $this->redirect("/");
        }
    }

    // Hubungi Saya Sidebar
    public function contact_us() {
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Product']['Contact_Phone'];
            $email_black = $this->request->data['Product']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Product'];
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terimakasih telah mengisi data, agen kami akan segera menghubungi anda'));
                $this->redirect(Controller::referer());
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
    }

    public function home() {
        $this->layout = 'home';
        // echo '<script language="javascript">';
        //       echo 'alert("Data Anda Tidak Terpilih Sebagai Pemenang")';
        //       echo '</script>';
//    * optmzd_id
//    * gclid



        if (isset($_REQUEST['optmzd_id']) && isset($_REQUEST['gclid'])) {
            $optmzd_id = $_REQUEST['optmzd_id'];
            $gclid = $_REQUEST['gclid'];
            $this->set(compact('optmzd_id', 'gclid'));
            $this->Session->write('Adv.optmzd_id', $optmzd_id);
            $this->Session->write('Adv.gclid', $gclid);
        }


        if ($this->request->is('post')) {
            if (!empty($this->request->data['Leavenumber']['Contact_Phone'])) {
                $phone_black = $this->request->data['Leavenumber']['Contact_Phone'];
                $black_phone = $this->Black->find('first', array('conditions' => array('Black.phone' => $phone_black)));
                if ($black_phone == null) {

                    $tipe = $this->request->data['Leavenumber']['Contact_Tipe'];
                    $name = $this->request->data['Leavenumber']['Contact_Name'];
                    $phone = $this->request->data['Leavenumber']['Contact_Phone'];
                    //$email = $this->request->data['Leavenumber']['Contact_Email'];

                    if ("info" == $tipe) {
                        //info produk
                        $Email = new CakeEmail();
                        $Email->emailFormat('html');
                        $Email->config('smtp');
                        $Email->from('noreply@jagadiri.co.id');
                        $Email->to(Configure::read('Aqi.mail'));
                        $Email->cc('samuel.wicaksana@jagadiri.co.id');
                        $Email->subject('Saya Mau Mencari Informasi Produk - Jagadiri');

                        $msg = '';
                        $msg .= 'Name: ' . $name . '<br/>';
                        $msg .= 'Contact Phone: ' . $phone . '<br/>';
                        $msg .= 'Contact Email: ' . $email . '<br/>';

                        $Email->send($msg);
                        $this->Session->setFlash(__('Terimakasih telah meninggalkan nomor kontak anda, agen kami akan segera menghubungi anda -info'));
                    } else {
                        //melakukan pembelian
                        $data = $this->request->data['Leavenumber'];
                        //$this->ApiXml->sendLeaveNumber($data);

                        if ($this->Session->check('Adv')) {
                            $this->ApiXml->sendLeaveNumberEXT($name, $phone, $this->Session->read('Adv.optmzd_id'), $this->Session->read('Adv.gclid'));
                        } else {
                            $this->ApiXml->sendLeaveNumber($data);
                        }


                        //$this->ApiXml->sendContactUs($data);
                        $this->Session->setFlash(__('Terimakasih telah meninggalkan nomor kontak anda, agen kami akan segera menghubungi anda -beli'));
                        $ctleavenumber = '1';
                        //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Tipe'], $data['Contact_Email']);
                        //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Tipe']);//leads ga boleh ke gs
                    }
                } else
                    $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
            else {
                $phone_black = $this->request->data['Contactme']['Contact_Phone'];
                //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
                $emph = null; //black list ilang
                $data = $this->request->data['Contactme'];
                $hdr = array(
                    'name' => $data['Contact_Name'],
                    'email' => $data['Contact_Email'],
                    'phone' => $data['Contact_Phone']
                );

                if ($emph == null) {
                    $prod = '';

                    if ($data['rekomendasi'] == 'rekomendasi') {
                        $prod = 'DIREKOMENDASIKAN_' . $data['Contact_Name'] . "_" . $data['Contact_Phone'] . "_" . $data['Contact_Email'] . "_MGM";
                        $data['Contact_Email'] = $data['Contact_Email'];
                        if ($data['Contact_NameR'] != "") {
                            $response = $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR'], $data['Contact_PhoneR']);
                            $this->ApiXml->sendContactUs($data);
                            //$this->ApiXml->pushCTS($data['Contact_NameR'], $data['Contact_PhoneR'], $prod, $data['Contact_Email']);
                        }
                        if ($data['Contact_NameR2'] != "") {
                            $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR2'], $data['Contact_PhoneR2']);
                            $this->ApiXml->sendContactUs($data);
                            //$this->ApiXml->pushCTS($data['Contact_NameR2'], $data['Contact_PhoneR2'], $prod, $data['Contact_Email']);
                        }
                        if ($data['Contact_NameR3'] != "") {
                            $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR3'], $data['Contact_PhoneR3']);
                            $this->ApiXml->sendContactUs($data);
                            //$this->ApiXml->pushCTS($data['Contact_NameR3'], $data['Contact_PhoneR3'], $prod, $data['Contact_Email']);
                        }
                    } else {
                        $data['Contact_Email'] = '';
                        $data['Contact_Name'] = '';
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
                        $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash');
                    }

                    $this->request->data = null;
                    $ctcontactme = '1';

                    if ($response == 'DATA_NOT_FOUND') {
                        $this->Session->setFlash('Maaf Anda belum bisa mengikuti program ini karena belum menjadi member JAGADIRI, segera beli produk JAGADIRI untuk menjadi member', 'default', array(), 'flashe');
                        $this->Session->setFlash('Home', 'default', array(), 'flashbtn');
                    } else {
                        if ($data['flash'] == 'flash') {
                            $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash');
                            $flash = 1;
                        } else if ($data['flash'] == 'flash1') {
                            $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash1');
                            $flash1 = 1;
                        } else if ($data['flash'] == 'flash2') {
                            $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash2');
                            $flash2 = 1;
                        } else if ($data['flash'] == 'flash3') {
                            $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash3');
                            $flash3 = 1;
                        }
                    }
                } else
                    $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }

        //get visitor's IP address
        $visitorIp = $this->request->clientIp();
        $sumberOptions = array();

        //chekc visitor's IP address if already exist in database
        if ($this->Survey->isSurveyed($visitorIp))
            $popupWindow = 'member';    //if already surveyed, the popup type is member
        else {
            $popupWindow = 'survey';    //if not surveyed, the popup type is survey
            $sumberOptions = $this->Survey->getSumberOptions();
        }




        //define product
        $allproduct = $this->Product->find('all', array('conditions' => array()));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $banners = $this->Banner->find('all', array('conditions' => array('show' => 1)));
        $news = $this->News->find('all', array('limit' => 3, 'order' => array('id' => 'Desc')));     //post api
        $news2 = $this->News->find('all', array('limit' => 12, 'order' => array('id' => 'Desc')));
        #Show promo image with date conditions
        $date = date("Y-m-d H:i:s");
        $promo = $this->Promo->find('all', array('conditions' => array('NOT' => array('Promo.id' => array(2, 3, 4)), 'deleted' => 0, 'Promo.start_date <= ' => $date, 'Promo.end_date >= ' => $date,)));
        $this->set(compact('sumberOptions', 'popupWindow', 'checkProd', 'news', 'news2', 'allproduct', 'ctleavenumber', 'banners', 'allphone', 'promo'));
    }

    public function landing() {
        $this->layout = 'landing';
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $prod = '';
                if ($data['rekomendasi'] == 'rekomendasi') {
                    $data['Contact_Name'] = $data['Contact_NameR'];
                    $data['Contact_Phone'] = $data['Contact_PhoneR'];
                    $data['Contact_Email'] = $data['Contact_EmailR'];
                    $prod = $data['crekomendasi'];
                }
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terima kasih telah mengisi data, kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));

        $allphone = $this->Val->find('all', array('conditions' => array()));
        $jadwalSholat = $this->JadwalPray->find('first', array('conditions' => array('JadwalPray.tgl' => date('Y-m-d'))));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle', 'allphone', 'jadwalSholat'));
    }

    public function landing1() {
        $this->layout = 'landing1';
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terima kasih telah mengisi data, kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle'));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
    }

    public function landing2() {
        $this->layout = 'landing2';
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terima kasih telah mengisi data, kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle'));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
    }

    public function landing3() {
        $this->layout = 'landing3';
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terima kasih telah mengisi data, kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle'));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
    }

    public function landing4() {
        $this->layout = 'landing4';
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $prod = '';
                if ($data['rekomendasi'] == 'rekomendasi') {
                    $data['Contact_Name'] = $data['Contact_NameR'];
                    $data['Contact_Phone'] = $data['Contact_PhoneR'];
                    $data['Contact_Email'] = $data['Contact_EmailR'];
                    $prod = $data['crekomendasi'];
                }
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terima kasih telah mengisi data, kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));

        $allphone = $this->Val->find('all', array('conditions' => array()));
        $jadwalSholat = $this->JadwalPray->find('first', array('conditions' => array('JadwalPray.tgl' => date('Y-m-d'))));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle', 'allphone', 'jadwalSholat'));
    }

    public function landing5() {
        $this->layout = 'landing5';

        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            $data = $this->request->data['Contactme'];
            $hdr = array(
                'name' => $data['Contact_Name'],
                'email' => $data['Contact_Email'],
                'phone' => $data['Contact_Phone']
            );

            if ($emph == null) {
                $prod = '';

                if ($data['rekomendasi'] == 'rekomendasi') {
                    $prod = 'DIREKOMENDASIKAN_' . $data['Contact_Name'] . "_" . $data['Contact_Phone'] . "_" . $data['Contact_Email'] . "_MGM";
                    $data['Contact_Email'] = $data['Contact_Email'];
                    if ($data['Contact_NameR'] != "") {
                        $response = $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR'], $data['Contact_PhoneR']);
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_NameR'], $data['Contact_PhoneR'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR2'] != "") {
                        $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR2'], $data['Contact_PhoneR2']);
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_NameR2'], $data['Contact_PhoneR2'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR3'] != "") {
                        $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR3'], $data['Contact_PhoneR3']);
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_NameR3'], $data['Contact_PhoneR3'], $prod, $data['Contact_Email']);
                    }
                } else {
                    $data['Contact_Email'] = '';
                    $data['Contact_Name'] = '';
                    $this->ApiXml->sendContactUs($data);
                    //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
                    $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash');
                }

                $this->request->data = null;
                $ctcontactme = '1';

                if ($response == 'DATA_NOT_FOUND') {
                    $this->Session->setFlash('Maaf Anda belum bisa mengikuti program ini karena belum menjadi member JAGADIRI, segera beli produk JAGADIRI untuk menjadi member', 'default', array(), 'flashe');
                    $this->Session->setFlash('Home', 'default', array(), 'flashbtn');
                } else {
                    if ($data['flash'] == 'flash') {
                        $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash');
                        $flash = 1;
                    } else if ($data['flash'] == 'flash1') {
                        $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash1');
                        $flash1 = 1;
                    } else if ($data['flash'] == 'flash2') {
                        $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash2');
                        $flash2 = 1;
                    } else if ($data['flash'] == 'flash3') {
                        $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash3');
                        $flash3 = 1;
                    }
                }
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }

        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));

        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');

        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $jadwalSholat = $this->JadwalPray->find('first', array('conditions' => array('JadwalPray.tgl' => date('Y-m-d'))));

        #Show promo image with date conditions
        $date = date("Y-m-d H:i:s");
        $promo = $this->Promo->find('all', array('conditions' => array('NOT' => array('Promo.id' => array(2, 3, 4)), 'deleted' => 0, 'Promo.start_date <= ' => $date, 'Promo.end_date >= ' => $date,)));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle', 'allphone', 'jadwalSholat', 'flash', 'flash1', 'flash2', 'flash3', 'promo'));
    }

    public function landing6() {
        $this->layout = 'landing6';
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $prod = '';
                if ($data['rekomendasi'] == 'rekomendasi') {
                    $prod = 'direkomendasikan' . $data['Contact_Name'] . "_" . $data['Contact_Phone'];
                    $data['Contact_Email'] = '';
                    if ($data['Contact_NameR'] != "") {
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_NameR'], $data['Contact_PhoneR'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR2'] != "") {
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_NameR2'], $data['Contact_PhoneR2'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR3'] != "") {
                        $this->ApiXml->sendContactUs($data);
                        //$this->ApiXml->pushCTS($data['Contact_NameR3'], $data['Contact_PhoneR3'], $prod, $data['Contact_Email']);
                    }
                    $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash1');
                    $flash1 = 1;
                } else {
                    $data['Contact_Email'] = '';
                    $data['Contact_Name'] = '';
                    $this->ApiXml->sendContactUs($data);
                    //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
                    $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash2');
                    $flash2 = 1;
                }
                $this->request->data = null;
                $ctcontactme = '1';
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => 'jaga-sehat-plus')));
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => 'jaga-sehat-plus')));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $jadwalSholat = $this->JadwalPray->find('first', array('conditions' => array('JadwalPray.tgl' => date('Y-m-d'))));
        #Show promo image with date conditions
        $date = date("Y-m-d H:i:s");
        $promo = $this->Promo->find('all', array('conditions' => array('NOT' => array('Promo.id' => array(2, 3, 4)), 'deleted' => 0, 'Promo.start_date <= ' => $date, 'Promo.end_date >= ' => $date,)));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle', 'allphone', 'jadwalSholat', 'flash2', 'promo'));
    }

    //frontpage function
    public function product() {
        $this->layout = 'front';
        if (isset($_REQUEST['optmzd_id']) && isset($_REQUEST['gclid'])) {
            $optmzd_id = $_REQUEST['optmzd_id'];
            $gclid = $_REQUEST['gclid'];
            $this->set(compact('optmzd_id', 'gclid'));
            $this->Session->write('Adv.optmzd_id', $optmzd_id);
            $this->Session->write('Adv.gclid', $gclid);
        }
        //load product per kategori, accident, life, health, investa
        $acc = $this->Product->find('all', array('conditions' => array('Product.category_id' => 1, 'Product.publish' => 1)));
        $life = $this->Product->find('all', array('conditions' => array('Product.category_id' => 2, 'Product.publish' => 1)));
        $health = $this->Product->find('all', array('conditions' => array('Product.category_id' => 3, 'Product.publish' => 1)));
        $investa = $this->Product->find('all', array('conditions' => array('Product.category_id' => 4, 'Product.publish' => 1)));
        $general = $this->Product->find('all', array('conditions' => array('Product.category_id' => 5, 'Product.publish' => 1)));
        $this->set(compact('acc', 'life', 'health', 'investa', 'general'));
    }

    public function serbaserbi() {
        
    }

    public function productdetail($id = null) {
        if (isset($_REQUEST['optmzd_id']) && isset($_REQUEST['gclid'])) {
            $optmzd_id = $_REQUEST['optmzd_id'];
            $gclid = $_REQUEST['gclid'];
            $this->set(compact('optmzd_id', 'gclid'));
            $this->Session->write('Adv.optmzd_id', $optmzd_id);
            $this->Session->write('Adv.gclid', $gclid);
        }
        //data = query where id ==id
        if ($id == null) {
            return $this->redirect(array('controller' => 'front', 'action' => 'home'));
        }
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                //$this->ApiXml->sendContactUs($data);

                if ($this->Session->check('Adv')) {
                    $this->ApiXml->sendContactUsEXT($data);
                } else {
                    $this->ApiXml->sendContactUs($data);
                }


                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terimakasih telah mengisi data, agen kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $productdetail = $this->Product->find('first', array('recursive' => 1, 'conditions' => array('Product.seo' => $id, 'Product.publish' => 1)));
        $_metaTitle = $this->MetaTitle->getMetaProductDetail($productdetail['Product']['id']); //ganti function
        if ($productdetail == null)
            throw new NotFoundException('Could not find that page');
        $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => $id), 'limit' => 4));
        $this->set(compact('productdetail', 'allproduct', 'ctcontactme', '_metaTitle'));
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
    }

    public function tentangjagadiri() {
        
    }

    public function black_list() {
        if ($this->Session->check('Purchase')) {
            $this->Session->delete('Purchase');
        } else
            $this->redirect("/");
    }

    public function sorry() {
        
    }

    public function temukansolusi() {
        $listsolusi = null;
        $q1 = $q2 = $q3 = 9; //declare value > 3
        if ($this->request->is('post')) {
            //input request
            if (isset($this->request->data['Contactme']['Contact_Phone'])) {
                $phone_black = $this->request->data['Contactme']['Contact_Phone'];
                $email_black = $this->request->data['Contactme']['Contact_Email'];
                //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //buat blacklist
                $emph = null; //buat bikin ilang black list
            } else {
                $emph = null;
            }
            if ($emph == null) {
                if (isset($this->request->data['Contactme'])) {
                    $data = $this->request->data['Contactme'];
                    $this->ApiXml->sendContactUs($data);
                    //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
                    $this->request->data['Contactme'] = null;
                    $ctcontactme = '1';
                    $this->Session->setFlash(__('Terimakasih telah mengisi data, agen kami akan segera menghubungi anda'));
                } else {
                    if (!isset($this->request->data['Product']['question1'])) {
                        $q1 = 0;
                    };
                    if (!isset($this->request->data['Product']['question2'])) {
                        $q2 = 0;
                    };
                    if (!isset($this->request->data['Product']['question3'])) {
                        $q3 = 0;
                    };
                    //if user select then fill the value
                    if ($q1 != 0) {
                        $q1 = $this->request->data['Product']['question1'];
                    };
                    if ($q2 != 0) {
                        $q2 = $this->request->data['Product']['question2'];
                    };
                    if ($q3 != 0) {
                        $q3 = $this->request->data['Product']['question3'];
                    };
                    $listsolusi = $this->Product->find('all', array('recursive' => 1,
                        'conditions' => array('Product.quote_id !=' => 'jaga-jiwa-plus7', 'OR' => array('Product.quote_id !=' => 'jaga-aman-plus7'), 'Product.question1 like' => '%' . $q1 . '%',
                            'AND' => array('Product.question2 like' => '%' . $q2 . '%'),
                            'AND' => array('Product.question3 like' => '%' . $q3 . '%')
                        )
                            )
                    );
                }
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone', 'listsolusi', 'q1', 'q2', 'q3', 'ctcontactme'));
    }

    public function premium_payment() {
        $this->disableCache();
        $optPolicy = $this->ApiXml->getPolicyCust($this->Session->read('Auth.User.CustomerID'));
        if ($this->request->is('post') && $this->request->data['Premium']['List'] != null) {
            $policyNo = $this->request->data['Premium']['List'];
            $policy = $this->ApiXml->getPolicyDetail($policyNo);
            $pay = $this->ApiXml->getPremiPendingPayment($policyNo);
        } else {
            $policy = null;
            $pay = null;
        }
        $this->set(compact('optPolicy', 'policy', 'policyNo', 'pay'));
    }

    public function claim() {
        $this->disableCache();
        $bank = $this->ApiXml->getBankList();
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->data['Claim'];
            $this->ApiXml->sendClaim($data, $this->Session->read('Auth.User.CustomerID'));
            $this->sendEmail->claim($data, $bank[$data['BANK_ID']]);
            $this->request->data['Claim'] = null;
            $this->Session->write('thanks_id', 'claim');
            $this->redirect(array('controller' => 'front', 'action' => 'thanks_leavenumber', 'id' => 'claim'));
        }

        $optPolicy = $this->ApiXml->getPolicyCust($this->Session->read('Auth.User.CustomerID'));
        $list_entity = $this->ApiXml->getFundList(1);
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('list_entity', 'bank', 'optPolicy', 'allphone'));
    }

    public function ajax_getCoveragePolicy($id = 0) {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $cov = $this->ApiXml->getPolicyCoverage($id);
            $i = 0;
            echo "<option value=\"\">Pilih Coverage</option>";
            if ($cov != null) {
                if (isset($cov[0])) {
                    while ($i <= count($cov)) {
                        echo "<option value=\"" . $cov[$i]['id'] . "\">" . $cov[$i]['desc'] . "</option>";
                        $i++;
                    }
                } else {
                    echo "<option value=\"" . $cov['id'] . "\">" . $cov['desc'] . "</option>";
                }
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function hubungikami() {
        if (isset($_REQUEST['optmzd_id']) && isset($_REQUEST['gclid'])) {
            $optmzd_id = $_REQUEST['optmzd_id'];
            $gclid = $_REQUEST['gclid'];
            $this->set(compact('optmzd_id', 'gclid'));
            $this->Session->write('Adv.optmzd_id', $optmzd_id);
            $this->Session->write('Adv.gclid', $gclid);
        }
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactus']['Contact_Phone'];
            $email_black = $this->request->data['Contactus']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //buat blacklist
            $emph = null; //buat bikin ilang black list
            if ($emph == null) {
                $data = $this->request->data['Contactus'];
//var_dump($data);
                //$this->ApiXml->sendContactUs($data);

                if ($this->Session->check('Adv')) {
                    $phone = $this->request->data['Contactus']['Contact_Phone'];
                    $email = $this->request->data['Contactus']['Contact_Email'];

                    $x = $this->ApiXml->sendContactUsEXT($data);
//var_dump($x);
                } else {
                    $this->ApiXml->sendContactUs($data);
                }

                if ($data['Contact_Source'] == 'Tel' && $data['Contact_Remark1'] == 'Inquiry (I want to ask on JAGADIRI products and promotion)') {
                    //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email'], $data['Contact_Daytime']);
                } else {
                    //$this->sendEmail->hubungiKami($data);
                }

                $this->Session->write('thanks_id', 'hubungi-kami');
                $this->redirect(array('controller' => 'front', 'action' => 'thanks_leavenumber', 'id' => 'hubungi-kami'));
            } else {
                //$this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
    }

    public function forgot_password() {
        if ($this->request->is('post') || $this->request->is('put')) {
            foreach ($this->captchas as $field) {
                $this->User->setCaptcha($field, $this->Captcha->getCode($field));
            };
            $this->User->set($this->request->data);
            if ($this->User->validates(array('fieldList' => array('captcha')))) {
                $data = $this->request->data['User'];
                $result = $this->ApiXml->getKeyCust($data['email']);
                if ($result != null) {
                    $url = Router::url(array('controller' => 'front', 'action' => 'recovery_password', '?' => array('token' => $result['CustomerKey'], 'email' => urlencode($data['email']))), true);
                    $_tmp = $this->sendEmail->forgot_password($data['email'], $url, $result['CustomerName']);
                    $this->Session->setFlash('Kami telah mengirim recovery password ke email member Anda', 'default', array('class' => 'success'), 'success');
                }
                $this->redirect(array('controller' => 'front', 'action' => 'login'));
            } else {
                $this->request->data = null;
                $this->Session->setFlash(__('Invalid Captcha'));
            }
        }
        unset($this->request->data);
        $this->set('captcha_fields', $this->captchas);
    }

    public function recovery_password() {
        if (isset($this->request['url']['email']) && $this->request['url']['email'] != '' && isset($this->request['url']['token']) && $this->request['url']['token'] != '') {
            $email = urldecode($this->request['url']['email']);
            $result = $this->ApiXml->getKeyCust($email);
            if ($result != null && $this->request['url']['token'] == $result['CustomerKey']) {
                if ($this->request->is('post') || $this->request->is('put')) {
                    $ubah = $this->request->data['User'];
                    if ($ubah['password'] == $ubah['confirm_pass']) {
                        $this->ApiXml->saveUpdatePass(trim($email), $ubah['password'], $result['CustomerKey']);
                        $this->Session->setFlash('Anda telah berhasil mengubah password Anda', 'default', array('class' => 'success'), 'success');
                        $this->redirect(array('controller' => 'front', 'action' => 'login'));
                    } else {
                        $this->Session->setFlash(__('Gagal reset password, password Anda tidak sama silakan ulangi kembali'), 'default', array('class' => 'success'), 'failure');
                        $this->request->data = null;
                    }
                }
            } else
                throw new NotFoundException('Could not find that page');
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function login() {
        if ($this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'front', 'action' => 'home'));
        } else {
            $this->set('title_for_layout', 'Login');
            if ($this->request->is('post')) {
                foreach ($this->captchas as $field) {
                    $this->User->setCaptcha($field, $this->Captcha->getCode($field));
                };
                $this->User->set($this->request->data);
                $data = $this->request->data['User'];
                if ($this->User->validates(array('fieldList' => array('captcha')))) {
                    $credit = $this->ApiXml->getLoginCust($this->request->data['User']['email'], $this->request->data['User']['password']);
                    if ($credit != null) {
                        $this->Auth->login(array_merge($credit, array('role' => 'frontCAF')));

                        if (isset($this->request->query['sid']) && isset($this->request->query['name']) && isset($this->request->query['cat'])) {
                            $sid = $this->request->query['sid'];
                            $cat = $this->request->query['cat'];
                            $name = $this->request->query['name'];
                            if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
                                $tmp = $this->ApiXml->setProspectCust();
                                $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $cat)));
                            } else
                                $this->redirect($this->Auth->redirectUrl());
                        } else
                            $this->redirect($this->Auth->redirectUrl());
                    } else {
                        $this->request->data = null;
                        $this->Session->setFlash(__('Invalid username or password, please try again'));
                    }
                } else {
                    $this->request->data = null;
                    $this->Session->setFlash(__('Invalid Captcha'));
                }
            }
            $this->set('captcha_fields', $this->captchas);
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function thanks_leavenumber($id = '') {
        $this->layout = 'front';
        if ($this->Session->check('thanks_id') && $this->Session->read('thanks_id') == 'hubungi-kami') {
            $this->Session->delete('thanks_id');
            $ctthankscontactus = '1';
            $this->set(compact('ctthankscontactus'));
        } else if ($this->Session->check('thanks_id') && $this->Session->read('thanks_id') == 'claim') {
            $this->Session->delete('thanks_id');
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function download($file = '') {
        $url = APP . 'files' . DS . $file;
        $ext = substr($file, -4, 4);
        $name = substr($file, 0, -4);
        if (file_exists($url)) {
            $this->viewClass = 'Media';
            $this->autoRender = true;
            $params = array(
                'download' => true,
                'id' => $file,
                'name' => $name,
                'extension' => $ext,
                'path' => APP . 'files' . DS
            );
            $this->set($params);
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function privacy() {
        
    }

    public function submitPolingSurvey() {
        
    }

    public function popup_pemenang() {
//        $this->layout = "popup_pemenang";
//        echo '<script language="javascript">';
//        echo f
//        echo '</script>';
//        $this->Rawat->each('alert("Selamat Data Anda Terpilih Sebagai Pemenang");', true);
//        $this->redirect(array('controller' => 'promo', 'action' => 'quiz-survey-perawatan.htm'));
    }

    public function popup_kalah() {
//        $this->layout = 'popup_kalah';
//        echo '<script language="javascript">';
//        echo 'alert("Data Anda Tidak Terpilih Sebagai Pemenang")';
//        echo '</script>';
//        $this->Session->setFlash('Data Anda Tidak Terpilih Sebagai Pemenang');
//        $this->Rawat->each('alert("Data Anda Tidak Terpilih Sebagai Pemenang");', true);
//        $this->redirect(array('controller' => 'promo', 'action' => 'quiz-survey-perawatan.htm'));
    }

    // public function duplicate() {
//        echo '<script language="javascript">';
//        echo 'alert(" Data Anda Sudah terdaftar ")';
//        echo '</script>';
//        $this->Rawat->each('alert("Data Anda Sudah terdaftar");', true);
//        $this->redirect(array('controller' => 'promo', 'action' => 'quiz-survey-perawatan.htm'));
//         $this->Session->setFlash(__('Data Anda Sudah terdaftar'));
//         $this->redirect(Controller::referer());
//        echo $this->Html->link('Lihat Data', array('controller' => 'promo', 'action' => 'index'));
//        $this->redirect(array('action' => 'quiz-survey-perawatan.htm'), null, true);
//        throw new NotFoundException();-->
//   }
//    public function success() {
//        echo '<script language="javascript">';
//        echo 'alert("Terima kasih atas pendapat yang Anda berikan, Data Anda Kami Simpan ")';
//        echo '</script>';
//    }

    public function submitSurveyVisitor() {

        $db = ConnectionManager::getDataSource('default');
        $ip_address = $this->request->clientIp();
        $puas_polis = $this->request->data['puas_polis'];
        $saran = $this->request->data['saran'];
        $tanggal_survey = date("Y-m-d");
        $waktu_survey = date("Y-m-d H:i:s");
        $isi_puas_polis = "";

        // $status=$this->request->data['status'];//hardcd
        $prod = $this->request->data['prod']; //hardcd
        $metode = $this->request->data['metode'];
        $this->Session->write('Survey.prod', $prod);

        if ($saran == null) {
            $saran = "";
        }

        if ($puas_polis === "1") {
            $isi_puas_polis = "Puas";
        } else if ($puas_polis === "0") {
            $isi_puas_polis = "Tidak Puas";
        }
//        echo '<script language="javascript">';
//        echo 'alert("CEK DATA -> \t' . $ip_address . $isi_puas_polis . $saran . $tanggal_survey . $waktu_survey . '")';
//        echo '</script>';
//        return;
//        function insertData_surveyVisitor($ip_address, $puas_polis, $saran, $tanggal_survey, $waktu_survey) {
//        $db = $this->getDataSource();
        $query = $db->fetchAll('INSERT INTO aq_hasil_survey_saran(ip_address, puas_polis, saran, tanggal_survey, waktu_survey, produk, pembayaran)
               VALUES(?, ?, ?, ?, ?, ?, ?)', array($ip_address, $puas_polis, $saran, $tanggal_survey, $waktu_survey, $prod, $metode));
//                return;
//        }
        // $this->redirect(array('controller' => 'front', 'action' => 'home'));//aslinyaa

        $this->redirect(array('controller' => 'front', 'action' => 'aftersurvey', '?' => array('prod' => $prod)));
        // $this->redirect($_SERVER["HTTP_REFERER"]);
        // $this->redirect(array('controller' => 'front', 'action' => 'response_creditcard'));
        // $this->redirect("/");
        // $this->redirect(array('controller' => 'front', 'action' => 'response_creditcard', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
        // $this->set(compact('status', 'ctthankspurchase', 'prod'));// cara hardcode
    }

    public function aftersurvey() {

        if ($this->Session->check('Survey')) {
            //     $prod=  $this->Session->read('Survey.prod');
            $prod = $this->request->query['prod'];

            $this->Session->delete('Survey');
            $this->set(compact('ctthankspurchase', 'prod'));
//$this->Session->destroy();
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function submitPromo() {

        $nama = $this->request->data['name'];
        $no_telepon = $this->request->data['telp'];
        $email = $this->request->data['email'];
        $alamat = $this->request->data['address'];
        $pilihan = $this->request->data['pilihan'];
        $isPemenang = "";
        $idBatch = "";
        $jumlah_batch = "";
//        $data_batch = "";
        if ($pilihan === "1") {
            $keterangan = "Rawat Inap";
        } else if ($pilihan === "2") {
            $keterangan = "Rawat Jalan";
        }
        $tanggal = date("Y-m-d");
        $time = date("H:i:s");


//        echo '<script language="javascript">';
//        echo 'alert("CEK DATA -> \t' . $nama . $no_telepon . $email . $alamat . $pilihan . $keterangan . $tanggal . $time . '")';
//        echo '</script>';


        if ($nama != "") {

            $db = ConnectionManager::getDataSource('default');
            //$db->rawQuery("SELECT * from aq_survey_rawat where no_tlp ='$no_telepon' OR email='$email'"); 
            //$this->set('data',$db);
            //$this->Promo->insertData($nama, $no_telepon, $email, $alamat, $pilihan, $tanggal, $time);

            $result = $db->fetchAll("SELECT * FROM aq_survey_rawat WHERE no_tlp ='$no_telepon' OR email='$email'");

            if (count($result) > 0) {
//                http://book.cakephp.org/2.0/en/development/routing.html
//                $this->Session->setFlash('Data Anda Sudah Terdaftar Pada Database Kami'); //old way
//                return $this->redirect(array('action' => 'quiz-survey-perawatan.htm'));
//                  $this->redirect(array('controller' => 'front', 'action' => 'duplicate'));
                $this->Session->setFlash('Data Anda Sudah Terdaftar Pada Database Kami');
            } else {

                /* pembagian batch(batch jam 06:00 - 12:00, batch jam 12:01 - 18.00, batch jam 18:01 – 05:59) fromat 24 jam,
                 * algorima greeting php
                 */
                $result_id = $db->fetchAll("SELECT id FROM aq_batch WHERE '$time' >= waktu_awal AND '$time' <= waktu_akhir");

                if ($result_id) {

                    foreach ($result_id as $item)
                        $idBatch = $item['aq_batch']['id'];
                }
//                echo '<script language="javascript">';
//                echo 'alert(" ' . $idBatch . '")';
//                echo '</script>';
                //return ;
                /* Penentuan Pemenang
                 * algoritma https://sarcoom.wordpress.com/2014/12/01/menampilkan-data-harian-mingguan-bulanan-dan-tahunan-dengan-mysql/
                 */
//                $result_idBatch = $db->fetchAll("SELECT  * FROM aq_survey_rawat WHERE tanggal='$tanggal' and idBatch ='$idBatch' GROUP BY idBatch");
                $result_idBatch = $this->Rawat->find('all', array("SELECT  * FROM aq_survey_rawat WHERE tanggal='$tanggal' and idBatch ='$idBatch' GROUP BY idBatch" => array('idBatch' => $idBatch)));
                $jumlah_batch = sizeof($result_idBatch);
//                }
//             http://stackoverflow.com/questions/10526518/cakephp-how-to-get-the-count-in-the-query
//                echo '<script language="javascript">';
//                echo 'alert(" ' . $jumlah_batch . '")';
//                echo '</script>';
//                return;

                if ($jumlah_batch == "1") {

                    $isPemenang = "1";
                    $db->fetchAll('INSERT INTO aq_survey_rawat(nama, no_tlp, email, alamat, pilihan, keterangan, tanggal, time, idBatch, isPemenang)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?)', array($nama, $no_telepon, $email, $alamat, $pilihan, $keterangan, $tanggal, $time, $idBatch, $isPemenang));
                    // $this->redirect(array('controller' => 'front', 'action' => 'popup_pemenang'), 'quiz-survey-perawatan.htm');
                    $this->redirect(array('controller' => 'front', 'action' => 'popup_pemenang'));
                } else {
                    $isPemenang = "0";
                    $db->fetchAll('INSERT INTO aq_survey_rawat(nama, no_tlp, email, alamat, pilihan, keterangan, tanggal, time, idBatch, isPemenang)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?)', array($nama, $no_telepon, $email, $alamat, $pilihan, $keterangan, $tanggal, $time, $idBatch, $isPemenang));

//                   $this->redirect(array('controller' => 'front', 'action' => 'popup_kalah'), 'quiz-survey-perawatan.htm');

                    $this->redirect(array('controller' => 'front', 'action' => 'popup_kalah'));
                }
            }
//            $this->redirect(array('controller' => 'front', 'action' => 'success')); $this->redirect(array('controller' => 'promo', 'action' => 'quiz-survey-perawatan.htm'));
        }

        $this->redirect(array('controller' => 'promo', 'action' => 'quiz-survey-perawatan.htm'));
    }

    public function galihdanratna() {
        $db = ConnectionManager::getDataSource('default');
        //$this->Session->delete('EventGalihRatna');
        $date = date("Y-m-d H:i:s");
        if ($date > "2017-02-22 23:59:59") {
            $the_end = "Promo telah berakhir";
            $this->set(compact('the_end'));
        } else {
            $allphone = $this->Val->find('all', array('conditions' => array()));
            $this->set(compact('allphone'));

            $ip_address = $this->request->clientIp();
//	var_dump($ip_address);
//	$ip_address = $this->getHostsByName(getHostName());

            $query0 = $db->fetchAll('SELECT ip_address from aq_event_galihratna');
            //var_dump($query0);
            foreach ($query0 as $data) {
                if ($data["aq_event_galihratna"]["ip_address"] == $ip_address) {
                    $this->Session->write('EventGalihRatna', 'Done');
                } else {
                    $this->Session->delete('EventGalihRatna');
                }

                //var_dump($data);
            }
            if ($this->request->is('post')) {
                $nama = $this->request->data['fm_reservasi_premier']['NAMA'];
                $gender = $this->request->data['fm_reservasi_premier']['GENDER'];
                $ttl = $this->request->data['fm_reservasi_premier']['TTL'];
                $email = $this->request->data['fm_reservasi_premier']['EMAIL'];
                $nomor = $this->request->data['fm_reservasi_premier']['Contact_Phone'];
                $jawaban = $this->request->data['fm_reservasi_premier']['ANSWER'];


                $query = $db->fetchAll('INSERT INTO aq_event_galihratna(nama, email, no_telepon, dob, gender, jawaban, date_submit, ip_address)
               VALUES(?, ?, ?, ?, ?, ?, ?,?)', array($nama, $email, $nomor, $ttl, $gender, $jawaban, $date, $ip_address));
                $this->Session->write('EventGalihRatna', 'Done');
                $this->set(compact('allphone'));
            }
        }
    }

    Public function promosi() {
        
    }

    public function momnjo() {
        
    }

    public function tebak_kata() {
        //$this->viewBuilder()->layout('tebak_kata');
        $this->layout = "tebak_kata";
        $_metaTitle = $this->MetaTitle->getMeta('tebak_kata');

        $this->set(compact('_metaTitle'));
    }

    public function jagaamanbersamaMRA() {
        $this->layout = 'front';
        $this->disableCache();
        $_metaTitle = $this->MetaTitle->getMeta('jaga-mra');
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
        // $this->set('captcha_fields', $this->captchas);

        if ($this->request->is('post')) {

            //if ( $this->captchas==$this->request->data[fm_reservasi_mra][captcha]) {


            $db = ConnectionManager::getDataSource('default');
            $nama = $this->request->data['fm_reservasi_mra']['NAMA'];
            $gender = $this->request->data['fm_reservasi_mra']['GENDER'];
            $ttl = $this->request->data['fm_reservasi_mra']['TTL'];
            $email = $this->request->data['fm_reservasi_mra']['EMAIL'];
            $nomor = $this->request->data['fm_reservasi_mra']['Contact_Phone'];
            $alamat = $this->request->data['fm_reservasi_mra']['ADDRESS'];
            $date = date("Y-m-d H:i:s");
            $query = $db->fetchAll('INSERT INTO aq_event_mra(nama,  dob, gender, no_tlp, email, tanggal_entry, alamat)
               VALUES(?, ?, ?, ?, ?, ?,?)', array($nama, $ttl, $gender, $nomor, $email, $date, $alamat));

            $this->redirect(array('controller' => 'front', 'action' => 'jagaamanbersamaMRA'));
            //}else{ $this->Session->setFlash(__('Invalid Captcha'));}
        }


        $this->set(compact('_metaTitle'));
    }

    public function jagaamanmudik() {
        $this->layout = 'blank';
        $this->disableCache();
        $_metaTitle = $this->MetaTitle->getMeta('jagaamanmudik');
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $this->set(compact('allphone'));
        // $this->set('captcha_fields', $this->captchas);

        if ($this->request->is('post')) {

            //if ( $this->captchas==$this->request->data[fm_reservasi_mra][captcha]) {


            $db = ConnectionManager::getDataSource('default');
            $nama = $this->request->data['reservasi_jaber']['NAMA'];
            $gender = $this->request->data['reservasi_jaber']['GENDER'];
            $ttl = $this->request->data['reservasi_jaber']['TTL'];
            $email = $this->request->data['reservasi_jaber']['EMAIL'];
            $nomor = $this->request->data['reservasi_jaber']['Contact_Phone'];
            $alamat = $this->request->data['reservasi_jaber']['ADDRESS'];
            $date = date("Y-m-d H:i:s");
            $kode = $nama . substr_replace($ttl, '', 4, 1); //.substr_replace($ttl,'',0,8);		      
            $kode = substr_replace($kode, '', -3, 1);

            //$cek= $db->fetchAll('SELECT COUNT(*) FROM `aq_event_mudik` WHERE nama LIKE '%tesa%' AND dob LIKE '1990-01-31');
            $cek = $this->Mudik->find('first', array('conditions' => array('Mudik.nama like' => $nama, 'Mudik.dob like' => $ttl)));
            $cek2 = $this->Mudik->find('first', array('fields' => array('MAX(id) AS id'), 'conditions' => array('Mudik.flag_submit =' => 1)));
            //var_dump($cek);
            $tmp = $cek2[0]['id'] + 1;

            if (sizeof($tmp) < 10) {
                $tmp = '0000' . $tmp;
            } else if (sizeof($tmp) < 100) {
                $tmp = '000' . $tmp;
            } else if (sizeof($tmp) < 1000) {
                $tmp = '00' . $tmp;
            } else if (sizeof($tmp) < 10000) {
                $tmp = '0' . $tmp;
            }

            $kode = $kode . $tmp;

            $this->Session->write('cek_mudik', $cek);
            $this->Session->write('cek_mudik2', $cek2);
            if (empty($cek)) {
                $query = $db->fetchAll('INSERT INTO aq_event_mudik(kode,nama,  dob, gender, no_tlp, email, tanggal_entry, alamat, flag_submit)  VALUES(?,?, ?, ?, ?, ?, ?,?,?)', array($kode, $nama, $ttl, $gender, $nomor, $email, $date, $alamat, 1));

                $submit = $this->ApiXml->saveMudik($tmp, $nama, $ttl, $gender, $nomor, $email, $alamat);
                $this->Session->write('cek_mudik_submit', $submit);
                $this->Session->setFlash(__('Terima Kasih atas partisipasi anda'));
            } else {
                $query = $db->fetchAll('INSERT INTO aq_event_mudik(kode,nama,  dob, gender, no_tlp, email, tanggal_entry, alamat, flag_submit)  VALUES(?,?, ?, ?, ?, ?, ?,?,?)', array($kode, $nama, $ttl, $gender, $nomor, $email, $date, $alamat, 0));
                $this->Session->setFlash(__('Anda sudah terdaftar dalam program ini, Terima Kasih atas partisipasi anda'));
            }


            //echo '<script>alert("Sukses");</script>';
            $this->redirect(array('controller' => 'front', 'action' => 'jagaamanmudik'));
            //}else{ $this->Session->setFlash(__('Invalid Captcha'));}
        }


        $this->set(compact('_metaTitle'));
    }

    public function detail_promo($seo = '') {
        $db = ConnectionManager::getDataSource('default');
        #show image if current date beetween startdate and enddate
        $date = date("Y-m-d H:i:s");
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $pr = $this->Promo->find('first', array('conditions' => array('Promo.seo' => $seo, 'deleted' => 0, 'Promo.start_date <= ' => $date)));
        if ($pr['Promo']['id'] == 7) {
            $ip_address = $this->request->clientIp();
            $query0 = $db->fetchAll('SELECT ip_address from aq_event_galihratna');
            //var_dump($query0);
            foreach ($query0 as $data) {
                if ($data["aq_event_galihratna"]["ip_address"] == $ip_address) {
                    $this->Session->write('EventGalihRatna', 'Done');
                }
                //var_dump($data);
            }


            if ($this->request->is('post')) {
                $nama = $this->request->data['fm_reservasi_premier']['NAMA'];
                $gender = $this->request->data['fm_reservasi_premier']['GENDER'];
                $ttl = $this->request->data['fm_reservasi_premier']['TTL'];
                $email = $this->request->data['fm_reservasi_premier']['EMAIL'];
                $nomor = $this->request->data['fm_reservasi_premier']['Contact_Phone'];
                $jawaban = $this->request->data['fm_reservasi_premier']['ANSWER'];


                $query = $db->fetchAll('INSERT INTO aq_event_galihratna(nama, email, no_telepon, dob, gender, jawaban, date_submit, ip_address)
               VALUES(?, ?, ?, ?, ?, ?, ?,?)', array($nama, $email, $nomor, $ttl, $gender, $jawaban, $date, $ip_address));
                $this->Session->write('EventGalihRatna', 'Done');
                $this->set(compact('allphone'));
            }
        }
        $this->set(compact('pr', 'date'));
    }

    public function linequiz_index() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)))
            $this->redirect('/'); // redirect if not mobile
        $this->layout = "linequiz";

        $optHub = $this->ApiXml->getRelationAHList();
        $allphone = $this->Val->find('all', array('conditions' => array()));
        $linequiz_session = $this->Session->read('LineQuiz');

        if (null !== $linequiz_session) { // Ada session ?
            $linequiz_data = $this->Linequiz->find('first', array('conditions' => array('Linequiz.cookie_id' => $linequiz_session)));
            if (!isset($linequiz_data['Linequiz']['step_stts'])) { // If no data, store new data
                $this->Linequiz->getDataSource()->begin();
                $this->Linequiz->save(array('cookie_id' => $linequiz_session, 'step_stts' => 1));
                $this->Linequiz->getDataSource()->commit();
            } elseif (1 == $linequiz_data['Linequiz']['step_stts']) { // If he has been here, but not input data
                $step_stts = 1;
            } elseif (2 == $linequiz_data['Linequiz']['step_stts']) { // If he has been here, and successfully input data
                $this->redirect(array('controller' => 'front', 'action' => 'linequiz_thanks'));
            }
        } else { // No LineQuiz session
            $step_stts = 0;
            $linequiz_session = md5($this->request->clientIp() . time());
            $this->Session->write('LineQuiz', $linequiz_session); // Write new LineQuiz session
            //Store to database
            $this->Linequiz->getDataSource()->begin();
            $this->Linequiz->save(array('cookie_id' => $linequiz_session, 'step_stts' => 1));
            $this->Linequiz->getDataSource()->commit();
        }

        $this->set(compact('optHub', 'step_stts', 'allphone'));
    }

    public function linequiz_send() {
        $this->autoRender = false;
        $linequiz_session = $this->Session->read('LineQuiz');

        //$data = $this->request->data['Personal'];

        if ($this->request->is('post')) {
            $data = $this->request->data;
            // Save Customer
            $customer_id = $this->ApiXml->saveLineQuizCustomer($data['Personal']);
            if ($customer_id) {
                $customer_cert_id = $this->ApiXml->GenerateLineQuizPolicyCustomer($customer_id);
            } else
                CakeLog::write('error', $customer_id); // write API Error to log

            $benef_id = $this->ApiXml->saveLineQuizBeneficiary($data['Personal']);

            if ($benef_id) {
                $benef_cert_id = $this->ApiXml->GenerateLineQuizPolicyBeneficiary($benef_id, $customer_cert_id, $data['Personal']['RELATIONSHIP_ID_WARIS']);
            } else
                CakeLog::write('error', $benef_id); // write API Error to log

            if (isset($customer_cert_id)) { // Success
                $this->Linequiz->updateAll(
                        array('step_stts' => 2, 'customer_id' => $customer_id, 'certificate_id' => $customer_cert_id), array('cookie_id' => $linequiz_session));
            }

            $this->redirect(array('controller' => 'front', 'action' => 'linequiz_thanks'));
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function linequiz_thanks() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)))
            $this->redirect('/'); // redirect if not mobile

        $linequiz_session = $this->Session->read('LineQuiz');
        if (null !== $linequiz_session) { // Ada session ?
            $linequiz_data = $this->Linequiz->find('first', array('conditions' => array('Linequiz.cookie_id' => $linequiz_session, 'step_stts' => 2)));
            if (!isset($linequiz_data['Linequiz']['step_stts'])) { // If no data, redirect to linequiz index
                $this->redirect(array('controller' => 'front', 'action' => 'linequiz_index'));
            } else {
                $download_url = $this->ApiXml->getEPolicyUrl($linequiz_data['Linequiz']['certificate_id']);
                $download_url = str_replace('C:\\inetpub\\WebService\\', 'http://system.jagadiri.co.id/webservice/', $download_url);
            }
        } else { // No LineQuiz session, redirect to linequiz index
            $this->redirect(array('controller' => 'front', 'action' => 'linequiz_index'));
        }

        $this->layout = "linequiz";
        $this->set(compact('download_url'));
    }

    public function submitSurvey() {
        $visitorIp = $this->request->clientIp();
        $sumberSurvey = isset($this->request->data['sumber']) ? $this->request->data['sumber'] : null;
        $sumberLainnya = $this->request->data['lainnya'];

        if ($sumberSurvey)
            $this->Survey->insertSurvey($visitorIp, $sumberSurvey, $sumberLainnya);

        $this->redirect(array('controller' => 'front', 'action' => 'home'));
    }

    public function CheckCustomerBlackList() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $cust_name = $this->request->query['cust_name'];
            $cust_dob = $this->request->query['cust_dob'];
            $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($cust_name, $cust_dob);
            if ($IsExistCustomerBlackList['CResult'] == 'T') {
                echo "1";
            } else {
                echo "0";
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

//start news
    public function news() {
        $this->layout = 'front';
        //load product per kategori, accident, life, health, investa
        $artikel = $this->News->find('all', array('conditions' => array('News.publish' => 1,), 'order' => array('created DESC')));
        // $this->News->find('all', array('limit' => 3, 'order' => array('created DESC')));
        // var_dump($artikel);


        $this->paginate = array(
            'limit' => 12,
            'order' => array(
                'News.id' => 'desc'
            )
        );
        $news = $this->paginate('News');
        $this->set('news', $news);
        //var_dump($news);
        $this->set(compact('artikel', 'news'));
    }

    public function newsdetail($id = null) {
        //data = query where id ==id
        $this->layout = 'front';
        $news2 = $this->News->find('all', array('limit' => 6, 'order' => array('id' => 'Desc'), 'conditions' => ['seo !=' => $id]));

        if ($id == null) {
            return $this->redirect(array('controller' => 'front', 'action' => 'home'));
        }
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactme']['Contact_Phone'];
            $email_black = $this->request->data['Contactme']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //black list
            $emph = null; //black list ilang
            if ($emph == null) {
                $data = $this->request->data['Contactme'];
                $this->ApiXml->sendContactUs($data);
                //$this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
                $this->request->data = null;
                $ctcontactme = '1';
                $this->Session->setFlash(__('Terimakasih telah mengisi data, agen kami akan segera menghubungi anda'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
            }
        }
        $newsdetail = $this->News->find('first', array('recursive' => 1, 'conditions' => array('News.seo' => $id, 'News.publish' => 1)));
        // var_dump($newsdetail);
        // $_metaTitle = $this->MetaTitle->getMeta('news'); //ganti function

        $this->Session->write('News.title', $newsdetail['News']['title']);
        $_metaTitle = $this->MetaTitle->getMetaNews($this->Session->read('News.title'));
        if ($newsdetail == null)
            throw new NotFoundException('Could not find that page');
        // $allproduct = $this->Product->find('all', array('conditions' => array('Product.seo !=' => $id), 'limit' => 4));
        $this->set(compact('newsdetail', /* 'allproduct', */ 'ctcontactme', '_metaTitle', 'news2'));
        // $allphone = $this->Val->find('all', array('conditions' => array()));
        // $this->set(compact('allphone'));
    }

//end news
//init raja premi
    public function raja_premi($RPKeyToken = '', $RPKeyDesc = '', $RPKeyProduct = '') {

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        var_dump($useragent);

        $a = $_REQUEST['RPKeyToken'];
        $b = $_REQUEST['RPKeyDesc'];
        $ck = $_REQUEST['RPKeyProduct'];
        list($c, $URL) = explode("-", $ck);

        var_dump($c);
        var_dump($URL);
        $ip_address = $this->request->clientIp();

        //$this->Session->write('IP_user', $ip_address);

        if (!strpos($URL, "http")) {
            $URL = "http://" . $URL;
        }


        $RP_token = $this->ApiXml->getConfig('TokenRajaPremi');
        $RP_desc = $this->ApiXml->getConfig('TokenRajaPremiDesc');

        //$this->Session->destroy();
        $this->Session->write('key.token', $RP_token);
        $this->Session->write('key.desc', $RP_desc);
        $this->Session->write('key.KeyProduct', $c);
        $this->Session->write('key.URLback', $URL);

        //$this->Session->destroy();
        if ($a != $RP_token && $b != $RP_desc) {
            $this->redirect($URL);
        }


        $list_product = array('1' => 'jaga-sehat-plus', '2' => 'jaga-aman', '3' => 'jaga-jiwa', '4' => 'caf-flexy-link', '5' => 'jaga-sehat-dbd', '6' => 'jaga-aman-instan', '7' => 'jaga-aman-plus5', '8' => 'jaga-aman-plus7', '9' => 'jaga-jiwa-plus5', '10' => 'jaga-jiwa-plus7', '11' => 'jaga-sehat-keluarga');

        if ($c < 1 || $c > sizeof($list_product)) {
            $this->redirect('http://' . $URL);
            //$this->redirect(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-sehat-plus'));
        }

        for ($i = 1; $i < sizeof($list_product) + 1; $i++) {
            if ($c == $i) {
                $this->redirect(array('controller' => 'front', 'action' => 'step1_non_unitlink', 'id' => $list_product[$i]));
                //$this->requestAction(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>$list_product[$i]), array('data' =>$this->data));
            }
        }
        //http://103.24.12.244/raja-premi/cek-token.htm?RPKeyToken=aa&RPKeyDesc=bb&RPKeyProduct=1
    }

//end raja premi
//init kapan lagi
    public function kapan_lagi($KLKeyToken = '', $KLKeyDesc = '', $KLKeyProduct = '') {

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        $a = $_REQUEST['KLKeyToken'];
        $b = $_REQUEST['KLKeyDesc'];
        $c = $_REQUEST['KLKeyProduct'];
        $ip_address = $this->request->clientIp();

        $list_product = array('0' => 'home', '1' => 'jaga-sehat-plus', '2' => 'jaga-aman', '3' => 'jaga-jiwa', '4' => 'caf-flexy-link', '5' => 'jaga-sehat-dbd', '6' => 'jaga-aman-instan', '7' => 'jaga-aman-plus5', '8' => 'jaga-aman-plus7', '9' => 'jaga-jiwa-plus5', '10' => 'jaga-jiwa-plus7', '11' => 'jaga-sehat-keluarga');

        $KL_token = $this->ApiXml->getConfig('TokenKapanLagi');
        $KL_desc = $this->ApiXml->getConfig('TokenKapanLagiDesc');
        //$this->Session->destroy();



        if ($a != $KL_token && $b != $KL_desc) {
            throw new NotFoundException('Could not find that page');
        } else if (!isset($c)) {
            throw new NotFoundException('Could not find that page');
        } else if ($c < 1 || $c > sizeof($list_product)) {
            //$this->redirect('/');
            $c = 0;
        }

        if (!$this->Session->check('KL')) {
            $this->Session->write('KL.KeyToken', $KL_token);
            $this->Session->write('KL.KeyDesc', $KL_desc);
            $this->Session->write('KL.Page', $c);
            $db = ConnectionManager::getDataSource('default');
            $query_log = $db->fetchAll('INSERT INTO aq_sumber_visitor( sumber, waktu, user_ip, user_agent, page )VALUES( ?, ?, ?, ?, ?)', array('KapanLagi', date("Y-m-d H:i:s"), $ip_address, $useragent, $list_product[$c]));
        }

        for ($i = 0; $i < sizeof($list_product) + 1; $i++) {
            if ($c == 0) {
                $this->redirect('/');
            } else if ($c == $i) {
                $this->redirect(array('controller' => 'front', 'action' => 'step1_non_unitlink', 'id' => $list_product[$i]));
                //$this->requestAction(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>$list_product[$i]), array('data' =>$this->data));
            }
            //http://103.24.12.244/kapan-lagi/cek-token.htm?KLKeyToken=aa&KLKeyDesc=bb&KLKeyProduct=1
            //http://103.24.12.244/kapan-lagi/cek-token.htm?KLKeyToken=8JJpH9a0dPARlMNA1FqCfENOD50&KLKeyDesc=J+CQP0Ra3x2uNTjUypL3QNWkPig=&KLKeyProduct=1
        }
    }

//end kapan lagi

    public function test() {
        $list_product = array('0' => 'home', '1' => 'jaga-sehat-plus', '2' => 'jaga-aman', '3' => 'jaga-jiwa', '4' => 'caf-flexy-link', '5' => 'jaga-sehat-dbd', '6' => 'jaga-aman-instan', '7' => 'jaga-aman-plus5', '8' => 'jaga-aman-plus7', '9' => 'jaga-jiwa-plus5', '10' => 'jaga-jiwa-plus7', '11' => 'jaga-sehat-keluarga');
        $this->set(compact('list_product'));
    }

//start free movie
    public function fm() {
        $this->disableCache();
        $this->layout = 'front';

        $cinemaArr = $this->Cinema->find('all', array('fields' => array('nama_cinema')));
        $cinema = array();
        for ($i = 0; $i < count($cinemaArr); $i++) {
            $cinema[] = $cinemaArr[$i]["Cinema"]["nama_cinema"];
        }


        $jadwalArr = $this->Jadwal->find('all', array(
            'fields' => array('tanggal_ambil')));
        $jadwal = array();
        for ($i = 0; $i < count($jadwalArr); $i++) {
            $jadwal[] = $jadwalArr[$i]["Jadwal"]["tanggal_ambil"];
        }

        //$ticket = $this->Ticket->query("SELECT SUM(`aq_fm_qty_ticket`.`jumlah_ticket_entry`) AS totalTicket  FROM`aq_fm_qty_ticket` "); 
        //$ticket= $this->Ticket->find('all',array( 'fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket')  ));
        //$ticket= $this->Ticket->find('all',array( 'fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket, tanggal_selesai'),'conditions'=>array('tanggal_mulai <'=> date("Y-m-d H:i:s",strtotime('+1 month 5 days')), 'tanggal_selesai >' => date("Y-m-d H:i:s",strtotime('+1 month 5 days'))  )));    //$listCinema=$cinema[0]["nama_cinema"]; var_dump($listCinema);
        $ticket = $this->Ticket->find('all', array('fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket,tanggal_selesai'), 'conditions' => array('tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
        //$listCinema=$cinema[0]["nama_cinema"]; var_dump($listCinema);

        $this->set(compact('cinema', 'jadwal', 'ticket', 'ea'));
    }

//end free movie
//init reservasi fm
    public function reservasi_nonton() {
        $this->disableCache();
        if ($this->request->is('post')) {

            $cinemaArr = $this->Cinema->find('all', array('fields' => array('nama_cinema')));
            $cinema = array();

            for ($i = 0; $i < count($cinemaArr); $i++) {
                $cinema[] = $cinemaArr[$i]["Cinema"]["nama_cinema"];
            }

            $jadwalArr = $this->Jadwal->find('all', array('fields' => array('tanggal_ambil')));      //  var_dump($jadwal);
            $jadwal = array();

            for ($i = 0; $i < count($jadwalArr); $i++) {
                $jadwal[] = $jadwalArr[$i]["Jadwal"]["tanggal_ambil"];
            }

            // var_dump($this->request ["data"]["fm_reservasi_"]);
            $input_nomor_polis = $this->request ["data"]["fm_reservasi_"]["NOMOR_POLIS"];
            $input_cinema = $this->request ["data"]["fm_reservasi_"]["CINEMA"];
            $input_jadwal = $this->request ["data"]["fm_reservasi_"]["JADWAL"];
            $quote_no = $this->request ["data"]["fm_reservasi_"]["QUOTE_NO"];

            $tiketDiambil = $this->Ticket_Log->find('all', array('fields' => array('SUM(jumlah_ticket_diambil)as diambil'), 'conditions' => array('nomor_polis' => $input_nomor_polis, 'tanggal_ticket_diambil <' => date("Y-m-d H:i:s"), 'tanggal_ticket_diambil >' => date("Y-m-d H:i:s", strtotime('-2 week')))));

            $ticket = $this->Ticket->find('all', array('fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket,tanggal_selesai'), 'conditions' => array('tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));

            //$ticket= $this->Ticket->find('all',array( 'fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket,  tanggal_selesai'),'conditions'=>array( 'tanggal_selesai >' => date("Y-m-d H:i:s")  )));    
            //$ticket= $this->Ticket->find('all',array( 'fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket,  tanggal_selesai'),'conditions'=>array( 'tanggal_selesai >' => date("Y-m-d H:i:s",strtotime('+1 month 5 days'))  )));    


            try {
                $hasilCek = $this->ApiXml->cekFreeMovie($input_nomor_polis);
            } catch (Exception $e) {
                $hasilCek = null;
            }
            $this->Session->write('updatefm', "siap");
            $this->set(compact('input_nomor_polis', 'input_cinema', 'input_jadwal', 'cinema', 'jadwal', 'hasilCek', 'tiketDiambil', 'quote_no', 'ticket'));
        } else {
            // throw new NotFoundException('Could not find that page');
            $this->redirect(array('controller' => 'front', 'action' => 'fm'));
        }
    }

//end reservasi fm
//init hasil reservasi fm
    public function reservasi_finish() {
        $this->disableCache();
        if ($this->request->is('post')) {

            $cinemaArr = $this->Cinema->find('all', array('fields' => array('nama_cinema')));
            $cinema = array();
            for ($i = 0; $i < count($cinemaArr); $i++) {
                $cinema[] = $cinemaArr[$i]["Cinema"]["nama_cinema"];
            }
            $jadwalArr = $this->Jadwal->find('all', array('fields' => array('tanggal_ambil')));      //  var_dump($jadwal);
            $jadwal = array();
            for ($i = 0; $i < count($jadwalArr); $i++) {
                $jadwal[] = $jadwalArr[$i]["Jadwal"]["tanggal_ambil"];
            }


            // var_dump($this->request ["data"]["fm_reservasi_"]);
            $input_nomor_polis = $this->request ["data"]["fm_request_"]["NOMOR_POLIS"];
            $input_nama = $this->request ["data"]["fm_request_"]["NAMA"];
            $input_email = $this->request ["data"]["fm_request_"]["EMAIL"];
            $input_jumlah_tiket = $this->request ["data"]["fm_request_"]["JUMLAH_TICKET"] + 1;
            $input_cinema = $this->request ["data"]["fm_request_"]["CINEMA"];
            $input_jadwal = $this->request ["data"]["fm_request_"]["JADWAL"];
            $input_insured = $this->request ["data"]["fm_request_"]["COUNT_INSURED"];
            $quote_no2 = $this->request ["data"]["fm_request_"]["QUOTE_NO"];
            //	 $quote_no=$quote_no2.'-'.$input_nomor_polis.'-'.$input_jumlah_tiket;
            $quote_no = $quote_no2 . '-' . $input_nomor_polis . '-' . date("His") . $input_jumlah_tiket;

            if ($this->Session->check('updatefm')) {

                $this->Session->delete('updatefm');
                $db = ConnectionManager::getDataSource('default');
                $ticket = $this->Ticket->find('all', array('fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket,tanggal_selesai'), 'conditions' => array('tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));    //$this->Ticket->find('all',array( 'fields' => array('SUM(jumlah_ticket_entry)as totalTicket')  ));
                if ($ticket[0][0]["totalTicket"] == 0) {
                    echo 'alert(maaf tiket telah habis);';
                    $this->redirect(array('controller' => 'front', 'action' => 'fm'));
                }

                $jumlah = $ticket[0][0]["totalTicket"] - $input_jumlah_tiket;
                //var_dump($input_nomor_polis." ".$input_nama." ".$input_email." ".$input_jumlah_tiket." ".$input_cinema." ".$input_jadwal.' ');
                $status = 'no';
                $desc = "blom";
                // $this->ApiXml->saveemailfm($quote_no, $input_nama, $input_nomor_polis,$input_email,$input_jumlah_tiket,$input_cinema, $input_jadwal,$status,$desc );
                //sleep(5);    
                $query_log = $db->fetchAll('INSERT INTO aq_fm_ticket_log(id_ticket, jumlah_ticket_diambil, tanggal_ticket_diambil, nomor_polis, nama_polis, insured_polis, email_polis, quote_no )VALUES(?, ?, ?, ?, ?, ?, ?,?)', array($ticket[0]['Ticket']["id_ticket"], $input_jumlah_tiket, date("Y-m-d H:i:s"), $input_nomor_polis, $input_nama, $input_insured, $input_email, $quote_no));
                //sleep(5);
                $query_tiket = $db->fetchAll('UPDATE `aq_fm_qty_ticket` SET `aq_fm_qty_ticket`.jumlah_ticket_entry = ' . $jumlah . ' WHERE id_ticket =' . $ticket[0]['Ticket']["id_ticket"]);
                $this->ApiXml->saveemailfm($quote_no, $input_nama, $input_nomor_polis, $input_email, $input_jumlah_tiket, $input_cinema, $input_jadwal, $status, $desc);
            }

            $this->set(compact('input_nomor_polis', 'input_cinema', 'input_jadwal', 'input_jumlah_tiket', 'input_email', 'input_nama', 'quote_no'));
        } else {
            // throw new NotFoundException('Could not find that page');
            $this->redirect(array('controller' => 'front', 'action' => 'fm'));
        }
    }

//end hasil reservasi fm
//init petunjuk fm
    public function petunjuk_fm() {
        
    }

//end petunjuk fm
//init petunjuk hari pelangan nasional 2017
    public function hpn2017() {
        
    }

//end petunjuk hari pelangan nasional 2017
//init cek nomorpolis
    public function check_valid_polis_fm() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $input_nomor_polis = $this->request->query['nopol'];
            $hasilCek = $this->ApiXml->cekFreeMovie($input_nomor_polis);
            if ($hasilCek)
                echo "1";
            else
                echo "0";
        } else
            throw new NotFoundException('Could not find that page');
    }

//end cek nomor polis
//start egift 
    public function egift($id = null) {

        $this->disableCache();
        $this->layout = 'front';

        //$egift= $this->Egift->find('all',array( 'fields' => array('SUM(jumlah_voucher_entry)as totalVoucher, quote_voucher, id_voucher,tanggal_selesai'),'conditions'=>array('tanggal_mulai <'=> date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s")  )));    
        //$egift= $this->Egift->find('all',array( 'fields' => array('SUM(jumlah_voucher_entry)as totalVoucher, kode_voucher, id_voucher,tanggal_selesai'),'conditions'=>array('tanggal_mulai <'=> date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s")  )));    
        //$egift_ev= $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.nomor_polis' => null, 'tanggal_mulai <'=> date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s") ))); //$this->Egift->find('all',array( 'fields' => array('jumlah_voucher_entry, kode_voucher, id_voucher,tanggal_selesai'),'conditions'=>array('tanggal_mulai <'=> date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s")  )));    

        $VoucherDiambil = $this->Egift_log->find('first', array('conditions' => array('nomor_polis' => $id, 'log_date <' => date("Y-m-d H:i:s"), 'log_date >' => date("Y-m-d H:i:s", strtotime('-2 week')))));


        $hasilCek = $this->ApiXml->cekEGift($id);
        $this->Session->write('egift', $hasilCek);


        if (empty($VoucherDiambil)) {
            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => null, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            $egift_booked = $db->fetchAll('UPDATE `aq_egift_voucher` SET `aq_egift_voucher`.remark = ' . $id . ' WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            ;
            $query_log = $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark,last_update )VALUES(?, ?,  ?, ?, ?, ?,?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id, 'TICKET ALREADY BOOKED', 'BOOKED', date("Y-m-d H:i:s")));

            if (!empty($VoucherDiambil)) {
                $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
                $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
                $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
            }
        } else if ($VoucherDiambil['Egift_log']['remark'] == 'BOOKED') {
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $id, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            $db = ConnectionManager::getDataSource('default');
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET  `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher_log =' . $VoucherDiambil['Egift_log']['id_voucher_log']);
            if (!empty($VoucherDiambil)) {
                $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
                $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
                $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
            }
        }

        if (!$hasilCek)
            throw new NotFoundException('Could not find that page');

        $allphone = $this->Val->find('all', array('conditions' => array()));

        $this->set(compact('egift', 'id', 'hasilCek', 'VoucherDiambil', 'allphone'));
    }

//end egift
//start egift blibli
    public function egift_bli($id = null) {

        $this->disableCache();
        $this->layout = 'front';
        $VoucherDiambil = $this->Egift_log->find('first', array('conditions' => array('nomor_polis' => $id, 'id_merchant' => 1, 'log_date <' => date("Y-m-d H:i:s"), 'log_date >' => date("Y-m-d H:i:s", strtotime('-2 week')))));
        $hasilCek = $this->ApiXml->cekEGift($id);
        $this->Session->write('egift', $hasilCek);

        if (empty($VoucherDiambil)) {
            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => null, 'merchant' => 1, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');

            $egift_booked = $db->fetchAll('UPDATE `aq_egift_voucher` SET `aq_egift_voucher`.remark = ' . $id . ' WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            ;
            $query_log = $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark,last_update, id_merchant )VALUES(?, ?,  ?, ?, ?, ?,?,?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id, 'TICKET ALREADY BOOKED', 'BOOKED', date("Y-m-d H:i:s"), 1));


            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }else if ($VoucherDiambil['Egift_log']['remark'] == 'BOOKED') {
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $id, 'merchant' => 1, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');
            $db = ConnectionManager::getDataSource('default');
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET  `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher_log =' . $VoucherDiambil['Egift_log']['id_voucher_log']);

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }

        $this->Session->write('egift.imid', 'bli');
        if (!$hasilCek)
            throw new NotFoundException('Could not find that page');

        $allphone = $this->Val->find('all', array('conditions' => array()));

        $this->set(compact('egift', 'id', 'hasilCek', 'VoucherDiambil', 'allphone'));
    }

//end egift blibli
//start egift toped
    public function egift_tp($id = null) {

        $this->disableCache();
        $this->layout = 'front';
        $VoucherDiambil = $this->Egift_log->find('first', array('conditions' => array('nomor_polis' => $id, 'id_merchant' => 2, 'log_date <' => date("Y-m-d H:i:s"), 'log_date >' => date("Y-m-d H:i:s", strtotime('-2 week')))));
        $hasilCek = $this->ApiXml->cekEGift($id);
        $this->Session->write('egift', $hasilCek);

        if (empty($VoucherDiambil)) {
            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => null, 'merchant' => 2, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');

            $egift_booked = $db->fetchAll('UPDATE `aq_egift_voucher` SET `aq_egift_voucher`.remark = ' . $id . ' WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            ;
            $query_log = $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark,last_update, id_merchant )VALUES(?, ?,  ?, ?, ?, ?,?,?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id, 'TICKET ALREADY BOOKED', 'BOOKED', date("Y-m-d H:i:s"), 2));


            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }else if ($VoucherDiambil['Egift_log']['remark'] == 'BOOKED') {
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $id, 'merchant' => 2, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');

            $db = ConnectionManager::getDataSource('default');
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET  `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher_log =' . $VoucherDiambil['Egift_log']['id_voucher_log']);

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }
        $this->Session->write('egift.imid', 'tp');
        if (!$hasilCek)
            throw new NotFoundException('Could not find that page');

        $allphone = $this->Val->find('all', array('conditions' => array()));

        $this->set(compact('egift', 'id', 'hasilCek', 'VoucherDiambil', 'allphone'));
    }

//end egift toped
//start egift 77
    public function egift_77($id = null) {

        $this->disableCache();
        $this->layout = 'front';
        $VoucherDiambil = $this->Egift_log->find('first', array('conditions' => array('nomor_polis' => $id, 'id_merchant' => 3, 'log_date <' => date("Y-m-d H:i:s"), 'log_date >' => date("Y-m-d H:i:s", strtotime('-2 week')))));
        $hasilCek = $this->ApiXml->cekEGift($id);
        $this->Session->write('egift', $hasilCek);

        if (empty($VoucherDiambil)) {
            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => null, 'merchant' => 3, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');
            $egift_booked = $db->fetchAll('UPDATE `aq_egift_voucher` SET `aq_egift_voucher`.remark = ' . $id . ' WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            ;
            $query_log = $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark,last_update, id_merchant )VALUES(?, ?,  ?, ?, ?, ?,?,?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id, 'TICKET ALREADY BOOKED', 'BOOKED', date("Y-m-d H:i:s"), 3));

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }else if ($VoucherDiambil['Egift_log']['remark'] == 'BOOKED') {
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $id, 'merchant' => 3, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');

            $db = ConnectionManager::getDataSource('default');
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET  `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher_log =' . $VoucherDiambil['Egift_log']['id_voucher_log']);

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }
        $this->Session->write('egift.imid', '77');
        if (!$hasilCek)
            throw new NotFoundException('Could not find that page');

        $allphone = $this->Val->find('all', array('conditions' => array()));

        $this->set(compact('egift', 'id', 'hasilCek', 'VoucherDiambil', 'allphone'));
    }

//end egift 77
//start egift alfamart
    public function egift_alf($id = null) {

        $this->disableCache();
        $this->layout = 'front';
        $VoucherDiambil = $this->Egift_log->find('first', array('conditions' => array('nomor_polis' => $id, 'id_merchant' => 4, 'log_date <' => date("Y-m-d H:i:s"), 'log_date >' => date("Y-m-d H:i:s", strtotime('-2 week')))));
        $hasilCek = $this->ApiXml->cekEGift($id);
        $this->Session->write('egift', $hasilCek);

        if (empty($VoucherDiambil)) {
            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => null, 'merchant' => 4, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');
            $egift_booked = $db->fetchAll('UPDATE `aq_egift_voucher` SET `aq_egift_voucher`.remark = ' . $id . ' WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            ;
            $query_log = $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark,last_update, id_merchant )VALUES(?, ?,  ?, ?, ?, ?,?,?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id, 'TICKET ALREADY BOOKED', 'BOOKED', date("Y-m-d H:i:s"), 4));

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }else if ($VoucherDiambil['Egift_log']['remark'] == 'BOOKED') {
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $id, 'merchant' => 4, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');

            $db = ConnectionManager::getDataSource('default');
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET  `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher_log =' . $VoucherDiambil['Egift_log']['id_voucher_log']);

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }
        $this->Session->write('egift.imid', 'alf');
        if (!$hasilCek)
            throw new NotFoundException('Could not find that page');

        $allphone = $this->Val->find('all', array('conditions' => array()));

        $this->set(compact('egift', 'id', 'hasilCek', 'VoucherDiambil', 'allphone'));
    }

//end egift alfamart
//start egift chatime
    public function egift_cha($id = null) {

        $this->disableCache();
        $this->layout = 'front';
        $VoucherDiambil = $this->Egift_log->find('first', array('conditions' => array('nomor_polis' => $id, 'id_merchant' => 5, 'log_date <' => date("Y-m-d H:i:s"), 'log_date >' => date("Y-m-d H:i:s", strtotime('-2 week')))));
        $hasilCek = $this->ApiXml->cekEGift($id);
        $this->Session->write('egift', $hasilCek);

        if (empty($VoucherDiambil)) {
            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => null, 'merchant' => 5, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');
            $egift_booked = $db->fetchAll('UPDATE `aq_egift_voucher` SET `aq_egift_voucher`.remark = ' . $id . ' WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            ;
            $query_log = $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark,last_update, id_merchant )VALUES(?, ?,  ?, ?, ?, ?,?,?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id, 'TICKET ALREADY BOOKED', 'BOOKED', date("Y-m-d H:i:s"), 5));

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }else if ($VoucherDiambil['Egift_log']['remark'] == 'BOOKED') {
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $id, 'merchant' => 5, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
            if (!$egift)
                throw new NotFoundException('Could not find that page');

            $db = ConnectionManager::getDataSource('default');
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET  `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher_log =' . $VoucherDiambil['Egift_log']['id_voucher_log']);

            $this->Session->write('egift.kode_voucher', $egift['Egift']['kode_voucher']);
            $this->Session->write('egift.expired_voucher', $egift['Egift']['tanggal_selesai']);
            $this->Session->write('egift.egift_number', $egift['Egift']['egift_number']);
        }
        $this->Session->write('egift.imid', 'cha');
        if (!$hasilCek)
            throw new NotFoundException('Could not find that page');

        $allphone = $this->Val->find('all', array('conditions' => array()));

        $this->set(compact('egift', 'id', 'hasilCek', 'VoucherDiambil', 'allphone'));
    }

//end egift chatime
//init egift_redeem
    public function egift_redeem() {
        $this->disableCache();
        if ($this->request->is('post')) {

            // var_dump($this->request ["data"]["fm_reservasi_"]);
            $input_nomor_polis = $this->request ["data"]["egift_reservasi_"]["NOMOR_POLIS"];
            $input_alamat = $this->request ["data"]["egift_reservasi_"]["ALAMAT"];
            $input_hp = $this->request ["data"]["egift_reservasi_"]["NO_HP"];

            $this->Session->write('egift.inputAddress', $input_alamat);
            $this->Session->write('egift.inputMobilePhone', $input_hp);

            $url = $_SERVER['HTTP_REFERER'];
            $updateData = $this->ApiXml->saveEgiftData($input_nomor_polis, $url);
//var_dump($updateData);



            $db = ConnectionManager::getDataSource('default');
            $egift = $this->Egift->find('first', array('recursive' => 1, 'conditions' => array('Egift.flag_use' => 0, 'Egift.remark' => $input_nomor_polis, 'tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
//$this->Session->write('egift1', $egift['Egift']['id_voucher']);
            $egift_booked = $db->fetchAll("update aq_egift_voucher set flag_use =1  where id_voucher =" . $egift['Egift']['id_voucher']);
//var_dump($egift);
            $this->set(compact('egift'));
            $egift_log = $this->Egift_log->find('first', array('recursive' => 1, 'conditions' => array('nomor_polis' => $input_nomor_polis, 'remark' => 'BOOKED')));
            $this->set(compact('egift_log'));
            $egift_log_update = $db->fetchAll('UPDATE `aq_egift_voucher_log` SET `aq_egift_voucher_log`.remark = "DONE",`aq_egift_voucher_log`.description = "VOUCHER ALREADY SENT", `aq_egift_voucher_log`.last_update ="' . date("Y-m-d H:i:s") . '" WHERE id_voucher =' . $egift['Egift']["id_voucher"]);
            //$query_log= $db->fetchAll('INSERT INTO aq_egift_voucher_log(id_voucher, log_date, log_by, nomor_polis,  description, remark )VALUES(?, ?,  ?, ?, ?, ?)', array($egift['Egift']["id_voucher"], date("Y-m-d H:i:s"), 'SYSTEM REDEEM', $id ,'TICKET ALREADY BOOKED' ,'BOOKED'));


            $this->set(compact('input_nomor_polis'));
        } else {
            // throw new NotFoundException('Could not find that page');
            $this->redirect(array('controller' => 'front', 'action' => 'egift_petunjuk'));
        }
    }

//end egift_redeem
//init egift_finish
    public function egift_finish() {
        $this->disableCache();
        if ($this->request->is('post')) {

            $cinemaArr = $this->Cinema->find('all', array('fields' => array('nama_cinema')));
            $cinema = array();

            for ($i = 0; $i < count($cinemaArr); $i++) {
                $cinema[] = $cinemaArr[$i]["Cinema"]["nama_cinema"];
            }

            $jadwalArr = $this->Jadwal->find('all', array('fields' => array('tanggal_ambil')));      //  var_dump($jadwal);
            $jadwal = array();

            for ($i = 0; $i < count($jadwalArr); $i++) {
                $jadwal[] = $jadwalArr[$i]["Jadwal"]["tanggal_ambil"];
            }

            // var_dump($this->request ["data"]["fm_reservasi_"]);
            $input_nomor_polis = $this->request ["data"]["fm_request_"]["NOMOR_POLIS"];
            $input_nama = $this->request ["data"]["fm_request_"]["NAMA"];
            $input_email = $this->request ["data"]["fm_request_"]["EMAIL"];
            $input_jumlah_tiket = $this->request ["data"]["fm_request_"]["JUMLAH_TICKET"] + 1;
            $input_cinema = $this->request ["data"]["fm_request_"]["CINEMA"];
            $input_jadwal = $this->request ["data"]["fm_request_"]["JADWAL"];
            $input_insured = $this->request ["data"]["fm_request_"]["COUNT_INSURED"];
            $quote_no2 = $this->request ["data"]["fm_request_"]["QUOTE_NO"];
            //$quote_no=$quote_no2.'-'.$input_nomor_polis.'-'.$input_jumlah_tiket;
            $quote_no = $quote_no2 . '-' . $input_nomor_polis . '-' . date("His") . $input_jumlah_tiket;

            if ($this->Session->check('updatefm')) {
                $this->Session->delete('updatefm');
                $db = ConnectionManager::getDataSource('default');
                $ticket = $this->Ticket->find('all', array('fields' => array('SUM(jumlah_ticket_entry)as totalTicket, quote_ticket, id_ticket,tanggal_selesai'), 'conditions' => array('tanggal_mulai <' => date("Y-m-d H:i:s"), 'tanggal_selesai >' => date("Y-m-d H:i:s"))));
                //$this->Ticket->find('all',array( 'fields' => array('SUM(jumlah_ticket_entry)as totalTicket')  ));

                if ($ticket[0][0]["totalTicket"] == 0) {
                    echo 'alert(maaf tiket telah habis);';
                    $this->redirect(array('controller' => 'front', 'action' => 'fm'));
                }

                $jumlah = $ticket[0][0]["totalTicket"] - $input_jumlah_tiket;
                //var_dump($input_nomor_polis." ".$input_nama." ".$input_email." ".$input_jumlah_tiket." ".$input_cinema." ".$input_jadwal.' ');
                $status = 'no';
                $desc = "blom";
                // $this->ApiXml->saveemailfm($quote_no, $input_nama, $input_nomor_polis,$input_email,$input_jumlah_tiket,$input_cinema, $input_jadwal,$status,$desc );
                //sleep(5);    
                $query_log = $db->fetchAll('INSERT INTO aq_fm_ticket_log(id_ticket, jumlah_ticket_diambil, tanggal_ticket_diambil, nomor_polis, nama_polis, insured_polis, email_polis, quote_no )VALUES(?, ?, ?, ?, ?, ?, ?,?)', array($ticket[0]['Ticket']["id_ticket"], $input_jumlah_tiket, date("Y-m-d H:i:s"), $input_nomor_polis, $input_nama, $input_insured, $input_email, $quote_no));
                //sleep(5);
                $query_tiket = $db->fetchAll('UPDATE `aq_fm_qty_ticket` SET `aq_fm_qty_ticket`.jumlah_ticket_entry = ' . $jumlah . ' WHERE id_ticket =' . $ticket[0]['Ticket']["id_ticket"]);
                $this->ApiXml->saveemailfm($quote_no, $input_nama, $input_nomor_polis, $input_email, $input_jumlah_tiket, $input_cinema, $input_jadwal, $status, $desc);
            }

            $this->set(compact('input_nomor_polis', 'input_cinema', 'input_jadwal', 'input_jumlah_tiket', 'input_email', 'input_nama', 'quote_no'));
        } else {
            // throw new NotFoundException('Could not find that page');
            $this->redirect(array('controller' => 'front', 'action' => 'fm'));
        }
    }

//end egift_finish
//init egift_petunjuk
    public function egift_petunjuk() {
        
    }

//end egift_petunjuk
//init checkout raja premi
    public function checkout_raja_premi() {
        $this->layout = "layout_raja_premi";
    }

//end checkout raja premi


    /* ===============================================================
      intial
      microsite jaber - gojek 2017
      author : Samuel a.k.a Jojo

      =================================================================
     */
//init jaga aman gojek daftar
    public function jagojek_daftar() {
        $this->layout = 'jagojek';
        if ($this->request->is('post')) {
            if (!empty($this->request->data['RegGojek']['voucherCode'])) {

                $kodev = $this->request->data['RegGojek']['voucherCode'];

                //cek ke db
                $db = ConnectionManager::getDataSource('default');
                $query_find = $db->fetchAll("SELECT * FROM `aq_jab_gojek_voucher` WHERE kode_voucher ='$kodev' ");

                //validasi evoucher valid / tidak 
                if ($query_find) {
                    //kode voucher benar
                    if ($query_find[0]['aq_jab_gojek_voucher']['tanggal_selesai'] < date('Y-m-d H:i:s')) {// cek exp date
                        $this->Session->setFlash(__('kode voucher anda sudah kadaluarsa'));
                    } else if ($query_find[0]['aq_jab_gojek_voucher']['flag_use'] == 1) {//cek udh pake / belum
                        $this->Session->setFlash(__('kode voucher anda sudah sudah terpakai'));
                    } else {//kode voucher ok
                        //$this->Session->setFlash(__('selamat anda berhak lanjut ke step berikutnya'));
                        $this->Session->write('jagojek.id', $query_find[0]['aq_jab_gojek_voucher']['id_voucher']);
                        $this->Session->write('jagojek.code', $query_find[0]['aq_jab_gojek_voucher']['kode_voucher']);

                        $db = ConnectionManager::getDataSource('default');
                        $dtime = date('Y-m-d H:i:s');
                        $whois = 'SYSTEM BOOKING MICROSITE GOJEK';
                        $ipaddress = $this->request->clientIp();
                        $visitor_user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $idvoucher = $this->Session->read('jagojek.id');

                        $query_update = $db->fetchAll("UPDATE `aq_jab_gojek_voucher` SET `flag_use`=0 , `last_update`='$dtime', `update_by`='$whois' WHERE `id_voucher`='$idvoucher'");
                        $query_log = $db->fetchAll('INSERT INTO `aq_jab_gojek_voucher_log`( id_voucher, log_date, log_by, description, remark, last_update, ip, agent ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)', array($idvoucher, $dtime, $whois, 'Booking', 'Progress', $dtime, $ipaddress, $visitor_user_agent));


                        $this->redirect(array('controller' => 'front', 'action' => 'jagojek_isi'));
                    }
                } else {
                    //kode voucher palsu
                    $this->Session->setFlash(__('kode voucher anda tidak valid'));
                }
            } else {
                $this->Session->setFlash(__('Mohon isi kode voucher!'));
            }
        }
    }

//end jaga aman gojek daftar
//init jaga aman gojek isi
    public function jagojek_isi() {
        $this->layout = 'jagojek';
        if ($this->Session->check('jagojek')) {
            $allphone = $this->Val->find('all', array('conditions' => array()));
            $this->set(compact('allphone'));
            if ($this->request->is('post')) { //get post data from page it self
                $data = $this->request->data['DtGojek'];
                //var_dump($data);

                try {
                    $idCustomer = $this->ApiXml->saveCustomerGojek($data);
                } catch (Exception $e) {
                    //echo 'Message1: ' .$e->getMessage();
                    CakeLog::write('error', $e->getMessage());
                }

                try {
                    $idBeneficary = $this->ApiXml->saveCustomerGojekAW($data);
                } catch (Exception $e) {
                    //echo 'Message2: ' .$e->getMessage();
                    CakeLog::write('error', $e->getMessage());
                }

                try {
                    $idPolicy = $this->ApiXml->saveShortTermPolicyJabGojek($data, $idBeneficary);

                    try {
                        $this->ApiXml->ShortTermBeneficairyJabGojek($idPolicy, $idBeneficary, $data["insuredHeirRelation"], $idPolicy);
                    } catch (Exception $e) {
                        //echo 'Message4: ' .$e->getMessage();
                        CakeLog::write('error', $e->getMessage());
                    }

                    try {
                        $db = ConnectionManager::getDataSource('default');
                        $dtime = date('Y-m-d H:i:s');
                        $whois = 'SYSTEM REDEEM MICROSITE GOJEK';
                        $ipaddress = $this->request->clientIp();
                        $visitor_user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $idvoucher = $this->Session->read('jagojek.id');

                        $query_update = $db->fetchAll("UPDATE `aq_jab_gojek_voucher` SET `flag_use`=1 , `last_update`='$dtime', `update_by`='$whois' WHERE `id_voucher`='$idvoucher'");
                        $query_log = $db->fetchAll('INSERT INTO `aq_jab_gojek_voucher_log`( id_voucher, log_date, log_by, description, remark, last_update, ip, agent ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)', array($idvoucher, $dtime, $whois, 'Redeem', 'Success', $dtime, $ipaddress, $visitor_user_agent));

                        $this->redirect(array('controller' => 'front', 'action' => 'jagojek_selesai'));
                    } catch (Exception $e) {
                        //echo 'Message5: ' .$e->getMessage();
                        CakeLog::write('error', $e->getMessage());

                        try {
                            $db = ConnectionManager::getDataSource('default');
                            $dtime = date('Y-m-d H:i:s');
                            $whois = 'SYSTEM REDEEM FAILED MICROSITE GOJEK';
                            $ipaddress = $this->request->clientIp();
                            $visitor_user_agent = $_SERVER['HTTP_USER_AGENT'];
                            $idvoucher = $this->Session->read('jagojek.id');

                            $query_update = $db->fetchAll("UPDATE `aq_jab_gojek_voucher` SET `flag_use`=1 , `last_update`='$dtime', `update_by`='$whois' WHERE `id_voucher`='$idvoucher'");
                            $query_log = $db->fetchAll('INSERT INTO `aq_jab_gojek_voucher_log`( id_voucher, log_date, log_by, description, remark, last_update, ip, agent ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)', array($idvoucher, $dtime, $whois, 'Redeem', 'FAILED', $dtime, $ipaddress, $visitor_user_agent));

                            $this->redirect(array('controller' => 'front', 'action' => 'jagojek_selesai'));
                        } catch (Exception $e) {
                            //echo 'Message6: ' .$e->getMessage();
                            CakeLog::write('error', $e->getMessage());
                        }
                    }
                } catch (Exception $e) {
                    //echo 'Message3: ' .$e->getMessage();
                    CakeLog::write('error', $e->getMessage());
                    $this->redirect(array('controller' => 'front', 'action' => 'sorry'));
                }
            } else { // after verification voucher code landed here
            }
        } else {
            //throw new NotFoundException('Could not find that page');
            $this->redirect(array('controller' => 'front', 'action' => 'jagojek_daftar'));
        }
    }

//end jaga aman gojek isi
//init jaga aman gojek selesai
    public function jagojek_selesai() {
        $this->layout = 'jagojek';

        if ($this->Session->check('jagojek')) {
            $this->Session->delete('jagojek');
        } else {
            $this->redirect(array('controller' => 'front', 'action' => 'jagojek_daftar'));
        }
    }

//end jaga aman gojek selesai

    public function check_email_jab() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {

            try {
                $email = $this->request->query['email'];
                $cek = $this->ApiXml->cekEmailGojek($email);
                if (!empty($cek['CPolicyJaber'])) {
                    //var_dump($cek);
                    if (!empty($cek['CPolicyJaber']['Status'])) {
                        if ($cek['CPolicyJaber']['Status'] == 1) {//holder
                            echo "1";
                        }
                        echo "0";
                    } else {
                        if ($cek['CPolicyJaber'][0]['Status'] == 1 || $cek['CPolicyJaber'][1]['Status'] == 1) {//holder
                            echo "1";
                        } else
                            echo "0";
                    }
                }else {
                    echo "0";
                }
                //$this->Session->write('cek', $cek);
            } catch (Exception $e) {
                CakeLog::write('error', $e);
                //echo $e;
                $cek = null;
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    /* ===============================================================
      end
      microsite jaber - gojek 2017
      author : Samuel a.k.a Jojo

      =================================================================
     */





    /* ===================================================================================
     *
     * 	SETUP JAGAMOTORKU (JMK) - BY JOJO
     * 	GO LIVE 3 OKT 2017
     * 	INITIAL
     *
     * ===================================================================================== */

    public function step1_add_ah($name = "") {

        // $sid = $this->request->query['sid'];
        //$cat = $this->request->query['cat'];
        //if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Ahliwaris']['hubungan'] = $this->ApiXml->getRelationAHListById($this->request->data['Ahliwaris']['RELATIONSHIP_ID']);
            $aw = $this->request->data['Ahliwaris'];
            if (null == ($this->Session->read('Purchase.Ahliwaris.1'))) {
                $this->Session->write('Purchase.Ahliwaris.1', $aw);
            } elseif (null == ($this->Session->read('Purchase.Ahliwaris.2'))) {
                $this->Session->write('Purchase.Ahliwaris.2', $aw);
            } elseif (null == ($this->Session->read('Purchase.Ahliwaris.3'))) {
                $this->Session->write('Purchase.Ahliwaris.3', $aw);
            } elseif (null == ($this->Session->read('Purchase.Ahliwaris.4'))) {
                $this->Session->write('Purchase.Ahliwaris.4', $aw);
            } elseif (null == ($this->Session->read('Purchase.Ahliwaris.5'))) {
                $this->Session->write('Purchase.Ahliwaris.5', $aw);
            }
            //$this->redirect(array('controller' => 'front', 'action' => 'get-a-quote-non-unit-link', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
            $this->redirect(array('controller' => 'front', 'action' => 'step1_non_unitlink', 'id' => "jaga-motorku"));
            //$this->redirect(array('controller' => 'front', 'action' => 'get-a-quote-non-unit-link', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
            //$this->redirect( Router::url( $this->referer(), true ) );
        }

        //} else {
        //    $this->redirect("/");
        //}
    }

    public function step1_del_aw($name = "") {
//        $sid = $this->request->query['sid'];
//        $cat = $this->request->query['cat'];
//        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
        $this->Session->delete('Purchase.Ahliwaris.' . $this->request->query['id']);
        $temp = $this->Session->read('Purchase.Ahliwaris');
        $i = 1;
        $n = 1;
        while ($i <= 5) {
            if (isset($temp[$i])) {
                $newData[$n] = $temp[$i];
                $n++;
            }
            $i++;
        }
        $this->Session->delete('Purchase.Ahliwaris');
        $this->Session->write('Purchase.Ahliwaris', $newData);
        $this->redirect(array('controller' => 'front', 'action' => 'step1_non_unitlink', 'id' => "jaga-motorku"));
//            $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail','id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
//        } else {
//            $this->redirect("/");
//        }
    }

    Public function ajax_kota($id = 0) {
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $cov = $this->ApiXml->getKota($id);
            $i = 0;
            echo "<option value=\"\">Kota</option>";
            if ($cov != null) {
                if (isset($cov[0])) {
                    while ($i < count($cov)) {
                        echo "<option value=\"" . $cov[$i]['Code'] . "\">" . $cov[$i]['Description'] . "</option>";
                        $i++;
                    }
                } else {
                    echo "<option value=\"" . $cov['Code'] . "\">" . $cov['Description'] . "</option>";
                }
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    Public function ajax_kecamatan($id = 0, $fk = 0) {
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $id = $this->request->query['id'];
            $fk = $this->request->query['fk'];
            $cov = $this->ApiXml->getKecamatan($id, $fk);
            $i = 0;
            echo "<option value=\"\">Kecamatan</option>";
            if ($cov != null) {
                if (isset($cov[0])) {
                    while ($i < count($cov)) {
                        echo "<option value=\"" . $cov[$i]['Code'] . "\">" . $cov[$i]['Description'] . "</option>";
                        $i++;
                    }
                } else {
                    echo "<option value=\"" . $cov['Code'] . "\">" . $cov['Description'] . "</option>";
                }
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    Public function ajax_kelurahan($id = 0, $fk = 0, $kec = 0) {
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $id = $this->request->query['id'];
            $fk = $this->request->query['fk'];
            $kec = $this->request->query['kec'];
            $cov = $this->ApiXml->getKelurahan($id, $fk, $kec);
            $i = 0;
            echo "<option value=\"\">Kelurahan</option>";
            if ($cov != null) {
                if (isset($cov[0])) {
                    while ($i < count($cov)) {
                        echo "<option value=\"" . $cov[$i]['Code'] . "\">" . $cov[$i]['Description'] . "</option>";
                        $i++;
                    }
                } else {
                    echo "<option value=\"" . $cov['Code'] . "\">" . $cov['Description'] . "</option>";
                }
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    Public function ajax_typeMotor($id = 0) {
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $cov = $this->ApiXml->getJMKSeries($id);
            $i = 0;
            echo "<option value=\"\">Type</option>";
            if ($cov != null) {
                if (isset($cov[0])) {
                    while ($i < count($cov)) {
                        echo "<option value=\"" . $cov[$i]['VehicleTypeDetailID'] . "\">" . $cov[$i]['VehicleSeries'] . "</option>";
                        $i++;
                    }
                } else {
                    echo "<option value=\"" . $cov['VehicleTypeDetailID'] . "\">" . $cov['VehicleSeries'] . "</option>";
                }
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function jmk_cal_non_unitlink_ajax() {
        $this->layout = "ajax";
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $data = $this->request->data['Personal'];
            //$up = preg_replace("/[^0-9]/", "", $data['SUM_INSURED']);
            //if($data['QUOTE_PREMIUM_MODE']!=12){
            //    $premium = $this->ApiXml->getPremiumRateJMK($data['COVERAGE_TYPE_ID_1'], $data['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($data['PROSPECT_DOB2']), $data['PROSPECT_GENDER2'], isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 1, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0,  isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0,  '6.25');
            //	$coverage = $this->ApiXml->getCoverageJMK($data['COVERAGE_TYPE_ID_1'],$data['PROSPECT_GENDER2'],'6.25');
            //}else{
            $premium = $this->ApiXml->getPremiumRateJMK($data['COVERAGE_TYPE_ID_1'], $data['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($data['PROSPECT_DOB2']), $data['PROSPECT_GENDER2'], isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 1, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0, isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0, '165');
            $coverage = $this->ApiXml->getCoverageJMK($data['COVERAGE_TYPE_ID_1'], $data['PROSPECT_GENDER2'], '165');

            //}
            //$coverage = $this->ApiXml->getCoverageJMK($data['COVERAGE_TYPE_ID_1'],$data['PROSPECT_GENDER2']);

            if ($data['PROSPECT_REQ_BUKU'] == 'Y') {
                $premium += 50000;
            }
            $this->Session->write('Purchase.premi', array('mode' => $data['QUOTE_PREMIUM_MODE'], 'total_premi' => round($premium, 0), 'frek' => $this->ApiXml->dataPremimode($data['QUOTE_PREMIUM_MODE'])));


            $plat = $this->ApiXml->getJMKPlate();


            $plad_a = $plat[$data['NOPOL_A']];
            $nopol = $plad_a . ' ' . $data['NOPOL_B'] . ' ' . $data['NOPOL_C'];

            $provinsi = $this->ApiXml->getProvinsi();

            $ph_provinsi_desc = $provinsi[$data['PROSPECT_PROVINSI']];
            $ph_kota = $this->ApiXml->getKotaOpt($ph_provinsi_desc);
            $ph_kota_desc = $ph_kota[$data['PROSPECT_KOTA']];
            $ph_kec = $this->ApiXml->getKecamatanOpt($ph_provinsi_desc, $ph_kota_desc);
            $ph_kec_desc = $ph_kec[$data['PROSPECT_KEC']];
            $ph_kel = $this->ApiXml->getKelurahanOpt($ph_provinsi_desc, $ph_kota_desc, $ph_kec_desc);
            $ph_kel_desc = $ph_kel[$data['PROSPECT_KEL']];
            $ph_region = $this->ApiXml->getRegionOpt($ph_provinsi_desc, $ph_kota_desc, $ph_kec_desc, $ph_kel_desc);

            $kor_provinsi_desc = $provinsi[$data['KORESPONDENSI_PROVINSI']];
            $kor_kota = $this->ApiXml->getKotaOpt($ph_provinsi_desc);
            $kor_kota_desc = $kor_kota[$data['KORESPONDENSI_KOTA']];
            $kor_kec = $this->ApiXml->getKecamatanOpt($kor_provinsi_desc, $kor_kota_desc);
            $kor_kec_desc = $kor_kec[$data['KORESPONDENSI_KEC']];
            $kor_kel = $this->ApiXml->getKelurahanOpt($kor_provinsi_desc, $kor_kota_desc, $kor_kec_desc);
            $kor_kel_desc = $kor_kel[$data['KORESPONDENSI_KEL']];
            $kor_region = $this->ApiXml->getRegionOpt($kor_provinsi_desc, $kor_kota_desc, $kor_kec_desc, $kor_kel_desc);

            $insured_provinsi_desc = $provinsi[$data['PROSPECT_PROVINSI2']];
            $insured_kota = $this->ApiXml->getKotaOpt($insured_provinsi_desc);
            $insured_kota_desc = $insured_kota[$data['PROSPECT_KOTA2']];
            $insured_kec = $this->ApiXml->getKecamatanOpt($insured_provinsi_desc, $insured_kota_desc);
            $insured_kec_desc = $insured_kec[$data['PROSPECT_KEC2']];
            $insured_kel = $this->ApiXml->getKelurahanOpt($insured_provinsi_desc, $insured_kota_desc, $insured_kec_desc);
            $insured_kel_desc = $insured_kel[$data['PROSPECT_KEL2']];
            $insured_region = $this->ApiXml->getRegionOpt($insured_provinsi_desc, $insured_kota_desc, $insured_kec_desc, $insured_kel_desc);


            $this->Session->write('Purchase.step1', array(
                'product_id' => $data['product_id'],
                'PROSPECT_KTP' => $data['PROSPECT_KTP'],
                'PROSPECT_NAME' => $data['PROSPECT_NAME'],
                'PROSPECT_DOB' => $data['PROSPECT_DOB'],
                'PROSPECT_GENDER' => $data['PROSPECT_GENDER'],
                'PROSPECT_ADDRESS' => $data['PROSPECT_ADDRESS'],
                'PROSPECT_PROVINSI' => $data['PROSPECT_PROVINSI'],
                'PROSPECT_KOTA' => $data['PROSPECT_KOTA'],
                'PROSPECT_KEC' => $data['PROSPECT_KEC'],
                'PROSPECT_KEL' => $data['PROSPECT_KEL'],
                'PROSPECT_EMAIL' => $data['PROSPECT_EMAIL'],
                'PROSPECT_MOBILE_PHONE' => $data['PROSPECT_MOBILE_PHONE'],
                'PROSPECT_REQ_BUKU' => $data['PROSPECT_REQ_BUKU'],
                'HARD_COPY' => $data['PROSPECT_REQ_BUKU'],
                'PROSPECT_KORESPONDENSI' => $data['PROSPECT_KORESPONDENSI'],
                'KORESPONDENSI_ADDRESS' => $data['KORESPONDENSI_ADDRESS'],
                'KORESPONDENSI_PROVINSI' => $data['KORESPONDENSI_PROVINSI'],
                'KORESPONDENSI_KOTA' => $data['KORESPONDENSI_KOTA'],
                'KORESPONDENSI_KEC' => $data['KORESPONDENSI_KEC'],
                'KORESPONDENSI_KEL' => $data['KORESPONDENSI_KEL'],
                'PROSPECT_PEMILIK' => $data['PROSPECT_PEMILIK'],
                'PROSPECT_NAME_PEMILIK' => $data['PROSPECT_NAME_PEMILIK'],
                'PROSPECT_KTP_PEMILIK' => $data['PROSPECT_KTP_PEMILIK'],
                'PROSPECT_DOB2' => $data['PROSPECT_DOB2'],
                'PROSPECT_GENDER2' => $data['PROSPECT_GENDER2'],
                'RELATIONSHIP_ID' => $data['RELATIONSHIP_ID'],
                'PROSPECT_ADDRESS2' => $data['PROSPECT_ADDRESS2'],
                'PROSPECT_PROVINSI2' => $data['PROSPECT_PROVINSI2'],
                'PROSPECT_KOTA2' => $data['PROSPECT_KOTA2'],
                'PROSPECT_KEC2' => $data['PROSPECT_KEC2'],
                'PROSPECT_KEL2' => $data['PROSPECT_KEL2'],
                'MEREK_MOTOR' => $data['MEREK_MOTOR'],
                'TYPE_MOTOR' => $data['TYPE_MOTOR'],
                'TAHUN_MOTOR' => $data['TAHUN_MOTOR'],
                'NO_RANGKA_MESIN' => $data['NO_RANGKA_MESIN'],
                'MOTOR_NO_MESIN' => $data['NO_MESIN'],
                'NO_MESIN' => $data['NO_MESIN'],
                'NOPOL_A' => $data['NOPOL_A'],
                'NOPOL_B' => $data['NOPOL_B'],
                'NOPOL_C' => $data['NOPOL_C'],
                'motor_nopol' => $nopol,
                'PROSPECT_STNK' => $data['PROSPECT_STNK'],
                'PROSPECT_NAMA_STNK' => $data['PROSPECT_NAMA_STNK']
            ));

            $this->Session->write('Purchase.step2', array(
                'PROSPECT_NRIC' => $data['PROSPECT_KTP'],
                'PROSPECT_NAME' => $data['PROSPECT_NAME'],
                'PROSPECT_DOB' => $data['PROSPECT_DOB'],
                'PROSPECT_GENDER' => $data['PROSPECT_GENDER'],
                'PROSPECT_ADDRESS' => $data['PROSPECT_ADDRESS'],
                'PROSPECT_EMAIL' => $data['PROSPECT_EMAIL'],
                'PROSPECT_MOBILE_PHONE' => $data['PROSPECT_MOBILE_PHONE'],
            ));

            $this->Session->write('Purchase.jmk', array(
                'product_id' => $data['product_id'],
                'ph_ktp' => $data['PROSPECT_KTP'],
                'ph_name' => $data['PROSPECT_NAME'],
                'ph_dob' => $data['PROSPECT_DOB'],
                'ph_gender' => $data['PROSPECT_GENDER'],
                'ph_address' => $data['PROSPECT_ADDRESS'],
                'ph_provinsi' => $data['PROSPECT_PROVINSI'],
                'ph_kota' => $data['PROSPECT_KOTA'],
                'ph_kec' => $data['PROSPECT_KEC'],
                'ph_kel' => $data['PROSPECT_KEL'],
                'ph_region' => $ph_region,
                'ph_email' => $data['PROSPECT_EMAIL'],
                'ph_nohp' => $data['PROSPECT_MOBILE_PHONE'],
                'ph_reqbook' => $data['PROSPECT_REQ_BUKU'],
                'ph_alamatbukusama' => $data['PROSPECT_KORESPONDENSI'],
                'ph_nohp' => $data['PROSPECT_MOBILE_PHONE'],
                'ph_reqbook' => $data['PROSPECT_REQ_BUKU'],
                'kirimbuku_alamatbukusama' => $data['PROSPECT_KORESPONDENSI'],
                'kirimbuku_alamatbuku' => $data['KORESPONDENSI_ADDRESS'],
                'kirimbuku_provinsi' => $data['KORESPONDENSI_PROVINSI'],
                'kirimbuku_kota' => $data['KORESPONDENSI_KOTA'],
                'kirimbuku_kec' => $data['KORESPONDENSI_KEC'],
                'kirimbuku_kel' => $data['KORESPONDENSI_KEL'],
                'kirimbuku_region' => $kor_region,
                'ph_pemilik' => $data['PROSPECT_PEMILIK'],
                'insured_name' => $data['PROSPECT_NAME_PEMILIK'],
                'insured_ktp' => $data['PROSPECT_KTP_PEMILIK'],
                'insured_dob' => $data['PROSPECT_DOB2'],
                'insured_gender' => $data['PROSPECT_GENDER2'],
                'insured_relasi' => $data['RELATIONSHIP_ID'],
                'insured_address' => $data['PROSPECT_ADDRESS2'],
                'insured_provinsi' => $data['PROSPECT_PROVINSI2'],
                'insured_kota' => $data['PROSPECT_KOTA2'],
                'insured_kec' => $data['PROSPECT_KEC2'],
                'insured_kel' => $data['PROSPECT_KEL2'],
                'insured_region' => $insured_region,
                'motor_brand' => $data['MEREK_MOTOR'],
                'motor_type' => $data['TYPE_MOTOR'],
                'motor_tahun' => $data['TAHUN_MOTOR'],
                'motor_no_rangka' => $data['NO_RANGKA_MESIN'],
                'motor_no_mesin' => $data['NO_MESIN'],
                'motor_nopol_id' => $data['NOPOL_A'],
                'motor_nopol' => $nopol,
                'motor_stnk' => $data['PROSPECT_STNK'],
                'motor_nama_stnk' => $data['PROSPECT_NAMA_STNK']
            ));

            /*
              $this->Session->write('Purchase.step2',
              array(
              'PROSPECT_NRIC' => $data['PROSPECT_KTP'],
              'PROSPECT_NAME' => $data['PROSPECT_NAME'],
              'PROSPECT_DOB' => $data['PROSPECT_DOB'],
              'PROSPECT_GENDER' => $data['PROSPECT_GENDER'],
              'PROSPECT_ADDRESS' => $data['PROSPECT_ADDRESS'],
              'PROSPECT_EMAIL' => $data['PROSPECT_EMAIL'],
              'PROSPECT_MOBILE_PHONE' => $data['PROSPECT_MOBILE_PHONE'],
              ));
             */


            $this->set(compact('data', 'coverage', 'premium', 'cashlessFee'));
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function jmk_cek_SI() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('post') && $this->request->is('ajax')) {

            //$data = $this->Session->read('Purchase.step1');
            try {
                //$rangka = $this->request->query['rangka'];
                //$plata = $this->request->query['plata'];
                //$platb = $this->request->query['platb'];
                //$platc = $this->request->query['platc'];
                //$merek = $this->request->query['merek'];


                $rangka = $_REQUEST['rangka'];
                $plata = $_REQUEST['plata'];
                $platb = $_REQUEST['platb'];
                $platc = $_REQUEST['platc'];
                $merek = $_REQUEST['merek'];


                //$plat =  $plata.' '. $platb.' '. $platc;
                $nopol = $this->ApiXml->getJMKPlate();


                $plat_a = $nopol[$plata];
                $plat = $plat_a . ' ' . $platb . ' ' . $platc;

                //$cek=$this->ApiXml->cekOversumJMK($data['NO_RANGKA_MESIN'],$data['motor_nopol'],$data['TYPE_MOTOR']);
                $cek = $this->ApiXml->cekOversumJMK(strtoupper($rangka), $plat, $merek);
                //var_dump($cek);
                //if(isset($cek) && empty($cek)){
                //var_dump( count($cek) );
                if ($cek) {
                    if (count($cek) <= 2) {
                        echo '1';
                    } else {
                        echo '0';
                    }
                } else {
                    echo '0';
                }
            } catch (Exception $e) {
                //  echo 'Message: ' .$e->getMessage();
                CakeLog::write('error', $e);
            }
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function check_email_jmk() { //jmk cek duplicate email + BL
        $this->autoRender = false;
        $this->layout = "ajax";
        //if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
        if ($this->request->is('ajax')) {
            $email = $this->request->query['email'];
            $name = $this->request->query['name'];
            $dob = $this->request->query['dob'];
            $gender = $this->request->query['gender'];
            //$data = $this->Session->read('Purchase.step1');
            //$id_prospect = $this->ApiXml->saveProspect($email, $name, $data['PROSPECT_DOB'], $data['PROSPECT_GENDER']);
            //$IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($name,$data['PROSPECT_DOB']);

            $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($name, $dob);
            if ($IsExistCustomerBlackList == "True") {
                echo '2';
            } else {
                $id_prospect = $this->ApiXml->saveProspect($email, $name, $dob, $gender);

                if (is_numeric($id_prospect)) {
                    echo "1";
                } else {
                    echo "0";
                }
            }
        } else {
            throw new NotFoundException('Could not find that page');
        }
    }

    public function check_email_jmk_OLD() { //jmk cek duplicate email + BL
        $this->autoRender = false;
        $this->layout = "ajax";
        //if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
        if ($this->request->is('ajax')) {
            $email = $this->request->query['email'];
            $name = $this->request->query['name'];
            $data = $this->Session->read('Purchase.step1');
            $id_prospect = $this->ApiXml->saveProspect($email, $name, $data['PROSPECT_DOB'], $data['PROSPECT_GENDER']);

            $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($name, $data['PROSPECT_DOB']);
            if ($IsExistCustomerBlackList == "True")
                echo '2';
            else if (is_numeric($id_prospect))
                echo "1";
            else
                echo "0";
        } else
            throw new NotFoundException('Could not find that page');
    }

    /*
      public function promo_kodevoucherJMK()
      { //jmk promo free 100 polis - soft lauching
      $this->autoRender = false;
      $this->layout = "ajax";
      //if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
      if ($this->request->is('ajax') ) {
      $kv = $this->request->query['kodevoucher'];

      $db = ConnectionManager::getDataSource('default');
      // $query_find= $db->fetchAll("SELECT * FROM `aq_promo_jmk` WHERE kode_voucher ='$kodev' " );
      //$query_find= $db->fetchAll("SELECT v.`id_voucher`, v.`kode_voucher`, v.`start_date`, v.`expired_date`,v.`flag_use` FROM `aq_promo_jmk` v");

      $name = $this->request->query['name'];
      $data = $this->Session->read('Purchase.step1');
      $id_prospect = $this->ApiXml->saveProspect($email, $name, $data['PROSPECT_DOB'], $data['PROSPECT_GENDER']);

      $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($name,$data['PROSPECT_DOB']);
      if ($IsExistCustomerBlackList=="True")
      echo '2';
      else if (is_numeric($id_prospect))
      echo "1";
      else
      echo "0";

      } else
      throw new NotFoundException('Could not find that page');
      }
     */

    /*
      public function jmk_input_vocuher()
      {


      if ($this->request->is('post')) {
      if (!empty($this->request->data['promo_jmk']['voucherCode']))
      {

      try {
      // $id = $this->ApiXml->updateShortTermPolicyCC($this->Session->read('Purchase.idPolicy'), $this->request->data, $this->Session->read('Purchase.CC.transactionDate'));
      $kodev=$this->request->data['promo_jmk']['voucherCode'];
      //cek ke db
      $db = ConnectionManager::getDataSource('default');
      // $query_find= $db->fetchAll("SELECT * FROM `aq_jab_gojek_voucher` WHERE kode_voucher ='$kodev' " );
      $query_find= $db->fetchAll("SELECT v.`id_voucher`, v.`kode_voucher`, v.`start_date`, v.`expired_date`,v.`flag_use` FROM `aq_promo_jmk` v WHERE  v.`kode_voucher` ='$kodev' ");

      //var_dump($query_find);



      // //validasi evoucher valid / tidak
      if($query_find){
      //kode voucher benar
      if($query_find[0]['aq_promo_jmk']['tanggal_selesai']> date('Y-m-d H:i:s')){// cek exp date
      $this->Session->setFlash(__('kode voucher anda sudah kadaluarsa'));
      }else if($query_find[0]['aq_promo_jmk']['flag_use']==1){//cek udh pake / belum
      $this->Session->setFlash(__('kode voucher anda sudah sudah terpakai'));
      }else{//kode voucher ok
      //$this->Session->setFlash(__('selamat anda berhak lanjut ke step berikutnya'));
      $this->Session->write('voucher_jmk.id', $query_find[0]['aq_promo_jmk']['id_voucher'] );
      $this->Session->write('voucher_jmk.code', $query_find[0]['aq_promo_jmk']['kode_voucher'] );

      $db = ConnectionManager::getDataSource('default');
      $dtime = date('Y-m-d H:i:s');
      $whois ='SYSTEM BOOKING free 100 voucher jagamotorku';
      $ipaddress = $this->request->clientIp();
      $visitor_user_agent=$_SERVER['HTTP_USER_AGENT'];
      $idvoucher=$this->Session->read('jagojek.id');

      $query_update = $db->fetchAll("UPDATE `aq_promo_jmk` SET `flag_use`=1 , `updated_date`='$dtime', `update_by`='$whois' WHERE `id_voucher`='$idvoucher'");
      $query_log = $db->fetchAll('INSERT INTO `aq_promo_jmk_log`( id_voucher, log_date, log_by, description, remark, last_update, ip, agent ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)', array($idvoucher, $dtime, $whois, 'Booking', 'Progress', $dtime, $ipaddress, $visitor_user_agent ));


      $this->redirect(array('controller'=>'front','action'=>'/'));
      }
      }else{
      //kode voucher palsu
      $this->Session->setFlash(__('kode voucher anda tidak valid'));
      }
     */

//                 // //validasi evoucher valid / tidak 
//                 // if($query_find){
//                 //     //kode voucher benar
//                 //     if($query_find[0]['aq_jab_gojek_voucher']['tanggal_selesai']< date('Y-m-d H:i:s')){// cek exp date
//                 //         $this->Session->setFlash(__('kode voucher anda sudah kadaluarsa'));
//                 //     }else if($query_find[0]['aq_jab_gojek_voucher']['flag_use']==1){//cek udh pake / belum
//                 //         $this->Session->setFlash(__('kode voucher anda sudah sudah terpakai'));
//                 //     }else{//kode voucher ok
//                 //         //$this->Session->setFlash(__('selamat anda berhak lanjut ke step berikutnya'));
//                 //             $this->Session->write('jagojek.id', $query_find[0]['aq_jab_gojek_voucher']['id_voucher'] );
//                 //             $this->Session->write('jagojek.code', $query_find[0]['aq_jab_gojek_voucher']['kode_voucher'] );
//                 //         $db = ConnectionManager::getDataSource('default');
//                 //         $dtime = date('Y-m-d H:i:s');
//                 //         $whois ='SYSTEM BOOKING MICROSITE GOJEK';
//                 //             $ipaddress = $this->request->clientIp();
//                 //         $visitor_user_agent=$_SERVER['HTTP_USER_AGENT'];
//                 //         $idvoucher=$this->Session->read('jagojek.id');
//                 //         $query_update = $db->fetchAll("UPDATE `aq_jab_gojek_voucher` SET `flag_use`=0 , `last_update`='$dtime', `update_by`='$whois' WHERE `id_voucher`='$idvoucher'");
//                 //         $query_log = $db->fetchAll('INSERT INTO `aq_jab_gojek_voucher_log`( id_voucher, log_date, log_by, description, remark, last_update, ip, agent ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)', array($idvoucher, $dtime, $whois, 'Booking', 'Progress', $dtime, $ipaddress, $visitor_user_agent ));
//                 //         $this->redirect(array('controller'=>'front','action'=>'jagojek_isi'));        
//                 //     }
//                 // }else{
//                 // //kode voucher palsu
//                 //     $this->Session->setFlash(__('kode voucher anda tidak valid'));
//                 // }
//             } catch (Exception $e) {
//                  CakeLog::write('error', $e->getMessage());        
//             }
//         }else{
//         $this->Session->setFlash(__('Mohon isi kode voucher!'));
//         }
//     }//klo req tidak post
//    }



    /* ===================================================================================
     *
     * 	SETUP JAGAMOTORKU - BY JOJO
     * 	GO LIVE 3 OKT 2017
     * 	ENDING
     *
     * ===================================================================================== */


//init preview
    public function preview($file = '') {
        $url = APP . 'files' . DS . $file;
        $ext = substr($file, -4, 4);
        $name = substr($file, 0, -4);
        if (file_exists($url)) {
            $this->viewClass = 'Media';
            $this->autoRender = true;
            $params = array(
                'download' => false,
                'id' => $file,
                'name' => $name,
                'extension' => $ext,
                'path' => APP . 'files' . DS
            );
            $this->set($params);
        } else
            throw new NotFoundException('Could not find that page');
    }

//end preview
//init list rekanan
    public function list_preview() {
        
    }

//end list rekanan
//init klaim
    public function klaim() {
        
    }

//end klaim
//init promo
    public function promo() {
        
    }

//end promo
//init mom n jo 16 mei 17
    public function mom_n_jo_mei17() {
        
    }

//end mom n jo 16 mei 17
//init petunjuk go point
    public function gopoint() {
        
    }

//end petunjuk go point
//init undermaintanance
    public function undermaintanance() {
        
    }

//end undermaintanance
}

//class closure

