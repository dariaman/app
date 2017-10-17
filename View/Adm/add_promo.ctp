<div class="page-header">
	<h1>
		Add
		<small>
			<i class="fa fa-angle-double-right"></i>
			Promo
		</small>
	</h1>
</div>

<div class="row">
	<div class="col-md-12 column">
		<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
		<?php echo $this->Form->create('Promo',array('novalidate' => true,'class'=>'form-horizontal','role'=>'form','type' => 'file'));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,));?>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Promo Title*</label>
			<div class="col-md-10">
				<?php echo $this->Form->input('promo_title', array('placeholder' => __('Content') ,'class'=>'col-xs-10 col-md-5')); ?>
			</div>
		</div>
    <div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Target Link</label>
			<div class="col-md-10">
				<?php echo $this->Form->input('target_url', array('placeholder' => __('http://sample.com') ,'class'=>'col-xs-10 col-md-5')); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Open Link in New Tab</label>
			<div class="col-md-10">
				<?php echo $this->Form->input('new_tab', array('options' => array(1=>'Yes',0=>'No'), 'required'=>'required')); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Landing Page Banner</label>
			<div class="col-md-10">
				<?php echo $this->Form->file('img_promo_bilboard', array('label'=>false,'id'=>'billboard'));  ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Promo Billboard</label>
			<div class="col-md-10">
				<?php echo $this->Form->file('img_promo_homepage', array('label'=>false,'id'=>'homepage'));  ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Promo Detail</label>
			<div class="col-md-10">
				<?php echo $this->Form->file('img_promo_detail', array('label'=>false,'id'=>'detail'));  ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Deleted</label>
			<div class="col-md-10">
				<?php echo $this->Form->input('deleted', array('options' => array(0=>'No',1=>'Yes'), 'required'=>'required')); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">Start Date</label>
			<div class="col-md-10">
			<?php echo $this->Form->input('start_date', array('label'=>false,'id'=>'start_date'));  ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label no-padding-right" for="form-field-1">End Date</label>
			<div class="col-md-10">
			<?php echo $this->Form->input('end_date', array('label'=>false,'id'=>'end_date'));  ?>
			</div>
		</div>
		<div class="clearfix">
			<div class="col-md-offset-2 col-md-10">
				<button class="btn btn-sm btn-success" type="submit">
					<i class="fa fa-check fa-fw"></i>
					Save
				</button>
				&nbsp; &nbsp; &nbsp;
				<a class="btn btn-sm btn-info" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'promo')); ?>">
					<i class="fa fa-reply fa-fw"></i>
					Back
				</a>
			</div>
		</div>
		<?php echo $this->form->end ?>
	</div>
</div>
