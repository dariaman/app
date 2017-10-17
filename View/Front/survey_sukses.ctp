<div class="widget-box login-front">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
                <li class="active">Terima Kasih</li>
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
                            
                            $prod = $this->Session->read('Purchase.produk');
                            ?>
                            Pembelian Asuransi <?php echo $prod ?> Anda <?php if ($status['reason_id'] != '' && isset($status['reason_id'])) echo $status['reason_ind']; else echo "Belum Berhasil"; //echo "Gagal";      ?> 
                        <?php else: ?>
                            Pembayaran Premium Policy <?php echo $status['transactionNo'] ?> Anda <?php if ($status['reason_id'] == 3) echo "Sukses"; else if ($status['reason_ind'] != '') echo $status['reason_ind']; else echo "Belum Berhasil"; //echo "Gagal";      ?> 
                        <?php endif; ?>
                    </span>
                    </h2>
            </div>
            <hr class="redline"/>
                TERIMA KASIH atas pembayaran Anda melalui BCA KlikPay.
            Transaksi Pembayaran Anda sudah dibayar            <br>

                Klik <a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">disini</a> untuk kembali ke halaman utama 
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
<script type="text/javascript">
	$('#modalPolling').modal({backdrop: 'static', keyboard: false});
    $('#modalPolling').modal('show');
</script>
<script type="text/javascript">
	var value = "";
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
