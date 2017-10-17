<!--<div class="row">
List Rekanan Jaga Sehat Plus
<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="<?php $this->Html->url('/');?>Daftar_RS_Rekanan.pdf" frameborder="1" scrolling="auto" height="100%" width="100%" ></iframe>
</div>
<div class="row">
List Rekanan Jaga Sehat Keluarga
<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="<?php $this->Html->url('/');?>Daftar_RS_Rekanan_JSK.pdf" frameborder="1" scrolling="auto" height="100%" width="100%" ></iframe>
</div>-->


<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>">Home</a></li>
			<li class="active">Daftar RS Rekanan</li>
		</ol>
		<!--<div class="mainvisual">
 
		</div>-->
	</div>
</div>


<div class="row">

	<div class=" col-sm-9" style="">
		<img alt="daftar rekanan" src="<?php echo $this->Html->url("/");?>img/newicon/header-RS.png" class="img-responsive">
				<div class=" col-sm-12" style="border-radius: 15px; background:#D8D8D8;top:15px;  padding: 10px 0;" align="center">
					<div sytle="margin-top:50px;margin-bottom:25px;">
					<a href="<?php echo $this->Html->url('/');?>preview/Daftar_RS_Rekanan.pdf">
						<img alt="preview rekanan jsp" src="<?php echo $this->Html->url("/");?>img/newicon/BUTTON-RS-JSP.png" class="img-responsive">
					</a>
					</div>
					<div sytle="margin-top:25px;margin-bottom:50px;">
					<a href="<?php echo $this->Html->url('/');?>preview/Daftar_RS_Rekanan_JSK.pdf">
					<img alt="preview rekanan jsk" src="<?php echo $this->Html->url("/");?>img/newicon/BUTTON-RS-JSK.png" class="img-responsive">
					</a>
					</div>
				</div>
	</div>

	<div class=" col-sm-3" style="top:20px;">
		<div class=" col-sm-12 col-xs-12">
		<img alt="list rekanan" src="<?php echo $this->Html->url("/");?>img/newicon/rs-rekanan-03.png" class="img-responsive">
		</div>
		<div class=" col-sm-12 col-xs-12">
		
			<div style=" position: relative;">
				<img style="position: relative;z-index:500;"alt="list unduh rekanan" src="<?php echo $this->Html->url("/");?>img/newicon/BG-UNDUH.png" class="img-responsive" >
				<a href="<?php echo $this->Html->url('/');?>download/Daftar_RS_Rekanan.pdf">
					<img  style="position: absolute;z-index:501;top:75px;left:10px;" alt="unduh rekanan jsp"  src="<?php echo $this->Html->url("/");?>img/newicon/DOWNLOAD-JSP.png" class="img-responsive"></a>
				<a href="<?php echo $this->Html->url('/');?>download/Daftar_RS_Rekanan_JSK.pdf">
					<img style="position: absolute;z-index:501;top:145px;left:10px;" alt="unduh rekanan jsk"  src="<?php echo $this->Html->url("/");?>img/newicon/DOWNLOAD-JSK.png" class="img-responsive"></a>
			</div>
		</div>

		<!--<div class=" col-sm-12 col-xs-6" style="border-radius: 10px; background:#B59C74;" align="center">
			<div style="background:#FFAA00;color:white; width:100%;font-size:18px;-border-radius: 15px 15px 15px 15px:" >
				<strong>UNDUH</strong>
			</div>
			<div style="margin-top:5px;">
				<img alt="unduh rekanan jsp" src="<?php echo $this->Html->url("/");?>img/newicon/DOWNLOAD-JSP.png" class="img-responsive">
				<img alt="unduh rekanan jsk" src="<?php echo $this->Html->url("/");?>img/newicon/DOWNLOAD-JSK.png" class="img-responsive">
			</div>
		</div>-->



	</div>

</div>
