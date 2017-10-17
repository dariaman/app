<?php
App::uses('AppModel', 'Model');
class Promo extends AppModel {
	public $recursive=-1;
	public $validate = array(		
		'img_promo_bilboard' => array(
			'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
			),
		'img_promo_homepage' => array(
			'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
			),
		'promo_title' => array(
			'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
			),
		'start_date' => array(
			'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
			), 
		'end_date' => array(
			'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
			),  
		); 
	
	/*1. promo_title (generate slug)
	2. img_promo_bilboard
	3. img_promo_homepage
	4. img_promo_detail
	5. start_date (input date and time also)
	6. end_date (input date and time also)*/

	public function beforeSave($opt=null){
		if(isset($this->data['Promo']['promo_title'])) $this->data['Promo']['seo']=str_replace( array(' ', '?','%','!','/'),array('-',''), strtolower(trim($this->data['Promo']['promo_title']))); 	
		return true;
	}
	
	public function FileUpload($name,$tmp,$ext,$prefix='prom'){		
		//$file=str_replace( ' ', '_', strtolower($name)); 
		$file=$prefix.'_'.time().$ext;
		$url=WWW_ROOT.'img'.DS.'prom'.DS;
		$urls = $url.$file;
		$gbr=$file;
		if(!file_exists($urls)) {
			$success = move_uploaded_file($tmp, $urls);
		} else {
			$gbr=time().$gbr;
			$urls = $url.time().$file;
			$success = move_uploaded_file($tmp, $urls);
		}	
		// if($success==true){
		// 	$this->createthumb($urls,$url.'small_'.$gbr,120,100);
		// }					
		return $gbr;
	}
	
	public function DelFile($file){
		$url=WWW_ROOT.'img'.DS.'prom'.DS;
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
		$url=WWW_ROOT.'img'.DS.'prom'.DS;
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