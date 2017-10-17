<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class FrontController extends AppController {

    public $uses = array('Survey', 'ApiXml', 'User', 'Product', 'News', 'MetaTitle', 'sendEmail', 'Val', 'Black', 'Banner', 'Quotejai', 'Payment', 'JadwalPray', 'Promo', 'Rawat', 'SurveyVisitor', 'Linequiz');
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
        $this->Security->csrfExpires = '+10 hour';
        $this->Auth->allow();
        $_metaTitle = $this->MetaTitle->getMeta($this->params['action']);
        if (!$this->Auth->loggedIn())
            $this->Auth->deny('premium_payment', 'claim');  //action apa saja yang harus login terlebih dahulu
        $this->Security->unlockedActions = array('response_creditcard', 'response_purchase', 'response_premi', 'response_creditcard_premi', 'ajax_getCoveragePolicy', 'form_promotion');
        $this->layout = 'front';

        if ($this->Session->read('Auth.User.role') == 'admin')
            $this->redirect(array('controller' => 'adm', 'action' => 'logout'));

        $_menu['accidental'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 1, 'Product.quote_id !=' => 'jaga-aman-plus7', 'Product.publish' => 1)));
        $_menu['life'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 2, 'Product.quote_id !=' => 'jaga-jiwa-plus7', 'Product.publish' => 1)));
        $_menu['health'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 3, 'Product.publish' => 1)));
        $_menu['unitlink'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 4, 'Product.publish' => 1)));
        $_menu['general'] = $this->Product->find('all', array('fields' => array('seo', 'name'), 'conditions' => array('Product.category_id' => 5, 'Product.publish' => 1)));

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
            $this->ApiXml->pushCTS($data['contact_name'], $data['contact_phone'], 'Gmail Sponsored Promotions', '');
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

    public function response_creditcard() {
        $this->disableCache();
        if ($this->request->is('post') && $this->Session->read('Purchase.prod') != null) {
            
            if ($this->Session->read('Purchase.id_CC') == 'J') { // JAI
                try {
                    $id = $this->ApiXml->updateShortTermPolicyCC($this->Session->read('Purchase.idPolicy'), $this->request->data, $this->Session->read('Purchase.CC.transactionDate'));
                    CakeLog::write('visamaster', "[merchantTransactionID] " . $this->request->data['merchantTransactionID'] . " [idPolicy] " . $this->Session->read('Purchase.idPolicy') . " [transactionStatus] " . $this->request->data['transactionStatus'] . " [APIResponse] " . $id);
                } catch (Exception $e) {
                    CakeLog::write('visamaster', "[merchantTransactionID]: " . $this->request->data['merchantTransactionID'] . " [idPolicy] " . $this->Session->read('Purchase.idPolicy') . " [transactionStatus] " . $this->request->data['transactionStatus'] . " [APIResponse] " . $id . " [Error]" . $e);
                }
            } 
            else {
            try {
                $id=$this->ApiXml->updatePaymentCreditCard($this->request->data);
                CakeLog::write('visamaster', "[merchantTransactionID] " .$this->request->data['merchantTransactionID']. " [transactionStatus] " .$this->request->data['transactionStatus']. " [APIResponse] ". $id);
            }
            catch (Exception $e) {
                CakeLog::write('visamaster', "[merchantTransactionID]: " .$this->request->data['merchantTransactionID']. " [transactionStatus] " .$this->request->data['transactionStatus']. " [APIResponse] ". $id . "[Error]". $e);
            }
        }

            $status = $this->request->data['transactionStatus'];
            if ($status == 'PENDING') {
                $status = 'Pending';
            } else if ($status == 'APPROVED') {
                $status = 'Berhasil';
                $this->Session->delete('Purchase.flow');
                $this->Session->delete('Purchase.step1');
                $this->Session->delete('Purchase.step2');
                $this->Session->delete('Purchase.token');
            } else {
                //$status='Gagal';
                $status = 'Belum Berhasil';
            }
            $ctthankspurchase = '1';
            $prod = $this->Session->read('Purchase.prod');
            $this->Session->delete('Purchase.prod');
            $this->set(compact('status', 'ctthankspurchase', 'prod'));
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

                if ($data['PROSPECT_DOB2']=="") {
                    $umurtertua = $this->ApiXml->getAge($data['PROSPECT_DOB']);
                    $_SESSION['qtytertanggung'] = 1;    
                    $gender = $data['PROSPECT_GENDER'];
                    $_SESSION['PROSPECT_DOB2_FOR_ENTRY'] = ""; //jika dob spouse tidak keisi maka tidak muncul di add tertanggung

                    // Hitung Premi berdasarkan usia tertua tertanggung utama
                    $premium = $this->ApiXml->getPremiumRate($data['COVERAGE_TYPE_ID'], $data['QUOTE_PREMIUM_MODE'], $umurtertua,$gender, isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0, $up, isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0);
                }
                else {
                    if ($this->ApiXml->getAge($data['PROSPECT_DOB']) > $this->ApiXml->getAge($data['PROSPECT_DOB2'])) {
                        $umurtertua = $this->ApiXml->getAge($data['PROSPECT_DOB']);
                        $_SESSION['qtytertanggung'] = 2;
                        $gender = $data['PROSPECT_GENDER'];
                        $_SESSION['PROSPECT_DOB2_FOR_ENTRY'] = $data['PROSPECT_DOB2'];
                        $_SESSION['PROSPECT_GENDER2'] = $data['PROSPECT_GENDER2'];
                    }else{
                        $umurtertua = $this->ApiXml->getAge($data['PROSPECT_DOB2']);
                        $_SESSION['qtytertanggung'] = 2;
                        $gender = $data['PROSPECT_GENDER2'];
                        $_SESSION['PROSPECT_DOB2_FOR_ENTRY'] = $data['PROSPECT_DOB2'];
                        $_SESSION['PROSPECT_GENDER2'] = $data['PROSPECT_GENDER2'];
                    }
                    $premium = $this->ApiXml->getPremiumRate($data['COVERAGE_TYPE_ID'], $data['QUOTE_PREMIUM_MODE'], $umurtertua,$gender, isset($data['QUOTE_PREMIUM_LIFESPAN']) ? $data['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($data['QUOTE_DURATION_DAYS']) ? $data['QUOTE_DURATION_DAYS'] : 0, $up, isset($data['QUOTE_DURATION_HOUR']) ? $data['QUOTE_DURATION_HOUR'] : 0);
                        $same_age = ($data['PROSPECT_DOB'] == $data['PROSPECT_DOB2'] ? 'Y' : 'N');
                }

                if ($data['QUOTE_PREMIUM_MODE'] == 12) { $this->Session->write('Purchase.step1', array('cashlessFee'=>$cashlessFee*12, 'sameAgeFlag'=>$same_age, 'premiTertua'=>$premium)); }
                elseif ($data['QUOTE_PREMIUM_MODE'] == 1) { $this->Session->write('Purchase.step1', array('cashlessFee'=>$cashlessFee, 'sameAgeFlag'=>$same_age, 'premiTertua'=>$premium)); }

            }
            else {
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

    public function check_email() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax') && $this->Session->check('Purchase.premi')) {
            $email = $this->request->query['email'];
            $name = $this->request->query['name'];
            $data = $this->Session->read('Purchase.step1');
            $id_prospect = $this->ApiXml->saveProspect($email, $name, $data['PROSPECT_DOB'], $data['PROSPECT_GENDER']);
            if (is_numeric($id_prospect))
                echo "1";
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
                echo '1'; else
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

    public function checkAcumulation() {
        $this->autoRender = false;
        $this->layout = "ajax";
        if ($this->request->is('ajax')) {
            $cust_name = $this->request->query['cust_name'];
            $cust_dob = $this->request->query['cust_dob'];
            $cust_gender = $this->request->query['cust_gender'];
            $cust_benefitID = $this->request->query['cust_benefitID'];
            if ($cust_benefitID==2)
                $cust_benefitID=11;
            $getAcumulate = $this->ApiXml->getAcumulation($cust_name, $cust_dob, $cust_gender, $cust_benefitID);
            $total_insured = $this->Session->read('Purchase.step1.SUM_INSURED');
            if (isset($getAcumulate['CCustomerSumInsured'])) {
                $getAcumulate = $getAcumulate['CCustomerSumInsured'];
                //if (($getAcumulate['TotalSumInsured'] + $total_insured) > $getAcumulate['MaxSumInsured'])
                //echo "1";
                if (($getAcumulate['TotalSumInsured'] + $total_insured) > 900000 && ($cust_benefitID==2 || $cust_benefitID==11|| $cust_benefitID==23)) //maksimal 900000 untuk rumah sakit
                {
                    echo "0";
                }
                elseif (($getAcumulate['TotalSumInsured'] + $total_insured) > 5000000 && ($cust_benefitID==5)) //maksimal 5jt untuk DBD
                {
                    echo "0";
                }
                elseif (($getAcumulate['TotalSumInsured'] + $total_insured) > 100000000 && ($cust_benefitID==3)) //maksimal 100jt meninggal karena kecelakaan
                {
                    echo "0";
                }
                else
                {
                    echo "1";
                }
            } else
                echo "1";
        }
        else
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
            else {
                $this->Quotejai->getDataSource()->begin();
                $this->Quotejai->save();
                $this->Quotejai->getDataSource()->commit();
                $this->Session->write('Purchase.QUOTE_ID', 'J' . $this->Quotejai->id);
                $quote['QuoteNo'] = 'J' . $this->Quotejai->id;
            }
            $totalpremi = $this->Session->read('Purchase.premi.total_premi');
            $cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21)? $this->Session->read('Purchase.step1.cashlessFee') : 0 );
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
        } else
            throw new NotFoundException('Could not find that page');
    }

    //init cimb
        public function getCIMBtoken($name = '') {
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
            $totalpremi = $this->Session->read('Purchase.premi.total_premi');
            $cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21)? $this->Session->read('Purchase.step1.cashlessFee') : 0 );
            

         
            $miscFee = number_format(0, 2, '.', '');
           

            $merchantCode=$this->ApiXml->getConfig('merchantCode');
            $paymentId=7;
            $merchantKey=$this->ApiXml->getConfig('merchantKey');
            $totalAmount = $totalpremi + $cashlessFee;
            $totalAmount= $totalAmount.'00';
             $tmp_signature=  $merchantKey.$merchantCode.$paymentId.$refno.$totalAmount.'IDR'.'1';
            $signature=sha1($tmp_signature);

            $userName = $this->Session->read('Purchase.step2.PROSPECT_NAME');
            $userEmail = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
            $userContact = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');


            $transactionDate = date('d/m/Y H:i:s');
            $descp = 'CAF PREMI PERTAMA';
            $transactionDateCAF = date_format(date_create_from_format('d/m/Y H:i:s', $transactionDate), 'Y-m-d H:i:s');
            // $signature = floatval($this->ApiXml->getSignatureBCA($klikPayCode, $quote['QuoteNo'], 'IDR', $clearKey, $transactionDate, $totalAmount));
            $return_url = Router::url(array('controller' => 'front', 'action' => 'thanks_cimbclick', 'id' => $name), true);
            $backend_url= Router::url(array('controller' => 'front', 'action' => 'backend_cimb'), true);
            $tokCIMB = array('merchantCode' => $merchantCode, 'paymentId'=>$paymentId, 'refNo' => $quote['QuoteNo'], 'totalAmount' => $totalAmount, 'currency' => 'IDR', 'descp' => 'descp', 'userName' => $userName, 'userEmail' => $userEmail, 'userContact' => $userContact, 'remark' => $descp, 'signature' => $signature, 'responseUrl'=>$return_url , 'backendUrl'=>$backend_url);

            if ($this->Session->read('Purchase.step1.product_id') == 7) {
                $this->Payment->getDataSource()->begin();
                // $tokBCA['authKey'] = $this->ApiXml->getAuth($klikPayCode, $quote['QuoteNo'], 'IDR', $transactionDate, $clearKey);
                $this->Payment->save($tokCIMB);
                $this->Payment->getDataSource()->commit();
                $id_CIMB = $this->Payment->id;
                $idCustomer = $this->ApiXml->saveCustomer($this->Session->read('Purchase'));
                $idPolicy = $this->ApiXml->saveShortTermPolicy($idCustomer, $tokCIMB);
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
                $id_CIMB = 2;//$this->ApiXml->savePaymentCIMBClick($tokCIMB);
            }

            $tokCIMB['transactionDate'] = $transactionDate;

            if($this->Session->read('Purchase.step1.product_id')!=7) {$this->Session->delete('Purchase');}


            $this->Session->write('Purchase.id_CIMB', $id_CIMB);
            if (isset($idPolicy) && $idPolicy == "ERROR_ACCUMULATION_FAILED") {
                echo "1";
            } else {
                echo json_encode($tokCIMB, JSON_UNESCAPED_SLASHES);
            }
        } else
            throw new NotFoundException('Could not find that page');
    }
    //end cimb


    //backend cimb - start
    public function backend_cimb()
    {
        echo "OK";
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
            $cashlessFee = (($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.product_id') == 21)? $this->Session->read('Purchase.step1.cashlessFee') : 0 );

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
            $transactionType= "AUTHORIZATION";
            $ProfileCode = "A869FF2A-E63E-232D-F513D72FE093AE4D";
            $checkSum = md5($amount.$currency.$merchantTransactionID.$serviceVersion.$siteID.$soml.$transactionType.$ProfileCode);
            
            $tokCC = compact('amount', 'siteID', 'serviceVersion', 'currency', 'merchantTransactionID', 'merchantTransactionNote', 'userDefineValue', 'billingName', 'billingAddress', 'billingCity', 'billingState', 'billingPostalCode', 'billingCountry', 'billingPhone', 'billingEmail', 'deliveryName', 'deliveryAddress', 'deliveryCity', 'deliveryState', 'deliveryPostalCode', 'deliveryCountry','soml','MerchantProfileCode','checkSum');
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
            $checkSum = md5($amount.$currency.$merchantTransactionID.$serviceVersion.$siteID.$soml.$transactionType.$ProfileCode);
            
            $tokCC = compact('amount', 'siteID', 'serviceVersion', 'currency', 'merchantTransactionID', 'merchantTransactionNote', 'userDefineValue', 'billingName', 'billingAddress', 'billingCity', 'billingState', 'billingPostalCode', 'billingCountry', 'billingPhone', 'billingEmail', 'deliveryName', 'deliveryAddress', 'deliveryCity', 'deliveryState', 'deliveryPostalCode', 'deliveryCountry','soml','MerchantProfileCode','checkSum');
            $id_CC = $this->ApiXml->savePaymentVisaMasterPremi(array_merge($tokCC, array('ReceiptTransactionCode' => 'RP', 'DueDatePre' => $policy['PolicyDueDatePremium'], 'policy_no' => $id)));
            $this->Session->write('Purchase.polisNopremi', $id);
            $this->Session->write('Purchase.id_CC', $id_CC);
            echo json_encode($tokCC, JSON_UNESCAPED_SLASHES);
        } else
            throw new NotFoundException('Could not find that page');
    }

    public function thanks_klikpaybca($id = '') {
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
                }
                else
                    $status = $this->ApiXml->getPaymentKlikBCAPremi($this->Session->read('Purchase.id_BCApremi'));

                if ($status['reason_id'] == '1') {
                    $this->Session->delete('Purchase.flow');
                    $this->Session->delete('Purchase.step1');
                    $this->Session->delete('Purchase.step2');
                    $this->Session->delete('Purchase.token');
                }
            } catch (Exception $e) {
                CakeLog::write('error', $e);
                $status = 'Gagal';
            }
            $this->Session->delete('Purchase.id_BCA');
            $this->Session->delete('Purchase.id_BCApremi');
            $prod = strtoupper(str_replace('-', ' ', $id));
            $ctthankspurchase = '1';
            $this->set(compact('status', 'ctthankspurchase', 'prod'));
        } 
        // else
            //$this->redirect("/");
    }

     public function thanks_cimbclick($id = '') {
        // if ($this->Session->check('Purchase.id_CIMB') || $this->Session->check('Purchase.id_CIMB')) {
        //     try {
        //         if ($this->Session->check('Purchase.id_CIMB')) {
        //             if ($this->Session->read('Purchase.step1.product_id') == 7) { // JAI
        //                 $res = $this->Payment->find('first', array('conditions' => array('Payment.id' => $this->Session->read('Purchase.id_CIMB'))));
        //                 $status = $res['Payment'];
        //                 // $result = $this->ApiXml->updateShortTermPolicyBCA($this->Session->read('Purchase.idPolicy'), $status);
        //                 CakeLog::write('klikpay', ' [JAI Payment.id] ' . $this->Session->read('Purchase.id_CIMB') . ' [APIResponse] ' . $result);
        //             } else
        //                  $status = $this->ApiXml->getPaymentKlikBCA($this->Session->read('Purchase.id_BCA'));
        //         }
        //         else
        //             $status = $this->ApiXml->getPaymentKlikBCAPremi($this->Session->read('Purchase.id_BCApremi'));

        //         if ($status['reason_id'] == '1') {
        //             $this->Session->delete('Purchase.flow');
        //             $this->Session->delete('Purchase.step1');
        //             $this->Session->delete('Purchase.step2');
        //             $this->Session->delete('Purchase.token');
        //         }
        //     } catch (Exception $e) {
        //         CakeLog::write('error', $e);
        //         $status = 'Gagal';
        //     }
        //     $this->Session->delete('Purchase.id_BCA');
        //     $this->Session->delete('Purchase.id_BCApremi');
        //     $prod = strtoupper(str_replace('-', ' ', $id));
        //     $ctthankspurchase = '1';
        //     $this->set(compact('status', 'ctthankspurchase', 'prod'));
        // } 
        // else
            //$this->redirect("/");
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
                $this->Session->write('Purchase.step1', am($this->Session->read('Purchase.step1'),$sess));
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
        $this->set(compact('optFrek', 'product', 'prod_det', 'coverage', 'name', 'premMode', 'id', 'optPP', 'optUp', '_metaTitle'));
    }

//fixed

    public function step2_your_detail($name = "") {
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        $_metaTitle = $this->MetaTitle->getMetaCust($this->Session->read('Purchase.produk'));
        if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
            if ($this->Session->check('Purchase.step2')) {
                $this->request->data['Detail'] = $this->Session->read('Purchase.step2');
            }
            $statTU = $this->ApiXml->getTertanggungUtamaStat();
            $arrayID = $this->ApiXml->getArrayRelation($this->Session->read('Purchase.Tertanggung'));
            //start untuk JSK
            if ($this->Session->read('Purchase.step1.product_id')==21 && $this->Session->read('PROSPECT_DOB2_FOR_ENTRY')=="") array_push($arrayID, 2);
            //end untuk JSK
            $prodListID = array(11,12,13,21,23);
            if ((in_array($this->Session->read('Purchase.step1.product_id'), $prodListID)) && $arrayID == null)
                $arrayID = array('1');
            //$optInsureRel=($statTU!=-1)?$this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'),$arrayID):array('1'=>'Tertanggung Utama');
            $optInsureRel = $this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'), $arrayID);
            $optHub = $this->ApiXml->getRelationAHList();
            $product = $this->ApiXml->getProductbyID($this->Session->read('Purchase.step1.product_id'), array('min_adult_age', 'max_adult_age', 'coverage_type_benefit_id'));
            $countRelInsure = count($this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id')));
            $this->set(compact('sid', 'cat', 'name', 'optHub', '_metaTitle', 'optInsureRel', 'product', 'countRelInsure', 'statTU'));
            $optProvinsi = array("BANTEN",  "BENGKULU", "DI  YOGYAKARTA",   "DKI JAKARTA",  "GORONTALO",    "IRIAN JAYA BARAT", "JAMBI",    "JAWA BARAT",   "JAWA TENGAH",  "JAWA TIMUR",   "KALIMANTAN BARAT", "KALIMANTAN SELATAN",   "KALIMANTAN TENGAH",    "KALIMANTAN TIMUR", "KALIMANTAN UTARA", "BANGKA BELITUNG",  "KEPULAUAN RIAU",   "LAMPUNG",  "MALUKU",   "MALUKU UTARA", "NANGGROE ACEH DARUSSALAM", "NUSA TENGGARA BARAT",  "NUSA TENGGARA TIMUR",  "PAPUA",    "BALI", "RIAU", "SULAWESI BARAT",   "SULAWESI SELATAN", "SULAWESI TENGAH",  "SULAWESI TENGGARA",    "SULAWESI UTARA",   "SUMATRA BARAT",    "SUMATRA SELATAN",  "SUMATRA UTARA");
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
        $this->disableCache();
        $sid = $this->request->query['sid'];
        $cat = $this->request->query['cat'];
        $name = $this->request->query['name'];
        $_metaTitle = $this->MetaTitle->getMetaCust($this->Session->read('Purchase.produk'));
        $email_black = $this->Session->read('Purchase.step2.PROSPECT_EMAIL');
        $phone_black = $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE');
        $birth_black = $this->Session->read('Purchase.step1.PROSPECT_DOB');
        $emph = $this->Black->find('first', array('conditions' => array('Black.email' => $email_black)));
        //$embir=$this->Black->find('first', array('conditions' => array('Black.email' => $email_black,'Black.tanggal_lahir'=>$birth_black)));
        $phbir = $this->Black->find('first', array('conditions' => array('Black.phone' => $phone_black)));
        if ($emph == null AND $phbir == null) {
            if ($this->ApiXml->getValidUrl($sid, $cat, $name)) {
                if ($this->request->is('post') || $this->request->is('put')) {
                    $sess = $this->request->data['Detail'];

                    /* Try HardCode Andi */
                    if (!isset($sess['me']))
                        $sess['me'] = 'Y';

                    if ($cat == 'unit-link') {
                        $_tmp = $this->ApiXml->storeUnitLink($this->Session->read('Purchase.step1'), $sess);
                    } else if ($this->Session->read('Purchase.step1.product_id') == '7') {  // jaga aman instan
                        $this->Session->write('Purchase.QUOTE_ID', time());
                        $step1 = $this->Session->read('Purchase.step1');
                        $up = preg_replace("/[^0-9]/", "", $step1['SUM_INSURED']);
                        $premi = $this->ApiXml->getPremiumRate($step1['COVERAGE_TYPE_ID'], $step1['QUOTE_PREMIUM_MODE'], $this->ApiXml->getAge($step1['PROSPECT_DOB']), $step1['PROSPECT_GENDER'], isset($step1['QUOTE_PREMIUM_LIFESPAN']) ? $step1['QUOTE_PREMIUM_LIFESPAN'] : 0, isset($step1['QUOTE_DURATION_DAYS']) ? $step1['QUOTE_DURATION_DAYS'] : 0, $up, isset($step1['QUOTE_DURATION_HOUR']) ? $step1['QUOTE_DURATION_HOUR'] : 0);

                        if ($step1['HARD_COPY'] == 'Y') {
                            $premi = $premi + 50000;
                        } else if (isset($step1['QUOTE_DURATION_DAYS']) && $step1['QUOTE_DURATION_DAYS'] >= 180) {
                            $premi = $premi + 25000;
                        }
                        $this->Session->write('Purchase.premi.total_premi', $premi);
                    } else {

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
                        $_tmp = $this->ApiXml->storeNonUnitLink($step1_sess, $sess);
                    }

                    $this->Session->write('Purchase.step2', $sess);
                }
                if ($cat == 'unit-link')
                    $chart = $this->ApiXml->GetGrafikUnitLink($this->Session->read('Purchase.QUOTE_ID')); else
                    $chart = null;
                $urlKlikPay = $this->ApiXml->getConfig('klikPayUrl');
                $urlCimbClick =$this->ApiXml->getConfig('cimbClick');
                $urlDO = $this->ApiXml->getConfig('DOurl');
                $ECashPayUrl = $this->ApiXml->getConfig('ecashPayment');
                $optInsureRel = $this->ApiXml->getRelationInsured($this->Session->read('Purchase.step1.product_id'));
                $this->set(compact('sid', 'cat', 'name', 'chart', '_metaTitle', 'urlKlikPay', 'urlCimbClick', 'urlDO', 'ECashPayUrl', 'optInsureRel'));
            }
            else {
                $this->redirect("/");
            }
        } else {
            $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
        }
        $cashlessFee = $this->Session->read('Purchase.step1.cashlessfee');
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
            $this->request->data['Tertanggung']['PROSPECT_DOB'] = ($this->request->data['Tertanggung']['PROSPECT_DOB'] != "" ? $this->request->data['Tertanggung']['PROSPECT_DOB']: $this->request->data['Tertanggung']['PROSPECT_DOB_ANAK']);
        }
        else if ($this->request->data['Tertanggung']['INSURED_RELATIONSHIP_ID'] == 2) {
            $this->request->data['Tertanggung']['PROSPECT_DOB'] = ($this->request->data['Tertanggung']['PROSPECT_DOB2'] != "" ? $this->request->data['Tertanggung']['PROSPECT_DOB2'] : $this->request->data['Tertanggung']['PROSPECT_DOB']);
        }
        else {
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
                
                $validBlackList=false;
                $IsExistCustomerBlackList = $this->ApiXml->CheckCustomerBlackList($dataTA['PROSPECT_NAME'], $dataTA['PROSPECT_DOB']);
                if ($IsExistCustomerBlackList['CResult']=='T') 
                {
                    $validBlackList=true;
                    $this->Session->setFlash('Maaf penambahan tertanggung ini belum dapat diproses, silakan menghubungi CS kami untuk informasi lebih lanjut.');
                    $this->redirect(array('controller' => 'front', 'action' => 'step2_your_detail', 'id' => $name, '?' => array('sid' => $sid, 'cat' => $this->Session->read('Purchase.flow.cat'))));
                }
                
                if ($validBlackList==false)
                {
                    $product = $this->ApiXml->getProductbyID($this->Session->read('Purchase.step1.product_id'), array('min_adult_age', 'max_adult_age', 'coverage_type_benefit_id'));
                    $cust_benefitID = $product['coverage_type_benefit_id'];
                    if ($cust_benefitID==2)
                        $cust_benefitID=11;
                    
                    $getAcumulate = $this->ApiXml->getAcumulation($dataTA['PROSPECT_NAME'], $dataTA['PROSPECT_DOB'], $dataTA['PROSPECT_GENDER'], $cust_benefitID);
                    $total_insured = $this->Session->read('Purchase.step1.SUM_INSURED');
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
                    }
                }
                
                $this->request->data['Tertanggung']['ID_PROSPECT'] = $this->ApiXml->saveTertanggung($dataTA['PROSPECT_NAME'], $dataTA['PROSPECT_DOB'], $dataTA['PROSPECT_GENDER']);
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
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
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

        if ($this->request->is('post')) {
            if (!empty($this->request->data['Leavenumber']['Contact_Phone'])) {
                $phone_black = $this->request->data['Leavenumber']['Contact_Phone'];
                $black_phone = $this->Black->find('first', array('conditions' => array('Black.phone' => $phone_black)));
                if ($black_phone == null) {

                    $tipe = $this->request->data['Leavenumber']['Contact_Tipe'];
                    $name = $this->request->data['Leavenumber']['Contact_Name'];
                    $phone = $this->request->data['Leavenumber']['Contact_Phone'];

                    if ("info" == $tipe) {
                        //info produk
                        $Email = new CakeEmail();
                        $Email->emailFormat('html');
                        $Email->config('smtp');
                        $Email->from('noreply@jagadiri.co.id');
                        $Email->to(Configure::read('Aqi.mail'));
                        $Email->subject('Saya Mau Mencari Informasi Produk - Jagadiri');

                        $msg = '';
                        $msg.='Name: ' . $name . '<br/>';
                        $msg.='Contact Phone: ' . $phone . '<br/>';

                        $Email->send($msg);
                        $this->Session->setFlash(__('Terimakasih telah meninggalkan nomor kontak anda, agen kami akan segera menghubungi anda'));
                    } else {
                        //melakukan pembelian
                        $data = $this->request->data['Leavenumber'];
                        $this->ApiXml->sendLeaveNumber($data);
                        $this->Session->setFlash(__('Terimakasih telah meninggalkan nomor kontak anda, agen kami akan segera menghubungi anda'));
                        $ctleavenumber = '1';
                        $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Tipe']);
                    }
                }
                else
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
                            $this->ApiXml->pushCTS($data['Contact_NameR'], $data['Contact_PhoneR'], $prod, $data['Contact_Email']);
                        }
                        if ($data['Contact_NameR2'] != "") {
                            $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR2'], $data['Contact_PhoneR2']);
                            $this->ApiXml->sendContactUs($data);
                            $this->ApiXml->pushCTS($data['Contact_NameR2'], $data['Contact_PhoneR2'], $prod, $data['Contact_Email']);
                        }
                        if ($data['Contact_NameR3'] != "") {
                            $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR3'], $data['Contact_PhoneR3']);
                            $this->ApiXml->sendContactUs($data);
                            $this->ApiXml->pushCTS($data['Contact_NameR3'], $data['Contact_PhoneR3'], $prod, $data['Contact_Email']);
                        }
                    } else {
                        $data['Contact_Email'] = '';
                        $data['Contact_Name'] = '';
                        $this->ApiXml->sendContactUs($data);
                        $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
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
                }
                else
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
        #Show promo image with date conditions
        $date = date("Y-m-d H:i:s");
        $promo = $this->Promo->find('all', array('conditions' => array('NOT' => array('Promo.id' => array(2, 3, 4)), 'deleted' => 0, 'Promo.start_date <= ' => $date, 'Promo.end_date >= ' => $date,)));
        $this->set(compact('sumberOptions', 'popupWindow', 'checkProd', 'news', 'allproduct', 'ctleavenumber', 'banners', 'allphone', 'promo'));
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
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
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
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email']);
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
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email']);
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
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email']);
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
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
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
                        $this->ApiXml->pushCTS($data['Contact_NameR'], $data['Contact_PhoneR'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR2'] != "") {
                        $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR2'], $data['Contact_PhoneR2']);
                        $this->ApiXml->sendContactUs($data);
                        $this->ApiXml->pushCTS($data['Contact_NameR2'], $data['Contact_PhoneR2'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR3'] != "") {
                        $this->ApiXml->InsertProspectMGM($hdr, $data['Contact_NameR3'], $data['Contact_PhoneR3']);
                        $this->ApiXml->sendContactUs($data);
                        $this->ApiXml->pushCTS($data['Contact_NameR3'], $data['Contact_PhoneR3'], $prod, $data['Contact_Email']);
                    }
                } else {
                    $data['Contact_Email'] = '';
                    $data['Contact_Name'] = '';
                    $this->ApiXml->sendContactUs($data);
                    $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
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
                        $this->ApiXml->pushCTS($data['Contact_NameR'], $data['Contact_PhoneR'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR2'] != "") {
                        $this->ApiXml->sendContactUs($data);
                        $this->ApiXml->pushCTS($data['Contact_NameR2'], $data['Contact_PhoneR2'], $prod, $data['Contact_Email']);
                    }
                    if ($data['Contact_NameR3'] != "") {
                        $this->ApiXml->sendContactUs($data);
                        $this->ApiXml->pushCTS($data['Contact_NameR3'], $data['Contact_PhoneR3'], $prod, $data['Contact_Email']);
                    }
                    $this->Session->setFlash('Terimakasih atas data referensi Anda, kami menjamin kerahasiaan data tersebut. Dalam beberapa saat referral Anda akan dihubungi staf telemarketing kami. Salam JAGADIRI!', 'default', array(), 'flash1');
                    $flash1 = 1;
                } else {
                    $data['Contact_Email'] = '';
                    $data['Contact_Name'] = '';
                    $this->ApiXml->sendContactUs($data);
                    $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $prod, $data['Contact_Email']);
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
        //load product per kategori, accident, life, health, investa
        $acc = $this->Product->find('all', array('conditions' => array('Product.category_id' => 1, 'Product.publish' => 1)));
        $life = $this->Product->find('all', array('conditions' => array('Product.category_id' => 2, 'Product.publish' => 1)));
        $health = $this->Product->find('all', array('conditions' => array('Product.category_id' => 3, 'Product.publish' => 1)));
        $investa = $this->Product->find('all', array('conditions' => array('Product.category_id' => 4, 'Product.publish' => 1)));
        $general = $this->Product->find('all', array('conditions' => array('Product.category_id' => 5, 'Product.publish' => 1)));
        $this->set(compact('acc', 'life', 'health', 'investa','general'));
    }

    public function serbaserbi() {
        
    }

    public function productdetail($id = null) {
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
                $this->ApiXml->sendContactUs($data);
                $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
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
        }
        else
            $this->redirect("/");
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
                    $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], $data['Contact_Remark1'], $data['Contact_Email']);
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
        if ($this->request->is('post')) {
            $phone_black = $this->request->data['Contactus']['Contact_Phone'];
            $email_black = $this->request->data['Contactus']['Contact_Email'];
            //$emph=$this->Black->find('first', array('conditions' => array('Black.phone'=>$phone_black,'Black.email'=>$email_black))); //buat blacklist
            $emph = null; //buat bikin ilang black list
            if ($emph == null) {
                $data = $this->request->data['Contactus'];
                $this->ApiXml->sendContactUs($data);
                if ($data['Contact_Source'] == 'Tel' && $data['Contact_Remark1'] == 'Inquiry (I want to ask on JAGADIRI products and promotion)') {
                    $this->ApiXml->pushCTS($data['Contact_Name'], $data['Contact_Phone'], '', $data['Contact_Email'], $data['Contact_Daytime']);
                } else {
                    $this->sendEmail->hubungiKami($data);
                }
                $this->Session->write('thanks_id', 'hubungi-kami');
                $this->redirect(array('controller' => 'front', 'action' => 'thanks_leavenumber', 'id' => 'hubungi-kami'));
            } else {
                $this->redirect(array('controller' => 'front', 'action' => 'black_list'));
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
                        }
                        else
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
        }
        else
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
//        echo 'alert("Selamat Data Anda Terpilih Sebagai Pemenang")';
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
        
        if ($saran==null)
        {
            $saran="";
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
        $db->fetchAll('INSERT INTO aq_hasil_survey_saran(ip_address, puas_polis, saran, tanggal_survey, waktu_survey)
               VALUES(?, ?, ?, ?, ?)', array($ip_address, $puas_polis, $saran, $tanggal_survey, $waktu_survey));
//                return;
//        }

        $this->redirect(array('controller' => 'front', 'action' => 'home'));
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

                /* pembagian batch(batch jam 06:00 - 12:00, batch jam 12:01 - 18.00, batch jam 18:01 â€“ 05:59) fromat 24 jam,
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

    public function detail_promo($seo = '') {
        #show image if current date beetween startdate and enddate
        $date = date("Y-m-d H:i:s");
        $pr = $this->Promo->find('first', array('conditions' => array('Promo.seo' => $seo, 'deleted' => 0, 'Promo.start_date <= ' => $date)));
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
            }
            else
                CakeLog::write('error', $customer_id); // write API Error to log

            $benef_id = $this->ApiXml->saveLineQuizBeneficiary($data['Personal']);

            if ($benef_id) {
                $benef_cert_id = $this->ApiXml->GenerateLineQuizPolicyBeneficiary($benef_id, $customer_cert_id, $data['Personal']['RELATIONSHIP_ID_WARIS']);
            }
            else
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
            if ($IsExistCustomerBlackList['CResult']=='T') 
            {
                echo "1";
            }
            else
            {
                echo "0";
            }
        }
        else
            throw new NotFoundException('Could not find that page');
    }
}

//class closure