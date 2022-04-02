<section class="content-header">
  <h1><?php echo $label; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url($this->uri->segment(1)); ?>"> <?php echo $label; ?></a></li>
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>  

<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Menu</h3>
    </div>
    <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
      <div class="box-body">
        <?php if (!empty($this->session->flashdata('message'))) { ?>
          <div class="alert alert-info">
            <?php
            print_r($this->session->flashdata('message'));
            ?>
          </div>
        <?php }
        if (!empty($this->session->flashdata('message_error'))) { ?>
          <div class="alert alert-danger">
            <?php
            print_r($this->session->flashdata('message_error'));
            ?>
          </div>
        <?php } ?>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-3 control-label text-right">Jenis</label>
          <div class="col-sm-6">
            <select id="parent_id" name="parent_id" class="form-control select2" value="<?php set_value("parent_id") ?>">
              <option value="1">Root</option>
              <?php
              $vendorData = "";
              foreach ($parent_id as $key => $val) { ?>
                <option value="<?php echo $val->id; ?>" <?php echo $val->parent_id == $vendorData ? 'selected' : '' ?>><?php echo $val->name ?></option>
              <?php }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-3 control-label text-right">Nama Menu</label>
          <div class="col-sm-6">
            <input class="form-control" id="menu_name" name="menu_name" placeholder="pengaturan" autocomplete="off" value="<?php set_value("menu_name") ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-3 control-label text-right">Url</label>
          <div class="col-sm-6">
            <input class="form-control" id="url" placeholder="" name="url" autocomplete="off" value="<?php set_value("url") ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-3 control-label text-right">Icon</label>
          <div class="col-sm-6">
            <input class="form-control" id="icon" placeholder="fa fa-circle-o" name="icon" autocomplete="off" value="<?php set_value("icon") ?>">
          </div>
        </div>

     
      </div>
      <div class="box-footer pad-15 full-width bg-softgrey border-top bot-rounded">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-primary pull-right mleft-0" id="save-btn">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-menu-admin.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>