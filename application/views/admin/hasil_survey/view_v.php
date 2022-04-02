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
      <h3 class="box-title"><i class="fa fa-tag"></i> Lihat Hasil Survey</h3>
    </div>
    <form id="karyawan" method="post" enctype="multipart/form-data">
      <input type="hidden" name="file_foto_pelanggan" value="<?php echo $data->foto_pelanggan ?>">
      <input type="hidden" name="file_foto_pasangan" value="<?php echo $data->foto_pasangan ?>">
      <input type="hidden" name="file_foto_ktp" value="<?php echo $data->foto_ktp ?>">
      <input type="hidden" name="file_foto_kk" value="<?php echo $data->foto_kk ?>">
      <input type="hidden" name="file_foto_slip_gaji" value="<?php echo $data->foto_slip_gaji ?>">
      <input type="hidden" name="file_foto_dl" value="<?php echo $data->foto_dl ?>">
      <input type="hidden" name="file_foto_dl1" value="<?php echo $data->foto_dl1 ?>">
      <div class="box-body">
        <div class="col-md-12">
          <div class="row">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Hasil Survey</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Dokumen</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Upload Dokumen</a></li>

              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">


                  <div class="col-md-6">
                    <div class="form-group">

                      <div class="form-group">
                        <label for="">No Pelanggan</label>
                        <select id="pelanggan" name="pelanggan" class="form-control">
                          <option value="" required>Pilih salah satu</option>
                          <?php
                          foreach ($pelanggan as $key => $val) { ?>
                            <option value="<?php echo $val->id_pelanggan; ?>" <?php echo $val->id_pelanggan == $id_pelanggan ? 'selected' : '' ?>><?php echo $val->id_pelanggan . ' - ' . $val->nama ?></option>
                          <?php }
                          ?>
                        </select>

                      </div>



                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="">Pernah Kredit</label>
                          <select name="pernah_kredit" class="form-control" id="pernah_kredit">
                            <option>Pilih salah satu</option>
                            <option value="1" <?php echo $data->pernah_kredit == '1' ? 'selected' : '' ?>>YA</option>
                            <option value="0" <?php echo $data->pernah_kredit == '0' ? 'selected' : '' ?>>TIDAK</option>

                          </select>


                        </div>
                        <div class="col-md-6">
                          <label for="">Pengeluaran Rutin</label>
                          <input type="numeric" class="form-control rupiah" id="pengeluaran_rutin" name="pengeluaran_rutin" autocomplete="disabled" value="<?php echo $data->pengeluaran_rutin ?>">

                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="">Kondisi Keuangan</label>
                          <input class="form-control rupiah" id="kondisi_keuangan" name="kondisi_keuangan" autocomplete="disabled" value="<?php echo $data->kondisi_keuangan ?>">

                        </div>
                        <div class="col-md-6">
                          <label for="">Data Formulir Hasil Survey</label>
                          <input class="form-control" name="DFHS" autocomplete="disabled" value="<?php echo $data->DFHS ?>">
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="">Nama Surveyor</label>
                        <input class="form-control " name="nama_surveyor" autocomplete="disabled" value="<?php echo $data->nama_surveyor ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal</label>
                        <input class="form-control datepicker" name="tanggal" autocomplete="disabled" value="<?php echo date("d-m-Y", strtotime($data->tanggal)) ?>">
                      </div>

                    </div>
                  </div>
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="">KETERANGAN HASIL TELP KELUARGA</label>
                      <textarea cols="3" rows="4" class="form-control" name="KHTK" value="<?php echo $data->KHTK ?>"><?php echo $data->KHTK ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="">CATATAN</label>
                      <textarea cols="3" rows="3" class="form-control" name="catatan" value="<?php echo $data->kondisi_keuangan ?>"><?php echo $data->kondisi_keuangan ?></textarea>
                    </div>


                    <div class="form-group">
                      <label for="">Disetujui dan dilanjukan proses pemebelian</label>
                      <div class="radio" id="status" name="status">
                        <label><input type="radio" name="status" value="1" <?php echo $data->status == '1' ? 'checked' : '' ?>>Ya &nbsp;&nbsp; </label>
                        <label><input type="radio" name="status" value="0" <?php echo $data->status == '0' ? 'checked' : '' ?>>Tidak</label>
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
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Formulir diisi dan diTTD sesuai dokumen</label>
                      <select name="formulir_TTD" class="form-control">
                        <option>Pilih salah satu</option>
                        <option value="1" <?php echo $data->formulir_TTD == '1' ? 'selected' : '' ?>>YA</option>
                        <option value="0" <?php echo $data->formulir_TTD == '0' ? 'selected' : '' ?>>TIDAK</option>

                      </select>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Foto/Fotocopy KTP</label>
                        <select name="fotocopy_ktp" class="form-control">
                          <option>Pilih salah satu</option>
                          <option value="1" <?php echo $data->fotocopy_ktp == '1' ? 'selected' : '' ?>>YA</option>
                          <option value="0" <?php echo $data->fotocopy_ktp == '0' ? 'selected' : '' ?>>TIDAK</option>

                        </select>
                      </div>

                      <div class="col-md-6">
                        <label for="">Foto/Fotocopy KK</label>
                        <select name="fotocopy_kk" class="form-control">
                          <option>Pilih salah satu</option>
                          <option value="1" <?php echo $data->fotocopy_kk == '1' ? 'selected' : '' ?>>YA</option>
                          <option value="0" <?php echo $data->fotocopy_kk == '0' ? 'selected' : '' ?>>TIDAK</option>

                        </select>
                      </div>

                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Foto/Fotocopy Slip Gaji</label>

                        <select name="fotocopy_slip_gaji" class="form-control">
                          <option>Pilih salah satu</option>
                          <option value="1" <?php echo $data->fotocopy_slip_gaji == '1' ? 'selected' : '' ?>>YA</option>
                          <option value="0" <?php echo $data->fotocopy_slip_gaji == '0' ? 'selected' : '' ?>>TIDAK</option>

                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="">Status Rumah</label>
                        <input class="form-control" type="text" name="status_rumah" autocomplete="disabled" value="<?php echo $data->status_rumah ?>">

                      </div>
                    </div>


                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Analisis Keuangan</label>
                        <input class="form-control" type="text" name="analisis_keuangan" autocomplete="disabled" value="<?php echo $data->analisis_keuangan ?>">

                      </div>
                      <div class="col-md-6">
                        <label for="">Tujuan Pembelian Sesuai</label>
                        <select name="tujuan_pembelian_sesuai" class="form-control">
                          <option>Pilih salah satu</option>
                          <option value="1" <?php echo $data->tujuan_pembelian_sesuai == '1' ? 'selected' : '' ?>>YA</option>
                          <option value="0" <?php echo $data->tujuan_pembelian_sesuai == '0' ? 'selected' : '' ?>>TIDAK</option>

                        </select>

                      </div>
                    </div>

                    <div class="form-group">
                      <label for="">Catatan</label>
                      <textarea cols="3" rows="3" class="form-control" id="catatan_dok" name="catatan_dok" value="<?php echo $data->catatan_dok ?>"><?php echo $data->catatan_dok ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Alamat Sekarang</label>
                      <textarea cols="3" rows="3" class="form-control" id="alamat_sekarang" name="alamat_sekarang" value="<?php echo $data->alamat_sekarang ?>"><?php echo $data->alamat_sekarang ?></textarea>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Lokasi</label>
                        <input class="form-control" value="<?php echo $data->lokasi ?>" name="lokasi" autocomplete="disabled">
                      </div>
                      <div class="col-md-6">
                        <label for="">Denah Rumah</label>
                        <input class="form-control" type="text" value="<?php echo $data->denah_rumah ?>" name="denah_rumah" autocomplete="disabled">
                      </div>

                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Kondisi Rumah</label>
                        <input class="form-control" type="text" value="<?php echo $data->kondisi_rumah ?>" name="kondisi_rumah" autocomplete="disabled">
                      </div>
                      <div class="col-md-6">
                        <label for="">Kondisi Tempat Usaha</label>
                        <input class="form-control" type="text" value="<?php echo $data->kondisi_tempat_usaha ?>" name="kondisi_tempat_usaha" autocomplete="disabled">
                      </div>

                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Kondisi Tempat Kerja</label>
                        <input class="form-control" type="text" value="<?php echo $data->kondisi_tempat_kerja ?>" name="kondisi_tempat_kerja" autocomplete="disabled">
                      </div>
                      <div class="col-md-6">
                        <label for="">Kondisi Tetangga</label>
                        <input class="form-control" value="<?php echo $data->kondisi_tetangga ?>" type="text" name="kondisi_tetangga" autocomplete="disabled">
                      </div>

                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Karakter Keluarga</label>
                        <input class="form-control" type="text" value="<?php echo $data->karakter_keluarga ?>" name="karakter_keluarga" autocomplete="disabled">
                      </div>
                      <div class="col-md-6">
                        <label for="">Pemakaian Objek Barang</label>
                        <input class="form-control" value="<?php echo $data->pemakaian_objek_barang ?>" type="text" name="pemakaian_objek_barang" autocomplete="disabled">
                      </div>

                    </div>

                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">FOTO Pelanggan</label> <br>
                      <img width="100px" height="100px" src="<?php echo base_url('assets/upload/image/') . $data->foto_pelanggan ?>"> <br><br>
                      <input type="file" id="foto_pelanggan" name="foto_pelanggan" class="form-control">
                    </div>


                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="">Foto KTP</label> <br>
                        <img width="100px" height="100px" src="<?php echo base_url('assets/upload/image/') . $data->foto_ktp ?>"> <br><br>
                        <input type="file" id="foto_ktp" name="foto_ktp" class="form-control">

                      </div>

                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="">Foto Dokumen Lain</label> <br>
                        <img width="100px" height="100px" src="<?php echo base_url('assets/upload/image/') . $data->foto_dl ?>"> <br><br>
                        <input type="file" id="foto_dl" class="form-control" name="foto_dl">

                      </div>
                      <div class="col-md-6">
                        <label for="">Foto Dokumen Lain</label> <br>
                        <img width="100px" height="100px" src="<?php echo base_url('assets/upload/image/') . $data->foto_dl1 ?>"> <br><br>
                        <input type="file" id="foto_dl1" class="form-control" name="foto_dl1">
                      </div>
                    </div>

                  </div>
                  <!-- /.tab-pane -->
                </div>


                <!-- /.tab-content -->
              </div>


              <div class="col-md-12">

                <div class="form-group">
                  <a href="<?php echo base_url('Hasil_survey') ?>" class="btn btn-default pull-right"> Kembali</a>

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