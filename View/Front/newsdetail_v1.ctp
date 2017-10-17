
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
	<div class="col-xs-12 col-sm-12 col-md-8">

		<!--<img width="100%" height="200px"alt="Gambar:<?php echo $newsdetail['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $newsdetail['News']['picture'];?>"/>-->

        <?php 
            if($newsdetail['News']['picture']==""){
            ?>
            <img  height="200px" width="100%"  alt="Gambar: <?php echo $newsdetail['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   >

            <?php }else{ ?>
            <img  width="100%"  alt="Gambar: <?php echo $newsdetail['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $newsdetail['News']['picture'];?>"/>

        <?php } ?>

	<h2 class="title-berita"><?php echo $newsdetail['News']['title'];?></h2>
	<?php echo $newsdetail['News']['content'];?>
	</div>

	<div class=" container col-xs-12 col-sm-12 col-md-4">
<hr style="visibility:hidden;"/>
       Terbaru Dari Jagadiri
<hr class="redline"/>
		     <?php $i=0;foreach ($news2 as $ns){ ?>
                	   				
                	   				 <div class="item <?php if($i==0){echo "active";} ?>">
	                                    <div class="col-md-6">
	                                        <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'newsdetail','id'=>$ns['News']['seo']))?>">
	                                        
	                                      
	                                        <?php 
	                                        if($ns["News"]['picture']==""){
	                                       	?>
	                                       	<img alt="Gambar:<?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url('/img/no_img.jpg');?>"   class="img-responsive ">
	                                     
	                                       	<?php }else{ ?>
	                                       <img alt="Gambar:<?php echo $ns['News']['title'];?>" src="<?php echo $this->Html->url("/");?>img/news/<?php echo $ns['News']['picture'];?>"/>

	                                       	<?php } ?>



	                                      
	                                        
	                                        <div class="text"><?php echo $ns["News"]['title'] ?></div>
	                                        </a>
	                                    </div>
                               		</div>
                	   				
            					<?php $i++;} ?>

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

