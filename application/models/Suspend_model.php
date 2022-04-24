<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Suspend_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }
      
	public function insert_data($data){
		$this->db->insert('suspend', $data);
		return $this->db->insert_id();
	} 

	public function update_data($data,$where){
		$this->db->update('suspend', $data, $where);
		return $this->db->affected_rows();
	}

	public function update($data,$where){
        $this->db->update('suspend', $data, $where);
        return $this->db->affected_rows();
    }
   

  


	function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("suspend.*")->from("suspend"); 
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
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


    function getCountAllBy($limit,$start,$search,$order,$dir)
    {
    	$this->db->select("suspend.*")->from("suspend"); 
         
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
