<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->model("cron_model", "cron");
        $this->load->model("Template_email_model", "template");
         $this->load->model("Template_email_model", "template");
        // $this->load->library("input");
        $this->load->library('mailer');
        $this->load->library('whatsapp');

    }

    public function index()
    {
        // if (!$this->input->is_cli_request()) {
        //     echo "This script can only be accessed via the command line" . PHP_EOL;
        //     return;
        // }
        $time = strtotime("now");
        $tunggakan = $this->cron->getTunggakan($time);
        $tunggakan_notif = $this->cron->getTunggakan_notif($time);

        $get_template_wa = $this->template->getById(2)->result();
        $get_template_email = $this->template->getById(4)->result();

        $temp_wa = $get_template_wa[0];
        $temp_email = $get_template_email[0];

        if (!empty($tunggakan)) {
            foreach($tunggakan as $key => $val) {
                $phone = $val->no_telp;
                $message = "Hi, $val->nama" . ", ". $temp_wa->isi;
                $messageWA = $message . "
        TGL                     : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
        NAMA                 : " . $val->nama_barang . "
        NO IMEI               : " . $val->imei1 . "
        CICILAN              : " . $val->cicilan . "
        JUMLAH             : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "

         
                ";
                
                $this->whatsapp->send($phone, $messageWA);

                $send_mail = array(
                    'email_penerima'=> $val->email,
                    'subjek'=> $val->keterangan,
                    'content'=> "Hi, $val->nama" . ", " . $temp_email->isi. " 
                   <br>TGL                   : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
                   <br> NAMA                 : " . $val->nama_barang . "
                   <br> NO IMEI              : " . $val->imei1 . "
                   <br> CICILAN              : " . $val->cicilan . "
                   <br> JUMLAH               : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "",
                );

                $this->mailer->send($send_mail);
            }
        }

        if (!empty($tunggakan_notif)) {
            foreach($tunggakan_notif as $key => $val) {
                $phone = $val->no_hp;
                $message = "Hi, $val->nama";
                $messageWA = $message . "
pelanggan kamu angsurannya jatuh tempo hari ini
berikut rinciannya   :
NAMA               : " . $val->namaPelanggan . "
NO TELP           : " . $val->telpPelanggan . "
EMAIL               : " . $val->emailPelanggan . "
TGL                    : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
NAMA                : " . $val->nama_barang . "
NO IMEI             : " . $val->imei1 . "
CICILAN             : " . $val->cicilan . "
JUMLAH            : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "

         
                ";
                
                $this->whatsapp->send($phone, $messageWA);

                $send_mail = array(
                    'email_penerima'=> $val->email,
                    'subjek'=> $val->keterangan,
                    'content'=> "Hi, $val->nama" . " 
                    pelanggan kamu angsurannya jatuh tempo hari ini
                    berikut rinciannya   :
                    <br>NAMA              : " . $val->namaPelanggan . "
                    <br>NO TELP           : " . $val->telpPelanggan . "
                    <br>EMAIL             : " . $val->emailPelanggan . "
                    <br>TGL               : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
                    <br>NAMA              : " . $val->nama_barang . "
                    <br>NO IMEI           : " . $val->imei1 . "
                    <br>CICILAN           : " . $val->cicilan . "
                    <br>JUMLAH            : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "
                   
                   ",
                );

                $this->mailer->send($send_mail);
            }
        }



    }
    public function tunggakan_remainder()
    {
        // if (!$this->input->is_cli_request()) {
        //     echo "This script can only be accessed via the command line" . PHP_EOL;
        //     return;
        // }
        $time = strtotime("+3 days");
        $tunggakan = $this->cron->getTunggakan($time);
        $tunggakan_notif = $this->cron->getTunggakan_notif($time);

        $get_template_wa = $this->template->getById(5)->result();
        $get_template_email = $this->template->getById(6)->result();

        $temp_wa = $get_template_wa[0];
        $temp_email = $get_template_email[0];

        if (!empty($tunggakan)) {
            foreach($tunggakan as $key => $val) {
                $phone = $val->no_telp;
                $message = "Hi, $val->nama" . ", ". $temp_wa->isi;
                $messageWA = $message . "
        TGL                     : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
        NAMA                 : " . $val->nama_barang . "
        NO IMEI               : " . $val->imei1 . "
        CICILAN              : " . $val->cicilan . "
        JUMLAH             : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "

         
                ";
                
                $this->whatsapp->send($phone, $messageWA);

                $send_mail = array(
                    'email_penerima'=> $val->email,
                    'subjek'=> $val->keterangan,
                    'content'=> "Hi, $val->nama" . ", " . $temp_email->isi. " 
                   <br>TGL                   : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
                   <br> NAMA                 : " . $val->nama_barang . "
                   <br> NO IMEI              : " . $val->imei1 . "
                   <br> CICILAN              : " . $val->cicilan . "
                   <br> JUMLAH               : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "",
                );

                $this->mailer->send($send_mail);
            }
        }

        if (!empty($tunggakan_notif)) {
            foreach($tunggakan_notif as $key => $val) {
                $phone = $val->no_hp;
                $message = "Hi, $val->nama";
                $messageWA = $message . "
pelanggan kamu angsurannya jatuh tempo hari ini
berikut rinciannya   :
NAMA               : " . $val->namaPelanggan . "
NO TELP           : " . $val->telpPelanggan . "
EMAIL               : " . $val->emailPelanggan . "
TGL                    : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
NAMA                : " . $val->nama_barang . "
NO IMEI             : " . $val->imei1 . "
CICILAN             : " . $val->cicilan . "
JUMLAH            : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "

         
                ";
                
                $this->whatsapp->send($phone, $messageWA);

                $send_mail = array(
                    'email_penerima'=> $val->email,
                    'subjek'=> $val->keterangan,
                    'content'=> "Hi, $val->nama" . " 
                    pelanggan kamu angsurannya jatuh tempo hari ini
                    berikut rinciannya   :
                    <br>NAMA              : " . $val->namaPelanggan . "
                    <br>NO TELP           : " . $val->telpPelanggan . "
                    <br>EMAIL             : " . $val->emailPelanggan . "
                    <br>TGL               : " . date("d M Y", strtotime($val->tgl_jatuh_tempo)) . "
                    <br>NAMA              : " . $val->nama_barang . "
                    <br>NO IMEI           : " . $val->imei1 . "
                    <br>CICILAN           : " . $val->cicilan . "
                    <br>JUMLAH            : Rp." . number_format($val->jumlah_cicilan,0, ",", ".") . "
                   
                   ",
                );

                $this->mailer->send($send_mail);
            }
        }



    }

    // public function tunggakan_remainder()
    // {
    //     $time = strtotime('+3 days');
    //     $tunggakan = $this->cron->remainder_tunggakan($time);
    //     $get_template_wa = $this->template->getById(5)->result();
    //     $get_template_email = $this->template->getById(6)->result();

    //     $temp_wa = $get_template_wa[0];
    //     $temp_email = $get_template_email[0];

    //     if (!empty($tunggakan)) {
    //         foreach($tunggakan as $key => $val) {
    //             $phone = $val->no_telp;
    //             $message = "Hi, $val->nama" . ", ". $temp_wa->isi;
                
    //             $this->whatsapp->send($phone, $message);

    //             $send_mail = array(
    //                 'email_penerima'=> $val->email,
    //                 'subjek'=> $val->keterangan,
    //                 'content'=> "Hi, $val->nama" . ", " . $temp_email->isi,
    //             );

    //             $this->mailer->send($send_mail);
    //         }
    //     }
    // }
}
