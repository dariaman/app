
<div id="sidebar">
	<div class="panel box-ones" role="navigation">
					<div class="panel-heading">
						<h4>Saya Mencari Asuransi :</h4>
						<button type="button" class="panel-toggle" data-toggle="collapse" data-target="#panel1-collapse"> <span class="sr-only">Toggle navigation</span><span class="glyphicon glyphicon-play"></span></button>
					</div>
					<div class="collapse panel-collapse-custome panel-collapse" id="panel1-collapse">
						<div class="panel panel-default">
							<div class="panel-body">
							<ul class="box-one-looking">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>"><li><span class="pull-left img-looking"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kesehatan.png" class="img-responsive" /></span> Kesehatan <b class="left-t"></b></li></a>
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>"><li><span class="pull-left img-looking"><img src="<?php echo $this->Html->url("/");?>img/icon-product/jiwa.png" class="img-responsive" /></span> Jiwa <b class="left-t"></b></li></a>
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>"><li><span class="pull-left img-looking"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kecelakaan.png" class="img-responsive" /></span> Kecelakaan <b class="left-t"></b></li></a>
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>"><li><span class="pull-left img-looking"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" class="img-responsive" /></span> Plus Investasi <b class="left-t"></b></li></a>
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'general'))?>"><li><span class="pull-left img-looking"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" class="img-responsive" /></span> General <b class="left-t"></b></li></a>
							</ul>
							</div>
						</div>
					</div>
				</div>
				
				
	<div id="iwant">
		<div class="panel" role="navigation">
			<div class="panel-heading">
				<h4>Saya Ingin :</h4>
				<button type="button" class="panel-toggle" data-toggle="collapse" data-target="#panel2-collapse"> <span class="sr-only">Toggle navigation</span><span class="glyphicon glyphicon-play"></span></button>
			</div>
			<div class="collapse panel-collapse-custome panel-collapse" id="panel2-collapse">
				<div class="panel panel-default">
					<div class="panel-body">
						<center><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>"><div class="solution-btn"><h2 class="title-btn">Temukan <span class="bold">Solusi</span></h2></div></a></center>
						<center><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'claim')); ?>"><div class="claim-btn"><h2 class="title-btn">Cek <span class="bold">Klaim Saya</span></h2></div></a></center>
						<!--<center><a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - product'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;" id="chat_with_us"><div class="talk-btn"><h2 class="title-btn3">Online <span class="bold">Chat</span></h2></div></a></center>-->
					<!-- hide survey <center>
					  <a href="javascript:show_popup();"><img src="<?php echo $this->Html->url("/");?>img/banner_survey_sidebar.png" alt="mini survey" class="img-responsive" /></a>
					</center> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
			
<script type="text/javascript">
$(function() {
    var offset = $("#sidebar").offset();
	var docHeight = $(document).height();
	var footer1Height = $('.footers').innerHeight();
	var footer2Height = $('.main-midfooter').innerHeight();
	var footer3Height = $('footer').innerHeight();
	var sidebarHeight = $('#sidebar').height();
	var footerHeight = footer1Height + footer2Height + footer3Height;
	var hThis = docHeight - footerHeight - offset.top - sidebarHeight - 60;
	
    var topPadding = 100;
    $(window).scroll(function() {
		if (($(window).scrollTop() > offset.top) && ($(window).scrollTop() < hThis)) {
			$("#sidebar").stop().animate({
				marginTop: $(window).scrollTop() - offset.top + topPadding
			});
		} else if ($(window).scrollTop() > hThis){
			$("#sidebar").stop().animate({
				marginTop: hThis
			});
		} else {
			$("#sidebar").stop().animate({
				marginTop: 0
			});
		};
    });
  });
</script>