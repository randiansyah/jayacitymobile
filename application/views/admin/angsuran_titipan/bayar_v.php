<section class="content-header">
  <h1>
Dana Titipan
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
    <form id="form-dana" method="post" enctype="multipart/form-data">
      <div class="box-body">

        <input type="hidden" name="nomor_akad" id="nomor_akad" value="<?php echo $akad->nomor_akad ?>">
        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo $akad->id_pelanggan ?>">
        <input type="hidden" name="id_invoice" id="id_invoice" value="<?php echo $akad->id_invoice ?>">
        <input type="hidden" name="id_akad" id="id_akad" value="<?php echo $akad->id_akad ?>">
        <!-- Main content -->
        <section class="invoice">
        <h4>Data Pelanggan</h4>
        <br>
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
          <h4>Angsuran yang sudah lunas</h4>
          <br>
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
                    <th>Tgl Bayar</th>
     
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if(!empty($angsuran)){
                  $i = 1;
                  $total_bayar = 0;
                  foreach ($angsuran as $data => $val) {
                    $total_bayar +=$val->jumlah_bayar;
                    $sisa = $val->jumlah_cicilan  - $val->jumlah_bayar;
                  ?>

                    <tr>
                      <input type="hidden" name="" value="<?php echo $val->id_angsuran; ?>">
                      <input type="hidden" class="no numeric" name="no[]" value="<?php echo $i; ?>" id-tr="<?php echo $i; ?>">
                      <td><?php echo $val->cicilan ?></td>
                      <td><?php echo date("d M Y", strtotime($val->tgl_jatuh_tempo)) ?></td>
                      <td><?php echo "Rp. ".number_format($val->jumlah_cicilan, 2, ",", ".") ?></td>
                      <td><?php echo "Rp. ".number_format($sisa, 2, ",", ".") ?></td>
                      <?php if($val->jumlah_bayar == $val->jumlah_cicilan){
                      $readonly = "readonly";
                      $style = "background-color: #00a65a;color: #fff;";
                      $jumlah_bayar = "Rp. ".number_format($val->jumlah_bayar, 2, ",", ".");
                      
                      } else if($val->jumlah_bayar > 0 ){
                     $readonly = "";
                     $jumlah_bayar = "Rp. ".number_format($val->jumlah_bayar, 2, ",", ".");
                     $style = "background-color: #e74c3c;color: #fff;";
                  }else{
                    $readonly = "";
                    $jumlah_bayar = "";
                    $style ="";
                  }
                      ?>
                      <td>
                      <input type="text" class="form-control harga" name="bayar[]" id="bayar[]" value="<?php echo $jumlah_bayar ?>" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>">
                      <td> <input class="form-control datepicker" value="<?php echo date("d-m-Y", strtotime($val->tgl_jatuh_tempo)) ?>" id="tgl_bayar[]" name="tgl_bayar[]" autocomplete="off" <?php echo $readonly; ?> style="<?php echo $style ?>"></td>
                    </td>
                    
                 
                      
                    </tr>
                  <?php $i++;
                  }
                } else { $total_bayar = 0;}
                  ?>
                </tbody>
              </table>
              <br>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
<hr></hr>
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              
              <p class="lead">Dana Titipan</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Cicilan Ke:</th>
                    <td>
                      <select name="id_angsuran" id="id_angsuran" class="form-control select2" >
                        <?php
                foreach ($cicilan as $key => $val1) { ?>
                  <option value="<?php echo $val1->id_angsuran; ?>"><?php echo $val1->cicilan ?></option>
                <?php }
                ?>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th>Atas Nama</th>
                    <td><input type="text" name="nama" id="nama" class="form-control" autocomplete="off"  required></td>
                  </tr>
                  <tr>
                    <th>Jumlah Bayar</th>
                    <td><input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control harga" autocomplete="off"  required></td>
                  </tr>
                  <tr>
                    <th>Tgl Bayar:</th>
                    <td> <input class="form-control datepicker" value="" id="tgl_bayar" name="tgl_bayar" autocomplete="off" required></td>
              
                  </tr>
                  <tr>
                    <th>Keterangan</th>
                    <td><textarea name="keterangan" rows="3" cols="35" autocomplete="off"  required></textarea></td>
              
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              
              <p class="lead">Simulasi Angsuran Saat ini</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Total Tagihan:</th>
                    <td><?php echo "Rp. ".number_format($akad->harga_jual, 2, ",", ".") ?></td>
                  </tr>
                  <tr>
                    <th>Total Terbayar Dari [A]</th>
                    <td><?php echo "Rp. ".number_format($total_bayar, 2, ",", ".") ?></td>
                  </tr>
                  <tr>
                    <th>Total Dana Titipan</th>
                    <td><?php echo "Rp. ".number_format($dana_titipan, 2, ",", ".") ?></td>
                  </tr>
                  <tr>
                    <th>Sisa Tagihan:</th>
                    <td><?php $sisa_tagihan = $akad->harga_jual - $total_bayar - $dana_titipan; 
                        echo "Rp. ".number_format($sisa_tagihan, 2, ",", ".");
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
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-money"></i> Bayar
              </button>

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