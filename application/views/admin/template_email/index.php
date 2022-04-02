<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-default color-palette-box">
                <div class="box-body">
                    <div class="table-responsive">
                    <?php if(!empty($this->session->flashdata('message'))){?>
                    <div class="alert alert-info">
                    <?php   
                    print_r($this->session->flashdata('message'));
                    ?>
                    </div>
                    <?php }?> 
                    <?php if(!empty($this->session->flashdata('message_error'))){?>
                    <div class="alert alert-info">
                    <?php   
                    print_r($this->session->flashdata('message_error'));
                    ?>
                    </div>
                    <?php }?> 
                        <table class="table table-striped">
                            <thead>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Isi</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($template_email->result() as $row) { ?>
                                <tr>
                                    <td><?= $no ++; ?></td>
                                    <td>
                                       <?php 
                                            if ($row->tipe == 0) {
                                                echo "Pembayaran angsuran whatsapp";
                                            }
                                            
                                            if ($row->tipe == 1) {
                                                echo "Tagihan tunggakan whatsapp";
                                            }

                                            if ($row->tipe == 2) {
                                                echo "Pembayaran angsuran email";
                                            }

                                            if ($row->tipe == 3) {
                                                echo "Tagihan tunggakan email";
                                            }
                                              if ($row->tipe == 4) {
                                                echo "Reminder tunggakan whatsapp";
                                            }
                                              if ($row->tipe == 5) {
                                                echo "Reminder tunggakan email";
                                            }
                                        ?>
                                    </td>
                                    <td><?= $row->isi; ?></td>
                                    <td>
                                        <button type="button" data-id="<?php echo $row->id ?>" class="btn btn-warning edit">Edit</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="judul">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="tampil_modal">
                            <!-- Data akan di tampilkan disini-->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script 
  data-main="<?php echo base_url()?>assets/js/main/main-template_email.js" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>
