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
    <h3 class="box-title"><i class="fa fa-tag"></i> Ubah Pembelian barang baru</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">NO. INVOICE </label>
            <input class="form-control" value="<?php echo $data->id_invoice ?>" name="no_invoice" autocomplete="off" required>
          </div>  
           <div class="form-group">
            <label for="">PELANGGAN</label>
             <select id="pelanggan" name="pelanggan" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($pelanggan as $key => $val) { ?>
      <option value="<?php echo $val->id_pelanggan;?>" <?php echo $val->id_pelanggan==$data->id_pelanggan ? 'selected' : '' ?>><?php echo $val->id_pelanggan ?></option>
                  <?php }
                  ?>
                </select>
          </div>   
           <div class="form-group">
            <label for="">TANGGAL PEMBELIAN</label>
            <input class="form-control datepicker"  value="<?php echo date("d-m-Y", strtotime($data->tgl_beli)); ?>" id="tgl_beli" name="tgl_beli" required>
          </div>  
           <div class="form-group">
            <label for=""> NAMA BARANG</label>
         <input class="form-control" name="nama_barang"  value="<?php echo $data->nama_barang ?>">
          </div>   
              <div class="form-group">
            <label for="">MEREK</label>
            <select id="merek" name="merek" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($brand as $key => $val) { ?>
      <option value="<?php echo $val->id;?>" <?php echo $val->id==$data->merek ? 'selected' : '' ?>><?php echo $val->name ?></option>
                  <?php }
                  ?>
                </select>       
          </div> 
           <div class="form-group">
            <label for="">TIPE</label>
  <input class="form-control"  name="tipe"  value="<?php echo $data->tipe ?>">            
          </div>
      <div class="form-group">
            <label for="">WARNA</label>
            <input class="form-control" name="warna" autocomplete="off"  value="<?php echo $data->warna ?>">
          </div>
        </div>
      </div>
      <div class="col-md-4">
   
  <div class="form-group">
            <label for="">SN</label>
            <input class="form-control"  name="sn" autocomplete="off"  value="<?php echo $data->sn ?>">
          </div>
           <div class="form-group">
            <label for="">IMEI 1</label>
            <input class="form-control" autocomplete="off" name="imei1" autocomplete="off"  value="<?php echo $data->imei1 ?>">
          </div>
            <div class="form-group">
            <label for="">IMEI 2</label>
         <input class="form-control" autocomplete="off" name="imei2" autocomplete="off"  value="<?php echo $data->imei2 ?>">
          </div>
          <div class="form-group">
            <label for="">NO. LAINNYA</label>
          <input class="form-control" autocomplete="off" name="lainnya" autocomplete="off"  value="<?php echo $data->no_lainnya ?>">
          </div>
 <div class="form-group">
            <label for="">KETERANGAN BARANG</label>
           <textarea cols="4" rows="5" class="form-control" name="keterangan"  value="<?php echo $data->keterangan ?>"><?php echo $data->keterangan ?></textarea>
          </div>
                <div class="form-group">
            <label for="">ADMIN</label>
      <input class="form-control" autocomplete="off" name="admin" autocomplete="off"  value="<?php echo $data->admin ?>">
          </div>
         
          </div>
          <div class="col-md-4">
               <div class="form-group">
            <label for="">HARGA PARTAI</label>
   <input class="form-control harga" autocomplete="off" name="harga_partai" autocomplete="off" required  value="<?php echo number_format($data->harga_partai,0,',','.') ?>">
          </div>
          
            <div class="form-group">
            <label for="">HARGA RETAIL</label>
      <input class="form-control harga" autocomplete="off" name="harga_retail" autocomplete="off" required  value="<?php echo number_format($data->harga_retail,0,',','.') ?>">
          </div>
             <div class="form-group">
            <label for="">HARGA JUAL</label>
           <input class="form-control harga" autocomplete="off" name="harga_jual" autocomplete="off" required  value="<?php echo number_format($data->harga_jual,0,',','.') ?>">
          </div>
          <div class="form-group">
           <label for="">LAMA CICILAN</label>
         <select name="lama_cicilan" class="form-control select2" id="lama_cicilan">
           <option>Pilih</option>
            <?php
                  foreach ($lama_cicilan as $key => $val) { ?>
      <option value="<?php echo $val->id_cicilan;?>" <?php echo $val->id_cicilan==$data->id_cicilan ? 'selected' : '' ?>><?php echo $val->nama ?> / Bulan</option>
                  <?php }
                  ?>
         </select>
          </div>
          <div class="form-group">
           <label for="">TANGGAL JATUH TEMPO</label>
 <input class="form-control datepicker" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" value="<?php echo date("d-m-Y", strtotime($data->tgl_jatuh_tempo)) ?>">
          </div>
           <div class="form-group">
           <label for="">NAMA TOKO</label>
        <input class="form-control" id="nama_toko" name="nama_toko" value="<?php echo $data->nama_toko?>">
          </div>


           <div class="form-group">
           <label for="">User input</label>
      <input class="form-control" type="hidden" value="<?php echo $this->data['users']->id;?>" id="user_input" name="user_input">

          <input class="form-control" value="<?php echo $this->data['users']->first_name;?>"autocomplete="off" readonly>
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
              <button type="submit" class="btn btn-primary pull-right">Ubah</button>

              <a href="<?php  echo base_url() ?>/Transaksi" class="btn btn-default pull-right">Batal</a>

            </div>
          </div>
      </div>
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-transaksi" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>