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
    <h3 class="box-title"><i class="fa fa-tag"></i> Isi data penangguhan anda</h3>
    </div>
     <form id="karyawan" method="post" enctype="multipart/form-data">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group"> 
  
           <div class="form-group">
            <label for="">Nama Barang</label>
            <select name="nama_barang" class="form-control select2" id="nama_barang" value="<?php echo set_value("lama_cicilan") ?>">
                <option value="">Pilih</option>
                <?php
                foreach ($transaksi as $key => $val) { ?>
                  <option value="<?php echo $val->nama_barang; ?>"><?php echo $val->nama_barang; ?></option>
                <?php }
                ?>
              </select>
          </div>  
          <div class="form-group">
              <label for="">Angsuran Ke</label>
              <select name="cicilan" class="form-control select2" id="cicilan" required>
                <option value="">Pilih</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Pesan</label>
         <textarea name="text" class="form-control" width="50px" height="200px"></textarea>
            </div>
        </div>
      </div>
  
         
    </div>
         <div class="box-footer">
          <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
              <button type="submit" class="btn btn-primary pull-right">Kirim</button>
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