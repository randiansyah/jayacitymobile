<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Notif_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }
      
	public function insert($data){
		$this->db->insert('notification', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('notification', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where){
		$this->db->where($where);
		$this->db->delete('notification'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
    }

   
    
	public function getAllById($where = array()){
        $this->db->select("*")->from("notification");  
        $this->db->JOIN('karyawan', "karyawan.id=notification.id_karyawan");
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
    
	

     function getOneBy($where = array()){
		$this->db->select("*")->from("notification"); 
        $this->db->where($where); 
		$this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

	function getAllBy($limit,$start,$search,$col,$dir)
    {
        $this->db->select("notification.*,karyawan.nama,brand.name")->from("notification"); 
		$this->db->JOIN('karyawan', "karyawan.id=notification.id_karyawan");
		$this->db->JOIN('brand', "brand.id=notification.id_merek");
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
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

    function getCountAllBy($limit,$start,$search,$order,$dir)
    {
    	$this->db->select("notification.*")->from("notification");  
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
