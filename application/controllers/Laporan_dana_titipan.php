<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Laporan_dana_titipan extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('angsuran_model');
        $this->load->model('angsuran_titipan_model');
        $this->load->model('pengaturan_model');
        $this->load->model('customer_model');
		$this->load->helper('url');
		//$this->load->library('excel');
		$this->load->library('Pdf');
	}

	public function index()
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['title'] = 'Laporan Dana Titipan';
			$this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
			$this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
			$this->data['angsuran_titipan'] = $this->dataList();
			$this->data['content'] = 'admin/laporan/list_angsuran_titipan_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function detail()
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['title'] = 'Laporan Dana Titipan';
			$this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
			$this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
			$this->data['angsuran_detail'] = $this->dataList_detail();
			$this->data['content'] = 'admin/laporan/list_angsuran_titipan_detail_v.php';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function dataList()
	{
		$start_date  = date("Y-m-d", strtotime(date('Y-m') . '-01'));
		$end_date = date("Y-m-d", strtotime(date('Y-m') . '-31'));

		$where = array(

			'created_on >=' => $start_date,
			'created_on <=' => $end_date,
		);

		$laporan_angsuran = $this->angsuran_titipan_model->getSumAmount($where);

		$data = [];
		$total = 0;
		if (!empty($laporan_angsuran)) {
			foreach ($laporan_angsuran as $val) {

				$total += @$val->total;

				$array['date'] = $val->created_on;
				$array['sub_total'] = $val->total;
				$array['total'] = $total;

				array_push($data, $array);
			}
		}

		return $data;
	}

	function angsuran_pdf()
    {

        $pengaturan = $this->pengaturan_model->getOneBy();
		$this->data['pengaturan'] = $pengaturan;
		$this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
		$this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
		$this->data['angsuran_titipan'] = $this->dataList();
        $this->load->library('Pdf');
        $this->pdf->set_option('enable_html5_parser', TRUE);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Laporan-Dana-Titipan" . date('dmy') . ".pdf";
        $this->pdf->load_view('admin/laporan/cetak_dana_titipan_v', $this->data, true);
	}
	
	function angsuran_detail_pdf()
    {

        $pengaturan = $this->pengaturan_model->getOneBy();
		$this->data['pengaturan'] = $pengaturan;
		$this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
		$this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
		$this->data['angsuran_detail'] = $this->dataList_detail();
        $this->load->library('Pdf');
        $this->pdf->set_option('enable_html5_parser', TRUE);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Laporan-rincian-Angsuran" . date('dmy') . ".pdf";
        $this->pdf->load_view('admin/laporan/cetak_dana_titipan_detail_v', $this->data, true);
    }



	public function dataList_detail()
	{
		$getDate = $this->uri->segment(3);

		$where = array(
			//	'status' => 2, 
			'created_on >=' => $getDate,
			'created_on <=' => $getDate,
		);
    
		$laporan_angsuran = $this->angsuran_titipan_model->getSumAmountDetail($where);
		$data = [];
		if (!empty($laporan_angsuran)) {
			foreach ($laporan_angsuran as $val) {
                $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $val->id_pelanggan));
                $ambil_cicilan = $this->angsuran_model->getOneByAngsuran(array("id_angsuran" => $val->id_angsuran));
             
				$array['date'] = date('d M Y', strtotime($val->created_on));
				$array['total'] = $val->total;
				$array['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
                $array['cicilan'] = (!empty($ambil_cicilan)) ? $ambil_cicilan->cicilan : "";
                $array['atas_nama'] = $val->nama;
                $array['invoice'] = $val->id_invoice;
				array_push($data, $array);
			}
		}

		return $data;
	}
      

}
