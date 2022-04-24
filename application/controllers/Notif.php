<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Notif extends Admin_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('notif_model');
    $this->load->model('karyawan_model');
    $this->load->model('brand_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/notif/list_v';
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function dataList()
  {
    $columns = array(
      0 => 'id_notif',
      1 => 'id_karyawan',
      2 => 'id_merek',
      3 => 'tipe'
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $limit = 0;
    $start = 0;
    $totalData = $this->notif_model->getCountAllBy($limit, $start, $search, $order, $dir);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;


    if ($isSearchColumn) {
      $totalFiltered = $this->notif_model->getCountAllBy($limit, $start, $search, $order, $dir);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->notif_model->getAllBy($limit, $start, $search, $order, $dir);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_delete']) {

          $delete_url = "<button
                    url='" . base_url() . "notif/destroy/" . $data->id_notif . "'
                    class='btn btn-danger btn-sm white delete' 
                     >Delete
                    </button>";
        }

        if ($this->data['is_can_edit']) {
          $edit_url = "<a href='" . base_url() . "notif/edit/" . $data->id_notif . "' class='btn btn-primary btn-sm white'><i class='fa fa-pencil'></i> Ubah</a>";
        } else {
          $edit_url = "";
        }
        // $nestedData['id']   = $start+$key+1;
        if ($data->tipe == 1) {
          $type = "Jatuh Tempo";
        } else if ($data->tipe == 2) {
          $type = "Pembayaran";
        } else if ($data->tipe == 3) {
          $type = "Pembayaran Otomatis";
        } else {
          $type = "";
        }

        $nestedData['id']   = $data->id_notif;
        $nestedData['id_karyawan']         = $data->nama;
        $nestedData['id_merek']         = $data->name;
        $nestedData['tipe']         = $type;
        $nestedData['action'] = $delete_url . " " . $edit_url;
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

    $this->form_validation->set_rules('id_karyawan', "isi nama karyawan", "trim|required");

    if ($this->form_validation->run() === TRUE) {

      $data = array(
        'id_karyawan' => $this->input->post('id_karyawan'),
        'id_merek' => $this->input->post('id_merek'),
        'tipe' => $this->input->post('type'),

      );

      $create = $this->notif_model->insert($data);

      if ($create) {
        $this->session->set_flashdata('message', "Notif Berhasil ditambahkan");
        redirect('Notif');
      } else {
        $this->session->set_flashdata('message', "Notif Gagal ditambahkan");
        redirect('Notif');
      }
    } else {

      if ($this->data['is_can_read']) {
        $this->data['karyawan'] = $this->karyawan_model->getAllbyId();
        $this->data['brand'] = $this->brand_model->getAllbyId();
        $this->data['content'] = 'admin/notif/create_v';
      } else {
        $this->data['content'] = 'errors/html/restrict';
      }

      $this->load->view('admin/layouts/page', $this->data);
    }
  }
  public function edit($id)
  {

    $this->form_validation->set_rules('id_karyawan', "isi nama karyawan", "trim|required");

    if ($this->form_validation->run() === TRUE) {

      $data = array(
        'id_karyawan' => $this->input->post('id_karyawan'),
        'id_merek' => $this->input->post('id_merek'),
        'tipe' => $this->input->post('type'),

      );

      $update = $this->notif_model->update($data, array("id_notif" => $id));

      if ($update) {
        $this->session->set_flashdata('message', "Notif Berhasil diubah");
        redirect('Notif');
      } else {
        $this->session->set_flashdata('message', "Notif Gagal diubah");
        redirect('Notif');
      }
    } else {

      if ($this->data['is_can_read']) {

        $this->data['notif'] = $this->notif_model->getOneBy(array("id_notif" => $id));
        $this->data['karyawan'] = $this->karyawan_model->getAllbyId();
        $this->data['brand'] = $this->brand_model->getAllbyId();
        $this->data['content'] = 'admin/notif/edit_v';
      } else {
        $this->data['content'] = 'errors/html/restrict';
      }

      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  // public function edit($id){

  //   $this->form_validation->set_rules('name',"isi nama","trim|required");

  //   if($this->form_validation->run() === TRUE){

  //     $data = array(
  //         'name' => $this->input->post('name'),
  //         'id_category' => 1

  //   );

  //     $update = $this->brand_model->update($data,array("id" => $id));

  //     if($update){
  //       $this->session->set_flashdata('message',"Merek Berhasil diubah");
  //       redirect('brand');

  //     }else{
  //      $this->session->set_flashdata('message',"Merek Gagal diubah");
  //       redirect('brand');
  //     }

  //   }else{

  //   if($this->data['is_can_read']){
  //     $this->data['content'] = 'admin/brand/update_v'; 
  //     $this->data['data'] = $this->brand_model->getAllById(array("id" => $id));  
  //   }else{
  //     $this->data['content'] = 'errors/html/restrict'; 
  //   }

  //   $this->load->view('admin/layouts/page',$this->data);  

  // }
  // }

  public function destroy()
  {
    $response_data = [];
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = [];


    $id = $this->uri->segment(3);

    if (!empty($id)) {

      $delete = $this->notif_model->delete(array("id_notif" => $id));
      $response_data['data'] = $delete;
      $response_data['status'] = true;
    } else {
      $response_data['msg'] = "Error";
    }

    echo json_encode($response_data);
  }
}
