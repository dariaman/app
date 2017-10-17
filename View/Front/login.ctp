<div class="widget-box login-front">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">Home</a></li>
				<li class="active">Login</li>
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
								<li class="pull-right hidden-xs"><h2 class="title-help"><span class="bold">Butuh bantuan? ?</span></h2></li>
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
				<span class="bold red">Member Login</span>
			</h2>
		</div>
		<hr class="redline">
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h1 class="login-title">
			<span class="bold">Anda pemegang polis <span class="red bold">JAGADIRI</span>? silahkan <span class="red bold">LOGIN</span></span>
		</h1>
		<p class="text-center">Kami telah mengirimkan informasi login ke email yang Anda gunakan untuk membeli produk JAGADIRI.</p><br /><br />
		<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
		<?php echo $this->Session->flash('success', array('element' => 'success'));?>
		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'front','action'=>'login','?'=>$this->request['url']),'role'=>'form','class'=>'form-horizontal')); ?>

		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][email]" type="email" id="form-field-1" placeholder="Email" class="form-control " required="required" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][password]" type="password" id="form-field-1" placeholder="Password" class="form-control " required="required" />
			</div>
		</div>
		<div class="form-group">
			<span class="col-sm-offset-4 col-sm-4">
				<?php foreach($captcha_fields as $index => $captcha) {
					echo $this->Html->image($captcha . '.jpg', array('id' => $captcha)).' ';
					echo $this->Html->link('reload image &#x21bb;', '#', array('class' => 'reload', 'escape' => false));
				} 
				?>
			</span>
		</div>
		<div class="form-group">
			<span class="col-sm-offset-4 col-sm-4">
				<?php echo $this->Form->input('captcha',array('placeholder'=>'Captcha','class'=>'form-control','required'=>'required','div'=>false,'label'=>false)); ?>
			</span>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'forgot_password'))?>"><p class="forgot text-right"><span class="bold red">Lupa Password</span></p></a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<center><button class="btn-login" type="submit" id="submit-loginbtn"><i class="icon-key bigger-110"></i>Masuk</button></center>
			</div>
		</div></form>
	</div>
</div>
</div>

<?php
$this->Js->get('.reload')->event('click',
	"$(this).prev().attr('src', $(this).prev().attr('src') + '?' + new Date().getTime())"
	);
?><?php echo $this->Js->writeBuffer(); ?>
<script type="text/javascript">
	$('#submit-loginbtn').on('click', function() {
    	ga('send', 'event', 'member', 'click', 'submit login'); 
    });
</script>