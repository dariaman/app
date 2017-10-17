
<div class="widget-box login-front">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">Home</a></li>
                <li class="active"><?php if ($status != 'Belum Berhasil') echo "Terima Kasih"; else echo "Mohon Maaf"; ?></li>
            </ol>
            <div class="mainvisual">
                <nav class="navbar navsecond" role="navigation">
                    <div class="container">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class=" navbar-collapse">
                            <ul class="nav navbar-nav iwanto">
                                <li class="fourth pull-right">
                                    <a href="/chat_with_us/chat?locale=id" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/chat_with_us/chat?locale=id&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=500,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><span class="icon"><img src="<?php echo $this->Html->url("/");?>img/chat-icon.png" /></span> Chat with <span class="bold">Us</span></a>
                                </li>
                                <li class="pull-right hidden-xs"><h2 class="title-help"><span class="bold">Need Help ?</span></h2></li>
                            </ul>
                        </div>              <!-- /.navbar-collapse -->
                    </div>                  <!-- /.container -->
                </nav>
            </div>
        </div>
    </div>
    
<div class="row margintop">
        <div class="col-md-12">
            <div class="clearfix"><h1 class="title-login">
                <span class="bold red">
                <?php if(isset($prod)): ?>
                Pembelian Asuransi <?php echo strtoupper($prod); ?> Anda <?php echo $status; ?> 
                <?php else: ?>
                Pembayaran Premium Policy <?php echo strtoupper($premi); ?> Anda <?php echo $status; ?> 
                <?php endif; ?>
                </span>
            </h2>
        </div>
        <hr class="redline"/>
        <?php if ($status == 'Berhasil'): ?>
        TERIMA KASIH atas pembayaran Anda. Transaksi Pembayaran Anda <?php echo $status; ?>
        <?php else: ?>
        <!--Mohon maaf transaksi Anda gagal. Silakan memeriksa folder inbox atau spam pada email untuk keterangan e-policy Anda.-->
    Mohon maaf, transaksi pembayaran Anda belum berhasil. Silakan mengulangi proses pembelian <?php echo strtoupper($prod); ?> kembali.<br/>Klik <a href="#" onClick="backtoPaymentPage(); return false;">disini</a> untuk kembali ke halaman pembelian.
        <?php endif; ?>
                <br>
        <?php if ($status == 'Berhasil'): ?>
                Klik <a href="<?php echo $this->Html->url(array('controller'=>'front', 'action'=>'home')) ?>">disini</a> untuk kembali ke halaman utama 
        <?php else: echo ""; endif;?>
        <div class="clearfix"></div>
                
    </div>
</div>


</div>
<div id="modalPolling" class="modal fade">
    <?php echo $this->Form->create('SurveyVisitor', array('url' => array('controller' => 'front', 'action' => 'submitSurveyVisitor'), 'role' => 'form')); ?>

    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
            <button type="button" class="close" onclick="closeModal()"aria-label="Close"><img src="<?php echo $this->Html->url('/') ?>img/close-btn.png"></button>
                <div class="modal-body">
                    <div class="row">
            <div class="col-md-12" style="text-align:center;">
                <h4 style="font-weight: bold;"> </h4>
            </div>
            <div class="col-md-12" style="text-align:center;">
                <h4 style="font-weight: bold;"> </h4>
            </div>
                        <div class="col-md-12" style="text-align:center;">
                            <h4 style="font-weight: bold;">Terima kasih telah membeli polis di website JAGADIRI</h4>
                        </div>
                        <div class="col-md-12" style="text-align:center">
                            <h4>Apakah Anda puas dengan Proses Pembelian Polis Anda di website kami?</h4>
                        </div>
                        <div class="col-md-offset-3 col-md-3">
                              <input  type="radio" name="puas_polis" value="1" required="required" class="quote" id="puas_polis" /> 
                              <label for="inlinepuas_polis1">Puas </label>
                        </div>
                        <div class="col-md-offset-1 col-md-3">
                            <input  type="radio" type="radio" name="puas_polis" value="0" required="required" class="quote" id="puas_polis" /> 
                              <label for=inlinepuas_polis2">Tidak Puas</label>
                        </div>
                        <div class="col-md-12" style="text-align:center">
                            <h4>Berikan saran Anda:</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea id="saran" name="saran" class="form-control" rows="2" style="resize: vertical"></textarea>
                        </div>
                        <div class="col-md-12" style="margin-left: 10px">
                            <h5>Terima kasih untuk saran yang Anda berikan.</h5>
                        </div>
                        <div class="col-md-12" style="margin-left: 10px">
                            <h5>Saran Anda untuk perbaikan Kami di masa yang akan datang.</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default center-block" onclick="submitPolling()">Kirim</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


