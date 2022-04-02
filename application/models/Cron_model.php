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
