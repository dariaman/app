<!DOCTYPE html>
<!-- layout front-->
<html lang="en">
<head>
	 <?php echo $this->element('tag_manager_head'); ?>
	<?php echo $this->element('widget_meta_title_tag'); ?>
	<link rel="shortcut icon" href="<?php echo $this->Html->url("/");?>favicon.ico">
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo $this->Html->url("/");?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/style.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/datepicker.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/validate.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/morris.css" rel="stylesheet"> 
	<!-- Custom CSS -->
	<link href="<?php echo $this->Html->url("/");?>css/animate.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo $this->Html->url("/");?>js/jquery.maskMoney.min.js" type="text/javascript"></script>

	<script src="<?php echo $this->Html->url("/");?>js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?php echo $this->Html->url("/");?>js/raphael-min.js" type="text/javascript"></script>
	<script src="<?php echo $this->Html->url("/");?>js/morris.min.js" type="text/javascript"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>

    function confirmClose(){
        $('#form-rawat-inap-jalan-form-modal').modal('hide');
        $('#close-rawat-inap-jalan-form-modal').modal('show');
    }
    function popUpInapJalan(){
        $('#polling-rawat-inap-jalan-form-modal').modal('show');
    }
    function showFormPolling(){
        $('#close-rawat-inap-jalan-form-modal').modal('hide');
        $('#form-rawat-inap-jalan-form-modal').modal('show');
    }
    function popUpFormVisitor(polling){
        $('#polling-rawat-inap-jalan-form-modal').modal('hide');
        var selectedPolling = polling;
        //console.log("klik "+ selectedPolling);
        showFormPolling();
    }

	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 500) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});
		$(document).ready(function(){
			$("#back-top").hide();
			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
	});
	$(document).ready(function () {
		$('.carousel').carousel({
			interval: 2500
		});
		$('.carousel').carousel('cycle');
	});
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	$(function() {
		window.prettyPrint && prettyPrint()
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
			e.stopPropagation()
		})
	});
</script>
<?php echo $this->element('widget_ga_tag'); ?>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	 <?php echo $this->element('tag_manager_body'); ?>
	<?php echo $this->element('front/header'); ?>

	<div class="main-content">
		<div class="container">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<br>
	<?php echo $this->element('front/footer'); ?>
	<div id="back-top" style="float:right;">
		<a href="#top"><span ></span>Top</a>
	</div>
  
	<?php // echo $this->element('widget_remarketing_tag'); ?>
	<script type="text/javascript">
		$('#loginbtn').on('click', function() {
			ga('send', 'event', 'member', 'click', 'login');
		});
	</script>
  
  <?php echo $this->element('dmp_tag');?>
  <?php echo $this->element('survey_popup'); ?>
</body>
</html>
