<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stok_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

 

    function getAllBy()
    {

        $this->db->select("brand.*,COUNT(s.id_transaksi) as jumlah")->from("brand");
        $this->db->join('transaksi as s', 's.merek=brand.id');
        $this->db->group_by('id');
      
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    function getAllByBrand($where)
    {

        $this->db->select("transaksi.*,a.id,p.nama as namanya")->from("transaksi");
        $this->db->join('brand as a', 'a.id=transaksi.merek');
        $this->db->join('pelanggan as p', 'p.id_pelanggan=transaksi.id_pelanggan');
        $this->db->where($where);
        $this->db->order_by('transaksi.id_transaksi','DESC');
       
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
