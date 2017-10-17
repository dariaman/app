<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>RajaPremi - Your Way, We Protect</title>
<meta name="keywords" content="Asuransi mobil, Asuransi motor, Asuransi kecelakaan diri, Asuransi Travel, Asuransi Jiwa">
<meta name="description" content="Temukan berbagai asuransi (mobil, motor, rumah, dan personal accident) dengan premi TERMURAH dari perusahaan ternama di RajaPremi.com">
<meta name="og:url" content="https://www.rajapremi.com/">
<meta name="og:title" content="RajaPremi - Your Way, We Protect">
<meta name="og:desc" content="Temukan berbagai asuransi (mobil, motor, rumah, dan personal accident) dengan premi TERMURAH dari perusahaan ternama di RajaPremi.com">
<meta name="og:image" content="https://www.rajapremi.com/assets/images/construct/bg-home-car.jpg">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">

<meta name="author" content="rajapremi">
<link rel="shortcut icon" type="image/x-icon" href="https://www.rajapremi.com/assets/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap core CSS -->
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,bold" rel="stylesheet"  property="stylesheet" type="text/css" media="all" >
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A600%2C300%2C400" rel="stylesheet" property="stylesheet" type="text/css" media="all" />
<link href="https://fonts.googleapis.com/css?family=Raleway%3A600" rel="stylesheet" property="stylesheet" type="text/css" media="all" />


<link href="https://www.rajapremi.com/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://www.rajapremi.com/assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">

<link href="https://www.rajapremi.com/assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
<link href="https://www.rajapremi.com/assets/plugins/fontawesome/css/font-awesome-animation.min.css" rel="stylesheet">
<link href="https://www.rajapremi.com/assets/css/styles.css" rel="stylesheet">

<script src="https://www.rajapremi.com/assets/js/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="payment-wrapper">
<header>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header" style="margin: auto;float: none;text-align: center;height: 45px;">
				<a href="https://www.rajapremi.com/"><img src="https://www.rajapremi.com/assets/images/construct/logo.png" style="height:100%"></a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
</header>
<div class="wrapper-inside2">
	<div class="container">
	<?php echo $this->fetch('content'); ?>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".payment-option .item").click(function(){
		$(".payment-option .active").removeClass("active");
		$(".payment-option .opened").hide();
		$(this).addClass("active").find("input").prop("checked", true);
		if($(this).has( "li" ).length)
			$(this).find(".additional-info").addClass("opened").slideDown();
	});
});
</script><div class="container footer-payment">
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 visible-xs text-center">2017 &copy; Rajapremi</div>
				<div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 hidden-xs">2017 &copy; Rajapremi</div>
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-6 hidden-xs text-right">
					<img src="https://www.rajapremi.com/assets/images/construct/pay-visa.png"/>
					<img src="https://www.rajapremi.com/assets/images/construct/pay-mastercard.png"/>
					<img src="https://www.rajapremi.com/assets/images/construct/pay-mandiri.png"/>
					<img src="https://www.rajapremi.com/assets/images/construct/pay-bri.png"/>
					<img src="https://www.rajapremi.com/assets/images/construct/pay-kredivo.png"/>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clear30"></div>
<link href="https://www.rajapremi.com/assets/dapurkita/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<script src="https://www.rajapremi.com/assets/dapurkita/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="https://www.rajapremi.com/assets/dapurkita/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<link href="https://www.rajapremi.com/assets/plugins/jqueryui/jquery-ui-rp.css" rel="stylesheet">
<script src="https://www.rajapremi.com/assets/plugins/jqueryui/jquery-ui.js"></script>
<script src="https://www.rajapremi.com/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://www.rajapremi.com/assets/js/auto-numeric.js"></script>
<script src="https://www.rajapremi.com/assets/js/general_script.js"></script>
</body>
</html>