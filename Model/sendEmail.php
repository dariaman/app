<?php
App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');
class sendEmail extends AppModel {
	public $useTable = false; 
	
	public function forgot_password($email,$url,$name){
		$Email = new CakeEmail();
		$Email->viewVars(compact('url','name'));
		$Email->config('smtp');
		$Email->template('forgot_password');
		$Email->emailFormat('html');
        $Email->subject('Reset Password member jagadiri.co.id');
	    $Email->to(trim($email));
	    $Email->bcc('surya@aqi.co.id');
		$test=$Email->send();		
		return true;
	}
	
	public function hubungiKami($data){
		//$to=array('cs@jagadiri.co.id');
		//$bcc=array('surya@aqi.co.id');
		$to=array('samuel.wicaksana@jagadiri.co.id');
		$bcc=array('ronny.kusnardi@jagadiri.co.id');
		
		$Email = new CakeEmail();
		$Email->viewVars(compact('data'));
		$Email->config('smtp');
		$Email->template('hubungi_kami');
		$Email->emailFormat('html');
        $Email->subject('Hubungi Kami dari jagadiri.co.id');
	    $Email->to($to);
	    $Email->bcc($bcc);
		$test=$Email->send();		
		return true;
	}
	
	public function claim($data,$bank,$coverage=''){
		$to=array('cs@jagadiri.co.id');
		$bcc=array('surya@aqi.co.id');
		$Email = new CakeEmail();
		$Email->viewVars(compact('data','bank','coverage'));
		$Email->config('smtp');
		$Email->template('claim');
		$Email->emailFormat('html');
        $Email->subject('Claim dari jagadiri.co.id');
	    $Email->to($to);
	    $Email->bcc($bcc);
		$test=$Email->send();		
		return true;
	}
	
	public function leadsError($data){ 
		//$to=array('Jodie.Pratomo@jagadiri.co.id');
		//$cc=array('surya@aqi.co.id','paskal@aqi.co.id');

		$to=array('samuel.wicaksana@jagadiri.co.id');
		$cc=array('ronny.kusnardi@jagadiri.co.id');

		$Email = new CakeEmail();
		$Email->config('smtp');  
        $Email->subject('Jagadiri message send failure');
	    $Email->to($to); 
	    $Email->cc($cc); 
		$test=$Email->send(array(
		'Name: '.$data['name'],
		'Phone: '.$data['phone'],
		'Product: '.$data['prod'],
		'timeCall: '.$data['timeCall'],
		'timeLead: '.$data['timeLead'],
		'Email: '.$data['email']
		));		
		return true;
	}

}