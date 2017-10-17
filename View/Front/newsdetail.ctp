
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'news'))?>">News</a></li>
			<li class="active"><?php echo $newsdetail['News']['title'] ?></li>
		</ol>
		<!--<div class="mainvisual">
		 
		</div>-->
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="artikeldetail">
		<div class="pull-left">BERITA JAGADIRI</div>
		<br><br>
     	<?php 
            if($newsdetail['News']['picture']==""){
            ?>
            <img  height="200px" width="100%"  alt="Gambar: <?php echo $newsdetail['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   >

            <?php }else{ ?>
            <img  class="img-responsive" alt="Gambar: <?php echo $newsdetail['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $newsdetail['News']['picture'];?>"/>

        <?php } ?>

	<div class="text" style="font-size:20px;font-weight: bold;color:#428bca;margin-top:20px;"><?php echo $newsdetail['News']['title'];?></div>
<br>
	<div class="text" style="font-size:16px"><?php echo $newsdetail['News']['content'];?></div>
	</div><!--end artikeldetail-->
	
<br>
	<div class="artikellainny">
	<div class="pull-left">BERITA LAINNYA</div>
	<br>
		<div class="row">
			<?php foreach ($news2 as $ns){ ?>
						<div class="desc-proc col-md-6 col-lg-6" style="height:200px;">
	<div class="row" >
		<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'newsdetail','id'=>$ns['News']['seo']))?>">
			<div class=" col-md-6 col-lg-6 col-xs-12" style="padding-top:20px">							
 				<?php if($ns["News"]['picture']==""){ ?>
					<img alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   class="img-responsive ">
				<?php }else{ ?>
					<img alt="Gambar: <?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $ns['News']['picture'];?>" class="img-responsive "/>
				<?php } ?>
			</div>
			<div class=" col-md-6 col-lg-6 col-xs-12">
				<div class="text"  style="font-weight: bold;padding-top:20px;"><?php echo $ns['News']['title'];?></div>
		</a>		
				<div class="text" style="font-size:12px;margin-top:5px;" ><?php echo $ns["News"]['short_desc'] ?></div>
			</div>
		
	</div><!--div row-->
</div>
            		<?php } ?>

		</div>
	</div><!--end artikellainnya-->

	<div style="text-align:center;margin-top:30px;"><a style="
	padding: 10px 15px;
	margin-top:80px;
	background: #f44336;
	color: #FFF;" href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'news'))?>">Memuat Lebih</a></div>

	</div>
</div>


</div>


<script type="">
jQuery.validator.addMethod("validplus", function(value, element) {
			conv = value.substring(0,3);
			if(conv == '+62') return false;
			return true;
		}, "Please Change +62 to 0 ");

jQuery.validator.addMethod("validlength", function(value, element) {
if(value.length >0 && value.length <8) return false;
return true;
}, "8 numbers minimum");

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
}, "Not valid numbers");

    // validate the form when it is submitted
    var valContactMe = $("#Contactme").validate({
     	errorElement: "span",
    	errorPlacement: function(error, element) {
                        error.insertBefore(element);
        }
     });
     $("#nama").rules("add", {
         required:true,
         messages: {
                required: "Please Enter Your Name."
         }
      });
     $("#email").rules("add", {
         required:true,
         email: true,
         messages: {
                required: "Please Enter Your Email.",
    		email: "Please Enter Your Valid Email."
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
     

function ContactMe(){
    	if(valContactMe.form()) {
        <?php if($productdetail['Product']['id']!=1):?>
			ga('send', 'event', { eventCategory: 'potential lead', eventAction: 'click', eventLabel: '<?php echo 'contact - '.$gaSend[$productdetail['Product']['id']];?>'});
      <?php endif;?>
      }
    }

$('#contactme-btn').on('click', function() {
  ga('send', 'event', 'potential lead', 'click', 'contact me'); 
});
$('#btn-apply-product').on('click', function() {
ga('send', 'event', 'customer', 'click', 'apply now - product'); 
});
</script>

