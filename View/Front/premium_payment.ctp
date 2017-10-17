 <?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li class="active">Online Payment</li>
			</ol>
			<div class="mainvisual">
			</div>
		</div>
	</div>
	<div class="row margintop">
		<div class="col-md-12">
			<div class="clearfix"><h1 class="title-login">
				<span class="bold red">Online Premium Payment</span>
				</h1>
			</div>
			<div class="clearfix"><h2 class="title-quote">
				<span class="bold">Silahkan pilih polis yang ingin anda bayarkan dan manfaatkan fasilitas pembayaran online kami</span>
				</h2>
				<h3 class="title-wajib">
				<span class="red">*Wajib Diisi</span>
				</h3>
			</div>
			<hr class="redline">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		
		  <div class="form-group">	
			  <label class="col-sm-2 control-label">Policy Number<span class="red">*</span></label>
			<div class="col-sm-10">
			<?php echo $this->Form->create('Premium',array('id'=>'formQuote','url'=>array('controller'=>'front','action'=>'premium_payment','?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','novalidate'=>true)); ?>
			  <span class="custom-dropdown custom-dropdown--white">
						 <?php echo $this->Form->input('List', array('onChange'=>'this.form.submit()','empty'=>'Pilih Policy Anda','options'=>$optPolicy,'required'=>'required','class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'label'=>false )); ?>
				</span>
			</form>
			</div>
		  </div>
		  
		   <?php if($policy!=null):?>
		   <div class="form-group">	
				<div class="col-sm-2">
					<h4 class="title-calculate">Premium</h4>
				</div>
				<div class="col-sm-10">
					<h4 class="title-calculate"><span class="bold"><?php echo rp(round($policy['PolicyRegulerPremium'],0)) ?></span></h4>
				</div>
		  </div>
		  
		   <div class="form-group">	
				<div class="col-sm-2">
					<h4 class="title-calculate">Jatuh Tempo</h4>
				</div>
				<div class="col-sm-10">
					<h4 class="title-calculate"><span class="bold">
					<?php 
					$tempo=str_replace("T"," ",$policy['PolicyDueDatePremium']); 
					$tempo=date_format(date_create_from_format('Y-m-d H:i:s', $tempo), 'j F Y'); 
					echo $tempo ?></span></h4>
				</div>
		  </div>
		  
		   <div class="form-group">	
				<div class="col-sm-2">
					<h4 class="title-calculate">Status</h4>
				</div>
				<div class="col-sm-10">
					<h4 class="title-calculate"><span class="bold"><?php if($pay) echo "Belum dibayar"; else echo "Pembayaran sedang dalam proses"; ?></span></h4>
				</div>
		  </div>
			<?php endif; ?>
	 
		</div>
	</div>
	
	<?php if($pay==true && $policy!=null && $policy['PolicyDueDatePremium']!=$policy['MatureDate'] && (strtolower($policy['PolicyStatus'])=='inforce' || strtolower($policy['PolicyStatus'])=='grace'  || strtolower($policy['PolicyStatus'])=='lapse')): ?>
	<div class="row margintop">
		<div class="col-md-12">
			<div class="clearfix"><h1 class="title-login">
				<span class="bold red">Pilih Metode Pembayaran </span>
				</h1>
			</div>
			<hr class="redline">
			<div class="row">
					<div class="col-sm-offset-3 col-sm-4">
						<input class="quote" type="radio" <?php //if(round($policy['PolicyRegulerPremium'],0) < 100000) echo "disabled"; ?> name="pembayaran" id="inlineRadio1" value="creditcard" /> 
						<label for="inlineRadio1" ><span class="kk"><img src="<?php echo $this->Html->url("/"); ?>img/visa.png" alt="visa" /></span>
						</label>
					</div>
					<div class="col-sm-4">
						<input class="quote" type="radio" name="pembayaran" id="inlineRadio2" value="bca"/> 
						<label for="inlineRadio2" >
						<span class="kk"><img src="<?php echo $this->Html->url("/"); ?>img/bca.png" alt="klikPay Bca" /></span>
						</label>
					</div>
				</div>
				<div class="row margintop">
					<div class="col-md-12">
						<center><button class="btn-caf-green" type="button" onClick="clickBayar()" id="payment-btn">Pay Now</button></center><br /><br />
					</div>
				</div>
		</div>
	</div>
	
<script type="text/javascript">
function clickBayar(){
		if($('input[name=pembayaran]:checked').val()=='bca') {
		ga('send', 'event', 'customer', 'click', 'online payment'); 
		$.ajax({
		url: "<?php echo $this->Html->url('/front/getBCAtokenPremi/');?>",
		type: "GET",
		cache: false,
		data: {'id':<?php echo $policyNo; ?>},
		beforeSend: function(){ },
		complete: function(){  },
		success: function(msg){  
			msg=JSON.parse(msg);
		 	postData("https://klikpay.klikbca.com/purchasing/purchase.do?action=loginRequest",{
			klikPayCode:msg['klikPayCode'],
			transactionNo:msg['transactionNo'],
			totalAmount:msg['totalAmount'],
			payType:msg['payType'],
			callback:msg['callback'],
			miscFee:msg['miscFee'],
			transactionDate:msg['transactionDate'],
			signature:msg['signature'],
			descp:msg['descp'],
			currency:msg['currency'],
			});
			 
		}
	});
			
		} else if($('input[name=pembayaran]:checked').val()=='creditcard') {
			ga('send', 'event', 'customer', 'click', 'online payment'); 
			$.ajax({
		url: "<?php echo $this->Html->url('/front/getVisaMastertokenPremi/');?>",
		type: "GET",
		cache: false,
		data: {'id':<?php echo $policyNo; ?>},
		beforeSend: function(){ },
		complete: function(){  },
		success: function(msg){  
			msg=JSON.parse(msg);
			postData("https://acquire.doappx.com/sprint/doacquire/api/webAuthorization.cfm",{  
			siteID:msg['siteID'],
			serviceVersion:msg['serviceVersion'],
			merchantTransactionID:msg['merchantTransactionID'],
			amount:msg['amount'],
			callback:msg['callback'],
			miscFee:msg['miscFee'],
			transactionDate:msg['transactionDate'],
			signature:msg['signature'],
			descp:msg['descp'],
			currency:msg['currency'],
			checksum:msg['checksum'],
			});			 
		}
	});
		}
}

function postData(path, params, method) {
    method = method || "post";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
         }
    }
    document.body.appendChild(form);
    form.submit();
}
$('#payment-btn').on('click', function() {
});
</script>
	<?php endif; ?>
</div>