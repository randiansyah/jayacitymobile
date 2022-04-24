<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Tunggakan_brand_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }
      
	public function insert($data){
		$this->db->insert('brand', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('brand', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where){
		$this->db->where($where);
		$this->db->delete('brand'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
    }

   
    
	public function getAllById($where = array()){
        $this->db->select("brand.*")->from("brand");  
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

	

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('brand');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

	function getAllBy($limit,$start,$search,$col,$dir,$day)
    {

        $day_start = date('Y-m-d 00:00:00', $day);
   

        $this->db->select("brand.*,a.tgl_jatuh_tempo,COUNT(a.id_angsuran) as jumlah")->from("brand"); 
        $this->db->join('transaksi as s','s.merek=brand.id');
        $this->db->join('angsuran as a','a.id_invoice=s.id_invoice');
        $this->db->where("a.status =", 0);
        $this->db->where("a.tgl_jatuh_tempo <=", $day_start);
        $this->db->group_by('id');
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

    function getCountAllBy($limit,$start,$search,$order,$dir)
    {
    	$this->db->select("brand.*")->from("brand");  
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
