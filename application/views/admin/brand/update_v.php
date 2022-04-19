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
    <h3 class="box-title"><i class="fa fa-tag"></i> Ubah Merek</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama</label>
            <input class="form-control" value="<?php echo $data[0]->name; ?>" name="name" type="text" autocomplete="off" required>
          </div>  
      
     
        </div>
      </div>
  
         
    </div>
         <div class="box-footer">
          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
              <button type="submit" class="btn btn-primary pull-right">Ubah</button>
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