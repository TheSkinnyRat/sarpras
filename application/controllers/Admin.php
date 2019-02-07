<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends PX_Controller {
	public function __construct() {
			parent::__construct();
		}

	public function index(){
		if($this->session->userdata('petugas') != FALSE){
			redirect('admin/dashboard');
		}
		else
			redirect('admin/login');
	}

	function login(){
		if($this->session->userdata('petugas') != FALSE){
			redirect('admin/dashboard');
		}
		else
			$this->load->view('backend/admin/login');
	}

	function dashboard(){
		$data['userdata'] = $this->session_petugas;
		if($this->session->userdata('petugas') == FALSE){
			redirect('admin');
		}
		else
		$jml_barang = $this->model_basic->select_all('tbl_barang');
		$jml_peminjam = $this->model_basic->select_all('tbl_peminjam');
		$jml_pinjam = $this->model_basic->select_all('tbl_pinjam');
		$ttl_barang = 0;
		foreach ($jml_barang as $stock) {
			$ttl_barang += $stock->stock;
		}
		$ttl_pinjam = 0;
		foreach ($jml_pinjam as $jml) {
			$ttl_pinjam += $jml->jml;
		}

		$data['jml_barang'] = count($jml_barang);
		$data['jml_peminjam'] = count($jml_peminjam);
		$data['ttl_barang'] = $ttl_barang;
		$data['ttl_pinjam'] = $ttl_pinjam;
		$data['content'] = $this->load->view('backend/admin/dashboard',$data,true);
		$this->load->view('backend/index',$data);
	}

	function do_login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user_data = $this->model_basic->select_where('tbl_petugas','username',$username)->row();
		if($user_data){
			if($this->encrypt->decode($user_data->password) == $password){
				$data_user = array(
					'id_petugas' => $user_data->id_petugas,
					'username' => $user_data->username,
					'password' => $password,
					'name' => $user_data->name,
					'email' => $user_data->email,
					'photo' => $user_data->photo
					);
				$this->session->set_userdata('petugas',$data_user);
				$this->returnJson(array('status' => 'ok','msg' => 'Login berhasil, anda akan di alihkan.','redirect' => 'dashboard'));
			}
			else
				$this->returnJson(array('status' => 'error','msg' => 'Login gagal, password anda salah.'));
		}
		else
			$this->returnJson(array('status' => 'error','msg' => 'Login gagal, username tidak terdaftar.'));
	}

	function do_logout() {
		if($this->session->userdata('petugas') != FALSE){
			$this->session->unset_userdata('petugas');
			redirect('home');
		}
		else
			redirect('home');
	}


}
