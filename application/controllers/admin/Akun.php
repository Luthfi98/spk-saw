<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Akun');
		cekLogin();
	}

	public function index()
	{
		redirect('./');
	}

	function getData()
	{
		$akun = $this->M_Akun->get_datatables();
		$data = [];
		$no = @$_POST['start'];
		foreach ($akun as $akn) {
			$no ++;
			$row = [];
			$row[] = $no.".";
			$row[] = '
			 <span class="avatar">
                  <img src="'.base_url('assets/img/').$akn->gambar.'" alt="...">
                </span>
			';
			$row[] = $akn->username;
			$row[] = $akn->nama_jabatan;
			$row[] = $akn->date_created;
			$row[] = $akn->last_login;
			$row[] = '
			<a class="btn btn-xs btn-warning" href="javascript:void(0)" title="Ubah" onclick="ButtonEdit('."'".$akn->id_akun."'".')"><i class="fa fa-edit"></i></a>
			<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="ButtonDelete('."'".$akn->id_akun."'".')"><i class="fa fa-trash"></i></a>
			';
			$data[] = $row;
		}

		$output = [
			'draw' => @$_POST['draw'],
			'recordsTotal' => $this->M_Akun->count_all(),
			'recordsFiltered' => $this->M_Akun->count_filtered(),
			'data' => $data,
		];

		echo json_encode($output);
	}

	public function manajemen()
	{
		$jabatan = $this->db->get('jabatan')->result();
		$data = ['title' => 'Akun', 'jabatan' => $jabatan];
		$this->template->load('templates/backend', 'admin/manajemen_akun', $data);
	}

	function getAkunById()
	{
		$id = $this->input->post('id_akun');
		$get = $this->M_Akun->getById($id);
		echo json_encode($get);
	}

	function Simpan($status)
	{
		$id = $this->input->post('id_akun');
		$username = htmlspecialchars($this->input->post('username', TRUE));
		$password = htmlspecialchars($this->input->post('password', TRUE));
		$konfirmasi = htmlspecialchars($this->input->post('konfirmasi', TRUE));
		$jabatan = htmlspecialchars($this->input->post('jabatan', TRUE));
		$gambar = $_FILES['gambar']['name'];


		$cek = $this->M_Akun->getById($id);

		if ($cek) {
			if ($cek->username == $username) {
				$is_unique = '';
			}else{
				$is_unique = '|is_unique[akun.username]';
			}
			$required = '';
		}else{
			$is_unique = '|is_unique[akun.username]';
			$required = '|required';
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[5]|max_length[15]'.$is_unique,[
				'required' => '%s Tidak Boleh Kosong',
				'is_unique' => '%s Sudah Digunakan Oleh Akun Lain',
				'min_length' => 'Panjang %s Minimal 5 Huruf',
				'max_length' => 'Panjang %s Maksimal 15 Huruf',
			]);
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|min_length[8]'.$required,[
				'required' => '%s Tidak Boleh Kosong',
				'min_length' => 'Panjang %s Minimal 8 Huruf',
			]);
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|xss_clean'.$required,['required' => '%s Tidak Boleh Kosong',]);
		$this->form_validation->set_rules('konfirmasi', 'Konfirmasi Password', 'trim|xss_clean|matches[password]|min_length[8]'.$required,[
				'required' => '%s Tidak Boleh Kosong',
				'matches' => '%s Tidak Sesuai',
				'min_length' => 'Panjang %s Minimal 8 Huruf',
			]);
		if ($this->form_validation->run() == FALSE) {
			$array = [
				'username_error' => form_error('username'),
				'password_error' => form_error('password'),
				'konfirmasi_error' => form_error('konfirmasi'),
				'jabatan_error' => form_error('jabatan'),
			];
			echo json_encode($array);
		}else{

				$upload = $this->uploadGambar($status, $gambar, $username, $id);
			if ($status == 'add') {
				if (isset($upload['sukses'])) {
					$data = [
						'username' => $username,
						'password' => password_hash($password, PASSWORD_DEFAULT),
						'id_jabatan' => $jabatan,
						'date_created' => date('Y-m-d H:i:s'),
						'gambar' => $upload['gambar']
					];
					$this->M_Akun->addAkun($data);

					$array = ['sukses' => true, 'alert' => 'Data Akun '.$username.' Berhasil Ditambahkan'];
					echo json_encode($array);
				}else{
					echo json_encode($upload);
				}
			}else{
				if (isset($upload['sukses'])) {

					if ($password) {
						$new = password_hash($password, PASSWORD_DEFAULT);
					}else{
						$new = $cek->password;
					}


					$data = [
						'username' => $username,
						'password' => $new,
						'id_jabatan' => $jabatan,
						'date_edited' => date('Y-m-d H:i:s'),
						'gambar' => $upload['gambar']
					];
					$this->M_Akun->editAkun($data, $id);
					$array = ['sukses' => true, 'alert' => 'Data Akun '.$username.' Berhasil Diperbarui'];
					echo json_encode($array);
				}else{
					echo json_encode($upload);
				}
			}
		}

	}


	function uploadGambar($status, $gambar, $username, $id)
	{
		$get = $this->M_Akun->getById($id);
		if ($status == 'add') {
			if ($_FILES['gambar']['name']) {
				$config = [
					'upload_path' => './assets/img/',
					'allowed_types' => 'jpg|png|jpeg',
					'max_size' => '2048',
					'file_name' => 'Profile'.$username.'_'.date('dmY').'_'.rand(3, 1000),
				];
				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('gambar')) {
					$array = ['gambar_error' => $this->upload->display_errors()];
					return $array;
				}else{
					$array = ['gambar' => $this->upload->data('file_name'), 'sukses' => true ];
					return $array;
				}
			}else{
				$array = ['gambar' => 'default.jpg', 'sukses' => true ];
				return $array;
			}
		}else{
			if ($_FILES['gambar']['name']) {
				$config = [
					'upload_path' => './assets/img/',
					'allowed_types' => 'jpg|png|jpeg',
					'max_size' => '2048',
					'file_name' => 'Profile'.$username.'_'.date('dmY').'_'.rand(3, 1000),
				];
				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('gambar')) {
					$array = ['gambar_error' => $this->upload->display_errors()];
					return $array;
				}else{
					if ($get->gambar != 'default.jpg') {
						unlink(FCPATH.'./assets/img/'.$get->gambar);
					}
					$array = ['gambar' => $this->upload->data('file_name'), 'sukses' => true ];
					return $array;
				}
			}else{
				$array = ['gambar' => $get->gambar, 'sukses' => true ];
				return $array;
			}
		}

	}

	function delete($id_akun)
	{
		$get = $this->M_Akun->getById($id_akun);

		if ($get->gambar != 'default.jpg') {
			unlink(FCPATH.'./assets/img/'.$get->gambar);
		}
		$this->M_Akun->deleteAkun($id_akun);
		echo json_encode(['status' => true, 'alert' => 'Dihapus']);
	}


	function profile()
	{
		$id = $this->session->userdata('id_akun');
		$get = $this->db->select('*')->join('jabatan', 'jabatan.id_jabatan = akun.id_jabatan')->get_where('akun', ['id_akun' => $id])->row();

		$data = ['title' => 'My Profile', 'profile' => $get];
		$this->template->load('templates/backend', 'admin/profile', $data);

	}


}