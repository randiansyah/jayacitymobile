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
            <h3 class="box-title">Pencarian</h3>
        </div>
        <div class="box-body">
            <div class="row">

                <div class="col-sm-08">
                    <div class="form-group">
                        <div class="col-sm-4">

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
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                        
                            <label>Tanggal</label><br>
                                <button type="button" class="btn btn-default " id="daterange-btn">
                                     <i class="fa fa-calendar"></i>
                                    <span>
                                        Date range picker
                                    </span>
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <input type="hidden" id="periode_start">
                                <input type="hidden" id="periode_end">
                         
                        </div>

                    </div>

                </div>

                <div class="col-sm-4">
                    <label>-</label>
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
            <h3 class="box-title"><i class="fa fa-tag"></i>
                <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?>

            </h3><br><br>
            <i class="fa fa-calendar"></i> <?php echo date("d M Y"); ?>
            <div class="col-sm-12 datatableButton pull-right">
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

                                <th>Nama</th>
                                <th width="5">angsuran</th>
                                <th>Jumlah cicilan</th>
                                <th width="5">Pembayaran</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Sisa Pembayaran</th>
                                <th>Selisih</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-laporan-tunggakan.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>