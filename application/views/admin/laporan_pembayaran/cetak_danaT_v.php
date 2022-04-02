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
<html>
<head>
  <title>Kwitansi Dana Titipan</title>
  <style type="text/css">
      @font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: normal;
  src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
}  
@page { 
  

   }
    #outtable{
      margin-bottom: 10px;
      border:1px solid #019934;
      padding: 10px;
       font-family: Arial,sans-serif;  
    }
 
    .pertama{
      width: 280px;
    }
 
    .kedua{
      width: 230px;
      color:#019934;
      font-size:12px;
      font-weight:normal;
    }
    .ketiga{
      width: 200px;
       color:#019934;
      font-size:16px;
      font-weight:900;
    }
     .custom{
      width: 100px;
      color:#019934;
       margin-top:3px;
      font-size:12px;
      font-weight:normal;
    }
     .keempat{
      color:#019934;
       margin-top:-20px;
      font-size:13px;
      font-weight:600;
        text-decoration-style: dotted;
        text-align: left;
  
    }
    
    u {    
    border-bottom: 1px dotted #019934;
    margin-bottom:5px;
    text-decoration: none;
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
 
    tbody tr:nth-child(even){
      background: #F6F5FA;
    }
 
    tbody tr:hover{
      background: #EAE9F5
    }
    hr.new5 {
  border: 1px solid #019934;
  border-radius: 0px;
}
br {
   display: block;
   margin: 6px 0;
}
.custom2{
      width: 250px; 
    }
    .custom3{
     margin-top: -10px;
     font-size: 17px;
     font-weight: bold;
     color: #019934;
    }
  </style>
</head>
<body>
	<div id="outtable">
	  <table>
	  	<thead>
	  		<tr>
	  			<th class="pertama"><img src="assets/images/logo-smart2.png" width="80%"></th>
	  			<th class="kedua"><?php echo $pengaturan->alamat ?><br>HP :<?php echo $pengaturan->no_telp ?> 
          </th>
	  			<th class="ketiga"><u>KWITANSI</u><br>RECEIPT<br><p class="custom">
            No :<u><?php echo $angsuran->id_at ?></u>
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
	  			<td class="keempat">Sudah Terima Dari</u></td>
                  <td class="keempat">:</td>
                  <td class="keempat"><?php echo $angsuran->nama ?> &nbsp;........................
......................................................

                  </td>
              </tr>
              <tr>
	  			<td class="keempat">Banyaknya Uang</td>
	  			<td class="keempat">:</td>
                  <td class="keempat"><?php echo terbilang($angsuran->jumlah_bayar)." rupiah" ?>
                  &nbsp;........................................................................
                  ...................
                </td>
              </tr>
              <tr>
	  			<td class="keempat">untuk Pembayaran</u></td>
	  			<td class="keempat">:</td>
                  <td class="keempat"><?php echo $angsuran->keterangan ?>  &nbsp;........................................................................
                  .......................</td>
	  		</tr>
          </tbody>  
      </table>
      <br>
      <table>
	  	<thead>
	  		<tr>
                  <th class="custom2"><hr class="new5">
             <br><div class="custom3">&nbsp;&nbsp;&nbsp;Rp.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($angsuran->jumlah_bayar,2,",",".") ?></div><br>
             <hr class="new5"><br>
             <div class="kedua">Catatan
             <br>Jika Pembayaran Transfer ke bank<br>
            <?php echo $bank->nama_bank ?><br>
           <b>No Rek <?php echo $bank->no_akun ?>&nbsp;A/N  <?php echo $bank->nama_akun ?></b><br>

             </div>
                </th>
	  			<th class="ketiga">
          </th>
	  			<th class="kedua"><u>Tarakan,&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $angsuran->tgl_bayar ?></u>
            </p></th>
	  		</tr>
	  	</thead>
	  	<tbody>
	
	  	</tbody>
      </table>
	 </div>
</body>
</html>