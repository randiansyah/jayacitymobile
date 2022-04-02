<?php
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
  function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
    }
    ?>
<!DOCTYPE html>
<html><head>

  <title>Kwitansi</title>
  
  <style type="text/css">

@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 600;
  src: local('Open Sans Semibold'), local('OpenSans-Semibold'), url(https://fonts.gstatic.com/s/opensans/v13/MTP_ySUJH_bn48VBG8sNSnhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}

    #outtable{
      margin-bottom: 10px;
      border:1px solid #2d3436;
      padding: 10px;
    }
 
    .pertama{
      width: 280px;
      font-family: Arial,sans-serif;  
      color: #2d3436;
      font-size:17px;
      padding: 10px;
    }
    .nameSetting{
      width: 230px;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
      color: #2d3436;
      font-size:17px;
      padding: 10px;
      font-weight: 700;
    }
 
    .kedua{
      width: 230px;
      color:#2d3436;
      font-size:12px;
      font-weight:normal;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }

    .bank{
      width: 230px;
      margin: 10px;
      color:#2d3436;
      font-size:12px;
      font-weight:normal;
      font-family: Roboto, 'Segoe UI', Tahoma, sans-serif;
    }
    .ketiga{
      width: 230px;
       color:#2d3436;
      font-size:16px;
      font-weight: 600;
    }
    .tgl{
       color:#2d3436;
      font-size:13px;
  font-weight : 400;
    }
     .custom{
      width: 180px;
      height: 30px;
      color:#2d3436;
       margin-top:3px;
      font-size:12px;
      font-weight:normal;
      border: 1px solid #2d3436;
    }
     .keempat{
      width: 150px;
      color:#2d3436;
      font-size:13px;
      font-weight:600;
        text-decoration-style: dotted;
        text-align: left;
       font-family: 'Open Sans'; 
  
    }
    .keempat1{
      color:#2d3436;
      font-size:13px;
      font-weight:600;
        text-decoration-style: dotted;
        text-align: left;
        font-family: 'Open Sans';
  
    }
    
    u {    
    border-bottom: 1px dotted #2d3436;
    margin-bottom:5px;
    text-decoration: none;
}
.hrFont {
      width: 450px;
      height: 20px;
      border-bottom: solid 1px black;
      
    }
    .hrFontTGL {
      width: 235px;
      margin-top: -200px;
      padding: auto;
      border-bottom: dotted 1px black;
      
    }
    .bgcolorFont {
     background-color: #bdc3c7;
     margin-top: 10px;
     padding-top: 10px;
    height: 10px;
   
    }
    .bgcolorFont1 {
     background-color: #bdc3c7;
     margin: 10px;
    
    }

 
    table{
      border-collapse: collapse;
      color:#5E5B5C;
    }
 
    thead th{
      text-align: left;
    }
  
 
    tbody td{
   
      padding: 10px;
    }
 
    .hrTerbilang {
      margin: 10px;
      width: 231px;
      height: 1px;
      border-bottom: solid 1px black;
      
    } 
 
    tbody tr:hover{
      background: #EAE9F5
    }
    hr.new5 {
  border: 1px solid #2d3436;
  border-radius: 0px;
  width: 230px;
}
br {
   display: block;
   margin: 6px 0;
}
.custom2{
      width: 250px; 
    }
    .custom3{
     padding: 10px;
     font-size: 17px;
     font-weight: bold;
     color: #2d3436;
    }
  </style>
</head><body>
	<div id="outtable">
	  <table>
	  	<thead>
	  		<tr>
	  			<th class="nameSetting"><?php echo $pengaturan->nama ?></th>
	  			<th class="kedua"><?php echo $pengaturan->alamat ?><br>HP :<?php echo $pengaturan->no_telp ?> 
          </th>
	  			<th class="ketiga">KWITANSI<p class="custom">
           <u></u>
            </p></th>
	  		</tr>
	  	</thead>
	  	<tbody>
	
	  	</tbody>
      </table>
      <br>
      <table >
      <thead>
	  	
          </thead>
          <tbody>
          <tr>
	  			<td class="keempat">SUDAH TERIMA DARI</u></td>
                  <td class="keempat1">:</td>
                  <td class="keempat1 hrFont"><?php echo $angsuran->nama ?>

                  </td>
              </tr>
              <tr>
	  			<td class="keempat">UANG SEBANYAK</td>
	  			<td class="keempat1">:</td>
                  <td class="keempat1 bgcolorFont hrFont"><?php echo terbilang($angsuran->jumlah_bayar)." rupiah" ?>
               </td>
              </tr>
              <tr>
	  			<td class="keempat">GUNA PEMBAYARAN</u></td>
	  			<td class="keempat1">:</td>
                  <td class="keempat1 hrFont"><?php echo $angsuran->keterangan ?></td>
	  		</tr>
          </tbody>  
      </table>
      <br>
      <table>
	  	<thead>
	  		<tr>
                  <th class="custom2">
                    <div class="hrTerbilang"></div>
           <div class="custom3 bgcolorFont1">&nbsp;&nbsp;&nbsp;Rp.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($angsuran->jumlah_bayar,2,",",".") ?></div>
           <div class="hrTerbilang"></div>
             <!-- <div class="bank">Catatan
             <br>Jika Pembayaran Transfer ke bank<br>
            <?php echo $bank->nama_bank ?><br>
           <b>No Rek <?php echo $bank->no_akun ?>&nbsp;A/N  <?php echo $bank->nama_akun ?></b><br>

             </div> -->
                </th>
	  			<th class="kedua">
          </th>
	  			<th class="tgl">Tanjungbatu,<?php 
          echo date('d F Y', strtotime($angsuran->tgl_bayar));
          ?>
            </th>
	  		</tr>
	  	</thead>
	  	<tbody>
	
	  	</tbody>
      </table>
	 </div>
</body></html>