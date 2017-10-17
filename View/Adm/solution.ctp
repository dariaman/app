
<div class="page-header">
	<h1>
		<i class="fa fa-angle-double-right"></i>
		Find Solution<span id="cust_tipe_title"></span>

	</h1>
</div>

<br/>

<?php echo $this->Session->flash('good', array('element' => 'success'));?>
<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
<table class="table">
	<?php 
	$tableHeaders =  $this->Html->tableHeaders(array(
		'No', 
		'Picture',
		'Name of Product',
		'Question 1 (Status Marital)',
		'Question 2 (Tanggungan)',
		'Question 3 (Protection)',
		)); 
	echo $this->Form->create('Product',array('class'=>'form-horizontal','role'=>'form','type' => 'file'));
	$this->Form->inputDefaults(array('label' => false));
	?>
	<thead>
		<?php echo  $tableHeaders ?>
	</thead>
	<tbody>
		<?php $n=1; $i=0;
		foreach ($prods as $user): 
			?>
		<tr>
			<td>
				<?php echo $n; ?>
			</td>
			<td>
				<?php if($user['Product']['picture']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/prod/'.$user['Product']['picture']).'">'.$this->Html->image('prod/small_'.$user['Product']['picture'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'100'));
				echo $this->Form->hidden('Product.'.$i.'.id',array('default'=>$user['Product']['id'])); 
				?> 
			</td>

			<td>
				<?php echo $user['Product']['name'] ; ?>
			</td>
			<td>
				<!--  -->
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question1_1',array('value'=>'1','hiddenField' => false,'default'=>$user['Product']['question1'][0])); ?>
				Lajang, Belum Menikah</label>
				<br>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question1_2',array('value'=>'2','hiddenField' => false,'default'=>$user['Product']['question1'][2])); ?>
				Menikah</label>

				<?php //echo $this->Form->checkbox('Product.'.$i.'.question1',array('empty'=>'Undefined','options'=>array('1'=>'Lajang, Belum Menikah','2'=>'Menikah'),'default'=>$user['Product']['question1'])); ?>
			</td>
			<td>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question2_1',array('value'=>'1','hiddenField' => false,'default'=>$user['Product']['question2'][0])); ?>
				Tidak Ada</label>
				<br>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question2_2',array('value'=>'2','hiddenField' => false,'default'=>$user['Product']['question2'][2])); ?>
				Anak</label>
				<br>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question2_3',array('value'=>'3','hiddenField' => false,'default'=>$user['Product']['question2'][4])); ?>
				Orang Tua</label>
				<?php //echo $this->Form->input('Product.'.$i.'.question2',array('empty'=>'Undefined','options'=>array('1'=>'Tidak Ada','2'=>'Anak','3'=>'Orang Tua'),'default'=>$user['Product']['question2'])); ?>
			</td>
			<td>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question3_1',array('value'=>'1','hiddenField' => false,'default'=>$user['Product']['question3'][0])); ?>
				Kesehatan</label>
				<br>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question3_2',array('value'=>'2','hiddenField' => false,'default'=>$user['Product']['question3'][2])); ?>
				Perlindungan Saat Bepergian</label>
				<br>
				<label>
				<?php echo $this->Form->checkbox('Product.'.$i.'.question3_3',array('value'=>'3','hiddenField' => false,'default'=>$user['Product']['question3'][4])); ?>
				Hari Tua</label>
				<?php //echo $this->Form->input('Product.'.$i.'.question3_1',array('empty'=>'Undefined','options'=>array('1'=>'Kesehatan','2'=>'Perlindungan Saat Bepergian','3'=>'Hari Tua'),'default'=>$user['Product']['question3'])); ?>
			</td>
		</tr>
		<?php $n++; $i++; endforeach; ?>
	</tbody>
</table>
<br/>
<button type="submit" class="btn btn-purple btn-sm">
	Update All
	<i class="fa fa-save icon-on-right bigger-110"></i>
</button>
</form>

<script type="text/javascript">
$(document).ready(function(){

	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
          mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
          image: {
          	verticalFit: true
          },
          zoom: {
          	enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

});
</script>