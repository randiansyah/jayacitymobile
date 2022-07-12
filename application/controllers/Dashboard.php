<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Dashboard extends Admin_Controller {
 	public function __construct()
	{
		parent::__construct();
	
    $this->load->model('akad_model');
    $this->load->model('customer_model');
    $this->load->model('Laporan_tunggakan_model');
    $this->load->model('cicilan_model');
    $this->load->model('laporan_angsuran_model');
    $this->load->model('angsuran_titipan_model');
	
	}
	public function index()
	{
    $this->load->helper('url');	
   

		$this->data['pelanggan'] = $this->customer_model->getAllById();   
    if ($this->ion_auth->is_admin()) {
      $this->data['content'] = 'admin/dashboard';  
      $start_date  = date("Y-m-d", strtotime(date('Y-m') . '-01'));
      $end_date = date("Y-m-d", strtotime(date('Y-m') . '-31'));
  
      $where = array(
  
        'created_on >=' => $start_date,
        'created_on <=' => $end_date,
      );
     // $where = array();
    } else {
      $where = array();
      $id = $this->data['users']->id;
     
      $where['id_pelanggan'] = $id;
      $this->data['content'] = 'admin/customer/dashboard';  
      $this->data['buy_total'] = 	$this->akad_model->getSumBuyTotal($where);
    } 
        
    $this->data['total_dana_angsuran'] = 	$this->laporan_angsuran_model->getSumJumlah($where);
    $this->data['total_dana_tunggakan'] = 	$this->laporan_angsuran_model->getSumTunggakan($where);
    $this->data['total_dana_titipan'] = 	$this->angsuran_titipan_model->getSumJumlah($where);
    $this->data['total_dana_titipan'] = 	$this->angsuran_titipan_model->getSumJumlah($where);
  

		$this->load->view('admin/layouts/page',$this->data); 
	} 


  public function dataList_tunggakan()
  {
    $columns = array(
      0 => '',
      1 => '',
      2 => '',
      3 => '',
      4 => '',
      5 => '',
      6 => '',
      7 => '',
      8 => '',
      9 => '',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $where = array();
    $setting_hari = 0;
    $limit = 0;
    $start = 0;
    $jatuh_tempo = $this->Laporan_tunggakan_model->getOneJatuh_tempo();
    $set = (!empty($jatuh_tempo)) ? $jatuh_tempo->set_hari : "";
    $setting_hari = "+ interval " . $set . " day";
    $totalData = $this->Laporan_tunggakan_model->getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;
/*
    if (!empty($searchColumn[4]['search']['value'])) {
      $value = $searchColumn[4]['search']['value'];
      $isSearchColumn = true;
      $where['tgl_bayar >='] = date("Y-m-d", strtotime($value));
    }

    if (!empty($searchColumn[5]['search']['value'])) {
      $value = $searchColumn[5]['search']['value'];
      $isSearchColumn = true;
      $where['tgl_bayar <='] =  date("Y-m-d", strtotime($value));
    }

*/

    if ($isSearchColumn) {
      $totalFiltered = $this->Laporan_tunggakan_model->getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->Laporan_tunggakan_model->getAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {
       $sisa = $data->jumlah_cicilan - $data->jumlah_bayar;
        if ($this->data['is_can_edit']) {
          $cetak = "<a target='blank' href='" . base_url() . "bukti_pembayaran/pdf/" . $data->id_angsuran . "'><i class='fa fa-print'></i> Cetak</a> ";
        }

        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $nama =  (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-search'></i> ".$nama."</a> ";
     
        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_akad']  = $data->id_akad;
        $nestedData['id_invoice']  = $data->id_invoice;
        $nestedData['id_pelanggan']  = $view_url;
        $nestedData['cicilan']  = $data->cicilan;
        $nestedData['jumlah_cicilan']  = "Rp. " . number_format($data->jumlah_cicilan, 0, ".", ".");
        $nestedData['jumlah_bayar']  = "Rp. " . number_format($data->jumlah_bayar, 0, ".", ".");
        $nestedData['tgl_jatuh_tempo']  = date("d-m-Y", strtotime($data->tgl_jatuh_tempo));
        $nestedData['sisa']  = "Rp. " . number_format($data->sisa, 0, ".", ".");
        $nestedData['selisih']  = $data->selisih . ' Hari';
        $nestedData['aksi'] = $cetak;


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

	public function transaction_chart()
	{
		$periode_start      	= $this->input->post('periode_start');
    $periode_end      	= $this->input->post('periode_end');
		$start_date  = date("Y-m-d", strtotime(date('Y-m') . '-01'));
		$end_date = date("Y-m-d", strtotime(date('Y-m') . '-31'));
		$today			= date('Y-m-d');
		$tgl_today		= mktime(0, 0, 0, date("m"), date("d") - 6, date("Y"));
		$tujuh_hari		= date("Y-m-d", $tgl_today);
		$query = $this->db->query("SELECT sum(jumlah_bayar) AS total,tgl_bayar FROM angsuran 
    WHERE  DATE_FORMAT(str_to_date(tgl_bayar,'%d-%m-%Y'), '%Y-%m-%d') >= '" . $periode_start . "' 
    AND DATE_FORMAT(str_to_date(tgl_bayar,'%d-%m-%Y'), '%Y-%m-%d') <= '" . $periode_end . "'
     GROUP BY tgl_bayar ORDER BY tgl_bayar ASC");


		//	 echo $user;die;
		//	echo $this->db->last_query();die;
		@$total = [];
		@$created_on = [];
		foreach ($query->result_array() as $row) {
			@$total[] = (float) (@$row['total']);
			@$created_on[] = date('d M', strtotime(@$row['tgl_bayar']));
		}

		// data json untuk chart
		$data = array(
			'date' => $created_on,
			'total'  => $total,
		);

		echo json_encode($data);
  }
  
  public function sale_chart()
	{

    $periode_start      	= $this->input->post('periode_start');
    $periode_end      	= $this->input->post('periode_end');

		$query = $this->db->query("SELECT sum(total) AS total,tgl_akad
     FROM akad WHERE  DATE_FORMAT(tgl_akad,'%Y-%m-%d') >= '" . $periode_start . "'
      AND DATE_FORMAT(tgl_akad,'%Y-%m-%d') <= '" . $periode_end . "' GROUP BY 
     tgl_akad ORDER BY tgl_akad ASC");


		//	 echo $user;die;
			// echo $this->db->last_query();die;
		@$total = [];
		@$created_on = [];
		foreach ($query->result_array() as $row) {
			@$total[] = (float) (@$row['total']);
			@$created_on[] = date('d M', strtotime(@$row['tgl_akad']));
		}

		// data json untuk chart
		$data = array(
			'date' => $created_on,
			'total'  => $total,
		);

		echo json_encode($data);
	}
  


}
