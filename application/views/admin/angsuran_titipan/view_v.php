<section class="content-header">
  <h1>
    <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dana Titipan</li>
  </ol>
</section>

<section class="content">
  
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i> Dana Titipan</h3>
      <div class="col-sm-1 datatableButton pull-right">
        <div class="row">
          <?php if ($this->data['is_can_create']) { ?>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <form id="angsuran" method="post" enctype="multipart/form-data">
      <div class="box-body">

        <input type="hidden" name="nomor_akad" id="nomor_akad" value="<?php echo $akad->nomor_akad ?>">
        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo $akad->id_pelanggan ?>">
        <input type="hidden" name="id_invoice" id="id_invoice" value="<?php echo $akad->id_invoice ?>">
        <input type="hidden" name="id_akad" id="id_akad" value="<?php echo $akad->id_akad ?>">
        <!-- Main content -->
        <section class="invoice">

          <!-- info row -->
          <div class="row invoice-info">
            <div class="form-group">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Nomor Akad</label></div>
                  <div class="col-sm-4"><?php echo $akad->nomor_akad ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Tgl Akad</label></div>
                  <div class="col-sm-4"><?php echo date("d M Y", strtotime($akad->nomor_akad)) ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Nama Perwakilan</label></div>
                  <div class="col-sm-4"><?php echo $akad->nama_perwakilan ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Jabatan Perwakilan</label></div>
                  <div class="col-sm-4"><?php echo $akad->jabatan ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Alamat Perwakilan</label></div>
                  <div class="col-sm-4"><?php echo $akad->alamat ?></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">ID Pelanggan</label></div>
                  <div class="col-sm-4"><?php echo $akad->id_pelanggan ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Nama Pelanggan</label></div>
                  <div class="col-sm-4"><?php echo $akad->nama ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">No KTP</label></div>
                  <div class="col-sm-4"><?php echo $akad->ktp ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">No HP</label></div>
                  <div class="col-sm-4"><?php echo $akad->no_telp ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Alamat Sekarang</label></div>
                  <div class="col-sm-4"><?php echo $akad->alamat_sekarang ?></div>
                </div>
              </div>

            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped ">
                <thead>
                  <tr>
                  <th width="5">No.</th>
                    <th>Bayar Cicilan Ke</th>
                    <th>Atas Nama</th>
                    <th>Jumlah Dana Titipan</th>
                    <th>Tgl Bayar</th>
                    <th>Keterangan</th>
                    <th width="10">Cetak</th>
                
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                    $dana = 0;
                  foreach ($angsuran as $data => $val) {
                  $dana = $dana + $val->jumlah_bayar;
                  ?>

                    <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $cicilan; ?></td>
                     <td><?php echo $val->nama; ?></td>
                     <td><?php echo "Rp. ".number_format($val->jumlah_bayar,0,",","."); ?></td>
                     <td><?php echo date("d M Y",strtotime($val->tgl_bayar)); ?></td>
                     <td><?php echo $val->keterangan; ?></td>
                     <td><a class="btn btn-danger" target="blank" href="<?php echo base_url('bp_dana_titipan/pdf/'.$val->id_at)?>"><i class="fa fa-print"></i></a></td>
                    </tr>
                <?php 
                   $i++;
                  }
                ?>
                </tbody>
              </table>
              <br>
              <br>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">

              </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Total Dana titipan</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Dana Titipan:</th>
                    <td><?php echo "Rp.".number_format($dana, 2, ",", ".") ?></td>
                  </tr>
               

                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
            <a href="<?php echo base_url($this->uri->segment(1)) ?>" class="btn btn-default pull-right"> Kembali</a>
      

            </div>
          </div>
        </section>
      </div>
    </form>
  </div>
  </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-angsuran.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>