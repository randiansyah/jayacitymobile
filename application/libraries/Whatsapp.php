<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp {
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();

    }

    public function send($phone = '', $message ='')
    {
        $token = "XtSQvWZemA7xebXCn2KDAnxURpfqHBYp35ViHbixaTYfPYzYvZ";

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$phone.'&message='.$message,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}