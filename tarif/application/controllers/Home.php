<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("Tarif_model", "tarif");
    }

    public function index()
    {
        $data = [
            "asalDarat" => $this->tarif->getAsalDarat(),
            "tujuanDarat" => $this->tarif->getTujuanDarat(),
			"asalLaut" => $this->tarif->getAsalLaut(),
			"tujuanLaut" => $this->tarif->getTujuanLaut(),
			"asalUdara" => $this->tarif->getAsalUdara(),
			"tujuanUdara" => $this->tarif->getTujuanUdara(),
        ];

        $data["data"] = $data;

        $this->load->view("home/index", $data);
    }

    public function getTarifDarat()
    {
        $tujuan = $this->input->post("tujuanDarat");
        $asal = $this->input->post("asalDarat");

        $tarif = $this->tarif->getOneBy(["asal" => $asal, "tujuan" => $tujuan, "kargo" => "darat"]);

        echo json_encode($tarif);
    }
	 public function getTarifLaut()
    {
        $tujuan = $this->input->post("tujuanLaut");
        $asal = $this->input->post("asalLaut");

        $tarif = $this->tarif->getOneBy(["asal" => $asal, "tujuan" => $tujuan, "kargo" => "laut"]);

        echo json_encode($tarif);
    }
	 public function getTarifUdara()
    {
        $tujuan = $this->input->post("tujuanUdara");
        $asal = $this->input->post("asalUdara");

        $tarif = $this->tarif->getOneBy(["asal" => $asal, "tujuan" => $tujuan, "kargo" => "udara"]);

        echo json_encode($tarif);
    }
}