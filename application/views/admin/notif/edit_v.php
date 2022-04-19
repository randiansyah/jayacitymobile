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
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Pengaturan Notif</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group"> 
  
          <div class="form-group">
            <label for="">Karyawan</label>
             <select  name="id_karyawan" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($karyawan as $key => $val) { ?>
      <option value="<?php echo $val->id;?>" <?php echo $val->id==$notif->id_karyawan ? 'selected' : '' ?>><?php echo $val->nama ?></option>
                  <?php }
                  ?>
                </select>
          </div>   
          <div class="form-group">
            <label for="">Merek</label>
             <select  name="id_merek" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($brand as $key => $val) { ?>
      <option value="<?php echo $val->id;?>" <?php echo $val->id==$notif->id_merek ? 'selected' : '' ?>><?php echo $val->name ?></option>
                  <?php }
                  ?>
                </select>
          </div>   
          <div class="form-group">
            <label for="">Type Notifikasi</label>
             <select  name="type" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <option value="1"<?php if('1'==$notif->tipe) { echo "selected"; } ?> >Jatuh Tempo</option>
                  <option value="2" <?php if('2'==$notif->tipe) { echo "selected"; } ?>>Pembayaran</option>
                 
                </select>
          </div>   
      
     
        </div>
      </div>
  
         
    </div>
         <div class="box-footer">
          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
              <button type="submit" class="btn btn-primary pull-right">ubah</button>
            </div>
          </div>
      </div>
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-brand.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>