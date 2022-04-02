<section class="content-header">
    <h1>
        <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?></li>
    </ol>
</section>

<section class="content">
    <div class="box box-bottom">
        <div class="box-header with-border">
            <h3 class="box-title">Pencarian Bukti Pembayaran</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Status</label>
                            <select name="status" class="form-control select2" id="status">
                                <option value="">Pilih</option>
                                <option value="1">Sudah Terbayar</option>
                                <option value="0">Belum Terbayar</option>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-6">

                            <label>Nama Pelanggan</label>
                            <select id="pelanggan" name="pelanggan" class="form-control select2" autocomplete="off">
                                <option value="" required>Pilih salah satu</option>
                                <?php
                                foreach ($pelanggan as $key => $val) { ?>
                                    <option value="<?php echo $val->id_pelanggan; ?>"><?php echo $val->id_pelanggan . ' - ' . $val->nama ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Cicilan ke</label>
                            <select name="cicilan" class="form-control select2" id="cicilan">
                                <option value="">Pilih</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                 <option value="19">19</option>
                                 <option value="19">20</option>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-6">

                            <label>Tgl Bayar Dari</label>
                            <input class="form-control datepicker" id="dari_tgl" name="dari_tgl" autocomplete="off">

                        </div>
                        <div class="col-sm-6">

                            <label>Tgl Bayar Sampai</label>
                            <input class="form-control datepicker" id="sampai_tgl" name="sampai_tgl" autocomplete="off">

                        </div>
                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="form-group text-right">
                        <a href="#" class="btn btn-sm btn-primary" id="filter"><i class="fa fa-search"></i> PENCARIAN</a>
                        <a href="#" class="btn btn-sm btn-danger" id="reset"><i class="fa fa-refresh"></i> RESET</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?></h3>
            <div class="col-sm-1 datatableButton pull-right">
                <div class="row">
                    <?php if ($this->data['is_can_create']) { ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="box-header">

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <?php if (!empty($this->session->flashdata('message'))) { ?>
                            <div class="alert alert-info">
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
                                <th>No Akad</th>
                                <th>Invoice</th>
                                <th>Nama</th>
                                <th>angsuran ke</th>
                                <th>Jumlah cicilan</th>
                                <th>jumlah Bayar</th>
                                <th>Tgl Bayar</th>
                                <th>Cetak</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-kwitansi.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>