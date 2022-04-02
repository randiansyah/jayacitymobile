<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Laporan_dana_angsuran extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_angsuran_model');
		$this->load->model('pengaturan_model');
		$this->load->helper('url');
		//$this->load->library('excel');
		$this->load->library('Pdf');
	}

	public function index()
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['title'] = 'Laporan Dana Angsuran';
			$this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
			$this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
			$this->data['angsuran'] = $this->dataList();
			$this->data['content'] = 'admin/laporan/list_angsuran_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function detail()
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['title'] = 'Laporan Dana Angsuran';
			$this->data['start_date'] = date('d M Y', strtotime(date('Y-m') . '-01'));
			$this->data['end_date'] = date('d M Y', strtotime(date('Y-m') . '-31'));
			$this->data['angsuran_detail'] = $this->dataList_detail();
			$this->data['content'] = 'admin/laporan/list_angsuran_detail_v';
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

		$laporan_angsuran = $this->laporan_angsuran_model->getSumAmount($where);

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
		$this->data['angsuran'] = $this->dataList();
        $this->load->library('Pdf');
        $this->pdf->set_option('enable_html5_parser', TRUE);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = "Laporan-Angsuran" . date('dmy') . ".pdf";
        $this->pdf->load_view('admin/laporan/cetak_angsuran_v', $this->data, true);
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
        $this->pdf->load_view('admin/laporan/cetak_angsuran_detail_v', $this->data, true);
    }



	public function dataList_detail()
	{
		$getDate = $this->uri->segment(3);

		$where = array(
			//	'status' => 2, 
			'created_on >=' => $getDate,
			'created_on <=' => $getDate,
		);

		$laporan_angsuran = $this->laporan_angsuran_model->getSumAmount_detail($where);
		$data = [];
		if (!empty($laporan_angsuran)) {
			foreach ($laporan_angsuran as $val) {
				$array['date'] = date('d M Y', strtotime($val->created_on));
				$array['total'] = $val->total;
				$array['nama'] = $val->nama;
				$array['cicilan'] = $val->cicilan;
				array_push($data, $array);
			}
		}

		return $data;
	}
      

}
