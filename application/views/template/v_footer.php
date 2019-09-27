<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
   <strong>Copyright &copy; 2019 <b>Wika Industri dan Konstruksi</b>.</strong> All rights reserved.
  </footer>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo config_item('assets_bower');?>jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo config_item('assets_bower');?>jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo config_item('assets_bower');?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo config_item('assets_bower');?>raphael/raphael.min.js"></script>
<script src="<?php echo config_item('assets_bower');?>morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo config_item('assets_bower');?>jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo config_item('assets_plugins');?>jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo config_item('assets_plugins');?>jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo config_item('assets_bower');?>jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo config_item('assets_bower');?>moment/min/moment.min.js"></script>
<script src="<?php echo config_item('assets_bower');?>bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo config_item('assets_bower');?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo config_item('assets_plugins');?>bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo config_item('assets_bower');?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo config_item('assets_bower');?>fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo config_item('assets_dist');?>js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo config_item('assets_dist');?>js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo config_item('assets_dist');?>js/demo.js"></script>

<!-- DataTables -->
<script src="<?php echo config_item('assets_bower');?>datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo config_item('assets_bower');?>datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>

<script>
  function showBarang(str) 
  {

      if (str == "") {
          $('#nama_barang').val('');
          $('#harga_barang').val('');
          $('#qty').val('');
          $('#sub_total').val('');
          $('#reset').hide();
          return;
      } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("barang").innerHTML = 
                xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "<?php echo base_url('transaksi/getBarang') ?>/"+str,true);
        xmlhttp.send();
      }
  }

  function subTotal(qty)
  {

    var harga = $('#harga_barang').val().replace(".", "").replace(".", "");

    $('#sub_total').val(convertToRupiah(harga*qty));
  }

  function convertToRupiah(angka)
  {

      var rupiah = '';    
      var angkarev = angka.toString().split('').reverse().join('');
      
      for(var i = 0; i < angkarev.length; i++) 
        if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      
      return rupiah.split('',rupiah.length-1).reverse().join('');
  
  }
  var table_penjualan;
  $(document).ready(function() {
    table_penjualan = $('#table_transaksi').DataTable( {
        paging: false,
        "info": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables'
        "sScrollX": "100%", 
        // server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= site_url('transaksi/ajax_list_transaksi')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,1,2,3,4,5,6,7,8 ], //last column
          "orderable": false, //set not orderable
        },
        ],
        "columns": [
          { "data": "nomor" },
          { "data": "idbarang" },
          { "data": "namabarang" },
          { "data": "hargabarang" },
          { "data": "qty"},
          { "data": "subtot"},
          { "data": "stok", "visible": false},
          { "data": "stat", "visible": false},
          { "data": "tombol"}
      ],
      "rowCallback": function( row, data, index ) {
          if (data.stat == "Lebih") {
          //Highlight the cell value
          $(row).find('td:eq(4)').css('color', 'red');
          }
        }
    } );
  } );
  var table_barang;
  $(document).ready(function() {
    table = $('#table_barang').DataTable( {
        "orderCellsTop": true,
        "fixedHeader": false,
        "sScrollX": "100%",
        "ajax": {
            "url": "<?= site_url('barang/get_data_barang')?>",
            "type": "POST"
        },
    } );
  } );

  function reload_table()
    {
      table_penjualan.ajax.reload(null,false); //reload datatable ajax 
    }

  function addbarang()
    {
        var id_barang = $('#id_barang').val();
        var qty = $('#qty').val();
        var max = document.getElementById("qty").max;
        if (id_barang == '') {
          $('#id_barang').focus();
        }else if(qty == ''){
          $('#qty').focus();
        }else if(qty>max){
          alert('Quantitas melebihi stok');
          $('#qty').focus();
        }else{
       // ajax adding data to database
          $.ajax({
            url : "<?= site_url('transaksi/addbarang')?>",
            type: "POST",
            data: $('#form_transaksi').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //reload ajax table
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });

          showTotal();
          showKembali($('#bayar').val());
          //mereset semua value setelah btn tambah ditekan
          $('.reset').val('');
        };
    }

    function deletebarang(id,sub_total)
    {
        // ajax delete data to database
          $.ajax({
            url : "<?= site_url('transaksi/deletebarang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

          var ttl = $('#total').val().replace(".", "");

          $('#total').val(convertToRupiah(ttl-sub_total));

          showKembali($('#bayar').val());
    }

    function showTotal()
    {

      var total = $('#total').val().replace(".", "").replace(".", "");

      var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");

      $('#total').val(convertToRupiah((Number(total)+Number(sub_total))));

    }

  function showKembali(str)
    {
      var total = $('#total').val().replace(".", "").replace(".", "");
      var bayar = str.replace(".", "").replace(".", "");
      var kembali = bayar-total;
      $('#bayar1').val(Number(bayar));
      $('#bayar').val(convertToRupiah((Number(bayar))));
      $('#kembali').val(convertToRupiah(kembali));

      if (kembali >= 0) {
        $('#selesai').removeAttr("disabled");
      }else{
        $('#selesai').attr("disabled","disabled");
      };

      if (total == '0') {
        $('#selesai').attr("disabled","disabled");
      };
    }
</script>