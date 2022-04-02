<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Customer_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct(); 
    }
      
	public function insert_data_pribadi($data){
		$this->db->insert('pelanggan', $data);
		return $this->db->insert_id();
	}

    public function insert_data_pemohon($data){
        $this->db->insert('pelanggan_pemohon', $data);
        return $this->db->insert_id();
    }

     public function insert_data_pasangan($data){
        $this->db->insert('pelanggan_pasangan', $data);
        return $this->db->insert_id();
    }

      public function insert_data_kekayaan($data){
        $this->db->insert('pelanggan_kekayaan', $data);
        return $this->db->insert_id();
    }

     public function insert_data_keluarga($data){
        $this->db->insert('pelanggan_keluarga', $data);
        return $this->db->insert_id();
    }


	public function update_data_pribadi($data,$where){
		$this->db->update('pelanggan', $data, $where);
		return $this->db->affected_rows();
	}
    public function update_data_pemohon($data,$where){
        $this->db->update('pelanggan_pemohon', $data, $where);
        return $this->db->affected_rows();
    }
    public function update_data_pasangan($data,$where){
        $this->db->update('pelanggan_pasangan', $data, $where);
        return $this->db->affected_rows();
    }
    public function update_data_kekayaan($data,$where){
        $this->db->update('pelanggan_kekayaan', $data, $where);
        return $this->db->affected_rows();
    }
    public function update_data_keluarga($data,$where){
        $this->db->update('pelanggan_keluarga', $data, $where);
        return $this->db->affected_rows();
    }
   
	public function delete_pribadi($where){
		$this->db->where($where);
		$this->db->delete('pelanggan'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
    }

    public function delete_pemohon($where){
        $this->db->where($where);
        $this->db->delete('pelanggan_pemohon'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

     public function delete_pasangan($where){
        $this->db->where($where);
        $this->db->delete('pelanggan_pasangan'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

     public function delete_kekayaan($where){
        $this->db->where($where);
        $this->db->delete('pelanggan_kekayaan'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    public function delete_keluarga($where){
        $this->db->where($where);
        $this->db->delete('pelanggan_keluarga'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }


      public function getKode(){
        $this->db->select('id_pelanggan')->from("pelanggan"); 
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
         $this->db->select("pelanggan.*,pelanggan_pasangan.nama as nama_pasangan,pelanggan_pasangan.ktp as ktp_pasangan,pelanggan_pasangan.tgl_lahir as tgl_lahir_pasangan,pelanggan_pasangan.tempat_lahir as tempat_lahir_pasangan,pelanggan_pasangan.no_telp as no_telp_pasangan,pelanggan_pasangan.alamat as alamat_pasangan,pelanggan_pasangan.agama as agama_pasangan,pelanggan_pasangan.pekerjaan as pekerjaan_pasangan,pelanggan_pasangan.nama_usaha as nama_usaha_pasangan,pelanggan_pasangan.alamat_pekerjaan as alamat_pekerjaan_pasangan,pelanggan_kekayaan.*,pelanggan_keluarga.nama as nama_keluarga,pelanggan_keluarga.ktp as ktp_keluarga,pelanggan_keluarga.alamat as alamat_keluarga,pelanggan_keluarga.no_hp as no_hp_keluarga,pelanggan_keluarga.pekerjaan as pekerjaan_keluarga,pelanggan_keluarga.hubungan as hubungan_keluarga

            ")->from("pelanggan"); 
        //$this->db->join("pelanggan_pemohon","pelanggan.id_pelanggan = pelanggan_pemohon.id_pelanggan");
        $this->db->join("pelanggan_pasangan","pelanggan.id_pelanggan = pelanggan_pasangan.id_pelanggan");
        $this->db->join("pelanggan_kekayaan","pelanggan.id_pelanggan = pelanggan_kekayaan.id_pelanggan");
         $this->db->join("pelanggan_keluarga","pelanggan.id_pelanggan = pelanggan_keluarga.id_pelanggan"); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}

    public function getAllByIdPemohon($where = array()){
        $this->db->select("pelanggan_pemohon.*")->from("pelanggan_pemohon"); 
      $this->db->where($where); 
       $query = $this->db->get();
       if ($query->num_rows() >0){  
           return $query->result(); 
       } 
       return FALSE;
   }

     function getOneBy($where = array()){
        $this->db->select("*");
        $this->db->from('pelanggan');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    } 

     function getOneByID($where = array()){
        $this->db->select("*");
        $this->db->from('pelanggan');
        $this->db->where($where); 
        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->result(); 
        } 
        return FALSE;
    } 

	function getAllBy($limit,$start,$search,$col,$dir,$where)
    {
        $this->db->select("pelanggan.*")->from("pelanggan"); 
        $this->db->where($where);
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

    function getAllBySelect()
    {
        $this->db->select("pelanggan.*")->from("pelanggan");  
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
    	$this->db->select("pelanggan.*")->from("pelanggan");  
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
	} 
}
