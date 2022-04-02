<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';

class Finace extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Finace_model');
    }

    public function destroy()
    {
        $response_data = [];
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = [];

        $id = $this->uri->segment(3);

        if (!empty($id)) {
            $delete = $this->Finace_model->delete(['id' => $id]);
            $response_data['data'] = $delete;
            $response_data['status'] = true;

        } else {
            $response_data['msg'] = "Error";
        }

        echo json_encode($response_data);
    }
    
    public function saldo()
    {
        $this->load->helper('url');

        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/finace/saldo';   
        } else {
            $this->data['content'] = 'errors/html/restrict'; 
        }

        $credit = $this->Finace_model->countCredit();
        $debit = $this->Finace_model->countDebit();
        $str_bank = $this->Finace_model->countCreditBank();
        $trk_bank = $this->Finace_model->countDebitBank();

        $this->data['credit'] = $credit + $str_bank;
        $this->data['debit'] = $debit + $trk_bank;

        $this->load->view('admin/layouts/page', $this->data);  
    }

    public function listSaldo()
    {
        $columns = [
            0   => 'id',
            1   => 'name',
            2   => 'amount',
            3   => 'description',
            4   => 'type',
            5   => 'created_at'
        ];

        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  		$search = array();
  		$where= array();
  		$limit = 0;
  		$start = 0;
        $totalData = $this->Finace_model->getCountAllBy($search, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        if(!empty($searchColumn[1]['search']['value'])) {
        	$value = $searchColumn[1]['search']['value'];
        	$isSearchColumn = true;
            $search['keuangan.type'] = $value;
             
        }

        if ($isSearchColumn) {
			$totalFiltered = $this->Finace_model->getCountAllBy($search, $where); 
        } else {
        	$totalFiltered = $totalData;
        }
        
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $datas =  $this->Finace_model->getAll($limit,$start,$search,$order,$dir,$where); 
        $new_data = [];
        $no = 1;

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                if ($this->data['is_can_edit']) {
                    $edit_url = "<a href='" . base_url() . "finace/edit_finace/" . $data->id . "' class='btn btn-primary btn-sm white'><i class='fa fa-pencil'></i> Ubah</a>";
                }

                if ($this->data['is_can_delete']) {
                    $delete_url ="<a href='#' 
                        url='".base_url()."finace/destroy/".$data->id."'
                        class='delete' 
                        ><i class='fa fa-trash'></i>&nbsp;Hapus
                        </a>"
                    ;
                }

                if ($data->type == 1) {
                    $type = "<label class='label bg-blue'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label class='label bg-red'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label class='label bg-green'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label class='label bg-red'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $no++;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));
           		$nestedData['action'] = $edit_url." ".$delete_url;   

                $new_data[] = $nestedData;
            }
        }

        $json_data = [
            "draw"            => intval($this->input->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $new_data
        ];

        echo json_encode($json_data); 
    }

    public function create_finace()
    {
        $this->form_validation->set_rules('name',"Nama", 'trim|required');
        $this->form_validation->set_rules('amount',"Nominal", 'trim|required');
        $this->form_validation->set_rules('description',"Deskripsi", 'trim|required');
        $this->form_validation->set_rules('type',"Tipe", 'trim|required');
        
        $amount1 = str_replace(".","",$this->input->post('amount'));
        $amount  = str_replace("Rp","",$amount1);
        
        if ($this->form_validation->run() === true) {
            $data = [
                'name' => $this->input->post('name'),
                'amount' => $amount,
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type'),
                'created_at' => date('Y-m-d')
            ];

            $insert_finace = $this->Finace_model->insert_finace($data);

            if ($insert_finace) {
                 $this->session->set_flashdata('message', "Data berhasil disimpan");

                 redirect("finace/saldo");
            } else {
                $this->session->set_flashdata('message_error',"Data Gagal Disimpan");

                redirect("finace/saldo");
            }
        } else {
            $this->data['content'] = 'admin/finace/create';
            
            $this->load->view('admin/layouts/page', $this->data);
        }
    }

    public function edit_finace($id)
    {
        $this->form_validation->set_rules('name', "Name Harus Diisi", 'trim|required');
        
        $amount1 = str_replace(".","",$this->input->post('amount'));
        $amount  = str_replace("Rp","",$amount1);
        if ($this->form_validation->run() === TRUE) {

            $data = [
                'name' => $this->input->post('name'),
                'amount' => $amount,
                'description' => $this->input->post('description'),
                'created_at' => date('Y-m-d')
            ];

            $update = $this->Finace_model->update_finace($data, ['id' => $id]);

            if ($update) {
                $this->session->set_flashdata('message', "Data Berhasil Diubah");

                redirect("finace/saldo");
            } else {
                $this->session->set_flashdata('message_error', "Data Gagal Diubah");

                redirect("finace/saldo");
            }
        } else {
            $data = $this->Finace_model->getById($id);

            $this->data['data'] = $data[0];

            $this->data['content'] = 'admin/finace/edit';
            
            $this->load->view('admin/layouts/page', $this->data);
        }
    }
}