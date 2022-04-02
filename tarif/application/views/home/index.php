<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
	 <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.css" rel="stylesheet">
    <title>Home</title>
    <link href="<?= base_url('assets/'); ?>vendor/select2/dist/css/select2.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="col-12">
            <h2 class="text-center pt-4">CEK TARIF</h2>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-truck"></i>
 Darat</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-ship"></i> Laut</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-plane"></i> Udara</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
     <div class="card shadow mb-4">
                <div class="card-body">
				 <form id="form">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota Asal</label>
                                    <select id="asalDarat" class="form-control select2" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($data['asalDarat'] as $row) { ?>
                                            <option value="<?php echo $row->asal?>"><?= $row->asal ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota Tujuan</label>
                                    <select id="tujuanDarat" class="form-control select2" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($data['tujuanDarat'] as $row){ ?>
                                            <option value="<?= $row->tujuan ?>"><?= $row->tujuan; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary mt-4" id="cekDarat">Cek Tarif</button>
                                </div>
                            </div>
                        </div>
                    </form>
                 
                </div>
            </div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   <div class="card shadow mb-4">
                <div class="card-body">
   <form id="form">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota Asal</label>
                                    <select id="asalLaut" class="form-control select2" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($data['asalLaut'] as $row) { ?>
                                            <option value="<?php echo $row->asal?>"><?= $row->asal ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota Tujuan</label>
                                    <select id="tujuanLaut" class="form-control select2" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($data['tujuanLaut'] as $row){ ?>
                                            <option value="<?= $row->tujuan ?>"><?= $row->tujuan; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary mt-4" id="cekLaut">Cek Tarif</button>
                                </div>
                            </div>
                        </div>
                    </form>
					</div>
					</div>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
   <div class="card shadow mb-4">
                <div class="card-body">
   <form id="form">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota Asal</label>
                                    <select id="asalUdara" class="form-control select2" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($data['asalUdara'] as $row) { ?>
                                            <option value="<?php echo $row->asal?>"><?= $row->asal ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota Tujuan</label>
                                    <select id="tujuanUdara" class="form-control select2" required>
                                        <option value="">Pilih</option>
                                        <?php foreach($data['tujuanUdara'] as $row){ ?>
                                            <option value="<?= $row->tujuan ?>"><?= $row->tujuan; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary mt-4" id="cekUdara">Cek Tarif</button>
                                </div>
                            </div>
                        </div>
                    </form>
					</div>
					</div>
  
  </div>
</div>
           
        </div>
        
        <div class="modal" tabindex="-1" role="dialog" id="modal_detail">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tarif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bodymodal_detail">
                    <form id="modalForm">
                        <div id="res">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Tarif</label>
                                <div class="col-sm-9">
                                    <span id="tarif"></span>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Minimum Charge</label>
                                <div class="col-sm-9">
                                    <span id="min_charge"></span>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Estimasi</label>
                                <div class="col-sm-9">
                                    <span id="estimasi"></span>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Kargo</label>
                                <div class="col-sm-9">
                                    <span id="kargo"></span>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Kontak</label>
                                <div class="col-sm-9">
                                    <span id="kontak"></span>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <p id="keterangan"></p>
                                </div> 
                            </div>
                        </div>
                        <p id="error"></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/select2/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
		    width: '100%'
	    });
        
        $("#cekDarat").on("click", function() {
	
            var content = $("#bodymodal_detail");
            $.ajax({
                dataType: "json", 
                type: "POST",
                url: "<?=site_url('home/getTarifDarat');?>",
                data: {
                    asalDarat : $("#asalDarat").val(),
                    tujuanDarat: $("#tujuanDarat").val()
                }
            }).done(function(res) {
                if (res == false) {
                    $("#res").css("display", "none");
                    $("#error").text("Harap Masukan Kota asal Dan tujuan").css("color", "red")
                } else {
                    $("#res").css("display", "");
                    $("#error").css("display", "none")
                    $('#asalDarat').val(null).trigger('change');
                    $('#tujuanDarat').val(null).trigger('change');

                }

                $(".modal").modal("show");
                $("#tarif").text(res.tarif)
                $("#min_charge").text(res.min_charge)
                $("#estimasi").text(res.estimasi)
                $("#kargo").text(res.kargo)
                $("#kontak").text(res.kontak)
                $("#keterangan").text(res.keterangan)
                $('#asalDarat').val(null).trigger('change');
                $('#tujuanDarat').val(null).trigger('change');

            });
        });
		
		
		 $("#cekLaut").on("click", function() {
            var content = $("#bodymodal_detail");
            $.ajax({
                dataType: "json", 
                type: "POST",
                url: "<?=site_url('home/getTarifLaut');?>",
                data: {
                    asalLaut : $("#asalLaut").val(),
                    tujuanLaut: $("#tujuanLaut").val()
                }
            }).done(function(res) {
                if (res == false) {
                    $("#res").css("display", "none");
                    $("#error").text("Harap Masukan Kota asal Dan tujuan").css("color", "red")
                } else {
                    $("#res").css("display", "");
                    $("#error").css("display", "none")
                    $('#asal').val(null).trigger('change');
                    $('#tujuan').val(null).trigger('change');

                }

                $(".modal").modal("show");
                $("#tarif").text(res.tarif)
                $("#min_charge").text(res.min_charge)
                $("#estimasi").text(res.estimasi)
                $("#kargo").text(res.kargo)
                $("#kontak").text(res.kontak)
                $("#keterangan").text(res.keterangan)
                $('#asal').val(null).trigger('change');
                $('#tujuan').val(null).trigger('change');

            });
        });
		
			 $("#cekUdara").on("click", function() {
            var content = $("#bodymodal_detail");
            $.ajax({
                dataType: "json", 
                type: "POST",
                url: "<?=site_url('home/getTarifUdara');?>",
                data: {
                    asalUdara : $("#asalUdara").val(),
                    tujuanUdara: $("#tujuanUdara").val()
                }
            }).done(function(res) {
                if (res == false) {
                    $("#res").css("display", "none");
                    $("#error").text("Harap Masukan Kota asal Dan tujuan").css("color", "red")
                } else {
                    $("#res").css("display", "");
                    $("#error").css("display", "none")
                    $('#asal').val(null).trigger('change');
                    $('#tujuan').val(null).trigger('change');

                }

                $(".modal").modal("show");
                $("#tarif").text(res.tarif)
                $("#min_charge").text(res.min_charge)
                $("#estimasi").text(res.estimasi)
                $("#kargo").text(res.kargo)
                $("#kontak").text(res.kontak)
                $("#keterangan").text(res.keterangan)
                $('#asal').val(null).trigger('change');
                $('#tujuan').val(null).trigger('change');

            });
        });


        $("#close").on("click", function() {
            $(".modal").modal("hide");
            $('#asal').val(null).trigger('change');
            $('#tujuan').val(null).trigger('change');
			
        })
    </script>
</body>
</html>