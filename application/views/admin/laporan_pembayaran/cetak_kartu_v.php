<html><head>
  <title>Kartu Angsuran</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .trPad {
      padding-bottom: 5px;
      padding-top: 5px;
    }

    .tglDisepakati {
     text-align: right;
     font-size: 12px;
      font-weight: 550;
      color: #000;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }

    .pertama {
      width: 150px;

    }
    .pembeli {
      width: 200px;
      font-size: 12px;
      font-weight: 550;
      color: #000;
      padding-left: 40px;
      padding-top: -30px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }
    
    .ttd1 {
      width: 200px;
      height: 70px;
      font-size: 12px;
      font-weight: 550;
      color: #000;
      padding-left: 14px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }
    .ttd2 {
      width: 200px;
      font-size: 12px;
      font-weight: 550;
      color: #000;
      padding-left: 14px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }
    .ttd3 {
      width: 200px;
      font-size: 12px;
      font-weight: 550;
      color: #000;
      padding-left: 12px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }

    .keterangan {
      font-size: 12px;
      font-weight: 550;
      color: #000;
      padding-left: 12px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;

    }
    .keterangan1 {
      font-size: 12px;
      font-weight: 550;
      color: #000;
      padding-left: 14px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;

    }

    .fonttable {
      font-size: 12px;
      font-weight: 550;
      color: #000;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }

    .hrFont {
      width: 512px;
      border-bottom: dotted 1px black;
    }

    .kedua {
      width: 300px;
      color: #000;
      font-size: 20px;
      font-weight: 700;
      text-align: center;
      padding-left:175px;
    }

    .ketiga {
      width: 150px;
    }
 .table-dark{
   border: 1px;
 }
 .table1{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent;border: 1px #000;}
 .table1 td{padding: .1rem;},
 .table1 th{padding:.75rem;vertical-align:top;border-top:1px solid #000}
 .table1 thead th{vertical-align:bottom;border-bottom:1px solid #000}
 .table1 tbody+tbody{border-top:1px solid #000}
 .table1 
 .table1{background-color:#fff}
 .table1-sm td,.table1-sm th{padding:.3rem}
  </style>
</head><body>
  <table>
    <thead>
      <tr>
        <th class="pertama"></th>
        <th class="kedua">SURAT PERJANJIAN KREDIT<br> TOKO CITYMOBILE
        </th>
        <th class="ketiga"></th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
  <br>

  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-success">
      <div class="box-header with-border">
      </div>
      <!-- /.box-header -->
      <!-- form start -->

      <form class="form-horizontal">
        <div class="box-body">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Saya yang bertanda tangan di bawah ini menyatakan :</label>

          </div>
          <table>
            <thead>
            </thead>
            <tbody>
              <tr class="trPad">
                <td class="pertama fonttable trPad">NAMA</td>
                <td class="fonttable hrFont trPad">: <?php echo $akad->nama ?> </td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">NO TELP/WA</td>
                <td class="fonttable hrFont trPad">: <?php echo $akad->no_telp ?></td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">ALAMAT</td>
                <td class="fonttable hrFont trPad">: <?php echo $akad->alamat_sekarang ?></td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">TYPE PESANAN</td>
                <td class="fonttable hrFont trPad">: <?php echo $transaksi->nama_barang ?>  </td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">NO.SERI IMEI</td>
                <td class="fonttable hrFont trPad">: <?php echo $transaksi->imei1 ?>   </td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">UANG MUKA</td>
                <td class="fonttable hrFont trPad">: Rp.<?php echo number_format($akad->uang_muka,0,'.',',')  ?> </td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">LAMA KREDIT</td>
                <td class="fonttable hrFont trPad">: <?php echo $akad->lama_cicilan ?> Bulan</td>

              </tr>
              <tr>
                <td class="pertama fonttable trPad">ANGSURAN/BULAN</td>
                <?php
                $tes = ($akad->total / $akad->lama_cicilan);
                ?>
                <td class="fonttable hrFont trPad">: Rp.<?php echo number_format($angsuran[0]->jumlah_cicilan,0,'.',',') ?> </td>

              </tr>
            </tbody>
          </table>
          <div class="form-group">
            <label for="inputEmail3" class="keterangan trPad">Apabila dikemudian hari, saya tidak dapat memenuhi kewajiban saya untuk melunasi / membayar KREDIT tersebut,
              <br>maka pihak marketing / agent berhak untuk menarik kembali type / jenis barang tersebut.
            </label><br>
            <label for="inputEmail3" class="keterangan1">SYARAT KETERLAMBATAN :</label><br>
            <label for="inputEmail3" class="keterangan">Pembayaran paling lambat 3(tiga) hari setelah tanggal jatuh tempo, jika terjadi keterlambatan membayar,
              <br>maka akan dikenakan DENDA sebesar Rp. 3.000/ perhari keterlambatan, maksimal keterlambatan 10 hari setelah tanggal jatuh tempo, maka barang tersebut akan kami tarik.
              <br>Demikian surat perjanjian ini beserta ketentuan yang telah disepakati dan di setujui oleh pihak kedua tanpa unsur paksaan dari pihak manapun.
            </label>

          </div>
          <div class="form-group">
            <label for="inputEmail3" class="tglDisepakati">Tanjung Batu,
               <?php 
            if(!empty($akad->tgl_akad)){
            $tglAkad =date("d M Y", strtotime($akad->tgl_akad));
          }else{
          $tglAkad ='';
          }
          echo $tglAkad; ?></label>

          </div>
          <table>
    <thead>
      <tr>
        <th class="ttd1">PIHAK KEDUA II</th>
        <th class="ttd2">PIHAK PERTAMA I</th>
        <th class="ttd3">PIHAK KETIGA III</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td class="ttd1">(..........................)</td>
        <td class="ttd1">(..........................)</td>
        <td class="ttd3">(..........................)</td>
      </tr>
      <tr>
        <td class="pembeli">Pembeli</td>
        <td class="pembeli">Penjual</td>
      </tr>
    </tbody>
  </table>
        </div>

      </form>
    </div>
  </div>
  <table class="table1">
    <thead>
      <tr>
        <th scope="col">NO</th>
        <th scope="col">JAM SETOR</th>
        <th scope="col">TANGGAL SETOR</th>
        <th scope="col">NILAI PEMBAYARAN</th>
        <th scope="col">TELLER</th>
        <th scope="col">Paraf</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1;

      $total_bayar = 0;
      foreach ($angsuran as $data => $val) {
      ?>

        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $val->pay_time; ?></td>
          <td><?php
          if(!empty($val->tgl_bayar)){
            $tgl =date("d M Y", strtotime($val->tgl_bayar));
          }else{
          $tgl ='';
          }
          echo $tgl; ?></td>
        
          <td><?php echo "Rp. " . number_format($val->jumlah_bayar, 2, ",", ".") ?></td>
          <td><?php echo $val->teller; ?></td>
          <td></td>
        

        </tr>
      <?php $i++;
      }
      ?>
    </tbody>
  </table>

</body></html>