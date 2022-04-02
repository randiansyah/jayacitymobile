<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Dana_titipan_model extends CI_Model
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

    function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("angsuran_titipan.*")->from("angsuran_titipan"); 
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $this->db->where($where); 
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
  
  

    function getCountAllBy($limit,$start,$search,$order,$dir,$where)
    {
        $this->db->select("angsuran_titipan.*")->from("angsuran_titipan");  
        
        $this->db->where($where); 
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
}
