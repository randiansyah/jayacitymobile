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

  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i> <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?></h3>
      <div class="col-sm-2 datatableButton pull-right">
        <div class="row">
          <?php if ($this->data['is_can_create']) { ?>
          <a class="btn btn-warning" target="blank" href="<?php echo base_url('Setoran_angsuran/cetak_kartu/').$akad->id_akad?>"><i class="fa fa-print"> Cetak Kartu angsuran</i></a>
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
                  <div class="col-sm-4"><label for="">Nomor Transaksi</label></div>
                  <div class="col-sm-4"><?php echo $akad->nomor_akad ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Tgl Transaksi</label></div>
                  <div class="col-sm-4"><?php echo date("d M Y", strtotime($akad->tgl_akad)) ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">TYPE PESANAN</label></div>
                  <div class="col-sm-4"> <?php echo $transaksi->nama_barang ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">NO.SERI IMEI</label></div>
                  <div class="col-sm-4"><?php echo $transaksi->imei1 ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">UANG MUKA</label></div>
                  <div class="col-sm-4"><?php echo $akad->uang_muka ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">LAMA KREDIT</label></div>
                  <div class="col-sm-4"><?php echo $akad->lama_cicilan ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">ANGSURAN/BULAN</label></div>
                  <div class="col-sm-4"><?php
                $tes = ($akad->total / $akad->lama_cicilan);
                ?>
                 Rp. <?php echo number_format($angsuran[0]->jumlah_cicilan,0,'.',',') ?></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">ID Pelanggan</label></div>
                  <div class="col-sm-4"><?php echo $akad->id_pelanggan ?></div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4"><label for="">Nama Pelanggan</label></div>
                  <input type="hidden" name="nameP" id="nameP" value="<?php echo $akad->nama ?>">
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
                    <th>Cicilan Ke</th>
                    <th>Tgl Jatuh Tempo</th>
                    <th>Angsuran per bulan</th>
                    <th>Sisa Cicilan</th>
                    <th>Ter Bayar</th>
                    <th>Jam Bayar</th>
                    <th>Tgl Bayar</th>
                    <th>Teller</th>
                    <th>Catatan pembayaran </th>
                    <th width="50">Cetak</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php 
                  if(!empty($angsuran)){
                  $i = 1;

                  $total_bayar = 0;
                  foreach ($angsuran as $data => $val) {
                    $total_bayar += $val->jumlah_bayar;
                    $sisa = $val->jumlah_cicilan  - $val->jumlah_bayar;
                    $id = $val->id_angsuran;
                  ?>

                    <tr>
                    <input type="hidden" name="jumlah_cicilan[]" value="<?php echo $val->jumlah_cicilan; ?>">
                    
                      <input type="hidden" name="id_angsuran[]" value="<?php echo $val->id_angsuran; ?>">
                      <input type="hidden" class="no numeric" name="no[]" value="<?php echo $i; ?>" id-tr="<?php echo $i; ?>">
                      <td><?php echo $val->cicilan ?></td>
                      <td><?php echo date("d M Y", strtotime($val->tgl_jatuh_tempo)) ?></td>
                      <td><?php echo "Rp. " . number_format($val->jumlah_cicilan, 2, ",", ".") ?></td>
                      <td><?php echo "Rp. " . number_format($sisa, 2, ",", ".") ?></td>
                      <?php if ($val->jumlah_bayar == $val->jumlah_cicilan) {
                        $readonly = "readonly";
                        $style = "background-color: #00a65a;color: #fff;";
                        $jumlah_bayar = "Rp. " . number_format($val->jumlah_bayar, 2, ",", ".");
                      } else if ($val->jumlah_bayar > 0) {
                        $readonly = "";
                        $jumlah_bayar = "Rp. " . number_format($val->jumlah_bayar, 2, ",", ".");
                        $style = "background-color: #e74c3c;color: #fff;";
                      } else {
                        $readonly = "";
                        $jumlah_bayar = "";
                        $style = "";
                      }
                      ?>
                      <td>
                        <input type="text" class="form-control harga bayar" name="bayar[]" id="bayar[]" id-tr="<?php echo $i; ?>" value="<?php echo $jumlah_bayar ?>" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>">
                        
                        
                          <td>
                          <div class="input-group bootstrap-timepicker timepicker">
            <input id="time[]" name="time[]"  value="<?php echo $val->pay_time; ?>"  type="text" class="form-control input-small timepicker1" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div>
                             </td>
                      <td>
                        <?php if ($val->tgl_bayar == null) {
                          $tgl = '';
                        } else {
                          $tgl = date("d-m-Y", strtotime($val->tgl_bayar));
                        }
                        ?>
                        <input class="form-control datepicker" value="<?php echo $tgl ?>" id="tgl_bayar[]" name="tgl_bayar[]" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>"></td>
                      </td>
                      <td>
                        <input type="text" class="form-control" value="<?php echo $val->teller; ?>" name="teller[]" id="teller[]" value="" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="keterangan[]" id="keterangan[]" value="<?php echo $val->keterangan ?>" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>">
                      </td>
                      <td><a href="<?php echo base_url() . "Setoran_angsuran/pdf/" . $id ?>" class="btn btn-danger white" target="blank" ><i class="fa fa-print"></i></a></td>

                    </tr>
                  <?php $i++;
                  }
                }else {$total_bayar = 0;}
                  ?>
                </tbody>
              </table>
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
              <p class="lead">Total Angsuran Saat ini</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Total Tagihan:</th>
                    <td><?php echo "Rp." . number_format($akad->total, 2, ",", ".") ?></td>
                  </tr>
                  <tr>
                    <th>Total Terbayar</th>
                    <td><?php echo "Rp." . number_format($total_bayar, 2, ",", ".") ?></td>
                  </tr>
                  <tr>
                    <th>Sisa Tagihan:</th>
                    <td><?php $sisa_tagihan = $akad->total - $total_bayar;
                        echo "Rp." . number_format($sisa_tagihan, 2, ",", ".");
                        ?></td>
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