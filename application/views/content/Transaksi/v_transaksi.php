<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penjualan
        <small>Form Penjualan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Penjualan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- <?php if ($this->session->flashdata('gagal_tambah')) { ?>
    <div class="form-group">
      <div class="alert alert-danger alert-primary alert-block">
      <?php echo $this->session->flashdata('gagal_tambah') ?>
      </div>
    </div>
    <?php } ?>
    <?php if ($this->session->flashdata('berhasil_tambah')) { ?>
    <div class="form-group">
      <div class="alert alert-success alert-primary alert-block">
      <?php echo $this->session->flashdata('berhasil_tambah') ?>
      </div>
    </div>
    <?php } ?> -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Form Penjualan</h3>
              <a href="<?php echo base_url('dokumen');?>"><button type="button" class="btn btn-md btn-primary" style="float: right;">Kembali</button></a>
                <!-- Modal Dokumen -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <div class="row">
                  <form class="form-horizontal" action="<?php echo base_url('transaksi/insertTransaksi') ?>" id="form_transaksi" role="form" method="POST" enctype="multipart/form-data">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Id Barang</label>
                          <div class="col-md-6">
                            <input list="list_barang" class="form-control reset" 
                              placeholder="Isi id..." name="id_barang" id="id_barang" 
                              autocomplete="off" onchange="showBarang(this.value)">
                                  <datalist id="list_barang">
                                    <?php foreach ($barang as $bg){ ?>
                                      <option value="<?php echo $bg->b_id ?>"><?php echo $bg->b_nama; ?></option>
                                    <?php } ?>
                                  </datalist>
                          </div>
                        </div>
                        <div id="barang">
                          <div class="form-group">
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
                          </div>
                        <!-- end div id="barang" -->
                        </div>
                            <div class="form-group">
                              <label class="control-label col-md-3" style="text-align: left;"
                                for="sub_total">Sub-Total (Rp):</label>
                              <div class="col-md-6">
                                <input type="text" class="form-control reset"
                                  name="sub_total" id="sub_total" 
                                  readonly="readonly">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-offset-3 col-md-3">
                                  <button type="button" class="btn btn-primary" 
                                  id="tambah" onclick="addbarang()">
                                    <i class="fa fa-cart-plus"></i> Tambah</button>
                              </div>
                            </div>
                        </div><!-- end col-md-8 -->
                </div>
                <!-- /.row -->
                <div class="row">
                  <div class="col-md-12">
                    <br>
                      <table id="table_transaksi" class="table table-striped table-bordered" style="width: 100%;">
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
                </div>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-8">
                  </div>
                  <div class="col-md-4">
                                <div class="form-group">
                                  <label class="control-label col-md-3" style="text-align: left;"
                                for="sub_total">Total (Rp):</label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" 
                                    name="total" id="total" placeholder="0"
                                    readonly="readonly"  value="<?= number_format( 
                                          $this->cart->total(), 0 , '' , '.' ); ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3" style="text-align: left;"
                                for="sub_total">Bayar (Rp) :</label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control uang" 
                                      name="bayar" placeholder="0" autocomplete="off"
                                      id="bayar" onkeyup="showKembali(this.value)">
                                  </div>
                                    <input type="hidden" class="form-control uang" 
                                      name="bayar1"
                                      id="bayar1">
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3" style="text-align: left;"
                                for="sub_total">Kembali (Rp) :</label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" 
                                    name="kembali" id="kembali" placeholder="0"
                                    readonly="readonly">
                                  </div>
                                </div>
                    </div>
                </div>
                <br>
                <br>
                <!-- /.row -->
                <input type="Submit" class="btn btn-primary btn-lg" style="float:right; margin-right: 1%;" value="Submit" />
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
