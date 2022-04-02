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
    <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Pengeluaran Oprasional</h3>
    </div>
     <form id="finace_expense" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama</label>
            <input class="form-control"  name="name" type="text" autocomplete="Off" required>
          </div>  
        </div>
      </div>
         <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nominal</label>
            <input class="form-control harga" autocomplete="off" name="amount" autocomplete="off">
          </div>  
        </div>
      </div>

       <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="description" class="form-control" cols="2" rows="2"></textarea>
          </div>  
        </div>
      </div>

      <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Tipe</label>
              <select class="form-control filter-column" name="type">
                <option value="" selected>Tipe</option>
                <option value="1">Pemasukan</option>
                <option value="2">Pengeluaran Orasional</option>
                <option value="3">Tarik Uang (Bank)</option>
                <option value="4">Setor Uang (Bank)</option>
              </select>
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
  data-main="<?php echo base_url()?>assets/js/main/main-saldo.js" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>