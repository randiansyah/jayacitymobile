<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Laporan_pembayaran_karyawan extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Laporan_pembayaran_karyawan_model','karyawan'); 
    $this->load->model('akad_model');
    $this->load->model('customer_model');
    $this->load->model('cicilan_model');
    $this->load->model('karyawan_model');
  

  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/laporan_pembayaran1/list_karyawan_v';   
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
      $totalData = $this->karyawan->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->karyawan->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->karyawan->getAllBy($limit,$start,$search,$order,$dir,$time);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
                {   
               
            

                if ($this->data['is_can_edit']) {
                  $edit_url = "<a href='" . base_url() . "Laporan_pembayaran_karyawan/view/" . $data->id . "' class='btn btn-primary btn-sm white'><i class='fa fa-eye'></i> Lihat</a>";
                } else {
                  $edit_url = "";
                }
           // $nestedData['id']   = $start+$key+1;
            $nestedData['id']   = $data->id;
            $nestedData['name']         = $data->nama;
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
      $this->data['content'] = 'admin/laporan_pembayaran1/list_detail_karyawan_v';
      $this->data['pelanggan'] = $this->akad_model->getAllById(array('is_deleted' => '0'));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
      $this->data['brand'] = $id;
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }


  public function dataListKaryawan($id)
  {
    $columns = array(
      0 => '',
      1 => 'angsuran.id_pelanggan',
      2 => 'angsuran.cicilan',
      3 => 'angsuran.total_bayar',
      4 => 'angsuran.tgl_bayar',
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
    $limit = 0;
    $start = 0;
    $jatuh_tempo = $this->karyawan->getOneJatuh_tempo();
    $set = (!empty($jatuh_tempo)) ? $jatuh_tempo->set_hari : "";
    $setting_hari = "+ interval " . $set . " day";

    $where['angsuran.teller'] = $id; 
    $totalData = $this->karyawan->getCountAllByBrand($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;


  

     if (!empty($searchColumn[1]['search']['value'])) {
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $search['angsuran.id_pelanggan'] = $value;
    }

    if (!empty($searchColumn[2]['search']['value'])) {
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $where['angsuran.tgl_bayar >='] = date("d-m-Y", strtotime($value));
    }

    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $where['angsuran.tgl_bayar <='] =  date("d-m-Y", strtotime($value));
    }



    if ($isSearchColumn) {
      $totalFiltered = $this->karyawan->getCountAllByBrand($limit, $start, $search, $order, $dir, $where, $setting_hari);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->karyawan->getAllByBrand($limit, $start, $search, $order, $dir, $where, $setting_hari);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ( strval($data->teller) !== strval(intval($data->teller)) ) {
          $teller = $data->teller;
        }else {

          $karyawan = $this->karyawan_model->getAllById(array("id" => $data->teller));
          $teller = (!empty($karyawan)) ? $karyawan[0]->nama : "";
        }
      
        if($data->created_by == 1){
        $created_by = "Admin";
        }else {
          $created = $this->karyawan_model->getAllById(array("id_pengguna" => $data->created_by));
          $created_by = (!empty($created)) ? $created[0]->nama : "";
        }
        

   
        if ($this->data['is_can_edit']) {
          $cetak = "<a target='blank' href='" . base_url() . "bukti_pembayaran/pdf/" . $data->id_angsuran . "'><i class='fa fa-print'></i> Cetak</a> ";
        }

        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $nama = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-search'></i> ".$nama."</a> ";
     
        $nestedData['id']   = $start + $key + 1;
        $nestedData['id_akad']  = $data->id_akad;
        $nestedData['id_invoice']  = $data->id_invoice;
        $nestedData['id_pelanggan']  = $view_url;
        $nestedData['cicilan']  = $data->cicilan;
        $nestedData['barang']  = $data->nama_barang;
        $nestedData['created_by']  = $created_by;
        $nestedData['teller']  = $teller;
        $nestedData['jumlah_bayar']  = "Rp. " . number_format($data->jumlah_bayar, 0, ".", ".");
        $nestedData['denda']  = "Rp. " . number_format($data->denda, 0, ".", ".");
        $nestedData['diskon']  = "Rp. " . number_format($data->diskon, 0, ".", ".");
        $nestedData['total_bayar']  = "Rp. " . number_format($data->total_bayar, 0, ".", ".");
        $nestedData['tgl_bayar']  = $data->pay_time.'  '.$data->tgl_bayar;
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