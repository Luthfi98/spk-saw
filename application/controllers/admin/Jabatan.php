<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Jabatan');
		cekLogin();
	}
	public function index()
	{
		redirect('./');
	}
	public function manajemen()
	{
		$data = ['title' => 'Jabatan'];
		$this->template->load('templates/backend', 'admin/manajemen_jabatan', $data);
	}

	public function getData()
	{
		$jabatan = $this->M_Jabatan->get_datatables();
		$data = [];
		$no = @$_POST['start'];
		foreach ($jabatan as $jbt) {
			$no ++;
			$row = [];
			$row[] = $no.".";
			$row[] = $jbt->nama_jabatan;
			$row[] = $jbt->deskripsi_jabatan;
			$row[] = '
			<a class="btn btn-xs btn-success" href="javascript:void(0)" title="Previllege" onclick="ButtonPrevillege('."'".$jbt->id_jabatan."'".')"><i class="fa fa-wrench"></i></a>
			<a class="btn btn-xs btn-warning" href="javascript:void(0)" title="Ubah" onclick="ButtonEdit('."'".$jbt->id_jabatan."'".')"><i class="fa fa-edit"></i></a>
			<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="ButtonDelete('."'".$jbt->id_jabatan."'".')"><i class="fa fa-trash"></i></a>
			';
			$data[] = $row;
		}

		$output = [
			'draw' => @$_POST['draw'],
			'recordsTotal' => $this->M_Jabatan->count_all(),
			'recordsFiltered' => $this->M_Jabatan->count_filtered(),
			'data' => $data,
		];

		echo json_encode($output);
	}


	function simpan($status)
	{
		if ($status == 'add') {
			$nama = '|required';
			$deskripsi = '|required';
		}else{
			$nama = '';
			$deskripsi = '';
		}


		$nama_jabatan = $this->input->post('nama_jabatan');
		$id_jabatan = $this->input->post('id_jabatan');
		$deskripsi_jabatan = $this->input->post('deskripsi_jabatan');
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'trim'.$nama);
		$this->form_validation->set_rules('deskripsi_jabatan', 'Deskripsi Jabatan', 'trim'.$deskripsi);
		if ($this->form_validation->run() == FALSE) {
			$array = [
				'nama_jabatan_error' => form_error('nama_jabatan'), 
				'deskripsi_jabatan_error' => form_error('deskripsi_jabatan'), 
			];
		}else{
			if ($status == 'add') {
				$data = [
					'nama_jabatan' => $nama_jabatan,
					'deskripsi_jabatan' => $deskripsi_jabatan,
				];

				$this->M_Jabatan->addJabatan($data);
				$array = ['sukses' => true, 'alert' => 'Ditambahkan'];
			}else{
				$data = [
					'nama_jabatan' => $nama_jabatan,
					'deskripsi_jabatan' => $deskripsi_jabatan,
				];

				$this->M_Jabatan->editJabatan($data, $id_jabatan);
				$array = ['sukses' => true, 'alert' => 'Diperbarui'];
			}
		}

		echo json_encode($array);

	}

	public function getJabatanById($id)
	{
		$role = $this->db->get_where('jabatan', ['id_jabatan' => $id])->row();
		echo json_encode($role);
	}


	public function delete($id)
	{
		$this->M_Jabatan->deleteJabatan($id);
		echo json_encode(['status' => true, 'alert' => 'Dihapus']);
	}

	public function getPrevilegeJabatan($id_jabatan)
	{

		$menuroleparent = $this->M_Jabatan->get_menu_parent_by_role($id_jabatan);
		$menu = '<input type="hidden" id="id_jabatan" name="id_jabatan" value="'.$id_jabatan.'">';
		$menu .= '<ol>';

		foreach($menuroleparent as $parent)
		{
			$parent_is = '';
			if ( $parent['id_jabatan'] != "" )
			$parent_is = ' checked="checked"';

			$menu .= '<li>
			<label>
			<input type="checkbox" name="id_menu[]" id="parent"'.$parent_is.' value="'.$parent['id_menu'].'">
			<span>'.$parent['nama_menu'].'</span>
			</label>';

			$menurolechild = $this->M_Jabatan->get_menu_child_by_role($id_jabatan,$parent['id_menu']);

			if ( count($menurolechild) > 0 )
			$menu .= '<ol>';

			foreach($menurolechild as $child)
			{

				$menurolegrandchild = $this->M_Jabatan->get_menu_child_by_role($id_jabatan,$child['id_menu']);

				$child_is = '';
				if ( $child['id_jabatan'] != "" )
				$child_is = ' checked="checked"';

				$menu .= '<li>
				<label>
				<input type="checkbox" name="id_menu[]" id="child"'.$child_is.' value="'.$child['id_menu'].'">
				<span>'.$child['nama_menu'].'</span>
				</label>';

				if ( count($menurolegrandchild) > 0 )
				$menu .= '<ol>';

				foreach($menurolegrandchild as $grandchild)
				{
					$grandchild_is = '';
					if ( $grandchild['id_jabatan'] != "" )
					$grandchild_is = ' checked="checked"';

					$menu .= '<li><label>
					<input type="checkbox" name="id_menu[]" id="parent"'.$grandchild_is.' value="'.$grandchild['id_menu'].'">
					<span>'.$grandchild['nama_menu'].'</span>
					</label></li>';
				}

				if ( count($menurolegrandchild) > 0 )
				$menu .= '</ol>';

				$menu .= '</li>';
			}

			if ( count($menurolechild) > 0 )
			$menu .= '</ol>';

			$menu .= '
			</li>';
		}

		$menu .= '</ol>';

		echo $menu;
	}



	public function simpanPrevileJabatan()
	{
		$id_jabatan = $this->input->post('id_jabatan');
		$id_menu = $this->input->post('id_menu');

		$data_batch = array();

		for ( $i = 0 ; $i < count($id_menu) ; $i++ )
		{
			$data_batch[] = array(
				'id_jabatan' => $id_jabatan,
				'id_menu' => $id_menu[$i]
			);
		}

		$param_delete = array('id_jabatan'=>$id_jabatan);

		$this->db->trans_begin();
		$this->M_Jabatan->delete_user_nav($param_delete);
		if ( $this->db->trans_status() === true )
		{
			$this->db->trans_commit();

			if ( count($data_batch) > 0 )
			{
				$this->db->trans_begin();
				$this->M_Jabatan->insert_batch_user_nav($data_batch);
				if ( $this->db->trans_status() === true )
				{
					$this->db->trans_commit();
					$return = array('success'=>true);
				}
				else
				{
					$this->db->trans_rollback();
					$return = array('success'=>false);
				}
			}
			else
			{
				$return = array('success'=>true);
			}

		}
		else
		{
			$this->db->trans_rollback();
			$return = array('success'=>false);
		}

		echo json_encode($return);
	}

	// Fungsi Manajemen User

	function grid_user()
	{ 
		$user = $this->Model_User->get_dataTables();
		// $role = $this->db->get('pmpu_role_user')->result();
		$data = [];
		$no = @$_POST['start'];
		foreach ($user as $s) {
			$no ++;
			$row = [];
			$row[] = $no.".";
			$row[] = $s->username;
			$row[] = $s->fullname;
			$row[] = $s->email;
			$row[] = $s->role_name;
			if ($s->status == 1) {
				$row[] = "Aktif";
			}else{
				$row[] = "Tidak Aktif";
			}
			$row[] = '<img src="../assets/dokumentasi_user/'.$s->gambar.'"/>';
			$row[] = $s->created_stamp;
			$row[] = '
			<a class="badge badge-sm badge-warning" href="javascript:void(0)" title="Ubah"
			onclick="EditUser('."'".$s->user_id."'".')"><i class="fa fa-edit"></i></a>
			<a class="badge badge-sm badge-danger" href="javascript:void(0)" title="Hapus"
			onclick="HapusUser('."'".$s->user_id."'".')"><i class="fa fa-trash"></i></a>
			';
			$data[] = $row;
		}

		$output = [
			'draw' => @$_POST['draw'],
			'recordsTotal' => $this->Model_User->count_all(),
			'recordsFiltered' => $this->Model_User->count_filtered(),
			'data' => $data,
		];

		echo json_encode($output);
	}


	public function user()
	{
		$data['provinsi'] = $this->Model_User->getAllProvinsi()->result();
		$data['role'] = $this->Model_User->getAllRole()->result();
		$data['title'] = 'Manajemen User';
		$this->template->load('template/static', 'user/index',$data);

	}

	public function tambah()
	{
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required', ['required => %s Wajib Di Isi']);
		$this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' =>'%s Wajib Di Isi']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confirm]', [
			'matches' => 'Password Tidak Sama'
		]);
		$this->form_validation->set_rules('confirm', 'Password', 'required|trim|matches[password]');

		$this->form_validation->set_rules('fullname', 'Full Name', 'required|trim', ['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',
		['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('role_name', 'Role Name', 'required', ['required' =>'%s Wajib Di Isi']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => '%s Wajib Di Isi']);
		if ($this->form_validation->run()== FALSE) {
			$return = [
				'provinsi_error' => form_error('provinsi'),
				'username_error' => form_error('username'),
				'password_error' => form_error('password'),
				'fullname_error' => form_error('fullname'),
				'email_error' => form_error('email'),
				'role_error' => form_error('role_name'),
				'status_error'=> form_error('status')
			];
		}else {
			$provinsi = $this->input->post('provinsi');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$re_password = $this->input->post('confirm');
			$fullname = $this->input->post('fullname');
			$email = $this->input->post('email');
			$role_name = $this->input->post('role_name');
			$status = $this->input->post('status');
			$gambar = $_FILES['gambar']['name'];

			if($gambar == ''){}else{
				$config ['upload_path'] = './assets/dokumentasi_user/';
				$config ['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '3072';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')){
					echo "Gambar gagal di upload !";
				} else {
					$gambar = $this->upload->data('file_name');
				}
			}
			$data = [
				'username' => $username,
				'password' => sha1($password),
				're_password' => $re_password,
				'status' => $status,
				'fullname' => $fullname,
				'email' => $email,
				'created_stamp' => date('Y-m-d H:i:s'),
				'id_jabatan' => $role_name,
				'last_visited' => date('Y-m-d H:i:s'),
				'session_id' => sha1($password),
				'provinsi' => $provinsi,
				'gambar' =>$gambar
			];
			// var_dump($data);

			$this->Model_User->tambah($data,'pmpu_user');
			$return = ['status' => true, 'alert'=> 'DiTambahkan'];
		}
		echo json_encode($return);
	}



	public function getByIDUser($id)
	{
		$user = $this->Model_User->getByID($id)->row();
		echo json_encode($user);
	}

	public function ubah()
	{
		$id = $this->input->post('user_id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$fullname = $this->input->post('fullname');
		$email = $this->input->post('email');
		$role_name = $this->input->post('role_name');
		$provinsi = $this->input->post('provinsi');
		$status = $this->input->post('status');
		$gambar = $_FILES['gambar']['name'];

		if($gambar == ''){}else{

			$config ['upload_path'] = './assets/dokumentasi_user/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] = '3072';
			$get = $this->db->get_where('pmpu_user', ['user_id' =>$id])->row();
			$image = $get->gambar;
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				unlink(FCPATH.'assets/dokumentasi_user/'.$image);
				$gambar = $this->upload->data('file_name');
			}

		}

		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required', ['required => %s Wajib Di Isi']);
		$this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' =>'%s Wajib Di Isi']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confirm]', [
			'matches' => 'Password Tidak Sama'
		]);
		$this->form_validation->set_rules('confirm', 'Password', 'required|trim|matches[password]');

		$this->form_validation->set_rules('fullname', 'Full Name', 'required|trim', ['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',
		['required' => '%s Tidak Boleh Kosong']);
		$this->form_validation->set_rules('role_name', 'Role Name', 'required', ['required' =>'%s Wajib Di Isi']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => '%s Wajib Di Isi']);
		if ($this->form_validation->run()== FALSE) {
			$return = [
				'provinsi_error' => form_error('provinsi'),
				'username_error' => form_error('username'),
				'password_error' => form_error('password'),
				'fullname_error' => form_error('fullname'),
				'email_error' => form_error('email'),
				'role_error' => form_error('role_name'),
				'status_error'=> form_error('status')
			];
		}else {
			$data = array(
				'username' => $username,
				'status' => $status,
				'fullname' => $fullname,
				'email' => $email,
				'created_stamp' => date('Y-m-d H:i:s'),
				'id_jabatan' => $role_name,
				'session_id' => sha1($password),
				'provinsi' => $provinsi,
				'gambar' => $gambar
			);

			if ($password != "") {
				$data['password'] = sha1($password);
			}

			if ($password != "") {
				$data['re_password'] = $password;
			}

			$this->Model_User->update($id, $data);
			$return = ['status' => true, 'alert'=> 'DiUbah'];
		}
		echo json_encode($return);

	}


	public function hapus($id)
	{
		$get = $this->Model_User->getByID($id)->row();
		unlink(FCPATH.'./assets/dokumentasi_user/'.$get->gambar);
		$this->db->where('user_id', $id);
		$this->db->delete('pmpu_user');
		$result = ['sukses' => true];
		echo json_encode($result);
	}
}
