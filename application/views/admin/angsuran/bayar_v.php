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
            <a class="btn btn-warning" target="blank" href="<?php echo base_url('Setoran_angsuran/cetak_kartu/') . $akad->id_akad ?>"><i class="fa fa-print"> Cetak Kartu angsuran</i></a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>

    <div class="box-body">
      <input type="hidden" name="nomor_akad" id="nomor_akad" value="<?php echo $akad->nomor_akad ?>">
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
                  Rp. <?php echo number_format($angsuran[0]->jumlah_cicilan, 0, '.', ',') ?></div>
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
                  <th>KE</th>
                  <th>JATUH TEMPO</th>
                  <th>ANGSURAN</th>
                  <th>DENDA</th>
                  <th>DISKON</th>
                  <th>TOTAL</th>
                  <th>TERBAYAR</th>
                  <th>TOTAL BAYAR</th>
                  <th>SISA</th>
                  <th>JAM</th>
                  <th>TGL BAYAR</th>
                  <th>TELLER</th>
                  <th width="150">AKSI</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if (!empty($angsuran)) {
                  $i = 1;

                  $total_bayar = 0;
                  $total_denda = 0;
                  $total_diskon = 0;
                  $total_bayar1 = 0;
                  foreach ($angsuran as $data => $val) {
                    $total_bayar += $val->jumlah_bayar - (int)$val->denda + (int)$val->diskon;
                    $total_bayar1 += $val->jumlah_bayar + (int)$val->denda + (int)$val->diskon;
                    $total_denda += $val->denda ;
                    $total_diskon += $val->diskon ;
                  
                    $sisa = $val->jumlah_cicilan  - $val->jumlah_bayar;
                    $id = $val->id_angsuran;

                    if ($val->status == 0 && $val->selisih > 4) {
                      $totalDiskon = ((int)$val->jumlah_cicilan * 3/100);
                    } else {
                      $totalDiskon = $val->diskon;
                    }

                    if ($val->status == 0 && $val->selisih < 1) {
                      
                      $styleDenda = "background-color: #2c3e50;color: #fff;";
                      $nominalDenda = "3000";
                      $total = str_replace("-", "", $nominalDenda * $val->selisih);
                      $denda = str_replace("-", "", $val->selisih) . " Hari ";
                      $totalnya =  $val->jumlah_cicilan +  $total - (int)$totalDiskon;
                    } else {
                      $denda = "";
                      $total = $val->denda;
                      $styleDenda = "";
                      $totalnya =  $val->jumlah_cicilan +  $val->denda - (int)$totalDiskon ;
                    }
                                      
                ?>
                    <tr style="<?php echo $styleDenda; ?>">
                      <td><?php echo $val->cicilan ?></td>
                      <td><?php echo date("d M Y", strtotime($val->tgl_jatuh_tempo)) ?></td>
                      <td><?php echo "Rp. " . number_format($val->jumlah_cicilan, 0, ",", ".") ?></td>
                      <td>
                        <?php echo "Rp. " . number_format((int)$total, 0, ",", "."); ?>
                      </td>
                      <td>
                      <?php echo "Rp. " . number_format((int)$totalDiskon, 0, ",", "."); ?>
                      </td>
                      <td><?php echo "Rp. " . number_format((int)$totalnya, 0, ",", ".") ?></td>
                      
                      <?php if ($val->jumlah_bayar == $val->jumlah_cicilan) {
                        $readonly = "readonly";
                        $style = "background-color: #00a65a;color: #fff;";
                        $jumlah_bayar = "Rp. " . number_format($val->jumlah_bayar, 0, ",", ".");
                      } else if ($val->jumlah_bayar > 0) {
                        $readonly = "";
                        $jumlah_bayar = "Rp. " . number_format($val->jumlah_bayar, 0, ",", ".");
                        $style = "background-color: #e74c3c;color: #fff;";
                      } else {
                        $readonly = "";
                        $jumlah_bayar = "";
                        $style = "";
                      }
                      ?>
                      
                      <td>
                        <?php echo $jumlah_bayar ?>

                        <td>
                        <?php echo "Rp. " . number_format($val->total_bayar, 0, ",", "."); ?>

                    </td>
                      <td>
                        <?php echo "Rp. " . number_format($val->sisa, 0, ",", "."); ?>

                    </td>
                      <td>
                        

                        <?php echo $val->pay_time ?>
                      </td>
                    
                      <td>
                        <?php if ($val->tgl_bayar == null) {
                          $tgl = '';
                        } else {
                          $tgl = date("d-m-Y", strtotime($val->tgl_bayar));
                        }
                        ?>
                        <?php echo $tgl ?>
                      </td>
                      <td>
                        <?php echo $val->teller; ?>
                      </td>

                      <td>
                      <a href="#" class="btn btn-info btn-sm btn-buy" data-id="<?php echo $val->id_angsuran; ?>"
                      data-denda="<?php echo $total; ?>"
                      data-diskon="<?php echo $totalDiskon; ?>"
                      data-total="<?php echo $totalnya; ?>"
                      data-teller="<?php echo $val->teller; ?>"
                      data-keterangan="<?php echo $val->keterangan; ?>"
                      
                      ><i class="fa fa-money"></i></a>

                      <a href="<?php echo base_url() . "Setoran_angsuran/pdf/" . $id ?>" class="btn btn-danger white" target="blank"><i class="fa fa-print"></i></a>
                        
                      </td>
                    </tr>
                <?php $i++;
                  }
                } else {
                  $total_bayar = 0;
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
       
          <!-- /.col -->
          <div class="col-md-12">
            <p class="lead">Total Angsuran Saat ini</p>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Total Tagihan:</th>
                  <td><?php echo "Rp." . number_format($akad->total, 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <th style="width:50%">Total Denda:</th>
                  <td><?php echo "Rp." . number_format($total_denda, 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <th style="width:50%">Total Diskon:</th>
                  <td><?php echo "Rp." . number_format($total_diskon, 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <th>Total Terbayar</th>
                  <td><?php echo "Rp." . number_format($total_bayar1, 0, ",", ".") ?></td>
                </tr>
                <tr>
                  <th>Sisa Tagihan:</th>
                  <td><?php $sisa_tagihan = $akad->total - $total_bayar;
                      echo "Rp." . number_format($sisa_tagihan, 0, ",", ".");
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

  </div>
  </div>

  <!-- Modal Edit Product-->
  <form action="<?php echo base_url('Setoran_angsuran/buy') ?>" method="post">
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">PEMBAYARAN</label></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <label>JAM BAYAR</label>
                <div class="input-group bootstrap-timepicker timepicker">
                  <input id="time" name="time" value="<?php echo $val->pay_time; ?>" type="text" class="form-control input-small timepicker1" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
              </div>
              <div class="col-md-6">
                <label>TANGGAL BAYAR</label>
                <input type="text" class="form-control tgl_bayar datepicker" autocomplete="off" name="tgl_bayar">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label>DENDA</label>
                <input type="text" class="form-control denda" autocomplete="off" name="denda">
              </div>
              <div class="col-md-6">
                <label>DISKON</label>
                <input type="text" class="form-control diskon" autocomplete="off" name="diskon">
              </div>
            </div>
            <div class="form-group">
              <label>JUMLAH BAYAR</label>
              <input type="text" class="form-control jumlah_bayar harga" name="jumlah_bayar" autocomplete="off">
            </div>
            
            <div class="form-group">
            <button type="button"  data-total="<?php echo $val->jumlah_cicilan; ?>" id="uangPas" class="btn btn-success btn-sisa">Uang Pas</button>
            </div>

            <div class="form-group">
              <label>SISA</label>
              <input type="text" class="form-control sisa harga" id="sisa" name="sisa" autocomplete="off">
            </div>


            <div class="form-group row">
              <div class="col-md-6">
              <label>TELLER</label>
              <input type="text" class="form-control teller" name="teller" autocomplete="off">
              </div>
              <div class="col-md-6">
                <label>KETERANGAN</label>
                <input type="text" name="keterangan" class="keterangan form-control">
              </div>
            </div>
         
          </div>
          <div class="modal-footer">
          <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo $akad->id_pelanggan ?>">
            <input type="hidden" name="id_angsuran" class="id_angsuran">
            <input type="hidden" id="totalnya" name="total" class="total" value="<?php echo $val->jumlah_cicilan; ?>">
            <input type="hidden" name="idAkad"  value="<?php echo $idakad ?>" >
            <input type="hidden" name="id_inv"  value="<?php echo $transaksi->id_invoice ?>" >
            <input type="hidden" name="merek"  value="<?php echo $transaksi->merek ?>" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">BAYAR</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- End Modal Edit Product-->
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-angsuran.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>