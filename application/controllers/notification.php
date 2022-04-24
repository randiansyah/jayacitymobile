<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

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
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->model('transaksi_midtrans_model','midtransNotif');
		$this->load->model('angsuran_model','angsuran');
		$this->load->model('customer_model');
		$this->load->model('transaksi_model');
		$this->load->model("template_email_model", "template");
		$this->load->model('notif_model');
		$this->load->library('mailer');
		$this->load->library('whatsapp');
		$this->load->helper('url');
		
    }

	public function index()
	{
		//echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, "true");
        $order_id = $result['order_id'];
		$transaction_time = $result['transaction_time'];
		$gross_amount = $result['gross_amount'];

		$dataNotif = array(
			"status_code" => $result['status_code'],
			"transaction_status" => $result['transaction_status']
		);


		if($result['status_code'] == 200){
			$data = $this->midtransNotif->getAllById(array("order_id" => $order_id));
	   
			foreach($data as $key => $val)
			{
			$id = explode(',', $val->id_angsuran);
		
			}
			$data2 = array();
			foreach($id as $key => $val){
			$angsuran = $this->angsuran->getAllById(array("id_angsuran" => $id[$key] ));
			$data2[] = array(
			"id_angsuran" => $id[$key],
			"status" => 1,
			"tgl_bayar" => date("d-m-Y", strtotime($transaction_time)),
			"pay_time" => date("h:i:s", strtotime($transaction_time)),
			"jumlah_bayar" => (!empty($angsuran)) ? $angsuran[0]->jumlah_cicilan : "",
			"total_bayar" => (!empty($angsuran)) ? $angsuran[0]->jumlah_cicilan : "",
			"created_by" => (!empty($angsuran)) ? $angsuran[0]->id_pelanggan : "",
			);
	
			
			}
		  $insert = $this->db->update_batch('angsuran',$data2,'id_angsuran');
		$this->midtransNotif->update($dataNotif, array("order_id" => $order_id));
			if($insert){
	
				$pelanggan = $this->customer_model->getOneBy(array("id_pelanggan" => $data[0]->id_pelanggan));
				$transaksi = $this->transaksi_model->getOneBy(array("id_invoice" => $data[0]->id_invoice));
		  
				//wa
				$getTemplate_wa_header = $this->template->getById(1)->result();
				$temp_wa_header = $getTemplate_wa_header[0];
				$getTemplate_wa_footer = $this->template->getById(7)->result();
				$temp_wa_footer = $getTemplate_wa_footer[0];
				// email
				$getTemplate_email = $this->template->getById(3)->result();
				$temp_email = $getTemplate_email[0];
		  
				$name = $pelanggan->nama;
				$phone = $pelanggan->no_telp;
				$message = "Hai, " . $name . $temp_wa_header->isi;
				$messageWA = $message . "
		  NAMA               : " . $transaksi->nama_barang . "
		  NO IMEI            : " . $transaksi->imei1 . "
		  JAM BAYAR     : " . date("h:i:s", strtotime($transaction_time)) . "
		  TGL BAYAR      : " .  date("d-m-Y", strtotime($transaction_time)) . "
		  JUMLAH          : Rp." . number_format($gross_amount, 0, ',', '.') . "
		  " . $temp_wa_footer->isi;
		 //email
		 $messageEmail = "Hai, " . $name . $temp_email->isi;
		 $messageEmail1 = $messageEmail . "
	NAMA PRODUK   : " . $transaksi->nama_barang . "<br>
	NO IMEI       : " . $transaksi->imei1 . "<br>
	JAM BAYAR     : " . date("h:i:s", strtotime($transaction_time)) . "<br>
	TGL BAYAR      : " .  date("d-m-Y", strtotime($transaction_time)) . "<br>
	JUMLAH          : Rp." . number_format($gross_amount, 0, ',', '.') . "<br>
	
		 " . $temp_wa_footer->isi;
	
		 $sendmail = array(
		   'email_penerima' => $pelanggan->email,
		   'subjek' => 'Pembayaran Angsuran',
		   'content' => $messageEmail1,
		 );
	
		 $this->mailer->send($sendmail);
	
		  $WASEND = $this->whatsapp->send($phone, $messageWA);
				//get send multiple notif
				$notif = $this->notif_model->getAllById(array("notification.tipe" => 3));
				if ($WASEND) {
				  foreach ($notif as $val) {
					$phone = $val->no_hp;
					//echo print_r($val->no_hp);
					$messageWA =  "Hai " . $val->nama . "
			Pelanggan dengan nama : " . $pelanggan->nama . "
			no Telp : " . $pelanggan->no_telp . "
			Telah melakukan pembayaran :
		  
			NAMA               : " . $transaksi->nama_barang . "
			NO IMEI            : " . $transaksi->imei1 . "
			JAM BAYAR     : " . date("h:i:s", strtotime($transaction_time)) . "
			TGL BAYAR      : " .  date("d-m-Y", strtotime($transaction_time)) . "
			JUMLAH          : Rp." . number_format($gross_amount, 0, ',', '.') . "
			";
					$this->whatsapp->send($phone, $messageWA);
					$sendmail = array(
					  'email_penerima' => $val->email,
					  'subjek' => 'Pembayaran Angsuran',
					  'content' => $messageWA,
					);
		  
					$this->mailer->send($sendmail);
				  }
				}
	
	
	
			}else {
			
			}

		

		}

		
		
		    // echo "<pre>";
			// var_dump($data2);
			// echo "</pre>";
		

        // $key = array_keys($id_angsuran);

		// foreach($key as $k ){
		// 	$data = explode(",", $k);
		// 	echo "<pre>";
		// 	var_dump($data[0]);
		// 	echo "</pre>";

		// }
	


	}
}
