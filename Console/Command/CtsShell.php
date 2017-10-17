<?php
class CtsShell extends AppShell {
	public $uses=array('ApiXml','Lead');
    public function main() { 
		$tmp=$this->Lead->find('all',array('conditions'=>array('Lead.status'=>0)));
		if($tmp!=null){
			foreach($tmp as $data){
				$id=$data['Lead']['id'];
				$name=$data['Lead']['name'];
				$phone=$data['Lead']['phone'];
				$prod=$data['Lead']['prod'];
				$timeCall=$data['Lead']['timeCall'];
				$timeLead=$data['Lead']['timeLead'];
				$email=$data['Lead']['email'];
				try{  
					$this->ApiXml->CTSGrandSpot($name, $phone, $prod, $timeCall,$timeLead,$email); 
					$status=1;
					$tmp_=$this->Lead->save(compact('id','name','phone','prod','timeCall','timeLead','email','status'));
				}
				catch(Exception $e){ 
					CakeLog::write('cts', 'Re-attempt error id: '.$id.' name: '.$name.' phone: '.$phone.' prod: '.$prod.' timeLead: '.$timeLead.' timeCall: '.$timeCall.' error: '.$e, 'cts');
				}
			}
			
		}
   }
   
}
?>