<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">E-Gift</li>
		</ol>
		<!--<div class="mainvisual">
 
		</div>-->
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div >
			<center><?php echo $this->element('front/fm_kiri'); ?></center>
		</div>
	</div>

	<div class="col-md-8">

			
		<?php echo $this->Form->create('egift_reservasi_',array('id'=>'formEG','url'=>array('controller'=>'front','action'=>'egift_redeem'),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); 

		echo $this->Form->input('NOMOR_POLIS', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=> $id)); ?>
		
		<div>
			 <span class="red">* Harap verifikasi data anda</span><br/>

		</div>	

		<div class="form-group">
			<label class="col-sm-4 control-label">Alamat<span class="red">*</span></label>
			<div class="col-sm-8">
				<span>
				 <?php 

					if(empty($hasilCek['PolicyCustomerAddress']) ){
					echo $this->Form->input('ALAMAT', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','label' => false, 'value'=>$hasilCek[0]['PolicyCustomerAddress'])); 
					}else{
					echo $this->Form->input('ALAMAT', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','label' => false, 'value'=>$hasilCek['PolicyCustomerAddress'])); 
					}

				?></span>
	 			 
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Nomor Hp<span class="red">*</span></label>
			<div class="col-sm-8">
				<span>
				 <?php 
					if(empty($hasilCek['PolicyCustomerAddress']) ){
					echo $this->Form->input('NO_HP', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','label' => false, 'value'=>$hasilCek[0]['PolicyCustomerMobilePhone'] )); 
					}else{
					echo $this->Form->input('NO_HP', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','label' => false, 'value'=>$hasilCek['PolicyCustomerMobilePhone'] )); 
					}
				?></span>

	 			 
			</div>	
		</div>		




		<div><br/>  
			<?php  if(empty($egift)){ ?>

				<div class="alert alert-danger alert-dismissable">

				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, E-Voucher bulan ini belum tersedia.</div>
			
			<?php }else if(!empty($VoucherDiambil))
				{ //echo date("Y-m-d H:i:s",strtotime('+1 month 8 days'));?>

				<?php  if($VoucherDiambil['Egift_log']['remark']=='BOOKED'){ ?>

				<center><button type="submit" class="btn btn-default2 calculate" type="button" id="calculate-btn">Submit</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i></center><br/></div> 		
				



				<?php }else{ ?>

				<div class="alert alert-danger alert-dismissable">

				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, anda telah mengambil E-Voucher anda bulan ini.</div>
			
			
			<?php }	}else{ //echo date("Y-m-d H:i:s",strtotime('+1 month 8 days'));?>
		<center><button type="submit" class="btn btn-default2 calculate" type="button" id="calculate-btn">Submit</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i></center><br/></div> 
			
			<?php } ?>




		</form>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div style=" margin-top: 10px;">
			<?php echo $this->element('front/fm_bawah'); ?>
		</div>
	</div>
</div>


<script>
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

$(".calculate").click(function(){ 
	if(valQuote.form()) {
		$(".calculate").prop('disabled', true);
		 $( "#formEG" ).submit();

		//ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
	}
});

var valQuote = $("#formEG").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[egift_reservasi_][NO_HP]" :{ required:true, validplus:true, validlength:true, validNotelp:true},
		"data[egift_reservasi_][ALAMAT]": { required:true, minlength:15},
	},
	messages: {
		"data[egift_reservasi_][NOMOR_POLIS]": "Masukan nomor polis anda",
		"data[egift_reservasi_][ALAMAT]":{ required:"Masukan alamat", minlength:"alamat terlalu pendek"},
		"data[egift_reservasi_][NO_HP]": {required:"Masukan nomor telpon selular anda",validplus:"Silahkan Rubah +62 ke 0 ", validlength:"Nomor telepon yang Anda masukkan tidak valid", validNotelp:"Nomor yang Anda masukan tidak valid"},
	},
	errorPlacement: function(error, element) {
 	error.appendTo(element.parent('span').parent("div"));
	},
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

jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Silahkan Rubah +62 ke 0 ");

jQuery.validator.addMethod("validlength", function(value, element) {
if(value.length >0 && value.length <8) return false;
return true;
}, "Nomor telepon yang Anda masukkan tidak valid");

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
}, "Nomor yang Anda masukan tidak valid");


</script>