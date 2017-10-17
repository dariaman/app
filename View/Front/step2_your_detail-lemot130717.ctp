
<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			    <li class="active">Purchasing Steps</li>
			  <li class="active">Provide your detail</li>
			</ol>
			<!--<div class="mainvisual-detail">
			</div>-->
      	<!--<?php if($this->Session->read('Purchase.step1.product_id')==11||$this->Session->read('Purchase.step1.product_id')==23 || $this->Session->read('Purchase.step1.product_id')==12 || $this->Session->read('Purchase.step1.product_id')==13 || $this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==17):?>
      	<center style="margin: 0 0 20px;"><a href="https://www.jagadiri.co.id/promo/valentine-promo-2016.htm"><img src="/img/banner_top_small.jpg" class="img-responsive"></a></center>
  		<?php endif;?>-->
      <center><img src="<?php echo $this->Html->url('/')?>img/step2.jpg" class="img-responsive"></center>
		</div>
	</div>
<!--<div class="row margintop">
		<div class="col-md-10">
			<ul class="nav-tabs" role="tablist">
			  <li><a href="<?php
			if($cat=='non-unit-link') echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_non_unitlink','id'=>$name,'?'=>array('sid'=>$sid)));
			else echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_unitlink','id'=>$name,'?'=>array('sid'=>$sid))); ?>" >Dapatkan Quote</a></li>
			  <li class="active"><a><span class="hidden-xs">Isi</span> Data</a></li>
			  <li><a>Selesai</a></li>
			</ul>
		</div>
	</div>-->
<div class="row margintop">
			<div class="col-md-12">
				<div class="clearfix"><h2 class="title-quote">
				<span class="bold">Isi dan segera dapatkan Quote <?php echo $this->Session->read('Purchase.produk'); ?></span>
				</h2>
				<h3 class="title-wajib">
				<span class="red">*Wajib Diisi</span>
				</h3>
				</div>
				<hr class="redline"/>
			</div>
		</div>


<div class="row">
			<div class="col-md-12">
				<div class="clearfix">
					<h2 class="title-quote">
						<span class="bold">Data Pembeli</span>
					</h2>
				</div>
	<?php echo $this->Form->create('Detail',array('id'=>'formQuote','url'=>array('controller' =>'front', 'action'=>'step4_checkout','?'=>array('sid'=>$sid,'cat'=>$cat,'name'=>$name)),'class'=>'form-horizontal','role'=>'form','novalidate'=>true));
	$this->Form->inputDefaults(array('class' => 'span6','label' => false));  ?>

	<div class="form-group">
				<div class="col-sm-9"><?php if($this->Session->read('Purchase.step1.product_id') =='7'): ?><span class="red">Penting! Pembeli akan secara otomatis menjadi Tertanggung yaitu pihak yang ditanggung oleh JAGADIRI</span><?php else:?>
        <span class="red"><?php if($this->Session->read('Purchase.step1.product_id') =='12' || $this->Session->read('Purchase.step1.product_id') =='13'):?>Penting! Pembeli akan secara otomatis menjadi Pemegang Polis yaitu pihak yang mengadakan perjanjian asuransi jiwa dengan Penanggung dalam hal ini PT Central Asia Financial.<?php else: ?>Penting! Produk ini hanya berlaku jika pemegang polis adalah pihak yang melakukan pembayaran.<?php endif;?></span><?php endif;?></div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Lengkap<span class="red">*</span></label>
				<div class="col-sm-9">

			 <?php echo $this->Form->input('PROSPECT_NAME', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
		</div>
	</div>

  <!-- Show Alamat All product without conditions -->
    <div class="form-group">
      <label class="col-sm-2 control-label">Alamat Lengkap Tempat Tinggal<span class="red">*</span><a class="tooltips"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Alamat Anda kami butuhkan untuk memudahkan kami mengirimkan dokumen terkait polis asuransi.</div></span></a></label>
	  <div class="col-sm-9">
         <?php echo $this->Form->input('PROSPECT_ADDRESS', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
         <span class="red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.</span>
		 <span class="red"><?php if($this->Session->read('Purchase.step1.product_id') =='11'||$this->Session->read('Purchase.step1.product_id') =='23' || $this->Session->read('Purchase.step1.product_id') =='21' || $this->Session->read('Purchase.step1.product_id') =='5'):?><br />*Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Medan dan sekitarnya.<?php endif;?></span> 		 
      </div>
    </div>
	
	<?php if($this->Session->read('Purchase.step1.product_id') =='11'||$this->Session->read('Purchase.step1.product_id') =='23' || $this->Session->read('Purchase.step1.product_id') =='21' || $this->Session->read('Purchase.step1.product_id') =='5'):?>
	<div class="form-group">
      <label class="col-sm-2 control-label">Provinsi<span class="red">*</span><a class="tooltips"><span class="glyphicon glyphicon-question-sign red"></span><span class="hidewhile"><div class="in-tooltip clearfix">Alamat Anda kami butuhkan untuk memudahkan kami mengirimkan dokumen terkait polis asuransi.</div></span></a></label>
	  <div class="col-sm-9">
			<span class="custom-dropdown custom-dropdown--white">
				<?php echo $this->Form->input('PROSPECT_PROVINSI', array('required'=>'required','empty'=>'Pilih Provinsi','options'=>$optProvinsi,'onchange'=>"extracheck()", 'class'=>' form-control custom-dropdown__select custom-dropdown__select--white','div'=>false )); ?>
			</span>
      </div>
    </div>
	<?php endif;?>

	<?php if($cat!='non-unit-link'): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">NIK/KITAS<span class="red">*</span></label>
				<div class="col-sm-9">
			 <?php echo $this->Form->input('PROSPECT_NRIC', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
		</div>
	</div>
	<?php endif;?>

	<div class="form-group">
		<label class="col-sm-2 control-label">E-mail<span class="red">*</span></label>
				<div class="col-sm-9">
			 <?php echo $this->Form->input('PROSPECT_EMAIL', array('required'=>'required','class'=>'form-control','div'=>false )); ?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Telp Selular<span class="red">*</span></label>
				<div class="col-sm-9">
			 <?php echo $this->Form->input('PROSPECT_MOBILE_PHONE', array('required'=>'required','validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'class'=>'form-control','div'=>false,'id'=>'phone')); ?>
		</div>
	</div>

	<?php if($this->Session->read('Purchase.step1.product_id')!=1 && $this->Session->read('Purchase.step1.product_id')!=7): ?>

	<div class="form-group">
		<label class="col-sm-2 control-label">
    <?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==21 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==18): ?>
    <?php elseif($this->Session->read('Purchase.step1.product_id')!=21): ?>
    Apakah Anda ingin menjadi tertanggung?<span class="red">*</span>
    <?php endif;?>
    </label>


				<div class="col-sm-8">
          <?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==18): ?>
    			   <?php /* $options = array('Y' => '&nbsp;Ya');
                  $attributes = array('required'=>'required','onClick'=>'return changeMe2();','legend' => false,'separator'=>' &nbsp;&nbsp;&nbsp;&nbsp;');
    			         echo $this->Form->radio('me', $options, $attributes); */ ?>
             <button class="btn btn-default2" type="button" id="confirm" name="data[Detail][me]" onClick="return changeMe2();" value="Y" required="required">Konfirmasi Data Pembeli</button>

		  <?php elseif($this->Session->read('Purchase.step1.product_id')==21): ?>
             <button class="btn btn-default2" type="button" id="confirm" name="data[Detail][me]" onClick="changeMe2();ga('send', 'event', 'customer', 'click', 'get a quote – tambah tertanggung policy');" value="Y" required="required">Konfirmasi Data Pembeli</button>

		  <?php else: ?>
     			   <?php $options = array('Y' => '&nbsp;Ya', 'T' => '&nbsp;Tidak');
                   $attributes = array('required'=>'required','onClick'=>'return changeMe2();','legend' => false,'separator'=>' &nbsp;&nbsp;&nbsp;&nbsp;');
     			         echo $this->Form->radio('me', $options, $attributes); ?>
          <?php endif; ?>
		</div>
	</div>

	<hr class="redline"/>
	<div class="form-group">
				<div class="col-sm-9">
          <span class="red">
            <?php if($this->Session->read('Purchase.step1.product_id')=='12' || $this->Session->read('Purchase.step1.product_id')=='13'):?>
              Perhatian: Tertanggung adalah keluarga inti pemegang polis (diri sendiri/suami/istri).
            <?php elseif($this->Session->read('Purchase.step1.product_id')=='14' || $this->Session->read('Purchase.step1.product_id')=='15' || $this->Session->read('Purchase.step1.product_id')=='17' || $this->Session->read('Purchase.step1.product_id')=='21'|| $this->Session->read('Purchase.step1.product_id')=='18'):?>
              Perhatian: Pemegang polis wajib menjadi tertanggung.
            <?php else:?>
              Perhatian: Tertanggung adalah keluarga inti pemegang polis (diri sendiri/suami/istri/anak).
            <?php endif;?>
          </span>
        </div>
	</div>

  <?php if($this->Session->read('Purchase.step1.product_id')!='18' && $this->Session->read('Purchase.step1.product_id')!='17' && $this->Session->read('Purchase.step1.product_id')!='15' && $this->Session->read('Purchase.step1.product_id')!='14'):?>
	<?php if(count($this->Session->read('Purchase.Tertanggung'))<$countRelInsure): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Tertanggung Asuransi<span class="red">*</span></label>
				<div class="col-sm-2">
			<button type="button" class="btn btn-default2" onClick="addTA_button();ga('send', 'event', 'customer', 'click', 'get a quote – tambah tertanggung policy'); ">
					Tambah Tertanggung
			</button>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; ?>
		<?php if($this->Session->check('Purchase.Tertanggung')): ?>
	<div class="box-grey-top">
					<span class="bold">
					Tertanggung Asuransi
					</span>
			</div>
		<div class="table-responsive">
		<table class="table table-bordered" >
		<tr class="active"><td>No</td><td>Nama</td><td>Tanggal Lahir</td><td>Jenis Kelamin</td><td>Hubungan</td><td>Hapus</td></tr>
		<?php  $taData = $this->Session->read('Purchase.Tertanggung'); $i=0; while($i<count($taData)): ?>
		<tr><td><?php echo ($i+1) ?></td><td><?php echo $taData[$i]['PROSPECT_NAME'] ?></td><td><?php echo $taData[$i]['PROSPECT_DOB'] ?></td><td><?php if($taData[$i]['PROSPECT_GENDER']=='F') echo "Perempuan"; else echo "Laki-laki"  ?></td><td><?php echo $taData[$i]['hubungan'] ?></td>
		<td>
		<?php if($i==0) CakeSession::write('Purchase.TertanggungTertua', $taData[$i]['PROSPECT_DOB']) ?> <!-- JSK -->
		<a <?php if($taData[$i]['INSURED_RELATIONSHIP_ID']=='1') echo 'id="linkhapusme"' ?>
		href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step2_del_ta','id'=>$name,'?'=>array_merge($this->request['url'],array('id'=>$i)))) ?>"
		<?php if($taData[$i]['INSURED_RELATIONSHIP_ID']=='1'):?>
		onClick="ga('send', 'event', 'customer', 'click', 'get a quote – hapus tertanggung'); return confirm('Yakin tertanggung utama dihapus? Pastikan data tertanggung utama terisi untuk dapat membeli asuransi ini. ');"
		<?php else: ?>
		onClick="ga('send', 'event', 'customer', 'click', 'get a quote – hapus tertanggung'); return confirm('Yakin Tertanggung Asuransi <?php echo $taData[$i]['PROSPECT_NAME']  ?> dihapus?');"
		<?php endif ?>
		class="btn btn-default2">
		Hapus
		</a></td>
		</tr>
		<?php $i++;endwhile; ?>
		</table>
		</div>
	<?php endif; ?>

	<?php endif;?>

	<hr class="redline"/>
	<?php if($this->Session->read('Purchase.step1.product_id')!=21) :?>

	<?php /* if($this->Session->read('Purchase.step1.product_id')==7) $maxAH=1; else */ $maxAH=5; if(count($this->Session->read('Purchase.Ahliwaris'))<$maxAH): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Ahli Waris<span class="red">*</span></label>
				<div class="col-sm-2">
			<button type="button" class="btn btn-default2" onClick="addAh_button();ga('send', 'event', 'customer', 'click', 'get a quote – tambah ahli waris'); ">
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
		<tr><td><?php echo ($i+1) ?></td><td><?php echo $ahData[($i+1)]['PROSPECT_NAME'] ?></td><td><?php echo $ahData[($i+1)]['PROSPECT_DOB'] ?></td><td><?php if($ahData[($i+1)]['PROSPECT_GENDER']=='F') echo "Perempuan"; else echo "Laki-laki"  ?></td><td><?php echo $ahData[($i+1)]['hubungan'] ?></td><td><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'step2_del_aw','id'=>$name,'?'=>array_merge($this->request['url'],array('id'=>($i+1))))) ?>" onClick="ga('send', 'event', 'customer', 'click', 'get a quote – hapus'); return confirm('Yakin Ahli Waris <?php echo $ahData[($i+1)]['PROSPECT_NAME']  ?> dihapus?');" class="btn btn-default2">Hapus</a></td></tr>
		<?php $i++;endwhile; ?>
		</table>
		</div>

	<?php endif; ?>

	<?php endif; //endif punya yg kalau bukan 21?>

	<div class="row margintop">
			<div class="col-md-12">
				<div class="clearfix">
			<div class="pull-left">
				<a href="<?php
				if($cat=='non-unit-link') echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_non_unitlink','id'=>$name,'?'=>array('sid'=>$sid)));
				else echo $this->Html->url(array('controller' =>'front', 'action'=>'step1_unitlink','id'=>$name,'?'=>array('sid'=>$sid))); ?>">
				<div class="btn-back"><h2 class="title-btn-quote">Kembali</h2></div>
				</a>
			</div>
			<?php if((count($this->Session->read('Purchase.Ahliwaris'))>0 && count($this->Session->read('Purchase.Tertanggung'))>0) ||
			($this->Session->read('Purchase.step1.product_id')==21 && count($this->Session->read('Purchase.Tertanggung'))>=$_SESSION['qtytertanggung']) ||
			(($this->Session->read('Purchase.step1.product_id')==1 || $this->Session->read('Purchase.step1.product_id')==7)&& count($this->Session->read('Purchase.Ahliwaris'))>0)): ?>
			<div class="pull-right">
			<button id="lanjutButton" class="btn-lanjut"  <?php if($this->Session->read('Purchase.step1.product_id')==7)echo "onclick=\"ga('send', 'event', { eventCategory: 'Lanjut Button', eventAction: 'click', eventLabel: 'lanjut - button - jai'});\""; ?> >
				Lanjut
			</button>
			</div>
			<?php endif; ?>
			</form>
		</div>
	</div>
	</div>

</div>
</div>


<?php if(!$this->Session->check('Auth.User')): ?>
<div class="row">
	<div class="col-md-12">
		<h1 class="login-title">
			<span class="bold">Sudah menjadi <span class="red bold">member</span>? silahkan <span class="red bold">LOGIN</span></span>
		</h1>
		<p class="text-center">Anda akan mendapatkan informasi login jika anda sudah pernah membeli salah satu produk kami.</p><br /><br />
		<?php echo $this->Session->flash('flash', array('element' => 'failure'));?>

		<?php echo $this->Form->create('User',array('url'=>array('controller'=>'front','action'=>'login','?'=>array_merge($this->request['url'],array('name'=>$name))),'role'=>'form','class'=>'form-horizontal')); ?>

		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][email]" type="email" id="form-field-1" placeholder="Email" class="form-control " required="required" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input name="data[User][password]" type="password" id="form-field-1" placeholder="Password" class="form-control " required="required" />
			</div>
		</div>
		<div class="form-group">
			<span class="col-sm-offset-4 col-sm-4">
				<?php foreach($captcha_fields as $index => $captcha) {
					echo $this->Html->image($captcha . '.jpg', array('id' => $captcha)).' ';
					echo $this->Html->link('reload image &#x21bb;', '#', array('class' => 'reload', 'escape' => false));
				}
				?>
			</span>
		</div>
		<!--<div class="form-group">
			<span class="col-sm-offset-4 col-sm-4">
				<?php echo $this->Form->input('captcha',array('placeholder'=>'Captcha','class'=>'form-control','required'=>'required','div'=>false,'label'=>false)); ?>
			</span>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'forgot_password'))?>"><p class="forgot text-right"><span class="bold red">Forgot Password</span></p></a>
			</div>
		</div>-->
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<center><button class="btn-login" type="submit"><i class="icon-key bigger-110"></i>Login</button></center>
			</div>
		</div>
	</form>
</div>
</div>
<?php endif; ?>


<div class="modal fade" id="modalaw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					 <h4 class="modal-title" id="aw-btn">Tambah Ahli Waris</h4>
				</div>
				<div class="modal-body">
					<!-- isi modal -->
					<?php echo $this->Form->create('Ahliwaris',array('url'=>array('controller'=>'front','action'=>'step2_add_ah','id'=>$name,'?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>true,'id'=>'FormAH',''=>array()));
					$this->Form->inputDefaults(array('class' => 'span6','label' => false,)); ?>

					<div class="form-group">
						<label class="col-md-3 control-label">Nama *</label>
						<div class="col-md-7">
							<?php echo $this->Form->input('PROSPECT_NAME', array('class'=>'form-control','required'=>'required')); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Tanggal Lahir *</label>
						<div class="col-md-5">
							<div class="input-group" id="doob">
							<?php echo $this->Form->input('PROSPECT_DOB', array('onKeypress'=>'validateNumb(event)','class'=>'form-control','required'=>'required','placeholder' => __('YYYY-MM-DD'),'id'=>'ahdob')); ?>
							<span class="input-group-addon tgl red"><i class="fa fa-calendar"></i></span>
						</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin *</label>
						<div class="col-md-7">
							<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
			echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '')); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Hubungan *</label>
						<div class="col-md-7">
							<?php echo $this->Form->input('RELATIONSHIP_ID', array('empty'=>'Pilih Hubungan','options'=>$optHub,'class'=>'form-control','required'=>'required')); ?>
						</div>
					</div>

          <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <span class="red">Jika ahli waris berusia kurang dari 17 tahun</span>, harap masukkan data email wali ahli waris Anda, yaitu keluarga yang tidak serumah (sangat disarankan). Wali akan menerima informasi pertanggungan asuransi dan berhak mewakili untuk mengurus proses klaim selama ahli waris masih di bawah umur. <span class="red">Jika ahli waris di atas 17 tahun</span>, maka harap masukkan data email ahli waris Anda.
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

<div class="modal fade" id="modalta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="aw-btn">Tambah Tertanggung Asuransi</h4>
				</div>
				<div class="modal-body">
					<!-- isi modal -->
					<?php echo $this->Form->create('Tertanggung',array('url'=>array('controller'=>'front','action'=>'step2_add_ta','id'=>$name,'?'=>$this->request['url']),'class'=>'form-horizontal','role'=>'form','type' => 'post','novalidate'=>true,'id'=>'FormTA',''=>array()));
					$this->Form->inputDefaults(array('class' => 'span6','label' => false)); ?>

					<div class="form-group">
						<label class="col-md-3 control-label">Hubungan *</label>
						<div class="col-md-7" id="divrelation">
							<?php echo $this->Form->input('INSURED_RELATIONSHIP_ID', array('change'=>'validateNumb(event)','empty'=>'Pilih Hubungan','options'=>$optInsureRel,'class'=>'form-control','required'=>'required')); ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Nama *</label>
						<div class="col-md-7">
							<?php echo $this->Form->input('PROSPECT_NAME', array('class'=>'form-control','required'=>'required')); ?>
						</div>
					</div>

					<div class="form-group" id="dobgroup" style="display: none;">
						<label class="col-md-3 control-label">Tanggal Lahir *</label>
						<div class="col-md-5">
							<div class="input-group" id="doob">
							<?php echo $this->Form->input('PROSPECT_DOB', array('onKeypress'=>'validateNumb(event)','class'=>'form-control','required'=>'required','placeholder' => __('YYYY-MM-DD'),'id'=>'tadob')); ?>
							<span class="input-group-addon tgl2 red"><i class="fa fa-calendar"></i></span>
						</div>
						</div>
					</div>
					<div class="form-group" id="dobanakgroup" style="display: none;">
						<label class="col-md-3 control-label">Tanggal Lahir *</label>
						<div class="col-md-5">
							<div class="input-group" id="doob">
							<?php echo $this->Form->input('PROSPECT_DOB_ANAK', array('onKeypress'=>'validateNumb(event)','class'=>'form-control','required'=>'required','placeholder' => __('YYYY-MM-DD'),'id'=>'tadobanak')); ?>
							<span class="input-group-addon tgl2 red"><i class="fa fa-calendar"></i></span>
						</div>
						</div>
					</div>
					<?php echo $this->Form->input('PROSPECT_DOB2', array('type'=>'hidden', 'id'=>'tadob2')); ?>

					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Kelamin *</label>
						<div class="col-md-7">
							<?php $options = array('M' => '&nbsp;Laki laki ', 'F' => '&nbsp;Perempuan ');
			echo $this->Form->radio('PROSPECT_GENDER', $options , array('required'=>'required','legend'=>false, 'separator'=> '&nbsp;&nbsp;&nbsp;&nbsp;','before' => ' ','after' => '')); ?>
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
					<button type="submit" class="btn btn-primary" id="save_aw" onClick="return chekAcumulate();">Simpan Tertanggung</button>
					<button type="button" class="btn btn-default active" data-dismiss="modal">Tutup</button>
				</center>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $cek_insured=$this->Session->read('Purchase.Tertanggung');//var_dump($this->Session->read('Purchase.Tertanggung'));?>


<script type="text/javascript">
$(document).ready(function(){
$("html, body").animate({ scrollTop: $('.breadcrumb').offset().top-50 }, 1500);
});

/* function changeMe(){
  if($('#confirm').val()=='Y' || $('input[name="data[Detail][me]"]:checked').val()=='Y'){
      $('#formQuote').append('<input type="hidden" name="data[Detail][me]" value="Y" />');
      $.ajax({
      url: "<?php echo $this->Html->url('/front/check_valid_dns_email/');?>",
      type: "GET",
      cache: false,
      data: {'email_valid':$('#DetailPROSPECTEMAIL').val()},
      beforeSend: function(){ },
      complete: function(){ },
      success: function(msg,e){  if(msg==1){ alert('Valid'); return changeMeAfterCheckDNS(); }else {
        alert('Not Valid'); $('#DetailMeY').prop('checked', false); return false;
          }
        }
      });
  }
} */
function changeMe2(){
	if(valQuote.form()) {
		if($('input[name="data[Detail][me]"]:checked').val()=='Y'||$('#confirm').val()=='Y'){
			<?php $gaSend=array(4=>'cfl',5=>'dbd',7=>'jai',11=>'jsp',12=>'jj',13=>'ja', 14=>'jjp',15=>'jjp',17=>'jap',18=>'jap',21=>'jsk',23=>'jsp',); // ga code?>
			//var x=ga('send', 'event', { eventCategory: 'step2', eventAction: 'click', eventLabel: 'ya - button - <?php echo $gaSend[$this->Session->read('Purchase.step1.product_id')];?>'});
			//if (x){
			<?php //   echo 'alert("'. $gaSend[$this->Session->read('Purchase.step1.product_id')] .'");'; ?>
			changeMe();
				<?php if($this->Session->read('Purchase.step1.product_id')=='21'){ echo 'addTA_buttonJSK()' ; }else{ echo 'changeMe()'; } ?>
			//}
			
		}
	}
}

function changeMe(){
	//alert('coverage_type_benefit_id = <?php echo $product['coverage_type_benefit_id']; ?>');
		if(valQuote.form()) {
      <?php if($statTU!=-1): ?>
				<?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==21|| $this->Session->read('Purchase.step1.product_id')==18): ?>
        if($('#confirm').val()=='Y')
        <?php else:?>
        if($('input[name="data[Detail][me]"]:checked').val()=='Y')
          <?php endif;?>
        {
        <?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==21|| $this->Session->read('Purchase.step1.product_id')==18): ?>
        $('#formQuote').append('<input type="hidden" name="data[Detail][me]" value="Y" />');
        <?php endif;?>
        if(!confirm('Anda akan menggantikan Tertanggung Utama <?php echo $this->Session->read('Purchase.Tertanggung.'.$statTU.'.PROSPECT_NAME'); ?>')) return false; }
			<?php endif; ?>
        <?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==21|| $this->Session->read('Purchase.step1.product_id')==18): ?>
        if($('#confirm').val()=='Y')
        <?php else:?>
        if($('input[name="data[Detail][me]"]:checked').val()=='Y')
          <?php endif;?>
        {
        <?php if($this->Session->read('Purchase.step1.product_id')==14 || $this->Session->read('Purchase.step1.product_id')==15 || $this->Session->read('Purchase.step1.product_id')==17 || $this->Session->read('Purchase.step1.product_id')==21|| $this->Session->read('Purchase.step1.product_id')==18): ?>
        $('#formQuote').append('<input type="hidden" name="data[Detail][me]" value="Y" />');
        <?php endif;?>
          $.ajax({
            url: "<?php echo $this->Html->url('/front/checkAcumulation/')?>",
            type: "GET",
            cache: false,
            data: {'cust_name':$('#DetailPROSPECTNAME').val(),'cust_dob':'<?php echo $this->Session->read('Purchase.step1.PROSPECT_DOB');?>','cust_gender':'<?php echo $this->Session->read('Purchase.step1.PROSPECT_GENDER');?>','cust_benefitID':<?php echo $product['coverage_type_benefit_id'];?>},
            success: function(msg){
	//alert(msg);
              if(msg==1){
                sendPostDetail(3); //alert('submit.');

              }
 		else if(msg==2){
		//alert('kamu bandel sihh jadi di blacklist');
		alert('Maaf penambahan tertanggung ini belum dapat diproses, silakan menghubungi CS kami untuk informasi lebih lanjut.');

		$('#DetailMeT').prop('checked', true);
		$('#confirm').val("N");
		<?php // $this->Session->write('over_limit', 'over'); ?>
                return false;

              }

              else{
                alert('Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.');
                $('#DetailMeT').prop('checked', true);
		$('#confirm').val("N");
		<?php // $this->Session->write('over_limit', 'over'); ?>
                return false;
              }
            }
          });
        }
      } else return false;
	}

function chekAcumulate(){
    if(FormTA.form()) {
      $.ajax({
        url: "<?php echo $this->Html->url('/front/checkAcumulation/')?>",
        type: "GET",
        cache: false,
        data: {'cust_name':$('#TertanggungPROSPECTNAME').val(),'cust_dob':($("#TertanggungINSUREDRELATIONSHIPID").val() == 2 ? $('#tadob').val(): $('#tadobanak').val()),
        'cust_gender':$('input:radio[name="data[Tertanggung][PROSPECT_GENDER]"]:checked').val(),'cust_benefitID':<?php echo $product['coverage_type_benefit_id'];?>},
        beforeSend: function(){
          $('#save_aw').prop('disabled', true);
        },
        success: function(msg){
          if(msg==1){
            $('#FormTA').submit();
            return true;

}
 		else if(msg==2){
		//alert('kamu bandel sihh jadi di blacklist');
		alert('Maaf penambahan tertanggung ini belum dapat diproses, silakan menghubungi CS kami untuk informasi lebih lanjut.');
		$('#DetailMeT').prop('checked', true);
		$('#confirm').val("N");
		<?php // $this->Session->write('over_limit', 'over'); ?>
                return false;

              }
          else{
            alert('Maaf Uang Pertanggungan Anda sudah melebihi limit yang disediakan, silakan menghubungi CS kami untuk informasi lebih lanjut.'); 
		$('#confirm').val("N");

		return false;
          }
        }
      });
    } else return false;
  }



function checkAH2(){
	if(FormAH.form()) {
			<?php $gaSend=array(4=>'cfl',5=>'dbd',7=>'jai',11=>'jsp',12=>'jj',13=>'ja', 14=>'jjp',15=>'jjp',17=>'jap',18=>'jap',21=>'jsk',23=>'jsp',); // ga code?>
			var x=ga('send', 'event', { eventCategory: 'Ahli Waris', eventAction: 'click', eventLabel: 'simpan - button - <?php echo $gaSend[$this->Session->read('Purchase.step1.product_id')];?>'});
			//if (x){
			<?php   // echo 'alert("'. $gaSend[$this->Session->read('Purchase.step1.product_id')] .'");'; ?>
			checkAH();
			//}
	}
}

function checkAH(){
  if(FormAH.form()){

    if($('#AhliwarisPROSPECTEMAIL').val() === $('#DetailPROSPECTEMAIL').val()){
      alert('Email yang anda masukan tidak boleh sama dengan\nEmail pemegang polis.');
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


function checkPU(a){
	if(a.value=='1') {
		document.getElementById("TertanggungPROSPECTNAME").value = document.getElementById("DetailPROSPECTNAME").value;
		document.getElementById("tadob").value = '<?php echo $this->Session->read('Purchase.step1.PROSPECT_DOB'); ?>';
		if('<?php echo $this->Session->read('Purchase.step1.PROSPECT_GENDER'); ?>'=='M') radiobtn = document.getElementById("TertanggungPROSPECTGENDERM"); else radiobtn = document.getElementById("TertanggungPROSPECTGENDERF");
		radiobtn.checked = true;
		document.getElementById('TertanggungPROSPECTNAME').readOnly  = true;
		document.getElementById('tadob').readOnly  = true;
		document.getElementById('TertanggungPROSPECTGENDERM').disabled  = true;
		document.getElementById('TertanggungPROSPECTGENDERF').disabled  = true;
		$("#tadob").datepicker('remove');
	} else {
		document.getElementById('TertanggungPROSPECTNAME').readOnly  = false;
		document.getElementById('tadob').readOnly  = false;
		document.getElementById('TertanggungPROSPECTGENDERM').readOnly  = false;
		document.getElementById("TertanggungPROSPECTNAME").value = '';
		document.getElementById("tadob").value = '';
		if('<?php echo $this->Session->read('Purchase.step1.PROSPECT_GENDER'); ?>'=='M') radiobtn = document.getElementById("TertanggungPROSPECTGENDERM"); else radiobtn = document.getElementById("TertanggungPROSPECTGENDERF");
		radiobtn.checked = false;
		$('#tadob').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		startView:2,
		endDate:"-<?php if($product['min_adult_age']==0) echo "6m"; else echo $product['min_adult_age']."y"; ?>",
		startDate:"-<?php echo $product['max_adult_age']; ?>y",
		}).on('changeDate', function(e){
			 $(this).blur();
		}).on('show', function(e){
			 $(this).blur();
		});
	}
}
jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Silahkan Rubag +62 ke 0 ");

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

$('#lanjutButton').click(function (e) {
	<?php 	
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
		}
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
});

/* CheckValid Email */
/* function checkValidEmail() {
	$.ajax({
		url: "<?php echo $this->Html->url('/front/check_valid_dns_email/');?>",
		type: "GET",
		cache: false,
		data: {'email':$('#DetailPROSPECTEMAIL').val()},
		beforeSend: function(){ },
		complete: function(){ },
		success: function(msg){  if(msg==1) {}  else {
			alert('Email not valid');
			}
		}
	});
	return false;
} */


function addAh_button(){
	if(valQuote.form()) {
		<?php if(count($this->Session->read('Purchase.Ahliwaris'))==0): ?> sendPostDetail(1);
		<?php else: ?>  $('#modalaw').modal('show');   <?php endif; ?>
	}


};

function addTA_button(){
	if(valQuote.form()) {
		<?php if(count($this->Session->read('Purchase.Tertanggung'))==0): ?> sendPostDetail(2);
		<?php else: ?>  $('#modalta').modal('show');   <?php endif; ?>
	}
}

function addTA_buttonJSK(){
	if (changeMe())
	{
		if(valQuote.form()) {
			
			<?php
				$tertanggung = $this->Session->read('Purchase.Tertanggung');
				$num_tertanggung = count($this->Session->read('Purchase.Tertanggung'));
				if(($num_tertanggung) > 0) {
					$tertanggung_utama = false;
					for($i = 0; $i < $num_tertanggung; $i++) {

						if ($tertanggung[$i]['hubungan'] == 'Tertanggung Utama') {
							$tertanggung_utama = true;
						}
					}

					if (!$tertanggung_utama) { ?> sendPostDetail(3);  <?php }
				}
				else {
				
			?> sendPostDetail(3);
			
			<?php } ?>
		}
	}
}

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
var valQuote = $("#formQuote").validate({
 errorElement: "span",
 focusCleanup: true,
 focusInvalid:false,
	rules: {
	    "data[Detail][PROSPECT_NAME]"  :{required:true, minlength:3},
		"data[Detail][PROSPECT_ADDRESS]":{required:true, minlength:10},
		"data[Detail][PROSPECT_EMAIL]" :{ required:true, myEmail:true}
	},
	messages: {
		"data[Detail][PROSPECT_NAME]": {required:"Masukan Nama Anda",minlength:"Mohon Isi Nama Lengkap Sesuai Kartu Identitas "},
		"data[Detail][PROSPECT_ADDRESS]": {required:"Masukan Alamat Anda",minlength:"Mohon Isi Alamat Lengkap Anda"},
		"data[Detail][me]": "Pilih salah satu",
		"data[Detail][PROSPECT_NRIC]": "Masukan nomor KITAS/KTP",
		"data[Detail][PROSPECT_EMAIL]": {required:"Masukan Email Anda",email:"Email anda belum valid"},
		"data[Detail][PROSPECT_MOBILE_PHONE]": {required:"Masukan nomor telpon selular anda"},
	},
	errorPlacement: function(error, element) {
		 error.appendTo(element.parent("div"));
	},
});

jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Email anda belum valid');

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
var FormTA = $("#FormTA").validate({
 errorElement: "span",
 focusCleanup: true,
 focusInvalid:false,
	messages: {
		"data[Tertanggung][PROSPECT_NAME]": "Masukan Nama Tertanggung",
		"data[Tertanggung][PROSPECT_DOB]": "Masukan Tanggal Lahir Tertanggung",
		"data[Tertanggung][PROSPECT_BIRTH_PLACE]": "Masukan Tempat Lahir Tertanggung",
		"data[Tertanggung][PROSPECT_GENDER]": "Pilih Jenis Kelamin Tertanggung",
		"data[Tertanggung][INSURED_RELATIONSHIP_ID]": "Pilih Hubungan Tanggungan Anda",
	},
	errorPlacement: function(error, element) {
		 error.appendTo(element.parent("div"));
	},
});

$("#phone").rules("add", {
    	required:true,
    	number:true,
    	messages: {
    		required: "Masukkan no telepon Anda.",
    		number: "Please Enter Only Number"
    	}
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

$('#tadob').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startView:2,
endDate:"-<?php if($product['min_adult_age']==0) echo "6m"; else echo $product['min_adult_age']."y"; ?>",
startDate:"-<?php echo $product['max_adult_age']; ?>y",
}).on('changeDate', function(e){
     $(this).blur();
}).on('show', function(e){
     $(this).blur();
});
$(".tgl2").click(function(){
	$('#tadob').focus();
});

$('#tadobanak').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
startView:2,
endDate:"-<?php echo "6m"; ?>",
startDate:"-<?php echo "23"; ?>y",
}).on('changeDate', function(e){
     $(this).blur();
}).on('show', function(e){
     $(this).blur();
});
$(".tgl2").click(function(){
	$('#tadob').focus();
});

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
$(document).ready(function() {
	ga('send', 'pageview', '/get-a-quote-provide-your-detail/');

	$('#DetailPROSPECTEMAIL').keyup(function() {
		$(this).val($(this).val().toLowerCase());
	});
});

$('#aw-btn').on('click', function() {
	ga('send', 'event', 'customer', 'click', 'get a quote – tambah ahli waris');
});

function tambahTertanggung(obj){
    var xmlhttp;

	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			// Do stuff when script returns
			alert(xmlhttp.responseText);
		}
	}

	xmlhttp.open("GET","lemparnama.php?nama=" + obj.value + "&t="+Math.random(),true);
	xmlhttp.send();

    <?php
	  if ($this->Session->read('Purchase.step1.product_id')==21 && !isset($_SESSION['Purchase']['Tertanggung'][0]['PROSPECT_NAME'])){
		  $_SESSION['Purchase']['Tertanggung'][0]['PROSPECT_NAME'] = $this->Session->read('Purchase.step2.PROSPECT_NAME');
		  $_SESSION['Purchase']['Tertanggung'][0]['PROSPECT_DOB'] = $this->Session->read('Purchase.step1.PROSPECT_DOB');
		  $_SESSION['Purchase']['Tertanggung'][0]['PROSPECT_GENDER'] = $this->Session->read('Purchase.step1.PROSPECT_GENDER');
		  $_SESSION['Purchase']['Tertanggung'][0]['hubungan'] = 'Tertanggung Utama';
		  $_SESSION['Purchase']['Tertanggung'][0]['INSURED_RELATIONSHIP_ID'] = '1';

	  }
	?>
}

function testchange() {
	alert('kampret');
	var e = document.getElementById("DetailPROSPECTPROVINSI");
	alert(e.options[e.selectedIndex].value);
}
	
function extracheck() {
    var e = document.getElementById("DetailPROSPECTPROVINSI");
    if (e.options[e.selectedIndex].value == "33") {
		e.selectedIndex = 0;
        alert("Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Sumatra Utara.");
    }else if (e.options[e.selectedIndex].value == "20") {
		e.selectedIndex = 0;
        alert("Mohon maaf, saat ini JAGADIRI membatasi penjualan untuk wilayah Nanggroe Aceh Darussalam.");
    }
}

$('#INSURED_RELATIONSHIP_ID').change(function() {
    var idx = this.selectedIndex;
    alert(idx);
});
$("div#divrelation select").change(function(){
if ($("div#divrelation option:selected").text()=='Suami / Istri')
{
	$("#dobanakgroup").hide();
	$("#tadobanak").attr("required", false);
	$("#dobgroup").show();
	<?php
		if ($this->Session->read('Purchase.step1.product_id')==21 && isset($_SESSION['PROSPECT_DOB2_FOR_ENTRY']))
		{
		?>
			var sessName = <?php echo json_encode($_SESSION['PROSPECT_DOB2_FOR_ENTRY']) ?>;
			$('#tadob').val(sessName);
			$('#tadob2').val(sessName);
			$('#tadob').attr('disabled', true);

			var gender = <?php echo json_encode($_SESSION['PROSPECT_GENDER2']) ?>;
			// console.log(gender);
			if(gender==='F') {
				// console.log('Female');
				$('#TertanggungPROSPECTGENDERF').attr('checked', true);
				$('#TertanggungPROSPECTGENDERM').attr('checked', false);
			}
			else {
				// console.log('Male');
				$('#TertanggungPROSPECTGENDERM').attr('checked', true);
				$('#TertanggungPROSPECTGENDERF').attr('checked', false);
			}

		<?php
		}
		?>
}
else if ($("div#divrelation option:selected").text() =='Pilih Hubungan')
{
	//$('#tadob').attr('disabled', false);
	$("#dobanakgroup").hide();
	$("#dobgroup").hide();
}
else {
	$("#dobanakgroup").show();
	$("#dobgroup").hide();
	$("#tadob").attr("required", false);
}

if ($("div#divrelation option:selected").text()!='Suami / Istri')
{
	//$('#tadob').bind();
}
});
</script>

<?php
$this->Js->get('.reload')->event('click',
	"$(this).prev().attr('src', $(this).prev().attr('src') + '?' + new Date().getTime())"
	);
?>
<?php echo $this->Js->writeBuffer(); ?>
