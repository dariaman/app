<?php
App::uses('AppModel', 'Model');
App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');
App::uses('ConnectionManager', 'Model');
App::uses('BaseLog', 'Log/Engine');
class ApiXml extends AppModel {
	public $useTable = false; 


	protected $path='/webservice/';
	protected $timeout=30;

/*
param1: Key API
param2: FileName/NameXML
param3: Name of Table
*/
protected function getData($data=array(),$file='',$name=false){
	$host = ConnectionManager::getDataSource('default')->config['ApiHost'];  
	$http = new HttpSocket(array('timeout' => $this->timeout));
	$response = $http->get(
		array('host' => $host, 'path' => $this->path.$file),
		$data
		);
	if(!$response->isOk()) {
		if($response->code=='503') $error='Timeout Gateway'; else $error=$response->body;
		throw new CakeException($response->body);
	} 
	
	else{
		$xmlArray = Xml::toArray(Xml::build($response->body));
		if(!$name) return $xmlArray;
		else return $xmlArray['ArrayOfC'.$name]['C'.$name];
	}
}

public function getConfig($par=""){
	$data=ConnectionManager::getDataSource('default')->config[$par]; 
	return $data;
}

/*
param1: FileName/NameXML
param2: array data Post
*/
protected function sendData($data=array(),$file='',$name=false){
	$host = ConnectionManager::getDataSource('default')->config['ApiHost']; 
	$http = new HttpSocket(array('timeout' => $this->timeout));
	$response = $http->post(
		array('host' => $host, 'path' => $this->path.$file),
		$data
		);
	if(!$response->isOk()) {
		if($response->code=='503') $error='Timeout Gateway'; else $error=$response->body;
		throw new CakeException($response->body);
	} 
	
	else{
		$xmlArray = Xml::toArray(Xml::build($response->body));
		if(!$name) return $xmlArray;
		else { 
			if (isset($xmlArray['ArrayOfC'.$name]['C'.$name])) {
				return $xmlArray['ArrayOfC'.$name]['C'.$name];
			}
			else return $xmlArray;
		}
	}
}

protected function sendCTSData($name, $phone, $prod='',$timeCall=''){
	$host = ConnectionManager::getDataSource('default')->config['ApiCTS'];
	$data['Customer']['name'] =$name;
	$data['Customer']['phone'] =$phone;
	$data['Customer']['prod'] =$prod;
	$data['Customer']['type'] ='website';
	$http = new HttpSocket(array('timeout' => $this->timeout));
	$response = $http->post($host,$data);
	if(!$response->isOk()) {
		throw new CakeException($response->body);
	} 
	else{
		return true;
	}
}


public function getResultEcash($id=''){
	$host = ConnectionManager::getDataSource('default')->config['ecashValidation'];
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $host.'?id='.$id);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	$result = curl_exec($curl);	
	$info = curl_getinfo($curl); 
	if($info['http_code']!=200)	{
		CakeLog::write('error_ecash', 'error_validation: '.curl_error($curl));
		throw new CakeException(curl_error($curl)); 
	}
	curl_close($curl);
	CakeLog::write('ecash_result', 'response: '.$result);
	return $result;
}

public function EcashPush($return_url, $amount, $description, $order_id){
	$config = ConnectionManager::getDataSource('default')->config;
	$host =  $config['ecashInitiate'];
	$mid =  $config['midEcash'];
	$password =  $config['passwordEcash'];
	$hash = sha1(strtoupper($mid) . $amount . $_SERVER['REMOTE_ADDR']);
	$xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.service.gateway.ecomm.ptdam.com/">
                <soapenv:Header/>
                    <soapenv:Body>
                        <ws:generate>
                            <params>
                                <amount>' . $amount . '</amount>
                                <clientAddress>' . $_SERVER['REMOTE_ADDR'] . '</clientAddress>
                                <description>' . $description . '</description>
                                <memberAddress>' . $_SERVER['SERVER_ADDR'] . '</memberAddress>
                                <returnUrl>' . $return_url . '</returnUrl>
                                <toUsername>' . $mid . '</toUsername>
                                <hash>' . $hash . '</hash>
                                <trxid>' . $order_id . '</trxid>
                            </params>
                        </ws:generate>
                    </soapenv:Body>
             </soapenv:Envelope>';
	
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $host);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, $mid . ":" . $password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data = curl_exec($ch);
        if ($data === false) {
			CakeLog::write('error_ecash', 'tidak dapat return dari mandiri e-cash '.curl_error($ch));
			throw new CakeException(curl_error($ch));
        }
		else {
            if (!empty($data)) {
			    $xml = simplexml_load_string($data); 
                if (isset($xml)) {
                    $id = $xml->xpath('//return[1]');
					if($id == "INVALID_DATA" || $id == "INVALID_RETURNURL")
					{
						CakeLog::write('error_ecash', 'data yang dikirim tidak sesuai '.curl_error($ch));
						throw new CakeException(curl_error($ch)); 
					}
					else{ 
						CakeLog::write('ecash', 'id: '.$id[0]);
						return $id[0];
					}
                }
            }
			else{
				CakeLog::write('error_ecash', 'tidak menerima reply dari server mandiri e-cash '.curl_error($ch));
				throw new CakeException(curl_error($ch));
			}
        }	
}

public function CTSGrandSpot($name, $phone, $prod,$timeCall,$timeLead,$email){
	$host = ConnectionManager::getDataSource('default')->config['ApiGrandSpot'];
	$xmlArray=array(
		'string'=>array(
			'Customers'=> array(
				'Customer' => array(
					'CustomerName'=>$name,'CustomerGender'=>'','MobilePhone1'=>$phone,'MobilePhone2'=>'','HomePhone1'=>'','HomePhone2'=>'','HomeAddr1'=>'','HomeAddr2'=>'','HomeAddr3'=>'','HomeAddr4'=>'','HomeCity'=>'','HomeZip'=>'','OfficeName'=>'','OfficePhone1'=>'','OfficePhone2'=>'','OfficeAddr1'=>'','OfficeAddr2'=>'','OfficeAddr3'=>'','OfficeAddr4'=>'','OfficeCity'=>'','OfficeZip'=>'','ProductName'=>$prod,'Email'=>$email,'TimeToCall'=>$timeCall,'TimeCreateLeads'=>$timeLead
				)
			)
		)
	);
	$xmlObject = Xml::fromArray($xmlArray, array('format' => 'tags')); 
	$xmlString = $xmlObject->asXML(); 
	$http = new HttpSocket(array('timeout' => $this->timeout));
	$response = $http->post($host,$xmlString); 
	$result=trim(strip_tags($response->body));  
	if(!$response->isOk() || $result!='Save 1 row data successfully') {
		throw new CakeException($result);
	} 
	else{
		return true;
	}

}

private function saveLeadinMyweb($name, $phone, $prod='',$email='',$timeCall='',$timeLead, $status){
	$Lead = ClassRegistry::init('Lead');
	$Lead->create();
	$Lead->save(compact('name','phone','prod','timeCall','timeLead','email','status'));
	return $Lead->id;
}

public function pushCTS($name, $phone, $prod='',$email='',$timeCall=''){
	//grandspot
	try{ 
		$timeLead=date('Y-m-d H:i:s');
		$this->CTSGrandSpot($name, $phone, $prod, $timeCall,$timeLead,$email); 
		$status=1;
		$tmp_=$this->saveLeadinMyweb($name, $phone, $prod,$email,$timeCall,$timeLead,$status);
	} 
	catch(Exception $e){
		$status=0;
		$id=$this->saveLeadinMyweb($name, $phone, $prod,$email,$timeCall,$timeLead,$status);
		CakeLog::write('cts', 'error id: '.$id.' name: '.$name.' phone: '.$phone.' prod: '.$prod.' timeLead: '.$timeLead.' timeCall: '.$timeCall.' error: '.$e, 'cts');
		$sendEmail = ClassRegistry::init('sendEmail');
		$sendEmail->leadsError(compact('name','phone','prod','timeCall','timeLead','email','status'));
		
	}
}

/*Get dynamic Data from CAF*/
public function getEntityList(){
	$list=array();
	$data=array(
		'KEY'=>'8BA2A7D26EF31B12AA697E7466970B66'
		);
	$dataentity=$this->getData($data,'DataEntity.asmx/GetAllEntityDatainXML','Entity');
	foreach($dataentity as $a){
		$list[$a['entityID']]=$a['entityDesc'];
	}
	return $list;
}

public function getBankList(){
	$list=array();
	$data=array(
		'KEY'=>'9548B7D9AA615312B72A69E970445936'
		);
	$dataentity=$this->getData($data,'DataBank.asmx/GetAllBankDatainXML','Bank'); ;
	foreach($dataentity as $a){
		$list[$a['BankID']]=$a['BankCode'];
	}
	return $list;
}

public function getCauseList(){
	$list=array();
	$data=array(
		'KEY'=>'548B7D9AA629548B7272AA6966970B66'
		);
	$dataentity=$this->getData($data,'DataCOC.asmx/GetAllCOCDatainXML','Coc');
	foreach($dataentity as $a){
		$list[$a['cocID']]=$a['cocDescription'];
	}
	return $list;
}
public function getProductList(){
	$list=array();
	$data=array(
		'KEY'=>'98B7D9E29548B7D9AA615312B72AA696'
		);
	$dataentity=$this->getData($data,'DataProduct.asmx/GetProductDatainXML','Product');
	foreach($dataentity as $a){
		$list[$a['product_id']]=$a['product_description'];
	}
	return $list;
}
public function getFundList($id=false){
	$list=array();
	$data=array(
		'KEY'=>'1031B14CBAA61531B1032B72AA696E47'
		);
	$dataentity=$this->getData($data,'DataFundType.asmx/GetFundTypeDatainXML','FundType');
	foreach($dataentity as $a){
		$list[$a['fund_type_id']]=$a['fund_type_desc'];
	}
	if(!$id) return $list;
	else return $list[$id];
}
public function getPremiumRate($id=0,$mode=0,$age='',$gender='',$year=0,$day=0,$insured=0,$hour=0){
	 //echo $id.' '.$mode.' '.$age.' '.$gender.' '.$year.' '.$day.' '.$insured ; die();
 
	$data=array(
		'KEY'=>'B7D195C41548B7D9B72AA697044B6E47',
		'COVERAGE_TYPE_ID'=>$id,
		'AGE'=>$age,
		'GENDER'=>$gender,
		'DURATION'=>$year,
		'DURATION_DAY'=>$day,
		'DURATION_HOUR'=>$hour,
		'PREMIUM_MODE'=>$mode,
		'SUM_INSURED'=>$insured
		);
	$dataentity=$this->getData($data,'DataPremiumRate.asmx/GetPremiumRateDatainXML','PremiumRate');
	return $dataentity['PremiumRate'];
}
public function getLoginCust($user='',$pass=''){
		$list=array();
		$data=array(
			'KEY'=>'485A526F1EF81031B14CBAA615760FE9',
			'Custemail'=>$user,
			'CustPass'=>$pass,
		);
		$dataentity=$this->getData($data,'DataCustomer.asmx/GetLoginDatainXML');
		if(!isset($dataentity['ArrayOfCCustomer']['CCustomer'])) return null;
		else return $dataentity['ArrayOfCCustomer']['CCustomer'];
}

public function getKeyCust($email=''){
		$list=array();
		$data=array(
			'KEY'=>'485A526F1EF81031B14CBAA615760FE9',
			'Custemail'=>$email,
		);
		$dataentity=$this->getData($data,'DataCustomer.asmx/GetCustomerDataByEmailinXML');
		if(!isset($dataentity['ArrayOfCCustomer']['CCustomer'])) return null;
		else return $dataentity['ArrayOfCCustomer']['CCustomer'];
}

/* Get Data Fund */
public function getDataFund(){
		$list=array();
		$data=array(
			'KEY'=>'A9129A4DF87E1030B8217CB61E71DE05',
			'DAYS'=>'2',
		);
    try{
      $dataentity=$this->getData($data,'DataFundTypePrice.asmx/GetDaysLatestApprovedNAVinXML','FundPrice');
      return $dataentity;
    } catch(Exception $e){
      //$this->response->body;
    }   
}

public function getAcumulation($cust_name,$cust_dob,$cust_gender,$cust_benefitID){
  $data=array(
    'KEY'=>'485A526F1EF81031B14CBAA615760FE9',
    'CustName'=>$cust_name,
    'CustDOB'=>$cust_dob,
    'CustGender'=>$cust_gender,
    'CoverageBenefitID'=>$cust_benefitID
  );
  $dataentity=$this->sendData($data,'DataCustomer.asmx/GetTotalSumInsuredPolicyActiveByCustomerCoverageBenefitinXML','');
    return $dataentity['ArrayOfCCustomerSumInsured'];
}

/* SEND DATA */

public function saveProspect($email,$name,$dob,$gender){ 
	$data=array(
		'KEY'=>'0BD7043E6D9B1032B72AA697044B6E47',
		'PROSPECT_EMAIL'=>$email,
		'PROSPECT_NAME'=>$name,
		'PROSPECT_DOB'=>$dob,
		'PROSPECT_GENDER'=>$gender,
	);
	$dataentity=$this->sendData($data,'InputProspect.asmx/InsertProspectinXML','Result');
    return $dataentity['Result'];
}

public function saveTertanggung($name,$dob,$gender){ 
	$data=array(
		'KEY'=>'0BD7043E6D9B1032B72AA697044B6E47', 
		'PROSPECT_NAME'=>$name,
		'PROSPECT_DOB'=>$dob,
		'PROSPECT_GENDER'=>$gender,
	);
	$dataentity=$this->sendData($data,'InputProspect.asmx/InsertProspectInsuredinXML','Result');
    return $dataentity['Result'];
}

public function updateProspect($data){ 
	$data=array(
		'KEY'=>'0BD7043E6D9B1032B72AA697044B6E47',
		'TRANSACTION_NO'=>"2",
		'PROSPECT_ID'=>$data['PROSPECT_ID'],
		'PROSPECT_NAME'=>$data['PROSPECT_NAME'],
		'PROSPECT_NRIC'=>isset($data['PROSPECT_NRIC'])?$data['PROSPECT_NRIC']:' ',
		'PROSPECT_ID_TYPE'=>'N/A',
		'PROSPECT_DOB'=>$data['PROSPECT_DOB'],
		'PROSPECT_MOBILE_PHONE'=>isset($data['PROSPECT_MOBILE_PHONE'])?$data['PROSPECT_MOBILE_PHONE']:' ',
		'PROSPECT_WORK_PHONE'=>' ',
		'PROSPECT_EMAIL'=>(isset($data['PROSPECT_EMAIL']) && $data['PROSPECT_EMAIL']!='')?$data['PROSPECT_EMAIL']:'',
		'PROSPECT_ADDRESS'=>isset($data['PROSPECT_ADDRESS'])?$data['PROSPECT_ADDRESS']:' ',
		'PROSPECT_CITY'=>' ',
		'PROSPECT_POSTAL_CODE'=>' ',
		'PROSPECT_PHONE'=>' ',
		'PROSPECT_ADDRESS_COR'=>' ',
		'PROSPECT_CITY_COR'=>' ',
		'PROSPECT_POSTAL_CODE_COR'=>' ',
		'PROSPECT_PHONE_COR'=>' ',
		'PROSPECT_BANK_ACCOUNT'=>' ',
		'PROSPECT_GENDER'=>$data['PROSPECT_GENDER'],
		'PROSPECT_RELIGION'=>0,
		'PROSPECT_MARITAL_STATUS'=>0,
		'PROSPECT_JOB'=>' ',
		'PROSPECT_HOBBY'=>' ',
		'PROSPECT_GROSS_SALARY'=>1,
		'PROSPECT_OTHER_INCOME'=>1,
		'PROSPECT_PURPOSE_POLICY'=>1,
		'PROSPECT_HEIGHT'=>1,
		'PROSPECT_WEIGHT'=>1,
		'PROSPECT_BIRTH_PLACE'=>' ',
		'PROSPECT_ACCOUNT_NAME'=>' ',
		'PROSPECT_BANK_NAME'=>0,
		'PROSPECT_BANK_BRANCH'=>' ',
		'PROSPECT_TAX_NO'=>' ',
		'PROSPECT_JOB_LEVEL'=>' ', 
		'PROSPECT_REGION_ID'=>0,
		'PROSPECT_REGION_COR_ID'=>0,
    'PROSPECT_NO'=>' '
	);
	$dataentity=$this->sendData($data,'InputProspect.asmx/UpdateProspectinXML','Result');
    return $dataentity['Result'];
}

public function saveQuotation($holder,$prospect,$product){
	$data=array(
		'KEY'=>'B72AA6970644B101031B1E7AA32B72AA',
		'QUOTE_HOLDER_ID'=>$holder,
		'QUOTE_PROSPECT_ID'=>$prospect,
		'QUOTE_DESC'=>' ',
		'QUOTE_WORKSITE_ID'=>0,
		'QUOTE_AGENT_ID'=>0,
		'QUOTE_PRODUCT_ID'=>$product,
	);
	$dataentity=$this->sendData($data,'InputQuote.asmx/InsertQuoteinXML','Result');
    return $dataentity['Result'];
}

public function saveInsuredID($quote,$prospect,$relation=1){
	$data=array(
		'KEY'=>'B72AA6970644B101031B1E7AA32B72AA',
		'QUOTE_ID'=>$quote,
		'PROSPECT_ID'=>$prospect,
		'INSURED_RELATIONSHIP_ID'=>$relation,
	);
	$dataentity=$this->sendData($data,'InputQuote.asmx/InsertQuoteInsuredinXML','Result');
    return $dataentity['Result'];
}

public function saveFundID($quote,$fundtype,$premi){
	$data=array(
		'KEY'=>'B72AA6970644B101031B1E7AA32B72AA',
		'QUOTE_ID'=>$quote,
		'FUND_TYPE_ID'=>$fundtype,
		'PREMIUM_PERCENT'=>100,
		'REGULAR_PREMIUM_AMOUNT'=>$premi,
	);
	$dataentity=$this->sendData($data,'InputQuote.asmx/InsertQuoteFundinXML','Result');
    return $dataentity['Result'];
}

public function updateStatusQuote($quote,$status){
	$data=array(
		'KEY'=>'B72AA6970644B101031B1E7AA32B72AA',
		'QUOTE_ID'=>$quote,
		'QUOTE_STATUS'=>$status,
		'QUOTE_SUCCESS'=>1,
		'QUOTE_APPR_CODE'=>'W3BS1',
		'CREATED_BY'=>'DM',
		
	);
	$dataentity=$this->sendData($data,'InputQuote.asmx/UpdateStatusinXML','Result');
    return $dataentity['Result'];
}

public function sendRecurringCard($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
		'CC_MONTH'=>' ',
		'CC_YEAR'=>' ',
		'CC_NAME'=>' ',
		'CC_ADDRESS'=>' ',
		'CC_PHONE'=>' ',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/InsertCCMOTOinXML','Result');
    return true;
}

public function savePaymentKlikBCA($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/InsertBCAKlikPayinXML','Result');
    return $dataentity['Result'];
}

public function savePaymentEcash($return_url, $amount, $description, $order_id){
	$config = ConnectionManager::getDataSource('default')->config;
	$host =  $config['ecashInitiate'];
	$mid =  $config['midEcash']; 
	$hash = sha1(strtoupper($mid) . $amount . $_SERVER['REMOTE_ADDR']);
	$data['KEY']='B1032B72AA697043341B1697044B6E47';
	$data['AMOUNT']=$amount;
	$data['CLIENTADDRESS']=$_SERVER['REMOTE_ADDR'];
	$data['DESCRIPTION']= $description;
	$data['MEMBERADDRESS']=$_SERVER['SERVER_ADDR'];
	$data['RETURNURL']= $return_url;
	$data['TOUSERNAME']=$mid;
	$data['TRXID']= $order_id;
	$data['HASH']=$hash;
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/InsertEMoneyinXML','Result');
    return $dataentity['Result'];
}

public function updateEcash($trxid, $resultid, $status){
	$data['KEY']='B1032B72AA697043341B1697044B6E47';
	$data['TRXID']=$trxid;
	$data['RESULTID']=$resultid;
	$data['RESULTSTATUS']= $status;
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/UpdateResultEMoneyinXML','Result');
    return $dataentity['Result'];
}

public function savePaymentKlikBCAPremi($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGatewayRegular.asmx/InsertBCAKlikPayinXML','Result');
    return $dataentity['Result'];
}

public function sendLeaveNumber($field){
	$data=array(
		'KEY'=>'B1032B72AA697044BEEB1E7AA32B72AA',
		'Contact_CreatedDate'=>date("Y-m-d"),
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputContact.asmx/InsertContactPhoneinXML','Result');
    return $dataentity['Result'];
}

public function sendContactUs($field){
	$data=array(
		'KEY'=>'B1032B72AA697044BEEB1E7AA32B72AA',
		'Contact_CreatedDate'=>date("Y-m-d"),
		'Contact_CDate'=>date("Y-m-d"),
		'Contact_CTimeFrom'=>date("H:i"),
		'Contact_CTimeTo'=>date("H:i"),
		'Contact_DOB'=>date("Y-m-d"),
		'Contact_Gender'=>' ',
		
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputContact.asmx/InsertContactinXML','Result');
    return $dataentity['Result'];
}

public function sendClaim($field,$custID){
	$data=array(
		'KEY'=>'98B7D9EEF81031B12AA697E71DFDFE9',
		'POLICY_ID'=>$this->getPolicyDetail($field['POLICY_ID'])->PolicyID,
		'CUSTOMER_ID'=>$custID,
		'COC_ID'=>0,
		'HOSPITAL_STAY'=>0,
		'CLAIM_DESCRIPTION'=>' ',
		'CLAIM_AMOUNT'=>0,
		'ENTITY_ID'=>0,
		'HOSPITAL_REASON'=>' ',
		'PHYSICIAN_NAME'=>' ',
		'FIRST_DIAGNOSIS_DATE'=>date('Y-m-d'),
		'DIAGNOSIS'=>' ',
		'SYMPTOMS_DATE'=>date('Y-m-d'),
		'ACCIDENT_DESCRIPTION'=>' ',
		'SYMPTOMS'=>' ',
		'PREVIOUS_DISEASE'=>' ',
		'ACCIDENT_LOCATION'=>' ',
		'OTHER_POLICY_NO'=>' ',
		'OTHER_INSURANCE_NAME'=>' ',
		
	);
	unset($field['POLICY_ID']);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputClaim.asmx/InsertClaiminXML','Result');
    return $dataentity['Result'];
}

public function savePaymentVisaMaster($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/InsertDOacquireinXML','Result');
    return $dataentity['Result'];
}

public function savePaymentVisaMasterPremi($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGatewayRegular.asmx/InsertDOacquireinXML','Result');
    return $dataentity['Result'];
}
public function updatePaymentVisaMasterPremi($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGatewayRegular.asmx/UpdateResultDOacquireinXML','Result');
    return $dataentity['Result'];
}

public function updatePaymentKlikBCA($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/UpdateResultBCAKlikPayinXML','Result');
    return $dataentity['Result'];
}

public function updatePaymentKlikBCAPremi($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGatewayRegular.asmx/UpdateResultBCAKlikPayinXML','Result');
    return $dataentity['Result'];
}

public function getPaymentKlikBCA($id){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
		'id_no'=>$id,
	);
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/GetBCAKlikPayinXML','BCAKlikPay');
    return $dataentity;
}

public function getPaymentKlikBCAPremi($id){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
		'id_no'=>$id,
	);
	$dataentity=$this->sendData($data,'InputPaymentGatewayRegular.asmx/GetBCAKlikPayinXML','BCAKlikPay');
    return $dataentity;
}

public function updatePaymentCreditCard($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGateway.asmx/UpdateResultDOacquireinXML','Result');
    return $dataentity['Result'];
}


public function updatePaymentCreditCardPremi($field){
	$data=array(
		'KEY'=>'B1032B72AA697043341B1697044B6E47',
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputPaymentGatewayRegular.asmx/UpdateResultDOacquireinXML','Result');
    return $dataentity;
}

public function getPremiPendingPayment($no){
	$data=array(
		'KEY'=>'29A6B1032BD81031B12AA697E71DFE9',
		'POLICY_NO'=>$no
	);
	$dataentity=$this->getData($data,'DataReceipt.asmx/GetReceiptPendingByPolicyNoinXML','');
    if(isset($dataentity[0]['ArrayOfCReceipt']['CReceipt']['RECEIPTID']) || isset($dataentity['ArrayOfCReceipt']['CReceipt']['RECEIPTID'])) return false; else return true;
}


protected function saveAhliWaris($id,$field){
	$data=array(
		'KEY'=>'0BD7043E6D9B1032B72AA697044B6E47',
		'PROSPECT_BIRTH_PLACE'=>' ',
		'QUOTE_ID'=>$id,
	);
	$data=array_merge($data,$field);
	$dataentity=$this->sendData($data,'InputProspect.asmx/InsertBeneficiaryProspectinXML','Result');
    return $dataentity['Result'];
}

public function saveCoverageID($data){
		$data=array(
		'KEY'=>'B72AA6970644B101031B1E7AA32B72AA',
		'QUOTE_ID'=>$data['QUOTE_ID'],
		'COVERAGE_TYPE_ID'=>$data['COVERAGE_TYPE_ID'],
		'QUOTE_INSURED_ID'=>$data['QUOTE_INSURED_ID'],
		'SUM_INSURED'=>$data['SUM_INSURED'],
		'DURATION_DAYS'=>$data['DURATION_DAYS'],
		'COMMENCE_DT'=>date("Y-m-d"),
		'PREMIUM_AMOUNT'=>$data['PREMIUM_AMOUNT'],
		'DURATION'=>$data['DURATION'],
		'PREMIUM_FACTOR'=>1,
	);
	$dataentity=$this->sendData($data,'InputQuote.asmx/InsertQuoteCoverageinXML','Result');
    return $dataentity['Result'];
}

public function updateQuotation($data){
	$data=array(
		'KEY'=>'B72AA6970644B101031B1E7AA32B72AA',
		'QUOTE_ID'=>$data['QUOTE_ID'],
		'QUOTE_PRIMARY_FUND_TYPE_ID'=>$data['QUOTE_PRIMARY_FUND_TYPE_ID'],
		'QUOTE_PREMIUM_LIFESPAN'=>$data['QUOTE_PREMIUM_LIFESPAN'],
		'QUOTE_DURATION_DAYS'=>0,
		'QUOTE_REGULAR_FEE'=>$data['QUOTE_REGULAR_FEE'],
		'QUOTE_INITIAL_FEE'=>$data['QUOTE_INITIAL_FEE'],
		'QUOTE_STAMP_FEE'=>$data['QUOTE_STAMP_FEE'],
		'QUOTE_SINGLE_PREMIUM'=>$data['QUOTE_SINGLE_PREMIUM'],
		'QUOTE_REGULAR_PREMIUM'=>$data['QUOTE_REGULAR_PREMIUM'],
		'QUOTE_PREMIUM_MODE'=>$data['QUOTE_PREMIUM_MODE'],
		'QUOTE_PREMIUM_LEAVE_YEAR'=>999,
		'QUOTE_PAPER_PRINT_FEE'=>$data['QUOTE_PAPER_PRINT_FEE'],
		'QUOTE_CASHLESS_FEE'=>$data['QUOTE_CASHLESS_FEE'],
    'QUOTE_REFERENCE_ID'=>1,
    'QUOTE_PREMIUM_DURATION'=>$data['QUOTE_PREMIUM_LIFESPAN']
	);
 
	$dataentity=$this->sendData($data,'InputQuote.asmx/UpdateQuote01inXML','Result');
    return $dataentity['Result'];
}

/*
param1: ID Product
param2: array field optional
*/

public function getProductbyID($id=0,$field=null){
	$list=array();
	$data=array(
		'KEY'=>'98B7D9E29548B7D9AA615312B72AA696',
		'PRODUCT_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataProduct.asmx/GetProductDataByProductIDinXML','ProductCoverage');
	if($field==null) {
		return $dataentity;
	} else {
		foreach($dataentity as $key=>$value){
			if(in_array($key,$field)) $list[$key]=$value;
		}
	}
	return $list;
}

public function getQuoteByID($id=0,$field=null){
	$list=array();
	$data=array(
		'KEY'=>'548B7D9AA615312B72AA6966970B6696',
		'QUOTE_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataQuote.asmx/GetQuoteDatainXML','Quote');
	if($field==null) {
		return $dataentity;
	} else {
		foreach($dataentity as $key=>$value){
			if(in_array($key,$field)) $list[$key]=$value;
		}
	}
	return $list;
}
/*
param1: ID Coverage
param2: array field optional
*/

public function getCoveragebyID($id=0,$field=null){
	$list=array();
	$data=array(
		'KEY'=>'C86295C4151E612BD9B72AA697044596',
		'COVERAGE_TYPE_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataCoverageSI.asmx/GetDurationSumInsuredCoverageinXML','');
	if($field==null) {
		if(!isset($dataentity['ArrayOfCCoverageSI']['CCoverageSI'])) return null;
		return $dataentity['ArrayOfCCoverageSI']['CCoverageSI'];
	} else {
		foreach($dataentity as $key=>$value){
			if(in_array($key,$field)) $list[$key]=$value;
		}
	}
	return $list;
}

public function dataPremimode($id='a'){
	$list=array( 0=>'Sekaligus',1=>'Bulanan',3=>'Triwulan',6=>'Semester',12=>'Tahunan');
	if($id=='a') return $list;
	else return $list[$id];
}

public function GetOptPremiModeByID($id=0){
	$list=array();
	$opt = $this->dataPremimode();
	$data=array(
		'KEY'=>'98B7D9E29548B7D9AA615312B72AA696',
		'PRODUCT_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataProduct.asmx/GetPremiumModeByProductIDinXML','PremiumMode');
	if(!isset($dataentity[0])){
		$i=$dataentity['PremiumMode'];
		$list[$i]=$opt[$i];
	} else {
		foreach($dataentity as $dt){
			$i=$dt['PremiumMode'];
			$list[$i]=$opt[$i];
		}
	}
	return $list;
}

public function getTertanggungUtamaStat(){
	$i=0;$searchTU=-1;
	$data=CakeSession::read('Purchase.Tertanggung');
	if($data!=null) {
		foreach($data as $d){
			if($d['INSURED_RELATIONSHIP_ID']==1) $searchTU=$i;
			$i++;
		}  
	}
	return $searchTU;
}

public function GetGrafikUnitLink($id=0,$field=null){
	$list=array(); 
	$data=array(
		'KEY'=>'548B7D9AA615312B72AA6966970B6696',
		'QUOTE_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataQuote.asmx/GetQuotationUnitLinked','');
		if(!isset($dataentity['ArrayOfCQuoteIllustration']['CQuoteIllustration'])) return null;
		foreach($dataentity['ArrayOfCQuoteIllustration']['CQuoteIllustration'] as $key => $val){
			if($val["LevelAssumed"]==1) $c='low'; else if($val["LevelAssumed"]==2) $c='mid'; else $c='high';
			$list[$val["Year"]] = isset($list[$val["Year"]])?array_merge($list[$val["Year"]],array($c=>$val['AmountProjected'])):array($c=>$val['AmountProjected']);
		}
	return $list;
}

public function getPolicyCust($id=0){
		$data=array(
			'KEY'=>'7FED54BA63911032B72AA697044B6E47',
			'Policy_Holder_ID'=>$id
		);
		$dataentity=$this->getData($data,'DataPolicy.asmx/GetPolicyDataSCinXML');
		if(!isset($dataentity['ArrayOfCPolicy']['CPolicy'])) return null;
		else if(isset($dataentity['ArrayOfCPolicy']['CPolicy'][0])){
			foreach($dataentity['ArrayOfCPolicy']['CPolicy'] as $policy	){
				$list[$policy['PolicyNo']]=$policy['PolicyNo'];
			}
			return $list;
		}
		else return array($dataentity['ArrayOfCPolicy']['CPolicy']['PolicyNo']=>$dataentity['ArrayOfCPolicy']['CPolicy']['PolicyNo']);
}

public function getPolicyCoverage($id=0){
		$data=array(
			'KEY'=>'7FED54BA63911032B72AA697044B6E47',
			'POLICY_NO'=>$id
		);
		$dataentity=$this->getData($data,'DataPolicy.asmx/GetPolicyCoverageDatainXML');
		if(!isset($dataentity['ArrayOfCPolicyCoverage']['CPolicyCoverage'])) return null;
		else if(isset($dataentity['ArrayOfCPolicyCoverage']['CPolicyCoverage'][0])){
			$i=0;
			foreach($dataentity['ArrayOfCPolicyCoverage']['CPolicyCoverage'] as $policy	){
				$list[$i]=array('desc'=>$policy['CoverageTypeDesc'],'id'=>$policy['CoverageTypeID']);
				$i++;
			}
			return $list;
		}
		else return $list[0]=array('desc'=>$dataentity['ArrayOfCPolicyCoverage']['CPolicyCoverage']['CoverageTypeDesc'],'id'=>$dataentity['ArrayOfCPolicyCoverage']['CPolicyCoverage']['CoverageTypeID']);
}

public function getPolicyDetail($id=0){
		$data=array(
			'KEY'=>'7FED54BA63911032B72AA697044B6E47',
			'POLICY_NO'=>$id
		); 
		$dataentity=$this->getData($data,'DataPolicy.asmx/GetPolicyDatainXML','Policy'); 
		if(!isset($dataentity)) return null;
		else return $dataentity;
}

/* Send Data */
public function saveUpdatePass($email='',$pass='',$customerKey=''){
		$data=array(
			'KEY'=>'8BA2A7D26EF81031B12AA697E71DFE9',
			'Email'=>$email,
			'NewPassword'=>$pass,
			'CustomerKey'=>$customerKey
		);
		$dataentity=$this->sendData($data,'InputCustomer.asmx/UpdatePasswordinXML'); 
		if(!isset($dataentity['ArrayOfCCustomer']['CCustomer'])) return null;
		else return $dataentity['ArrayOfCCustomer']['CCustomer'];
}

/*Get Static Data*/


public function getRelationAHList(){
	$list=array();
	$data=array(
		'KEY'=>'485A526F1EF81031B14CBAA615760FE9'
		);
	$dataentity=$this->getData($data,'DataCustomer.asmx/GetRelationshipBeneficiaryinXML','Relationship');
	// Start to Check "Tertanggung as Pemegang Polis"
  if(CakeSession::read('Purchase.step1.product_id')=='1' || CakeSession::read('Purchase.step1.product_id')=='7'):
    foreach($dataentity as $a){
      if($a['RelationshipId']!=13)
      $list[$a['RelationshipId']]=$a['RelationshipDesc'];
    }
  else:
    if(CakeSession::read('Purchase.step2.me')=='Y'){
      foreach($dataentity as $a){
        if($a['RelationshipId']!=13)
        $list[$a['RelationshipId']]=$a['RelationshipDesc'];
      }
    }else{
      foreach($dataentity as $a){
        $list[$a['RelationshipId']]=$a['RelationshipDesc'];
      }
    }
  endif; // End Check
	return $list;
}

public function getRelationInsured($id=0,$exclude=array()){
	$list=array();
	$data=array(
		'KEY'=>'98B7D9E29548B7D9AA615312B72AA696',
		'PRODUCT_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataProduct.asmx/GetInsuredRelationshipByProductIDinXML','InsuredRelationship');
	if(!isset($dataentity[0])) return array($dataentity['InsuredRelationshipID']=>$dataentity['InsuredRelationshipDescription']);
	foreach($dataentity as $a){
		if(!in_array($a['InsuredRelationshipID'],$exclude)) $list[$a['InsuredRelationshipID']]=$a['InsuredRelationshipDescription'];
	}
	return $list;
}

public function getRelationInsuredById($id=0,$prod=0){
	$list=$this->getRelationInsured($prod);
	return $list[$id];
}

public function getArrayRelation($ar=array()){ 
	if(!isset($ar[0])) return array();
	else{
		$total=count($ar);
		 $i=0;
		while($i<$total){
			$list[$i]=$ar[$i]['INSURED_RELATIONSHIP_ID'];
			$i++; 
		} 
	return $list;
	}
}

public function getOptPP($min=1,$max=1){
	while($min<=$max){
		$list[$min]=$min.' Tahun';
		$min++;
	}
	return $list;
}

public function getOptPPAnd($first=1,$second=1){
		$list[$first]=$first.' Tahun';
		$list[$second]=$second.' Tahun';

	return $list;
}

public function getOptUp($min=0,$max=0,$multiply=0){
	if($multiply==0) return null;
	App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php'));
	$i=$min;
	while($i <= $max){
		$list[$i]=rp($i);
		$i=$i+$multiply;
	}
	return $list;
}

public function getRelationAHListById($id=0){
	$list=$this->getRelationAHList();
	return $list[$id];
}


public function getAge($tgl='',$fmt='Y-m-d'){
	$tz = new DateTimeZone('Asia/Jakarta');
	$age = DateTime::createFromFormat($fmt, $tgl, $tz)
	->diff(new DateTime('now', $tz));
	return $age->y;
}

public function storeUnitLink($data,$real_prospect=false){
			$data[1]['SUM_INSURED']=preg_replace("/[^0-9]/","",$data[1]['SUM_INSURED']);
			if(isset($data[3]['SUM_INSURED'])) $data[3]['SUM_INSURED']=preg_replace("/[^0-9]/","",$data[3]['SUM_INSURED']);
			if(isset($data[4]['SUM_INSURED'])) $data[4]['SUM_INSURED']=preg_replace("/[^0-9]/","",$data[4]['SUM_INSURED']);
			$age=$this->getAge($data['PROSPECT_DOB']);
			if(!$real_prospect) $id_prospect=$this->saveTertanggung("_",$data['PROSPECT_DOB'],$data['PROSPECT_GENDER']);
			else {
				$id_prospect=$this->saveProspect($real_prospect['PROSPECT_EMAIL'],$real_prospect['PROSPECT_NAME'],$data['PROSPECT_DOB'],$data['PROSPECT_GENDER']);
				$prospect=array_merge($data,$real_prospect);
				$prospect['PROSPECT_ID']=$id_prospect;
				$this->updateProspect($prospect);
			}
			$id_quotation=$this->saveQuotation($id_prospect,$id_prospect,$data['product_id']);
			if(CakeSession::check('Purchase.Ahliwaris') && is_array($real_prospect))
			
			{
				$ahData=CakeSession::read('Purchase.Ahliwaris');
				$i=1;while($i<=count($ahData)){
					$idAh[$i]=$this->saveAhliWaris($id_quotation,$ahData[$i]);
					$ahData[$i]['PROSPECT_ID']=$idAh[$i];
					$this->updateProspect($ahData[$i]);
					$i++;
				}
				CakeSession::write('Purchase.ID_AH',$idAh); 
			}
			$product = $this->getProductbyID($data['product_id']); 
			$premium=preg_replace("/[^0-9]/","",$data['PREMI']); 
      $fee_print=($data['HARD_COPY']=='Y')?50000:0;
			$_tmp = $this->updateQuotation(array(
			'QUOTE_ID'=>$id_quotation,
			'QUOTE_PRIMARY_FUND_TYPE_ID'=>$data['QUOTE_PRIMARY_FUND_TYPE_ID'],
			'QUOTE_PREMIUM_LIFESPAN'=>$data['QUOTE_PREMIUM_LIFESPAN'],
			'QUOTE_PREMIUM_MODE'=>$data['QUOTE_PREMIUM_MODE'],
			'QUOTE_STAMP_FEE'=>$product['product_stamp_fee'],
			'QUOTE_REGULAR_FEE'=>$product['product_regular_fee'],
			'QUOTE_SINGLE_PREMIUM'=>($data['QUOTE_PREMIUM_MODE']==0)?($premium+500000):500000,
			'QUOTE_REGULAR_PREMIUM'=>($data['QUOTE_PREMIUM_MODE']!=0)?$premium:0,
			//'QUOTE_INITIAL_FEE'=>($premium<100000000)?round(($product['product_initial_fee']*0.005),0):floatval($product['product_initial_pct']),
			'QUOTE_INITIAL_FEE'=>500000,
      'QUOTE_PAPER_PRINT_FEE'=>$fee_print
			)); 
			$id_insured=$this->saveInsuredID($id_quotation,$id_prospect);
			$premium_amount[1]=$this->getPremiumRate(1,$data['QUOTE_PREMIUM_MODE'],$age,$data['PROSPECT_GENDER'],isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,$data[1]['SUM_INSURED']);
			$data_coverage=array(
			'QUOTE_ID'=>$id_quotation,
			'COVERAGE_TYPE_ID'=>1,
			'QUOTE_INSURED_ID'=>$id_insured,
			'DURATION_DAYS'=>0,
			'SUM_INSURED'=>$data[1]['SUM_INSURED'],
			'PREMIUM_AMOUNT'=>round($premium_amount[1],0),
			'DURATION'=>$data['QUOTE_PREMIUM_LIFESPAN'],
			);
			$id_coverage[1]=$this->saveCoverageID($data_coverage);
			
			if(isset($data[3]['SUM_INSURED'])) { 
				$premium_amount[3]=$this->getPremiumRate(1,$data['QUOTE_PREMIUM_MODE'],$age,$data['PROSPECT_GENDER'],isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,$data[3]['SUM_INSURED']);
				$data_coverage['COVERAGE_TYPE_ID']=3;
				$data_coverage['PREMIUM_AMOUNT']=$premium_amount[3];
				$data_coverage['SUM_INSURED']=round($data[3]['SUM_INSURED'],0);
				$id_coverage[3]=$this->saveCoverageID($data_coverage);
			}
			
			if(isset($data[4]['SUM_INSURED'])) {
				$premium_amount[4]=$this->getPremiumRate(1,$data['QUOTE_PREMIUM_MODE'],$age,$data['PROSPECT_GENDER'],isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,$data[4]['SUM_INSURED']);
				$data_coverage['COVERAGE_TYPE_ID']=4;
				$data_coverage['PREMIUM_AMOUNT']=round($premium_amount[4],0);
				$data_coverage['SUM_INSURED']=$data[4]['SUM_INSURED'];
				$id_coverage[4]=$this->saveCoverageID($data_coverage);
			}
			$id_fund=$this->saveFundID($id_quotation,$data['QUOTE_PRIMARY_FUND_TYPE_ID'],($data['QUOTE_PREMIUM_MODE']!=0)?$premium:0);
			//echo $id_prospect.' '.$id_quotation.' '.$id_insured.' '.$id_fund;var_dump($id_coverage);var_dump($premium_amount);die();
			
      //Req HARD_COPY
      if($data['HARD_COPY']=='Y'){
        $premium=$premium+50000;
      }
      CakeSession::write('Purchase.PROSPECT_ID',$id_prospect);
			CakeSession::write('Purchase.QUOTE_ID',$id_quotation);
			CakeSession::write('Purchase.QUOTE_INSURED_ID',$id_insured);
			CakeSession::write('Purchase.QUOTE_COVERAGE_ID',$id_coverage);
			CakeSession::write('Purchase.QUOTE_FUND_ID',$id_fund);
			CakeSession::write('Purchase.FUND_DESC',$this->getFundList($data['QUOTE_PRIMARY_FUND_TYPE_ID']));
			CakeSession::write('Purchase.premi', array('mode'=>$data['QUOTE_PREMIUM_MODE'],'total_premi'=>($premium+500000),'frek'=>$this->dataPremimode($data['QUOTE_PREMIUM_MODE'])));
      
}


public function setProspectCust(){
	$user=CakeSession::read('Auth.User');
	$step1=(CakeSession::check('Purchase.step1'))?array_merge(CakeSession::read('Purchase.step1'),array('PROSPECT_DOB'=>substr($user['CustomerDOB'], 0, 10),'PROSPECT_GENDER'=>$user['CustomerGender'])):array('PROSPECT_DOB'=>substr($user['CustomerDOB'], 0, 10),'PROSPECT_GENDER'=>$user['CustomerGender']);
	$step2=array('PROSPECT_NAME'=>$user['CustomerName'],'PROSPECT_NRIC'=>$user['CustomerNRIC'],'PROSPECT_EMAIL'=>$user['CustomerEmail'],'PROSPECT_MOBILE_PHONE'=>$user['CustomerMobilePhone'],'PROSPECT_ADDRESS'=>$user['CustomerAdress']);
	CakeSession::write('Purchase.step1',$step1);
	CakeSession::write('Purchase.step2',$step2);
}

public function saveCustomer($ses=array(),$ah=array()){
	$data['KEY']='8BA2A7D26EF81031B12AA697E71DFE9';
	$data['CUSTOMER_NAME']=isset($ses['step2']['PROSPECT_NAME'])?$ses['step2']['PROSPECT_NAME']:$ah['PROSPECT_NAME'];
	$data['CUSTOMER_NRIC']=' ';
	$data['CUSTOMER_ID_TYPE']=' ';
	$data['CUSTOMER_DOB']=isset($ses['step1']['PROSPECT_DOB'])?$ses['step1']['PROSPECT_DOB']:$ah['PROSPECT_DOB'];
	$data['CUSTOMER_BIRTH_PLACE']=' ';
	$data['CUSTOMER_GENDER']=isset($ses['step1']['PROSPECT_GENDER'])?$ses['step1']['PROSPECT_GENDER']:$ah['PROSPECT_GENDER'];
	$data['CUSTOMER_MOBILE_PHONE']=isset($ses['step2']['PROSPECT_MOBILE_PHONE'])?$ses['step2']['PROSPECT_MOBILE_PHONE']:$ah['PROSPECT_MOBILE_PHONE'];
	$data['CUSTOMER_WORK_PHONE']=' ';
	$data['CUSTOMER_EMAIL']=isset($ses['step2']['PROSPECT_EMAIL'])?$ses['step2']['PROSPECT_EMAIL']:$ah['PROSPECT_EMAIL'];
	$data['CUSTOMER_ADDRESS']=isset($ses['step2']['PROSPECT_ADDRESS'])?$ses['step2']['PROSPECT_ADDRESS']:' ';
	$data['CUSTOMER_CITY']=' ';
	$data['CUSTOMER_POSTAL_CODE']=' ';
	$data['CUSTOMER_PHONE']=' ';
	$data['CUSTOMER_ADDRESS_COR']=' ';
	$data['CUSTOMER_CITY_COR']=' ';
	$data['CUSTOMER_POSTAL_CODE_COR']=' ';
	$data['CUSTOMER_PHONE_COR']=' ';
	$data['CUSTOMER_BANK_ACCOUNT']=' ';
	$data['CUSTOMER_ACCOUNT_NAME']=' ';
	$data['CUSTOMER_BANK_NAME']=0;
	$data['CUSTOMER_BANK_BRANCH']=' ';
	$data['CUSTOMER_TAX_NO']=' ';
	$data['CUSTOMER_RELIGION']=0;
	$data['CUSTOMER_MARITAL_STATUS']=0;
	$data['CUSTOMER_JOB']=' ';
	$data['CUSTOMER_JOB_LEVEL']=' ';
	$data['CUSTOMER_GROSS_SALARY']=1;
	$data['CUSTOMER_OTHER_INCOME']=1;
	$data['CUSTOMER_PURPOSE_POLICY']=1;
	$data['CUSTOMER_HOBBY']=' ';
	$data['CUSTOMER_HEIGHT']=1;
	$data['CUSTOMER_WEIGHT']=1;
	$data['CUSTOMER_REGION_ID']=0;
	$data['CUSTOMER_REGION_COR_ID']=0;
	
	$dataentity=$this->sendData($data,'InputCustomer.asmx/InsertCustomerinXML','Result');
    return $dataentity['Result'];

}

   public function saveShortTermPolicy($idCustomer,$token,$method="IB"){ 
	$ses=CakeSession::read('Purchase');
	$printfee=0;
	if($ses['step1']['HARD_COPY']=='Y'){
		$printfee=50000;
	} else if(isset($ses['step1']['QUOTE_DURATION_DAYS']) && $ses['step1']['QUOTE_DURATION_DAYS']>=180){
		$printfee=25000;
	}
	$data['KEY']='B7D1D925644B1032B72AA697044B6E47';
	$data['POLICY_HOLDER_ID']=$idCustomer;
	$data['POLICY_CUSTOMER_ID']=$idCustomer;
	$data['POLICY_PREMIUM_MODE']="0";
	$data['POLICY_DURATION_YEARS']=isset($ses['step1']['QUOTE_PREMIUM_LIFESPAN'])?$ses['step1']['QUOTE_PREMIUM_LIFESPAN']:0;
	$data['POLICY_DURATION_DAYS']=isset($ses['step1']['QUOTE_DURATION_DAYS'])?$ses['step1']['QUOTE_DURATION_DAYS']:0;
	$data['POLICY_DURATION_HOURS']=isset($ses['step1']['QUOTE_DURATION_HOUR'])?$ses['step1']['QUOTE_DURATION_HOUR']:0;
	$data['POLICY_DETAILS']=' ';
	$data['POLICY_SUM_INSURED']=$ses['step1']['SUM_INSURED'];
	//$data['POLICY_COMMENCE_DATE']=$token['transactionDate'];
	$data['POLICY_COMMENCE_DATE']=$ses['step1']['WAKTU_PERLINDUNGAN'];
	$data['POLICY_ADMIN']=' ';
	$data['POLICY_PRODUCT_ID']='7';
	//$data['BENEFICIARY_CUSTOMER_ID']=$idAhliwaris;
	//$data['RELATIONSHIP_ID']=$relationship;
	$data['POLICY_WORKSITE_ID']="0";
	$data['POLICY_AGENT_ID']="0";
	$data['POLICY_PREMIUM_AMOUNT']=$ses['premi']['total_premi'];
	$data['POLICY_PREMIUM_FACTOR']="1";
	$data['POLICY_PREMIUM_RATE']=$ses['premi']['total_premi'];
	$data['POLICY_PAYMENT_METHOD']=$method;
	$data['POLICY_SOURCE_DATA']="1";
	$data['PAYMENT_DATE']=$token['transactionDate'];
	$data['RECEIPT_SOURCE']=$method;
	$data['BANK_ACC_ID']="2";
	$data['MERCHANT_TRANS_NO']= $token['transactionNo'];
	$data['TRANSACTION_DT']= $token['transactionDate'];
	$data['POLICY_PAPER_PRINT_FEE']= $printfee;
	$data['CURRENCY']= $token['currency'];
	$data['AMOUNT_PAYMENT']= $token['totalAmount'];
	$data['MISC_FEE']= $token['miscFee'];
	$data['PRODUCT_TYPE']=' ';
	$dataentity=$this->sendData($data,'InputPolicy.asmx/InsertPolicyShortTerminXML','Result');
    return $dataentity['Result'];
}
  
  
  public function ShortTermBeneficairy($idPolicy, $idBeneficary, $relationship){  
	$data['KEY']='B7D1D925644B1032B72AA697044B6E47'; 
	$data['POLICY_ID']=$idPolicy;
	$data['CUSTOMER_ID']=$idBeneficary;
	$data['RELATIONSHIP_ID']=$relationship; 
    //edit-yusuf
	$dataentity=$this->sendData($data,'InputPolicy.asmx/InsertShortTermBeneficiaryinXML','Result');
    return $dataentity['Result'];
    //return true;
}
  
  public function updateShortTermPolicyBCA($id, $tokBCA){  
	$data['KEY']='B7D1D925644B1032B72AA697044B6E47'; 
	$data['POLICY_ID']=$id;
	$data['TRANSACTION_DT']=$tokBCA['transactionDate'];
	$data['RESULT_STATUS']=($tokBCA['reason_id']==1)?'00':'01';
	$data['REMARK']=$tokBCA['reason_ind'];
	$data['RESULT_DT']=date('Y-m-d H:i:s');
	$data['REFERENCE_PG_1']=$tokBCA['transactionNo'];
	$data['REFERENCE_PG_2']=$tokBCA['authKey'];
	$data['REFERENCE_PG_3']=$tokBCA['approvalCode'];
	$data['REFERENCE_PG_4']='';
	$data['REFERENCE_PG_5']='';
	$dataentity=$this->sendData($data,'InputPolicy.asmx/UpdateShortTermPolicyPaymentGatewayinXML','Result');
    return $dataentity['Result'];
}


  public function updateShortTermPolicyEcash($id, $tokCC){  
	$data['KEY']='B7D1D925644B1032B72AA697044B6E47'; 
	$data['POLICY_ID']=$id;
	$data['TRANSACTION_DT']=date('Y-m-d H:i:s');
	$data['RESULT_STATUS']=$tokCC[4];
	$data['REMARK']="";
	$data['RESULT_DT']=date('Y-m-d H:i:s');
	$data['REFERENCE_PG_1']=$tokCC[0];
	$data['REFERENCE_PG_2']=$tokCC[1];
	$data['REFERENCE_PG_3']=$tokCC[2];
	$data['REFERENCE_PG_4']=$tokCC[3];
	$data['REFERENCE_PG_5']=$tokCC[4];
	$dataentity=$this->sendData($data,'InputPolicy.asmx/UpdateShortTermPolicyPaymentGatewayinXML','Result');
    return $dataentity['Result'];
}

  public function updateShortTermPolicyCC($id, $tokCC, $dateTransaction){  
	$data['KEY']='B7D1D925644B1032B72AA697044B6E47'; 
	$data['POLICY_ID']=$id;
	$data['TRANSACTION_DT']=$dateTransaction;
	$data['RESULT_STATUS']=$tokCC['transactionStatus'];
	$data['REMARK']=$tokCC['scrubMessage'];
	$data['RESULT_DT']=date('Y-m-d H:i:s');
	$data['REFERENCE_PG_1']=$tokCC['cardNo'];
	$data['REFERENCE_PG_2']=$tokCC['transactionType'];
	$data['REFERENCE_PG_3']=$tokCC['acquirerApprovalCode'];
	$data['REFERENCE_PG_4']=$tokCC['transactionID'];
	$data['REFERENCE_PG_5']=$tokCC['acquirerCode'];
	$dataentity=$this->sendData($data,'InputPolicy.asmx/UpdateShortTermPolicyPaymentGatewayinXML','Result');
    return $dataentity['Result'];
}
 
 
 public function storeNonUnitLink($data,$real_prospect){   
			$age=$this->getAge($data['PROSPECT_DOB']);
			$id_prospect=$this->saveProspect($real_prospect['PROSPECT_EMAIL'],$real_prospect['PROSPECT_NAME'],$data['PROSPECT_DOB'],$data['PROSPECT_GENDER']);
			$prospect=array_merge($data,$real_prospect);
			$prospect['PROSPECT_ID']=$id_prospect;
			$this->updateProspect($prospect);
			$id_quotation=$this->saveQuotation($id_prospect,$id_prospect,$data['product_id']);
			$ahData=CakeSession::read('Purchase.Ahliwaris');
			$i=1;while($i<=count($ahData)){
				$idAh[$i]=$this->saveAhliWaris($id_quotation,$ahData[$i]);
				$ahData[$i]['PROSPECT_ID']=$idAh[$i];
				$this->updateProspect($ahData[$i]);
				$i++;
			}
			$product = $this->getProductbyID($data['product_id']); 
			$premium=round($this->getPremiumRate($data['COVERAGE_TYPE_ID'],$data['QUOTE_PREMIUM_MODE'],$this->getAge($data['PROSPECT_DOB']),$data['PROSPECT_GENDER'],isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,$data['SUM_INSURED'],isset($data['QUOTE_DURATION_HOUR'])?$data['QUOTE_DURATION_HOUR']:0),0); 
			if($data['product_id']!='5'): $fee_print=($data['HARD_COPY']=='Y')?50000:0; endif;
		    if($data['product_id']=='21'): $cashless=($data['CASHLESS']=='Y')?35000:0; endif;
      $_tmp = $this->updateQuotation(array(
			'QUOTE_ID'=>$id_quotation,
			'QUOTE_PRIMARY_FUND_TYPE_ID'=>0,
			'QUOTE_PREMIUM_LIFESPAN'=>(isset($data['QUOTE_PREMIUM_LIFESPAN']))?$data['QUOTE_PREMIUM_LIFESPAN']:0,
			'QUOTE_PREMIUM_MODE'=>$data['QUOTE_PREMIUM_MODE'],
			'QUOTE_STAMP_FEE'=>$product['product_stamp_fee'],
			'QUOTE_REGULAR_FEE'=>$product['product_regular_fee'],
			'QUOTE_SINGLE_PREMIUM'=>($data['QUOTE_PREMIUM_MODE']==0)?$premium:0,
			'QUOTE_REGULAR_PREMIUM'=>($data['QUOTE_PREMIUM_MODE']!=0)?$premium:0,
			'QUOTE_INITIAL_FEE'=>($premium<100000000)?round(($product['product_initial_fee']*0.005),0):floatval($product['product_initial_pct']),
      'QUOTE_PAPER_PRINT_FEE'=>($data['product_id']!='5')?$fee_print:0,
	  'QUOTE_CASHLESS_FEE'=>($data['product_id']=='21')?$cashless:0
	  
      )); 
			
			$data_coverage=array(
					'QUOTE_ID'=>$id_quotation,
					'COVERAGE_TYPE_ID'=>$data['COVERAGE_TYPE_ID'],
					'SUM_INSURED'=>$data['SUM_INSURED'],
					'DURATION_DAYS'=>isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,
					'PREMIUM_AMOUNT'=>round($premium,0),
					'DURATION'=>isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,
					);
			if($real_prospect['me']=='Y') {
					$id_insured=$this->saveInsuredID($id_quotation,$id_prospect);
					$data_coverage['QUOTE_INSURED_ID']=$id_insured;
					$id_coverage=$this->saveCoverageID($data_coverage);
			}
			//save Tertanggung
			$taData=CakeSession::read('Purchase.Tertanggung');  
			$i=0;while($i<count($taData)){
				if(($real_prospect['me']!='Y' && $taData[$i]['INSURED_RELATIONSHIP_ID']==1) || $taData[$i]['INSURED_RELATIONSHIP_ID']!=1) {
					$idTAInsured=$this->saveInsuredID($id_quotation,$taData[$i]['ID_PROSPECT'],$taData[$i]['INSURED_RELATIONSHIP_ID']);  
					$data_coverage['QUOTE_INSURED_ID']=$idTAInsured;  
					$data_coverage['PREMIUM_AMOUNT']=round($this->getPremiumRate($data['COVERAGE_TYPE_ID'],$data['QUOTE_PREMIUM_MODE'],$taData[$i]['AGE'],$data['PROSPECT_GENDER'],isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,$data['SUM_INSURED'],isset($data['QUOTE_DURATION_HOUR'])?$data['QUOTE_DURATION_HOUR']:0),0);
					$id_coverageTA=$this->saveCoverageID($data_coverage);
					CakeSession::write('Purchase.Tertanggung.'.$i.'.ID_INSURED',$idTAInsured);
					CakeSession::write('Purchase.Tertanggung.'.$i.'.ID_COVERAGE',$id_coverageTA);
				}
				$i++;
			}
			
			if($data['QUOTE_PREMIUM_MODE']!=0){
				$totalpremi=$this->getQuoteByID($id_quotation,array('QuoteRegulerPremium'))['QuoteRegulerPremium'];
				if ($data['product_id']='21')
				{ 
					$totalpremi=round(CakeSession::read('PremiumJSK'),0);
				}
			}
			else {
				$totalpremi=$this->getQuoteByID($id_quotation,array('QuoteSinglePremium'))['QuoteSinglePremium'];
			}
      
      //Req HARD_COPY
      if($data['product_id']!='5'):
        if($data['HARD_COPY']=='Y'){
          $totalpremi=$totalpremi+50000;
        }
	  endif;
	  
	  if($data['product_id']=='21'):
        if($data['CASHLESS']=='Y'){
          $totalpremi=$totalpremi+35000;
        }
      endif;
			$allTA=$this->getCoverageList($id_quotation,array('InsuredType','ProspectName','ProspectGender','ProspectDOB','PremiumAmount'));
			CakeSession::write('Purchase.allTA',$allTA);
			CakeSession::write('Purchase.premi.total_premi',$totalpremi);
			CakeSession::write('Purchase.PROSPECT_ID',$id_prospect);
			CakeSession::write('Purchase.QUOTE_ID',$id_quotation);
			CakeSession::write('Purchase.ID_AH',$idAh); 
}

public function getCoverageList($id=0,$field=null){
	$list=array();
	$data=array(
		'KEY'=>'548B7D9AA615312B72AA6966970B6696',
		'QUOTE_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataQuote.asmx/GetQuoteCoverageDatainXML','QuoteCoverage');
	if($field==null) {
		return $dataentity;
	} else {
		$i=0;
		if(isset($dataentity[0])) {
			foreach($dataentity as $data){
				foreach($data as $key=>$value){
					if(in_array($key,$field)) $tmp[$key]=$value;
				}
			$list[$i]=$tmp;
			$i++;
			} 
		} else {
			foreach($dataentity as $key=>$value){
				if(in_array($key,$field)) $tmp[$key]=$value;
			} 
			$list[0]=$tmp; 
		}
		
	}
	return $list;
}
 
public function storeNonUnitLinkOld($data,$real_prospect){
			$age=$this->getAge($data['PROSPECT_DOB']);
			$id_prospect=$this->saveProspect($real_prospect['PROSPECT_EMAIL'],$real_prospect['PROSPECT_NAME'],$data['PROSPECT_DOB'],$data['PROSPECT_GENDER']);
			$prospect=array_merge($data,$real_prospect);
			$prospect['PROSPECT_ID']=$id_prospect;
			$this->updateProspect($prospect);
			$id_quotation=$this->saveQuotation($id_prospect,$id_prospect,$data['product_id']);
			$ahData=CakeSession::read('Purchase.Ahliwaris');
			$i=1;while($i<=count($ahData)){
				$idAh[$i]=$this->saveAhliWaris($id_quotation,$ahData[$i]);$i++;
			}
			$product = $this->getProductbyID($data['product_id']); 
			$premium=round(CakeSession::read('Purchase.premi.total_premi'),0); 
			$data2=CakeSession::read('Purchase.step1');
			$premium=$this->getPremiumRate($data2['COVERAGE_TYPE_ID'],$data2['QUOTE_PREMIUM_MODE'],$age,$data2['PROSPECT_GENDER'],isset($data2['QUOTE_PREMIUM_LIFESPAN'])?$data2['QUOTE_PREMIUM_LIFESPAN']:0,isset($data2['QUOTE_DURATION_DAYS'])?$data2['QUOTE_DURATION_DAYS']:0,$data2['SUM_INSURED'],isset($data2['QUOTE_DURATION_HOUR'])?$data2['QUOTE_DURATION_HOUR']:0);
			
			$_tmp = $this->updateQuotation(array(
			'QUOTE_ID'=>$id_quotation,
			'QUOTE_PRIMARY_FUND_TYPE_ID'=>0,
			'QUOTE_PREMIUM_LIFESPAN'=>(isset($data['QUOTE_PREMIUM_LIFESPAN']))?$data['QUOTE_PREMIUM_LIFESPAN']:0,
			'QUOTE_PREMIUM_MODE'=>$data['QUOTE_PREMIUM_MODE'],
			'QUOTE_STAMP_FEE'=>$product['product_stamp_fee'],
			'QUOTE_REGULAR_FEE'=>$product['product_regular_fee'],
			'QUOTE_SINGLE_PREMIUM'=>($data['QUOTE_PREMIUM_MODE']==0)?$premium:0,
			'QUOTE_REGULAR_PREMIUM'=>($data['QUOTE_PREMIUM_MODE']!=0)?$premium:0,
			'QUOTE_INITIAL_FEE'=>($premium<100000000)?round(($product['product_initial_fee']*0.005),0):floatval($product['product_initial_pct']),
			)); 
			$id_insured=$this->saveInsuredID($id_quotation,$id_prospect);
			
			$data_coverage=array(
			'QUOTE_ID'=>$id_quotation,
			'COVERAGE_TYPE_ID'=>$data['COVERAGE_TYPE_ID'],
			'QUOTE_INSURED_ID'=>$id_insured,
			'SUM_INSURED'=>$data['SUM_INSURED'],
			'DURATION_DAYS'=>isset($data['QUOTE_DURATION_DAYS'])?$data['QUOTE_DURATION_DAYS']:0,
			'PREMIUM_AMOUNT'=>round($premium,0),
			'DURATION'=>isset($data['QUOTE_PREMIUM_LIFESPAN'])?$data['QUOTE_PREMIUM_LIFESPAN']:0,
			);
			$id_coverage=$this->saveCoverageID($data_coverage);
			CakeSession::write('Purchase.PROSPECT_ID',$id_prospect);
			CakeSession::write('Purchase.premi.total_premi',$premium);
			CakeSession::write('Purchase.QUOTE_ID',$id_quotation);
			CakeSession::write('Purchase.ID_AH',$idAh);
			CakeSession::write('Purchase.QUOTE_INSURED_ID',$id_insured);
			CakeSession::write('Purchase.QUOTE_COVERAGE_ID',$id_coverage);

}

public function getMappingProd($name="",$cat=""){
	$prod=array(
		'caf-flexy-link'=>array('product_id'=>1,'cat'=>'unit-link'),
		
		'jaga-sehat-dbd'=>array('product_id'=>5,'cat'=>'non-unit-link','pp'=>'dropdown'),
		'jaga-aman'=>array('product_id'=>13,'cat'=>'non-unit-link'),
		'jaga-aman-instan'=>array('product_id'=>7,'cat'=>'non-unit-link'),
		'jaga-sehat-plus'=>array('product_id'=>11,'cat'=>'non-unit-link'),
		'jaga-jiwa'=>array('product_id'=>12,'cat'=>'non-unit-link'),
		'jaga-sehat'=>array('product_id'=>9,'cat'=>'non-unit-link'),
		'jaga-jiwa-plus'=>array('product_id'=>14,'cat'=>'non-unit-link'),
		'jaga-jiwa-plus5'=>array('product_id'=>14,'cat'=>'non-unit-link'),
		'jaga-aman-plus5'=>array('product_id'=>17,'cat'=>'non-unit-link'),
		'jaga-aman-plus'=>array('product_id'=>17,'cat'=>'non-unit-link'),
		'jaga-aman-plus7'=>array('product_id'=>18,'cat'=>'non-unit-link'),
		'jaga-jiwa-plus7'=>array('product_id'=>15,'cat'=>'non-unit-link'),
		'jaga-sehat-keluarga'=>array('product_id'=>21,'cat'=>'non-unit-link'),
		
	);
	if(isset($prod[$name]) && $prod[$name]['cat']==$cat) return $prod[$name]; else throw new NotFoundException('Could not find that product'); 
}

public function getValidUrl($sid="",$cat="",$name=""){
	if(CakeSession::read('Purchase.token')!=$sid || !CakeSession::check('Purchase.token')){
		return false;
	} else if(CakeSession::read('Purchase.flow.cat')!=$cat || !CakeSession::check('Purchase.flow.cat')){
		return false;
	} else if(CakeSession::read('Purchase.flow.name')!=$name || !CakeSession::check('Purchase.flow.name')){
		return false;
	}
	return true;
}
public function getSignatureBCA($klikPayCode, $transactionNo, $currency, $clearKey, $transactionDate, $totalAmount){
	 App::import('Vendor', 'klikpaykeys', array('file'=>'utility' . DS .'klikpaykeys.php')); 
	 $bcakey = new KlikPayKeys;
	 $signature = $bcakey->signature($klikPayCode, $transactionNo, $currency, $clearKey, $transactionDate, $totalAmount);
	 return $signature;
}
public function getAuth($klikPayCode, $transactionNo, $currency, $clearKey, $transactionDate){
	 App::import('Vendor', 'klikpaykeys', array('file'=>'utility' . DS .'klikpaykeys.php')); 
	 $bcakey = new KlikPayKeys;
	 $authkey = $bcakey->authkey($klikPayCode, $transactionNo, $currency, $clearKey, $transactionDate);
	 return $authkey;
}

public function getPeriodAmanInstan($id=0){
	$list=array();
	$data=array(
		'KEY'=>'98B7D9E29548B7D9AA615312B72AA696',
		'COVERAGE_TYPE_ID'=>$id
		);
	$dataentity=$this->getData($data,'DataProduct.asmx/GetCoverageDurationDataByCoverageTypeIDinXML','CoverageDuration');
		foreach($dataentity as $data){
			if($data['coverage_from']!=0) $list['year'.$data['coverage_from']]=$data['coverage_from'].' Tahun';
			else if ($data['coverage_days_from']!=0) {
				if($data['coverage_days_from']==7) $list['days'.$data['coverage_days_from']]='7 Hari';
				else if($data['coverage_days_from']==30) $list['days'.$data['coverage_days_from']]='30 Hari';
				else if($data['coverage_days_from']==90) $list['days'.$data['coverage_days_from']]='90 Hari'; 
				else if($data['coverage_days_from']==120) $list['days'.$data['coverage_days_from']]='120 Hari';
				else if($data['coverage_days_from']==180) $list['days'.$data['coverage_days_from']]='180 Hari';
				else if($data['coverage_days_from']==360) $list['days'.$data['coverage_days_from']]='360 Hari';
				
				else $list['days'.$data['coverage_days_from']]=$data['coverage_days_from'].' Hari';
			}
			
			else if ($data['coverage_hours_from']!=0) $list['hour'.$data['coverage_hours_from']]=$data['coverage_hours_from'].' Jam';
		}
		return $list;
}


public function saveLineQuizCustomer($data){
	$save_data['KEY']='8BA2A7D26EF81031B12AA697E71DFE9';
	$save_data['CUSTOMER_NAME']=isset($data['PROSPECT_NAME'])?$data['PROSPECT_NAME']:'';
	$save_data['CUSTOMER_DOB']=isset($data['PROSPECT_DOB'])?$data['PROSPECT_DOB']:'';
	$save_data['CUSTOMER_GENDER']=isset($data['PROSPECT_GENDER'])?$data['PROSPECT_GENDER']:'';
	$save_data['CUSTOMER_MOBILE_PHONE']=isset($data['PROSPECT_MOBILE_PHONE'])?$data['PROSPECT_MOBILE_PHONE']:'';
	$save_data['CUSTOMER_EMAIL']=isset($data['PROSPECT_EMAIL'])?$data['PROSPECT_EMAIL']:'';
	
	$dataentity=$this->sendData($save_data,'InputCustomer.asmx/InsertCustomerGroupinXML','Result');
    return $dataentity['Result'];

}

public function GenerateLineQuizPolicyCustomer ($customer_id) {
	$data['KEY']='B7D1D925644B1032B72AA697044B6E47';
	$data['CUSTOMER_ID'] = $customer_id;
	$dataentity=$this->sendData($data,'InputPolicy.asmx/GenerateGroupPolicyinXML','Result');
	return $dataentity['Result'];
}

public function saveLineQuizBeneficiary($data){
	$save_data['KEY']='8BA2A7D26EF81031B12AA697E71DFE9';
	$save_data['CUSTOMER_NAME']=isset($data['PROSPECT_NAME_WARIS'])?$data['PROSPECT_NAME_WARIS']:'';
	$save_data['CUSTOMER_BIRTH_PLACE']='';
	$save_data['CUSTOMER_DOB']=isset($data['PROSPECT_DOB_WARIS'])?$data['PROSPECT_DOB_WARIS']:'';
	$save_data['CUSTOMER_GENDER']=isset($data['PROSPECT_GENDER_WARIS'])?$data['PROSPECT_GENDER_WARIS']:'';
	$dataentity=$this->sendData($save_data,'InputCustomer.asmx/InsertCustomerGroupBriefinXML','Result');
    return $dataentity['Result'];
}

public function GenerateLineQuizPolicyBeneficiary($benef_id, $certificate_id, $relationship_id) {
	$save_data['key'] = '8BA2A7D26EF81031B12AA697E71DFE9';
	$save_data['CERTIFICATE_ID'] = $certificate_id;
	$save_data['CUSTOMER_ID'] = $benef_id;
	$save_data['RELATIONSHIP_ID'] = $relationship_id;
	
	$dataentity=$this->sendData($save_data,'InputCustomer.asmx/InsertGroupBeneficiaryinXML','Result');
	return $dataentity['Result'];
}

public function getEPolicyUrl($cartificate_id) {
	$data['KEY'] = '7FED54BA63911032B72AA697044B6E47';
	$data['CERTIFICATEID'] = $cartificate_id;

	$dataentity=$this->sendData($data,'datapolicy.asmx/GetGroupEPolicyinXML','Result');
	return $dataentity['Result'];	
}

public function InsertProspectMGM($hdr, $dtl_name, $dtl_phone) {

	$data=array(
		'KEY'=>'0BD7043E6D9B1032B72AA697044B6E47', 
		'PROSPECT_HDR_NAME'=> $hdr['name'],
		'PROSPECT_HDR_EMAIL'=> $hdr['email'],
		'PROSPECT_HDR_PHONE'=> $hdr['phone'],
		'PROSPECT_DTL_NAME'=> $dtl_name,
		'PROSPECT_DTL_PHONE'=> $dtl_phone
	);
	$dataentity=$this->sendData($data,'InputProspect.asmx/InsertProspectinJson_MGM','Result');
    return $dataentity['string'];
}


}
