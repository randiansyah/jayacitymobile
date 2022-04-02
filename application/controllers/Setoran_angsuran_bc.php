<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';

class Setoran_angsuran extends Admin_Controller
{
  public function __construct()
  {
  
    parent::__construct();
    $this->load->model('customer_model');
    $this->load->model('akad_model');
    $this->load->model('angsuran_model');
    $this->load->model('angsuran_titipan_model');
    $this->load->model('cicilan_model');
    $this->load->model('pengaturan_model');
    $this->load->model('rekening_model');
    $this->load->model('transaksi_model');
    $this->load->model("template_email_model", "template");
    $this->load->library('mailer');
    $this->load->library('whatsapp');
  

  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/angsuran/list_v';
      $this->data['pelanggan'] = $this->akad_model->getAllById(array('is_deleted' => '0'));
      $this->data['lama_cicilan'] = $this->cicilan_model->getAllById();
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function dataList()
  {
    $columns = array(
      0 => '',
      1 => 'nama',
      2 => 'tgl_akad',
      3 => 'lama_cicilan',
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
    $limit = 0;
    $start = 0;
    $totalData = $this->angsuran_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;

    if (!empty($searchColumn[1]['search']['value'])) {
      $value = $searchColumn[1]['search']['value'];
      $isSearchColumn = true;
      $where['nomor_akad'] = $value;
    }

    if (!empty($searchColumn[2]['search']['value'])) {
      $value = $searchColumn[2]['search']['value'];
      $isSearchColumn = true;
      $where['akad.id_pelanggan'] = $value;
    }

    if (!empty($searchColumn[3]['search']['value'])) {
      $value = $searchColumn[3]['search']['value'];
      $isSearchColumn = true;
      $where['lama_cicilan'] = $value;
    }
    if (!empty($searchColumn[4]['search']['value'])) {
      $value = $searchColumn[4]['search']['value'];
      $isSearchColumn = true;
      $where['tgl_akad >='] = date("Y-m-d", strtotime($value));
    }

    if (!empty($searchColumn[5]['search']['value'])) {
      $value = $searchColumn[5]['search']['value'];
      $isSearchColumn = true;
      $where['tgl_akad <='] =  date("Y-m-d", strtotime($value));
    }

    if ($isSearchColumn) {
      $totalFiltered = $this->angsuran_model->getCountAllBy($limit, $start, $search, $order, $dir, $where);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->angsuran_model->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

        if ($this->data['is_can_edit']) {
          $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> Rincian</a> ";
          $edit_url = "<a href='" . base_url() . "Setoran_angsuran/bayar/" . $data->id_akad . "'><i class='fa fa-eye'></i>RINCIAN</a> ";
        }

        if ($this->data['is_can_delete']) {
          $delete_url = "<a href='#' 
                  url='" . base_url() . "Akad/destroy/" . $data->id_akad . "'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
        }
        $ambil_nama = $this->customer_model->getOneByID(array("id_pelanggan" => $data->id_pelanggan));
        $ambil_bayar = $this->angsuran_model->getSum(array("id_akad" => $data->id_akad));
        $nestedData['nama'] = (!empty($ambil_nama)) ? $ambil_nama[0]->nama : "";
        $terbayar = (!empty($ambil_bayar)) ? $ambil_bayar[0]->total_bayar : "";
        $sisa = $data->total - $terbayar;
        $nestedData['id']   = $start + $key + 1;
        $nestedData['nomor_akad']          = "<a href='" . base_url() . "akad/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> " . $data->nomor_akad . "</a> ";
        $nestedData['id_pelanggan']          = $data->id_pelanggan;
        $nestedData['id_invoice']          = $data->id_invoice;
        $nestedData['tgl_akad']    = date("d-m-Y", strtotime($data->tgl_akad));
        $nestedData['harga_jual']    = number_format($data->harga_jual, 0, ',', '.');
        $nestedData['lama_cicilan']    = $data->lama_cicilan . ' Bulan';
        $nestedData['total']    = number_format($data->total, 0, ',', '.');
        $nestedData['terbayar'] = number_format($terbayar, 0, ',', '.');
        $nestedData['sisa_pembayaran'] = number_format($sisa, 0, ',', '.');
        $nestedData['aksi'] = $edit_url;

        if($data->bunga > 100){
          $manual = number_format($data->bunga, 0, ',', '.'). ' /BLN';
          } else {
          $manual = $data->bunga . ' %';
          }
  
          $nestedData['bunga']          = $manual;


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

  public function bayar($id)
  {
    $this->form_validation->set_rules('nomor_akad', "Pelanggan tidak boleh kosong", 'trim|required');
    $date = date('y-m-d H:i:s');
    $akad = $this->akad_model->getAllById(array("id_akad" => $id));
    $pelanggan = $akad[0];
    //wa
    $getTemplate_wa = $this->template->getById(1)->result();
    $temp_wa = $getTemplate_wa[0];
    // email
    $getTemplate_email = $this->template->getById(3)->result();
    $temp_email = $getTemplate_email[0];

    // $kode = $this->customer_model->getKode();
    //  $id_inv = $this->transaksi_model->getKode();
    if ($this->form_validation->run() === TRUE) {

      $id_angsuran = $this->input->post('id_angsuran');
      $id_akad = $this->input->post('id_akad');
      $keterangan = $this->input->post('keterangan');
      $id_pelanggan = $this->input->post('id_pelanggan');
      $id_invoice = $this->input->post('id_invoice');
      $tgl = $this->input->post('tgl_bayar');
      $jumlah_cicilan = $this->input->post('jumlah_cicilan');
      $time = $this->input->post('time');
      $teller = $this->input->post('teller');
    
      $no = $this->input->post('no');
      $jumlah_cicilan = $this->input->post('jumlah_cicilan');
      $jumlah_bayar1 = str_replace(".", "", $this->input->post('bayar'));
      $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);
      $date = date("Y-m-d");
  
      $cicilan_angsuran = array();
      foreach ($no as $key => $val) {
        
        if ($no[$key] > 0) {
         // $sisa[$key] = $jumlah_cicilan[$key] - $jumlah_bayar[$key];
        if($jumlah_bayar[$key] == $jumlah_cicilan[$key]){
          $status[$key] = "1";
        }else{
          $status[$key] = "0";
        }
         // print_r($sisa[$key]);
           
          // if($sisa[$key] <= "0"){
          //   $status[$key] = "1";
          // }else{
          //   $status[$key] = "0";
          // }
        
          $tgl_bayar[$key] = date("Y-m-d",strtotime($tgl[$key]));
          $cicilan_angsuran[] = array(
            'id_akad'   => $id_akad,
            'id_pelanggan'   => $id_pelanggan,
            'id_invoice'     => $id_invoice,
            'jumlah_bayar'   => $jumlah_bayar[$key],
            'id_angsuran'   => $id_angsuran[$key],
            'tgl_bayar'   => $tgl[$key],
            'keterangan'   => $keterangan[$key],
            'pay_time'   => $time[$key],
            'teller'   => $teller[$key],
            //'status' => $status[$key],
            'created_on' =>  $tgl_bayar[$key],
          );
        }
      }

      $update =  $this->db->update_batch('angsuran', $cicilan_angsuran, 'id_angsuran');
      $this->db->error();

      if ($update) {
        $name = $this->input->post('nameP');
        $phone= $pelanggan->no_telp;
        $message = "Hi, ".$name.$temp_wa->isi;

        $this->whatsapp->send($phone, $message);
        
        $sendmail = array(
            'email_penerima'=> $pelanggan->email,
            'subjek'=> 'Pembayaran Angsuran',
            'content'=> "Hai ".$name."<br>".$temp_email->isi,
        );

        $this->mailer->send($sendmail);

        $this->session->set_flashdata('message', "Setoran Angsuran  Berhasil ditambahkan");
        redirect('Setoran_angsuran');
      } else {
        $this->session->set_flashdata('message', "Setoran Angsuran Gagal ditambahkan");
        redirect('Setoran_angsuran');
      }
    } else {
      $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));
      $id_pelanggan = (!empty($akad)) ? $akad[0]->id_pelanggan : "";
      $id_invoice = (!empty($akad)) ? $akad[0]->id_invoice : "";
      $transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $id_invoice));
      $this->data['idakad'] = $id;
      $this->data['akad'] = $akad[0];
      $this->data['transaksi'] = $transaksi;
      $this->data['angsuran'] = $angsuran;
      $this->data['content'] = 'admin/angsuran/bayar_v';
      $this->load->view('admin/layouts/page', $this->data);
    }
  }

  public function buy(){

    $this->form_validation->set_rules('id_angsuran',"angsurannya","trim|required");
      if($this->form_validation->run() === TRUE){
     
      $id_pelanggan = $this->input->post('id_pelanggan');
      $id = $this->input->post('id_angsuran');
      $id_inv = $this->input->post('id_inv');
      $jumlah_bayar1 = str_replace(".", "", $this->input->post('jumlah_bayar'));
      $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);
      $denda1 = str_replace(".", "", $this->input->post('denda'));
      $denda = str_replace("Rp", "", $denda1);
      $diskon1 = str_replace(".", "", $this->input->post('diskon'));
      $diskon = str_replace("Rp", "", $diskon1);
      $pelanggan = $this->customer_model->getOneBy(array("id_pelanggan" => $id_pelanggan));
      $transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $id_inv));
     
      //wa
      $getTemplate_wa = $this->template->getById(1)->result();
      $temp_wa = $getTemplate_wa[0];
      // email
      $getTemplate_email = $this->template->getById(3)->result();
      $temp_email = $getTemplate_email[0];

      $name = $pelanggan->nama;
      $phone= $pelanggan->no_telp;
      $message = "Hai, ".$name.$temp_wa->isi;
      $messageWA = $message. "
NAMA               : ".$transaksi->nama_barang."
NO IMEI            : ".$transaksi->imei1."
KETERANGAN : ".$this->input->post('keterangan')."
JAM BAYAR     : ".$this->input->post('time')."
TGL BAYAR      : ".$this->input->post('tgl_bayar')."
DENDA             : Rp.".number_format($denda, 0, ',', '.')."
DISKON            : Rp.".number_format($diskon, 0, ',', '.')."
JUMLAH          : Rp.".number_format($jumlah_bayar, 0, ',', '.')."

untuk mengetahui sisa tagihan,
anda bisa melakukan login di website kami dengan mengisi username dan password.
website kami : https://jayacitymobile.com
      ";

      $messageEmail = "Hai, ".$name.$temp_email->isi;
      $messageEmail1 = $messageEmail. "
NAMA PRODUK   : ".$transaksi->nama_barang."<br>
NO IMEI       : ".$transaksi->imei1."<br>
KETERANGAN    : ".$this->input->post('keterangan')."<br>
JAM BAYAR     : ".$this->input->post('time')."<br>
TGL BAYAR     : ".$this->input->post('tgl_bayar')."<br>
DENDA         : ".$this->input->post('denda')."<br>
DISKON        : ".$this->input->post('diskon')."<br>
JUMLAH        : ".$this->input->post('jumlah_bayar')."<br>

untuk mengetahui sisa tagihan,<br>
anda bisa melakukan login di website kami dengan mengisi username dan password.<br>
website kami : https://jayacitymobile.com
      ";

      $this->whatsapp->send($phone, $messageWA);
      
      $sendmail = array(
          'email_penerima'=> $pelanggan->email,
          'subjek'=> 'Pembayaran Angsuran',
          'content'=> $messageEmail1,
      );

      $this->mailer->send($sendmail);

      ///
      $data = array(

        'pay_time' => $this->input->post('time'),
        'tgl_bayar' => $this->input->post('tgl_bayar'),
        'denda' => $denda,
        'diskon' => $diskon,
        'teller' => $this->input->post('teller'),
        'keterangan' => $this->input->post('keterangan'),
        'jumlah_bayar' => $jumlah_bayar,
        'status' => 1,

    );

      $update  = $this->angsuran_model->update($data, array("id_angsuran" => $id));
      if($update){
        $idAkad = $this->input->post('idAkad');
        $this->session->set_userdata($data);
        $this->session->set_userdata('idnya', $idAkad);
        $this->session->set_flashdata('message', "Setoran Angsuran Berhasil ditambahkan");        
        redirect('Setoran_angsuran');
      }else{
        $this->session->set_flashdata('message', "Setoran Angsuran Gagal ditambahkan");
        redirect('Setoran_angsuran');
      }

    }else{
     
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/setoran_angsuran/bayar_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  

  }
}



//   function pdf()
//   {

//     $id = $this->uri->segment(3);
//     $angsuran = $this->angsuran_model->getOneByAngsuran(array("id_angsuran" => $id));
//     $this->data['angsuran'] = $angsuran;
//     $pengaturan = $this->pengaturan_model->getOneBy();
//     $id_bank = (!empty($pengaturan)) ? $pengaturan->id_bank : "";
//     $bank = $this->rekening_model->getOneBy(array("id" => $id_bank));
//     $this->data['pengaturan'] = $pengaturan;
//     $this->data['bank'] = $bank;

//     $this->load->library('Pdf');
//     $this->pdf->setPaper('A4', 'portrait');
//     $this->pdf->filename = "Kwitansi" . date('dmy') . ".pdf";
//     $this->pdf->load_view('admin/laporan_pembayaran/cetak_v', $this->data, true);
//   }
  
   function pdf()
  {

    $id = $this->uri->segment(3);
    $angsuran = $this->angsuran_model->getOneByAngsuran(array("id_angsuran" => $id));
    $this->data['angsuran'] = $angsuran;
    $pengaturan = $this->pengaturan_model->getOneBy();
    $id_bank = (!empty($pengaturan)) ? $pengaturan->id_bank : "";
    $bank = $this->rekening_model->getOneBy(array("id" => $id_bank));
    $this->data['pengaturan'] = $pengaturan;
    $this->data['bank'] = $bank;

    // $this->load->library('Pdf');
    // $this->pdf->setPaper('A4', 'portrait');
    // $this->pdf->filename = "Kwitansi" . date('dmy') . ".pdf";
    // $this->pdf->load_view('admin/laporan_pembayaran/cetak_v', $this->data, true);
    $this->load->library('pdfgenerator');
        
           
        // filename dari pdf ketika didownload
        $file_pdf = 'KWITANSI';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
	     $html = $this->load->view('admin/laporan_pembayaran/cetak_v',$this->data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
  }

  function cetak_kartu()
  {

    $id = $this->uri->segment(3);
    $akad = $this->akad_model->getAllById(array("id_akad" => $id));

    $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));

    $this->data['akad'] = $akad[0];
    $this->data['angsuran'] = $angsuran;
    $pengaturan = $this->pengaturan_model->getOneBy();
    $this->data['pengaturan'] = $pengaturan;

    $this->load->library('Pdf');
    $this->pdf->setPaper('A4', 'portrait');
    $this->pdf->filename = "Kwitansi" . date('dmy') . ".pdf";
    $this->pdf->load_view('admin/laporan_pembayaran/cetak_kartu_v', $this->data, true);
  }


  public function view($id)
  {
    $this->form_validation->set_rules('nomor_akad', "Pelanggan tidak boleh kosong", 'trim|required');
    $date = date('y-m-d H:i:s');
    // $kode = $this->customer_model->getKode();
    //  $id_inv = $this->transaksi_model->getKode();
    if ($this->form_validation->run() === TRUE) {

      $id_angsuran = $this->input->post('id_angsuran');
      $id_akad = $this->input->post('id_akad');
      $keterangan = $this->input->post('keterangan');
      $id_pelanggan = $this->input->post('id_pelanggan');
      $id_invoice = $this->input->post('id_invoice');
      $tgl = $this->input->post('tgl_bayar');
      $tgl_bayar = date("Y-m-d", strtotime($tgl));
      $no = $this->input->post('no');

      $jumlah_bayar1 = str_replace(".", "", $this->input->post('bayar'));
      $jumlah_bayar = str_replace("Rp", "", $jumlah_bayar1);

      $cicilan_angsuran = array();
      foreach ($no as $key => $val) {
        if ($no[$key] > 0) {
          $cicilan_angsuran[] = array(
            'id_akad'   => $id_akad,
            'id_pelanggan'   => $id_pelanggan,
            'id_invoice'     => $id_invoice,
            'jumlah_bayar'   => $jumlah_bayar[$key],
            'id_angsuran'   => $id_angsuran[$key],
            'tgl_bayar'   => $tgl[$key],
            'keterangan'   => $keterangan[$key],
          );
        }
      }

      $update =  $this->db->update_batch('angsuran', $cicilan_angsuran, 'id_angsuran');
      $this->db->error();


      if ($update) {
        $this->session->set_flashdata('message', "Setoran Angsuran Berhasil ditambahkan");
        redirect('Setoran_angsuran');
      } else {
        $this->session->set_flashdata('message', "Setoran Angsuran Gagal ditambahkan");
        redirect('Setoran_angsuran');
      }
    } else {
      $akad = $this->akad_model->getAllById(array("id_akad" => $id));
      $id_pelanggan = (!empty($akad)) ? $akad[0]->id_pelanggan : "";
      $id_invoice = (!empty($akad)) ? $akad[0]->id_invoice : "";
      $transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $id_invoice));

      $angsuran = $this->angsuran_model->getAllById(array("id_akad" => $id));
      $this->data['akad'] = $akad[0];
      $this->data['transaksi'] = $transaksi;
      $this->data['angsuran'] = $angsuran;
      $this->data['content'] = 'admin/angsuran/view_v';
      $this->load->view('admin/layouts/page', $this->data);
    }
  }

 

}
