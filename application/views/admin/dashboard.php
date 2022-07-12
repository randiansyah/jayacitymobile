<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard"></i>
                Home
            </a>
        </li>
        <li class="active">Dashboard</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <label>Tgl Hari ini <?php echo date("d M Y"); ?></label>
        </div>
    </div>
    <br>
    <div class="col-md-12">
    </div>


    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 style="font-size: 31px;" id="tunggkan"></h3>
                <p>TOTAL TUNGGAKAN</p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('/Laporan_tunggakan') ?>" class="small-box-footer">
                Lihat Selengkapnya
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3 style="font-size: 31px;" id="terbayar"></h3>
                <p>TOTAL ANGSURAN DIBAYAR
                <p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('/Laporan_dana_angsuran') ?>" class="small-box-footer">Lihat Selengkapnya
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3 style="font-size: 31px;" id="dana"></h3>
                <p>TOTAL DANA TITIPAN
                <p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo base_url('/Angsuran_titipan') ?>" class="small-box-footer">Lihat Selengkapnya
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 style="font-size: 31px;" id="customer"></h3>
                <p>TOTAL PELANGGAN</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('/Customer') ?>" class="small-box-footer">Lihat Selengkapnya
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
            <div class="row">

                <div class="col-sm-8">

                    <div class="form-group">
                        <div class="col-sm-8">
                            <br>
                            <div class="form-group">
                                <button type="button" class="btn btn-default " id="daterange-btn">
                                    <i class="fa fa-calendar"></i>
                                    <span>
                                        Date range picker
                                    </span>
                                    <i class="fa fa-caret-down"></i>
                                </button> 
                                <input type="hidden" id="periode_start" name="periode_start">
                                <input type="hidden" id="periode_end" name="periode_end">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">

                            <li class="active">
                                <a href="#transaction_count" data-toggle="tab">Angsuran</a>
                            </li>
                            <li>
                                <a href="#sale_count" data-toggle="tab">Penjualan</a>
                            </li>
                            <li class="pull-left header">
                                <i class="fa fa-calendar"></i>
                                Grafik
                            </li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="transaction_count" style="position: relative; height: 300px;"></div>
                            <div class="chart tab-pane" id="sale_count" style="position: relative; height: 300px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    </div>


</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-dashboard.js" src="<?php echo base_url() ?>assets/js/require.js"></script>