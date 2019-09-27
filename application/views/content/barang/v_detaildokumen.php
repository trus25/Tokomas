<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dokumen
        <small>Detail Dokumen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dokumen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
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
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail</h3>
              <a href="<?php echo base_url();?>"><button type="button" class="btn btn-md btn-primary" style="float: right;">Kembali</button></a>
                <!-- Modal Dokumen -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="page-header">
                      <i class="fa fa-book"></i> Detail Dokumen
                      <small id="tgl_bukti" class="pull-right"></small>
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-md-4 invoice-col">
                    <div class="row">
                      <div class="col-md-6">
                        <b>No Bukti Kas</b>
                      </div>
                      <div class="col-md-6">
                        <b>: </b>
                        <span id="no_dok"><?php echo $dokumen[0]->d_nomor ?></span> 
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <b>Dibayar Kepada</b>
                      </div>
                      <div class="col-md-6">
                        <b>: </b>
                        <span id="d_kepada"><?php echo $dokumen[0]->d_kepada ?></span> 
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4 invoice-col">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Invoice</b>
                      </div>
                      <div class="col-md-6">
                        <b>: </b>
                        <span id="kredit_np"><?php echo $dokumen[0]->d_invoice ?></span> 
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <b>Nomor Faktur Pajak</b>
                      </div>
                      <div class="col-md-6">
                        <b>: </b>
                        <span id="nomor_fp"><?php echo $dokumen[0]->d_faktor_pajak ?></span> 
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4 invoice-col">
                    <div class="row">
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-4">
                      <?php 
                        if ($roleid == '1') echo '<span class = "badge bg-green">'.strtoupper($berada[0]->r_nama).'</span>';
                        else if ($roleid == '21' || $roleid == '22' || $roleid == '23') echo '<button class="approved">Submitted</button>';
                        else if($doklog[0]->l_status == 'Accepted'){
                            if($doklog[0]->r_id == '20') echo '<button class="approved">Dibayarkan</button>';
                            else echo '<button class="approved">Approve</button>';
                        } 
                        else if($doklog[0]->l_status == 'Rejected') echo '<button class="rejected">Rejected</button>';
                        else if($doklog[0]->l_status == 'Waiting') echo '<button class="waiting">Waiting</button>';
                      ?>
                      </div>
                    </div>
                  </div>  
                </div>
                <!-- /.row -->
                <br>
                <div class="row">
                  <!-- <div class="col-md-4"> -->
                  <?php
                    if($cek[0]->c_kontrak == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="kontrak" checked disabled><span class="checkmark"></span>Kontrak/SP3/SPK/PB/KPesan</label>
                    </div>';
                    if($cek[0]->c_kuitansi == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="kuitansi" checked disabled><span class="checkmark"></span>Kuitansi/Faktur/Nota</label>
                    </div>';
                    if($cek[0]->c_bast == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="bast" checked disabled><span class="checkmark"></span>BAST/BAOP/BAPP</label>
                    </div>';
                    if($cek[0]->c_faktur == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="faktur" checked disabled><span class="checkmark"></span>Faktur Pajak</label>
                    </div>';
                    if($cek[0]->c_spp == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="ssp" checked disabled><span class="checkmark"></span>Surat Setoran Pajak(SSP)</label>
                    </div>';
                    if($cek[0]->c_bukti_pph == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="pph"checked disabled><span class="checkmark"></span>Bukti Pemotongan PPh</label>
                    </div>';
                    if($cek[0]->c_bap == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="bap" checked disabled><span class="checkmark"></span>BAP</label>
                    </div>';
                    if($cek[0]->c_l_kembali == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="lkembali" checked disabled><span class="checkmark"></span>Lembar Kendali</label>
                    </div>';
                    if($cek[0]->c_lain == '1') 
                    echo '
                    <div class="col-md-3">
                      <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="lain" checked disabled><span class="checkmark"></span>Lain-lain</label>
                    </div>';
                  ?>
                </div>
                <br>
                <!-- Table row -->
                <div class="row">   
                  <div class="col-md-12 table-responsive">
                    <table id="uraian" class="table table-striped">
                      <thead>
                      <tr>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">No</th>
                        <th class="col-md-5" style="text-align:center; vertical-align: middle;">Uraian</th>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">SPK/SPP</th>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">Kode Nasabah</th>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">Debet No. Perkiraan</th>
                        <th class="col-md-3" style="text-align:center; vertical-align: middle;">Rupiah</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $no=0;
                      foreach($dokuraian as $dok){
                        $no++;
                      echo "
                      <tr>
                        <td style='text-align: center; vertical-align: middle;'>$no</td>
                        <td style='text-align: left; vertical-align: middle;'>$dok->u_uraian</td>
                        <td style='text-align: center; vertical-align: middle;'>$dok->u_spkspp</td>
                        <td style='text-align: center; vertical-align: middle;'>$dok->u_kode_nasabah</td>
                        <td style='text-align: center; vertical-align: middle;'>$dok->u_debet</td>
                        <td style='text-align: right; vertical-align: middle;'><span>Rp. </span>";
                        echo number_format($dok->u_rupiah , 0, ',', '.')."</td>
                      </tr>
                      ";
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-md-8">
                  </div>
                  <div class="col-md-4 table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th class="col-xs-6" style="text-align: right;">Total:</th>
                          <td class="col-xs-6" style="text-align: right;" id="totalharga"><span>Rp. </span><?php echo number_format($total[0]->u_rupiah , 0, ',', '.'); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-md-10">
                  </div>
                  <div class="col-md-2">
                    <?php 
                    if($dokumen[0]->d_status_role == $roleid && $dokumen[0]->d_status != "1"){
                      if($doklog[0]->l_status != "Rejected" && $roleid != "2" && $roleid != "7" && !($roleid == "12" && $dokumen[0]->d_jdok=="Pusat")){
                    ?>
                    <table>
                      <tr>
                        <?php if($roleid == "20"){?>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-approve" class="btn btn-md btn-primary" style="float: right;">Bayarkan</button>
                            </div>
                          </th>
                        <?php } else if($roleid == "12"){?>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-dokkon-reject" class="btn btn-md btn-danger" style="float: right;">Reject</button>
                            </div>
                          </th>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-dokkon-approve" class="btn btn-md btn-primary" style="float: right;">Approve</button>
                            </div>
                          </th>
                        <?php }else if($roleid == "14"){ ?>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-reject" class="btn btn-md btn-danger" style="float: right;">Reject</button>
                            </div>
                          </th>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-pajak" class="btn btn-md btn-primary" style="float: right;">Approve</button>
                            </div>
                          </th>
                        <?php }else{?>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-reject" class="btn btn-md btn-danger" style="float: right;">Reject</button>
                            </div>
                          </th>
                          <th>
                            <div class="col-md-6">
                              <button type="button" data-toggle="modal" data-target="#modal-approve" class="btn btn-md btn-primary" style="float: right;">Approve</button>
                            </div>
                          </th>
                        <?php } ?>
                      </tr>
                    </table>
                    <?php } else { ?>
                    <table>
                      <tr>
                        <th>
                          <div class="col-md-12">
                            <?php if($roleid == "12"){?>
                              <th>
                                <div class="col-md-6">
                                  <button type="button" data-toggle="modal" data-target="#modal-dokkon-approve" class="btn btn-md btn-primary" style="float: right;">Approve</button>
                                </div>
                              </th>
                            <?php }else if($roleid == "14"){ ?>  
                              <th>
                                <div class="col-md-6">
                                  <button type="button" data-toggle="modal" data-target="#modal-pajak" class="btn btn-md btn-primary" style="float: right;">Approve</button>
                                </div>
                              </th>
                            <?php }else{?>
                                <div class="col-md-6">
                                  <button type="button" data-toggle="modal" data-target="#modal-approve" class="btn btn-md btn-primary" style="float: right;">Approve</button>
                                </div>
                              </th>
                            <?php } ?>
                          </div>
                        </th>
                      </tr>
                    </table>
                    <?php } 
                      }?>
                  </div>
                </div>
                <!-- /.row -->
              </section>
              <section class="invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="page-header">
                      Rincian Riwayat Dokumen
                      <small id="tgl_bukti" class="pull-right"></small>
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>
              <section>
                <div class="row">   
                  <div class="col-md-12 table-responsive">
                    <table id="uraian" class="table table-striped">
                      <thead>
                      <tr>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">No</th>
                        <th class="col-md-5" style="text-align:center; vertical-align: middle;">Tanggal</th>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">Jabatan</th>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">Status</th>
                        <th class="col-md-1" style="text-align:center; vertical-align: middle;">Keterangan</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $no=0;
                      foreach($history as $log){
                        $no++;
                      echo "
                      <tr>
                        <td style='text-align: center; vertical-align: middle;'>$no</td>
                        <td style='text-align: left; vertical-align: middle;'>$log->h_tgl</td>
                        <td style='text-align: center; vertical-align: middle;'>$log->h_jabatan</td>
                        <td style='text-align: center; vertical-align: middle;'>$log->h_status</td>
                        <td style='text-align: center; vertical-align: middle;'>$log->h_ket</td>
                      </tr>
                      ";
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>      
              </section>
            </section>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>

  <div class="modal fade" id="modal-approve">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Confirmation</h4>
          <p class="modal-content">Apakah anda yakin menyetujui dokumen ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <a href="<?php echo base_url('dokumen/approve/'.$dokumen[0]->d_id);?>"><button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-md btn-primary" style="float: right;">Yes</button></a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-reject">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reject Confirmation</h4>
          <p>Apakah anda yakin mengembalikan dokumen ini?</p>
          <form action="<?php echo base_url('dokumen/reject/'.$dokumen[0]->d_id);?>" method="POST">
            <div class="form-group">
                <label for="comment">Comment:</label>
              <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <input type="submit" data-toggle="modal" data-target="#modal-default" class="btn btn-md btn-primary" style="float: right;" value="Yes">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="modal-dokkon-approve">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Confirmation</h4>
          <br>
          <label>Silahkan pilih pejabat yang ingin dituju:</label>
          <form role="form" method="POST" action="<?php echo base_url('dokumen/approve/'.$dokumen[0]->d_id);?>">
            <select class="form-control form-control-lg" name="role">
              <option value="13">MDAN - Manager Pengadaaan</option>
              <option value="14">PAJAK - Pajak</option>
              <option value="15">SAKT - Staff Akutansi</option>
              <option value="16">KAKT - KASI Akutansi</option>
              <option value="17">KKEU - KASI Keuangan</option>
              <option value="18">MKU - Manager Keuangan</option>
              <option value="19">DIRE - Direksi</option>
            </select>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
            <input type="submit" data-toggle="modal" data-target="#modal-default" class="btn btn-md btn-primary" style="float: right;" value="Yes">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-dokkon-reject">
    <div class="modal-dialog">
      <div class="modal-content">
        <?php if($dokumen[0]->d_jdok == "Proyek"){?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Reject Confirmation</h4>
            <p>Apakah anda yakin mengembalikan dokumen ini?</p>
            <form action="<?php echo base_url('dokumen/reject/'.$dokumen[0]->d_id.'/6');?>" method="POST">
              <div class="form-group">
                  <label for="comment">Comment:</label>
                <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <input type="submit" data-toggle="modal" data-target="#modal-default" class="btn btn-md btn-primary" style="float: right;" value="Yes">
          </div>
            </form>
        <?php }else if($dokumen[0]->d_jdok == "Pabrik"){ ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Reject Confirmation</h4>
            <p>Apakah anda yakin mengembalikan dokumen ini?</p>
            <form action="<?php echo base_url('dokumen/reject/'.$dokumen[0]->d_id.'/11');?>" method="POST">
            <div class="form-group">
                <label for="comment">Comment:</label>
              <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <input type="submit" data-toggle="modal" data-target="#modal-default" class="btn btn-md btn-primary" style="float: right;" value="Yes">
          </div>
          </form>
        <?php } ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-pajak">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Approve Confirmation</h4>
          <p class="modal-content">Silahkan pilih pejabat yang ingin dituju.</p>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
          <a href="<?php echo base_url('dokumen/approve/'.$dokumen[0]->d_id.'/15');?>"><button type="button" data-toggle="modal" data-target="#modal-default" class="btn pull-left btn-md btn-primary" style="float: right;">SAKT</button></a>
          <a href="<?php echo base_url('dokumen/approve/'.$dokumen[0]->d_id.'/16');?>"><button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-md btn-primary" style="float: right;">KAKT</button></a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
