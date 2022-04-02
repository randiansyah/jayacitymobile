<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Rp. <?php echo number_format($debit - $credit) ?></h3>
                    <p>Saldo</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>Rp. <?php echo number_format($debit) ?></h3>
                    <p>Total Pemasukan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Rp. <?php echo number_format($credit) ?></h3>
                    <p>Total Pengeluaran</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Tipe</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <select class="form-control filter-column" id="type">
                                <option value="" selected>Semua</option>
                                <option value="1">Pemasukan</option>
                                <option value="2">Pengeluaran</option>
                                <option value="3">Tarik Bank</option>
                                <option value="4">Setor Bank</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <button class="btn btn-sm btn-danger" id="reset">Hapus</button>
                            <button class="btn btn-sm btn-primary" id="search">Cari</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Semua Data</a></li>
            <!-- <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Pemasukan</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Pengeluaran</a></li>
            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Tarik Uang (Bank) </a></li>
            <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Setor Uang (Bank) </a></li> -->
            <li class="pull-right">
              <?php if($this->data['is_can_create']){?>
                <a href="<?php echo base_url() ?>finace/create_finace" class="btn btn-primary">Tambah Data</a>
                <?php 
              }
              ?>
              </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="table-responsive">
                    <?php if (!empty($this->session->flashdata('message'))) { ?>
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php
                            print_r($this->session->flashdata('message'));
                            ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($this->session->flashdata('message_error'))) { ?>
                        <div class="alert alert-info">
                            <?php
                            print_r($this->session->flashdata('message_error'));
                            ?>
                        </div>
                    <?php } ?>
                    <table class="table table-striped" id="table">
                        <thead>
                        <th width="5">No.</th>
                        <th>Nama</th>
                        <th>Amount</th>
                        <th>Deskripsi</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive"></div>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
</section>


<script
        data-main="<?php echo base_url() ?>assets/js/main/main-saldo.js"
        src="<?php echo base_url() ?>assets/js/require.js">
</script>