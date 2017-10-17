<div class="container-fluid" style="margin-top:35px">
	<div class="row">
		<div class="col-md-12">
			<section class="body">
	
	<?php
		if(isset($_POST['validate']) ? $_POST['validate'] : false){
			$kode = isset($_POST['voucherCode']) ? $_POST['voucherCode'] : '';
			if($kode != ''){
				
			}
			else{
				?>
				<script type="text/javascript">
					$('#voucherCode').focus();
				</script>
				<?php
			}
		}
	?>
	<!--<form method="post" action="/" class="center form-horizontal" id="validateForm">-->
	<?php 
		echo $this->Form->create('promo_jmk',array('id'=>'promo_jmk','class'=>' form-inline','role'=>'form','type' => 'post','novalidate'=>true)); 
		$this->Form->inputDefaults(array('label' => false));
	?>

		<?php  echo $this->Session->flash('flash', array('element' => 'failure')); ?>

	<center>
	<?php 
		echo $this->Form->input('voucherCode', array('id'=>'voucherCode', 'placeholder' => 'Masukan kode voucher', 'class'=>'center form-control', 'div'=>false, 'type'=>'text'));
	?>
	<center>
		<!--<input id="voucherCode" name="voucherCode" placeholder="masukan kode voucher" class="center form-control">-->
		<input id="validateVoucher" name="validate" type="submit" value="validasi voucher" class="center btn-danger">
	</form>

		</div>  
	</div>
</div>

<script>
		jQuery.validator.addMethod("validlength", function(value, element) {
			if(value.length >0 && value.length <8) return false;
			return true;
		}, "Please Enter Minimum 8 Digit Numbers. ");

    // validate the form when it is submitted
    var valLeaveNumb = $("#RegGojek").validate({
    	errorElement: "span",
    	errorPlacement: function(error, element) {
    		error.insertBefore(element);
    	}
    });
    $("#voucherCode").rules("add", {
    	required:true,
    	messages: {
    		required: "Please Enter Your Voucher Code."
    	}
    });
</script>