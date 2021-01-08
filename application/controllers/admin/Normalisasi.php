<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Normalisasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Kriteria');
		cekLogin();
	}
	public function index()
	{
		$kriteria = $this->db->order_by('id', 'ASC')->get('kriteria');
		$alternatif = $this->db->order_by('id', 'ASC')->get('alternatif');
		$hasil = $this->db->order_by('baris', 'ASC')->get('nilai_alternatif')->result();
		$nilai = $this->db->order_by('kolom', 'ASC')->order_by('baris', 'ASC')->get('nilai_alternatif');
		$data = ['title' => 'Normalisasi Alternatif', 'nilai' => $nilai, 'alternatif' => $alternatif, 'kriteria' => $kriteria, 'hasil' => $hasil];
		$this->template->load('templates/backend', 'admin/normalisasi_alternatif', $data);
	}
}