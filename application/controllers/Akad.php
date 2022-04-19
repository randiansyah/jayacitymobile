<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Akad extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model');
    $this->load->model('hasil_survey_model');
    $this->load->model('transaksi_model');
    $this->load->model('cicilan_model');
    $this->load->model('akad_model');
    $this->load->model('angsuran_model');
    $this->load->model('brand_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/akad/list_v';
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
      0 => 'id',
      1 => 'nomor_akad',
      2 => 'id_invoice',
      3 => 'id_pelanggan',
      4 => 'nama',
      5 => 'tgl_akad',
      6 => 'lama_cicilan',
      7 => 'harga_jual',
      8 => 'uang_muka',
      9 => 'bunga',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->akad_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

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
      $where['akad.id_pelanggan'] = $value;
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
      $totalFiltered = $this->akad_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->akad_model->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
          $edit_url = "<a href='" . base_url() . "akad/edit/" . $data->id_akad . "' class='btn btn-primary btn-sm white'><i class='fa fa-pencil'></i> Ubah</a>
          <a href='" . base_url() . "akad/editPrice/" . $data->id_akad . "' class='btn btn-success btn-sm white'><i class='fa fa-pencil'></i> Ubah Harga</a>";
        } else {
          $edit_url = "";
        }
        if ($this->data['is_can_delete']) {

          $delete_url = "<button
              url='" . base_url() . "akad/destroy/" . $data->id_akad . "/" . $data->is_deleted . "'
              class='btn btn-danger btn-sm white delete' ><i class='fa fa-trash'></i>&nbsp;Hapus
              </button>";
        }
        $nestedData['aksi'] = $edit_url . "  " . $delete_url;
        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $nestedData['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $nestedData['id']   = $start + $key + 1;
        $nestedData['nomor_akad']          = "<a href='" . base_url() . "akad/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> " . $data->nomor_akad . "</a> ";
        $nestedData['id_invoice']          = $data->id_invoice;
        $nestedData['akad_versi']          = $data->akad_versi;
        $nestedData['id_pelanggan']          = $data->id_pelanggan;
        $nestedData['tgl_akad']    = date("d-m-Y", strtotime($data->tgl_akad));
        $nestedData['margin_keuntungan']    = number_format($data->margin_keuntungan, 2, ',', '.');
        $nestedData['harga_jual']    = number_format($data->harga_jual, 2, ',', '.');
        $nestedData['uang_muka']    = number_format($data->uang_muka, 2, ',', '.');
        $nestedData['lama_cicilan']    = $data->lama_cicilan . ' Bulan';

        if ($data->bunga > 100) {
          $manual = number_format($data->bunga, 0, ',', '.') . ' /BLN';
        } else {
          $manual = $data->bunga . ' %';
        }

        $nestedData['bunga']          = $manual;
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
    $this->form_validation->set_rules('id_pelanggan', "Pelanggan tidak boleh kosong", 'trim|required');
    $date = date('y-m-d H:i:s');
    $kode = $this->customer_model->getKode();
    $id_inv = $this->transaksi_model->getKode();
    if ($this->form_validation->run() === TRUE) {

      //
      $harga_jual1 = str_replace(".", "", $this->input->post('harga_jual'));
      $harga_jual = str_replace("Rp", "", $harga_jual1);


      $uang_muka1 = str_replace(".", "", $this->input->post('uang_muka'));
      $uang_muka  = str_replace("Rp", "", $uang_muka1);

      $totalDP = $harga_jual - $uang_muka;

      $bungaFlat = $this->input->post('bunga');
      $bungaManual = $this->input->post('bungaManual');
      $cicilan = $this->input->post('lama_cicilan');

      if (empty($bungaFlat)) {
        $bunga1 = str_replace(".", "", $this->input->post('bungaManual'));
        $bunga = str_replace("Rp", "", $bunga1);

        $totalBunga =  $bunga;
        $totalBC = ($bunga * $cicilan);
        $total = ($totalDP + $totalBC);
        $totalnya = $bunga;
        $bungaInput = $bunga;
      } else if (empty($bungaManual)) {
        $bunga1 = $this->input->post('bunga') / 100;
        $totalBunga =  ($totalDP * $bunga1);
        $totalnya = ($totalDP * $bunga1) / $cicilan;
        $total = ($totalDP + $totalBunga);
        $bungaInput = $this->input->post('bunga');
      }

      $pokok = $totalDP / $cicilan;
      $bunga = $totalnya;
      $jumlah_cicilan = ($pokok + $bunga);



      $uang_muka1 = str_replace(".", "", $this->input->post('uang_muka'));
      $uang_muka  = str_replace("Rp", "", $uang_muka1);

      $tgl_jatuh_tempo = date("Y-m-d", strtotime($this->input->post('tgl_jatuh_tempo')));
      $tgl_akad = date("Y-m-d", strtotime($this->input->post('tgl_akad')));


      $data = array(
        'id_pelanggan' => $this->input->post('id_pelanggan'),
        'id_invoice' => $this->input->post('id_invoice'),
        'nomor_akad' => $this->input->post('nomor_akad'),
        'tgl_akad' => $tgl_akad,
        'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
        'lama_cicilan' => $this->input->post('lama_cicilan'),
        'harga_jual' => $harga_jual,
        'uang_muka' => $uang_muka,
        'total' => $total,
        'bunga' => $bungaInput,
        'user_input' => $this->input->post('user_input'),
        'waktu_input' => $this->input->post('waktu_input'),
        'is_deleted' => 0,
      );


      $insert  = $this->akad_model->insert($data);
      $last_id = $this->db->insert_id();


      if ($insert) {

        $angsuran = array();



        $tgl_jatuh_tempo = mktime(0, 0, 0, date("m", strtotime($tgl_jatuh_tempo)) - 1, date("d", strtotime($tgl_jatuh_tempo)), date("Y", strtotime($tgl_jatuh_tempo)));
        $tgl_jatuh_tempo = date("Y-m-d 00:00:00", $tgl_jatuh_tempo);
        for ($i = 1; $i <= $cicilan; $i++) {
          $tgl_jatuh_tempo = mktime(0, 0, 0, date("m", strtotime($tgl_jatuh_tempo)) + 1, date("d", strtotime($tgl_jatuh_tempo)), date("Y", strtotime($tgl_jatuh_tempo)));
          $tgl_jatuh_tempo = date("Y-m-d", $tgl_jatuh_tempo);
          $angsuran[] = array(
            'cicilan' => $i,
            'id_akad' => $last_id,
            'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
            'id_invoice' => $this->input->post('id_invoice'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'keterangan' => "Angsuran ke " . $i,
            'bunga' => $bunga,
            'jumlah_cicilan' => $jumlah_cicilan,
            'status' => '0',
            'is_deleted' => '0',
          );
        }

        $this->db->insert_batch('angsuran', $angsuran);
        $this->session->set_flashdata('message', "Transaksi Berhasil Disimpan");
        redirect("Akad");
      } else {
        $this->session->set_flashdata('message_error', "Transaksi Gagal Disimpan");
        redirect("Akad");
      }
    } else {

      $this->data['pelanggan'] = $this->transaksi_model->getAllById(array("transaksi.is_deleted" => 0));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
      $this->data['content'] = 'admin/akad/create_v';
      $this->data['waktu_input'] = $date;

      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  public function getPelanggan()
  {
    $response_data = array();
    $id_pelanggan = $this->input->get('pelanggan');
    $data = array();
    $data = $this->transaksi_model->getAllById();


    $response_data['data'] = $data;
    echo json_encode($response_data);
  }

  public function dataPelanggan($id)
  {
    $date = date('y-m-d H:i:s');
    $transaksi = $this->transaksi_model->getAllById(array('id_invoice' => $id));
    $idPelanggan = (!empty($transaksi)) ? $transaksi[0]->id_pelanggan : "";
    $pelanggan = $this->customer_model->getOneByID(array('id_pelanggan' => $idPelanggan));
    $this->data['brand'] = $this->brand_model->getAllById();

    $this->data['pelanggan'] = $pelanggan[0];
    $this->data['transaksi'] = $transaksi[0];
    $this->data['content'] = 'admin/akad/dataPelanggan_v';
    $this->data['waktu_input'] = $date;
    $this->load->view('admin/layouts/page_detail', $this->data);
  }



  public function view($id)
  {
    $date = date('y-m-d H:i:s');
    $data = $this->akad_model->getAllById(array("akad.id_akad" => $id));
    $this->data['data'] = $data[0];

    $this->data['pelanggan'] = $this->transaksi_model->getAllById(array("is_deleted" => 0));
    $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
    $this->data['content'] = 'admin/akad/view_v';
    $this->data['waktu_input'] = $date;
    $this->load->view('admin/layouts/page', $this->data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules('id_pelanggan', "Pelanggan tidak boleh kosong", 'trim|required');
    $date = date('y-m-d H:i:s');
    $kode = $this->customer_model->getKode();
    $id_inv = $this->transaksi_model->getKode();
    if ($this->form_validation->run() === TRUE) {


      $harga_jual1 = str_replace(".", "", $this->input->post('harga_jual'));
      $harga_jual = str_replace("Rp", "", $harga_jual1);

      $uang_muka1 = str_replace(".", "", $this->input->post('uang_muka'));
      $uang_muka  = str_replace("Rp", "", $uang_muka1);


      $tgl_jatuh_tempo = date("Y-m-d", strtotime($this->input->post('tgl_jatuh_tempo')));
      $tgl_akad = date("Y-m-d", strtotime($this->input->post('tgl_akad')));

      $bungaFlat = $this->input->post('bunga');
      $bungaManual = $this->input->post('bungaManual');
      $cicilan = $this->input->post('lama_cicilan');

      $totalDP = $harga_jual - $uang_muka;

      if (empty($bungaFlat)) {
        $bunga1 = str_replace(".", "", $this->input->post('bungaManual'));
        $bunga = str_replace("Rp", "", $bunga1);

        $totalBunga =  $bunga;
        $totalBC = ($bunga * $cicilan);
        $total = ($totalDP + $totalBC);
        $totalnya = $bunga;
        $bungaInput = $bunga;
      } else if (empty($bungaManual)) {
        $bunga1 = $this->input->post('bunga') / 100;
        $totalBunga =  ($totalDP * $bunga1);
        $totalnya = ($totalDP * $bunga1) / $cicilan;
        $total = ($totalDP + $totalBunga);
        $bungaInput = $this->input->post('bunga');
      }

      $pokok = $totalDP / $cicilan;
      $bunga = $totalnya;
      $jumlah_cicilan = ($pokok + $bunga);


      $data = array(
        'id_pelanggan' => $this->input->post('id_pelanggan'),
        'id_invoice' => $this->input->post('id_invoice'),
        'nomor_akad' => $this->input->post('nomor_akad'),
        'tgl_akad' => $tgl_akad,
        'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
        'lama_cicilan' => $this->input->post('lama_cicilan'),
        'harga_jual' => $harga_jual,
        'uang_muka' => $uang_muka,
        'total' => $total,
        'bunga' => $bungaInput,
        'user_input' => $this->input->post('user_input'),
        'waktu_input' => $this->input->post('waktu_input'),
        'is_deleted' => 0,
      );


      $update  = $this->akad_model->update($data, array("id_akad" => $id));
      //   $last_id = $this->db->insert_id();

      if ($update) {
        $this->angsuran_model->delete(array("id_akad" => $id));
        $angsuran = array();
        $cicilan = $this->input->post('lama_cicilan');
        $jumlah_cicilan = $harga_jual / $cicilan;
        $tgl_jatuh_tempo = mktime(0, 0, 0, date("m", strtotime($tgl_jatuh_tempo)) - 1, date("d", strtotime($tgl_jatuh_tempo)), date("Y", strtotime($tgl_jatuh_tempo)));
        $tgl_jatuh_tempo = date("Y-m-d", $tgl_jatuh_tempo);

        for ($i = 1; $i <= $cicilan; $i++) {
          $tgl_jatuh_tempo = mktime(0, 0, 0, date("m", strtotime($tgl_jatuh_tempo)) + 1, date("d", strtotime($tgl_jatuh_tempo)), date("Y", strtotime($tgl_jatuh_tempo)));
          $tgl_jatuh_tempo = date("Y-m-d", $tgl_jatuh_tempo);
          $angsuran[] = array(
            'cicilan' => $i,
            'id_akad' => $id,
            'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
            'id_invoice' => $this->input->post('id_invoice'),
            'keterangan' => "Angsuran ke " . $i,
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'pokok' => $pokok,
            'bunga' => $bunga,
            'jumlah_cicilan' => $jumlah_cicilan,
            'status' => '0',
            'is_deleted' => '0',
          );
        }

        $this->db->insert_batch('angsuran', $angsuran);
        $this->session->set_flashdata('message', "Transaksi Berhasil Diubah");
        redirect("Akad");
      } else {
        $this->session->set_flashdata('message_error', "Transaksi Gagal Diubah");
        redirect("Akad");
      }
    } else {
      $data = $this->akad_model->getAllById(array("akad.id_akad" => $id));
      $this->data['data'] = $data[0];

      $this->data['pelanggan'] = $this->transaksi_model->getAllById(array("is_deleted" => 0));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
      $this->data['content'] = 'admin/akad/edit_v';
      $this->data['waktu_input'] = $date;

      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  public function editPrice($id)
  {
    $this->form_validation->set_rules('nomor_akad', "Pelanggan tidak boleh kosong", 'trim|required');
    $akad = $this->akad_model->getAllById(array("id_akad" => $id));

    if ($this->form_validation->run() === TRUE) {

      $id_akad = $this->input->post('id_akad');
      $id_angsuran = $this->input->post('id_angsuran');
      $id_invoice = $this->input->post('id_invoice');
      $tgl = $this->input->post('tgl_bayar');


      $no = $this->input->post('no');
      $jumlah_bayar1 = str_replace(".", "", $this->input->post('bayar'));
      $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);


      $cicilan_angsuran = array();
      foreach ($no as $key => $val) {

        if ($no[$key] > 0) {


          $tgl_bayar[$key] = date("Y-m-d", strtotime($tgl[$key]));
          $cicilan_angsuran[] = array(
            'id_akad'   => $id_akad,
            'jumlah_cicilan'   => $jumlah_bayar[$key],
            'tgl_jatuh_tempo'   =>  $tgl_bayar[$key],
            'id_angsuran'   => $id_angsuran[$key]
          );
        }
      }

      $update =  $this->db->update_batch('angsuran', $cicilan_angsuran, 'id_angsuran');
      $this->db->error();

      if ($update) {


        $this->session->set_flashdata('message', "Harga Angsuran  Berhasil diubah");
        redirect('Akad');
      } else {
        $this->session->set_flashdata('message', "Harga Angsuran Gagal diubah");
        redirect('Akad');
      }
    } else {
      $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));
      $id_pelanggan = (!empty($akad)) ? $akad[0]->id_pelanggan : "";
      $id_invoice = (!empty($akad)) ? $akad[0]->id_invoice : "";
      $transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $id_invoice));

      $this->data['akad'] = $akad[0];
      $this->data['transaksi'] = $transaksi;
      $this->data['angsuran'] = $angsuran;
      $this->data['content'] = 'admin/akad/editPrice_v';
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
      $this->load->model("akad_model");
      $this->load->model("angsuran_model");

      $data = array();
      $this->akad_model->delete(array("id_akad" => $id));

      $this->angsuran_model->delete(array("id_akad" => $id));

      $response_data['data'] = $data;
      $response_data['status'] = true;
    } else {
      $response_data['msg'] = "ID KOSONG";
    }

    echo json_encode($response_data);
  }
}
