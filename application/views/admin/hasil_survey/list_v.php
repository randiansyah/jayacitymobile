<section class="content">
<div class="box box-bottom">
    <div class="box-header with-border">
      <h3 class="box-title">Pencarian Produk</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
          <div class="col-sm-6">
              <label>Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Pelanggan">
          </div> 
          <div class="col-sm-6">
              <label>KTP</label>
              <input type="numeric" id="ktp" name="ktp" class="form-control" placeholder="KTP">
          </div> 
          </div>
     
        </div>
      
        <div class="col-sm-12">
          <div class="form-group text-right">
            <a href="#" class="btn btn-sm btn-primary" id="search"><i class="fa fa-search"></i> PENCARIAN</a>
            <a href="#" class="btn btn-sm btn-danger" id="reset"><i class="fa fa-refresh"></i> RESET</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title">Hasil Survey</h3>
       <div class="datatableButton pull-right">
        <!--
       <a href="<?php //echo base_url('Pelanggan/exportCSV')?>" class="btn btn-sm btn-warning" ><i class="fa fa-download"></i> Export CSV</a>
     -->
             <?php if($this->data['is_can_create']){?>
        <a href="<?php echo $this->uri->segment(1)?>/create" class="btn btn-sm btn-primary">Tambah Survey</a>
        <?php 
}
?>
    </div></div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12"> 
            <div class="table-responsive">
            <?php if(!empty($this->session->flashdata('message'))){?>
            <div class="alert alert-info">
            <?php   
               print_r($this->session->flashdata('message'));
            ?>
            </div>
            <?php }?> 
             <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-info">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?> 
            <table class="table table-striped" id="table"> 
              <thead>
                <th width="5">No. </th>
                <th width="5">ID Survey</th>
                <th>Nama</th> 
                <th>KTP</th> 
                <th>Tanggal Buat</th> 
               <th>Di setujui ke pembelian barang</th> 
                <th>Aksi</th>
              </thead>        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-survey.js" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>