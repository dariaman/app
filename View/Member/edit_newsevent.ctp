			<div class="page-header">
							<h1>
								<a href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'news_event'))?>">News Event</a>
								<small>
									<i class="fa fa-angle-double-right"></i>
									  Edit News Event
								</small>
							</h1>
			</div>
			
			
			<div class="row">
				<div class="col-md-12 column">
					<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
					 <?php echo $this->Form->create('News',array('class'=>'form-horizontal','role'=>'form','type' => 'file'));
							$this->Form->inputDefaults(array(
					'class' => 'span6',
					'label' => false,
				));
					 ?>
								
								<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Type</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('type', array('options' => array('news'=>'News','event'=>'Event'), 'required'=>'required')); ?>
										</div>
									</div>
						<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Publish</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('publish', array('options' => array(1=>'Yes',0=>'No'), 'required'=>'required')); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Title*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('title', array('placeholder' => __('Title'), 'required'=>'required','class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Content*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('content', array('placeholder' => __('Content') ,'class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Picture</label>

										<div class="col-md-10">
											
											<?php 
											if($det_news['News']['picture']!=null) echo $this->Html->image("/img/news/".$det_news['News']['picture'],array('width'=>'60','height'=>'60')); else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'60'));
											echo '<br/><br/>'.$this->Form->file('picture', array('class'=>'btn btn-sm')); ?>
											
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
											<a class="btn btn-sm btn-info" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'news_event')); ?>">
												<i class="fa fa-reply fa-fw"></i>
												Back
											</a>
										</div>
									</div>

									

								</form>
					
				</div>
			</div>
		