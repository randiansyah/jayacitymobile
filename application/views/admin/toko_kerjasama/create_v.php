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
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Rekening Bank</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama Toko</label>
            <input class="form-control"  name="nama_toko" type="text" autocomplete="disabled" required>
          </div>  
        </div>
      </div>
         <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama pemilik data survei</label>
            <input class="form-control" name="nama_pemilik" type="text" autocomplete="disabled" required>
          </div>  
        </div>
      </div>
         <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Tgl Gabung</label>
            <input class="form-control"  name="tgl_gabung" value="<?php echo date('d-m-Y'); ?>" type="text" readonly>
          </div>  
        </div>
      </div>

       <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Alamat</label>
            <textarea name="alamat" class="form-control" cols="2" rows="2"></textarea>
          </div>  
        </div>
      </div>
  
         
    </div>
         <div class="box-footer">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </div>
      </div>
    </form>
  </div>
</section>

              

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-kerjasama.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>