<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<!--<script type="text/javascript" src="../jsfiles/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../jsfiles/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>-->
<link href="../css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
<!--<link href="../cssfiles/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">-->
	
<?php App::import('Vendor', 'rupiah', array('file'=>'utility' . DS .'rupiah.php')); ?>

 <div class="row">
 	<div class="col-md-12">
 		<ol class="breadcrumb">
 			<li><a href="index.php">Home</a></li>
 			<li class="active">Purchasing Steps</li>
 			<li class="active">Dapatkan Quote </li>
 		</ol>
 		<!--<div class="mainvisual-quote">
 		</div>-->
    <!--<?php if($product['product_id']==11||$product['product_id']==23 || $product['product_id']==12 || $product['product_id']==13 || $product['product_id']==14 || $product['product_id']==17):?>
    <center style="margin: 0 0 20px;"><a href="https://www.jagadiri.co.id/promo/valentine-promo-2016.htm"><img src="/img/banner_top_small.jpg" class="img-responsive"></a></center>
	<?php endif;?>-->
    
    <?php
if($name!="jaga-motorku"){ ?>
    <center><img src="<?php echo $this->Html->url('/')?>img/step1.jpg" class="img-responsive"></center>
<?php }?>
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
 			<!--<span class="bold">Isi dan segera dapatkan penawaran <?php echo $prod_det['Product']['name'];//$product['product_description']; ?></span>-->
			<span class="bold">Dapatkan perhitungan premi Anda sekarang!</span>

 		</h2>
 		<h3 class="title-wajib">
 			<span class="red">*Wajib Diisi</span>
 		</h3>
 	</div>
 	<hr class="redline">
 </div>
</div>


<?php
if($name=="jaga-motorku"){ //hardcode jaga motor ?>

<div class="row">
	<div class="col-md-12">
		<?php 
		echo $this->Form->create('Personal',array('id'=>'formQuote','url'=>array('controller'=>'front','action'=>'step1_non_unitlink','id'=>$name,'?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
		//echo $this->Form->create('Personal',array('id'=>'formQuote','url'=>array('controller' =>'front', 'action'=>'step4_checkout','?'=>array('sid'=>$sid,'cat'=>$cat,'name'=>$name)),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));

		$this->Form->inputDefaults(array('class' => 'span6','label' => false,));

		echo $this->form->hidden('Personal.COVERAGE_TYPE_ID_1',array('value'=>$product['coverage_type_id']));
		//echo $this->form->hidden('Personal.COVERAGE_TYPE_ID_2',array('value'=>$product['coverage_type_id']));
		//echo $this->form->hidden('Personal.COVERAGE_TYPE_ID_3',array('value'=>$product['coverage_type_id']));

		echo $this->form->hidden('Personal.QUOTE_PREMIUM_MODE',array('value'=>"0"));
		
		echo $this->form->hidden('Personal.product_id',array('value'=>$product['product_id']));
				echo $this->form->hidden('Personal.manfaat',array('value'=>$prod_det['Product']['manfaat']));
		echo $this->form->hidden('Personal.seo',array('value'=>$product['product_description']));
		?>
		<div class="form-group">
		<label class="col-sm-3 control-label">No KTP<span class="red">*</span></label>
			<div class="col-sm-8">
			<div>
			<?php echo $this->Form->input('PROSPECT_KTP', array('required'=>'required', 'class'=>'form-control','div'=>false,'id'=>'ktp')); ?>
			</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Nama Sesuai KTP <span class="red">*</span></label>
			<div class="col-sm-8">
				<div>
				<?php echo $this->Form->input('PROSPECT_NAME', array('required'=>'required','class'=>'form-control','div'=>false,'id'=>'nama_ph' )); ?>
				</div>				
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Tanggal Lahir<span class="red">*</span></label>
			<div class="col-sm-8">
				<div class="input-group"><?php echo $this->Form->input('PROSPECT_DOB', array('required'=>'required','id'=>'dob','onKeyup'=>"this.value='';",'id'=>'tgl_lahir','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir col-xs-2 col-md-3 form-control', 'div'=>false, 'id'=>'dob_ph')); ?>
					<span class="input-group-addon tgl red"><i class="fa fa-calendar"></i></span>
				</div>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Jenis Kelamin<span class="red">*</span></label>
			<div class="col-sm-8">
				<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
				echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote', 'id'=>'gender_ph')); ?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Alamat tempat tinggal sesuai KTP <span class="red">*</span></label>
			<div class="col-sm-8">
				<div >
				 <?php echo $this->Form->input('PROSPECT_ADDRESS', array('required'=>'required','class'=>'form-control','div'=>false,  )); ?>
        		 <span class="red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.</span>
	 			 <span class="red"><br />*Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Medan dan sekitarnya.</span>

				</div>
			</div>	
		</div>

		
		<div class="form-group">
			<label class="col-sm-3 control-label">Provinsi<span class="red">*</span><a class="tooltips"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Alamat Anda kami butuhkan untuk memudahkan kami mengirimkan dokumen terkait polis asuransi.</div></span></a></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('PROSPECT_PROVINSI', array('required'=>'required','empty'=>'Pilih Provinsi','options'=>$provinsi, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">Kota<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkot" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('PROSPECT_KOTA', array('required'=>'required','empty'=>'Kota','options'=>$ph_kota, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Kecamatan<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkec" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('PROSPECT_KEC', array('required'=>'required','empty'=>'Kecamatan','options'=>$ph_kec, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Kelurahan<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkel" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('PROSPECT_KEL', array('required'=>'required','empty'=>'Kelurahan','options'=>$ph_kel, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>
	
		<div class="form-group">
			<label class="col-sm-3 control-label">E-mail<span class="red">*</span></label>
			<div class="col-sm-8">
			<div>
			<?php echo $this->Form->input('PROSPECT_EMAIL', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
			</div>	
			</div>
		</div>

		<div class="form-group">
		<label class="col-sm-3 control-label">Telp Selular<span class="red">*</span></label>
			<div class="col-sm-8">
			<div>
			<?php echo $this->Form->input('PROSPECT_MOBILE_PHONE', array('required'=>'required', 'class'=>'form-control','div'=>false,'id'=>'phone0')); ?>
			</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Request Buku Polis <span class="red">*</span></label>
			<div class="col-sm-8">
				<?php $options = array('Y' => '&nbsp;Ya ', 'N' => '&nbsp;Tidak ');
				echo $this->Form->radio('PROSPECT_REQ_BUKU', $options , array('onClick'=>'return cek_req_buku();','required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
			</div>
		</div>

		<div id="section_korespondensi_alamat" style="visibility:hidden;position:absolute;">
		<div class="form-group">
			<label class="col-sm-3 control-label">Alamat Korespondensi<span class="red">*</span></label>
			<div class="col-sm-8">
				<div>
				<?php $options = array('Y' => '&nbsp;Sama dengan alamat tempat tinggal ', 'N' => '&nbsp;Alamat lain ');
				echo $this->Form->radio('PROSPECT_KORESPONDENSI', $options , array('onClick'=>'return cek_korespondensi();','required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote','id'=>'alamat_kirim_buku')); ?>
				</div>
			</div>
		</div>
		<div id="section_korespondensi" style="visibility:hidden;position:absolute;">
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-8">
				<div>
				 <?php echo $this->Form->input('KORESPONDENSI_ADDRESS', array('required'=>'false','class'=>'form-control','div'=>false )); ?>
        		 <span class="red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.</span>
	 			 <span class="red"><?php if($this->Session->read('Purchase.step1.product_id') =='11'||$this->Session->read('Purchase.step1.product_id') =='23'|| $this->Session->read('Purchase.step1.product_id') =='21' || $this->Session->read('Purchase.step1.product_id') =='5'):?><br />*Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Medan dan sekitarnya.<?php endif;?></span>

				</div>
			</div>	
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">Provinsi<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('KORESPONDENSI_PROVINSI', array('required'=>'required','empty'=>'Pilih Provinsi','options'=>$provinsi, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">Kota<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkot" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('KORESPONDENSI_KOTA', array('required'=>'required','empty'=>'Kota','options'=>$kor_kota, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Kecamatan<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkec" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('KORESPONDENSI_KEC', array('required'=>'required','empty'=>'Kecamatan','options'=>$kor_kec, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Kelurahan<span class="red">*</span></label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkel" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('KORESPONDENSI_KEL', array('required'=>'required','empty'=>'Kelurahan','options'=>$kor_kel, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>
	


		</div><!--id section korespondensi-->
		</div><!--id section korespondensi alamat-->

    
	<hr class="redline"/>
	

		<div class="clearfix">
		<h2 class="title-quote">
				<span class="bold">Data Tertanggung </span>
		</h2>
		</div>


	

		<div class="form-group">
			<label class="col-sm-5 control-label">Centang apabila tertanggung adalah pemegang polis</label>
			<div class="col-sm-5">
				<?php $options = array('Y' => '&nbsp;Ya ', 'T' => '&nbsp;Tidak ');
				echo $this->Form->radio('PROSPECT_PEMILIK', $options , array('onClick'=>'return cek_tertanggung_ph();','required'=>true,'legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
			</div>
		</div>

		<div id="section_tertanggung" style="visibility:hidden;position:absolute;">
		<div class="form-group">
		<label class="col-sm-3 control-label">No KTP<span class="red">*</span></label>
			<div class="col-sm-8">
			<div>
			<?php echo $this->Form->input('PROSPECT_KTP_PEMILIK', array('required'=>'required', 'class'=>'form-control','div'=>false,'id'=>'ktp2')); ?>
			</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Nama Sesuai KTP <span class="red">*</span></label>
			<div class="col-sm-8">
				<div>
				<?php echo $this->Form->input('PROSPECT_NAME_PEMILIK', array('required'=>'required','class'=>'form-control','div'=>false, 'id'=>'nama_tertanggung' )); ?>
				</div>
			</div>	
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Tanggal Lahir <span class="red">*</span></label>
			<div class="col-sm-8">
				<div class="input-group"><?php echo $this->Form->input('PROSPECT_DOB2', array('required'=>true,'id'=>'dob2','onKeyup'=>"this.value='';",'id'=>'tgl_lahir2','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir2 col-xs-2 col-md-3 form-control', 'div'=>false, 'id'=>'dob_tertanggung')); ?>
					<span class="input-group-addon tgl2 red"><i class="fa fa-calendar"></i></span>
				</div>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Jenis Kelamin <span class="red">*</span></label>
			<div class="col-sm-8">
				<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
				echo $this->Form->radio('PROSPECT_GENDER2', $options , array('required'=>true,'legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote', 'id'=>'gender_tertanggung')); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Hubungan dengan pemegang polis <span class="red">*</span></label>
		
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('RELATIONSHIP_ID', array('required'=>'true','empty'=>'Pilih Hubungan','options'=>$relasi_AH,'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false,'id'=>'hubungan_tertanggung_ph' )); ?>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Alamat tempat tinggal sesuai KTP <span class="red">*</span></label>
			<div class="col-sm-8">
				<div >
				 <?php echo $this->Form->input('PROSPECT_ADDRESS2', array('required'=>'required','class'=>'form-control','div'=>false,  )); ?>
        		 <span class="red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.</span>
	 			 <span class="red"><br />*Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Medan dan sekitarnya.</span>

				</div>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Provinsi</label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('PROSPECT_PROVINSI2', array('required'=>'required','empty'=>'Pilih Provinsi','options'=>$provinsi, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">Kota</label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkot2" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('PROSPECT_KOTA2', array('required'=>'required','empty'=>'Kota','options'=>$insured_kota, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Kecamatan</label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkec2" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('PROSPECT_KEC2', array('required'=>'required','empty'=>'Kecamatan','options'=>$insured_kec, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Kelurahan</label>
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loadingkel2" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('PROSPECT_KEL2', array('required'=>'required','empty'=>'Kelurahan','options'=>$insured_kel, 'class'=>'form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>			
		</div>

		</div><!-- end div section tertanggung-->

			<hr class="redline"/>
	
	<div class="clearfix">
		<h2 class="title-quote">
				<span class="bold">Data Motor</span>
		</h2>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Jenis Kendaraan <span class="red">*</span></label>
		
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('MEREK_MOTOR', array('required'=>'required','empty'=>'Merek','options'=>$merek, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>

			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white"><i id="loading_motor" style="display:none" class="fa fa-refresh fa-spin fa-lg"></i>
					<?php echo $this->Form->input('TYPE_MOTOR', array('required'=>'required','empty'=>'Type','options'=>$type_motor, 'class'=>'type form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>

		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Tahun Pembuatan <span class="red">*</span></label>
		
			<div class="col-sm-4">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('TAHUN_MOTOR', array('required'=>'required','empty'=>'Tahun','options'=>$optTahun, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>

		</div>

		<!--<div class="form-group">
			<label class="col-sm-3 control-label">Tahun Pembuatan <span class="red">*</span></label>
		
			<div class="col-sm-4">
				<div>
					<?php //// echo $this->Form->input('TAHUN_MOTOR', array('required'=>'required','empty'=>'Tahun','options'=>$optTahun, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
					<?php //echo $this->Form->input('TAHUN_MOTOR2', array('required'=>'required','class'=>'form-control','div'=>false ,'tahunMotor'=>'true','Motor1920'=>'true')); ?>
				</div>
				
			</div>

		</div>-->


		<div class="form-group">
			<label class="col-sm-3 control-label">No Rangka <span class="red">*</span></label>
			<div class="col-sm-8">
				<div>				
				<?php echo $this->Form->input('NO_RANGKA_MESIN', array('required'=>'required','class'=>'form-control','div'=>false, 'rangka_motor'=>'true' )); ?>
				</div>
			</div>	
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">No Mesin <span class="red">*</span></label>
			<div class="col-sm-8">
				<div>
				<?php echo $this->Form->input('NO_MESIN', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
				</div>
			</div>	
		</div>


		<div class="form-group">
			<label class="col-sm-3 control-label">No Polisi Kendaraan <span class="red">*</span></label>
			<div class="col-sm-2">
				<span class="custom-dropdown custom-dropdown--white">
					<?php echo $this->Form->input('NOPOL_A', array('required'=>'required','empty'=>'Kode Awal','options'=>$plat, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
			<div class="col-sm-4">
				<div>
				<?php echo $this->Form->input('NOPOL_B', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
				</div>
			</div>	
			<div class="col-sm-2">
				<div>
				<?php echo $this->Form->input('NOPOL_C', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
				</div>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Nama di STNK <span class="red">*</span></label>
			<div class="col-sm-8">
				<div>
				<?php $options = array('Y' => '&nbsp;Sama dengan KTP ', 'F' => '&nbsp;Tidak sama dengan KTP, sebutkan ');
				echo $this->Form->radio('PROSPECT_STNK', $options , array('onClick'=>'return cek_nama_stnk();','required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
				</div>
			</div>
		</div>


		<div id="section_stnk" style="visibility:hidden;position:absolute;">
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-8">
				<div>
				<?php echo $this->Form->input('PROSPECT_NAMA_STNK', array('required'=>'required','class'=>'form-control','div'=>false ,'id'=>'nama_stnk')); ?>
				</div>
			</div>
		</div>
		</div>
	  
		
	<hr class="redline"/>


<?php if($this->Session->read('Purchase.step1.product_id')!=21) :?>

	<?php /* if($this->Session->read('Purchase.step1.product_id')==7) $maxAH=1; else */ $maxAH=5; if(count($this->Session->read('Purchase.Ahliwaris'))<$maxAH): ?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Ahli Waris<span class="red">*</span></label>
				<div class="col-sm-2">
			<button type="button" class="btn btn-default2" onClick="addAh_button();//ga('send', 'event', 'customer', 'click', 'get a quote – tambah ahli waris'); ">
					Tambah Ahli Waris
			</button>
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->Session->check('Purchase.Ahliwaris')): ?>
	<div class="box-grey-top">
					<span class="bold">
					Ahli Waris
					</span>
			</div>
		<div class="table-responsive">
		<table class="table table-bordered" >
		<tr class="active"><td>No</td><td>Nama</td><td>Tanggal Lahir</td><td>Jenis Kelamin</td><td>Hubungan</td><td>Hapus</td></tr>
		<?php  $ahData = $this->Session->read('Purchase.Ahliwaris'); $i=0; while($i<count($ahData)): ?>
		<tr><td><?php echo ($i+1) ?></td><td><?php echo $ahData[($i+1)]['PROSPECT_NAME'] ?></td><td><?php echo $ahData[($i+1)]['PROSPECT_DOB'] ?></td><td><?php if($ahData[($i+1)]['PROSPECT_GENDER']=='F') echo "Perempuan"; else echo "Laki-laki"  ?></td><td><?php echo $ahData[($i+1)]['hubungan'] ?></td><td><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step1_del_aw','id'=>$name,'?'=>array_merge($this->request['url'],array('id'=>($i+1))))) ?>" onClick="ga('send', 'event', 'customer', 'click', 'get a quote – hapus'); return confirm('Yakin Ahli Waris <?php echo $ahData[($i+1)]['PROSPECT_NAME']  ?> dihapus?');" class="btn btn-default2">Hapus</a></td></tr>
		<?php $i++;endwhile; ?>
		</table>
		</div>	

	<?php endif; ?>

	<?php endif; //endif punya yg kalau bukan 21?>



		
		<hr class="redline"/>


		<!--<div class="form-group">
			<label class="col-sm-2 control-label">Periode Pembayaran <span class="red">*</span></label>
			<div class="col-sm-10">
				<span class="custom-dropdown custom-dropdown--white">
					<?php// $periode=array('12'=>"Tahunan");echo $this->Form->input('P_BAYAR', array('required'=>'required','empty'=>'Periode Pembayaran','options'=>$periode, 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
				</span>
			</div>
		
		</div>


	<hr class="redline"/>-->
		<div class="form-group">
			<center><?php //if( count($this->Session->read('Purchase.Ahliwaris'))>0 ){ ?>
				<button class="btn-caf-green calculate" type="button" id="calculate-btn">
					Hitung Premi Saya
				</button> <i id="loading" style="display:none;" class="fa fa-refresh fa-spin fa-lg"></i>
				<?php //} ?>
			</center>
		</div>			
		
		
		<div id="resultCalc">
		</form>
	</div>
	
</div>
</div>

<div class="hr hr-24"></div>

<div class="modal fade" id="modalaw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					 <h4 class="modal-title" id="aw-btn">Tambah Ahli Waris</h4>
				</div>
				<div class="modal-body">
					<!-- isi modal -->
					<?php echo $this->Form->create('Ahliwaris',array('url'=>array('controller'=>'front','action'=>'step1_add_ah','id'=>$name,'?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>true,'id'=>'FormAH',''=>array()));
					$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>

					<div class="form-group">
						<label class="col-md-3 control-label">Nama <span class="red">*</span></label>
						<div class="col-md-7">
							<?php echo $this->Form->input('PROSPECT_NAME', array('class'=>'form-control','required'=>'required')); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Lahir <span class="red">*</span></label>
						<div class="col-md-5">
							<div class="input-group" id="doob">
							<?php echo $this->Form->input('PROSPECT_DOB', array('onKeypress'=>'validateNumb(event)','class'=>'form-control','required'=>'required','placeholder' => __('YYYY-MM-DD'),'id'=>'ahdob')); ?>
							<span class="input-group-addon tgl red"><i class="fa fa-calendar"></i></span>
						</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin <span class="red">*</span></label>
						<div class="col-md-7">
							<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
			echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '')); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Hubungan <span class="red">*</span></label>
						<div class="col-md-7">
							<?php echo $this->Form->input('RELATIONSHIP_ID', array('empty'=>'Pilih Hubungan','options'=>$optHub,'class'=>'form-control','required'=>'required')); ?>
						</div>
					</div>

          <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <span class="red">Jika ahli waris berusia kurang dari 17 tahun</span>, harap masukkan data email wali ahli waris Anda, yaitu keluarga yang tidak serumah (sangat disarankan). Wali akan menerima informasi pertanggungan asuransi dan berhak mewakili untuk mengurus proses klaim selama ahli waris masih di bawah umur. <span class="red">Jika ahli waris di atas 17 tahun</span>, maka harap masukkan data email ahli waris Anda.
		  </div>

          <?php if($this->Session->read('Purchase.step1.product_id')=='7'):?>
          <div class="form-group">
            <label class="col-md-3 control-label">E-Mail *</label>
            <div class="col-md-7">
              <?php echo $this->Form->input('PROSPECT_EMAIL', array('required'=>'required','type'=>'email','class'=>'form-control')); ?>
            </div>
          </div>
          <?php else:?>
          <div class="form-group">
            <label class="col-md-3 control-label">E-Mail</label>
            <div class="col-md-7">
              <?php echo $this->Form->input('PROSPECT_EMAIL', array('type'=>'email','class'=>'form-control')); ?>
            </div>
          </div>
          <?php endif;?>

          <div class="form-group">
            <label class="col-md-3 control-label">No.Handphone</label>
            <div class="col-md-7">
              <?php echo $this->Form->input('PROSPECT_MOBILE_PHONE', array('type'=>'text','class'=>'form-control')); ?>
            </div>
          </div>

					<div class="form-group">
						<label class="col-md-3 control-label small" for="form-field-1">* Wajib diisi</label>
						<div class="col-md-2 ">
						</div>
					</div>

				</div>
				<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-primary" id="save_awr" onClick="checkAH2();">Simpan Ahli Waris</button>
					<button type="button" class="btn btn-default active" data-dismiss="modal">Tutup</button>
				</center>
				</div>
			</form>
		</div>
	</div>
</div>
<script>

$('#lanjutButtonJMK').click(function (e) {
	
	
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_email/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#PersonalPROSPECTEMAIL').val(),'name':$('#nama_ph').val()},
		beforeSend: function(){ $("#lanjutButton").prop('disabled', true); },
		complete: function(){ 	$("#lanjutButton").prop('disabled', false); },
		success: function(msg,e){  
		if(msg==1){ 
			alert("step 1");
			//$("#formQuote").submit();
			/*
			$.ajax({
				url: "<?php echo $this->Html->url('/front/jmk_cek_SI/');?>",
				type: "POST",
				cache: false,
				data: {},
				beforeSend: function(){},
				complete: function(){},
				success: function(msg,e){  
				alert(msg);
				if(msg==1){ 
				alert("atas");
					$("#formQuote").submit();
	
					//$(".calculate").prop('disabled', true);
					//getCalc();
					//ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
	
				}else {
					alert('Anda masukkan sudah melebihi batas ketentuan pembelian polis.\nSilakan menghubungi CS.');
					//alert(msg);
				}
			}	
			}); */
	
		}else if (msg==11) 
		alert('Ahli waris tidak boleh sama dengan Tertanggung');
		else {
			alert('Email yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
				//alert(msg);
			}
		}
	}); 
	


	/*
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_email_jmk/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#PersonalPROSPECTEMAIL').val(),'name':$('#nama_ph').val()},
		beforeSend: function(){ $(".lanjutButton").prop('disabled', true); },
		complete: function(){ 	$(".lanjutButton").prop('disabled', false); },
		success: function(msg,e){  
		alert(msg)
		if(msg==1){ 	
			//$("#formQuote").submit();
			$.ajax({
				url: "<?php echo $this->Html->url('/front/jmk_cek_SI/');?>",
				type: "POST",
				cache: false,
				data: {},
				beforeSend: function(){},
				complete: function(){},
				success: function(msg,e){  
				alert(msg)
				if(msg==1){ 
					$("#formQuote").submit();
	
					//$(".calculate").prop('disabled', true);
					//getCalc();
					ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
	
				}else {
					alert('Anda masukkan sudah melebihi batas ketentuan pembelian polis.\nSilakan menghubungi CS.');
					//alert(msg);
				}
			}	
			}); 
			
		}else if (msg==2){ 
			alert('maaf, anda tidak dapat melakukan pembelian polis, silahkan hubungi customer service kami!');
		}else if (msg==11){ 
			alert('Ahli waris tidak boleh sama dengan Tertanggung');
		}else {
			alert('Email yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
				//alert(msg);
			}
		}
	});

*/
			

			


	return false;
});



function sendPostDetail(id){
	$.ajax({
		url: "<?php echo $this->Html->url('/front/send_our_data/');?>",
		type: "POST",
		cache: false,
		data: $('#formQuote').serialize(),
		beforeSend: function(){ },
		complete: function(){},
		success: function(msg){
		if(id==1)  $('#modalaw').modal('show');
		else if(id==2) $('#modalta').modal('show');
		else if(id==3) {
			<?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==21 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==18): ?>
      if($('#confirm').val()=='Y')
      <?php else:?>
      if($('input[name="data[Detail][me]"]:checked').val()=='Y')
      <?php endif;?>
      {
      <?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==18): ?>
      $('#formQuote').append('<input type="hidden" name="data[Detail][me]" value="Y" />');
      <?php endif;?>
			postData("<?php echo $this->Html->url(array('controller'=>'front','action'=>'step2_add_ta','id'=>$name,'?'=>$this->request['url'])); ?>",{
				"data[_Token][key]":'<?php echo $this->Session->read('_Token.key'); ?>',
				"data[Tertanggung][INSURED_RELATIONSHIP_ID]":'1',
				"data[Tertanggung][PROSPECT_NAME]":document.getElementById("DetailPROSPECTNAME").value,
				"data[Tertanggung][PROSPECT_DOB]":'<?php echo $this->Session->read('Purchase.step1.PROSPECT_DOB'); ?>',
				"data[Tertanggung][PROSPECT_GENDER]":'<?php echo $this->Session->read('Purchase.step1.PROSPECT_GENDER'); ?>',
			});

			} else {
				if($("#linkhapusme").is("[href]")) location.href =  $("#linkhapusme").attr("href");
			}
		}
		}
	});
}

function addAh_button(){


	if(valQuote.form()) {

	$.ajax({
		url: "<?php echo $this->Html->url('/front/jmk_cal_non_unitlink_ajax/');?>",
		type: "POST",
		cache: false,
		data: $('#formQuote').serialize(),
		beforeSend: function(){},
		complete: function(){},
		success: function(msg){ }
	});
		<?php if(count($this->Session->read('Purchase.Ahliwaris'))==0): ?> sendPostDetail(1);
		<?php else: ?>  $('#modalaw').modal('show');   <?php endif; ?>
	}
};
function checkAH2(){
	if(FormAH.form()) {
		<?php $gaSend=array(4=>'cfl',5=>'dbd',7=>'jai',11=>'jsp',12=>'jj',13=>'ja', 14=>'jjp',15=>'jjp',17=>'jap',18=>'jap',21=>'jsk',23=>'jsp',24=>'jmk'); // ga code?>
		var x=ga('send', 'event', { eventCategory: 'Ahli Waris', eventAction: 'click', eventLabel: 'simpan - button - <?php echo $gaSend[24];?>'});
		//if (x){
		<?php  //  echo 'alert("'. $gaSend[24] .'");'; ?>
		checkAH();
		//}
	}
}


function checkAH(){
  if(FormAH.form()){

    if($('#AhliwarisPROSPECTEMAIL').val() == $('#PersonalPROSPECTEMAIL').val()){
      alert('Email yang anda masukan tidak boleh sama dengan\nEmail pemegang polis.'+$('#AhliwarisPROSPECTEMAIL').val()+"||"+$('#PersonalPROSPECTEMAIL').val() );
    }else{
      <?php if($this->Session->read('Purchase.step1.product_id')=='7'):?>
      $.ajax({
        url: "<?php echo $this->Html->url('/front/check_emailAH/');?>",
        type: "GET",
        cache: false,
        data: {'mobile':$('#AhliwarisPROSPECTMOBILEPHONE').val(),'email':$('#AhliwarisPROSPECTEMAIL').val(),'name':$('#AhliwarisPROSPECTNAME').val(),'dob':$('#ahdob').val(),'gender':$('input:radio[name="data[Ahliwaris][PROSPECT_GENDER]"]:checked').val()},
        beforeSend: function(){ $("#save_awr").prop('disabled', true); },
        complete: function(){ 	$("#save_awr").prop('disabled', false); },
        success: function(msg,e){
          if(msg==1){
            $("#FormAH").submit();
          }else {
            alert('Email yang Anda masukkan sudah pernah digunakan oleh nama lain.\nSilakan menggunakan email lain.');
          }
        }
      });
      return false;
      <?php else:?>
        $("#FormAH").submit();
      <?php endif;?>
    }

  }
}

$("#PersonalMEREKMOTOR").change(function(){
	var type = $("#PersonalMEREKMOTOR").val();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_typeMotor'); ?>"+type,cache: false,
		beforeSend: function(){$("#loading_motor").show();},
		complete: function(){$("#loading_motor").hide();},
		success: function(msg){$("#PersonalTYPEMOTOR").html(msg);},
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


$("#PersonalPROSPECTPROVINSI").change(function(){
	var provinsi = $("#PersonalPROSPECTPROVINSI option:selected").text();
	$('#PersonalPROSPECTKOTA').empty();
	$('#PersonalPROSPECTKEC').empty();
	$('#PersonalPROSPECTKEL').empty();
	if(provinsi =="SUMATRA UTARA"||provinsi =="SUMATERA UTARA"){
	alert ('Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Sumatra Utara.');
	document.getElementById("DetailPROSPECTPROVINSI1").selectedIndex = 0;	
	}else if(provinsi =="NANGGROE ACEH DARUSSALAM"){
	alert ('Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Nanggroe Aceh Darussalam.');
	}else{

	var type = $("#PersonalPROSPECTPROVINSI option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kota'); ?>"+type,cache: false,
		beforeSend: function(){$("#loadingkot").show();},
		complete: function(){$("#loadingkot").hide();},
		success: function(msg){$("#PersonalPROSPECTKOTA").html(msg);},
		"statusCode": {
			403: function() {
				window.location.href=""
			},
			500: function() {
				alert('Error Server Side occured');
			}
		}
	});
	}
});

$("#PersonalPROSPECTKOTA").change(function(){
	var type = $("#PersonalPROSPECTPROVINSI option:selected").text();
	var type2 = $("#PersonalPROSPECTKOTA option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kecamatan'); ?>",
		cache: false,
		data: {id: type, fk: type2},
		beforeSend: function(){$("#loadingkec").show();},
		complete: function(){$("#loadingkec").hide();},
		success: function(msg){$("#PersonalPROSPECTKEC").html(msg);},
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

$("#PersonalPROSPECTKEC").change(function(){
	var type = $("#PersonalPROSPECTPROVINSI option:selected").text();
	var type2 = $("#PersonalPROSPECTKOTA option:selected").text();
	var kec = $("#PersonalPROSPECTKEC option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kelurahan'); ?>",
		cache: false,
		data: {id: type, fk: type2, kec: kec},
		beforeSend: function(){$("#loadingkel").show();},
		complete: function(){$("#loadingkel").hide();},
		success: function(msg){$("#PersonalPROSPECTKEL").html(msg);},
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



$("#PersonalKORESPONDENSIPROVINSI").change(function(){
	var provinsi = $("#PersonalKORESPONDENSIPROVINSI option:selected").text();
	$('#PersonalKORESPONDENSIKOTA').empty();
	$('#PersonalKORESPONDENSIKEC').empty();
	$('#PersonalKORESPONDENSIKEL').empty();
	if(provinsi =="SUMATRA UTARA"||provinsi =="SUMATERA UTARA"){
	alert ('Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Sumatra Utara.');
	document.getElementById("DetailPROSPECTPROVINSI1").selectedIndex = 0;	
	}else if(provinsi =="NANGGROE ACEH DARUSSALAM"){
	alert ('Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Nanggroe Aceh Darussalam.');
	}else{

	var type = $("#PersonalKORESPONDENSIPROVINSI option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kota'); ?>"+type,cache: false,
		beforeSend: function(){$("#loadingkot").show();},
		complete: function(){$("#loadingkot").hide();},
		success: function(msg){$("#PersonalKORESPONDENSIKOTA").html(msg);},
		"statusCode": {
			403: function() {
				window.location.href=""
			},
			500: function() {
				alert('Error Server Side occured');
			}
		}
	});
	}
});

$("#PersonalKORESPONDENSIKOTA").change(function(){
	var type = $("#PersonalKORESPONDENSIPROVINSI option:selected").text();
	var type2 = $("#PersonalKORESPONDENSIKOTA option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kecamatan'); ?>",
		cache: false,
		data: {id: type, fk: type2},
		beforeSend: function(){$("#loadingkec").show();},
		complete: function(){$("#loadingkec").hide();},
		success: function(msg){$("#PersonalKORESPONDENSIKEC").html(msg);},
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

$("#PersonalKORESPONDENSIKEC").change(function(){
	var type = $("#PersonalKORESPONDENSIPROVINSI option:selected").text();
	var type2 = $("#PersonalKORESPONDENSIKOTA option:selected").text();
	var kec = $("#PersonalKORESPONDENSIKEC option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kelurahan'); ?>",
		cache: false,
		data: {id: type, fk: type2, kec: kec},
		beforeSend: function(){$("#loadingkel").show();},
		complete: function(){$("#loadingkel").hide();},
		success: function(msg){$("#PersonalKORESPONDENSIKEL").html(msg);},
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


$("#PersonalPROSPECTPROVINSI2").change(function(){
	var provinsi = $("#PersonalPROSPECTPROVINSI2 option:selected").text();
	$('#PersonalPROSPECTKOTA2').empty();
	$('#PersonalPROSPECTKEC2').empty();
	$('#PersonalPROSPECTKEL2').empty();

	if(provinsi =="SUMATRA UTARA"||provinsi =="SUMATERA UTARA"){
	alert ('Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Sumatra Utara.');
	document.getElementById("DetailPROSPECTPROVINSI2").selectedIndex = 0;	
	}else if(provinsi =="NANGGROE ACEH DARUSSALAM"){
	alert ('Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Nanggroe Aceh Darussalam.');
	}else{

	var type = $("#PersonalPROSPECTPROVINSI2 option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kota'); ?>"+type,cache: false,
		beforeSend: function(){$("#loadingkot2").show();},
		complete: function(){$("#loadingkot2").hide();},
		success: function(msg){$("#PersonalPROSPECTKOTA2").html(msg);},
		"statusCode": {
			403: function() {
				window.location.href=""
			},
			500: function() {
				alert('Error Server Side occured');
			}
		}
	});
	}
});

$("#PersonalPROSPECTKOTA2").change(function(){
	var type = $("#PersonalPROSPECTPROVINSI2 option:selected").text();
	var type2 = $("#PersonalPROSPECTKOTA2 option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kecamatan'); ?>",
		cache: false,
		data: {id: type, fk: type2},
		beforeSend: function(){$("#loadingkec2").show();},
		complete: function(){$("#loadingkec2").hide();},
		success: function(msg){$("#PersonalPROSPECTKEC2").html(msg);},
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

$("#PersonalPROSPECTKEC2").change(function(){
	var type = $("#PersonalPROSPECTPROVINSI2 option:selected").text();
	var type2 = $("#PersonalPROSPECTKOTA2 option:selected").text();
	var kec = $("#PersonalPROSPECTKEC2 option:selected").text();
	$.ajax({
		url: "<?php echo $this->Html->url('/front/ajax_kelurahan'); ?>",
		cache: false,
		data: {id: type, fk: type2, kec: kec},
		beforeSend: function(){$("#loadingkel2").show();},
		complete: function(){$("#loadingkel2").hide();},
		success: function(msg){$("#PersonalPROSPECTKEL2").html(msg);},
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

function cek_nama_stnk(){

	if($('input[name="data[Personal][PROSPECT_STNK]"]:checked').val()=='Y'){

		document.getElementById("section_stnk").style.position = 'absolute';
		document.getElementById("section_stnk").style.visibility = 'hidden';
		document.getElementById("nama_stnk").value = document.getElementById("nama_ph").value;
		$("#calculate-btn").trigger('click');
	}else{
		document.getElementById("nama_stnk").value ="";
		document.getElementById("section_stnk").style.position = 'relative';
		document.getElementById("section_stnk").style.visibility = 'visible';
	}
}

function cek_tertanggung_ph(){
  $("#calculate-btn").trigger('click');
	if($('input[name="data[Personal][PROSPECT_PEMILIK]"]:checked').val()=='Y'){
		document.getElementById("section_tertanggung").style.position = 'absolute';
		document.getElementById("section_tertanggung").style.visibility = 'hidden';
		document.getElementById("nama_tertanggung").value = document.getElementById("nama_ph").value;

		document.getElementById("ktp2").value = document.getElementById("ktp").value;
		document.getElementById("dob_tertanggung").value = document.getElementById("dob_ph").value;
		
		if(document.getElementById("gender_phM").checked==true){
			document.getElementById("gender_tertanggungM").checked = true;
		}else{
			document.getElementById("gender_tertanggungF").checked = true;
		}

		document.getElementById("PersonalPROSPECTADDRESS2").value = document.getElementById("PersonalPROSPECTADDRESS").value;	
		document.getElementById("PersonalPROSPECTPROVINSI2").value = document.getElementById("PersonalPROSPECTPROVINSI").value;

		var x1 = document.getElementById("PersonalPROSPECTKOTA2");
		var option = document.createElement("option");
		option.text = $("#PersonalPROSPECTKOTA option:selected").text();
		option.value = document.getElementById("PersonalPROSPECTKOTA").value;	
		x1.add(option);

		var x2 = document.getElementById("PersonalPROSPECTKEC2");
		var option = document.createElement("option");
		option.text = $("#PersonalPROSPECTKEC option:selected").text();
		option.value = document.getElementById("PersonalPROSPECTKEC").value;	
		x2.add(option);

		var x3 = document.getElementById("PersonalPROSPECTKEL2");
		var option = document.createElement("option");
		option.text = $("#PersonalPROSPECTKEL option:selected").text();
		option.value = document.getElementById("PersonalPROSPECTKEL").value;	
		x3.add(option);

		document.getElementById("PersonalPROSPECTKOTA2").value = document.getElementById("PersonalPROSPECTKOTA").value;	
		document.getElementById("PersonalPROSPECTKEC2").value = document.getElementById("PersonalPROSPECTKEC").value;	
		document.getElementById("PersonalPROSPECTKEL2").value = document.getElementById("PersonalPROSPECTKEL").value;		

		var x0 = document.getElementById("hubungan_tertanggung_ph");
		var option = document.createElement("option");
		option.text = "pembeli";
		option.value = "0";
		x0.add(option);
		document.getElementById("hubungan_tertanggung_ph").value = '0';
	
		//$('input[name="data[Personal][PROSPECT_GENDER]"]:checked').val()=$('input[name="data[Personal][PROSPECT_GENDER]"]:checked').val();
	}else{
		var x = document.getElementById("hubungan_tertanggung_ph");
		x.remove(x.selectedIndex);
		var x1 = document.getElementById("PersonalPROSPECTKOTA2");
		x1.remove(x1.selectedIndex);
		var x2 = document.getElementById("PersonalPROSPECTKEC2");
		x2.remove(x2.selectedIndex);
		var x3 = document.getElementById("PersonalPROSPECTKEL2");
		x3.remove(x3.selectedIndex);
		document.getElementById("section_tertanggung").style.visibility = 'visible';
		document.getElementById("section_tertanggung").style.position = 'relative';


		document.getElementById("nama_tertanggung").value = "";

		document.getElementById("ktp2").value = "";
		document.getElementById("dob_tertanggung").value = "";
		document.getElementById("gender_tertanggungM").checked = false;
		document.getElementById("gender_tertanggungF").checked = false;

		document.getElementById("PersonalPROSPECTADDRESS2").value = "";	
		document.getElementById("PersonalPROSPECTPROVINSI2").value = "";

		$(".section_korespondensi").show();
	}

}

function cek_req_buku(){
  $("#calculate-btn").trigger('click');
	if($('input[name="data[Personal][PROSPECT_REQ_BUKU]"]:checked').val()=='N'){
		document.getElementById("section_korespondensi").style.visibility = 'hidden';
		document.getElementById("section_korespondensi").style.position = 'absolute';
		document.getElementById("section_korespondensi_alamat").style.visibility = 'hidden';
		document.getElementById("section_korespondensi_alamat").style.position = 'absolute';

		document.getElementById("PersonalKORESPONDENSIADDRESS").value = document.getElementById("PersonalPROSPECTADDRESS").value;	
		document.getElementById("PersonalKORESPONDENSIPROVINSI").value = document.getElementById("PersonalPROSPECTPROVINSI").value;
		document.getElementById("PersonalKORESPONDENSIKOTA").value = document.getElementById("PersonalPROSPECTKOTA").value;	
		document.getElementById("PersonalKORESPONDENSIKEC").value = document.getElementById("PersonalPROSPECTKEC").value;	
		document.getElementById("PersonalKORESPONDENSIKEL").value = document.getElementById("PersonalPROSPECTKEL").value;

		document.getElementById("alamat_kirim_bukuY").checked = true;

		var x1 = document.getElementById("PersonalKORESPONDENSIKOTA");
		var option = document.createElement("option");
		option.text = $("#PersonalPROSPECTKOTA option:selected").text();
		option.value = document.getElementById("PersonalPROSPECTKOTA").value;	
		x1.add(option);

		var x2 = document.getElementById("PersonalKORESPONDENSIKEC");
		var option = document.createElement("option");
		option.text = $("#PersonalPROSPECTKEC option:selected").text();
		option.value = document.getElementById("PersonalPROSPECTKEC").value;	
		x2.add(option);

		var x3 = document.getElementById("PersonalKORESPONDENSIKEL");
		var option = document.createElement("option");
		option.text = $("#PersonalPROSPECTKEL option:selected").text();
		option.value = document.getElementById("PersonalPROSPECTKEL").value;	
		x3.add(option);

		document.getElementById("PersonalKORESPONDENSIKOTA").value = document.getElementById("PersonalPROSPECTKOTA").value;	
		document.getElementById("PersonalKORESPONDENSIKEC").value = document.getElementById("PersonalPROSPECTKEC").value;	
		document.getElementById("PersonalKORESPONDENSIKEL").value = document.getElementById("PersonalPROSPECTKEL").value;

	}else{

		document.getElementById("PersonalKORESPONDENSIADDRESS").value = "";	
		document.getElementById("PersonalKORESPONDENSIPROVINSI").value = "";
		document.getElementById("PersonalKORESPONDENSIKOTA").value = "";	
		document.getElementById("PersonalKORESPONDENSIKEC").value = "";	
		document.getElementById("PersonalKORESPONDENSIKEL").value = "";

		var x1 = document.getElementById("PersonalKORESPONDENSIKOTA");
		x1.remove(x1.selectedIndex);
		var x2 = document.getElementById("PersonalKORESPONDENSIKEC");
		x2.remove(x2.selectedIndex);
		var x3 = document.getElementById("PersonalKORESPONDENSIKEL");
		x3.remove(x3.selectedIndex);
		document.getElementById("section_korespondensi_alamat").style.visibility = 'visible';
		document.getElementById("section_korespondensi_alamat").style.position = 'relative';
		$(".section_korespondensi").show();
	}
}

function cek_korespondensi(){
  $("#calculate-btn").trigger('click');
	//if(valQuote.form()) {
		if($('input[name="data[Personal][PROSPECT_KORESPONDENSI]"]:checked').val()=='Y'){
		//alert('ya');
			document.getElementById("PersonalKORESPONDENSIADDRESS").value = document.getElementById("PersonalPROSPECTADDRESS").value;	
			document.getElementById("PersonalKORESPONDENSIPROVINSI").value = document.getElementById("PersonalPROSPECTPROVINSI").value;
			document.getElementById("PersonalKORESPONDENSIKOTA").value = document.getElementById("PersonalPROSPECTKOTA").value;	
			document.getElementById("PersonalKORESPONDENSIKEC").value = document.getElementById("PersonalPROSPECTKEC").value;	
			document.getElementById("PersonalKORESPONDENSIKEL").value = document.getElementById("PersonalPROSPECTKEL").value;	

			var x1 = document.getElementById("PersonalKORESPONDENSIKOTA");
			var option = document.createElement("option");
			option.text = $("#PersonalPROSPECTKOTA option:selected").text();
			option.value = document.getElementById("PersonalPROSPECTKOTA").value;	
			x1.add(option);

			var x2 = document.getElementById("PersonalKORESPONDENSIKEC");
			var option = document.createElement("option");
			option.text = $("#PersonalPROSPECTKEC option:selected").text();
			option.value = document.getElementById("PersonalPROSPECTKEC").value;	
			x2.add(option);

			var x3 = document.getElementById("PersonalKORESPONDENSIKEL");
			var option = document.createElement("option");
			option.text = $("#PersonalPROSPECTKEL option:selected").text();
			option.value = document.getElementById("PersonalPROSPECTKEL").value;	
			x3.add(option);

			document.getElementById("PersonalKORESPONDENSIKOTA").value = document.getElementById("PersonalPROSPECTKOTA").value;	
			document.getElementById("PersonalKORESPONDENSIKEC").value = document.getElementById("PersonalPROSPECTKEC").value;	
			document.getElementById("PersonalKORESPONDENSIKEL").value = document.getElementById("PersonalPROSPECTKEL").value;

			document.getElementById("section_korespondensi").style.visibility = 'hidden';
			document.getElementById("section_korespondensi").style.position = 'absolute';
		}else{
		//alert('tidak');
			var x1 = document.getElementById("PersonalKORESPONDENSIKOTA");
			x1.remove(x1.selectedIndex);
			var x2 = document.getElementById("PersonalKORESPONDENSIKEC");
			x2.remove(x2.selectedIndex);
			var x3 = document.getElementById("PersonalKORESPONDENSIKEL");
			x3.remove(x3.selectedIndex);

			//document.getElementById("PersonalKORESPONDENSIADDRESS").value = "";	
			//document.getElementById("PersonalKORESPONDENSIPROVINSI").value = "";
			//document.getElementById("PersonalKORESPONDENSIKOTA").value = "";	
			//document.getElementById("PersonalKORESPONDENSIKEC").value = "";	
			//document.getElementById("PersonalKORESPONDENSIKEL").value = "";	




			document.getElementById("section_korespondensi").style.visibility = 'visible';
			document.getElementById("section_korespondensi").style.position = 'relative';
			$(".section_korespondensi").show();
		}
		
	//}
}

function extracheck() {
    var e = document.getElementById("PersonalPROSPECTPROVINSI");
    if (e.options[e.selectedIndex].value == "33") {
		e.selectedIndex = 0;
        alert("Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Sumatra Utara.");
    }else if (e.options[e.selectedIndex].value == "20") {
		e.selectedIndex = 0;
        alert("Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Nanggroe Aceh Darussalam.");
    }
}


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
	return (value!=0 && parseInt(value.replace(/\D/g, '')) >= <?php echo $coverage1['MinSumInsured']; ?> && parseInt(value.replace(/\D/g, '')) <= <?php echo $coverage1['MaxSumInsured']; ?>) ;
}, "Uang pertanggungan harus diantara <?php echo rp($coverage1['MinSumInsured']); ?>  dan <?php echo rp($coverage1['MaxSumInsured']); ?> ");

$(".calculate").click(function(){ 
if(valQuote.form()) {
getCalc();
	//if(getCalc()){getCekSI();}
/*
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_email_jmk/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#PersonalPROSPECTEMAIL').val(),'name':$('#nama_ph').val()},
		beforeSend: function(){ $(".calculate").prop('disabled', true); },
		complete: function(){ 	$(".calculate").prop('disabled', false); },
		success: function(msg,e){  
		//alert(msg)
		if(msg==1){ 	
			$(".calculate").prop('disabled', true);
			getCalc();
			ga('send', 'event', 'customer', 'click', 'get a quote - calculate');

			/*
			$.ajax({
				url: "<?php echo $this->Html->url('/front/jmk_cek_SI/');?>",
				type: "POST",
				cache: false,
				data: {'rangka':$('#PersonalNORANGKAMESIN').val() },
				beforeSend: function(){},
				complete: function(){},
				success: function(msg,e){  
				alert(msg)
				if(msg==1){ 	
					$(".calculate").prop('disabled', true);
					getCalc();
					ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
				}else {
					alert('Anda masukkan sudah melebihi batas.\nSilakan menghubungi CS.');
					//alert(msg);
				}
			}	
			});*/ /*
			


		}else if (msg==2){ 
			alert('maaf, anda tidak dapat melakukan pembelian polis, silahkan hubungi customer service kami!');
		}else if (msg==11){ 
			alert('Ahli waris tidak boleh sama dengan Tertanggung');
		}else {
			alert('Email yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
				//alert(msg);
			}
		}
	});*/

	
}
	
});

function getShowCalc(){ 
					$.ajax({ //ajax jmk cal non unit link - start
					url: "<?php echo $this->Html->url('/front/jmk_cal_non_unitlink_ajax/');?>",
					type: "POST",
					cache: false,
					data: $('#formQuote').serialize(),
					beforeSend: function(){$("#loading").show(); },
					complete: function(){$("#loading").hide(); $(".calculate").prop('disabled', false);line=null; },
					success: function(msg){   
						$("#resultCalc").html(msg);$("#resultCalc").show(800);   		   
						}
					});    //ajax jmk cal non unit link - end

}

function getCekSI(){ 
			$.ajax({  //ajax cek suminsured - start
				url: "<?php echo $this->Html->url('/front/jmk_cek_SI/');?>",
				type: "POST",
				cache: false,
				
				//data: {'rangka':$('#PersonalNORANGKAMESIN').val(), 'plata':$('#PersonalNOPOLA').val() , 'platb':$('#PersonalNOPOLB').val() , 'platc':$('#PersonalNOPOLC').val() , 'merek':$('#PersonalMEREKMOTOR').val() },
					
			        //data: {'plata':$('#PersonalNOPOLA').val() , 'platb':$('#PersonalNOPOLB').val() , 'platc':$('#PersonalNOPOLC').val() , 'merek':$('#PersonalMEREKMOTOR').val() , 'rangka':$('#PersonalNORANGKAMESIN').val() },

				//data: { 'rangka':  document.getElementById("PersonalNORANGKAMESIN").value , 'plata':$('#PersonalNOPOLA').val() , 'platb':$('#PersonalNOPOLB').val() , 'platc':$('#PersonalNOPOLC').val() , 'merek':$('#PersonalMEREKMOTOR').val() },

				data: { 'rangka':  document.getElementById("PersonalNORANGKAMESIN").value , 'plata': document.getElementById("PersonalNOPOLA").value  , 'platb': document.getElementById("PersonalNOPOLB").value , 'platc': document.getElementById("PersonalNOPOLC").value , 'merek': document.getElementById("PersonalMEREKMOTOR").value  },

				//data: {'rangka':$('input[name="data[Personal][NO_RANGKA_MESIN]"]').val()  , 'plata':$('#PersonalNOPOLA').val() , 'platb':$('#PersonalNOPOLB').val() , 'platc':$('#PersonalNOPOLC').val() , 'merek':$('#PersonalMEREKMOTOR').val() },
				beforeSend: function(){},
				complete: function(){},
				success: function(msg,e){  
				//alert(msg)
				if(msg==1){ 	
					//$(".calculate").prop('disabled', true);
					//getCalc();
					//ga('send', 'event', 'customer', 'click', 'get a quote - calculate');
	
					getShowCalc(); 
				}else {
					alert('Anda masukkan sudah melebihi batas ketentuan pembelian polis.\nSilakan menghubungi CS.');
					alert(msg);
				}
			}	
			}); //ajax cek suminsured -end
}

function getCalc(){ 



	$.ajax({  //ajax cek email - start
		url: "<?php echo $this->Html->url('/front/check_email_jmk/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#PersonalPROSPECTEMAIL').val(),'name':$('#nama_ph').val(), 'dob':$('#dob_ph').val(), 'gender':$('input[name="data[Personal][PROSPECT_GENDER]"]:checked').val() },
		beforeSend: function(){ $(".calculate").prop('disabled', true); },
		complete: function(){ 	$(".calculate").prop('disabled', false); },
		success: function(msg,e){  
		//alert(msg)
		if(msg==1){ 	
			//$(".calculate").prop('disabled', true);
			//getCalc();
			//ga('send', 'event', 'customer', 'click', 'get a quote - calculate');

			getCekSI();
			//return true;
			//getShowCalc(); 		


		}else if (msg==2){ 
			alert('maaf, anda tidak dapat melakukan pembelian polis, silahkan hubungi customer service kami!');
		}else if (msg==11){ 
			alert('Ahli waris tidak boleh sama dengan Tertanggung');
		}else {
			alert('Email yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
				//alert(msg);
			}
		}
	});   //ajax cek email - end

	

}

var FormAH = $("#FormAH").validate({
 errorElement: "span",
 focusCleanup: true,
 focusInvalid:false,
	messages: {
		"data[Ahliwaris][PROSPECT_NAME]": "Masukan Nama Ahli Waris Anda",
		"data[Ahliwaris][PROSPECT_DOB]": "Masukan Tanggal Lahir Ahli Waris",
		"data[Ahliwaris][PROSPECT_BIRTH_PLACE]": "Masukan Tempat Lahir Ahli Waris",
		"data[Ahliwaris][PROSPECT_GENDER]": "Pilih Jenis Kelamin Ahli Waris",
		"data[Ahliwaris][RELATIONSHIP_ID]": "Pilih Hubungan Ahli Waris Anda",
		"data[Ahliwaris][PROSPECT_EMAIL]": "Masukan Email Ahli Waris Anda",
	},
	errorPlacement: function(error, element) {
		 error.appendTo(element.parent("div"));
	},
});



var valQuote = $("#formQuote").validate({
	errorElement: "span",
	focusCleanup: true,
	focusInvalid:false,
	rules: {
		"data[Personal][PROSPECT_NAME]"  :{required:true, minlength:3, abc:true },
		"data[Personal][PROSPECT_NAME_PEMILIK]":{required:true, minlength:3, abc:true},
		"data[Personal][PROSPECT_NAMA_STNK]":{required:true, minlength:3},
		"data[Personal][PROSPECT_ADDRESS]":{required:true, minlength:10},
		"data[Personal][PROSPECT_ADDRESS2]":{required:true, minlength:10},
		"data[Personal][KORESPONDENSI_ADDRESS]":{required:true, minlength:10},
		"data[Personal][PROSPECT_EMAIL]" :{ required:true, myEmail:true},
		"data[Personal][PROSPECT_MOBILE_PHONE]" :{ required:true, validplus:true, validlength:true, validNotelp:true},
		"data[Personal][PROSPECT_KTP]" :{ required:true, ktp:true},
		"data[Personal][PROSPECT_KTP_PEMILIK]" :{ required:true, ktp:true},

		//"data[Personal][NO_RANGKA_MESIN]" :{ required:true, rangka_motor:true, minlength:6,maxlength:20 },
		//"data[Personal][NO_MESIN]" :{ required:true, rangka_motor:true, minlength:6, maxlength:20 },

		"data[Personal][NO_RANGKA_MESIN]" :{ required:true,  rangka_motor:true, minlength:1, maxlength:30 },
		"data[Personal][NO_MESIN]" :{ required:true, rangka_motor:true, minlength:1, maxlength:30 },

		"data[Personal][TAHUN_MOTOR2]" :{ required:true, minlength:4, tahunMotor:true,Motor1920:true},
		"data[Personal][PROSPECT_REQ_BUKU]" :{required:true},
		"data[Personal][PROSPECT_PEMILIK]" :{required:true},
		"data[Personal][PROSPECT_PROVINSI]":{required:true},
		"data[Personal][PROSPECT_KORESPONDENSI]":{required:true},
		"data[Personal][NOPOL_B]":{ required:true, nopolb:true},
		"data[Personal][NOPOL_C]":{ required:true, nopolc:true},
		"data[Personal][P_BAYAR]":{required:true},
	},
	messages: {		
	

		"data[Personal][PROSPECT_KTP]" :{ required:"Masukan nomor KTP Anda", ktp:"Nomor KTP belum valid"},
		"data[Personal][PROSPECT_KTP_PEMILIK]" :{ required:"Masukan nomor KTP Anda", ktp:"Nomor KTP belum valid"},
		"data[Personal][PROSPECT_NAME]": {required:"Masukan Nama Anda",minlength:"Mohon Isi Nama Lengkap Sesuai Kartu Identitas", abc:"Nama yang Anda masukkan tidak valid"},
		"data[Personal][PROSPECT_NAME_PEMILIK]": {required:"Masukan Nama Pemilik Motor",minlength:"Mohon Isi Nama Lengkap Sesuai Kartu Identitas", abc:"Nama yang Anda masukkan tidak valid"},
		"data[Personal][PROSPECT_ADDRESS]": {required:"Masukan Alamat Anda",minlength:"Mohon Isi Alamat Lengkap Anda"},
		"data[Personal][PROSPECT_EMAIL]": {required:"Masukan Email Anda",email:"Email anda belum valid"},
		"data[Personal][PROSPECT_MOBILE_PHONE]": {required:"Masukan nomor telpon selular anda",validplus:"Silahkan Rubah +62 ke 0 ", validlength:"Nomor telepon yang Anda masukkan tidak valid", validNotelp:"Nomor yang Anda masukan tidak valid"},
		"data[Personal][PROSPECT_DOB]": "Masukan tanggal lahir anda",
		"data[Personal][PROSPECT_DOB2]": "Masukan tanggal lahir Pemilik motor",
		"data[Personal][PROSPECT_ADDRESS2]": {required:"Masukan Alamat Anda",minlength:"Mohon Isi Alamat Lengkap Anda"},
		"data[Personal][PROSPECT_PROVINSI]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_KOTA]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_KEC]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_KEL]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_PROVINSI2]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_KOTA2]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_KEC2]": {required:"Pilih salah satu"},
		"data[Personal][PROSPECT_KEL2]": {required:"Pilih salah satu"},
		"data[Personal][KORESPONDENSI_PROVINSI]": {required:"Pilih salah satu"},
		"data[Personal][KORESPONDENSI_KOTA]": {required:"Pilih salah satu"},
		"data[Personal][KORESPONDENSI_KEC]": {required:"Pilih salah satu"},
		"data[Personal][KORESPONDENSI_KEL]": {required:"Pilih salah satu"},
		"data[Personal][KORESPONDENSI_ADDRESS]": {required:"Masukan Alamat Anda",minlength:"Mohon Isi Alamat Lengkap Anda"},
		"data[Personal][PROSPECT_REQ_BUKU]" : "Pilih salah satu",
		"data[Personal][PROSPECT_PEMILIK]" : "Pilih salah satu",
		"data[Personal][PROSPECT_STNK]": "Pilih salah satu",
		"data[Personal][PROSPECT_PROVINSI]": "Pilih salah satu",
		"data[Personal][PROSPECT_KORESPONDENSI]": "Pilih salah satu",
		"data[Personal][PROSPECT_NAMA_STNK]":  {required:"Masukan Nama di STNK Motor",minlength:"Mohon Isi Nama Lengkap Sesuai Kartu Identitas "},
		"data[Personal][PROSPECT_GENDER]": "Pilih jenis kelamin",
		"data[Personal][PROSPECT_GENDER2]": "Pilih jenis kelamin",
		"data[Personal][MEREK_MOTOR]":"Pilih merek motor",
		"data[Personal][TYPE_MOTOR]":"Pilih type motor",
		"data[Personal][SUM_INSURED]": {required: "Pilih uang pertanggungan"},
		"data[Personal][QUOTE_PREMIUM_LIFESPAN]": "Pilih periode pertanggungan",
		"data[Personal][QUOTE_DURATION_DAYS]": "Pilih periode pertanggungan",
		"data[Personal][DURATION_JAI]": "Pilih periode pertanggungan",
		"data[Personal][QUOTE_PREMIUM_MODE]": "Pilih frekuensi pembayaran premi anda",
		"data[Personal][HARD_COPY]": "Pilih Request Hard Copy",
		"data[Personal][CASHLESS]": "Pilih Fitur Cashless",
		"data[Personal][RELATIONSHIP_ID]": "Masukan hubungan anda dengan tertanggung",
		"data[Personal][WAKTU_PERLINDUNGAN]": "Isi Waktu Mulai Perlindungan",

		//"data[Personal][NO_RANGKA_MESIN]" :{ required:"Masukan nomor rangka motor anda", rangka_motor:"Masukan hanya alfa numerik", minlength:"Minimal 6 karakter" ,maxlength:"maksimal hanya 20 karakter"},
		//"data[Personal][NO_MESIN]" :{ required:"Masukan nomor mesin motor anda", rangka_motor:"Masukan hanya alfa numerik", minlength:"Minimal 6 karakter" , maxlength:"maksimal hanya 20 karakter"},

		"data[Personal][NO_RANGKA_MESIN]" :{ required:"Masukan nomor rangka motor anda",   rangka_motor:"Masukan hanya alfa numerik", minlength:"Minimal 1 karakter" ,maxlength:"maksimal hanya 30 karakter"},
		"data[Personal][NO_MESIN]" :{ required:"Masukan nomor mesin motor anda",  rangka_motor:"Masukan hanya alfa numerik", minlength:"Minimal 1 karakter" , maxlength:"maksimal hanya 30 karakter"},

		"data[Personal][TAHUN_MOTOR]":"Pilih Tahun motor",
		"data[Personal][TAHUN_MOTOR2]" :{ required:"Masukan Tahun pembuatan motor anda", minlength:"Format tahun kurang", tahunMotor:"Tahun motor belum valid",Motor1920:"Tahun tidak valid"},
		"data[Personal][NOPOL_A]":"Pilih salah satu",
		"data[Personal][NOPOL_B]":{ required:"Masukan nomor registrasi kendaraan anda", nopolb:"Nomor motor yang Anda masukkan tidak valid"},
		"data[Personal][NOPOL_C]":{ required:"Masukan huruf registrasi kendaraan anda", nopolc:"Huruf motor yang Anda masukkan tidak valid"},
		"data[Personal][P_BAYAR]":{required:"Pilih periode pembayaran"},		
	},
	errorPlacement: function(error, element) {
		if (element.is(":radio")) error.appendTo(element.parent('div'));
		else if (element.is("select")) error.appendTo(element.parent('span').parent('div'));
		else error.appendTo(element.parent("div").parent('div'));
	},
});

jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Email anda belum valid');

jQuery.validator.addMethod("rangka_motor", function(value, element) {
    if ( /[^a-zA-Z0-9\-\/]/.test( value )){ return false;}
	else {return true;}
}, 'Nomor rangka hanya alfanumerik');


jQuery.validator.addMethod("nopolb", function(value, element) {
if(value.length >4){ return false;}
else{	if(/^[0-9]*$|\./.test( value ) ){return true;}else{return false;} }
}, "Nomor motor yang Anda masukkan tidak valid");

jQuery.validator.addMethod("nopolc", function(value, element) {
if(value.length >3){ return false;}
else{	if(/^[A-z]+$|\./.test( value ) ){return true;}else{return false;} }
}, "Nomor motor yang Anda masukkan tidak valid");

jQuery.validator.addMethod("abc", function(value, element) {

	if(/^[a-zA-Z\s-]+$|\./.test( value ) ){return true;}else{return false;} 

}, "Nomor motor yang Anda masukkan tidak valid");

jQuery.validator.addMethod("tahunMotor", function(value, element) {
if(value.length !=4){ return false;}
else{ if(/^[0-9]*$|\./.test( value ) ){return true;}else{return false;} }
}, "Tahun motor yang Anda masukkan tidak valid");

jQuery.validator.addMethod("ktp", function(value, element) {
if(value.length !=16)
{ return false;}
else
{ if(/^[0-9]*$|\./.test( value ) ){return true;}else{return false;} }
}, "Tahun motor yang Anda masukkan tidak valid");

jQuery.validator.addMethod("Motor1920", function(value, element) {
			conv = value.substring(0,2);
			if((conv == '19' || conv == '20') && value <='<?php echo idate("Y")?>') return true;
			return false;
		}, " tahun motor 19xx - 2017 ");

jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Silahkan Rubah +62 ke 0 ");

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
	endDate:"-<?php echo $product['min_adult_age']; ?>y",
	startDate:"-<?php echo $product['max_adult_age']; ?>y",
}).on('changeDate', function(e){
	$(this).blur();
}).on('show', function(e){
	$(this).blur();
});
// Spouse age range
$('.tgl_lahir2').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	startView:2,
	endDate:"-<?php echo $coverage1['ageFrom']; ?>y",
	startDate:"-<?php echo $coverage1['ageTo']; ?>y",
}).on('changeDate', function(e){
	$(this).blur();
}).on('show', function(e){
	$(this).blur();
});

$('#ahdob').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startView:2,
endDate:"y",
}).on('changeDate', function(e){
     $(this).blur();
}).on('show', function(e){
     $(this).blur();
});
$(".tgl").click(function(){
	$('#ahdob').focus();
});


function unmask(){
	$('#up').val().replace(/\D/g, '');
}

$(".tgl").click(function(){
	$('.tgl_lahir').focus();
});

$(".tgl2").click(function(){
	$('.tgl_lahir2').focus();
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

$("#PersonalHARDCOPYT").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalHARDCOPYY").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalCASHLESSY").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalCASHLESST").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalSUMINSURED").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalWAKTUPERLINDUNGAN").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#pp").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalQUOTEPREMIUMMODE").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalPBAYAR").change(function(){
  $("#calculate-btn").trigger('click');
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

	//ga('send', 'pageview', '/get-a-quote/'); 
});

$(function() {
	$('#currency').maskMoney();
});

/*
$('#lanjutButton').click(function (e) {
	<?php 	/*
		$tertanggung = $this->Session->read('Purchase.Tertanggung');
		$ahliwaris = $this->Session->read('Purchase.Ahliwaris');
		$num_tertanggung = count($this->Session->read('Purchase.Tertanggung'));
		$num_ahliwaris = count($this->Session->read('Purchase.Ahliwaris'));
		if(($num_tertanggung)==1) {
			for($i=1; $i<=$num_ahliwaris; $i++) {
				if ($tertanggung[0]['PROSPECT_NAME'] == $ahliwaris[$i]['PROSPECT_NAME']) {
					?> alert('Ahli waris tidak boleh sama dengan Tertanggung'); return false; <?php
				}
			}
		} */
	?>
	
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_email/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#DetailPROSPECTEMAIL').val(),'name':$('#DetailPROSPECTNAME').val()},
		beforeSend: function(){ $("#lanjutButton").prop('disabled', true); },
		complete: function(){ 	$("#lanjutButton").prop('disabled', false); },
		success: function(msg,e){  
		if(msg==1) 
		alert(msg);alert("bawah");
			$("#formQuote").submit(); 
		else if (msg==11) 

		alert('Ahli waris tidak boleh sama dengan Tertanggung');
		else {
			alert('Email yang Anda masukkan sudah pernah digunakan.\nSilakan login atau menggunakan email lain.');
				//alert(msg);
			}
		}
	});
	return false;
});*/



</script>



<?php } else { //hardcode jaga motor --- batas ----------------------------------------------?>




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
      <label class="col-sm-2 control-label">Request Hardcopy <br class="hidden-sm hidden-md">Buku Polis <a class="tooltip"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Secara umum JAGADIRI hanya akan menerbitkan e-policy untuk Anda; jika Anda menginginkan <i>hardcopy</i> Buku Polis, maka Anda akan dibebankan biaya tambahan sebesar Rp 50,000 untuk biaya pencetakan dan pengiriman buku polis.</div></span></a></label>
      <div class="col-sm-10">
        <?php 
          $option = array('Y'=>' &nbsp;Ya', 'T'=>' &nbsp;Tidak');
          echo $this->Form->radio('HARD_COPY', $option, array('id'=>'req_hc','required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote'));
        ?>
      </div>
    </div>
    <?php elseif($product['product_id']!='5'):?>
    <div class="form-group">
      <label class="col-sm-2 control-label">Request Hardcopy <br class="hidden-sm hidden-md">Buku Polis <a class="tooltip"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Secara umum JAGADIRI hanya akan menerbitkan e-policy untuk Anda; jika Anda menginginkan <i>hardcopy</i> Buku Polis, maka Anda akan dibebankan biaya tambahan sebesar Rp 50,000 untuk biaya pencetakan dan pengiriman buku polis.</div></span></a></label>
      <div class="col-sm-10">
        <?php 
          $option = array('Y'=>' &nbsp;Ya', 'T'=>' &nbsp;Tidak');
          echo $this->Form->radio('HARD_COPY', $option, array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote'));
        ?>
      </div>
    </div>
	<?php if ($product['product_id']=='21'):?>
	<div class="form-group">
      <label class="col-sm-2 control-label">Request Fitur <br class="hidden-sm hidden-md">Cashless <a class="tooltip z-index-less"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">keterangan cashless.</div></span></a></label>
      <div class="col-sm-10">
        <?php 
          $option = array('Y'=>' &nbsp;Ya', 'T'=>' &nbsp;Tidak');
          echo $this->Form->radio('CASHLESS', $option, array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote'));
        ?>
      </div>
    </div>
	<?php endif; ?>
	
    <?php endif; ?>
    
	<hr class="redline"/>
	
	<?php if ($product['product_id']=='21'):?>	
		<div class="clearfix">
		<h2 class="title-quote">
				<span class="bold">Pasangan Pemegang Polis (isi hanya apabila Pasangan akan diikutsertakan sebagai Tertanggung)</span>
		</h2>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Tanggal Lahir</label>
			<div class="col-sm-4">
				<div class="input-group"><?php echo $this->Form->input('PROSPECT_DOB2', array('required'=>false,'id'=>'dob2','onKeyup'=>"this.value='';",'id'=>'tgl_lahir2','placeholder' => __('YYYY-MM-DD'), 'onFocus'=>"return false;",'class'=>'tgl_lahir2 col-xs-2 col-md-3 form-control', 'div'=>false)); ?>
					<span class="input-group-addon tgl2 red"><i class="fa fa-calendar"></i></span>
				</div>
			</div>	
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Jenis Kelamin</label>
			<div class="col-sm-10">
				<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
				echo $this->Form->radio('PROSPECT_GENDER2', $options , array('required'=>false,'legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
			</div>
		</div>
		
		
		<hr class="redline"/>
	<?php endif; ?>
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
				<div>
				<?php echo $this->Form->Input('WAKTU_PERLINDUNGAN', array('empty'=>'Isi Waktu Perlindungan','required'=>'required', 'class'=>'form_datetime form-control', 'placeholder'=>'YYYY-MM-DD HH:II:SS', 'div'=>false,'onKeyup'=>"this.value='';",'onFocus'=>"return false;")); ?>
				</div>
			</div>
			<script type="text/javascript">
				$(".form_datetime").datetimepicker({
					startDate: new Date(),
					todayBtn: true,
					autoclose: true,
					format: "yyyy-mm-dd hh:ii:00"
				}).on('changeDate', function(e){
					$(this).blur();
				}).on('show', function(e){
					$(this).blur();
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
      
      <?php if($product['product_id']=='11'||$product['product_id']=='23'): //Temporary Hardcode for JSP?>
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
	  <?php elseif($product['product_id']=='21'): //JSK?>
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
	  
         <?php if($product['product_id']=='11'||$product['product_id']=='23'){ ?>


<div class="form-group">
			<label class="col-sm-5 control-label">apakah anda pernah dirawat di rs dalam 6 bulan terakhir<span class="red">*</span></label>
			<div class="col-sm-4">
				<?php $options = array('Y' => '&nbsp;Ya ', 'T' => '&nbsp;Tidak ');
				echo $this->Form->radio('RAWAT_INAP', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '','class'=>'quote')); ?>
			</div>
		</div>


 
 <!--<div class="form-group">
            <div class="checkbox col-md-11">
                <label>
                  <input class="quote" id="PERNYATAAN"  type="checkbox" required name="agreeRecurring" > 
                  <span class="red">Saya tidak sakit keras (JAGADIRI)</span>
                </label>
             </div>
          </div>-->

	<?php } ?>
	  
		
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
		"data[Personal][CASHLESS]": "Pilih Fitur Cashless",
		"data[Personal][WAKTU_PERLINDUNGAN]": "Isi Waktu Mulai Perlindungan",
		"data[Personal][RAWAT_INAP]": "Isi Pernyataan",
		"data[PERNYATAAN]": "Isi Pernyataan2",

		
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
// Spouse age range
$('.tgl_lahir2').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	startView:2,
	endDate:"-18y",
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

$(".tgl2").click(function(){
	$('.tgl_lahir2').focus();
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

$("#PersonalHARDCOPYT").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalHARDCOPYY").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalCASHLESSY").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalCASHLESST").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalSUMINSURED").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalWAKTUPERLINDUNGAN").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#pp").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PersonalQUOTEPREMIUMMODE").change(function(){
  $("#calculate-btn").trigger('click');
});


$("#PersonalRAWATINAPY").change(function(){
alert("Data Anda Tidak Boleh");
var btn = document.getElementById("calculate-btn"); 
btn.disabled = true;
window.location = "<?php echo "/"; //echo $home;?>";
  $("#calculate-btn").disable(true);
  $("#calculate-btn").attr("disabled","disabled");
});

$("#PersonalRAWATINAPT").change(function(){
  $("#calculate-btn").trigger('click');
});

$("#PERNYATAAN").change(function(){
  $("#calculate-btn").trigger('click');
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

	//ga('send', 'pageview', '/get-a-quote/'); 
});

$(function() {
	$('#currency').maskMoney();
});

</script>


<div class="hr hr-24"></div>
<?php } // hardcode jaga motor?>


