<?php if (!empty($this->session->flashdata('message_error'))) { ?>
  <div class="alert alert-danger">
    <?php
    print_r($this->session->flashdata('message_error'));
    ?>
  </div>
<?php } ?>

<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Transaksi</h3>
    </div>
    <form id="form-akad" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="row">
          <div id="dataPelanggan"></div>




          <div class="col-md-4">
            <div class="form-group">
              <div class="form-group row">
                <div class="col-md-8"> <label for="">INV PELANGGAN</label>
                  <select id="id_invoice" name="id_invoice" class="form-control select2">

                    <?php
                    foreach ($pelanggan as $key => $val) { ?>
                      <option value="<?php echo $val->id_invoice; ?>">INV : <?php echo $val->id_invoice . ' - ID :' . $val->id_pelanggan . ' - ' . $val->nama ?></option>
                    <?php }
                    ?>
                  </select>
                </div>
                <div class="col-md-4"><label for="">-</label><br><a href="#" id="search" class="btn btn-danger btn-md">Lihat</a></div>
              </div>
              <div class="form-group">
                <label for="">NOMOR TRANSAKSI</label>
                <input class="form-control" name="nomor_akad" autocomplete="off" value="<?php echo set_value("nomor_akad") ?>">
              </div>
              <div class="form-group">
                <label for="">TANGGAL TRANSAKSI</label>
                <input class="form-control datepicker" id="tgl_akad"  autocomplete="off" name="tgl_akad" value="<?php echo set_value("tgl_akad") ?>">
              </div>
              <div class="form-group">
                <label for="">TGL JATUH TEMPO PERBULAN</label>
                <input class="form-control datepicker" autocomplete="off" name="tgl_jatuh_tempo" autocomplete="off" value="<?php echo set_value("tgl_jatuh_tempo") ?>">
              </div>
              <div class="form-group">
                <label for="">Waktu input</label>
                <input class="form-control" value="<?php echo $waktu_input; ?>" id="waktu_input" name="waktu_input" autocomplete="off" readonly="">
              </div>

              <div class="form-group">
                <label for="">User input</label>
                <input class="form-control" type="hidden" value="<?php echo $this->data['users']->id; ?>" id="user_input" name="user_input">

                <input class="form-control" value="<?php echo $this->data['users']->first_name; ?>" autocomplete="off" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-4">


            <div class="form-group">
              <label for="">HARGA JUAL</label>
              <input class="form-control harga" autocomplete="off" id="harga_jual" name="harga_jual" autocomplete="off" value="<?php echo set_value("harga_jual") ?>">
            </div>
            <div class="form-group">
              <label for="">UANG MUKA</label>
              <input class="form-control harga" autocomplete="off" id="uang_muka" name="uang_muka" autocomplete="off" value="<?php echo set_value("uang_muka") ?>">
            </div>
            <div class="form-group">
              <label for="">PILIHAN BUNGA</label>
              <select name="option_bunga" class="form-control select2" id="option_bunga" >
              <option value="">Pilih</option>
                <option value="1">MANUAL PERBULAN</option>
                <option value="2">BUNGA FLAT/THN %</option>
              </select>
            </div>
            <div id="bungaFlat">
            <div class="form-group">
              <label for="">BUNGA FLAT/THN %</label>
              <input type="number" class="form-control" id="bunga" name="bunga" autocomplete="off" value="<?php echo set_value("bunga") ?>">
            </div>
            </div>
            <div id="bungaOption">
            <div class="form-group">
              <label for="">BUNGA MANUAL/BULAN</label>
              <input class="form-control harga" id="bungaManual" name="bungaManual" autocomplete="off"  value="<?php echo set_value("bunga") ?>">
            </div>
            </div>
            <div class="form-group">
              <label for="">LAMA CICILAN</label>
              <select name="lama_cicilan" class="form-control select2" id="lama_cicilan" value="<?php echo set_value("lama_cicilan") ?>">
                <option value="">Pilih</option>
                <?php
                foreach ($lama_cicilan as $key => $val) { ?>
                  <option value="<?php echo $val->nama; ?>"><?php echo $val->nama ?> / Bulan</option>
                <?php }
                ?>
              </select>
            </div>

            <div class="form-group">
              <div class="box-header with-border">
                <a href="#" id="simulasi" class="btn btn-info btn-md">Simulasi Kredit <i class="fa fa-money"></i></a>
              </div>
            </div>
            <div class="form-group">
              <label for="">Example :</label>
              <textarea class="form-control">
Cicilan pokok:
Rp120.000.000 : 12 bulan = Rp10.000.000/bulan
Bunga:
(Rp120.000.000 x 10%) : 12 bulan = Rp1.000.000
Angsuran per bulan:
Rp10.000.000 + Rp1.000.000 = Rp11.000.000
        </textarea>
            </div>

          </div>
          <div class="col-md-4">

            <div id="simulasi_table">
              <div class="form-group">
                <label for="">Angsuran Pokok Setiap Bulan</label>
                <input class="form-control" id="simulasi_pokok" value="" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="">Angsuran Bunga Setiap Bulan</label>
                <input class="form-control" id="simulasi_bunga" value="" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="">Total Angsuran Perbulan</label>
                <input class="form-control" id="simulasi_angsuran" value="" autocomplete="off">
              </div>

            </div>

          </div>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-right">
              <button type="submit" id="konfirmasi" class="btn btn-primary pull-right">Simpan</button>

              <a href="<?php echo base_url($this->uri->segment(1)) ?>" class="btn btn-default pull-right"> Kembali</a>
            </div>
          </div>
        </div>
    </form>
  </div>
</section>

<script data-main="<?php echo base_url() ?>assets/js/main/main-akad.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>