<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_model extends CI_Model
{
    public function getTunggakan($day)
    {
        $day_start = date('Y-m-d 00:00:00', $day);
        $day_end = date('Y-m-d 23:59:59', $day);

        $this->db->select("
            angsuran.*,
            p.nama,
            p.email,
            p.no_telp,
            t.nama_barang,
            t.imei1
        ")->from("angsuran");
        $this->db->JOIN('pelanggan as p', 'p.id_pelanggan = angsuran.id_pelanggan');
        $this->db->JOIN('transaksi as t', 't.id_invoice = angsuran.id_invoice');
        $this->db->where("angsuran.status =", 0);
        $this->db->where("angsuran.tgl_jatuh_tempo >=", $day_start);
        $this->db->where("angsuran.tgl_jatuh_tempo <=", $day_end);
        
        // $this->db->where('angsuran.status = 0 AND angsuran.tgl_jatuh_tempo < now()');
        
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function getTunggakan_notif($day)
    {
        $day_start = date('Y-m-d 00:00:00', $day);
        $day_end = date('Y-m-d 23:59:59', $day);

        $this->db->select("
            angsuran.*,
            k.nama,
            k.email,
            k.no_hp,
            p.nama as namaPelanggan,
            p.email as emailPelanggan,
            p.no_telp as telpPelanggan,
            t.nama_barang,
            t.imei1
        ")->from("angsuran");
        $this->db->JOIN('pelanggan as p', 'p.id_pelanggan = angsuran.id_pelanggan');
        $this->db->JOIN('transaksi as t', 't.id_invoice = angsuran.id_invoice');
        $this->db->JOIN('notification as n', 'n.id_merek = t.merek');
        $this->db->JOIN('karyawan as k', 'k.id = n.id_karyawan');
        $this->db->where("angsuran.status =", 0);
        $this->db->where("angsuran.tgl_jatuh_tempo >=", $day_start);
        $this->db->where("angsuran.tgl_jatuh_tempo <=", $day_end);
        $this->db->where("n.tipe = 1");
        // $this->db->where('angsuran.status = 0 AND angsuran.tgl_jatuh_tempo < now()');
        
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function remainder_tunggakan($day)
    {
        $day_start = date('Y-m-d 00:00:00', $day);
        $day_end = date('Y-m-d 23:59:59', $day);

        $this->db->select("
            angsuran.*,
            p.nama,
            p.email,
            p.no_telp
        ")->from("angsuran");
        $this->db->JOIN('pelanggan as p', 'p.id_pelanggan = angsuran.id_pelanggan');
        $this->db->where("angsuran.status =", 0);
        $this->db->where("angsuran.tgl_jatuh_tempo >=", $day_start);
        $this->db->where("angsuran.tgl_jatuh_tempo <=", $day_end);
        
        // $this->db->where('angsuran.status = 0 AND angsuran.tgl_jatuh_tempo < now()');
        
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }
}
