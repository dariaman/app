<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	 <link rel="shortcut icon" href="<?php echo $this->Html->url("/");?>favicon.ico">
	<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width">
		<?php echo $this->Html->meta('icon'); ?>
		<title><?php echo $title_for_layout; ?></title>
	    
		
        <?php  echo $this->AssetCompress->css('P2zYu8'); ?>
		<?php  echo $this->AssetCompress->script('P2zYu8'); 
		echo $this->Html->script(array('tinymce/tinymce.min.js'));
		?>

		
		
	</head>
	<body>
	
	 <script type="text/javascript">
tinymce.init({
    selector: "textarea",
	height : 280,
    theme: "modern",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
</script>
<div class="navbar navbar-default" id="navbar">
		<?php echo $this->element('admin/header'); ?>
		
</div>

<div class="main-container-inner">

	<div  class="sidebar ">
		<?php echo $this->element('admin/sidebar'); ?>
		
	</div>
	

	
	
	<div class="main-content">
		<div class="page-content">
			
			<?php echo $this->fetch('content'); ?>
			
		</div>
		<div id="footer">
			<center>Powered by <a href="http://aqi.co.id">AsiaQuest Indonesia</a></center>
		</div>

	</div>

</div>
	</body>
</html>
