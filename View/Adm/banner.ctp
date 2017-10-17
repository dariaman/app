			<div class="page-header">
				<h1>
					
						<i class="fa fa-angle-double-right"></i>
						Banner<span id="cust_tipe_title"></span>
					
				</h1>
			</div>
			
			<div >
				<?php echo $this->Session->flash('flash', array('element' => 'success'));?>
						 
			</div>
			
			<br/>
			
			<div class="row clearfix">
				<div class="col-md-12 column">
					
				<div class="table-responsive">

			<table  class="table table-striped table-bordered table-hover dataTable" >
						<thead>
							<tr>
							<td><b>No</b></td>
							<td><b>Image</b></td>
							<td><b>Detail</b></td>
							</tr>
						<thead>
						<tbody>
							<?php $i=1; foreach($banners as $ban): ?>
							<tr >
							    <td>
								Banner <?php echo $i;?>
								</td>
								<td style="width:20%">
									<?php 
									 echo '<a class="image-popup-no-margins" href="'.$this->Html->url('/img/banner/'.$ban['Banner']['picture']).'">'.$this->Html->image('banner/small_'.$ban['Banner']['picture']).'</a>'; ?>
								</td>
							 <td>
								<?php 
								echo $this->Form->create('Banner',array('url'=>array('controller'=>'adm','action'=>'upload_banner',$ban['Banner']['id'],$this->request->data('Fieldservice.id')),'type' => 'file','class'=>'form-horizontal','role'=>'form'));  
								$this->Form->inputDefaults(array('div'=>false,'label'=>false));
								echo $this->Form->input('show',array('options'=>array(0=>'Hide Banner',1=>'Show Banner'),'default'=>$ban['Banner']['show'])).'<br/><br/>';
								echo $this->Form->input('link',array('class'=>'col-xs-12','placeholder'=>'URL Link use http or https','default'=>$ban['Banner']['link'])).'<br/><br/>';
								echo $this->Form->input('target_link',array('options'=>array(0=>'Internal',1=>'External'),'default'=>$ban['Banner']['target_link'])).'<br/><br/>';
								echo $this->Form->input('alt',array('class'=>'col-xs-12','placeholder'=>'Alt Image','default'=>$ban['Banner']['alt'])).'<br/><br/>';
								echo $this->Form->file('file_img',array('onChange'=>'ChangeFile(this)'));  ?>
								<br/>
								<button type="submit" class="btn btn-success btn-sm">Update / Upload Image</button>
								</form>
							</td>
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>


		</div>

	</div>
				

<script type="text/javascript"> 
function ChangeFile(e){
		var ext = e.value.match(/\.([^\.]+)$/)[1];
		switch(ext){
			case 'jpg':
			break;
			case 'jpeg':
			break;
			case 'png':
			break;
			case 'JPG':
			break;
			case 'JPEG':
			break;
			case 'PNG':
			break;
			default:
			alert('only jpg and png file that be allowed');
			e.value='';
		}
	

}

$(document).ready(function() { 
	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
          mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
          image: {
          	verticalFit: true
          },
          zoom: {
          	enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

});
</script>
