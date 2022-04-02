<html>

<head>
    <title>Laporan Angsuran</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
            margin-left: 2cm;
            margin-right: 2cm;
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
        <b style="font-size: 13px; text-align:right;">Periode : <?php echo $start_date . ' s/d ' . $end_date; ?></b>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Sub Total</th>
                            <th>Total</th>
                            </tr>
                        
                        </thead>
                        <tbody>
                            <?php $i = 1;

                            foreach ($angsuran_titipan as $key => $value)
                            //   $totalnya = 0;

                            { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo date('d M Y', strtotime($value["date"])); ?></td>
                                    <td> Rp.<?php echo number_format($value["sub_total"], 0, ".", ".") ?></td>
                                    <td>Rp.<?php echo number_format($value["total"], 0, ".", ".") ?></td>
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
    </main>

</body>

</html>