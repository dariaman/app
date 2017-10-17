<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
            <li class="active">Jaga Aman Bersama MRA</li>
        </ol>
    </div>
</div>

		<?php echo $this->Form->create('fm_reservasi_mra',array('id'=>'formEvent',/*'url'=>array('controller'=>'front','action'=>'reservasi_nonton'),*/'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>
<div class="row">
    <div class="col-md-12">
	<p>Tulis Data Diri</p>
			<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>

			<div class="form-group">
					<div class="col-sm-2">Nama Lengkap</div>
					<div class="col-sm-10">		
					<span>
					<?php echo $this->Form->input('NAMA', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Nama Lengkap','label' => false)); ?>
					</span>
					</div>			
			</div>

			<div class="form-group">
					<div class="col-sm-2">Tanggal Lahir</div>
					<div class="col-sm-10">		
					<span class="custom-dropdown custom-dropdown--white">
				 <?php 
						//echo $this->Form->input('TTL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'number','placeholder' => 'Tanggal Lahir','label' => false)); 
					echo $this->Form->input('TTL', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'tgl_lahir','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir col-xs-2 col-md-3 form-control', 'div'=>false));
				?>

					</span>
					</div>			
			</div>

			<div class="form-group">
					<div class="col-sm-2">Jenis Kelamin</div>
					<div class="col-sm-10">		
					<span>
				
<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
				echo $this->Form->radio('GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>


					</span>
					</div>			
			</div>

			

			<div class="form-group">
					<div class="col-sm-2">Nomor Telepon</div>
					<div class="col-sm-10">		
					<span>
				<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'placeholder' => 'Nomor Telepon', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
					</span>
					</div>			
			</div>

			<div class="form-group">
					<div class="col-sm-2">Email</div>
					<div class="col-sm-10">		
					<span>
				 <?php echo $this->Form->input('EMAIL', array('required'=>'required','class'=>'form-control','div'=>false ,'type'=>'text','placeholder' => 'Email','label' => false, 'myEmail'=>true)); ?>

					</span>
					</div>			
			</div>
	
			<div class="form-group">
      <label class="col-sm-2 control-label">Alamat Lengkap Tempat Tinggal<span class="red">*</span><a class="tooltips"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Alamat Anda kami butuhkan untuk memudahkan kami mengirimkan dokumen terkait polis asuransi.</div></span></a></label>
	  <div class="col-sm-10">
         <?php echo $this->Form->input('ADDRESS', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
         <span class="red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.</span>

      </div>
    </div>

</form>


			
    </div>
</div>
	

		

		<div ><br/>  <center><button type="submit" class="calculate"  type="button" id="calculate-btn">Kirim</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i></center><br/></div> 
<script>


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


$(".calculate").click(function(){ 
	if(valQuote.form()) {
		$(".calculate").prop('disabled', true);
		 $( "#formEvent" ).submit();

	}
});

var valQuote = $("#formEvent").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[fm_reservasi_mra][EMAIL]" :{ required:true, myEmail:true},
		"data[fm_reservasi_mra][ADDRESS]":{required:true, minlength:10},


	},
	messages: {
		"data[fm_reservasi_mra][ANSWER]": "Masukan jawaban anda",
		"data[fm_reservasi_mra][NAMA]": "Masukan nama anda",
		"data[fm_reservasi_mra][GENDER]": "Pilih jenis kelamin anda",
		"data[fm_reservasi_mra][TTL]": "Masukan tanggal lahir anda",
		"data[fm_reservasi_mra][EMAIL]":{required:"Masukan Email Anda",email:"Email anda belum valid"},
		"data[fm_reservasi_mra][ADDRESS]": {required:"Masukan Alamat Anda",minlength:"Mohon Isi Alamat Lengkap Anda"},
		"data[fm_reservasi_mra][Contact_Phone]": "Masukan nomor telepon anda",
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
    		required: "Masukan nomor telepon anda",
    		number: "Nomor telepon harus angka"
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
