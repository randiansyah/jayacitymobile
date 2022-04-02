<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan_lunas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    function getAllBy($limit, $start, $search, $col, $dir, $where)
    {
        // $this->db->select("pelanggan.*")->from("pelanggan");
        // $this->db->JOIN('angsuran','angsuran.id_pelanggan=pelanggan.id_pelanggan');
        $this->db->select("angsuran.*,angsuran.id_akad as akad,pelanggan.nama as nama,sum(jumlah_cicilan) as jumlah_angsuran,sum(jumlah_bayar) as jumlah_pembayaran
        ")->from("angsuran");
        $this->db->JOIN('pelanggan', 'pelanggan.id_pelanggan=angsuran.id_pelanggan');
        $this->db->GROUP_BY('pelanggan.id_pelanggan');
        $this->db->where($where);
        $this->db->limit($limit, $start)->order_by($col, $dir);
        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }


    function getCountAllBy($limit, $start, $search, $order, $dir)
    {
        $this->db->select("angsuran.*,
        ")->from("angsuran");
        $this->db->JOIN('pelanggan', 'pelanggan.id_pelanggan=angsuran.id_pelanggan');
        $this->db->GROUP_BY('pelanggan.id_pelanggan');
        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }

        $result = $this->db->get();

        return $result->num_rows();
    }
}
