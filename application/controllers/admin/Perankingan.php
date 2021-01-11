<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perankingan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Kriteria');
		cekLogin();
	}
	public function index()
	{
		$kriteria = $this->db->order_by('id', 'ASC')->get('kriteria');
		$alternatif = $this->db->join('ranking', 'alternatif.id = ranking.id_alternatif')->order_by('id', 'ASC')->where('hasil_wp', 0.00000)->get('alternatif');
		if ($alternatif->num_rows() <1) {
			$alternatif = $this->db->order_by('id', 'ASC')->get('alternatif');
		}
		$hasil = $this->db->order_by('baris', 'ASC')->get('nilai_alternatif')->result();
		$nilai = $this->db->order_by('kolom', 'ASC')->order_by('baris', 'ASC')->get('nilai_alternatif');
		$rnk = $this->db->get_where('ranking', ['hasil_wp' => 0.00000]);
		$data = ['title' => 'Perankingan Simple Additive Weighting (SAW)', 'nilai' => $nilai, 'alternatif' => $alternatif, 'kriteria' => $kriteria, 'hasil' => $hasil, 'rnk' => $rnk];
		$this->template->load('templates/backend', 'admin/perankingan', $data);
	}

	public function wp()
	{
		$kriteria = $this->db->order_by('id', 'ASC')->get('kriteria');
		$alternatif = $this->db->order_by('id', 'ASC')->get('alternatif');
		$hasil = $this->db->order_by('baris', 'ASC')->get('nilai_alternatif')->result();
		$nilai = $this->db->order_by('kolom', 'ASC')->order_by('baris', 'ASC')->get('nilai_alternatif');
		$data = ['title' => 'Perankingan Weighted Product (WP)', 'nilai' => $nilai, 'alternatif' => $alternatif, 'kriteria' => $kriteria, 'hasil' => $hasil];
		$this->template->load('templates/backend', 'admin/perankingan_wp', $data);
	}
}