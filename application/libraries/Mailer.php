<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    protected $_ci;
    protected $email_pengirim = 'manggadingincorp@gmail.com';
    protected $nama_pengirim = 'RANDIGITAL';
    protected $password = 'Sample123123@';

    public function __construct(){
        $this->_ci = &get_instance();

        require_once(APPPATH.'third_party/PHPMailer/Exception.php');
        require_once(APPPATH.'third_party/PHPMailer/PHPMailer.php');
        require_once(APPPATH.'third_party/PHPMailer/SMTP.php');
    }

    public function send($data){
        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $this->email_pengirim;
        $mail->Password = $this->password;
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        // $mail->SMTPDebug = 2;

        $mail->setFrom($this->email_pengirim, $this->nama_pengirim);
        $mail->addAddress($data['email_penerima'], '');
        $mail->isHTML(true);

        $mail->Subject = $data['subjek'];
        $mail->Body = $data['content'];
        $mail->AddEmbeddedImage('image/logo.png', 'logo_mynotescode', 'logo.png');
        $send = $mail->send();

        if($send){ // Jika Email berhasil dikirim
            $response = array('status'=>'Sukses', 'message'=>'Email berhasil dikirim');
        }else{ // Jika Email Gagal dikirim
            $response = array('status'=>'Gagal', 'message'=>'Email gagal dikirim');
        }

        return $response;
    }

    public function send_with_attachment($data){
        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $this->email_pengirim; // Email Pengirim
        $mail->Password = $this->password; // Isikan dengan Password email pengirim
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        // $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

        $mail->setFrom($this->email_pengirim, $this->nama_pengirim);
        $mail->addAddress($data['email_penerima'], '');
        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

        $mail->Subject = $data['subjek'];
        $mail->Body = $data['content'];
        $mail->AddEmbeddedImage('image/logo.png', 'logo_mynotescode', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email

        if($data['attachment']['size'] <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
            $mail->addAttachment($data['attachment']['tmp_name'], $data['attachment']['name']);

            $send = $mail->send();

            if($send){ // Jika Email berhasil dikirim
                $response = array('status'=>'Sukses', 'message'=>'Email berhasil dikirim');
            }else{ // Jika Email Gagal dikirim
                $response = array('status'=>'Gagal', 'message'=>'Email gagal dikirim');
            }
        }else{ // Jika Ukuran file lebih dari 25 MB
            $response = array('status'=>'Gagal', 'message'=>'Ukuran file attachment maksimal 25 MB');
        }

        return $response;
    }
}