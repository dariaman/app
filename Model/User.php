<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
	 public $actsAs = array(
        'Captcha' => array(
            'field' => array('captcha', 'captcha-2'),
            'error' => 'Captcha code entered invalid'
        )
    );

public $useTable = 'users';
    public $name = 'User';

    public $validate = array(
		 'name' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
      'email' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
		),
		'unique email'=> array(
				'rule'=>array('isUnique'),
				'message'=>'Email is already exist.'
				)
		),
		'password' => array(
          'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				),
				'match'=> array(
				'rule'=>'matchPassword2',
				'message'=>'Password isn\'t match'
				)
        ),
		 'password_confirmation' => array(
           'not Empty'=>array('rule' =>'notEmpty','message' => 'required'),
		   'match'=> array(
				'rule'=>'matchPassword',
				'message'=>'Password isn\'t match'
				)
            )
        );
		
	public function matchPassword($data){
		if($data['password_confirmation']== $this->data['User']['password']){
		return true;
		}
		return false;
	}
		public function matchPassword2($data){
		if( $data['password']== $this->data['User']['password_confirmation']){
		return true;
		}
		return false;
	}
	
	public function beforeSave($opt=null){
	return true;
	}
	
	
}