<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jabatan extends CI_Model {

	var $column_order_role = [null,'nama_jabatan','deskripsi_jabatan'];
	var $column_search_role = ['nama_jabatan','deskripsi_jabatan'];
	var $order_role = ['id_jabatan' => 'ASC'];

	private function _get_datatables_query(){
		$this->db->from('jabatan');

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
		$this->db->from('jabatan');
		return $this->db->count_all_results();
	}

	function addJabatan($data)
	{
		$this->db->insert('jabatan', $data);
	}

	function editJabatan($data, $id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->update('jabatan', $data);
	}

	function deleteJabatan($id)
	{
		$this->db->where('id_jabatan', $id);
		$this->db->delete('jabatan');
	}

	function get_menu_parent_by_role($id_role)
	{

		$this->db->select('menu.id_menu, menu.nama_menu, previlege_jabatan.id_jabatan');
		$this->db->from('menu');
		$this->db->join('previlege_jabatan', 'previlege_jabatan.id_menu = menu.id_menu AND previlege_jabatan.id_jabatan = '.$id_role, 'LEFT');
		$this->db->where('menu.main_menu ', '0');
		$this->db->order_by('posisi');
		return $this->db->get()->result_array();
			// $sql = "SELECT
			// 		pmpu_menu.menu_id,
			// 		pmpu_menu.menu_title,
			// 		pmpu_user_nav.role_id
			// 		FROM pmpu_menu
			// 		LEFT JOIN pmpu_user_nav ON pmpu_user_nav.menu_id = pmpu_menu.menu_id and pmpu_user_nav.role_id = ?
			// 		WHERE pmpu_menu.menu_parent = '0' order by pmpu_menu.position asc";

			// $query = $this->db->query($sql,array($id_role));

			// return $query->result_array();
	}

	public function get_menu_child_by_role($id_role,$main_menu)
	{

		$this->db->select('menu.id_menu, menu.nama_menu, previlege_jabatan.id_jabatan');
		$this->db->from('menu');
		$this->db->join('previlege_jabatan', 'previlege_jabatan.id_menu = menu.id_menu AND previlege_jabatan.id_jabatan = '.$id_role, 'LEFT');
		$this->db->where('menu.main_menu', $main_menu);
		$this->db->order_by('posisi');
		return $this->db->get()->result_array();
	}

	public function delete_user_nav($param)
	{
		$this->db->delete('previlege_jabatan',$param);
	}

	public function insert_batch_user_nav($data)
	{
		$this->db->insert_batch('previlege_jabatan',$data);
	}
}