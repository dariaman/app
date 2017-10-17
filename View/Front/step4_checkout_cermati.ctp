<?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>

<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Purchasing Steps</li>
      <li class="active">Finish</li>
    </ol>
    <!--<div class="mainvisual-finish">
    </div>-->
    <!--<?php if($this->Session->read('Purchase.step1.product_id')==11||$this->Session->read('Purchase.step1.product_id')==23|| $this->Session->read('Purchase.step1.product_id')==12 || $this->Session->read('Purchase.step1.product_id')==13 || $this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==17):?>
      <center style="margin: 0 0 20px;"><a href="https://www.jagadiri.co.id/promo/valentine-promo-2016.htm"><img src="/img/banner_top_small.jpg" class="img-responsive"></a></center>
    <?php endif;?>-->
    <center><img src="<?php echo $this->Html->url('/')?>img/step3.jpg" class="img-responsive"></center>
  </div>
</div>
<!--<div class="row margintop">
  <div class="col-md-10">
    <ul class="nav-tabs" role="tablist">
      <li><a href="<?php 
        if($cat=='non-unit-link') echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_non_unitlink','id'=>$name,'?'=>array('sid'=>$sid))); 
        else echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_unitlink','id'=>$name,'?'=>array('sid'=>$sid))); ?>" >Dapatkan Quote</a>
      </li>
      <li><a href="<?php 
        echo $this->Html->url(array('controller' =>'front', 'action'=>'step2_your_detail','id'=>$name,'?'=>array('cat'=>$cat,'sid'=>$sid))); ?>"><span class="hidden-xs">Isi</span> Data</a>
      </li>
      <li class="active"><a>Selesai</a></li>
    </ul>
  </div>
</div>-->
<div class="row margintop">
  <div class="col-md-12">
    <div class="clearfix">
      <h2 class="title-quote">
        <!--<span class="bold red">KONFIRMASI</span> <span class="bold">Silahkan cek kembali data yang telah Anda masukkan</span>-->
	<span class="bold red">MOHON</span> <span class="bold">cek kembali data yang sudah Anda masukkan</span>
      </h2>
      <h3 class="title-wajib">
        <span class="red">*Wajib Diisi</span>
      </h3>
    </div>
    <hr class="redline">
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box-grey-top">
      <span class="bold">
        Informasi Pembayaran Premi
      </span>
    </div>
    
    <?php if($cat=='non-unit-link'):?>
    
    <?php if($this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==18 || $this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15): //hide freq_pembayaran khusus JAI?>
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Periode Pembayaran Premi</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <h4 class="title-calculate"><span class="bold"><?php if($this->Session->check('Purchase.step1.QUOTE_PREMIUM_LIFESPAN')) echo (($this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN')==5)?$this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN'):'5').' Tahun'; else if($this->Session->check('Purchase.step1.QUOTE_DURATION_HOUR')) echo $this->Session->read('Purchase.step1.QUOTE_DURATION_HOUR').' Jam'; else echo $this->Session->read('Purchase.step1.QUOTE_DURATION_DAYS').' Hari';  ?></span></h4>
        </div>
      </div>
    </div>
    <?php endif;?>

    <?php if($this->Session->read('Purchase.step1.product_id')!='7'):?>
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Frekuensi Pembayaran Premi</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <h4 class="title-calculate">
            <span class="bold">
              <?php echo $this->Session->read('Purchase.premi.frek'); ?>
	      <?php if('24' == $this->Session->read('Purchase.step1.product_id') ): ?>

              
              <?php elseif('12' == $this->Session->read('Purchase.premi.mode') ): ?>
                (hemat 10% dari perhitungan premi bulanan)
              <?php endif; ?>
            </span>
          </h4>
        </div>
      </div>
    </div>
    <?php endif;?>
    
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Premi yang dibayarkan</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <?php $prem_total=$this->Session->read('Purchase.premi.total_premi');?>
          <?php if($this->Session->read('Purchase.step1.HARD_COPY')=='Y'):?>
	
            <h4 class="title-calculate">
              <span class="bold">
                <?php $basic_premium = $prem_total-50000; ?> 
                <?php echo rp($basic_premium); ?> 
              </span>
            </h4>
	     <?php elseif($this->Session->read('Purchase.step1.product_id')=='7' && $this->Session->check('Purchase.step1.QUOTE_DURATION_DAYS') && $this->Session->read('Purchase.step1.QUOTE_DURATION_DAYS')>=180): ?> 
      <h4 class="title-calculate"><span class="bold"><?php $basic_premium = $prem_total-25000; ?> <?php echo rp($basic_premium); if($basic_premium<=0){ $this->Session->destroy();?><script>if (window.confirm('Terjadi kesalahan, mohon ulangi proses pembelian hanya dengan 1 tab saja pada browser anda.'))
{
    // They clicked Yes
	window.location = "<?php echo $this->Html->url('/get-a-quote-non-unit-link/'.$name.'.htm'); ?>";
}
else
{
    // They clicked no
	window.location = "<?php echo $this->Html->url('/')?>";
}
</script><?php } ?></span></h4>
          <?php else: ?>
            <h4 class="title-calculate"><span class="bold"><?php $basic_premium = $prem_total; ?><?php echo rp($basic_premium); if($basic_premium<=0){session_destroy();?><script>if (window.confirm('Terjadi kesalahan, mohon ulangi proses pembelian hanya dengan 1 tab saja pada browser anda.'))
{
    // They clicked Yes
	window.location = "<?php  echo $this->Html->url('/get-a-quote-non-unit-link/'.$name.'.htm'); ?>";
}
else
{
    // They clicked no
	window.location = "<?php echo $this->Html->url('/')?>";
}
</script><?php } ?> </span></h4>
          <?php endif;?>
        </div>
      </div>
    </div>
    
	<?php
	  //calculate cahsless feature 1x
		$totalPrint=0;
		$cashlessFee=0;
		if($this->Session->read('Purchase.step1.product_id') =='21'){
		  $cashlessFee= $this->Session->read('Purchase.step1.cashlessFee');  
		}
	?>
	<?php if ($this->Session->read('Purchase.step1.product_id')=='21'):?>
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              
              <h4 class="title-calculate">Biaya Fitur Cashless</h4>
              
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8"> 
              <h4 class="title-calculate"><span class="bold">
                <?php 
                  if ($this->Session->read('Purchase.step1.CASHLESS') == 'Y') {
                    if ($this->Session->read('Purchase.step1.QUOTE_PREMIUM_MODE') == 12) {
                      echo rp($cashlessFee) . " (dibayarkan sekali dimuka)";
                    }
                    else {
                      echo rp($cashlessFee) . " (dibayarkan secara reguler bersamaan dengan premi)";
                    }
                  }
                  else { echo "Rp 0"; } 
                ?>
              </span></h4>
            </div>
          </div>
        </div>
    <?php endif;?>
	
    <!-- HARD COPY -->
    <?php if($this->Session->read('Purchase.step1.product_id')!='5'): ?>
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <?php if($this->Session->read('Purchase.step1.product_id')=='12'|| $this->Session->read('Purchase.step1.product_id')=='21'):?>
          <h4 class="title-calculate">Biaya Pencetakan dan Pengiriman Buku Polis</h4>
          <?php else:?>
          <h4 class="title-calculate">Biaya Pencetakan dan Pengiriman Data/Buku Polis</h4>
          <?php endif;?>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <h4 class="title-calculate"><span class="bold">
	  <?php
	  if ($this->Session->read('Purchase.step1.product_id')=='24' && $this->Session->read('Purchase.jmk.ph_reqbook')=='Y') $totalPrint=50000;  
	  else if($this->Session->read('Purchase.step1.product_id')=='7' && $this->Session->check('Purchase.step1.QUOTE_DURATION_DAYS') && $this->Session->read('Purchase.step1.QUOTE_DURATION_DAYS')>=180 && $this->Session->read('Purchase.step1.HARD_COPY')=='T') 
		$totalPrint=25000; 
	  else $totalPrint=($this->Session->read('Purchase.step1.HARD_COPY')=='Y')?50000:0; 
	
	  echo  rp($totalPrint); 
          ?> (hanya dibayarkan sekali dimuka)</span></h4>
        </div>
      </div>
    </div> 
    <?php endif;?>
    
  
    
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
           <h4 class="title-calculate"><span class="bold">Biaya Keseluruhan</span></h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">

	<h4 class="title-calculate"><span class="bold">
		<?php   
	//if($this->Session->read('Purchase.step1.CASHLESS')){
	if($this->Session->read('Purchase.step1.product_id')=='24'){
		/*if ($this->Session->read('Purchase.step1.CASHLESS') == 'Y' &&  $this->Session->read('Purchase.step1.HARD_COPY') == 'Y' ) {
		echo rp($this->Session->read('Purchase.premi.total_premi') + 50000 + $cashlessFee); 
		}else if ($this->Session->read('Purchase.step1.CASHLESS') == 'Y') {
		echo rp($this->Session->read('Purchase.premi.total_premi') + $cashlessFee); 
		}else if($this->Session->read('Purchase.step1.HARD_COPY')=='Y'){
		echo rp($this->Session->read('Purchase.premi.total_premi') + 50000); 
		}else{ 
		echo rp($this->Session->read('Purchase.premi.total_premi'))	;
		}*/


		echo rp($this->Session->read('Purchase.premi.total_premi'))	;

	}else
		echo rp($this->Session->read('Purchase.premi.total_premi') + $this->Session->read('Purchase.step1.cashlessFee') ); 
		?>
	</span></h4>

        </div>
      </div>
    </div>
    <br/>
    <div class="box-grey-top">
      <span class="bold">
        Informasi Manfaat
      </span>
    </div>
    <?php if($name=='jaga-sehat-plus'): ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Rawat Inap</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?> / hari</span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*20); ?></span></h4>
          </div>
        </div>
      </div>
	  <?php elseif($name=='jaga-sehat-keluarga'): ?>
	  <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate"><span class="bold">Maksimum Klaim Polis Pertahun</span></h4>
          </div>
		  <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*300); ?></span></h4>
          </div>
        </div>
		</div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Harian Rawat Inap akibat Sakit atau Kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?> / hari</span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Pembedahan akibat Sakit atau Kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*20); ?> (limit maksimum per pembedahan)</span></h4>
          </div>
        </div>
      </div>
	  <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Harian Rawat Jalan akibat Sakit atau Kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">
      <?php
      if($this->Session->read('Purchase.step1.SUM_INSURED') >300000) {
        echo 'Rp 500,000';
      }
      else {
        echo rp($this->Session->read('Purchase.step1.SUM_INSURED'));
      }
      ?>
			</span></h4>
          </div>
        </div>
      </div>
	  <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Layanan Bantuan 24/7</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Tersedia</span></h4>
          </div>
        </div>
      </div>
	  <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">No Claim Bonus 25% Setiap Tahun</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Tersedia</span></h4>
          </div>
        </div>
      </div>
<!--init manfaat jmk-->
<?php elseif($name=='jaga-motorku'): ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Periode Pertanggungan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo 12;//echo $this->Session->read('Purchase.premi.mode'); ?> Bulan</span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Manfaat</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo $prod_det['Product']['manfaat']; ?></span></h4>
          </div>
        </div>
      </div>
    
<!--end manfaat jmk-->
    <?php elseif($name=='jaga-sehat-dbd'): ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Biaya Rumah Sakit</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Hingga  <?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?> (akibat penyakit demam berdarah)</span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Hingga  <?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*2); ?> (akibat penyakit demam berdarah)</span></h4>
          </div>
        </div>
      </div>
    <!-- JJP -->  
    <?php elseif($this->Session->read('Purchase.step1.product_id')=='14' || $this->Session->read('Purchase.step1.product_id')=='15'): ?> 
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia bukan akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?></span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*2); ?></span></h4>
          </div>
        </div>
      </div>
      <!-- JJP No Claim Bonus -->
      <?php $se = $this->Session->read('Purchase.premi.frek'); ?>
      <?php if($se=='Bulanan'): ?>
        <?php if($this->Session->read('Purchase.step1.product_id')=='14'):?>
          <?php $ncb = $this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN') * 12 * $basic_premium ?>
        <?php elseif($this->Session->read('Purchase.step1.product_id')=='15'): ?>
          <?php $basencb = 5 * 12 * $basic_premium ?>
          <?php $ncb = $basencb + (0.1 * $basencb) ?>
        <?php endif ?>
      <?php else: ?>
        <?php if($this->Session->read('Purchase.step1.product_id')=='14'):?>
          <?php $ncb = $this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN') * $basic_premium ?>
        <?php elseif($this->Session->read('Purchase.step1.product_id')=='15'): ?>
          <?php $basencb = 5 * $basic_premium ?>
          <?php $ncb = $basencb + (0.1 * $basencb) ?>
        <?php endif ?>
      <?php endif ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">No Claim Bonus</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">
              <?php echo rp($ncb)?>
            </span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Manfaat Lainnya</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Layanan Bantuan 24/7 meliputi * :</span></h4>
            <ol style="list-style-type: decimal; margin-left: 50px;">
              <li>24/7 tele-konsultasi medis</li>
              <li>Evakuasi medis (Layanan yang diberikan apabila Tertanggung perlu layanan evakuasi dari tempat kejadian ke fasilitas perawatan terdekat)</li>
              <li>Repatriasi medis (Layanan yang diberikan apabila Tertanggung memerlukan layanan khusus untuk mengembalikan dirinya ke Tempat Tinggal Resmi setelah kondisi dirinya telah dinyatakan stabil oleh pihak yang merawat)</li>
              <li>Transportasi untuk mendampingi Tertanggung (Layanan yang diberikan ketika Tertanggung perlu dirawat selama lebih dari 7 hari saat sedang bepergian min. 100 km dari Tempat Tinggal Resmi)</li>
              <li>Pengiriman obat dalam keadaan darurat</li>
              <li>Layanan lainnya</li>
            </ol>
            <span class="bold" style="font-size: small;margin-left: 15px;">* Bekerjasama dengan Blue Dot Assistance</span>
          </div>
        </div>
      </div>
    <!-- JAP -->  
    <?php elseif($this->Session->read('Purchase.step1.product_id')=='17' || $this->Session->read('Purchase.step1.product_id')=='18'): ?> 
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?></span></h4>
          </div>
        </div>
      </div>
      <!-- JAP No Claim Bonus -->
      <?php $se = $this->Session->read('Purchase.premi.frek'); ?>
      <?php if($se=='Bulanan'): ?>
        <?php if($this->Session->read('Purchase.step1.product_id')=='17'):?>
          <?php $ncb = $this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN') * 12 * $basic_premium ?>
        <?php elseif($this->Session->read('Purchase.step1.product_id')=='18'): ?>
          <?php $basencb = 5 * 12 * $basic_premium ?> <!-- For 7 years, only 5 years payment is calculated -->
          <?php $ncb = $basencb + (0.1 * $basencb) ?>
        <?php endif ?>
      <?php else: ?>
        <?php if($this->Session->read('Purchase.step1.product_id')=='17'):?>
          <?php $ncb = $this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN') * $basic_premium ?>
        <?php elseif($this->Session->read('Purchase.step1.product_id')=='18'): ?>
          <?php $basencb = 5 * $basic_premium ?>
          <?php $ncb = $basencb + (0.1 * $basencb) ?>
        <?php endif ?>
      <?php endif ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">No Claim Bonus</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">
              <?php echo rp($ncb)?>
            </span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Manfaat Lainnya</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Layanan Bantuan 24/7 meliputi * :</span></h4>
            <ol style="list-style-type: decimal; margin-left: 50px;">
              <li>24/7 tele-konsultasi medis</li>
              <li>Evakuasi medis (Layanan yang diberikan apabila Tertanggung perlu layanan evakuasi dari tempat kejadian ke fasilitas perawatan terdekat)</li>
              <li>Repatriasi medis (Layanan yang diberikan apabila Tertanggung memerlukan layanan khusus untuk mengembalikan dirinya ke Tempat Tinggal Resmi setelah kondisi dirinya telah dinyatakan stabil oleh pihak yang merawat)</li>
              <li>Transportasi untuk mendampingi Tertanggung (Layanan yang diberikan ketika Tertanggung perlu dirawat selama lebih dari 7 hari saat sedang bepergian min. 100 km dari Tempat Tinggal Resmi)</li>
              <li>Pengiriman obat dalam keadaan darurat</li>
              <li>Layanan lainnya</li>
            </ol>
            <span class="bold" style="font-size: small;margin-left: 15px;">* Bekerjasama dengan Blue Dot Assistance</span>
          </div>
        </div>
      </div>
    
    <?php else: ?>
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Periode Pertanggungan</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
        <?php if($this->Session->read('Purchase.step1.product_id')=='12' || $this->Session->read('Purchase.step1.product_id')=='13'):?>
          <h4 class="title-calculate">
            <span class="bold">
              1 tahun dan dapat diperpanjang secara otomatis hingga usia 70 tahun
            </span>
          </h4>
          <?php else:?>
          <h4 class="title-calculate"><span class="bold">  
        <?php if($this->Session->check('Purchase.step1.QUOTE_PREMIUM_LIFESPAN')) echo $this->Session->read('Purchase.step1.QUOTE_PREMIUM_LIFESPAN').' Tahun'; else if($this->Session->check('Purchase.step1.QUOTE_DURATION_HOUR')) echo $this->Session->read('Purchase.step1.QUOTE_DURATION_HOUR').' Jam'; else echo $this->Session->read('Purchase.step1.QUOTE_DURATION_DAYS').' Hari';  ?>
        </span></h4>
        <?php endif;?>
        </div>
      </div>
    </div>
	  <?php if($this->Session->read('Purchase.step1.product_id')=='7'): //edit andi?>
      <div class="box-grey-second">
		<div class="row">
		  <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
			<h4 class="title-calculate">Waktu Mulai Perlindungan</h4>
		  </div>
		  <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
			<h4 class="title-calculate"><span class="bold"><?php echo $this->Session->read('Purchase.step1.WAKTU_PERLINDUNGAN'); ?></span></h4>
		  </div>
		</div>
	  </div>
      <?php endif;?>
      <?php if($this->Session->read('Purchase.step1.product_id')!='3' && $this->Session->read('Purchase.step1.product_id')!='2' && $this->Session->read('Purchase.step1.product_id')!='12' && $this->Session->read('Purchase.step1.product_id')!='13'): //edit andi?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Perawatan Rumah Sakit akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <?php if($this->Session->read('Purchase.step1.SUM_INSURED')==25000000):?>
            <h4 class="title-calculate"><span class="bold"> Maksimal <?php echo rp(1000000);?> per kejadian<?php //echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*0.1); ?></span></h4>
            <?php else:?>
            <h4 class="title-calculate"><span class="bold"> Maksimal <?php echo rp(2000000);?> per kejadian<?php //echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*0.1); ?></span></h4>
            <?php endif;?>
          </div>
        </div>
      </div>
      <?php endif;?>
      <?php if($this->Session->read('Purchase.step1.product_id')=='12'): //JAGA JIWA?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia bukan akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"> <?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?></span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"> <?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')*2); ?></span></h4>
          </div>
        </div>
      </div>
      <?php elseif($this->Session->read('Purchase.step1.product_id')=='13'): //JAGA AMAN?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$this->Session->read('Purchase.step1.SUM_INSURED'))); ?></span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Perawatan Rumah Sakit akibat Kecelakaan</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$this->Session->read('Purchase.step1.SUM_INSURED')*0.1)); ?></span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Manfaat Lainnya</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Layanan Bantuan 24/7</span></h4>
          </div>
        </div>
      </div>
      <?php else: //end JAGA JIWA and JAGA AMAN?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <?php if($this->Session->read('Purchase.step1.product_id')=='2'):?>
            <h4 class="title-calculate">Santunan Meninggal Dunia</h4>
            <?php else:?>
            <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
            <?php endif;?>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"> <?php echo rp($this->Session->read('Purchase.step1.SUM_INSURED')); ?></span></h4>
          </div>
        </div>
      </div>
      <?php endif;?>
    <?php endif; ?>
    <!-- periode pertanggung pindah ke atas -->

  <?php else: 
  $data=$this->Session->read('Purchase.step1'); $premium=$this->Session->read('Purchase.premi.total_premi'); 
  ?>
    <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Frekuensi Pembayaran</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold"><?php echo $this->Session->read('Purchase.premi.frek'); ?></span></h4>
            </div>
          </div>
    </div>    


        <?php if($this->Session->read('Purchase.step1.product_id')=='24'){ ?>
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Premi yang dibayarkan</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold">else echo rp($premium);?></span></h4>
            </div>
          </div>
        </div>

        <?php }else{ ?>        
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Premi yang dibayarkan</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold"><?php if($this->Session->read('Purchase.step1.HARD_COPY')=='Y') echo rp($premium-500000-50000); else echo rp($premium-500000);?></span></h4>
            </div>
          </div>
        </div>
        <?php } ?>
        
        <!-- HARD COPY -->
        <?php if($this->Session->read('Purchase.step1.product_id')!='5'): ?>
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Biaya Pencetakan dan Pengiriman Data/Buku Polis</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold"><?php   $totalPrint=($data['HARD_COPY']=='Y')?50000:0; echo rp($totalPrint); ?> (hanya dibayarkan sekali dimuka)</span></h4>
            </div>
          </div>
        </div>
        <?php endif;?>
    
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Biaya akuisisi<br/>(satu kali dimuka)</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold"><?php echo rp(500000);?></span></h4>
            </div>
          </div>
        </div>
    
        <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
           <h4 class="title-calculate"><span class="bold">Biaya Keseluruhan</span></h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <h4 class="title-calculate"><span class="bold"><?php echo rp($this->Session->read('Purchase.premi.total_premi')); ?></span></h4>
        </div>
      </div>
    </div>
        
          <br/>
    <div class="box-grey-top">
      <span class="bold">
         Ilustrasi Perkembangan Investasi Anda
      </span>
    </div>
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate"><span class="red">Life Protection</span></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="white-box">
                <div class="row">
                  <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                    <h4 class="title-calculate">Uang Pertanggungan</h4>
                  </div>
                  <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                    <h4 class="title-calculate"><span class="bold"><?php echo $data[1]['SUM_INSURED'] ?></span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Periode Pertanggungan</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold"><?php echo $data['QUOTE_PREMIUM_LIFESPAN']; ?> Tahun</span></h4>
            </div>
          </div>
        </div>
        <?php if(isset($data[3]['SUM_INSURED'])): ?>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate"><span class="red">Perlindungan Kecelakaan</span></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="white-box">
                  <div class="row">
                    <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                      <h4 class="title-calculate">Uang Pertanggungan</h4>
                    </div>
                    <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                      <h4 class="title-calculate"><span class="bold"><?php echo $data[3]['SUM_INSURED'] ?></span></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Periode Pertanggungan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo $data['QUOTE_PREMIUM_LIFESPAN']; ?> Tahun</span></h4>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if(isset($data[4]['SUM_INSURED'])): ?>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate"><span class="red">Manfaat Penyakit Kritis</span></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="white-box">
                  <div class="row">
                    <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                      <h4 class="title-calculate">Uang Pertanggungan</h4>
                    </div>
                    <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                      <h4 class="title-calculate"><span class="bold"><?php echo $data[4]['SUM_INSURED'] ?></span></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Periode Pertanggungan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo $data['QUOTE_PREMIUM_LIFESPAN']; ?> Tahun</span></h4>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Tipe Investasi</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><span class="bold"><?php echo $this->Session->read('Purchase.FUND_DESC'); ?></span></h4>
            </div>
          </div>
        </div>
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate"><span class="red">Grafik Perkembangan Investasi Anda*</span></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Investasi tahun pertama :</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><?php echo rp(round($chart[1]['high'],0))?></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <h4 class="title-calculate">Investasi tahun terakhir :</h4>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate"><?php echo rp(round($chart[count($chart)]['high'],0))?></h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-11">
              <div class="chart" id="line-chart" style="height: 300px;"></div>
              <br/>
              <center>*Hasil mungkin bervariasi berdasarkan asumsi performa indikator riwayat</center>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          var dataChart= [
          <?php $i=1;foreach($chart as $c):?>
          {y: '<?php echo $i?>', item1: <?php echo round($c['high'],0)?>, item2:<?php echo $c['mid']?>, item3:<?php echo $c['low']?>},
          <?php $i++; endforeach;?>
          ];
          var line = new Morris.Line({
            element: 'line-chart', 
            data: dataChart,
            xkey: 'y',
            ykeys: ['item1'],
            xLabelAngle: 30,
            labels: ['Rp','Middle','Low'],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto',
            parseTime:false,
            xLabelFormat:function (x) { return 'Tahun ke-'+x.label;}
          });
        </script>
      <?php endif; ?>
    </div>
  </div>

  <div class="row margintop">
    <div class="col-md-12">
      <div class="box-grey-top">
        <span class="bold">
          Data Pemegang Polis
        </span>
      </div>
      <div class=" table-responsive">
        <table class="table table-striped">

	<?php if($this->Session->check('Purchase.step2.PROSPECT_NRIC')) { ?>
  	  <tr class="box-grey-second">
            <td class="">
              <h4 class="title-calculate">Nomor KTP</h4>
            </td>
            <td class="">
              <h4 class="title-calculate"><span class="bold">
		<?php echo $this->Session->read('Purchase.step2.PROSPECT_NRIC'); ?>
	      </span></h4>
            </td>
          </tr>
	<?php } ?>

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
<br/>
 <div class="row">
          <div class="col-sm-4">
            <p style="font-size:12px;margin-top:19px;">Transfer Bank</p>
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
            <option value="BNIA">CIMB Niaga</option>
            <option value="BRIN">BRI</option>
            <option value="BDMN">Danamon</option>
          </select>

          </div>

</div>

      </div>
    </div>  

    <div class="row margintop">
      <div class="col-md-12">
        <div class="clearfix">
          <div class="pull-left">

	<?php if ($this->Session->read('Purchase.step1.product_id') == 24) {  // jaga motorku ?>
	   <a href="<?php 
            echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_non_unitlink','id'=>$name,'?'=>array('cat'=>$cat,'sid'=>$sid))); ?>">
            <div class="btn-back"><h2 class="title-btn-quote">Kembali</h2></div>
            </a>
	<?php } else { ?>
            <a href="<?php 
            echo $this->Html->url(array('controller' =>'front', 'action'=>'step2_your_detail','id'=>$name,'?'=>array('cat'=>$cat,'sid'=>$sid))); ?>">
            <div class="btn-back"><h2 class="title-btn-quote">Kembali</h2></div>
            </a>
	<?php } ?>
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
          beforeSend: function(){ $("#save_card").prop('disabled', false); },
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
//alert(msg);
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
	//alert(msg);
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
		'Amount': '<?php
		/*   
		if ($this->Session->read('Purchase.step1.CASHLESS') == 'Y' && $this->Session->read('Purchase.step1.HARD_COPY') == 'Y' ) {
		echo $this->Session->read('Purchase.premi.total_premi') + 50000 + $this->Session->read('Purchase.step1.cashlessFee') ; 
		}else if ($this->Session->read('Purchase.step1.CASHLESS') == 'Y') {
		echo $this->Session->read('Purchase.premi.total_premi') + $this->Session->read('Purchase.step1.cashlessFee'); 
		}else if($this->Session->read('Purchase.step1.HARD_COPY')=='Y'){
		echo $this->Session->read('Purchase.premi.total_premi') + 50000; 
		}else{ 
		echo $this->Session->read('Purchase.premi.total_premi');
		}
		*/
		echo $this->Session->read('Purchase.premi.total_premi')+ $this->Session->read('Purchase.step1.cashlessFee') ; 
		?>',
		'payMethod':'02',
		},
          beforeSend: function(){ $("#paybutt").prop('disabled', true); },
          complete: function(){  },
          success: function(msg){  

	//window.location.replace("<?php echo $this->Html->url('/front/nicepay_payment/');?>");
          //alert(msg);

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
    //ga('send', 'pageview', '/get-a-quote-finish/'); 
  });
</script>