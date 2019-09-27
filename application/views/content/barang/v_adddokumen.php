<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dokumen
        <small>List Dokumen</small>
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
              <h3 class="box-title">Form Input Dokumen</h3>
              <a href="<?php echo base_url('dokumen');?>"><button type="button" class="btn btn-md btn-primary" style="float: right;">Kembali</button></a>
                <!-- Modal Dokumen -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="<?php echo base_url('dokumen/add') ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-8 form-horizontal">
                    <div class="form-group">
                      <label class="col-md-3 control-label" style="text-align: left;">Tanggal</label>
                      <div class="col-md-3">
                        <input type="date" class="form-control bradius" name="date" required="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" style="text-align: left;">Nomor Bukti Kas</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control bradius" name="nomor" required="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" style="text-align: left;">Invoice</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control bradius" name="invoice">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Dibayar Kepada</label>
                        <div class="col-md-9"><input type="text" class="form-control bradius" name="bkepada"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">No. Faktur Pajak</label>
                        <div class="col-md-9"><input type="text" class="form-control bradius" name="nfpajak"></div>
                    </div>

                    <input type="hidden" id="count" name="count" value="0">
                  </div>
                  <div class="col-md-3">
                    <div>
                      <label style="font-size: 120%;">Kelengkapan :</label>
                    </div>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="kontrak" value="1"><span class="checkmark"></span>Kontrak/SP3/SPK/PB/KPesan</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="kuitansi" value="1"><span class="checkmark"></span>Kuitansi/Faktur/Nota</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="bast" value="1"><span class="checkmark"></span>BAST/BAOP/BAPP</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="faktur" value="1"><span class="checkmark"></span>Faktur Pajak</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="ssp" value="1"><span class="checkmark"></span>Surat Setoran Pajak(SSP)</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="pph" value="1"><span class="checkmark"></span>Bukti Pemotongan PPh</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="bap" value="1"><span class="checkmark"></span>BAP</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="lkembali" value="1"><span class="checkmark"></span>Lembar Kendali</label>
                    <label class="customcheck" style="font-weight: normal;"><input type="checkbox" name="lain" value="1"><span class="checkmark"></span>Lain-lain</label>

                    <br>
                    <div class="form-group">
                      <label>Upload Dokumen (hanya .pdf): </label>
                      <input class="form-control-file" type="file" name="berkas" />
                    </div>
                    <br>
                  </div>
                  <div class="col-md-1">
                  </div>
                </div>
                <!-- /.row -->
                <div class="row mt-10">
                  <div class="col-md-12 form-group">
                    <br>
                    <table class="table table-bordered table-striped order-list">
                      <thead>
                        <tr>  
                          <th class="col-md-1" style="text-align:center; vertical-align: middle;">No</th>
                          <th class="col-md-4" style="text-align:center; vertical-align: middle;">Uraian</th>
                          <th class="col-md-1" style="text-align:center; vertical-align: middle;">SPK/SPP</th>
                          <th class="col-md-1" style="text-align:center; vertical-align: middle;">Kode Nasabah</th>
                          <th class="col-md-1" style="text-align:center; vertical-align: middle;">Debet No. Perkiraan</th>
                          <th class="col-md-3" style="text-align:center; vertical-align: middle;">Rupiah</th>
                          <th class="col-md-1 borderless"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align: center; vertical-align: middle;">1</td>
                          <td><input type="text" class="form-control bradius" name="uraian0"></td>
                          <td><input type="text" style="text-align: center;" class="form-control bradius" name="spp0"></td>
                          <td><input type="text" style="text-align: center;" class="form-control bradius" name="kodenas0"></td>
                          <td><input type="text" style="text-align: center;" class="form-control bradius" name="dnp0"></td>
                          <td class="input-group"><span class="input-group-addon">Rp. </span><input type="text" style="text-align: right;" class="form-control bradius number" id="rupiah0" name="rupiah0" onblur="calculateForm();" value="0"></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td style="text-align: right; vertical-align: middle; font-weight: bold;" colspan="5">
                            Total
                          </td>
                          <td class="input-group" colspan="1">
                            <span class="input-group-addon">Rp. </span><input type="text" style="text-align: right; font-weight: bold; background-color:#FFF !important;" class="form-control bradius" id="total" name="total" readonly>
                          </td>
                        </tr>
                        <tr>
                          <td class="borderless" colspan="6">
                            <input type="button" class="btn btn-lg btn-block btn-success" id="addrow" value="Tambah Baris" />
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <br>
                <br>
                <!-- /.row -->
                <input type="Submit" class="btn btn-primary btn-lg" style="float:Right;" value="Submit" />
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
