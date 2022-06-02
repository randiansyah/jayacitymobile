<section class="content-header">
<div class="row no-print">
            <div class="col-xs-12">
              <a href="<?php echo base_url($this->uri->segment(1)) ?>" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>


            </div>
          </div>
</section>

<section class="content">

  <div class="box box-default color-palette-box">
 
    <form id="angsuran" method="post" enctype="multipart/form-data">
      <div class="box-body">

        <input type="hidden" name="nomor_akad" id="nomor_akad" value="<?php echo $akad->nomor_akad ?>">
        <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo $akad->id_pelanggan ?>">
        <input type="hidden" name="id_invoice" id="id_invoice" value="<?php echo $akad->id_invoice ?>">
        <input type="hidden" name="id_akad" id="id_akad" value="<?php echo $akad->id_akad ?>">
        <!-- Main content -->
        <div class="col-xs-12 table-responsive">
       
       <h4 class="box-title">DATA PELANGGAN</h3>
       <div class="form-group">
              <div class="col-md-8">
                <div class="form-group row">
                  <table class="table table-bordered">
                    <tr>
                      <td> <div class="col-md-6"> <label for="">NAMA</label></div></td>
                      <td><div class="col-md-6">: <?php echo $pelanggan->nama; ?></div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">NO TELP/WA</label></div></td>
                      <td><div class="col-md-6">: <?php echo $pelanggan->no_telp; ?></div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">ALAMAT</label></div></td>
                      <td><div class="col-md-6">: <?php echo $pelanggan->alamat; ?></div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">TYPE PESANAN</label></div></td>
                      <td><div class="col-md-6">: <?php echo $transaksi->nama_barang ?> </div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">NO.SERI IMEI</label></div></td>
                      <td><div class="col-md-6">: <?php echo $transaksi->imei1 ?></div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">UANG MUKA</label></div></td>
                      <td><div class="col-md-6">: <?php echo $akad->uang_muka ?></div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">LAMA KREDIT</label></div></td>
                      <td><div class="col-md-6">: <?php echo $akad->lama_cicilan; ?> Bulan</div></td>
                    </tr>
                    <tr>
                      <td> <div class="col-md-6"> <label for="">ANGSURAN/BULAN</label></div></td>
                      <td><div class="col-md-6">: <?php
                $tes = ($akad->total / $akad->lama_cicilan);
                ?>
                 Rp. <?php echo number_format($tes,0,'.',',') ?></div></td>
                    </tr>
                  </table>
                 
                </div>
               
             
       </div>
</div>

            <div class="col-xs-12 table-responsive">
       
      <h4 class="box-title">RINCIAN PEMBAYARAN</h3>
    
 
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th width="50">KE</th>
                    <th>JATUH TEMPO</th>
                    <th>TAGIHAN</th>
                    <th>DENDA</th>
                    <th>DISKON</th>
                    <th>TOTAL</th>
                    <th>JAM SETOR</th>
                    <th>TGL SETOR</th>
                    <th>NILAI PEMBAYARAN</th>
                    <th>TELLER</th>
                    <th >CETAK</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  $total_bayar = 0;
                  $total_denda = 0;
                  $total_diskon = 0;
                  foreach ($angsuran as $data => $val) {
                    if ( strval($val->teller) !== strval(intval($val->teller)) ) {
                      $teller = $val->teller;
                    }else {
            
                      $getKaryawan = $karyawan->getAllById(array("id" => $val->teller));
                      $teller = (!empty($getKaryawan)) ? $getKaryawan[0]->nama : "";
                    }

                    $total_bayar += $val->jumlah_bayar;
                 
                    $sisa = $val->jumlah_cicilan  - $val->jumlah_bayar;
                    $id = $val->id_angsuran;
                    $total_denda += $val->denda ;
                    $total_diskon += $val->diskon ;

                    if ($val->status == 0 && $val->selisih > 4) {
                      $totalDiskon = ((int)$val->jumlah_cicilan * 3/100);
                    } else {
                      $totalDiskon = $val->diskon;
                    }

                    if ($val->status == 0 && $val->selisih < 1) {
                      
                      $styleDenda = "background-color: #2c3e50;color: #fff;";
                      $nominalDenda = "3000";
                      $total = str_replace("-", "", $nominalDenda * $val->selisih);
                      $denda = str_replace("-", "", $val->selisih) . " Hari ";
                      $totalnya =  $val->jumlah_cicilan +  $total - (int)$totalDiskon;
                    } else {
                      $denda = "";
                      $total = $val->denda;
                      $styleDenda = "";
                      $totalnya =  $val->jumlah_cicilan +  $val->denda - (int)$totalDiskon ;
                    }
                  
                  ?>

                    <tr style="<?php echo $styleDenda; ?>">
                          <td><?php echo $val->cicilan ?></td>

                     <?php if ($val->status == 1) {
                        $readonly = "readonly";
                        $style = "color: #00a65a;";
                        $tgl_jatuh_tempo1 = "lunas";
                      } else {
                        $readonly = "";
                        $tgl_jatuh_tempo1 = date("d M Y", strtotime($val->tgl_jatuh_tempo));
                        $style = "";
                      }
                     if ($val->jumlah_bayar == 0) {
                     $buy = "";
                     $print ="";
                     }else if($val->jumlah_bayar == null){
                     $buy = "";
                     $print ="";
                     } else{
                    $buy = "Rp. " . number_format($val->jumlah_bayar, 2, ",", ".");
                    $link = base_url() . "Remaining_payment/pdf/" . $id;
                    $print = '<a href="'.$link.'" target="_blank" class="btn btn-danger white" ><i class="fa fa-print"></i></a>';
                     }


                      ?>
                      <td>
                        <p <?php echo $readonly; ?> style="<?php echo $style ?>"><?php echo $tgl_jatuh_tempo1 ?></p>
                      </td>
                      <td><?php echo "Rp. " . number_format($val->jumlah_cicilan, 2, ",", ".") ?></td>
                      <td>
                        <?php echo "Rp. " . number_format((int)$total, 0, ",", "."); ?>
                      </td>
                      <td>
                      <?php echo "Rp. " . number_format((int)$totalDiskon, 0, ",", "."); ?>
                      </td>
                      <td><?php echo "Rp. " . number_format((int)$totalnya, 0, ",", ".") ?></td>
                      
                     <td><?php echo $val->pay_time; ?></td>
                     <td><?php echo $val->tgl_bayar; ?></td>

                     <td><?php echo $buy; ?></td>

                     <td><?php echo $teller; ?></td>
                     <td><?php echo $print; ?></td>
                   


                    </tr>
                  <?php $i++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
        

       
          <div class="col-xs-12 table-responsive">
       
       <h4 class="box-title">TOTAL ANGSURAN SAAT INI</h3>
     
  
               <table class="table table-bordered">
                 <thead class="thead-dark">
                   <tr>
                     <th>Jumlah Terbayar</th>
                     <th>Sisa Pembayaran</th>
                   </tr>
                 </thead>
                 <tbody>
                  
 
                     <tr>
                     <td><?php echo "Rp." . number_format($total_bayar, 2, ",", ".") ?></td>
       <td><?php $sisa_tagihan = $akad->total - $total_bayar + (int)$total_denda - (int)$total_diskon;
                        echo "Rp." . number_format($sisa_tagihan, 2, ",", ".");
                        ?></td>
 
                     </tr>
                 
                 </tbody>
               </table>
             </div>
    
          <!-- /.row -->

          <!-- this row will not appear when printing -->
       
    
      </div>
      <!-- <div class="col-xs-12 table-responsive">
   
       <h4 class="box-title">PEMBAYARAN</h3>
       <a href="<?php echo base_url('History_pembayaran/step1/').$val->id_akad ?>"> <button type="button" class="btn btn-success btn-lg btn-block">Bayar Sekarang</button>
    </a>
                </div> -->
    </form>
         
 
  </div>
  </div>
</section>
<script data-main="<?php echo base_url() ?>assets/js/main/main-remain.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>