<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Suspend extends Admin_Controller
{
  public function __construct()
  {

    parent::__construct();
    $this->load->model('transaksi_model', 'transaksi');
    $this->load->model('suspend_model', 'suspend');
    $this->load->model('cicilan_model');
    $this->load->model('customer_model');

  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/suspend/list_v';
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function datalist()
  {
    $columns = array(
      0 => 'id_suspend',
      1 => 'id_pelanggan',
      2 => 'cicilan',
      3 => 'nama_barang',
      4 => 'text',
      5 => '',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $limit = 0;
    $start = 0;
    $where = array();
    if ($this->ion_auth->is_admin()) {

      $where = array();
    } else {
      $id = $this->data['users']->id;
      $where['id_pelanggan'] = $id;
    }

    $totalData = $this->suspend->getCountAllBy($limit, $start, $search, $order, $dir);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;

    if ($isSearchColumn) {
      $totalFiltered = $this->suspend->getCountAllBy($limit, $start, $search, $order, $dir);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->suspend->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {
        if ($this->ion_auth->is_admin()) {
          $terima ="<a href='#' 
          url='".base_url()."Suspend/terima/".$data->id_suspend."'
          class='terima' 
           ><i class='fa fa-check'></i>&nbsp;Terima
          </a>";
  
          $tolak ="<a href='#' 
          url='".base_url()."Suspend/tolak/".$data->id_suspend."'
          class='terima' 
           ><i class='fa fa-times'></i>&nbsp;Tolak
          </a>";

          $action = $terima. " ".$tolak;
        } else {
         $action = "";
        }
      
       
        
        
    $pelanggan = $this->customer_model->getAllByPelanggan(array("id_pelanggan" => $data->id_pelanggan));
    $nama = (!empty($pelanggan)) ? $pelanggan[0]->nama : "";
      if($data->status == 1){
      $status = "<button type='button' class='btn btn-warning btn-sm'>Menunggu di setujui</button>&nbsp;&nbsp;&nbsp;".$action;

      }else if($data->status == 2) {
      $status = "<button type='button' class='btn btn-success btn-sm'>Disetujui</button>";
      } else if($data->status == 3) {
        $status = "<button type='button' class='btn btn-danger btn-sm'>Ditolak</button>";
      }

        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_pelanggan']   = $nama;
        $nestedData['cicilan']   = $data->cicilan;
        $nestedData['nama_barang']   = $data->nama_barang;
        $nestedData['text']   = $data->text;
        $nestedData['status']   = $status;
       

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



  public function create(){

    $this->form_validation->set_rules('cicilan', "Cicilan tidak boleh kosong", "trim|required");
  $this->form_validation->set_rules('nama_barang', "barang tidak boleh kosong", "trim|required");
  $this->form_validation->set_rules('text', "pesan tidak boleh kosong", "trim|required");

    if($this->form_validation->run() === TRUE){

      $data = array(
          'nama_barang' => $this->input->post('nama_barang'),
          'cicilan' => $this->input->post('cicilan'),
          'text' => $this->input->post('text'),
          'status' => 1,
          'created_at' => now(),
          'id_pelanggan' => $this->data['users']->id
    
    );

      $create = $this->suspend->insert_data($data);

      if($create){
        $this->session->set_flashdata('message',"Penangguhan Berhasil dikirim");
        redirect('suspend');

      }else{
       $this->session->set_flashdata('message',"Penangguhan Gagal dikirim");
        redirect('suspend');
      }

    }else{
     
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/suspend/create_v';   
      $id = $this->data['users']->id;
      $this->data['transaksi'] = $this->transaksi->getAllById(array("transaksi.id_pelanggan" => $id));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  

  }
}

public function terima()
{
    $response_data = [];
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = [];

    $id = $this->uri->segment(3);
    

    if (!empty($id)) {
      $data = array(
        "status" => 2
      );
        $terima = $this->suspend->update($data,['id_suspend' => $id]);
        $response_data['data'] = $terima;
        $response_data['status'] = true;

    } else {
        $response_data['msg'] = "Error";
    }

    echo json_encode($response_data);
}

public function tolak()
{
    $response_data = [];
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = [];

    $id = $this->uri->segment(3);
    

    if (!empty($id)) {
      $data = array(
        "status" => 3
      );
        $terima = $this->suspend->update($data,['id_suspend' => $id]);
        $response_data['data'] = $terima;
        $response_data['status'] = true;

    } else {
        $response_data['msg'] = "Error";
    }

    echo json_encode($response_data);
}


}
