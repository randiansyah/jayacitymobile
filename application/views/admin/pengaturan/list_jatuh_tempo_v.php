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
        <li ><a href="<?php echo base_url('pengaturan');?>">Pengaturan</a></li>
          <li class="active"><a href="<?php echo base_url('pengaturan/jatuh_tempo');?>">Jatuh Tempo</a></li>
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
                      <label for="inputEmail3" class="col-sm-3 control-label">Set Hari sebelum jatuh Tempo</label> 
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="set_hari" name="set_hari" value="<?php echo $data->set_hari;?>">
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