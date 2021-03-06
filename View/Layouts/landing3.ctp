<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->element('widget_meta_title_tag'); ?>
  <meta property="og:title" content="Jaga Sehat Plus | JAGADIRI" />
  <meta property="og:image" content="<?php echo $this->Html->url('/',true);?>img/mainvisual_lp.jpg" />
  <meta property="og:url" content="https://www.jagadiri.co.id" />

	<link href="<?php echo $this->Html->url("/");?>css/bootstrap-landing3.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/landing4.css" rel="stylesheet">
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
		$('.carousel').carousel({
			interval: 2200
		});
		$('.carousel').carousel('cycle');
	});
  </script>
</head>

<body>
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-3">
				<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'));?>"><center><img src="img/logo_lp.png" alt="logo jagadiri" class="img-responsive" /></center></a>
			</div>
			<div class="col-md-offset-2 col-md-4">
				<h1 class="hub"><strong>Hubungi Kami</strong></h1>
				<h2 class="info"><strong>+62 21 1500 660 | cs@jagadiri.co.id</strong></h2>
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
		</div>
	</header>
	<div class="row">
		<div class="col-md-12">
			<h2 class="title text-center"><span class="peach"><strong>Selamat Datang di JAGADIRI,</strong></span> Asuransi Tanpa Beban untuk Perlindungan Anda dan Keluarga.</h2>
		</div>
	</div>
	<!--content-->
	<div class="row">
		<!--left content-->
		<div class="col-md-4">
			<div class="box-chat">
				<span class="big">Halo, saya <span class="peach"><strong>Nita.</strong></span></span><br />
				Klik Saya untuk Live Chat <br />
				dengan CS Kami
			</div>
			<div class="segitiga"></div>
			<a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: 'open chatbox-lp'});  if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><center><img src="img/landing_big/maskot.png" alt="maskot jagadiri" class="img-responsive maskot" /></center></a>
			<div class="hidden-xs hidden-sm">
				<div class="box-grey">
					<strong>Kemudahan perlindungan di tangan Anda. Segera Download aplikasi JAGADIRI</strong>
					<a href="https://goo.gl/ZWmP58" target="_blank"><center><img src="img/google.png" alt="google apps" class="img-responsive google" /></center></a>
				</div>
				<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'));?>"><button class="btn-pink">Bantu Saya pergi ke<br /> Halaman Utama JAGADIRI</button></a>
			</div>
		</div>
		<!--end left content-->
		
		<!--right content-->
		<div class="col-md-8">
			<div class="box-promo">
				<h2>What's Hot</h2>
				<div class="carousel slide" id="carousel-884814">
					<div class="carousel-inner">
            <div class="item active">
							<div class="row">
								<div class="col-sm-4">
									<center><img src="img/landing_big/jai.png" alt="jaga aman instan" class="img-responsive" /></center>
								</div>
								<div class="col-sm-8">
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
                      <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-aman-instan')); ?>"><button type="submit" onClick="ga('send', 'event', 'customer', 'click', 'apply now - product');" class="btn-beli">BELI</button></a>
											<a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: 'open chatbox-lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><button class="btn-tanya">TANYA CS KAMI</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="row">
								<div class="col-sm-4">
									<center><img src="img/landing_big/jsdbd.png" alt="jaga sehat DBD" class="img-responsive" /></center>
								</div>
								<div class="col-sm-8">
									<h3 class="title">
										<span class="peach">GRATIS!</span> Perlindungan untuk Demam Berdarah.
									</h3><br />
									<div class="row">
										<div class="col-md-7">
											<p>Cukup berikan masukkan Anda untuk website kami, maka kami akan memeberikan Anda Perlindungan dari Jaga Sehat DBD secara cuma-cuma.</p>
										</div>
										<div class="col-md-5">
											<!--<button class="btn-beli">BELI</button>-->
                      <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-sehat-dbd')); ?>"><button type="submit" onClick="ga('send', 'event', 'customer', 'click', 'apply now - product');" class="btn-beli">BELI</button></a>
											<a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: 'open chatbox-lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><button class="btn-tanya">TANYA CS KAMI</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="row">
								<div class="col-sm-4">
									<center><img src="img/landing_big/jsp.png" alt="jaga sehat plus" class="img-responsive" /></center>
								</div>
								<div class="col-sm-8">
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
                      <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_non_unitlink','id'=>'jaga-sehat-plus')); ?>"><button type="submit" onClick="ga('send', 'event', 'customer', 'click', 'apply now - product');" class="btn-beli">BELI</button></a>
											<a href="/chat_with_us/chat?locale=id" target="_blank" onclick="ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: 'open chatbox-lp'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><button class="btn-tanya">TANYA CS KAMI</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
					<span class="left carousel-control" href="#carousel-884814" data-slide="prev"><img src="img/landing_big/left-arrow.png" /></span> 
					<span class="right carousel-control" href="#carousel-884814" data-slide="next"><img src="img/landing_big/right-arrow.png" /></span>
				</div>
			</div>
			<div class="tabbable" id="tabs-353229">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-892759" data-toggle="tab"><span class="peach big">Belum JAGADIRI?</span></a>
					</li>
					<li>
						<a href="#panel-511536" data-toggle="tab"><span class="green big">Sudah JAGADIRI?</span> Gunakan fasilitas yang memudahkan Anda</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane paddingtabe1" id="panel-511536">
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'claim'));?>"><button class="btn-green">
								<span class="icon">
									<img src="img/landing_big/icon-klaim.png" class="hidden-xs" /><img src="img/landing_big/icon-klaim-xs.png" class="visible-xs" /></span>
									<p>Proses Klaim</p>
								</button></a>
								<a target="_blank" href="http://system.jagadiri.co.id/Selfcare"><button class="btn-green">
									<span class="icon"><img src="img/landing_big/icon-care.png" class="hidden-xs" /> <img src="img/landing_big/icon-care-xs.png" class="visible-xs" /></span>
									<p>Self Care</p>
								</button></a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'premium_payment'));?>"><button class="btn-green">
									<span class="icon"><img src="img/landing_big/icon-polis.png" class="hidden-xs" /><img src="img/landing_big/icon-polis-xs.png" class="visible-xs" /></span>
									<p>Bayar Polis</p>
								</button></a>
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'));?>"><button class="btn-green">
									<span class="icon"><img src="img/landing_big/icon-perlindungan.png" class="hidden-xs" /> <img src="img/landing_big/icon-perlindungan-xs.png" class="visible-xs" /></span>
									<p>Perlindungan <br/>Lainnya</p>
								</button></a>
							</div>
						</div>
					</div>
					<div class="tab-pane active" id="panel-892759">
						<div class="row">
							<div class="col-md-6">
								<div class="box-blue">
									<div style="padding:20px;">
										Mulai JAGADIRI Anda dengan <br />perlindungan instan yang <br />ekonomis
									</div>
									<div class="tri">
										<div style="padding:0px 20px;">
											<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
                        <?php echo $this->Form->create('Contactme',array('id'=>'Contactme','type' => 'post','novalidate'=>true)); ?>
											  
                        <div class="form-group">
												<?php echo $this->Form->input('Contact_Name', array('id'=>'nama','class'=>'form-control','placeholder'=>'Nama','label'=>false)); ?>
											  </div>
											  <div class="form-group">
												<?php echo $this->Form->input('Contact_Email', array('id'=>'email','class'=>'form-control','placeholder'=>'Email','label'=>false)); ?>
											  </div>
											   <div class="form-group">
												<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false)); ?>
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
                        
                        <input type="submit" class="btn-hub" value="Hubungi Saya" onclick="ContactMe();" ></input>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box-title">
								Segera Cari tahu:
								</div>
								<div style="padding:10px;">
									<ul class="find">
										<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'tentangjagadiri'))?>">Tentang JAGADIRI</a></li>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>">Produk JAGADIRI</a></li>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home','#'=>'contact'))?>">Cara mudah membeli produk <br />JAGADIRI via Web atau Aplikasi</a></li>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>">Solusi Perlindungan dan Investasi <br />sesuai kebutuhan Anda</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="visible-xs visible-sm">
				<div class="box-grey">
					<strong>Kemudahan perlindungan di tangan Anda. Segera Download aplikasi JAGADIRI</strong>
					<a href="https://goo.gl/ZWmP58" target="_blank"><center><img src="img/google.png" alt="google apps" class="img-responsive google" /></center></a>
				</div>
				<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>"><button class="btn-pink">Bantu Saya pergi ke<br /> Halaman Utama JAGADIRI</button></a>
			</div>
			<h4 class="copy">
				JAGADIRI merupakan merek dagang PT Central Asia Financial. <br />PT Central Asia Financial adalah lembaga yang terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)
			</h4>
		</div>
		<!--end right content-->
	</div>
	<!--end content-->
</div>
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
     $("#nama").rules("add", {
         required:true,
         messages: {
                required: "Please Enter Your Name."
         }
      });
     $("#email").rules("add", {
         email: true,
         messages: {
    		email: "Please Enter Your Valid Email."
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
     

function ContactMe(){
    	if(valContactMe.form()) {
			ga('send', 'event', 'potential lead', 'click', 'submit contact me');
    	}
    }

$('#contactme-btn').on('click', function() {
  ga('send', 'event', 'potential lead', 'click', 'contact me'); 
});
$('#btn-apply-product').on('click', function() {
ga('send', 'event', 'customer', 'click', 'apply now - product'); 
});
</script>
