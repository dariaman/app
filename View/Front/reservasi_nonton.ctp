
<?php
if($hasilCek==null){
//echo "nopolis palsu";
}else if(strtolower($hasilCek['PolicyStatus'])!='inforce')
{
//echo "polis tidak aktif tidak eligible";
}else if(strtolower($hasilCek['ProductDesc'])!='jaga sehat plus'||strtolower($hasilCek['ProductDesc'])!='jaga sehat keluarga')
{
//echo "polis bukan jsp jsk tidak eligible";

}

?>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'fm')) ?>">Free Movie</a></li>
            <li class="active">Reservasi Tiket</li>
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

		<?php echo $this->Form->create('fm_request_',array('id'=>'formFM','url'=>array('controller'=>'front','action'=>'reservasi_finish'),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nomor Polis <span class="red">*</span></label>
			<div class="col-sm-8">
				
				 <?php echo $this->Form->input('NOMOR_POLIS', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=> $input_nomor_polis)); ?>
	 			 <label><?php echo $input_nomor_polis ?></label>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Nama <span class="red">*</span></label>
			<div class="col-sm-8">
				<span>
				 <?php echo $this->Form->input('NAMA', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=>$hasilCek['CustomerName'])); ?></span>
				<label><?php echo $hasilCek['CustomerName']; ?></label>

	 			 
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Alamat Email <span class="red">*</span></label>
			<div class="col-sm-8">
				<span>
				 <?php echo $this->Form->input('EMAIL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'email','label' => false, 'value'=>$hasilCek['CustomerEmail'])); ?></span>
	 			 
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Jumlah Ticket<span class="red">*</span>
			
			</label>
			<div class="col-sm-8">
				<span class="custom-dropdown custom-dropdown--white">
					<?php $tkt=array('1') ;
					echo $this->Form->input('COUNT_INSURED', array('required'=>'required','type'=>'hidden' ,'div'=>false,'label' => false, 'value'=>$hasilCek['CountInsured'] ));
					
					$tiket_eligible=$hasilCek['CountInsured']-$tiketDiambil[0][0]['diambil'];//var_dump($tiket_eligible);
					
					if($tiket_eligible>$ticket[0][0]["totalTicket"])
					{$tiket_eligible=$ticket[0][0]["totalTicket"];	}
					
					if($tiket_eligible<0){$tkt=array('0');}
					elseif($tiket_eligible==0){$tkt=array('0');}
					else if($tiket_eligible==1){$tkt=array('1');}
					else if($tiket_eligible==2){$tkt=array('1','2');}
					else if($tiket_eligible==3){$tkt=array('1','2','3');}
					else if($tiket_eligible==4){$tkt=array('1','2','3','4');}
					else if($tiket_eligible==5){$tkt=array('1','2','3','4','5');}
					echo $this->Form->input('JUMLAH_TICKET', array('required'=>'required','options'=>$tkt,'onchange'=>"extracheck()", 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label' => false, 'optgroup'=>false )); ?>
				</span>
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-4 control-label">Pilihan Cinema<span class="red">*</span>
			
			</label>
			<div class="col-sm-8">
				
					 <?php echo $this->Form->input('CINEMA', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=> $input_cinema)); ?>
				 <label><?php echo $cinema[$input_cinema] ?> <?php echo $this->Form->input('CINEMA', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=>$cinema[$input_cinema] )); ?>
</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Jadwal Pengambilan<span class="red">*</span></label>
			<div class="col-sm-8">
				<div class="input-group">
					<?php echo $this->Form->input('JADWAL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=> $input_jadwal)); ?>
					 <label><?php echo $jadwal[$input_jadwal] ?><?php echo $this->Form->input('JADWAL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','label' => false, 'value'=> $jadwal[$input_jadwal] )); ?>
</label>
				</div>
			</div>	
		</div>


<?php
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
}
?>
		<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"><button class="btn btn-default2" type="button">Kembali</button></a></center><br/></div>

				 <?php echo $this->Form->input('QUOTE_NO', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'hidden','value' => $quote_no )); ?>				

		</form>
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