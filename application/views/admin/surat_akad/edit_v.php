<script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js');?>"></script>
<script>
function initMCEexact(e){
  tinyMCE.init({
    mode : "exact",
    elements : e
  });
}
initMCEexact("keterangan1");
initMCEexact("keterangan2");
initMCEexact("keterangan3");
initMCEexact("keterangan4");
initMCEexact("keterangan5");
initMCEexact("keterangan6");
initMCEexact("keterangan7");
initMCEexact("keterangan8");
initMCEexact("keterangan9");
</script>
<section class="content-header">
  <h1><?php echo $label;?></h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard');?>"> Dasbor</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section>
<section class="content">
  <div class="full-width padding">
  <div class="padding-top">
    <div class="row"> 
      <div class="col-md-12"> 
      
        <div class="tab-content">
          <div id="commission" class="tab-pane fade in active">
            <div class="box box-primary" style="border:0">
              <form class="surat-akad" id="surat-akad" method="POST" action="" enctype="multipart/form-data">
                <div class="box-body">
                  <?php if(!empty($this->session->flashdata('message'))){?>
                    <div class="alert alert-info">
                    <?php   
                       print_r($this->session->flashdata('message'));
                    ?>
                    </div>
                  <?php } if(!empty($this->session->flashdata('message_error'))){?>
                    <div class="alert alert-danger">
                    <?php   
                       print_r($this->session->flashdata('message_error'));
                    ?>
                    </div>
                    <?php }?>         
                    <br>  
                    <div class="col-md-12">                                                    
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Judul</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $data->judul ?>" required>
                      </div>
                    </div>     
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Sub Judul</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="sub_judul" name="sub_judul" value="<?php echo $data->sub_judul ?>" required>
                      </div>
                    </div>   
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 1</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" id="keterangan1" name="keterangan1" rows="13"><?php echo $data->keterangan_1; ?></textarea>
                    </div>
                    </div> 
                    <hr>
                  
                      <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="nama_pp" name="nama_pp" value="<?php echo $data->nama_pp ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="alamat_pp" name="alamat_pp" value="<?php echo $data->alamat_pp ?>" required>
                      </div>
                    </div> 

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="jabatan_pp" name="jabatan_pp"value="<?php echo $data->jabatan_pp ?>"required>
                      </div>
                    </div> 
                    <hr>---</hr>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 2</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" id="keterangan2" name="keterangan2" rows="3"><?php echo $data->keterangan_2 ?></textarea>
                    </div>
                    </div> 

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control nama_pk" id="nama_pk" name="nama_pk" value="<?php echo $data->nama_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Tempat Tgl Lahir</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="tempat_tgl_lahir_pk" name="tempat_tgl_lahir_pk" value="<?php echo $data->tempat_tgl_lahir_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nik</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="nik_pk" name="nik_pk" value="<?php echo $data->nik_pk ?>"required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="pekerjaan_pk" name="pekerjaan_pk" value="<?php echo $data->pekerjaan_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Alamat KTP</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="alamat_ktp_pk" name="alamat_ktp_pk" value="<?php echo $data->alamat_ktp_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Alamat Sekarang</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="alamat_sekarang_pk" name="alamat_sekarang_pk" value="<?php echo $data->alamat_sekarang_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">HP</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="hp_pk" name="hp_pk" value="<?php echo $data->hp_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 3</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="13" id="keterangan3" name="keterangan3"><?php echo $data->keterangan_3 ?></textarea>
                    </div>
                    </div> 
                   
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="nama_barang_pk" name="nama_barang_pk" value="<?php echo $data->nama_barang_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">S/N</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="sn_pk" name="sn_pk" value="<?php echo $data->sn_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Imei 1</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="imei1_pk" name="imei1_pk" value="<?php echo $data->imei1_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Imei 2</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="imei2_pk" name="imei2_pk" value="<?php echo $data->imei2_pk ?>"required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 4</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="13"id="keterangan4" name="keterangan4"> <?php echo $data->keterangan_4 ?></textarea>
                    </div>
                    </div> 

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Harga Pokok</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="harga_pokok_pk" name="harga_pokok_pk" value="<?php echo $data->harga_pokok_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keuntungan Pihak Pertama/Penjual</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="keuntungan_pp" name="keuntungan_pp" value="<?php echo $data->keuntungan_pp ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Harga Jual</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="harga_jual_pk" name="harga_jual_pk" value="<?php echo $data->harga_jual_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Biaya Admin</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="biaya_admin_pk" name="biaya_admin_pk" value="<?php echo $data->biaya_admin_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Asuransi Jiwa</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="asuransi_jiwa_pk" name="asuransi_jiwa_pk" value="<?php echo $data->asuransi_jiwa_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Uang Muka</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="uang_muka_pk" name="uang_muka_pk" value="<?php echo $data->uang_muka_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Terhutang Pihak Kedua</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="harga_pokok_pk1" name="harga_pokok_pk1" value="<?php echo $data->harga_pokok_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 5</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="6" id="keterangan5" name="keterangan5"><?php echo $data->keterangan_5 ?></textarea>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Besaran Terbilang</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control besaran_terbilang" id="besaran_terbilang" name="besaran_terbilang" value="<?php echo $data->besaran_terbilang ?>"  required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 6</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="4" id="keterangan6" name="keterangan6"><?php echo $data->keterangan_6 ?></textarea>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">di cicil sebanyak</label> 
                      <div class="col-sm-3">
                        <input type="number" class="form-control cicilan" id="cicilan" name="cicilan" value="<?php echo $data->cicilan ?>"  required>
                      </div>
                      <label for="inputEmail3" class="col-sm-1 control-label">Kali</label> 
                      <label for="inputEmail3" class="col-sm-2 control-label">Dan Lama Waktu</label> 
                      <div class="col-sm-3">
                        <input type="number" class="form-control " id="cicilan1" name="cicilan1" value="<?php echo $data->cicilan ?>" required>
                      </div>
                      <label for="inputEmail3" class="col-sm-1 control-label">/ Bulan</label> 
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-6 control-label">dengan Jatuh Tempo cicilan paling Lambat tanggal </label> 
                      <div class="col-sm-3">
                        <input type="number" class="form-control " id="cicilan2" name="cicilan2" value="<?php echo $data->cicilan ?>"required>
                      </div>
                      <label for="inputEmail3" class="col-sm-2 control-label"> disetiap Bulannya.</label> 
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 7</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="3" id="keterangan7"  name="keterangan7"><?php echo $data->keterangan_7 ?></textarea>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Cicilan</label> 
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="cicilan3" name="cicilan3" value="<?php echo $data->cicilan ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Besaran Cicilan Perbulan</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control harga" id="besaran_cicilan_pk" name="besaran_cicilan_pk" value="<?php echo $data->besaran_cicilan_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-6 control-label">3.	Jatuh Tempo cicilan setiap bulannya adalah tanggal </label> 
                      <div class="col-sm-4">
                        <input type="number" class="form-control" id="cicilan4" name="cicilan4" value="<?php echo $data->cicilan ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-6 control-label">4.	Jatuh Tempo cicilan pertama </label> 
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="jatuh_tempo_pertama_pk" name="jatuh_tempo_pertama_pk" value="<?php echo $data->jatuh_tempo_pertama_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-6 control-label">5.	Jatuh Tempo cicilan Terkahir </label> 
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="jatuh_tempo_terakhir_pk" name="jatuh_tempo_terakhir_pk" value="<?php echo $data->jatuh_tempo_terakhir_pk ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 8</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="4" id="keterangan8" name="keterangan8"><?php echo $data->keterangan_8 ?></textarea>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Besaran Terbilang</label> 
                      <div class="col-sm-6">
                        <input type="text" class="form-control " id="besaran_terbilang2" name="besaran_terbilang2" value="<?php echo $data->besaran_terbilang ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan 9</label> 
                      <div class="col-sm-10">
                    <textarea class="form-control" cols="30" rows="60" id="keterangan9" name="keterangan9"><?php echo $data->keterangan_9 ?></textarea>
                    </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Pihak Kedua</label> 
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="nama_pk1" name="nama_pk1" value="<?php echo $data->nama_pk ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Pihak Pertama</label> 
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="nama_pp1" name="nama_pp1" value="<?php echo $data->nama_pp ?>"required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Saksi 1</label> 
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="saksi1" name="saksi1" value="<?php echo $data->saksi1 ?>" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 control-label">Saksi 2</label> 
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="saksi2" name="saksi2" value="<?php echo $data->saksi2 ?>" required>
                      </div>
                    </div> 

                  </div>                                                             
                </div> 
                <div class="box-footer pad-15 full-width bg-softgrey border-top bot-rounded">
                  <button type="submit" class="btn btn-primary pull-right mleft-15" id="save-btn">Ubah</button>
                </div>
              </form>
            </div>  
          </div>                
        </div>
      </div> 
    </div>
  </div>
</div>
</section>

<script data-main="<?php echo base_url()?>assets/js/main/main-surat_akad.js" src="<?php echo base_url()?>assets/js/require.js"></script>