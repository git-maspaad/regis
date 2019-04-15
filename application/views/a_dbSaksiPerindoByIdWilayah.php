<?php

    if (@$_SESSION == NULL)
    {
      session_start();
    }

    if (@$_SESSION["AppSignin"] == NULL || @$_SESSION["AppSignin"] == false)
    {
      $this->load->helper('url');
      redirect('Signin');
    }

?>

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
    <!-- iCheck -->
    <link href="<?php echo base_url() ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url() ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
        <!-- Admin -->
        <div class="right_col" role="main">
          <div class="">

          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                      <?php
                        $IdWilayah = $this->uri->segment('3');
                        $NamaWilayah;
                        if ($IdWilayah == NULL)
                        {
                            $this->load->helper('url');
                            redirect('Dashboard/DbSaksiPerindoAll');
                        }
                        else
                        {
                            switch ($IdWilayah)
                            {
                                case 1:
                                    $NamaWilayah = "Sumatera";
                                    break;
                                case 2:
                                    $NamaWilayah = "Jawa - Bali";
                                    break;
                                case 3:
                                    $NamaWilayah = "Kalimantan";
                                    break;
                                case 4:
                                    $NamaWilayah = "Wilayah Timur";
                                    break;
                                default:
                                    $this->load->helper('url');
                                    redirect('Dashboard/DbSaksiPerindoAll');
                                    break;
                            }
                        }
                        echo "Saksi Perindo" . '&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;' . $NamaWilayah;
                      ?>
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Depan</th>
                          <th>Nama Belakang</th>
                          <th>Jenis Kelamin</th>
                          <th>Kab. / Kota</th>
                          <th>Kecamatan</th>
                          <th>Kelurahan</th>
                          <th>Kontak</th>
                          <th>Status</th>
                          <th style="width: 75px; text-align: center;">Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
                            $this->load->view('a_dataSaksiPerindoByIdWilayah');
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          </div>
        </div>
        <!-- End of Admin -->
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
    <!-- iCheck -->
    <script src="<?php echo base_url() ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() ?>assets/build/js/custom.min.js"></script>

    <!-- Jquery Confirm Dialog -->
    <script src="<?php echo base_url() ?>assets/jquery.confirm/jquery.confirm.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery.confirm/jquery.confirm.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "assets/snackbar/dist/snackbar.css"; ?>" />
    <script src="<?php echo base_url() . "assets/snackbar/dist/snackbar.min.js"; ?>"></script>

    <script type="text/javascript">
        $(document).ready(function ()
        {
            var message = '<?php echo @$_SESSION["Response_Message"]; ?>';
            if (message != "")
            {
                ShowMessage(message);

                $.ajax({
                    url: '<?php echo base_url()."Dashboard/RemoveMessage"; ?>',
                    success: function(r)
                    {
                        setTimeout(function()
                        {
                            location.reload();
                        }, 3000);
                    }
                });
            }
        })

        function ClickDeleteSaksiPerindo (message, iduser)
        {
          $.confirm({
              text: message,
              confirm: function(button) {
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url().'Dashboard/DeleteAdmin/'; ?>" + iduser,
                      success: function(status) {
                          location.reload();
                      }
                  });
              },
              cancel: function(button) {
              }
          });
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
    </script>
  </body>
</html>
