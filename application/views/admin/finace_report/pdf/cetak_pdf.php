<html>

<head>
    <title>Laporan Pengeluaran oprasional</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
  <!-- Theme style -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin.min.css"> 
   <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css">
    <style>
        /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        #header {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="row" id="header">
            <div class="col-md-12">
                <img src="assets/images/logo-smart2.png" width="30%">
                <h6><b> <?php echo $pengaturan->alamat ?> HP :<?php echo $pengaturan->no_telp ?>

                    </b> </h5>
                    <br>
                    <hr style="width:90%;margin-top:5px;height:3px;border-width:0;color:#019934;background-color:#019934;">


            </div>
        </div>

        <br>
    </header>

    <footer>

    </footer>
    <main>
        <br>
    

        <div class="row">
        <div class="col-md-12"> 
            <div class="table-responsive">
            <table class="table table-striped" id="table"> 
              <thead>
                  <tr>
                    <th width="5">No.</th>
                    <th>Nama</th>
                    <th>Amount</th>
                    <th>Deskripsi</th>
                    <th>Tipe</th>
                    <th>Dibuat Pada</th>
                  </tr>
              </thead> 
              <tbody>
                <?php
                foreach ($data as $key => $value){
                    
                    ?>
                  <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['name'];?></td>
                    <td><?php echo $value['amount']; ?> </td>
                    <td><?php echo $value['description']; ?> </td>
                    <td><?php echo $value['type']; ?> </td>
                    <td><?php echo date('Y-m-d', strtotime($value['created_at'])) ?> </td>
                  </tr>
                <?php
            }
              ?>
              </tbody>      
            </table>
          </div>
        </div>
        </div>
    </main>

</body>

</html>