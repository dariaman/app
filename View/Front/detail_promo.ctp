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
            <li class="active"><?php echo $pr['Promo']['promo_title'] ?></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php if ($pr['Promo']['end_date'] < $date): ?>
            <div class="expired">
                <div class="pita">Promo Telah Berakhir</div>
            </div>
	<?php elseif ($pr['Promo']['id'] == 7): ?>

            <div class="">

		<img src="<?php echo $this->Html->url('/img/prom/galih-ratna/1.jpg')  ?>" class="img-responsive">
		<img src="<?php echo $this->Html->url('/img/prom/galih-ratna/2.jpg')  ?>" class="img-responsive">

		
		<?php  if( $this->Session->check('EventGalihRatna') ){ ?>
		<div style="background-color:#FEF4F3;">
		<center><img src="<?php echo $this->Html->url('/img/prom/galih-ratna/thankyou-note.png')?>" alt="pesan terima kasih" class="img-responsive"></center>
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
					
					<div class="col-sm-12">		
					<span style="color:magenta;">
					 <?php echo $this->Form->input('ANSWER', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Jawaban','label' => false)); ?>
					</span>
					</div>	
				</div>
				

				<br>
				<p>Tulis Data Diri</p>
				<br>	

			<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
	<div class="row">

			<!--<div class="col-sm-1"></div>-->
		
			<div class="col-sm-2">		
			<span>
				 <?php echo $this->Form->input('NAMA', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Nama Lengkap','label' => false)); ?>
			</span>
			</div>	
		
			<div class="col-sm-2">		
			<span>
				 <?php echo $this->Form->input('GENDER', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Jenis Kelamin','label' => false)); ?>
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
			<!--<div class="col-sm-1"></div>-->		

		</div>
		

		<div style="background-color:#FF8685;"><br/>  <center><button type="submit" class="calculate" style="background-color:#FF8685;display:none;" type="button" id="calculate-btn"></button><img style="cursor:pointer" id="kirim-btn" alt="kirim-button-cinta-style" src="<?php echo $this->Html->url('/img/prom/galih-ratna/kirim-btn-cinta.jpg')  ?>" class="img-responsive"> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i></center><br/></div> 

			</form>
<div class="fb-share-button" data-href="http://103.24.12.244/promo/galih-dan-ratna.htm" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F103.24.12.244%2Fpromo%2Fgalih-dan-ratna.htm&amp;src=sdkpreparse">Share</a></div>
<a href="https://twitter.com/intent/tweet?screen_name=jagadiri_id" class="twitter-mention-button" data-show-count="false">Tweet to @jagadiri_id</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	</div>
<script>

$("#kirim-btn").click(function(){
  $("#calculate-btn").trigger('click');
});



$('.tgl_lahir').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	startView:2,
	endDate:"-1y",
	startDate:"-65y",
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

		//ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
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
		"data[fm_reservasi_premier][GENDER]": "Masukan jenis kelamin anda",
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
}, 'Email anda belum valid');
var getBannerCode='';
    
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

			if(a == -1 ) return false;
			return true;
		}, "Please Enter Valid Numbers. ");

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
		<img src="<?php echo $this->Html->url('/img/prom/galih-ratna/4.jpg')  ?>" class="img-responsive">


            </div>

	<?php else: ?>
	
	<center>
            <?php if ($pr['Promo']['target_url'] == null): ?>
                <img src="<?php echo $this->Html->url('/img/prom/' . $pr['Promo']['img_promo_detail']) ?>" class="img-responsive">
		<?php else: ?>
                <a href="<?php echo $pr['Promo']['target_url'] ?>" <?php echo (1 == $pr['Promo']['new_tab']) ? 'target="_blank"' : ''; ?>><img src="<?php echo $this->Html->url('/img/prom/' . $pr['Promo']['img_promo_detail']) ?>" class="img-responsive"></a>
            <?php endif; ?>
        </center>
        
        <?php endif ?>
    </div>
</div>

<!-- POPUP FOR POLLING PILIH RAWAT INAP/JALAN -->
<div id="polling-rawat-inap-jalan-form-modal" class="modal fade" role="dialog" style="padding-top:7%;" style="margin-top:auto;">
    <div class="modal-dialog">
        <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="../img/close-btn.png"></button>
            <div class="modal-body">
        <div class="row">
					<div>
                        <a href="#"><img src="<?php echo $this->Html->url("/"); ?>img/polling/rev_7-06.png" class="img-responsive"></a> <!--onClick="javascript:popUpFormVisitor('inap')"-->
					</div>
                    <div class="col-xs-6 col-sm-6 col-lg-6" style="padding-left:20px;">
                        <a href="#" onclick="showModal(1)"><img src="<?php echo $this->Html->url("/"); ?>img/polling/rawat-inap.png" class="img-responsive"></a> <!--onClick="javascript:popUpFormVisitor('inap')"-->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-6" style="padding-left:25px;">
                        <a href="#" onclick="showModal(2)"><img src="<?php echo $this->Html->url("/"); ?>img/polling/rawat-jalan.png" class="img-responsive"></a><!--onClick="javascript:popUpFormVisitor('jalan')"-->
                    </div>
                </div>
      </div>
        </div>
    </div>
</div>

<!-- POPUP FOR FORM POLLING PILIH RAWAT INAP/JALAN -->
<div id="form-rawat-inap-jalan-form-modal" name="form-rawat-inap-jalan-form-modal" class="modal fade form-horizontal" role="dialog">
    <?php echo $this->Form->create('Promo', array('url' => array('controller' => 'front', 'action' => 'submitPromo'), 'role' => 'form')); ?>
    <div class="modal-dialog">
	<div class="modal-content">
	<button type="button"  data-dismiss="modal" class="close" onclick="confirmClose()" aria-label="Close"><img src="<?php echo $this->Html->url('/') ?>img/close-btn.png"></button>
        <p id="content-pesan" ></p>
        <div class="modal-header">
                <h4 class="modal-title"><span class="control-label">Terima kasih atas pendapat yang Anda berikan. Mohon untuk melengkapi data Anda.</span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label col-sm-2">Nama</label>
                    <div class="col-sm-10">
                        <p id="content-name" ></p>
                        <input type="text" class="form-control required" name="name" id="name">
                        <input type="hidden" id="pilihan" name="pilihan" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <p id="content-email" ></p>
                        <input type="email" class="form-control required" name="email" id="email" oninput="cekEmail()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-2">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <p id="content-telp" ></p>
                        <input type="text" class="form-control required" name="telp" id="telp" oninput="cekNum()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label col-sm-2">Alamat Lengkap</label>
                    <div class="col-sm-10">
                        <p id="content-address" ></p>
                        <textarea name="address" id="address" class="form-control required" rows="3" ></textarea>
                        <p style="color:red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.<p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<!-- POPUP FOR CONFIRM CLOSE POLLING PILIH RAWAT INAP/JALAN -->
<div id="close-rawat-inap-jalan-form-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="control-label"><center>Isi Data Anda Untuk Memenangkan Vouchernya.</center></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" onclick="showFormPolling()" >Isi Data</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" onCLick="tutupForm()">Tidak, Terima Kasih</button><!--data-dismiss="modal-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	
	function tutupForm(){
	  $("#polling-rawat-inap-jalan-form-modal").hide();
	  $(".modal-backdrop").hide();
	}

    //    function close(){
    //        $('#close-rawat-inap-jalan-form-modal').modal('hide');
	
    //    }
    function showModal(o){
        $('#form-rawat-inap-jalan-form-modal').modal({backdrop: 'static', keyboard: false});
        $('#pilihan').val(o);
        $('#modalPolling').modal('show');
    }
    function cekEmail(){
        var pesan_email = $("#content-email");
        var email = $("#email").val();
        var regex = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
		
        if(!regex.test(email)){
            pesan_email.text("Field Email Tidak Sesuai").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#email").focus();
            return false;
        }else{  pesan_email.text("").removeClass('error');  $("#email").focus(); return false;  }
    }
    function cekNum(){
        var pesan_telp_angka = $("#content-telp");
        var $num = $("#telp").val();
        for(var a = 0 ; a < $num.length; a++){
            var angka = /^[0-9]+$/;
            if(!$num.match(angka)){
                pesan_telp_angka.text("Field Nomor Telepon hanya boleh diisi angka").removeClass('success').addClass('error').css({
                    'color':'red'
                });
                $("#telp").focus();
                return false;
            }else{  pesan_telp_angka.text("").removeClass('error');  $("#telp").focus(); return false;  }
           if($num.length < 6){
                pesan_telp_angka.text("Field Nomor Telepon Tidak Sesuai").removeClass('success').addClass('error').css({
                    'color':'red'
                });
                $("#telp").focus('');
				return false;
            }else{  pesan_telp_angka.text("").removeClass('error');  $("#telp").focus(); return false;  }
        }
    }
    $('#form-rawat-inap-jalan-form-modal').submit(function () {
        var angka_ = /^[0-9]+$/;
        var dataString = $('#form-rawat-inap-jalan-form-modal').serialize();
        var pesan_name = $("#content-name");
        var pesan_email = $("#content-email");
        var pesan_telp = $("#content-telp");
        var pesan_address= $("#content-address");
        if($("#name").val() === ""){
            pesan_name.text("Field Nama tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#name").focus();
            return false;
        }
        if($("#email").val() === ""){
            pesan_email.text("Field Email tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#email").focus();
            return false;
        }
        if($("#telp").val() === ""){
            pesan_telp.text("Field Nomor Telepon tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#telp").focus();
            return false;
        }
        
        if($("#address").val() === ""){
            pesan_address.text("Field Alamat tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#address").focus();
            return false;
        } 
        if($("#address").length() < "6"){
            pesan_address.text("Field Alamat tidak Sesuai").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#address").focus();
            return false;
        }
		
		
        /* $.ajax({
                                        url: "< echo $this->Html->url('submitPromo');>",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(){
                        $('#content').html('<p>You have successfully !</p>');
                    }

                })*/
    })
    //http://code.runnable.com/UhY_PcUNXgAmAAYD/allow-only-numbers-in-an-input-using-jquery-for-form
    
</script>