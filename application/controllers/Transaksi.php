<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Transaksi extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');
		
		if($this->session->userdata('status') != "Login"){
			redirect(base_url("login"));
		}
	}
    
	function index(){
		$data = $this->M_CallSQL->sessdata();  
        $data['barang'] = $this->db->get("tm_barang")->result();
        $view = array(
                    $this->load->view('template/v_header', $data),
                    $this->load->view('content/transaksi/v_transaksi1', $data),
                    $this->load->view('template/v_footer')
                );
        return $view;
	}

    function getbarang($id){
        $barang = $this->M_CallSQL->where("tm_barang", array('b_id' => $id))->row();

        if ($barang) {

            if ($barang->b_stok == '0') {
                $disabled = 'disabled';
                $info_stok = '<span class="help-block badge" id="reset" 
                              style="background-color: #d9534f;">
                              stok habis</span>';
            }else{
                $disabled = '';
                $info_stok = '<span class="help-block badge" id="reset" 
                              style="background-color: #5cb85c;">stok : '
                              .$barang->b_stok.'</span>';
            }

            // echo '<div class="form-group">
            //             <label class="control-label col-md-3" style="text-align: left;"
            //               for="nama_barang">Nama Barang :</label>
            //             <div class="col-md-6">
            //               <input type="text" class="form-control reset" 
            //                 name="nama_barang" id="nama_barang" 
            //                 value="'.$barang->b_nama.'"
            //                 readonly="readonly">
            //             </div>
            //           </div>
            //           <div class="form-group">
            //             <label class="control-label col-md-3" style="text-align: left;"
            //               for="harga_barang">Harga (Rp) :</label>
            //             <div class="col-md-6">
            //               <input type="text" class="form-control reset" 
            //                 name="harga_barang" id="harga_barang"
            //                 value="'.number_format( $barang->b_harga, 0 ,
            //                  '' , '.' ).'" 
            //                 readonly="readonly">
            //             </div>
            //           </div>
            //           <div class="form-group">
            //             <label class="control-label col-md-3" style="text-align: left;"
            //               for="qty">Quantity :</label>
            //             <div class="col-md-6">
            //               <input type="number" class="form-control reset" 
            //                 autocomplete="off" onchange="subTotal(this.value)" 
            //                 onkeyup="subTotal(this.value)" id="qty" min="0"
            //                 max="'.$barang->b_stok.'" '.$disabled.' 
            //                 name="qty" placeholder="Isi qty...">
            //             </div>'.$info_stok.'
            //           </div>';
            echo '<div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Nama Barang</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-edit"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control reset" 
                                    name="nama_barang" id="nama_barang" value="'.$barang->b_nama.'"
                                    readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Harga (Rp)</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-dollar"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control reset" value="'.number_format( $barang->b_harga, 0 ,
                              '' , '.' ).'" name="harga_barang" id="harga_barang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Quantity</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-edit"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="number" class="form-control reset" 
                                                autocomplete="off" onchange="subTotal(this.value)" 
                                                onkeyup="subTotal(this.value)" id="qty" min="0"
                                                max="'.$barang->b_stok.'" '.$disabled.' 
                                                name="qty" placeholder="Isi qty...">
                                        </div>'.$info_stok.'
                                    </div>
                                </div>
                            </div>';
        }else{

            echo '<div class="form-group">
                        <label class="control-label col-md-3" style="text-align: left;"
                          for="nama_barang">Nama Barang :</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control reset" 
                            name="nama_barang" id="nama_barang" 
                            readonly="readonly">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" style="text-align: left;"
                          for="harga_barang">Harga (Rp) :</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control reset" 
                            name="harga_barang" id="harga_barang" 
                            readonly="readonly">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" style="text-align: left;"
                          for="qty">Quantity :</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control reset" 
                            autocomplete="off" onchange="subTotal(this.value)" 
                            onkeyup="subTotal(this.value)" id="qty" min="0" 
                            name="qty" placeholder="Isi qty...">
                        </div>
                      </div>';
        }
    }

    function ajax_list_transaksi(){

        $data = array();

        $no = 1; 
        
        foreach ($this->cart->contents() as $items){
            
            $row = array();
            $row['nomor'] = $no;
            $row['idbarang'] = $items["id"];
            $row['namabarang'] = $items["name"];
            $row['hargabarang'] = 'Rp. ' . number_format( $items['price'], 
                    0 , '' , '.' ) . ',-';
            $row['qty'] = $items["qty"];
            $row['subtot'] = 'Rp. ' . number_format( $items['subtotal'], 
                    0 , '' , '.' ) . ',-';
            //add html for action
            $row['tombol'] = '<a href="javascript:void()" class="btn btn-danger" onclick="deletebarang('
                    ."'".$items["rowid"]."'".','."'".$items['subtotal'].
                    "'".')"> <i class="fa fa-close"></i> Delete</a>';
            $stok = $this->M_CallSQL->where("tm_barang", array('b_id' => $items["id"]))->row();
            $row['stok'] = $stok->b_stok;
            if($items["qty"] > $stok->b_stok){
                $row['stat'] = 'Lebih';
            }else{
                $row['stat'] = '';
            }
            $data[] = $row;
            $no++;
        }

        $output = array(
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function addbarang()
    {

        $data = array(
                'id' => $this->input->post('id_barang'),
                'name' => $this->input->post('nama_barang'),
                'price' => str_replace('.', '', $this->input->post(
                    'harga_barang')),
                'qty' => $this->input->post('qty')
            );
        $insert = $this->cart->insert($data);
        echo json_encode(array("status" => TRUE));
    }

    function deletebarang($rowid) 
    {

        $this->cart->update(array(
                'rowid'=>$rowid,
                'qty'=>0,));
        echo json_encode(array("status" => TRUE));
    }

    function insertTransaksi(){
            $total = $this->cart->total();
            $bayar = $this->input->post('bayar1');
            $kembali = $bayar - $total;
        if(!$this->cart->contents()){
            $this->session->set_flashdata('gagal_tambah', 'Transaksi gagal');
            redirect(base_url('transaksi'));
        }
        else if($bayar<$total){
            $this->session->set_flashdata('gagal_tambah', 'Jumlah bayar kurang dari total harga');
            redirect(base_url('transaksi'));
        }else{
            $cek = 0;
            foreach ($this->cart->contents() as $items){
                $row = array();
                $row['qty'] = $items["qty"];
                $stok = $this->M_CallSQL->where("tm_barang", array('b_id' => $items["id"]))->row();
                $row['stok'] = $stok->b_stok;
                if($items["qty"] > $stok->b_stok){
                    $cek = 1;
                    break;
                }
            }
            if($cek == 1){
                $this->session->set_flashdata('gagal_tambah', 'Quantitas melebihi stok barang');
                redirect(base_url('transaksi'));
            }else{
                $transaksi = array(
                                    't_tanggal' => date('Y-m-d H:i:s'),
                                    't_jumlah' => $total,
                                    't_bayar' => $bayar,
                                    't_kembali' => $kembali,
                                    't_jenis'   => 'Penjualan'
                                );
                $this->M_CallSQL->input_data($transaksi, "tm_transaksi");
                $Qidd = $this->db->insert_id();
                foreach ($this->cart->contents() as $items){
                $stok = $this->M_CallSQL->where("tm_barang", array('b_id' => $items["id"]))->row();
                $penjualan = array(
                                't_id' => $Qidd,
                                'b_id' => $items["id"],
                                'p_jumlah' => $items["qty"],
                                'p_harga' => $items['subtotal'],
                                );
                $updatestok = array(
                                'b_stok' => $stok->b_stok - $items["qty"],
                                );
                $this->M_CallSQL->input_data($penjualan, "tm_penjualan");
                $this->M_CallSQL->update_data(array('b_id' => $items["id"]) , $updatestok, "tm_barang" );
                }
                $this->cart->destroy();
                $this->session->set_flashdata('berhasil_tambah', 'transaksi sukses');
                redirect(base_url('transaksi'));
            }
        }
    }

}