<?php
App::uses('AppModel', 'Model');
class Product extends AppModel {
	public $recursive=-1;
	 public $validate = array(		
		'short_desc' => array(
		    'max'=> array(
				'rule'=>array('maxLength', 300),
				'message'=>'Maximum Short Descriptions is 300 characters'
				),
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		'manfaat' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		 'content' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		), 
		
		
		'mata_uang' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		'usia_masuk' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		
		'masa_pertanggungan' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		
		'masa_premi' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		
		'min_uang_pertanggungan' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		'max_uang_pertanggungan' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		'category_id' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please choose this field'
				)
		),
		'name' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
    ); 
	
	public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        )
     );
	
	public function beforeSave($opt=null){
	if(isset($this->data['Product']['name'])) $this->data['Product']['seo']=str_replace( array(' ', '?','%','!','/'),array('-',''), strtolower(trim($this->data['Product']['name']))); 	
	return true;
	}
	
	public function FileUpload($name,$tmp,$ext,$prefix='prod'){		
		//$file=str_replace( ' ', '_', strtolower($name)); 
		$file=$prefix.'_'.time().$ext;
		$url=WWW_ROOT.'img'.DS.'prod'.DS;
		$urls = $url.$file;
		$gbr=$file;
					if(!file_exists($urls)) {
						$success = move_uploaded_file($tmp, $urls);
					} else {
						$gbr=time().$gbr;
						$urls = $url.time().$file;
						$success = move_uploaded_file($tmp, $urls);
					}	
		if($success==true){
			$this->createthumb($urls,$url.'small_'.$gbr,120,100);
		}					
		return $gbr;
	}
	
	public function DelFile($file){
	$url=WWW_ROOT.'img'.DS.'prod'.DS;
	$url1 = $url.$file;
	$url2 = $url.'small_'.$file;
	echo $url2; 
	if(file_exists($url)) {
	$_tmp=unlink($url1);
	$_tmp=unlink($url2);
	   }
	   return '';
	}
	
	public function FileExist($file){
	$url=WWW_ROOT.'img'.DS.'prod'.DS;
	$url = $url.$file;
	if(file_exists($url)) {
	return true;
	   }
	   return false;
	}
	
	function createthumb($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if (preg_match('/jpg|jpeg/',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y) {
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	if (preg_match("/png/",$system[1]))
	{
		imagepng($dst_img,$filename); 
	} else {
		imagejpeg($dst_img,$filename); 
	}
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}
		
	
}