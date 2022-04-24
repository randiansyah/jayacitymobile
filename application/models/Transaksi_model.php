<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Transaksi_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }
      
	public function insert($data){
		$this->db->insert('transaksi', $data);
		return $this->db->insert_id();
	} 

	public function update($data,$where){
		$this->db->update('transaksi', $data, $where);
		return $this->db->affected_rows();
	}
  
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('transaksi'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
    }

    public function getKode(){
        $this->db->select('RIGHT(transaksi.id_invoice,3) as inv', FALSE);
        $this->db->order_by('inv','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('transaksi');  //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() > 0){      
             //cek kode jika telah tersedia    
             $data = $query->row();      
             $kode = intval($data->inv) + 1; 
        }
        else{      
             $kode = 1;  //cek jika kode belum terdapat pada table
        }
            $tgl=date('dmY'); 
            $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
            $kodetampil = $batas;  //format kode
            return $kodetampil;  
       }

    //   public function getKode(){
    //     $this->db->select('id_invoice')->from("transaksi"); 
    //     $query = $this->db->get();  //cek dulu apakah ada sudah ada kode di tabel.    
     
    //     if($query->num_rows() > 0){      
         
    //            //cek kode jika telah tersedia    
    //         $data = $query->row();      
    //         $kode = intval($query->num_rows()) + 1; 
    //     }else{      
             
    //         $kode = 1;  //cek jika kode belum terdapat pada table
    //     }
    //     $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
    //     $kodetampil = $batas;  //format kode
    //     return $kodetampil;
    // }
    
	public function getAllById($where = array()){
         $this->db->select("*")->from("transaksi"); 
         $this->db->join("pelanggan as p","p.id_pelanggan=transaksi.id_pelanggan");
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('transaksi');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

	function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("transaksi.*,pelanggan.nama as pelanggan_nama")->from("transaksi"); 
        $this->db->join("pelanggan","pelanggan.id_pelanggan=transaksi.id_pelanggan");
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

    function getAllByLaporan($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("transaksi.*,pelanggan.nama as pelanggan_nama,COUNT(transaksi.id_pelanggan) as jumlah")->from("transaksi"); 
        $this->db->join("pelanggan","pelanggan.id_pelanggan=transaksi.id_pelanggan");
        $this->db->group_by("id_pelanggan");
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
  

    function getCountAllBy($limit,$start,$search,$order,$dir)
    {
    	$this->db->select("transaksi.*")->from("transaksi");  
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
