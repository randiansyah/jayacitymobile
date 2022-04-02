<section class="content-header">
  <h1><?php echo $title;?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard');?>"> Dasbor</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section> 
<section class="content">
<!-- <div class="box box-bottom">
    <div class="box-header with-border">
    <h3 class="box-title">Pencarian <?php echo $title;?></h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">      
          <div class="form-group row">          
            <div class="col-sm-6">
                <label>Dari Tanggal</label>
                <input type="text" id="periode_start" name="periode_start" class="form-control date" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal">
            </div>
            <div class="col-sm-6">
                <label>Sampai Tanggal</label>
                <input type="text" id="periode_end" name="periode_end" class="form-control date" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal">
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
  </div>  -->
  <div class="col-md-12">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"> <?php echo $title;?></h3>
       <div class="datatableButton pull-right">
         <?php
           $getDate = $this->uri->segment(3);
           ?>
       <a href="<?php echo base_url('Laporan_dana_angsuran/angsuran_detail_pdf/').$getDate ?>" target="blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
              <?php if($this->data['is_can_create']){ ?>
        <?php } ?>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
      <div class="col-md-12"> 
          <table id="m_rekap_laporan" class="table table-striped table-bordered table-hover">
            <tbody>
             <tr>
                <td width="10%">Periode</td>
                <td><?php echo $start_date.' s/d '.$end_date;?></td>
             </tr>            
            </tbody>
          </table>
        </div>

        <div id="detail">
        <div class="col-md-12"> 
            <div class="table-responsive">
            <table class="table table-striped" id="table"> 
              <thead>
              <th>No</th> 
                <th>Tanggal</th> 
                <th>Nama</th>
                <th>cicilan Ke</th>
                <th>Sub Total</th> 
                <th>Total</th> 
              </thead> 
              <tbody>
                <?php $i=1; 
                 $totalnya = 0;
                foreach ($angsuran_detail as $key => $value){
                    $totalnya += $value["total"];
                    
                    ?>
                  <tr>
                  <td><?php echo $i; ?></td>
                    <td><?php echo date('d M Y', strtotime($value["date"]));?></td>
                    <td><?php echo $value['nama']; ?> </td>
                    <td><?php echo $value['cicilan']; ?> </td>
                    <td>Rp.<?php echo number_format($value["total"], 0, ".", ".")?></td>
                    <td>Rp.<?php echo number_format($totalnya, 0, ".", ".")?></td>
                  </tr>
                <?php
             $i++; 
            }
              ?>
              </tbody>      
            </table>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
        </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-laporan-angsuran.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>
