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
    <h3 class="box-title"><i class="fa fa-tag"></i> Edit Pengeluaran Oprasional</h3>
    </div>
     <form id="finace_expense" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama</label>
            <input class="form-control"  name="name" type="text" autocomplete="Off" value="<?php echo $data->name ?>">
          </div>  
        </div>
      </div>
         <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nominal</label>
            <input class="form-control harga" name="amount" autocomplete="off" value="<?php echo "Rp. ".number_format($data->amount,0,",",".") ?>">
          </div>  
        </div>
      </div>

       <div class="col-md-6">
          <div class="form-group"> 
           <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="description" class="form-control" cols="2" rows="2" value="<?php echo $data->description ?>"><?php echo $data->description ?></textarea>
          </div>  
        </div>
      </div>

      <div class="col-md-6">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Tipe</label>
            <input 
              class="form-control"  
              name="name" type="text" autocomplete="Off" 
              value="
              <?php if($data->type == 1) {
                  echo 'pemasukan';
              } elseif ($data->type == 2) {
                  echo 'pengeluaran';
              } elseif ($data->type == 3) {
                  echo 'Tarik Uang (Bank)';
              } else {
                  echo 'Setor Uang (Bank)';
              }  ?>
              " 
              readonly
            >
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