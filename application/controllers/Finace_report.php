<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';

class Finace_report extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Finace_model');
        $this->load->model('pengaturan_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function expense()
    {
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/finace_report/index';   
        } else {
            $this->data['content'] = 'errors/html/restrict'; 
        }

        $this->load->view('admin/layouts/page', $this->data);     
    }

    public function dataList()
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
        $where = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->Finace_model->getCountAllBy($search, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        $where["type"] = 2;

        if (!empty($searchColumn[1]['search']['value'])) {
        $value = $searchColumn[1]['search']['value'];
        $isSearchColumn = true;
        $where['created_at >='] = date("Y-m-d", strtotime($value));
        }

        if (!empty($searchColumn[2]['search']['value'])) {
        $value = $searchColumn[2]['search']['value'];
        $isSearchColumn = true;
        $where['created_at <='] =  date("Y-m-d", strtotime($value));
        }



        if ($isSearchColumn) {
        $totalFiltered = $this->Finace_model->getCountAllBy($search, $where);
        } else {
        $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($data->type == 1) {
                    $type = "<label class='label bg-blue'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label class='label bg-red'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label class='label bg-green'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label class='label bg-red'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

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
    
    public function export()
    {
        $pengaturan = $this->pengaturan_model->getOneBy();
        $periode_start = $this->uri->segment(3);
        $periode_end = $this->uri->segment(4);

        $where = [];
        $where['created_at >='] = $periode_start;
        $where['created_at <='] = $periode_end;
        $where["type"] = 2;
        $search = [];
        $limit = 0;
        $start = 0;
        $order = 0;
        $dir = 0;

        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = [];

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                if ($data->type == 1) {
                    $type = "<label style='color:blue;'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label style='color:red;'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label style='color:blue;'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label style='color:red;'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

                $new_data[] = $nestedData;
            }
        }
        
		$this->data['pengaturan'] = $pengaturan;
		// $this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
		// $this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
        $this->data['data'] = $new_data; 
        $this->data['periode_start'] = $periode_start; 
        $this->data['periode_end'] = $periode_end; 
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = ucwords(str_replace("_", " ", $this->uri->segment(1). " - " . $this->uri->segment(2))) . "-" . date('dmy');

        $this->pdf->load_view('admin/finace_report/pdf/cetak_pdf', $this->data);
    }

    public function income()
    {
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/finace_report/income.php';   
        } else {
            $this->data['content'] = 'errors/html/restrict'; 
        }

        $this->load->view('admin/layouts/page', $this->data);
    }

    public function dataIncome()
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
        $where = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->Finace_model->getCountAllBy($search, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        $where["type"] = 1;

        if (!empty($searchColumn[1]['search']['value'])) {
        $value = $searchColumn[1]['search']['value'];
        $isSearchColumn = true;
        $where['created_at >='] = date("Y-m-d", strtotime($value));
        }

        if (!empty($searchColumn[2]['search']['value'])) {
        $value = $searchColumn[2]['search']['value'];
        $isSearchColumn = true;
        $where['created_at <='] =  date("Y-m-d", strtotime($value));
        }



        if ($isSearchColumn) {
        $totalFiltered = $this->Finace_model->getCountAllBy($search, $where);
        } else {
        $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($data->type == 1) {
                    $type = "<label class='label bg-blue'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label class='label bg-red'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label class='label bg-green'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label class='label bg-red'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

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

    public function export_income()
    {
        $pengaturan = $this->pengaturan_model->getOneBy();
        $periode_start = $this->uri->segment(3);
        $periode_end = $this->uri->segment(4);

        $where = [];
        $where['created_at >='] = $periode_start;
        $where['created_at <='] = $periode_end;
        $where["type"] = 1;
        $search = [];
        $limit = 0;
        $start = 0;
        $order = 0;
        $dir = 0;

        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = [];

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                if ($data->type == 1) {
                    $type = "<label style='color:blue;'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label style='color:red;'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label style='color:blue;'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label style='color:red;'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

                $new_data[] = $nestedData;
            }
        }
        
		$this->data['pengaturan'] = $pengaturan;
		// $this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
		// $this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
        $this->data['data'] = $new_data; 
        $this->data['periode_start'] = $periode_start; 
        $this->data['periode_end'] = $periode_end; 
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = ucwords(str_replace("_", " ", $this->uri->segment(1). " - " . $this->uri->segment(2))) . "-" . date('dmy');

        $this->pdf->load_view('admin/finace_report/pdf/cetak_pdf', $this->data);
    }

    public function report_setor()
    {
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/finace_report/setor';   
        } else {
            $this->data['content'] = 'errors/html/restrict'; 
        }

        $this->load->view('admin/layouts/page', $this->data); 
    }

    public function dataSetor()
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
        $where = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->Finace_model->getCountAllBy($search, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        $where["type"] = 4;

        if (!empty($searchColumn[1]['search']['value'])) {
        $value = $searchColumn[1]['search']['value'];
        $isSearchColumn = true;
        $where['created_at >='] = date("Y-m-d", strtotime($value));
        }

        if (!empty($searchColumn[2]['search']['value'])) {
        $value = $searchColumn[2]['search']['value'];
        $isSearchColumn = true;
        $where['created_at <='] =  date("Y-m-d", strtotime($value));
        }



        if ($isSearchColumn) {
        $totalFiltered = $this->Finace_model->getCountAllBy($search, $where);
        } else {
        $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($data->type == 1) {
                    $type = "<label class='label bg-blue'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label class='label bg-red'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label class='label bg-green'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label class='label bg-red'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

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

    public function export_setor()
    {
        $pengaturan = $this->pengaturan_model->getOneBy();
        $periode_start = $this->uri->segment(3);
        $periode_end = $this->uri->segment(4);

        $where = [];
        $where['created_at >='] = $periode_start;
        $where['created_at <='] = $periode_end;
        $where["type"] = 4;
        $search = [];
        $limit = 0;
        $start = 0;
        $order = 0;
        $dir = 0;

        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = [];

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                if ($data->type == 1) {
                    $type = "<label style='color:blue;'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label style='color:red;'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label style='color:blue;'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label style='color:red;'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

                $new_data[] = $nestedData;
            }
        }
        
		$this->data['pengaturan'] = $pengaturan;
		// $this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
		// $this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
        $this->data['data'] = $new_data; 
        $this->data['periode_start'] = $periode_start; 
        $this->data['periode_end'] = $periode_end; 
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = ucwords(str_replace("_", " ", $this->uri->segment(1). " - " . $this->uri->segment(2))) . "-" . date('dmy');

        $this->pdf->load_view('admin/finace_report/pdf/cetak_pdf', $this->data);
    }

    public function tarik()
    {
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/finace_report/tarik';   
        } else {
            $this->data['content'] = 'errors/html/restrict'; 
        }

        $this->load->view('admin/layouts/page', $this->data); 
    }

    public function dataTarik()
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
        $where = array();
        $limit = 0;
        $start = 0;

        $totalData = $this->Finace_model->getCountAllBy($search, $where);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        $where["type"] = 3;

        if (!empty($searchColumn[1]['search']['value'])) {
        $value = $searchColumn[1]['search']['value'];
        $isSearchColumn = true;
        $where['created_at >='] = date("Y-m-d", strtotime($value));
        }

        if (!empty($searchColumn[2]['search']['value'])) {
        $value = $searchColumn[2]['search']['value'];
        $isSearchColumn = true;
        $where['created_at <='] =  date("Y-m-d", strtotime($value));
        }



        if ($isSearchColumn) {
        $totalFiltered = $this->Finace_model->getCountAllBy($search, $where);
        } else {
        $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($data->type == 1) {
                    $type = "<label class='label bg-blue'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label class='label bg-red'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label class='label bg-green'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label class='label bg-red'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

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

    public function export_tarik()
    {
        $pengaturan = $this->pengaturan_model->getOneBy();
        $periode_start = $this->uri->segment(3);
        $periode_end = $this->uri->segment(4);

        $where = [];
        $where['created_at >='] = $periode_start;
        $where['created_at <='] = $periode_end;
        $where["type"] = 3;
        $search = [];
        $limit = 0;
        $start = 0;
        $order = 0;
        $dir = 0;

        $datas = $this->Finace_model->getAll($limit, $start, $search, $order, $dir, $where);

        $new_data = [];

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                if ($data->type == 1) {
                    $type = "<label style='color:blue;'>Pemasukan</label>";
                } elseif ($data->type == 2) {
                    $type = "<label style='color:red;'>Pengeluaran Orasional</label>";
                } elseif ($data->type == 3) {
                    $type = "<label style='color:blue;'>Tarik Uang (Bank)</label>";
                } else {
                    $type = "<label style='color:red;'>Setor Uang (Bank)</label>";
                }

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['amount'] = number_format($data->amount);
                $nestedData['description'] = $data->description;
                $nestedData['type'] = $type;
                $nestedData['created_at'] =  date('Y-m-d', strtotime($data->created_at));

                $new_data[] = $nestedData;
            }
        }
        
		$this->data['pengaturan'] = $pengaturan;
		// $this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
		// $this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
        $this->data['data'] = $new_data; 
        $this->data['periode_start'] = $periode_start; 
        $this->data['periode_end'] = $periode_end; 
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = ucwords(str_replace("_", " ", $this->uri->segment(1). " - " . $this->uri->segment(2))) . "-" . date('dmy');

        $this->pdf->load_view('admin/finace_report/pdf/cetak_pdf', $this->data);  
    }
}