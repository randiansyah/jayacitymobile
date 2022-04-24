<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Snap extends Admin_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-8KDsxpDsuaBiwo8L5bHEWGw8', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
		$this->load->model('angsuran_model','angsuran');
		$this->load->model('transaksi_midtrans_model','midtrans_save');
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
		$item_details = array ();

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
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'email'         => "andri@litani.com",
		  'phone'         => "081122334455"
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
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
    	$result = json_decode($this->input->post('result_data'), true);
        $data = [
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

	$create = $this->midtrans_save->insert($data);
    
	
	if ($create) {
		$this->session->set_flashdata('message', "Pembayaran Berhasil ditambahkan");
		redirect('History_pembayaran');
	} else {
		$this->session->set_flashdata('message', "Pembayaran Gagal ditambahkan");
		redirect('History_pembayaran');
	}


    	// echo 'RESULT <br><pre>';
    	// var_dump($data);
    	// echo '</pre>' ;

    }
}
