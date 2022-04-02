<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Laporan_lunas extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('akad_model');
    $this->load->model('customer_model');
    $this->load->model('Laporan_lunas_model');
    $this->load->model('cicilan_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/laporan_lunas/list_v';
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
    $totalData = $this->Laporan_lunas_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

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
      $where['angsuran.tgl_bayar >='] = date("d-m-Y", strtotime($value));
    }

    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $where['angsuran.tgl_bayar <='] =  date("d-m-Y", strtotime($value));
    }



    if ($isSearchColumn) {
      $totalFiltered = $this->Laporan_lunas_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->Laporan_lunas_model->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit']) {
         // $cetak = "<a target='blank' href='" . base_url() . "bukti_pembayaran/pdf/" . $data->id_angsuran . "'><i class='fa fa-print'></i> Cetak</a> ";
        }

     
        $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/". $data->akad ."'><i class='fa fa-search'></i> ".$data->nama."</a> ";
        if($data->jumlah_angsuran == $data->jumlah_pembayaran){
            $keterangan = "Lunas";
        } else {
            $keterangan = "Belum Lunas";  
        }
        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_pelanggan']  = $view_url;
        $nestedData['jumlah_cicilan']  ="Rp." . number_format($data->jumlah_angsuran, 0, ".", ".");;
        $nestedData['jumlah_bayar']  = "Rp. " . number_format($data->jumlah_pembayaran, 0, ".", ".");;
        $nestedData['keterangan']  = $keterangan;

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
