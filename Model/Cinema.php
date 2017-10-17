<?php
App::uses('AppModel', 'Model');
class Cinema extends AppModel {
    public $useTable = 'fm_cinema';

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