<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Angsuran_titipan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }
      
    public function insert($data){
        $this->db->insert('angsuran_titipan', $data);
        return $this->db->insert_id();
    } 

    public function update($data,$where){
        $this->db->update('angsuran_titipan', $data, $where);
        return $this->db->affected_rows();
    }
  
    public function delete($where){
        $this->db->where($where);
        $this->db->delete('angsuran_titipan'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    
    public function getAllById($where = array()){
        $this->db->select("*")->from("angsuran_titipan"); 

        $this->db->where($where); 
       // $this->db->where("angsuran.jumlah_bayar>1"); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }

  

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('angsuran_titipan');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

    function getAllBy($limit,$start,$search,$col,$dir)
    {
        $this->db->select("angsuran_titipan.*")->from("angsuran_titipan"); 
        $this->db->limit($limit,$start)->order_by($col,$dir);
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
        
        $result = $this->db->get();
        if($result->num_rows()>0)
        {
            return $result->result();  
        }
        else
        {
            return null;
        }
    }

    public function getSumJumlah($where = array())
    {
        $this->db->select("angsuran_titipan.*,SUM(angsuran_titipan.jumlah_bayar) as total")->from("angsuran_titipan");
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
        $this->db->select("angsuran_titipan.*,SUM(angsuran_titipan.jumlah_bayar) as total")->from("angsuran_titipan");
        $this->db->where($where);
       $this->db->group_by("day(created_on)");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function getSumAmountDetail($where = array())
    {
        $this->db->select("angsuran_titipan.*,angsuran_titipan.jumlah_bayar as total")->from("angsuran_titipan");
        $this->db->where($where);
        $this->db->group_by("id_at");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    function getSum($where = array())
    {
        $this->db->select("SUM(jumlah_bayar) as total_bayar")->from("angsuran_titipan"); 
        $this->db->where($where);  
        $result = $this->db->get();
        if($result->num_rows()>0)
        {
            return $result->result();  
        }
        else
        {
            return null;
        }
    }
  
  

    function getCountAllBy($limit,$start,$search,$order,$dir)
    {
        $this->db->select("angsuran_titipan.*")->from("angsuran_titipan");  
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
