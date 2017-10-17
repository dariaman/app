<div class="page-header">
	<h1>
		<i class="fa fa-angle-double-right"></i>
		Promo<span id="cust_tipe_title"></span>
	</h1>
</div>
<div >
	<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
	<a class="btn btn-sm btn-aqi" type="button" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'add_promo')); ?>" >
		<i class="fa fa-plus"></i> Add Promo
	</a>	 
</div>
<br/>
<?php echo $this->Form->create('url',array('type'=>'get','url'=>array('controller'=>'adm','action'=>'promo'),'class'=>'form-horizontal','role'=>'form','class'=>'form-search'));
// $this->Form->inputDefaults(array( 'class' => 'span6', 'label' => false,'div'=>false 	));	?>
<div class="col-xs-12 col-sm-8">
	<div class="input-group">
		<input name="search_title" type="text" value="" class="form-control search-query input-search" placeholder="Search Promo Name">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-purple btn-sm">
				Search
				<i class="aqi-icon fa fa-search icon-on-right bigger-110"></i>
			</button>
		</span>
	</div>
</div>
<?php echo $this->Form->end(); ?>
<br/>
<table class="table">
	<?php 
	$tableHeaders =  $this->Html->tableHeaders(array(
		'No', 
		$this->Paginator->sort('Promo.promo_title','Promo Title'),
    'Target Link',
		'Landing Page Banner','Promo Billboard','Promo Detail',
		$this->Paginator->sort('start_date','Start Date'),
		$this->Paginator->sort('end_date','End Date'),
    'Published',
    $this->Paginator->sort('modified','Last Update'),
    'Updated By',
		'Action'
		)); 
		?>
		<thead>
			<?php echo  $tableHeaders ?>
		</thead>
		<tbody>
			<?php $n=intval($this->Paginator->counter('{:start}'));	foreach ($promos as $pr): ?>
			<tr>
				<td>
					<?php echo $n; ?>
				</td>
				<td>
					<?php echo $pr['Promo']['promo_title'] ?>
				</td>
        <td>
          <?php echo ($pr['Promo']['target_url']!=null)?$pr['Promo']['target_url']:'No Link'; ?>
        </td>
				<td>
					<?php if($pr['Promo']['img_promo_bilboard']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/prom/'.$pr['Promo']['img_promo_bilboard']).'">'.$this->Html->image('prom/'.$pr['Promo']['img_promo_bilboard'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'100'));?> 
				</td>
				<td>
					<?php if($pr['Promo']['img_promo_homepage']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage']).'">'.$this->Html->image('prom/'.$pr['Promo']['img_promo_homepage'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'100'));?> 
				</td>
				<td>
					<?php if($pr['Promo']['img_promo_detail']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/prom/'.$pr['Promo']['img_promo_detail']).'">'.$this->Html->image('prom/'.$pr['Promo']['img_promo_detail'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'100'));?> 
				</td>
				<td>
					<?php echo $pr['Promo']['start_date']?>
				</td>
				<td>
					<?php echo $pr['Promo']['end_date'] ?>
				</td>
				<td>
					<?php if($pr['Promo']['deleted']=='0') echo $this->Html->image("/img/icons/tick.png"); else echo $this->Html->image("/img/icons/cross.png"); ?>
				</td>
        <td><?php echo $pr['Promo']['modified'] ?></td>
        <td><?php echo $pr['Promo']['modified_by'] ?></td>
				<td>
					<?php echo $this->Html->link('Edit',array('controller'=>'adm','action'=>'edit_promo',$pr['Promo']['id']),
					array('class'=>'btn btn-sm btn-info')); ?>
					<?php echo $this->Html->link('Delete',array('controller'=>'adm','action'=>'del_promo',$pr['Promo']['id']),
					array('class'=>'btn btn-sm btn-danger')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

