<!-- layout login-->
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex,nofollow">
	
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo $this->Html->url("/");?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->Html->url("/");?>css/style.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo $this->Html->url("/");?>css/animate.css" rel="stylesheet">
	
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->Html->url("/");?>js/bootstrap.min.js"></script>
	<?php
	echo $this->Html->meta('icon');
	// echo $this->AssetCompress->css('P2zYu8');
	// echo $this->AssetCompress->script('P2zYu8');
	?>
	<script>
	$(function() {
		window.prettyPrint && prettyPrint()
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
			e.stopPropagation()
		})
	})
	</script>
	<script>
	$(document).ready(function(){

		// hide #back-top first
		$("#back-top").hide();
		
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 500) {
					$('#back-top').fadeIn();
				} else {
					$('#back-top').fadeOut();
				}
			});

			// scroll body to 0px on click
			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});

	});
	</script>

</head>
<body>
	<div class="container">
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
