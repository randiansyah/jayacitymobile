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
        <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama Akun</label>
            <input class="form-control"  name="nama_akun" type="text" autocomplete="off" required>
          </div>  
        </div>
      </div>
         <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">No Akun</label>
            <input class="form-control" name="no_akun" type="number" autocomplete="off" required>
          </div>  
        </div>
      </div>
         <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama Bank</label>
            <input class="form-control"  name="nama_bank" type="text" autocomplete="off" required>
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
  data-main="<?php echo base_url()?>assets/js/main/main-rekening.js" 
  src="<?php echo base_url()?>assets/js/require.js">
</script>