
<div >
				<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
					<a class="btn btn-sm btn-aqi" type="button" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'add_user')); ?>" >
						<i class="fa fa-plus"></i> Add User
					</a>	 
				</div>
				 
 <br/> 

			<table class="table">
			<?php $tableHeaders =  $this->Html->tableHeaders(array(
				'No',
				$this->Paginator->sort('name','Name'),
				$this->Paginator->sort('email','Username'),
				$this->Paginator->sort('suspended','Suspended'),
				$this->Paginator->sort('role','Role'),
				'Edit',
				'Delete',
			)); ?>
				<thead>
					<?php echo  $tableHeaders ?>
				</thead>
				<tbody>
				<?php $n=intval($this->Paginator->counter('{:start}'));
				foreach ($users as $user): 
				?>
				<tr class="<?php if($user['User']['suspended']!='1') echo "error"; ?>">
						<td>
							<?php echo $n; ?>
						</td>
						<td>
							<?php echo $user['User']['name']; ?>
						</td>
						<td>
							<?php echo $user['User']['email']; ?>
						</td>
						<td>
						<center><?php if($user['User']['suspended']=='1') echo "Yes"; else echo "No"; ?></center>
						</td>
						<td>
							<?php echo ucwords($user['User']['role']); ?>
						</td>
						<td>
						<?php echo $this->Html->link('Click Here',array('controller'=>'adm','action'=>'edit_user',$user['User']['id']),
	array('class'=>'btn btn-info btn-sm')); ?>
						</td>
						<td>
						<?php echo $this->Form->postLink('Delete',array('controller'=>'adm','action'=>'del_user',$user['User']['id']),
	array('class'=>'btn  btn-sm btn-danger'),'Are you sure to delete user '.$user['User']['name'].'?'); ?>
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
