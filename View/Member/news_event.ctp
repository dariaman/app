
<div >
				<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
					<a class="btn btn-sm btn-aqi" type="button" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'add_newsevent')); ?>" >
						<i class="fa fa-plus"></i> Add News Event
					</a>	 
				</div>
<br/>

			
	
			<table class="table">
			<?php 
			$tableHeaders =  $this->Html->tableHeaders(array(
				'No',
				'Picture',
				$this->Paginator->sort('type','Type'),
				$this->Paginator->sort('title','Title'),
				$this->Paginator->sort('content','Content'),
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
				<tr class="<?php if($user['News']['publish']!=1)   echo "danger"; ?>">
						<td>
							<?php echo $n; ?>
						</td>
						<td>
							<?php if($user['News']['picture']!=null) echo $this->Html->image("/img/news/small_".$user['News']['picture'],array('width'=>'40','height'=>'40')); else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'40','height'=>'40'));?>
						</td>
						<td>
							<center><?php echo ucwords($user['News']['type']); ?></center>
						</td>
						<td>
							<?php echo $user['News']['title']; ?>
						</td>
						<td>
							<?php echo html_entity_decode($this->Text->truncate(Sanitize::html($user['News']['content'], array('remove' => true)), 250,array('ellipsis' => '...','exact' => false,'html' => true)));
					?>
						</td>
						<td>
							<?php echo date('d M Y', strtotime($user['News']['created'])); ?>
						</td>
						<td><center><?php if($user['News']['publish']=='1') echo $this->Html->image("/img/icons/tick.png"); else echo $this->Html->image("/img/icons/cross.png"); ?></center></td>
						<td>
						<?php echo $this->Html->link('Edit',array('controller'=>'adm','action'=>'edit_newsevent',$user['News']['id']),
	array('class'=>'btn btn-sm')); ?>
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
