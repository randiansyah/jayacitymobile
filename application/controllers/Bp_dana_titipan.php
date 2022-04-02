<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Bp_dana_titipan extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('akad_model');
        $this->load->model('customer_model');
        $this->load->model('angsuran_model');
        $this->load->model('pengaturan_model');
        $this->load->model('rekening_model');
        $this->load->model('cicilan_model');
        $this->load->model('dana_titipan_model');
    }
    public function index()
    {
        $this->load->helper('url');
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/laporan_pembayaran/list_dana_v';
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
            1 => '',
            2 => '',
            3 => '',
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
        $totalData = $this->dana_titipan_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        if (!empty($searchColumn[1]['search']['value'])) {
            $value = $searchColumn[1]['search']['value'];
            $isSearchColumn = true;
            $where['status'] = $value;
        }

        if (!empty($searchColumn[2]['search']['value'])) {
            $value = $searchColumn[2]['search']['value'];
            $isSearchColumn = true;
            $where['id_pelanggan'] = $value;
        }

        if (!empty($searchColumn[3]['search']['value'])) {
            $value = $searchColumn[3]['search']['value'];
            $isSearchColumn = true;
            $where['cicilan'] = $value;
        }
        if (!empty($searchColumn[4]['search']['value'])) {
            $value = $searchColumn[4]['search']['value'];
            $isSearchColumn = true;
            $where['tgl_bayar >='] = date("Y-m-d", strtotime($value));
        }

        if (!empty($searchColumn[5]['search']['value'])) {
            $value = $searchColumn[5]['search']['value'];
            $isSearchColumn = true;
            $where['tgl_bayar <='] =  date("Y-m-d", strtotime($value));
        }




        if ($isSearchColumn) {
            $totalFiltered = $this->dana_titipan_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->dana_titipan_model->getAllBy($limit, $start, $search, $order, $dir, $where);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($this->data['is_can_edit']) {
                    $cetak = "<a target='blank' href='" . base_url() . "bp_dana_titipan/pdf/" . $data->id_at . "'><i class='fa fa-print'></i> Cetak</a> ";
                }

                $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
                $ambil_cicilan = $this->angsuran_model->getOneByAngsuran(array("id_angsuran" => $data->id_angsuran));
                $nestedData['id']   = $start + $key + 1;
                $nestedData['id_invoice']  = $data->id_invoice;
                $nestedData['id_pelanggan']  = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
                $nestedData['nama']  = $data->nama;
                $nestedData['cicilan']  = (!empty($ambil_cicilan)) ? $ambil_cicilan->cicilan : "";
                $nestedData['jumlah_bayar']  = "Rp. " . number_format($data->jumlah_bayar, 0, ".", ".");
                $nestedData['tgl_bayar']  = date("d M Y", strtotime($data->tgl_bayar));
                $nestedData['keterangan']  = $data->keterangan;
                $nestedData['aksi'] = $cetak;


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




    function pdf()
    {

        $id = $this->uri->segment(3);
        $angsuran = $this->dana_titipan_model->getOneBy(array("id_at" => $id));
        $this->data['angsuran'] = $angsuran;
        $pengaturan = $this->pengaturan_model->getOneBy();
        $id_bank = (!empty($pengaturan)) ? $pengaturan->id_bank : "";
        $bank = $this->rekening_model->getOneBy(array("id" => $id_bank));
        $this->data['pengaturan'] = $pengaturan;
        $this->data['bank'] = $bank;

        $this->load->library('Pdf');
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Kwitansi_dana_titipan" . date('dmy') . ".pdf";
        $this->pdf->load_view('admin/laporan_pembayaran/cetak_danaT_v', $this->data, true);
    }
}
