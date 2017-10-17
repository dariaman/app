<div class="wrapper line-quiz">
	<div class="header-container row textmedium">
    <img src="<?php echo $this->Html->url("/");?>linequiz-assets/images/jagadiri_icon_line_2.jpg" class="img-responsive">
        <h1 class="winning-title">
        	Terima Kasih<br /> <span>data telah berhasil dikirim</span>
        </h1>
    </div>
    <div class="body-container">
    	<div class="quiz-desc textmedium">
        <p>Perlindungan mulai aktif<br><span class="red">20 Oktober - 19 November 2015</span></p>
        <span class="big-info">Silahkan unduh</br>E-SERTIFIKAT Anda</br>
        Segera!</span>
        <br clear="all">
        <div class="line-agreement">
          <h4>Penting Untuk Diketahui</h4>
          <ol>
<li>Tanggal berlaku dan berakhirnya asuransi adalah bersifat tetap dan tidak dapat dilakukan perubahan dikemudian hari.</li>
<li>Nasabah wajib untuk memberikan data yang benar dan valid sesuai dengan bukti identitas yang berlaku di Negara Republik Indonesia.</li>
<li>Nasabah bersedia dan setuju untuk dipergunakan datanya oleh PT. Central Asia Financial (JAGADIRI) maupun diserahkan kepada pihak ketiga untuk kepentingan perlindungan Asuransi dan Pemasaran Produk Asuransi Jiwa milik PT. Central Asia Financial (JAGADIRI).</li>
<li>Sertifikat ini merupakan tanda bukti kepersertaan Nasabah pada program Asuransi dan wajib untuk disimpan sebaik-baiknya. Harap informasikan mengenai pertanggungan Asuransi ini kepada ahli waris yang tecantum di Sertifikat ini.</li>
<li>Maksimum uang pertanggungan untuk 1 (satu) orang tertanggung adalah sebesar Manfaat yang tercantum di Sertifikat ini.</li>
<li>Informasi lengkap mengenai program Asuransi ini dapat dilihat di www.jagadiri.co.id</li>
          </ol>
          <label class="line-agree-label"><input type="checkbox" class="line-agree">Saya telah membaca dan menyetujui pernyataan dan informasi di atas.</label>
        </div>
        <button class="btn-green btn-unduh line-btn disabled" disabled="disabled">
        	Unduh E-sertifikat
        </button>
 <br />
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

<script src="<?php echo $this->Html->url("/");?>linequiz-assets/js/jquery.js"></script>
<script src="<?php echo $this->Html->url("/");?>linequiz-assets/js/bootstrap.min.js"></script>
<script>
  $('.line-agree').change(function() {
    if(this.checked) {
      $('.btn-unduh').removeClass('disabled');
      $('.btn-unduh').prop("disabled", false);
    } else {
      $('.btn-unduh').addClass('disabled');
      $('.btn-unduh').prop("disabled", true);
    }
  });

$('.btn-unduh').click(function() {
    window.location.href = '<?php echo $download_url; ?>';
    return false;
});
</script>
