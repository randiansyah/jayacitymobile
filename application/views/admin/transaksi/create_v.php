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
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Pembelian barang baru</h3>
    </div>
     <form id="form-transaksi" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">NO. INVOICE </label>
            <input class="form-control" value="<?php echo $inv; ?>" name="no_invoice" autocomplete="off" value="<?php set_value("no_invoice") ?>" >
          </div>  
           <div class="form-group">
            <label for="">PELANGGAN</label>
             <select id="pelanggan" name="pelanggan" class="form-control select2" value="<?php set_value("pelanggan") ?>">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($pelanggan as $key => $val) { ?>
      <option value="<?php echo $val->id_pelanggan;?>"><?php echo $val->id_pelanggan.' - '.$val->nama ?></option>
                  <?php }
                  ?>
                </select>
          </div>   
           <div class="form-group">
            <label for="">TANGGAL PEMBELIAN</label>
            <input class="form-control datepicker" autocomplete="off" id="tgl_beli" name="tgl_beli"  value="<?php set_value("tgl_beli") ?>">
          </div>  
           <div class="form-group">
            <label for=""> NAMA BARANG</label>
         <input class="form-control" name="nama_barang"   autocomplete="off" value="<?php set_value("nama_barang") ?>">
          </div>   
              <div class="form-group">
            <label for="">MEREK</label>
            <select id="merek" name="merek" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($brand as $key => $val) { ?>
      <option value="<?php echo $val->id;?>"><?php echo $val->name ?></option>
                  <?php }
                  ?>
                </select>    
          </div> 
        
        </div>
      </div>
      <div class="col-md-4">
      <div class="form-group">
            <label for="">TIPE</label>
  <input class="form-control"  name="tipe"  autocomplete="off"  value="<?php set_value("tipe") ?>">            
          </div>
      <div class="form-group">
            <label for="">WARNA</label>
            <input class="form-control" name="warna" autocomplete="off"  value="<?php set_value("warna") ?>">
          </div>
  <div class="form-group">
            <label for="">SN</label>
            <input class="form-control"  name="sn" autocomplete="off"  value="<?php set_value("sn") ?>">
          </div>
           <div class="form-group">
            <label for="">IMEI 1</label>
            <input class="form-control" autocomplete="off" name="imei1" autocomplete="off"  value="<?php set_value("imei1") ?>">
          </div>
            <div class="form-group">
            <label for="">IMEI 2</label>
         <input class="form-control" autocomplete="off" name="imei2" autocomplete="off"  value="<?php set_value("imei2") ?>">
          </div>
        

         
          </div>
          <div class="col-md-4">
             
             <div class="form-group">
            <label for="">HARGA JUAL</label>
           <input class="form-control harga" autocomplete="off" name="harga_jual" autocomplete="off"  value="<?php set_value("harga_jual") ?>">
          </div>
          <div class="form-group">
           <label for="">LAMA CICILAN</label>
         <select name="lama_cicilan" class="form-control select2" id="lama_cicilan"  value="<?php set_value("lama_cicilan") ?>">
           <option>Pilih</option>
            <?php
                  foreach ($lama_cicilan as $key => $val) { ?>
      <option value="<?php echo $val->id_cicilan;?>"  value="<?php set_value("lama_cicilan") ?>"><?php echo $val->nama ?> / Bulan</option>
                  <?php }
                  ?>
         </select>
          </div>
          <div class="form-group">
           <label for="">TANGGAL JATUH TEMPO</label>
 <input class="form-control datepicker" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" value="<?php set_value("tgl_jatuh_tempo") ?>">
          </div>
           <div class="form-group">
           <label for="">NAMA TOKO</label>
        <input class="form-control" id="nama_toko" name="nama_toko"  value="<?php set_value("nama_toko") ?>">
          </div>


           <div class="form-group">
           <label for="">User input</label>
      <input class="form-control" type="hidden" value="<?php echo $this->data['users']->id;?>" id="user_input" name="user_input">

          <input class="form-control" value="<?php echo $this->data['users']->username;?>"autocomplete="off" readonly>
          </div>
           <div class="form-group">
           <label for="">Waktu input</label>
          <input class="form-control" value="<?php echo $waktu_input; ?>" id="waktu_input" name="waktu_input" autocomplete="off" readonly="">
          </div>
          </div>
    </div>
         <div class="box-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
              <a href="<?php  echo base_url() ?>/Transaksi" class="btn btn-default pull-right">Batal</a>

                </div>
          </div>
      </div>
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-transaksi.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>