<div class="widget-box login-front">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">Home</a></li>
				<li class="active"><?php if ($status != 'Belum Berhasil') echo "Terima Kasih"; else echo "Mohon Maaf"; ?></li>
			</ol>
			<div class="mainvisual">
				<nav class="navbar navsecond" role="navigation">
					<div class="container">
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class=" navbar-collapse">
							<ul class="nav navbar-nav iwanto">
								<li class="fourth pull-right">
									<a href="/chat_with_us/chat?locale=id" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><span class="icon"><img src="<?php echo $this->Html->url("/");?>img/chat-icon.png" /></span> Chat with <span class="bold">Us</span></a>
								</li>
								<li class="pull-right hidden-xs"><h2 class="title-help"><span class="bold">Need Help ?</span></h2></li>
							</ul>
						</div>				<!-- /.navbar-collapse -->
					</div>					<!-- /.container -->
				</nav>
			</div>
		</div>
	</div>
	
<div class="row margintop">
		<div class="col-md-12">
			<div class="clearfix"><h1 class="title-login">
				<span class="bold red">
				<?php if(isset($prod)): ?>
				Pembelian Asuransi <?php echo strtoupper($prod); ?> Anda <?php echo $status; ?> 
				<?php else: ?>
				Pembayaran Premium Policy <?php echo strtoupper($premi); ?> Anda <?php echo $status; ?> 
				<?php endif; ?>
				</span>
			</h2>
		</div>
		<hr class="redline"/>
		<?php if ($status == 'Berhasil'): ?>
		TERIMA KASIH atas pembayaran Anda melalui Visa/Master Card. Transaksi Pembayaran Anda <?php echo $status; ?>
		<?php else: ?>
		<!--Mohon maaf transaksi Anda gagal. Silakan memeriksa folder inbox atau spam pada email untuk keterangan e-policy Anda.-->
    Mohon maaf, transaksi pembayaran Anda belum berhasil. Silakan mengulangi proses pembelian <?php echo strtoupper($prod); ?> kembali.<br/>Klik <a href="#" onClick="backtoPaymentPage(); return false;">disini</a> untuk kembali ke halaman pembelian.
		<?php endif; ?>
				<br>
        <?php if ($status == 'Berhasil'): ?>
				Klik <a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">disini</a> untuk kembali ke halaman utama 
        <?php else: echo ""; endif;?>
		<div class="clearfix"></div>
				
	</div>
</div>


</div>

<script type="text/javascript">
function postData(path, params, method) {
		method = method || "post";
		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", path);
		for(var key in params) {
			if(params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);
				form.appendChild(hiddenField);
			}
		}
		document.body.appendChild(form);
		form.submit();
	}
	
function backtoPaymentPage(){
	postData("<?php echo $this->Html->url(array('controller' =>'front', 'action'=>'step4_checkout','?'=>array('sid'=>$this->Session->read('Purchase.token'),'cat'=>$this->Session->read('Purchase.flow.cat'),'name'=>$this->Session->read('Purchase.flow.name')))); ?>",{
		"_method":'POST', 
		"data[_Token][key]":'<?php echo $this->Session->read('_Token.key'); ?>', 
		"data[Detail][PROSPECT_NAME]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_NAME'); ?>', 
		"data[Detail][PROSPECT_ADDRESS]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'); ?>', 
		"data[Detail][PROSPECT_EMAIL]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_EMAIL'); ?>', 
		"data[Detail][PROSPECT_MOBILE_PHONE]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE'); ?>', 
		"data[Detail][me]":'<?php echo $this->Session->read('Purchase.step2.me'); ?>', 
	});
}
</script>