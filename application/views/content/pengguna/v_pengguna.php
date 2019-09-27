<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna
        <small>Data Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pengguna</h3>
              <a href="<?php echo base_url('pengguna/add');?>"><button type="button" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i> Tambah Pengguna</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="pengguna" class="table table-bordered table-striped table-hover" style="width: 100%">
                <thead>
                <tr>
                  <th style="text-align:center">No</th>
                  <th style="text-align:center">Username</th>
                  <th style="text-align:center">Jabatan</th>
                  <th style="text-align:center">Jenis</th>
                  <th style="text-align:center">Wilayah</th> 
                  <th style="text-align:center">Kode</th>                
                  <th style="text-align:center">Nama</th>
                  <th style="text-align:center">Email</th>
                  <th style="text-align:center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  foreach($pengguna as $pgn){
                  echo '<tr>
                        <td style="text-align:center">No</td>
                        <th>'.$pgn->p_username.'</th>
                        <th>'.$pgn->r_nama.'</th>
                        <th>'.$pgn->r_jenis.'</th>
                        <th>'.$pgn->w_nama.'</th>
                        <th>'.$pgn->w_kode.'</th>
                        <th>'.$pgn->p_name.'</th>
                        <th>'.$pgn->p_email.'</th>
                        <th><center><a href="'.base_url('pengguna/edit/'.$pgn->p_id).'" class="btn btn-primary a-btn-slide-text">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            <span><strong>Edit</strong></span>            
                            </a></center></th>   
                        </tr>';            
                  }
                ?>
                </tbody>
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

