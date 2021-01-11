<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Kriteria');
		cekLogin();
	}
	public function index()
	{
		$data = ['title' => 'Kriteria'];
		$this->template->load('templates/backend', 'admin/manajemen_kriteria', $data);
	}

	function getKodeKriteria()
	{
		$kriteria = $this->db->order_by('kode_kriteria', 'DESC')->get('kriteria')->row();
		if ($kriteria) {
			$kode = buatkode($kriteria->kode_kriteria,'K', 1);
		}else{
			$kode = buatkode('','K', 1);
		}

		echo json_encode($kode);
	}

	function getData()
	{
		$kriteria = $this->M_Kriteria->get_datatables();
		$data = [];
		$no = @$_POST['start'];
		foreach ($kriteria as $krt) {
			$no ++;
			$row = [];
			$row[] = $no.".";
			$row[] = $krt->kode_kriteria;
			$row[] = $krt->nama_kriteria;
			$row[] = $krt->bobot;
			$row[] = $krt->jenis_kriteria;
			$row[] = '
			<a class="btn btn-xs btn-warning" href="javascript:void(0)" title="Ubah" onclick="ButtonEdit('."'".$krt->id."'".')"><i class="fa fa-edit"></i></a>
			';
			// <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="ButtonDelete('."'".$krt->id."'".')"><i class="fa fa-trash"></i></a>
			$data[] = $row;
		}

		$output = [
			'draw' => @$_POST['draw'],
			'recordsTotal' => $this->M_Kriteria->count_all(),
			'recordsFiltered' => $this->M_Kriteria->count_filtered(),
			'data' => $data,
		];

		echo json_encode($output);
	}

	function getKriteriaById()
	{
		$kriteria = $this->db->get_where('kriteria', ['id' => $this->input->post('id_kriteria')])->row();
		echo json_encode($kriteria);
	}

	function simpan($status)
	{

		$nama_kriteria = $this->input->post('kriteria');
		$kode_kriteria = $this->input->post('kode_kriteria');
		$id = $this->input->post('id_kriteria');
		$jenis_kriteria = $this->input->post('jenis');
		$bobot = $this->input->post('bobot_kriteria');

		$this->form_validation->set_rules('kriteria', 'Nama Kriteria', 'trim|required', ['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'trim|required', ['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('jenis', 'Jenis Kriteria', 'trim|required', ['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('bobot_kriteria', 'Bobot Kriteria', 'trim|required|numeric', ['required' => '%s Tidak Boleh Kosong', 'numeric' => 'Inputan %s Harus Berisikan Angka']);
		if ($this->form_validation->run() == FALSE) {
			$array = [
				'kriteria_error' => form_error('kriteria'), 
				'kode_kriteria_error' => form_error('kode_kriteria'), 
				'jenis_error' => form_error('jenis'), 
				'bobot_kriteria_error' => form_error('bobot_kriteria'), 
			];
		}else{
				// $data1 =[];
				$data = [
					'kode_kriteria' => $kode_kriteria,
					'nama_kriteria' => $nama_kriteria,
					'jenis_kriteria' => $jenis_kriteria,
					'bobot' => $bobot
				];
			if ($status == 'add') {
				$this->M_Kriteria->addKriteria($data);
				// $last = $this->db->insert_id();
				// $getid = $this->db->from('kriteria')->get()->result();
				// foreach ($getid as $gi) {
				// 		$data1 = [
				// 			'kolom' => $gi->id,
				// 		];
				// 	$this->db->insert('nilai_alternatif', $data1);
				// }
				// $getlast = $this->db->order_by('id_alternatif', 'DESC')->get('alternatif')->row();
				// $getidl = $this->db->from('alternatif')->get()->result();

				// foreach ($getidl as $gd) {
				// 		$data2 = [
				// 			'baris' => $gd->id_alternatif,
				// 			'kolom' => $last
				// 		];
				// 	$this->db->insert('nilai_alternatif', $data2);
				// }
				$array = ['sukses' => true, 'alert' => 'Ditambahkan'];
			}else{
				$this->M_Kriteria->editKriteria($data, $id);
				$array = ['sukses' => true, 'alert' => 'Diperbarui'];
			}
		}

		echo json_encode($array);

	}
	// else if ($getvallast->id_kriteria_1 < $last) {
	// 						$data1 = [
	// 							'id_kriteria_1' => $gi->id,
	// 							'id_kriteria_2' => $last
	// 						];
	// 					}
	public function delete()
	{

		$id = $this->input->post('id');
		if ($id) {
			$this->M_Kriteria->deleteKriteria($id);
			echo json_encode(['status' => true, 'alert' => 'Dihapus']);
		}else{
			$this->db->truncate('nilai_alternatif');
			$this->db->truncate('ranking');
			$this->db->truncate('kriteria');
			echo json_encode(['status' => true, 'alert' => 'Dikosongkan']);
		}
	}


	function nilaiKriteria()
	{

		// var_dump($kriteria); die;

		$kriteria = $this->db->order_by('id', 'ASC')->get('kriteria');
		$nilai = $this->db->order_by('id_kriteria_1', 'ASC')->get('nilai_kriteria')->result();
		// var_dump($nilai);die;
		$data = ['title' => 'Nilai Kriteria', 'kriteria' => $kriteria, 'nilai' => $nilai];
		$this->template->load('templates/backend', 'admin/manajemen_nilai_kriteria', $data);
	}

	function updateNilai($param)
	{

		$val = explode('-', $param);
		$idk1 = intval($val[0]);
		$idk2 = intval($val[1]);
		$k1 = intval($val[2]);

		if ($k1<0) {
			$nilai = 1/floatval($k1);
		}else{
			$nilai = 1/$k1;
		}

		$this->db->where('id_kriteria_1', $idk2);
		$this->db->where('id_kriteria_2', $idk1);
		$this->db->update('nilai_kriteria', ['nilai' => $nilai]);


		$this->db->where('id_kriteria_1', $idk1);
		$this->db->where('id_kriteria_2', $idk2);
		$this->db->update('nilai_kriteria', ['nilai' => $k1]);

		echo json_encode(['sukses' => true]);
	}

	function getJumlah()
	{

		$kriteria = $this->db->order_by('id', 'ASC')->get('kriteria')->result();
		$nilai = $this->db->order_by('id_kriteria_1', 'ASC')->get('nilai_kriteria')->result();
		foreach ($kriteria as $k) {
			foreach ($kriteria as $kr) {
				foreach ($nilai as $n) {
					$jml = $this->db->select('SUM(nilai) as nilai')->group_by('id_kriteria_2')->get('nilai_kriteria')->result_array();
				}
			}
		}
		echo json_encode($jml);

	}
}
