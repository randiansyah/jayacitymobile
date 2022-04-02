<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Hasil_survey extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model');
    $this->load->model('hasil_survey_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/hasil_survey/list_v';
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function dataList()
  {
    $columns = array(
      0 => 'id',
      1 => 'id_pelanggan',
      2 => 'nama',
      3 => 'ktp',
      4 => 'tanggal',
      5 => 'DFHS',
      6 => 'nama_surveyor',
      7 => 'status',
      8 => '',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $limit = 0;
    $start = 0;
    $where = array();
    $totalData = $this->hasil_survey_model->getCountAllBy($limit, $start, $search, $order, $dir);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;
    if (!empty($searchColumn[1]['search']['value'])) {
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $where['nama'] = $value;
    }

    if (!empty($searchColumn[2]['search']['value'])) {
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $where['ktp'] = $value;
    }
    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $search['hasil_survey.status'] = $value;
    }


    if ($isSearchColumn) {
      $totalFiltered = $this->hasil_survey_model->getCountAllBy($limit, $start, $search, $order, $dir);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->hasil_survey_model->getAllByJOIN($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit']) {
          $edit_url = "<a href='" . base_url() . "Hasil_survey/edit/" . $data->id_hasil_survey . "'><i class='fa fa-pencil'></i> Edit</a> ";
        }

        if ($this->data['is_can_delete']) {
          $delete_url = "<a href='#' 
                  url='" . base_url() . "Hasil_survey/destroy/" . $data->id_hasil_survey . "'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
        }



        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_pelanggan']          = "<a href='" . base_url() . "Hasil_survey/view/" . $data->id_hasil_survey . "'><i class='fa fa-eye'></i> " . $data->id_hasil_survey . "</a> ";;
        $nestedData['nama']          = $data->nama;
        $nestedData['ktp']          = $data->ktp;
        $nestedData['tanggal']    = $data->tanggal;
        $nestedData['DFHS']    = $data->DFHS;
        $nestedData['nama_surveyor']    = $data->nama_surveyor;
        if ($data->PS > 0) {
          $nestedData['status']    = "YA";
        } else {
          $nestedData['status']    = "TIDAK";
        }

        $nestedData['action'] = $edit_url . " " . $delete_url;


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
    $this->form_validation->set_rules('pelanggan', "Nama Lengkap", 'trim|required');
    $date = date('y-m-d H:i:s');
    $kode = $this->customer_model->getKode();
    if ($this->form_validation->run() === TRUE) {
      $config['upload_path']          = './assets/upload/image';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['overwrite']      = true;
      $config['max_size']    = 12024;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('foto_pelanggan')) {
        $error = array('error' => $this->upload->display_errors());

        $this->session->set_flashdata('message_error', "photo Gagal di upload");
        redirect("Hasil_survey/create", "refresh");
      } else {
        $this->load->library('image_lib');
        $this->upload->do_upload('foto_pelanggan');
        $file1 =   $this->upload->data();
        $foto_pelanggan = $file1['file_name'];

        $this->upload->do_upload('foto_ktp');
        $file2 = $this->upload->data();
        $foto_ktp = $file2['file_name'];

        $this->upload->do_upload('foto_dl');
        $file3 = $this->upload->data();
        $foto_dl = $file3['file_name'];

        $this->upload->do_upload('foto_dl');
        $file4 = $this->upload->data();
        $foto_dl1 = $file4['file_name'];


        $configer1 =  array(
          'image_library'   => 'gd2',
          'source_image'    =>  $file1['full_path'],
          'maintain_ratio'  =>  TRUE,
          'quality' => '40%', //tell CI to reduce the image quality and affect the image size
          // 'width' => 640, //new size of image
          // 'height' => 480, //new size of image
        );
        $configer2 =  array(
          'image_library'   => 'gd2',
          'source_image'    =>  $file2['full_path'],
          'maintain_ratio'  =>  TRUE,
          'quality' => '40%', //tell CI to reduce the image quality and affect the image size
          // 'width' => 640, //new size of image
          // 'height' => 480, //new size of image
        );
        $configer3 =  array(
          'image_library'   => 'gd2',
          'source_image'    =>  $file3['full_path'],
          'maintain_ratio'  =>  TRUE,
          'quality' => '40%', //tell CI to reduce the image quality and affect the image size
          // 'width' => 640, //new size of image
          // 'height' => 480, //new size of image
        );
        $configer4 =  array(
          'image_library'   => 'gd2',
          'source_image'    =>  $file4['full_path'],
          'maintain_ratio'  =>  TRUE,
          'quality' => '40%', //tell CI to reduce the image quality and affect the image size
          // 'width' => 640, //new size of image
          // 'height' => 480, //new size of image
        );

        $this->image_lib->clear();
        $this->image_lib->initialize($configer1, $configer2, $configer3, $configer4);
        $this->image_lib->resize();


        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));


        $data = array(
          'id_pelanggan' => $this->input->post('pelanggan'),
          'pernah_kredit' => $this->input->post('pernah_kredit'),
          'pengeluaran_rutin' => $this->input->post('pengeluaran_rutin'),
          'kondisi_keuangan' => $this->input->post('kondisi_keuangan'),
          'DFHS' => $this->input->post('DFHS'),
          'nama_surveyor' => $this->input->post('nama_surveyor'),
          'tanggal' => $tanggal,
          'KHTK' => $this->input->post('KHTK'),
          'catatan' => $this->input->post('catatan'),
          //dokumen
          'formulir_TTD' => $this->input->post('formulir_TTD'),
          'fotocopy_ktp' => $this->input->post('fotocopy_ktp'),
          'fotocopy_kk' => $this->input->post('fotocopy_kk'),
          'fotocopy_slip_gaji' => $this->input->post('fotocopy_slip_gaji'),
          'status_rumah' => $this->input->post('status_rumah'),
          'analisis_keuangan' => $this->input->post('analisis_keuangan'),
          'alamat_sekarang' => $this->input->post('alamat_sekarang'),
          'lokasi' => $this->input->post('lokasi'),
          'denah_rumah' => $this->input->post('denah_rumah'),
          'kondisi_rumah' => $this->input->post('kondisi_rumah'),
          'kondisi_tempat_usaha' => $this->input->post('kondisi_tempat_usaha'),
          'kondisi_tempat_kerja' => $this->input->post('kondisi_tempat_kerja'),
          'kondisi_tetangga' => $this->input->post('kondisi_tetangga'),
          'karakter_keluarga' => $this->input->post('karakter_keluarga'),
          'kondisi_tetangga' => $this->input->post('kondisi_tetangga'),
          'pemakaian_objek_barang' => $this->input->post('pemakaian_objek_barang'),
          'proses_pembelian' => $this->input->post('proses_pembelian'),
          'catatan_dok' => $this->input->post('catatan_dok'),
          'foto_pelanggan' => $foto_pelanggan,
          'foto_ktp' => $foto_ktp,
          'foto_dl' => $foto_dl,
          'foto_dl1' => $foto_dl1,
          'status' => $this->input->post('status'),
          'user_input' => $this->input->post('user_input'),
          'waktu_input' => $this->input->post('waktu_input')
        );
        $insert = $this->hasil_survey_model->insert_data($data);
        if ($insert) {
          $this->session->set_flashdata('message', "Hasil survey Berhasil Disimpan");
          redirect("Hasil_survey");
        } else {
          $this->session->set_flashdata('message_error', "Hasil surevy Gagal Disimpan");
          redirect("Hasil_survey");
        }
      }
    } else {
      $this->data['pelanggan'] = $this->customer_model->getAllBySelect();
      $this->data['content'] = 'admin/hasil_survey/create_v';
      $this->data['waktu_input'] = $date;
      $this->data['kode'] = 'P' . $kode;
      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  public function edit($id)
  {
    $this->form_validation->set_rules('pelanggan', "Nama Lengkap", 'trim|required');
    $date = date('y-m-d H:i:s');
    if ($this->form_validation->run() === TRUE) {
      $config['upload_path']          = './assets/upload/image';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['overwrite']      = true;
      $config['max_size']             = 12024;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('foto_pelanggan')) {
        $foto_pelanggan = $this->input->post('file_foto_pelanggan');
      } else {
        $file1 = $this->upload->data();
        $foto_pelanggan = $file1['file_name'];
      }
    
      if (!$this->upload->do_upload('foto_ktp')) {
        $foto_ktp = $this->input->post('file_foto_ktp');
      } else {
        $file2 = $this->upload->data();
        $foto_ktp = $file2['file_name'];
      }
    
      if (!$this->upload->do_upload('foto_dl')) {
        $foto_dl = $this->input->post('file_foto_dl');
      } else {
        $file3 = $this->upload->data();
        $foto_dl = $file3['file_name'];
      }
      if (!$this->upload->do_upload('foto_dl1')) {
        $foto_dl1 = $this->input->post('file_foto_dl1');
      } else {
        $file4 = $this->upload->data();
        $foto_dl1 = $file4['file_name'];
      }
      $this->load->library('image_lib');
      $configer1 =  array(
        'image_library'   => 'gd2',
        'source_image'    =>  $file1['full_path'],
        'maintain_ratio'  =>  TRUE,
        'quality' => '40%', //tell CI to reduce the image quality and affect the image size
        // 'width' => 640, //new size of image
        // 'height' => 480, //new size of image
      );
      $configer2 =  array(
        'image_library'   => 'gd2',
        'source_image'    =>  $file2['full_path'],
        'maintain_ratio'  =>  TRUE,
        'quality' => '40%', //tell CI to reduce the image quality and affect the image size
        // 'width' => 640, //new size of image
        // 'height' => 480, //new size of image
      );
      $configer3 =  array(
        'image_library'   => 'gd2',
        'source_image'    =>  $file3['full_path'],
        'maintain_ratio'  =>  TRUE,
        'quality' => '40%', //tell CI to reduce the image quality and affect the image size
        // 'width' => 640, //new size of image
        // 'height' => 480, //new size of image
      );
      $configer4 =  array(
        'image_library'   => 'gd2',
        'source_image'    =>  $file4['full_path'],
        'maintain_ratio'  =>  TRUE,
        'quality' => '40%', //tell CI to reduce the image quality and affect the image size
        // 'width' => 640, //new size of image
        // 'height' => 480, //new size of image
      );

      $this->image_lib->clear();
      $this->image_lib->initialize($configer1, $configer2, $configer3, $configer4);
      $this->image_lib->resize();

      $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
      $data = array(
        'id_pelanggan' => $this->input->post('pelanggan'),
        'pernah_kredit' => $this->input->post('pernah_kredit'),
        'pengeluaran_rutin' => $this->input->post('pengeluaran_rutin'),
        'kondisi_keuangan' => $this->input->post('kondisi_keuangan'),
        'DFHS' => $this->input->post('DFHS'),
        'nama_surveyor' => $this->input->post('nama_surveyor'),
        'tanggal' => $tanggal,
        'KHTK' => $this->input->post('KHTK'),
        'catatan' => $this->input->post('catatan'),
        //dokumen
        'formulir_TTD' => $this->input->post('formulir_TTD'),
        'fotocopy_ktp' => $this->input->post('fotocopy_ktp'),
        'fotocopy_kk' => $this->input->post('fotocopy_kk'),
        'fotocopy_slip_gaji' => $this->input->post('fotocopy_slip_gaji'),
        'status_rumah' => $this->input->post('status_rumah'),
        'analisis_keuangan' => $this->input->post('analisis_keuangan'),
        'alamat_sekarang' => $this->input->post('alamat_sekarang'),
        'lokasi' => $this->input->post('lokasi'),
        'denah_rumah' => $this->input->post('denah_rumah'),
        'kondisi_rumah' => $this->input->post('kondisi_rumah'),
        'kondisi_tempat_usaha' => $this->input->post('kondisi_tempat_usaha'),
        'kondisi_tempat_kerja' => $this->input->post('kondisi_tempat_kerja'),
        'kondisi_tetangga' => $this->input->post('kondisi_tetangga'),
        'karakter_keluarga' => $this->input->post('karakter_keluarga'),
        'kondisi_tetangga' => $this->input->post('kondisi_tetangga'),
        'pemakaian_objek_barang' => $this->input->post('pemakaian_objek_barang'),
        'proses_pembelian' => $this->input->post('proses_pembelian'),
        'catatan_dok' => $this->input->post('catatan_dok'),
        'foto_pelanggan' => $foto_pelanggan,
        'foto_ktp' => $foto_ktp,
        'foto_dl' => $foto_dl,
        'foto_dl1' => $foto_dl1,
        'status' => $this->input->post('status'),
        'user_input' => $this->input->post('user_input'),
        'waktu_input' => $this->input->post('waktu_input')
      );
      $update = $this->hasil_survey_model->update_data($data, array('id_hasil_survey' => $id));
      if ($update) {
        $this->session->set_flashdata('message', "Hasil survey Berhasil Diubah");
        redirect("Hasil_survey");
      } else {
        $this->session->set_flashdata('message_error', "Hasil surevy Gagal Diubah");
        redirect("Hasil_survey");
      }
    } else {
      $data = $this->hasil_survey_model->getAllById(array("hasil_survey.id_hasil_survey" => $id));

      $this->data['id_pelanggan'] =   (!empty($data)) ? $data[0]->id_pelanggan : "";
      $this->data['data'] = $data[0];

      $this->data['pelanggan'] = $this->customer_model->getAllById();




      $this->data['content'] = 'admin/hasil_survey/edit_v';
      $this->data['waktu_input'] = $date;
      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  public function view($id)
  {
    $date = date('d-m-Y H:i:s');
    $data = $this->hasil_survey_model->getAllById(array("hasil_survey.id_hasil_survey" => $id));
    $this->data['id_pelanggan'] =   (!empty($data)) ? $data[0]->id_pelanggan : "";
    $this->data['data'] = $data[0];
    $this->data['pelanggan'] = $this->customer_model->getAllById();
    $this->data['content'] = 'admin/hasil_survey/view_v';
    $this->data['waktu_input'] = $date;
    $this->load->view('admin/layouts/page', $this->data);
  }

  public function exportCSV()
  {
    // file name 
    $filename = 'Pelanggan' . date('Ymd') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");

    // get data 

    $datas = $this->customer_model->getAllById();

    // file creation 
    $file = fopen('php://output', 'w');

    $header = array("ID CUSTOMER", "NAMA", "EMAIL", "JENIS KELAMIN", "TELPON", "ALAMAT");
    fputcsv($file, $header);
    foreach ($datas as $line) {
      fputcsv($file, array($line->id_customer, $line->nama, $line->email, $line->jk, $line->telp, $line->alamat));
    }
    fclose($file);
    exit;
  }

  public function destroy()
  {
    $response_data = array();
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = array();
    $id = $this->uri->segment(3);
    if (!empty($id)) {
      $delete = $this->hasil_survey_model->delete(array("id_hasil_survey" => $id));


      $response_data['data'] = $data;
      $response_data['status'] = true;
    } else {
      $response_data['msg'] = "ID KOSONG";
    }

    echo json_encode($response_data);
  }
}
