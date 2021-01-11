<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cekLogin();
	}
	public function index()
	{
		$alternatif = $this->db->get('alternatif');
		$kriteria = $this->db->get('kriteria');
		$akun = $this->db->get('akun');
		$data = ['title' => 'Dashboard', 'kriteria' => $kriteria, 'alternatif' => $alternatif, 'akun' => $akun];
		$this->template->load('templates/backend', 'admin/dashboard', $data);
	}
}
