

<div class="row">
	<div class="col-md-12">
		<h1 class="login-title">
			<span class="bold">Administrator <span class="red bold">Login</span></span>
		</h1>
		<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
		
		<?php echo $this->Form->create('User',array('role'=>'form','class'=>'form-horizontal')); ?>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][email]" type="email" id="form-field-1" placeholder="Email" class="form-control" required="required" />						</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-4">
					<input name="data[User][password]" type="password" id="form-field-1" placeholder="Password" class="form-control" required="required" />
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
				<div class="col-sm-offset-4 col-sm-4">
					<?php echo $this->Form->input('captcha',array('placeholder'=>'Captcha','class'=>'form-control','required'=>'required','div'=>true,'label'=>false)); ?>					</div>
				</div>
			
				<br />
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
						<center><button type ="submit" class="btn-login">Login</button></center>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	$this->Js->get('.reload')->event('click',
		"$(this).prev().attr('src', $(this).prev().attr('src') + '?' + new Date().getTime())"
		);
	?><?php echo $this->Js->writeBuffer(); ?>