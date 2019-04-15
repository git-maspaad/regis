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
          $this->load->view('v_panelLeft');
          $this->load->view('v_panelTopRight');
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="x_panel">

              <div class="x_content">

                <!-- form cek nomor ktp -->
                <form id="demo-form-cek" data-parsley-validate style="font-family: 'Monaco';" method="POST" action="#">
                    <label style="font-size: 20px; margin-bottom: 15px;">Cek Keanggotaan</label>
                    <div class="clearfix"></div>

                    <label for="ceknoktp">No.KTP</label>
                    <input type="number" id="ceknoktp" name="text_User_NoKTPCek" class="form-control" style="width: 285px; margin-right: 10px; text-align: left; margin-bottom: 15px;" value="<?php echo @$_SESSION["Response_Tmp_UserNoKTP"]; ?>" placeholder="..." disabled />

                    <!--<label for="cekfullname">Nama Lengkap</label>
                    <input type="text" id="cekfullname" name="text_User_NamaLengkapCek" class="form-control" style="width: 285px; margin-right: 10px; text-align: left; margin-bottom: 15px;" value="" placeholder="..."/>

                    <label for="cekborndate">Tanggal Lahir</label>
                    <table style="margin-bottom: 15px;">
                        <th>
                            <input type="text" id="cekborndatedd" class="form-control" name="text_User_TanggalLahirDDCek" data-parsley-trigger="change" value="" style="width: 50px; margin-right: 10px; text-align: center;" />
                        </th>
                        <th>
                            <select id="cekborndatemm" name="spinner_User_TanggalLahirCek" class="form-control" style="width: 150px; margin-right: 10px;">
                            <option value="" selected>Pilih</option>

                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>

                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                            </select>
                        </th>
                        <th>
                            <input type="text" id="cekborndateyyyy" class="form-control" name="text_User_TanggalLahirYYYYCek" data-parsley-trigger="change" value="" style="width: 65px; text-align: center;" />
                        </th>
                    </table>-->

                    <a href="./Saksi" class="btn btn-primary">Kembali</a>
                    <!--<input type="submit" class="btn btn-primary" value="Proses" />--><!-- onclick="ValidateFormRegistrasi()" -->
                </form>
                <!-- end of form cek nomor ktp -->

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
                    url: '<?php echo base_url()."Dashboard/RemoveMessage"; ?>',
                    success: function(r)
                    {}
                });
            }

            //var xKtp = '<?php echo @$_SESSION["Response_Tmp_UserNoKTP"]; ?>';
            //$("#ceknoktp").val = "1001040202570005";
        });
    </script>

  </body>
</html>
