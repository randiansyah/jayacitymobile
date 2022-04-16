<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Hand_over extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cicilan_model');
        $this->load->model('serah_barang_model');
        $this->load->model('customer_model');
    }
    public function index()
    {
        $this->load->helper('url');
        if ($this->data['is_can_read']) {
            $this->data['content'] = 'admin/hand_over/list_v';
        } else {
            $this->data['content'] = 'errors/html/restrict';
        }

        $this->load->view('admin/layouts/page', $this->data);
    }

    public function dataList()
    {
        $columns = array(
            0 => 'id',
            1 => 'id_pelanggan',
            2 => 'image',
            3 => 'created_at',
            4 => ''
        );

        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = array();
        $limit = 0;
        $start = 0;
        $totalData = $this->serah_barang_model->getCountAllBy($limit, $start, $search, $order, $dir);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;


        if ($isSearchColumn) {
            $totalFiltered = $this->serah_barang_model->getCountAllBy($limit, $start, $search, $order, $dir);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->serah_barang_model->getAllBy($limit, $start, $search, $order, $dir);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {

                if ($this->data['is_can_delete']) {
                    $delete_url = "<a href='#' 
                  url='" . base_url() . "Hand_over/destroy/" . $data->id_serah_barang . "'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
                }
                if ($this->data['is_can_edit']) {
                    $edit_url = "<a href='" . base_url() . "Hand_over/edit/" . $data->id_serah_barang . "'><i class='fa fa-pencil'></i> Edit</a> ";
                }
                // $nestedData['id']   = $start+$key+1;
                $nestedData['id']   = $data->id_serah_barang;
                $nestedData['id_pelanggan']         = $data->nama;
                $nestedData['teller']         = $data->teller;
                $nestedData['image']         = "<a href='assets/upload/image/$data->image' target='blank'><img src=assets/upload/image/$data->image width='30%' alt='Snow'></a>";
                $nestedData['created_at']         =  date("d M Y", strtotime($data->created_at));
                $nestedData['action'] = $edit_url . "  " . $delete_url;
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

        $this->form_validation->set_rules('id_pelanggan', "pelanggan", "trim|required");

        if ($this->form_validation->run() === TRUE) {
            $config['upload_path']          = './assets/upload/image';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']      = true;
            $config['max_size']    = 12024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photo')) {
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('message_error', "photo Gagal di upload");
                redirect("Hand_over/create", "refresh");
            } else {
                $this->load->library('image_lib');
                $image_data =   $this->upload->data();

                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_data['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'quality' => '40%', //tell CI to reduce the image quality and affect the image size
                    // 'width' => 640, //new size of image
                    // 'height' => 480, //new size of image
                );

                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                $data = array(
                    'id_pelanggan' => $this->input->post('id_pelanggan'),
                    'teller' => $this->input->post('teller'),
                    'image' =>  $image_data['file_name'],
                    'created_at' =>  date("Y-m-d H:i:s")
                );

                $create = $this->serah_barang_model->insert($data);
            }



            if ($create) {
                $this->session->set_flashdata('message', "Serah Barang Berhasil ditambahkan");
                redirect('Hand_over');
            } else {
                $this->session->set_flashdata('message', "Serah Barang Gagal ditambahkan");
                redirect('Hand_over');
            }
        } else {

            if ($this->data['is_can_read']) {
                $this->data['content'] = 'admin/hand_over/create_v';
            } else {
                $this->data['content'] = 'errors/html/restrict';
            }
            $this->data['pelanggan'] = $this->customer_model->getAllBySelect();
            $this->load->view('admin/layouts/page', $this->data);
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('pelanggan', "Nama Lengkap", 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $config['upload_path']          = './assets/upload/image';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']      = true;
            $config['max_size']             = 12024;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo')) {
                $photo_pelanggan = $this->input->post('file_foto');
            } else {
                $this->load->library('image_lib');
                $image_data =   $this->upload->data();

                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_data['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'quality' => '40%', //tell CI to reduce the image quality and affect the image size
                    // 'width' => 640, //new size of image
                    // 'height' => 480, //new size of image
                );

                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                $photo_pelanggan = $image_data['file_name'];
            }


            $data = array(
                'id_pelanggan' => $this->input->post('pelanggan'),
                'teller' => $this->input->post('teller'),
                'image' =>  $photo_pelanggan,
                'created_at' =>  date("Y-m-d H:i:s")
            );
            $update = $this->serah_barang_model->update($data, array('id_serah_barang' => $id));
            if ($update) {
                $this->session->set_flashdata('message', "Hasil Serah barang Berhasil Diubah");
                redirect("Hand_over");
            } else {
                $this->session->set_flashdata('message_error', "Hasil Serah barang Berhasil Diubah");
                redirect("Hand_over");
            }
        } else {
            $data = $this->serah_barang_model->getAllById(array("id_serah_barang" => $id));
            $this->data['id_pelanggan'] =   (!empty($data)) ? $data[0]->id_pelanggan : "";
            $this->data['data'] = $data[0];

            $this->data['pelanggan'] = $this->customer_model->getAllById();
            $this->data['content'] = 'admin/hand_over/edit_v';
            $this->load->view('admin/layouts/page', $this->data);
        }
    }

    public function destroy()
    {
        $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $delete = $this->serah_barang_model->delete(array("id_serah_barang" => $id));


            $response_data['data'] = $data;
            $response_data['status'] = true;
        } else {
            $response_data['msg'] = "ID KOSONG";
        }

        echo json_encode($response_data);
    }
}
