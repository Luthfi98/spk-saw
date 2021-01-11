<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Main extends CI_Model {

	function get_menu($id_jabatan, $main_menu=0)
	{

		$this->db->select('menu.id_menu, menu.main_menu, menu.nama_menu, menu.url_menu, menu.mempunyai_link, menu.ikon_menu');
		$this->db->from('menu');
		$this->db->join('previlege_jabatan', 'previlege_jabatan.id_menu=menu.id_menu');
		$this->db->where('previlege_jabatan.id_jabatan', $id_jabatan);
		$this->db->where('menu.main_menu', $main_menu);
		$this->db->where('menu.id_menu !=', 8);
		$this->db->order_by('menu.posisi', 'ASC');
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function authentication_member($username,$password)
	{
		$password = sha1($password);
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('pmpu_user')->row_array();
	} 

	public function update($table,$data,$param)
	{
		$this->db->update($table,$data,$param);
	}
}