<div class="row">
	<div class="col-md-12 column">
		<b>Edit Data Ahli Waris </b>
	</div>
</div>

<div class="row">
	<div class="col-md-12 column ">
		<label class="col-md-4 control-label no-padding-right">Hubungan</label>
		<div class="col-md-8">
			<label class="col-md-3 control-label no-padding-right" for="form-field-1">Hubungan : </label>
			<?php $hub = array(
				'0' => 'N/A',
				'1' => 'Suami',
				'2' => 'Istri',
				'3' => ' Anak', 
				'4' => ' Kakak',
				'5' => ' Adik',
				'6' => ' Ayah',
				'7' => ' Ibu', 
				'8' => 'Paman',
				'9' => ' Bibi',
				'10' => 'Kakek',
				'11' => 'Nenek', 
				);
			echo $this->Form->input('hub_aw', array('options'=>$hub, 'label'=>false)); 
			?>
		</div>
	</div>
</div>