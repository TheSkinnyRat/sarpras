<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_system extends PX_Controller {
	public function __construct() {
			parent::__construct();
		}

	public function index(){

	}

	function peminjam(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$data['data'] = $this->model_basic->select_all('tbl_peminjam');
		$data['content'] = $this->load->view('backend/admin_system/peminjam',$data,true);
		$this->load->view('backend/index',$data);
	}

	function peminjam_form(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$id = $this->input->post('id');
		if($id){
		$data['data'] = $this->model_basic->select_where('tbl_peminjam','id_peminjam',$id)->row();
		}else{
		$data['data'] = null;
		}
		$data['content'] = $this->load->view('backend/admin_system/peminjam_form',$data,true);
		$this->load->view('backend/index',$data);
  }

	function peminjam_add(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$table_field = $this->db->list_fields('tbl_peminjam');
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		$insert['password'] = $this->encrypt->encode($insert['password']);
		$check_username = $this->model_basic->select_where('tbl_peminjam','username',$insert['username'])->row();
		if ($check_username != null) {
			$this->returnJson(array('status' => 'error','msg' => 'Username sudah digunakan!'));
		}else{
			if($insert){
				$do_insert = $this->model_basic->insert_all('tbl_peminjam',$insert);
				$this->returnJson(array('status' => 'ok','msg' => 'Insert data berhasil', 'redirect' => 'peminjam'));
			}else{
				$this->returnJson(array('status' => 'error','msg' => 'Periksa kembali form'));
			}
		}
  }

	function peminjam_update(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$table_field = $this->db->list_fields('tbl_peminjam');
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		$update['password'] = $this->encrypt->encode($update['password']);
		$check_username = $this->model_basic->select_where('tbl_peminjam','username',$update['username'])->row();
		if ($check_username != null && $check_username->id_peminjam != $update['id_peminjam']) {
			$this->returnJson(array('status' => 'error','msg' => 'Username sudah digunakan!'));
		}else{
			if($update){
				$do_update = $this->model_basic->update('tbl_peminjam',$update,'id_peminjam',$update['id_peminjam']);
				$this->returnJson(array('status' => 'ok','msg' => 'Update data berhasil', 'redirect' => 'peminjam'));
			}else{
				$this->returnJson(array('status' => 'error','msg' => 'Periksa kembali form'));
			}
		}
  }

	function peminjam_delete(){
    $this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete('tbl_peminjam','id_peminjam',$id);
		if($do_delete){
			redirect('admin_system/peminjam');
		}
		else{

		}
  }

	function barang(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$data['data'] = $this->model_basic->select_all('tbl_barang');
		$data['content'] = $this->load->view('backend/admin_system/barang',$data,true);
		$this->load->view('backend/index',$data);
	}

	function barang_form(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$id = $this->input->post('id');
		if($id){
		$data['data'] = $this->model_basic->select_where('tbl_barang','id_barang',$id)->row();
		}else{
		$data['data'] = null;
		}
		$data['content'] = $this->load->view('backend/admin_system/barang_form',$data,true);
		$this->load->view('backend/index',$data);
  }

	function barang_add(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$table_field = $this->db->list_fields('tbl_barang');
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}
		$check_name = $this->model_basic->select_where('tbl_barang','name',$insert['name'])->row();
		if ($check_name != null) {
			$this->returnJson(array('status' => 'error','msg' => 'Barang sudah ada!'));
		}else{
			if($insert){
				$do_insert = $this->model_basic->insert_all('tbl_barang',$insert);
				$this->returnJson(array('status' => 'ok','msg' => 'Insert data berhasil', 'redirect' => 'barang'));
			}else{
				$this->returnJson(array('status' => 'error','msg' => 'Periksa kembali form'));
			}
		}
  }

	function barang_update(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$table_field = $this->db->list_fields('tbl_barang');
		$update = array();
		foreach ($table_field as $field) {
			$update[$field] = $this->input->post($field);
		}
		$check_name = $this->model_basic->select_where('tbl_barang','name',$update['name'])->row();
		if ($check_name != null && $check_name->id_barang != $update['id_barang']) {
			$this->returnJson(array('status' => 'error','msg' => 'Nama barang sudah digunakan!'));
		}else{
			if($update){
				$do_update = $this->model_basic->update('tbl_barang',$update,'id_barang',$update['id_barang']);
				$this->returnJson(array('status' => 'ok','msg' => 'Update data berhasil', 'redirect' => 'barang'));
			}else{
				$this->returnJson(array('status' => 'error','msg' => 'Periksa kembali form'));
			}
		}
  }

	function barang_delete(){
    $this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$id = $this->input->post('id');
		$do_delete = $this->model_basic->delete('tbl_barang','id_barang',$id);
		if($do_delete){
			redirect('admin_system/barang');
		}
		else{

		}
  }

	function pinjam(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$data['data'] = $this->model_basic->select_where_join_2('tbl_pinjam','tbl_pinjam.*,tbl_barang.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_pinjam.status','0','tbl_barang','tbl_pinjam.id_barang','tbl_barang.id_barang','tbl_peminjam','tbl_pinjam.id_peminjam','tbl_peminjam.id_peminjam')->result();
		$data['content'] = $this->load->view('backend/admin_system/pinjam',$data,true);
		$this->load->view('backend/index',$data);
	}

	function pinjam_setujui(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$id = $this->input->post('id');
		$update['status'] = '1';

		if($update){
			$do_update = $this->model_basic->update('tbl_pinjam',$update,'id_pinjam',$id);
			if($do_update){
				redirect('admin_system/pinjam');
			}
		}
  }

	function pinjam_tolak(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$table_field = $this->db->list_fields('tbl_riwayat');
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}

		$check = $this->model_basic->select_where('tbl_barang','id_barang',$insert['id_barang'])->row();
		if($insert){
			$update['stock'] = $check->stock + $insert['jml'];
			$do_insert = $this->model_basic->insert_all('tbl_riwayat',$insert);
			$do_update = $this->model_basic->update('tbl_barang',$update,'id_barang',$insert['id_barang']);
			$do_delete = $this->model_basic->delete('tbl_pinjam','id_pinjam',$insert['id_pinjam']);
			if($do_insert && $do_delete && $do_update){
				redirect('admin_system/pinjam');
			}
		}
  }

	function kembali(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$data['data'] = $this->model_basic->select_where_join_2('tbl_pinjam','tbl_pinjam.*,tbl_barang.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_pinjam.status','2','tbl_barang','tbl_pinjam.id_barang','tbl_barang.id_barang','tbl_peminjam','tbl_pinjam.id_peminjam','tbl_peminjam.id_peminjam')->result();
		$data['content'] = $this->load->view('backend/admin_system/kembali',$data,true);
		$this->load->view('backend/index',$data);
	}

	function kembali_setujui(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$table_field = $this->db->list_fields('tbl_riwayat');
		$insert = array();
		foreach ($table_field as $field) {
			$insert[$field] = $this->input->post($field);
		}

		$check = $this->model_basic->select_where('tbl_barang','id_barang',$insert['id_barang'])->row();
		if($insert){
			$update['stock'] = $check->stock + $insert['jml'];
			$do_insert = $this->model_basic->insert_all('tbl_riwayat',$insert);
			$do_update = $this->model_basic->update('tbl_barang',$update,'id_barang',$insert['id_barang']);
			$do_delete = $this->model_basic->delete('tbl_pinjam','id_pinjam',$insert['id_pinjam']);
			if($do_insert && $do_delete && $do_update){
				redirect('admin_system/kembali');
			}
		}
  }

	function riwayat(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$data['data'] = $this->model_basic->select_all_join_2('tbl_riwayat','tbl_riwayat.*,tbl_barang.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_barang','tbl_riwayat.id_barang','tbl_barang.id_barang','tbl_peminjam','tbl_riwayat.id_peminjam','tbl_peminjam.id_peminjam');
		$data['content'] = $this->load->view('backend/admin_system/riwayat',$data,true);
		$this->load->view('backend/index',$data);
	}

	function riwayat_clear(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$this->db->empty_table('tbl_riwayat');
		redirect('admin_system/riwayat');
	}

	function laporan_pinjam(){
		$this->check_login_petugas();
		$data['userdata'] = $this->session_petugas;
		$data['data'] = $this->model_basic->select_where_join_2('tbl_pinjam','tbl_pinjam.*,tbl_barang.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_pinjam.status','1','tbl_barang','tbl_pinjam.id_barang','tbl_barang.id_barang','tbl_peminjam','tbl_pinjam.id_peminjam','tbl_peminjam.id_peminjam')->result();
		$data['content'] = $this->load->view('backend/admin_system/laporan_pinjam',$data,true);
		$this->load->view('backend/index',$data);
	}

	// function form_laporan_bulanan(){
	// 	$this->check_login_petugas();
	// 	$data['userdata'] = $this->session_petugas;
	// 	$data['data'] = $this->model_basic->select_all_join_2('tbl_riwayat','tbl_riwayat.*,tbl_barang.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_barang','tbl_riwayat.id_barang','tbl_barang.id_barang','tbl_peminjam','tbl_riwayat.id_peminjam','tbl_peminjam.id_peminjam');
	// 	$data['content'] = $this->load->view('backend/admin_system/form_laporan_bulanan',$data,true);
	// 	$this->load->view('backend/index',$data);
	// }
	//
	// function laporan_bulanan(){
	// 	$this->check_login_petugas();
	// 	$data['userdata'] = $this->session_petugas;
	// 	$bulan = $this->input->post('bulan');
	// 	$tahun = $this->input->post('tahun');
	//
	// 	$data['data'] = $this->model_basic->select_all_join_2('tbl_riwayat','tbl_riwayat.*,tbl_barang.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_barang','tbl_riwayat.id_barang','tbl_barang.id_barang','tbl_peminjam','tbl_riwayat.id_peminjam','tbl_peminjam.id_peminjam');
	// 	$data['content'] = $this->load->view('backend/admin_system/laporan_bulanan',$data,true);
	// 	$this->load->view('backend/index',$data);
	// }


}
