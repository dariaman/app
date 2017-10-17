<br>
<br>

<section class="container-fluid">
<div class="baris">
	<?php
		if(isset($_POST['register']) ? $_POST['register'] : false){
			$nama = isset($_POST['insuredName']) ? $_POST['insuredName'] : '';
			
		}
	?>
	<!--<form method="post" action="registerForm.php" class="form-note" id="registerForm">-->
	<?php 
		echo $this->Form->create('DtGojek',array('id'=>'DtGojek','class'=>'form-note','role'=>'form','type' => 'post','novalidate'=>true)); 
		$this->Form->inputDefaults(array('label' => false));
	?>
		
		<div class="note-section col-xs-12">
			<label for="insuredName" class="label-form-note">Nama Tertanggung</label>
			<input name="data[DtGojek][insuredName]" id="insuredName" type="text"  class="input-borderless" required>
	<?php 
		//echo $this->Form->input('insuredName', array('id'=>'insuredName', 'placeholder' => 'Nama Tertanggung', 'class'=>'input-borderless', 'div'=>false, 'type'=>'text'));
	?>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredPOB" class="label-form-note">Tempat Lahir</label>
			<input name="data[DtGojek][insuredPOB]" type="text"  class="input-borderless" required>
	<?php 
		//echo $this->Form->input('insuredPOB', array('id'=>'insuredPOB', 'placeholder' => 'Tempat Lahir', 'class'=>'input-borderless', 'div'=>false, 'type'=>'text'));
	?>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredSex" class="label-form-note">Jenis Kelamin</label>
			<div class="radio-group">
				<input id="sexMale" name="data[DtGojek][insuredSex]" value="M" type="radio" checked><label class="col-xs-6 radio-btn" for="sexMale">Pria</label>
				<input id="sexFemale" name="data[DtGojek][insuredSex]" value="F" type="radio"><label class="col-xs-6 radio-btn" for="sexFemale">Wanita</label>
			</div>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredMaritalStatus" class="label-form-note">Status Perkawinan</label>
			<div class="radio-group">
				<input id="maritusSingle" name="data[DtGojek][insuredMaritalStatus]" value="0" type="radio" checked><label class="col-xs-6 radio-btn" for="maritusSingle">Single</label>
				<input id="maritusMarried" name="data[DtGojek][insuredMaritalStatus]" value="1" type="radio"><label class="col-xs-6 radio-btn" for="maritusMarried">Menikah</label>
			</div>
		</div>

		<!--<input id="tempBtn" type="submit" value="Print to Console">-->
		
		<div class="note-section col-xs-12">
			<label for="insuredDOB" class="label-form-note">Tanggal Lahir</label>
			<input type="text" class="input-borderless date-picker" name="data[DtGojek][insuredDOB]" id="insuredDOB" data-date-format="yyyy-mm-dd" >
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredSSN" class="label-form-note">No. KTP</label>
			<input name="data[DtGojek][insuredSSN]" type="text"  class="input-borderless numeric" required>
			<span class="error" id="error-message-insuredSSN"></span>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredPhone" class="label-form-note">Nomor Telp.</label>
			<input name="data[DtGojek][insuredPhone]" type="text"  class="input-borderless numeric" required>
			<span class="error" id="error-message-insuredPhone"></span>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredAddress" class="label-form-note">Alamat Rumah</label>
			<textarea name="data[DtGojek][insuredAddress]" rows="4"  class="input-borderless" required></textarea>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredCity" class="label-form-note">Kota</label>
			<input name="data[DtGojek][insuredCity]" type="text"  class="input-borderless" required>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredZipCode" class="label-form-note">Kode Pos</label>
			<input name="data[DtGojek][insuredZipCode]" type="text" class="input-borderless numeric" required>
			<span class="error" id="error-message-insuredZipCode"></span>
		</div>

		<div class="note-section col-xs-12">
			<label for="insuredEmail" class="label-form-note">Alamat Email</label>
			<input name="data[DtGojek][insuredEmail]" id="insuredEmail" type="text" class="input-borderless" required>
		</div>
		
		
		<div class="note-section col-xs-12">
			<label for="insuredHeirName" class="label-form-note">Nama Ahli Waris</label>
			<input name="data[DtGojek][insuredHeirName]" id="insuredHeirName" type="text"  class="input-borderless" required>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredHeirRelation" class="label-form-note">Hubungan Ahli Waris</label>
			<select name="data[DtGojek][insuredHeirRelation]" id="insuredHeirRelation" class="dropdown input-borderless">
				<option value="" disabled selected>Pilih satu...</option>
				<option value="1">Suami/Istri</option>
				<option value="2">Anak</option>
				<option value="3">Ayah/Ibu</option>
				<option value="4">Adik</option>
				<option value="5">Kakak</option>
				<option value="6">Cucu</option>
			</select>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredHeirDOB" class="label-form-note">Tanggal Lahir Ahli Waris</label>
			<input type="text" class="input-borderless date-picker" name="data[DtGojek][insuredHeirDOB]" id="insuredHeirDOB" data-date-format="yyyy-mm-dd" >
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredHeirPhone" class="label-form-note">Nomor Telp.</label>
			<input name="data[DtGojek][insuredHeirPhone]" type="text"  class="input-borderless numeric" required>
			<span class="error" id="error-message-insuredHeirPhone"></span>
		</div>
		
		<div class="note-section col-xs-12">
			<label for="insuredHeirEmail" class="label-form-note">Alamat Email</label>
			<input name="data[DtGojek][insuredHeirEmail]" id="insuredHeirEmail" type="text"  class="input-borderless" required>
		</div>
		
		<br>
		<br>

		<!--<div class="note-section deep">
			<h3>
				Jaga Aman Bersama<br>Jaga Aman Bersama adalah produk asuransi yang memberikan perlindungan jiwa bagi nasabah atas resiko kecelakaan. Produk ini tidak dapat diperpanjang dan pembayaran premi hanya sekali di awal Polis.
			</h3>
			<h3>
				Manfaat Produk<br>
				- Manfaat Santunan Meninggal Dunia akibat Kecelakaan<br>
				&nbsp Santunan berupa 100% uang pertanggungan jika Tertanggung meninggal dunia karena kecelakaan sebesar Rp25.000.000<br>
				- Manfaat Santunan Perawatan Rumah Sakit akibat Kecelakaan<br>
				&nbsp Santunan berupa uang tunai sebagai pengganti biaya aktual perawatan rumah sakit akibat kecelakaan.<br>
				&nbsp Jumlah maksimal santunan yang diberikan selama masa perlindungan adalah Rp2.500.000.
			</h3>
		</div>-->

		<center><img src="/img/gojek/jab_desc.jpg" alt="JAB description" class="img-responsive" ></center>
		
		<div class="deep">
  <input type="checkbox" name="data[DtGojek][checkTermsAndCondition]"  id="checkTermsAndCondition"> <label for="checkTermsAndCondition"> Saya setuju dan juga telah membaca dan memahami Syarat dan Ketentuan dari PT Central Asia Financial (JAGADIRI) dan Produk ini</label><br>
  <input type="checkbox" name="data[DtGojek][checkOfferProduct]"  id="checkOfferProduct"> <label for="checkOfferProduct"> Saya setuju untuk diberikan penawaran atas program Asuransi lain dari JAGADIRI</label><br>

		</div>
		
		<input id="registerNow" name="register" type="button" value="DAFTAR SEKARANG" class="center btn-info">
	</form>
</div>
</section>

<footer class="body">
</footer>


<script type="text/javascript">
	//$('.date-picker').datepicker();

$('#insuredDOB').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startView:2,
endDate:"-21y",
startDate:"-69y",
}).on('changeDate', function(e){
     $(this).blur();
}).on('show', function(e){
     $(this).blur();
});


$('#insuredHeirDOB').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startView:2,
endDate:"-0y",
startDate:"-69y",
}).on('changeDate', function(e){
     $(this).blur();
}).on('show', function(e){
     $(this).blur();
});
	$(document).ready(function () {

    $("#insuredHeirRelation").children("option[value^='1']").hide();
    $("#insuredHeirRelation").children("option[value^='2']").hide();

	  //called when key is pressed in textbox
	  $(".numeric").keypress(function (e) {
		 //if the letter is not digit then display error and don't type anything
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			//display error message
			$("#error-message-"+e.target.name).html("Number Only").show().fadeOut("slow");
			   return false;
		}
	   });
	});
 // document.getElementById('tempBtn').addEventListener("click",function(){
	 // console.log(document.getElementById('sexMale').checked);
	 // console.log(document.getElementById('sexFemale').checked);
	 // console.log(document.getElementById('maritusSingle').checked);
	 // console.log(document.getElementById('maritusMarried').checked);
	 // });
</script>


<script>
	var valQuote = $("#DtGojek").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[DtGojek][insuredName]":{ required:true, minlength:4 , wordonly:true},
		"data[DtGojek][insuredPOB]":{ required:true, wordonly:true},
		"data[DtGojek][insuredSex]":{ required:true},		
		"data[DtGojek][insuredMaritalStatus]": { required:true},
		"data[DtGojek][insuredDOB]": { required:true},
		"data[DtGojek][insuredSSN]": { required:true, numberonly:true, maxlength:16,minlength:16},
		"data[DtGojek][insuredPhone]": { required:true, numberonly:true, validNotelp:true, validplus:true,validlength:true},
		"data[DtGojek][insuredAddress]": { required:true},
		"data[DtGojek][insuredEmail]": { required:true, myEmail:true},
		"data[DtGojek][insuredCity]": { required:true, wordonly:true},
		"data[DtGojek][insuredZipCode]": { required:true,  numberonly:true, maxlength:5,minlength:5},
		"data[DtGojek][insuredHeirName]": { required:true, minlength:4, wordonly:true},
		"data[DtGojek][insuredHeirRelation]": { required:true},
		"data[DtGojek][insuredHeirDOB]": { required:true},
		"data[DtGojek][insuredHeirPhone]": { required:true, numberonly:true, validNotelp:true, validplus:true,validlength:true},
		"data[DtGojek][insuredHeirEmail]": { required:true, myEmail:true},
		"data[DtGojek][checkTermsAndCondition]": { required:true},
		//"data[DtGojek][checkOfferProduct]": { required:true},

	},
	messages: {
		"data[DtGojek][insuredName]":{ required:"masukkan nama anda", minlength:"nama min 4 karakter", wordonly:"Kolom Nama hanya dapat diisi menggunakan alfabet"},		
		"data[DtGojek][insuredPOB]":{ required:"masukkan tempat lahir anda",wordonly:"Kolom Tempat Lahir hanya dapat diisi menggunakan alfabet"},		
		"data[DtGojek][insuredSex]":{ required:"pilih salah satu"},		
		"data[DtGojek][insuredMaritalStatus]": { required:"pilih salah satu"},
		"data[DtGojek][insuredDOB]": { required:"masukkan tanggal lahir"},
		"data[DtGojek][insuredSSN]": { required:"masukkan nomor ktp anda", numberonly:"nomor ktp hanya angka", maxlength:"nomor ktp belum valid" , minlength:"nomor ktp belum valid" },
		"data[DtGojek][insuredPhone]": { required:"masukkan nomor telepon ahli waris anda", numberonly:"nomor telepon hanya angka", validNotelp:"nomor telepon yang anda masukkan belum valid", validplus:"Silahkan Rubag +62 ke 0 ", validlength:"nomor telepon yang anda masukkan belum valid"},
		"data[DtGojek][insuredAddress]": { required:"masukkan alamat anda"},
		"data[DtGojek][insuredEmail]": { required:"masukkan alamat email anda", myEmail:"alamat email belum valid"},
		"data[DtGojek][insuredCity]": { required:"masukkan kota anda",wordonly:"kota hanya huruf"},
		"data[DtGojek][insuredZipCode]": { required:"masukkan kode pos anda", numberonly:"kode pos hanya angka",maxlength:"kode pos hanya 5 digit",minlength:"kode pos 5 kurang dari digit" },
		"data[DtGojek][insuredHeirName]": { required:"masukkan nama ahli waris anda",minlength:"nama ahli waris min 4 karakter" ,wordonly:"nama ahli waris hanya huruf"},
		"data[DtGojek][insuredHeirRelation]": { required:"masukkan relasi ahli waris dengan anda"},
		"data[DtGojek][insuredHeirDOB]": { required:"masukkan tanggal lahir ahli waris anda"},
		"data[DtGojek][insuredHeirPhone]": { required:"masukkan nomor telepon ahli waris anda", numberonly:"nomor telepon hanya angka", validNotelp:"nomor telepon yang anda masukkan belum valid", validplus:"Silahkan Rubag +62 ke 0 ", validlength:"nomor telepon yang anda masukkan belum valid"},
		"data[DtGojek][insuredHeirEmail]": { required:"masukkan alamat email ahli waris anda", myEmail:"alamat email belum valid"},
		"data[DtGojek][checkTermsAndCondition]": { required:"centang disini apabila anda setuju"},
		//"data[DtGojek][checkOfferProduct]": { required:"centang disini apabila anda setuju"},

	},
	errorPlacement: function(error, element) {
	error.insertBefore(element);

	},
});

jQuery.validator.addMethod("numberonly", function(value, element) {

	if(/^[0-9]*$|\./.test( value ) )
	{return true;}
	else{return false;} 
}, "Tahun motor yang Anda masukkan tidak valid");


jQuery.validator.addMethod("wordonly", function(value, element) {

	if(/^[a-zA-Z_ ]*$|\./.test( value ) )
	{return true;}
	else{return false;} 
}, "Tahun motor yang Anda masukkan tidak valid");

jQuery.validator.addMethod("validlength", function(value, element) {
if(value.length >0 && value.length <8) return false;
return true;
}, "Nomor telepon yang Anda masukkan tidak valid");

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
}, "Nomor yang Anda masukan tidak valid");

jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Silahkan Rubag +62 ke 0 ");

jQuery.validator.addMethod("validlength", function(value, element) {
if(value.length >0 && value.length <8) return false;
return true;
}, "Nomor telepon yang Anda masukkan tidak valid");

jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Email anda belum valid');



$('#registerNow').click(function (e) {
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_email_jab/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#insuredEmail').val()},
		beforeSend: function(){ $("#registerNow").prop('disabled', true); },
		complete: function(){ 	$("#registerNow").prop('disabled', false); },
		success: function(msg,e){ 
		//alert(msg); 

		if( $('#insuredEmail').val()==$('#insuredHeirEmail').val() )
			alert('Email Ahli waris tidak boleh sama dengan email Tertanggung');
		else if(msg==0) 
			$("#DtGojek").submit(); 
		else if(msg==1) 
			alert('Email yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
		//else if(msg==02) 
		//	alert('Email Ahli waris yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
		//else if(msg==12) 
		//	alert('Email Anda dan Email Ahli waris yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
		else {
			alert('Terjadi kesalahan.\nServer Busy.');
			//alert(msg);
			//$("#DtGojek").submit(); 
			}
		}
	});
	return false;
});

$("#maritusSingle").change(function () {
    //$("#insuredHeirRelation").children('option').hide();
    $("#insuredHeirRelation").children("option[value^='1']").hide();
    $("#insuredHeirRelation").children("option[value^='2']").hide();
}) 

$("#maritusMarried").change(function () {
    $("#insuredHeirRelation").children('option').show();
    $("#insuredHeirRelation").children("option[value^='1']").show();
    $("#insuredHeirRelation").children("option[value^='2']").show();
})  

</script>