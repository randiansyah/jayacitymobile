<section class="content-header">
    <h1>
        <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo ucwords(str_replace("_", " ", $this->uri->segment(1))) ?></li>
    </ol>
</section>

<section class="content">
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
            <h3 class="box-title">
            <i class="fa fa-tag"></i> <?php echo ucwords(str_replace("_", " ", $this->uri->segment(1). " - " . $this->uri->segment(2))) ?>
            </h3>
        </div>
        <div class="box-body">
            <div class="box-header">

            </div>
            <div class="row">
                <div style="padding-right:20px;"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" id="periode_start" name="periode_start">
                        <input type="hidden" id="periode_end">
                        <button type="button" class="btn btn-default " id="daterange-btn">
                            Periode <i class="fa fa-calendar"></i>
                            <span>
                              Date range picker
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </button>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="datatableButton">
                            <button id="print-pdf" target="blank" class="btn btn-sm btn-success"><i
                                class="fa fa-download"></i>&nbsp;Cetak Laporan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <?php if (!empty($this->session->flashdata('message'))) { ?>
                            <div class="alert alert-info">
                                <?php
                                print_r($this->session->flashdata('message'));
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($this->session->flashdata('message_error'))) { ?>
                            <div class="alert alert-info">
                                <?php
                                print_r($this->session->flashdata('message_error'));
                                ?>
                            </div>
                        <?php } ?>
                        <table class="table table-striped tab" id="table">
                            <thead>
                                <th width="5">No.</th>
                                <th>Nama</th>
                                <th>Amount</th>
                                <th>Deskripsi</th>
                                <th>Tipe</th>
                                <th>Dibuat Pada</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script data-main="<?php echo base_url() ?>assets/js/main/main-report_expense.js" src="<?php echo base_url() ?>assets/js/require.js"></script>
