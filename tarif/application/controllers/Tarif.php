<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Tarif_model", "tarif");
        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Tarif';
        $data['user'] = $this->user->getUserData();
        $data['tarif'] = $this->tarif->allData()->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tarif/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('asal', "Nama Harus Diisi", 'required');
        if ($this->form_validation->run() === true) {
            $data = [
                "asal" => $this->input->post("asal"),
                "tujuan" => $this->input->post("tujuan"),
                "tarif" => $this->input->post("tarif"),
                "min_charge" => $this->input->post("min_charge") . " " . $this->input->post("satuan"),
                "estimasi" => $this->input->post("estimasi") . " " . $this->input->post("lama"),
                "keterangan" => $this->input->post("keterangan"),
                "kontak" => !empty($this->input->post("kontak")) ? $this->input->post("kontak") : "-",
                "kargo" => $this->input->post("kargo"),
            ];

            $insert = $this->tarif->insert($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tarif berhasil dibuat!</div>');

                redirect("tarif","refresh");
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tarif gagal dibuat!</div>');
                redirect("tarif/create","refresh");
            } 
        } else {
            $data['title'] = 'Create Tarif';
            $data['user'] = $this->user->getUserData();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('tarif/add', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('tarif', 'Tarif', 'trim|required');

        if ($this->form_validation->run() === true) {
            $data = [
                "asal" => $this->input->post("asal"),
                "tujuan" => $this->input->post("tujuan"),
                "tarif" => $this->input->post("tarif"),
                "min_charge" => $this->input->post("min_charge") . " " . $this->input->post("satuan"),
                "estimasi" => $this->input->post("estimasi") . " " . $this->input->post("lama"),
                "keterangan" => $this->input->post("keterangan"),
                "kontak" => !empty($this->input->post("kontak")) ? $this->input->post("kontak") : "-",
                "kargo" => $this->input->post("kargo"),
            ];

            $update = $this->tarif->update($data, ['id' => $id]);

            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tarif berhasil diubah!</div>');

                redirect("tarif","refresh");
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tarif gagal diubah!</div>');
                redirect("tarif","refresh");
            } 
        } else {
            $data['title'] = 'Edit Tarif';
            $data['user'] = $this->user->getUserData();
            $data['tarif'] = $this->tarif->getOneBy(["id" => $id]);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('tarif/edit', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $delete = $this->tarif->hapus_data($where,'tarif');
        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tarif berhasil dihapus!</div>');

            redirect("tarif","refresh");
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">tarif gagal dihapus!</div>');
            redirect("tarif","refresh");
        } 
    }
}