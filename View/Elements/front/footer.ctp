
	<section>
		<div class="container">
			<div class="footers">
				<div class="col-sm-4">
					<div class="row">
						<div class="center-foot"><!-- tadinya left-foot -->
							<!--init old news-->
							<!--<h3>News</h3>
							<li style="list-style-type:none;padding:0px 50px 10px 50px;">							
							<ul class="downews">
								<?php 
									if(isset($_news)): foreach ($_news as $news): ?> 
									<li>
										<div class="news-list">
											<div class="date-news">
												<?php $day = date("d",strtotime($news['News']['created'])); ?>
												<?php $month = date("m",strtotime($news['News']['created'])); 
														$mon = $_mons[(int)$month];
														$remp = array("<p>","</p>");
												?>
												<h4><?php echo $day ; ?></h4>
												<h5><?php echo $mon; ?></h5>
											</div>
											<div class="title-news">
												<a href="<?php echo str_replace($remp, "", $news['News']['content']) ; ?>" target="_blank"><?php echo $news['News']['title'] ; ?></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</li>
								<?php endforeach; endif;?>
							</ul>
							</li>-->
							<!--end old news -->

							<!--init nav flexy -->
							<h3>Harga Unit Investasi (NAV)<br/>CAF Flexy Link</h3>
							<?php if(isset($_dataFund)):?>
							<div class="table-responsive">
							  <table class="table table-bordered">
								<tr class="head-tab">
								  <td style="color:#6b6b6b;font-size:12px;">Jenis Fund</td>
									<?php $_x=0; $dtresult=$_dataFund; while ($_x==0):?>
									<?php $_z=4; $dtresult2=$_dataFund; while ($_z==4):?>
									<?php 
									  $date=date('F', strtotime($dtresult2[$_z]['FundTypeDate']));
									  $date1=date('F', strtotime($dtresult[$_x]['FundTypeDate']));
									?>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo date('j', strtotime($dtresult2[$_z]['FundTypeDate'])).'-'.substr($date,0,3);?></td>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo date('j', strtotime($dtresult[$_x]['FundTypeDate'])).'-'.substr($date1,0,3);?></td>
									<?php $_z++; endwhile;?>
									<?php $_x++; endwhile;?>
								</tr>
								
								<?php $_i=0; $dtresult=$_dataFund; while ($_i<4): if(isset($dtresult[$_i]['FundTypeDesc'])):?>
								<tr>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo str_replace("Fund", "", $dtresult[$_i]['FundTypeDesc']);?></td>
									<?php $_y=4; $dtresult2=$_dataFund; while ($_y<8):?>
									<?php if(isset($dtresult2[$_y]['FundTypeID'])):?>
									<?php if($dtresult[$_i]['FundTypeID'] == $dtresult2[$_y]['FundTypeID']):?>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo number_format($dtresult2[$_y]['FundTypePrice'],2,',','.');?></td>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo number_format($dtresult[$_i]['FundTypePrice'],2,',','.');?></td>
									<?php endif; endif; $_y++; endwhile;?>
								</tr>
								<?php endif; $_i++; endwhile;?>
							  </table>
							</div>
							<?php endif; ?>

							<!--end nav flexy -->


							<!-- 
							<h3>Download</h3>
							<select onChange="window.location.href=this.value">
								<option value="<?php echo $this->Html->url("/download/CAF_Pengumuman_PAJ_UL_Tahun_2014_Website.pdf"); ?>">Laporan Keuangan Triwulan</option>
								<option value="<?php echo $this->Html->url("/download/CAF_Pengumuman_PAJ_UL_Tahun_2014_Website.pdf"); ?>">Laporan Keuangan Tahunan</option>
								<option value="<?php echo $this->Html->url("/download/Merchant_List_09.xls"); ?>">Daftar Program Diskon</option>
								<option value="<?php echo $this->Html->url("/download/LIST_PROVIDER_UP_DATE_OKTOBER_2015.pdf"); ?>">Daftar RS Rekanan</option>
								<option value="<?php echo $this->Html->url("/download/FORM_KLAIM_MENINGGAL.pdf"); ?>">Form Klaim Meninggal</option>
								<option value="<?php echo $this->Html->url("/download/FORM_KLAIM_RUMAH_SAKIT.pdf"); ?>">Form Klaim Rumah Sakit</option>
							</select>
							
							<h3>Jagadiri App</h3>
							<a href="https://goo.gl/ZWmP58" target="_blank" onClick="ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - home'});"><img src="<?php echo $this->Html->url("/"); ?>img/google.png" class="img-responsive" /></a>
							-->
						</div>
					</div>
				</div>
				<!--init hide caf flexy center -->
				<!--<div class="col-sm-4">
					<div class="row">
						<div class="center-foot">
							<h3>Harga Unit Investasi (NAV)<br/>CAF Flexy Link</h3>
							<?php if(isset($_dataFund)):?>
							<div class="table-responsive">
							  <table class="table table-bordered">
								<tr class="head-tab">
								  <td style="color:#6b6b6b;font-size:12px;">Jenis Fund</td>
									<?php $_x=0; $dtresult=$_dataFund; while ($_x==0):?>
									<?php $_z=4; $dtresult2=$_dataFund; while ($_z==4):?>
									<?php 
									  $date=date('F', strtotime($dtresult2[$_z]['FundTypeDate']));
									  $date1=date('F', strtotime($dtresult[$_x]['FundTypeDate']));
									?>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo date('j', strtotime($dtresult2[$_z]['FundTypeDate'])).'-'.substr($date,0,3);?></td>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo date('j', strtotime($dtresult[$_x]['FundTypeDate'])).'-'.substr($date1,0,3);?></td>
									<?php $_z++; endwhile;?>
									<?php $_x++; endwhile;?>
								</tr>
								
								<?php $_i=0; $dtresult=$_dataFund; while ($_i<4): if(isset($dtresult[$_i]['FundTypeDesc'])):?>
								<tr>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo str_replace("Fund", "", $dtresult[$_i]['FundTypeDesc']);?></td>
									<?php $_y=4; $dtresult2=$_dataFund; while ($_y<8):?>
									<?php if(isset($dtresult2[$_y]['FundTypeID'])):?>
									<?php if($dtresult[$_i]['FundTypeID'] == $dtresult2[$_y]['FundTypeID']):?>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo number_format($dtresult2[$_y]['FundTypePrice'],2,',','.');?></td>
								  <td style="color:#6b6b6b;font-size:12px;"><?php echo number_format($dtresult[$_i]['FundTypePrice'],2,',','.');?></td>
									<?php endif; endif; $_y++; endwhile;?>
								</tr>
								<?php endif; $_i++; endwhile;?>
							  </table>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>-->
				<!--end hide caf flexy center -->
				<div class="col-sm-8"><!-- ori : col-sm-4 -->
					<div class="row">
						<div class="right-foot">
							<p>
							PT. Central Asia Financial<br />
							(JAGADIRI) Office:<br />
							Menara Citicon 8th Floor Unit C<br />
							Jl. Letjend S. Parman Kav. 72, Slipi<br />
							Jakarta 11410 - Indonesia<br />
							Telp : +62 21 29 621 622<br />
							Fax : +62 21 29 621 623<br />
							Call Center : 1500 660
							</p>
							
							<h4>LAYANAN KONSUMEN</h4>
							Senin-Jumat : 08:00 - 17:00<br/>
							Sabtu/Minggu & Libur Nasional : Libur<br/>
							

							<!--<h4>LAYANAN KONSUMEN</h4>
							Senin-Kamis : 08:00 - 16:30<br/>
							Jumat : 08:00 - 16:00<br/>
							Sabtu/Minggu : Libur-->
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</section>

<section style="background:#6b6b6b;">
<div class="container" style="min-height:80px;">
				
				<div class="row" style="  font-weight: bold; margin:20px">
						<div class="col-xs-1 col-sm-1">&nbsp;</div>			
						<div class="col-xs-11 col-sm-2"><a style="color:white;" href="<?php echo $this->Html->url("/privacy-policy.htm"); ?>">Kebijakan Privasi</a></div>
						<div class="col-xs-12 col-sm-2"><a style="color:white;" href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>">Asuransi Kesehatan</a></div>
			                    	<div class="col-xs-12 col-sm-2"><a style="color:white;" href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>">Asuransi Kecelakaan</a></div>
						<div class="col-xs-12 col-sm-2"><a style="color:white;" href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>">Asuransi Jiwa</a></li></div>
						<div class="col-xs-12 col-sm-3"><a style="color:white;" href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>">Asuransi Plus Investasi</a></div>
                     			
				</div>

</div>
<section>
<section class="main-midfooter">
		<center><div class="container">
			
			<div class="middle-footer" >
				

				<div class="row">
					<div class="social-m">
							<p>Kunjungi kami:</p><br>
						<ul style="align:center">
							<li class="col-xs-1 col-sm-3"></li>
							<li class="col-xs-2 col-sm-1"><a href="https://www.facebook.com/jagadiri.id"><img src="<?php echo $this->Html->url("/"); ?>img/sosmed/fb2.png" alt="Facebook" class="img-responsive" width="50%"/></a></li>
							<li class="col-xs-2 col-sm-1"><a href="https://twitter.com/jagadiri_id"><img src="<?php echo $this->Html->url("/"); ?>img/sosmed/twitter2.png" alt="Twitter" class="img-responsive"/></a></li>
							<li class="col-xs-2 col-sm-1"><a href="https://plus.google.com/+JagadiriId"><img src="<?php echo $this->Html->url("/"); ?>img/sosmed/google2.png" alt="Google" class="img-responsive"/></a></li>
							<li class="col-xs-2 col-sm-1"><a href="https://www.youtube.com/channel/UCQowOi2neuZgNH4sBaznajg"><img src="<?php echo $this->Html->url("/"); ?>img/sosmed/youtube2.png" alt="Youtube" class="img-responsive"/></a></li>
							<li class="col-xs-2 col-sm-1"><a href="https://www.linkedin.com/company/jagadiri"><img src="<?php echo $this->Html->url("/"); ?>img/sosmed/linkedin2.png" alt="Linkedin" class="img-responsive"/></a></li>
							<li class="col-xs-2 col-sm-1"><a href="https://www.instagram.com/jagadiri_id/"><img src="<?php echo $this->Html->url("/"); ?>img/sosmed/instagram.png" alt="Instagram" class="img-responsive"/></a></li>

						</ul>
					</div>
					
				</div>
				

				<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-xs-4 col-sm-2"><center><a href="https://goo.gl/ZWmP58" target="_blank" onClick="ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - home'});"><img src="<?php echo $this->Html->url("/"); ?>img/google.png" alt="Google" class="img-responsive" style="margin-top:30px;"/></a></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/ojk.png" class="img-responsive" style="margin-top:20px;" alt="OJK" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/aaji.png" class="img-responsive" style="margin-top:20px;" alt="AAJI" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/global.png" class="img-responsive" style="margin-top:25px;" alt="GlobalSign" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/master.png" class="img-responsive" style="margin-top:35px;" alt="Visa Master Card" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/klikpay.png" class="img-responsive" style="margin-top:40px;" alt="BCA Klikpay" /></center></div>
					</div>
				</div>
				</div>
			</div>
		</div></center>
	</section>
	

<!--<section id="all-page-footer">
        <div class="container">
            <div class="row margintop">
                <div class="col-xs-12 col-sm-4 col-md-2 menubottom">
                    <p class="menu">
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi'))?>"> Asuransi <br /><span class="bold">A to Z</span></a>
					</p>
					<ul class="submenu">
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi','#'=>'apa'))?>">Apa itu asuransi?</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi','#'=>'kenapa'))?>">Kenapa berasuransi?  </a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi','#'=>'kenapa'))?>">Kapan berasuransi? </a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi','#'=>'kamus'))?>">Kamus Asuransi</a></li>
					</ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-1 menubottom">
                    <p class="menu">
                        <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>" >Temukan <br /><span class="bold">Solusi</span> </a>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-1 menubottom">
                    <p class="menu">
                        <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>">Pilihan <br /><span class="bold">Produk</span></a>
                    </p>
                    <ul class="submenu">
                    	<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>">Accidental</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>">Life</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>">Health</a></li>
						<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>">Unit Link</a></li>
                     </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-1 menubottom">
                    <p class="menu">
                        <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'tentangjagadiri'))?>">Kisah <br /><span class="bold">JAGADIRI</span></a>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 menubottom">
                    <p class="menu">
                        <span class="bold"><br/>Download</span>
                    </p>
                    <ul class="submenu">
                        <li><a href="<?php echo $this->Html->url("/download/Laporan_Keuangan_Triwulan_III_Tahun_2015.jpg"); ?>">Laporan Keuangan Triwulan</a></li>
                        <li><a href="<?php echo $this->Html->url("/download/CAF_Pengumuman_PAJ_UL_Tahun_2014_Website.pdf"); ?>">Laporan Keuangan Tahunan</a></li>
                        <li><a href="<?php echo $this->Html->url("/download/Merchant_List_12.pdf"); ?>">Daftar Program Diskon</a></li>
                        <li><a href="<?php echo $this->Html->url("/download/LIST_RS_UP_DATE_DESEMBER_2015.pdf"); ?>">Daftar RS Rekanan</a></li>
                        <li><a href="<?php echo $this->Html->url("/download/FORM_KLAIM_MENINGGAL.pdf"); ?>">Form Klaim Meninggal</a></li>
                        <li><a href="<?php echo $this->Html->url("/download/FORM_KLAIM_RUMAH_SAKIT.pdf"); ?>">Form Klaim Rumah Sakit</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-1 menubottom">
                    <p class="menu">
                        <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'privacy'))?>">Kebijakan <br /><span class="bold">Privasi</span></a>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 menubottom">
                    <p class="menu">
                        Harga Unit Investasi (NAV) <br/><span class="bold">CAF Flexy Link</span>
                    </p>
                    <?php if(isset($_dataFund)):?>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <td style="color:#6b6b6b;font-size:12px;">Jenis Fund</td>
                            <?php $_x=0; $dtresult=$_dataFund; while ($_x==0):?>
                            <?php $_z=4; $dtresult2=$_dataFund; while ($_z==4):?>
                            <?php 
                              $date=date('F', strtotime($dtresult2[$_z]['FundTypeDate']));
                              $date1=date('F', strtotime($dtresult[$_x]['FundTypeDate']));
                            ?>
                          <td style="color:#6b6b6b;font-size:12px;"><?php echo date('j', strtotime($dtresult2[$_z]['FundTypeDate'])).'-'.substr($date,0,3);?></td>
                          <td style="color:#6b6b6b;font-size:12px;"><?php echo date('j', strtotime($dtresult[$_x]['FundTypeDate'])).'-'.substr($date1,0,3);?></td>
                            <?php $_z++; endwhile;?>
                            <?php $_x++; endwhile;?>
                        </tr>
                        
                        <?php $_i=0; $dtresult=$_dataFund; while ($_i<4): if(isset($dtresult[$_i]['FundTypeDesc'])):?>
                        <tr>
                          <td style="color:#6b6b6b;font-size:12px;"><?php echo str_replace("Fund", "", $dtresult[$_i]['FundTypeDesc']);?></td>
                            <?php $_y=4; $dtresult2=$_dataFund; while ($_y<8):?>
                            <?php if(isset($dtresult2[$_y]['FundTypeID'])):?>
                            <?php if($dtresult[$_i]['FundTypeID'] == $dtresult2[$_y]['FundTypeID']):?>
                          <td style="color:#6b6b6b;font-size:12px;"><?php echo number_format($dtresult2[$_y]['FundTypePrice'],2,',','.');?></td>
                          <td style="color:#6b6b6b;font-size:12px;"><?php echo number_format($dtresult[$_i]['FundTypePrice'],2,',','.');?></td>
                            <?php endif; endif; $_y++; endwhile;?>
                        </tr>
                        <?php endif; $_i++; endwhile;?>
                      </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
			<div class="row">-->
				<!--<div class="col-md-4">
					<p class="ojk">
					JAGADIRI merupakan merek dagang PT Central Asia Financial. PT Central Asia Financial adalah lembaga yang terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK).
					</p>
				</div>
				<div class="col-md-12">
					<!--<div class="row">
						<div class="col-xs-4 col-sm-offset-1 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/ojk.png" class="img-responsive" style="margin-top:20px;"/></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/aaji.png" class="img-responsive" style="margin-top:20px;" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/global.png" class="img-responsive" style="margin-top:15px;" /></center></div>
						<div class="col-xs-6 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/master.png" class="img-responsive" style="margin-top:25px;" /></center></div>
						<div class="col-xs-6 col-sm-3"><center><img src="<?php echo $this->Html->url("/"); ?>img/klikpay.png" class="img-responsive" style="margin-top:25px;" /></center></div>
					</div>-->
          <!--<div class="row">
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/ojk.png" class="img-responsive" style="margin-top:20px;"/></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/aaji.png" class="img-responsive" style="margin-top:20px;" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/global.png" class="img-responsive" style="margin-top:25px;" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/master.png" class="img-responsive" style="margin-top:35px;" /></center></div>
						<div class="col-xs-4 col-sm-2"><center><img src="<?php echo $this->Html->url("/"); ?>img/klikpay.png" class="img-responsive" style="margin-top:40px;" /></center></div>
						<div class="col-xs-4 col-sm-2"><!--<p class="menu" style="margin-top:15px;">Get JAGADIRI apps</p>--><!--<center><a href="https://goo.gl/ZWmP58" target="_blank" onClick="ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - home'});"><img src="<?php echo $this->Html->url("/"); ?>img/google.png" class="img-responsive" style="margin-top:40px;" /></a></center></div>
					</div>
				</div>
			</div>
        </div>
    </section>-->
    <footer style="background:white">
        <div class="container" >
            <div class="row">
                <div class="col-md-12">
                    <h5 class="copy">
                    Copyright 2014 PT. Central Asia Financial. All Rights Reserved.
                    </h5>
                    <p class="text-center" style="font-size:12px;margin-top:10px;">JAGADIRI merupakan merek dagang PT Central Asia Financial. PT Central Asia Financial adalah lembaga yang terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK).</p>
                </div>
            </div>
        </div>
    </footer> 
	


	
	<div class="modal fade" id="modalaw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Hubungi Saya</h4>
					
				</div>
				<?php echo $this->Form->create('Leavenumber',array('id'=>'Contactme','class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>false));
				$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
				<div class="modal-body">
					<!-- isi modal -->
					<p>Silahkan isi data dibawah ini dan agen kami akan segera menghubungi anda</p>
					<div class="form-group">

						<div class="col-md-3"><label class="control-label " >Nama </label></div>
						<div class="col-md-1"><label class="control-label " >: </label></div>
						<div class="col-md-6">
							<?php echo $this->Form->input('Contact_Name', array('id'=>'nama','class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3"><label class="control-label " >Email </label></div>
						<div class="col-md-1"><label class="control-label " >: </label></div>
						<div class="col-md-6">
							<?php echo $this->Form->input('Contact_Email', array('id'=>'email','class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3"><label class="control-label " >No.Telepon </label></div>
						<div class="col-md-1"><label class="control-label " >: </label></div>
						<div class="col-md-6">
							<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control')); ?>
						</div>
						
					</div>
					<!-- hidden data -->
					<?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Source', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Daytime', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Remark1', array( 'value'=>'Hubungi Saya Sidebar', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Kirim" onclick="ContactMe(); return test();" ></input>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="fly-right-btn">
	<a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - home'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><div class="fly-btn live-fly"><img src="<?php echo $this->Html->url("/"); ?>img/chat-icon.png" alt="Live Chat" /> Live Chat</div></a>
	<!--<a href="<?php echo $this->Html->url("/hubungi-kami.htm"); ?>"><div class="fly-btn mail-fly"><img src="<?php echo $this->Html->url("/"); ?>img/envelope.png" alt="Email" /> Email</div></a>-->
	<!--<a href="tel:1500660"><div class="fly-btn phone-fly"><img src="<?php echo $this->Html->url("/"); ?>img/phone.png" alt="Telepon" /> 1500 660</div></a>-->
	<!--<a href="" onClick="ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: 'contact - jsp'});" data-toggle="modal" data-target="#modalaw" id="contactme-btn"><div class="fly-btn hub-fly"><img src="<?php echo $this->Html->url("/"); ?>img/hub.png" alt="Hubungi" /> Hubungi Saya</div></a>-->
	<a href="<?php echo $this->Html->url("/hubungi-kami.htm"); ?>" onClick="ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: 'contact - jsp'});"  id="contactme-btn"><div class="fly-btn hub-fly"><img src="<?php echo $this->Html->url("/"); ?>img/hub.png" alt="Hubungi" /> Hubungi Saya</div></a>
</div>

	 
	<script>
    $(function(){
   $('.dropdown').hover(function() {
       $(this).addClass('open');
   }, function() {
       $(this).removeClass('open');
   });
    });
    </script> 
	
<script>
//Validate Form Hubungi Saya
    var gaCodeProd = '';
    // validate the form when it is submitted
    var valContact = $("#Contactme").validate({
    	errorElement: "span",
    	errorPlacement: function(error, element) {
    		error.insertBefore(element);
    	}
    });
    $("#nama").rules("add", {
    	required:true,
    	messages: {
    		required: "Please Enter Your Name."
    	}
    });
    $("#email").rules("add", {
    	required:true,
    	email: true,
    	messages: {
    		required: "Please Enter Your Email.",
    		email: "Please Enter Your Valid Email."
    	}
    });
    $("#phone").rules("add", {
    	required:true,
    	number:true, 
    	messages: {
    		required: "Please Enter Your Phone Number",
    		number: "Please Enter Your Valid Phone Number"
    	}
    });
    
    function ContactMe(){
    	if(valContact.form()) {
    		if(gaCodeProd != 'jsp') {
          submitProd='contact - '+gaCodeProd;  
        ga('send', 'event', { eventCategory: 'potential lead-fs', eventAction: 'click', eventLabel: submitProd});
	ga('send', 'event', { eventCategory: 'Widget - Popup', eventAction: 'click', eventLabel: 'Kirim button'});//new

        //alert(submitProd);
        }
      }
    }
    
    function setgaSend(id){
      gaCodeProd=id;
    }
    
    function FillRemark1(Isi){
    	var r = document.getElementById("ContactmeContactRemark1"); 
    	r.setAttribute("value", Isi);
    }
</script>