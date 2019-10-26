<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Login');

		if($this->session->userdata('status') == "Login"){
			redirect(base_url("transaksi"));
		}
	}
 
	function index(){
		$this->load->view('template/v_login');
	}
 
	function submit(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'p_username' => $username,
			'p_password' => $password
			);
			
		$check = $this->M_Login->where("tm_pengguna",$where)->row();

		if($check){
			$role = $this->M_Login->cekrole($check->r_id)->row();
			// $wilayah = $this->db->get_where("bk_wilayah",array('w_id'=> $check->w_id))->row();
			$data_session = array(
					'username' => $username,
					'name' => $check->p_name,					
					'status' => "Login",
					'role' => $role->r_nama,
					'roleid' => $role->r_id,
					// 'tipe' => $role->r_tipe,
					// 'jenis' => $role->r_jenis,
					// 'kodewil' => $wilayah->w_kode,
					// 'namawil' => $wilayah->w_nama
					);
			$this->session->set_userdata($data_session);
			redirect(base_url("dashboard"));
		} else {
			$this->session->set_flashdata('failed_login', 'Username atau Password Salah!');
			redirect(base_url('login'));
		}
	}
}