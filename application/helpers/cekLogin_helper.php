<?php 

	function cekLogin()
	{
		$CI=get_instance();
		if (!$CI->session->userdata('username')) {
			redirect('');
		}
	}

 ?>