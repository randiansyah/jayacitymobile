<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Lama_cicilan extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('cicilan_model'); 
  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/lama_cicilan/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

  public function dataList(){
    $columns = array( 
            0 => 'id_cicilan',
            1 => 'nama',
            2 => ''
        );

      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];
      $search = array();
      $limit = 0;
      $start = 0;
      $totalData = $this->cicilan_model->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->cicilan_model->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->cicilan_model->getAllBy($limit,$start,$search,$order,$dir);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
                {   
               
                if($this->data['is_can_delete']){
          $delete_url ="<a href='#' 
                  url='".base_url()."Lama_cicilan/destroy/".$data->id_cicilan."'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
                }
           // $nestedData['id']   = $start+$key+1;
            $nestedData['id_cicilan']   = $data->id_cicilan;
            $nestedData['nama']         = $data->nama." Bulan";
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

    $this->form_validation->set_rules('cicilan',"cicilannya","trim|required");

    if($this->form_validation->run() === TRUE){

      $data = array('nama' => $this->input->post('cicilan'));

      $create = $this->cicilan_model->insert($data);

      if($create){
        $this->session->set_flashdata('message',"Cicilan Berhasil ditambahkan");
        redirect('Lama_cicilan');

      }else{
       $this->session->set_flashdata('message',"Cicilan Gagal ditambahkan");
        redirect('Lama_cicilan');
      }

    }else{
     
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/lama_cicilan/create_v';   
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
          $delete = $this->cicilan_model->delete(array("id_cicilan"=>$id));
        
         
          $response_data['data'] = $data; 
          $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID KOSONG";
    }
    
        echo json_encode($response_data); 
  }


}