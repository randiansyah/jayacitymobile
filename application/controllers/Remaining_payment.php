<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Remaining_payment extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model');
    $this->load->model('akad_model');
    $this->load->model('angsuran_model');
    $this->load->model('karyawan_model');
    $this->load->model('transaksi_model');
    $this->load->model('angsuran_titipan_model');
    $this->load->model('cicilan_model');
    $this->load->model('pengaturan_model');
    $this->load->model('rekening_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/remaining_payment/list_v';
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
      1 => 'total',
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
    if ($this->ion_auth->is_admin()) {

      $where = array();
    } else {
      $id = $this->data['users']->id;
      $where['id_pelanggan'] = $id;
    }

    $limit = 0;
    $start = 0;

    $isSearchColumn = false;

    $datas = $this->angsuran_model->getAllByCustomer($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit']) {
          $view_url = "<a href='" . base_url() . "Remaining_payment/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> Rincian</a> ";
          $edit_url = "<a href='" . base_url() . "Remaining_payment/bayar/" . $data->id_akad . "'><i class='fa fa-money'></i> Bayar</a> ";
        }


        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $get_product = $this->transaksi_model->getAllById(array("id_invoice" => $data->id_invoice));
        $ambil_bayar = $this->angsuran_model->getSum(array("id_akad" => $data->id_akad));
        $nestedData['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $terbayar = (!empty($ambil_bayar)) ? $ambil_bayar[0]->total_bayar : "";
        $sisa = $data->total - $terbayar;
        $nestedData['id']   = (!empty($get_product)) ? $get_product[0]->nama_barang : "";
        $nestedData['nomor_akad']          =  $data->nomor_akad;
        $nestedData['id_pelanggan']          = $data->id_pelanggan;
        $nestedData['id_invoice']          = $data->id_invoice;
        $nestedData['tgl_akad']    = date("d-m-Y", strtotime($data->tgl_akad));
        $nestedData['harga_jual']    = number_format($data->harga_jual, 0, ',', '.');
        $nestedData['total']    = number_format($data->total, 0, ',', '.');
        $nestedData['terbayar'] = number_format($terbayar, 0, ',', '.');
        $nestedData['sisa_pembayaran'] = number_format($sisa, 0, ',', '.');
        $nestedData['aksi'] =  $view_url;


        $new_data[] = $nestedData;
      }
    }

    $json_data = array(
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
      $jumlah_cicilan = $this->input->post('jumlah_cicilan');


      $no = $this->input->post('no');
      $jumlah_cicilan = $this->input->post('jumlah_cicilan');
      $jumlah_bayar1 = str_replace(".", "", $this->input->post('bayar'));
      $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);
      $date = date("Y-m-d");

      $cicilan_angsuran = array();
      foreach ($no as $key => $val) {

        if ($no[$key] > 0) {
          $sisa[$key] = $jumlah_cicilan[$key] - $jumlah_bayar[$key];

          if ($sisa[$key] <= "0") {
            $status[$key] = "1";
          } else {
            $status[$key] = "0";
          }

          $tgl_bayar[$key] = date("Y-m-d", strtotime($tgl[$key]));
          $cicilan_angsuran[] = array(
            'id_akad'   => $id_akad,
            'id_pelanggan'   => $id_pelanggan,
            'id_invoice'     => $id_invoice,
            'jumlah_bayar'   => $jumlah_bayar[$key],
            'id_angsuran'   => $id_angsuran[$key],
            'tgl_bayar'   => $tgl[$key],
            'keterangan'   => $keterangan[$key],
            'status' => $status[$key],
            'created_on' =>  $tgl_bayar[$key],
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
    $this->pdf->filename = "Kwitansi" . date('dmy') . ".pdf";
    $this->pdf->load_view('admin/laporan_pembayaran/cetak_v', $this->data, true);
  }

  function cetak_kartu()
  {

    $id = $this->uri->segment(3);
    $akad = $this->akad_model->getAllById(array("id_akad" => $id));

    $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));

    $this->data['akad'] = $akad[0];
    $this->data['angsuran'] = $angsuran;
    $pengaturan = $this->pengaturan_model->getOneBy();
    $this->data['pengaturan'] = $pengaturan;

    $this->load->library('Pdf');
    $this->pdf->setPaper('A4', 'portrait');
    $this->pdf->filename = "Kwitansi" . date('dmy') . ".pdf";
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
      $id_pelanggan = (!empty($akad)) ? $akad[0]->id_pelanggan : "";
      $id_invoice = (!empty($akad)) ? $akad[0]->id_invoice : "";
      $pelanggan = $this->customer_model->getOneBy(array("id_pelanggan" => $id_pelanggan));
      $transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $id_invoice));

      $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));
      $this->data['akad'] = $akad[0];
      $this->data['pelanggan'] = $pelanggan;
      $this->data['karyawan'] = $this->karyawan_model;
      $this->data['angsuran'] = $angsuran;
      $this->data['transaksi'] = $transaksi;
      $this->data['content'] = 'admin/remaining_payment/view_v';
      $this->load->view('admin/layouts/page', $this->data);
    }
  }
}
