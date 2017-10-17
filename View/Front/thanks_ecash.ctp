<!--<script src="<p echo $this->Html->url("/"); ?>linequiz-assets/js/jquery.js"></script>-->

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!--<style>
    .vertical-alignment-helper {
        display:table;
        height: 100%;
        width: 100%;
    }
    .vertical-align-center {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-content {
        width:inherit;
        height:inherit;
        margin: 0 auto;
    }
</style>-->
<div class="widget-box login-front">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
                <li class="active"><?php if ($status == 'Gagal' || (!isset($status['reason_id']) || $status['reason_id'] != 1)) echo "Mohon Maaf"; else echo "Terima Kasih"; ?></li>
            </ol>
            <div class="mainvisual">
                <nav class="navbar navsecond" role="navigation">
                    <div class="container">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class=" navbar-collapse">
                            <ul class="nav navbar-nav iwanto">
                                <li class="fourth pull-right">

                                </li>
                                <li class="pull-right hidden-xs"><h2 class="title-help"><span class="bold">Need Help ?</span></h2></li>
                            </ul>
                        </div>				<!-- /.navbar-collapse -->
                    </div>					<!-- /.container -->
                </nav>
            </div>
        </div>
    </div>

    <div class="row margintop">
        <div class="col-md-12">
            <div class="clearfix"><h1 class="title-login">
                    <span class="bold red">
                        <?php if ($prod != 'PREMIUM PAYMENT'): ?>
                            <?php
                            if ($this->Session->read('Purchase.step1.product_id') == 17 || $this->Session->read('Purchase.step1.product_id') == 18)
                                $prod = 'JAGA AMAN PLUS';
                            elseif ($this->Session->read('Purchase.step1.product_id') == 14 || $this->Session->read('Purchase.step1.product_id') == 15)
                                $prod = 'JAGA JIWA PLUS';
                            ?>
                            Pembelian Asuransi <?php echo $prod ?> Anda <?php if ($status == 'SUCCESS') echo 'Berhasil'; else echo "Belum Berhasil"; //echo "Gagal";   ?> 
                        <?php else: ?>
                            Pembayaran Premium Policy <?php echo $status['transactionNo'] ?> Anda <?php if ($status['reason_id'] == 3) echo "Sukses"; else if ($status['reason_ind'] != '') echo $status['reason_ind']; else echo "Belum Berhasil"; //echo "Gagal";   ?> 
                        <?php endif; ?>
                    </span>
                    </h2>
            </div>
            <hr class="redline"/>
            <!-- if gagal -->
            <?php if ($status != 'SUCCESS'): ?>
                <!--Mohon maaf transaksi Anda gagal. Silakan memeriksa folder inbox atau spam pada email untuk keterangan e-policy Anda.-->
                Mohon maaf, transaksi pembayaran Anda belum berhasil. Silakan mengulangi proses pembelian <?php echo $prod ?> kembali.<br/>Klik <a href="#" onClick="backtoPaymentPage(); return false;">disini</a> untuk kembali ke halaman pembelian.
            <?php else: ?>
                <!-- if berhasil -->
                TERIMA KASIH atas pembayaran Anda melalui Mandiri E-Cash. 
                <br>Klik <a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">disini</a> untuk kembali ke halaman utama 
            <?php endif; ?>
            <div class="clearfix"></div>

        </div>
    </div>


</div>

<script type="text/javascript">
    function postData(path, params, method) {
        method = method || "post";
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);
        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);
                form.appendChild(hiddenField);
            }
        }
        document.body.appendChild(form);
        form.submit();
    }
	
    function backtoPaymentPage(){
        postData("<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'step4_checkout', '?' => array('sid' => $this->Session->read('Purchase.token'), 'cat' => $this->Session->read('Purchase.flow.cat'), 'name' => $this->Session->read('Purchase.flow.name')))); ?>",{
            "_method":'POST', 
            "data[_Token][key]":'<?php echo $this->Session->read('_Token.key'); ?>', 
            "data[Detail][PROSPECT_NAME]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_NAME'); ?>', 
            "data[Detail][PROSPECT_ADDRESS]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_ADDRESS'); ?>', 
            "data[Detail][PROSPECT_EMAIL]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_EMAIL'); ?>', 
            "data[Detail][PROSPECT_MOBILE_PHONE]":'<?php echo $this->Session->read('Purchase.step2.PROSPECT_MOBILE_PHONE'); ?>', 
            "data[Detail][me]":'<?php echo $this->Session->read('Purchase.step2.me'); ?>'
        });
    }
</script>
<script type="text/javascript">
    var value = "";
    $('#modalPolling').modal({backdrop: 'static', keyboard: false});
    $('#modalPolling').modal('show');
    $("input:radio[name=puas_polis]").click(function() {
        value = $(this).val();
    });

    /*function showModal(){
        $('#modalPolling').modal({backdrop: 'static', keyboard: false});
        $('#modalPolling').modal('show');
      }*/

    function closeModal(){
        if(value == "" || $('#pollingSaran').val() == "") {
            $('#modalPolling').modal('hide');
            $('#modalAlert').modal({backdrop: 'static', keyboard: false});
            $('#modalAlert').modal('show');
        } 
    }

    function hideModal(id){
        $('#' + id).modal('hide');
        // showModal();
        $('#modalPolling').modal({backdrop: 'static', keyboard: false});
        $('#modalPolling').modal('show');
    }

    function submitPolling() {
        if(value == "puas")
            $('#modalPolling').modal('hide');
        else if(value == "tidakpuas" && $('#pollingSaran').val() != "")
            $('#modalPolling').modal('hide');
        // send data to database
        else if(value == "tidakpuas" && $('#pollingSaran').val() == "") {
            $('#modalPolling').modal('hide');
            $('#modalWarning').modal({backdrop: 'static', keyboard: false});
            $('#modalWarning').modal('show');
        }
    }
</script>
<div id="modalPolling" class="modal fade">
    <?php echo $this->Form->create('SurveyVisitor', array('url' => array('controller' => 'front', 'action' => 'submitSurveyVisitor'), 'role' => 'form')); ?>
   
      <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
          <div class="modal-content">
              <button type="button" class="close" onclick="closeModal()"<button type="button" class="close" onclick="closeModal()"aria-label="Close"><img src="<?php echo $this->Html->url('/') ?>img/close-btn.png"></button>
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
                              <input  type="radio" type="radio" name="puas_polis"  value="puas" required="required" class="quote" id="puas_polis" /> 
                              <label for="inlinepuas_polis1">PUAS </label>
                        </div>
                        <div class="col-md-offset-1 col-md-3">
                            <input  type="radio"  name="puas_polis"  value="tidakpuas" required="required" class="quote" id="puas_polis" /> 
                              <label for=inlinepuas_polis2">Tidak Puas</label>
                        </div>
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

    <div id="modalWarning" class="modal fade">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12" style="text-align:center">
                  <h4>Mohon untuk memberikan saran di kolom yang tersedia</h4>
                </div>
                <button type="button" class="btn btn-default center-block" onclick="hideModal('modalWarning')">OK</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  

    <div id="modalAlert" class="modal fade">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12" style="text-align:center">
                  <h4>Mohon untuk mengisi survey proses pembelian sebelum menutup layar windows</h4>
                </div>
              </div>
              <button type="button" class="btn btn-default center-block" onclick="hideModal('modalAlert')">OK</button>
            </div>
          </div>
        </div>
      </div>
    </div>
