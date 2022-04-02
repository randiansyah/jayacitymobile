<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Rekening_bank extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();

    $this->load->model('rekening_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/rekening_bank/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

  public function dataList(){
    $columns = array( 
            0 => 'id',
            1 => 'nama_akun',
            2 => 'no_akun',
            3 => 'nama_bank',
            4 => ''
        );

      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];
      $search = array();
      $limit = 0;
      $start = 0;
      $totalData = $this->rekening_model->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->rekening_model->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->rekening_model->getAllBy($limit,$start,$search,$order,$dir);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
                {   
               
                if($this->data['is_can_delete']){
          $delete_url ="<a href='#' 
                  url='".base_url()."Rekening_bank/destroy/".$data->id."'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
                }
           // $nestedData['id']   = $start+$key+1;
            $nestedData['id']   = $data->id;
            $nestedData['nama_akun']         = $data->nama_akun;
            $nestedData['no_akun']         = $data->no_akun;
            $nestedData['nama_bank']         = $data->nama_bank;
            $nestedData['action'] = $delete_url;
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

    $this->form_validation->set_rules('nama_akun',"Nama Akun","trim|required");

    if($this->form_validation->run() === TRUE){

      $data = array(
        'nama_akun' => $this->input->post('nama_akun'),
        'no_akun' => $this->input->post('no_akun'),
        'nama_bank' => $this->input->post('nama_bank'),
      );

      $create = $this->rekening_model->insert($data);

      if($create){
        $this->session->set_flashdata('message',"Rekening bank Berhasil ditambahkan");
        redirect('Rekening_bank');

      }else{
       $this->session->set_flashdata('message',"Rekening bank Gagal ditambahkan");
        redirect('Rekening_bank');
      }

    }else{
     
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/rekening_bank/create_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  

  }
}

  public function destroy(){
    $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   
    $id =$this->uri->segment(3);
    if(!empty($id)){
          $delete = $this->rekening_model->delete(array("id"=>$id));
        
         
          $response_data['data'] = $data; 
          $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID KOSONG";
    }
    
        echo json_encode($response_data); 
  }


}