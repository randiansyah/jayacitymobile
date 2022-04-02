<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Laporan_angsuran_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }
      
    
    public function getAllById($where = array()){
        $this->db->select("*")->from("angsuran"); 
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }

    public function getSumAmount_detail($where = array())
    {
        $this->db->select("angsuran.*,SUM(angsuran.jumlah_bayar) as total,pelanggan.nama")->from("angsuran");
        $this->db->where($where);
        $this->db->JOIN('pelanggan','pelanggan.id_pelanggan=angsuran.id_pelanggan');
       $this->db->group_by("id_angsuran");
       
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function getSumTunggakan()
    {
        $this->db->select("angsuran.*,SUM(angsuran.jumlah_cicilan) as total")->from("angsuran");
        $this->db->where('angsuran.status = 0 AND angsuran.tgl_jatuh_tempo < now() ');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

    public function getSumJumlah($where = array())
    {
        $this->db->select("angsuran.*,SUM(angsuran.jumlah_bayar) as total")->from("angsuran");
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

    public function getSumAmount($where = array())
    {
        $this->db->select("angsuran.*,SUM(angsuran.jumlah_bayar) as total")->from("angsuran");
        $this->db->where($where);
       $this->db->group_by("day(created_on)");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('angsuran');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

}
