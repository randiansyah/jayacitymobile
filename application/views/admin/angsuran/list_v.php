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
        <div class="col-md-6">
          <div class="form-group row">
            <div class="col-md-12">
              <label>No Transaksi</label>
              <input type="text" id="no_akad" name="no_akad" class="form-control" placeholder="Masukan no transaksi">
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
              <label>Lama Cicilan</label>
              <select name="lama_cicilan" class="form-control select2" id="lama_cicilan">
                <option value="">Pilih</option>
                <?php
                foreach ($lama_cicilan as $key => $val) { ?>
                  <option value="<?php echo $val->nama; ?>"><?php echo $val->nama ?> / Bulan</option>
                <?php }
                ?>
              </select>
            </div>

          </div>

        </div>
        <div class="col-md-6">
          <div class="form-group row">
            <div class="col-sm-6">

              <label>Tgl Transaksi Dari</label>
              <input class="form-control datepicker" id="dari_tgl" name="dari_tgl" autocomplete="off">

            </div>
            <div class="col-sm-6">

              <label>Tgl Transaksi Sampai</label>
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
        <?php if (!empty($this->session->flashdata('message_error'))) { ?>
          <div class="alert alert-info">
            <?php
            print_r($this->session->flashdata('message_error'));
            ?>
          </div>
        <?php } ?>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped" id="table">
              <thead>
                <th width="5">No.</th>
                <th>No Transaksi</th>
                <th>INV</th>
                <th>Nama</th>
                <th>Tgl Transaksi</th>
                <th>Lama CIcilan</th>
                <th>Pokok</th>
                <th>Bunga</th>
                <th>Total Tagihan</th>
                <th>Terbayar</th>
                <th>Sisa Pembayaran</th>
                <th>Aksi</th>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-angsuran.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>

<div class="modal fade in" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"> <?php
                                                        print_r($this->session->flashdata('message'));
                                                        ?></label></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-md-6">
            <label>JAM BAYAR</label>
            <div class="input-group bootstrap-timepicker timepicker">
              <p class="text-success"><b><?php
                                          print_r($this->session->userdata('pay_time'));
                                          ?></b></p>
            </div>
          </div>
          <div class="col-md-6">
            <label>TANGGAL BAYAR</label>
            <p class="text-success"><b><?php
                                        print_r($this->session->userdata('tgl_bayar'));
                                        ?></b></p>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
            <label>DENDA</label>
            <p class="text-success"><b><?php
                                        print_r($this->session->userdata('denda'));
                                        ?></b></p>
          </div>
          <div class="col-md-6">
            <label>DISKON</label>
            <p class="text-success"><b><?php
                                        print_r($this->session->userdata('diskon'));
                                        ?></b></p>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
          <label>JUMLAH BAYAR</label>
          <p class="text-success"><b><?php

if (!empty($this->session->userdata('total_bayar'))) { 
  print_r("Rp." . number_format($this->session->userdata('total_bayar'), 0, ",", "."));
                         
}else{
  print_r("Rp.0");
} 
?></b></p>
          </div>
          <div class="col-md-6">
            <label>SISA</label>
            <p class="text-success"><b><?php
          if (!empty($this->session->userdata('sisa'))) { 
            print_r("Rp." . number_format($this->session->userdata('sisa'), 0, ",", "."));
                                   
          }else{
            print_r("Rp.0");
          } 
                                        ?></b></p>
          </div>
        </div>
    
        <div class="form-group row">
          <div class="col-md-6">
            <label>TELLER</label>
            <p class="text-success"><b><?php
                                        print_r($this->session->userdata('teller'));
                                        ?></b></p>
          </div>
          <div class="col-md-6">
            <label>KETERANGAN</label>
            <p class="text-success"><b><?php
                                        print_r($this->session->userdata('keterangan'));
                                        ?></b></p>
                                        <?php echo print_r($this->session->userdata('idnya')); ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <a href="<?php echo base_url('Setoran_angsuran/bayar/'.$this->session->userdata('idnya')) ?>">
        <button class="btn btn-primary">Transaksi Lagi</button>
      </a>
 
      </div>
    </div>
  </div>
</div>
<?php if (!empty($this->session->flashdata('message'))) { ?>
  <script type="text/javascript">
  $(window).on('load', function() {
    $('#messageModal').modal('show');
  });
  </script>
<?php } ?>



