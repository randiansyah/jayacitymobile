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
      <h3 class="box-title">Pencarian Produk</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
          <div class="col-sm-6">
              <label>INVOICE</label>
              <input type="text" id="invoice" name="invoice" class="form-control" placeholder="Masukan Invoice">
          </div> 
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
        <div class="col-md-6">
          <div class="form-group row">
          <div class="col-sm-6">
              <label>Lama Cicilan</label>
               <select name="lama_cicilan" class="form-control select2" id="lama_cicilan"  >
           <option value="">Pilih</option>
            <?php
                  foreach ($lama_cicilan as $key => $val) { ?>
      <option value="<?php echo $val->id_cicilan;?>"><?php echo $val->nama ?> / Bulan</option>
                  <?php }
                  ?>
         </select>
          </div> 
          <div class="col-sm-6">
              <label>Tgl Jatuh Tempo</label>
              <input class="form-control datepicker" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" autocomplete="off">
 
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
        <a href="<?php echo base_url()?>Transaksi/create" class="btn btn-sm btn-primary"><i class='fa fa-plus'></i> <?php echo ucwords(str_replace("_"," ",$this->uri->segment(1)))?></a>
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
               <th>INVOICE</th> 
               <th>ID</th> 
               <th>NAMA</th> 
               <th>NAMA BARANG</th> 
               <th>HARGA JUAL</th> 
                <th>LAMA CICILAN</th> 
               <th>TGL JATUH TEMPO</th> 
               <th width="150">STATUS</th>
              </thead>        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-transaksi" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>