<section class="content-header">
  <h1>
    <?php echo ucwords(str_replace("_"," ",$this->uri->segment(1)))?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucwords(str_replace("_"," ",$this->uri->segment(1)))?></li>
  </ol>
</section>

<section class="content">
<div class="box box-bottom">
    <div class="box-header with-border">
      <h3 class="box-title">Pencarian</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
        
          <div class="col-sm-6">
              <label>Nama Pelanggan</label>
             <select id="pelanggan" name="pelanggan" class="form-control select2" >
                  <option value="" required>Pilih salah satu</option>
                  <?php
                  foreach ($pelanggan as $key => $val) { ?>
      <option value="<?php echo $val->id_pelanggan;?>"><?php echo $val->id_pelanggan.' - '.$val->nama ?></option>
                  <?php }
                  ?>
                </select>
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
    <h3 class="box-title"><i class="fa fa-tag"></i> <?php echo ucwords(str_replace("_"," ",$this->uri->segment(1)))?></h3>
    <div class="col-sm-1 datatableButton pull-right">
      <div class="row">
        <?php if($this->data['is_can_create']){?>
          <?php 
      }
      ?>
      </div>
    </div>
    </div>
    <div class="box-body">
    <div class="box-header">
      
    </div>
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
              <th>#</th>
               <th>NAMA</th> 
               <th>JUMLAH PEMBELIAN BARANG</th> 
              </thead>        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-laporan-transaksi" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>