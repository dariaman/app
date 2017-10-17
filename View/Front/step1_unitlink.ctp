 <?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>
 <style>
div.tooltip-inner {
  text-align: left;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  margin-bottom: 6px;
  background-color: #505050;
  font-size: 14px;
  max-width:600px;
}
 </style>
 <div class="row">
 	<div class="col-md-12">
 		<ol class="breadcrumb">
 			<li><a href="index.php">Home</a></li>
 			<li class="active">Purchasing Steps</li>
 			<li class="active">Dapatkan Quote <?php echo $product['product_description']; ?></li>
 		</ol>
 		<!--<div class="mainvisual-quote">
 		</div>-->
    <center><img src="<?php echo $this->Html->url('/')?>img/step1.jpg" class="img-responsive"></center>
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
	
	<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>
	<?php echo $this->Form->create('Personal',array('id'=>'formQuote','url'=>array('controller'=>'front','action'=>'step1_unitlink','id'=>$name,'?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
	$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); 
	echo $this->Form->hidden('product_id',array('value'=>$product['product_id']));
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
			echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '')); ?>
		</div>
	</div>
  
  <div class="form-group">
      <label class="col-sm-2 control-label">Request Hardcopy Buku Polis <a class="tooltip"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Secara umum JAGADIRI hanya akan menerbitkan e-policy untuk Anda; jika Anda menginginkan <i>hardcopy</i> Buku Polis, maka Anda akan dibebankan biaya tambahan sebesar Rp 50,000 untuk biaya pencetakan dan pengiriman buku polis.</div></span></a></label>
      <div class="col-sm-10">
        <?php 
          $option = array('Y'=>' &nbsp;Ya', 'T'=>' &nbsp;Tidak');
          echo $this->Form->radio('HARD_COPY', $option, array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote'));
        ?>
      </div>
    </div>
	
	<hr class="redline"/>
	
	<div class="form-group">
		<div class="col-sm-4">
			<label>Tipe Investasi<span class="red">*</span></label> <a href="#" id="mytooltip" data-html="true" data-toggle="tooltip" title="CAF Equity Fund: Investasi dengan dominasi dalam efek ekuitas.<br/>CAF Mixed Fund: Investasi ke dalam efek ekuitas, efek pendapatan tetap dan pasar uang.<br/>CAF Bond Fund: Investasi dengan dominasi dalam efek pendapatan tetap.<br/>CAF Money Market Fund: Investasi dengan dominasi dalam instrumen pasar uang atau efek pendapatan tetap."> <span class="glyphicon glyphicon-question-sign red"></span></a>
        <span class="custom-dropdown custom-dropdown--white">
				<?php echo $this->Form->input('QUOTE_PRIMARY_FUND_TYPE_ID', array('required'=>'required','empty'=>'Pilih Tipe Investasi','options'=>$optFund,'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>	
				</span>
		</div>

		<div class="col-sm-4">
			<label>Frekuensi Pembayaran Premi<span class="red">*</span></label>
			<span class="custom-dropdown custom-dropdown--white">
			<?php 
			echo $this->Form->input('QUOTE_PREMIUM_MODE', array('required'=>'required','empty'=>'Pilih Frekuensi','options'=>$optFrek,'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','id'=>'fpp','div'=>false )); ?>
			</span>		
		</div>
			 
		<div class="col-sm-4">
		<label>Premi yang Diinginkan<span class="red">*</span></label>
			<?php echo $this->Form->input('PREMI', array('required'=>'required', 'class'=>'text-right form-control', 'id'=>'up2','data-prefix'=>'Rp ','sumPremi0'=>true,'sumPremi1'=>true,'sumPremi2'=>true,'sumPremi3'=>true,'sumPremi4'=>true,'data-precision'=>0)); ?>
		</div>
		
	</div>
	
	<hr class="redline"/>
	
	<div class="form-group">
					<div class="col-sm-4">
						<label>Tipe Asuransi</label>
						<span class="custom-dropdown custom-dropdown--white">
				<select name="" class="form-control custom-dropdown__select custom-dropdown__select--white valid" required="required" id="" aria-required="true" aria-invalid="false" disabled="">
				<option value=""> Life Protection</option>
				</select>
			</span>
					</div>
					<div class="col-sm-4">
						<label>Uang Pertanggungan<span class="red">*</span></label>
						<?php 
				if($optUp[1]!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('1.SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp[1],'upLife'=>true,'div'=>false, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				
				else echo $this->Form->input('1.SUM_INSURED', array('required'=>'required','upLife'=>true,'summininsured'=>true, 'class'=>'text-right form-control','id'=>'up','data-prefix'=>'Rp ','data-precision'=>0)); ?>
					</div>
					<div class="col-sm-4">
						<label>Periode Pertanggungan<span class="red">*</span></label>
						<span class="custom-dropdown custom-dropdown--white">
						 <?php if(!isset($id['pp'])) echo $this->Form->input('QUOTE_PREMIUM_LIFESPAN', array('onChange'=>'changePeriod();','empty'=>'Pilih Periode','options'=>array(),'required'=>'required','class'=>'premiumlifespan form-control custom-dropdown__select custom-dropdown__select--white','div'=>false ,'id'=>'pp'));  
			?>
			</span>	
					</div>
	</div>
	
	<hr class="redline"/>
				
				
			<!-- 	<div class="form-group">
					<div class="col-sm-4" id="riderPK">
						<a href="#" onClick="return showRiderKecelakaan()"><span class="red bold">+ Perlindungan Kecelakaan</span></a>
					</div>
					<div class="col-sm-4" id="riderPKUP">
						
					</div>
					<div class="col-sm-4" id="riderPKPP">
						
					</div>
				</div> 
	<hr class="redline"/>
				<div class="form-group">
					<div class="col-sm-4" id="riderMPK">
						<a href="#" onClick="return showRiderKritis()"><span class="red bold">+ Manfaat Penyakit Kritis</span></a>
					</div>
					<div class="col-sm-4" id="riderMPKUP">
						
					</div>
					<div class="col-sm-4" id="riderMPKPP">
						
					</div>
				</div>
	<hr class="redline"/> -->
	
		<div class="form-group">
			<center>
				<button class="btn-caf-green calculate" type="button">
					Cek Investasi Saya
				</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i>
			</center>
		</div>			
	
	<div id="resultCalc">
	 
	</div>
	
	</div>
</div>

<div class="hr hr-24"></div>

<script>
$(function () {
  $('#mytooltip').tooltip()
})
</script>
<script type="text/javascript">

$(document).ready(function() {  
	getListPP($('#tgl_lahir').val());
	ga('send', 'pageview', '/get-a-quote/'); 
	<?php if(isset($this->request->data['Personal'][3]['SUM_INSURED'])):?>
	showRiderKecelakaan();
	<?php endif; ?>
	<?php if(isset($this->request->data['Personal'][4]['SUM_INSURED'])):?>
	showRiderKritis();
	<?php endif; ?>
});

function changePeriod (){
	 pr = $(".premiumlifespan option:selected").text();
	 $("#PKUP").html(pr);
	 $("#MPKUP").html(pr);
};

function showRiderKecelakaan(){
	$('#riderPK').html('');
	$('#riderPKUP').html('');
	$('#riderPKPP').html('');
	$('#riderPK').hide();
	$('#riderPK').html('<a href="#" onClick="return hideRiderKecelakaan()"><span class="red bold">- Perlindungan Kecelakaan</span></a>');
	$('#riderPKUP').html('<label>Uang Pertanggungan</label><?php 
				if($optUp[3]!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('3.SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp[3],'upKecelakaan'=>true,'div'=>false,'default'=>isset($this->request->data['Personal'][3]['SUM_INSURED'])?$this->request->data['Personal'][3]['SUM_INSURED']:null, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				else echo $this->Form->input('3.SUM_INSURED', array('required'=>'required','upKecelakaan'=>true,'summininsured'=>true,'default'=>isset($this->request->data['Personal'][3]['SUM_INSURED'])?$this->request->data['Personal'][3]['SUM_INSURED']:null, 'class'=>'regularpremi1 text-right form-control', 'id'=>'upPK','data-prefix'=>'Rp ','data-precision'=>0)); ?>');
	$('#riderPKPP').html('<label>Periode Pertanggungan</label><div class="row"><div class="col-md-3"></div><label class="col-md-12 control-label" id="PKUP">'+$(".premiumlifespan option:selected").text()+'</label></div>');
	$('#riderPK').show(500);
	$("#upPK").maskMoney();
	return false;
}
		
function hideRiderKecelakaan(){
	$('#riderPK').html('');
	$('#riderPKUP').html('');
	$('#riderPKPP').html('');
	$('#riderPK').hide();
	$('#riderPK').html('<a href="#" onClick="return showRiderKecelakaan()"><span class="red bold">+ Perlindungan Kecelakaan</span></a>');
	$('#riderPK').show(500);
	return false;
}

function showRiderKritis(){
	$('#riderMPK').html('');
	$('#riderMPKUP').html('');
	$('#riderMPKPP').html('');
	$('#riderMPK').hide();
	$('#riderMPK').html('<a href="#" onClick="return hideRiderKritis()"><span class="red bold">- Manfaat Penyakit Kritis</span></a>');
	$('#riderMPKUP').html('<label>Uang Pertanggungan</label><?php 
				if($optUp[4]!=null) echo '<span class="custom-dropdown custom-dropdown--white">'.$this->Form->input('4.SUM_INSURED', array('empty'=>'Pilih Uang Pertanggungan','required'=>'required','options'=>$optUp[3],'upPenyakit'=>true,'div'=>false,'default'=>isset($this->request->data['Personal'][4]['SUM_INSURED'])?$this->request->data['Personal'][4]['SUM_INSURED']:null, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white')).'</span>';
				else echo $this->Form->input('4.SUM_INSURED', array('required'=>'required','upPenyakit'=>true,'default'=>isset($this->request->data['Personal'][4]['SUM_INSURED'])?$this->request->data['Personal'][4]['SUM_INSURED']:null, 'class'=>'regularpremi1 text-right form-control', 'id'=>'upMPK','data-prefix'=>'Rp ','data-precision'=>0)); ?>');
	$('#riderMPKPP').html('<label>Periode Pertanggungan</label><div class="row"><div class="col-md-3"></div><label class="col-md-12 control-label" id="MPKUP">'+$(".premiumlifespan option:selected").text()+'</label></div>');
	$('#riderMPK').show(500);
	$("#upMPK").maskMoney();
	return false;
}
function hideRiderKritis(){
	$('#riderMPK').html('');
	$('#riderMPKUP').html('');
	$('#riderMPKPP').html('');
	$('#riderMPK').hide();
	$('#riderMPK').html('<a href="#" onClick="return showRiderKritis()"><span class="red bold">+ Manfaat Penyakit Kritis</span></a>');
	$('#riderMPK').show(500);
	return false;
}

function draw(){ 
if(line == null) 
  var line = new Morris.Line({
      element: 'line-chart', 
      data: dataChart,
      xkey: 'y',
      ykeys: ['item1'],
      xLabelAngle: 30,
      labels: ['Rp','Middle','Low'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto',
      parseTime:false,
      xLabelFormat:function (x) { return 'Tahun ke-'+x.label;}
  }); 
else line.setData(dataChart); 
			 
}
</script>
<script>
jQuery.validator.addMethod("upLife",
function(value, element) {
	value = value.replace(/\D/g, '');
	up = $('#up2').val().replace(/\D/g, '');	
	if($('#fpp').val()==1) {
		up=up*12*5;
	} else if($('#fpp').val()==3) {
		up=up*4*5;
	}
	else if($('#fpp').val()==6) {
		up=up*2*5;
	}
	else {
		up=up*5;
	}  
    if(up>100000000) up=100000000;	
	return ((value <= 100000000 && value >= up));
},function() { 
	value = $('#up').val().replace(/\D/g, '');
	up = $('#up2').val().replace(/\D/g, '');	
	if($('#fpp').val()==1) {
		up=up*12*5;
	} else if($('#fpp').val()==3) {
		up=up*4*5;
	}
	else if($('#fpp').val()==6) {
		up=up*2*5;
	}
	else {
		up=up*5;
	}
	if(value<=0 || value=='') return 'Masukan uang pertanggungan untuk Life Protection anda'; 
	else if(up > 100000000) return 'Maksimum dan Minimum Uang Pertanggungan adalah 100 juta'; 
	else return 'Uang pertanggungan harus diantara '+up.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' dan 100 juta';
});

var minPremi;
 function setMinPremi(id){
 minPremi=parseInt(id);
}
function getMinPremi(){
	return minPremi;
}

jQuery.validator.addMethod("sumPremi0", function(value, element) {
value=value.replace(/\D/g, '');
if ($('#fpp').val()==0) if(value<10000000) return false; 
return true;
}, "Minimal Premi adalah Rp 10,000,000 untuk pembayaran sekaligus");
jQuery.validator.addMethod("sumPremi1", function(value, element) {
value=value.replace(/\D/g, '');
if ($('#fpp').val()==1) if(value<300000) return false; 
return true;
}, "Minimal Premi adalah Rp 300,000 untuk pembayaran bulanan");
jQuery.validator.addMethod("sumPremi2", function(value, element) {
value=value.replace(/\D/g, '');
if ($('#fpp').val()==3) if(value<900000) return false; 
return true;
}, "Minimal Premi adalah Rp 900,000 untuk pembayaran triwulan");
jQuery.validator.addMethod("sumPremi3", function(value, element) {
value=value.replace(/\D/g, '');
if ($('#fpp').val()==6) if(value<1800000) return false; 
return true;
}, "Minimal Premi adalah Rp 1,800,000 untuk pembayaran semesteran");
jQuery.validator.addMethod("sumPremi4", function(value, element) {
value=value.replace(/\D/g, '');
if ($('#fpp').val()==12) if(value<3600000) return false; 
return true;
}, "Minimal Premi adalah Rp 3,600,000 untuk pembayaran tahunan");


jQuery.validator.addMethod("upKecelakaan", function(value, element) {
return (value!=0 && parseInt(value.replace(/\D/g, '')) >= <?php echo $coverage[3]['MinSumInsured']; ?> && parseInt(value.replace(/\D/g, '')) <= <?php echo $coverage[3]['MaxSumInsured']; ?>) ;
}, "Uang pertanggungan harus diantara <?php echo rp($coverage[3]['MinSumInsured']); ?>  dan <?php echo rp($coverage[3]['MaxSumInsured']); ?> ");

jQuery.validator.addMethod("upPenyakit", function(value, element) {
return (value!=0 && parseInt(value.replace(/\D/g, '')) >= <?php echo $coverage[4]['MinSumInsured']; ?> && parseInt(value.replace(/\D/g, '')) <= <?php echo $coverage[4]['MaxSumInsured']; ?>) ;
}, "Uang pertanggungan harus diantara <?php echo rp($coverage[4]['MinSumInsured']); ?>  dan <?php echo rp($coverage[4]['MaxSumInsured']); ?> ");

$(".calculate").click(function(){
	if(valQuote.form()) {
		ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
		$(".calculate").prop('disabled', true);getCalc();
	}
});

function getCalc(){ 
	 
	$.ajax({
		url: "<?php echo $this->Html->url('/front/cal_unitlink_ajax/');?>",
		type: "POST",
		cache: false,
		data: $('#formQuote').serialize(),
		beforeSend: function(){$("#loading").show(); },
		complete: function(){$("#loading").hide(); $(".calculate").prop('disabled', false);line=null; draw()},
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
		"data[Personal][PREMI]": {required: "Masukan jumlah premi yang diinginan"},
		"data[Personal][1][SUM_INSURED]": {required: "Masukan uang pertanggungan untuk Life Protection anda"},
		"data[Personal][3][SUM_INSURED]": {required: "Masukan uang pertanggungan untuk Perlindungan Kecelakaan"},
		"data[Personal][4][SUM_INSURED]": {required: "Masukan uang pertanggungan untuk Penyakit Kritis"},
		"data[Personal][QUOTE_PREMIUM_LIFESPAN]": "Pilih periode pertanggungan",
		"data[Personal][QUOTE_DURATION_DAYS]": "Pilih periode pertanggungan",
		"data[Personal][QUOTE_PREMIUM_MODE]": "Pilih frekuensi pembayaran premi anda",
		"data[Personal][QUOTE_PRIMARY_FUND_TYPE_ID]": "Pilih tipe investasi anda",
    "data[Personal][HARD_COPY]": "Pilih Request Hard Copy",
	},
	errorPlacement: function(error, element) {
		if (element.is(":radio")) error.appendTo(element.parent('div'));
		else if (element.is("select")) error.appendTo(element.parent('span').parent('div'));
		else error.appendTo(element.parent("div").parent('div'));
	},
});

$("#up").maskMoney();
$("#up2").maskMoney();
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
startDate:"-64y -6m",
}).on('changeDate', function(e){
	 getListPP(this.value);
     $(this).blur();
}).on('show', function(e){
     $(this).blur();
});
$(".tgl").click(function(){
	$('.tgl_lahir').focus();
});

function getListPP(date){
	data = [<?php foreach($optPP as $key=>$val): ?>"<?php echo  $key; ?>",<?php endforeach; ?>];
    age = getAge(date); 
	if(age>45) {
		data.length=70-age-5;
	}
	var x = document.getElementById("pp");
	x.options.length = 0;
	option = document.createElement("option");
	option.text = "Pilih Periode";
	option.value = "";
	x.add(option);
	for(i=0; i<data.length && date; i++){
		option = document.createElement("option");
		option.value = data[i];
		option.text = data[i]+" Tahun";
		x.add(option);
	}
}

function getAge(fromdate){
    todate= new Date('<?php echo date('Y-m-d'); ?>');
    var age= [], fromdate= new Date(fromdate),
    y= [todate.getFullYear(), fromdate.getFullYear()],
    ydiff= y[0]-y[1],
    m= [todate.getMonth(), fromdate.getMonth()],
    mdiff= m[0]-m[1],
    d= [todate.getDate(), fromdate.getDate()],
    ddiff= d[0]-d[1];

    if(mdiff < 0 || (mdiff=== 0 && ddiff<0))--ydiff;
    if(mdiff<0) mdiff+= 12;
    if(ddiff<0){
        fromdate.setMonth(m[1]+1, 0);
        ddiff= fromdate.getDate()-d[1]+d[0];
        --mdiff;
    }
    if(mdiff>=6 && ddiff>=1) ydiff+=1; 
	return ydiff;
}
</script>