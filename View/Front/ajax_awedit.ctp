<?php
 echo $this->Form->create('edithub',array('url'=>array('action'=>'edithub','controller'=>'front'),'class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>true));?>
<div class="row">
	<div class="col-md-12 column">


		<label class="col-md-2 control-label no-padding-right">Nama </label>
		<label class="col-md-1 control-label no-padding">:</label>
		<div class="col-md-8">

			<label class="control-label no-padding"><?php echo $data_aw['PROSPECT_NAME']; ?>
				<?php echo $this->Form->input('idaw', array('value'=>$id, 'type' => 'hidden')); ?>
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 column">
		<label class="col-md-2 control-label no-padding-right">Hubungan</label>
		<label class="col-md-1 control-label no-padding">:</label>
		<div class="col-md-8">
			<?php echo $this->Form->input('RELATIONSHIP_ID', array('options'=>$hub,'default'=>$data_aw['RELATIONSHIP_ID'], 'label'=>false, 'div'=>false)); ?>	
		</div>
	</div>
</div>
<div class="modal-footer">							 
<!-- 	<button type="button" class="btn btn-submit" data-dismiss="modal">Batal</button> 
 -->	<input type="submit" class="btn btn-primary"  Text="Simpan" ></input>
</div>
</form>	