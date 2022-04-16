<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Hasil_survey_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }
      
	public function insert_data($data){
		$this->db->insert('hasil_survey', $data);
		return $this->db->insert_id();
	} 

	public function update_data($data,$where){
		$this->db->update('hasil_survey', $data, $where);
		return $this->db->affected_rows();
	}
  
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('hasil_survey'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
    }

      public function getKode(){
        $this->db->select('id_hasil_survey')->from("hasil_survey"); 
        $query = $this->db->get();  //cek dulu apakah ada sudah ada kode di tabel.    
     
        if($query->num_rows() > 0){      
         
               //cek kode jika telah tersedia    
            $data = $query->row();      
            $kode = intval($query->num_rows()) + 1; 
        }else{      
             
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
        $kodetampil = $batas;  //format kode
        return $kodetampil;
    }
    
	public function getAllById($where = array()){
        $this->db->select("*")->from("hasil_survey"); 
        $this->db->join("pelanggan","pelanggan.id_pelanggan=hasil_survey.id_pelanggan");
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('hasil_survey');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

	function getAllBy($limit,$start,$search,$col,$dir)
    {
        $this->db->select("hasil_survey.*")->from("hasil_survey"); 
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
    function getAllByJOIN($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("hasil_survey.*,hasil_survey.status as PS,pelanggan.*")->from("hasil_survey"); 
        $this->db->JOIN('pelanggan','pelanggan.id_pelanggan=hasil_survey.id_pelanggan');
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
    	$this->db->select("hasil_survey.*")->from("hasil_survey"); 
         
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
