<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Akad_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }
      
    public function insert($data){
        $this->db->insert('akad', $data);
        return $this->db->insert_id();
    } 

    public function update($data,$where){
        $this->db->update('akad', $data, $where);
        return $this->db->affected_rows();
    }
  
    public function delete($where){
        $this->db->where($where);
        $this->db->delete('akad'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    
    
    public function getAllById($where = array()){
         $this->db->select("*")->from("akad"); 
         $this->db->join("pelanggan","pelanggan.id_pelanggan=akad.id_pelanggan");
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    }

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('akad');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

    function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("akad.*")->from("akad"); 
              $this->db->JOIN('pelanggan', 'pelanggan.id_pelanggan=akad.id_pelanggan');
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
  

    function getCountAllBy($limit,$start,$search,$order,$dir,$where)
    {
        $this->db->select("akad.*")->from("akad");
        $this->db->where($where);  
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
    }
    
    public function getSumBuyTotal($where)
    {
        $this->db->select("akad.*,COUNT(akad.id_pelanggan) as total,SUM(akad.total) as totalTagihan")->from("akad");
        $this->db->where($where);
        $result = $this->db->get();
         
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

}
