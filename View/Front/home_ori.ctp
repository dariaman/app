<!--<ul id="chat" class="hidden-xs">
	<li>
		<a class="page-scroll" href="#page-top"><div class="dot"></div></a>
	</li>
	<li>
		<a class="page-scroll" href="#about"><div class="dot"></div></a>
	</li>
	<li>
		<a class="page-scroll" href="#services"><div class="dot"></div></a>
	</li>
	<li>
		<a class="page-scroll" href="#contact"><div class="dot"></div></a>
	</li>
	<li>
		<a class="page-scroll" href="#footer"><div class="dot"></div></a>
	</li>		
	<li>
		<a class="page-scroll" href="#about"><div class="down"></div></a>
	</li>
</ul>-->

<section id="intro" class="intro-section">
	<div class="container">
		<div class="carousel slide" id="carousel-194094">

			<div class="carousel-inner">
				
			<!-- 	<div class="item active">

					<img alt="" src="img/mainvisual.jpg" class="img-responsive" />

					<div class="carousel-caption-top">

						<h1 class="topmain">

							At the end of the day, the goals are simple: <br />

							<span class="toppeach">safety and security.</span>

						</h1>

						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-sehat-plus'));  ?>"><button class="btn-caf-quote"><span class="glyphicon glyphicon-share-alt"></span> Get a <span class="bold">Quote</span></button></a>

					</div>

				</div> -->
				
				<?php $a = 0; ?>
				<?php $i=1; foreach ($promo as $pr ): ?>
				<?php $a = $a + 1; ?>
				<div class="item <?php if($i==1) echo "active"; ?>">
					<?php if(isset($pr['Promo']['img_promo_detail']) AND ''!=$pr['Promo']['img_promo_detail']): ?>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'detail_promo','seo'=>$pr['Promo']['seo'])) ?>" target="_blank">
						<img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage'])?>" class="img-responsive">
						</a>
					<?php else: ?>
						<img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage'])?>" class="img-responsive">
					<?php endif; ?>
				</div>
				<?php $i=0; endforeach; ?>
		  
				<?php foreach($banners as $ban): ?>
				<?php $a = $a + 1; ?>
				<div class="item">
					<?php if($ban['Banner']['link']==''): ?>
					<img alt="<?php echo $ban['Banner']['alt'] ?>" src="<?php echo $this->Html->url('/img/banner/'.$ban['Banner']['picture']); ?>" class="img-responsive" />
					<?php else: ?>
					<a href="<?php echo $ban['Banner']['link'] ?>" target="<?php if($ban['Banner']['target_link']!=0) echo "_blank"; else echo '';?>" onClick="gaBannerCode(<?php echo $ban['Banner']['id']?>);"><img alt="Promo Jagadiri" src="<?php echo $this->Html->url('/img/banner/'.$ban['Banner']['picture']); ?>" class="img-responsive" /></a>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
				
			<!-- hide survey <div class="item">
				<a href="javascript:show_popup();">
					<img src="<?php echo $this->Html->url('/')?>img/banner_survey-billboard_1024.png" class="img-responsive">
				</a>
			</div>	-->
				

			</div> 

			<a data-slide="prev" href="#carousel-194094" class="left carousel-control"><img src="<?php echo $this->Html->url("/"); ?>img/left-arrow.png" /></a>
			<a data-slide="next" href="#carousel-194094" class="right carousel-control"><img src="<?php echo $this->Html->url("/"); ?>img/right-arrow.png" /></a> 
              
			  <ol class="home-i carousel-indicators p-indicator">
				<?php for ($x = 0; $x < $a; $x++) { $z = $x + 1;?>
					<?php if(1 == $x) { ?>
						<li data-target="#carousel-194094" data-slide-to="<?php echo $x; ?>" class="active"><?php echo $z; ?></li>
					<?php } else { ?>
						<li data-target="#carousel-194094" data-slide-to="<?php echo $x; ?>"><?php echo $z; ?></li>
					<?php } ?>
				<?php } ?>
              </ol>

		</div>
	</div>
	<!--
	<div class="container">

		<div class="row">

			<div class="col-lg-12">

				<nav class="navbar navsecond" role="navigation">

					

						<!-- Brand and toggle get grouped for better mobile display -->

						<!--<div class="navbar-header navbar-header-second">

							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

								<span class="sr-only">Toggle navigation</span>

								<span class="icon-bar"></span>

								<span class="icon-bar"></span>

								<span class="icon-bar"></span>

							</button>

							<a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">I Want To</a>

						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->

						<!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

							<ul class="nav navbar-nav iwanto">

								<li class="first">

									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>"><span class="icon"><img src="<?php echo $this->Html->url("/"); ?>img/solution-icon.png" /></span> Find <span class="bold">Solution</span></a>

								</li>

								

								<li class="third">

									<a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'claim')); ?>"><span class="icon"><img src="<?php echo $this->Html->url("/"); ?>img/claim-icon.png" /></span> Check a <span class="bold">Claim</span></a>

								</li>

								<!--<li class="fourth">

									<a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - home'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><span class="icon"><img src="<?php echo $this->Html->url("/"); ?>img/chat-icon.png" /></span> Chat with <span class="bold">Us</span></a>

								</li>-->

							<!--</ul>

						</div>

						<!-- /.navbar-collapse -->

				

				<!--</nav>

			</div>

		</div>

	</div>-->

</section>


<!-- About Section -->
<section id="about" class="about-section">
	<div class="container">
		<h2 class="title text-center">
			Produk terbaik dari <span class="peach">JAGADIRI</span>
		</h2>
  <!-- SEMI HARDCODE -->
  <?php 
    /* $prodHome=array(1=>array('picture'=>'product1.png','seo'=>'jaga-sehat-plus','active'=>0,'cat_quote'=>0),2=>array('picture'=>'product-jai.png','seo'=>'jaga-aman-instan','active'=>0,'cat_quote'=>0),3=>array('picture'=>'product3.png','seo'=>'jaga-jiwa','active'=>0,'cat_quote'=>0),4=>array('picture'=>'product4.png','seo'=>'caf-flexy-link','active'=>1,'cat_quote'=>1)); */
    $prodHome=array(1=>array('picture'=>'product1.png','seo'=>'jaga-sehat-plus','active'=>0,'cat_quote'=>0),2=>array('picture'=>'product-jai.png','seo'=>'jaga-aman-instan','active'=>0,'cat_quote'=>0),3=>array('picture'=>'product6.png','seo'=>'jaga-jiwa-plus','active'=>0,'cat_quote'=>0),4=>array('picture'=>'product7.png','seo'=>'jaga-aman-plus','active'=>0,'cat_quote'=>1));
  ?>
	<div class="list-prod box-grey margintop2">
			<div class="row">
        <?php 
          $j=1;
          while($j<=4){
        ?>
				<div class="col-sm-6 col-md-3 col-lg-3 marginbottom">
					<!-- icon Best Seller -->
          <?php if($prodHome[$j]['seo']=='jaga-sehat-plus' || $prodHome[$j]['seo']=='jaga-aman-instan'):?>
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
          </div>
          <?php else: ?>
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
          </div>
          <?php endif;?>
          <div class="carousel-inner">
						<div class="item active">
							<a href="<?php if($prodHome[$j]['active']==0) echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$prodHome[$j]['seo'])); else echo '#';?>">	
								<img alt="Produk Jaga Sehat" src="<?php echo $this->Html->url("/");?>img/<?php echo $prodHome[$j]['picture']?>" />
							</a>
							<div class="carousel-caption-product">
								<h4 class="title-cap-home">
									<?php if($prodHome[$j]['seo']=='jaga-sehat-plus'):?>
                  Jaga Sehat<br />Plus
                  <?php elseif($prodHome[$j]['seo']=='jaga-aman-instan'):?>
                  Jaga Aman<br/>Instan
                  <?php elseif($prodHome[$j]['seo']=='jaga-jiwa-plus'):?>
                  Jaga Jiwa<br/>Plus
                  <?php else:?>
                  Jaga Aman<br/>Plus
                  <?php endif;?>
								</h4>
								
							</div>
						</div>
					</div>
					<p class="review-product content-box">
            <?php if($prodHome[$j]['seo']=='jaga-sehat-plus'):?>
            Perlindungan kesehatan yang memberi jaminan uang kembali, tanpa ribet! &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php elseif($prodHome[$j]['seo']=='jaga-aman-instan'):?>
            Langsung Aktif! Asuransi Kecelakaan Super Fleksibel &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php elseif($prodHome[$j]['seo']=='jaga-jiwa-plus'):?>
            Perlindungan jiwa semudah pinjam karena premi dikembalikan 110% jika tidak ada klaim!
            <?php else:?>
            Perlindungan kecelakaan plus pengembalian premi maksimum 110% jika tidak ada klaim!
            <?php endif;?>
						
					</p> <p>&nbsp;</p> 
					<center>
          <div class="row">
            <div class="col-xs-6">
            <a href="<?php if($prodHome[$j]['active']==0): 
            if($prodHome[$j]['cat_quote']==0){
              $act='step1_non_unitlink';
            }else{
              $act='step1_unitlink';
            } 
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$prodHome[$j]['seo'])); else: echo '#'; endif;?>" class="btn btn-default2" onClick="ga('send', 'event', { eventCategory: 'customer lead-home', eventAction: 'click', eventLabel: 'beli - jsp'});"><?php if($prodHome[$j]['active']==0) echo 'Beli Sekarang'; else echo 'Segera Hadir';?></a>
            </div><div class="col-xs-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$prodHome[$j]['seo']))?>" type="button" class="btn btn-default4">Lihat Detail</a>
            </div>
          </div></center>
				</div>
          <?php $j++; }  //endwhile?>
				</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="hub-say">
			<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
			<h5>Saya Mau</h5>
			<?php 
				echo $this->Form->create('Leavenumber',array('id'=>'Lnumber','class'=>' form-inline','role'=>'form','type' => 'post','novalidate'=>true)); 
				$this->Form->inputDefaults(array('label' => false));
				?>
				<div class="form-group col-sm-3">
					<select name="data[Leavenumber][Contact_Tipe]">
						<option value="Leads Homepage" selected>Melakukan Pembelian</option>
						<option value="info">Mencari Informasi Produk</option>
					</select>
				</div>
				<div class="form-group col-sm-3">
					<?php echo $this->Form->input('Contact_Name', array('id'=>'name', 'placeholder' => 'Nama', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
				</div>
				<div class="form-group col-sm-3">
					<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'placeholder' => 'Nomor Telepon', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
				</div>
				<div class="form-group col-sm-3">
					<button type="submit" class="btn-caf-blue" id="leave-numb-btn" onclick="Leave_Number();">Hubungi Saya</button>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="t-solusi">
			<div class="triangle-left">
				<img src="<?php echo $this->Html->url("/");?>img/triangle-left.png" />
			</div>
			<div class="main-t-solusi">
				<div class="desc-t">
					<h4>Kenali kebutuhan Anda</h4>
					<p>Kami akan membantu Anda untuk menentukan pilihan produk yang sesuai untuk kebutuhan Anda.</p>
				</div>
				<div class="laj">
					<img src="<?php echo $this->Html->url("/");?>img/laj.jpg" />
				</div>
				<div class="link-t">
					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>">Temukan<br />Solusi</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="services">
			<h2 class="title text-center">Mengapa <span class="peach">JAGADIRI</span> <span class="bold">berbeda</span> ?</h2>
			<div class="col-sm-6">
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why1-new.png" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Pembelian mudah & langsung</h5>
						<p class="content-new">Daftar asuransi tidak pernah semudah ini. Klik, bayar, langsung terlindungi!</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why2-new.png" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Klaim yang jelas dan transparan</h5>
						<p class="content-new">Mau klaim kok repot? Hanya di Jagadiri proses klaim tanpa ribet</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why3-new.png" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Jaminan harga terbaik!</h5>
						<p class="content-new">Bukan zamannya main rahasia-rahasiaan. Semua biaya dikupas tuntas</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="vide col-sm-6">
				<iframe src="//www.youtube.com/embed/exQ_n2vGDDA" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>

	<!-- Services Section -->
	<!--<section id="services" class="services-section">
		<div class="triangel1">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="title text-center wow fadeInDown" data-wow-duration="2500ms">
							Mengapa <span class="peach">JAGADIRI</span> <span class="bold">berbeda</span> ?
						</h2>

					</div>
				</div>	
			</div>
		</div>
		
			<div class="container">
			<div class="why-new">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-offset-1 col-md-3">
									<center><img src="<?php echo $this->Html->url("/");?>img/why1-new.png" /></center>
									<h5 class="title text-center">
									Pembelian mudah & langsung
									</h5>
									<p class="content-new text-center">
									Daftar asuransi tidak pernah semudah ini. Klik, bayar, langsung terlindungi!
									</p>
							</div>
							<div class="col-md-3">
								<div class="box-new-why">
									<center><img src="<?php echo $this->Html->url("/");?>img/why2-new.png" /></center>
									<h5 class="title text-center">
									Klaim yang jelas dan transparan
									</h5>
									<p class="content-new text-center">
									Mau klaim kok repot? Hanya di Jagadiri proses klaim tanpa ribet
									</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-offset-1 col-md-3">
								<div class="box-new-why2">
									<center><img src="<?php echo $this->Html->url("/");?>img/why3-new.png" /></center>
									<h5 class="title text-center">
									Jaminan harga terbaik!
									</h5>
									<p class="content-new text-center">
									Bukan zamannya main rahasia-rahasiaan. Semua biaya dikupas tuntas
									</p>
								</div>
							</div>
						</div>
						 
				</div>
			</div>
		</div>
	</div>
		 
	</section>-->

	<!-- Contact Section -->
	<!--<section id="contact" class="contact-section">
		<div class="triangel2">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="title text-center wow fadeInDown" data-wow-duration="2500ms">
							<span class="peach">JAGADIRI</span> Anda Sekarang !
						</h2>
						<h4 class="title text-center wow fadeInDown" data-wow-duration="2500ms" data-wow-delay="1s">
							Akses mudah dalam tiga langkah
						</h4>
					</div>
				</div>	
			</div>
		</div>
		<div class="container margintop">
			<div class="row">
				<div class="col-sm-6 col-md-3 col-lg-3">
					<center><img src="<?php echo $this->Html->url("/");?>img/step1.png" alt="step insurance" /></center>
					<h5 class="title">
						Langkah 1: <br /> <span class="desc">PILIH PRODUK</span>
					</h5>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<center><img src="<?php echo $this->Html->url("/");?>img/step2.png" alt="step insurance" /></center>
					<h5 class="title">
						Langkah 2: <br /> <span class="desc">ISI DATA</span>
					</h5>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<center><img src="<?php echo $this->Html->url("/");?>img/step3.png" alt="step insurance" /></center>
					<h5 class="title">
						Langkah 3: <br /> <span class="desc">BAYAR</span>
					</h5>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<center><img src="<?php echo $this->Html->url("/");?>img/step4.png" alt="step insurance" /></center>
					<h5 class="title">
						Polis JAGADIRI Aktif<br />
					</h5>
				</div>
			</div>
			<div class="row margintop">
				<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
				<div class="col-md-5">
					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>" id="apply-btn"><button class="btn-caf"><span class="icon2"><img src="<?php echo $this->Html->url("/");?>img/apply-icon.png" /></span> Pilih <span class="bold">Produk</span></button></a>
				</div>
				<div class="col-md-2">
					<h3 class="title-or text-center">Atau</h3>
				</div>
				<?php 
				echo $this->Form->create('Leavenumber',array('id'=>'Lnumber','class'=>' span6','role'=>'form','type' => 'post','novalidate'=>true)); 
				$this->Form->inputDefaults(array('label' => false));
				?>
				<div class="col-md-5 lnumber">

					<div class="row">
						<div class="col-sm-8">
							<div class="error1"></div>
							<?php echo $this->Form->input('Contact_Name', array('id'=>'name', 'placeholder' => 'Name', 'class'=>'form-control-caf span6', 'div'=>false, 'type'=>'text')); ?>
							<span>	
								<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'placeholder' => 'Phone', 'class'=>'form-control-caf span6', 'div'=>false, 'type'=>'text')); ?>
							</span>
						</div>
						<div class="col-sm-4">
							<button type="submit" class="btn-caf-blue" id="leave-numb-btn" onclick="Leave_Number();">Hubungi Saya</button>
						</div>
					</div>
				</div></form>
			</div>
		</div>
	</section>
	<br>-->
	<!-- Contact Section -->
	<!--<section id="footer" class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<h3 class="title-footer">
						Berita dan Event
					</h3>

					<?php foreach($news as $ns): ?>
						<div class="news">
							<h2 class="title-news">
								<?php echo $ns['News']['title']; ?> | <?php echo $this->Time->format('d/m/Y', $ns['News']['created']); ?>
							</h2>
							<p class="news-desc">
								<?php echo $ns['News']['content']; ?>
							</p>
						</div>
					<?php endforeach; ?>

				</div>
				<div class="col-sm-4">
					<h3 class="title-footer">
						Video
					</h3>
					<iframe src="//www.youtube.com/embed/exQ_n2vGDDA" frameborder="0" allowfullscreen></iframe><br /><br />
				 
				</div>
				<div class="col-sm-3">
					<h3 class="title-footer">
						<span>Hubungi Kami</span>
					</h3>
					<p class="hub">
						Belum menemukan solusi untuk kebutuhan proteksi Anda? Hubungi kami sekarang juga. 
					</p><br />
					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'hubungikami'))?>">
						<button type="button" class="btn4 btn-default2" type="submit"><span class="icon-hub"><img src="<?php echo $this->Html->url("/");?>img/chat-icon.png" /></span> Ask Us</button>
					</a><br/><br/>
          <p class="address text-address">
            <span class="bold">
            PT. Central Asia Financial<br />
            (JAGADIRI) Office:<br />
            Citicon Tower 8th Floor Unit C<br />
            Jl. Letjend S. Parman Kav. 72, Slipi<br />
            Jakarta 11410 - Indonesia<br />
            Telp : +62 21 29 621 622<br />
            Fax : +62 21 29 621 623<br/>
            Call Center : 1500-660
            </span>
          </p><br/>
          <p class="address text-address">
            <span class="bold peach">LAYANAN KONSUMEN</span><br/>
            Senin-Jumat : 08:00 - 17:00<br/>
            Sabtu-Minggu : Libur
          </p>
				</div>
			</div>
		</div>
	</section>-->
	<script type="">
		var getBannerCode='';
    
		jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Please Change +62 to 0 ");
	
		jQuery.validator.addMethod("validlength", function(value, element) {
			if(value.length >0 && value.length <8) return false;
			return true;
		}, "Please Enter Minimum 8 Digit Numbers. ");

		jQuery.validator.addMethod("validNotelp", function(value, element) {
			validno=[<?php foreach($allphone as $ph) {echo '"'.'0'.$ph['Val']['phone'].'",';} ?>];

			filme = value.substring(0, 3);
			if (filme == '021' || filme =='022' || filme =='024' || filme =='031' || filme == '061'){
				filmo = value.substring(0, 3);
			}
			else
			{
				filmo = value.substring(0, 4);
			}
			var a = validno.indexOf(filmo);

			if(a == -1 ) return false;
			return true;
		}, "Please Enter Valid Numbers. ");

		
    // validate the form when it is submitted
    var valLeaveNumb = $("#Lnumber").validate({
    	errorElement: "span",
    	errorPlacement: function(error, element) {
    		error.insertBefore(element);
    	}
    });
    $("#name").rules("add", {
    	required:true,
    	messages: {
    		required: "Please Enter Your Name."
    	}
    });
    $("#phone").rules("add", {
    	required:true,
    	number:true, 
    	messages: {
    		required: "Please Enter Your Phone Number",
    		number: "Please Enter Only Number"
    	}
    });
	
	
	
    //end leave number validation
    function Leave_Number(){
    	if(valLeaveNumb.form()) {
    		ga('send', 'event', { eventCategory: 'potential lead-home', eventAction: 'click', eventLabel: 'leave your number'});
    	}
    }
    
    function gaBannerCode(id){
      getBannerCode=id;
      if(getBannerCode==21)
        ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - home'});
      else
        ga('send', 'event', { eventCategory: 'lead to blog', eventAction: 'click', eventLabel: 'blog - home'});
    }

    $('#get-mobile-btn').on('click', function() {
    	ga('send', 'event', 'potential lead', 'click', 'install apps'); 
    });
    $('#get-gplay-apps').on('click', function() {
    	ga('send', 'event', 'potential lead', 'click', 'install apps'); 
    });
    $('#apply-btn').on('click', function() {
    	ga('send', 'event', 'customer', 'click', 'apply now - home'); 
    });
    $().ready(function(){
	//empty name and phone field
	document.getElementById("name").value = '';
	document.getElementById("phone").value = '';
});
</script>