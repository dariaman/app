			<div class="page-header">
							<h1>
								Edit
								<small>
									<i class="fa fa-angle-double-right"></i>
									  User
								</small>
							</h1>
			</div>
			
			
			<div class="row">
				<div class="col-md-12 column">
					<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
					 <?php echo $this->Form->create('User',array('class'=>'form-horizontal','role'=>'form','novalidate' => true));
							$this->Form->inputDefaults(array(
					'class' => 'span6',
					'label' => false,
				));
					 ?>
								
								<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Name*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('name', array('placeholder' => __('Name'),'type'=>'text','required'=>'required','class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Email*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('email', array('placeholder' => __('Email'),'type'=>'email','required'=>'required','class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Password**</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('password', array('placeholder' => __('Password'),'type'=>'password','required'=>'required','class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Re-type Password**</label>

										<div class="col-md-10">
										
											<?php echo $this->Form->input('password_confirmation', array('placeholder' => __('Re-type Password'),'type'=>'password','required'=>'required','class'=>'col-xs-10 col-md-5')); ?>
											
										</div>
									</div>		
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Status</label>

										<div class="col-md-10">
								
											<?php 	echo $this->Form->input('suspended',array('class'=>'span3','options' => array('0'=>'Active','1'=>'Suspended'))); ?>
										</div>
									</div>		
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Role</label>

										<div class="col-md-10">
								
											<?php 	echo $this->Form->input('role',array('class'=>'span3','options' => array('admin'=>'System Admin'))); ?>
										</div>
									</div>		

									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1"></label>

										<div class="col-md-10">
											<label class="col-md-10 no-padding-left" for="form-field-1">**)Please leave field blank if you don't want to change</label>
											
										</div>
									</div>	
									
									<div class="hr hr-24"></div>
									
									<div class="clearfix">
										<div class="col-md-offset-2 col-md-10">
											<button class="btn btn-sm btn-success" type="submit">
												<i class="fa fa-check fa-fw"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<a class="btn btn-sm btn-info" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'user')); ?>">
												<i class="fa fa-reply fa-fw"></i>
												Back
											</a>
										</div>
									</div>

									

								</form>
					
				</div>
			</div>
		