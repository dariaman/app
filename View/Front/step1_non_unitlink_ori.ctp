<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min"></script>
<script type="text/javascript" src="../jsfiles/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../jsfiles/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<link href="../css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
<link href="../cssfiles/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	
<?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>
 <div class="row">
 	<div class="col-md-12">
 		<ol class="breadcrumb">
 			<li><a href="index.php">Home</a></li>
 			<li class="active">Purchasing Steps</li>
 			<li class="active">Dapatkan Quote <?php echo $product['product_description']; ?></li>
 		</ol>
 		<!--<div class="mainvisual-quote">
 		</div>-->
    <?php if($product['product_id']==11 || $product['product_id']==12 || $product['product_id']==13 || $product['product_id']==14 || $product['product_id']==17):?>
    <center style="margin: 0 0 20px;"><a href="https://www.jagadiri.co.id/promo/valentine-promo-2016.htm"><img src="/img/banner_top_small.jpg" class="img-responsive"></a></center>
	<?php endif;?>
    <center><img src="<?php echo $this->Html->url('/')?>img/step1.jpg" class="img-responsive"></center>
    <!--<ul class="list-inline">
      <li><a href="#"></li>
    </ul>-->
 	</div>
 </div>
 <!--<div class="row margintop">
 	<div class="col-md-10">
 		<ul class="nav-tabs" role="tablist">
 			<li class="active"><a>Dapatkan Quote</a></li>
 			<li><a><span class="hidden-xs">Isi</span> Data</a></li>
 			<li><a>Selesai</a></li>
 		</ul>
 	</div>
 </div>-->
 <div class="row margintop">
 	<div class="col-md-12">
 		<div class="clearfix"><h2 class="title-quote">
 			<span class="bold">Isi dan segera dapatkan penawaran <?php echo $product['product_description']; ?></span>
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
		<?php echo $this->Form->create('Personal',array('id'=>'formQuote','url'=>array('controller'=>'front','action'=>'step1_non_unitlink','id'=>$name,'?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); 
		echo $this->form->hidden('Personal.COVERAGE_TYPE_ID',array('value'=>$product['coverage_type_id']));
		echo $this->form->hidden('Personal.product_id',array('value'=>$product['product_id']));
		echo $this->form->hidden('Personal.seo',array('value'=>$product['product_description']));
		if($product['product_id']=='7'): echo $this->form->hidden('Personal.QUOTE_PREMIUM_MODE',array('value'=>0)); endif; // andi edit req_paskal
    if($product['product_id']=='12'): echo $this->form->hidden('Personal.QUOTE_PREMIUM_LIFESPAN',array('value'=>1)); endif; // andi edit req_paskal
    if($product['product_id']=='13'): echo $this->form->hidden('Personal.QUOTE_PREMIUM_LIFESPAN',array('value'=>1)); endif; // andi edit req_paskal
		echo $this->form->hidden('Personal.manfaat',array('value'=>$prod_det['Product']['manfaat']));
		?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Tanggal Lahir<span class="red">*</span></label>
			<div class="col-sm-4">
				<div class="input-group"><?php echo $this->Form->input('PROSPECT_DOB', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'tgl_lahir','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir col-xs-2 col-md-3 form-control', 'div'=>false)); ?>
					<span class="input-group-addon tgl red"><i class="fa fa-calendar"></i></span>
				</div>
			</div>	
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Jenis Kelamin<span class="red">*</span></label>
			<div class="col-sm-10">
				<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
				echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
			</div>
		</div>
    
    <?php if($product['product_id']=='7'):?>
    <div id="hc_hidden" class="form-group" style="display:none;">
      <label class="col-sm-2 control-label">Request Hardcopy Buku Polis <a class="tooltip"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Secara umum JAGADIRI hanya akan menerbitkan e-policy untuk Anda; jika Anda menginginkan <i>hardcopy</i> Buku Polis, maka Anda akan dibebankan biaya tambahan sebesar Rp 50,000 untuk biaya pencetakan dan pengiriman buku polis.</div></span></a></label>
      <div class="col-sm-10">
        <?php 
          $option = array('Y'=>' &nbsp;Ya', 'T'=>' &nbsp;Tidak');
          echo $this->Form->radio('HARD_COPY', $option, array('id'=>'req_hc','required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote'));
        ?>
      </div>
    </div>
    <?php elseif($product['product_id']!='5'):?>
    <div class="form-group">
      <label class="col-sm-2 control-label">Request Hardcopy Buku Polis <a class="tooltip"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Secara umum JAGADIRI hanya akan menerbitkan e-policy untuk Anda; jika Anda menginginkan <i>hardcopy</i> Buku Polis, maka Anda akan dibebankan biaya tambahan sebesar Rp 50,000 untuk biaya pencetakan dan pengiriman buku polis.</div></span></a></label>
      <div class="col-sm-10">
        <?php 
          $option = array('Y'=>' &nbsp;Ya', 'T'=>' &nbsp;Tidak');
          echo $this->Form->radio('HARD_COPY', $option, array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote'));
        ?>
      </div>
    </div>
    <?php endif; ?>
    
		<hr class="redline"/>
		<div class="form-group">
			
      <?php if($product['product_id']=='7'): //jika JAI hide freq_pembayaran ?>
			<div class="col-sm-4">
				<label> Uang Pertanggungan<span class="red">*</span></label>
				<?php 
				if($optUp!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp,'div'=>false, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				
				else echo $this->Form->input('SUM_INSURED', array('required'=>'required','summininsured'=>true, 'class'=>'regularpremi col-xs-10 col-md-5 text-right form-control', 'id'=>'up','data-prefix'=>'Rp ','data-precision'=>0)); ?>
			</div>
			<div class="col-sm-4">
				<label>Periode Pertanggungan<span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php if($product['product_id']==7) echo $this->Form->input('DURATION_JAI', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp','onChange'=>'showHC();')); 
					else if(!isset($id['pp'])) echo $this->Form->input('QUOTE_PREMIUM_LIFESPAN', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp')); 
					else echo $this->Form->input('QUOTE_DURATION_DAYS', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp')); 
					?>	
				</span>
			</div>
			<div class="col-sm-4">
				<label>Waktu Mulai Perlindungan<span class="red">*</span></label>
				<!-- <input size="20" type="text" value="" readonly class="form_datetime form-control"> -->
				<?php echo $this->Form->Input('WAKTU_PERLINDUNGAN', array('empty'=>'Isi Waktu Perlindungan','required'=>'required', 'readonly'=>true,'class'=>'form_datetime form-control', 'div'=>false)); ?>
			</div>
			<script type="text/javascript">
				$(".form_datetime").datetimepicker({
					startDate: new Date(),
					todayBtn: true,
					autoclose: true,
					format: "yyyy-mm-dd hh:ii:00"
				});
			</script>
      <?php elseif($product['product_id']=='12'): //Jika JJ hide periode-pertanggungan?>
      <div class="col-md-6">
        <label> Uang Pertanggungan<span class="red">*</span></label>
				<?php 
				if($optUp!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp,'div'=>false, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				
				else echo $this->Form->input('SUM_INSURED', array('required'=>'required','summininsured'=>true, 'class'=>'regularpremi col-xs-10 col-md-5 text-right form-control', 'id'=>'up','data-prefix'=>'Rp ','data-precision'=>0)); ?>
      </div>
      <div class="col-md-6">
        <label>Frekuensi Pembayaran <?php if($product['product_id']==12) echo "Premi";?><span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php 
					echo $this->Form->input('QUOTE_PREMIUM_MODE', array('required'=>'required','empty'=>'Pilih Frekuensi','options'=>$optFrek,'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
      </div>
      <?php elseif($product['product_id']=='13'): //Jika JA hide periode-pertanggungan?>
      <div class="col-md-6">
        <label> Uang Pertanggungan<span class="red">*</span></label>
				<?php 
				if($optUp!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp,'div'=>false, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				
				else echo $this->Form->input('SUM_INSURED', array('required'=>'required','summininsured'=>true, 'class'=>'regularpremi col-xs-10 col-md-5 text-right form-control', 'id'=>'up','data-prefix'=>'Rp ','data-precision'=>0)); ?>
      </div>
      <div class="col-md-6">
        <label>Frekuensi Pembayaran <?php if($product['product_id']==12) echo "Premi";?><span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php 
					echo $this->Form->input('QUOTE_PREMIUM_MODE', array('required'=>'required','empty'=>'Pilih Frekuensi','options'=>$optFrek,'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
      </div>
      
      <?php elseif($product['product_id']=='17' || $product['product_id']=='18'): //Jika JAP hardcode options sum insured because the multiply is dynamic?>
      <div class="col-sm-4">
				<label> Uang Pertanggungan<span class="red">*</span></label>
        <span class="custom-dropdown custom-dropdown--white">
          <select name="data[Personal][SUM_INSURED]" class="form-control custom-dropdown__select custom-dropdown__select--white valid" required="required" id="PersonalSUMINSURED" aria-required="true">
          <option value="">Pilih Uang Pertanggungan</option>
          <option value="20000000">Rp 20,000,000</option>
          <option value="40000000">Rp 40,000,000</option>
          <option value="60000000">Rp 60,000,000</option>
          <option value="80000000">Rp 80,000,000</option>
          <option value="100000000">Rp 100,000,000</option>
          <option value="200000000">Rp 200,000,000</option>
          </select>
        </span>
			</div>
			
			<div class="col-sm-4">
				<label>Periode Pertanggungan<span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php if($product['product_id']==7) echo $this->Form->input('DURATION_JAI', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp','onChange'=>'showHC();')); 
					else if(!isset($id['pp'])) echo $this->Form->input('QUOTE_PREMIUM_LIFESPAN', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp')); 
					else echo $this->Form->input('QUOTE_DURATION_DAYS', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp')); 
					?>	
				</span>
			</div>
      
      <div class="col-sm-4">
				<label>Frekuensi Pembayaran <?php if($product['product_id']==12) echo "Premi";?><span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php 
					echo $this->Form->input('QUOTE_PREMIUM_MODE', array('required'=>'required','empty'=>'Pilih Frekuensi','options'=>$optFrek,'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
      
      <?php else: //selain JAI,JA dan JJ tampilkan semua?>
      
      <?php if($product['product_id']=='11'): //Temporary Hardcode for JSP?>
      <div class="col-sm-4">
				<label> Uang Pertanggungan<span class="red">*</span></label>
        <span class="custom-dropdown custom-dropdown--white">
          <select name="data[Personal][SUM_INSURED]" class="form-control custom-dropdown__select custom-dropdown__select--white valid" required="required" id="PersonalSUMINSURED" aria-required="true">
          <option value="">Pilih Uang Pertanggungan</option>
          <option value="300000">Rp 300,000</option>
          <option value="600000">Rp 600,000</option>
          <option value="900000">Rp 900,000</option>
          <!-- <option value="1200000">Rp 1,200,000</option>
          <option value="1500000">Rp 1,500,000</option>-->
          </select>
        </span>
			</div>
      <?php else:?>
      <div class="col-sm-4">
				<label> Uang Pertanggungan<span class="red">*</span></label>
				<?php 
				if($optUp!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp,'div'=>false, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				
				else echo $this->Form->input('SUM_INSURED', array('required'=>'required','summininsured'=>true, 'class'=>'regularpremi col-xs-10 col-md-5 text-right form-control', 'id'=>'up','data-prefix'=>'Rp ','data-precision'=>0)); ?>
			</div>
      <?php endif;?>
			
			<div class="col-sm-4">
				<label>Periode Pertanggungan<span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php if($product['product_id']==7) echo $this->Form->input('DURATION_JAI', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp','onChange'=>'showHC();')); 
					else if(!isset($id['pp'])) echo $this->Form->input('QUOTE_PREMIUM_LIFESPAN', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp')); 
					else echo $this->Form->input('QUOTE_DURATION_DAYS', array('empty'=>'Pilih Periode','options'=>$optPP,'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp')); 
					?>	
				</span>
			</div>
      
      <div class="col-sm-4">
				<label>Frekuensi Pembayaran <?php if($product['product_id']==12) echo "Premi";?><span class="red">*</span></label>
				<span class="custom-dropdown custom-dropdown--white">
					<?php 
					echo $this->Form->input('QUOTE_PREMIUM_MODE', array('required'=>'required','empty'=>'Pilih Frekuensi','options'=>$optFrek,'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
      <?php endif;?>
      
      
		</div>
		<hr class="redline"/>
		<div class="form-group">
			<center>
				<button class="btn-caf-green calculate" type="button" id="calculate-btn">
					Hitung Premi Saya
				</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i>
			</center>
		</div>			
		
		
		<div id="resultCalc">
		</form>
	</div>
	
</div>
</div>

<div class="hr hr-24"></div>


<script>
function showHC(){
  var a = 'days180';
  var b = 'days360';
  if($('#pp').val()==a || $('#pp').val()==b){
    $('#hc_hidden').show(500);
    $('#req_hcY,#req_hcT').prop("checked", false);
  }else{
    $('#hc_hidden').hide(500);
    $('#req_hcT').prop("checked", true);
  }
}
function checkHC(){
  var a = 'days180';
  var b = 'days360';
  if($('#pp').val()==a || $('#pp').val()==b){
    $('#hc_hidden').show(500);
  }else{
    $('#hc_hidden').hide(500);
  }
}

jQuery.validator.addMethod("summininsured", function(value, element) {
	return (value!=0 && parseInt(value.replace(/\D/g, '')) >= <?php echo $coverage['MinSumInsured']; ?> && parseInt(value.replace(/\D/g, '')) <= <?php echo $coverage['MaxSumInsured']; ?>) ;
}, "Uang pertanggungan harus diantara <?php echo rp($coverage['MinSumInsured']); ?>  dan <?php echo rp($coverage['MaxSumInsured']); ?> ");

$(".calculate").click(function(){ 
	if(valQuote.form()) {
		$(".calculate").prop('disabled', true);getCalc();
		ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
	}
});

function getCalc(){ 
	
	$.ajax({
		url: "<?php echo $this->Html->url('/front/cal_non_unitlink_ajax/');?>",
		type: "POST",
		cache: false,
		data: $('#formQuote').serialize(),
		beforeSend: function(){$("#loading").show(); },
		complete: function(){$("#loading").hide(); $(".calculate").prop('disabled', false);line=null; },
		success: function(msg){   $("#resultCalc").html(msg);$("#resultCalc").show(800);   }
	});
	
}

var valQuote = $("#formQuote").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		
	},
	messages: {
		"data[Personal][PROSPECT_DOB]": "Masukan tanggal lahir anda",
		"data[Personal][PROSPECT_GENDER]": "Pilih jenis kelamin",
		"data[Personal][SUM_INSURED]": {required: "Pilih uang pertanggungan"},
		"data[Personal][QUOTE_PREMIUM_LIFESPAN]": "Pilih periode pertanggungan",
		"data[Personal][QUOTE_DURATION_DAYS]": "Pilih periode pertanggungan",
		"data[Personal][DURATION_JAI]": "Pilih periode pertanggungan",
		"data[Personal][QUOTE_PREMIUM_MODE]": "Pilih frekuensi pembayaran premi anda",
		"data[Personal][HARD_COPY]": "Pilih Request Hard Copy",
	},
	errorPlacement: function(error, element) {
		if (element.is(":radio")) error.appendTo(element.parent('div'));
		else if (element.is("select")) error.appendTo(element.parent('span').parent('div'));
		else error.appendTo(element.parent("div").parent('div'));
	},
});


$("#up").maskMoney();
function validateNumb(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode( key );
	var regex = /[0-9]|\t|[\b]/;
	var point = document.getElementById('pp');
	var panjang = 2;
	if( regex.test(key)) {    
		if(point.value.length>=panjang	){
			point.value=point.value.substring(0, 1); 
		}
	} else{
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}

$('.tgl_lahir').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	startView:2,
	endDate:"-21y",
	startDate:"-<?php echo $product['max_adult_age']; ?>y",
}).on('changeDate', function(e){
	$(this).blur();
}).on('show', function(e){
	$(this).blur();
});

function unmask(){
	$('#up').val().replace(/\D/g, '');
}

$(".tgl").click(function(){
	$('.tgl_lahir').focus();
});

$('.regularpremi').maskMoney();


$(".regularpremi").change(function(){
	var regp = $(".regularpremi").val();
	//regularpremi2
	$(".regularpremi2").val(regp);
});
$(".premiumlifespan").change(function(){
	var ps = $(".premiumlifespan").val();
	//regularpremi2
	$(".premiumlifespan2").val(ps);
});

$(".product").change(function(){
	var pr = $(".product option:selected").text();
	//regularpremi2
	$(".tipeinvestasi").val(pr);
});

$(document).ready(function() {
  checkHC();
  
	var regp = $(".regularpremi").val();
	//regularpremi2
	$(".regularpremi2").val(regp);
	var ps = $(".premiumlifespan").val();
	//regularpremi2
	$(".premiumlifespan2").val(ps);
	var pr = $(".product option:selected").text();
	//regularpremi2
	$(".tipeinvestasi").val(pr);

	ga('send', 'pageview', '/get-a-quote/'); 
});

$(function() {
	$('#currency').maskMoney();
});

</script>

