<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Cetak_angsuran extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('akad_model');
        $this->load->model('angsuran_model');
        $this->load->model('angsuran_titipan_model');
        $this->load->model('cicilan_model');
        $this->load->model('pengaturan_model');
        $this->load->model('rekening_model');
        $this->load->model('transaksi_model');
    }
    public function index()
    {
        $this->load->helper('url');
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/angsuran/list_v';
            $this->data['pelanggan'] = $this->akad_model->getAllById(array('is_deleted' => '0'));
            $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
        } else {
            $this->data['content'] = 'errors/html/restrict';
        }

        $this->load->view('admin/layouts/page', $this->data);
    }

    public function dataList()
    {
        $columns = array(
            0 => '',
            1 => 'nama',
            2 => 'tgl_akad',
            3 => 'lama_cicilan',
            4 => '',
            5 => '',
            6 => '',
            7 => '',
            8 => '',
            9 => '',
        );

        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = array();
        $where = array();
        $limit = 0;
        $start = 0;
        $totalData = $this->angsuran_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        if (!empty($searchColumn[1]['search']['value'])) {
            $value = $searchColumn[1]['search']['value'];
            $isSearchColumn = true;
            $where['nomor_akad'] = $value;
        }

        if (!empty($searchColumn[2]['search']['value'])) {
            $value = $searchColumn[2]['search']['value'];
            $isSearchColumn = true;
            $where['id_pelanggan'] = $value;
        }

        if (!empty($searchColumn[3]['search']['value'])) {
            $value = $searchColumn[3]['search']['value'];
            $isSearchColumn = true;
            $where['lama_cicilan'] = $value;
        }
        if (!empty($searchColumn[4]['search']['value'])) {
            $value = $searchColumn[4]['search']['value'];
            $isSearchColumn = true;
            $where['tgl_akad >='] = date("Y-m-d", strtotime($value));
        }

        if (!empty($searchColumn[5]['search']['value'])) {
            $value = $searchColumn[5]['search']['value'];
            $isSearchColumn = true;
            $where['tgl_akad <='] =  date("Y-m-d", strtotime($value));
        }




        if ($isSearchColumn) {
            $totalFiltered = $this->angsuran_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->angsuran_model->getAllBy($limit, $start, $search, $order, $dir, $where);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($this->data['is_can_edit']) {
                    $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> Rincian</a> ";
                    $edit_url = "<a href='" . base_url() . "Setoran_angsuran/bayar/" . $data->id_akad . "'><i class='fa fa-money'></i> Bayar</a> ";
                    $cetak_url = "<a href='" . base_url() . "Cetak_angsuran/cetak_kartu/" . $data->id_akad . "' target='blank'><i class='fa fa-file-pdf-o'></i> PDF</a> ";
                }

                if ($this->data['is_can_delete']) {
                    $delete_url = "<a href='#' 
                  url='" . base_url() . "Akad/destroy/" . $data->id_akad . "'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
                }
                $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
                $ambil_bayar = $this->angsuran_model->getSum(array("id_akad" => $data->id_akad));
                $nestedData['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
                $terbayar = (!empty($ambil_bayar)) ? $ambil_bayar[0]->total_bayar : "";
                $sisa = $data->total - $terbayar;
                
             
          

                $nestedData['id']   = $start + $key + 1;
                $nestedData['id_invoice']          = $data->id_invoice;
                $nestedData['nomor_akad']          = "<a href='" . base_url() . "akad/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> " . $data->nomor_akad . "</a> ";
                $nestedData['id_pelanggan']          = $data->id_pelanggan;
                $nestedData['tgl_akad']    = date("d-m-Y", strtotime($data->tgl_akad));
                $nestedData['harga_jual']    = number_format($data->harga_jual, 2, ',', '.');
                $nestedData['lama_cicilan']    = $data->lama_cicilan . ' Bulan';
                $nestedData['terbayar'] = number_format($terbayar, 0, ',', '.');
                $nestedData['sisa_pembayaran'] = number_format($sisa, 0, ',', '.');       
                $nestedData['bunga']    = $data->bunga . '%';
                $nestedData['total']    = number_format($data->total, 0, ',', '.');
                $nestedData['aksi'] = $cetak_url;
    


                $new_data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $new_data
        );

        echo json_encode($json_data);
    }

    public function bayar($id)
    {
        $this->form_validation->set_rules('nomor_akad', "Pelanggan tidak boleh kosong", 'trim|required');
        $date = date('y-m-d H:i:s');
        // $kode = $this->customer_model->getKode();
        //  $id_inv = $this->transaksi_model->getKode();
        if ($this->form_validation->run() === TRUE) {

            $id_angsuran = $this->input->post('id_angsuran');
            $id_akad = $this->input->post('id_akad');
            $keterangan = $this->input->post('keterangan');
            $id_pelanggan = $this->input->post('id_pelanggan');
            $id_invoice = $this->input->post('id_invoice');
            $tgl = $this->input->post('tgl_bayar');
            $tgl_bayar = date("Y-m-d", strtotime($tgl));
            $no = $this->input->post('no');

            $jumlah_bayar1 = str_replace(".", "", $this->input->post('bayar'));
            $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);

            $cicilan_angsuran = array();
            foreach ($no as $key => $val) {
                if ($no[$key] > 0) {
                    $cicilan_angsuran[] = array(
                        'id_akad'   => $id_akad,
                        'id_pelanggan'   => $id_pelanggan,
                        'id_invoice'     => $id_invoice,
                        'jumlah_bayar'   => $jumlah_bayar[$key],
                        'id_angsuran'   => $id_angsuran[$key],
                        'tgl_bayar'   => $tgl[$key],
                        'keterangan'   => $keterangan[$key],
                    );
                }
            }

            $update =  $this->db->update_batch('angsuran', $cicilan_angsuran, 'id_angsuran');
            $this->db->error();


            if ($update) {
                $this->session->set_flashdata('message', "Setoran Angsuran  Berhasil ditambahkan");
                redirect('Setoran_angsuran');
            } else {
                $this->session->set_flashdata('message', "Setoran Angsuran Gagal ditambahkan");
                redirect('Setoran_angsuran');
            }
        } else {
            $akad = $this->akad_model->getAllById(array("id_akad" => $id));

            $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));

            $this->data['akad'] = $akad[0];
            $this->data['angsuran'] = $angsuran;
            $this->data['content'] = 'admin/angsuran/bayar_v';
            $this->load->view('admin/layouts/page', $this->data);
        }
    }



    function pdf()
    {

        $id = $this->uri->segment(3);
        $angsuran = $this->angsuran_model->getOneByAngsuran(array("id_angsuran" => $id));
        $this->data['angsuran'] = $angsuran;
        $pengaturan = $this->pengaturan_model->getOneBy();
        $id_bank = (!empty($pengaturan)) ? $pengaturan->id_bank : "";
        $bank = $this->rekening_model->getOneBy(array("id" => $id_bank));
        $this->data['pengaturan'] = $pengaturan;
        $this->data['bank'] = $bank;

        $this->load->library('Pdf');
        $this->pdf->setPaper('A4', 'portrait');
        
        $html = "<b>test</b>";
        $this->pdf->loadHtml($html);

        // $this->pdf->filename = "Kartu-Angsuran" . date('dmy') . ".pdf";
        // $this->pdf->load_view('admin/laporan_pembayaran/cetak_v', $this->data, true);
    }
    function cetak_kartu()
    {

        $id = $this->uri->segment(3);
        $akad = $this->akad_model->getAllById(array("id_akad" => $id));

     

        $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));
        $id_invoice = (!empty($akad)) ? $akad[0]->id_invoice : "";
        $transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $id_invoice));

        $this->data['akad'] = $akad[0];
        $this->data['angsuran'] = $angsuran;
        $pengaturan = $this->pengaturan_model->getOneBy();
        $this->data['pengaturan'] = $pengaturan;
        $this->data['transaksi'] = $transaksi;

        $this->load->library('Pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Surat-Perjanjian" . date('dmy') . ".pdf";
        $this->pdf->load_view('admin/laporan_pembayaran/cetak_kartu_v', $this->data, true);
    }

    public function view($id)
    {
        $this->form_validation->set_rules('nomor_akad', "Pelanggan tidak boleh kosong", 'trim|required');
        $date = date('y-m-d H:i:s');
        // $kode = $this->customer_model->getKode();
        //  $id_inv = $this->transaksi_model->getKode();
        if ($this->form_validation->run() === TRUE) {

            $id_angsuran = $this->input->post('id_angsuran');
            $id_akad = $this->input->post('id_akad');
            $keterangan = $this->input->post('keterangan');
            $id_pelanggan = $this->input->post('id_pelanggan');
            $id_invoice = $this->input->post('id_invoice');
            $tgl = $this->input->post('tgl_bayar');
            $tgl_bayar = date("Y-m-d", strtotime($tgl));
            $no = $this->input->post('no');

            $jumlah_bayar1 = str_replace(".", "", $this->input->post('bayar'));
            $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);

            $cicilan_angsuran = array();
            foreach ($no as $key => $val) {
                if ($no[$key] > 0) {
                    $cicilan_angsuran[] = array(
                        'id_akad'   => $id_akad,
                        'id_pelanggan'   => $id_pelanggan,
                        'id_invoice'     => $id_invoice,
                        'jumlah_bayar'   => $jumlah_bayar[$key],
                        'id_angsuran'   => $id_angsuran[$key],
                        'tgl_bayar'   => $tgl[$key],
                        'keterangan'   => $keterangan[$key],
                    );
                }
            }

            $update =  $this->db->update_batch('angsuran', $cicilan_angsuran, 'id_angsuran');
            $this->db->error();


            if ($update) {
                $this->session->set_flashdata('message', "Setoran Angsuran  Berhasil ditambahkan");
                redirect('Setoran_angsuran');
            } else {
                $this->session->set_flashdata('message', "Setoran Angsuran Gagal ditambahkan");
                redirect('Setoran_angsuran');
            }
        } else {
            $akad = $this->akad_model->getAllById(array("id_akad" => $id));

            $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));
            $this->data['akad'] = $akad[0];
            $this->data['angsuran'] = $angsuran;
            $this->data['content'] = 'admin/angsuran/view_v';
            $this->load->view('admin/layouts/page', $this->data);
        }
    }
}
