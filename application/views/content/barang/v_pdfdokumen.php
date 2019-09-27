<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo config_item('assets_dist');?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo config_item('assets_dist');?>css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo config_item('assets_plugins');?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo config_item('assets_bower');?>datatables.net-bs/css/dataTables.bootstrap.min.css">
	<style>
	@page { margin: 0px; }
	body { margin: 0px; }
	</style>
</head>
<body>
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header">
          <i class="fa fa-book"></i> Barcode Dokumen
          <small id="tgl_bukti" class="pull-right"></small>
        </h2>
      </div>
      <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-md-4 invoice-col">
          <div class="row">
            <div class="col-md-5"><strong>Nomor Bukti Kas</strong></div>
            <div class="col-md-7">
              <span id="no_dok"><?php echo $dokumen[0]->d_nomor ?></span><br> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <b>Invoice</b>
            </div>
            <div class="col-md-7">
              <span id="kredit_np"><?php echo $dokumen[0]->d_invoice ?></span><br> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <b>Dibayar Kepada</b>
            </div>
            <div class="col-md-7">
              <span id="d_kepada"><?php echo $dokumen[0]->d_kepada ?></span><br> 
            </div>
          </div>
        </div>
        <div class="col-md-4 invoice-col">
          <div class="row">
            <div class="col-md-5">
              <b>Nomor Faktur Pajak</b>
            </div>
            <div class="col-md-7">
              <span id="nomor_fp"><?php echo $dokumen[0]->d_faktor_pajak ?></span><br> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <b>Total</b>
            </div>
            <div class="col-md-7">
              <span id="nomor_fp">Rp. <?php echo number_format($total[0]->u_rupiah , 0, ',', '.'); ?></span><br> 
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-12 invoice-col" style="text-align: right;">
          <img src="./uploads/barcode/<?php echo $dokumen[0]->d_barcode?>">
        </div>
      </div>
    </div>
    <!-- /.row -->
  </section>
</body>
</html>