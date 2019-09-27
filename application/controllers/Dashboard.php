<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');
		
		if($this->session->userdata('status') != "Login"){
			redirect(base_url("login"));
		}
	}
 
	function index(){
		$data = $this->M_CallSQL->sessdata();
		$data['durasi'] = $this->db->get('bk_role')->result();
		$view = array(
			$this->load->view('template/v_header', $data),
			$this->load->view('content/dashboard/v_dashboard', $data),
			$this->load->view('template/v_footer')
		);

		return $view;
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}