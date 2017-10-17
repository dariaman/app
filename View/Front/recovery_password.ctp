<div class="widget-box login-front">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">Home</a></li>
				<li class="active">Recovery Password</li>
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
				<span class="bold red">Recovery Password</span>
			</h2>
		</div>
		<hr class="redline">
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h1 class="login-title">
			<span class="bold">Anda lupa password member  <span class="red bold">Anda</span>? Silahkan <span class="red bold">Ubah di sini</span></span>
		</h1>
		<br /><br />
		<?php echo $this->Session->flash('failure', array('element' => 'failure'));?>
		<?php echo $this->Session->flash('success', array('element' => 'success'));?>
		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'front','action'=>'recovery_password','?'=>$this->request['url']),'role'=>'form','class'=>'form-horizontal')); ?>

		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][password]" type="password" id="form-field-1" placeholder="Password" class="form-control " required="required" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][confirm_pass]" type="password" id="form-field-1" placeholder="Confirm Password" class="form-control " required="required" />
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<center><button class="btn-login" type="submit"><i class="icon-key bigger-110"></i>Login</button></center>
			</div>
		</div></form>
	</div>
</div>
</div>
