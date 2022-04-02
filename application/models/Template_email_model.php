<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Template_email_model extends CI_Model
{
    public function update($data, $where)
    {
        $this->db->update('template_email', $data, $where);
        
        return $this->db->affected_rows();
    }

    public function getById($id)
    {
        return $this->db->get_where('template_email', ["id" => $id]);
    }

    public function getAll()
    {
        return $this->db->get("template_email");
    }
}