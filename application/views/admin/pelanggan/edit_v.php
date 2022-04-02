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
    <h3 class="box-title"><i class="fa fa-tag"></i> Edit Pelanggan</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
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
            <input class="form-control" id="nama" value="<?php echo $nama; ?>" name="nama" autocomplete="disabled" required>
          </div>  
              <div class="form-group">
            <label for="">No KTP/SIM</label>
            <input class="form-control" id="ktp" name="ktp" value="<?php echo $ktp; ?>" autocomplete="disabled" required>
          </div> 

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Tempat Lahir</label>
            <input class="form-control" id="tempat_lahir" value="<?php echo $tempat_lahir; ?>" name="tempat_lahir" autocomplete="disabled">

            </div>
             <div class="col-md-6">
                 <label for="">Tgl Lahir</label>
            <input class="form-control datepicker" id="tgl_lahir" value="<?php echo $tgl_lahir; ?>" name="tgl_lahir" autocomplete="disabled">

             </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Jenis Kelamin</label>
           <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                  <option>Pilih salah satu</option>              
                  <option value="Laki-laki" <?php if($jenis_kelamin=="Laki-laki"){echo "selected";}else{"";}?>>Laki-laki</option>   
                  <option value="Perempuan" <?php if($jenis_kelamin=="Perempuan"){echo "selected";}else{"";}?>>Perempuan</option>             
                            
                </select>

            </div>
            <div class="col-md-6">
               <label for="">Agama</label>
           <select name="agama" class="form-control" id="agama">
                  <option>Pilih salah satu</option>              
                  <option value="Islam" <?php if($agama=="Islam"){echo "selected";}else{"";}?>>Islam</option>   
                  <option value="Kristen"  <?php if($agama=="Kristen"){echo "selected";}else{"";}?>>Kristen</option>
                   <option value="Hindu"  <?php if($agama=="Hindu"){echo "selected";}else{"";}?>>Hindu</option>   
                   <option value="Buddha"  <?php if($agama=="Buddha"){echo "selected";}else{"";}?>>Buddha </option>
                   <option value="Katolik"  <?php if($agama=="Katolik"){echo "selected";}else{"";}?>>Katolik</option>      
                </select>
            </div>
          </div>
 

        
            <div class="form-group">
            <label for="">Status Pernikahan</label>
           <select name="status_pernikahan" class="form-control" id="status_pernikahan" required>
                  <option>Pilih salah satu</option>              
<option value="BM" <?php if($status_pernikahan=="BM"){echo "selected";}else{"";}?>>[BM] Belum Menikah</option>
<option value="M0" <?php if($status_pernikahan=="M0"){echo "selected";}else{"";}?>>[M0] Menikah belum ada anak</option>
<option value="M1" <?php if($status_pernikahan=="M1"){echo "selected";}else{"";}?>>[M1] Menikah memiliki 1(satu) anak</option>
<option value="M2" <?php if($status_pernikahan=="M2"){echo "selected";}else{"";}?>>[M2] Menikah memiliki 2(dua) anak</option>
<option value="M3" <?php if($status_pernikahan=="M3"){echo "selected";}else{"";}?>>[M3] Menikah memiliki 3(tiga) anak</option>
<option value="JD" <?php if($status_pernikahan=="JD"){echo "selected";}else{"";}?>>[JD] Janda</option>
<option value="DD" <?php if($status_pernikahan=="DD"){echo "selected";}else{"";}?>>[DD] Duda</option>                 
                </select>
          </div>
              <div class="form-group">
            <label for="">Alamat KTP</label>
 <textarea cols="3" rows="4"  class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" required><?php echo $alamat ?></textarea>
                    
          </div> 
          
        </div>
      </div>
        <div class="col-md-6">

             <div class="form-group">
            <label for="">Pendidikan Terakhir</label>
           <select name="pendidikan" class="form-control" id="pendidikan" required>
                  <option>Pilih salah satu</option>              
<option value="SMP" <?php if($pendidikan=="SMP"){echo "selected";}else{"";}?>>[SMP] Sekolah Menengah Pertama</option>
<option value="SMA" <?php if($pendidikan=="SMA"){echo "selected";}else{"";}?>>[SMA] Sekolah Menengah Atas</option>
<option value="SMK" <?php if($pendidikan=="SMK"){echo "selected";}else{"";}?>>[SMK] Sekolah Menengah Kejuruan</option>
<option value="D1" <?php if($pendidikan=="D1"){echo "selected";}else{"";}?>>[D1] Diploma 1</option>
<option value="D2" <?php if($pendidikan=="D2"){echo "selected";}else{"";}?>>[D2] Diploma 2</option>
<option value="D3" <?php if($pendidikan=="D3"){echo "selected";}else{"";}?>>[D3] Diploma 3</option>
<option value="S1" <?php if($pendidikan=="S1"){echo "selected";}else{"";}?>>[S1] Strata 1</option>
<option value="S2" <?php if($pendidikan=="S2"){echo "selected";}else{"";}?>>[S2] Strata 2</option>
<option value="S3" <?php if($pendidikan=="S3"){echo "selected";}else{"";}?>>[S3] Strata 3</option>                
                </select>
          </div>

           <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" id="email" value="<?php echo $email ?>" name="email" autocomplete="disabled" >
          </div> 
           <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Telp Rumah</label>
            <input class="form-control" value="<?php echo $no_telp_rumah ?>" id="no_telp_rumah" name="no_telp_rumah" autocomplete="disabled">
            </div>
        <div class="col-md-6">
           <label for="">Telp HP</label>
            <input class="form-control" id="no_telp" value="<?php echo $no_telp ?>" name="no_telp" autocomplete="disabled">
        </div>
          </div> 
           

           <div class="form-group">
            <label for="">Alamat Sekarang</label>
 <textarea cols="3" rows="4"  class="form-control" value="<?php echo $alamat_sekarang ?>" id="alamat_sekarang" name="alamat_sekarang" required><?php echo $alamat_sekarang ?></textarea>
                    
          </div> 
 <div class="form-group">
            <label for="">Status</label>
          <div class="radio" id="status" name="status" required>
                  <label><input type="radio" name="status" value="1" <?php if($status=="1"){echo 'checked="checked"';}else{echo "";} ?>>Aktif &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="status" value="0" <?php if($status=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Aktif</label>
                </div>
          </div>
          <div class="form-group">
            <label for="">Tingkat Pembayaran</label>
          <div class="radio" id="status_pembayaran" name="status_pembayaran">
                  <label><input type="radio" name="status_pembayaran" value="1" <?php if($status_pembayaran=="1"){echo 'checked="checked"';}else{echo "";} ?>>Bintang 1 &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="status_pembayaran" value="2" <?php if($status_pembayaran=="2"){echo 'checked="checked"';}else{echo "";} ?>>Bintang 2</label>
                  <label><input type="radio" name="status_pembayaran" value="3" <?php if($status_pembayaran=="3"){echo 'checked="checked"';}else{echo "";} ?>>Bintang 3</label>
                  <label><input type="radio" name="status_pembayaran" value="4" <?php if($status_pembayaran=="4"){echo 'checked="checked"';}else{echo "";} ?>>Bintang 4</label>
                  <label><input type="radio" name="status_pembayaran" value="5" <?php if($status_pembayaran=="5"){echo 'checked="checked"';}else{echo "";} ?>>Bintang 5</label>
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
<option value="PNS" <?php if($pekerjaan=="PNS"){echo "selected";}else{"";}?>>[PNS] Pegawai Negri Sipil</option>
<option value="TNI" <?php if($pekerjaan=="TNI"){echo "selected";}else{"";}?>>[TNI] Tentara Nasional Indonesia/Polri</option>
<option value="BUMN" <?php if($pekerjaan=="BUMN"){echo "selected";}else{"";}?>>Karyawan BUMN</option>
<option value="SWASTA" <?php if($pekerjaan=="SWASTA"){echo "selected";}else{"";}?>>Karyawan Swasta</option>
<option value="LAINNYA" <?php if($pekerjaan=="LAINNYA"){echo "selected";}else{"";}?>>Lainnya</option>              
                </select>
          </div> 
           <div class="form-group row">
            <div class="col-md-6">
              <label for="">Jabatan</label>
            <input class="form-control" value="<?php echo $jabatan ?>" name="jabatan" autocomplete="disabled">
            </div>

             <div class="col-md-6">
<label for="">Lama Kerja</label>
            <input class="form-control" value="<?php echo $lama_kerja ?>" name="lama_kerja" autocomplete="disabled">
             </div>
            
          </div> 
           <div class="form-group">
            <label for="">Nama Instansi /Perusahaan</label>
            <input class="form-control" value="<?php echo $nama_instansi ?>" name="nama_instansi" autocomplete="disabled">
          </div>  

            <div class="form-group">
            <label for="">Alamat Instansi / Perusahaan</label>
 <textarea cols="3" rows="4" value="<?php echo $alamat_instansi ?>"  class="form-control" name="alamat_perusahaan"><?php echo $alamat_instansi ?></textarea>
                    
          </div> 
        </div>
           
             <div class="col-md-6">

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Penghasilan Pokok</label>
            <input class="form-control harga" value="<?php echo $penghasilan_pokok ?>" type="numeric" name="penghasilan_pokok" autocomplete="disabled">

            </div>
             <div class="col-md-6">
                 <label for="">Tunjangan Penghasilan</label>
            <input class="form-control harga" value="<?php echo $tunjangan_penghasilan ?>" type="numeric" name="tunjangan_penghasilan" autocomplete="disabled">

             </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Nama Usaha</label>
         <input class="form-control" value="<?php echo $nama_usaha ?>"  name="nama_usaha" autocomplete="disabled">
            </div>         
  <div class="col-md-6">
                  <label for="">Penghasilan Usaha</label>
         <input class="form-control harga"  value="<?php echo $penghasilan_usaha ?>" type="numeric" name="penghasilan_usaha" autocomplete="disabled">
            </div>    

              </div>

              <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Pengeluaran Rutin/bulan</label>
         <input class="form-control harga" value="<?php echo $pengeluaran_rutin ?>" type="numeric"  name="pengeluaran_rutin" autocomplete="disabled">
            </div>         
  <div class="col-md-6">
                  <label for="">Pengeluaran Kredit/bulan</label>
         <input class="form-control harga" value="<?php echo $pengeluaran_kredit ?>"  type="numeric" name="pengeluaran_kredit" autocomplete="disabled">
            </div>    

              </div>
                <div class="form-group">
            <label for="">Alamat Usaha</label>
 <textarea cols="3" rows="4"  class="form-control" value="<?php echo $alamat_usaha ?>" name="alamat_usaha"><?php echo $alamat_usaha ?></textarea>
                    
          </div> 

            </div>
          </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
             <div class="col-md-6">
                <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input class="form-control" id="nama_pasangan" value="<?php echo $nama_pasangan ?>" name="nama_pasangan" autocomplete="disabled">
          </div>  
              <div class="form-group">
            <label for="">No KTP/SIM</label>
            <input class="form-control" value="<?php echo $ktp_pasangan ?>" name="ktp_pasangan" autocomplete="disabled">
          </div> 

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Tempat Lahir</label>
            <input class="form-control" value="<?php echo $tempat_lahir_pasangan ?>" name="tempat_lahir_pasangan" autocomplete="disabled">

            </div>
             <div class="col-md-6">
                 <label for="">Tgl Lahir</label>
            <input class="form-control datepicker" value="<?php echo $tgl_lahir_pasangan ?>" name="tgl_lahir_pasangan" autocomplete="disabled">

             </div>
          </div> 
         <div class="form-group">
            <label for="">Alamat</label>
 <textarea cols="3" rows="4"  class="form-control" value="<?php echo $alamat_pasangan ?>" name="alamat_pasangan"></textarea>
                    
          </div> 
              </div>
              <div class="col-md-6">
                 <div class="form-group row">
            <div class="col-md-6">
                    <label for="">Pekerjaan/Profesi</label>
        <select name="pekerjaan_pasangan" class="form-control">
                  <option>Pilih salah satu</option>              
<option value="PNS" <?php if($pekerjaan_pasangan=="PNS"){echo "selected";}else{"";}?>>[PNS] Pegawai Negri Sipil</option>
<option value="TNI" <?php if($pekerjaan_pasangan=="TNI"){echo "selected";}else{"";}?>>[TNI] Tentara Nasional Indonesia/Polri</option>
<option value="BUMN" <?php if($pekerjaan_pasangan=="BUMN"){echo "selected";}else{"";}?>>Karyawan BUMN</option>
<option value="SWASTA" <?php if($pekerjaan_pasangan=="SWASTA"){echo "selected";}else{"";}?>>Karyawan Swasta</option>
<option value="LAINNYA" <?php if($pekerjaan_pasangan=="LAINNYA"){echo "selected";}else{"";}?>>Lainnya</option>              
                </select>

            </div>
            <div class="col-md-6">
               <label for="">Agama</label>
           <select name="agama_pasangan" class="form-control">
                    <option>Pilih salah satu</option>              
                  <option value="Islam" <?php if($agama_pasangan=="Islam"){echo "selected";}else{"";}?>>Islam</option>   
                  <option value="Kristen"  <?php if($agama_pasangan=="Kristen"){echo "selected";}else{"";}?>>Kristen</option>
                   <option value="Hindu"  <?php if($agama_pasangan=="Hindu"){echo "selected";}else{"";}?>>Hindu</option>   
                   <option value="Buddha"  <?php if($agama_pasangan=="Buddha"){echo "selected";}else{"";}?>>Buddha </option>
                   <option value="Katolik"  <?php if($agama_pasangan=="Katolik"){echo "selected";}else{"";}?>>Katolik</option>     
                </select>
            </div>
             </div>
                 <div class="form-group">
            <label for="">No Telp</label>
            <input class="form-control" name="telp_pasangan" value="<?php echo $no_telp_pasangan ?>" autocomplete="disabled">
          </div>  
                 <div class="form-group">
            <label for="">Nama Usaha</label>
            <input class="form-control" name="nama_usaha_pasangan" value="<?php echo $nama_usaha_pasangan ?>"  autocomplete="disabled">
          </div>  
          <div class="form-group">
            <label for="">Alamat Usaha</label>
 <textarea cols="3" rows="4"  class="form-control" value="<?php echo $alamat_pekerjaan_pasangan ?>" name="alamat_usaha_pasangan"><?php echo $alamat_pekerjaan_pasangan ?></textarea>
                    
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
                  <label><input type="radio" name="rumah" value="1" <?php if($rumah=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="rumah" value="0" <?php if($rumah=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                  <label for="">Rumah Milik</label>
        <select name="rumah_milik" class="form-control">
                  <option>Pilih salah satu</option>              
                  <option value="PRIBADI" <?php if($rumah_milik=="PRIBADI"){echo "selected";}else{"";} ?>>PRIBADI</option>   
                  <option value="ORANG TUA" <?php if($rumah_milik=="ORANG TUA"){echo "selected";}else{"";} ?>>ORANG TUA</option>
                   <option value="KELUARGA" <?php if($rumah_milik=="KELUARGA"){echo "selected";}else{"";} ?>>KELUARGA</option>   
                   <option value="SEWA" <?php if($rumah_milik=="SEWA"){echo "selected";}else{"";} ?>>SEWA </option>
                   <option value="DINAS" <?php if($rumah_milik=="DINAS"){echo "selected";}else{"";} ?>>DINAS</option>      
                </select>
          </div>  

                </div>
                  <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Tanah</label>
          <div class="radio">
                  <label><input type="radio" name="tanah" value="1" <?php if($tanah=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="tanah" value="0" <?php if($tanah=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">Mobil</label>
          <div class="radio">
                  <label><input type="radio" name="mobil" value="1" <?php if($mobil=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="mobil" value="0" <?php if($mobil=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  

                </div>
                 <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Motor</label>
          <div class="radio">
                  <label><input type="radio" name="motor" value="1" <?php if($motor=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="motor" value="0" <?php if($motor=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">Laptop/pc</label>
          <div class="radio">
                  <label><input type="radio" name="laptop" value="1" <?php if($laptop=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="laptop" value="0" <?php if($laptop=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  

                </div>
             

         

            </div>
            <div class="col-md-6">
                    <div class="form-group row">
                <div class="col-md-6">
                  <label for="">AC</label>
          <div class="radio">
                  <label><input type="radio" name="ac" value="1" <?php if($ac=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="ac" value="0" <?php if($ac=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">TV</label>
          <div class="radio">
                  <label><input type="radio" name="tv" value="1" <?php if($tv=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="tv" value="0" <?php if($tv=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  

                </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="">Kulkas</label>
          <div class="radio">
                  <label><input type="radio" name="kulkas" value="1" <?php if($kulkas=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="kulkas" value="0" <?php if($kulkas=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  
          <div class="col-md-6">
                 <label for="">Tabungan</label>
          <div class="radio">
                  <label><input type="radio" name="tabungan" value="1" <?php if($tabungan=="1"){echo 'checked="checked"';}else{echo "";} ?>>Ada &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="tabungan" value="0" <?php if($tabungan=="0"){echo 'checked="checked"';}else{echo "";} ?>>Tidak Ada</label>
                </div>
          </div>  

                </div>
                <div class="form-group">
                  <label>Lainnya</label>
                  <input type="text" name="kekayaan_lainnya" value="<?php echo $lainnya ?>"class="form-control">

                </div>

            </div>
              </div>
                   <div class="tab-pane" id="tab_5">
                   <div class="col-md-6">
                      <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input class="form-control" id="nama_keluarga" value="<?php echo $nama_keluarga ?>" name="nama_keluarga" autocomplete="disabled">
          </div>  
            <div class="form-group">
            <label for="">KTP</label>
            <input class="form-control"  name="ktp_keluarga"value="<?php echo $ktp_keluarga ?>" autocomplete="disabled">
          </div>  
    <div class="form-group">
            <label for="">Alamat</label>
 <textarea cols="3" rows="4"  class="form-control" value="<?php echo $alamat_keluarga ?>" name="alamat_keluarga"><?php echo $alamat_keluarga ?></textarea>
                    
          </div> 
 

                   </div>
                   <div class="col-md-6">
                       <div class="form-group">
            <label for="">No HP</label>
            <input class="form-control" value="<?php echo $no_hp_keluarga ?>" name="hp_keluarga" autocomplete="disabled">
          </div> 
           <div class="form-group">
            <label for="">Pekerjaan</label>
            <input class="form-control" value="<?php echo $pekerjaan_keluarga ?>"  name="pekerjaan_keluarga" autocomplete="disabled">
          </div> 
           <div class="form-group">
            <label for="">Hubungan</label>
            <input class="form-control" value="<?php echo $hubungan_keluarga ?>"  name="hubungan_keluarga" autocomplete="disabled">
          </div>  
                   </div>
                   </div>
            <!-- /.tab-content -->
          </div>

    
      <div class="col-md-12">
       
  <div class="form-group">
     <a href="<?php echo base_url('Customer')?>" class="btn btn-default pull-right"> BATAL</a>
       <button type="submit" class="btn btn-primary pull-right">Simpan</button>
          </div>

          </div>
               
         
          </div>
         
        
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-karyawan" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>