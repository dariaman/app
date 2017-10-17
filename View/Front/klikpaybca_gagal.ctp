<script type="text/javascript">
(function() {
    var MTBADVS = window.MTBADVS = window.MTBADVS || {}; MTBADVS.ConvContext = MTBADVS.ConvContext || {}; MTBADVS.ConvContext.queue = MTBADVS.ConvContext.queue || [];
    MTBADVS.ConvContext.queue.push({
        "advertiser_id": 5110,
        "price": 0,
        "convtype": 0,
        "dat": ""
    });
    var el = document.createElement('script'); el.type = 'text/javascript'; el.async = true;
    el.src = (('https:' == document.location.protocol) ? 'https://' : 'http://') + 'js.mtburn.com/advs-conversion.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(el, s);
 })();
</script>


<div class="widget-box login-front">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
                <li class="active">Mohon Maaf</li>
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
                       
                Mohon maaf, transaksi pembayaran Anda belum berhasil. Silakan mengulangi proses pembelian <?php echo $prod ?> kembali.
            <br/>
           
                Klik <a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">disini</a> untuk kembali ke halaman utama 
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
