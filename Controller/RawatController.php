<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RawatInapController
 *
 * @author newbiecihuy
 */
class RawatController extends AppController{
    //put your code here
public $helpers = array ('Html', 'Form');
  
  var $name='Promo';
  var $pilihan, $keterangan, $tanggal, $jam;
  if($pilihan === "1"){
	  $keterangan ="Rawat Inap";
  }else if($pilihan === "2"){
	  $keterangan ="Rawat Jalan";
  }
  function tambah () {
	 if(!empty($this->data)){
		 
	 }
  }
}
?>
