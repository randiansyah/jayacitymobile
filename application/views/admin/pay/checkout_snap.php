<section class="content-header">
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="<?php echo base_url($this->uri->segment(1)) ?>" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>


    </div>
  </div>
</section>
<section class="content">

  <div class="box box-default color-palette-box">
    <div class="col-xs-12 table-responsive">

      <h4 class="box-title">RINCIAN PEMBAYARAN</h4>
 

      <table class="table table-bordered">
      <thead class="thead-dark">
                  <tr>
                    <th width="50"></th>
                    <th></th>
                  
                  </tr>
                </thead>
        <tbody>
        <?php
      if (!empty($angsuran)) {
        foreach ($angsuran as $key => $val) {
      ?>
     <tr>
       <td><input data-id="<?php echo $val->id_angsuran ?>" style="margin-top: 20px;" class="type" type="checkbox" id="check" name="type" value="<?php echo $val->jumlah_cicilan ?>"></td>
       <td class="parent" >
     <p style="font-size: 20px;font-size: 20px;
    background-color: #22a6b3;color:aliceblue;height: 50px;
    padding: 9px;">Angsuran Ke : <?php echo $val->cicilan ?></p>
   <table style="margin-left: 10px;"><tr>

    <th class="child" style="width:100px">
      Tenor
    </th>
    <th class="child" style="width:100px">
      Tagihan
    </th>
    <th class="child" style="width:100px">
      Jatuh Tempo
    </th>
   </tr>
  <tbody>
    <tr>
      <td><?php echo $val->lama_cicilan ?></td>
      <td><?php echo "Rp.".number_format($val->jumlah_cicilan,0,".",".") ?></td>
      <td><?php echo date("d-m-Y", strtotime($val->tgl_jth)) ?></td>
    </tr>
  </tbody>
  
  </table>
</td>
     
     </tr>

      <?php
        }
      } else {}
      ?>
        </tbody>
     
      </table>
    
    </div>

    <div class="col-xs-12 table-responsive">

<form id="payment-form" method="post" action="<?= site_url() ?>History_pembayaran/finish">
  <input type="hidden" name="result_type" id="result-type" value="">
  <input type="hidden" name="result_data" id="result-data" value="">
  <input type="hidden" class="form-control id_angsuran" name="id_angsuran" id="id_angsuran">
  <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?php echo (!empty($angsuran)) ? $angsuran[0]->id_pelanggan : "" ?>">
  <input type="hidden" class="form-control" name="id_invoice" id="id_invoice" value="<?php echo (!empty($angsuran)) ? $angsuran[0]->id_invoice : "" ?>">
</form>
<table class="table table-bordered">
  <thead>
    <th><input type="text" class="form-control text" readonly>
    <input type="hidden" class="form-control jumlah" name="jumlah" id="jumlah">
    <input type="hidden" class="form-control id_angsuran" name="id_angsuran" id="id_angsuran">

  </th>
    <th>
<button id="pay-button" type="button" class="btn btn-danger">Bayar</button></th>
  </thead>

</table>


</div>
  </div>
 
</section>
<section class="content-footer">

</section>

<style>
.faq_chat{
    padding: 30px 30px 30px 30px;
    width: 66.66666667%;
    background-color: #d2f1f0 ;
    z-index: 99;
    position: fixed;
    right: 0;
    bottom: 0;
}
</style>

<script type="text/javascript">


  $('#pay-button').click(function(event) {
    event.preventDefault();
    $(this).attr("disabled", "disabled");
     var jumlah = $("#jumlah").val();
     var id_angsuran = $("#id_angsuran").val();

    $.ajax({
      type: 'POST',
      url: '<?= site_url() ?>History_pembayaran/token',
      data : {
      jumlah : jumlah,
      id_angsuran : id_angsuran 
      },
      cache: false,
      

      success: function(data) {
        //location = data;

        console.log('token = ' + data);

        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type, data) {
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {

          onSuccess: function(result) {
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result) {
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result) {
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });
</script>
<script data-main="<?php echo base_url() ?>assets/js/main/main-snap.js" src="<?php echo base_url() ?>assets/js/require.js">
</script>