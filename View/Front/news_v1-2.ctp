<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">News</li>
		</ol>
		<!--<div class="mainvisual">
 
		</div>-->
	</div>
</div>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="artikelList">

		<!-- news -->
		<section id="news">
				<div class="row">
					<div class="desc-proc col-md-12 col-lg-12">
						<div class="clearfix">
							<center><h2 class="title-content">
								BERITA JAGADIRI
							</h2></center	>
						</div>

					</div>
				
					<?php foreach ($news as $ns): ?>
					<div class="desc-proc col-md-4 col-lg-4" style="height:550px">

					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'newsdetail','id'=>$ns['News']['seo']))?>">
					<div class="desc-proc col-md-6 col-lg-6">
							
 						<?php 
	                                      if($ns["News"]['picture']==""){ ?>
	                                      	<img alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   class="img-responsive ">
		                              <?php }else{ ?>
	                                       	<img alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $ns['News']['picture'];?>" class="img-responsive "/>
	                                      <?php } ?>

							
					</div>
					<div class="desc-proc col-md-6 col-lg-6">
						<h3 class="title-berita"><?php echo $ns['News']['title'];?></h3>
						<section class="hidden-xs">
						<p class="title-berita"><?php echo $ns['News']['short_desc'];?></p>
						<!--<button>Lanjutkan Membaca</button>-->
						</section>
	
					</div>

					</a>
					</div>

					<?php endforeach ?>

<!-- start paging-->
<section id="paging">

		<div class="paging" style="margin-left:45px;">
			<?php
			echo $this->Paginator->prev(
			' < Sebelumnya ', array(), null, array('class' => 'prev
			disabled')
			);
			echo $this->Paginator->numbers(array('separator' => ' | '));
			echo $this->Paginator->next(
			' Selanjutnya >', array(), null, array('class' => 'next
			disabled')
			);
			?>
		</div>
</section>		
<!-- end paging-->
				</div>
			
		</section>
		<!-- End news -->

		</div>
	</div>
</div>

======================
<div class="row">
	
<!--content-->
	<div class="col-sm-8 col-md-9 col-lg-9">
	
		
<!--		
////////////////////////////////////////////////////////////
<section id="list-artikel">
	<table>
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('title','Title'); ?></th>
			<th><?php echo $this->Paginator->sort('konten','Konten'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Tanggal Dibuat');?></th>
		
		</tr>
	</thead>
	<tbody>
		<?php foreach ($news as $ns): ?>
		<tr>
			<th><?php echo $ns['News']['id'];?></th>
			<th><?php echo $ns['News']['title'];?></th>
			<th><?php echo $ns['News']['content'];?></th>
			<th><?php echo $ns['News']['created'];?></th>
		</tr>
		<?php endforeach ?>
	</tbody>
	</table>
</section>		
/////////////////////////////////////////////
-->


<!-- news -->
		<section id="news">
				<div class="row">
					<div class="desc-proc col-md-12 col-lg-12">
						<div class="clearfix">
							<h2 class="title-content">
								<span class="pull-left icon-product-list"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kesehatan.png" alt="accidental icon" /></span>News
							</h2>
						</div>
						<p class="review-product">
							Kabar Terkini
						</p>
					</div>
				
					<?php foreach ($news as $ns): ?>
					<div class="desc-proc col-md-12 col-lg-12">

					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'newsdetail','id'=>$ns['News']['seo']))?>">
					<div class="desc-proc col-md-3 col-lg-3">
							
 						<?php 
	                                      if($ns["News"]['picture']==""){ ?>
	                                      	<img alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   class="img-responsive ">
		                              <?php }else{ ?>
	                                       	<img alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $ns['News']['picture'];?>" class="img-responsive "/>
	                                      <?php } ?>

							
					</div>
					<div class="desc-proc col-md-9 col-lg-9">
						<h3 class="title-berita"><?php echo $ns['News']['title'];?></h3>
						<section class="hidden-xs">
						<p class="title-berita"><?php echo $ns['News']['short_desc'];?></p>
						<button>Lanjutkan Membaca</button>
						</section>
	
					</div>

					</a>
					</div>

					<?php endforeach ?>

<!-- start paging-->
<section id="paging">

		<div class="paging" style="margin-left:45px;">
			<?php
			echo $this->Paginator->prev(
			' < Sebelumnya ', array(), null, array('class' => 'prev
			disabled')
			);
			echo $this->Paginator->numbers(array('separator' => ' | '));
			echo $this->Paginator->next(
			' Selanjutnya >', array(), null, array('class' => 'next
			disabled')
			);
			?>
		</div>
</section>		
<!-- end paging-->
				</div>
			
		</section>
		<!-- End news -->

</div>
<!--end content-->

<!--<?php //foreach ($artikel as $ns): ?>
<div class="row">
	
	<div class="carousel-inner">
		
					<a href="" ><H2><?php echo $ns['News']['title'];?></h2></a>			
	</div>
</div>
<?php //endforeach ?>-->

	<!--sidebar-->
	<div class="col-sm-4 col-md-3 col-lg-3">
		<?php echo $this->element('front/sidebar'); ?>
	</div>
	<!--end sidebar-->
</div>