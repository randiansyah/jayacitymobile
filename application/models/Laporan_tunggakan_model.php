<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan_tunggakan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert('angsuran', $data);
        return $this->db->insert_id();
    }

    public function update($data, $where)
    {
        $this->db->update('angsuran', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete('angsuran');
        if ($this->db->affected_rows()) {
            return TRUE;
        }
        return FALSE;
    }



    public function getAllById($where = array())
    {
        $this->db->select("*")->from("angsuran");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }


    function getOneByAngsuran($where = array())
    {
        $this->db->select("*,pelanggan.nama");
        $this->db->from('angsuran');
        $this->db->JOIN('pelanggan', 'pelanggan.id_pelanggan=angsuran.id_pelanggan');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    function getOneBy($where = array())
    {
        $this->db->select("*");
        $this->db->from('akad');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
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



    function getAllBy($limit, $start, $search, $col, $dir, $where, $setting_hari)
    {


        $this->db->select("angsuran.*,DATEDIFF(DATE_ADD(angsuran.tgl_jatuh_tempo, INTERVAL 0 DAY), CURDATE()) as selisih 
        ")->from("angsuran");
        $this->db->JOIN('pelanggan', 'pelanggan.id_pelanggan=angsuran.id_pelanggan');

        $this->db->limit($limit, $start)->order_by($col, $dir);
        $this->db->like($search);
        $this->db->where($where);
        $this->db->where('angsuran.status = 0 AND angsuran.tgl_jatuh_tempo < now() ' . $setting_hari. '');
  

        // $this->db->where('angsuran.tgl_jatuh_tempo < now()');
        // $this->db->or_like('angsuran.tgl_jatuh_tempo > now() - interval 0 day');
        //  $this->db->like('status',$status_default);
        //   $this->db->order_by('angsuran.tgl_jatuh_tempo < now()', 'DESC');
 
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
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



    function getCountAllBy($limit, $start, $search, $order, $dir, $where, $setting_hari)
    {
        $this->db->select("angsuran.*")->from("angsuran");
        //    $this->db->where('status','0');
        $this->db->where('angsuran.status = 0 AND angsuran.tgl_jatuh_tempo < now() ' . $setting_hari . '');
        //    $this->db->or_like('angsuran.tgl_jatuh_tempo > now() - interval 0 day');
        //    $this->db->where('angsuran.tgl_jatuh_tempo < now()');
        //  $this->db->order_by('angsuran.tgl_jatuh_tempo < now()', 'DESC');

        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }

        $result = $this->db->get();

        return $result->num_rows();
    }
}
