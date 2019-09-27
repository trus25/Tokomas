<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dokumen
        <small>Data Dokumen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dokumen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if ($this->session->flashdata('nouser')) { ?>
    <div class="form-group">
      <div class="alert alert-danger alert-primary alert-block">
      <?php echo $this->session->flashdata('nouser') ?>
      </div>
    </div>
    <?php } ?>
    <?php if ($this->session->flashdata('gagal_tambah')) { ?>
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
    <?php } ?>
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Barang</h3>
			               <a href="<?php echo base_url('dokumen/add');?>"><button type="button" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i> Tambah Barang</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table_barang" class="table table-bordered table-striped table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th style="text-align: center">No.</th>
                  <th style="text-align: center">ID Barang</th>
                  <th style="text-align: center">Nama Barang</th>
                  <th style="text-align: center">Stok Barang</th>
                  <th style="text-align: center">Harga Barang</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
                <tbody>
                </tbody>
                </thead>
              </table>
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

