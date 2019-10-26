<!-- Breadcomb area Start-->
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Form Penjualan</h2>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="alert-inner">
                            <div class="alert-list">
                                <?php if ($this->session->flashdata('gagal_tambah')) { ?>
                                <div class="alert alert-danger alert-mg-b-0" role="alert"><?php echo $this->session->flashdata('gagal_tambah') ?>
                                </div>
                                <?php } ?>
                                <?php if ($this->session->flashdata('berhasil_tambah')) { ?>
                                <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('berhasil_tambah') ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="basic-tb-hd">
                            <h2>Barang</h2>
                        </div>
                        <form class="form-horizontal" action="<?php echo base_url('transaksi/insertTransaksi') ?>" id="form_transaksi" role="form" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>ID Barang</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input list="list_barang" class="form-control reset" 
                                          placeholder="Scan barcode..." name="id_barang" id="id_barang" 
                                          autocomplete="off" onchange="showBarang(this.value)">
                                              <datalist id="list_barang">
                                                <?php foreach ($barang as $bg){ ?>
                                                  <option value="<?php echo $bg->b_id ?>"><?php echo $bg->b_nama; ?></option>
                                                <?php } ?>
                                              </datalist>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="barang">
                            <div class="row">
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
                                    name="nama_barang" id="nama_barang" 
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
                                            <input type="text" class="form-control reset" 
                                    name="harga_barang" id="harga_barang">
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
                                    name="qty" placeholder="Isi qty...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="nk-int-mk">
                                    <h2>Sub-Total (Rp):</h2>
                                </div>
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-dollar"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" class="form-control reset"
                                  name="sub_total" id="sub_total" 
                                  readonly="readonly">  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="col-md-offset-8 col-md-12">
                                        <button type="button" class="btn btn-primary" 
                                        id="tambah" onclick="addbarang()">
                                        <i class="fa fa-cart-plus"></i> Tambah</button>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>Daftar Belanja</h2>
                            <p></p>
                        </div>
                        <div class="table-responsive">
                            <table id="table_transaksi" class="table table-striped" style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Sub-Total</th>
                                    <th>Stok Tersedia</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mg-t-30">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="nk-int-mk">
                                        <h2>Total (Rp):</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-dollar"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" 
                                    name="total" id="total" placeholder="0"
                                    readonly="readonly"  value="<?= number_format( 
                                          $this->cart->total(), 0 , '' , '.' ); ?>">  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mg-t-30">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="nk-int-mk">
                                        <h2>Jumlah Bayar (Rp):</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-dollar"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control uang" 
                                      name="bayar" placeholder="0" autocomplete="off"
                                      id="bayar" onkeyup="showKembali(this.value)"> 
                                              <input type="hidden" class="form-control uang" 
                                              name="bayar1"
                                              id="bayar1"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mg-t-30">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="nk-int-mk">
                                        <h2>Jumlah Kembali (Rp):</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-dollar"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" 
                                    name="kembali" id="kembali" placeholder="0"
                                    readonly="readonly">  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mg-t-30">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" form="form_transaksi" class="btn btn-success notika-btn-success waves-effect">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Form Element area End-->
