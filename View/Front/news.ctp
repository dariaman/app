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

<!--news list v1.3-->
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
							</h2></center>
						</div>

					</div>
				
					<?php foreach ($news as $ns): ?>
					
<div class="desc-proc col-md-6 col-lg-6" style="height:200px;">
	<div class="row" >
		<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'newsdetail','id'=>$ns['News']['seo']))?>">
			<div class=" col-md-6 col-lg-6 col-xs-12" style="padding-top:20px">							
 				<?php if($ns["News"]['picture']==""){ ?>
					<img style="max-height:180px" alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   class="img-responsive ">
				<?php }else{ ?>
					<img style="max-height:180px" alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $ns['News']['picture'];?>" class="img-responsive "/>
				<?php } ?>
			</div>
			<div class=" col-md-6 col-lg-6 col-xs-12">
				<div class="text"  style="font-weight: bold;padding-top:20px;"><?php echo $ns['News']['title'];?></div>
		</a>		
				<div class="text" style="font-size:12px;margin-top:5px;" ><?php echo $ns["News"]['short_desc'] ?></div>
			</div>
		
	</div><!--div row-->
</div>
					<?php endforeach ?>

<!-- start paging-->
<section id="paging">

		<div class="paging" style="margin-left:45px;text-align:center;">
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
<!--end news list v1.3-->

