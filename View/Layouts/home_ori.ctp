<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $this->element('widget_meta_title_tag'); ?>
<link rel="shortcut icon" href="<?php echo $this->Html->url("/");?>favicon.ico">
<!-- Bootstrap Core CSS -->
<link href="<?php echo $this->Html->url("/");?>css/landing6.css" rel="stylesheet">
<link href="<?php echo $this->Html->url("/");?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $this->Html->url("/");?>css/style.css" rel="stylesheet">
<link href="<?php echo $this->Html->url("/");?>css/morris.css" rel="stylesheet">
<link href="<?php echo $this->Html->url("/");?>css/validate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo $this->Html->url("/");?>css/animate.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
<script src="<?php echo $this->Html->url("/");?>js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->Html->url("/");?>js/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo $this->Html->url("/");?>js/morris.min.js" type="text/javascript"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.<?php echo $this->Html->url("/");?>js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function () {
$('.carousel').carousel({
interval: 5000
});
$('.carousel').carousel('cycle');
});
$(function() {
window.prettyPrint && prettyPrint()
$(document).on('click', '.yamm .dropdown-menu', function(e) {
e.stopPropagation()
})
});
$(function () {
$(window).scroll(function () {
if ($(this).scrollTop() > 500) {
$('#back-top').fadeIn();
} else {
$('#back-top').fadeOut();
}
});
$(document).ready(function(){
$("#back-top").hide();
$('#back-top a').click(function () {
$('body,html').animate({
scrollTop: 0
}, 800);
return false;
});
});
});
</script>
<script>
    $(document).ready(function(){
        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() < 150) {
                    $('.down').fadeIn();
                } else {
                    $('.down').fadeOut();
                }
            });
        });    });
		
	$(document).ready(function () {
		$("#phoneR").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
		$("#phoneR2").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
		$("#phoneR3").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
		$("#phonerr").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
		$("#phone").keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
	});
    </script>
<?php echo $this->element('widget_ga_tag'); ?>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<?php echo $this->element('front/header'); ?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('front/footer'); ?>
<!-- Scrolling Nav JavaScript -->
<script src="<?php echo $this->Html->url("/");?>js/jquery.easing.min.js"></script>
<script src="<?php echo $this->Html->url("/");?>js/scrolling-nav.js"></script>
<script src="<?php echo $this->Html->url("/");?>js/wow.js"></script>
<script>
wow = new WOW({animateClass: 'animated',offset:100});
wow.init();
</script>
<div id="back-top" style="float:right;">
<a href="#top"><span ></span>Top</a>
</div>
<!--<div id="btnchat" class="btnchat">
  <a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - home'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><span class="icon"><img src="<?php echo $this->Html->url("/"); ?>img/chat-icon.png" /></span> Tanya CS Kami</a>
</div>-->
<?php echo $this->element('widget_remarketing_tag'); ?>
<!-- <script type="text/javascript">

        // setTimeout(function() {
        //     // viewing survey pop up
        //     $('#surveyPopup').modal({ show: true });
        // }, 30000);

		$('#loginbtn').on('click', function() {
			ga('send', 'event', 'member', 'click', 'login');
		});
	</script> -->

  <?php echo $this->element('dmp_tag');?>
  <?php echo $this->element('survey_popup'); ?>



      <div id="myModal" class="modal fade" style="padding-top:7%;">
        <div class="modal-dialog">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="../img/close-btn.png"></button>
            <div class="modal-body">
              <div class="tabbable" id="tabs-353229">
                <ul class="nav nav-tabs">                  
                  <li class="active">
                    <a href="#panel-8927592" data-toggle="tab"><span class="big">Mau Jadi <span class="peach">Member JAGADIRI?</span></span></a>
                  </li>
				  <li>
                    <a href="#panel-5115363" data-toggle="tab"><span class="green big">Sudah Jadi Member JAGADIRI?</span></a> <!--<span class="peach">Klik disini</span>-->
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" id="panel-5115362">
                    <div class="no-gap clearfix">
    					<div class="col-md-6">
    						<div class="row">
    						    <!-- banner -->
                                <div class="banner-mgm">
                                    <img src="../img/mgm-banner.jpg">
                            	</div>
    						</div>
                        </div>
                          <div class="col-md-6">
                            <div class="box-blue-2">
                              <div style="padding:20px 20px 5px;">
                                Rekomendasikan keluarga atau kerabat <br />Anda ke JAGADIRI
                              </div>
                              <div style="padding:10px 20px;">
                                <?php echo $this->Session->flash('flash2', array('element' => 'success'));?>
                                <?php echo $this->Form->create('Contactme',array('id'=>'Contactmerl','type' => 'post','novalidate'=>true)); ?>

                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <input type="text" name="data[Contactme][flash]" value="flash2" id="flash2" class="" hidden="hidden">
                                    <input type="text" name="data[Contactme][rekomendasi]" value="rekomendasi" id="rekomendasi" class="" hidden="hidden">
                                    <?php echo $this->Form->input('Contact_NameR', array('id'=>'namaR','validNameLength'=>true,'validReqN'=>'true','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-8">
                                    <?php echo $this->Form->input('Contact_PhoneR', array('id'=>'phoneR','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>
                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_NameR2', array('id'=>'namaR2','validNameLength'=>true,'class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-8">
                                    <?php echo $this->Form->input('Contact_PhoneR2', array('id'=>'phoneR2','validNotelp'=>false,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>
                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_NameR3', array('id'=>'namaR3','validNameLength'=>true,'class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-8">
                                    <?php echo $this->Form->input('Contact_PhoneR3', array('id'=>'phoneR3','validNotelp'=>false,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>

                                  <?php echo $this->Session->flash('flashe', array('element' => 'emailerror'));?>
    							<!-- notifikasi email spesifik -->
    							<div class="alertmail alert alert-success alert-dismissable" style='display:none;'>
    								Maaf Anda belum bisa mengikuti program ini karena belum menjadi member JAGADIRI, segera beli produk JAGADIRI untuk menjadi member.
    							</div>
    							<!-- end notifikasi email spesifik -->
                                <hr>
                                <div style="padding:10px 20px 5px;">
                                  Isi Data Diri Anda di sini !
                                </div>
                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_Name', array('id'=>'namarr','validNameLength'=>true,'validReqN'=>'true','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_Phone', array('id'=>'phonerr','validNotelp2'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'No. Handphone','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_Email', array('id'=>'emailrr','validReqE'=>'true','validEmail'=>true, 'class'=>'form-control','placeholder'=>'Email','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>
                                <button type="submit" class="btn-hub"><span class="shadow" onclick="Validater_Form();">Kirim</span></button>
                                 <?php echo $this->Session->flash('flashbtn', array('element' => 'linkhome'));?>
                                 <a href="https://www.jagadiri.co.id/promo/member-get-member.htm" class="modal-linkpromo btn-hub"><span>Detail Promo</span></a>
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
                      </div>
                    </div>
                    <div class="tab-pane active paddingtabe1" id="panel-8927592">
                      <div class="no-gap clearfix">
                        <div class="col-md-6">
                          <div class="box-blue">
                            <div style="padding:20px;" id="hideAfter">
                              <strong>SEGERA</strong> cari tahu <br />produk JAGADIRI yang sesuai dengan kebutuhan Anda agar dapat menjadi member
                            </div>
                            <div style="padding:10px 20px;">
                              <?php echo $this->Session->flash('flash3', array('element' => 'good'));?>
                              <?php echo $this->Form->create('Contactme',array('id'=>'Contactme','type' => 'post','novalidate'=>true)); ?>
                              <div class="form-group">
                                <input type="text" name="data[Contactme][flash]" value="flash3" id="flash3" class="" hidden="hidden">
                                <input type="text" name="data[Contactme][rekomendasi]" value="self" id="self" class="" hidden="hidden">
                                <?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true,'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
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
                                <span class="icon2"><img src="../img/icon-1.png" class="hidden-xs" /></span>
                                <p class="judul">Tentang <br /><strong>JAGADIRI</strong></p>
                              </button></a>
                            </div>
                            <div class="col-xs-6">
                              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>"><button class="btn-pink">
                                <span class="icon2"><img src="../img/icon-2.png" class="hidden-xs" /></span>
                                <p class="judul"> Produk <br /><strong>JAGADIRI</strong></p>
                              </button></a>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div style="padding:20px;">
                            <div class="col-xs-6">
                              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>"><button class="btn-green2">
                                <span class="icon2"><img src="../img/icon-3.png" class="hidden-xs" /></span>
                                <p class="judul">Cek Kebutuhan  <br /><strong>Anda</strong></p>
                              </button></a>
                            </div>
                            <div class="col-xs-6">
                              <a href="promo/promo-badung.htm"><button class="btn-green3">
                                <span class="icon2"><img src="../img/icon_gift.png" class="hidden-xs" /></span>
                                <p class="judul">Promo <br /><strong>Bulan Ini</strong></p>
                              </button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
				  <div class="tab-pane paddingtabe1" id="panel-5115363">
					<div class="no-gap clearfix">
					  <div class="col-md-6">
						<div class="row">
						  <div style="padding:20px;">
							<div class="col-xs-6">
							  <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'claim'));?>"><button class="btn-green">
								<span class="icon">
								  <center><img src="../img/icon-klaim-xs.png" class="hidden-xs" /></span></center>
								  <p>Proses Klaim</p>
								</button></a>
							  </div>
							  <div class="col-xs-6">
								<a target="_blank" href="http://life.caf.co.id/SelfCare-Staging"><button class="btn-green">
								  <span class="icon"><center><img src="../img/icon-care-xs.png" class="hidden-xs" /></span></center>
								  <p>Self Care</p>
								</button></a>
							  </div>
							</div>
						  </div>
						  <div class="row">
							<div style="padding:20px;">
							  <div class="col-xs-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'premium_payment'));?>"><button class="btn-green">
								  <span class="icon"><center><img src="../img/icon-polis-xs.png" class="hidden-xs" /></span></center>
								  <p>Bayar Polis</p>
								</button></a>
							  </div>
							  <div class="col-xs-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'));?>"><button class="btn-green">
								  <span class="icon">
									<center><img src="../img/icon-perlindungan-xs.png" class="hidden-xs" /></span></center>
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
							  <div style="padding:10px 20px;">
								<?php echo $this->Session->flash('flash2', array('element' => 'success'));?>
								<?php echo $this->Form->create('Contactme',array('id'=>'Contactmer','type' => 'post','novalidate'=>true)); ?>
								<div class="form-group2 clearfix">
								  <div class="col-xs-4">
									<input type="text" name="data[Contactme][flash]" value="flash2" id="flash2" class="" hidden="hidden">
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
									<?php echo $this->Form->input('Contact_Name', array('id'=>'namarr','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
								  </div>
								  <div class="col-xs-8">
									<?php echo $this->Form->input('Contact_Phone', array('id'=>'phonerr','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
								  </div>
								</div>
								<button type="submit" class="btn-hub"><span class="shadow">Kirim</span></button>
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
					  </div>
					</div>
                </div>
              </div>
            </div>
    <!--<div class="mod-fot">
    <center><img src="../img/modal-footer.png" class="img-responsive" /></center>
    </div>-->
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<script>

//jQuery.noConflict();
<?php //if(isset($flash) )?>
<?php if(!isset($flash) && !isset($flash1) && !isset($flash2) && !isset($flash3)):?>
  jQuery(function() {
    jQuery('#myModal').modal({ show: true });
  });
<?php elseif(isset($flash2) && $flash2==1 || isset($flash3) && $flash3==1):?>
  jQuery(function() {
    jQuery('#myModal').modal({ show: true });
    $('#hideAfter,#hideAfter1,#phone').hide();
  });
<?php elseif(isset($flash1) && $flash1==1):?>
  jQuery(function() {
    jQuery('#myModal').modal({ show: false });
    $('#hideAfter2,#hideAfter3,#phonel').hide();
  });
<?php else:?>
  jQuery(function() {
    jQuery('#myModal').modal({ show: true });
  });
<?php endif;?>
</script>

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

  jQuery.validator.addMethod("validNameLength", function(value, element) {
    if(value.length >0 && value.length <3) return false;
    return true;
  }, "3 chars minimum");

    jQuery.validator.addMethod("validReqN", function(value, element) {
      if(value.length == 0) return false;
      return true;
  }, "Masukan Nama");

  function validateEmail($email) {
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
   return emailReg.test( $email );
 }
      jQuery.validator.addMethod("validReqE", function(value, element) {
        if (!validateEmail(value))  return false;
        if(value.length == 0) return false;
        return true;
    }, "Email Salah");

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
    }, "Not valid");

      jQuery.validator.addMethod("validNotelp2", function(value, element) {
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
        }, "Not valid");

var valContactMe3 = $("#Contactmerl").validate({
  errorElement: "span",
  errorPlacement: function(error, element) {
    error.insertBefore(element);
  }
});

//$("#nama").rules("add",{required:true,messages: {required: "Masukan Nama Anda"}});
$("#phone").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

$("#phonel").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

$("#namarrl").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#namarr").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#phonerr").rules("add",{required:true,number:true,messages:{required: "Not valid",number: "Masukan angka"}});

$("#namaR").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#phoneR").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR2").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR2").rules("add",{required:false,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR3").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR3").rules("add",{required:false,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

// $("#namarr").rules("add",{required:true,messages: {required: "Masukan Nama"}});
// $("#phonerr").rules("add",{required:true,number:true,messages:{required: "Not Valid",number: "Masukan angka"}});

$("#namaRl").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#phoneRl").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR2l").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR2l").rules("add",{required:false,number:false,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR3l").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR3l").rules("add",{required:false,number:false,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

$("#emailrr").rules("add",{required:true,email:true,messages:{required: "Email salah",email: "Email salah"}});
$("#emailrr2").rules("add",{required:true,email:true,messages:{required: "Email salah",email: "Email salah"}});

$('.btn-hub').on('click', function() {
 ga('send', 'event', { eventCategory: 'potential lead-lp', eventAction: 'click', eventLabel: 'leave your number'});
});
</script>
</body>
</html>
