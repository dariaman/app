<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product'))?>">Pilihan Produk</a></li>
			<li class="active"><?php echo $productdetail['Product']['name'] ?></li>
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
	<div class="modal fade" id="modalaw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Hubungi Saya</h4>
					
				</div>
				<?php echo $this->Form->create('Contactme',array('id'=>'Contactme','class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>true));
				$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); 



				?>
				<div class="modal-body">
					<!-- isi modal -->
					<p>Silahkan isi data dibawah ini dan agen kami akan segera menghubungi anda</p>
					<div class="form-group">

						<div class="col-md-3"><label class="control-label " >Nama </label></div>
						<div class="col-md-1"><label class="control-label " >: </label></div>
						<div class="col-md-6">
							<?php echo $this->Form->input('Contact_Name', array('id'=>'nama','class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3"><label class="control-label " >Email </label></div>
						<div class="col-md-1"><label class="control-label " >: </label></div>
						<div class="col-md-6">
							<?php echo $this->Form->input('Contact_Email', array('id'=>'email','class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3"><label class="control-label " >No.Telepon </label></div>
						<div class="col-md-1"><label class="control-label " >: </label></div>
						<div class="col-md-6">
							<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control')); ?>
						</div>
						
					</div>
					<!-- hidden data -->
					<?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Source', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Daytime', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Remark1', array( 'value'=>$productdetail['Product']['name'], 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); 

				if ($this->Session->check('Adv')){
				echo $this->form->hidden('Contactme.Contact_Optmzd_Id',array('value'=>$this->Session->read('Adv.optmzd_id') ));
				echo $this->form->hidden('Contactme.Contact_Gclid',array('value'=>$this->Session->read('Adv.gclid')  ));
				}

?>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Kirim" onsubmit="ContactMe(); return test();" ></input>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- modal box -->
<div class="col-sm-8 col-md-9 col-lg-9">
	<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
	<div class="row">
		<div class="col-md-4">
			<?php if($productdetail['Product']['quote_id']=='jaga-aman-instan' || $productdetail['Product']['quote_id']=='jaga-sehat-plus'):?>
      <!-- icon Best Seller -->
      <div class="best-seller">
        <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
      </div>
      <?php elseif($productdetail['Product']['quote_id']=='jaga-aman-plus5' || $productdetail['Product']['quote_id']=='jaga-jiwa-plus5'):?>
      <!-- icon Best Seller -->
      <div class="best-seller">
        <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png">
      </div>
      <?php endif;?>
      <div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $productdetail['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $productdetail['Product']['picture']?>" />
					<div class="carousel-caption-product">
						<h4 class="title-cap-detail">
							<!-- Jaga Sehat <br />Plus (HCP) -->
							<?php echo $productdetail['Product']['name'] ?>
						</h4>
						
					</div>
				</div>
			</div><br /> 
		</div>
		<div class="col-md-8">
			<h3 class="title-produk"><?php echo $productdetail['Product']['name'] ?></h3> 
			<h4 class="klas">Kategori : Asuransi <?php echo $productdetail['Category']['name']; ?></h4>
			 <p class="newreview">
           <?php if($productdetail['Product']['quote_id']=='jaga-aman-instan'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Pilihan periode perlindungan fleksibel mulai dari 3 jam hingga 1 tahun</li>
            <li><span class="peach-ondetail">+</span> Premi terjangkau mulai dari <span class="bold" style="color:#ee3a43">Rp 5000</span></li>
            <li><span class="peach-ondetail">+</span> Perlindungan termasuk olahraga ekstrim & penerbangan tidak terjadwal</li>
           </ul>
           <?php elseif($productdetail['Product']['quote_id']=='jaga-sehat-plus'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Mulai dari <span class="bold" style="color:#ee3a43">90 ribuan</span> per bulan*</li>
            <li><span class="peach-ondetail">+</span>  Jaminan uang kembali </li>
            <li><span class="peach-ondetail">+</span>  Layanan darurat 24 jam</li>
            <li><span class="peach-ondetail">+</span>  Gratis nonton di Blitzmegaplex</li>
            <li>(Kouta pemesanan Nonton Gratis adalah sejumlah 100 tiket untuk setiap tanggal penayangan dalam sehari)</li>

           
           </ul>

           <?php elseif($productdetail['Product']['quote_id']=='jaga-aman'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga ekonomis, premi mulai dari <span class="bold" style="color:#ee3a43">Rp 25 ribuan</span> per bulan</li>
            <li><span class="peach-ondetail">+</span>  Santunan meninggal dunia hingga <span class="bold" style="color:#ee3a43">Rp 100 Juta</span></li>
            <li><span class="peach-ondetail">+</span>  Santunan perawatan Rumah Sakit hingga <span class="bold" style="color:#ee3a43">Rp 10 Juta</span> per tahun</li>
            <li><span class="peach-ondetail">+</span>  Layanan darurat 24 Jam</li>
           </ul>
           <?php elseif($productdetail['Product']['quote_id']=='jaga-jiwa'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga ekonomis, premi mulai dari <span class="bold" style="color:#ee3a43">Rp 23 Ribuan</span> per bulan</li>
            <li><span class="peach-ondetail">+</span>  Santunan meninggal dunia hingga <span class="bold" style="color:#ee3a43">Rp 200 Juta</span></li>
            <li><span class="peach-ondetail">+</span> Perlindungan langsung aktif setelah pembayaran berhasil!</li>
           </ul>
           <?php elseif($productdetail['Product']['quote_id']=='jaga-sehat'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga terjangkau, mulai dari <span class="bold" style="color:#ee3a43">Rp 46 Ribuan</span></li>
            <li><span class="peach-ondetail">+</span>  Santunan harian RS + Santunan Pembedahan</li>
            <li><span class="peach-ondetail">+</span>  Diskon untuk pembelian tahunan dan keluarga</li>
            <li><span class="peach-ondetail">+</span>  Layanan darurat 24 Jam</li>
           </ul>
           <?php elseif($productdetail['Product']['quote_id']=='jaga-sehat-dbd'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga super irit, mulai dari <span class="bold" style="color:#ee3a43">Rp 10,000!</span></li>
            <li><span class="peach-ondetail">+</span>  Mudah dan langsung aktif</li>
            <li><span class="peach-ondetail">+</span>  Kadar trombosit kurang dari 130,000 sudah di-cover</li>
           </ul>
	
	<?php elseif($productdetail['Product']['quote_id']=='jaga-sehat-keluarga'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Satu premi untuk sekeluarga dengan harga terjangkau</li> 
            <li><span class="peach-ondetail">+</span> Perlindungan kesehatan termasuk rawat jalan</li>
            <li><span class="peach-ondetail">+</span> Tidak ada klaim? Tenang,kami kembalikan uang anda <span class="bold" style="color:#ee3a43"> 25%</span></li>
            <li><span class="peach-ondetail">+</span>  Gratis nonton di Blitzmegaplex</li>
            <li>(Kouta pemesanan Nonton Gratis adalah sejumlah 100 tiket untuk setiap tanggal penayangan dalam sehari)</li>
            
           </ul>
	<?php elseif($productdetail['Product']['quote_id']=='jaga-motorku'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Memberikan perlindungan ganda baik terhadap motor maupun Jiwa Anda dari resiko kecelakaan.</li> 
            <li><span class="peach-ondetail">+</span> Motor yang diasuransikan tidak harus motor baru dan tidak diperlukan pemeriksaan fisik saat proses pembelian.</li>
            <li><span class="peach-ondetail">+</span> Premi sangat terjangkau Rp. 13.000an perbulan.</li>
            <li><span class="peach-ondetail">+</span> Usia sepeda motor maksimal 10 tahun.</li>
           </ul>

           <?php elseif($productdetail['Product']['quote_id']=='caf-flexy-link'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Biaya akuisisi ringan, hanya 1X di awal kepesertaan!</li>
            <li><span class="peach-ondetail">+</span>  Tanpa medical check-up</li>
            <li><span class="peach-ondetail">+</span>  Santunan meninggal dunia hingga <span class="bold" style="color:#ee3a43">Rp 100 Juta</span></li>
           </ul>
           <?php else: ?>
           <span class="bold">
           <?php echo $productdetail['Product']['short_desc'] ?> 
           </span>
           <?php endif; ?>
      </p>
      <div class="row margintop3">
          <div class="col-sm-6">
          <?php $gaSend=array(1=>'jsp',2=>'ja',3=>'jj',4=>'cfl',5=>'dbd',6=>'jai',7=>'jap5',8=>'jap7',9=>'jjp5',10=>'jjp7',11=>'jsk', 12=>'jmk'); // ga code
		$appProd=array('jaga-sehat-plus','jaga-sehat-dbd','jaga-aman-instan','jaga-aman','jaga-jiwa','jaga-aman-plus5','jaga-aman-plus7','jaga-jiwa-plus5','jaga-jiwa-plus7','jaga-sehat-keluarga', 'jaga-motorku');?>
                
        <?php //if($productdetail['Product']['quote_id']!='jaga-jiwa-plus5' && $productdetail['Product']['quote_id']!='jaga-aman-plus5'):?>        
              <a href="<?php 
  			if($productdetail['Product']['cat_quote']=='non-unit-link'){
  				$act = 'step1_non_unitlink';
  			}else{
  				$act = 'step1_unitlink';
  			}
  			if(in_array($productdetail['Product']['quote_id'], $appProd)){
  			echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$productdetail['Product']['quote_id']));  
  			}
  			else{
  			echo "#";
  			}
  			?>" >
  			<button type="button" class="btn2 btn-app-neww" onClick="ga('send', 'event', { eventCategory: 'customer lead', eventAction: 'click', eventLabel: 'beli - <?php echo $gaSend[$productdetail['Product']['id']];?>'});">
  			<?php if(in_array($productdetail['Product']['quote_id'], $appProd)):?>
  			Beli Sekarang
  			<?php else: ?>
  			Segera Hadir
  			<?php endif ?>
  			</button></a>
        
        <?php //endif; ?>    
      
      <!-- If JJP show both JJP5 and JJP7 -->
      <!--<?php if($productdetail['Product']['quote_id']=='jaga-jiwa-plus5'):?>
        <a href="/get-a-quote-non-unit-link/jaga-jiwa-plus.htm">
        			<button onclick="ga('send', 'event', { eventCategory: 'customer lead', eventAction: 'click', eventLabel: 'beli - jjp5'});" class="btn2 btn-app-neww" type="button">
        						Beli Sekarang
        						</button></a>
      <?php endif; ?>-->
      
      <!-- If JAP show both JAP5 and JAP7 -->
      <!--<?php if($productdetail['Product']['quote_id']=='jaga-aman-plus5'):?>
        <a href="/get-a-quote-non-unit-link/jaga-aman-plus.htm">
        			<button onclick="ga('send', 'event', { eventCategory: 'customer lead', eventAction: 'click', eventLabel: 'beli - jap5'});" class="btn2 btn-app-neww" type="button">
        						Beli Sekarang
        						</button></a>
      <?php endif; ?>-->
      
			</div>
          <div class="col-sm-6">

<?php if($productdetail['Product']['id']==4 || $productdetail['Product']['id']==5 || $productdetail['Product']['id']==6):?>

<a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - home'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
<button type="button" class="btn2 btn-cont-neww">Tanya CS Kami</button>
</a>

<?php else:?>

	<button type="button" class="btn2 btn-cont-neww" <?php if($productdetail['Product']['id']==1):?> onClick="ga('send', 'event', { eventCategory: 'Bantu pembelian saya', eventAction: 'click', eventLabel: 'contact - jsp'});" <?php elseif($productdetail['Product']['id']==11):?> onClick="ga('send', 'event', { eventCategory: 'Bantu pembelian saya', eventAction: 'click', eventLabel: 'contact - jsk'});" <?php elseif($productdetail['Product']['id']==3):?> onClick="ga('send', 'event', { eventCategory: 'Bantu pembelian saya', eventAction: 'click', eventLabel: 'contact - jj'});"  <?php elseif($productdetail['Product']['id']==9 ||$productdetail['Product']['id']==10):?> onClick="ga('send', 'event', { eventCategory: 'Bantu pembelian saya', eventAction: 'click', eventLabel: 'contact - jjp'});" <?php elseif($productdetail['Product']['id']==2):?> onClick="ga('send', 'event', { eventCategory: 'Bantu pembelian saya', eventAction: 'click', eventLabel: 'contact - ja'});" <?php elseif($productdetail['Product']['id']==7||$productdetail['Product']['id']==8):?> onClick="ga('send', 'event', { eventCategory: 'Bantu pembelian saya', eventAction: 'click', eventLabel: 'contact - jap'});" <?php endif;?> data-toggle="modal" data-target="#modalaw" id="contactme-btn">Bantu Pembelian Saya</button>

<?php endif;?>
	  </div>
                    </div> 
					
		</div>
	</div>
	
	<div class="row">
                <div class="col-md-12">
                    <div class="box-title">
                        <span class="gothamblack">A. Deskripsi</span>
                    </div>
                    <div class="bg-content-des">
                        <p>
						
                        <span class="gotham">
							 <?php if($productdetail['Product']['quote_id']=='jaga-aman-instan'):?>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/OPm72nr_eUk" frameborder="0" allowfullscreen></iframe>
							<?php endif; ?>
							<?php echo $productdetail['Product']['content'] ?>
                        </span>
                        </p>
                    </div>
                </div>
             </div> 
	
	<div class="row">
		<div class="col-md-6">
			<div class="box-title">
				<span class="gothamblack">
				B. Informasi Umum</span>
			</div>
			<div class="bg-content-des ">
				<span class="gotham">
				<?php echo $productdetail['Product']['karakteristik'];  ?>
				</span>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box-title">
				<span class="gothamblack">
				C. Manfaat Produk <?php if($productdetail['Product']['quote_id']=='jaga-motorku'){ echo 'Dasar';} ?></span>
			</div>
			<div class="bg-content-des">
					<?php echo $productdetail['Product']['manfaat'] ?>
			</div>

			<?php if($productdetail['Product']['quote_id']=='jaga-motorku'){ ?>

				<!--<div class="box-title">
					<span class="gothamblack">
					Manfaat Produk Tambahan <i>(Optional)</i></span>
				</div>
				<div class="bg-content-des">
						<?php echo $productdetail['Product']['manfaat2'] ?>
				</div>-->

			<?php } ?>

		</div>
	</div> 


<?php if($productdetail['Product']['quote_id']=='jaga-motorku'){?>
        <center style="font-size:12px">PT Central Asia Financial dan PT Asuransi Allianz Utama Indonesia terdaftar dan diawasi oleh Otoritas Jasa Keuangan (OJK)</center>
<?php } ?>

		<div class="row margintop marginbottom">
			<div class="col-md-12">
				<h3 class="title-rekomen">
					Sudah menemukan produk yang cocok dengan Anda? <br />
					<span class="bold">Kami memiliki rekomendasi produk lainnya.</span>
				</h3>
			</div>
		</div>
		<div class="row marginbottom">
      <!-- in_array Product Apply -->
			<?php foreach ($allproduct as $ap): ?>
      <?php if(in_array($ap['Product']['quote_id'], $appProd)):?>
			<div class="col-sm-6 col-md-3 col-lg-3 marginbottom">
				<?php if($ap['Product']['quote_id']=='jaga-aman-instan' || $ap['Product']['quote_id']=='jaga-sehat-plus'):?>
        <!-- icon Best Seller -->
        <div class="best-seller-ondetail">
          <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
        </div>
        <?php endif;?>
        <div class="carousel-inner">
					<div class="item active">
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ap['Product']['seo']))?>">
						<img alt="" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $ap['Product']['picture'] ?>" alt="proudct" />
						</a>
						<div class="carousel-caption-product-detail">
							<h4 class="title-cap">
								<?php echo $ap['Product']['name'] ?>
							</h4>
						</div>
					</div>
				</div>
        <center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php if($ap['Product']['cat_quote']=='non-unit-link'){
				$act = 'step1_non_unitlink';
			}else{
				$act = 'step1_unitlink';
			}
      if(in_array($ap['Product']['seo'], $appProd)) echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$ap['Product']['quote_id'])); else echo "#";?>"><button type="button" class="btn btn-baru btn-default2"><?php if(in_array($ap['Product']['seo'], $appProd))echo "Beli Sekarang"; else echo "Segera Hadir"; ?></button>
            </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ap['Product']['seo']))?>"><button type="button" class="btn btn-baru btn-default3-baru">Lihat Detail</button>
            </a>
          </div>
        </div>
        </center>
			</div>
      <?php endif; ?>
      <?php endforeach; ?>
      
      <!-- Not in_array Product Apply -->
      <?php foreach ($allproduct as $ap): ?>
      <?php if(!in_array($ap['Product']['quote_id'], $appProd)):?>
      <div class="col-sm-6 col-md-3 col-lg-3 marginbottom">
				<?php if($ap['Product']['quote_id']=='jaga-aman-instan' || $ap['Product']['quote_id']=='jaga-sehat-plus'):?>
        <!-- icon Best Seller -->
        <div class="best-seller-ondetail">
          <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
        </div>
        <?php endif;?>
        <div class="carousel-inner">
					<div class="item active">
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ap['Product']['seo']))?>">
						<img alt="" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $ap['Product']['picture'] ?>" alt="proudct" />
						</a>
						<div class="carousel-caption-product-detail">
							<h4 class="title-cap">
								<?php echo $ap['Product']['name'] ?>
							</h4>
						</div>
					</div>
				</div>
				<center>
        <div class="row">
          <div class="col-md-6">
            <a href="<?php if($ap['Product']['cat_quote']=='non-unit-link'){
				$act = 'step1_non_unitlink';
			}else{
				$act = 'step1_unitlink';
			}
      if(in_array($ap['Product']['seo'], $appProd)) echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$ap['Product']['quote_id'])); else echo "#";?>"><button type="button" class="btn btn-baru btn-default2"><?php if(in_array($ap['Product']['seo'], $appProd))echo "Beli Sekarang"; else echo "Segera Hadir"; ?></button>
            </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$ap['Product']['seo']))?>"><button type="button" class="btn btn-baru btn-default3-baru">Lihat Detail</button>
            </a>
          </div>
        </div>
        </center>
			</div>
      <?php endif;?>
      <?php endforeach; ?>
	</div>
</div>
<!--end content-->
</div>
</div>


<script type="">
jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Please Change +62 to 0 ");

jQuery.validator.addMethod("validlength", function(value, element) {
if(value.length >0 && value.length <8) return false;
return true;
}, "8 numbers minimum");

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
//alert (a);
if(a == -1 ) return false;
return true;
}, "Not valid numbers");

    // validate the form when it is submitted
    var valContactMe = $("#Contactme").validate({
     	errorElement: "span",
    	errorPlacement: function(error, element) {
                        error.insertBefore(element);
        }
     });
     $("#nama").rules("add", {
         required:true,
         messages: {
                required: "Please Enter Your Name."
         }
      });
     $("#email").rules("add", {
         required:true,
         email: true,
         messages: {
                required: "Please Enter Your Email.",
    		email: "Please Enter Your Valid Email."
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
     

function ContactMe(){
    	if(valContactMe.form()) {
	        <?php if($productdetail['Product']['id']!=1):?>
			ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: '<?php echo 'contact - '.$gaSend[$productdetail['Product']['id']];?>'});
      <?php endif;?>
      }
    }

$('#contactme-btn').on('click', function() {
  ga('send', 'event', 'potential lead', 'click', 'contact me'); 
});
$('#btn-apply-product').on('click', function() {
ga('send', 'event', 'customer', 'click', 'apply now - product'); 
});
</script>

