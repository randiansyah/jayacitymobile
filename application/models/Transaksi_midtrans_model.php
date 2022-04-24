<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Transaksi_midtrans_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }

    public function insert($data)
    {
        $this->db->insert('transaksi_midtrans', $data);
        return $this->db->insert_id();
    }

    public function update($data, $where)
	{
		$this->db->update('transaksi_midtrans', $data, $where);
		return $this->db->affected_rows();
	}

    public function getAllById($where = array()){
        $this->db->select("transaksi_midtrans.*")->from("transaksi_midtrans"); 
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
      

	function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("transaksi_midtrans.*")->from("transaksi_midtrans"); 
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
    	$this->db->select("transaksi_midtrans.*")->from("transaksi_midtrans");  
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
