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
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Serah Barang</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Pelanggan</label>
            <select id="pelanggan" name="pelanggan" class="form-control select2">
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($pelanggan as $key => $val) { ?>
      <option value="<?php echo $val->id_pelanggan;?>" <?php echo $val->id_pelanggan == $id_pelanggan ? 'selected' : '' ?>><?php echo $val->id_pelanggan.' - '.$val->nama ?></option>
                  <?php }
                  ?>
                </select>
         
          </div>  
         
                <div class="form-group">
            <label for="">Photo Serah Barang</label>
        <input type="file" id="photo" name="photo" class="form-control">
        <input type="text" value="<?php echo $data->image ?>" name="file_foto">
          </div>  
       
      
     
        </div>
      </div>
  
         
    </div>
         <div class="box-footer">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <button type="submit" class="btn btn-primary pull-right">Ubah</button>
            </div>
          </div>
      </div>
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-handOver.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>