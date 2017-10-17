<?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>

    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
                <li class="active">Terima Kasih</li>
            </ol>
            <div class="mainvisual">
                <nav class="navbar navsecond" role="navigation">
                    <div class="container">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class=" navbar-collapse">
                            <ul class="nav navbar-nav iwanto">
                                <li class="fourth pull-right">

                                </li>
                                <li class="pull-right hidden-xs"><h2 class="title-help"><span class="bold">Need Help ?</span></h2></li>
                            </ul>
                        </div>				<!-- /.navbar-collapse -->
                    </div>					<!-- /.container -->
                </nav>
            </div>
        </div>
    </div>
<!--
TERIMA KASIH
<br>
silahkan lakukan pembayaran premi pertama anda untuk segera mendapatkan perlindungan asuransi Jagadiri
<br><nr>
Bank		: <?=$bank ?><br>
Nomor VA	: <?=$va_no ?><br>
Nama		: <?=$nama ?><br>
Jumlah		: <?=rp($amount)?><br>
Tanggal Create	: <?php echo $date.' '.$time ?><br>
Quote ID	: <?=$quoteid ?><br>
Quote Refno	: <?=$quoterefno?><br>
produk		: <?=$produk?><br>
-->



<br>
<br>
	<div class="row">
		
		<div class="col-md-8">
			<div><img src="/img/logo.png" alt="Asuransi Jaga Diri" class="logo img-responsive"></div>
				<br>
				<br>
			<div style="margin-left: 20px;">
				<p>Hai <strong style="font-weight: bold;"><?=$nama ?></strong>,</p>
				<br>
				<p>Terima kasih atas pembelian Polis <strong><?=$produk ?></strong>. berikut adalah nomor Virtual Account Anda:</p>
				<br>
				<p><strong style="font-weight: bold;">No. VA :<?=$va_no?></strong></p>
				<p>(pastikan pengisian nomor Virtual Account sudah sesuai dengan nomor VA yang anda dapatkan saat pembelian atau pastikan pengisian nomor Virtual Account sudah sesuai dengan nomor VA yang anda dapatkan diemail)</p>
				<br>
				<p><strong style="font-weight: bold;">Bank   :<?=$bank ?></strong></p>
				<br>
				<p>Silahkan melakukan pembayaran <strong style="font-weight: bold;color:red;">paling lambat 3 X 24 Jam</strong>, terhitung sejak tanggal pembelian. Jika lewat dari waktu yang telah ditentukan, maka pembelian secara otomatis dibatalkan</p>
				<br>
				<p>Setalah pembayaran sudah dilakukan, E-polis akan dikirimkan melalui email yang terdaftar di sistem.</p>
				<br>
				<br>
				<p>Salam Hangat,<br>JAGADIRI</p>
			</div>
		</div>
		<div class="col-md-4">
		


			<center>
			<div style="margin-top: 75px;border-radius: 25px;
    background: #E1DFE1;
    padding: 20px; 
    width: 300px;
    height: 325px;">Ringkasan Pembelian
				<div style="margin-left: -20px;border-radius: 25px;
    background: #8A888A;color:white;margin-top:10px;
    padding: 15px; 
    width: 300px;
    height: 50px;"><?=$produk?></div>


			<table align="left" width="100%" style="margin-top:15px">
				<tr >
					<td width="50%">Premi</td>
					<td width="50%"><div style="margin-left: -20px;margin-top:10px;margin-bottom:10px;border-radius: 10px;
    					background: #B8B6B8;
					    padding: 10px; 
					    height: 30px;">
					<?php   
					if ($cashless == 'Y' && $hardcopy == 'Y' ) {
					echo rp($amount - 50000 - $cashlessFee ); 
					}else if ($cashless == 'Y') {
					echo rp($amount - $cashlessFee ); 
					}else if($hardcopy =='Y'){
					echo rp($amount - 50000); 
					}else{ 
					echo rp($amount);
					}
					?></div>
					</td>
				</tr>
				
				<tr>
					<td>Cashless</td>
					<td><div style="margin-left: -20px;border-radius: 10px;
    					background: #B8B6B8;margin-top:10px;margin-bottom:10px;
					    padding: 10px; 
					    height: 30px;">
					<?php   
						if ($cashless == 'Y') {
						echo rp($cashlessFee); 
						}else{ 
						echo rp(0);
						}
						?></div>
					</td>
				</tr>

				<tr>
					<td>Cetak Buku Polis</td>
					<td><div style="margin-left: -20px;border-radius: 10px;
    					background: #B8B6B8;margin-top:10px;margin-bottom:10px;
					    padding: 10px; 
					    height: 30px;">
					<?php   
							if ($hardcopy == 'Y') {
							echo rp(50000); 
							}else{ 
							echo rp(0);
							}
							?></div>
					</td>
				</tr>
				
			</table>		

<div style="margin-left: -20px;border-radius: 25px;
    background: #E82B38;color:white;margin-top:180px;
    padding: 15px; 
    width: 300px;
    height: 50px;">Total Pembelian <?=rp($amount)?></div>

						
			</div></center>
		</div>
		
	</div>


<!--<center>
<div class="table-responsive" bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' style='margin:0;font-family:Arial,Helvetica,sans-serif;border-bottom:1;align:center;'>
    <table background='' bgcolor='#e4e4e4' width='85%' style='padding:20px 0 20px 0' cellspacing='0' border='0' align='center' cellpadding='0'>
		<tbody>
			<tr>
				<td>
					<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' style='border-radius: 5px;'>
						<tbody>
							
							<tr>
								<td valign='top' style='color:#404041;line-height:16px;padding:25px 20px 0px 20px'>
									
										<section style='position: relative;clear: both;margin: 5px 0;height: 1px;border-top: 1px solid #cbcbcb;margin-bottom: 25px;margin-top: 10px;text-align: center;'>
											<h3 align='center' style='margin-top: -12px;background-color: #FFF;clear: both;width: 180px;margin-right: auto;margin-left: auto;padding-left: 15px;padding-right: 15px; font-family: arial,sans-serif;'>
												<span style='font-weight:bold'>Tagihan<br>Virtual Account</span>
											</h3>
										</section>
												
								</td>
							</tr>
							
							<tr>
								<td valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:25px 20px 0px 20px'>
								
										<span><h2 style='color: #848484; font-family: arial,sans-serif; font-weight: 200;'>Hai <?=$nama?>,</h2></span>
								
										Terima Kasih anda telah melalukan transaksi pembelian polis <?=$produk?> melalui Virtual Account.<br>
										
										<!--<br>Transaksi pembelian <?=$produk?> anda sudah kami catat dan perlindungan anda akan aktif terhitung setelah kami menerima pembayaran anda.-tutupkomen->
										<br>Selanjutnya, Silahkan melalukan pembayaran via transfer bank supaya polis anda dapat segera kami proses dan perlindungan polis anda akan aktif sesuai dengan ketentuan produk polis yang anda beli.

								</td>
							</tr>
						

														  
							<tr align='left' >
								<td style='color:#404041;font-size:12px;line-height:16px;padding:10px 16px 20px 18px'>
									<table width='50%' border='0' align='left' cellpadding='0' cellspacing='0'>		
										<span><h2 style='color: #848484; font-family: arial,sans-serif; font-weight: 200;'>Banking Details</h2></span>
									
										<tbody>
											<tr>
												<td align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
													<strong>Transaction Number:</strong>
												</td>
												<td width='62' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
													<?=$quoterefno ?>
												</td>
											</tr>
											
											<tr>
												<td width='0' align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:0px 0px 3px 0px'>
													<strong>Bank:</strong> 
												</td>
												<td width='0' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:0px 5px 3px 5px'>
													<?=$bank ?>
												</td>
											</tr>
											
											<tr>
												<td align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
													<strong>Account Name:</strong>
												</td>
												<td width='120' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
													<?=$nama ?>
													</td>
											</tr>							
											<tr>
												<td align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;background:#1ca8dd;color:#fff;'>
													<strong>Account Number:</strong>
												</td>
												<td width='62' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;background:#1ca8dd;color:#fff;'>
													<?=$va_no ?>
												</td>
											</tr>
										</tbody>
										
									</table>
		
			
									<table width='50%' border='0' align='right' cellpadding='0' cellspacing='0'>
										<tbody>
																						<tr>
												<td width='0' align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:15px 0px 3px 0px'>
													<strong>Premi:</strong> 

												</td>
												<td width='100' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:15px 5px 3px 5px'>
													<?php   
													if ($cashless == 'Y' && $hardcopy == 'Y' ) {
													echo rp($amount - 50000 - $cashlessFee ); 
													}else if ($cashless == 'Y') {
													echo rp($amount - $cashlessFee ); 
													}else if($hardcopy =='Y'){
													echo rp($amount - 50000); 
													}else{ 
													echo rp($amount);
													}
													?>
												</td>
											</tr>
											<tr>
												<td align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;border-bottom:solid 1px #999999'>
													<strong>Cashless:</strong>
													<span style='font-size:11px;color:#666666'>(Bila Ada)</span>
												</td>
												<td width='100' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;border-bottom:solid 1px #999999'>													
													<?php   
													if ($cashless == 'Y') {
													echo rp($cashlessFee); 
													}else{ 
													echo rp(0);
													}
													?>
												</td>
											</tr>
											
											<tr>
												<td align='left' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;border-bottom:solid 1px #999999'>
													<strong>Cetak Buku:</strong>
													<span style='font-size:11px;color:#666666'>(Bila Ada)</span>
												</td>
												<td width='100' align='right' valign='top' style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;border-bottom:solid 1px #999999'>
													<?php   
													if ($hardcopy == 'Y') {
													echo rp(50000); 
													}else{ 
													echo rp(0);
													}
													?>
												</td>
											</tr>
											<tr>
												<td align='left' valign='bottom' style='color:#404041;font-size:13px;line-height:16px;padding:5px 0px 3px 0px;background:#1ca8dd;color:#fff;'>
													<strong>Total:</strong>
												</td>
												<td width='100' align='right' valign='bottom' style='color:#339933;font-size:13px;line-height:16px;padding:5px 5px 3px 5px;background:#1ca8dd;color:#fff;'>
													<strong><?=rp($amount)?></strong>
												</td>
											</tr>
										</tbody>
										
										
									</table>
								</td>
							</tr>
									
							
									
							<tr>
								<td>
									<table width='510' border='0' cellspacing='0' cellpadding='0'>
										<tbody>
											<tr>
												<td style='color:#404041;font-size:12px;line-height:16px;padding:5px 15px 10px 10px'>										
													<p>
														Kind regards,<br>
														<strong><a href='<?php echo $this->Html->url('/'); ?>' target='_blank'>Jagadiri</a> team</strong>
													</p>
												</td>
											</tr>
											
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	
</div>
</center>-->	
							
