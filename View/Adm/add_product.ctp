			<div class="page-header">
							<h1>
								Add
								<small>
									<i class="fa fa-angle-double-right"></i>
									  Product
								</small>
							</h1>
			</div>
			
			
			<div class="row">
				<div class="col-md-12 column">
					<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
					 <?php echo $this->Form->create('Product',array('novalidate' => true,'class'=>'form-horizontal','role'=>'form','type' => 'file'));
							$this->Form->inputDefaults(array(
					'class' => 'span6',
					'label' => false,
				));
					 ?>
					
								<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Name of Product*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('name', array('required'=>'required','class'=>'col-xs-10 col-md-8','required'=>'required')); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Category</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('category_id', array('options' => $list_cat, 'required'=>'required','empty'=>'Choose Category')); ?>
										</div>
									</div>
									
								<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Publish</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('publish', array('options' => array(1=>'Yes',0=>'No'), 'required'=>'required')); ?>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Short Description*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('short_desc', array('required'=>'required','class'=>'col-xs-10 col-md-8','required'=>'required')); ?>
										</div>
									</div>
									
									
									
							 		<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Content*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('content', array('placeholder' => __('Content') ,'class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Karakteristik*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('karakteristik', array('placeholder' => __('Karakteristik') ,'class'=>'col-xs-10 col-md-5')); ?>
										</div>
									</div>		
									<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Manfaat*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('manfaat', array('required'=>'required','class'=>'col-xs-10 col-md-8','required'=>'required')); ?>
										</div>
									</div>
                  <!--<div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Suitable For*</label>

										<div class="col-md-10">
											<?php echo $this->Form->input('suitable_prod', array('required'=>'required','class'=>'col-xs-10 col-md-8','required'=>'required')); ?>
										</div>
									</div>-->
									
									 <div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Upload Image Premium Table</label>
										<div class="col-md-10">
											<?php echo $this->Form->file('file_img2', array('label'=>false,'id'=>'file_browse2'));  ?>
										</div>
									</div>
									
									 <div class="form-group">
										<label class="col-md-2 control-label no-padding-right" for="form-field-1">Upload Image Product</label>
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
											<a class="btn btn-sm btn-info" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'products')); ?>">
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
var file2 = document.getElementById('file_browse2');
file2.onchange = function(e){
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
		