<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Pengaturan extends Admin_Controller {

 	public function __construct()
	{
		parent::__construct(); 
         $this->load->model('pengaturan_model');
         $this->load->model('rekening_model');
	}

	public function index()
	{  
	$this->form_validation->set_rules('nama',"Nama Perusahaan", 'trim|required'); 
		$this->form_validation->set_rules('no_telp',"no Telp", 'trim|required'); 
		$this->form_validation->set_rules('bank',"Akun Bank", 'trim|required'); 
	$this->form_validation->set_rules('alamat',"Alamat Perusahaan", 'trim|required'); 

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'id_bank' => $this->input->post('bank'), 
				'nama' => $this->input->post('nama'), 
				'no_telp' => $this->input->post('no_telp'), 
				'alamat' => $this->input->post('alamat'), 
				'created_on' => date('Y-m-d')
			);

			$update = $this->pengaturan_model->update($data,array("id_pengaturan"=>1));
			$this->session->set_flashdata('message', "Pengaturan Berhasil Diubah");
			redirect("Pengaturan","refresh");

		} 
		else
		{
			if(!empty($_POST)){ 
			
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("Pengaturan");
			
			}else{

                $data = $this->pengaturan_model->getOneBy(array("id_pengaturan" => 1)); 
                $bank = $this->rekening_model->getAllById(); 		
                $this->data['bank'] = $bank;
                $this->data['data'] = $data;
				$this->data['label'] = 'Pengaturan'; 	
				$this->data['title'] = 'Pengaturan'; 	
				$this->data['content'] = 'admin/pengaturan/list_utama_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
	} 

	public function jatuh_tempo()
	{  
	$this->form_validation->set_rules('set_hari',"Jatuh_tempo", 'trim|required'); 
		

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'set_hari' => $this->input->post('set_hari'), 
				'created_on' => date('Y-m-d')
			);

			$update = $this->pengaturan_model->update_jatuh_tempo($data,array("id_jatuh_tempo"=>1));
			$this->session->set_flashdata('message', "Pengaturan Berhasil Diubah");
			redirect("Pengaturan/jatuh_tempo","refresh");

		} 
		else
		{
			if(!empty($_POST)){ 
			
				$this->session->set_flashdata('message_error',validation_errors());
				return redirect("Pengaturan/jatuh_tempo");
			
			}else{

                $data = $this->pengaturan_model->getOneByJatuhTempo(array("id_jatuh_tempo" => 1)); 
              
                $this->data['data'] = $data;
				$this->data['label'] = 'Pengaturan jatuh Tempo'; 	
				$this->data['title'] = 'Pengaturan'; 	
				$this->data['content'] = 'admin/pengaturan/list_jatuh_tempo_v'; 
				$this->load->view('admin/layouts/page',$this->data); 
			}  
		}    
	} 
}
