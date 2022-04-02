<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Menu extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_admin_model');
    }

    public function index()
    {
        $this->load->helper('url');
        if ($this->data['is_can_read']) {
            $this->data['title'] = 'Data Menu Admin';
            $this->data['content'] = 'admin/menu_admin/list_v';
        } else {
            $this->data['content'] = 'errors/html/restrict';
        }

        $this->load->view('admin/layouts/page', $this->data);
    }

    public function dataList_admin()
    {
        $columns = array(
            0 => 'id', 1 => 'name',
            2 => 'url', 3 => 'parent_id', 4 => 'icon',
            5 => 'sequence', 6 => ''
        );

        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $search = array();
        $limit = 0;
        $start = 0;
        $totalData = $this->menu_admin_model->getCountAllBy($limit, $start, $search, $order, $dir);

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;

        if ($isSearchColumn) {
            $totalFiltered = $this->menu_admin_model->getCountAllBy($limit, $start, $search, $order, $dir);
        } else {
            $totalFiltered = $totalData;
        }

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $datas = $this->menu_admin_model->getAllBy($limit, $start, $search, $order, $dir);

        $new_data = array();
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                $dataParent = $this->menu_admin_model->getAllById(array('id' => $data->parent_id));
                $name = (!empty($dataParent)) ? $dataParent[0]->name : "";

                $nestedData['id'] = $start + $key + 1;
                $nestedData['name'] = $data->name;
                $nestedData['url'] = $data->url;
                $nestedData['parent_id'] = $name;
                $nestedData['icon'] = "<i class='" . $data->icon . "'></i>";
                $nestedData['sequence'] = $data->sequence;

                if ($this->data['is_can_edit'] && $data->is_deleted == 0) {
                    $edit_url = "<a href='" . base_url() . "menu/edit_admin/" . $data->id . "' class='btn btn-primary btn-sm white btn-xs'><i class='fa fa-pencil'></i> Ubah</a>";
                } else {
                    $edit_url = "";
                }
                if ($this->data['is_can_delete']) {
                    if ($data->is_deleted == 0) {
                        $delete_url = "<button
                  url='" . base_url() . "menu/destroy_admin/" . $data->id . "/" . $data->is_deleted . "'
                  class='btn btn-danger btn-sm white delete btn-xs' >NonAktifkan
                  </button>";
                    } else {
                        $delete_url = "<button
                  url='" . base_url() . "menu/destroy_admin/" . $data->id . "/" . $data->is_deleted . "'
                  class='btn btn-danger btn-sm white delete btn-xs' 
                  >Aktifkan
                  </button>";
                    }
                }
                $nestedData['action'] = $edit_url . "  " . $delete_url;

                $new_data[] = $nestedData;
            }
        }
        $json_data = array("draw" => intval($this->input->post('draw')), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $new_data);

        echo json_encode($json_data);
    }



    public function create_admin()
    {
        $this->form_validation->set_rules('menu_name', "Nama Menu", 'trim|required');

        if ($this->form_validation->run() === true) {


            $id = $this->input->post('parent_id');
            $sequence = $this->menu_admin_model->getCountParent(array("parent_id" => $id));

            $data = array(
                'parent_id' => $this->input->post('parent_id'),
                'name' => $this->input->post('menu_name'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'module_id' => "1",
                'sequence' => $sequence
            );

            if ($this->menu_admin_model->insert($data)) {
                $this->session->set_flashdata('message', "Menu admin Baru Berhasil Disimpan");
                redirect("menu");
            } else {
                $this->session->set_flashdata('message_error', "Menu admin Gagal Disimpan");
                redirect("menu/create_admin");
            }
        } else {
            $date = date("Y-m-d");
            $this->data['label'] = 'Data Menu';
            $this->data['title'] = 'Tambah Data Menu';
            $this->data['content'] = 'admin/menu_admin/create_v';
            $this->data['parent_id'] = $this->menu_admin_model->getAllById(array("parent_id" => 1));
            $this->data['waktu_input'] = $date;
            $this->load->view('admin/layouts/page', $this->data);
        }
    }



    public function edit_admin($id)
    {
        $this->form_validation->set_rules('menu_name', "Nama Menu", 'trim|required');

        if ($this->form_validation->run() === true) {


            $id_parent = $this->input->post('parent_id');
            $sequence = $this->menu_admin_model->getCountParent(array("parent_id" => $id_parent));

            $data = array(
                'parent_id' => $this->input->post('parent_id'),
                'name' => $this->input->post('menu_name'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'module_id' => "1",
                'sequence' => $sequence
            );

            if ($this->menu_admin_model->update($data, array("menu.id" => $id))) {
                $this->session->set_flashdata('message', "Menu admin Baru Berhasil Diubah");
                redirect("menu");
            } else {
                $this->session->set_flashdata('message_error', "Menu admin Gagal Diubah");
                redirect("menu/edit_admin");
            }
        } else {
            $date = date("Y-m-d");
            $this->data['label'] = 'Data Menu';
            $this->data['title'] = 'Edit Data Menu';
            $this->data['content'] = 'admin/menu_admin/edit_v';
            $this->data['parent_id'] = $this->menu_admin_model->getAllById(array("parent_id" => 1));
            $this->data['data_menu'] = $this->menu_admin_model->getOneBy(array("id" => $id));
            $this->data['waktu_input'] = $date;
            $this->load->view('admin/layouts/page', $this->data);
        }
    }



    public function destroy_admin()
    {
        $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();

        $id = $this->uri->segment(3);
        $is_deleted = $this->uri->segment(4);
        if (!empty($id)) {
            $this->load->model("menu_admin_model");
            $data = array('is_deleted' => ($is_deleted == 1) ? 0 : 1);
            $update = $this->menu_admin_model->update($data, array("id" => $id));

            $response_data['data'] = $data;
            $response_data['status'] = true;
        } else {
            $response_data['msg'] = "ID Harus Diisi";
        }

        echo json_encode($response_data);
    }
}
