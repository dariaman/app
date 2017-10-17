<script src="<?php echo $this->Html->url("/");?>linequiz-assets/js/jquery.js"></script>
<?php if(1==$step_stts): ?>
<script>
$(document).ready(function () {
    $('#startquiz').hide();
    $('#restart-quiz-button').click(function(event) {
        $('#restart-quiz').hide();
        $('#startquiz').show();
    });
});
</script>

<div class="wrapper line-quiz" id="restart-quiz">
  <div class="header-container row textmedium">
        <h1 class="winning-title">
            Waah sayang sekali!
        </h1>
    </div>
    <div class="body-container">
        <div class="quiz-desc textmedium">Hadiah belum berhasil diproses karena kamu belum mengisi data yang dibutuhkan.<br><br>
<span class="big-info">
    Lengkapi data dan konfirmasi hadiah dari <span class="red">JAGADIRI</span>?
</span>
         <div class="row">
         <div class="col-xs-6">
                 <a class="btn btn-green line-btn " href="#startquiz" id="restart-quiz-button" role="button" >
            Ya
        </a></div><div class="col-xs-6">  <a class="btn btn-green line-btn" href="https://www.jagadiri.co.id" target="_blank" role="button" >
            Tidak
        </a></div>
        </div>
         <span class="big-info">
    Mau tahu lebih banyak keuntungan asuransi tanpa beban <span class="red">JAGADIRI</span>?
</span>
         
                
         
        
        <a class="btn btn-green line-btn" href="https://www.jagadiri.co.id" target="_blank" >
            KLIK DISINI
        </a>
        </div>
        
        </div>
 
 <div class="footer row">
    <div  class="col-xs-12 small-info">Hadiah Dipersembahkan oleh:</div>
    <div class="col-sm-6 col-xs-5  logo-cont  text-right">
    <img class="line-logo" alt="line logo" src="<?php echo $this->Html->url("/");?>linequiz-assets/images/line-logo.png" /><br />
     </div>
     <div class="col-sm-6 col-xs-7 logo-cont text-left">
    <img class="line-logo" alt="line logo" src="<?php echo $this->Html->url("/");?>linequiz-assets/images/jagadiri-logo.png" /><br />
     </div>
 </div>
  
</div>
<?php endif; ?>
<div class="wrapper line-quiz" id="startquiz">
    <div class="header-container row textmedium">
    <img src="<?php echo $this->Html->url("/");?>linequiz-assets/images/jagadiri_icon_line_1.jpg" class="img-responsive">
        <h1 class="winning-title">
            Selamat! Kamu adalah<br />  1 dari 600<br /> Pemenang <br />Asuransi GRATIS <br />dari JAGADIRI
        </h1>
    </div>
    <div class="body-container">
        <div class="quiz-desc textmedium">
            <span class="textbold big-info">Kamu mendapatkan <span class="red">30 hari </span><br /> perlindungan kecelakaan dengan <br />
        <span class="red">Jaga Aman Bersama</span></span>
        
                <ul class="prize-info textmedium">
                    <li>Uang Pertanggungan meninggal dunia akibat kecelakaan :<br/> <span class="red">Rp 25 Juta</span></li>
                    <li>Uang Pertanggungan perawatan rumah sakit akibat kecelakaan :<br/> <span class="red">Rp 2,5 Juta</span></li>
                </ul>
      
         <hr>
            <span class="textmedium small-info">Isi data dibawah ini untuk konfirmasi data pemenang.</span><br/>
          <p class="why-data"><small>Kenapa kami perlu data kamu</small><span class="q-mark">?</span></p>
          <div id="why-data-content" class="why-data-content"><small>Data kamu dibutuhkan sebagai data acuan tim JAGADIRI untuk keperluan proses klaim uang pertanggungan.
Harap mengisi data dengan benar sehingga kamu bisa menikmati perlindungan seutuhnya.</small></div>
         <div class="form-container">
         <?php echo $this->Form->create('Personal',array('url'=>array('controller'=>'front','action'=>'linequiz_send','?'=>$this->request['url']),'class'=>'form-ahliwaris line-form','role'=>'form','novalidate'=>true)); ?> 
                <div class="form-group">
                    <label for="nama">Nama<span class="red">*</span></label>
                    <?php echo $this->Form->input('PROSPECT_NAME', array('required'=>'required','class'=>'form-control','div'=>false, 'label'=>false )); ?>
                </div> 
                <div class="form-group">
                    <label for="taggallahir">Tanggal Lahir<span class="red">*</span></label>
                    <div class="input-group date form_date form_date_customer col-md-5">
                    <?php echo $this->Form->input('PROSPECT_DOB', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'tgl_lahir','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir col-xs-2 col-md-3 form-control', 'div'=>false,'label' => false)); ?>
                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"> </span></span>
                </div>                </div>
                <div class="form-group">
                <label for="jenisKelamin">Jenis Kelamin<span class="red">*</span></label><br />
                    
                <?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
                echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
                    
                </div>
                 
                <div class="form-group">
                    <label for="telp">No. Telepon<span class="red">*</span></label>
                    <?php echo $this->Form->input('PROSPECT_MOBILE_PHONE', array('required'=>'required','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','div'=>false,'id'=>'phone','label' => false)); ?>
                </div> 
                <div class="form-group">
                    <label for="email">Email<span class="red">*</span></label>
                     <?php echo $this->Form->input('PROSPECT_EMAIL', array('required'=>'required','class'=>'form-control','div'=>false,'label' => false)); ?>
                </div> 
                <hr>
                <h5>Data ahli waris</h5>
                <div class="form-group">
                    <label for="namaAhliwaris">Nama<span class="red">*</span></label>
                    <?php echo $this->Form->input('PROSPECT_NAME_WARIS', array('required'=>'required','class'=>'form-control','div'=>false, 'label'=>false )); ?>
                </div> 
                <div class="form-group">
                    <label for="taggallahirAhliwaris">Tanggal Lahir<span class="red">*</span></label>
                    <div class="input-group date form_date form_date_aw col-md-5">
                    <?php echo $this->Form->input('PROSPECT_DOB_WARIS', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'tgl_lahir','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir col-xs-2 col-md-3 form-control', 'div'=>false,'label' => false)); ?>
                    
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"> </span></span>
                </div>                </div>
                <div class="form-group">
                <label for="jenisKelamin">Jenis Kelamin<span class="red">*</span></label><br />
                <?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
                echo $this->Form->radio('PROSPECT_GENDER_WARIS', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
                    
                </div>
                <div class="form-group">
                        <label for="hubunganKeluarga">Hubungan<span class="red">*</span></label>
                            <?php echo $this->Form->input('RELATIONSHIP_ID_WARIS', array('empty'=>'Pilih Hubungan','options'=>$optHub,'class'=>'form-control','required'=>'required','legend'=>false,'before' => ' ','after' => '', 'label' => false)); ?>

                    </div>
                 <div class="form-group">
                    <small>*Saya menyetujui bahwa data yang saya berikan di atas adalah benar.
                    <br><br>
                    *Data akan diproses sebagai data acuan untuk kebutuhan proses klaim.
                    </small>
                    
                </div>
                <button class="btn-green line-btn-kirim" >
                    KIRIM
                </button>
                 
            </form>
        </div>
        </div>
 
   <div class="footer row">
    <div  class="col-xs-12 small-info">Hadiah Dipersembahkan oleh:</div>
    <div class="col-sm-6 col-xs-5  logo-cont  text-right">
    <img class="line-logo" alt="line logo" src="<?php echo $this->Html->url("/");?>linequiz-assets/images/line-logo.png" /><br />
       </div>
       <div class="col-sm-6 col-xs-7 logo-cont text-left">
    <img class="line-logo" alt="line logo" src="<?php echo $this->Html->url("/");?>linequiz-assets/images/logo_lp.png" /><br />
       </div>
   </div>

</div>
    
<script src="/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo $this->Html->url("/");?>linequiz-assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Html->url("/");?>linequiz-assets/js/bootstrap-datepicker.min.js" charset="UTF-8"></script>
<script>
    $('.form_date_customer').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startView:2,
        endDate:"-21y",
        startDate:"-64y",
    }).on('changeDate', function(e){
        $(this).blur();
    }).on('show', function(e){
      $(this).blur();
    });
    
        $('.form_date_aw').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startView:2,
        endDate:"-0y",
        startDate:"-64y",
    }).on('changeDate', function(e){
        $(this).blur();
    }).on('show', function(e){
      $(this).blur();
    });
    
    $('.why-data').click(function() {
      $('.why-data-content').toggle();
    });
    var valQuote = $("#PersonalLinequizIndexForm").validate({
        errorElement: "span",
        focusCleanup: true,
        focusInvalid:false,
    rules: {
        "data[Personal][PROSPECT_EMAIL]":{ required:true, email:true}
    },
    messages: {
        "data[Personal][PROSPECT_NAME]": "Masukan nama anda",
        "data[Personal][PROSPECT_DOB]": "Masukan tanggal lahir anda",
        "data[Personal][PROSPECT_GENDER]": "Pilih jenis kelamin",
        "data[Personal][PROSPECT_EMAIL]": {required:"Masukan Email Anda",email:"Email anda belum valid"},
        "data[Personal][PROSPECT_NAME_WARIS]": "Masukan nama ahli waris anda",
        "data[Personal][PROSPECT_DOB_WARIS]": "Masukan tanggal lahir ahli waris anda",
        "data[Personal][PROSPECT_GENDER_WARIS]": "Pilih jenis kelamin",
        "data[Personal][PROSPECT_MOBILE_PHONE_WARIS]": "Masukan no. telepon ahli waris anda",
        "data[Personal][PROSPECT_EMAIL_WARIS]": "Masukan email ahli waris anda",
        "data[Personal][RELATIONSHIP_ID_WARIS]": "Pilih hubungan dengan ahli waris anda",
    },
    errorPlacement: function(error, element) {
        if (element.is(":radio")) error.appendTo(element.parent('div'));
        else if (element.is("#tgl_lahir")) error.appendTo(element.parent("div").parent('div'));
        else error.appendTo(element.parent("div"));
    },
});

jQuery.validator.addMethod("validplus", function(value, element) {
    conv = value.substring(0,3);
    if(conv == '+62') return false;
    return true;
}, "Silahkan ubah +62 ke 0 ");

jQuery.validator.addMethod("validlength", function(value, element) {
    if(value.length >0 && value.length <8) return false;
    return true;
}, "Nomor yang Anda masukan kurang dari 8 angka");

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
</script>   