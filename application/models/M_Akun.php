<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Akun extends CI_Model {

	var $column_order_role = [null,'gambar','username','nama_jabatan', 'date_created', 'last_login'];
	var $column_search_role = ['gambar','username','nama_jabatan', 'date_created', 'last_login'];
	var $order_role = ['id_akun' => 'ASC'];

	private function _get_datatables_query(){
		$this->db->select('username, nama_jabatan, date_created, id_akun, gambar, last_login');
		$this->db->from('akun');
		$this->db->join('jabatan', 'jabatan.id_jabatan = akun.id_jabatan');

		$i = 0;
		foreach ($this->column_search_role as $role) {
			if (@$_POST['search']['value']) {
				if ($i ===0) {
					$this->db->group_start();
					$this->db->like($role, $_POST['search']['value']);
				}else{
					$this->db->or_like($role, $_POST['search']['value']);
				}

				if (count($this->column_search_role) - 1 == $i) 
					$this->db->group_end();	
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order_role[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}elseif (isset($this->order_role)) {
			$order_role = $this->order_role;
			$this->db->order_by(key($order_role), $order_role[key($order_role)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if (@$_POST['length'] != 1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all()
	{
		$this->db->select('username, nama_jabatan, date_created, id_akun, gambar, last_login');
		$this->db->from('akun');
		$this->db->join('jabatan', 'jabatan.id_jabatan = akun.id_jabatan');
		return $this->db->count_all_results();
	}

	function addAkun($data)
	{
		$this->db->insert('akun', $data);
	}

	function editAkun($data, $id_akun)
	{
		$this->db->where('id_akun', $id_akun);
		$this->db->update('akun', $data);
	}

	function deleteAkun($id)
	{
		$this->db->where('id_akun', $id);
		$this->db->delete('akun');
	}

	function getById($id)
	{
		return $this->db->get_where('akun', ['id_akun' => $id])->row();
	}
}