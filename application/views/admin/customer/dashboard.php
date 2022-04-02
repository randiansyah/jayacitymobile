<section class="content-header">
    <h1>
        Selamat Datang <?php echo $this->data['users']->username; ?>
        <small></small>
    </h1>

</section>


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <label>Tgl Hari ini <?php echo date("d M Y"); ?></label>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3 style="font-size:3.5vw;" id="dana"><?php echo $buy_total->total ?></h3>
                <p>TOTAL KREDIT
                <p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 style="font-size:3.5vw;" id="dana">Rp. <?php echo number_format($buy_total->totalTagihan, 0, ',', '.'); ?></h3>
                <p>TOTAL TAGIHAN
                <p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3 style="font-size:3.5vw;" id="dana">Rp. <?php echo number_format($total_dana_angsuran->total, 0, ',', '.'); ?></h3>
                <p>TOTAL BAYAR
                <p>

            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>

        </div>
    </div>




    </div>


</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-dashboard.js" src="<?php echo base_url() ?>assets/js/require.js"></script>