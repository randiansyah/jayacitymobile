<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Laporan_pembayaran extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('akad_model');
    $this->load->model('customer_model');
    $this->load->model('Laporan_pembayaran_model');
    $this->load->model('cicilan_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/laporan_pembayaran1/list_v';
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
    $setting_hari = 0;
    $limit = 0;
    $start = 0;
    $jatuh_tempo = $this->Laporan_pembayaran_model->getOneJatuh_tempo();
    $set = (!empty($jatuh_tempo)) ? $jatuh_tempo->set_hari : "";
    $setting_hari = "+ interval " . $set . " day";
    $totalData = $this->Laporan_pembayaran_model->getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;

  

     if (!empty($searchColumn[1]['search']['value'])) {
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $search['angsuran.id_pelanggan'] = $value;
    }

    if (!empty($searchColumn[2]['search']['value'])) {
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $where['tgl_jatuh_tempo >='] = date("Y-m-d", strtotime($value));
    }

    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $where['tgl_jatuh_tempo <='] =  date("Y-m-d", strtotime($value));
    }



    if ($isSearchColumn) {
      $totalFiltered = $this->Laporan_pembayaran_model->getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->Laporan_pembayaran_model->getAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {
   
        if ($this->data['is_can_edit']) {
          $cetak = "<a target='blank' href='" . base_url() . "bukti_pembayaran/pdf/" . $data->id_angsuran . "'><i class='fa fa-print'></i> Cetak</a> ";
        }

        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $nama = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-search'></i> ".$nama."</a> ";
     
        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_akad']  = $data->id_akad;
        $nestedData['id_invoice']  = $data->id_invoice;
        $nestedData['id_pelanggan']  = $view_url;
        $nestedData['cicilan']  = $data->cicilan;
        $nestedData['jumlah_cicilan']  = "Rp. " . number_format($data->jumlah_cicilan, 0, ".", ".");
        $nestedData['jumlah_bayar']  = "Rp. " . number_format($data->jumlah_bayar, 0, ".", ".");
        $nestedData['tgl_jatuh_tempo']  = date("d-m-Y", strtotime($data->tgl_jatuh_tempo));
        $nestedData['sisa']  = date("d-m-Y", strtotime($data->tgl_bayar));;
        $nestedData['selisih']  = $data->selisih . ' Hari';
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
}
