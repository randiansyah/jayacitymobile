<?php if(!empty($this->session->flashdata('message_error'))){?>
<div class="alert alert-danger">
<?php   
   print_r($this->session->flashdata('message_error'));
?>
</div>
<?php }?> 
<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Pelanggan</h3>
    </div>
     <form id="form-pelanggan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Data Peribadi</a></li>
    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">PEKERJAAN PEMOHON </a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Data Pasangan / Sodara</a></li>
               <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">
                 Daftar Kekayaan
               </a></li>

     <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">
             Data Keluarga tidak serumah
               </a></li>
             
            
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">


           <div class="col-md-6">
          <div class="form-group"> 

            <div class="form-group">
            <label for="">No Pelanggan</label>
            <input class="form-control" name="id_pelanggan" value="<?php echo $kode; ?>" autocomplete="disabled" required readonly>
          </div> 
           <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input class="form-control" id="nama" name="nama" autocomplete="disabled" value="<?php echo set_value("nama"); ?>">
          </div>  
              <div class="form-group">
            <label for="">No KTP/SIM</label>
            <input class="form-control" id="ktp" name="ktp" autocomplete="disabled" required>
          </div> 

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Tempat Lahir</label>
            <input class="form-control" id="tempat_lahir" name="tempat_lahir" autocomplete="disabled" required>

            </div>
             <div class="col-md-6">
                 <label for="">Tgl Lahir</label>
            <input class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" autocomplete="disabled" required>

             </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Jenis Kelamin</label>
           <select name="jenis_kelamin" class="form-control select2" id="jenis_kelamin" value="<?php echo set_value("jenis_kelamin"); ?>">
                  <option>Pilih salah satu</option>              
                  <option value="Laki-laki">Laki-laki</option>   
                  <option value="Perempuan">Perempuan</option>             
                            
                </select>

            </div>
            <div class="col-md-6">
               <label for="">Agama</label>
           <select name="agama" class="form-control select2" id="agama" required>
                  <option>Pilih salah satu</option>              
                  <option value="Islam">Islam</option>   
                  <option value="Kristen">Kristen</option>
                   <option value="Hindu">Hindu</option>   
                   <option value="Buddha ">Buddha </option>
                   <option value="Katolik">Katolik</option>      
                </select>
            </div>
          </div>
 

        
            <div class="form-group">
            <label for="">Status Pernikahan</label>
           <select name="status_pernikahan" class="form-control select2" id="status_pernikahan" required>
                  <option>Pilih salah satu</option>              
<option value="BM">[BM] Belum Menikah</option>
<option value="M0">[M0] Menikah belum ada anak</option>
<option value="M1">[M1] Menikah memiliki 1(satu) anak</option>
<option value="M2">[M2] Menikah memiliki 2(dua) anak</option>
<option value="M3">[M3] Menikah memiliki 3(tiga) anak</option>
<option value="JD">[JD] Janda</option>
<option value="DD">[DD] Duda</option>                 
                </select>
          </div>
              <div class="form-group">
            <label for="">Alamat KTP</label>
 <textarea cols="3" rows="4"  class="form-control" id="alamat" name="alamat" required></textarea>
                    
          </div> 
          
        </div>
      </div>
        <div class="col-md-6">

             <div class="form-group">
            <label for="">Pendidikan Terakhir</label>
           <select name="pendidikan" class="form-control select2" id="pendidikan" required>
                  <option>Pilih salah satu</option>              
<option value="SMP">[SMP] Sekolah Menengah Pertama</option>
<option value="SMA">[SMA] Sekolah Menengah Atas</option>
<option value="SMK">[SMK] Sekolah Menengah Kejuruan</option>
<option value="D1">[D1] Diploma 1</option>
<option value="D2">[D2] Diploma 2</option>
<option value="D3">[D3] Diploma 3</option>
<option value="S1">[S1] Strata 1</option>
<option value="S2">[S2] Strata 2</option>
<option value="S3">[S3] Strata 3</option>                
                </select>
          </div>

           <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" id="email" name="email" autocomplete="disabled" required>
          </div> 
           <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Telp Rumah</label>
            <input class="form-control" id="no_telp_rumah" name="no_telp_rumah" autocomplete="disabled" required>
            </div>
        <div class="col-md-6">
           <label for="">Telp HP</label>
            <input class="form-control" id="no_telp" name="no_telp" autocomplete="disabled" required>
        </div>
          </div> 
           

           <div class="form-group">
            <label for="">Alamat Sekarang</label>
 <textarea cols="3" rows="4"  class="form-control" id="alamat_sekarang" name="alamat_sekarang" required></textarea>
                    
          </div> 
 <div class="form-group">
            <label for="">Status</label>
          <div class="radio" id="status" name="status" required>
                  <label><input type="radio" name="status" value="1" checked='checked'>Aktif &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="status" value="0">Tidak Aktif</label>
                </div>
          </div>
           <div class="form-group">
           <label for="">User input</label>
      <input class="form-control" type="hidden" value="<?php echo $this->data['users']->id;?>" id="user_input" name="user_input">

          <input class="form-control" value="<?php echo $this->data['users']->first_name;?>"autocomplete="disabled" readonly>
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
            <label for="">Pekerjaan/Profesi</label>
        <select name="pekerjaan" class="form-control">
                  <option>Pilih salah satu</option>              
<option value="PNS">[PNS] Pegawai Negri Sipil</option>
<option value="TNI">[TNI] Tentara Nasional Indonesia/Polri</option>
<option value="BUMN">Karyawan BUMN</option>
<option value="SWASTA">Karyawan Swasta</option>
<option value="LAINNYA">Lainnya</option>              
                </select>
          </div> 
           <div class="form-group row">
            <div class="col-md-6">
              <label for="">Jabatan</label>
            <input class="form-control" name="jabatan" autocomplete="disabled">
            </div>

             <div class="col-md-6">
<label for="">Lama Kerja</label>
            <input class="form-control" name="lama_kerja" autocomplete="disabled">
             </div>
            
          </div> 
           <div class="form-group">
            <label for="">Nama Instansi /Perusahaan</label>
            <input class="form-control" name="nama_instansi" autocomplete="disabled">
          </div>  

            <div class="form-group">
            <label for="">Alamat Instansi / Perusahaan</label>
 <textarea cols="3" rows="4"  class="form-control" name="alamat_perusahaan"></textarea>
                    
          </div> 
        </div>
           
             <div class="col-md-6">

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Penghasilan Pokok</label>
            <input class="form-control harga" type="numeric" name="penghasilan_pokok" autocomplete="disabled">

            </div>
             <div class="col-md-6">
                 <label for="">Tunjangan Penghasilan</label>
            <input class="form-control harga" type="numeric" name="tunjangan_penghasilan" autocomplete="disabled">

             </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Nama Usaha</label>
         <input class="form-control"  name="nama_usaha" autocomplete="disabled">
            </div>         
  <div class="col-md-6">
                  <label for="">Penghasilan Usaha</label>
         <input class="form-control harga" type="numeric" name="penghasilan_usaha" autocomplete="disabled">
            </div>    

              </div>

              <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Pengeluaran Rutin/bulan</label>
         <input class="form-control harga" type="numeric"  name="pengeluaran_rutin" autocomplete="disabled">
            </div>         
  <div class="col-md-6">
                  <label for="">Pengeluaran Kredit/bulan</label>
         <input class="form-control harga"  type="numeric" name="pengeluaran_kredit" autocomplete="disabled">
            </div>    

              </div>
                <div class="form-group">
            <label for="">Alamat Usaha</label>
 <textarea cols="3" rows="4"  class="form-control" name="alamat_usaha"></textarea>
                    
          </div> 

            </div>
          </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
             <div class="col-md-6">
                <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input class="form-control" id="nama_pasangan" name="nama_pasangan" autocomplete="disabled">
          </div>  
              <div class="form-group">
            <label for="">No KTP/SIM</label>
            <input class="form-control" name="ktp_pasangan" autocomplete="disabled">
          </div> 

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Tempat Lahir</label>
            <input class="form-control"  name="tempat_lahir_pasangan" autocomplete="disabled">

            </div>
             <div class="col-md-6">
                 <label for="">Tgl Lahir</label>
            <input class="form-control datepicker" name="tgl_lahir_pasangan" autocomplete="disabled">

             </div>
          </div> 
         <div class="form-group">
            <label for="">Alamat</label>
 <textarea cols="3" rows="4"  class="form-control" name="alamat_pasangan"></textarea>
                    
          </div> 
              </div>
              <div class="col-md-6">
                 <div class="form-group row">
            <div class="col-md-6">
                    <label for="">Pekerjaan/Profesi</label>
        <select name="pekerjaan_pasangan" class="form-control">
                  <option>Pilih salah satu</option>              
<option value="PNS">[PNS] Pegawai Negri Sipil</option>
<option value="TNI">[TNI] Tentara Nasional Indonesia/Polri</option>
<option value="BUMN">Karyawan BUMN</option>
<option value="SWASTA">Karyawan Swasta</option>
<option value="LAINNYA">Lainnya</option>              
                </select>

            </div>
            <div class="col-md-6">
               <label for="">Agama</label>
           <select name="agama_pasangan" class="form-control">
                  <option>Pilih salah satu</option>              
                  <option value="Islam">Islam</option>   
                  <option value="Kristen">Kristen</option>
                   <option value="Hindu">Hindu</option>   
                   <option value="Buddha ">Buddha </option>
                   <option value="Katolik">Katolik</option>      
                </select>
            </div>
             </div>
                 <div class="form-group">
            <label for="">No Telp</label>
            <input class="form-control" name="telp_pasangan" autocomplete="disabled">
          </div>  
                 <div class="form-group">
            <label for="">Nama Usaha</label>
            <input class="form-control" name="nama_usaha_pasangan" autocomplete="disabled">
          </div>  
          <div class="form-group">
            <label for="">Alamat Usaha</label>
 <textarea cols="3" rows="4"  class="form-control" name="alamat_usaha_pasangan"></textarea>
                    
          </div> 

              </div>
              <!-- /.tab-pane -->
            </div>
              <div class="tab-pane" id="tab_4">
            <div class="col-md-6">
               <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Rumah</label>
          <div class="radio">
                  <label><input type="radio" name="rumah" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="rumah" value="0">Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                  <label for="">Rumah Milik</label>
        <select name="rumah_milik" class="form-control">
                  <option>Pilih salah satu</option>              
                  <option value="PRIBADI">PRIBADI</option>   
                  <option value="ORANG TUA">ORANG TUA</option>
                   <option value="KELUARGA">KELUARGA</option>   
                   <option value="SEWA ">SEWA </option>
                   <option value="DINAS">DINAS</option>      
                </select>
          </div>  

                </div>
                  <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Tanah</label>
          <div class="radio">
                  <label><input type="radio" name="tanah" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="tanah" value="0">Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">Mobil</label>
          <div class="radio">
                  <label><input type="radio" name="mobil" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="mobil" value="0">Tidak Ada</label>
                </div>
          </div>  

                </div>
                 <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Motor</label>
          <div class="radio">
                  <label><input type="radio" name="motor" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="motor" value="0">Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">Laptop/pc</label>
          <div class="radio">
                  <label><input type="radio" name="laptop" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="laptop" value="0">Tidak Ada</label>
                </div>
          </div>  

                </div>
             

         

            </div>
            <div class="col-md-6">
                    <div class="form-group row">
                <div class="col-md-6">
                  <label for="">AC</label>
          <div class="radio">
                  <label><input type="radio" name="ac" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="ac" value="0">Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">TV</label>
          <div class="radio">
                  <label><input type="radio" name="tv" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="tv" value="0">Tidak Ada</label>
                </div>
          </div>  

                </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Kulkas</label>
          <div class="radio">
                  <label><input type="radio" name="kulkas" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="kulkas" value="0">Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">Tabungan</label>
          <div class="radio">
                  <label><input type="radio" name="tabungan" value="1" checked='checked'>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="tabungan" value="0">Tidak Ada</label>
                </div>
          </div>  

                </div>
                <div class="form-group">
                  <label>Lainnya</label>
                  <input type="text" name="kekayaan_lainnya" class="form-control">

                </div>

            </div>
              </div>
                   <div class="tab-pane" id="tab_5">
                   <div class="col-md-6">
                      <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input class="form-control" id="nama_keluarga" name="nama_keluarga" autocomplete="disabled">
          </div>  
            <div class="form-group">
            <label for="">KTP</label>
            <input class="form-control"  name="ktp_keluarga" autocomplete="disabled">
          </div>  
    <div class="form-group">
            <label for="">Alamat</label>
 <textarea cols="3" rows="4"  class="form-control"  name="alamat_keluarga"></textarea>
                    
          </div> 
 

                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
            <label for="">No HP</label>
            <input class="form-control"  name="hp_keluarga" autocomplete="disabled">
          </div> 
           <div class="form-group">
            <label for="">Pekerjaan</label>
            <input class="form-control"  name="pekerjaan_keluarga" autocomplete="disabled">
          </div> 
           <div class="form-group">
            <label for="">Hubungan</label>
            <input class="form-control"  name="hubungan_keluarga" autocomplete="disabled">
          </div>  
                   </div>
                   </div>
            <!-- /.tab-content -->
          </div>

    
      <div class="col-md-12">
       
  <div class="form-group">
       <button type="submit" class="btn btn-primary pull-right">Simpan</button>
          </div>

          </div>
               
         
          </div>
         
        
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-pelanggan.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>