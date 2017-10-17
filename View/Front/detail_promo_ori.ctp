<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">Home</a></li>
      <li><a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'promo')) ?>">Promo</a></li>
      <li class="active"><?php echo $pr['Promo']['promo_title']?></li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <center>
    <?php if($pr['Promo']['target_url']==null):?>
    <img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_detail'])?>" class="img-responsive"><?php else:?>
    <a href="<?php echo $pr['Promo']['target_url']?>" <?php echo (1==$pr['Promo']['new_tab']) ? 'target="_blank"' : ''; ?>><img src="<?php echo $this->Html->url('/img/prom/'.$pr['Promo']['img_promo_detail'])?>" class="img-responsive"></a>
    <?php endif;?>
    </center>
    <?php if ($pr['Promo']['end_date']<$date): ?>
      <div class="expired">
        <div class="pita">Promo Telah Berakhir</div>
      </div>
    <?php endif ?>
  </div>
</div>
