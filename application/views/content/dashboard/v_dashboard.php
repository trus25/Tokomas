<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function datediff($in, $out){
    // Hari libur lainnya ditambahkan secara manual
    $holidays = array('2012-09-07');

    // Jika Diff L_IN > Time Server > r_durasi
    $datePlus = new DateTime($in); 
    $time = new DateTime();
    $intervalCurrent = $datePlus->diff($time)->d;
    $periodCurrent = new DatePeriod($datePlus, new DateInterval('P1D'), $time);

      foreach($periodCurrent as $dt) {
          $curr = $dt->format('D');

          // substract if Saturday or Sunday
          if ($curr == 'Sat' || $curr == 'Sun') {
              $intervalCurrent--;
          }

          // (optional) for the updated question
          elseif (in_array($dt->format('Y-m-d'), $holidays)) {
              $intervalCurrent--;
          }
      }

    // Jika Diff L_IN dan L_OUT > r_durasi
    $dateIn = new DateTime($in);
    $dateOut = new DateTime($out);
    $interval = $dateIn->diff($dateOut)->d;
    $period = new DatePeriod($dateIn, new DateInterval('P1D'), $dateOut);

      foreach($period as $dt) {
          $curr = $dt->format('D');

          // substract if Saturday or Sunday
          if ($curr == 'Sat' || $curr == 'Sun') {
              $interval--;
          }

          // (optional) for the updated question
          elseif (in_array($dt->format('Y-m-d'), $holidays)) {
              $interval--;
          }
      }

    $date['interval'] = $interval;
    $date['intervalcurrent'] = $intervalCurrent;
    return $date;
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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

      <!-- Small boxes (Stat box) -->
<!--       <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        ./col
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div> -->
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <?php
            if($jenis=='Proyek' || $jenis=='Pabrik'){
            echo '<div class="box">';
              echo '<div class="box-header">';
              if($jenis=='Proyek'){
                echo '<h3 class="box-title">Monitoring Buktikas Proyek</h3>';
              }else{
                echo '<h3 class="box-title">Monitoring Buktikas Pabrik</h3>';
              }
            echo '</div>';
            ?>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                  <table id="tableproyek" class="table display table-bordered table-striped table-hover" width="100%">
                    <thead>
                      <tr>
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: center;">No. Bukti Kas</th>
                        <th style="text-align: center;">Dibayar Kepada</th>
                        <th style="text-align: center;">Total Nilai Rupiah</th>
                      <?php
                      if($jenis=='Pabrik'){
                          echo '<th colspan="2" style="text-align: center;">PPPP</th>';
                          echo '<th colspan="2" style="text-align: center;">KP</th>';
                          echo '<th colspan="2"  style="text-align: center;">MPAB</th>';
                          echo '<th colspan="2"  style="text-align: center;">MPPIC</th>';
                          echo '<th colspan="2" style="text-align: center;">MDIV</th>';
                        }

                      if($jenis=='Proyek'){
                          echo '<th colspan="2" style="text-align: center;">PPPP</th>';
                          echo '<th colspan="2" style="text-align: center;">KP</th>';
                          echo '<th colspan="2"  style="text-align: center;">MPROY</th>';
                          echo '<th colspan="2"  style="text-align: center;">MPPIC</th>';
                          echo '<th colspan="2" style="text-align: center;">MDIV</th>';
                        }

                      if($jenis=='Pabrik' || $jenis=='Proyek'){
                        echo '<th colspan="2" style="text-align: center;">DOKKON</th>';
                          echo '<th colspan="2" style="text-align: center;">MDAN</th>';
                          echo '<th colspan="2" style="text-align: center;">PAJAK</th>';
                          echo '<th colspan="2"  style="text-align: center;">SAKT</th>';
                          echo '<th colspan="2"  style="text-align: center;">KAKT</th>';
                          echo '<th colspan="2"  style="text-align: center;">KKEU</th>';
                          echo '<th colspan="2" style="text-align: center;">MKU</th>';
                          echo '<th colspan="2" style="text-align: center;">DIREKSI</th>';
                          echo '<th colspan="2" style="text-align: center;">KASIR</th>';
                      }
                     if($jenis=='Pabrik'){
                      echo '</tr>
                          <tr>
                          <th></th>
                          <th><input type="text" id="searchPaNo1" style="width: 100%;" placeholder="Telusuri"></th>
                          <th><input type="text" id="searchPaDk1" style="width: 100%;" placeholder="Telusuri"></th>
                          <th><input type="text" id="searchPaTot1" style="width: 100%;" placeholder="Telusuri"></th>';
                        }

                      if($jenis=='Proyek'){
                      echo '</tr>
                          <tr>
                          <th></th>
                          <th><input type="text" id="searchPrNo1" style="width: 100%;" placeholder="Telusuri"></th>
                          <th><input type="text" id="searchPrDk1" style="width: 100%;" placeholder="Telusuri"></th>                     
                          <th><input type="text" id="searchPrTot1" style="width: 100%;" placeholder="Telusuri"></th>';
                        }

                  ?>                
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">IN</th>
                  <th style="text-align: center;">OUT</th>
                  <th style="text-align: center;">DIBAYARKAN</th>                  
                </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($log as $lg){
                      if($jenis=='Proyek'){
                        echo '<tr>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><a href="'.base_url('dokumen/detail/'.$lg->iddok).'">'.$lg->nodok.'</a></th>
                            <th>'.$lg->kepada.'</th>
                            <th style="text-align:right;">Rp. '.number_format($lg->total , 0, ',', '.').'</th>';
                      $date = datediff($lg->INP4,$lg->OUTP4);
                      if($lg->P4S=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INP4.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTP4.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[1]->r_durasi){
                        if($date['interval'] > $durasi[1]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INP4.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTP4.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTP4.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTP4.'</span></th>';
                      }
                    
                      $date = datediff($lg->INKP,$lg->OUTKP);
                      if($lg->KPS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INKP.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTKP.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[2]->r_durasi){
                        if($date['interval'] > $durasi[2]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INKP.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTKP.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKP.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKP.'</span></th>';
                      }

                      $date = datediff($lg->INMPROY,$lg->OUTMPROY);
                      if($lg->MPROYS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMPROY.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMPROY.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[3]->r_durasi){
                        if($date['interval'] > $durasi[3]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMPROY.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMPROY.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMPROY.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPROY.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMPROY.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPROY.'</span></th>';
                      }

                      $date = datediff($lg->INMPIC,$lg->OUTMPIC);
                      if($lg->MPICS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMPIC.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMPIC.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[4]->r_durasi){
                        if($date['interval'] > $durasi[4]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMPIC.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMPIC.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPIC.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPIC.'</span></th>';
                      }

                      $date = datediff($lg->INMDIV,$lg->OUTMDIV);
                      if($lg->MDIVS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMDIV.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMDIV.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[5]->r_durasi){
                        if($date['interval'] > $durasi[5]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMDIV.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMDIV.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDIV.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDIV.'</span></th>';
                      }

                      $date = datediff($lg->INDOKKON,$lg->OUTDOKKON);
                      if($lg->DOKKONS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDOKKON.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTDOKKON.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[5]->r_durasi){
                        if($date['interval'] > $durasi[5]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INDOKKON.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTDOKKON.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDOKKON.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDOKKON.'</span></th>';
                      }

                      $date = datediff($lg->INMDAN,$lg->OUTMDAN);
                      if($lg->MDANS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMDAN.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMDAN.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[12]->r_durasi){
                        if($date['interval'] > $durasi[12]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMDAN.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMDAN.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDAN.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDAN.'</span></th>';
                      }

                      $date = datediff($lg->INPJK,$lg->OUTPJK);
                      if($lg->PJKS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INPJK.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTPJK.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[13]->r_durasi){
                        if($date['interval'] > $durasi[13]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INPJK.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTPJK.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTPJK.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTPJK.'</span></th>';
                      }

                      $date = datediff($lg->INSAKT,$lg->OUTSAKT);
                      if($lg->SAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INSAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTSAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[14]->r_durasi){
                        if($date['interval'] > $durasi[14]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INSAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTSAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTSAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTSAKT.'</span></th>';
                      }

                      $date = datediff($lg->INKAKT,$lg->OUTKAKT);
                      if($lg->KAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INKAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTKAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[15]->r_durasi){
                        if($date['interval'] > $durasi[15]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INKAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTKAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKAKT.'</span></th>';
                      }

                      $date = datediff($lg->INKKEU,$lg->OUTKKEU);
                      if($lg->KKEUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INKKEU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTKKEU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[16]->r_durasi){
                        if($date['interval'] > $durasi[16]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INKKEU.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTKKEU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKKEU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKKEU.'</span></th>';
                      }

                      $date = datediff($lg->INMKU,$lg->OUTMKU);
                      if($lg->MKUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMKU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMKU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[17]->r_durasi){
                        if($date['interval'] > $durasi[17]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMKU.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMKU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMKU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMKU.'</span></th>';
                      }

                      $date = datediff($lg->INDIR,$lg->OUTDIR);
                      if($lg->DIRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDIR.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[18]->r_durasi){
                        if($date['interval'] > $durasi[18]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INDIR.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTDIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDIR.'</span></th>';
                      }
                      $date = datediff($lg->INKASIR,$lg->OUTKASIR);
                      if($lg->KASRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[19]->r_durasi){
                        if($date['interval'] > $durasi[19]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->OUTKASIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->OUTKASIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->OUTKASIR.'</span></th>';
                      } 
                        echo '</tr>';
                    }else if($jenis=='Pabrik'){
                        echo '<tr>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><a href="'.base_url('dokumen/detail/'.$lg->iddok).'">'.$lg->nodok.'</a></span></th>
                            <th>'.$lg->kepada.'</th>
                            <th style="text-align:right;">Rp. '.number_format($lg->total , 0, ',', '.').'</th>';
                      $date = datediff($lg->INP4,$lg->OUTP4);
                      if($lg->P4S=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INP4.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTP4.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[1]->r_durasi){
                        if($date['interval'] > $durasi[1]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INP4.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTP4.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTP4.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTP4.'</span></th>';
                      }
                    
                      $date = datediff($lg->INKP,$lg->OUTKP);
                      if($lg->KPS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INKP.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTKP.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[2]->r_durasi){
                        if($date['interval'] > $durasi[2]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INKP.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTKP.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKP.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKP.'</span></th>';
                      }

                      $date = datediff($lg->INMPAB,$lg->OUTMPAB);
                      if($lg->MPABS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMPAB.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMPAB.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[3]->r_durasi){
                        if($date['interval'] > $durasi[3]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMPAB.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMPAB.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMPAB.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPAB.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMPAB.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPAB.'</span></th>';
                      }

                      $date = datediff($lg->INMPIC,$lg->OUTMPIC);
                      if($lg->MPICS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMPIC.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMPIC.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[4]->r_durasi){
                        if($date['interval'] > $durasi[4]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMPIC.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMPIC.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPIC.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMPIC.'</span></th>';
                      }

                      $date = datediff($lg->INMDIV,$lg->OUTMDIV);
                      if($lg->MDIVS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMDIV.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMDIV.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[5]->r_durasi){
                        if($date['interval'] > $durasi[5]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMDIV.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMDIV.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDIV.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDIV.'</span></th>';
                      }

                      $date = datediff($lg->INDOKKON,$lg->OUTDOKKON);
                      if($lg->DOKKONS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDOKKON.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTDOKKON.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[5]->r_durasi){
                        if($date['interval'] > $durasi[5]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INDOKKON.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTDOKKON.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDOKKON.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDOKKON.'</span></th>';
                      }


                      $date = datediff($lg->INMDAN,$lg->OUTMDAN);
                      if($lg->MDANS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMDAN.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMDAN.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[12]->r_durasi){
                        if($date['interval'] > $durasi[12]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMDAN.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMDAN.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDAN.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMDAN.'</span></th>';
                      }

                      $date = datediff($lg->INPJK,$lg->OUTPJK);
                      if($lg->PJKS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INPJK.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTPJK.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[13]->r_durasi){
                        if($date['interval'] > $durasi[13]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INPJK.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTPJK.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTPJK.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTPJK.'</span></th>';
                      }

                      $date = datediff($lg->INSAKT,$lg->OUTSAKT);
                      if($lg->SAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INSAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTSAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[14]->r_durasi){
                        if($date['interval'] > $durasi[14]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INSAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTSAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTSAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTSAKT.'</span></th>';
                      }

                      $date = datediff($lg->INKAKT,$lg->OUTKAKT);
                      if($lg->KAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INKAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTKAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[15]->r_durasi){
                        if($date['interval'] > $durasi[15]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INKAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTKAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKAKT.'</span></th>';
                      }

                      $date = datediff($lg->INKKEU,$lg->OUTKKEU);
                      if($lg->KKEUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INKKEU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTKKEU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[16]->r_durasi){
                        if($date['interval'] > $durasi[16]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INKKEU.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTKKEU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKKEU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTKKEU.'</span></th>';
                      }

                      $date = datediff($lg->INMKU,$lg->OUTMKU);
                      if($lg->MKUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INMKU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTMKU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[17]->r_durasi){
                        if($date['interval'] > $durasi[17]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INMKU.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTMKU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMKU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTMKU.'</span></th>';
                      }

                      $date = datediff($lg->INDIR,$lg->OUTDIR);
                      if($lg->DIRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDIR.'</span></th>
                            <th><span class = "badge bg-yellow">'.$lg->OUTDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[18]->r_durasi){
                        if($date['interval'] > $durasi[18]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->INDIR.'</span></th>
                              <th><span class = "badge bg-red">'.$lg->OUTDIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$lg->OUTDIR.'</span></th>';
                      }
                      $date = datediff($lg->INKASIR,$lg->OUTKASIR);
                      if($lg->KASRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[19]->r_durasi){
                        if($date['interval'] > $durasi[19]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$lg->OUTKASIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$lg->OUTKASIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$lg->OUTKASIR.'</span></th>';
                      }
                        echo '</tr>';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          <!-- /.box -->
          </div>
              <?php 
              }

              if($tipe=='admin' || $jenis=='Pusat'){
              ?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Monitoring Buktikas Proyek</h3>
              </div>
              <div class="box-body">
                <table id="tableproyek" class="table display table-bordered table-striped table-hover" width="100%">
                  <thead>
                    <tr><th style="text-align: center;">No.</th>
                      <th style="text-align: center;">No. Bukti Kas</th>
                      <th style="text-align: center;">Dibayar Kepada</th>
                      <th style="text-align: center;">Kode Wilayah</th>
                      <th style="text-align: center;">Total Nilai Rupiah</th>
                      <th colspan="2" style="text-align: center;">PPPP</th>
                      <th colspan="2" style="text-align: center;">KP</th>
                      <th colspan="2"  style="text-align: center;">MPAB</th>
                      <th colspan="2"  style="text-align: center;">MPPIC</th>
                      <th colspan="2" style="text-align: center;">MDIV</th>
                      <th colspan="2" style="text-align: center;">DOKKON</th>
                      <th colspan="2" style="text-align: center;">MDAN</th>
                      <th colspan="2" style="text-align: center;">PAJAK</th>
                      <th colspan="2"  style="text-align: center;">SAKT</th>
                      <th colspan="2"  style="text-align: center;">KAKT</th>
                      <th colspan="2"  style="text-align: center;">KKEU</th>
                      <th colspan="2" style="text-align: center;">MKU</th>
                      <th colspan="2" style="text-align: center;">DIREKSI</th>
                      <th colspan="2" style="text-align: center;">KASIR</th>             
                    </tr>
                    <tr>
                      <th></th>
                      <th><input type="text" id="searchPrNo" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPrDk" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPrKw" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPrTot" style="width: 100%;" placeholder="Telusuri"></th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">DIBAYARKAN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($logpr as $pr){
                        echo '<tr>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><a href="'.base_url('dokumen/detail/'.$pr->iddok).'">'.$pr->nodok.'</a></th>
                            <th>'.$pr->kepada.'</th>
                            <th>'.$pr->kodewil.'</th>
                            <th style="text-align:right;">Rp. '.number_format($pr->total , 0, ',', '.').'</th>';
                      $date = datediff($pr->INP4,$pr->OUTP4);
                      if($pr->P4S=='1'){
                        if($date['interval'] > $durasi[1]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INP4.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTP4.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTP4.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTP4.'</span></th>';
                      }
                    
                      $date = datediff($pr->INKP,$pr->OUTKP);
                      if($pr->KPS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INKP.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTKP.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[2]->r_durasi){
                        if($date['interval'] > $durasi[2]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INKP.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTKP.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTKP.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTKP.'</span></th>';
                      }

                      $date = datediff($pr->INMPROY,$pr->OUTMPROY);
                      if($pr->MPROYS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INMPROY.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTMPROY.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[3]->r_durasi){
                        if($date['interval'] > $durasi[3]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INMPROY.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTMPROY.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INMPROY.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMPROY.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INMPROY.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMPROY.'</span></th>';
                      }

                      $date = datediff($pr->INMPIC,$pr->OUTMPIC);
                      if($pr->MPICS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INMPIC.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTMPIC.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[4]->r_durasi){
                        if($date['interval'] > $durasi[4]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INMPIC.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTMPIC.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMPIC.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMPIC.'</span></th>';
                      }

                      $date = datediff($pr->INMDIV,$pr->OUTMDIV);
                      if($pr->MDIVS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INMDIV.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTMDIV.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[5]->r_durasi){
                        if($date['interval'] > $durasi[5]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INMDIV.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTMDIV.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMDIV.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMDIV.'</span></th>';
                      }

                      $date = datediff($pr->INDOKKON,$pr->OUTDOKKON);
                      if($pr->DOKKONS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INDOKKON.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTDOKKON.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[11]->r_durasi){
                        if($date['interval'] > $durasi[11]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INDOKKON.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTDOKKON.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTDOKKON.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTDOKKON.'</span></th>';
                      }

                      $date = datediff($pr->INMDAN,$pr->OUTMDAN);
                      if($pr->MDANS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INMDAN.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTMDAN.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[12]->r_durasi){
                        if($date['interval'] > $durasi[12]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INMDAN.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTMDAN.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMDAN.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMDAN.'</span></th>';
                      }

                      $date = datediff($pr->INPJK,$pr->OUTPJK);
                      if($pr->PJKS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INPJK.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTPJK.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[13]->r_durasi){
                        if($date['interval'] > $durasi[13]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INPJK.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTPJK.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTPJK.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTPJK.'</span></th>';
                      }

                      $date = datediff($pr->INSAKT,$pr->OUTSAKT);
                      if($pr->SAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INSAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTSAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[14]->r_durasi){
                        if($date['interval'] > $durasi[14]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INSAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTSAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTSAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTSAKT.'</span></th>';
                      }

                      $date = datediff($pr->INKAKT,$pr->OUTKAKT);
                      if($pr->KAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INKAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTKAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[15]->r_durasi){
                        if($date['interval'] > $durasi[15]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INKAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTKAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTKAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTKAKT.'</span></th>';
                      }

                      $date = datediff($pr->INKKEU,$pr->OUTKKEU);
                      if($pr->KKEUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INKKEU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTKKEU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[16]->r_durasi){
                        if($date['interval'] > $durasi[16]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INKKEU.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTKKEU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTKKEU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTKKEU.'</span></th>';
                      }

                      $date = datediff($pr->INMKU,$pr->OUTMKU);
                      if($pr->MKUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INMKU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTMKU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[17]->r_durasi){
                        if($date['interval'] > $durasi[17]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INMKU.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTMKU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMKU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTMKU.'</span></th>';
                      }

                      $date = datediff($pr->INDIR,$pr->OUTDIR);
                      if($pr->DIRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pr->INDIR.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pr->OUTDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[18]->r_durasi){
                        if($date['interval'] > $durasi[18]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->INDIR.'</span></th>
                              <th><span class = "badge bg-red">'.$pr->OUTDIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTDIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$pr->OUTDIR.'</span></th>';
                      }
                      $date = datediff($pr->INKASIR,$pr->OUTKASIR);
                      if($pr->KASRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$lg->INDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[19]->r_durasi){
                        if($date['interval'] > $durasi[19]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pr->OUTKASIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pr->OUTKASIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pr->OUTKASIR.'</span></th>';
                      }
                        echo '</tr>';
                    }?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Monitoring Buktikas Pabrik</h3>
                </div>
                <div class="box-body">
                  <table id="tablepabrik" class="table display table-bordered table-striped table-hover" width="100%">
                  <thead>
                    <tr>
                      <th style="text-align: center;">No.</th>
                      <th style="text-align: center;">No. Bukti Kas</th>
                      <th style="text-align: center;">Dibayar Kepada</th>
                      <th style="text-align: center;">Kode Wilayah</th>
                      <th style="text-align: center;">Total Nilai Rupiah</th>
                      <th colspan="2" style="text-align: center;">PPPP</th>
                      <th colspan="2" style="text-align: center;">KP</th>
                      <th colspan="2"  style="text-align: center;">MPROY</th>
                      <th colspan="2"  style="text-align: center;">MPPIC</th>
                      <th colspan="2" style="text-align: center;">MDIV</th>
                      <th colspan="2" style="text-align: center;">DOKKON</th>
                      <th colspan="2" style="text-align: center;">MDAN</th>
                      <th colspan="2" style="text-align: center;">PAJAK</th>
                      <th colspan="2"  style="text-align: center;">SAKT</th>
                      <th colspan="2"  style="text-align: center;">KAKT</th>
                      <th colspan="2"  style="text-align: center;">KKEU</th>
                      <th colspan="2" style="text-align: center;">MKU</th>
                      <th colspan="2" style="text-align: center;">DIREKSI</th>
                      <th colspan="2" style="text-align: center;">KASIR</th>                
                    </tr>
                    <tr>
                      <th></th>
                      <th><input type="text" id="searchPaNo" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPaDk" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPaKw" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPaTot" style="width: 100%;" placeholder="Telusuri"></th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">DIBAYARKAN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      foreach($logpa as $pa){
                      echo '<tr>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><a href="'.base_url('dokumen/detail/'.$pa->iddok).'">'.$pa->nodok.'</a></th>
                            <th>'.$pa->kepada.'</th>
                            <th>'.$pa->kodewil.'</th>
                            <th style="text-align:right;">Rp. '.number_format($pa->total , 0, ',', '.').'</th>';
                      $date = datediff($pa->INP4,$pa->OUTP4);
                      if($pa->P4S=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INP4.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTP4.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[1]->r_durasi){
                        if($date['interval'] > $durasi[1]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INP4.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTP4.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTP4.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INP4.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTP4.'</span></th>';
                      }
                    
                      $date = datediff($pa->INKP,$pa->OUTKP);
                      if($pa->KPS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INKP.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTKP.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[2]->r_durasi){
                        if($date['interval'] > $durasi[2]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INKP.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTKP.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTKP.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INKP.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTKP.'</span></th>';
                      }

                      $date = datediff($pa->INMPAB,$pa->OUTMPAB);
                      if($pa->MPABS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INMPAB.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTMPAB.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[3]->r_durasi){
                        if($date['interval'] > $durasi[3]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INMPAB.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTMPAB.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INMPAB.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMPAB.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INMPAB.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMPAB.'</span></th>';
                      }

                      $date = datediff($pa->INMPIC,$pa->OUTMPIC);
                      if($pa->MPICS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INMPIC.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTMPIC.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[4]->r_durasi){
                        if($date['interval'] > $durasi[4]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INMPIC.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTMPIC.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMPIC.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INMPIC.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMPIC.'</span></th>';
                      }

                      $date = datediff($pa->INMDIV,$pa->OUTMDIV);
                      if($pa->MDIVS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INMDIV.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTMDIV.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[5]->r_durasi){
                        if($date['interval'] > $durasi[5]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INMDIV.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTMDIV.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMDIV.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INMDIV.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMDIV.'</span></th>';
                      }

                      $date = datediff($pa->INDOKKON,$pa->OUTDOKKON);
                      if($pa->DOKKONS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INDOKKON.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTDOKKON.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[11]->r_durasi){
                        if($date['interval'] > $durasi[11]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INDOKKON.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTDOKKON.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTDOKKON.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTDOKKON.'</span></th>';
                      }

                      $date = datediff($pa->INMDAN,$pa->OUTMDAN);
                      if($pa->MDANS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INMDAN.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTMDAN.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[12]->r_durasi){
                        if($date['interval'] > $durasi[12]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INMDAN.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTMDAN.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMDAN.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMDAN.'</span></th>';
                      }

                      $date = datediff($pa->INPJK,$pa->OUTPJK);
                      if($pa->PJKS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INPJK.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTPJK.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[13]->r_durasi){
                        if($date['interval'] > $durasi[13]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INPJK.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTPJK.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTPJK.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTPJK.'</span></th>';
                      }

                      $date = datediff($pa->INSAKT,$pa->OUTSAKT);
                      if($pa->SAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INSAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTSAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[14]->r_durasi){
                        if($date['interval'] > $durasi[14]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INSAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTSAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTSAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTSAKT.'</span></th>';
                      }

                      $date = datediff($pa->INKAKT,$pa->OUTKAKT);
                      if($pa->KAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INKAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTKAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[15]->r_durasi){
                        if($date['interval'] > $durasi[15]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INKAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTKAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTKAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTKAKT.'</span></th>';
                      }

                      $date = datediff($pa->INKKEU,$pa->OUTKKEU);
                      if($pa->KKEUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INKKEU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTKKEU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[16]->r_durasi){
                        if($date['interval'] > $durasi[16]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INKKEU.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTKKEU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTKKEU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTKKEU.'</span></th>';
                      }

                      $date = datediff($pa->INMKU,$pa->OUTMKU);
                      if($pa->MKUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INMKU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTMKU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[17]->r_durasi){
                        if($date['interval'] > $durasi[17]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INMKU.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTMKU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMKU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTMKU.'</span></th>';
                      }

                      $date = datediff($pa->INDIR,$pa->OUTDIR);
                      if($pa->DIRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INDIR.'</span></th>
                            <th><span class = "badge bg-yellow">'.$pa->OUTDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[18]->r_durasi){
                        if($date['interval'] > $durasi[18]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->INDIR.'</span></th>
                              <th><span class = "badge bg-red">'.$pa->OUTDIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTDIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$pa->OUTDIR.'</span></th>';
                      }
                      $date = datediff($pa->INKASIR,$pa->OUTKASIR);
                      if($pa->KASRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$pa->INDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[19]->r_durasi){
                        if($date['interval'] > $durasi[19]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$pa->OUTKASIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$pa->OUTKASIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$pa->OUTKASIR.'</span></th>';
                      }                      
                        echo '</tr>';
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Monitoring Buktikas Pusat</h3>
                </div>
                <div class="box-body">
                  <table id="tablepusat" class="table display table-bordered table-striped table-hover" width="100%">
                  <thead>
                    <tr>
                      <th style="text-align: center;">No.</th>
                      <th style="text-align: center;">No. Bukti Kas</th>
                      <th style="text-align: center;">Dibayar Kepada</th>
                      <!-- <th style="text-align: center;">Kode Wilayah</th> -->
                      <th style="text-align: center;">Total Nilai Rupiah</th>
                      <th colspan="2" style="text-align: center;">DOKKON</th>
                      <th colspan="2" style="text-align: center;">MDAN</th>
                      <th colspan="2" style="text-align: center;">PAJAK</th>
                      <th colspan="2"  style="text-align: center;">SAKT</th>
                      <th colspan="2"  style="text-align: center;">KAKT</th>
                      <th colspan="2"  style="text-align: center;">KKEU</th>
                      <th colspan="2" style="text-align: center;">MKU</th>
                      <th colspan="2" style="text-align: center;">DIREKSI</th> 
                      <th colspan="2" style="text-align: center;">KASIR</th>              
                    </tr>
                    <tr>
                      <th></th>
                      <th><input type="text" id="searchPuNo" style="width: 100%;" placeholder="Telusuri"></th>
                      <th><input type="text" id="searchPuDk" style="width: 100%;" placeholder="Telusuri"></th>
                      <!-- <th><input type="text" id="searchPuKw" style="width: 100%;" placeholder="Telusuri"></th> -->
                      <th><input type="text" id="searchPuTot" style="width: 100%;" placeholder="Telusuri"></th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">IN</th>
                      <th style="text-align: center;">OUT</th>
                      <th style="text-align: center;">DIBAYARKAN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      foreach($logps as $ps){
                      echo '<tr>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><a href="'.base_url('dokumen/detail/'.$ps->iddok).'">'.$ps->nodok.'</a></th>
                            <th>'.$ps->kepada.'</th>
                            <th>'.$ps->total.'</th>';
                      $date = datediff($ps->INDOKKON,$ps->OUTDOKKON);
                      if($ps->DOKKONS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INDOKKON.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTDOKKON.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[11]->r_durasi){
                        if($date['interval'] > $durasi[11]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INDOKKON.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTDOKKON.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTDOKKON.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INDOKKON.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTDOKKON.'</span></th>';
                      }

                      $date = datediff($ps->INMDAN,$ps->OUTMDAN);
                      if($ps->MDANS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INMDAN.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTMDAN.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[12]->r_durasi){
                        if($date['interval'] > $durasi[12]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INMDAN.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTMDAN.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTMDAN.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INMDAN.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTMDAN.'</span></th>';
                      }

                      $date = datediff($ps->INPJK,$ps->OUTPJK);
                      if($ps->PJKS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INPJK.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTPJK.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[13]->r_durasi){
                        if($date['interval'] > $durasi[13]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INPJK.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTPJK.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTPJK.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INPJK.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTPJK.'</span></th>';
                      }

                      $date = datediff($ps->INSAKT,$ps->OUTSAKT);
                      if($ps->SAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INSAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTSAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[14]->r_durasi){
                        if($date['interval'] > $durasi[14]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INSAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTSAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTSAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INSAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTSAKT.'</span></th>';
                      }

                      $date = datediff($ps->INKAKT,$ps->OUTKAKT);
                      if($ps->KAKTS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INKAKT.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTKAKT.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[15]->r_durasi){
                        if($date['interval'] > $durasi[15]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INKAKT.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTKAKT.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTKAKT.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INKAKT.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTKAKT.'</span></th>';
                      }

                      $date = datediff($ps->INKKEU,$ps->OUTKKEU);
                      if($ps->KKEUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INKKEU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTKKEU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[16]->r_durasi){
                        if($date['interval'] > $durasi[16]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INKKEU.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTKKEU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTKKEU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INKKEU.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTKKEU.'</span></th>';
                      }

                      $date = datediff($ps->INMKU,$ps->OUTMKU);
                      if($ps->MKUS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INMKU.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTMKU.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[17]->r_durasi){
                        if($date['interval'] > $durasi[17]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INMKU.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTMKU.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTMKU.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INMKU.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTMKU.'</span></th>';
                      }

                      $date = datediff($ps->INDIR,$ps->OUTDIR);
                      if($ps->DIRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INDIR.'</span></th>
                            <th><span class = "badge bg-yellow">'.$ps->OUTDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[18]->r_durasi){
                        if($date['interval'] > $durasi[18]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->INDIR.'</span></th>
                              <th><span class = "badge bg-red">'.$ps->OUTDIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTDIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->INDIR.'</span></th>
                            <th><span class = "badge bg-green">'.$ps->OUTDIR.'</span></th>';
                      }
                      $date = datediff($ps->INKASIR,$ps->OUTKASIR);
                      if($ps->KASRS=='1'){
                            echo '
                            <th><span class = "badge bg-yellow">'.$ps->INDIR.'</span></th>';  
                        } else if($date['intervalcurrent'] > $durasi[19]->r_durasi){
                        if($date['interval'] > $durasi[19]->r_durasi){
                          echo '
                              <th><span class = "badge bg-red">'.$ps->OUTKASIR.'</span></th>';
                        }else{
                            echo '
                            <th><span class = "badge bg-green">'.$ps->OUTKASIR.'</span></th>';  
                        }
                      } else {
                        echo '
                            <th><span class = "badge bg-green">'.$ps->OUTKASIR.'</span></th>';
                      } 
                       echo '</tr>';
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box -->
              <?php 
              }
              ?>    
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

