<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kriteria extends CI_Model {

	var $column_order_role = [null,'kode_kriteria','nama_kriteria', 'bobot', 'jenis_kriteria'];
	var $column_search_role = ['kode_kriteria','nama_kriteria', 'bobot', 'jenis_kriteria'];
	var $order_role = ['id' => 'ASC'];

	private function _get_datatables_query(){
		$this->db->from('kriteria');

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
		$this->db->from('kriteria');
		return $this->db->count_all_results();
	}

	function addKriteria($data)
	{
		$this->db->insert('kriteria', $data);
	}

	function editKriteria($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('kriteria', $data);
	}

	function deleteKriteria($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kriteria');
	}

	function getById($id)
	{
		return $this->db->get_where('kriteria', ['id' => $id])->row();
	}
}