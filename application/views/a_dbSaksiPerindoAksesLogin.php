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
        <!-- Saksi Perindo -->
        <div class="right_col" role="main">
          <div class="">

          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Saksi Perindo</h2>
                    <span style="color: #607D8B; float: right; margin-top: 0px;">
                        <!--Keterangan&nbsp;&nbsp;
                        <a href="#" style="background-color: #43A047; border-radius: 2.50px; color: #FFFFFF; padding-top: 2.50px; padding-bottom: 2.50px; padding-left: 5px; padding-right: 5px;"><small>Data Valid</small></a>
                        <a href="#" style="background-color: #F44336; border-radius: 2.50px; color: #FFFFFF; padding-top: 2.50px; padding-bottom: 2.50px; padding-left: 5px; padding-right: 5px;"><small>Data Invalid</small></a>
                        <a href="#" style="background-color: #FFC107; border-radius: 2.50px; color: #000000; padding-top: 2.50px; padding-bottom: 2.50px; padding-left: 5px; padding-right: 5px;"><small>Data Update</small></a>
                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        <a href=" #echo base_url() . "Dashboard/ExcelSaksiSubmit"; " class="btn btn-primary"><i class="fa fa-check-circle-o"></i><small>&nbsp;&nbsp;&nbsp;Submit</small></a>-->
                        <!-- <a href="<?php #echo base_url() . "Admin/ExcelExportDbSaksiPerindoTmp_v2"; ?>" class="btn btn-primary" style="margin-right: -5px;"><i class="fa fa-file-excel-o"></i><small>&nbsp;&nbsp;&nbsp;Export to Excel</small></a> -->
                        <!--<input type="button" class="btn btn-primary" value=""/>-->

                        <form method="POST" action="<?php echo base_url() . "Dashboard/ExcelExportDbSaksiPerindoTmp_v4"; ?>">
                          <strong>DAPIL&nbsp;&nbsp;</strong>
                          <select id="idSpinnerDapil" name="spinner_User_Dapil" style="height: 32px; margin-right: 10px;" required>
                            <?php $this->m_wilayah->GetDapil_v1(); ?>
                            <!--<option value="" selected>Tampilkan Semua</option>-->
                            <!--<option value="01">Jawa Barat XI</option>-->
                          </select>
                          <button type="submit" class="btn btn-primary" style="margin-right: -5px; margin-top: 5px;"><i class="fa fa-file-excel-o"></i><small>&nbsp;&nbsp;&nbsp;Export to Excel</small></button>
                          <!--<input type="submit" class="btn btn-primary" style="font-size: 12px; height: 32px; margin-top: 5px;" value="Export to Excel"/>-->
                        </form>
                    </span>
                    <!-- <i class="fa fa-times-circle-o"></i> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Lengkap</th>
                          <th>NIK</th>
                          <th>Username</th>
                          <th>Password</th>

                          <!--<th>Alamat Lengkap</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Kab. / Kota</th>
                          <th>TPS</th>
                          <th>No.HP</th>
                          <th>Rekomendasi</th>-->

                          <!--<th style="width: 100px; text-align: left;">Nama Lengkap</th>
                          <th style="width: 125px; text-align: left;">Data Unique</th>
                          <th style="width: auto; text-align: left;">Lokasi</th>
                          <th style="width: 125px; text-align: left;">Informasi</th>-->

                          <!--<th>Alamat Rumah</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Kab. / Kota</th>
                          <th style="width: 25px; text-align: left;">TPS</th>
                          <th style="width: 50px; text-align: left;">No.HP</th>
                          <th>Rekomendasi</th>-->
                          <!--<th>Status</th>-->

                          <!--<th>Nama Lengkap</th>
                          <th style="width: 90px; text-align: left;">Jenis Kelamin</th>
                          <th style="width: 115px; text-align: left;">Status Pernikahan</th>
                          <th>Pekerjaan</th>
                          <th style="width: 50px; text-align: left;">Usia</th>
                          <th style="width: 50px; text-align: left;">Status</th>-->

                          <!--<th>Nama Depan</th>
                          <th>Nama Belakang</th>
                          <th>Jenis Kelamin</th>
                          <th>Provinsi</th>
                          <th>Kab. / Kota</th>
                          <th>Kecamatan</th>
                          <th>Kelurahan</th>
                          <th>Kontak</th>
                          <th>Status</th>
                          <th style="width: 75px; text-align: center;">Action</th>-->
                        </tr>
                      </thead>


                      <tbody id="idTableBody">
                        <?php
                            #$this->load->view('v_dataSaksiPerindoAll');
                            #$this->m_saksi->UploadExcelSaksiTmp2();
                            $this->m_saksi->ListExcelSaksiAksesLogin();
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          </div>
        </div>
        <!-- End of Saksi Perindo -->
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
        $(function() { 
            $(".btn").click(function(){
                $(this).button('loading').delay(3000).queue(function() {
                    $(this).button('reset');
                    $(this).dequeue();
                });        
            });
        });
        
        $(document).ready(function ()
        {
            var message = '<?php echo @$_SESSION["Response_Message"]; ?>';
            if (message != "")
            {
                ShowMessage(message);

                $.ajax({
                    url: '<?php echo base_url()."Admin/RemoveMessage"; ?>',
                    success: function(r)
                    {
                        /*setTimeout(function()
                        {
                            location.reload();
                        }, 3000);*/
                    }
                });
            }

            // spinner dapil
            $("#idSpinnerDapil").change(function()
            {
                var iddapil = $(this).find(":selected").val();

                //alert('id dapil : ' + iddapil);
                //$("#idTableBody").html();

                $.ajax({
                    url: '<?php echo base_url()."Dashboard/SpinnerDapilOnAjax_v3/" ?>' + iddapil,
                    // data: "IdProvinsi="+idprovinsi,
                    cache: false,
                    // type : "GET",
                    success: function(r)
                    {
                        console.log(r);

                        $("#idTableBody").html(r);

                        //$("#spinnerkota").html(r);
                        //$("#spinnerkecamatan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                        //$("#spinnerkelurahan").find('option').remove().end().append('<option value="0" selected>Pilih</option>');
                    }
                });
            });
        })

        function ClickDeleteSaksiPerindo (message, iduser)
        {
          $.confirm({
              text: message,
              confirm: function(button) {
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url().'Admin/DeleteSaksiPerindo/'; ?>" + iduser,
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
