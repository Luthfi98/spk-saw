<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Alternatif extends CI_Model {

	var $column_order_role = [null,'kode_alternatif','nama_alternatif'];
	var $column_search_role = ['kode_alternatif','nama_alternatif'];
	var $order_role = ['id' => 'ASC'];

	private function _get_datatables_query(){
		$this->db->from('alternatif');

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
		$this->db->from('alternatif');
		return $this->db->count_all_results();
	}

	function addAlternatif($data)
	{
		$this->db->insert('alternatif', $data);
	}

	function editAlternatif($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('alternatif', $data);
	}

	function deleteAlternatif($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('alternatif');

		$this->db->where('baris', $id);
		$this->db->delete('nilai_alternatif');
	}

	function getById($id)
	{
		return $this->db->get_where('alternatif', ['id' => $id])->row();
	}
}