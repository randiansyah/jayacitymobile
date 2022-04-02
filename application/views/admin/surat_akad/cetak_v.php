<html>

<head>
    <title>Kartu Angsuran</title>
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
                    <hr style="width:79%;margin-top:5px;height:3px;border-width:0;color:#019934;background-color:#019934;">

            </div>
        </div>


    </header>

    <footer>

    </footer>
    <main>
        <div class="col-md-12 text-center">
            <br>
            <h4><b><?php echo $surat->judul ?><b></h4>
            <h5><b><?php echo $surat->sub_judul ?><5>
                        </h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <p><?php echo $surat->keterangan_1 ?>
                    <b style="font-size: 12px;">
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->nama_pp ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-2 control-label">Jabatan </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->jabatan_pp ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-2 control-label">Alamat </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->alamat_pp ?>
                            </div>
                        </div>
                    </b>
                    <?php echo $surat->keterangan_2 ?>
                    <b style="font-size: 12px;">
                        <div class="form-group row " style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nama </label>
                            <div class="col-sm-6">
                                : ASTUTI
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Tempat/TGL Lahir </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->tempat_tgl_lahir_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">NIK </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->nik_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Pekerjaan </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->pekerjaan_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Alamat KTP </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->alamat_ktp_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Alamat Sekarang </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->alamat_sekarang_pk ?>
                            </div>
                        </div>

                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">No. HP </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->hp_pk ?>
                            </div>
                        </div>
                    </b>
                    <?php echo $surat->keterangan_3 ?>
                    <b style="font-size: 12px;">
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-6">
                                : <?php echo $surat->nama_barang_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Sn : </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->sn_pk ?>
                            </div>
                        </div>

                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Imei1</label>
                            <div class="col-sm-6">
                                : <?php echo $surat->imei1_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Imei2</label>
                            <div class="col-sm-6">
                                : <?php echo $surat->imei2_pk ?>
                            </div>
                        </div>
                    </b>
                    <?php echo $surat->keterangan_4 ?>
                    <b style="font-size: 12px;">
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Harga Pokok </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->harga_pokok_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Keuntungan PIHAK PERTAMA/ PENJUAL </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->keuntungan_pp ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Harga Jual </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->harga_jual_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Admin </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->biaya_admin_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Asuransi Jiwa </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->asuransi_jiwa_pk ?>
                            </div>
                        </div>
                        <hr style="width:50%;margin-top:5px;height:2px;border-width:0;color:black;background-color:black;">

                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Uang Muka </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->uang_muka_pk ?>
                            </div>
                        </div>
                        <div class="form-group row" style="height:20px;">
                            <label for="inputEmail3" class="col-sm-3 control-label">Terhutang PIHAK KEDUA/ PEMBELI </label>
                            <div class="col-sm-6">
                                : <?php echo $surat->harga_jual_pk ?>
                            </div>
                        </div>
                    </b>
                    <?php echo $surat->keterangan_5 ?><b style="font-size:12px;"><?php echo $surat->harga_jual_pk . " " . $surat->besaran_terbilang ?></b>
                    dilakukan pembayaran dengan Metode Transfer Ke Rekening PIHAK PERTAMA/ PENJUAL <b style="font-size:12px;">Bank <?php echo $bank->nama_bank . " " . $bank->no_akun . " An " . $bank->nama_akun ?></b>
                    atau dengan Membayar Langsung Ke Toko/ Kantor SMART REZEKI TARAKAN<br>
                    Ayat 2<br>
                    PIHAK KEDUA/ PEMBELI menyetujui Kepada PIHAK PERTAMA/ PENJUAL pembayaran <b style="font-size:12px;"> di cicil <?php echo $surat->cicilan ?> kali dan lama waktu <?php echo $surat->cicilan ?> bulan,</b> dengan Jatuh Tempo cicilan paling Lambat <b style="font-size:12px;"> tanggal <?php echo $surat->cicilan ?> disetiap Bulannya.</b>
                    <?php echo $surat->keterangan_7 ?>
                    <br>1. Jumlah<b style="font-size:12px;"> cicilan sebanyak <?php echo $surat->cicilan ?> kali</b>
                    <br>2. Besaran cicilan setiap bulan <b style="font-size:12px;"><?php echo $surat->besaran_cicilan_pk ?></b>
                    <br>3. Jatuh Tempo cicilan setiap bulannya adalah tanggal <?php echo $surat->cicilan ?>
                    <br>4. Jatuh Tempo cicilan pertama tanggal <?php echo $surat->jatuh_tempo_pertama_pk ?>
                    <br>5. Jatuh Tempo cicilan Terakhir Tanggal <?php echo $surat->jatuh_tempo_terakhir_pk ?>
                    <?php echo $surat->keterangan_8 ?>
                    <b style="font-size:12px;"><?php echo $surat->harga_jual_pk . " " . $surat->besaran_terbilang ?></b>
                    <?php echo $surat->keterangan_9 ?>
                    <br>
                    <br>
                    <div class="form-group row" style="height:20px;">
                        <div class="col-sm-12 text-center">
                            <b>Tarakan <?php echo date("d M Y") ?></b>
                        </div>

                    </div>
                    <div class="form-group row" style="height:20px;">
                        <div class="col-sm-6">
                            <b>PIHAK KEDUA/ PEMBELI</b>
                        </div>
                        <div class="col-sm-6">
                            <b> PIHAK PERTAMA/ PENJUAL</b>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="form-group row" style="height:20px;">
                        <div class="col-sm-6">
                            <b><?php echo $surat->nama_pk ?></b>
                        </div>
                        <div class="col-sm-6">
                            <b><?php echo $surat->nama_pp ?></b>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row" style="height:20px;">
                        <div class="col-sm-12 text-center">
                            <b>Saksi-Saksi</b>
                        </div>

                    </div>
                    <br>
                    <div class="form-group row" style="height:20px;">
                        <div class="col-sm-6">
                            <b>1.<?php echo $surat->saksi1 ?></b>
                        </div>
                        <div class="col-sm-6">
                            <b>2.<?php echo $surat->saksi2 ?></b>
                        </div>
                    </div>

                </p>
            </div>
        </div>
    </main>

</body>

</html>