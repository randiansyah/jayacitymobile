<section class="content-header">
  <h1><?php echo $label;?></h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard');?>"> Dasbor</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section>
<section class="content">
  <div class="full-width padding">
  <div class="padding-top">
    <div class="row"> 
      <div class="col-md-12"> 
        <ul class="nav nav-tabs">
          <li class="active"><a href="<?php echo base_url('pengaturan');?>">Pengaturan</a></li>
          <li><a href="<?php echo base_url('pengaturan/jatuh_tempo');?>">Jatuh Tempo</a></li>
          <!-- <li><a href="<?php echo base_url('membership');?>">Paket Membership</a></li> -->
        </ul>   
        <div class="tab-content">
          <div id="commission" class="tab-pane fade in active">
            <div class="box box-primary" style="border:0">
              <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
                <div class="box-body">
                  <?php if(!empty($this->session->flashdata('message'))){?>
                    <div class="alert alert-info">
                    <?php   
                       print_r($this->session->flashdata('message'));
                    ?>
                    </div>
                  <?php } if(!empty($this->session->flashdata('message_error'))){?>
                    <div class="alert alert-danger">
                    <?php   
                       print_r($this->session->flashdata('message_error'));
                    ?>
                    </div>
                    <?php }?>         
                    <br>                                                      
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 control-label">Nama</label> 
                      <div class="col-sm-6">
                        <input type="tex" class="form-control" id="nama" name="nama" value="<?php echo $data->nama;?>">
                      </div>
                    </div>           
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 control-label">Telp</label> 
                      <div class="col-sm-6">
                       <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $data->no_telp;?>">
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label class="col-sm-3 control-label">Alamat Bank</label> 
                      <div class="col-sm-6">
                   <select class="form-control select2" name="bank" id="bank" value="<?php echo $data->id_bank ?>">
                    <?php foreach($bank as $bank_data){  ?>
                    <option value="<?php echo $bank_data->id ?>" <?php if($bank_data->id === $data->id_bank ){ echo 'selected';}else{ '';} ?>><?php echo $bank_data->no_akun." -  A/n  - ".$bank_data->nama_akun; ?></option>
              <?php
                    }
                    ?>
                   </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Alamat</label> 
                      <div class="col-sm-6">
                   <textarea name="alamat" class="form-control" rows="3" cols="30" id="alamat"  value="<?php echo $data->alamat; ?>"><?php echo $data->alamat ?></textarea>
                    </div>
                    </div>                                                                    
                </div> 
                <div class="box-footer pad-15 full-width bg-softgrey border-top bot-rounded">
                  <button type="submit" class="btn btn-primary pull-right mleft-15" id="save-btn">Ubah</button>
                </div>
              </form>
            </div>  
          </div>                
        </div>
      </div> 
    </div>
  </div>
</div>
</section>

<script data-main="<?php echo base_url()?>assets/js/main/main-config" src="<?php echo base_url()?>assets/js/require.js"></script>