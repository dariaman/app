<!--<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../jsfiles/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../jsfiles/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<link href="../css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
<link href="../cssfiles/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">-->
	


<script>
$(document).ready(function() {


}

</script>


<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">Free Movie</li>
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

		<?php echo $this->Form->create('fm_reservasi_',array('id'=>'formFM','url'=>array('controller'=>'front','action'=>'reservasi_nonton'),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
		<div class="form-group">
			<span class="red" style="font-weight: bold;font-size:18px;">Reservasi dibuka setiap hari rabu pukul 12:00 s/d jumat pukul 24:00 minggu ke-2 setiap bulannya.</span><br><br>
			<!--<span class="red" style="font-weight: bold;font-size:18px;">Reservasi dapat dilakukan pada hari rabu s/d jumat mulai pukul 12:00 s/d 24:00 WIB, di minggu ke-2 setiap bulan.</span><br><br>-->
			<label class="col-sm-4 control-label">Nomor Polis <span class="red">*</span></label>
			<div class="col-sm-8">
				
			<span>
				 <?php echo $this->Form->input('NOMOR_POLIS', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','label' => false)); ?>
			</span>
			</div>	
		</div>


		


		<div class="form-group">
			<label class="col-sm-4 control-label">Pilihan Cinema<span class="red">*</span>
			
			</label>
			<div class="col-sm-8">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('CINEMA', array('required'=>'required','empty'=>'Pilih Cinema','options'=>$cinema,'onchange'=>"extracheck()", 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label' => false, 'optgroup'=>false )); ?>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Jadwal Pengambilan<span class="red">*</span>
			
			</label>
			<div class="col-sm-8">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('JADWAL', array('required'=>'required','empty'=>'Pilih Jadwal','options'=>$jadwal,'onchange'=>"extracheck()", 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label' => false, 'optgroup'=>false )); ?>
				</span>
			</div>
		</div>


		
		<div class="form-group">
			<label class="col-sm-4 control-label">Voucher Tersedia<span class="red">*</span>
			
			</label>
			<div class="col-sm-8">
			<label><?php if($ticket[0][0]["totalTicket"]<0)echo "0";else echo $ticket[0][0]["totalTicket"];  ?> / 600</label>
				 <?php echo $this->Form->input('QUOTE_NO', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','value' => $ticket[0]['Ticket']["quote_ticket"] )); ?>				
			</div>
		</div>

		
		<div>

			 <span class="red">* Harap melalukan pengambilan voucher pada Cinema & jadwal yang telah dipilih</span><br/>
			 <span class="red">* Apabila pengambilan melewati jadwal yang telah ditentukan akan menyebabkan e-voucher hangus</span><br/>

		</div>	

		<div><br/>  <?php if( $ticket[0]["Ticket"]["tanggal_selesai"]< date("Y-m-d H:i:s") ){ //echo date("Y-m-d H:i:s",strtotime('+1 month 8 days'));?>
<script>
$( "#fm_reservasi_NOMORPOLIS" ).prop( "disabled", true );
$( "#fm_reservasi_CINEMA" ).prop( "disabled", true );
$( "#fm_reservasi_JADWAL" ).prop( "disabled", true );
</script>
				<div class="alert alert-danger alert-dismissable">

				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, program bulan ini belum tersedia.</div>
		
				<?php }else if( $ticket[0]["Ticket"]["tanggal_selesai"]< date("Y-m-d H:i:s") ){ //echo date("Y-m-d H:i:s",strtotime('+1 month 8 days'));?>
<script>
$( "#fm_reservasi_NOMORPOLIS" ).prop( "disabled", true );
$( "#fm_reservasi_CINEMA" ).prop( "disabled", true );
$( "#fm_reservasi_JADWAL" ).prop( "disabled", true );
</script>
				<div class="alert alert-danger alert-dismissable">

				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

					Mohon maaf, program bulan ini telah berakhir.</div>

				  <?php }else if($ticket[0][0]["totalTicket"]<=0 ){ ?>
<script>
$( "#fm_reservasi_NOMORPOLIS" ).prop( "disabled", true );
$( "#fm_reservasi_CINEMA" ).prop( "disabled", true );
$( "#fm_reservasi_JADWAL" ).prop( "disabled", true );
</script>				

				<div class="alert alert-danger alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, Ketersediaan Tiket hari ini telah habis. Tersedia kuota 200 tiket setiap harinya. Anda dapat melakukan reservasi esok hari setiap pukul 12:00 WIB</div>


			<?php	}else{ //echo date("Y-m-d H:i:s",strtotime('+1 month 8 days'));?>
<script>
$( "#fm_reservasi_NOMORPOLIS" ).prop( "disabled", false );
$( "#fm_reservasi_CINEMA" ).prop( "disabled", false );
$( "#fm_reservasi_JADWAL" ).prop( "disabled", false );
</script><center><button type="submit" class="btn btn-default2 calculate" type="button" id="calculate-btn">Submit</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i></center><br/></div> <?php } ?>

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
$(".calculate").click(function(){ 
	if(valQuote.form()) {
		$(".calculate").prop('disabled', true);
		 $( "#formFM" ).submit();

		//ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
	}
});

var valQuote = $("#formFM").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[fm_reservasi_][NOMOR_POLIS]": { required:true, np:true},		
	},
	messages: {
		//"data[fm_reservasi_][NOMOR_POLIS]": "Masukan nomor polis anda",
		"data[fm_reservasi_][NOMOR_POLIS]": { required:"Masukan nomor polis anda", np:"Nomor polis hanya numerik"},		
		"data[fm_reservasi_][CINEMA]": "Pilih cinema",
		"data[fm_reservasi_][JADWAL]": {required: "Pilih jadwal"},		
	},
	errorPlacement: function(error, element) {
 	error.appendTo(element.parent('span').parent("div"));
	},
});

jQuery.validator.addMethod("np", function(value, element) {

	if(/^[0-9]*$|\./.test( value ) )
	{return true;}
	else{return false;} 
}, "Tahun motor yang Anda masukkan tidak valid");


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