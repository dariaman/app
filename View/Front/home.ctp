<section id="intro" class="intro-section">
	<div class="container">
		<div class="carousel slide" id="carousel-194094">

			<div class="carousel-inner">
				<?php $a = 0; $i=1; ?>
		  
				<?php foreach($banners as $ban): ?>
				<?php $a = $a + 1; ?>
				<div class="item <?php if($i==1) echo "active"; ?>">
					<?php if($ban['Banner']['link']==''): ?>
					<img alt="<?php echo $ban['Banner']['alt'] ?>" src="<?php echo $this->Html->url('/img/banner/'.$ban['Banner']['picture']); ?>" class="img-responsive" />
					<?php else: ?>
					<a href="<?php echo $ban['Banner']['link'] ?>" target="<?php if($ban['Banner']['target_link']!=0) echo "_blank"; else echo '';?>" onClick="gaBannerCode(<?php echo $ban['Banner']['id']?>);"><img alt="Promo Jagadiri" src="<?php echo $this->Html->url('/img/banner/'.$ban['Banner']['picture']); ?>" class="img-responsive" /></a>
					<?php endif; ?>
				</div>
				<?php $i=0; endforeach; ?>

				<?php foreach ($promo as $pr ): ?>
				<?php $a = $a + 1; ?>
				<div class="item <?php if($i==1) echo "active"; ?>">
					<?php if(isset($pr['Promo']['img_promo_detail']) AND ''!=$pr['Promo']['img_promo_detail']): ?>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'detail_promo','seo'=>$pr['Promo']['seo'])) ?>" target="_blank">
						<img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage'])?>" class="img-responsive">
						</a>
					<?php else: ?>
						<img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_homepage'])?>" class="img-responsive">
					<?php endif; ?>
				</div>
				<?php $i=0; endforeach; ?>

			</div> 

			<a data-slide="prev" href="#carousel-194094" class="left carousel-control"><img src="<?php echo $this->Html->url("/"); ?>img/left-arrow.png" alt="Arah" /></a>
			<a data-slide="next" href="#carousel-194094" class="right carousel-control"><img src="<?php echo $this->Html->url("/"); ?>img/right-arrow.png" alt="Arah" /></a> 
              
			  <!--<ol class="home-i carousel-indicators p-indicator">
				<?php for ($x = 0; $x < $a; $x++) { $z = $x + 1;?>
					<?php if(1 == $x) { ?>
						<li data-target="#carousel-194094" data-slide-to="<?php echo $x; ?>" class="active"><?php echo $z; ?></li>
					<?php } else { ?>
						<li data-target="#carousel-194094" data-slide-to="<?php echo $x; ?>"><?php echo $z; ?></li>
					<?php } ?>
				<?php } ?>
              </ol>-->

		</div>
	</div>
</section>


<section>
	<div class="container">
		<div class="hub-say">
			<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
			<h5>Saya Mau</h5>
			<?php 
				echo $this->Form->create('Leavenumber',array('id'=>'Lnumber','class'=>' form-inline','role'=>'form','type' => 'post','novalidate'=>true)); 
				$this->Form->inputDefaults(array('label' => false));

				
				?>
				<div class="form-group col-sm-3">
					<select name="data[Leavenumber][Contact_Tipe]">
						<option value="Leads Homepage" selected>Melakukan Pembelian</option>
						<option value="info">Mencari Informasi Produk</option>
					</select>
				</div>
				<div class="form-group col-sm-3">
					<?php echo $this->Form->input('Contact_Name', array('id'=>'name', 'placeholder' => 'Nama', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
				</div>
				<div class="form-group col-sm-3">
					<?php echo $this->Form->input('Contact_Phone', array('id'=>'phone', 'validNotelp'=>true,'validlength'=>true,'validplus'=>true, 'placeholder' => 'Nomor Telepon', 'class'=>'form-control', 'div'=>false, 'type'=>'text')); ?>
				</div>
				<div class="form-group col-sm-3">
					<button type="submit" class="btn-caf-blue" id="leave-numb-btn" onsubmit="Leave_Number();">Hubungi Saya</button>

				</div>
			<?php 
				if ($this->Session->check('Adv')){
				echo $this->form->hidden('Leavenumber.Contact_CreatedDate',array('value'=>date("Y-m-d") ));
				echo $this->form->hidden('Leavenumber.Contact_Optmzd_Id',array('value'=>$this->Session->read('Adv.optmzd_id') ));
				echo $this->form->hidden('Leavenumber.Contact_Gclid ',array('value'=>$this->Session->read('Adv.gclid')  ));
				}
			?>
				</form>
				<div class="form-group col-sm-3 hidden-sm hidden-md hidden-lg">
					<center><h5>Atau</h5></center>
				</div>


				<div class="form-group col-sm-3 hidden-sm hidden-md hidden-lg">
					<a href="/chat_with_us/chat?locale=id" target="_blank" class="hidden-sm hidden-md hidden-lg img-responsive" onClick="ga('send', 'event', { eventCategory: 'communication', eventAction: 'click', eventLabel: 'chat with us - home'}); if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><button  class="btn-caf-blue" id="liveChat" >Live Chat</button></a>

				</div>

				<div class="clearfix"></div>
			<!--</form>-->
		</div>
	</div>
</section>



<!-- About Section -->
<section id="about" class="about-section">
	<div class="container">
		<h2 class="title text-center">
			Produk terbaik dari <span class="peach">JAGADIRI</span>
		</h2>
  <!-- SEMI HARDCODE -->
  <?php 
    
    $prodHome=array(1=>array('picture'=>'product1.png','seo'=>'jaga-sehat-plus','active'=>0,'cat_quote'=>0),2=>array('picture'=>'jsklogo_UPDATE.png','seo'=>'jaga-sehat-keluarga','active'=>0,'cat_quote'=>0),3=>array('picture'=>'product6.png','seo'=>'jaga-jiwa-plus','active'=>0,'cat_quote'=>0),4=>array('picture'=>'product-jai.png','seo'=>'jaga-aman-instan','active'=>0,'cat_quote'=>1));
  ?>
	<div class="list-prod box-grey margintop2">
			<div class="row">
        <?php 
          $j=1;
          while($j<=4){
        ?>
				<div class="col-sm-6 col-md-3 col-lg-3 marginbottom">
					<!-- icon Best Seller -->
          <?php if($prodHome[$j]['seo']=='jaga-sehat-plus' || $prodHome[$j]['seo']=='jaga-aman-instan'):?>
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/best-seller-small.png" alt="Best Seller" />
          </div>
          <?php else: ?>
          <div class="best-seller">
            <img src="<?php echo $this->Html->url('/')?>img/recommended-small.png" alt="Recommended" />
          </div>
          <?php endif;?>
          <div class="carousel-inner">
						<div class="item active">
							<a href="<?php if($prodHome[$j]['active']==0) echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$prodHome[$j]['seo'])); else echo '#';?>">	
								<img alt="Produk Jaga Sehat" src="<?php echo $this->Html->url("/");?>img/<?php echo $prodHome[$j]['picture']?>" />
							</a>
							<div class="carousel-caption-product">
								<h4 class="title-cap-home">
									<?php if($prodHome[$j]['seo']=='jaga-sehat-plus'):?>
                  Jaga Sehat<br />Plus
                  <?php elseif($prodHome[$j]['seo']=='jaga-sehat-keluarga'):?>
                  Jaga Sehat<br/>Keluarga
                  <?php elseif($prodHome[$j]['seo']=='jaga-jiwa-plus'):?>
                  Jaga Jiwa<br/>Plus
                  <?php else:?>
                  Jaga Aman<br/>Instan
                  <?php endif;?>
								</h4>
								
							</div>
						</div>
					</div>
					<p class="review-product content-box">
            <?php if($prodHome[$j]['seo']=='jaga-sehat-plus'):?>
            Premi mulai dari 90ribu-an, plus 50% premi kembali, pasti! &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php elseif($prodHome[$j]['seo']=='jaga-aman-instan'):?>
            Asuransi kecelakaan dengan premi mulai Rp 5 ribu-an! &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php elseif($prodHome[$j]['seo']=='jaga-jiwa-plus'):?>
            Perlindungan jiwa semudah pinjam karena premi dikembalikan 110% jika tidak ada klaim!
            <?php else:?>
            Hanya 1 premi untuk 1 keluarga, tersedia fasilitas rawat jalan.
            <?php endif;?>
						
					</p> <p>&nbsp;</p> 
					<center>
          <div class="row">
            <div class="col-xs-6">
            <a href="<?php if($prodHome[$j]['active']==0): 
            if($prodHome[$j]['cat_quote']==0){
              $act='step1_non_unitlink';
            }else{
              $act='step1_unitlink';
            }
	// perbaikan broken link jai
	if( $prodHome[$j]['seo']=='jaga-aman-instan'){
             $act='step1_non_unitlink';
            } 
	// end jai
            echo $this->Html->url(array('controller'=>'front','action'=>$act,'id'=>$prodHome[$j]['seo'])); else: echo '#'; endif;?>" class="btn btn-default2" onClick="ga('send', 'event', { eventCategory: 'customer lead-home', eventAction: 'click', eventLabel: 'beli - jsp'});"><?php if($prodHome[$j]['active']==0) echo 'Beli Sekarang'; else echo 'Segera Hadir';?></a>
            </div><div class="col-xs-6">
            <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$prodHome[$j]['seo']))?>" type="button" class="btn btn-default4">Lihat Detail</a>
            </div>
          </div></center>
				</div>
          <?php $j++; }  //endwhile?>
				</div>
		</div>
	</div>
</section>



<section>
	<div class="container">
		<div class="t-solusi">
			<div class="triangle-left">
				<img src="<?php echo $this->Html->url("/");?>img/triangle-left.png" alt="Kiri" />
			</div>
			<div class="main-t-solusi">
				<div class="desc-t">
					<h4>Kenali kebutuhan Anda</h4>
					<p>Kami akan membantu Anda untuk menentukan pilihan produk yang sesuai untuk kebutuhan Anda.</p>
				</div>
				<div class="laj">
					<img src="<?php echo $this->Html->url("/");?>img/laj.jpg" alt="Status"/>
				</div>
				<div class="link-t">
					<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>">Temukan<br />Solusi</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="services">
			<h2 class="title text-center">Mengapa <span class="peach">JAGADIRI</span> <span class="bold">berbeda</span> ?</h2>
			<div class="col-sm-6">
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why1-new.png" alt="Mudah dan Langsung" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Pembelian mudah & langsung</h5>
						<p class="content-new">Daftar asuransi tidak pernah semudah ini. Klik, bayar, langsung terlindungi!</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why2-new.png" alt="Klaim Jelas dan Transparan" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Klaim yang jelas dan transparan</h5>
						<p class="content-new">Mau klaim kok repot? Hanya di Jagadiri proses klaim tanpa ribet</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-serv">
					<div class="img-list-serv col-sm-3">
						<center><img src="<?php echo $this->Html->url("/");?>img/why3-new.png" alt="Jaminan Harga Terbaik" /></center>
					</div>
					<div class="desc-list-serv col-sm-9">
						<h5 class="title">Jaminan harga terbaik!</h5>
						<p class="content-new">Bukan zamannya main rahasia-rahasiaan. Semua biaya dikupas tuntas</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="vide col-sm-6">
				<iframe src="//www.youtube.com/embed/exQ_n2vGDDA?autoplay=0" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>


	<script type="">
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

		
    // validate the form when it is submitted
    var valLeaveNumb = $("#Lnumber").validate({
    	errorElement: "span",
    	errorPlacement: function(error, element) {
    		error.insertBefore(element);
    	}
    });
    $("#name").rules("add", {
    	required:true,
    	messages: {
    		required: "Please Enter Your Name."
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
	


	$(".cb_lainnya").click(function() {
	    if (this.checked){
			$('#Lainnya').attr("disabled", false).focus();
		    $('#Lainnya').attr("required", true);
			$('#Lainnya').removeAttr("placeholder");
			
			
		}else{
			$('#Lainnya').attr("disabled", true);
			$('#Lainnya').attr("required", false);
			$('#Lainnya').attr("placeholder", "Lainnya");
		}
	});

	function submitPolling(){
		//alert("a");
	}
	 
    //end leave number validation
    function Leave_Number(){
    	if(valLeaveNumb.form()) {
    		ga('send', 'event', { eventCategory: 'potential lead-home', eventAction: 'click', eventLabel: 'leave your number'});
		ga('send', 'event', { eventCategory: 'Homepage', eventAction: 'click', eventLabel: 'Homepage - Hubungin Saya button'});//new

    	}
    }
    
    function gaBannerCode(id){
      getBannerCode=id;
      if(getBannerCode==21)
        ga('send', 'event', { eventCategory: 'lead to app', eventAction: 'click', eventLabel: 'google play - home'});
      else
        ga('send', 'event', { eventCategory: 'lead to blog', eventAction: 'click', eventLabel: 'blog - home'});
    }

    $('#get-mobile-btn').on('click', function() {
    	ga('send', 'event', 'potential lead', 'click', 'install apps'); 
    });
    $('#get-gplay-apps').on('click', function() {
    	ga('send', 'event', 'potential lead', 'click', 'install apps'); 
    });
    $('#apply-btn').on('click', function() {
    	ga('send', 'event', 'customer', 'click', 'apply now - home'); 
    });
    $().ready(function(){
	//empty name and phone field
	document.getElementById("name").value = '';
	document.getElementById("phone").value = '';
	

});
</script>

<!-- carausel news -->
<section id="artikel3" class="intro-section">
<div class="container">
	<h2 class="title text-center">
			Berita <span class="peach">JAGADIRI</span>
	</h2>

</div>

    <div class="container">
    
            <div class="span12">
                <div class="well">
                    <div id="myCarousel" class="carousel fdi-Carousel slide">
                     <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
				  		
<!--ver 1.13-->
		
<?php for ($i=0;$i < sizeof($news2);$i=$i+3){ ?>
<div class="item <?php if($i==0){echo "active";} ?>">

	<?php $x=$i+3; for($j=$i;$j<$x;$j++){ ?>
<div class="col-md-4" style="height:320px">
	<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'newsdetail','id'=>$news2[$j]['News']['seo']))?>">
		<?php if($news2[$j]["News"]['picture']==""){?>
			<img alt="Gambar:<?php echo $news2[$j]['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   class="img-responsive ">
		<?php }else{ ?>
			<img alt="Gambar:<?php echo $news2[$j]['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $news2[$j]['News']['picture'];?>" class="img-responsive " style=" max-height: 6cm;"/>
		<?php } ?>
		<div class="text" style="font-weight: bold;padding:5px;top:5px;"><?php echo $news2[$j]["News"]['title'] ?></div>
	</a>
<div class="text" style="font-size:12px;padding:3px;"><?php echo $news2[$j]["News"]['short_desc'] ?></div>

</div>
	<?php } // for j?>

</div>
<?php } //for i?>

				
<!--ver 1.13-->

		
                            </div>
                            <a class="left carousel-control" href="#eventCarousel" data-slide="prev"><img src="/img/left-arrow.png"></a>
                            <a class="right carousel-control" href="#eventCarousel" data-slide="next"><img src="/img/right-arrow.png"></a>

                
                        </div>
 
                        <!--/carousel-inner-->
<div style="text-align:center;margin-top:30px;"><a style="
	padding: 10px 15px;
	margin-top:80px;
	background: #f44336;
	color: #FFF;" href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'news'))?>">Memuat Lebih</a></div>



                    </div><!--/myCarousel-->
                </div><!--/well-->
            </div>
    
    </div>


<style>

.well {

  margin-bottom: 0px;
 }
.carousel-control.left,.carousel-control.right  {background:none;width:25px;}
.carousel-control.left {left:0px;}
.carousel-control.right {right:0px;}
.broun-block {

.carousel-inner.onebyone-carosel { margin: auto; width: 90%; }
.onebyone-carosel .active.left { left: -33.33%; }
.onebyone-carosel .active.right { left: 33.33%; }
.onebyone-carosel .next { left: 33.33%; }
.onebyone-carosel .prev { left: -33.33%; }
</style>
<script>
$(document).ready(function () {
    $('#myCarousel').carousel({
        interval: 50000
    })
   /* $('.fdi-Carousel .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        if (next.next().length > 0) {
            next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });*/
});
</script>
</section>
<!-- end carausel news -->

<section id="popup">

<div class="modal fade" id="modalnotif" style="padding-top:7%;">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="img/close-btn.png" alt="icon"></button>
			<div class="row">
				                                <img class="img-responsive"  src="img/CNY-01.png" alt="Selamat imlek">
			</div>
		</div>
	</div>
</div>

  <div id="myModal22" class="modal fade" style="padding-top:7%;">
    <div class="modal-dialog">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="img/close-btn.png" alt="icon"></button>
        <div class="">
		<div class="no-gap clearfix">
					<div class="col-md-12">
						<div class="row">
						    <!-- banner -->
                            <div class="">
				                                <img class="img-responsive"  src="img/CNY-01.png" alt="Selamat imlek">
				
                        	</div>
						</div>
                    </div>
                  </div>
        </div>
</div>
</div>
</div>

<script type="text/javascript">
   // $('#myModal22').modal({backdrop: 'static', keyboard: false});
   // $('#myModal22').modal('show');
</script>
</section>