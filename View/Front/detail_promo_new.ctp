<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">Home</a></li>
            <li><a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'promo')) ?>">Promo</a></li>
            <li class="active"><?php echo $pr['Promo']['promo_title'] ?></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <center>
            <?php if ($pr['Promo']['target_url'] == null): ?>
                <img src="<?php echo $this->Html->url('/img/prom/' . $pr['Promo']['img_promo_detail']) ?>" class="img-responsive"><?php else: ?>
                <a href="<?php echo $pr['Promo']['target_url'] ?>" <?php echo (1 == $pr['Promo']['new_tab']) ? 'target="_blank"' : ''; ?>><img src="<?php echo $this->Html->url('/img/prom/' . $pr['Promo']['img_promo_detail']) ?>" class="img-responsive"></a>
            <?php endif; ?>
        </center>
        <?php if ($pr['Promo']['end_date'] < $date): ?>
            <div class="expired">
                <div class="pita">Promo Telah Berakhir</div>
            </div>
        <?php endif ?>
    </div>
</div>

<!-- POPUP FOR POLLING PILIH RAWAT INAP/JALAN -->
<div id="polling-rawat-inap-jalan-form-modal" class="modal fade" role="dialog" style="padding-top:7%;">
    <div class="modal-dialog">
        <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="../img/close-btn.png"></button>
            <div class="modal-body">
        <div class="row">
					<div style="text-align:center;">
                        <a href="#"><img src="<?php echo $this->Html->url("/"); ?>img/polling/tittle_-06.png" class="img-responsive"></a> <!--onClick="javascript:popUpFormVisitor('inap')"-->
		
                    <div class="col-xs-6 col-sm-6 col-lg-6">
                        <a href="#" onclick="showModal(1)"><img src="<?php echo $this->Html->url("/"); ?>img/polling/rawat-inap.png" class="img-responsive"></a> <!--onClick="javascript:popUpFormVisitor('inap')"-->
                    </div>
                    <div class="col-xs-6 col-sm-6 col-lg-6">
                        <a href="#" onclick="showModal(2)"><img src="<?php echo $this->Html->url("/"); ?>img/polling/rawat-jalan.png" class="img-responsive"></a><!--onClick="javascript:popUpFormVisitor('jalan')"-->
                    </div>
                </div>
      </div>
        </div>
    </div>
</div>

<!-- POPUP FOR FORM POLLING PILIH RAWAT INAP/JALAN -->
<div id="form-rawat-inap-jalan-form-modal" name="form-rawat-inap-jalan-form-modal" class="modal fade form-horizontal" role="dialog">
    <?php echo $this->Form->create('Promo', array('url' => array('controller' => 'front', 'action' => 'submitPromo'), 'role' => 'form')); ?>
    <div class="modal-dialog">
	<div class="modal-content">
	<button type="button"  data-dismiss="modal" class="close" onclick="confirmClose()" aria-label="Close"><img src="<?php echo $this->Html->url('/') ?>img/close-btn.png"></button>
        <p id="content-pesan" ></p>
        <div class="modal-header">
                <h4 class="modal-title"><span class="control-label">Terima kasih atas pendapat yang Anda berikan. Mohon untuk melengkapi data Anda.</span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label col-sm-2">Nama</label>
                    <div class="col-sm-10">
                        <p id="content-name" ></p>
                        <input type="text" class="form-control required" name="name" id="name">
                        <input type="hidden" id="pilihan" name="pilihan" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <p id="content-email" ></p>
                        <input type="email" class="form-control required" name="email" id="email" oninput="cekEmail()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label col-sm-2">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <p id="content-telp" ></p>
                        <input type="text" class="form-control required" name="telp" id="telp" oninput="cekNum()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label col-sm-2">Alamat Lengkap</label>
                    <div class="col-sm-10">
                        <p id="content-address" ></p>
                        <textarea name="address" id="address" class="form-control required" rows="3" ></textarea>
                        <p style="color:red">Contoh: Jl. Prof. Dr. Satrio No. 22, RT 01/RW 05, Karet Kuningan, Setiabudi, Jakarta Selatan.<p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<!-- POPUP FOR CONFIRM CLOSE POLLING PILIH RAWAT INAP/JALAN -->
<div id="close-rawat-inap-jalan-form-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="control-label"><center>Isi Data Anda Untuk Memenangkan Vouchernya.</center></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" onclick="showFormPolling()" >Isi Data</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Tidak, Terima Kasih</button><!--data-dismiss="modal-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //    function close(){
    //        $('#close-rawat-inap-jalan-form-modal').modal('hide');
    //    }
    function showModal(o){
        $('#form-rawat-inap-jalan-form-modal').modal({backdrop: 'static', keyboard: false});
        $('#pilihan').val(o);
        $('#modalPolling').modal('show');
    }
    function cekEmail(){
        var pesan_email = $("#content-email");
        var email = $("#email").val();
        var regex = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
        if(!regex.test(email)){
            pesan_email.text("Field Email Tidak Sesuai").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#email").focus();
            return false;
        }else{  pesan_email.text("").removeClass('error');  $("#email").focus(); return false;  }
    }
    function cekNum(){
        var pesan_telp_angka = $("#content-telp");
        var $num = $("#telp").val();
        for(var a = 0 ; a < $num.length; a++){
            var angka = /^[0-9]+$/;
            if(!$num.match(angka)){
                pesan_telp_angka.text("Field Nomor Telepon hanya boleh diisi angka").removeClass('success').addClass('error').css({
                    'color':'red'
                });
                $("#telp").focus();
                return false;
            }else{  pesan_telp_angka.text("").removeClass('error');  $("#telp").focus(); return false;  }
           if($num.length < 6){
                pesan_telp_angka.text("Field Nomor Telepon Tidak Sesuai").removeClass('success').addClass('error').css({
                    'color':'red'
                });
                $("#telp").focus('');
				return false;
            }else{  pesan_telp_angka.text("").removeClass('error');  $("#telp").focus(); return false;  }
        }
    }
    $('#form-rawat-inap-jalan-form-modal').submit(function () {
        var angka_ = /^[0-9]+$/;
        var dataString = $('#form-rawat-inap-jalan-form-modal').serialize();
        var pesan_name = $("#content-name");
        var pesan_email = $("#content-email");
        var pesan_telp = $("#content-telp");
        var pesan_address= $("#content-address");
        if($("#name").val() === ""){
            pesan_name.text("Field Nama tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#name").focus();
            return false;
        }
        if($("#email").val() === ""){
            pesan_email.text("Field Email tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#email").focus();
            return false;
        }
        if($("#telp").val() === ""){
            pesan_telp.text("Field Nomor Telepon tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#telp").focus();
            return false;
        }
        
        if($("#address").val() === ""){
            pesan_address.text("Field Alamat tidak boleh kosong").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#address").focus();
            return false;
        } 
        if($("#address").length() < "6"){
            pesan_address.text("Field Alamat tidak Sesuai").removeClass('success').addClass('error').css({
                'color':'red',
                'background': 'url() 1px 0 no-repeat'
            });
            $("#address").focus();
            return false;
        }
        /* $.ajax({
                                        url: "< echo $this->Html->url('submitPromo');>",
                    type:"POST",
                    data:dataString,
                    cache: false,
                    success: function(){
                        $('#content').html('<p>You have successfully !</p>');
                    }

                })*/
    })
    //http://code.runnable.com/UhY_PcUNXgAmAAYD/allow-only-numbers-in-an-input-using-jquery-for-form
    
</script>