<?php
defined('BASEPATH') or exit('No direct script access allowed');
    
class Finace_model extends CI_Model 
{   
    public function insert_finace($data)
    {
        $this->db->insert('keuangan', $data);

        return $this->db->insert_id();
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete('keuangan');

        if ($this->db->affected_rows()) {
            return TRUE;
        }

        return FALSE;
    }

    public function update_finace($data, $where)
    {
        $this->db->update('keuangan', $data, $where);
        
        return $this->db->affected_rows();
    }

    public function getById($id)
    {
        return $this->db->get_where('keuangan', ["id" => $id])->result();
    }

    function getAll($limit,$start,$search,$col,$dir, $where)
    {
        $this->db->select("keuangan.*")->from("keuangan"); 
        $this->db->limit($limit,$start)->order_by($col,$dir);
        $this->db->where($where);
        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
    
        $result = $this->db->get();
        
        if($result->num_rows()>0) {
            return $result->result();  
        } else {
            return null;
        }
    }

    function getCountAllBy($search ,$where)
    {
        $this->db->select("keuangan.*")->from("keuangan");
        $this->db->where($where);  

        if(!empty($search)){
            foreach($search as $key => $value){
                $this->db->or_like($key,$value);    
            }   
        } 
        
        $result = $this->db->get();
    
        return $result->num_rows();
    }
    
    public function countCredit()
    {
        $this->db->select('(SELECT SUM(keuangan.amount) FROM keuangan WHERE keuangan.type=2) AS pengeluaran', FALSE);

        $result = $this->db->get();

        return $result->row('pengeluaran');
    }

    public function countDebit()
    {
        $this->db->select('(SELECT SUM(keuangan.amount) FROM keuangan WHERE keuangan.type=1) AS pemasukan', FALSE);

        $result = $this->db->get();

        return $result->row('pemasukan');
    }

    public function countCreditBank()
    {
        $this->db->select('(SELECT SUM(keuangan.amount) FROM keuangan WHERE keuangan.type=4) AS str_bank', FALSE);

        $result = $this->db->get();

        return $result->row('str_bank');
    }

    public function countDebitBank()
    {
        $this->db->select('(SELECT SUM(keuangan.amount) FROM keuangan WHERE keuangan.type=3) AS trk_bank', FALSE);

        $result = $this->db->get();

        return $result->row('trk_bank');
    }

    public function export_pengeluaran()
    {
        $this->db->select("*")->from("keuangan");
        $this->db->where('type', 2);

        $result = $this->db->get();

        return $result;
    }
}
