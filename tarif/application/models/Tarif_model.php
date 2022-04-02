<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif_model extends CI_Model
{
    function getOneBy($where = array()){
		$this->db->select("*")->from("tarif"); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->row(); 
    	} 
    	return FALSE;
	}

    public function getAsal()
    {
        $this->db->select("asal")->from("tarif");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function getTujuan()
    {
        $this->db->select("tujuan")->from("tarif");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }
	
	  public function getAsalDarat()
    {
        $this->db->select("asal")->from("tarif")->where('kargo','darat');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function getTujuanDarat()
    {
        $this->db->select("tujuan")->from("tarif")->where('kargo','darat');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }
	
		  public function getAsalLaut()
    {
        $this->db->select("asal")->from("tarif")->where('kargo','laut');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function getTujuanLaut()
    {
        $this->db->select("tujuan")->from("tarif")->where('kargo','laut');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }
	
		  public function getAsalUdara()
    {
        $this->db->select("asal")->from("tarif")->where('kargo','udara');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function getTujuanUdara()
    {
        $this->db->select("tujuan")->from("tarif")->where('kargo','udara');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

	public function update($data){
		$this->db->update('tarif', $data);
		return $this->db->affected_rows();
	}

    public function getAllById($where = array())
    {
        $this->db->select("tarif.*")->from("tarif");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    function getAllBy($limit, $start, $search, $col, $dir, $where = array())
    {
        $this->db->select("tarif.*")->from("tarif");
        $this->db->limit($limit, $start)->order_by($col, $dir);
        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }
        $this->db->where($where);

        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    function getCountAllBy($limit, $start, $search, $order, $dir, $where = array())
    {
        $this->db->select("tarif.*")->from("tarif");
        if (!empty($search)) {
            foreach ($search as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }
        $this->db->where($where);

        $result = $this->db->get();

        return $result->num_rows();
    }

    public function insert($data)
    {
        $this->db->insert('tarif', $data);
        return $this->db->insert_id();
    }

    public function allData()
    {
        return $this->db->get("tarif");
    }
    
    function hapus_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}