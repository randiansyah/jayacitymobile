<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Stok_terjual extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Stok_model','stok'); 

  

  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['brand'] = $this->stok->getAllBy();
      $this->data['content'] = 'admin/laporan_stok/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

  public function view($id)
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['item'] = $this->stok->getAllByBrand(array("a.id" => $id));
      $this->data['content'] = 'admin/laporan_stok/list_detail_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }



}