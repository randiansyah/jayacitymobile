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
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Survey</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
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
 <select id="pelanggan" name="pelanggan" class="form-control select2">
                  <option value="">Pilih salah satu</option>
                  <?php
                  foreach ($pelanggan as $key => $val) { ?>
      <option value="<?php echo $val->id_pelanggan;?>">ID : <?php echo $val->id_pelanggan.' - '.$val->nama ?></option>
                  <?php }
                  ?>
                </select>

          </div> 
         
            

           <div class="form-group row">
            <div class="col-md-6">
            <label for="">Pernah Kredit</label>
              <select name="pernah_kredit" class="form-control select2" id="pernah_kredit">
                  <option>Pilih salah satu</option>              
<option value="1">YA</option>
<option value="0">TIDAK</option>
               
                </select>
     

            </div>
             <div class="col-md-6">
                 <label for="">Pengeluaran Rutin</label>
            <input type="numeric" class="form-control rupiah" id="pengeluaran_rutin" name="pengeluaran_rutin" autocomplete="off">

             </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Kondisi Keuangan</label>
                  <input class="form-control rupiah" id="kondisi_keuangan" name="kondisi_keuangan" autocomplete="off">

            </div>
            <div class="col-md-6">
               <label for="">Data Formulir Hasil Survey</label>
               <input class="form-control" name="DFHS" autocomplete="off">
            </div>
          </div>
 

        
            <div class="form-group">
            <label for="">Nama Surveyor</label>
               <input class="form-control "name="nama_surveyor" autocomplete="off">
          </div>
              <div class="form-group">
            <label for="">Tanggal</label>
       <input class="form-control datepicker" name="tanggal" autocomplete="off">
          </div> 
          
        </div>
      </div>
        <div class="col-md-6">

             <div class="form-group">
            <label for="">KETERANGAN HASIL TELP KELUARGA</label>
        <textarea cols="3" rows="4"  class="form-control"  name="KHTK" ></textarea>
          </div>

           <div class="form-group">
            <label for="">CATATAN</label>
             <textarea cols="3" rows="3"  class="form-control" name="catatan" ></textarea>
          </div> 
    

 <div class="form-group">
            <label for="">Disetujui dan dilanjukan proses pemebelian</label>
          <div class="radio" id="status" name="status" >
                  <label><input type="radio" name="status" value="1" checked='checked'>Ya &nbsp;&nbsp;  </label>
                  <label><input type="radio" name="status" value="0">Tidak</label>
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
            <label for="">Formulir diisi dan diTTD sesuai dokumen</label>
        <select name="formulir_TTD" class="form-control select2">
                  <option>Pilih salah satu</option>              
<option value="1">YA</option>
<option value="0">TIDAK</option>
              
                </select>
          </div> 
           <div class="form-group row">
            <div class="col-md-6">
                <label for="">Foto/Fotocopy KTP</label>
        <select name="fotocopy_ktp" class="form-control select2">
                  <option>Pilih salah satu</option>              
<option value="1">YA</option>
<option value="0">TIDAK</option>
              
                </select>
            </div>

             <div class="col-md-6">
 <label for="">Foto/Fotocopy KK</label>
        <select name="fotocopy_kk" class="form-control select2">
                  <option>Pilih salah satu</option>              
<option value="1">YA</option>
<option value="0">TIDAK</option>
              
                </select>
             </div>
            
          </div> 
             <div class="form-group row">
            <div class="col-md-6">
            <label for="">Foto/Fotocopy Slip Gaji</label>
           
  <select name="fotocopy_slip_gaji" class="form-control select2">
                  <option>Pilih salah satu</option>              
<option value="1">YA</option>
<option value="0">TIDAK</option>
              
                </select>
            </div>
             <div class="col-md-6">
                 <label for="">Status Rumah</label>
            <input class="form-control" type="text" name="status_rumah" autocomplete="off">

             </div>
          </div> 

            
              <div class="form-group row">
            <div class="col-md-6">
            <label for="">Analisis Keuangan</label>
            <input class="form-control" type="text" name="analisis_keuangan" autocomplete="off">

            </div>
             <div class="col-md-6">
                 <label for="">Tujuan Pembelian Sesuai</label>
            <select name="tujuan_pembelian_sesuai" class="form-control select2">
                  <option>Pilih salah satu</option>              
<option value="1">YA</option>
<option value="0">TIDAK</option>
              
                </select>

             </div>
          </div> 

             <div class="form-group">
                  <label for="">Catatan</label>
          <textarea cols="3" rows="3"  class="form-control" id="catatan_dok" name="catatan_dok" ></textarea>
              </div>
        </div>
           
             <div class="col-md-6">
  <div class="form-group">
                  <label for="">Alamat Sekarang</label>
          <textarea cols="3" rows="3"  class="form-control" id="alamat_sekarang" name="alamat_sekarang" ></textarea>
              </div>
       
          <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Lokasi</label>
         <input class="form-control"  name="lokasi" autocomplete="off">
            </div>         
  <div class="col-md-6">
                  <label for="">Denah Rumah</label>
         <input class="form-control" type="text" name="denah_rumah" autocomplete="off">
            </div>    

              </div>

              <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Kondisi Rumah</label>
         <input class="form-control" type="text"  name="kondisi_rumah" autocomplete="off">
            </div>         
  <div class="col-md-6">
                  <label for="">Kondisi Tempat Usaha</label>
         <input class="form-control"  type="text" name="kondisi_tempat_usaha" autocomplete="off">
            </div>    

              </div>
                <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Kondisi Tempat Kerja</label>
         <input class="form-control" type="text"  name="kondisi_tempat_kerja" autocomplete="off">
            </div>         
  <div class="col-md-6">
                  <label for="">Kondisi Tetangga</label>
         <input class="form-control"  type="text" name="kondisi_tetangga" autocomplete="off">
            </div>    

              </div>
                 <div class="form-group row">
            <div class="col-md-6">
                  <label for="">Karakter Keluarga</label>
         <input class="form-control" type="text"  name="karakter_keluarga" autocomplete="off">
            </div>         
  <div class="col-md-6">
                  <label for="">Pemakaian Objek Barang</label>
         <input class="form-control"  type="text" name="pemakaian_objek_barang" autocomplete="off">
            </div>    

              </div>

            </div>
          </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
             <div class="col-md-6">
                <div class="form-group">
            <label for="">FOTO Pelanggan</label>
        <input type="file" id="foto_pelanggan" name="foto_pelanggan" class="form-control">
          </div>  
             

           <div class="form-group row">
            <div class="col-md-12">
            <label for="">Foto KTP</label>
       <input type="file" id="foto_ktp" name="foto_ktp" class="form-control">

            </div>
           
          </div> 
         
              </div>
              <div class="col-md-6">
                 <div class="form-group row">
            <div class="col-md-6">
                    <label for="">Foto Dokumen Lain</label>
      <input type="file" id="foto_dl" class="form-control" name="foto_dl">

            </div>
            <div class="col-md-6">
               <label for="">Foto Dokumen Lain</label>
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
        <a href="<?php echo base_url('Hasil_survey')?>" class="btn btn-default pull-right"> Batal</a>
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

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-survey.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>