<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home','#'=>'sol'))?>">Home</a></li>
			<li class="active">Temukan Solusi</li>
		</ol>
		<!--<div class="mainvisual">
 
		</div>-->
	</div>
</div>
<div class="row">
	<!--sidebar-->
	<div class="col-sm-4 col-md-3 col-lg-3">
		<?php echo $this->element('front/sidebar'); ?>
	</div>
	<!--end sidebar-->
	<!-- modal -->
	<div class="modal fade" id="modalaw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Hubungi Saya</h4>
				</div>
				<?php echo $this->Form->create('Contactme',array('id'=>'Contactme','class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>true));
				$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
				<div class="modal-body">
					<!-- isi modal -->
					<p>  Belum menemukan solusi untuk kebutuhan proteksi Anda? Silahkan isi form dibawah dan agen kami akan segera menghubungi Anda.</p>
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
							<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone','validNotelp'=>true,'validlength'=>true,'validplus'=>true,'class'=>'form-control')); ?>
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
					<?php echo $this->Form->input('Contact_Remark1', array( 'value'=>'test', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
					<?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="Kirim" id="contactme-btn" onClick="ContactMe();" ></input>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal box -->
<!--content-->
<div class="col-sm-8 col-md-9 col-lg-9">
	
		<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
	<h2 class="title-content">
		Kenali Kebutuhan Anda
	</h2>
	<p class="review">
		Kami akan membantu Anda untuk menentukan pilihan produk yang seusai untuk kebutuhan Anda. Cukup dengan menjawab pertanyaan - pertanyaan kami berikut ini, untuk memulai proses JAGADIRI.
	</p>
	<div class="optionbg">

		<?php echo $this->Form->create('Product',array('id'=>'formProduct','role'=>'form','type' => 'post','novalidate'=>true)); ?>
		<div class="row">
			<div class="col-md-12">
				<h3 class="title-option"><span class="peach">Beritahu kami sedikit tentang Anda ?</span></h3>
				<span id="error1"></span>
			</div>
		</div>
		
 
		<div class="row">
                    <div class="col-sm-4">
                        <div class="radios1">
                            <center><input type="radio"  name="data[Product][question1]" value="1" id="r1"  <?php if (isset($q1) && $q1==1) {echo 'checked="true"';} ?> />
                            <label class="radio" for="r1"></label>
                            Lajang</center>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="radios2">
                            <center><input type="radio"  name="data[Product][question1]" value="2" id="r2" <?php if (isset($q1) && $q1==2) {echo 'checked="true"';} ?> />
                            <label class="radio" for="r2"></label>
                            Menikah</center>
                        </div>
                    </div>
                </div> 
		
		<span class="input-group"></span>
		<div class="row margintop">
			<div class="col-md-12">
				<h3 class="title-option"><span class="peach">Apakah Anda Memiliki Tanggungan ?</span></h3>
				<span id="error2"></span>
			</div>
		</div>
	 
		
		<div class="row">
                    <div class="col-sm-4">
                        <div class="radios3">
                            <center><input type="radio" name="data[Product][question2]" value="1" id="r3" <?php if (isset($q2)&& $q2==1) {
						echo 'checked="true"';
					} ?> />
                            <label class="radio" for="r3"></label>
                            Tidak Ada</center>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="radios4">
                            <center><input type="radio" name="data[Product][question2]" value="2" id="r4" <?php if (isset($q2)&& $q2==2) {
						echo 'checked="true"';
					} ?> />
                            <label class="radio" for="r4"></label>
                            Anak</center>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="radios5">
                            <center><input type="radio" name="data[Product][question2]" value="3" id="r5" <?php if (isset($q2)&& $q2==3) {
						echo 'checked="true"';
					} ?> />
                            <label class="radio" for="r5"></label>
                            Orang Tua</center>
                        </div>
                    </div>
                </div> 
		
		
		<div class="row margintop">
			<div class="col-md-12">
				<h3 class="title-option"><span class="peach">Bisa Anda Gambarkan apa yang menjadi hal terpenting <br />bagi Anda saat ini ?</span></h3>
				<span id="error3"></span>
			</div>
		</div>
		 
		
		<div class="row">
                    <div class="col-sm-4">
                        <div class="radios6">
                            <center><input type="radio" name="data[Product][question3]" value="1" id="r6"  <?php if (isset($q3)&& $q3==1) {
						echo 'checked="true"';
					} ?>  />
                            <label class="radio" for="r6"></label>
                            Kesehatan</center>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="radios7">
                            <center><input type="radio" name="data[Product][question3]" value="2" id="r7"  <?php if (isset($q3)&& $q3==2) {
						echo 'checked="true"';
					} ?> />
                            <label class="radio" for="r7"></label>
                            Perlindungan <br />Saat Bepergian</center>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="radios8">
                            <center><input type="radio" name="data[Product][question3]" value="3" id="r8"  <?php if (isset($q3)&& $q3==3) {
						echo 'checked="true"';
					} ?> />
                            <label class="radio" for="r8"></label>
                            Hari Tua</center>
                        </div>
                    </div>
                </div>
				
		
		<div class="row margintop">
			<div class="col-sm-offset-2 col-sm-8">
				<button class="btn-option" onClick="FindSolution()" type="button" >Cek Rekomendasi Kami</button>
			</form>	
		</div>
	</div>

</div>
<!-- endform -->

<section id="sol">
</section>
<?php 
if ($listsolusi!=null) {
      $gaSend=array(1=>'jsp',2=>'ja',3=>'jj',4=>'cfl',5=>'dbd',6=>'jai',7=>'jap5',8=>'jap7',9=>'jjp5',10=>'jjp7',11=>'jsk'); // ga code
	?>
	<div id="result" class="row margintop">
		<div class="col-md-12">
			<h3 class="title-suitable">
				<span class="peach bold">Terima Kasih,</span> Berikut adalah Produk yang Kami Rekomendasikan
			</h3>
		</div>
	</div>
	<?php
	foreach($listsolusi as $ls):?>
	<div class="row">
		<div class="col-md-4">
			<?php if($ls['Product']['quote_id']=='jaga-aman-instan' || $ls['Product']['quote_id']=='jaga-sehat-plus'):?>
      <!-- icon Best Seller -->
      <div class="best-seller">
        <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png">
      </div>
      <?php endif;?>
      <div class="carousel-inner">
				<div class="item active">
					<img alt="Produk <?php echo $ls['Product']['name'] ?>" src="<?php echo $this->Html->url("/");?>img/prod/<?php echo $ls['Product']['picture']?>" />
					<div class="carousel-caption-product">
						<h4 class="title-cap-detail">
							<!-- Jaga Sehat <br />Plus (HCP) -->
							<?php echo $ls['Product']['name'] ?>
						</h4>
					</div>
				</div>
			</div><br /> 
		</div>
		<div class="col-md-8">
			<h3 class="title-produk"><?php echo $ls['Product']['name'] ?></h3> 
			<h4 class="klas">Kategori : Asuransi <?php echo $ls['Category']['name'] ?></h4>
			 <p class="newreview">
           <?php if($ls['Product']['quote_id']=='jaga-aman-instan'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Pilihan periode perlindungan fleksibel mulai dari 3 jam hingga 1 tahun</li>
            <li><span class="peach-ondetail">+</span> Premi terjangkau mulai dari <span class="bold" style="color:#ee3a43">Rp 5000</span></li>
            <li><span class="peach-ondetail">+</span> Perlindungan termasuk olahraga ekstrim & penerbangan tidak terjadwal</li>
           </ul>
           <?php elseif($ls['Product']['quote_id']=='jaga-sehat-plus'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Mulai dari <span class="bold" style="color:#ee3a43">60 ribuan</span> per bulan*</li>
            <li><span class="peach-ondetail">+</span>  Jaminan uang kembali </li>
            <li><span class="peach-ondetail">+</span>  Layanan darurat 24 jam</li>
            <li><span class="peach-ondetail">+</span>  Gratis nonton di Blitzmegaplex</li>
           </ul>
           <small style="font-size:12px">*Syarat dan kondisi berlaku</small>
           <?php elseif($ls['Product']['quote_id']=='jaga-aman'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga ekonomis, premi mulai dari <span class="bold" style="color:#ee3a43">Rp 25 ribuan</span> per bulan</li>
            <li><span class="peach-ondetail">+</span>  Santunan meninggal dunia hingga <span class="bold" style="color:#ee3a43">Rp 100 Juta</span></li>
            <li><span class="peach-ondetail">+</span>  Santunan perawatan Rumah Sakit hingga <span class="bold" style="color:#ee3a43">Rp 10 Juta</span> per tahun</li>
            <li><span class="peach-ondetail">+</span>  Layanan darurat 24 Jam</li>
           </ul>
           <?php elseif($ls['Product']['quote_id']=='jaga-jiwa'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga hemat, mulai dari <span class="bold" style="color:#ee3a43">Rp 23 Ribuan</span></li>
            <li><span class="peach-ondetail">+</span>  Santunan meninggal dunia hingga <span class="bold" style="color:#ee3a43">Rp 200 Juta</span></li>
            <li><span class="peach-ondetail">+</span>  Langsung aktif!</li>
           </ul>
           <?php elseif($ls['Product']['quote_id']=='jaga-sehat'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga terjangkau, mulai dari <span class="bold" style="color:#ee3a43">Rp 46 Ribuan</span></li>
            <li><span class="peach-ondetail">+</span>  Santunan harian RS + Santunan Pembedahan</li>
            <li><span class="peach-ondetail">+</span>  Diskon untuk pembelian tahunan dan keluarga</li>
            <li><span class="peach-ondetail">+</span>  Layanan darurat 24 Jam</li>
           </ul>
           <?php elseif($ls['Product']['quote_id']=='jaga-sehat-dbd'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Harga super irit, mulai dari <span class="bold" style="color:#ee3a43">Rp 10,000!</span></li>
            <li><span class="peach-ondetail">+</span>  Mudah dan langsung aktif</li>
            <li><span class="peach-ondetail">+</span>  Kadar trombosit kurang dari 130,000 sudah di-cover</li>
           </ul>
		   <?php elseif($ls['Product']['quote_id']=='jaga-sehat-keluarga'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> 1 (satu) perlindungan kesehatan sekaligus untuk keluarga anda dengan
				harga terjangkau <span class="bold" style="color:#ee3a43"></span></li>
            <li><span class="peach-ondetail">+</span>  Perlindungan kesehatan termasuk rawat jalan</li>
            <li><span class="peach-ondetail">+</span>  Tidak ada klaim? Tenang,kami kembalikan uang anda <span class="bold" style="color:#ee3a43">25%</span></li>
           </ul>
           <?php elseif($ls['Product']['quote_id']=='caf-flexy-link'):?>
           <ul>
            <li><span class="peach-ondetail">+</span> Biaya akuisisi ringan, hanya 1X di awal kepesertaan!</li>
            <li><span class="peach-ondetail">+</span>  Tanpa medical check-up</li>
            <li><span class="peach-ondetail">+</span>  Santunan meninggal dunia hingga <span class="bold" style="color:#ee3a43">Rp 100 Juta</span></li>
           </ul>
           <?php else: ?>
           <span class="bold">
           <?php echo $ls['Product']['short_desc'] ?> 
           </span>
           <?php endif; ?>
        </p>
        <div class="row margintop3">
            <div class="col-sm-6">
            <a href="<?php 
			if($ls['Product']['cat_quote']=='non-unit-link'){
				$act = 'step1_non_unitlink';
			}else{
				$act = 'step1_unitlink';
			}
      $appProd=array('jaga-sehat-plus','jaga-sehat-dbd','jaga-sehat-keluarga','jaga-aman-instan','jaga-aman','jaga-jiwa','jaga-aman-plus','jaga-aman-plus-7-tahun','jaga-jiwa-plus','jaga-jiwa-plus-7-tahun');
			if(in_array($ls['Product']['seo'], $appProd)) echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$ls['Product']['quote_id'])); else echo "#";
			?>" ><button type="button" class="btn2 btn-app-neww" onClick="ga('send', 'event', { eventCategory: 'customer lead-fs', eventAction: 'click', eventLabel: 'beli - <?php echo $gaSend[$ls['Product']['id']];?>'});"
><?php if(in_array($ls['Product']['seo'], $appProd))echo "Beli Sekarang"; else echo "Segera Hadir"; ?></button></a>
			</div>
            <div class="col-sm-6"><?php if($ls['Product']['id']==4 || $ls['Product']['id']==5 || $ls['Product']['id']==6):?><a href="/chat_with_us/chat?locale=id" target="_blank" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - home'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><button type="button" class="btn2 btn-cont-neww">Tanya CS Kami</button></a><?php else:?><button type="button" class="btn2 btn-cont-neww" onClick="FillRemark1('<?php echo $ls['Product']['name']; ?>'); <?php if($ls['Product']['id']==1):?> ga('send', 'event', { eventCategory: 'potential lead-fs', eventAction: 'click', eventLabel: 'contact - jsp'});<?php endif;?>  setgaSend('<?php echo $gaSend[$ls['Product']['id']]?>');" data-toggle="modal" data-target="#modalaw" id="contactme-btn">Hubungi Saya</button><?php endif;?></div>
                    </div> 
					
		</div>
	</div>
	<?php endforeach; }?>
</div>
<!--end content-->
</div>
<script>
$(document).ready(function(){
$("html, body").animate({ scrollTop: $('#result').offset().top-50 }, 1000);
});
	
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
//alert (a);
if(a == -1 ) return false;
return true;
}, "Please Enter Valid Numbers. ");

	function valFindson(){
		var valq1=null,valq2=null,valq3=null;
		if (!$("input[name='data[Product][question1]']:checked").val()) {
			$('#error1').html("<span class='error'> Silahkan pilih salah satu opsi dibawah terlebih dahulu. </span>");
	    	//return false;
	    	valq1=false;
	    }
	    if (!$("input[name='data[Product][question2]']:checked").val()) {
	    	$('#error2').html("<span class='error'> Silahkan pilih salah satu opsi tanggungan dibawah terlebih dahulu. </span>");
	    	//return false;
	    	valq2=false;
	    }
	    if (!$("input[name='data[Product][question3]']:checked").val()) {
	    	$('#error3').html("<span class='error'> Silahkan pilih salah satu opsi prioritas anda terlebih dahulu. </span>");
	    	//return false;
	    	valq3=false;
	    }
	    if( valq1 == false ||valq2 == false ||valq3 == false){
	    	return false;
	    }
	    return true;
	}
		
	function FindSolution(){
		if(valFindson()) {
			ga('send', 'event', 'potential lead', 'click', 'suitable jaga diri product');    
			$('#formProduct').submit();
		}
	}

</script>
<script type="">
    var gaCodeProd = '';
    // validate the form when it is submitted
    var valContact = $("#Contactme").validate({
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
    		number: "Please Enter Your Valid Phone Number"
    	}
    });
    
    function ContactMe(){
    	if(valContact.form()) {
    		if(gaCodeProd != 'jsp') {
          submitProd='contact - '+gaCodeProd;  
        ga('send', 'event', { eventCategory: 'potential lead-fs', eventAction: 'click', eventLabel: submitProd});
        //alert(submitProd);
        }
      }
    }
    
    function setgaSend(id){
      gaCodeProd=id;
    }
    
    function FillRemark1(Isi){
    	var r = document.getElementById("ContactmeContactRemark1"); 
    	r.setAttribute("value", Isi);
    }
</script>