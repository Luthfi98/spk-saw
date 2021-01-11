<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Alternatif');
		cekLogin();
	}
	public function index()
	{
		$data = ['title' => 'Alternatif'];
		$this->template->load('templates/backend', 'admin/manajemen_alternatif', $data);
	}

	function getAlternatifById()
	{
		$alternatif = $this->db->get_where('alternatif', ['id' => $this->input->post('id_alternatif')])->row();
		echo json_encode($alternatif);
	}

	function getKodeAlternatif()
	{
		$alternatif = $this->db->order_by('kode_alternatif', 'DESC')->get('alternatif')->row();
		if ($alternatif) {
			$kode = buatkode($alternatif->kode_alternatif,'A', 2);
		}else{
			$kode = buatkode('','A', 2);
		}

		echo json_encode($kode);
	}

	function getData()
	{
		$alternatif = $this->M_Alternatif->get_datatables();
		$data = [];
		$no = @$_POST['start'];
		foreach ($alternatif as $krt) {
			$no ++;
			$row = [];
			$row[] = $no.".";
			$row[] = $krt->kode_alternatif;
			$row[] = $krt->nama_alternatif;
			$row[] = '
			<a class="btn btn-xs btn-warning" href="javascript:void(0)" title="Ubah" onclick="ButtonEdit('."'".$krt->id."'".')"><i class="fa fa-edit"></i></a>
			';
			// <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="ButtonDelete('."'".$krt->id."'".')"><i class="fa fa-trash"></i></a>
			$data[] = $row;
		}

		$output = [
			'draw' => @$_POST['draw'],
			'recordsTotal' => $this->M_Alternatif->count_all(),
			'recordsFiltered' => $this->M_Alternatif->count_filtered(),
			'data' => $data,
		];

		echo json_encode($output);
	}


	function simpan($status)
	{
		$nama_alternatif = $this->input->post('alternatif');
		$kode_alternatif = $this->input->post('kode_alternatif');
		$id = $this->input->post('id_alternatif');

		$this->form_validation->set_rules('alternatif', 'Nama Alternatif', 'trim|required', ['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('kode_alternatif', 'Kode Alternatif', 'trim|required', ['required' => '%s Tidak Boleh Kosong']);
		if ($this->form_validation->run() == FALSE) {
			$array = [
				'alternatif_error' => form_error('alternatif'), 
				'kode_alternatif_error' => form_error('kode_alternatif'), 
			];
			echo json_encode($array);
		}else{
			$data = [
				'kode_alternatif' => $kode_alternatif,
				'nama_alternatif' => $nama_alternatif,
			];

			if ($status == 'add') {
				$this->M_Alternatif->addAlternatif($data);
				$id_new = $this->db->insert_id();

				$getid = $this->db->from('kriteria')->get()->result();
				foreach ($getid as $gi) {
						$data1 = [
							'baris' => $id_new,
							'kolom' => $gi->id,
							'nilai' => 0
						];
					$this->db->insert('nilai_alternatif', $data1);
				}

				// $get = $this->db->get_where('nilai_alternatif', ['baris' => null])->result();
				// foreach ($get as $g) {
				// 	$this->db->where('id_nilai', $g->id_nilai);
				// 	$this->db->update('nilai_alternatif', ['baris' => $id_new]);
				// }
				echo json_encode(['sukses' => true, 'alert'=> 'Ditambahkan']);
			}else{
				$this->M_Alternatif->editAlternatif($data, $id);
				echo json_encode(['sukses' => true, 'alert'=> 'Diperbarui']);

			}

		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($id) {
			$this->M_Alternatif->deleteAlternatif($id);
			echo json_encode(['status' => true, 'alert' => 'Dihapus']);
		}else{
			$this->db->truncate('ranking');
			$this->db->truncate('nilai_alternatif');
			$this->db->truncate('alternatif');
			echo json_encode(['status' => true, 'alert' => 'Dikosongkan']);
		}
	}


	function nilai_alternatif()
	{
		$kriteria = $this->db->order_by('id', 'ASC')->get('kriteria');
		$alternatif = $this->db->order_by('id', 'ASC')->get('alternatif');
		$nilai = $this->db->order_by('baris', 'ASC')->get('nilai_alternatif')->result();
		// var_dump($nilai);die;
		$data = [
			'title' => 'Nilai Alternatif', 
			'kriteria' => $kriteria, 
			'nilai' => $nilai, 
			'alternatif' => $alternatif
		];
		$this->template->load('templates/backend', 'admin/manajemen_nilai_alternatif', $data);
	}

	function updateNilaiAlternatif()
	{
		$nilai = $this->input->post('nilai');
		$id = $this->input->post('id');

		$this->form_validation->set_rules('nilai[]', 'Inputan Nilai', 'numeric');
		if ($this->form_validation->run() == FALSE) {
		}else {
			for($x = 0; $x < count($id); $x++){
			    $updateArray[] = [
			        'id_nilai'=>$id[$x],
			        'nilai' => $nilai[$x],
			    ];
			}      
			$this->db->update_batch('nilai_alternatif',$updateArray, 'id_nilai'); 
			echo json_encode('sukses');
		}
		// $datanilai = [];
		// foreach ($nilai as $n) {
		// 	$datanilai[] = ['nilai' => $n];
		// }

		// $dataid = [];
		// foreach ($id as $id) {
		// 	$dataid[] = ['id_nilai' => $id];
		// }


	}

}
