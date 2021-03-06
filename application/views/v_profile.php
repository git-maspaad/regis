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

                <!-- start form for validation -->
                <form id="demo-form" data-parsley-validate style="font-family: 'Monaco';" method="POST" action="ProfileUpdate">

                  <label style="font-size: 20px; margin-bottom: 15px;">Identitas Anda</label>
                  <div class="clearfix"></div>

                  <label for="fullname">Nama Lengkap</label>
                  <input type="text" id="fullname" name="text_User_NamaLengkap" class="form-control" style="margin-bottom: 15px;" value="<?php echo @$_SESSION["User_NamaLengkap"]; ?>" placeholder="..." required autofocus />
                  <!--<input type="text" id="fullname" name="text_User_NamaBelakang" class="form-control" style="margin-bottom: 15px;" value="<?php #echo @$_SESSION["User_NamaBelakang"]; ?>" placeholder="nama belakang"/>-->

                  <!--<label>Jenis Kelamin</label>
                  <p style="margin-bottom: 15px;">
                    <?php
                      /*if (@$_SESSION["User_JenisKelamin"] == "Laki-laki")
                      {
                        echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" checked required />&nbsp;Laki-laki';
                        echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" />&nbsp;Perempuan';
                      }
                      else if (@$_SESSION["User_JenisKelamin"] == "Perempuan")
                      {
                        echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" required />&nbsp;Laki-laki';
                        echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" checked />&nbsp;Perempuan';
                      }
                      else
                      {
                        echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" required />&nbsp;Laki-laki';
                        echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" />&nbsp;Perempuan';
                      }*/
                    ?>
                  </p>-->

                  <!--<label for="bornplace">Tempat Lahir</label>
                  <input type="text" id="bornplace" class="form-control" name="text_User_Tempatlahir" data-parsley-trigger="change" value="<?php #echo @$_SESSION["User_TempatLahir"]; ?>" style="margin-bottom: 15px;" required />-->

                  <!--<label for="borndate">Tanggal Lahir</label>
                  <table style="margin-bottom: 50px;">
                      <th>
                        <input type="text" id="borndatedd" class="form-control" name="text_User_TanggalLahirDD" data-parsley-trigger="change" value="<?php #echo @$_SESSION["User_TanggalLahirDD"]; ?>" style="width: 50px; margin-right: 10px; text-align: center;" required />
                      </th>
                      <th>
                        <select id="borndatemm" name="spinner_User_TanggalLahir" class="form-control" style="width: 150px; margin-right: 10px;" required>
                          <option value="" selected>Pilih</option>

                          <?php
                            /*for($i = 0; $i <= 12; $i++)
                            {
                                $IsSelected = "";
                                if ($i == @$_SESSION["User_TanggalLahirMM"])
                                {
                                    $IsSelected = "selected";
                                }

                                if ($i < 10)
                                {
                                    $i = "0" . $i;

                                    switch ($i)
                                    {
                                        case "01":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Januari</option>';
                                            break;
                                        case "02":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Februari</option>';
                                            break;
                                        case "03":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Maret</option>';
                                            break;
                                        case "04":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>April</option>';
                                            break;
                                        case "05":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Mei</option>';
                                            break;
                                        case "06":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Juni</option>';
                                            break;
                                        case "07":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Juli</option>';
                                            break;
                                        case "08":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Agustus</option>';
                                            break;
                                        case "09":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>September</option>';
                                            break;
                                    }
                                }
                                else
                                {
                                    $i = "" . $i;

                                    switch ($i)
                                    {
                                        case "10":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Oktober</option>';
                                            break;
                                        case "11":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>November</option>';
                                            break;
                                        case "12":
                                            echo '<option value="'.$i.'" '.$IsSelected.'>Desember</option>';
                                            break;
                                    }
                                }
                            }*/
                          ?>
                        </select>
                      </th>
                      <th>
                        <input type="text" id="borndateyyyy" class="form-control" name="text_User_TanggalLahirYYYY" data-parsley-trigger="change" value="<?php #echo @$_SESSION["User_TanggalLahirYYYY"]; ?>" style="width: 65px; text-align: center;" required />
                      </th>
                  </table>-->

                  <!--<label style="font-size: 20px; margin-bottom: 15px;">Wilayah</label>
                  <div class="clearfix"></div>

                  <label for="spinnerprovinsi">Provinsi</label>
                  <select id="spinnerprovinsi" name="spinner_User_Provinsi" class="form-control" style="margin-bottom: 15px;" required onclick="LoadProvinsiOnSelected();">
                      <?php
                          #$this->load->view('v_spinnerProvinsi');
                      ?>
                  </select>

                  <label for="spinnerkota">Kab. / Kota</label>
                  <select id="spinnerkota" name="spinner_User_Kota" class="form-control" style="margin-bottom: 15px;" required onclick="LoadKotaOnSelected();">
                      <?php
                          #$this->load->view('v_spinnerKota');
                      ?>
                  </select>

                  <label for="spinnerkecamatan">Kecamatan</label>
                  <select id="spinnerkecamatan" name="spinner_User_Kecamatan" class="form-control" style="margin-bottom: 15px;" required>
                      <?php
                          #$this->load->view('v_spinnerKecamatan');
                      ?>
                  </select>

                  <label for="spinnerkelurahan">Kelurahan</label>
                  <select id="spinnerkelurahan" name="spinner_User_Kelurahan" class="form-control" style="margin-bottom: 15px;" required>
                      <?php
                          #$this->load->view('v_spinnerKelurahan');
                      ?>
                  </select>-->

                  <!--<label for="homeaddress">Alamat Lengkap</label>
                  <textarea id="homeaddress" required="required" class="form-control" name="text_User_AlamatLengkap" data-parsley-trigger="keyup" data-parsley-minlength="12" data-parsley-maxlength="150" data-parsley-minlength-message="Min. 12 karakter!" data-parsley-validation-threshold="10" style="height: 150px; margin-bottom: 50px;"><?php echo @$_SESSION["User_AlamatLengkap"] ?></textarea>

                  <label style="font-size: 20px; margin-bottom: 15px;">Data Unique</label>
                  <div class="clearfix"></div>-->

                  <label for="contact">Kontak</label>
                  <input type="phone" id="contact" class="form-control" name="text_User_Kontak" data-parsley-trigger="change" value="<?php echo @$_SESSION["User_Kontak"]; ?>" style="margin-bottom: 15px;" required />

                  <!--<label for="email">Email</label>
                  <input type="email" id="email" class="form-control" name="text_User_Email" data-parsley-trigger="change" value="<?php #echo @$_SESSION["User_Email"]; ?>" style="margin-bottom: 15px;" required />

                  <label for="nomorktp">Nomor KTP</label>
                  <input type="number" id="nomorktp" class="form-control" name="text_User_NomorKTP" data-parsley-trigger="change" value="<?php #echo @$_SESSION["User_NomorKTP"]; ?>" style="margin-bottom: 15px;" required />-->

                  <br/>
                  <input type="submit" class="btn btn-primary" value="Update"/>

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
                    url: '<?php echo base_url()."Dashboard/RemoveMessage"; ?>',
                    success: function(r)
                    {}
                });
            }

            // provinsi
            /*$("#spinnerprovinsi").change(function()
            {
                var idprovinsi = $(this).find(":selected").val();

                $.ajax({
                    url: '<?php //echo base_url()."Dashboard/SpinnerKotaOnAjax/" ?>' + idprovinsi,
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
            })*/

            /*function LoadProvinsiOnSelected ()
            {
                var idprovinsi = $(this).find(":selected").val();

                $.ajax({
                    url: '<?php //echo base_url()."Dashboard/SpinnerKotaOnAjax/" ?>' + idprovinsi,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkota").html(r);
                        $("#spinnerkecamatan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            }*/
            // end of provinsi

            // kota
            /*$("#spinnerkota").change(function()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();

                $.ajax({
                    url: '<?php //echo base_url()."Dashboard/SpinnerKecamatanOnAjax/" ?>' + idprovinsi + '/' + idkota,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkecamatan").html(r);
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            })*/

            /*function LoadKotaOnSelected ()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();

                $.ajax({
                    url: '<?php //echo base_url()."Dashboard/SpinnerKecamatanOnAjax/" ?>' + idprovinsi + '/' + idkota,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkecamatan").html(r);
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            }*/
            // end of kota

            // kecamatan
            /*$("#spinnerkecamatan").change(function()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();
                var idkecamatan = $("#spinnerkecamatan").find(":selected").val();

                $.ajax({
                    url: '<?php //echo base_url()."Dashboard/SpinnerKelurahanOnAjax/" ?>' + idprovinsi + '/' + idkota + '/' + idkecamatan,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkelurahan").html(r);
                    }
                });
            })*/

            /*function LoadKecamatanOnSelected ()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();
                var idkecamatan = $("#spinnerkecamatan").find(":selected").val();

                $.ajax({
                    url: '<?php //echo base_url()."Dashboard/SpinnerKelurahanOnAjax/" ?>' + idprovinsi + '/' + idkota + '/' + idkecamatan,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkelurahan").html(r);
                    }
                });
            }*/
            // end of kecamatan
        });
    </script>

  </body>
</html>
