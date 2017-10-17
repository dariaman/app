<!DOCTYPE HTML>
<!-- layout default-->
<html>
<head>
	 <?php echo $this->element('tag_manager_head'); ?>
	<?php echo $this->element('widget_meta_title_tag'); ?>
	
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
<style>
html, body {
	width:100%;
	height: 100%;
	color:white;
}
.bg {
	width: 100%;
	height: 100%;
	display: table;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiNkMzU0NDgiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjNGExMTBjIiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-radial-gradient(center, ellipse cover, #d35448 0%, #4a110c 100%); /* FF3.6+ */
	background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#d35448), color-stop(100%,#4a110c)); /* Chrome,Safari4+ */
	background: -webkit-radial-gradient(center, ellipse cover, #d35448 0%,#4a110c 100%); /* Chrome10+,Safari5.1+ */
	background: -o-radial-gradient(center, ellipse cover, #d35448 0%,#4a110c 100%); /* Opera 12+ */
	background: -ms-radial-gradient(center, ellipse cover, #d35448 0%,#4a110c 100%); /* IE10+ */
	background: radial-gradient(ellipse at center, #d35448 0%,#4a110c 100%); /* W3C */
}

</style>
<body class="bg">
	 <?php //echo $this->element('tag_manager_body'); ?>
  
  <?php // echo $this->element('front/header'); ?>
	<div class="container-fluid" style="min-height:250px">
		<?php echo $this->fetch('content'); ?>
	</div>
  <?php // echo $this->element('front/footer'); ?>
  
</body>
</html>
