 <?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>
 <div class="row margintop">
		<div class="col-md-offset-1 col-md-10">
			
			
			<div class="box-grey-top">
					<span class="bold">
					Informasi Pembayaran
					</span>
				</div>
				
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
				
				<div class="box-grey-second">
					<div class="row">
						<div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
							<h4 class="title-calculate">Premi yang dibayarkan</h4>
						</div>
						<div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
							<h4 class="title-calculate"><span class="bold"><?php echo rp($premium);?></span></h4>
						</div>
					</div>
				</div>
        
        <!-- REQ_HARD_COPY --> 
          <div class="box-grey-second">
            <div class="row">
              <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
                <h4 class="title-calculate">Biaya Pencetakan dan Pengiriman Data/Buku Polis</h4>
              </div>
              <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
                <h4 class="title-calculate"><span class="bold"><?php $totalPrintFee=($data['HARD_COPY'] == 'Y')?50000:0; echo  rp($totalPrintFee); ?> (hanya dibayarkan sekali dimuka)</span></h4>
              </div>
            </div>
          </div> 
        
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
            <h4 class="title-calculate"><span class="bold"><?php echo rp($premium+$totalPrintFee+500000); ?></span></h4>
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
							<h4 class="title-calculate"><span class="red">Tipe Investasi</span></h4>
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
										<h4 class="title-calculate"><span class="bold"><?php echo rp($data[1]['SUM_INSURED']) ?></span></h4>
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
										<h4 class="title-calculate"><span class="bold"><?php echo rp($data[3]['SUM_INSURED']) ?></span></h4>
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
										<h4 class="title-calculate">Uang Pertanggungan <span style="color:red;font-weight:bold;">*</span></h4>
									</div>
									<div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
										<h4 class="title-calculate"><span class="bold"><?php echo rp($data[4]['SUM_INSURED']) ?></span></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
							<h4 class="title-calculate">Periode Pertanggungan <span style="color:red;font-weight:bold;">*</span></h4>
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
							<h4 class="title-calculate">Investasi tahun pertama : </h4>
						</div>
            <div class="col-xs-6 col-sm-7 col-md-8 col-lg-8">
							<h4 class="title-calculate"><?php echo rp(round($chart[1]['high'],0))?></h4>
						</div>
					</div>
          <div class="row">
            <div class="col-xs-6 col-sm-offset-1 col-sm-4 col-md-3 col-lg-3">
							<h4 class="title-calculate">Investasi tahun terakhir &nbsp;: </h4>
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
		 

	</div>
</div>
	
	<script type="text/javascript">
var dataChart = [
<?php $i=1;foreach($chart as $c):?>
    {y: '<?php echo $i?>', item1: <?php echo round($c['high'],0)?>, item2:<?php echo $c['mid']?>, item3:<?php echo $c['low']?>},
<?php $i++; endforeach;?> ];
</script>

	<div class="row margintop">
    <div class="col-md-12">
      <div class="clearfix">
        <span class="red">Klik Lanjut Untuk Pembayaran dengan Kartu Kredit atau BCA KlikPay. Chat dengan CS kami untuk opsi cara pembayaran lainnya.</span>
      </div>
    </div>
  </div>
	<div class="row margintop">
      <div class="col-md-10" style="margin-right:-55px;">
				<div class="clearfix">
				 
				<div class="pull-right">
        <a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', 'potential lead', 'click', 'chat with us'); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
					<button class="btn-cust-service">Chat dengan CS</button>
        </a>
				</div>
				</div>
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
