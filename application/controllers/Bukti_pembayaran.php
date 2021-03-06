<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Bukti_pembayaran extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('akad_model');
    $this->load->model('customer_model');
    $this->load->model('angsuran_model');
    $this->load->model('pengaturan_model');
    $this->load->model('rekening_model');
    $this->load->model('angsuran_detail_model');
    $this->load->model('cicilan_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/laporan_pembayaran/list_v';
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
      0 => 'id_angsuran',
      1 => 'id_akad',
      2 => 'id_invoice',
      3 => 'id_pelanggan',
      4 => 'cicilan',
      5 => 'jumlah_cicilan',
      6 => 'jumlah_bayar',
      7 => 'tgl_bayar',
      8 => '',
      9 => '',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->angsuran_detail_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

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
      $totalFiltered = $this->angsuran_detail_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->angsuran_detail_model->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit']) {
          $cetak = "<a target='blank' href='" . base_url() . "bukti_pembayaran/pdf/" . $data->id_angsuran . "'><i class='fa fa-file-pdf-o'></i> PDF</a> ";
          //  $edit_url = "<a href='" . base_url() . "Setoran_angsuran/bayar/" . $data->id_akad . "'><i class='fa fa-money'></i> Bayar</a> ";
        }

        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        //   $ambil_bayar = $this->angsuran_model->getSum(array("id_pelanggan" => $data->id_pelanggan));
        //   $nestedData['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        //   $terbayar = (!empty($ambil_bayar)) ? $ambil_bayar[0]->total_bayar : "";
        //    $sisa = $data->harga_jual - $terbayar;
        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_akad']  = $data->id_akad;
        $nestedData['id_invoice']  = $data->id_invoice;
        $nestedData['id_pelanggan']  = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $nestedData['cicilan']  = $data->cicilan;
        $nestedData['jumlah_cicilan']  = "Rp. " . number_format($data->jumlah_cicilan, 0, ".", ".");
        $nestedData['jumlah_bayar']  = "Rp. " . number_format($data->jumlah_bayar, 0, ".", ".");
        $nestedData['tgl_bayar']  = date("d M Y", strtotime($data->tgl_bayar));
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
    $angsuran = $this->angsuran_model->getOneByAngsuran(array("id_angsuran" => $id));
    $this->data['angsuran'] = $angsuran;
    $pengaturan = $this->pengaturan_model->getOneBy();
    $id_bank = (!empty($pengaturan)) ? $pengaturan->id_bank : "";
    $bank = $this->rekening_model->getOneBy(array("id" => $id_bank));
    $this->data['pengaturan'] = $pengaturan;
    $this->data['bank'] = $bank;

    // $this->load->library('Pdf');
    // $this->pdf->setPaper('A4', 'portrait');
    // $this->pdf->filename = "Kwitansi" . date('dmy') . ".pdf";
    // $this->pdf->load_view('admin/laporan_pembayaran/cetak_v', $this->data, true);
    $this->load->library('pdfgenerator');
        
           
        // filename dari pdf ketika didownload
        $file_pdf = 'KWITANSI';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
	     $html = $this->load->view('admin/laporan_pembayaran/cetak_v',$this->data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
  }
}
