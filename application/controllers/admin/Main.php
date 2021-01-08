<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Main');
		cekLogin();
	}

	public function index()
	{
		redirect('./');
	}

	public function generate_menu()
	{
		$id_jabatan = $this->session->userdata('id_jabatan');
		$url = $_POST['url1'];
		$url2 = $_POST['url1'].'/'.$_POST['url2']; 
		 // $url = $this->uri->segment(1); 
		$html = '
    <script src="'.base_url().'/assets/js/Section/Menubar.js"></script>
    <script src="'.base_url() .'/assets/js/Site.js"></script>
    <script>
    	(function(document, window, $){
    	  "use strict";
    	
    	  var Site = window.Site;
    	  $(document).ready(function(){
    	    Site.run();
    	  });
    	})(document, window, jQuery);
    </script>
    <div class="site-menubar">

		<ul class="site-menu">
		';


			$menu_parent = 0;
			// $menu = $this->db->where('menu_parent', 0)->where('id_menu !=', 11)->get('pmpu_menu')->result_array();
			$menu = $this->M_Main->get_menu($id_jabatan,0,1);

			for ( $i = 0 ; $i < count($menu) ; $i++ )
			{

				/* BEGIN MENU */
				if($menu[$i]['url_menu']==$url)
				{
					$li_active = 'active';
					if($menu[$i]['url_menu']=="" || $menu[$i]['mempunyai_link']==0){
						$has_sub ='site-menu-item has-sub';
						$atr = '<span class="site-menu-arrow"></span>';
					$link_menu = 'javascript:void(0)';
					}
					else{
						$has_sub ='site-menu-item';
						$atr = '';
						$link_menu = base_url().$menu[$i]['url_menu'];
					}
				}
				else
				{
					$li_active = '';
					if($menu[$i]['url_menu']=="dashboard" || $menu[$i]['mempunyai_link']==1){
					$atr = '';
					$has_sub ='site-menu-item';
					$link_menu = base_url().$menu[$i]['url_menu'];
					}else{
					$atr = '<span class="site-menu-arrow"></span>';
					$has_sub ='site-menu-item has-sub';
					$link_menu = 'javascript:void(0)';
					}
				}
				$submenu = $this->M_Main->get_menu($id_jabatan,$menu[$i]['id_menu'],2);

				


				$html .= '
				<li class="'.$li_active.' '.$has_sub.'">
				  <a href="'.$link_menu.'">
				          <i class="site-menu-icon fa fa-'.$menu[$i]['ikon_menu'].'" aria-hidden="true"></i>
				          <span class="site-menu-title">'.$menu[$i]['nama_menu'].'</span>
				                 '.$atr.'
				      </a>
				';
	            
	            /* BEGIN SUB MENU */
				if ( count($submenu) > 0 )
	            	$html .= '<ul class="site-menu-sub">';

				for ( $j = 0 ; $j < count($submenu) ; $j++ )
				{

						$attr = 'site-menu-item';
					if ($submenu[$j]['url_menu']==$url2 && $menu[$i]['url_menu'] == $url) {
						$li_active2 = 'active';
					}else{
						$li_active2 = '';
					}
					$link = base_url().$submenu[$j]['url_menu'];
					$html .= '

							<li class="'.$li_active2.' '.$attr.'">
							  <a class="animsition-link" href="'.$link.'">
							    <span class="site-menu-title">'.$submenu[$j]['nama_menu'].'</span>
							  </a>
						';



					

				$html .= '</li>';
				}

				if ( count($submenu) > 0 )
	            	$html .= '</ul>';
	            /* END SUB MENU */

				$html .= '</li>';
				/* END MENU */
			}
	            	$html .= '</ul></div>';

			echo ($html);
		
	}
}