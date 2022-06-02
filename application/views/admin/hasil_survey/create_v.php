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
      <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Survey</h3>
    </div>
    <form id="karyawan" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">

                <div class="form-group">
                  <label for="">No Pelanggan</label>
                  <select id="pelanggan" name="pelanggan" class="form-control select2">
                    <option value="">Pilih salah satu</option>
                    <?php
                    foreach ($pelanggan as $key => $val) { ?>
                      <option value="<?php echo $val->id_pelanggan; ?>">ID : <?php echo $val->id_pelanggan . ' - ' . $val->nama ?></option>
                    <?php }
                    ?>
                  </select>

                </div>



                <div class="form-group">

                  <label for="">Pernah Kredit</label>
                  <select name="pernah_kredit" class="form-control select2" id="pernah_kredit">
                    <option>Pilih salah satu</option>
                    <option value="1">YA</option>
                    <option value="0">TIDAK</option>

                  </select>




                </div>

                <div class="form-group">
                  <label for="">CATATAN</label>
                  <textarea cols="3" rows="3" class="form-control" name="catatan"></textarea>
                </div>


                <div class="form-group">
                  <label for="">Disetujui</label>
                  <div class="radio" id="status" name="status">
                    <label><input type="radio" name="status" value="1" checked='checked'>Ya &nbsp;&nbsp; </label>
                    <label><input type="radio" name="status" value="0">Tidak</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">User input</label>
                  <input class="form-control" type="hidden" value="<?php echo $this->data['users']->id; ?>" id="user_input" name="user_input">

                  <input class="form-control" value="<?php echo $this->data['users']->first_name; ?>" autocomplete="disabled" readonly>
                </div>
                <div class="form-group">
                  <label for="">Waktu input</label>
                  <input class="form-control" value="<?php echo $waktu_input; ?>" id="waktu_input" name="waktu_input" autocomplete="disabled" readonly="">
                </div>


              </div>
            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="">FOTO Pelanggan</label>
                <input type="file" id="foto_pelanggan" name="foto_pelanggan" class="form-control">
              </div>


              <div class="form-group">

                <label for="">Foto KTP</label>
                <input type="file" id="foto_ktp" name="foto_ktp" class="form-control">



              </div>
              <div class="form-group">

                <label for="">Foto Dokumen Lain</label>
                <input type="file" id="foto_dl" class="form-control" name="foto_dl">

              </div>
              <div class="form-group">

                <label for="">Foto Dokumen Lain</label>
                <input type="file" id="foto_dl1" class="form-control" name="foto_dl1">

              </div>
            </div>





            <div class="col-md-12">

              <div class="form-group">
                <a href="<?php echo base_url('Hasil_survey') ?>" class="btn btn-default pull-right"> Batal</a>
                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
              </div>

            </div>


          </div>
        </div>
      </div>
  </div>

  </form>
  </div>
</section>



<script data-main="<?php echo base_url() ?>assets/js/main/main-survey.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>