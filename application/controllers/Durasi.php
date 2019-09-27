<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Durasi extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');
		
		if($this->session->userdata('status') != "Login"){
			redirect(base_url("login"));
		}else if($this->session->userdata('tipe') != "admin"){
			redirect(base_url("dashboard"));
		}
	}
 
	function index(){
		$data = $this->M_CallSQL->sessdata();
		$data['durasiPr'] = $this->db->select("r_id, r_nama, r_durasi")
									->from("bk_role")
									->where("r_jenis", "Proyek")->get()->result();
		$data['durasiPa'] = $this->db->select("r_id, r_nama, r_durasi")
									->from("bk_role")
									->where("r_jenis", "Pabrik")->get()->result();
		$data['durasiPu'] = $this->db->select("r_id, r_nama, r_durasi")
									->from("bk_role")
									->where("r_jenis", "Pusat")->get()->result();
		$view = array(
			$this->load->view('template/v_header', $data),
			$this->load->view('content/durasi/v_durasi', $data),
			$this->load->view('template/v_footer')
		);
	}
	function update($id){
		$durasi = $this->input->post('drs'.$id);
		$this->M_CallSQL->update_data(array('r_id' => $id),array('r_durasi' => $durasi), "bk_role");
		redirect(base_url("durasi"));
	}
}