<!DOCTYPE html>
<!-- layout home-->
<html lang="en">
<head>
   <?php echo $this->element('tag_manager_head'); ?>
    <?php echo $this->element('widget_meta_title_tag'); ?>
    <link rel="shortcut icon" href="<?php echo $this->Html->url("/");?>favicon.ico">
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $this->Html->url("/");?>css/landing6.css" rel="stylesheet">
    <link href="<?php echo $this->Html->url("/");?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->Html->url("/");?>css/style.css" rel="stylesheet">
    <link href="<?php echo $this->Html->url("/");?>css/morris.css" rel="stylesheet">
    <link href="<?php echo $this->Html->url("/");?>css/validate.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo $this->Html->url("/");?>css/animate.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
    <script src="<?php echo $this->Html->url("/");?>js/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
    <script src="<?php echo $this->Html->url("/");?>js/raphael-min.js" type="text/javascript"></script>
    <script src="<?php echo $this->Html->url("/");?>js/morris.min.js" type="text/javascript"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.<?php echo $this->Html->url("/");?>js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        $(document).ready(function () {
            $('.carousel').carousel({
                interval: 5000
            });

            $('.carousel').carousel('cycle');
        });

        $(function() {
            window.prettyPrint && prettyPrint()
            $(document).on('click', '.yamm .dropdown-menu', function(e) {
                e.stopPropagation()
            })
        });

        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 500) {
                    $('#back-top').fadeIn();
                }
                else {
                    $('#back-top').fadeOut();
                }
            });

        $(document).ready(function() {
            $("#back-top").hide();

            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                
                return false;
            });
        }); });
    </script>

    <script>
     function showModal(){
            $('#modalPolling').modal({backdrop: 'static', keyboard: false});
            $('#modalPolling').modal('show');
          }
    
          function closeModal(){
            if(checkboxValue.length == 0) {
              $('#modalPolling').modal('hide');
              $('#modalAlert').modal({backdrop: 'static', keyboard: false});
              $('#modalAlert').modal('show');
            } 
          }
    
          function hideModal(id){
            $('#' + id).modal('hide');
            showModal();
          }
    
          function submitPolling() {
            checkboxValue = [];
            $('#sumberJagadiri :checked').each(function() {
              checkboxValue.push($(this).val());
            });
            if(checkboxValue.length > 0)
              $('#modalPolling').modal('hide');
              // send data to database
            else if(checkboxValue.length == 0) {
              $('#modalPolling').modal('hide');
              $('#modalWarning').modal({backdrop: 'static', keyboard: false});
              $('#modalWarning').modal('show');
            }
          }
        $(document).ready(function(){
            // fade in #back-top
            $(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() < 150) {
                        $('.down').fadeIn();
                    } else {
                        $('.down').fadeOut();
                    }
                });
            });    });
    </script>

    <?php //echo $this->element('widget_ga_tag'); ?>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
   <?php echo $this->element('tag_manager_body'); ?>
<?php //echo $this->element('front/snowy'); ?>
    <?php echo $this->element('front/header'); ?>
    <?php echo $this->fetch('content'); ?>
    <?php echo $this->element('front/footer'); ?>

    

    <!-- Scrolling Nav JavaScript -->
    <script src="<?php echo $this->Html->url("/");?>js/jquery.easing.min.js"></script>
    <script src="<?php echo $this->Html->url("/");?>js/scrolling-nav.js"></script>
    <script src="<?php echo $this->Html->url("/");?>js/wow.js"></script>
    <script>
        wow = new WOW({animateClass: 'animated',offset:100});
        wow.init();
    </script>

    <div id="back-top" style="float:right;">
        <a href="#top"><span ></span>Top</a>
    </div>

    <?php // echo $this->element('widget_remarketing_tag'); ?>


    <?php // echo $this->element('dmp_tag');?>
    <?php echo $this->element('survey_popup'); ?>

    <script>
        //jQuery.noConflict();
        <?php //if(isset($flash) )?>
        <?php if(!isset($flash) && !isset($flash1) && !isset($flash2) && !isset($flash3)):?>
          jQuery(function() {
            jQuery('#myModal').modal({ show: true });
          });
        <?php elseif(isset($flash2) && $flash2==1 || isset($flash3) && $flash3==1):?>
          jQuery(function() {
            jQuery('#myModal').modal({ show: true });
            $('#hideAfter,#hideAfter1,#phone').hide();
          });
        <?php elseif(isset($flash1) && $flash1==1):?>
          jQuery(function() {
            jQuery('#myModal').modal({ show: false });
            $('#hideAfter2,#hideAfter3,#phonel').hide();
          });
        <?php else:?>
          jQuery(function() {
            jQuery('#myModal').modal({ show: true });
          });
        <?php endif;?>
    </script>

<script type="">
// $('#modalPolling').modal('show');

  jQuery.validator.addMethod("validplus", function(value, element) {
    conv = value.substring(0,3);
    if(conv == '+62') return false;
    return true;
  }, "Please Change +62 to 0 ");

  jQuery.validator.addMethod("validlength", function(value, element) {
    if(value.length >0 && value.length <8) return false;
    return true;
  }, "8 numbers minimum");


    jQuery.validator.addMethod("validReqN", function(value, element) {
      if(value.length == 0) return false;
      return true;
  }, "Masukan Nama");

  function validateEmail($email) {
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
   return emailReg.test( $email );
 }
      jQuery.validator.addMethod("validReqE", function(value, element) {
        if (!validateEmail(value))  return false;
        if(value.length == 0) return false;
        return true;
    }, "Email Salah");

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
    }, "Masukan nomor handphone");

      jQuery.validator.addMethod("validNotelp2", function(value, element) {
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
        }, "Not valid");

var valContactMe3 = $("#Contactmerl").validate({
  errorElement: "span",
  errorPlacement: function(error, element) {
    error.insertBefore(element);
  }
});

//$("#nama").rules("add",{required:true,messages: {required: "Masukan Nama Anda"}});
$("#phone").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

$("#phonel").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

$("#namarrl").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#namarr").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#phonerr").rules("add",{required:true,number:true,messages:{required: "Not valid",number: "Masukan angka"}});

$("#namaR").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#phoneR").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR2").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR2").rules("add",{required:false,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR3").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR3").rules("add",{required:false,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

// $("#namarr").rules("add",{required:true,messages: {required: "Masukan Nama"}});
// $("#phonerr").rules("add",{required:true,number:true,messages:{required: "Not Valid",number: "Masukan angka"}});

$("#namaRl").rules("add",{required:true,messages: {required: "Masukan Nama"}});
$("#phoneRl").rules("add",{required:true,number:true,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR2l").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR2l").rules("add",{required:false,number:false,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});
$("#namaR3l").rules("add",{required:false,messages: {required: "Masukan Nama"}});
$("#phoneR3l").rules("add",{required:false,number:false,messages:{required: "Masukan nomor handphone",number: "Masukan angka"}});

$("#emailrr").rules("add",{required:true,email:true,messages:{required: "Email salah",email: "Email salah"}});
$("#emailrr2").rules("add",{required:true,email:true,messages:{required: "Email salah",email: "Email salah"}});



$('.btn-hub').on('click', function() {
 ga('send', 'event', { eventCategory: 'potential lead-lp', eventAction: 'click', eventLabel: 'leave your number'});
});
</script>
</body>
</html>
