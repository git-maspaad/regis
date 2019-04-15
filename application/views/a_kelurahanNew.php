<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Real Count</title>

    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/img_chartbar1_32px.png">

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url() ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <?php
          $this->load->view('a_panelLeft');
          $this->load->view('a_panelTopRight');
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="x_panel">

              <div class="x_content">

                <!-- start form for validation -->
                <form id="demo-form" data-parsley-validate style="font-family: 'Monaco';" method="POST" action="<?php echo base_url() . "Admin/CreateNewKelurahan"; ?>">

                  <label style="font-size: 20px; margin-bottom: 15px;">Form Kelurahan</label>
                  <div class="clearfix"></div>

                  <label for="spinnerprovinsi">Provinsi</label>
                  <select id="spinnerprovinsi" name="spinner_Provinsi_IdProvinsi" class="form-control" style="width: 100%; margin-bottom: 25px; margin-right: 0px;" onclick="LoadProvinsiOnSelected()" required>
                      <?php
                          $this->load->view('a_spinnerProvinsi2');
                      ?>
                  </select>

                  <label for="spinnerkota">Kab. / Kota</label>
                  <select id="spinnerkota" name="spinner_Kota_IdKota" class="form-control" style="margin-bottom: 15px;" required>
                    <option value="0" selected>Pilih</option>
                  </select>

                  <label for="spinnerkecamatan">Kecamatan</label>
                  <select id="spinnerkecamatan" name="spinner_Kecamatan_IdKecamatan" class="form-control" style="margin-bottom: 15px;" required>
                    <option value="0" selected>Pilih</option>
                  </select>

                  <label for="kelurahan">Kelurahan</label>
                  <input type="text" id="kelurahan" name="text_Kelurahan_NamaKelurahan" class="form-control" style="margin-bottom: 15px;" value="" placeholder="..." required autofocus />

                  <br/>
                  <input type="submit" class="btn btn-primary" value="Simpan"/>

                </form>
                <!-- end form for validations -->

              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Real Count - <a href="https://www.partaiperindo.com">Partai Perindo</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url() ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url() ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?php echo base_url() ?>assets/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url() ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url() ?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url() ?>assets/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url() ?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() ?>assets/build/js/custom.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "assets/snackbar/dist/snackbar.css"; ?>" />
    <script src="<?php echo base_url() . "assets/snackbar/dist/snackbar.min.js"; ?>"></script>

    <!-- Ajax Data Wilayah -->
    <script type="text/javascript">
        function ShowMessage (message)
        {
            Snackbar.show({
                actionText: "Ok",
                actionTextColor: "#ffffff",
                pos: "bottom-right",
                showAction: false,
                text: "<small>" + message + "</small>"
            });
        }

        $(document).ready(function ()
        {
            var message = '<?php echo @$_SESSION["Response_Message"]; ?>';
            if (message != "")
            {
                ShowMessage(message);

                $.ajax({
                    url: '<?php echo base_url()."Admin/RemoveMessage"; ?>',
                    success: function(r)
                    {}
                });
            }

            // provinsi
            $("#spinnerprovinsi").change(function()
            {
                var idprovinsi = $(this).find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Admin/SpinnerKotaOnAjax/" ?>' + idprovinsi,
                    // data: "IdProvinsi="+idprovinsi,
                    cache: false,
                    // type : "GET",
                    success: function(r)
                    {
                        $("#spinnerkota").html(r);
                        $("#spinnerkecamatan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            })

            function LoadProvinsiOnSelected ()
            {
                var idprovinsi = $(this).find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Admin/SpinnerKotaOnAjax/" ?>' + idprovinsi,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkota").html(r);
                        $("#spinnerkecamatan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            }
            // end of provinsi

            // kota
            $("#spinnerkota").change(function()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Admin/SpinnerKecamatanOnAjax/" ?>' + idprovinsi + '/' + idkota,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkecamatan").html(r);
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            })

            function LoadKotaOnSelected ()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Admin/SpinnerKecamatanOnAjax/" ?>' + idprovinsi + '/' + idkota,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkecamatan").html(r);
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            }
            // end of kota

            // kecamatan
            $("#spinnerkecamatan").change(function()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();
                var idkecamatan = $("#spinnerkecamatan").find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Admin/SpinnerKelurahanOnAjax/" ?>' + idprovinsi + '/' + idkota + '/' + idkecamatan,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkelurahan").html(r);
                    }
                });
            })

            function LoadKecamatanOnSelected ()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();
                var idkecamatan = $("#spinnerkecamatan").find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Admin/SpinnerKelurahanOnAjax/" ?>' + idprovinsi + '/' + idkota + '/' + idkecamatan,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkelurahan").html(r);
                    }
                });
            }
            // end of kecamatan
        });
    </script>

  </body>
</html>
