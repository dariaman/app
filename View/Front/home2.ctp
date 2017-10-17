<!-- POPUP for survey or member -->
<?php if( $popupWindow == 'survey' ): ?>
    <style>
        input[type='checkbox'], input[type='radio'] { display: block; }
    </style>

    <div id="modalPolling" class="modal fade" role="dialog">
        <?php echo $this->Form->create(false, array('url' => '/survey/submit', 'class' => 'form-horizontal')); ?>
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">
                            <span class="big">Dari manakah Anda mengetahui <span class="peach">JAGADIRI?</span></span>
                        </h4>
                    </div>
                    <div id="sumberJagadiri" class="modal-body">
                            <?php foreach($sumberOptions as $key => $item): ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="sumber[]" value="<?php echo $key; ?>"> <?php echo $item; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                              
                            <div class="form-group">
                                <input type="text" name="lainnya" class="form-control" id="Lainnya" placeholder="Lainnya">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary center-block" onclick="submitPolling()">Kirim</button>
                    </div>
                </div>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>


    <div id="modalWarning" class="modal fade">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12" style="text-align:center">
                  <h4>Saran anda sangat kami hargai, mohon dapat meluangkan waktu sejenak untuk pilihan Anda dalam Survey kepuasan ini</h4>
                </div>
                <button type="button" class="btn btn-default center-block" onclick="hideModal('modalWarning')">OK</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  

    <div id="modalAlert" class="modal fade">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12" style="text-align:center">
                  <h4>Mohon untuk mengisi survey proses pembelian sebelum menutup layar windows</h4>
                </div>
              </div>
              <button type="button" class="btn btn-default center-block" onclick="hideModal('modalAlert')">OK</button>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php else: ?>
    <div id="myModal" class="modal fade" style="padding-top:7%;">
        <div class="modal-dialog">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="../img/close-btn.png"></button>
            <div class="modal-body">
              <div class="tabbable" id="tabs-353229">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#panel-5115362" data-toggle="tab"><span class="green big">Sudah Jadi Member JAGADIRI?</span> <!--<span class="peach">Klik disini</span>--></a>
                  </li>
                  <li>
                    <a href="#panel-8927592" data-toggle="tab"><span class="big">Mau Jadi <span class="peach">Member JAGADIRI?</span></span></a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active paddingtabe1" id="panel-5115362">
                    <div class="no-gap clearfix">
                        <div class="col-md-6">
                            <div class="row">
                                <!-- banner -->
                                <div class="banner-mgm">
                                    <img src="../img/mgm-banner.jpg">
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                            <div class="box-blue-2">
                              <div style="padding:20px 20px 5px;">
                                Rekomendasikan keluarga atau kerabat <br />Anda ke JAGADIRI
                              </div>
                              <div style="padding:10px 20px;">
                                <?php echo $this->Session->flash('flash2', array('element' => 'success'));?>
                                <?php echo $this->Form->create('Contactme',array('id'=>'Contactmerl','type' => 'post','novalidate'=>true)); ?>

                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <input type="text" name="data[Contactme][flash]" value="flash2" id="flash2" class="" hidden="hidden">
                                    <input type="text" name="data[Contactme][rekomendasi]" value="rekomendasi" id="rekomendasi" class="" hidden="hidden">
                                    <?php echo $this->Form->input('Contact_NameR', array('id'=>'namaR','validReqN'=>'true','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-8">
                                    <?php echo $this->Form->input('Contact_PhoneR', array('id'=>'phoneR','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>
                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_NameR2', array('id'=>'namaR2','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-8">
                                    <?php echo $this->Form->input('Contact_PhoneR2', array('id'=>'phoneR2','validNotelp'=>false,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>
                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_NameR3', array('id'=>'namaR3','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-8">
                                    <?php echo $this->Form->input('Contact_PhoneR3', array('id'=>'phoneR3','validNotelp'=>false,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>

                                  <?php echo $this->Session->flash('flashe', array('element' => 'emailerror'));?>
                                <!-- notifikasi email spesifik -->
                                <div class="alertmail alert alert-success alert-dismissable" style='display:none;'>
                                    Maaf Anda belum bisa mengikuti program ini karena belum menjadi member JAGADIRI, segera beli produk JAGADIRI untuk menjadi member.
                                </div>
                                <!-- end notifikasi email spesifik -->
                                <hr>
                                <div style="padding:10px 20px 5px;">
                                  Isi Data Diri Anda di sini !
                                </div>
                                <div class="form-group2 clearfix">
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_Name', array('id'=>'namarr','validReqN'=>'true','class'=>'form-control','placeholder'=>'Nama','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_Phone', array('id'=>'phonerr','validNotelp2'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'No. Handphone','label'=>false,'div'=>false, 'style'=>"width:95%;")); ?>
                                  </div>
                                  <div class="col-xs-4">
                                    <?php echo $this->Form->input('Contact_Email', array('id'=>'emailrr','validReqE'=>'true','validEmail'=>true, 'class'=>'form-control','placeholder'=>'Email','label'=>false,'div'=>false)); ?>
                                  </div>
                                </div>
                                <button type="submit" class="btn-hub"><span class="shadow" onclick="Validater_Form();">Kirim</span></button>
                                 <?php echo $this->Session->flash('flashbtn', array('element' => 'linkhome'));?>
                                 <a href="#" class="modal-linkpromo btn-hub"><span>Detail Promo</span></a>
                                <?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_Source', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_Daytime', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_Remark1', array( 'value'=>'Jaga Sehat Plus', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                                <?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="panel-8927592">
                      <div class="no-gap clearfix">
                        <div class="col-md-6">
                          <div class="box-blue">
                            <div style="padding:20px;" id="hideAfter">
                              <strong>SEGERA</strong> cari tahu <br />produk JAGADIRI yang sesuai dengan kebutuhan Anda agar dapat menjadi member
                            </div>
                            <div style="padding:10px 20px;">
                              <?php echo $this->Session->flash('flash3', array('element' => 'good'));?>
                              <?php echo $this->Form->create('Contactme',array('id'=>'Contactme','type' => 'post','novalidate'=>true)); ?>
                              <div class="form-group">
                                <input type="text" name="data[Contactme][flash]" value="flash3" id="flash3" class="" hidden="hidden">
                                <input type="text" name="data[Contactme][rekomendasi]" value="self" id="self" class="" hidden="hidden">
                                <?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','placeholder'=>'Nomor Handphone','label'=>false,'div'=>false)); ?>
                              </div>
                              <button type="submit" class="btn-hub" id="hideAfter1"><span class="shadow">Hubungi Saya</span></button>
                              <!-- hidden data -->
                              <?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_Source', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_Daytime', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_Remark1', array( 'value'=>'Jaga Sehat Plus', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                              <?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div style="padding:20px;">
                            <div class="col-xs-6">
                              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'tentangjagadiri'))?>"><button class="btn-green1">
                                <span class="icon2"><img src="../img/icon-1.png" class="hidden-xs" /></span>
                                <p class="judul">Proses Klaim</p>
                              </button></a>
                            </div>
                            <div class="col-xs-6">
                              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>"><button class="btn-pink">
                                <span class="icon2"><img src="../img/icon-2.png" class="hidden-xs" /></span>
                                <p class="judul">List Rumah Sakit</p>
                              </button></a>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div style="padding:20px;">
                            <div class="col-xs-6">
                              <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>"><button class="btn-green2">
                                <span class="icon2"><img src="../img/icon-3.png" class="hidden-xs" /></span>
                                <p class="judul">List Merchant Discount</p>
                              </button></a>
                            </div>
                            <div class="col-xs-6">
                              <a href="promo/promo-badung.htm"><button class="btn-green3">
                                <span class="icon2"><img src="../img/icon_gift.png" class="hidden-xs" /></span>
                                <p class="judul">Log In </p>
                              </button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    <!--<div class="mod-fot">
    <center><img src="../img/modal-footer.png" class="img-responsive" /></center>
    </div>-->
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php endif; ?>



<section id="intro" class="intro-section">
	<div class="container">
		<div class="carousel slide" id="carousel-194094">

			<div class="carousel-inner">
				<?php $a = 0; ?>
				<?php $i=1; foreach ($promo as $pr ): ?>
				<?php $a = $a + 1; ?>
				<div class="item <?php if($i==1) echo "active"; ?>">
					<?php if(isset($pr['Promo']['img_promo_detail']) AND ''!=$pr['Promo']['img_promo_detail']): ?>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'detail_promo','seo'=>$pr['Promo']['seo'])) ?>" target="_blank">
						<img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage'])?>" class="img-responsive">
						</a>
					<?php else: ?>
						<img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage'])?>" class="img-responsive">
					<?php endif; ?>
				</div>
				<?php $i=0; endforeach; ?>
		  
				<?php foreach($banners as $ban): ?>
				<?php $a = $a + 1; ?>
				<div class="item">
					<?php if($ban['Banner']['link']==''): ?>
					<img alt="<?php echo $ban['Banner']['alt'] ?>" src="<?php echo $this->Html->url('/img/banner/'.$ban['Banner']['picture']); ?>" class="img-responsive" />
					<?php else: ?>
					<a href="<?php echo $ban['Banner']['link'] ?>" target="<?php if($ban['Banner']['target_link']!=0) echo "_blank"; else echo '';?>" onClick="gaBannerCode(<?php echo $ban['Banner']['id']?>);"><img alt="Promo Jagadiri" src="<?php echo $this->Html->url('/img/banner/'.$ban['Banner']['picture']); ?>" class="img-responsive" /></a>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div> 

			<a data-slide="prev" href="#carousel-194094" class="left carousel-control"><img src="<?php echo $this->Html->url("/"); ?>img/left-arrow.png" /></a>
			<a data-slide="next" href="#carousel-194094" class="right carousel-control"><img src="<?php echo $this->Html->url("/"); ?>img/right-arrow.png" /></a> 
              
			  <ol class="home-i carousel-indicators p-indicator">
				<?php for ($x = 0; $x < $a; $x++) { $z = $x + 1;?>
					<?php if(1 == $x) { ?>
						<li data-target="#carousel-194094" data-slide-to="<?php echo $x; ?>" class="active"><?php echo $z; ?></li>
					<?php } else { ?>
						<li data-target="#carousel-194094" data-slide-to="<?php echo $x; ?>"><?php echo $z; ?></li>
					<?php } ?>
				<?php } ?>
              </ol>

		</div>
	</div>
</section>


<!-- About Section -->
<section id="about" class="about-section">
	<div class="container">
		<h2 class="title text-center">
			Produk terbaik dari <span class="peach">JAGADIRI</span>
		</h2>
  <!-- SEMI HARDCODE -->
  <?php 
    
    $prodHome=array(1=>array('picture'=>'product1.png','seo'=>'jaga-sehat-plus','active'=>0,'cat_quote'=>0),2=>array('picture'=>'product-jai.png','seo'=>'jaga-aman-instan','active'=>0,'cat_quote'=>0),3=>array('picture'=>'product6.png','seo'=>'jaga-jiwa-plus','active'=>0,'cat_quote'=>0),4=>array('picture'=>'product7.png','seo'=>'jaga-aman-plus','active'=>0,'cat_quote'=>1));
  ?>
	<div class="list-prod box-grey margintop2">
			<div class="row">
        <?php 
          $j=1;
          while($j<=4){
        ?>
				<div class="col-sm-6 col-md-3 col-lg-3 marginbottom">
					<!-- icon Best Seller -->
          <?php if($prodHome[$j]['seo']=='jaga-sehat-plus' || $prodHome[$j]['seo']=='jaga-aman-instan'):?>
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
          </div>
          <?php else: ?>
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
          </div>
          <?php endif;?>
          <div class="carousel-inner">
						<div class="item active">
							<a href="<?php if($prodHome[$j]['active']==0) echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$prodHome[$j]['seo'])); else echo '#';?>">	
								<img alt="Produk Jaga Sehat" src="<?php echo $this->Html->url("/");?>img/<?php echo $prodHome[$j]['picture']?>" />
							</a>
							<div class="carousel-caption-product">
								<h4 class="title-cap-home">
									<?php if($prodHome[$j]['seo']=='jaga-sehat-plus'):?>
                  Jaga Sehat<br />Plus
                  <?php elseif($prodHome[$j]['seo']=='jaga-aman-instan'):?>
                  Jaga Aman<br/>Instan
                  <?php elseif($prodHome[$j]['seo']=='jaga-jiwa-plus'):?>
                  Jaga Jiwa<br/>Plus
                  <?php else:?>
                  Jaga Aman<br/>Plus
                  <?php endif;?>
								</h4>
								
							</div>
						</div>
					</div>
					<p class="review-product content-box">
            <?php if($prodHome[$j]['seo']=='jaga-sehat-plus'):?>
            Perlindungan kesehatan yang memberi jaminan uang kembali, tanpa ribet! &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php elseif($prodHome[$j]['seo']=='jaga-aman-instan'):?>
            Langsung Aktif! Asuransi Kecelakaan Super Fleksibel &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php elseif($prodHome[$j]['seo']=='jaga-jiwa-plus'):?>
            Perlindungan jiwa semudah pinjam karena premi dikembalikan 110% jika tidak ada klaim!
            <?php else:?>
            Perlindungan kecelakaan plus pengembalian premi maksimum 110% jika tidak ada klaim!
            <?php endif;?>
						
					</p> <p>&nbsp;</p> 
					<center>
          <div class="row">
            <div class="col-xs-6">
            <a href="<?php if($prodHome[$j]['active']==0): 
            if($prodHome[$j]['cat_quote']==0){
              $act='step1_non_unitlink';
            }else{
              $act='step1_unitlink';
            } 
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$prodHome[$j]['seo'])); else: echo '#'; endif;?>" class="btn btn-default2" onClick="ga('send', 'event', { eventCategory: 'customer lead-home', eventAction: 'click', eventLabel: 'beli - jsp'});"><?php if($prodHome[$j]['active']==0) echo 'Beli Sekarang'; else echo 'Segera Hadir';?></a>
            </div><div class="col-xs-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$prodHome[$j]['seo']))?>" type="button" class="btn btn-default4">Lihat Detail</a>
            </div>
          </div></center>
				</div>
          <?php $j++; }  //endwhile?>
				</div>
		</div>
	</div>
</section>


<section>
	<div class="container">
		<div class="hub-say">
			<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
			<h5>Saya Mau</h5>
			<?php 
				echo $this->Form->create('Leavenumber',array('id'=>'Lnumber','class'=>' form-inline','role'=>'form','type' => 'post','novalidate'=>true)); 
				$this->Form->inputDefaults(array('label' => false));
				?>
				<div class="form-group col-sm-3">
					<select name="data[Leavenumber][Contact_Tipe]">
						<option value="Leads Homepage" selected>Melakukan Pembelian</option>
						<option value="info">Mencari Informasi Produk</option>
					</select>
				</div>
				<div class="form-group col-sm-3">
					<?php echo $this->Form->input('Contact_Name', array('id'=>'name', 'placeholder' => 'Nama', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
				</div>
				<div class="form-group col-sm-3">
					<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'placeholder' => 'Nomor Telepon', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
				</div>
				<div class="form-group col-sm-3">
					<button type="submit" class="btn-caf-blue" id="leave-numb-btn" onclick="Leave_Number();">Hubungi Saya</button>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</section>



<section>
	<div class="container">
		<div class="t-solusi">
			<div class="triangle-left">
				<img src="<?php echo $this->Html->url("/");?>img/triangle-left.png" />
			</div>
			<div class="main-t-solusi">
				<div class="desc-t">
					<h4>Kenali kebutuhan Anda</h4>
					<p>Kami akan membantu Anda untuk menentukan pilihan produk yang sesuai untuk kebutuhan Anda.</p>
				</div>
				<div class="laj">
					<img src="<?php echo $this->Html->url("/");?>img/laj.jpg" />
				</div>
				<div class="link-t">
					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>">Temukan<br />Solusi</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>



<section>
	<div class="container">
		<div class="services">
			<h2 class="title text-center">Mengapa <span class="peach">JAGADIRI</span> <span class="bold">berbeda</span> ?</h2>
			<div class="col-sm-6">
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why1-new.png" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Pembelian mudah & langsung</h5>
						<p class="content-new">Daftar asuransi tidak pernah semudah ini. Klik, bayar, langsung terlindungi!</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why2-new.png" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Klaim yang jelas dan transparan</h5>
						<p class="content-new">Mau klaim kok repot? Hanya di Jagadiri proses klaim tanpa ribet</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why3-new.png" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Jaminan harga terbaik!</h5>
						<p class="content-new">Bukan zamannya main rahasia-rahasiaan. Semua biaya dikupas tuntas</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="vide col-sm-6">
				<iframe src="//www.youtube.com/embed/exQ_n2vGDDA" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>


	<script type="">
		var getBannerCode='';
    
		jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Please Change +62 to 0 ");
	
		jQuery.validator.addMethod("validlength", function(value, element) {
			if(value.length >0 && value.length <8) return false;
			return true;
		}, "Please Enter Minimum 8 Digit Numbers. ");

		jQuery.validator.addMethod("validNotelp", function(value, element) {
			validno=[<?php foreach($allphone as $ph) {echo '"'.'0'.$ph['Val']['phone'].'",';} ?>];

			filme = value.substring(0, 3);
			if (filme == '021' || filme =='022' || filme =='024' || filme =='031' || filme == '061'){
				filmo = value.substring(0, 3);
			}
			else
			{
				filmo = value.substring(0, 4);
			}
			var a = validno.indexOf(filmo);

			if(a == -1 ) return false;
			return true;
		}, "Please Enter Valid Numbers. ");

		
    // validate the form when it is submitted
    var valLeaveNumb = $("#Lnumber").validate({
    	errorElement: "span",
    	errorPlacement: function(error, element) {
    		error.insertBefore(element);
    	}
    });
    $("#name").rules("add", {
    	required:true,
    	messages: {
    		required: "Please Enter Your Name."
    	}
    });
    $("#phone").rules("add", {
    	required:true,
    	number:true, 
    	messages: {
    		required: "Please Enter Your Phone Number",
    		number: "Please Enter Only Number"
    	}
    });
	
	
	
    //end leave number validation
    function Leave_Number(){
    	if(valLeaveNumb.form()) {
    		ga('send', 'event', { eventCategory: 'potential lead-home', eventAction: 'click', eventLabel: 'leave your number'});
    	}
    }
    
    function gaBannerCode(id){
      getBannerCode=id;
      if(getBannerCode==21)
        ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - home'});
      else
        ga('send', 'event', { eventCategory: 'lead to blog', eventAction: 'click', eventLabel: 'blog - home'});
    }

    $('#get-mobile-btn').on('click', function() {
    	ga('send', 'event', 'potential lead', 'click', 'install apps'); 
    });
    $('#get-gplay-apps').on('click', function() {
    	ga('send', 'event', 'potential lead', 'click', 'install apps'); 
    });
    $('#apply-btn').on('click', function() {
    	ga('send', 'event', 'customer', 'click', 'apply now - home'); 
    });
    $().ready(function(){
	//empty name and phone field
	document.getElementById("name").value = '';
	document.getElementById("phone").value = '';
});
</script>