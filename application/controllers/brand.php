<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Brand extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('brand_model'); 
  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/brand/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

  public function dataList(){
    $columns = array( 
            0 => 'id',
            1 => 'name',
            2 => ''
        );

      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];
      $search = array();
      $limit = 0;
      $start = 0;
      $totalData = $this->brand_model->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->brand_model->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->brand_model->getAllBy($limit,$start,$search,$order,$dir);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
                {   
               
                  if($this->data['is_can_delete']){
                    if($data->is_deleted == 0){
                    $delete_url = "<a href='#' 
                      url='".base_url()."brand/destroy/".$data->id."/".$data->is_deleted."'
                      class='btn btn-sm btn-success white delete' >Non Aktifkan
                      </a>";
                  }else{
                    $delete_url = "<a href='#' 
                      url='".base_url()."brand/destroy/".$data->id."/".$data->is_deleted."'
                      class='btn btn-sm btn-danger white delete' 
                       >Aktifkan
                      </a>";
                  } 
                }

                if ($this->data['is_can_edit']) {
                  $edit_url = "<a href='" . base_url() . "brand/edit/" . $data->id . "' class='btn btn-primary btn-sm white'><i class='fa fa-pencil'></i> Ubah</a>";
                } else {
                  $edit_url = "";
                }
           // $nestedData['id']   = $start+$key+1;
            $nestedData['id']   = $data->id;
            $nestedData['name']         = $data->name;
            $nestedData['action'] = $delete_url." ".$edit_url;
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

    $this->form_validation->set_rules('name',"isi nama","trim|required");

    if($this->form_validation->run() === TRUE){

      $data = array(
          'name' => $this->input->post('name'),
          'id_category' => 1
    
    );

      $create = $this->brand_model->insert($data);

      if($create){
        $this->session->set_flashdata('message',"Merek Berhasil ditambahkan");
        redirect('brand');

      }else{
       $this->session->set_flashdata('message',"Merek Gagal ditambahkan");
        redirect('brand');
      }

    }else{
     
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/brand/create_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  

  }
}

public function edit($id){

  $this->form_validation->set_rules('name',"isi nama","trim|required");

  if($this->form_validation->run() === TRUE){

    $data = array(
        'name' => $this->input->post('name'),
        'id_category' => 1
  
  );

    $update = $this->brand_model->update($data,array("id" => $id));

    if($update){
      $this->session->set_flashdata('message',"Merek Berhasil diubah");
      redirect('brand');

    }else{
     $this->session->set_flashdata('message',"Merek Gagal diubah");
      redirect('brand');
    }

  }else{
   
  if($this->data['is_can_read']){
    $this->data['content'] = 'admin/brand/update_v'; 
    $this->data['data'] = $this->brand_model->getAllById(array("id" => $id));  
  }else{
    $this->data['content'] = 'errors/html/restrict'; 
  }
  
  $this->load->view('admin/layouts/page',$this->data);  

}
}

public function destroy()
{
    $response_data = [];
    $response_data['status'] = false;
    $response_data['msg'] = "";
    $response_data['data'] = [];

  
    $id =$this->uri->segment(3);
    $is_deleted = $this->uri->segment(4);

    if (!empty($id)) {
      $data = array(
        'is_deleted' => ($is_deleted == 1)?0:1, 
      ); 
        $delete = $this->brand_model->update($data,array("id" => $id));
        $response_data['data'] = $delete;
        $response_data['status'] = true;

    } else {
        $response_data['msg'] = "Error";
    }

    echo json_encode($response_data);
}


}