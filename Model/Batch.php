<?php
App::uses('AppModel', 'Model');

class Rawat extends AppModel {
	public $name = 'Promo';
	public $useTable = 'aq_batch';
	public function getData(){
		 $db = $this->getDataSource();
	}
}
?>