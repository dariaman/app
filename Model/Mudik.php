<?php
App::uses('AppModel', 'Model');
class Mudik extends AppModel {
    public $useTable = 'event_mudik';

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