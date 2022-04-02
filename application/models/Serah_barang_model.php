<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Serah_barang_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
	{
		$this->db->insert('serah_barang', $data);
		return $this->db->insert_id();
	}

	public function update($data, $where)
	{
		$this->db->update('serah_barang', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($where)
	{
		$this->db->where($where);
		$this->db->delete('serah_barang');
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		return FALSE;
	}



	public function getAllById($where = array())
	{
		$this->db->select("serah_barang.*")->from("serah_barang");
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return FALSE;
	}



	function getOneBy($where = array())
	{
		$this->db->select("*");
		$this->db->from('serah_barang');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return FALSE;
	}

	function getAllBy($limit, $start, $search, $col, $dir)
	{
		$this->db->select("serah_barang.*,pelanggan.nama")->from("serah_barang");
		$this->db->JOIN("pelanggan", "pelanggan.id_pelanggan=serah_barang.id_pelanggan");
		$this->db->limit($limit, $start)->order_by($col, $dir);
		if (!empty($search)) {
			foreach ($search as $key => $value) {
				$this->db->or_like($key, $value);
			}
		}

		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	function getCountAllBy($limit, $start, $search, $order, $dir)
	{
		$this->db->select("serah_barang.*")->from("serah_barang");
		$this->db->JOIN("pelanggan", "pelanggan.id_pelanggan=serah_barang.id_pelanggan");
		if (!empty($search)) {
			foreach ($search as $key => $value) {
				$this->db->or_like($key, $value);
			}
		}

		$result = $this->db->get();

		return $result->num_rows();
	}
}
