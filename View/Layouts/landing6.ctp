<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Intro JAGADIRI Asuransi Tanpa Beban</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">


  <link href="<?php echo $this->Html->url("/");?>css/bootstrap-landing5.css" rel="stylesheet">
  <link href="<?php echo $this->Html->url("/");?>css/landing6.css" rel="stylesheet">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->Html->url("/");?>js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/scripts.js"></script>

<script>
  $(function(){
    $('.carousel').carousel({
      interval: 5000
    });
  });
</script>
</head>

<body>
  <div class="container">
    <header>
      <div class="row">
        <div class="col-md-3">
          <a href="https://www.jagadiri.co.id/home/"><center><img src="img/logo_lp.png" alt="logo jagadiri" class="img-responsive" /></center></a>
        </div>
        <div class="col-md-2"><a href="https://www.jagadiri.co.id/home/" class="hidden-xs hidden-sm"><img src="img/home-button.png" /></a></div>
        <div class="col-md-4">
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
      <div class="col-md-3">
        <div class="box-chat">
          <span class="big"><span class="peach">Halo, saya Nita.</span></span><br />
          Klik Saya untuk Live Chat <br />
          dengan CS Kami
        </div>
        <div class="segitiga"></div>
        <a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - lp'});  if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><center><img src="img/maskot6.png" alt="maskot jagadiri" class="img-responsive maskot" /></center></a>
        <div class="hidden-xs hidden-sm">
          <div class="box-grey">
            <strong>Segera Download aplikasi JAGADIRI</strong>
            <a href="https://goo.gl/ZWmP58" target="_blank" id="goole-apps" onClick="ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - lp'});"
            ><center><img src="img/google.png" alt="google apps" class="img-responsive google" /></center></a>
          </div>
        </div>
      </div>
      <!--end left content-->

      <!--right content-->
      <div class="col-md-9">
        <div class="tabbable" id="tabs-353229">
          <ul class="nav nav-tabs">
            <li class="active"> 
              <a href="#panel-892759" data-toggle="tab"><span class="big">Anda <span class="peach">Belum JAGADIRI?</span></span></a>
            </li>
            <li> 
              <a href="#panel-511536" data-toggle="tab"><span class="green big">Sudah JAGADIRI?</span> <span class="peach">Klik disini</span> untuk layanan yang memudahkan Anda</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane paddingtabe1" id="panel-511536">
              <div class="no-gap clearfix">
                <div class="col-md-6">
                  <div class="row">
                    <div style="padding:20px;">
                      <div class="col-xs-6">
                        <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'claim'));?>"><button class="btn-green">
                          <span class="icon">
                            <center><img src="img/icon-klaim-xs.png" class="hidden-xs" /></span></center>
                            <p>Proses Klaim</p>
                          </button></a>
                        </div>
                        <div class="col-xs-6">
                          <a target="_blank" href="http://system.jagadiri.co.id/Selfcare"><button class="btn-green">
                            <span class="icon"><center><img src="img/icon-care-xs.png" class="hidden-xs" /></span></center>
                            <p>Self Care</p>
                          </button></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div style="padding:20px;">
                        <div class="col-xs-6">
                          <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'premium_payment'));?>"><button class="btn-green">
                            <span class="icon"><center><img src="img/icon-polis-xs.png" class="hidden-xs" /></span></center>
                            <p>Bayar Polis</p>
                          </button></a>
                        </div>
                        <div class="col-xs-6">
                          <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'));?>">
                            <button class="btn-green">
                              <span class="icon">
                                <center><img src="img/icon-perlindungan-xs.png" class="hidden-xs" /></span></center>
                                <p>Perlindungan <br />Lainnya</p>
                              </button></a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="box-blue-2">
                          <div style="padding:20px 20px 5px;">
                            Rekomendasikan keluarga atau kerabat <br />Anda ke JAGADIRI
                          </div>
                          <div style="padding:0px 20px;">
                            <?php echo $this->Session->flash('flash1', array('element' => 'success'));?>
                            <?php echo $this->Form->create('Contactme',array('id'=>'Contactmer','type' => 'post','novalidate'=>true)); ?>
                            <div class="form-group2 clearfix">
                              <div class="col-xs-4">
                                <input type="text" name="data[Contactme][rekomendasi]" value="rekomendasi" id="rekomendasi" class="" hidden="hidden">
                                <?php echo $this->Form->input('Contact_NameR', array('id'=>'namaR','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                              </div>
                              <div class="col-xs-8">
                                <?php echo $this->Form->input('Contact_PhoneR', array('id'=>'phoneR','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                              </div>
                            </div>
                            <div class="form-group2 clearfix">
                              <div class="col-xs-4">
                                <?php echo $this->Form->input('Contact_NameR2', array('id'=>'namaR2','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                              </div>
                              <div class="col-xs-8">
                                <?php echo $this->Form->input('Contact_PhoneR2', array('id'=>'phoneR2','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                              </div>
                            </div>
                            <div class="form-group2 clearfix">
                              <div class="col-xs-4">
                                <?php echo $this->Form->input('Contact_NameR3', array('id'=>'namaR3','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                              </div>
                              <div class="col-xs-8">
                                <?php echo $this->Form->input('Contact_PhoneR3', array('id'=>'phoneR3','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                              </div>
                            </div>
                            <hr>
                            <div style="padding:0px 20px 5px;">
                              Isi Data Diri Anda di sini !
                            </div>
                            <div class="form-group2 clearfix">
                              <div class="col-xs-4">
                                <?php echo $this->Form->input('Contact_Name', array('id'=>'nama','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                              </div>
                              <div class="col-xs-8">
                                <?php echo $this->Form->input('Contact_Phone', array('id'=>'phonel','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                              </div>
                            </div>
                            <?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_Source', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_Daytime', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_Remark1', array( 'value'=>'Jaga Sehat Plus', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            <button type="submit" class="btn-hub"><span class="shadow">Kirim</span></button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane active" id="panel-892759">
                  <div class="no-gap clearfix">
                    <div class="col-md-6">
                      <div class="box-blue">
                        <div style="padding:20px;" id="hideAfter">
                          <strong>SEGERA</strong> cari tahu <br />produk JAGADIRI yang sesuai dengan kebutuhan Anda
                        </div>
                        <div style="padding:10px 20px;">
                          <?php echo $this->Session->flash('flash2', array('element' => 'good'));?>
                          <?php echo $this->Form->create('Contactme',array('id'=>'Contactme','type' => 'post','novalidate'=>true)); ?>
                          <div class="form-group">
                            <input type="text" name="data[Contactme][rekomendasi]" value="self" id="self" class="" hidden="hidden">
                            <?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                          </div>
                          <button type="submit" class="btn-hub" id="hideAfter1"><span class="shadow">Hubungi Saya</span></button>
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
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div style="padding:20px;">
                        <div class="col-xs-6">
                          <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'tentangjagadiri'))?>"><button class="btn-green1">
                            <span class="icon2"><img src="img/icon-1.png" class="hidden-xs" /></span>
                            <p class="judul">Tentang <br /><strong>JAGADIRI</strong></p>
                          </button></a>
                        </div>
                        <div class="col-xs-6">
                          <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>"><button class="btn-pink">
                            <span class="icon2"><img src="img/icon-2.png" class="hidden-xs" /></span>
                            <p class="judul"> Produk <br /><strong>JAGADIRI</strong></p>
                          </button></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div style="padding:20px;">
                        <div class="col-xs-6">
                          <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>"><button class="btn-green2">
                            <span class="icon2"><img src="img/icon-3.png" class="hidden-xs" /></span>
                            <p class="judul">Cek Kebutuhan  <br /><strong>Anda</strong></p>
                          </button></a>
                        </div>
                        <div class="col-xs-6">
                          <a href="https://www.jagadiri.co.id/promo/promo-badung.htm"><button class="btn-green3">
                            <span class="icon2"><img src="img/icon_gift.png" class="hidden-xs" /></span>
                            <p class="judul">Promo <br /><strong>Bulan Ini</strong></p>
                          </button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel slide" id="carousel-884814">
          <div class="hot"><img src="img/hot.png" class="img-responsive" /></div>
          <div class="carousel-inner">
            <!--<div class="item active mainvisual">
              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>"><img src="img/landing_big/GAC_LandingPage.jpg" alt="" class="img-responsive" /></a>
            </div>-->
            <!--<div class="item mainvisual">
              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'promo'))?>" target="_blank"><img src="img/promo_bandung.jpg" alt="" class="img-responsive " /></a>
            </div>-->
            <?php $_i=0; foreach ($promo as $pr ): ?>
            <div class="item <?php if($_i==0) echo 'active';?> mainvisual">
              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'detail_promo','seo'=>$pr['Promo']['seo'])) ?>" target="_blank">
                <img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_bilboard'])?>" class="img-responsive">
              </a>
            </div>
            <?php $_i=1; endforeach; ?>
            <div class="item mainvisual">
              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>'jaga-jiwa-plus'))?>"><img src="img/landing_big/landingpage_jjp.jpg" alt="" class="img-responsive " /></a>
            </div>
            <div class="item mainvisual">
              <a href="javascript:show_popup();"><img src="img/banner_survey-LP.png" alt="" class="img-responsive " /></a>
            </div>
          </div> 
          <span class="left carousel-control" href="#carousel-884814" data-slide="prev"><img src="img/left-arrow2.png" /></span> 
          <span class="right carousel-control" href="#carousel-884814" data-slide="next"><img src="img/right-arrow2.png" /></span>
        </div>
          <h4 class="copy">
            JAGADIRI merupakan merek dagang PT Central Asia Financial. <br />PT Central Asia Financial adalah lembaga yang terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)
          </h4>
        </div>
        <!--end right content-->
      </div>
      <!--end content-->
    </div>
    
    <script type="text/javascript" charset="UTF-8">document.write(unescape("%3Cscript src='//di2xiflr72bem.cloudfront.net/ut/34e94dab06682b23_35.js' type='text/javascript' charset='UTF-8' %3E%3C/script%3E"));</script> 
    
    <script>

setTimeout(function() {
    // viewing survey pop up
    $('#surveyPopup').modal({ show: true });
}, 30000);

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');  ga('create', 'UA-56440636-1', 'auto');
ga('require', 'displayfeatures');  
ga('send', 'pageview')

</script> 
  </body>
  </html>
  <script type="">
    <?php if(isset($flash2) && $flash2==1):?>
    $('#hideAfter,#hideAfter1,#phone').hide();
  <?php endif;?>

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
$("#phone").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#phonel").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR").rules("add",{required:true,messages: {required: "Masukan Nama Anda"}});
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
$('.btn-hub').on('click', function() {
 ga('send', 'event', { eventCategory: 'potential lead-lp', eventAction: 'click', eventLabel: 'leave your number'});
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
<?php echo $this->element('survey_popup'); ?>