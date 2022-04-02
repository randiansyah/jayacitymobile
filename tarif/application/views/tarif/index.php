<div class="container-fluid">
    <h1 class="h2 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Tarif</h6>
            <div class="pull-right">
                <a href="<?= base_url("tarif/create") ?>" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Tarif</th>
                            <th>Minimum Charge</th>
                            <th>Estimasi</th>
                            <th>Keterangan</th>
                            <th>Kontak</th>
                            <th>Kargo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tarif as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->asal; ?></td>
                                <td><?= $row->tujuan; ?></td>
                                <td><?= $row->tarif; ?></td>
                                <td><?= $row->min_charge; ?></td>
                                <td><?= $row->estimasi; ?></td>
                                <td><?= $row->keterangan; ?></td>
                                <td><?= $row->kontak; ?></td>
                                <td><?= $row->kargo; ?></td>
                                <td>
                                    <a href="<?= base_url("tarif/edit/"). $row->id ?>">Edit</a>
                                    <?=anchor("tarif/delete/".$row->id,"Delete",array('onclick' => "return confirm('Do you want delete this record')"))?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
