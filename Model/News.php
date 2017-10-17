<?php
App::uses('AppModel', 'Model');
class News extends AppModel {
	
	 public $validate = array(		 
		 'content' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
		'title' => array(
		   'required'=> array(
				'rule'=>array('notEmpty'),
				'message'=>'Please fill this field'
				)
		),
    ); 
	
	public function beforeSave($opt=null){
	if(isset($this->data['News']['title']))$this->data['News']['seo']=str_replace( array(' ', '?','%','!','/'),array('-',''), strtolower(trim(preg_replace('/\s+?(\S+)?$/', '', substr($this->data['News']['title'], 0, 101))))); 	
	return true;
	}
	
	public function FileUpload($name,$tmp,$ext){		
		//$file=str_replace( ' ', '_', strtolower($name)); 
		$file='news_'.time().$ext;
		$url=WWW_ROOT.'img'.DS.'news'.DS;
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
	$url=WWW_ROOT.'img'.DS.'news'.DS;
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
	$url=WWW_ROOT.'img'.DS.'news'.DS;
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