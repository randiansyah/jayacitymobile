<section class="content-header">
  <h1>
  Ubah Harga Angsuran
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Ubah Harga Angsuran</li>
  </ol>
</section>

<section class="content">

  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i>Ubah Harga Angsuran</h3>
      <div class="col-sm-2 datatableButton pull-right">
        <div class="row">
    
        </div>
      </div>
    </div>
    <form id="form-akad" method="post" enctype="multipart/form-data">
    <div class="box-body">

      <input type="hidden" name="nomor_akad" id="nomor_akad" value="<?php echo $akad->nomor_akad ?>">
       <input type="hidden" name="id_invoice" id="id_invoice" value="<?php echo $akad->id_invoice ?>">
      <input type="hidden" name="id_akad" id="id_akad" value="<?php echo $akad->id_akad ?>">

      <!-- Main content -->
      <section class="invoice">
        <hr>
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped ">
              <thead>
                <tr>
                  <th>KE</th>
                  <th>JATUH TEMPO</th>
                  <th>ANGSURAN</th>
               
                </tr>
              </thead>
              <tbody>

                <?php
                if (!empty($angsuran)) {
                  $i = 1;

              
                  foreach ($angsuran as $data => $val) {
                  

            
                    
                ?>

                    <tr>
                      <td><?php echo $val->cicilan ?></td>
                      <input type="hidden" class="no numeric" name="no[]" value="<?php echo $i; ?>" id-tr="<?php echo $i; ?>">
                      <input type="hidden" name="id_angsuran[]" value="<?php echo $val->id_angsuran; ?>">
                    <td>

                      <input type="text" class="form-control datepicker" autocomplete="off" name="tgl_bayar[]" value="<?php echo date("d-m-Y", strtotime($val->tgl_jatuh_tempo)); ?>">

                    </td>
                      <td>

                          <input type="text" class="form-control harga" name="bayar[]" autocomplete="off" value="<?php echo"Rp. " . number_format($val->jumlah_cicilan, 0, ",", ".") ?>">
        
                        </td>
                   
                    </tr>
                <?php $i++;
                  }
                } else {
        
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

 
        <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
            <div class="col-xs-12">
            <button type="submit" class="btn btn-primary pull-right">Ubah</button>

            </div>
          </div>

      </section>
    </div>
            </form>
  </div>
  </div>
 
  <!-- End Modal Edit Product-->
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-angsuran.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>