
<div class="page-header">
							<h1>
								<i class="fa fa-angle-double-right"></i>
								News<span id="cust_tipe_title"></span>
					
							</h1>
</div>
<div >
				<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
					<a class="btn btn-sm btn-aqi" type="button" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'add_generalnews')); ?>" >
						<i class="fa fa-plus"></i> Add News
					</a>	 
				</div>
<br/>

			
	
			<table class="table">
			<?php 
			$tableHeaders =  $this->Html->tableHeaders(array(
				'No', 
				'Picture',
				$this->Paginator->sort('title','Title'),
				$this->Paginator->sort('created','Posting Date'),
				$this->Paginator->sort('publish','Publish'),
				'Action',
			)); 
			?>
				<thead>
					<?php echo  $tableHeaders ?>
				</thead>
				<tbody>
				<?php $n=intval($this->Paginator->counter('{:start}'));
				foreach ($news as $user): 
				?>
				<tr>
						<td>
							<?php echo $n; ?>
						</td>
							<td>
							<?php if($user['News']['picture']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/news/'.$user['News']['picture']).'">'.$this->Html->image('news/small_'.$user['News']['picture'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'50','height'=>'50'));?> 
						</td>
					 
						<td>
							<?php echo $user['News']['title'] ; ?>
						</td>
						
						<td>
							<?php echo date('d M Y', strtotime($user['News']['created'])); ?>
						</td>
						<td><?php if($user['News']['publish']=='1') echo $this->Html->image("/img/icons/tick.png"); else echo $this->Html->image("/img/icons/cross.png"); ?></td>
						<td>
						<?php echo $this->Html->link('Edit',array('controller'=>'adm','action'=>'edit_generalnews',$user['News']['id']),
	array('class'=>'btn btn-sm btn-info')).' '.$this->Form->postLink('Delete',array('controller'=>'adm','action'=>'del_gennews',$user['News']['id']),array('class'=>'btn btn-sm btn-danger'),'Are you sure to delete '.html_entity_decode($this->Text->truncate(Sanitize::html($user['News']['content'], array('remove' => true)), 50,array('ellipsis' => '...','exact' => false,'html' => true))).'?'); ?>
						</td>
					
					   
				</tr>
				<?php $n++; endforeach; ?>
				</tbody>
			</table>
				<center>
					<ul class="pagination">
						<?php echo $this->Paginator->first('<< ' . __('first'), array('tag' => 'li'),'<a>First</a>', array('tag' => 'li','escape'=>false)); ?>
						<?php echo $this->Paginator->prev(' < ' . __('prev'), array('tag' => 'li'),'<a>Prev</a>', array('tag' => 'li','escape'=>false)); ?>
						<?php echo $this->Paginator->numbers(array('tag'=>'li','separator'=>'','currentTag'=>'a',
						'currentClass'=>'active')); ?>
						<?php echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li'),'<a>Next</a>', array('tag' => 'li','escape'=>false)); ?>
						<?php echo $this->Paginator->last(__('last') . ' >>', array('tag' => 'li'),'<a>Last</a>', array('tag' => 'li','escape'=>false)); ?>
					</ul>
					
				</center>
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