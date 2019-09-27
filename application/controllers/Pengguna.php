<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pengguna extends CI_Controller{
 
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
		$data['pengguna'] = $this->db->select("a.*, b.r_nama, b.r_jenis, (SELECT w_nama FROM bk_wilayah WHERE w_id=a.w_id) as w_nama, (SELECT w_kode FROM bk_wilayah WHERE w_id=a.w_id) as w_kode")
									->from("bk_pengguna a")
									->join("bk_role b", "b.r_id=a.r_id");
		$data['pengguna'] = $this->db->get()->result();
		$view = array(
			$this->load->view('template/v_header', $data),
			$this->load->view('content/pengguna/v_pengguna', $data),
			$this->load->view('template/v_footer')
		);
	}

	function add(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$passwd = $this->M_CallSQL->pswd_encode($password);
		$email = $this->input->post('email');
		$role = $this->input->post('role');
		$wilayah = $this->input->post('wilayah');
        $insert = array(
		    'p_username' => $username,
		    'p_password' => $passwd,
		    'p_name' => $nama,
		    'p_email' => $email,
		    'r_id' => $role,
		    'w_id' => $wilayah
		);
		if($nama!=''&&$username!=''&&$password!=''&&$email!=''){
			$check1 = array('p_username' => $username);
			$check = $this->db->get_where("bk_pengguna",$check1)->row();
			if($check){
				$this->session->set_flashdata('pengguna_gagal', 'Silahkan cek kembali pengisian pengguna.');
			} else { 
				$this->M_CallSQL->input_data($insert,'bk_pengguna');
				$this->session->set_flashdata('pengguna_tambah', 'Data pengguna sudah ditambahkan.');
			}
				redirect(base_url('pengguna/add'));			
		} else {
			$data = $this->M_CallSQL->sessdata();
			$data['sql'] = $this->db->get("bk_role")->result();
			$data['wil'] = $this->db->get("bk_wilayah")->result();			
			$view = array(
				$this->load->view('template/v_header', $data),
				$this->load->view('content/pengguna/v_addpengguna', $data),
				$this->load->view('template/v_footer')
			);
		}
	}

	function edit($id, $idx='index'){
		$data = $this->M_CallSQL->sessdata();
		$data['sql'] = $this->db->get("bk_role")->result();
		$data['wil'] = $this->db->get("bk_wilayah")->result();
		$data['pengguna'] = $this->db->select("a.*, b.r_nama")
									->from("bk_pengguna a")
									->join("bk_role b", "b.r_id=a.r_id")
									->where("p_id", $id)->get()->result();
		switch($idx){
			case 'index':
			$check = $this->db->get_where("bk_pengguna",array('p_id' => $id))->row();
			if($check){
				$view = array(
					$this->load->view('template/v_header', $data),
					$this->load->view('content/pengguna/v_editpengguna', $data),
					$this->load->view('template/v_footer')
				);	
			}
			break;

			case 'submit':
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$passwd = $this->M_CallSQL->pswd_encode($password);
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$wilayah = $this->input->post('wilayah');
	        $insert = array(
			    'p_username' => $username,
			    //'p_password' => $passwd,
			    'p_name' => $nama,
			    'p_email' => $email,
			    'r_id' => $role,
		    	'w_id' => $wilayah
			);
	        $insert1 = array(
			    'p_username' => $username,
			    'p_password' => $passwd,
			    'p_name' => $nama,
			    'p_email' => $email,
			    'r_id' => $role,
    		    'w_id' => $wilayah
			);
			if($nama&&$password==$data['pengguna'][0]->p_password){
		        $this->M_CallSQL->update_data(array('p_id' => $id),$insert,"bk_pengguna");
				$this->session->set_flashdata('pengguna_edit', 'Data pengguna sudah diperbarui.');
				redirect(base_url("pengguna/edit/".$id));
			} else if($nama&&$password!=$data['pengguna'][0]->p_password){
		        $this->M_CallSQL->update_data(array('p_id' => $id),$insert1,"bk_pengguna");
				$this->session->set_flashdata('pengguna_edit', 'Data pengguna sudah diperbarui.');
				redirect(base_url("pengguna/edit/".$id));
			} else {
				redirect(base_url("pengguna/edit/".$id));				
			}
			break;
		}
	}
}