<section class="content-header">
  <h1><?php echo $title;?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard');?>"> Dasbor</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section> 
<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title">Data Menu</h3>
       <div class="datatableButton pull-right">      
        <?php if($this->data['is_can_create']){ ?>
          <a href="<?php echo base_url()?>menu/create_admin" class="btn btn-sm btn-primary">Tambah <?php echo "Data ".ucwords(str_replace("_"," ",$this->uri->segment(2)))?></a>
        <?php } ?>
      </div>
    </div>
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
                <th>Nama</th> 
                <th>Url</th> 
                <th>Induk</th> 
                <th>sequence</th> 
                <th>Icon</th>
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
  data-main="<?php echo base_url()?>assets/js/main/main-menu-admin.js" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>