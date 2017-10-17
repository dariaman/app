
<div class="page-header">
							<h1>
								<i class="fa fa-angle-double-right"></i>
								Product<span id="cust_tipe_title"></span>
					
							</h1>
</div>
<div >
				<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
					<a class="btn btn-sm btn-aqi" type="button" href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'add_product')); ?>" >
						<i class="fa fa-plus"></i> Add Product
					</a>	 
				</div>
<br/>
 
 
	 
		 <?php echo $this->Form->create('url',array('type'=>'get','url'=>array('controller'=>'adm','action'=>'products'),'class'=>'form-horizontal','role'=>'form','class'=>'form-search'));
							$this->Form->inputDefaults(array(
					'class' => 'span6',
					'label' => false,'div'=>false
				));
					 ?>
 <div class="col-xs-12 col-sm-8">
			  <?php echo $this->Form->input('cat_id', array('default'=>$cat_id,'empty'=>'--Filter by Category--','options' => $list_cat, 'class'=>'input-search')); ?>
			 <br/> 
			 <div class="input-group">
				 <input name="search_title" type="text" value="<?php echo $s_id;?>" class="form-control search-query input-search" placeholder="Search Name">
					 <span class="input-group-btn">
						 <button type="submit" class="btn btn-purple btn-sm">
							 Search
							 <i class="aqi-icon fa fa-search icon-on-right bigger-110"></i>
						  </button>
					 </span>
				 </div>
		 </div>
			 </form>

<br/>	

			
	
			<table class="table">
			<?php 
			$tableHeaders =  $this->Html->tableHeaders(array(
				'No', 
				'Picture',
				$this->Paginator->sort('Category.name','Category'),
				$this->Paginator->sort('name','Name'),
				$this->Paginator->sort('short_desc','Short Desc'),
				'Table Premium',
				$this->Paginator->sort('publish','Publish'),
				'Action',
			)); 
			?>
				<thead>
					<?php echo  $tableHeaders ?>
				</thead>
				<tbody>
				<?php $n=intval($this->Paginator->counter('{:start}'));
				foreach ($prods as $user): 
				?>
				<tr>
						<td>
							<?php echo $n; ?>
						</td>
						<td>
							<?php if($user['Product']['picture']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/prod/'.$user['Product']['picture']).'">'.$this->Html->image('prod/small_'.$user['Product']['picture'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'100'));?> 
						</td>
						
						<td>
							<?php echo $user['Category']['name'] ; ?>
						</td>
						
						<td>
							<?php echo $user['Product']['name'] ; ?>
						</td>
						
						<td>
							<?php echo $user['Product']['short_desc'] ; ?>
						</td>
						<td>
							<?php if($user['Product']['pic_premium_table']!=null) echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/prod/'.$user['Product']['pic_premium_table']).'">'.$this->Html->image('prod/small_'.$user['Product']['pic_premium_table'],array('width'=>'50px','height'=>'50px')).'</a>'; else echo $this->Html->image("/img/news/no_img.jpg",array('width'=>'60','height'=>'100'));?> 
						</td>
						<td><?php if($user['Product']['publish']=='1') echo $this->Html->image("/img/icons/tick.png"); else echo $this->Html->image("/img/icons/cross.png"); ?></td>
						<td>
						<?php echo $this->Html->link('Edit',array('controller'=>'adm','action'=>'edit_product',$user['Product']['id']),
	array('class'=>'btn btn-sm btn-info')); ?>
						</td>
					
					   
				</tr>
				<?php $n++; endforeach; ?>
				</tbody>
			</table>
				<center>
					<ul class="pagination">
					<?php $this->Paginator->options(array(
							'url' => array(
							'sort' => 'email', 'direction' => 'desc', 'page' => 2,
					'lang' => 'en' )
						));?>
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