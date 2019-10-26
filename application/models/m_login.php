<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model{	
	function where($table,$where){		
		return $this->db->get_where($table,$where);
	}

	function pswd_encode($ifpsd){
		$result=md5($ifpsd.'*&@-_#%^.Fhb+}{');
		return $result;
	}
	
	function cekrole($role){
		return $this->db->get_where("tm_role",array('r_id'=> $role));
	}

	function sessdata(){
		$data['username'] = $this->session->userdata('username');
		$data['role'] = $this->session->userdata('role');
		$data['roleid'] = $this->session->userdata('roleid');
		$data['tipe'] = $this->session->userdata('tipe');
		$data['name'] = $this->session->userdata('name');
		$data['jenis'] = $this->session->userdata('jenis');
		$data['kodewil'] = $this->session->userdata('kodewil');	
		$data['namawil'] = $this->session->userdata('namawil');				
		return $data;
	}

	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
}