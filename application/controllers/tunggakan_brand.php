<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Tunggakan_brand extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('tunggakan_brand_model','brand'); 
    $this->load->model('customer_model');
    $this->load->model('tunggakan_brand_detail_model','tunggakan');
    $this->load->model('cicilan_model');
    $this->load->model('akad_model');
    $this->load->model('customer_model');
    $this->load->model('brand_model');

  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/laporan_brand/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

  public function dataList(){
    $columns = array( 
            0 => 'id',
            1 => 'name',
            2 => ''
        );

      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];
      $search = array();
      $limit = 0;
      $start = 0;
      $time = strtotime("now");
      $totalData = $this->brand->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->brand->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->brand->getAllBy($limit,$start,$search,$order,$dir,$time);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
                {   
               
            

                if ($this->data['is_can_edit']) {
                  $edit_url = "<a href='" . base_url() . "tunggakan_brand/view/" . $data->id . "' class='btn btn-primary btn-sm white'><i class='fa fa-eye'></i> Lihat</a>";
                } else {
                  $edit_url = "";
                }
           // $nestedData['id']   = $start+$key+1;
            $nestedData['id']   = $data->id;
            $nestedData['name']         = $data->name;
            $nestedData['jumlah']         = $data->jumlah;
            $nestedData['action'] = $edit_url;
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

  public function view($id)
  {
     
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/laporan_brand/list_detail_v';
      $this->data['brand'] = $id;
      $this->data['name_brand'] =  $this->brand_model->getAllById(array('id' => $id));
      $this->data['pelanggan'] = $this->akad_model->getAllById(array('is_deleted' => '0'));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }


  public function dataList_brand($id)
  {
    $columns = array(
        0 => 'angsuran.id_angsuran',
        1 => 'angsuran.id_pelanggan',
        2 => 'angsuran.cicilan',
        3 => 'angsuran.jumlah_cicilan',
        4 => '',
        5 => '',
        6 => 'angsuran.tgl_jatuh_tempo',
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
    $jatuh_tempo = $this->tunggakan->getOneJatuh_tempo();
    $set = (!empty($jatuh_tempo)) ? $jatuh_tempo->set_hari : "";
    $setting_hari = "+ interval " . $set . " day";
    $totalData = $this->tunggakan->getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;

    $where['s.merek ='] = $id;

     if (!empty($searchColumn[1]['search']['value'])) {
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $search['angsuran.id_pelanggan'] = $value;
    }

    if (!empty($searchColumn[2]['search']['value'])) {
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $where['angsuran.tgl_jatuh_tempo >='] = date("Y-m-d", strtotime($value));
    }

    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $where['angsuran.tgl_jatuh_tempo <='] =  date("Y-m-d", strtotime($value));
    }



    if ($isSearchColumn) {
      $totalFiltered = $this->tunggakan->getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->tunggakan->getAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {
       $denda = $data->jumlah_cicilan - $data->jumlah_bayar;
        if ($this->data['is_can_edit']) {
          $cetak = "<a target='blank' href='" . base_url() . "bukti_pembayaran/pdf/" . $data->id_angsuran . "'><i class='fa fa-print'></i> Cetak</a> ";
        }

        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $nama = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-search'></i> ".$nama."</a> ";
        $nominalDenda = 3000;
        $totalDenda = str_replace("-", "", $nominalDenda * $data->selisih);
        $total = ($data->jumlah_cicilan + $totalDenda);
        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_akad']  = $data->id_akad;
        $nestedData['id_invoice']  = $data->id_invoice;
        $nestedData['id_pelanggan']  = $view_url;
        $nestedData['cicilan']  = $data->cicilan;
        $nestedData['jumlah_cicilan']  = "Rp. " . number_format($data->jumlah_cicilan, 0, ".", ".");
        $nestedData['denda']  = "Rp. " . number_format($totalDenda, 0, ".", ".");
        $nestedData['tgl_jatuh_tempo']  = date("d-m-Y", strtotime($data->tgl_jatuh_tempo));
        $nestedData['total']  = "Rp. " . number_format($total, 0, ".", ".");
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


}