<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Online Claim</li>
		</ol>
		<div class="mainvisual">
		</div>
	</div>
</div>
<div class="row margintop">
	<div class="col-md-12">
		<div class="clearfix"><h1 class="title-login">
			<span class="bold red">Online Claim</span>
		</h1>
	</div>
	<div class="clearfix"><h2 class="title-quote">
		<span class="bold">Silahkan Lengkapi data di bawah ini agar kami dapat memproses klaim anda.</span>
	</h2>
	<h3 class="title-wajib">
		<span class="red">*Wajib Diisi</span>
	</h3>
</div>
<hr class="redline">
</div>
</div>

<div class="row">
	<div class="col-md-12 ">
		<?php //echo $this->Session->flash('flash', array('element' => 'failure'));?>
		<?php echo $this->Form->create('Claim',array('id'=>'formClaim', 'class'=>'form-horizontal','role'=>'form','novalidate' => true));
 
		$this->Form->inputDefaults(array(
			'class' => 'span6',
			'label' => false,
			));
			?>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Policy Number<span class="red">*</span></label>

				<div class="col-sm-10">
					<span class="custom-dropdown custom-dropdown--white">

						<?php echo $this->Form->input('POLICY_ID', array('id'=>'polid','empty'=>'Pilih Policy Anda','options'=>$optPolicy,'required'=>'required','class'=>' polid form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label'=>false )); ?>

					</span>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Event Date<span class="red">*</span></label>

				<div class="col-md-10">

					<div class="input-group"><?php echo $this->Form->input('EVENT_DATE', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'eventDate','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'eventDate col-xs-2 col-md-3 form-control', 'div'=>false)); ?>
					<span class="input-group-addon tgl red"><i class="fa fa-calendar"></i></span>

					</div>
				</div>
			</div>	

			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Coverage<span class="red">*</span> <i id="loading" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i></label>

				<div class="col-sm-10">

				    <span class="custom-dropdown custom-dropdown--white">
						 <?php echo $this->Form->input('COVERAGE_TYPE_ID', array('empty'=>'Pilih Coverage','options'=>array(''=>''),'required'=>'required','class'=>'coverage form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label'=>false,'required'=>'required' )); ?>

					</span>
				</div>
			</div>

			
			<div class="form-group">
				<label class="col-sm-2 control-label"><span class="bold red">Beneficiary Detail</span></label>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Name<span class="red">*</span></label>

				<div class="col-md-10">
					<?php echo $this->Form->input('BENEFICIARY_NAME', array('id'=>'name', 'required'=>'required','class'=>'form-control','required'=>'required')); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1"> Address<span class="red">*</span></label>
				<div class="col-md-10">
					<?php echo $this->Form->input('BENEFICIARY_ADDRESS', array('id'=>'address','required'=>'required','class'=>'form-control','required'=>'required')); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Phone<span class="red">*</span></label>
				<div class="col-md-10">
					<?php echo $this->Form->input('BENEFICIARY_PHONE', array('id'=>'phone','required'=>'required','class'=>'form-control','required'=>'required', 'type'=>'number','validNotelp'=>true,'validlength'=>true,'validplus'=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Email</label>					
				<div class="col-md-10">
					<?php echo $this->Form->input('BENEFICIARY_EMAIL', array('email'=>true, 'class'=>'form-control','required'=>'required')); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Bank Account<span class="red">*</span></label>
				<div class="col-md-10">
					<?php echo $this->Form->input('BANK_ACCOUNT_NO', array('id'=>'bankacc','required'=>'required','class'=>'form-control','required'=>'required')); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Account Name<span class="red">*</span></label>
				<div class="col-md-10">
					<?php echo $this->Form->input('ACCOUNT_NAME', array('id'=>'accname','required'=>'required','class'=>'form-control','required'=>'required')); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Bank Name<span class="red">*</span></label>

				<div class="col-md-10">
					<span class="custom-dropdown custom-dropdown--white">

						<?php echo $this->Form->input('BANK_ID', array('empty'=>'Pilih Bank','options'=>$bank, 'required'=>'required','class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label'=>false)); ?>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="form-field-1">Bank Branch<span class="red">*</span></label>
				<div class="col-md-10">
					<?php echo $this->Form->input('BANK_BRANCH', array('id'=>'bankbranch','required'=>'required','class'=>'form-control','required'=>'required')); ?>
				</div>
			</div>
			
			<div class="hr hr-24"></div>
			<br>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn-caf-green" type="submit" id="claim-btn" onclick="ClaimCheck()"><span class="bold">Submit</span></button><br /><br />
				</div>
			</div>
		</form>
	</div>
 
	
<script type="text/javascript">
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
//alert(validno);
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

	$("#polid").change(function(){
	var type = $("#polid").val();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_getCoveragePolicy'); ?>"+type,cache: false,
		beforeSend: function(){$("#loading").show(); },
		complete: function(){$("#loading").hide(); },
		success: function(msg){$(".coverage").html(msg);},
		"statusCode": {
			403: function() {
				window.location.href=""
			},

			500: function() {
				alert('Error Server Side occured');
			}
		}
	});
});

	$('.eventDate').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startView:2,
endDate:"<?php echo date('Y-m-d'); ?>y",
}).on('changeDate', function(e){
	$(this).blur();
}).on('show', function(e){
	$(this).blur();
});
$(".tgl").click(function(){
	$('.eventDate').focus();
});

//$().ready(function() {
    // validate the form when it is submitted
    var valClaim = $("#formClaim").validate({
    	errorElement: "span",
    	errorPlacement: function(error, element) {
		    if (element.is("select")) error.appendTo(element.parent('span').parent('div'));
    		else error.insertAfter(element);
    	},
		messages: {
		"data[Claim][POLICY_ID]": "Pilih No Polis Anda",
		"data[Claim][EVENT_DATE]": "Masukan Event Date",
		"data[Claim][COVERAGE_TYPE_ID]": "Pilih Coverage",
		"data[Claim][BENEFICIARY_NAME]": "Masukan Nama Ahli Waris",
		"data[Claim][BENEFICIARY_ADDRESS]": "Masukan Alamat",
		"data[Claim][BENEFICIARY_PHONE]": "Masukan Telephon",
		"data[Claim][BENEFICIARY_EMAIL]": {required: "Masukan alamat email", email: "Alamat Email anda belum valid"},
		"data[Claim][BANK_ACCOUNT_NO]": "Masukan nomor akun bank Anda",
		"data[Claim][ACCOUNT_NAME]": "Masukan Nama akun bank Anda",
		"data[Claim][BANK_ID]": "Pilih Bank Anda",
		"data[Claim][BANK_BRANCH]": "Masukan kantor cabang bank Anda",
		},
    });

    $("#phone").rules("add", {
    	required:true,
    	number:true, 
    	messages: {
    		required: "Please Enter Your Phone Number",
    		number: "Please Enter Only Number"
    	}
    });
    function ClaimCheck(){
         	if(valClaim.form()) {
ga('send', 'event', 'customer', 'click', 'online claim'); 
         	}
         }
//});
//claim button ga

</script>