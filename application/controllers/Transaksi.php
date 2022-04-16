<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Transaksi extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model');
    $this->load->model('hasil_survey_model');
    $this->load->model('transaksi_model');
    $this->load->model('cicilan_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/transaksi/list_v';
      $this->data['pelanggan'] = $this->hasil_survey_model->getAllById(array('hasil_survey.status' => '1'));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function dataList()
  {
    $columns = array(
      0 => 'id_transaksi',
      1 => 'id_invoice',
      2 => 'id_pelanggan',
      3 => 'nama_barang',
      4 => 'harga_jual',
      5 => 'id_cicilan',
      6 => 'tgl_jatuh_tempo',
      7 => '',
      8 => '',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->transaksi_model->getCountAllBy($limit, $start, $search, $order, $dir);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;

    if (!empty($searchColumn[1]['search']['value'])) {
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $where['id_invoice'] = $value;
    }

    if (!empty($searchColumn[2]['search']['value'])) {
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $where['transaksi.id_pelanggan'] = $value;
    }
    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $search['transaksi.id_cicilan'] = $value;
    }
    if (!empty($searchColumn[4]['search']['value'])) {
      $value = $searchColumn[4]['search']['value'];
      $isSearchColumn = true;
      $search['transaksi.tgl_jatuh_tempo'] = date("Y-m-d", strtotime($value));
    }

    if ($isSearchColumn) {
      $totalFiltered = $this->transaksi_model->getCountAllBy($limit, $start, $search, $order, $dir);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->transaksi_model->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
          $edit_url = "<a href='" . base_url() . "Transaksi/edit/" . $data->id_transaksi . "' class='btn btn-primary btn-sm white'><i class='fa fa-pencil'></i> Ubah</a>";
        } else {
          $edit_url = "";
        }
        if ($this->data['is_can_delete']) {
       
            $delete_url = "<button
                  url='" . base_url() . "Transaksi/destroy/" . $data->id_transaksi . "'
                  class='btn btn-danger btn-sm white delete' 
                   >Delete
                  </button>";
          
        }
        $nestedData['status'] = $edit_url . "  " . $delete_url;

        $lama_cicilan = $this->cicilan_model->getAllById(array('id_cicilan' => $data->id_cicilan));
        $cicilan =  (!empty($lama_cicilan)) ? $lama_cicilan[0]->nama : "";

        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_invoice']          = "<a href='" . base_url() . "transaksi/view/" . $data->id_transaksi . "'><i class='fa fa-eye'></i> " . $data->id_invoice . "</a> ";
        $nestedData['id_pelanggan']          = $data->id_pelanggan;
        $nestedData['nama']          = $data->pelanggan_nama;
        $nestedData['nama_barang']          = $data->nama_barang;
        $nestedData['harga_jual']    = number_format($data->harga_jual, 2, ',', '.');
        $nestedData['id_cicilan']    = $cicilan . " Bulan";
        $nestedData['tgl_jatuh_tempo']    = date("d-m-Y", strtotime($data->tgl_jatuh_tempo));


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


  public function create()
  {
    $this->form_validation->set_rules('no_invoice', "nomor invoice", 'trim|required');
    $date = date('y-m-d H:i:s');
    $kode = $this->customer_model->getKode();
    $id_inv = $this->transaksi_model->getKode();
    if ($this->form_validation->run() === TRUE) {

      $harga_admin1 = str_replace(".", "", $this->input->post('admin'));
      $harga_admin = str_replace("Rp", "", $harga_admin1);
      //

      $harga_partai1 = str_replace(".", "", $this->input->post('harga_partai'));
      $harga_partai = str_replace("Rp", "", $harga_partai1);
      //
      $harga_retail1 = str_replace(".", "", $this->input->post('harga_retail'));
      $harga_retail  = str_replace("Rp", "", $harga_retail1);

      $harga_jual1 = str_replace(".", "", $this->input->post('harga_jual'));
      $harga_jual  = str_replace("Rp", "", $harga_jual1);
      $tgl_beli = date("Y-m-d", strtotime($this->input->post('tgl_beli')));

      $tgl_jatuh_tempo = date("Y-m-d", strtotime($this->input->post('tgl_jatuh_tempo')));
      $data = array(
        'id_invoice' => $this->input->post('no_invoice'),
        'id_pelanggan' => $this->input->post('pelanggan'),
        'tgl_beli' => $tgl_beli,
        'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
        'nama_barang' => $this->input->post('nama_barang'),
        'merek' => $this->input->post('merek'),
        'tipe' => $this->input->post('tipe'),
        'warna' => $this->input->post('warna'),
        'sn' => $this->input->post('sn'),
        'imei1' => $this->input->post('imei1'),
        'imei2' => $this->input->post('imei2'),
        'no_lainnya' => $this->input->post('lainnya'),
        'keterangan' => $this->input->post('keterangan'),
        'admin' => $harga_admin,
        'id_cicilan' => $this->input->post('lama_cicilan'),
        'nama_toko' => $this->input->post('nama_toko'),
        'user_input' => $this->input->post('user_input'),
        'waktu_input' => $this->input->post('waktu_input'),
        'harga_partai' => $harga_partai,
        'harga_retail' => $harga_retail,
        'harga_jual' => $harga_jual,
        'is_deleted' => "0",

      );


      $insert  = $this->transaksi_model->insert($data);


      if ($insert) {
        $this->session->set_flashdata('message', "Transaksi Berhasil Disimpan");
        redirect("Transaksi");
      } else {
        $this->session->set_flashdata('message_error', "Transaksi Gagal Disimpan");
        redirect("Transaksi");
      }
    } else {

      $this->data['pelanggan'] = $this->hasil_survey_model->getAllById(array('hasil_survey.status' => '1'));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
      $this->data['content'] = 'admin/transaksi/create_v';
      $this->data['waktu_input'] = $date;
      $this->data['kode'] = 'P' . $kode;
      $this->data['inv'] = 'M' . $id_inv;

      $this->load->view('admin/layouts/page', $this->data);
    }
  }


  public function view($id)
  {
    $data = $this->transaksi_model->getAllById(array("transaksi.id_transaksi" => $id));
    $this->data['data'] = $data[0];
    $this->data['pelanggan'] = $this->hasil_survey_model->getAllById(array('hasil_survey.status' => '1'));
    $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
    $this->data['content'] = 'admin/transaksi/view_v';
    $this->data['waktu_input'] = $data[0]->waktu_input;
    $this->load->view('admin/layouts/page', $this->data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules('no_invoice', "Nama Lengkap", 'trim|required');
    $date = date('y-m-d H:i:s');
    if ($this->form_validation->run() === TRUE) {

      $harga_partai1 = str_replace(".", "", $this->input->post('harga_partai'));
      $harga_partai = str_replace("Rp", "", $harga_partai1);
      //
      $harga_retail1 = str_replace(".", "", $this->input->post('harga_retail'));
      $harga_retail  = str_replace("Rp", "", $harga_retail1);

      $harga_jual1 = str_replace(".", "", $this->input->post('harga_jual'));
      $harga_jual  = str_replace("Rp", "", $harga_jual1);
      $tgl_beli = date("Y-m-d", strtotime($this->input->post('tgl_beli')));
      $tgl_jatuh_tempo = date("Y-m-d", strtotime($this->input->post('tgl_jatuh_tempo')));
      $data = array(
        'id_invoice' => $this->input->post('no_invoice'),
        'id_pelanggan' => $this->input->post('pelanggan'),
        'tgl_beli' => $tgl_beli,
        'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
        'nama_barang' => $this->input->post('nama_barang'),
        'merek' => $this->input->post('merek'),
        'tipe' => $this->input->post('tipe'),
        'warna' => $this->input->post('warna'),
        'sn' => $this->input->post('sn'),
        'imei1' => $this->input->post('imei1'),
        'imei2' => $this->input->post('imei2'),
        'no_lainnya' => $this->input->post('lainnya'),
        'keterangan' => $this->input->post('keterangan'),
        'admin' => $this->input->post('admin'),
        'id_cicilan' => $this->input->post('lama_cicilan'),
        'nama_toko' => $this->input->post('nama_toko'),
        'user_input' => $this->input->post('user_input'),
        'waktu_input' => $this->input->post('waktu_input'),
        'harga_partai' => $harga_partai,
        'harga_retail' => $harga_retail,
        'harga_jual' => $harga_jual,
        'is_deleted' => "0"

      );


      $update  = $this->transaksi_model->update($data, array('id_transaksi' => $id));


      if ($update) {
        $this->session->set_flashdata('message', "Transaksi Berhasil diubah");
        redirect("Transaksi");
      } else {
        $this->session->set_flashdata('message_error', "Transaksi Gagal diubah");
        redirect("Transaksi");
      }
    } else {
      $data = $this->transaksi_model->getAllById(array("transaksi.id_transaksi" => $id));
      $this->data['data'] = $data[0];
      $this->data['pelanggan'] = $this->hasil_survey_model->getAllById(array('hasil_survey.status' => '1'));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();

      $this->data['content'] = 'admin/transaksi/edit_v';
      $this->data['waktu_input'] = $date;
      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  public function destroy()
  {
    $response_data = array();
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = array();
    $id = $this->uri->segment(3);
    $is_deleted = $this->uri->segment(4);
    if (!empty($id)) {
      $this->load->model("transaksi_model");
    
      $data = array();
      $this->transaksi_model->delete(array("id_transaksi" => $id));
      $response_data['data'] = $data;
      $response_data['status'] = true;
    } else {
      $response_data['msg'] = "ID KOSONG";
    }

    echo json_encode($response_data);
  }
}
