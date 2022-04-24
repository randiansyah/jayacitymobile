<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class History_pembayaran extends Admin_Controller
{
  public function __construct()
  {

    parent::__construct();
    $params = array('server_key' => 'SB-Mid-server-8KDsxpDsuaBiwo8L5bHEWGw8', 'production' => false);
    $this->load->library('midtrans');
    $this->midtrans->config($params);
    $this->load->helper('url');
    $this->load->model('angsuran_model', 'angsuran');
    $this->load->model('transaksi_midtrans_model', 'midtrans_save');
    //$this->load->model('cabang_model');
  }
  public function index()
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['content'] = 'admin/history_pembayaran/list_v';
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function datalist()
  {
    $columns = array(
      0 => 'id',
      1 => 'gross_amount',
      2 => 'payment_type',
      3 => 'bank',
      4 => 'va_number',
      5 => 'transaction_time',
      6 => 'status_code',
      7 => 'pdf_url',
      8 => '',
    );

    $order = $columns[$this->input->post('order')[0]['column']];
    $dir = $this->input->post('order')[0]['dir'];
    $search = array();
    $limit = 0;
    $start = 0;
    $where = array();
    if ($this->ion_auth->is_admin()) {

      $where = array();
    } else {
      $id = $this->data['users']->id;
      $where['id_pelanggan'] = $id;
    }

    $totalData = $this->midtrans_save->getCountAllBy($limit, $start, $search, $order, $dir);

    $searchColumn = $this->input->post('columns');
    $isSearchColumn = false;

    if ($isSearchColumn) {
      $totalFiltered = $this->midtrans_save->getCountAllBy($limit, $start, $search, $order, $dir);
    } else {
      $totalFiltered = $totalData;
    }

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->midtrans_save->getAllBy($limit, $start, $search, $order, $dir, $where);

    $new_data = array();
    if (!empty($datas)) {
      foreach ($datas as $key => $data) {

      if($data->status_code == 201){
      $status = "<button type='button' class='btn btn-warning btn-sm'>Pending</button>";
      }else if($data->status_code == 200) {
      $status = "<span class='badge badge-success'>Success</span>";
      } else {
      $status = "";
      }

        $nestedData['id']   = $start + $key + 1;
        $nestedData['order_id']   = $data->order_id;
        $nestedData['gross_amount']   = "Rp.".number_format($data->gross_amount,0,".",".");
        $nestedData['payment_type']   = $data->payment_type;
        $nestedData['bank']   = $data->bank;
        $nestedData['va_number']   = $data->va_number;
        $nestedData['transaction_time']   = $data->transaction_time;
        $nestedData['status_code']   = $status;
        $nestedData['pdf_url']   = "<a href=" . $data->pdf_url . " target='blank' class='btn btn-danger btn-md'><i class='fa fa-file-pdf-o'></i></a>";


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

  public function step1($id)
  {
    $this->load->helper('url');
    if ($this->data['is_can_read']) {
      $this->data['angsuran'] = $this->angsuran->getAllBySnap(array('angsuran.id_akad' => $id));
      $this->data['content'] = 'admin/pay/checkout_snap';
    } else {
      $this->data['content'] = 'errors/html/restrict';
    }

    $this->load->view('admin/layouts/page', $this->data);
  }

  public function token()
  {
    $jumlah = $this->input->post('jumlah');
    // Required
    $transaction_details = array(
      'order_id' => rand(),
      'gross_amount' => $jumlah, // no decimal allowed for creditcard
    );

    // // Optional
    // $item1_details = array(
    //   'id' => 'a1',
    //   'price' => 18000,
    //   'quantity' => 3,
    //   'name' => "Apple"
    // );

    // // Optional
    // $item2_details = array(
    //   'id' => 'a2',
    //   'price' => 20000,
    //   'quantity' => 2,
    //   'name' => "Orange"
    // );

    // Optional
    $item_details = array();

    // // Optional
    // $billing_address = array(
    //   'first_name'    => "Andri",
    //   'last_name'     => "Litani",
    //   'address'       => "Mangga 20",
    //   'city'          => "Jakarta",
    //   'postal_code'   => "16602",
    //   'phone'         => "081122334455",
    //   'country_code'  => 'IDN'
    // );

    // // Optional
    // $shipping_address = array(
    //   'first_name'    => "Obet",
    //   'last_name'     => "Supriadi",
    //   'address'       => "Manggis 90",
    //   'city'          => "Jakarta",
    //   'postal_code'   => "16601",
    //   'phone'         => "08113366345",
    //   'country_code'  => 'IDN'
    // );

    // Optional
    $customer_details = array(
      'first_name'    => $this->data['users']->first_name,
      'email'         => $this->data['users']->email,
      'phone'         => $this->data['users']->phone
    );

    // Data yang akan dikirim untuk request redirect_url.
    $credit_card['secure'] = true;
    //ser save_card true to enable oneclick or 2click
    //$credit_card['save_card'] = true;

    $time = time();
    $custom_expiry = array(
      'start_time' => date("Y-m-d H:i:s O", $time),
      'unit' => 'minute',
      'duration'  => 2
    );

    $transaction_data = array(
      'transaction_details' => $transaction_details,
      'item_details'       => $item_details,
      'customer_details'   => $customer_details,
      'credit_card'        => $credit_card,
      'expiry'             => $custom_expiry
    );

    error_log(json_encode($transaction_data));
    $snapToken = $this->midtrans->getSnapToken($transaction_data);
    error_log($snapToken);
    echo $snapToken;
  }

  public function finish()
  {
    $id_angsuran = $this->input->post("id_angsuran");
    $id_pelanggan = $this->input->post("id_pelanggan");
    $id_invoice = $this->input->post("id_invoice");
    $result = json_decode($this->input->post('result_data'), true);
    $data = [
      "id_pengguna" => $this->data['users']->id,
      "id_angsuran" => $id_angsuran,
      "id_pelanggan" => $id_pelanggan,
      "id_invoice" => $id_invoice,
      "order_id" => $result['order_id'],
      "transaction_id" => $result['transaction_id'],
      "gross_amount" => $result['gross_amount'],
      "payment_type" => $result['payment_type'],
      "transaction_time" => $result['transaction_time'],
      "transaction_status" => $result['transaction_status'],
      "bank" => $result['va_numbers'][0]['bank'],
      "va_number" => $result['va_numbers'][0]['va_number'],
      "pdf_url" => $result['pdf_url'],
      "status_code" => $result['status_code'],
    ];

    // echo "<pre>";
    // var_dump($data);
    // echo "</pre>";

    $create = $this->midtrans_save->insert($data);


    if ($create) {
    	$this->session->set_flashdata('message', "Pembayaran Berhasil ditambahkan");
    	redirect('History_pembayaran');
    } else {
    	$this->session->set_flashdata('message', "Pembayaran Gagal ditambahkan");
    	redirect('History_pembayaran');
    }

  }
}
