<!DOCTYPE HTML>
<!-- layout default-->
<html>
<head>
	 <?php echo $this->element('tag_manager_head'); ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<title>
		<?php 	if($error->getCode() ==500) echo 'Terjadi Kesalahan Error'; 
				else if($error->getCode() ==404) echo 'Halaman yang anda cari Tidak ditemukan'; 
				else echo 'Jagadiri Default Page';
		?>
	</title>
	<link rel="shortcut icon" href="<?php echo $this->Html->url("/");?>favicon.ico">
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo $this->Html->url("/");?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/style.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo $this->Html->url("/");?>css/animate.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
	<script>
	$(function() {
		window.prettyPrint && prettyPrint()
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
			e.stopPropagation()
		})
	})
	</script>
	 <?php echo $this->element('widget_ga_tag'); ?>
</head>
<body>
	 <?php echo $this->element('tag_manager_body'); ?>
  <?php echo $this->element('front/header'); ?>
	<div class="container" style="min-height:250px">
		<?php echo $this->fetch('content'); ?>
	</div>
 <br>
  <?php echo $this->element('front/footer'); ?>
  <div id="back-top" style="float:right;">
    <a href="#top"><span ></span>Top</a>
  </div>
</body>
</html>
