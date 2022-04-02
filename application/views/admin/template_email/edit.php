<form method="post" id="form" action="<?php echo base_url("template_email/update") ?>">
    <div class="form-group">
        <label>Tipe</label>
        <select name="tipe" id="tipe" class="form-control" required readOnly>
            <option value="">Pilih</option>
            <option value="0"<?php if($data->tipe == 0) { echo "selected"; }?>>
                Pembayaran angsuran whatsapp
            </option>
            <option value="1"<?php if($data->tipe == 1) { echo "selected"; }?>>
                JTagihan tunggakan whatsapp
            </option>
            <option value="2"<?php if($data->tipe == 2) { echo "selected"; }?>>
                Pembayaran angsuran email
            </option>
            <option value="3"<?php if($data->tipe == 3) { echo "selected"; }?>>
                Tagihan tunggakan email
            </option>
             <option value="4"<?php if($data->tipe == 4) { echo "selected"; }?>>
              Reminder tunggakan whatsapp
            </option>
             <option value="5"<?php if($data->tipe == 5) { echo "selected"; }?>>
              Reminder tunggakan email
            </option>
        </select>
    </div>
    <div class="form-group">
        <label>Isi</label>
        <textarea name="isi" id="isi" cols="30" rows="10" class="form-control"><?= $data->isi; ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?= $data->id; ?>">

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>