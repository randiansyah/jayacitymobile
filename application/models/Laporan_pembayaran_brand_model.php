<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan_pembayaran_brand_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getSum($where = array())
    {
        $this->db->select("SUM(jumlah_bayar) as total_bayar")->from("angsuran");
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }



    function getCountAllByBrand($limit, $start, $search, $order, $dir, $where, $setting_hari)
    {
        $this->db->select("angsuran.*")->from("angsuran");
        $this->db->JOIN('pelanggan as p', 'p.id_pelanggan=angsuran.id_pelanggan');
        $this->db->JOIN('transaksi as s', 's.id_invoice=angsuran.id_invoice');
        $this->db->like($search);
        $this->db->where($where);
        $this->db->where('angsuran.status=1');


        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }

        $result = $this->db->get();

        return $result->num_rows();
    }

    function getOneJatuh_tempo()
    {
        $this->db->select("*");
        $this->db->from('pengaturan_jatuh_tempo');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    function getAllByBrand($limit, $start, $search, $col, $dir, $where, $setting_hari)
    {


        $this->db->select("angsuran.*,s.nama_barang,s.merek
        ")->from("angsuran");
        $this->db->JOIN('pelanggan as p', 'p.id_pelanggan=angsuran.id_pelanggan');
        $this->db->JOIN('transaksi as s', 's.id_invoice=angsuran.id_invoice');
        
        $this->db->like($search);
        $this->db->where($where);
        $this->db->where('angsuran.status=1');
        $this->db->limit($limit, $start)->order_by($col, $dir);


        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    function getAllBy($limit, $start, $search, $col, $dir, $day)
    {

        $this->db->select("brand.*,COUNT(a.id_angsuran) as jumlah")->from("brand");
        $this->db->join('transaksi as s', 's.merek=brand.id');
        $this->db->join('angsuran as a', 'a.id_invoice=s.id_invoice');
        $this->db->where("a.status =", 1);
        $this->db->group_by('id');
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
        $this->db->select("brand.*")->from("brand");
        $this->db->join('transaksi as s', 's.merek=brand.id');
        $this->db->join('angsuran as a', 'a.id_invoice=s.id_invoice');
        $this->db->where("a.status =", 1);
        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }

        $result = $this->db->get();

        return $result->num_rows();
    }
}
