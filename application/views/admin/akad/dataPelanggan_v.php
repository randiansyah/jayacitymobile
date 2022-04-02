
        <div class="col-md-4">
          <div class="form-group"> 
    <div class="form-group">
            <label for="">Nama Pelanggan </label>
            <input class="form-control" type="hidden" value="<?php echo $pelanggan->id_pelanggan ?>" name="id_pelanggan" id="id_pelanggan" autocomplete="off">
            <input class="form-control" value="<?php echo $pelanggan->nama ?>" autocomplete="off">
          </div>  

           <div class="form-group">
            <label for="">Tempat Tgl Lahir </label>
            <input class="form-control" autocomplete="off" value="<?php echo $pelanggan->tempat_lahir.','.$pelanggan->tgl_lahir ?>">
          </div>  
          <div class="form-group">
            <label for="">No KTP </label>
            <input class="form-control" value="<?php echo $pelanggan->ktp ?>" autocomplete="off">
          </div>  
            <div class="form-group">
            <label for="">No HP </label>
            <input class="form-control" value="<?php echo $pelanggan->no_telp ?>" autocomplete="off">
          </div> 
           <div class="form-group">
            <label for="">ALAMAT KTP</label>
           <textarea cols="4" rows="5" class="form-control" value="<?php echo $pelanggan->alamat ?>"><?php echo $pelanggan->alamat ?></textarea>
          </div>
           <div class="form-group">
            <label for="">ALAMAT SEKARANG</label>
           <textarea cols="4" rows="5" class="form-control" value="<?php echo $pelanggan->alamat_sekarang ?>"><?php echo $pelanggan->alamat_sekarang ?></textarea>
          </div>
        </div>
      </div>
      <div class="col-md-4">
    <div class="form-group">
            <label for="">TANGGAL PEMBELIAN</label>
            <input class="form-control datepicker" value="<?php echo $pelanggan->alamat_sekarang ?>"  id="tgl_beli" name="tgl_beli">
          </div>  
           <div class="form-group">
            <label for=""> NAMA BARANG</label>
         <input class="form-control"  value="<?php echo $transaksi->nama_barang ?>">
          </div>   
              <div class="form-group">
            <label for="">MEREK</label>
  <input class="form-control" value="<?php echo $transaksi->merek ?>">       
          </div> 
           <div class="form-group">
            <label for="">TIPE</label>
  <input class="form-control"  value="<?php echo $transaksi->tipe ?>">            
          </div>
      <div class="form-group">
            <label for="">WARNA</label>
            <input class="form-control" value="<?php echo $transaksi->warna ?>">
          </div>
 
          <div class="form-group">
            <label for="">NO. LAINNYA</label>
          <input class="form-control" autocomplete="off" value="<?php echo $transaksi->no_lainnya ?>">
          </div>
 <div class="form-group">
            <label for="">KETERANGAN BARANG</label>
           <textarea cols="4" rows="5" class="form-control" value="<?php echo $transaksi->keterangan ?>"><?php echo $transaksi->keterangan ?></textarea>
          </div>
             
         
          </div>
          <div class="col-md-4">
             <div class="form-group">
            <label for="">SN</label>
            <input class="form-control"  autocomplete="off"  value="<?php echo $transaksi->sn ?>">
          </div>
           <div class="form-group">
            <label for="">IMEI 1</label>
            <input class="form-control" autocomplete="off"autocomplete="off"  value="<?php echo $transaksi->imei1 ?>">
          </div>
            <div class="form-group">
            <label for="">IMEI 2</label>
         <input class="form-control" autocomplete="off"  autocomplete="off"  value="<?php echo $transaksi->imei2 ?>">
          </div>
               <div class="form-group">
            <label for="">ADMIN</label>
      <input class="form-control" autocomplete="off" autocomplete="off"  value="<?php echo number_format($transaksi->admin,2,",",".") ?>">
          </div>
               <div class="form-group">
            <label for="">HARGA PARTAI</label>
   <input class="form-control harga" autocomplete="off" autocomplete="off"  value="<?php echo number_format($transaksi->harga_partai,2,",",".") ?>">
          </div>
          
            <div class="form-group">
            <label for="">HARGA RETAIL</label>
      <input class="form-control harga" autocomplete="off" value="<?php echo number_format($transaksi->harga_retail,2,",",".") ?>">
          </div>
             <div class="form-group">
            <label for="">HARGA JUAL</label>
           <input class="form-control harga" autocomplete="off" value="<?php echo number_format($transaksi->harga_retail,2,",",".") ?>">
          </div>
      
     
           <div class="form-group">
           <label for="">NAMA TOKO</label>
        <input class="form-control" id="nama_toko" value="<?php echo $transaksi->nama_toko ?>">
          </div>


          </div>
    </div>
<hr class="style1"></hr>
    <br>
        