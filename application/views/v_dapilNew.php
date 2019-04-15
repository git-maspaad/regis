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

    <style>
        .chip {
            display: inline-block;
            padding: 0 25px;
            height: 50px;
            font-size: 16px;
            line-height: 50px;
            border-radius: 25px;
            background-color: #f1f1f1;
        }

        .chip2 {
            display: inline-block;
            padding: 0 25px;
            height: 50px;
            font-size: 16px;
            line-height: 50px;
            border-radius: 25px;
            background-color: #B71C1C;
        }

        .chip img {
            float: left;
            margin: 0 10px 0 -25px;
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }


        .closebtn {
            padding-left: 10px;
            color: #888;
            font-weight: bold;
            float: right;
            font-size: 20px;
            cursor: pointer;
        }

        .closebtn:hover {
            color: #000;
        }

        .flexp {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
        }

        .flexc {
            width: 50%;
        }
    </style>
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
                <form id="demo-form" data-parsley-validate style="font-family: 'Monaco';" method="POST" action="CreateNewDapil">

                  <label style="font-size: 20px; margin-bottom: 15px;">Form Daerah Pemilihan</label>
                  <div class="clearfix"></div>

                  <label for="spinnerprovinsi">Provinsi</label>
                  <select id="spinnerprovinsi" name="spinner_User_Provinsi" class="form-control" style="margin-bottom: 15px;" onclick="LoadProvinsiOnSelected()" required>
                      <?php
                          $this->load->view('v_spinnerProvinsi2');
                      ?>
                  </select>

                  <div id="dchipkota">
                    <label for="chipkota">Kab. / Kota</label>
                    <div id="chipkota" class="flexp" style="margin-bottom: 0px;">
                        <!--<div class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">
                            <input type="checkbox" value="Bekasi"/>
                            <label style="margin-right: 5px;margin-top: 1.50px;">Bekasi</label>
                        </div>-->

                        <!--<div id="chipkota" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">
                                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Person" width="96" height="96">
                                Depok<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
                        </div>-->
                    </div>
                    <div id="chipreset" class="chip2" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()" hidden>
                        <label style="color:white; margin-right:0px; margin-top:0px;">Reset</label>
                    </div>
                    <input type="text" id="tchipkota" name="text_User_tChipKota" class="form-control" style="text-align: left; margin-bottom: 15px;" value="" placeholder="..." hidden />
                  </div>

                  <label for="dapil">Nama Dapil</label>
                  <input type="text" id="dapil" name="text_User_NamaDapil" class="form-control" style="margin-bottom: 15px;" value="" placeholder="..." required />

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
        function AddIdKota(id)
        {
            var x = document.getElementById("tchipkota").value;

            if ($("#icItemKota").prop('checked'))
            {
                if (x === "")
                {
                    //var idx = (x === "" ? id : x+","+id);
                    document.getElementById("tchipkota").value = id;
                }
                else
                {
                    var idx = x+","+id;
                    document.getElementById("tchipkota").value = idx;

                    //var arr = [idx]; //[5, 15, 110, 210, 550];
                    //var index = arr.indexOf(id);

                    //if (index > -1)
                    //{
                        //arr.splice(index, 1);
                    //}
                    //var idx = (x === "" ? id : x+","+id);
                    //document.getElementById("tchipkota").value = arr;
                }
            }
        }

        function LoadProvinsiOnSelected ()
        {
            $("#dchipkota").hide();
            $("#tchipkota").val('');
            //$("#tchipkota").val('0');
            $("#tchipkota").hide();

            var idprovinsi = $(this).find(":selected").val();

            if (idprovinsi === "0")
            {
                console.log("Oops!");
            }
            else
            {
                $.ajax({
                    url: '<?php echo base_url()."Dashboard/SpinnerKotaOnAjax_v2/" ?>' + idprovinsi,
                    cache: false,
                    success: function(r)
                    {
                        //console.log(r);

                        if (r === "")
                        {
                            $("#dchipkota").hide();
                        }
                        else
                        {
                            $("#dchipkota").show();
                            $("#chipkota").html(r);
                            $("#chipreset").show();
                        }

                        //$("#spinnerkota").html(r);
                        //$("#spinnerkecamatan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                        //$("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            }
        }

        function ResetChipsKota ()
        {
            //var x = document.getElementById("tchipkota").value;
            //var arr = [x]; //[5, 15, 110, 210, 550];
            //var index = arr.indexOf(id);

            //if (index > -1)
            //{
                //arr.splice(index, 1);
            //}
            //var idx = (x === "" ? "" : x+","+id);
            //document.getElementById("tchipkota").value = arr;

            $("#tchipkota").val('');

            //$("#tchipkota").val('0');
            //$("#icItemKota").removeAttr("checked");
            $('input:checkbox').removeAttr('checked');

            //$('input:checkbox:checked:visible:first').prop("checked", true);
            //$("#icItemKotaDefault").attr('checked');
            //$('input:checkbox:checked:visible:first').attr('unchecked');
            $("#chipkota").find("input[type=checkbox]:first").prop( "checked", true );
            $("#chipkota").find("div[id=chipx]:first").hide();
            //$("input:checkbox:unchecked:first").prop("checked",true);
            //$("input:checkbox:unchecked:first").attr("checked","checked");
            //$("input:checkbox").find("input[type=checkbox]:first").prop( "checked", true );
        }

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
            $("#dchipkota").hide();
            $("#tchipkota").val('');
            //$("#tchipkota").val('0');
            $("#tchipkota").hide();

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
            $("#spinnerprovinsi").change(function()
            {
                $("#tchipkota").val('');
                //$("#tchipkota").val('0');

                var idprovinsi = $(this).find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Dashboard/SpinnerKotaOnAjax_v2/" ?>' + idprovinsi,
                    // data: "IdProvinsi="+idprovinsi,
                    cache: false,
                    // type : "GET",
                    success: function(r)
                    {
                        //console.log(r);

                        if (r === "")
                        {
                            $("#dchipkota").hide();
                            $("#chipx").hide();
                        }
                        else
                        {
                            $("#dchipkota").show();
                            $("#chipkota").html(r);
                            $("#chipreset").show();
                            $("#chipkota").find("div[id=chipx]:first").hide();
                            //$("#chipkota").find("div[id=chipx]:second").hide();
                            //$("#tchipkota").val('0');
                        }
                    }
                });
            });
            // end of provinsi

            // kota
            /*$("#spinnerkota").change(function()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Dashboard/SpinnerKecamatanOnAjax/" ?>' + idprovinsi + '/' + idkota,
                    cache: false,
                    success: function(r)
                    {
                        $("#spinnerkecamatan").html(r);
                        $("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            });

            function LoadKotaOnSelected ()
            {
                var idprovinsi = $("#spinnerprovinsi").find(":selected").val();
                var idkota = $("#spinnerkota").find(":selected").val();

                $.ajax({
                    url: '<?php echo base_url()."Dashboard/SpinnerKecamatanOnAjax/" ?>' + idprovinsi + '/' + idkota,
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
                    url: '<?php echo base_url()."Dashboard/SpinnerKelurahanOnAjax/" ?>' + idprovinsi + '/' + idkota + '/' + idkecamatan,
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
                    url: '<?php echo base_url()."Dashboard/SpinnerKelurahanOnAjax/" ?>' + idprovinsi + '/' + idkota + '/' + idkecamatan,
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
