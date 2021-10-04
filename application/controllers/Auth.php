<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	var $captcha_sess_key = 'BISSMILLAH_SKRIPSI_2021___AAMIIN';


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Akun');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			redirect('admin-dashboard');
		}
		$data = ['title' => 'Dashboard'];
		$this->load->view('login', $data);
	}

	function generateCaptcha()
	{
		// load codeigniter captcha helper
		$this->load->helper('captcha');

		$words = array_merge(range('A', 'Z'), range('0','9'));
		shuffle($words);
		$max_length = 6;
		$words = substr(implode($words), 0, $max_length);

		$vals = array(
			'word' => $words,
			'img_path'	 => './assets/img/captcha/',
			'img_url'	 => base_url().'assets/img/captcha/',
			'img_width'     => '325',
			'img_height'    => 50,
			'expiration'    => 7200,
			'font_size'     => 11,
			'font_path'  => base_url().'assets/global/fonts/framework7.ttf',
			'colors'        => array(
				'background' => array(244, 246, 250),
				'border' => array(32, 107, 196),
				'text' => array(0, 0, 0),
				'grid' => array(32, 107, 196)
			)
		);
		// create captcha image
		$cap = create_captcha($vals);

		// store the captcha word in a session
		$this->session->set_userdata($this->captcha_sess_key, $cap['word']);
		echo $cap['image'];
	}
	function captchaValidate()
	{
		$is_valid = false;
		$words = $this->input->post('captcha_words');
		if ($this->session->userdata($this->captcha_sess_key) == $words) {
			return true;
		}
	}

	function cekLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->db->get_where('akun', ['username' => $username])->row_array();
		if ($cek) {
			if (password_verify($password,$cek['password'])) {
				// if ($this->captchaValidate() == true) {
					$dataupdate = [
						'last_login' => date('Y-m-d H:i:s')
					];
					$data = [
						'session' => $this->session->userdata($this->captcha_sess_key),
						'id_akun' => $cek['id_akun'],
						'username' => $cek['username'],
						'gambar' => $cek['gambar'],
						'id_jabatan' => $cek['id_jabatan'],
					];

					$this->session->set_userdata($data);
					$this->M_Akun->editAkun($dataupdate, $cek['id_akun']);
					$array = ['sukses' => true,'alert' => 'Selamat Datang '.$cek['username']];
				// }else{
				// 	$array = ['alert' => 'Kode Captcha Tidak Sesuai'];
				// }
			}else{
				$array = ['alert' => 'Username atau Password Salah'];
			}
		}else{
			$array = ['alert' => 'Username atau Password Salah'];
		}

		echo json_encode($array);
	}

	function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('session');
		$this->session->unset_userdata('id_akun');
		$this->session->unset_userdata('id_jabatan');
		$this->session->unset_userdata('gambar');

		echo json_encode(['sukses' => true]);
	}

	function forbidden()
	{
		$this->template->load('templates/backend', 'errors/forbidden');
	}
}
