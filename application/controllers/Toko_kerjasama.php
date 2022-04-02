<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Toko_kerjasama extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();

    $this->load->model('kerjasama_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/toko_kerjasama/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

  public function dataList(){
    $columns = array( 
            0 => 'id',
            1 => 'nama_toko',
            2 => 'nama_pemilik',
            3 => 'tgl_gabung',
            4 => ''
        );

      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];
      $search = array();
      $limit = 0;
      $start = 0;
      $totalData = $this->kerjasama_model->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->kerjasama_model->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->kerjasama_model->getAllBy($limit,$start,$search,$order,$dir);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
                {   
               
                if($this->data['is_can_delete']){
          $delete_url ="<a href='#' 
                  url='".base_url()."Toko_kerjasama/destroy/".$data->id."'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
                }
           // $nestedData['id']   = $start+$key+1;
            $nestedData['id']   = $data->id;
            $nestedData['nama_toko']         = $data->nama_toko;
            $nestedData['nama_pemilik']         = $data->nama_pemilik;
            $nestedData['tgl_gabung']         = $data->tgl_gabung;
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

    $this->form_validation->set_rules('nama_toko',"Nama Toko","trim|required");

    if($this->form_validation->run() === TRUE){

      $data = array(
        'nama_toko' => $this->input->post('nama_toko'),
        'nama_pemilik' => $this->input->post('nama_pemilik'),
        'alamat' => $this->input->post('alamat'),
        'tgl_gabung' => $this->input->post('tgl_gabung')
      );

      $create = $this->kerjasama_model->insert($data);

      if($create){
        $this->session->set_flashdata('message',"Toko Kerjasama Berhasil ditambahkan");
        redirect('Toko_kerjasama');

      }else{
       $this->session->set_flashdata('message',"Toko kerjasama Gagal ditambahkan");
        redirect('Toko_kerjasama');
      }

    }else{
     
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/toko_kerjasama/create_v';   
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
          $delete = $this->kerjasama_model->delete(array("id"=>$id));
        
         
          $response_data['data'] = $data; 
          $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID KOSONG";
    }
    
        echo json_encode($response_data); 
  }


}