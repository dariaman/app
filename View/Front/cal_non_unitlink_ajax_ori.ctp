 <?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>
 <div class="row margintop">
  <div class="col-md-offset-1 col-md-10">
    <div class="box-grey-top">
      <span class="bold">
        Informasi Pembayaran Premi
      </span>
    </div>
    
    <?php if($data['product_id']==17 || $data['product_id']==18 || $data['product_id']==14 || $data['product_id']==15): ?>
    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Periode Pembayaran Premi</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <h4 class="title-calculate"><span class="bold"><?php if(isset($data['QUOTE_PREMIUM_LIFESPAN'])) echo (($data['QUOTE_PREMIUM_LIFESPAN']==5)?$data['QUOTE_PREMIUM_LIFESPAN']:'5').' Tahun'; else if(isset($data['QUOTE_DURATION_HOUR'])) echo $data['QUOTE_DURATION_HOUR'].' Jam'; else echo $data['QUOTE_DURATION_DAYS'].' Hari';  ?></span></h4>
        </div>
      </div>
    </div>
    <?php endif;?>
    <?php if($data['product_id'] !='7'): //hide freq_pembayaran khusus JAI?>
     <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Frekuensi Pembayaran Premi</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <h4 class="title-calculate">
            <span class="bold">
              <?php echo $this->Session->read('Purchase.premi.frek'); ?>
              <?php if('12' == $this->Session->read('Purchase.premi.mode') ): ?>
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
          <h4 class="title-calculate"><span class="bold"><?php echo rp($premium); ?></span></h4>
        </div>
      </div>
    </div>
    
  <?php 
    //calculate  print fee
    $totalPrintFee=0;
    if($data['product_id'] =='7'){
       if($data['HARD_COPY'] == 'T'){
        $totalPrintFee=($valjai>=180)?25000:0;
       } else {
        $totalPrintFee=50000;
       }
    } else {
      if($data['product_id']!='5'){$totalPrintFee=($data['HARD_COPY'] == 'Y')?50000:0;}
    }
  
  ?>
        <?php if($data['product_id'] !='5'):?>
        <div class="box-grey-second">
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
              <?php if($data['product_id']=='12'):?>
              <h4 class="title-calculate">Biaya Pencetakan dan Pengiriman Buku Polis</h4>
              <?php else:?>
              <h4 class="title-calculate">Biaya Pencetakan dan Pengiriman Data/Buku Polis</h4>
              <?php endif;?>
            </div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8"> 
              <h4 class="title-calculate"><span class="bold"><?php echo rp($totalPrintFee); ?> (hanya dibayarkan sekali dimuka)</span></h4>
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
            <h4 class="title-calculate"><span class="bold"><?php echo rp($premium+$totalPrintFee); ?></span></h4>
          </div>
        </div>
      </div>
  
  <br/>
    <div class="box-grey-top">
      <span class="bold">
        Informasi Manfaat
      </span>
    </div>

    <div class="box-grey-second">
      <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
          <h4 class="title-calculate">Periode Pertanggungan</h4>
        </div>
        <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
          <?php if($data['product_id']=='12' || $data['product_id']=='13'):?>
          <h4 class="title-calculate">
            <span class="bold">
              1 tahun dan dapat diperpanjang secara otomatis hingga usia 70 tahun
            </span>
          </h4>
          <?php else:?>
          <h4 class="title-calculate"><span class="bold"><?php if(isset($data['QUOTE_PREMIUM_LIFESPAN'])) echo $data['QUOTE_PREMIUM_LIFESPAN'].' Tahun'; else if(isset($data['QUOTE_DURATION_HOUR'])) echo $data['QUOTE_DURATION_HOUR'].' Jam'; else echo $data['QUOTE_DURATION_DAYS'].' Hari';  ?></span></h4>
          <?php endif;?>
        </div>
      </div>
    </div>
    <?php if($data['product_id'] =='11'): //change 6 -> 11?>
      <?php $se = $this->Session->read('Purchase.premi.frek'); ?>
      <?php if($se=='Bulanan'): ?>
        <?php $rop = $data['QUOTE_PREMIUM_LIFESPAN'] * 12 * 0.5 * $premium?>
      <?php else: ?>
        <?php $rop = $data['QUOTE_PREMIUM_LIFESPAN'] * 0.5 * $premium?>
      <?php endif ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Jumlah Pengembalian Premi / 3 tahun</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">
              <?php echo rp($rop)?>
            </span></h4>
          </div>
        </div>
      </div>
    <?php endif ?>
    <?php  if($data['product_id'] =='11'): //change 6 -> 11?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Rawat Inap</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])).' / hari'; ?></span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",($data['SUM_INSURED']*20))); ?></span></h4>
          </div>
        </div>
      </div>
    <?php elseif($data['product_id'] == '5'): ?>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Rumah Sakit</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Hingga <?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?> (akibat penyakit demam berdarah)</span></h4>
          </div>
        </div>
      </div>
      <div class="box-grey-second">
        <div class="row">
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia</h4>
          </div>
          <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
            <h4 class="title-calculate"><span class="bold">Hingga <?php echo rp(preg_replace("/[^0-9]/","",($data['SUM_INSURED']*2))); ?> (akibat penyakit demam berdarah)</span></h4>
          </div>
        </div>
      </div>
    <?php  endif?>
    <?php if($data['product_id'] !='7' && $data['product_id'] !='5' && $data['product_id'] !='12' && $data['product_id'] !='13' && $data['product_id'] !='14' && $data['product_id'] !='15' && $data['product_id'] !='17' && $data['product_id'] !='18'): ?>
    <?php //else: ?>
      <div class="box-grey-second">
        <div class="row">
          <?php if($data['product_id']=='3'): //edit andi?>
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
          </div>
          <?php elseif($data['product_id']=='2'): //edit andi?>
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Santunan Meninggal Dunia</h4>
          </div>
          <?php elseif($data['product_id']!='5' || $data['product_id'] !='12' || $data['product_id'] !='13' || $data['product_id'] !='14'): //edit andi?>
          <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
            <h4 class="title-calculate">Manfaat</h4>
          </div>
          <?php endif;?>
          <?php if($data['product_id'] =='11'): //change 6 -> 11?>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
              <h4 class="title-calculate">
                <span class="bold">
                  <ul style="list-style-type: upper-latin; margin-left:25px;">
                    <li>
                      Layanan bantuan 24 Jam, meliputi:
                      <ul style="list-style-type:disc; margin-left:20px;">
                        <li>Transportasi pasien</li>
                        <li>Pemulangan jenazah</li>
                        <li>Ambulance</li>
                        <li>Layanan Khusus lainnya</li>
                      </ul>
                    </li>
                    <li>
                      Beragam diskon di merchant-merchant terpilih dan tiket nonton GRATIS di Blitz Megaplex Grand Indonesia setiap bulan.
                    </li>
                  </ul>           
                </span></h4>
              </div>
            <?php elseif($data['product_id']=='3'): //edit andi ?>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            <?php elseif($data['product_id']=='2'): //edit andi ?>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            <?php elseif($data['product_id'] !='7'): ?>
              <!-- add perhitungan manfaat premium -->
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate">
                  <span class="bold">
                  <?php echo $data['manfaat']; ?>
                  </span>
                </h4>
              </div>
              <?php elseif($data['product_id'] !='5'): ?>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate">
                  <span class="bold">
                    <?php echo $data['manfaat']; ?>
                  </span></h4>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <!-- edit andi -->
          <?php if($data['product_id']=='7'):?>
		  <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Waktu Mulai Perlindungan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo $data['WAKTU_PERLINDUNGAN']; ?></span></h4>
              </div>
            </div>
          </div>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Perawatan Rumah Sakit akibat kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <?php if($data['SUM_INSURED']==25000000):?>
                <h4 class="title-calculate"><span class="bold">Maksimal <?php echo rp(1000000);?> per kejadian<?php //echo rp(preg_replace("/[^0-9]/","",($data['SUM_INSURED']*0.1))); ?></span></h4>
                <?php else:?>
                <h4 class="title-calculate"><span class="bold">Maksimal <?php echo rp(2000000);?> per kejadian<?php //echo rp(preg_replace("/[^0-9]/","",($data['SUM_INSURED']*0.1))); ?></span></h4>
                <?php endif;?>
              </div>
            </div>
          </div>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <?php endif; ?>
          
          <!-- JAGA JIWA-->
          <?php if($data['product_id']=='12'):?>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia bukan akibat kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",2*$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <?php endif;?>
          <!-- JAGA AMAN-->
          <?php if($data['product_id']=='13'):?>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia akibat kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Perawatan Rumah Sakit akibat Kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",0.1*$data['SUM_INSURED'])); ?></span></h4>
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
          <?php endif;?>
          
          <!-- JAGA JIWA PLUS-->
          <?php if($data['product_id']=='14' || $data['product_id']=='15') :?>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia bukan akibat kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia akibat Kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",2*$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <!-- JJP No Claim Bonus -->
          <?php $se = $this->Session->read('Purchase.premi.frek'); ?>
          <?php if($se=='Bulanan'): ?>
            <?php if($data['product_id']=='14'):?>
              <?php $ncb = $data['QUOTE_PREMIUM_LIFESPAN'] * 12 * $premium ?>
            <?php elseif($data['product_id']=='15'): ?>
              <?php $basencb = 5 * 12 * $premium ?>
              <?php $ncb = $basencb + (0.1 * $basencb) ?>
            <?php endif ?>
          <?php else: ?>
            <?php if($data['product_id']=='14'):?>
              <?php $ncb = $data['QUOTE_PREMIUM_LIFESPAN'] * $premium ?>
            <?php elseif($data['product_id']=='15'): ?>
              <?php $basencb = 5 * $premium ?>
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
          <?php endif;?>
          
          <!-- JAGA AMAN PLUS-->
          <?php if($data['product_id']=='17' || $data['product_id']=='18') :?>
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Santunan Meninggal Dunia akibat Kecelakaan</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php echo rp(preg_replace("/[^0-9]/","",$data['SUM_INSURED'])); ?></span></h4>
              </div>
            </div>
          </div>
          <!-- JAP No Claim Bonus -->
          <?php $se = $this->Session->read('Purchase.premi.frek'); ?>
          <?php if($se=='Bulanan'): ?>
            <?php if($data['product_id']=='17'):?>
              <?php $ncb = $data['QUOTE_PREMIUM_LIFESPAN'] * 12 * $premium ?>
            <?php elseif($data['product_id']=='18'): ?>
              <?php $basencb = 5 * 12 * $premium ?>
              <?php $ncb = $basencb + (0.1 * $basencb) ?>
            <?php endif ?>
          <?php else: ?>
            <?php if($data['product_id']=='17'):?>
              <?php $ncb = $data['QUOTE_PREMIUM_LIFESPAN'] * $premium ?>
            <?php elseif($data['product_id']=='18'): ?>
              <?php $basencb = 5 * $premium ?>
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
          <?php endif;?>
          
          
        </div>
      </div>
    <?php //echo $data['product_id'];//endif; ?>
    <?php if($data['product_id']=='7' && $valjai >= 30):?>
    <div class="row margintop">
      <div class="col-md-12">
        <div class="clearfix">
          <span class="red">Klik Lanjut Untuk Pembayaran dengan Kartu Kredit atau BCA KlikPay. Chat dengan CS kami untuk opsi cara pembayaran lainnya.</span>
        </div>
      </div>
    </div>
    <?php elseif($data['product_id']!='7'):?>
    <div class="row margintop">
      <div class="col-md-12">
        <div class="clearfix">
          <span class="red">Klik Lanjut Untuk Pembayaran dengan Kartu Kredit atau BCA KlikPay. Chat dengan CS kami untuk opsi cara pembayaran lainnya.</span>
        </div>
      </div>
    </div>
    <?php endif;?>
    <div class="row margintop">
      <div class="col-md-10" style="margin-right:-55px;">
        <?php if($data['product_id']=='7' && $valjai >= 30):?>
        <div class="clearfix">
          <div class="pull-right">
            <a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', 'potential lead', 'click', 'chat with us'); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
              <button class="btn-cust-service">Chat dengan CS</button>
            </a>
          </div>
        </div>
        <?php elseif($data['product_id']!='7'):?>
        <div class="clearfix">
          <div class="pull-right">
            <a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', 'potential lead', 'click', 'chat with us'); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
              <button class="btn-cust-service">Chat dengan CS</button>
            </a>
          </div>
        </div>
        <?php endif;?>
      </div>
      <div class="col-md-2">
        <div class="clearfix">
          <div class="pull-right">
            <button class="btn-lanjut" type="submit">Lanjut</button>
          </div>
        </div>
      </div>
    </div>
  </form>
