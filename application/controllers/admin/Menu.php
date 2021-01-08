<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Menu');
		cekLogin();
	}

	public function getData()
	{
		$menu = $this->M_Menu->get_datatables();
		$data = [];
		$no = @$_POST['start'];
		foreach ($menu as $mn) {
			$no ++;
			$row = [];
			$row[] = $no.".";
			$row[] = $mn->main_menu2;
			$row[] = $mn->nama_menu; 
			$row[] = $mn->url_menu; 
			if ($mn->mempunyai_link == 1) {
			 	$row[] = 'Memiliki Link';
			 } else{
			 	$row[] = 'Tidak Memiliki Link';
			 }
			$row[] = '<i class="fa fa-'.$mn->ikon_menu.'"></i>';
			$row[] = '
					<a class="btn btn-xs btn-warning" href="javascript:void(0)" title="Ubah" onclick="ButtonEdit('."'".$mn->id_menu."'".')"><i class="fa fa-edit"></i></a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="ButtonDelete('."'".$mn->id_menu."'".')"><i class="fa fa-trash"></i></a>
					';
			$data[] = $row;
					// <button type="button" class="hapus btn btn-danger btn-sm" title="Hapus Pengguna" id="'.$art->id.'" ><i class="fa fa-trash"></i></button>
		}

		$output = [
			'draw' => @$_POST['draw'],
			'recordsTotal' => $this->M_Menu->count_all(),
			'recordsFiltered' => $this->M_Menu->count_filtered(),
			'data' => $data,
		];

		echo json_encode($output);
	}

	public function index()
	{
		redirect('./');
	}


	public function manajemen()
	{
		// $main_menu = 0;
		// $menu = $this->db->select('id_menu, main_menu, (SELECT a.nama_menu FROM menu a WHERE a.id_menu = menu.main_menu) as main_menu2, nama_menu, url_menu, mempunyai_link, ikon_menu, posisi')->from('menu')->get()->result();
		// $option = $this->db->select('menu.id_menu,
		// 		menu.main_menu,
		// 		(select (select b.nama_menu from menu as b where b.id_menu = a.main_menu) from menu as a where a.id_menu = menu.main_menu) as main_menu_parent_title,
		// 		(select c.nama_menu from menu as c where c.id_menu = menu.main_menu) as main_nama_menu,
		// 		menu.nama_menu,
		// 		menu.url_menu,
		// 		menu.mempunyai_link,
		// 		menu.ikon_menu,
		// 		menu.posisi')->from('menu')->order_by('main_menu, posisi', 'ASC')->get()->result();
		$data = ['title' => 'Menu'];
	   	$this->template->load('templates/backend', 'admin/manajemen_menu', $data);
	}

	public function getMenuById($id)
	{
		$menu = $this->db->get_where('menu', ['id_menu' => $id])->row();
		echo json_encode($menu);
	}

	function simpan($status)
	{
		$main_menu = $this->input->post('main_menu');
		$nama_menu = $this->input->post('nama_menu');
		$url_menu = $this->input->post('url_menu');
		$ikon_menu = $this->input->post('ikon_menu');
		$mempunyai_link = $this->input->post('mempunyai_link');
		$id_menu = $this->input->post('id_menu');

		if ($main_menu == '0') {
			$required = '|required';
		}else{
			$required = '';
		}

		if($main_menu== '') $main_menu = '0';
		$sql 	= "select max(posisi) as posisi from menu where main_menu = ?";
		$query 	= $this->db->query($sql,array($main_menu));

		$row = $query->row();
		$posisi = $row->posisi+1; 

		$this->form_validation->set_rules('main_menu', 'Main Menu', 'trim');
		$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'trim|required');
		$this->form_validation->set_rules('url_menu', 'Url Menu', 'trim|required', ['required' => '%s Belum Diisi']);
		$this->form_validation->set_rules('ikon_menu', 'Ikon Menu', 'trim'.$required);
		$this->form_validation->set_rules('mempunyai_link', 'Mempunyai Link', 'trim|required', ['required' => '%s Belum Diisi']);

		if ($this->form_validation->run() == false) {
			$array = [
				'main_menu_error' => form_error('main_menu'),
				'nama_menu_error' => form_error('nama_menu'),
				'url_menu_error' => form_error('url_menu'),
				'ikon_menu_error' => form_error('ikon_menu'),
				'mempunyai_link_error' => form_error('mempunyai_link'),
			];
		}else{
			if ($status == 'add') {
				$data = [
					'nama_menu' => $nama_menu,
					'url_menu' => $url_menu,
					'mempunyai_link' => $mempunyai_link,
					'ikon_menu' => $ikon_menu,
					'posisi' => $posisi,
					'main_menu' => $main_menu,
				];
				$this->M_Menu->addMenu($data);

				$array = ['sukses' => true, 'alert' => 'Ditambahkan'];
			}else{
				$data = [
					'nama_menu' => $nama_menu,
					'url_menu' => $url_menu,
					'mempunyai_link' => $mempunyai_link,
					'ikon_menu' => $ikon_menu,
					'main_menu' => $main_menu,
				];
				$this->M_Menu->editMenu($data, $id_menu);
				$array = ['sukses' => true, 'alert' => 'Diperbarui'];
			}




		}

		echo json_encode($array);

	}

	public function tambah_menu()
	{
		$main_menu = $this->input->post('parent');



		if($main_menu=='') $main_menu = '0';
		$sql 	= "select max(posisi) as posisi from menu where main_menu = ?";
		$query 	= $this->db->query($sql,array($main_menu));

		$row = $query->row();
		$posisi = $row->posisi+1;

		$data = [
			'nama_menu' => $this->input->post('title'),
			'url_menu' => $this->input->post('url'),
			'mempunyai_link' => $this->input->post('flag'),
			'ikon_menu' => $this->input->post('icon'),
			'posisi' => $posisi,
			'main_menu' => $main_menu,
		];
		$this->db->insert('menu', $data);
		$array = ['sukses' => true];
		echo json_encode($array);
	}


	public function ubah_menu()
	{
		$id = $this->input->post('id');
		// $main_menu = $this->input->post('parent');
		// $this->db->set('mempunyai_link', 0);
		// $this->db->where('id_menu', $main_menu);
		// $this->db->update('menu');
		$data = [
			'nama_menu' => $this->input->post('title'),
			'url_menu' => $this->input->post('url'),
			'mempunyai_link' => $this->input->post('flag'),
			'ikon_menu' => $this->input->post('icon'),
			'main_menu' => $this->input->post('parent'),
		];
		$this->db->where('id_menu', $id);
		$this->db->update('menu', $data);

		$array = ['sukses' => true];
		echo json_encode($array);
	}

	public function delete($id)
	{
		$this->db->where('id_menu', $id);
		$this->db->delete('menu');
		$array = ['sukses' => true, 'alert' => 'Dihapus'];
		echo json_encode($array);
	}

	public function getOption()
	{
		$option = $this->M_Menu->getOption();

		echo json_encode($option);
	}


	public function posisi()
	{
		$data = ['title' => 'Posisi'];
	   	$this->template->load('templates/backend', 'admin/manajemen_posisi', $data);	
	}


	public function getPosisi()
	{
		$html = '
		<script src="'. base_url('assets/') .'global/js/sortable-nestable.js"></script>
		<div class="dd" data-plugin="nestable">
			<ol class="dd-list">';

        $menu = $this->M_Menu->get_menu(0);

        for ( $i = 0 ; $i < count($menu) ; $i++ )
        {

        $html .= '
       				 <li class="dd-item dd-item-alt dd-collapsed" data-id="'.$menu[$i]['id_menu'].'">
                        <div class="dd-handle"></div>
                        <div class="dd-content">'.$menu[$i]['nama_menu'].'
                        </div>';
        
        $childmenu = $this->M_Menu->get_menu($menu[$i]['id_menu']);

        if ( count($childmenu) > 0 )
        $html .= '  <ol class="dd-list">';

        for ( $j = 0 ; $j < count($childmenu) ; $j++ )
        {

        $html .= '  
					<li class="dd-item dd-item-alt" data-id="'.$childmenu[$j]['id_menu'].'">
	                	<div class="dd-handle"></div>
	                	<div class="dd-content">'.$childmenu[$j]['nama_menu'].'
	                	</div>';
        
        $grandchildmenu = $this->M_Menu->get_menu($childmenu[$j]['id_menu']);

        if ( count($grandchildmenu) > 0 )
        $html .= '     <ol class="dd-list">';
		
    	for ( $k = 0 ; $k < count($grandchildmenu) ; $k++ )
    	{

		$html .= '     		<li class="dd-item" data-id="'.$grandchildmenu[$k]['id_menu'].'">
		                       <div class="dd-handle">'.$grandchildmenu[$k]['nama_menu'].'</div>
		                    </li>';
		
        }

        if ( count($grandchildmenu) > 0 )
		$html .= '      </ol>';
        
        $html .= '  </li>';
        
        }

        if ( count($childmenu) > 0 )
        $html .= '
                 </ol>';


        $html .= '
              </li>';
        
        }

        $html .= '
			</ol>
		</div>
		';

		echo json_encode($html);
	}

	public function ubahPosisiMenu()
	{
		$data = $this->input->post('data');
		
		$n1 = 1;
		foreach ( $data as $key_parent => $val_parent )
		{
			/*[BEGIN] UPDATE KE DATABASE*/
			$data_parent = array('posisi'=>$n1,'main_menu'=>0, 'mempunyai_link' => 1);
			$param_parent = array('id_menu'=>$val_parent['id']);
			// $this->db->trans_begin();
			$this->M_Menu->editPosisiMenu($data_parent,$param_parent);
			// if($this->db->trans_status()===true){
			// 	$this->db->trans_commit();
			// }else{
			// 	$this->db->trans_rollback();
			// }
			/*[END] UPDATE KE DATABASE*/

			$n2 = 1;

			if( isset ( $val_parent['children'] ) )
			{
				$data_parent = array('posisi'=>$n1,'main_menu'=>0, 'mempunyai_link' => 0);
				$param_parent = array('id_menu'=>$val_parent['id']);
				$this->M_Menu->editPosisiMenu($data_parent,$param_parent);
				foreach ( $val_parent['children'] as $key_child => $val_child )
				{
					$n3 = 1;

					/*[BEGIN] UPDATE KE DATABASE*/
					$data_child = array('posisi'=>$n2,'main_menu'=>$val_parent['id']);
					$param_child = array('id_menu'=>$val_child['id']);
					// $this->db->trans_begin();
					$this->M_Menu->editPosisiMenu($data_child,$param_child);
					// if($this->db->trans_status()===true){
					// 	$this->db->trans_commit();
					// }else{
					// 	$this->db->trans_rollback();
					// }
					/*[END] UPDATE KE DATABASE*/

					if( isset ( $val_child['children'] ) )
					{
						foreach ( $val_child['children'] as $key_grandchild => $val_grandchild )
						{
							/*[BEGIN] UPDATE KE DATABASE*/
							$data_grandchild = array('posisi'=>$n3,'main_menu'=>$val_child['id']);
							$param_grandchild = array('id_menu'=>$val_grandchild['id']);
							// $this->db->trans_begin();
							$this->M_Menu->editPosisiMenu($data_grandchild,$param_grandchild);
							// if($this->db->trans_status()===true){
							// 	$this->db->trans_commit();
							// }else{
							// 	$this->db->trans_rollback();
							// }
							/*[END] UPDATE KE DATABASE*/

							$n3++;
						}
					}

					$n2++;
				}
			}

			$n1++;
		}
	
		echo json_encode('sukses');	
	}

}