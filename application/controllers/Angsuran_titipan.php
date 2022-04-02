<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Angsuran_titipan extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model');
    $this->load->model('akad_model');
    $this->load->model('angsuran_model');
    $this->load->model('cicilan_model');
    $this->load->model('angsuran_titipan_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/angsuran_titipan/list_v';
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
          $view_url = "<a href='" . base_url() . "Angsuran_titipan/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> Rincian</a> ";
          $edit_url = "<a href='" . base_url() . "Angsuran_titipan/bayar/" . $data->id_akad . "'><i class='fa fa-money'></i> Bayar</a> ";
        }

        if ($this->data['is_can_delete']) {
          $delete_url = "<a href='#' 
                    url='" . base_url() . "Akad/destroy/" . $data->id_akad . "'
                    class='delete' 
                     ><i class='fa fa-trash'></i>&nbsp;Hapus
                    </a>";
        }
        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $ambil_bayar = $this->angsuran_titipan_model->getSum(array("id_akad" => $data->id_akad));
        $nestedData['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $terbayar = (!empty($ambil_bayar)) ? $ambil_bayar[0]->total_bayar : "";
        $sisa = $data->harga_jual - $terbayar;
        $nestedData['id']   = $start + $key + 1;
        $nestedData['nomor_akad']          = "<a href='" . base_url() . "akad/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> " . $data->nomor_akad . "</a> ";
        $nestedData['id_pelanggan']          = $data->id_pelanggan;
        $nestedData['id_invoice']          = $data->id_invoice;
        $nestedData['tgl_akad']    = date("d-m-Y", strtotime($data->tgl_akad));
        $nestedData['harga_jual']    = number_format($data->harga_jual, 0, ',', '.');
        $nestedData['lama_cicilan']    = $data->lama_cicilan . ' Bulan';
        $nestedData['terbayar'] = "<a href='" . base_url() . "Angsuran_titipan/view/" . $data->id_akad . "'><i class='fa fa-money'></i>&nbsp;&nbsp;" . number_format($terbayar, 0, ',', '.') . "</a> ";;
        $nestedData['sisa_pembayaran'] = number_format($sisa, 0, ',', '.');
        $nestedData['aksi'] = $edit_url;


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
      $id_pelanggan = $this->input->post('id_pelanggan');
      $id_invoice = $this->input->post('id_invoice');
      $tgl = $this->input->post('tgl_bayar');
      $no = $this->input->post('no');
      $nama = $this->input->post('nama');
      $keterangan = $this->input->post('keterangan');

      $jumlah_bayar1 = str_replace(".", "", $this->input->post('jumlah_bayar'));
      $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);

      $data = array(
        'id_pelanggan'   => $id_pelanggan,
        'id_akad'   => $id_akad,
        'id_invoice'     => $id_invoice,
        'jumlah_bayar'   => $jumlah_bayar,
        'id_angsuran'   => $id_angsuran,
        'tgl_bayar'   => date("Y-m-d", strtotime($tgl)),
        'status' => '1',
        'nama' => $nama,
        'keterangan' => $keterangan,
        'created_on' => date("Y-m-d", strtotime($tgl))
      );
      $insert =  $this->angsuran_titipan_model->insert($data);
      $last_id = $this->db->insert_id();
      if ($insert) {
        /*
                // $angsuran_titipan = $this->angsuran_titipan_model->getAllById(array("id_at" => $last_id));
                $angsuran = $this->angsuran_titipan_model->getSum(array("id_angsuran" => $id_angsuran));
                $jumlah = (!empty($angsuran)) ? $angsuran[0]->total_bayar : "";

                $data = array(
                    'jumlah_bayar' => $jumlah,
                    'tgl_bayar'   => date("Y-m-d", strtotime($tgl)),
                );
                $update =  $this->angsuran_model->update($data, array("id_angsuran" => $id_angsuran));
               */
        $this->session->set_flashdata('message', "Dana Titipan Berhasil ditambahkan");
        redirect('angsuran_titipan');
      } else {
        $this->session->set_flashdata('message', "Dana Titipan Gagal ditambahkan");
        redirect('angsuran_titipan');
      }
    } else {

      $akad = $this->akad_model->getAllById(array("id_akad" => $id));
      $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id, "angsuran.jumlah_bayar>" => 1));
      $cicilan = $this->angsuran_model->getAllByIdOption(array("id_akad" => $id));
      $dana_titipan = $this->angsuran_titipan_model->getSum(array("id_akad" => $id));
      $terbayar = (!empty($dana_titipan)) ? $dana_titipan[0]->total_bayar : "";
      $this->data['akad'] = $akad[0];
      $this->data['angsuran'] = $angsuran;
      $this->data['cicilan'] = $cicilan;
      $this->data['dana_titipan'] = $terbayar;
      $this->data['content'] = 'admin/angsuran_titipan/bayar_v';
      $this->load->view('admin/layouts/page', $this->data);
    }
  }


  public function view($id)
  {

    $date = date('y-m-d H:i:s');

    $akad = $this->akad_model->getAllById(array("id_akad" => $id));

    $angsuran = $this->angsuran_titipan_model->getAllById(array("id_akad" => $id));
    $id_angsuran = (!empty($angsuran)) ? $angsuran[0]->id_angsuran : "";
    $cicilan = $this->angsuran_model->getOneByAngsuran(array("angsuran.id_angsuran" => $id_angsuran));
    $this->data['akad'] = $akad[0];
    $this->data['angsuran'] = $angsuran;
    $this->data['cicilan'] = (!empty($cicilan)) ? $cicilan->cicilan : "";
    $this->data['content'] = 'admin/angsuran_titipan/view_v';
    $this->load->view('admin/layouts/page', $this->data);
  }
}
