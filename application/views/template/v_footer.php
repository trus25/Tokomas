<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 
. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/bootstrap.min.js"></script>
    <!-- wow JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/wow.min.js"></script>
    <!-- price-slider JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/counterup/waypoints.min.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- jvectormap JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/jvectormap/jvectormap-active.js"></script>
    <!-- sparkline JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/sparkline/sparkline-active.js"></script>
    <!-- sparkline JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/flot/jquery.flot.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/flot/curvedLines.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/flot/flot-active.js"></script>
    <!-- knob JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/knob/jquery.knob.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/knob/jquery.appear.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/knob/knob-active.js"></script>
    <!--  wave JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/wave/waves.min.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/wave/wave-active.js"></script>
    <!--  todo JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/todo/jquery.todo.js"></script>
    <!-- plugins JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/plugins.js"></script>
  <!--  Chat JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/chat/moment.min.js"></script>
    <script src="<?php echo config_item('assets_path');?>js/chat/jquery.chat.js"></script>
    <!-- main JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/main.js"></script>
  <!-- tawk chat JS
    ============================================ -->
    <script src="<?php echo config_item('assets_path');?>js/tawk-chat.js"></script>
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