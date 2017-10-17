<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'egift_petunjuk')) ?>">E-Gift</a></li>
            <li class="active">Reservasi E-Voucher</li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-4">
		<div >
			<center><?php echo $this->element('front/fm_kiri'); ?></center>
		</div>
	</div>
	<div class="col-md-8">

terima kasih atas pembaruan data anda, voucher anda akan dikirim melalui email <br><br>
		<!--<?php echo $this->Form->create('fm_request_',array('id'=>'formEG','url'=>array('controller'=>'front','action'=>'reservasi_finish'),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nomor Polis <span class="red">*</span></label>
			<div class="col-sm-8">
				
				 <?php echo $this->Form->input('NOMOR_POLIS', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=> $input_nomor_polis)); ?>
	 			 <label><?php echo $input_nomor_polis ?></label>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Nomor Hp<span class="red">*</span></label>
			<div class="col-sm-8">
				<span>
				 <?php echo $this->Form->input('NO_HP', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'email','label' => false, 'value'=>$hasilCek['CustomerEmail'])); ?></span>
	 			 
			</div>	
		</div>-->


<?php
/*
if($hasilCek==null){
?>
<div class="alert alert-danger alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, Polis anda belum terdaftar.</div>
<?php
}else if($hasilCek['ProductDesc']!='Jaga Sehat Plus' && $hasilCek['ProductDesc']!='Jaga Sehat Keluarga'){
?>
<div class="alert alert-danger alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, Program ini hanya berlaku untuk pemegang polis Jaga Sehat Plus dan Jaga Sehat Keluarga.</div>

<?php
}else if(strtolower($hasilCek['PolicyStatus'])!='inforce')
{
?>
<div class="alert alert-danger alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					Mohon maaf, Program ini hanya berlaku untuk pemegang polis yang masih aktif.</div>
<?php
}else{
	if($tiket_eligible>0){
?>
		<div><br/><center><button class="btn btn-default2 calculate" type="button" id="calculate-btn">Submit</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i>	
<?php
	}
} */
?>
		<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><button class="btn btn-default2" type="button">Kembali</button></a></center><br/></div>

				 <?php //echo $this->Form->input('QUOTE_NO', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','value' => $quote_no )); ?>				

		<!--</form>-->
	</div>
<div class="row">
	<div class="col-md-12">
		<div style=" margin-top: 10px;">
			<center><?php echo $this->element('front/fm_bawah'); ?></center>
		</div>
	</div>
</div>


</div><!-- div container -->



<script>
$(".calculate").click(function(){ 
	if(valQuote.form()) {
		//$(".calculate").prop('disabled', true);

		$( "#formFM" ).submit();


	}
});




var valQuote = $("#formFM").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[fm_request_][EMAIL]" :{ required:true, myEmail:true}

	},
	messages: {

		"data[fm_request_][NAMA]":"Masukan nama anda",
		"data[fm_request_][EMAIL]":{required:"Masukan Email Anda",email:"Email anda belum valid"},
		"data[fm_request_][JUMLAH_TICKET]": "Masukan kuantitas tiket yang anda mau",
		
	},
	errorPlacement: function(error, element) {
 	error.appendTo(element.parent('span').parent("div"));
	},
});
jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Email anda belum valid');




</script>