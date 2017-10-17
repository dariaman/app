<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">Perlindungan Anda</li>
		</ol>
		<!--<div class="mainvisual">
 
		</div>-->
	</div>
</div>
<div class="row">
	<!--sidebar-->
	<div class="col-sm-4 col-md-3 col-lg-3">
		<?php echo $this->element('front/sidebarprod'); ?>
	</div>
	<!--end sidebar-->
	<!--content-->
	<div class="col-sm-8 col-md-9 col-lg-9">
	<?php $appProd=array('jaga-sehat-plus','jaga-sehat-keluarga','jaga-sehat-dbd','jaga-aman-instan','jaga-aman','jaga-jiwa','jaga-aman-plus5','jaga-aman-plus7','jaga-jiwa-plus5','jaga-jiwa-plus7','jaga-motorku'); ?>
<!-- Health -->
<section id="health">
	<div class="prod-boxed box-product">
		<div class="row">
			<div class="desc-proc col-md-12 col-lg-12">
				<div class="clearfix">
					<h2 class="title-content">
						<span class="pull-left icon-product-list"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kesehatan.png" alt="accidental icon" /></span> Kesehatan
					</h2>
				</div>
				<p class="review-product">
					Asuransi kesehatan Anda banyak syaratnya? Jangan khawatir, produk ini memberi benefit lebih dengan proses cashless. Bukan zamannya lagi bawa uang tunai atau reimbursement ke rumah sakit!
				</p>
			</div>
			<?php foreach ($health as $hl): ?>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				<?php if($hl['Product']['quote_id']=='jaga-sehat-plus'):?>
				<!-- icon Best Seller -->
				<div class="best-seller">
					<img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
				</div>
				<?php endif;?>
				<div class="carousel-inner">
					<div class="item active">
						<img alt="Produk <?php echo $hl['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $hl['Product']['picture'] ?>" />
						<div class="carousel-caption-product">
							<h4 class="title-cap-product-list">
								<?php echo $hl['Product']['name'] ?>
							</h4>
						</div>
					</div>
					<p class="review-product">
						<?php echo $hl['Product']['short_desc'] ?>
					</p><br />
					<center>
						<div class="row">
							<div class="col-md-6">
								<a href="<?php 
									if($hl['Product']['cat_quote']=='non-unit-link'){
									  $act = 'step1_non_unitlink';
									}else{
									  $act = 'step1_unitlink';
									}
									if(in_array($hl['Product']['quote_id'], $appProd)){
									echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$hl['Product']['quote_id'])); 
									}
									else{
									echo "#";
									}
								?>">
									<button type="button" class="btn btn-default2">
									<?php if(in_array($hl['Product']['quote_id'], $appProd)):?>
										Beli Sekarang
										<?php else: ?>
										Segera Hadir
										<?php endif; ?>
									</button>
								</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$hl['Product']['seo']))?>">
									<button type="button" class="btn btn-info  btn-info-custom">
										<span class="bold">Lihat Detail</span>
									</button>
								</a>
							</div>	
						</div>
					</center>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- End Health -->
		

<!-- Live -->
<section id="life">
	<div class="prod-boxed box-product">
		<div class="row">
			<div class="desc-proc col-md-12 col-lg-12">
				<div class="clearfix"><h2 class="title-content">
					<span class="pull-left icon-product-list"><img src="<?php echo $this->Html->url("/");?>img/icon-product/jiwa.png" alt="accidental icon" /></span> Jiwa
					</h2>
				</div>
				<p class="review-product">
					Lindungi kebahagiaan diri Anda dan keluarga tercinta dengan produk ini. Proses aplikasi mudah, langsung disetujui. Kebahagiaan hidup di depan mata, priceless!
				</p>
			</div>
			<?php foreach ($life as $lf): ?>
				<?php if($lf['Product']['quote_id']!='jaga-jiwa-plus7'):?>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<?php if($lf['Product']['quote_id']=='jaga-jiwa-plus5'):?>
      <!-- icon Best Seller -->
      <div class="best-seller">
        <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
      </div>
      <?php endif;?>
			<div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $lf['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $lf['Product']['picture'] ?>"  />
					<div class="carousel-caption-product">
						<h4 class="title-cap-product-list">
							<?php echo $lf['Product']['name'] ?>
						</h4>
					</div>
				</div>
				<p class="review-product">
					<?php echo $lf['Product']['short_desc'] ?>
				</p><br />
				<center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php 
            if($lf['Product']['cat_quote']=='non-unit-link'){
              $act = 'step1_non_unitlink';
            }else{
              $act = 'step1_unitlink';
            }
            if(in_array($lf['Product']['quote_id'], $appProd)){
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$lf['Product']['quote_id'])); 
            }
            else{
            echo "#";
            }
          ?>">
            <button type="button" class="btn btn-default2"><?php if(in_array($lf['Product']['quote_id'], $appProd)):?>
            Beli Sekarang
            <?php else: ?>
            Segera Hadir
            <?php endif; ?></button>
          </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$lf['Product']['seo']))?>"><button type="button" class="btn btn-info  btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
          </div>
        </div></center>
			</div>
		</div>
    <?php endif;?>
	<?php endforeach ?>
</div>
</div>
</section>
<!-- End Live --><!-- accidental -->
		<section id="accidental">
			<div class="prod-boxed box-product">
				<div class="row">
					<div class="desc-proc col-md-12 col-lg-12">
						<div class="clearfix"><h2 class="title-content">
							<span class="pull-left icon-product-list"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kecelakaan.png" alt="accidental icon" /></span> Kecelakaan
						</h2>
					</div>
					<p class="review-product">
						Perlindungan diri dari segala bentuk kecelakaan, cocok untuk Anda yang mobile dan gemar travelling
					</p>
				</div>
				<?php foreach ($acc as $ac): ?>
        <?php if($ac['Product']['quote_id']!='jaga-aman-plus7'):?>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<?php if($ac['Product']['quote_id']=='jaga-aman-instan'):?>
          <!-- icon Best Seller -->
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
          </div>
          <?php elseif($ac['Product']['quote_id']=='jaga-aman-plus5'):?>
          <!-- icon Best Seller -->
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
          </div>
          <?php endif;?>
          <div class="carousel-inner">
						<div class="item active">
							<img alt="Produk <?php echo $ac['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $ac['Product']['picture'] ?>" />
							
              <div class="carousel-caption-product">
								<h4 class="title-cap-product-list">
									<?php echo $ac['Product']['name'] ?>
								</h4>
							</div>
						</div>
						<p class="review-product">
							<?php echo $ac['Product']['short_desc'] ?>
						</p><br />
						<center>
            <div class="row">
              <div class="col-md-6">
                <a href="<?php 
                  if($ac['Product']['cat_quote']=='non-unit-link'){
                    $act = 'step1_non_unitlink';
                  }else{
                    $act = 'step1_unitlink';
                  }
                  if(in_array($ac['Product']['quote_id'], $appProd)){
                  echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$ac['Product']['quote_id'])); 
                  }
                  else{
                  echo "#";
                  }
                ?>">
                  <button type="button" class="btn btn-default2"><?php if(in_array($ac['Product']['quote_id'], $appProd)):?>
                  Beli Sekarang
                  <?php else: ?>
                  Segera Hadir
                  <?php endif; ?></button>
                </a>
              </div>
              <div class="col-md-6">
                <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ac['Product']['seo']))?>"><button type="button" class="btn btn-info  btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
              </div>
            </div></center>
					</div>
				</div>
        <?php endif;?>
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- End accidental -->
<!-- Plus -->
<section id="unit">
	<div class="prod-boxed box-product">
		<div class="row">
			<div class="desc-proc col-md-12 col-lg-12">
				<div class="clearfix"><h2 class="title-content">
					<span class="pull-left icon-product-list"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" alt="accidental icon" /></span> Plus Investasi
				</h2>
			</div>
			<p class="review-product">
				Menabung tidak pernah menyenangkan seperti ini! Selain mendapatkan manfaat investasi, Anda juga langsung terlindungi. Tidak hanya itu, biayanya tidak membebani, sesuai keinginan Anda.
			</p>
		</div>
		<?php foreach ($investa as $iv): ?>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $iv['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $iv['Product']['picture'] ?>" />
					<div class="carousel-caption-product">
						<h4 class="title-cap-product-list">
							<?php echo $iv['Product']['name'] ?>
						</h4>
					</div>
				</div>
				<p class="review-product">
					<?php echo $iv['Product']['short_desc'] ?>
				</p><br />
				<center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php 
            if($iv['Product']['cat_quote']=='non-unit-link'){
              $act = 'step1_non_unitlink';
            }else{
              $act = 'step1_unitlink';
            }
            if(in_array($iv['Product']['quote_id'], $appProd)){
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$iv['Product']['quote_id'])); 
            }
            else{
            echo "#";
            }
          ?>">
            <button type="button" class="btn btn-default2"><?php if(in_array($iv['Product']['quote_id'], $appProd)):?>
            Beli Sekarang
            <?php else: ?>
            Segera Hadir
            <?php endif; ?></button>
          </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$iv['Product']['seo']))?>"><button type="button" class="btn btn-info btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
          </div>
        </div></center>
			</div>
		</div>
	<?php endforeach ?>
</div>
</div>
</section>
<!-- End Plus -->


<!-- General -->
<section id="general">
	<div class="prod-boxed box-product">
		<div class="row">
			<div class="desc-proc col-md-12 col-lg-12">
				<div class="clearfix"><h2 class="title-content">
					<span class="pull-left icon-product-list"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" alt="accidental icon" /></span> General 
				</h2>
			</div>
			<p class="review-product">
				Asuransi tidak pernah menyenangkan seperti ini! Selain mendapatkan manfaat asuransi kendaraan, Anda juga langsung terlindungi. Tidak hanya itu, biayanya tidak membebani, sesuai keinginan Anda.
			</p>
		</div>

		<?php foreach ($general as $ge): ?>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $ge['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $ge['Product']['picture'] ?>" />
					<div class="carousel-caption-product">
						<h4 class="title-cap-product-list">
							<?php echo $ge['Product']['name'] ?>
						</h4>
					</div>
				</div>
				<p class="review-product">
					<?php echo $ge['Product']['short_desc'] ?>
				</p><br />
				<center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php 
            if($ge['Product']['cat_quote']=='non-unit-link'){
              $act = 'step1_non_unitlink';
            }else{
              $act = 'step1_unitlink';
            }
            if(in_array($ge['Product']['quote_id'], $appProd)){
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$ge['Product']['quote_id'])); 
            }
            else{
            echo "#";
            }
          ?>">
            <button type="button" class="btn btn-default2"><?php if(in_array($ge['Product']['quote_id'], $appProd)):?>
            Beli Sekarang
            <?php else: ?>
            Segera Hadir
            <?php endif; ?></button>
          </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ge['Product']['seo']))?>"><button type="button" class="btn btn-info btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
          </div>
        </div></center>
			</div>
		</div>
	<?php endforeach ?>
</div>
</div>
</section>
<!-- End General -->

</div>
<!--end content-->
</div>

<!--===========================================================================================================================================-->
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">Perlindungan Anda</li>
		</ol>
		<!--<div class="mainvisual">
 
		</div>-->
	</div>
</div>
<div class="row">
	<div class="col-md-9">
		<img alt="header list produk" src="<?php echo $this->Html->url("/");?>img/newicon/header-produk.png" class="img-responsive">
		<br>
		<img alt="asuransi kesehatan" src="<?php echo $this->Html->url("/");?>img/newicon/kesehatan-03.jpg" class="img-responsive">
		<br>
		<?php foreach ($health as $hl): ?>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				<?php if($hl['Product']['quote_id']=='jaga-sehat-plus'):?>
				<!-- icon Best Seller -->
				<div class="best-seller">
					<img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
				</div>
				<?php endif;?>
				<div class="carousel-inner">
					<div class="item active">
						<img alt="Produk <?php echo $hl['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $hl['Product']['picture'] ?>" />
						<div class="carousel-caption-product">
							<h4 class="title-cap-product-list">
								<?php echo $hl['Product']['name'] ?>
							</h4>
						</div>
					</div>
					<p class="review-product">
						<?php echo $hl['Product']['short_desc'] ?>
					</p><br />
					<center>
						<div class="row">
							<div class="col-md-6">
								<a href="<?php 
									if($hl['Product']['cat_quote']=='non-unit-link'){
									  $act = 'step1_non_unitlink';
									}else{
									  $act = 'step1_unitlink';
									}
									if(in_array($hl['Product']['quote_id'], $appProd)){
									echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$hl['Product']['quote_id'])); 
									}
									else{
									echo "#";
									}
								?>">
									<button type="button" class="btn btn-default2">
									<?php if(in_array($hl['Product']['quote_id'], $appProd)):?>
										Beli Sekarang
										<?php else: ?>
										Segera Hadir
										<?php endif; ?>
									</button>
								</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$hl['Product']['seo']))?>">
									<button type="button" class="btn btn-info  btn-info-custom">
										<span class="bold">Lihat Detail</span>
									</button>
								</a>
							</div>	
						</div>
					</center>
				</div>
			</div>
			<?php endforeach ?>
		<br><br>
		<img alt="asuransi kecelakaan" src="<?php echo $this->Html->url("/");?>img/newicon/kesehatan-07.jpg" class="img-responsive">
		<br>
			<?php foreach ($acc as $ac): ?>
        <?php if($ac['Product']['quote_id']!='jaga-aman-plus7'):?>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<?php if($ac['Product']['quote_id']=='jaga-aman-instan'):?>
          <!-- icon Best Seller -->
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
          </div>
          <?php elseif($ac['Product']['quote_id']=='jaga-aman-plus5'):?>
          <!-- icon Best Seller -->
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
          </div>
          <?php endif;?>
          <div class="carousel-inner">
						<div class="item active">
							<img alt="Produk <?php echo $ac['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $ac['Product']['picture'] ?>" />
							
              <div class="carousel-caption-product">
								<h4 class="title-cap-product-list">
									<?php echo $ac['Product']['name'] ?>
								</h4>
							</div>
						</div>
						<p class="review-product">
							<?php echo $ac['Product']['short_desc'] ?>
						</p><br />
						<center>
            <div class="row">
              <div class="col-md-6">
                <a href="<?php 
                  if($ac['Product']['cat_quote']=='non-unit-link'){
                    $act = 'step1_non_unitlink';
                  }else{
                    $act = 'step1_unitlink';
                  }
                  if(in_array($ac['Product']['quote_id'], $appProd)){
                  echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$ac['Product']['quote_id'])); 
                  }
                  else{
                  echo "#";
                  }
                ?>">
                  <button type="button" class="btn btn-default2"><?php if(in_array($ac['Product']['quote_id'], $appProd)):?>
                  Beli Sekarang
                  <?php else: ?>
                  Segera Hadir
                  <?php endif; ?></button>
                </a>
              </div>
              <div class="col-md-6">
                <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ac['Product']['seo']))?>"><button type="button" class="btn btn-info  btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
              </div>
            </div></center>
					</div>
				</div>
        <?php endif;?>
			<?php endforeach ?>
		<br><br>
		<img alt="asuransi jiwa" src="<?php echo $this->Html->url("/");?>img/newicon/jiwa-06.jpg" class="img-responsive">
		<br>
				<?php foreach ($life as $lf): ?>
				<?php if($lf['Product']['quote_id']!='jaga-jiwa-plus7'):?>
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<?php if($lf['Product']['quote_id']=='jaga-jiwa-plus5'):?>
      <!-- icon Best Seller -->
      <div class="best-seller">
        <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
      </div>
      <?php endif;?>
			<div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $lf['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $lf['Product']['picture'] ?>"  />
					<div class="carousel-caption-product">
						<h4 class="title-cap-product-list">
							<?php echo $lf['Product']['name'] ?>
						</h4>
					</div>
				</div>
				<p class="review-product">
					<?php echo $lf['Product']['short_desc'] ?>
				</p><br />
				<center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php 
            if($lf['Product']['cat_quote']=='non-unit-link'){
              $act = 'step1_non_unitlink';
            }else{
              $act = 'step1_unitlink';
            }
            if(in_array($lf['Product']['quote_id'], $appProd)){
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$lf['Product']['quote_id'])); 
            }
            else{
            echo "#";
            }
          ?>">
            <button type="button" class="btn btn-default2"><?php if(in_array($lf['Product']['quote_id'], $appProd)):?>
            Beli Sekarang
            <?php else: ?>
            Segera Hadir
            <?php endif; ?></button>
          </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$lf['Product']['seo']))?>"><button type="button" class="btn btn-info  btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
          </div>
        </div></center>
			</div>
		</div>
    <?php endif;?>
	<?php endforeach ?>
		<br><br>
		<img alt="asuransi flexi link" src="<?php echo $this->Html->url("/");?>img/newicon/flexy-08.jpg" class="img-responsive">
		<br>
		<?php foreach ($investa as $iv): ?>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $iv['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $iv['Product']['picture'] ?>" />
					<div class="carousel-caption-product">
						<h4 class="title-cap-product-list">
							<?php echo $iv['Product']['name'] ?>
						</h4>
					</div>
				</div>
				<p class="review-product">
					<?php echo $iv['Product']['short_desc'] ?>
				</p><br />
				<center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php 
            if($iv['Product']['cat_quote']=='non-unit-link'){
              $act = 'step1_non_unitlink';
            }else{
              $act = 'step1_unitlink';
            }
            if(in_array($iv['Product']['quote_id'], $appProd)){
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$iv['Product']['quote_id'])); 
            }
            else{
            echo "#";
            }
          ?>">
            <button type="button" class="btn btn-default2"><?php if(in_array($iv['Product']['quote_id'], $appProd)):?>
            Beli Sekarang
            <?php else: ?>
            Segera Hadir
            <?php endif; ?></button>
          </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$iv['Product']['seo']))?>"><button type="button" class="btn btn-info btn-info-custom"><span class="bold">Lihat Detail</span></button></a>
          </div>
        </div></center>
			</div>
		</div>
	<?php endforeach ?>
		
	</div>
	<div class="col-md-3">
		<div class=" col-sm-12 col-xs-12">
		<img alt="icon list produk" src="<?php echo $this->Html->url("/");?>img/newicon/produk-02.png" class="img-responsive">
		</div>
	</div>
</div>