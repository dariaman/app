<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">Hubungi Kami</li>
		</ol>
		<div class="mainvisual">
 
		</div>
	</div>
</div>
<div class="row margintop">
	<!--content-->

	<?php echo $this->Form->create('Contactus',array('id'=>'Hubkami','class'=>'','role'=>'form','type' => 'post','novalidate'=>true)); 
				

	?>
	<div class="col-sm-8 col-md-8 col-lg-8">
		<p class="hubungikami">
			Belum menemukan solusi untuk kebutuhan proteksi Anda? Hubungi kami sekarang juga.
		</p>
		<div class="form-group">
			<?php echo $this->Form->input('Contact_Name', array('id'=>'nama', 'placeholder' => 'Name', 'class'=>'form-control-contactus', 'div'=>false, 'type'=>'text','label'=>false)); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->input('Contact_Email', array('id'=>'email', 'placeholder' => 'Email Address', 'class'=>'form-control-contactus','type'=>'email','email'=>'true', 'div'=>false, 'type'=>'text','label'=>false)); //tidak ada contact_email?>
		</div>
		
		<div class="form-group">
		
			<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'placeholder' => 'Phone Number','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'onkeypress'=>'return numbersonly(event)', 'class'=>'form-control-contactus', 'div'=>false, 'type'=>'text','label'=>false)); ?>
			<?php echo $this->Form->input('Contact_Gender', array( 'value'=>'_', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
			<?php echo $this->Form->input('Contact_DOB', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
			<?php echo $this->Form->input('Contact_CDate', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
			<?php echo $this->Form->input('Contact_CTimeFrom', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
			<?php echo $this->Form->input('Contact_CTimeTo', array( 'value'=>'1/1/1999', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
			<?php echo $this->Form->input('Contact_Remark2', array( 'value'=>'', 'type'=>'text','hidden'=>true, 'label'=>false)); ?>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Saya Ingin Di Hubungi Di</label>
					<span class="custom-dropdown custom-dropdown--white">
						<!-- dropdown -->

						<?php $options = array('Email' => 'Email','Tel' => 'Telepon');
						echo $this->Form->input('Contact_Source',array( 'options'=>$options,'class'=>'form-control-contactus custom-dropdown__select custom-dropdown__select--white','label'=>false )); ?>
					</span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Pada Waktu</label>
					<span class="custom-dropdown custom-dropdown--white">
						<!-- daytime  -->
						<?php $options = array('Pagi' => 'Pagi','Siang' => 'Siang','Malam' => 'Malam');
						echo $this->Form->input('Contact_Daytime',array( 'options'=>$options,'class'=>'form-control-contactus custom-dropdown__select custom-dropdown__select--white','label'=>false )); ?>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Message</label>
			<span class="custom-dropdown custom-dropdown--white">
				<!-- message -->

				<?php $options = array(
					'Inquiry (I want to ask on JAGADIRI products and promotion)' => 'Inquiry (I want to ask on JAGADIRI products and promotion)',
					'Claim (I want to get help for my claim process)' => 'Claim (I want to get help for my claim process)',
					'Feedback (I want to give inputs to JAGADIRI)' => 'Feedback (I want to give inputs to JAGADIRI)',
					'Other' => 'Other',

					);
					echo $this->Form->input('Contact_Remark1',array( 'options'=>$options,'class'=>'remark1 form-control-contactus custom-dropdown__select custom-dropdown__select--white','label'=>false,'id'=>'remark1' )); ?>
				</span>
			</div>
			<div class="form-group">
				<?php echo $this->Form->textarea('Contact_Remark2', array('rows'=>'3','type'=>'textarea','class'=>'remark2 form-control-contactus', 'placeholder' => 'Other ','label'=>false, 'id'=>'message', 'text'=>'Other message')); ?>
			</div>

<?php
				if ($this->Session->check('Adv')){
				echo $this->form->hidden('Contactus.Contact_Optmzd_Id',array('value'=>$this->Session->read('Adv.optmzd_id') ));
				echo $this->form->hidden('Contactus.Contact_Gclid',array('value'=>$this->Session->read('Adv.gclid')  ));
				}
?>
			<div class='row'>
				<div class='col-md-offset-8 col-md-4'>
					<button type="submit" class="btn-thanks btn-caf-blue" id="hub_kami" onclick="Hub_Kami(); return test();">Send</button>
				</div>
			</div>
		</div>
	</form>

	<!--end content-->

	<!--sidebar-->
	<div class="col-sm-4 col-md-4 col-lg-4">
		<h2 class="hubungi">
			<span class="bold">
				Jagadiri
			</span>
		</h2>
		<p class="hubungikami">
			<span class="bold">JAGADIRI Office:</span><br />

			Citicon Tower 8th Floor Unit C<br />
			Jl. Letjend S. Parman Kav. 72, Slipi<br />
			Jakarta 11410 - Indonesia<br /><br />
			Telp : +62 21 29 621 622<br />
			Fax : +62 21 29 621 623<br/>
      Call Center : 1500 660
		</p>
	</div>
	<!--end sidebar-->
</div>

<script type="text/javascript">

	$("select[id=remark1]").change(function(){
		$( "select option:selected").each(function(){
			if($(this).attr("value")=="Other"){
				$(".remark2").show();
			}else{
				$(".remark2").innerHTML="test";
				$(".remark2").hide();
			}
		});
	}).change();

</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('.carousel').carousel({
			interval: 2500
		});

		$('.carousel').carousel('cycle');
		$(".remark2").value='test';
		$(".remark2").hide();
	});
</script> 
<script>
	$(function() {
		window.prettyPrint && prettyPrint()
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
			e.stopPropagation()
		})
	})
</script>
<script>
	function numbersonly(e){
		var unicode=e.charCode? e.charCode : e.keyCode
		if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if (unicode<48||unicode>57) //if not a number
			return false //disable key press
	}
}
</script>
<script type="">
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

    // validate the form when it is submitted
    var valhub = $("#Hubkami").validate({
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
    	messages: {
    		required: "Please Enter Your Email."
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
    $("#message").rules("add", {
    	required:true,
    	messages: {
    		required: "Please Enter Your Message"
    	}
    });
/*  You Can add oter fields like above
         Here with messages. But remember you have to mention
         $("#testingform").validate(); first and then write
         all other code
         */
         //if success run google code         

         function Hub_Kami(){
         	if(valhub.form()) {
         		ga('send', 'event', 'potential lead', 'click', 'hubungi kami'); 
			ga('send', 'event', { eventCategory: 'Widget - Email', eventAction: 'click', eventLabel: 'Send button'});//new

         	}
         }

     </script>
     <!-- Google Code for Thanks_Contactus Conversion Page -->
     <script type="text/javascript">
     	/* <![CDATA[ */
     	var google_conversion_id = 966906860;
     	var google_conversion_language = "en";
     	var google_conversion_format = "2";
     	var google_conversion_color = "ffffff";
     	var google_conversion_label = "WqocCKqNpVcQ7KeHzQM";
     	var google_remarketing_only = false;
     	/* ]]>*/
     </script>
     <script type="text/javascript" src="//
     www.googleadservices.com/pagead/conversion.js">
 </script>
 <noscript>
 	<div style="display:inline;">
 		<img height="1" width="1" style="border-style:none;" alt="" src="//
 		www.googleadservices.com/pagead/conversion/966906860/?label=WqocCKqNpVcQ7KeHzQM&amp;guid=ON&amp;script=0
 		"/>
 	</div>
 </noscript>