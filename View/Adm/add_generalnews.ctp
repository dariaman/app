			<div class="page-header">
							<h1>
								Add
								<small>
									<i class="fa fa-angle-double-right"></i>
									  News
								</small>
							</h1>
			</div>
			
			
			<div class="row">
				<div class="col-md-12 column">
					<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
					 <?php echo $this->Form->create('News',array('novalidate' => true,'class'=>'form-horizontal','role'=>'form','type' => 'file'));
							$this->Form->inputDefaults(array(
					'class' => 'span6',
					'label' => false,
				));
					 ?>
					
								<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Title*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('title', array('required'=>'required','class'=>'col-xs-10 col-md-8','required'=>'required')); ?>
										</div>
									</div>
									
								<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Publish</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('publish', array('options' => array(1=>'Yes',0=>'No'), 'required'=>'required')); ?>
										</div>
									</div>
									
							 		<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Content*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('content', array('placeholder' => __('Content') ,'class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Short Desc*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('short_desc', array('placeholder' => __('Content') ,'class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>
									 <div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Upload Image</label>
										<div class="col-md-10">
											<?php echo $this->Form->file('file_img', array('label'=>false,'id'=>'file_browse'));  ?>
										</div>
									</div>
									 
									
								 	

<div class="hr hr-24"></div>
									
									<div class="clearfix">
										<div class="col-md-offset-2 col-md-10">
											<button class="btn btn-sm btn-success" type="submit">
												<i class="fa fa-check fa-fw"></i>
												Save
											</button>

											&nbsp; &nbsp; &nbsp;
											<a class="btn btn-sm btn-info" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'generalnews')); ?>">
												<i class="fa fa-reply fa-fw"></i>
												Back
											</a>
										</div>
									</div>

									

								</form>
					
				</div>
			</div>
			
<script type="text/javascript"> 
$(document).ready(function() { 
var file = document.getElementById('file_browse');
file.onchange = function(e){
    var ext = this.value.match(/\.([^\.]+)$/)[1];
    switch(ext)
    {
        case 'jpg':
            break;
		case 'png':
            break;
		case 'JPG':
            break;
		case 'PNG':
            break;
        default:
            alert('only jpg/png file that be allowed');
            this.value='';
    }
};
});
</script>
		