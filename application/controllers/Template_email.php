<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';

class Template_email extends Admin_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->model("template_email_model", "template");
    }

    public function index()
    {
        $this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/template_email/index';
            $this->data['template_email'] = $this->template->getAll();
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
    }

    public function update()
    {
        $this->form_validation->set_rules('tipe', "Name Harus Diisi", 'trim|required');
        if ($this->form_validation->run() === TRUE) {
            $data = [
                "tipe" => $this->input->post("tipe"),
                "isi" => $this->input->post("isi")
            ];

            $update = $this->template->update($data, ["id" => $this->input->post("id")]);

            if ($update) {
               
                 $this->session->set_flashdata('message',"Template Email berhasil diupdate");

                 redirect('template_email', 'refresh');
            } else {
                $this->session->set_flashdata('message_error',"Template Email gagal diupdate");

                redirect('template_email', 'refresh');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->post("id");
        $data['data'] = $this->template->getById($id)->row();

        $this->load->view("admin/template_email/edit", $data);
    }
}