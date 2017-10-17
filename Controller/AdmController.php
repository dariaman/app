<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');



class AdmController extends AppController {

	public $uses=array('User','News','Member','Banner','Product','Category','LiveChat','Promo');
	public $captchas = array('captcha');
	public $components = array(
		'Captcha' => array(
			'type'   => array('alpha'),
			'rotate' => false,
			'theme'  => 'green',
			'height'=>40,
			'width'=>120,
			),
		'Session',
		'RequestHandler',
		'Security' => array(
			'csrfUseOnce' => false),
		'Cookie',
		'Auth' => array(
			'loginAction'=> array('controller'=>'adm','action'=>'login'),
			'logoutAction'=> array('controller'=>'adm','action'=>'login'),
			'authError' =>"you can't access that page",

			)
		);
	public $helpers = array(
		'Js' => array('Jquery')
		);
	public function isAuthorized($user) {
		return (bool)($user['role'] === 'admin'  || $user['role'] === 'cs');

		return false;
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->authenticate = array('Form');
		$this->Auth->authenticate = array(
			AuthComponent::ALL => array(
				'userModel' => 'User',
				'fields' => array(
					'username' => 'email',
					'password' => 'password'
					),
				'scope' => array(
					'User.suspended' => 0,'User.deleted' => 0,
					)
				),'Form'
			);
		$this->Auth->authorize=array('Controller');
		$this->Security->validatePost = false; 
		$this->Security->blackHoleCallback = 'redirectBC';
		$this->Security->csrfExpires = '+10 hour';
	//$this->cacheAction = true;
		$title_for_layout="Administrator Page";
		$headline  = "Admin Panel CAF";  //headline administrator
	// $this->Auth->allow(array('index','dealer','user','add_user','get_user_','edit_user'));
		$this->Auth->allow(array('captcha'));
		if($this->Session->read('Auth.User.role')=='frontCAF') 	$this->redirect(array('controller' => 'front', 'action' => 'logout'));
		$this->layout = "admin";
		$this->set(compact('title_for_layout','headline'));
	}

	public function index() {

	}

	public function banner(){
		$this->set('title_for_layout','Banner Management');
		$banners=$this->Banner->find('all');
		$menu='banner';
		$this->set(compact('menu','banners'));
	}

	public function upload_banner($id=0){
		$this->Banner->id = $id; 
		if (!$this->Banner->exists()) {
			$this->redirect(array('controller'=>'adm','action' => 'banner'));
		} else {
			if($this->request->is('post')){
				$this->Banner->getDataSource()->begin(); 
				if(!empty($this->request->data['Banner']['file_img']['name']))
				{
					$ext = substr($this->request->data['Banner']['file_img']['name'],-4,4);
					$this->request->data['Banner']['picture']=$this->Banner->FileUpload($this->request->data['Banner']['file_img']['name'],$this->request->data['Banner']['file_img']['tmp_name'],strtolower($ext));
					$this->request->data['Banner']['id']=$id;
				}
				if($this->Banner->save($this->request->data)){  
					$this->Banner->getDataSource()->commit();  
					$this->Session->setFlash(__('Banner successfully uploaded'),'default',array('class'=>'success'),'flash');
					$this->redirect(array('action' => 'banner'));
				}
				else {
					$this->Banner->getDataSource()->rollback(); 
					$this->Session->setFlash(__('Cannot uploaded Banner. Please try again'));
				}
			}
		}
	}


	public function generalnews() {
		$this->set('title_for_layout','News Management');
		$this->News->recursive = 0;
		$this->paginate = array(
			'paramType' => 'querystring',
			'order' => array('News.created'=>'Desc'),
			'limit' => 10
			);
		if(isset($this->request['url']['search_title'])) $tmp=strip_tags(trim($this->request['url']['search_title'])); else $tmp='';
		$news=$this->paginate('News',array('News.title like'=>'%'.$tmp.'%'));
		$s_id=$tmp;
		$menu='news';
		$this->set(compact('menu','news','s_id'));
	}
  
	private function validateDate($date){
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') == $date;
	}
  
  //function report chat lama / summary
  public function reportchat(){
    $menu='reportchat';
	$query=$this->request->query;
	if(isset($query['last_date']) && isset($query['first_date']) && $this->validateDate($query['last_date']) && $this->validateDate($query['first_date'])) {
		$this->autoRender=false;
		App::import('Vendor','PHPExcel',array('file' => 'PHPExcel' . DS . 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);
		$col=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
		$data=$this->LiveChat->getReport($query['first_date'],$query['last_date']);
		$c=0;
		foreach($data[0][0] as $key=>$val){
			$objPHPExcel->getActiveSheet()->setCellValue($col[$c].'1',$key); 
			$objPHPExcel->getActiveSheet()->setCellValue($col[$c].'2',$val); 
			$c++;
		}
		header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Summarry_report_chat_'.date('d-M-Y').'.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}
    $this->set(compact('menu'));
  }
	//end function report chat  lama / summary


  //report chat detail

	public function detailreportchat(){
    $menu='reportchat';
	$query=$this->request->query;
	if(isset($query['last_date2']) && isset($query['first_date2']) && $this->validateDate($query['last_date2']) && $this->validateDate($query['first_date2'])) {
		$this->autoRender=false;
		App::import('Vendor','PHPExcel',array('file' => 'PHPExcel' . DS . 'PHPExcel.php'));
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);
		$col=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
		$title='Report Chat Periode : '.$query['first_date2']." Sampai ".$query['last_date2'];
		// $data=$this->LiveChat->getReport($query['first_date'],$query['last_date']); 
		$data2=$this->LiveChat->getReport2($query['first_date2'],$query['last_date2']); 
		
		
		$objPHPExcel->getActiveSheet()->setCellValue($col[0].'1',$title);

		// waktu , nama , topik , contact , status , agent , remark

		$objPHPExcel->getActiveSheet()->setCellValue($col[0].'3', "Date");
		$objPHPExcel->getActiveSheet()->setCellValue($col[1].'3', "Name");
		$objPHPExcel->getActiveSheet()->setCellValue($col[2].'3', "Topic/Product");
		$objPHPExcel->getActiveSheet()->setCellValue($col[3].'3', "Contact");
		$objPHPExcel->getActiveSheet()->setCellValue($col[4].'3', "Operator Chat");
		$objPHPExcel->getActiveSheet()->setCellValue($col[5].'3', "Duration");
		$objPHPExcel->getActiveSheet()->setCellValue($col[6].'3', "Agent Commar");
		$objPHPExcel->getActiveSheet()->setCellValue($col[7].'3', "Remark");
		

		// echo "<prev>";
		// echo  count($data2);
		// var_dump($data2);

		// for ($ia=0; $ia < ; $ia++) { 
			 
			// for ($i=0; $i < count($data2); $i++) { 
			// 	for ($j=4; $j <(count($data2)+4) ; $j++) {	
			// 		$objPHPExcel->getActiveSheet()->setCellValue('A'.$j,$data2[$i][0]["Tanggal"]); 
			// 		$objPHPExcel->getActiveSheet()->setCellValue('B'.$j,$data2[$i]["wb_thread"]["Nama"]); 
			// 		$objPHPExcel->getActiveSheet()->setCellValue('C'.$j,$data2[$i]["wb_opgroup"]["Topik"]); 
			// 		$objPHPExcel->getActiveSheet()->setCellValue('D'.$j,$data2[$i]["wb_message"]["Kontak"]); 
			// 		$objPHPExcel->getActiveSheet()->setCellValue('E'.$j,$data2[$i]["wb_thread"]["agentname"]);
				
			// 	}
			// 	// $d++;
			// 	// $r2++:
			// }

			$row=4;
			foreach ($data2 as $key ) {
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$key[0]["Tanggal"]); 
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$key["wb_thread"]["Nama"]); 
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$key["wb_opgroup"]["Topik"]); 
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$key["wb_message"]["Kontak"]); 
				if ($key["wb_thread"]["agentname"]=="") 
				{
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$row,"offline");
				}else{
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$key["wb_thread"]["agentname"]);
				}
				// $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$key[0]["Time1"]); 
				// $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$key[0]["Time2"]); 

				$start_date = new DateTime($key[0]["Time1"]);
				$since_start = $start_date->diff(new DateTime($key[0]["Time2"]));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $since_start->h.":". $since_start->i.":". $since_start->s); 
				// $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$key["wb_thread"]["agentname"]);
				$row++;
			}

			foreach(range('B','G') as $columnID) {
    		$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}
		

			
			// $objPHPExcel->getActiveSheet()->setCellValue($col[0].$r2,$data2[0][0]["Tanggal"]); 
			// $objPHPExcel->getActiveSheet()->setCellValue($col[1].$r2,$data2[0]["wb_thread"]["Nama"]); 
			// $objPHPExcel->getActiveSheet()->setCellValue($col[2].$r2,$data2[0]["wb_opgroup"]["Topik"]); 
			// $objPHPExcel->getActiveSheet()->setCellValue($col[3].$r2,$data2[0]["wb_message"]["Kontak"]); 
			// $objPHPExcel->getActiveSheet()->setCellValue($col[4].$r2,$data2[0]["wb_thread"]["agentname"]);


		// report format lama
		// $c=0;
		// foreach($data[0][0] as $key=>$val){
		// 	$objPHPExcel->getActiveSheet()->setCellValue($col[$c].'26',$key); 
		// 	$objPHPExcel->getActiveSheet()->setCellValue($col[$c].'27',$val); 
		// 	$c++;
		// }
		//end report format lama
		header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Detail_Report_chat_'.date('d-M-Y').'.xlsx"');// format file xls lama  Report_chat_d-m-y.xlsx
		// header('Content-Disposition: attachment;filename="Report_chat_'.$query['first_date'].'-'.$query['last_date']'.xlsx"'); // ga bisa
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}
    $this->set(compact('menu'));
  }
  //end report chat detail

	public function solution() {
		if($this->request->is('post') || $this->request->is('put')){
			$this->Product->getDataSource()->begin();
			//
			$data=$this->request->data['Product'];
			for ($i=0;$i<count($data);$i++) {
				$question1=array('val1'=>isset($this->request->data['Product'][$i]['question1_1'])? : '0','val2'=>isset($this->request->data['Product'][$i]['question1_2'])?'2' : '0');
				$question2=array('val1'=>isset($this->request->data['Product'][$i]['question2_1'])? : '0','val2'=>isset($this->request->data['Product'][$i]['question2_2'])?'2' : '0','val3'=>isset($this->request->data['Product'][$i]['question2_3'])?'3' : '0');
				$question3=array('val1'=>isset($this->request->data['Product'][$i]['question3_1'])? : '0','val2'=>isset($this->request->data['Product'][$i]['question3_2'])?'2' : '0','val3'=>isset($this->request->data['Product'][$i]['question3_3'])?'3' : '0');

				$data[$i]['question1']=implode(" ",$question1);	
				$data[$i]['question2']=implode(" ",$question2);			
				$data[$i]['question3']=implode(" ",$question3);			

			}

			//}
			//$this->request->data['']
			//var_dump($data); die();

			if($this->Product->saveMany($data)){  
				$this->Product->getDataSource()->commit();  
				$this->Session->setFlash(__('Find Solution successfully updated'),'default',array('class'=>'success'),'good');
			}

			else {
				$this->Product->getDataSource()->rollback(); 
				$this->Session->setFlash(__('Cannot update Find Solution. Please try again'));
			}
		}
		$this->set('title_for_layout','Find Solution');
		$prods = $this->Product->find('all');
		$menu='solution';
		$this->set(compact('prods','menu'));
	}

	public function products() {
		$this->set('title_for_layout','Product Management');
		$this->Product->recursive = 0;
		$this->paginate = array(
			'paramType' => 'querystring',
			'order' => array('Product.created'=>'Desc'),
			'limit' => 10
			);
		if(isset($this->request['url']['search_title'])) $s_id=strip_tags(trim($this->request['url']['search_title'])); else $s_id='';
		if(isset($this->request['url']['cat_id'])) $cat_id=strip_tags(trim($this->request['url']['cat_id'])); else $cat_id='';
		$cond=array();
		if($cat_id!="") $cond["Product.category_id"]=$cat_id;
		if($s_id!="") $cond["Product.name like"]='%'.$s_id.'%';
		$prods=$this->paginate('Product',$cond);
		$menu='products';
		$list_cat = $this->Category->find('list',array('fields'=>array('id','name'),'order'=>array('name'=>'Asc')));
		$this->set(compact('menu','prods','s_id','list_cat','cat_id'));
	}

	public function add_product() {
		if($this->request->is('post')){
			$this->Product->getDataSource()->begin(); 
			if(!empty($this->request->data['Product']['file_img']['name']))
			{
				$ext = substr($this->request->data['Product']['file_img']['name'],-4,4);
				$this->request->data['Product']['picture']=$this->Product->FileUpload($this->request->data['Product']['file_img']['name'],$this->request->data['Product']['file_img']['tmp_name'],strtolower($ext));
			}
			if(!empty($this->request->data['Product']['file_img2']['name']))
			{
				$ext = substr($this->request->data['Product']['file_img2']['name'],-4,4);
				$this->request->data['Product']['pic_premium_table']=$this->Product->FileUpload($this->request->data['Product']['file_img2']['name'],$this->request->data['Product']['file_img2']['tmp_name'],strtolower($ext),'premi');
			}
			if($this->Product->save($this->request->data)){  
				$this->Product->getDataSource()->commit();  
				$this->Session->setFlash(__('Product successfully created'),'default',array('class'=>'success'),'flash');
				$this->redirect(array('action' => 'products'));
			}
			else {
				$this->Product->getDataSource()->rollback(); 
				$this->Session->setFlash(__('Cannot created Product. Please try again'));
			}
		} 
		$menu='products';
		$list_cat = $this->Category->find('list',array('fields'=>array('id','name'),'order'=>array('name'=>'Asc')));
		$this->set(compact('menu','list_cat'));
	}
	public function edit_product($id=null) {
		$this->Product->id = $id; 
		if (!$this->Product->exists()) {
			$this->redirect(array('controller'=>'adm','action' => 'generalnews'));
		}
		if ($this->request->is('post') || $this->request->is('put')) { 
			$this->request->data['Product']['id']=$id; 
			if(!empty($this->request->data['Product']['file_img']['name']))
			{
				$ext = substr($this->request->data['Product']['file_img']['name'],-4,4);
				$this->request->data['Product']['picture']=$this->Product->FileUpload($this->request->data['Product']['file_img']['name'],$this->request->data['Product']['file_img']['tmp_name'],strtolower($ext));
			}
			if(!empty($this->request->data['Product']['file_img2']['name']))
			{
				$ext = substr($this->request->data['Product']['file_img2']['name'],-4,4);
				$this->request->data['Product']['pic_premium_table']=$this->Product->FileUpload($this->request->data['Product']['file_img2']['name'],$this->request->data['Product']['file_img2']['tmp_name'],strtolower($ext),'premi');
			}
			if($this->Product->save($this->request->data)){
				$this->Session->setFlash(__('Product Successful be edited'),'default',array('class'=>'success'),'good');
			}			
			else {
				$this->Session->setFlash(__('Product could not be edited. Please, try again.'));
			} 
		} 
		$usr = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id))); 
		$this->request->data=$usr;
		$menu='products';
		$list_cat = $this->Category->find('list',array('fields'=>array('id','name'),'order'=>array('name'=>'Asc')));
		$this->set(compact('menu','list_cat'));
	}
	public function add_generalnews() {
		if($this->request->is('post')){
			$this->News->getDataSource()->begin(); 
			if(!empty($this->request->data['News']['file_img']['name']))
			{
				$ext = substr($this->request->data['News']['file_img']['name'],-4,4);
				$this->request->data['News']['picture']=$this->News->FileUpload($this->request->data['News']['file_img']['name'],$this->request->data['News']['file_img']['tmp_name'],strtolower($ext));
			}
			if($this->News->save($this->request->data)){  
				$this->News->getDataSource()->commit();  
				$this->Session->setFlash(__('News successfully created'),'default',array('class'=>'success'),'flash');
				$this->redirect(array('action' => 'generalnews'));
			}
			else {
				$this->News->getDataSource()->rollback(); 
				$this->Session->setFlash(__('Cannot created News. Please try again'));
			}
		} 
		$menu='news';
		$this->set(compact('menu'));
	}
	public function edit_generalnews($id=null) {
		$this->News->id = $id; 
		if (!$this->News->exists()) {
			$this->redirect(array('controller'=>'adm','action' => 'generalnews'));
		}
		if ($this->request->is('post') || $this->request->is('put')) { 
			$this->request->data['News']['id']=$id; 
			if(!empty($this->request->data['News']['file_img']['name']))
			{
				$ext = substr($this->request->data['News']['file_img']['name'],-4,4);
				$this->request->data['News']['picture']=$this->News->FileUpload($this->request->data['News']['file_img']['name'],$this->request->data['News']['file_img']['tmp_name'],strtolower($ext));
			}
			if($this->News->save($this->request->data)){
				$this->Session->setFlash(__('News Successfull be edited'),'default',array('class'=>'success'),'good');
			}			
			else {
				$this->Session->setFlash(__('News could not be edited. Please, try again.'));
			} 
		} 
		$usr = $this->News->find('first',array('conditions'=>array('News.id'=>$id))); 
		$this->request->data=$usr;
		$menu='news';
		$this->set(compact('menu'));
	}
	public function del_gennews($id=0) {
		if ($this->request->is('post')){
			$this->News->id = $id; 
			if (!$this->News->exists()) {
				$this->redirect(array('controller'=>'adm','action' => 'generalnews'));
			}
			$usr = $this->News->find('first',array('conditions'=>array('News.id'=>$id))); 
			$this->News->getDataSource()->begin(); 
			if($this->News->delete($id)){
				$this->News->getDataSource()->commit(); 
				$tmp=$this->News->DelFile($usr['News']['picture']);
				$this->Session->setFlash(__('General News successfully deleted'),'default',array('class'=>'success'),'flash'); 
				$this->redirect(array('controller'=>'adm','action' => 'generalnews'));
			} else {
				$this->News->getDataSource()->rollback(); 
				$this->redirect(array('controller'=>'adm','action' => 'generalnews'));
			}
		} 
	}

	public function captcha()  {
		$this->autoRender = false;
        // Retrieve the basename for the image route so that we can
        // uniquely identify and generate each captcha control.
		isset($this->params['url']['url'])? $captcha = basename($this->params['url']['url'], '.jpg'):$captcha ='captcha';
        /// Generate actual captcha image (each image unique per image route)
		$this->Captcha->generate($captcha);
	}


	public function login() {
		if($this->Auth->loggedIn()) {
			$this->redirect(array('controller' => 'adm', 'action' => 'index'));
		} else{
			$this->layout = 'login';
			$this->set('title_for_layout', 'Login');
			if ($this->request->is('post')) {
				foreach($this->captchas as $field) {
					$this->User->setCaptcha($field,$this->Captcha->getCode($field));
				};
				$this->User->set($this->request->data); 
				if ($this->User->validates(array('fieldList' => array('captcha')))) {
					if ($this->Auth->login()) {
						$this->redirect($this->Auth->redirectUrl());
					} else {
						$this->request->data=null;

						$this->Session->setFlash(__('Invalid username or password, please try again'));

					}
				}else {
					$this->request->data=null;
					$this->Session->setFlash(__('Invalid Captcha'));
				}


			}
			$this->set('captcha_fields', $this->captchas);

		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
  
  /* Promo Management */
  public function promo(){
		$menu = 'promo';
		$this->set('title_for_layout','Promo Management');
		$this->Promo->recursive = 0;
		$this->paginate = array(
			'paramType' => 'querystring',
			'order' => array('Promo.created'=>'Desc'),
			'limit' => 10
			);
		if(isset($this->request['url']['search_title'])) $s_id=strip_tags(trim($this->request['url']['search_title'])); else $s_id='';
		$cond=array();
		if($s_id!="") $cond["Promo.promo_title like"]='%'.$s_id.'%';
		$promos=$this->paginate('Promo',$cond);

		$this->set(compact('menu','promos','s_id'));
	}

	public function add_promo(){
		if($this->request->is('post')){
			$this->Promo->getDataSource()->begin(); 
			if(!empty($this->request->data['Promo']['img_promo_bilboard']['name']))
			{
				$ext = substr($this->request->data['Promo']['img_promo_bilboard']['name'],-4,4);
				$this->request->data['Promo']['img_promo_bilboard']=$this->Promo->FileUpload($this->request->data['Promo']['img_promo_bilboard']['name'],$this->request->data['Promo']['img_promo_bilboard']['tmp_name'],strtolower($ext));
			}
			if(!empty($this->request->data['Promo']['img_promo_homepage']['name']))
			{
				$ext = substr($this->request->data['Promo']['img_promo_homepage']['name'],-4,4);
				$this->request->data['Promo']['img_promo_homepage']=$this->Promo->FileUpload($this->request->data['Promo']['img_promo_homepage']['name'],$this->request->data['Promo']['img_promo_homepage']['tmp_name'],strtolower($ext),'hp');
			}
			if(!empty($this->request->data['Promo']['img_promo_detail']['name']))
			{
				$ext = substr($this->request->data['Promo']['img_promo_detail']['name'],-4,4);
				$this->request->data['Promo']['img_promo_detail']=$this->Promo->FileUpload($this->request->data['Promo']['img_promo_detail']['name'],$this->request->data['Promo']['img_promo_detail']['tmp_name'],strtolower($ext),'dt');
			}
      
      $this->request->data['Promo']['modified_by']=$this->Session->read('Auth.User.name');
			if($this->Promo->save($this->request->data)){  
				$this->Promo->getDataSource()->commit();  
				$this->Session->setFlash(__('Promo successfully created!'),'default',array('class'=>'success'),'flash');
				$this->redirect(array('action' => 'promo'));
			} else {
				$this->Promo->getDataSource()->rollback(); 
				$this->Session->setFlash(__('Cannot created Promo. Please try again'));
			}
		} 
		$menu='products';
	}

	public function edit_promo($id){
		$this->Promo->id = $id; 
		if (!$this->Promo->exists()) {
			$this->redirect(array('controller'=>'adm','action' => 'promo'));
			$this->Session->setFlash(__('Promo could not be edited.'));
		}
		$promob = $this->Promo->find('first',array('conditions'=>array('Promo.id'=>$id))); 
		if ($this->request->is('post') || $this->request->is('put')) { 
			$this->request->data['Promo']['id']=$id; 
			if(!empty($this->request->data['Promo']['img_promo_bilboard']['name']))
			{
				$ext = substr($this->request->data['Promo']['img_promo_bilboard']['name'],-4,4);
				$this->request->data['Promo']['img_promo_bilboard']=$this->Promo->FileUpload($this->request->data['Promo']['img_promo_bilboard']['name'],$this->request->data['Promo']['img_promo_bilboard']['tmp_name'],strtolower($ext));
			}else{
				$this->request->data['Promo']['img_promo_bilboard'] = $promob['Promo']['img_promo_bilboard'];
			}
			if(!empty($this->request->data['Promo']['img_promo_homepage']['name']))
			{
				$ext = substr($this->request->data['Promo']['img_promo_homepage']['name'],-4,4);
				$this->request->data['Promo']['img_promo_homepage']=$this->Promo->FileUpload($this->request->data['Promo']['img_promo_homepage']['name'],$this->request->data['Promo']['img_promo_homepage']['tmp_name'],strtolower($ext),'hp');
			}else{
				$this->request->data['Promo']['img_promo_homepage'] = $promob['Promo']['img_promo_homepage'];
			}

			if(!empty($this->request->data['Promo']['img_promo_detail']['name']))
			{
				$ext = substr($this->request->data['Promo']['img_promo_detail']['name'],-4,4);
				$this->request->data['Promo']['img_promo_detail']=$this->Promo->FileUpload($this->request->data['Promo']['img_promo_detail']['name'],$this->request->data['Promo']['img_promo_detail']['tmp_name'],strtolower($ext),'dt');
			} else{
				$this->request->data['Promo']['img_promo_detail'] = $promob['Promo']['img_promo_detail'];
			}
      
      $this->request->data['Promo']['modified_by']=$this->Session->read('Auth.User.name');
			if($this->Promo->save($this->request->data)){
				$this->Session->setFlash(__('Promo is successfully updated!'));
			}			
			else {
				$this->Session->setFlash(__('Promo could not be edited. Please, try again.'));
			} 
		} 
		$usr = $this->Promo->find('first',array('conditions'=>array('Promo.id'=>$id))); 
		$this->request->data=$usr;
		$menu = 'promo';
		$this->set(compact('menu'));
	}

	public function del_promo($id_promo){
		$this->Promo->id = $id; 
		if (!$this->Promo->exists()) {
			$this->redirect(array('controller'=>'adm','action' => 'promo'));
			$this->Session->setFlash(__('Promo could not be deleted.'));
		}
		$data['deleted']=1;
		if($this->Promo->save($data)){
			$this->Session->setFlash(__('Promo Successfully deleted'),'default',array('class'=>'success'),'flash');
		}			
		else {
			$this->Session->setFlash(__('Promo could not be deleted. Please, try again.'));
		} 

	}



}
