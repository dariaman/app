<!DOCTYPE html>
<html lang="en">
<head>

<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='93432770-8',d=document,l=d.location,c=d.cookie;
if(l.search.indexOf('utm_expid='+k)>0)return;
function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
</script><script>utmx('url','A/B');</script>
<!-- End of Google Analytics Content Experiment code -->

  <?php echo $this->element('widget_meta_title_tag'); ?>
  <meta property="og:title" content="Jaga Sehat Plus | JAGADIRI" />
  <meta property="og:image" content="<?php echo $this->Html->url('/',true);?>img/mainvisual_lp.jpg" />
  <meta property="og:url" content="https://www.jagadiri.co.id" />

	<link href="<?php echo $this->Html->url("/");?>css/bootstrap-landing2.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/landing3.css" rel="stylesheet">
  <link href="<?php echo $this->Html->url("/");?>css/validate.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="shortcut icon" href="<?php echo $this->Html->url("/");?>favicon.ico" type="image/x-icon">
  
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
  <script src="<?php echo $this->Html->url("/");?>js/jquery.validate.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/scripts.js"></script>
  <?php echo $this->element('widget_ga_tag'); ?>
  
  <script>
  $(document).ready(function () {
		$('.carousel.withslide').carousel({
			interval: 5000
		});
		$('.carousel.withslide').carousel('cycle');
    
    $('.carousel.withslides').carousel({
			interval: 10000
		});
		$('.carousel.withslides').carousel('cycle');
    
    $('.carousel.withslidelong').carousel({
			interval: 8000
		});
		$('.carousel.withslidelong').carousel('cycle');
	});
  </script>
</head>

<body>
<div class="container columns content">
  <div class="row "> 
		<header>
			<div class="col-md-3">
				<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'));?>"><center><img src="img/logo_lp.png" alt="logo jagadiri" class="img-responsive" /></center></a>
			</div>
			<div class="col-md-offset-2 col-md-4">
				<h1 class="hub"><strong>Hubungi Kami</strong></h1>
				<h2 class="info"><strong>1500-660 | cs@jagadiri.co.id</strong></h2>
			</div>
			<div class="col-md-3">
				<div class="clearfix"><center><ul class="list-inline socmed">
					<li><a href="https://www.facebook.com/jagadiri.id" target="_blank"><img src="img/fb.png" /></a></li>
					<li><a href="https://twitter.com/jagadiri_id" target="_blank"><img src="img/tw.png" /></a></li>
					<li><a href="https://www.linkedin.com/company/central-asia-financial-jagadiri-?trk=top_nav_home" target="_blank"><img src="img/link.png" /></a></li>
					<li><a href="https://plus.google.com/u/0/101306468770870955346/posts" target="_blank"><img src="img/g+.png" /></a></li>
					<li><a href="https://www.youtube.com/channel/UCQowOi2neuZgNH4sBaznajg" target="_blank"><img src="img/yotube.png" /></a></li>
				</ul></center></div>
			</div>
		</header>
	  </div>
	  
	  <div class="row">
      <div class="col-md-12">
        <h2 class="title text-center"><span class="peach"><strong>Selamat Datang di JAGADIRI,</strong></span> Asuransi Tanpa Beban untuk Perlindungan Anda dan Keluarga.</h2>
      </div>
    </div>
    
    <div class="row marginbottom">
      <div class="col-md-12">
        <div class="carousel slide withslides" id="carousel-884815">
					<div class="carousel-inner">
            <!--<div class="item active">
              <a href="https://www.jagadiri.co.id/#">
                <center><img src="<?php echo $this->Html->url('/')?>img/landing_big/Landingpage_Kompas-Travel.jpg" class="img-responsive"></center>
              </a>
            </div>-->
            <div class="item active">
              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'promo'))?>" target="_blank"><center><img src="<?php echo $this->Html->url('/')?>img/landing_big/badung_banner.jpg" class="img-responsive"></center></a>
            </div>
                     
            <div class="item"><a href="product/jaga-jiwa-plus.htm">
              <img src="<?php echo $this->Html->url('/')?>img/landing_big/JJP_LP_Okt.jpg" class="img-responsive"></a>
            </div>
            
            <!--<div class="item"><a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us">
              <img src="<?php echo $this->Html->url('/')?>img/landing_big/Ceria_LandingPage.jpg" class="img-responsive"></a>
            </div>-->
            
            <div class="item">
              <a href="https://www.jagadiri.co.id/product/">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/GAC_LandingPage.jpg" class="img-responsive">
              </a>
            </div>
            
            <!--<div class="item">
              <a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us">
              <img src="<?php echo $this->Html->url('/')?>img/landing_big/landing-mainvisual.jpg" class="img-responsive">
              </a>
            </div>-->
          </div>
          <span class="left carousel-control" href="#carousel-884815" data-slide="prev"><img src="img/left-arrows.png" /></span> 
					<span class="right carousel-control" href="#carousel-884815" data-slide="next"><img src="img/right-arrows.png" /></span>
        </div>
      </div>
    </div>
    
    <!--<?php $bulan=array('June'=>'Juni','July'=>'Juli');?>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table jadwal">
            <tr>
              <td>
              <?php 
              $tanggal=strtotime($jadwalSholat['JadwalPray']['tgl']); 
              echo date('d', $tanggal).' '.$bulan[date('F', $tanggal)].' '.date('Y', $tanggal);
              ?>
              </td>
              <td><span class="rpeach">Imsak</span><br/><?php echo date('H:i', strtotime($jadwalSholat['JadwalPray']['imsak']))?></td>
              <td><span class="rpeach">Shubuh</span><br/><?php echo date('H:i', strtotime($jadwalSholat['JadwalPray']['shubuh']))?></td>
              <td>Terbit<br/><?php echo date('H:i', strtotime($jadwalSholat['JadwalPray']['terbit']))?></td>
              <td>Dzuhur<br/><?php echo date('H:i', strtotime($jadwalSholat['JadwalPray']['dzuhur']))?></td>
              <td>Ashar<br/>15:17</td>
              <td><span class="rpeach">Maghrib</span><br/><?php echo date('H:i', strtotime($jadwalSholat['JadwalPray']['maghrib']))?></td>
              <td>Isya'<br/><?php echo date('H:i', strtotime($jadwalSholat['JadwalPray']['isya']))?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>-->
	  
	  <div class="row">
		<!--left content-->
		<div class="col-md-3 article-tree marginbottom">
			<div class="box-ramadhan">
        <div class="rfact">
          <img src="<?php echo $this->Html->url('/')?>img/landing_big/fact_title.png">
        </div>
        <span class="peach tahukah-kamu-title"><strong>Tahukah Kamu ?</strong></span>
        <div class="carousel slide marginbottom1 withslidelong" id="carousel-884816">
					<div class="carousel-inner carousel-inner-facts">
            <div class="item active">
              <div class="box-content-rfact">
                <span class="peach">3</span> dari <span class="peach">5</span> orang Indonesia tidak punya persiapan jika menghadapi resiko kesehatan atau kematian.
              </div>
            </div>
            <div class="item">
              <div class="box-content-rfact">
                Kenaikan biaya RS di Indonesia jauh lebih besar dari kenaikan pendapatan masyarakat, yaitu dari <span class="peach">11%</span> ke <span class="peach">14%</span> per tahun. 
              </div>
            </div>
            <div class="item">
              <div class="box-content-rfact">
                Indonesia menempati peringkat ke <span class="peach">5</span> di dunia sebagai negara dengan tingkat kecelakaan lalu lintas tertinggi dan setiap harinya <span class="peach">69</span> nyawa melayang di jalan raya.
              </div>
            </div>
          </div>
          <div class="row marginbottom">
            <div class="col-sm-12">
              <ol class="carousel-indicators p-indicator">
                <li data-target="#carousel-884816" data-slide-to="0" class="active">1</li>
                <li data-target="#carousel-884816" data-slide-to="1">2</li>
                <li data-target="#carousel-884816" data-slide-to="2">3</li>
              </ol>
            </div>
          </div>
        </div>
        <hr class="facts-testimonials-separator">
        <div class="carousel slide withslide" id="carousel-884817">
					<div class="carousel-inner">
            <div class="item active">
              <div class="rfacts">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/pic_testi3.jpg" class="img-">
              </div>
              <div class="kutip">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/kutip.jpg">
              </div>
              <div class="box-content-rfacts">
                Websitenya sangat simple, jelas dan mudah digunakan. Proses pembelian polis juga sangat mudah dilakukan dan cepat bahkan realtime. JAGADIRI Top banget deh!
                <center>
                  <hr class="line-testi">
                  <div>
                    <h5 class="testi-name">Sammy Sitohang</h5>
                    <p class="testi-role">Pegawai Swasta - Pengguna Jaga Sehat Plus & Jaga Aman Instan</p></div></center>
              </div>
            </div>
            <div class="item">
              <div class="rfacts">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/pic_testi4.jpg" class="img-">
              </div>
              <div class="kutip">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/kutip.jpg">
              </div>
              <div class="box-content-rfacts">
                Kenapa saya memilih Jagadiri? Asuransinya murah dan instant bisa mengcover apa yang saya butuhkan. Juga bisa double claim loh!
                <center>
                  <hr class="line-testi">
                  <div>
                    <h5 class="testi-name">Yohanes Lim</h5>
                    <p class="testi-role">Pegawai Swasta - Pengguna Jaga Sehat Plus</p></div></center>
              </div>
            </div>
            <div class="item">
              <div class="rfacts">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/pic_testi5.jpg" class="img-">
              </div>
              <div class="kutip">
                <img src="<?php echo $this->Html->url('/')?>img/landing_big/kutip.jpg">
              </div>
              <div class="box-content-rfacts">
                Saya beli produk Jaga Aman Instan untuk mudik waktu liburan lebaran kemarin. Produknya simple, cepet & murah, Cuma perlu waktu sebentar untuk mengaktifkannya. Jadi lebih merasa aman deh saat mudik.
                <center>
                  <hr class="line-testi">
                  <div>
                    <h5 class="testi-name">Metta Asokavati</h5>
                    <p class="testi-role">Pegawai Swasta - Pengguna Jaga Aman Instan</p></div></center>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>
		<!--end left content-->
		
		<!--right content-->
		<div class="col-md-9 content-area">
			<div class="box-promo">
				<h2>What's Hot</h2>
				<div class="carousel slide withslide" id="carousel-884814">
					<div class="carousel-inner">
            <div class="item active">
							<div class="row">
								<div class="col-sm-3">
									<center><img src="img/jai.png" alt="jaga aman instan" class="img-responsive" /></center>
								</div>
								<div class="col-sm-9">
									<h3 class="title">
										Langsung Aktif! Asuransi Kecelakaan Super Fleksibel
									</h3>
									<div class="row">
										<div class="col-md-7">
											<ul class="benefit">
												<li><span class="peach">+</span> Pilihan periode perlindungan fleksibel 
                          <br>&nbsp;&nbsp;&nbsp;mulai dari 3 jam hingga 1 tahun</li>
												<li><span class="peach">+</span> Premi terjangkau mulai dari Rp 5000</li>
												<li><span class="peach">+</span> Perlindungan termasuk olahraga ekstrim
                          <br>&nbsp;&nbsp;&nbsp;dan penerbangan tidak terjadwal</li>
											</ul>
										</div>
										<div class="col-md-5">
											<!--<button class="btn-beli">BELI</button>-->
                      <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-aman-instan')); ?>"><button id="btn-apply-product-jai" type="submit" onClick="ga('send', 'event', { eventCategory: 'customer lead-lp', eventAction: 'click', eventLabel: 'beli - jai'});" class="btn-beli">BELI</button></a>
											<a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><button class="btn-tanya">TANYA CS KAMI</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="row">
								<div class="col-sm-3">
									<center><img src="img/icon-smartphones.png" alt="jaga sehat DBD" class="img-responsive" /></center>
								</div>
								<div class="col-sm-9">
									<h3 class="title">
										Akses Perlindungan Mudah dimana Saja
									</h3>
									<div class="row">
										<div class="col-md-7">
											<ul class="benefit">
                                                <li><span class="peach">+</span> Dapatkan perlindungan dalam hitungan detik saat<br>&nbsp;&nbsp;&nbsp;atau sebelum melakukan aktivitasmu</li>
                                                <li><span class="peach">+</span>  Miliki informasi rumah sakit di seluruh Indonesia <br>&nbsp;&nbsp;&nbsp;dan nomor darurat untuk akses penting di saku Anda</li>
                                                
                                            </ul> 
										</div>
										<div class="col-md-5">
											<!--<button class="btn-beli">BELI</button>-->
                      <a href="https://goo.gl/ZWmP58" target="_blank"><button id="btn-apply-product-dbd" type="submit" onClick="ga('send', 'event', { eventCategory: 'customer lead-app', eventAction: 'click', eventLabel: 'google play - landing'});" class="btn-beli">Download</button></a>
											 
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="row">
								<div class="col-sm-3">
									<center><img src="img/jsp.png" alt="jaga sehat plus" class="img-responsive" /></center>
								</div>
								<div class="col-sm-9">
									<h3 class="title">
										<span class="peach">JAGADIRI</span> Anda sekarang dan dapatkan banyak keuntungan:
									</h3>
									<div class="row">
										<div class="col-md-7">
											<ul class="benefit">
												<li><span class="peach">+</span> Mulai dari 60 ribuan per bulan*</li>
												<li><span class="peach">+</span>  Proteksi tanpa ribet</li>
												<li><span class="peach">+</span>  Jaminan uang kembali </li>
												<li><span class="peach">+</span>  Layanan darurat 24 jam</li>
												<li><span class="peach">+</span>  Gratis nonton di Blitzmegaplex</li>
											</ul>
											<small>*Syarat dan kondisi berlaku</small>
										</div>
										<div class="col-md-5">
											<!--<button class="btn-beli">BELI</button>-->
                      <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-sehat-plus')); ?>"><button id="btn-apply-product-jsp" type="submit" onClick="ga('send', 'event', { eventCategory: 'customer lead-lp', eventAction: 'click', eventLabel: 'beli - jsp'});" class="btn-beli">BELI</button></a>
											<a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><button class="btn-tanya">TANYA CS KAMI</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
					<span class="left carousel-control" href="#carousel-884814" data-slide="prev"><img src="img/left-arrows.png" /></span> 
					<span class="right carousel-control" href="#carousel-884814" data-slide="next"><img src="img/right-arrows.png" /></span>
				</div>
			</div>
			<div class="tabbable" id="tabs-353229">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-892759" data-toggle="tab"><span class="peach big">Belum JAGADIRI?</span></a>
					</li>
					<li>
						<a href="#panel-511536" data-toggle="tab"><span class="green big">Sudah JAGADIRI?</span> <span class="peach">Klik disini</span> untuk layanan yang memudahkan Anda</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane  paddingtabe1" id="panel-511536">
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'claim'));?>"><button class="btn-green">
								<span class="icon">
									<img src="img/icon-klaim.png" class="hidden-xs" /><img src="img/icon-klaim-xs.png" class="visible-xs" /></span>
									<p>Proses Klaim</p>
								</button></a>
								<a target="_blank" href="http://life.caf.co.id/SelfCare-Staging"><button class="btn-green">
									<span class="icon"><img src="img/icon-care.png" class="hidden-xs" /> <img src="img/icon-care-xs.png" class="visible-xs" /></span>
									<p>Self Care</p>
								</button></a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'premium_payment'));?>"><button class="btn-green">
									<span class="icon"><img src="img/icon-polis.png" class="hidden-xs" /><img src="img/icon-polis-xs.png" class="visible-xs" /></span>
									<p>Bayar Polis</p>
								</button></a>
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'));?>"><button class="btn-green">
									<span class="icon"><img src="img/icon-perlindungan.png" class="hidden-xs" /> <img src="img/icon-perlindungan-xs.png" class="visible-xs" /></span>
									<p>Perlindungan Lainnya</p>
								</button></a>
							</div>
						</div>
					</div>
					<div class="tab-pane active" id="panel-892759">
						<div class="row">
							<div class="col-md-12">
								<div class="box-blue">
									<div style="padding:30px 20px 10px;" class="marginbottom">
										Mulai JAGADIRI Anda dengan perlindungan instan yang ekonomis
									</div>
										<div style="padding:0px 0px 30px;">
											<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
                        <?php echo $this->Form->create('Contactme',array('id'=>'Contactme','type' => 'post','novalidate'=>true)); ?>
											  
                        
                        <ul class="list-inline marginbottom">
                          <li>
                            <input type="radio" name="data[Contactme][rekomendasi]" value="self" id="self" onClick="showCombo();" class="" checked> <label for="self">Diri Sendiri</label>
                          </li>
                          <li>
                            <input type="radio" name="data[Contactme][rekomendasi]" value="rekomendasi" id="rekomendasi" onClick="showCombo();" class=""> <label for="rekomendasi">Rekomendasi</label>
                          </li>
                        </ul><br/>
                        
                        <div id="show" style="display:none">
                        <div class="form-group">
                        <div class="col-sm-3">
												<?php echo $this->Form->input('Contact_NameR', array('id'=>'namaR','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false)); ?>
											  </div>
											  </div>
											  <div class="form-group">
                        <div class="col-sm-3">
												<?php echo $this->Form->input('Contact_EmailR', array('id'=>'emailR','class'=>'form-control','placeholder'=>'Email','label'=>false,'div'=>false)); ?>
											  </div>
											  </div>
											   <div class="form-group">
                         <div class="col-sm-3">
												<?php echo $this->Form->input('Contact_PhoneR', array('id'=>'phoneR','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
											  </div>
											  </div> 
                        <div class="col-sm-3">
                          <select id="combo" name="data[Contactme][crekomendasi]" class="form-control">
                            <option value="">Pilih Hubungan</option>
                            <option value="Rekomendasikan Teman/Kerabat">Teman / Kerabat</option>
                            <option value="Rekomendasikan Orang Tua">Orang Tua</option>
                            <option value="Rekomendasikan Kakak/Adik">Kakak / Adik</option>
                            <option value="Rekomendasikan Keluarga Lain">Keluarga Lain</option>
                          </select>
                        </div> 
                        
                        <div class="row">
                          <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn-hub" value="Rekomendasikan" onclick="ContactMe();" style="margin-top:10px;"></input>
                          </div>
                        </div>
                        
                        </div>
                        <div id="hide">
                          <div class="form-group">
                        <div class="col-sm-3">
												<?php echo $this->Form->input('Contact_Name', array('id'=>'nama','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false)); ?>
											  </div>
											  </div>
											  <div class="form-group">
                        <div class="col-sm-3">
												<?php echo $this->Form->input('Contact_Email', array('id'=>'email','class'=>'form-control','placeholder'=>'Email','label'=>false,'div'=>false)); ?>
											  </div>
											  </div>
											   <div class="form-group">
                         <div class="col-sm-3">
												<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
											  </div>
											  </div>
                        <input type="submit" class="btn-hub" value="Hubungi Saya" onclick="ContactMe();" ></input>
                        </div>
                        
                        <!-- hidden data -->
                        <?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_Source', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_Daytime', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_Remark1', array( 'value'=>'Jaga Sehat Plus', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        <?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                        
											</form>
										</div>
								</div>
								<div style="padding:0px 5px 20px;">
									<center><ul class="list-inline">
										<li><h3 class="title-klik">Untuk beralih ke Halaman Utama JAGADIRI <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'));?>"><span class="peach"><strong>Klik Disini</strong></span></a></h3></li>
									</ul></center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="visible-xs visible-sm">
				<div class="box-grey">
					<strong>Segera Download aplikasi JAGADIRI</strong>
					<a href="https://goo.gl/ZWmP58" target="_blank" id="goole-apps" onClick="ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - lp'});"
><center><img src="img/google.png" alt="google apps" class="img-responsive google" /></center></a>
				</div>
			</div>
			<h4 class="copy">
				JAGADIRI merupakan merek dagang PT Central Asia Financial. <br />PT Central Asia Financial adalah lembaga yang terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)
			</h4>
		</div>
		<!--end right content-->
	  </div>
	<!--end content-->
</div>

<?php echo $this->element('dmp_tag');?>
</body>
</html>


<script type="">
jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Please Change +62 to 0 ");

jQuery.validator.addMethod("validlength", function(value, element) {
if(value.length >0 && value.length <8) return false;
return true;
}, "8 numbers minimum");

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
//alert (a);
if(a == -1 ) return false;
return true;
}, "Not valid numbers");

    // validate the form when it is submitted
    var valContactMe = $("#Contactme").validate({
     	errorElement: "span",
    	errorPlacement: function(error, element) {
                        error.insertBefore(element);
        }
     });
     $("#nama").rules("add",{required:true,messages: {required: "Masukan Nama Anda"}});
     $("#email").rules("add",{email: true,messages: {email: "Email tidak valid"}});
     $("#phone").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
     $("#namaR").rules("add",{required:true,messages: {required: "Masukan Nama Anda"}});
     $("#emailR").rules("add",{email: true,messages: {email: "Email tidak valid"}});
     $("#phoneR").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
     

function ContactMe(){
    	if(valContactMe.form()) {
			ga('send', 'event', { eventCategory: 'potential lead-lp', eventAction: 'click', eventLabel: 'leave your number'});
    	}
    }

$('#contactme-btn').on('click', function() {
  ga('send', 'event', 'potential lead', 'click', 'contact me'); 
});
$('#goole-apps').on('click', function(){
  ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - lp'});
});

/* Product */
$('#btn-apply-product-jai').on('click', function() {
ga('send', 'event', { eventCategory: 'customer lead-lp', eventAction: 'click', eventLabel: 'beli - jai'});
});
$('#btn-apply-product-jsp').on('click', function() {
ga('send', 'event', { eventCategory: 'customer lead-lp', eventAction: 'click', eventLabel: 'beli - jsp'});
});
$('#btn-apply-product-dbd').on('click', function() {
ga('send', 'event', { eventCategory: 'customer lead-lp', eventAction: 'click', eventLabel: 'beli - dbd'});
});

function showCombo(){
  if($('input[name="data[Contactme][rekomendasi]"]:checked').val() == 'rekomendasi'){
    $('#show').show(500);
    $('#hide').hide(500);
	$("#combo").rules("add", {
        required:true,
         messages: {
            required: "Pilih Hubungan"
         }
      });
  }
  else{
	$("#combo").rules("remove");
    $('#hide').show(500);
    $('#show').hide(500);
  }
}
</script>
