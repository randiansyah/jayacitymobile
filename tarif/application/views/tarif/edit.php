<div class="container-fluid">
    <h1 class="h2 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url("tarif/edit/") . $tarif->id ?>" method="POST">
                <div class="form-group row">
					<label class="col-sm-3 control-label">Asal</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="asal" value="<?= $tarif->asal ?>" reqired>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Tujuan</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tujuan" value="<?= $tarif->tujuan ?>" required>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Tarif</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" name="tarif" value="<?= $tarif->tarif ?>" required>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Minimum Charge</label>
					<div class="col-sm-9">
                        <div class="row">
                            <div class="col-8">
                                <input type="number" class="form-control" name="min_charge" placeholder="1" required>
                            </div>
                            <div class="col-4">
                                <select name="satuan" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="gram">Gram</option>
                                    <option value="Kg">Kg</option>
                                </select>
                            </div>
                        </div>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Estimasi</label>
					<div class="col-sm-9">
                        <div class="row">
                            <div class="col-8">
                                <input type="number" class="form-control" name="estimasi" placeholder="1" required>
                            </div>
                            <div class="col-4">
                                <select name="lama" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="hari">Hari</option>
                                    <option value="minggu">Minggu</option>
                                    <option value="Bulan">Bulan</option>
                                </select>
                            </div>
                        </div>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Keterangan</label>
					<div class="col-sm-9">
                        <textarea name="keterangan" class="form-control" cols="30" rows="10"><?= $tarif->keterangan ?></textarea>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Kontak</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" name="kontak" value="<?= $tarif->kontak ?>" required>
					</div> 
				</div>
                <div class="form-group row">
					<label class="col-sm-3 control-label">Kargo</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="kargo" value="<?= $tarif->kargo ?>" required>
					</div> 
				</div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>