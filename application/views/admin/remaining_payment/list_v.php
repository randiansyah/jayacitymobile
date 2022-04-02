

<section class="content">

  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-money"></i> Transaksi</h3>
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
            <table class="table table-bordered" id="table" width="100%"> 
              <thead>
               <th>PEMBELIAN</th> 
               <th >TAGIHAN</th> 
               <th >TERBAYAR</th> 
               <th >AKSI</th>
              </thead>        
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-remain.js" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>