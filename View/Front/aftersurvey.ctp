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
                            <?php
                            
                            $prod = $this->Session->read('Purchase.produk');
				//$prod = $this->Session->read('Survey.prod');
                            ?>
                            Pembelian Asuransi <?php echo $prod ?> Anda Sukses                    </span>
                    </h2>
            </div>
            <hr class="redline"/>
                TERIMA KASIH atas pembayaran Anda.
            Transaksi Pembayaran Anda sudah dibayar            <br>

                Klik <a href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'home')) ?>">disini</a> untuk kembali ke halaman utama 
            <div class="clearfix"></div>

        </div>
    </div>


</div>
