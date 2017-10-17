			<div class="widget-box login-front">
											<div class="widget-header">
												<h4>AQI CMS</h4><br/>
												Admin Panel
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
			
													<?php echo $this->Form->create('User',array('role'=>'form','class'=>'form-horizontal')); ?>
									
									<div class="form-group">
										<div class="col-xs-12">
											<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user fa-fw"></i>
											</span>
											<input name="data[User][email]" type="email" id="form-field-1" placeholder="Email" class="col-xs-12" required="required" />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-xs-12">
											<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key fa-fw"></i>
											</span>
											<input name="data[User][password]" type="password" id="form-field-1" placeholder="Password" class="col-xs-12" required="required" />
											</div>
										</div>
									</div>
		<div class="form-group">
			 					
		<span class="col-md-5">
		<?php foreach($captcha_fields as $index => $captcha) {
        echo $this->Html->image($captcha . '.jpg', array('id' => $captcha)).' ';
        echo $this->Html->link('reload image &#x21bb;', '#', array('class' => 'reload', 'escape' => false));
		} 
		?>
		</span>
  <?php echo $this->Form->input('captcha',array('placeholder'=>'Captcha','class'=>'col-md-6','required'=>'required','div'=>false,'label'=>false)); ?>
</div>
														<button type="submit" class="btn btn-aqi btn-sm">
															<i class="icon-key bigger-110"></i>
															Login
														</button>
													</form>
												</div>
											</div>
											
											<?php
    $this->Js->get('.reload')->event('click',
        "$(this).prev().attr('src', $(this).prev().attr('src') + '?' + new Date().getTime())"
    );
?><?php echo $this->Js->writeBuffer(); ?>