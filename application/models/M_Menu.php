<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {

	var $column_order = [null,'main_menu2','nama_menu','url_menu','mempunyai_link', 'ikon_menu'];
	var $column_search = ['nama_menu','url_menu','mempunyai_link', 'ikon_menu'];
	var $order = ['id_menu' => 'ASC'];

	private function _get_datatables_query(){
		$this->db->select('id_menu, main_menu, (SELECT a.nama_menu FROM menu a WHERE a.id_menu = menu.main_menu) as main_menu2, nama_menu, url_menu, mempunyai_link, ikon_menu, posisi');
		$this->db->from('menu');

		$i = 0;
		foreach ($this->column_search as $menu) {
			if (@$_POST['search']['value']) {
				if ($i ===0) {
					$this->db->group_start();
					$this->db->like($menu, $_POST['search']['value']);
				}else{
					$this->db->or_like($menu, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) 
					$this->db->group_end();	
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}elseif (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
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
		$this->db->select('id_menu, main_menu, (SELECT a.nama_menu FROM menu a WHERE a.id_menu = menu.main_menu) as main_menu2, nama_menu, url_menu, mempunyai_link, ikon_menu, posisi')->from('menu');
		return $this->db->count_all_results();
	}

	function editPosisiMenu($data,$param)
	{
		$this->db->update('menu',$data,$param);
	}

	function editMenu($data, $id_menu)
	{
		$this->db->where('id_menu', $id_menu);
		$this->db->update('menu',$data);
	}

	function get_menu($main_menu='0')
	{
		$this->db->select('id_menu, main_menu, nama_menu, url_menu, mempunyai_link, ikon_menu');
		$this->db->where('main_menu', $main_menu);
		$this->db->order_by('posisi', 'ASC');
		$query = $this->db->get('menu')->result_array();
		return $query;
	}


	function getOption()
	{
		$this->db->select('menu.id_menu,menu.main_menu,(select (select b.nama_menu from menu as b where b.id_menu = a.main_menu) from menu as a where a.id_menu = menu.main_menu) as nama_main_menu,(select c.nama_menu from menu as c where c.id_menu = menu.main_menu) as main_nama_menu,menu.nama_menu,menu.url_menu,menu.mempunyai_link,menu.ikon_menu,menu.posisi')->from('menu')->order_by('main_menu, posisi', 'ASC');
		return $this->db->get()->result_array();
	}

	function addMenu($data)
	{
		$this->db->insert('menu', $data);
	}

	
	
}