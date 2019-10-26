<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Barang extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');
		if($this->session->userdata('status') != "Login"){
			redirect(base_url("login"));
		}
	}
 
	function index(){
		$data = $this->M_CallSQL->sessdata();
		
		$view = array(
			$this->load->view('template/v_header', $data),
			$this->load->view('content/barang/v_barang1', $data),
			$this->load->view('template/v_footer', $data)
		);
		
		return $view;
	}

	function get_data_barang()
    {
    	$data = array();
    	$no = 1;
        $list = $this->db->get_where("tm_barang")->result();
        foreach ($list as $field) {
            $row = array();
            $row[] = $no;
            $row[] = $field->b_id;
            $row[] = $field->b_nama;
            $row[] = $field->b_stok;
            $row[] = 'Rp. ' . number_format( $field->b_harga, 
                    0 , '' , '.' ) . ',-';
            $row[] = '<center><span><a href="Barang/edit/'.$field->b_id.'" class="btn btn-default" style="text-align:center;"><i class="fa fa-edit"></i> Edit</a> <a href="Barang/delete/'.$field->b_id.'" class="btn btn-default" style="text-align:center;"><i class="fa  fa-trash-o"></i> Hapus</a></span></center>';
            $data[] = $row;
            $no++;
        }
        $output = array(
            "data" => $data,
        );
        header('Content-Type: application/json');
        echo json_encode($output);
    }

}