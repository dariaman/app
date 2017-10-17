<?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>


<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="content_landing mt-30">
					<h3>Pilih Metode Pembayaran</h3>
					<div class="payment-option">
						<form action="https://www.rajapremi.com/payment/choose/RkZzSzdaMFUyaWJuL25FWURVa3BpSzJHSGUyakdhWk5vOFVwQWhKdCtSOElqazU1YXlKRjhPS053MTUvSmdIS1Myeis0NFJWZVpKbGs5NEl2S1EvaEg1ZEhCcGtzYk15eXd6N00vSFcyTU9yMFJDRGJtSytlZGgrK3FxdWRzSXh8RU5oQmdDbFRFQXRFVy9VWnVaSkFtT0hFVFZMbHVuQVlMMTZpOTg3dUlhOD0=" method="post">
													<div class="item">
								<div class="radio">
									<label>
										<input type="radio" name="channel" value="15" required=""> Kartu Kredit/BNI Debit Online									</label>
								</div>
																<div class="additional-info">
																		<li>Anda akan dikenakan tambahan biaya sebesar 3% dari total tagihan.</li>
																	</div>
															</div>
														<div class="item">
								<div class="radio">
									<label>
										<input type="radio" name="channel" value="999" required=""> Transfer									</label>
								</div>
															</div>
														<div class="item">
								<div class="radio">
									<label>
										<input type="radio" name="channel" value="31" required=""> Kredivo									</label>
								</div>
																<div class="additional-info">
																		<li>Anda akan dikenakan tambahan biaya sebesar 2.3% dari total tagihan.</li>
																	</div>
															</div>
														<div class="clear20"></div>
							<div class="col-lg-3 col-lg-offset-9"><input type="submit" class="btn btn-default form-control" value="Bayar Sekarang"></div>
							<div class="clear20"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="content_landing mt-30">
					<h3>Ringkasan Pembayaran</h3>
					<div class="payment-summary">
						<div class="row">
							<div class="item">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left"><strong>PT. Asuransi Simas Net</strong></div>
							</div>
							<div class="item">
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">Produk</div>
								<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 text-right">Asuransi Mobil</div>
							</div>
							<div class="item">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">Premi Dasar</div>
								<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">Rp</div>
								<div class="col-lg-4 col-md-4 col-sm-11 col-xs-11 text-right">3.223.350</div>
							</div>
							<div class="item">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">Premi Tambahan</div>
								<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">Rp</div>
								<div class="col-lg-4 col-md-4 col-sm-11 col-xs-11 text-right">600.000</div>
							</div>
							<div class="item">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">Diskon</div>
								<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">Rp</div>
								<div class="col-lg-4 col-md-4 col-sm-11 col-xs-11 text-right">225.635</div>
							</div>
							<div class="item">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">Administrasi</div>
								<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">Rp</div>
								<div class="col-lg-4 col-md-4 col-sm-11 col-xs-11 text-right">60.000</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="payment-total">
						<div class="row">
							<div class="item">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">Total Tagihan</div>
								<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">Rp</div>
								<div class="col-lg-4 col-md-4 col-sm-11 col-xs-11 text-right">3.657.716</div>
							</div>
						</div>
					</div>
					<div class="shipping-address">
						<p>Alamat Pengiriman Polis</p>
						<div>
						Bstartup Center, Menara Batavia Lt 3A
Jl KH Mas Mansyur Kav 126 JAKARTA BARAT 10220						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




<div class="row">
  <div class="col-md-12">
    
  <div class="row margintop">
    <div class="col-md-12">
      <div class="box-grey-top">
        <span class="bold">
          Data Pemegang Polis
        </span>
      </div>
      <div class=" table-responsive">
        <table class="table table-striped">
          <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Nama Lengkap</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold">
		<?php if($name=='jaga-motorku')echo $this->Session->read('Purchase.jmk.ph_name'); else echo $this->Session->read('Purchase.step2.PROSPECT_NAME'); ?>
	      </span></h4>
            </td>
          </tr>
          
          <!-- if hc==y show address -->
          <?php if($this->Session->read('Purchase.step1.HARD_COPY')=='Y'):?>
          <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Alamat</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold"><?php  if($name=='jaga-motorku')echo $this->Session->read('Purchase.jmk.ph_address'); else echo $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'); ?></span></h4>
            </td>
          </tr>
	  <?php elseif($this->Session->read('Purchase.jmk.ph_reqbook')=='Y'):?>
          <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Alamat</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold"><?php echo $this->Session->read('Purchase.jmk.ph_address'); ?></span></h4>
            </td>
          </tr>
          <?php endif; ?>
          
          <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Tanggal Lahir</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold"><?php if($name=='jaga-motorku')echo $this->Session->read('Purchase.jmk.ph_dob'); else  echo $this->Session->read('Purchase.step1.PROSPECT_DOB'); ?></span></h4>
            </td>
          </tr>
          <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Jenis Kelamin</h4>
            </td>
            <td class="">
	      <?php if($name=='jaga-motorku'){  ?>
     	      <h4 class="title-calculate"><span class="bold"><?php if($this->Session->read('Purchase.step1.ph_gender')=='F') echo "Perempuan"; else echo "Laki-laki";  ?></span></h4>
	      <?php }else{ ?>
              <h4 class="title-calculate"><span class="bold"><?php if($this->Session->read('Purchase.step1.PROSPECT_GENDER')=='F') echo "Perempuan"; else echo "Laki-laki";  ?></span></h4>
	      <?php } ?>
            </td>
          </tr>
          <tr class="box-grey-second">

            <td class="">
              <h4 class="title-calculate">Email</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold"><?php  if($name=='jaga-motorku') echo $this->Session->read('Purchase.step1.PROSPECT_EMAIL');else echo $this->Session->read('Purchase.step2.PROSPECT_EMAIL'); ?></span></h4>
            </td>

          </tr>
          <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Telp Selular</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold"> <?php  if($name=='jaga-motorku') echo $this->Session->read('Purchase.step1.PROSPECT_MOBILE_PHONE');else  echo $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE'); ?></span></h4>
            </td>
          </tr>

          
            <?php  $ahData = $this->Session->read('Purchase.Ahliwaris'); $i=0; $total=count($ahData); while($i<$total): ?>
            <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Ahli Waris <?php if ($total>1) echo ($i+1) ?></h4>
            </td>
            <td class="">
              <div class="row">
                <div class="col-sm-3">
                  <h4 class="title-calculate"><span class="bold"><?php echo $ahData[($i+1)]['PROSPECT_NAME'] ?></span></h4>
                </div>
                <div class="col-sm-3">
                  <h4 class="title-calculate"><span class="bold"><?php echo $ahData[($i+1)]['PROSPECT_DOB'] ?></span></h4>
                </div>
                <div class="col-sm-3">
                  <h4 class="title-calculate"><span class="bold"><?php if($ahData[($i+1)]['PROSPECT_GENDER']=='F') echo "Perempuan"; else echo "Laki-laki"  ?></span></h4>
                </div>
                <div class="col-sm-3">
                  <h4 class="title-calculate"><span class="bold"><?php echo $ahData[($i+1)]['hubungan'] ?></span></h4>
                </div>
              </div>
            </td>
            </tr>
            <?php $i++;endwhile; ?>   
        </table>
      </div>
      <?php if($this->Session->read('Purchase.step1.product_id')=='11'||$this->Session->read('Purchase.step1.product_id')=='23'|| $this->Session->read('Purchase.step1.product_id')=='21'):?>
      <div class="row">
        <div class="col-md-12">
          <center>
          <div class="box-grey-second" style="border-top:0 !important;">
            <span class="bold red">
              Kartu JAGADIRI akan dikirimkan maksimal satu bulan setelah pembelian polis.
            </span>
          </div>
          </center>
        </div>
      </div>
      <?php endif;?>
    </div>
  </div>
  
   <?php if($this->Session->read('Purchase.step1.product_id')!=1 && $this->Session->read('Purchase.step1.product_id')!=7 && $this->Session->read('Purchase.step1.product_id')!=24):?>
  <div class="row margintop">
    <div class=" col-md-12">
      <div class="box-grey-top">
        <span class="bold">
          Data Tertanggung Asuransi
        </span>
      </div>
	
      <div class="table-responsive">
        <table class="table table-striped">   
          <?php  $taData = $this->Session->read('Purchase.allTA'); $i=0; $total=count($taData); while($i<$total): ?>
          <tr class="">
            <td class="">
              <h4 class="title-calculate">Tertanggung <?php if ($total>1) echo ($i+1) ?></h4>
            </td>
            <td class=" col-sm-2">
              <h4 class="title-calculate"><span class="bold"><?php echo $taData[$i]['ProspectName'] ?></span></h4>
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"  ><span class="bold"><?php echo substr($taData[$i]['ProspectDOB'], 0, 10) ?></span></h4>
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"><span class="bold"><?php if($taData[$i]['ProspectGender']=='F') echo "Perempuan"; else echo "Laki-laki"  ?></span></h4>
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"><span class="bold"><?php echo $taData[$i]['InsuredType'] ?></span></h4>
            </td>

            <td class="col-sm-offset-1 col-sm-2">
              <h4 class="title-calculate"><span class="bold">

        <?php
          if ($this->Session->read('Purchase.step1.product_id')!=21) { echo rp($taData[$i]['PremiumAmount']); }
          else {
            if ($this->Session->read('Purchase.TertanggungTertua') == substr($taData[$i]['ProspectDOB'], 0, 10)) {
                if ($this->Session->read('Purchase.step1.sameAgeFlag') == 'Y') { 
                  
                  if ($taData[$i]['InsuredType'] == 'Tertanggung Utama') {
                      echo rp($this->Session->read('Purchase.step1.premiTertua'));  
                  }
                  else {
                      echo "Rp 0";
                  }
                }
                else {
                  if ($taData[$i]['InsuredType'] == 'Tertanggung Utama') {
                    echo rp($taData[$i]['PremiumAmount']);
                  }
                  else {
                    echo rp($this->Session->read('Purchase.step1.premiTertua'));
                  }
                }
            }
            else {
              echo "Rp 0";
            }
          } 
        ?>        
        </span></h4>
            </td>
          </tr>
          <?php $i++;endwhile; ?> 
          <!--
          <tr class="box-grey-second">
            <td class="col-sm-2"> 
            </td>
            <td class="col-sm-2">
            </td> 
            <td class=" col-sm-2">
            </td>
            <td class="col-sm-2">
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"><span class="bold">Total</span></h4>
            </td>
            <td class="col-sm-offset-1 col-sm-3">
              <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.premi.total_premi')+$cashlessFee); ?></span></h4>
            </td>
          </tr>
          -->
        </table>
      </div>
    </div>
  </div> 
<?php elseif($this->Session->read('Purchase.step1.product_id')==24):?>
  <div class="row margintop">
    <div class=" col-md-12">
      <div class="box-grey-top">
        <span class="bold">
          Data Tertanggung Asuransi
        </span>
      </div>
	
      <div class="table-responsive">
        <table class="table table-striped">   
         
          <tr class="">
            <td class="">
              <h4 class="title-calculate">Tertanggung</h4>
            </td>
            <td class=" col-sm-2">
              <h4 class="title-calculate"><span class="bold"><?php echo $this->Session->read('Purchase.jmk.insured_name'); ?></span></h4>
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"  ><span class="bold"><?php echo substr($this->Session->read('Purchase.jmk.insured_dob'), 0, 10); ?></span></h4>
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"><span class="bold"><?php if($this->Session->read('Purchase.jmk.insured_gender')=='F') echo "Perempuan"; else echo "Laki-laki"  ?></span></h4>
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"><span class="bold"><?php echo "Tertanggung Utama" ?></span></h4>
            </td>

            <td class="col-sm-offset-1 col-sm-2">
              <h4 class="title-calculate"><span class="bold"></span>
            </td>		

 
          <!--
          <tr class="box-grey-second">
            <td class="col-sm-2"> 
            </td>
            <td class="col-sm-2">
            </td> 
            <td class=" col-sm-2">
            </td>
            <td class="col-sm-2">
            </td>
            <td class="col-sm-2">
              <h4 class="title-calculate"><span class="bold">Total</span></h4>
            </td>
            <td class="col-sm-offset-1 col-sm-3">
              <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.premi.total_premi')+$cashlessFee); ?></span></h4>
            </td>
          </tr>
          -->

        </table>
      </div>
    </div>
  </div> 
  
  <?php endif; ?>
  
  <form id="ConfirmPage" novalidate="novalidate">
    <div class="row margintop">
      <div class="col-md-12">
        <div class="clearfix"><h1 class="title-login">
          <span class="bold red">Pernyataan Calon Nasabah Dan Ringkasan Informasi Produk</span>
        </h1>
      </div>
      <hr class="redline">
      <div class="row">
          <div class="col-sm-6">
            <div class="scroll">
              <p class="descquote">
              Dengan mengisi dan melengkapi kelengkapan data diri yang dipersyaratkan untuk mengikuti program asuransi jiwa ini, saya mengajukan permohonan asuransi jiwa kepada PT Central Asia Financial (JAGADIRI) ('"Penanggung"') yang mana dalam hal ini saya bertindak sebagai calon pemegang polis dan menyatakan bahwa:<br />
              </p>
              <ul class="UL">
                <li>Saya telah memenuhi syarat dan ketentuan yang dipersyaratkan oleh Penanggung.</li>
                <li>Semua data, pernyataan, dan jawaban yang saya berikan untuk keikutsertaan saya dalam program asuransi berlaku sebagai Surat Permintaan Asuransi dan adalah benar dan akan menjadi dasar bagi berlakunya Kontrak Asuransi Jiwa yang akan disetujui dan dikeluarkan oleh pihak Penanggung. Apabila di kemudian hari terdapat keterangan / informasi yang bertentangan dengan keadaan sebenarnya tetapi tidak dinyatakan/dikemukakan dalam Surat Permintaan Asuransi ini, dimana dalam hal apabila keterangan / informasi yang sebenarnya diberikan sejak awal maka pertanggungan asuransi tidak akan ditutup atau dipertanggungkan dengan syarat dan ketentuan yang sama, maka Penanggung berhak untuk membatalkan Polis dan / atau menolak klaim yang diajukan.</li>
                <li>Menyetujui Pertanggungan ini mulai berlaku sejak masa pertanggungan yang tercantum dalam Polis yang diterbitkan oleh Penanggung.</li>
              </ul>
              
            </div>
            <!--<div class="checkbox">
              <label>
                <input class="quote" type="checkbox"onChange="signature()" name="agree1" required="required"> <span class="red">Saya setuju dan juga telah membaca dan memahami Syarat Dan Ketentuan PT Central Asia Financial (JAGADIRI) dan Produk ini.</span>
              </label>
              </div>-->
          </div>
          <?php 
          if($name=='jaga-sehat-plus'){
            echo $this->element('prod_agree/jagasehatplus'); 
          }
          else if($name=='jaga-jiwa'){
            echo $this->element('prod_agree/jagajiwa'); 
          }
          else if($name=='jaga-aman'){
            echo $this->element('prod_agree/jagaaman'); 
          }
          else if($name=='jaga-sehat-dbd'){
            echo $this->element('prod_agree/jagasehatdbd'); 
          }
      else if($name=='jaga-aman-instan'){
            echo $this->element('prod_agree/jagaamaninstan'); 
          }
      else if($name=='caf-flexy-link'){
            echo $this->element('prod_agree/cafflexylink'); 
          }
      
      else if($name=='jaga-jiwa-plus5'){
            echo $this->element('prod_agree/jagajiwaplus5'); 
          }
      else if($name=='jaga-aman-plus5'){
            echo $this->element('prod_agree/jagaamanplus5'); 
          }
      else if($name=='jaga-aman-plus7'){
            echo $this->element('prod_agree/jagaamanplus7'); 
          }
      else if($name=='jaga-jiwa-plus7'){
            echo $this->element('prod_agree/jagajiwaplus7'); 
          }
      else if($name=='jaga-sehat-keluarga'){
            echo $this->element('prod_agree/jagasehatkeluarga'); 
          }
          ?>
          
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                <input class="quote" type="checkbox"onChange="signature()" name="agree1" required="required"> <span class="red">Saya setuju dan juga telah membaca dan memahami Syarat Dan Ketentuan PT Central Asia Financial (JAGADIRI) dan Produk ini.</span>
              </label>
            </div>
          </div>
        </div>
        </div>  
      </div>  

      <div class="row margintop">
        <div class="col-md-12">
          <div class="clearfix"><h1 class="title-login">
            <span class="bold red">Pilih Metode Pembayaran </span>
          </h1>
        </div>
        <hr class="redline">
        <div class="row">
          <div class="col-md-12">
          <h2>Jumlah transaksi minimum adalah Rp 1,000 untuk kartu kredit berlogo Visa & MasterCard dan Rp 10,000 untuk BCA KlikPay</h2>
        </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <p style="font-size:12px;margin-top:19px;">Kartu Kredit & Kartu Debit Berlogo Visa / Mastercard</p>
            <input  type="radio"  type="radio" <?php //if(intval($this->Session->read('Purchase.premi.total_premi')) < 100000) echo "disabled"; ?> name="pembayaran"  value="creditcard" required="required" class="quote" id="inlineRadio1" /> 
            <label for="inlineRadio1">              
              <span class="kk"><img src="<?php echo $this->Html->url("/"); ?>img/visa.png" alt="visa" /></span>
            </label>
          </div>
          <div class="col-sm-4">
            <p style="font-size:12px;margin-top:19px;">Internet Banking</p>
            <input  type="radio"   name="pembayaran"  value="bca" required="required" class="quote" id="inlineRadio2" /> 
            <label for="inlineRadio2">
              <span class="kk"><img src="<?php echo $this->Html->url("/"); ?>img/bca.png" alt="klikPayBCA" /></span>        
            </label>
          </div>

          <div class="col-sm-4">
            <p style="font-size:12px;margin-top:19px;">Internet Banking</p>
            <input  type="radio"   name="pembayaran"  value="cimbclick" required="required" class="quote" id="inlineRadio3" /> 
            <label for="inlineRadio3">
              <span class="kk"><img style="width:250px;"src="<?php echo $this->Html->url("/"); ?>img/cimb.png" alt="cimb-click" /></span>        
            </label>
          </div>

  
          <?php //if($this->Session->read('Purchase.step1.product_id')==5 || $this->Session->read('Purchase.step1.product_id')==7):?>
          <!--<div class="col-sm-4">
            <p style="font-size:12px;margin-top:19px;">E-Money</p>
            <input  type="radio"   name="pembayaran"  value="ecash" required="required" class="quote" id="inlineRadio3" /> 
            <label for="inlineRadio3">
              <span class="kk"><img src="<?php //echo $this->Html->url("/"); ?>img/emoney.png" alt="E-Money" /></span>
            </label>
          </div>-->
          <?php //endif;?>
        </div>
 <div class="row">
          <div class="col-sm-4">
            <p style="font-size:12px;margin-top:19px;">Internet Banking</p>
            <input  type="radio"   name="pembayaran"  value="nicepay" required="required" class="quote" id="inlineRadio4" /> 
            <label for="inlineRadio4">
 
              <span class="kk">Virtual Account</span>

            </label>

<input type="hidden" name="payMethod" id="payMethod" value="02">
<input type="hidden" name="Amount" id="Amount" value="<?php echo $this->Session->read('Purchase.premi.total_premi'); ?>">
 <select name="bankCd" id="bankCd">

            <option value="CENA">BCA</option>
            <option value="BNIN">BNI</option>
            <option value="BMRI">Mandiri</option>
            <option value="HNBN">KEB Hana Bank</option>
            <option value="BBBA">Permata</option>
            <option value="IBBK">BII Maybank</option>
            <!-- Not available yet, coming soon-->
            <option disabled>----------</option>
            <option value="BNIA" disabled>CIMB Niaga</option>
            <option value="BRIN" disabled>BRI</option>
            <option value="BDMN" disabled>Danamon</option>
          </select>

          </div>

</div>

      </div>
    </div>  

    <div class="row margintop">
      <div class="col-md-12">
        <div class="clearfix">
          <div class="pull-left">
            <a href="<?php 
            echo $this->Html->url(array('controller' =>'front', 'action'=>'step2_your_detail','id'=>$name,'?'=>array('cat'=>$cat,'sid'=>$sid))); ?>">
            <div class="btn-back"><h2 class="title-btn-quote">Kembali</h2></div>
          </a>
        </div>
        <?php if( count($this->Session->read('Purchase.Ahliwaris'))>0 || $this->Session->read('Purchase.step1.product_id')==21 ): ?>
          <div class="pull-right">
            <button class="btn-lanjut" id="paybutt" type="button" onClick="clickBayar()" >
              Bayar 
            </button>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
 </div>
</div>
</form>

<div class="modal fade" id="modalta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
         <div class="modal-header"> 
           <h4 class="modal-title" id="aw-btn">Auto Debet dengan Kartu Kredit / Debit</h4>
        </div>
        <div class="modal-body">
          <!-- isi modal -->
          <?php echo $this->Form->create('',array('class'=>'form-horizontal','id'=>'formCard','role'=>'form','type' => 'get','novalidate'=>true,'onSubmit'=>'getSendPayment(); return false;'));
          $this->Form->inputDefaults(array('class' => 'span6','label' => false)); ?>
          
          <div class="form-group">
            <label class="col-md-2 control-label">No Kartu</label>
            <div class="col-md-9">
              <?php echo $this->Form->input('nokartu', array('id'=>'noCCval','class'=>'form-control','required'=>'required')); ?>
            </div>
          </div>
          
          <div class="form-group">
            <div class="checkbox col-md-11">
                <label>
                  <input class="quote" checked type="checkbox" onChange="afterRecurring()" name="agreeRecurring" > <span class="red">Saya setuju untuk memberikan data yang diperlukan di atas guna mendapatkan perlindungan berkelanjutan dari PT Central Asia Financial (JAGADIRI)</span>
                </label>
             </div>
          </div>
         
          
        </div>
        <div class="modal-footer"> 
          <div class="col-md-4 pull-left">
          <button type="button" class="btn btn-primary" id="save_card" style="padding-left:30px; padding-right:30px;" onClick="return getSendPayment();">OK</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
$("html, body").animate({ scrollTop: $('.breadcrumb').offset().top-50 }, 1500);
});
  var valCard = $("#formCard").validate({
    focusCleanup: true,
    focusInvalid:false, 
    errorElement: "span",
    messages: {
      "nokartu": "Masukan no kartu kredit/debit anda, atau <i>uncheck</i> persetujuan di bawah ini bila ingin langsung ke halaman pembayaran", 
    },
  });
  var valQuote = $("#ConfirmPage").validate({
    errorClass: 'agree-error',
    errorElement: "span",
    focusCleanup: true,
    focusInvalid:false,
    rules:{
      metodepembayaran:"required"
    },
    messages: {
      "agree1": "Penting! Anda harus menyetujui Syarat dan Ketentuan untuk dapat melanjutkan proses pembelian.",
      "agree2": "Penting! Anda harus menyetujui Syarat dan Ketentuan untuk dapat melanjutkan proses pembelian.",
      "pembayaran": "</br><center>Pilih jenis pembayan anda</center>",
    },
    errorPlacement: function(error, element) {
      if (element.is(":radio")) error.appendTo(element.parent('div').parent('div').parent('div'));
      else error.appendTo(element.parent('label'));
    },
  });

  function getSendPayment(){
    if(valCard.form()) {
      $.ajax({
          url: "<?php echo $this->Html->url('/front/sendCCRecurring/');?>",
          type: "POST",
          cache: false,
          data: {'data[_Token][key]':'<?php echo $this->Session->read('_Token.key'); ?>','QUOTE_ID':'<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>','CC_NO':$("#noCCval").val()},
          beforeSend: function(){ $("#save_card").prop('disabled', true); },
          complete: function(){ $("#save_card").prop('disabled', false);  },
          success: function(msg){  
            afterRecurring();
          }
        });
    }
  }
  function clickBayar(){
    if(valQuote.form()) {
      ga('send', 'event', 'customer', 'click', 'get a quote – finish');
      if ($('input[name=pembayaran]:checked').val()=='ecash') {
        $.ajax({
          url: "<?php echo $this->Html->url('/front/getECashtoken/'.$name);?>",
          type: "GET",
          cache: false,
          data: {'id':'<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>'},
          beforeSend: function(){ $("#paybutt").prop('disabled', true); },
          complete: function(){  },
          success: function(msg){  
          if (msg == "1"){  
                   alert("Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.");
                   location.reload();
                }else{
            window.location.replace("<?php echo $ECashPayUrl.'?id='; ?>"+msg);            
          }
          }
        });

      } 
      //START: Temporary disable card input modal/alert
      else if($('input[name=pembayaran]:checked').val()=='creditcard') {
        sendCC();
      } else if($('input[name=pembayaran]:checked').val()=='bca') {
          sendKlikPay();
      }  else if($('input[name=pembayaran]:checked').val()=='cimbclick') {
          sendCimbClick();
      }else if($('input[name=pembayaran]:checked').val()=='nicepay') {
          sendNicePay();
      }
      // else { 
      //  $('#modalta').modal('show');
      // }
      // END: Temporary disable card input modal/alert
    }
  }
  
  function afterRecurring(){
    $('#modalta').modal('hide');
    if($('input[name=pembayaran]:checked').val()=='creditcard') {
      sendCC();
    } else if($('input[name=pembayaran]:checked').val()=='bca') {
        sendKlikPay();
    } 
  }
  
  function sendKlikPay(){
    $.ajax({
          url: "<?php echo $this->Html->url('/front/getBCAtoken/'.$name);?>",
          type: "GET",
          cache: false,
          data: {'id':'<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>'},
          beforeSend: function(){ $("#paybutt").prop('disabled', true); },
          complete: function(){  },
          success: function(msg){  
alert(msg);
          if (msg == "1"){  
                   alert("Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.");
                   location.reload();
                }else{
            msg=JSON.parse(msg);
            postData("<?php echo $urlKlikPay ?>",{
              klikPayCode:msg['klikPayCode'],
              transactionNo:msg['transactionNo'],
              totalAmount:msg['totalAmount'],
              payType:msg['payType'],
              callback:msg['callback'],
              miscFee:msg['miscFee'],
              transactionDate:msg['transactionDate'],
              signature:msg['signature'],
              descp:msg['descp'],
              currency:msg['currency'],
            });
          }
          }
        });
  }


   function sendCimbClick(){
    $.ajax({
          url: "<?php echo $this->Html->url('/front/getCIMBtoken/'.$name);?>",
          type: "GET",
          cache: false,
          data: {'id':'<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>'},
          beforeSend: function(){ $("#paybutt").prop('disabled', true); },
          complete: function(){  },
          success: function(msg){  
	alert(msg);
          if (msg == "1"){  
                   alert("Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.");
                   location.reload();
                }else{
            msg=JSON.parse(msg);
            postData("<?php echo $urlCimbClick ?>",{
              merchantCode:msg['merchantCode'],
              paymentID:msg['paymentId'],
              refNo:msg['refNo'],
              amount:msg['totalAmount'],
              currency:msg['currency'],
              prodDesc:msg['descp'],
              userName:msg['userName'],
              userEmail:msg['userEmail'],
              userContact:msg['userContact'],
              remark:msg['remark'],
              lang:msg[''],

              signature:msg['signature'],
              responseUrl:msg['responseUrl'],
              backendUrl:msg['backendUrl']

           
            });
          }
          }
        });
  }



function sendNicePay(){
var amount = document.getElementById("Amount").value;
var bankCd= document.getElementById("bankCd").value;
var payMethod= document.getElementById("payMethod").value;
    $.ajax({
          url: "<?php echo $this->Html->url('/front/nicepay_purchase/');?>",
          type: "GET",
          cache: false,
          data: {'id':'<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>',
		'bankCd': bankCd,
		'Amount': '<?php echo $this->Session->read('Purchase.premi.total_premi'); ?>',
		'payMethod':'02',
		},
          beforeSend: function(){ $("#paybutt").prop('disabled', true); },
          complete: function(){  },
          success: function(msg){  

	//window.location.replace("<?php echo $this->Html->url('/front/nicepay_payment/');?>");
          

          if (msg == "1"){  
                   alert("Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.");
                   location.reload();
                }else{

	    window.location.replace("<?php echo $this->Html->url('/payment/transfer-virtual-account/'.$name.'.htm');?>");

          //  msg=JSON.parse(msg);
          //  postData("<?php echo $NicePayUrl ?>",{
          //    merchantCode:msg['merchantCode'],
          //    paymentID:msg['paymentId'],
          //    refNo:msg['refNo'],
          //    amount:msg['totalAmount'],
          //    currency:msg['currency'],
          //    prodDesc:msg['descp'],
          //    userName:msg['userName'],
          //    userEmail:msg['userEmail'],
          //    userContact:msg['userContact'],
          //    remark:msg['remark'],
          //    lang:msg[''],

          //    signature:msg['signature'],
          //    responseUrl:msg['responseUrl'],
          //    backendUrl:msg['backendUrl']

           
          //  });
          }
          }
        });
  }


  
  function sendCC(){  
    $.ajax({
          url: "<?php echo $this->Html->url('/front/getVisaMastertoken/'.$name);?>",
          type: "GET",
          cache: false,
          data: {'id':'<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>'},
          beforeSend: function(){ $("#paybutt").prop('disabled', true);  },
          success: function(msg){
                 if (msg == "1"){  
                   alert("Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.");
                   location.reload();
                }else{
            msg=JSON.parse(msg);
            postData("<?php echo $urlDO ?>",{
              siteID:msg['siteID'],
              serviceVersion:msg['serviceVersion'],
              merchantTransactionID:msg['merchantTransactionID'],
              amount:msg['amount'],
              callback:msg['callback'],
              miscFee:msg['miscFee'],
              transactionDate:msg['transactionDate'],
              signature:msg['signature'],
              descp:msg['descp'],
              currency:msg['currency'],
              checkSum:msg['checkSum']
            });
          }

          },
          error: function(msg){
            //alert("error");
            console.log(msg);
          },
          "statusCode": {
          403: function() {
            alert(" 403 ");
          },
          500: function(msg) {
            alert('Error Server Side occured type on change');
            console.log(msg);
          }
        }
        });
  }
  
  function signature(){  
    if($("input[name=agree1]").is(':checked')) status='S'; else status='Q';
 
  <?php if($name!='jaga-aman-instan'): ?>
    $.ajax({
      url: "<?php echo $this->Html->url('/front/StatusQuote/');?>",
      type: "GET",
      cache: false,
      data: {'id':<?php echo $this->Session->read('Purchase.QUOTE_ID'); ?>,'status':status},
      beforeSend: function(){ },
      complete: function(){  },
      success: function(msg){  
        // When failed update quote status to API,simply uncheck the TOC.
        if (msg != 'SUCCESS_MESSAGE') 
            $("input[name=agree1]").attr('checked', false);  
      }
    });
   <?php endif; ?>
  }

  function postData(path, params, method) {
    method = method || "post";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
      if(params.hasOwnProperty(key)) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
      }
    }
    document.body.appendChild(form);
    form.submit();
  }
  
  $(document).ready(function() {
    ga('send', 'pageview', '/get-a-quote-finish/'); 
  });
</script>