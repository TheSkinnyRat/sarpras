<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PX_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// DEFAULT TIME ZONE
		date_default_timezone_set('Asia/Jakarta');
		// TABLE
		$this->tbl_prefix = 'px_';
		$this->tbl_about = $this->tbl_prefix.'about';
		// MODELS
		$this->load->model('model_basic');
		// sessions
		if($this->session->userdata('petugas') != FALSE)
			$this->session_petugas = $this->session->userdata('petugas');
		else{
			$this->session_petugas = array(
				'admin_id' => 0,
				'username' => 'GUEST',
				'password' => ' ',
				'realname' => 'GUEST',
				'email' => 'GUEST@LOCAL.DEV',
				'id_usergroup' => 0,
				'name_usergroup' => 'GUEST',
				'photo' => 'THUMB.png'
				);
		}
		if($this->session->userdata('peminjam') != FALSE)
			$this->session_peminjam = $this->session->userdata('peminjam');
		else{
			$this->session_peminjam = FALSE;
		}
	}
	function get_app_settings() {
		$d_row = $this->model_basic->select_all_limit($this->tbl_adm_config,1)->row();
		$c_row = $this->model_basic->select_all_limit($this->tbl_settings,1)->row();
		$guest_book = $this->model_basic->select_where($this->tbl_guest_book,'status',0);
		$data['app_id'] = $d_row->id;
		$data['app_title'] = $d_row->title;
		$data['app_desc'] = $d_row->desc;
		$data['app_login_logo'] = $d_row->login_logo;
		$data['app_mini_logo'] = $d_row->mini_logo;
		$data['app_single_logo'] = $d_row->single_logo;
		$data['app_mini_logo'] = $d_row->mini_logo;
		$data['app_favicon_logo'] = $d_row->favicon_logo;
		$data['app_guest_book_data'] = $guest_book->result();
		$data['app_guest_book_count'] = $guest_book->num_rows();
		$data['app_shortcut_icon'] = $c_row->icon;
		$data['app_judul_web'] = $c_row->title;
		$data['app_judul'] = $c_row->content;
		return $data;
	}
	function get_function($name,$function){
		$data['function_name'] = $name;
		$data['function'] = $function;
		$data['function_form'] = $function.'_form';
		$data['function_add'] = $function.'_add';
		$data['function_edit'] = $function.'_edit';
		$data['function_delete'] = $function.'_delete';
		$data['function_get'] = $function.'_get';
		$menu_id = $this->model_basic->select_where($this->tbl_menu,'target',$function)->row();
		if($menu_id)
			$data['function_id'] = $menu_id->id;
		else
			$data['function_id'] = 0;
		return $data;
	}
	function get_menu()
	{
		$menu = $this->model_menu->get_menu_bar($this->session_admin['id_usergroup']);
		$submenu = $this->model_menu->get_sub_menu($this->session_admin['id_usergroup']);
		$data = array();
		foreach ($menu as $m) {
			$data[$m->id_menu] = $m;
			$m->submenu = array();
		}
		foreach ($submenu as $sm) {
			$data[$sm->id_parent]->submenu[] = $sm;
		}
		$data['menu'] = $data;
		return $data;
	}
	function get_all_menu()
	{
		$menu = $this->model_basic->select_where_order($this->tbl_menu,'id_parent','0','orders','ASC')->result();
		$submenu = $this->model_basic->select_where_order($this->tbl_menu,'id_parent >','0','orders','ASC')->result();
		$data = array();
		foreach ($menu as $m) {
			$data[$m->id] = $m;
			$m->submenu = array();
		}
		foreach ($submenu as $sm) {
			$data[$sm->id_parent]->submenu[] = $sm;
		}
		return $data;
	}
	function check_login_petugas(){
		if($this->session->userdata('petugas') == FALSE){
			redirect('admin');
		}
		else
			return true;
	}
	function check_login_peminjam(){
		if($this->session->userdata('peminjam') == FALSE){
			redirect('member');
		}
		else
			return true;
	}
	function check_userakses($menu_id, $function, $user = 'admin')
	{
		if($user == 'admin')
			$group_id = $this->session_admin['id_usergroup'];
		if($user == 'member')
			$group_id = $this->session->userdata['member']['group_id'];
		$access = $this->model_useraccess->get_useraccess($group_id, $menu_id);
		switch ($function)
		{
			case 1:
				if($access->act_read == 1)
					return TRUE;
				else
					redirect('admin');
				break;
			case 2:
				if($access->act_create == 1)
					return TRUE;
				else
					redirect('admin');
				break;
			case 3:
				if($access->act_update == 1)
					return TRUE;
				else
					redirect('admin');
				break;
			case 4:
				if($access->act_delete == 1)
					return TRUE;
				else
					redirect('admin');
				break;
		}
	}
	function delete_temp($folder){
		if($this->session->userdata($folder) != FALSE){
			$temp_folder = $this->session->userdata($folder);
			$files = glob(FCPATH . "assets/uploads/temp/".$temp_folder."/{,.}*", GLOB_BRACE);
			foreach($files as $file){
				if(is_file($file))
					@unlink($file);
			}
			@rmdir(FCPATH . "assets/uploads/temp/".$temp_folder);
			$this->session->unset_userdata($folder);
		}
	}
	function delete_folder($folder){
		$files = glob(FCPATH . "assets/uploads/".$folder."/{,.}*", GLOB_BRACE);
		foreach($files as $file){
			if(is_file($file))
				@unlink($file);
		}
		@rmdir(FCPATH . "assets/uploads/".$folder);
	}
	function format_log(){
		$log['id_log_type'];
		$log['id_user'];
		$log['desc'];
		$log['date_created'];
	}
	function save_log($data){
		if($this->model_basic->insert_all($this->tbl_logs,$data))
			return true;
		else
			return false;
	}
	function returnJson($msg){
		echo json_encode($msg);
		exit;
	}
	function get_tags($tags,$target,$action){
		$tags = explode(',', $tags);
		$data_insert = array();
		foreach ($tags as $tag) {
			$check = $this->model_basic->select_where($this->tbl_tags,'tags',$tag)->num_rows();
			if($check < 1){
				$data['tags'] = $tag;
				$data[$target] = 1;
				array_push($data_insert, $data);
			}
			else{
				$update = $this->model_basic->update($this->tbl_tags,'tags',$tag,$target,$action);
			}
		}
		if(count($data_insert) > 0){
			$do_insert = $this->model_basic->insert_all_batch($this->tbl_tags,$data_insert);
		}
	}
	function createURL($string){
	    $string = strtolower($string);
	    $string = html_entity_decode($string);
	    $string = str_replace(array('ä','ü','ö','ß'),array('ae','ue','oe','ss'),$string);
	    $string = preg_replace('#[^\w\säüöß]#',null,$string);
	    $string = preg_replace('#[\s]{2,}#',' ',$string);
	    $string = str_replace(array(' '),array('-'),$string);
	    return $string;
	}
}
