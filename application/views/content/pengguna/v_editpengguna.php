<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna
        <small>Form Edit Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengguna</li>
        <li class="active">Form Edit Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if ($this->session->flashdata('pengguna_edit')) { ?>
    <div class="form-group">
      <div class="alert alert-success alert-primary alert-block">
      <?php echo $this->session->flashdata('pengguna_edit') ?>
      </div>
    </div>
    <?php } ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Form Edit Pengguna</h3>
               <a href="<?php echo base_url('pengguna');?>"><button type="button" class="btn btn-md btn-primary" style="float: right;">Kembali</button></a>
                <!-- Modal Dokumen -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <form role="form" method="POST" action="<?php echo base_url('pengguna/edit/'.$pengguna[0]->p_id.'/submit') ?>">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control bradius" value="<?php echo $pengguna[0]->p_username ?>" name="username" required="">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control bradius" value="<?php echo $pengguna[0]->p_password ?>" name="password" required="">
                    </div>
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control bradius" value="<?php echo $pengguna[0]->p_name ?>" name="nama" required="">
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" class="form-control bradius" value="<?php echo $pengguna[0]->p_email ?>" name="email" required="">
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <select class="form-control bradius" name="role" required="">
                      <?php
                      foreach($sql as $row){
                        echo "<option value='$row->r_id'";
                        if($row->r_id==$pengguna[0]->r_id)echo "selected"; 
                        echo ">$row->r_nama</option>";
                      }?>                          
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Wilayah</label>
                      <select class="form-control bradius" name="wilayah" required="">
                      <?php
                      foreach($wil as $wil){
                        echo "<option value='$wil->w_id'";
                        if($wil->w_id==$pengguna[0]->w_id)echo "selected"; 
                        echo ">$wil->w_nama</option>";
                      }?>                          
                      </select>
                    </div>
                    <br>
                    <div class="form-group">
                      <input type="Submit" class="btn btn-primary mt-10 btn-md" style="float:Right;" value="Submit" />
                    </div>
                  </form>
                </div>
                <div class="col-md-4">
              </div>
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

