<?php
App::uses('AppModel', 'Model');
class Cinema extends AppModel {
    public $useTable = 'test';

	public $validate = array(		 
		 'content' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		'nama_cinema' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
    ); 
	
}
?>