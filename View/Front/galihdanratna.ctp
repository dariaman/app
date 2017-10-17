<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'promo')) ?>">Promo</a></li>
            <li class="active">Galih dan Ratna</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
	 <div class="">

		<!--<img src="<?php echo $this->Html->url('/img/prom/galih-ratna/1.jpg')  ?>" class="img-responsive">-->	


		<div class=" col-sm-12 col-xs-12">
		
			<div style=" position: relative;">
				<img style="position: relative;z-index:500;"alt="list unduh rekanan" src="<?php echo $this->Html->url("/");?>img/prom/galih-ratna/bg-movie.jpg" class="img-responsive" >
				<iframe style="position: absolute;z-index:501;top:110px;" src="https://www.youtube.com/embed/Ks0lO3zCWOQ?autoplay=0"  frameborder="0" allowfullscreen></iframe>				
			</div>
			
		</div>

		<img src="<?php echo $this->Html->url('/img/prom/galih-ratna/2.jpg')  ?>" class="img-responsive">

		
		<?php  if( $this->Session->check('EventGalihRatna') ){ ?>
		<div style="background-color:#FEF4F3;">
		<center><img src="<?php echo $this->Html->url('/img/prom/galih-ratna/thankyou-note-2.png')?>" alt="pesan terima kasih" class="img-responsive">
	
			<div class="row">
			<div class="fb-share-button" data-href="http://103.24.12.244/galihdanratna/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F103.24.12.244%2Fgalihdanratna%2F&amp;src=sdkpreparse">Share</a></div>
			<!--<div class="fb-share-button" data-href="http://103.24.12.244/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F103.24.12.244%2Fgalihdanratna%2F&amp;src=sdkpreparse">Share</a></div>-->
			<a href="https://twitter.com/intent/tweet?screen_name=jagadiri_id&button_hashtag=JagaGalihdanRatna" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
	
		
		</center>
		</div>
		<?php } else { ?>
		<div style="background-color:#FEF4F3;">
			<center>
			<div style="background-color:#FF8685;border-radius: 25px; padding: 20px; width: 80%; color:white;">
				<p style="font-weight:bold;font-size:22px;">Di adaptasi dari novel apakah film GALIH & RATNA?</p>
				<br>
		<?php echo $this->Form->create('fm_reservasi_premier',array('id'=>'formEvent',/*'url'=>array('controller'=>'front','action'=>'reservasi_nonton'),*/'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
				
				
				<div class="form-group">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">		
					<span style="color:magenta;">
					 <?php echo $this->Form->input('ANSWER', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Jawaban','label' => false)); ?>
					</span>
					</div>	
					<div class="col-sm-1"></div>
				</div>
				

				<br>
				<p>Tulis Data Diri</p>
				<br>	

			<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
	<div class="row">

			<div class="col-sm-1"></div>
		
			<div class="col-sm-2">		
			<span>
				 <?php echo $this->Form->input('NAMA', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Nama Lengkap','label' => false)); ?>
			</span>
			</div>	
		
			<div class="col-sm-2">		
			<span class="custom-dropdown custom-dropdown--white">
				
				 <?php 
					//echo $this->Form->input('GENDER', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Jenis Kelamin','label' => false)); 
					$opsi=array('M','F');
					echo $this->Form->input('GENDER', array('required'=>'required','options'=>$opsi, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white valid','div'=>false,'label' => false, 'optgroup'=>false,'empty' => 'Jenis Kelamin' ));
				?>
			</span>
			</div>	
		
			<div class="col-sm-2">		
			<span>
				 <?php 
					//echo $this->Form->input('TTL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'number','placeholder' => 'Tanggal Lahir','label' => false)); 
					echo $this->Form->input('TTL', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'tgl_lahir','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir col-xs-2 col-md-3 form-control', 'div'=>false));
				?>
				
			</span>
			</div>	
		
			<div class="col-sm-2">	
			<span>
				 <?php echo $this->Form->input('EMAIL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Email','label' => false)); ?>
			</span>
			</div>	
				
			<div class="col-sm-2">		
			<span>
				 <?php // echo $this->Form->input('NOMOR_TLP', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'number','placeholder' => 'Nomor telepon','label' => false)); ?>
				<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'placeholder' => 'Nomor Telepon', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>

			</span>
			</div>	
			<div class="col-sm-1"></div>		

		</div>
		

		<div style="background-color:#FF8685;"><br/>  <center><button type="submit" class="calculate" style="background-color:#FF8685;display:none;" type="button" id="calculate-btn"></button><img style="cursor:pointer" id="kirim-btn" alt="kirim-button-cinta-style" src="<?php echo $this->Html->url('/img/prom/galih-ratna/kirim-btn-cinta.jpg')  ?>" class="img-responsive"> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i></center><br/></div> 

			</form>
			<div class="row">
			<div class="fb-share-button" data-href="http://103.24.12.244/galihdanratna/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F103.24.12.244%2Fgalihdanratna%2F&amp;src=sdkpreparse">Share</a></div>
			<!--<div class="fb-share-button" data-href="http://103.24.12.244/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F103.24.12.244%2Fgalihdanratna%2F&amp;src=sdkpreparse">Share</a></div>-->
			<a href="https://twitter.com/intent/tweet?screen_name=jagadiri_id&button_hashtag=JagaGalihdanRatna" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
	</div>
<script>

$("#kirim-btn").click(function(){
  $("#calculate-btn").trigger('click');
});



$('.tgl_lahir').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	startView:2,
	endDate:"-21y",
	startDate:"-45y",
}).on('changeDate', function(e){
	$(this).blur();
}).on('show', function(e){
	$(this).blur();
});

/* CheckValid nomorpolis */
 function check_nopol() {
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_valid_polis_fm/');?>",
		type: "GET",
		cache: false,
		data: {'nopol':$('#fm_reservasi_NOMORPOLIS').val()},
		beforeSend: function(){ },
		complete: function(){ },
		success: function(msg){  if(msg==0) {}  else {
			alert('Mohon maaf, Polis anda belum terdaftar.');
			}
		}
	});
	return false;
} 

$(".calculate2").click(function(){ 
	if(valQuote.form()) {
		$(".calculate2").prop('disabled', true);
		 $( "#formFM" ).submit();

	}
});

var valQuote = $("#formEvent").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[fm_reservasi_premier][EMAIL]" :{ required:true, myEmail:true}

	},
	messages: {
		"data[fm_reservasi_premier][ANSWER]": "Masukan jawaban anda",
		"data[fm_reservasi_premier][NAMA]": "Masukan nama anda",
		"data[fm_reservasi_premier][GENDER]": "Pilih jenis kelamin anda",
		"data[fm_reservasi_premier][TTL]": "Masukan tanggal lahir anda",
		"data[fm_reservasi_premier][EMAIL]":{required:"Masukan Email Anda",email:"Email anda belum valid"},
		"data[fm_reservasi_premier][Contact_Phone]": "Masukan nomor telepon anda",
	},
	errorPlacement: function(error, element) {
 	error.appendTo(element.parent('span').parent("div"));
	},
});
jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Format Email tidak sesuai');
var getBannerCode='';
    
		jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Ubah kode +62 ke 0 ");
	
		jQuery.validator.addMethod("validlength", function(value, element) {
			if(value.length >0 && value.length <10) return false;
			return true;
		}, "Minimum 10 digit. ");

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
		}, "Format nomer belum sesuai. ");

$("#phone").rules("add", {
    	required:true,
    	number:true, 
    	messages: {
    		required: "Please Enter Your Phone Number",
    		number: "Please Enter Only Number"
    	}
    });




$(document).ready(function() {
	var regp = $(".regularpremi").val();
	//regularpremi2
	$(".regularpremi2").val(regp);
	var ps = $(".premiumlifespan").val();
	//regularpremi2
	$(".premiumlifespan2").val(ps);
	var pr = $(".product option:selected").text();
	//regularpremi2
	$(".tipeinvestasi").val(pr);

	//ga('send', 'pageview', '/get-a-quote/'); 
});



</script>


	</div>
<?php } // else klo ga ada session ?>				
				
			</div>
			</center>
		<div>
		<img src="<?php echo $this->Html->url('/img/prom/galih-ratna/4b.jpg')  ?>" class="img-responsive">


            </div>


	

    </div>
</div>