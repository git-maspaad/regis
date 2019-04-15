<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="<?php echo site_url("Admin"); ?>" class="site_title"><img src="<?php echo base_url() ?>assets/images/img_chartbar1_32px.png" style="height: 25px; width: 25px; margin-top: -7.50px;"/> <span style="font-family: 'Arial';">Real Count</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php if (@$_SESSION["User_PhotoUrl"] == NULL) { echo base_url()."assets/images/img.jpg"; } else { echo base_url()."upload/images/" . @$_SESSION["User_PhotoUrl"]; } ?>" alt="..." class="img-circle profile_img" style="width: 64px; height: 64px; object-fit: cover;">
      </div>
      <div class="profile_info" style="margin-top: -12px;">
        <span>Welcome,</span>
        <h2 style="margin-bottom: 10px;"><?php echo @$_SESSION["User_NamaLengkap"] ?></h2>
        <h2 style="font-size: 11px;"><?php echo @$_SESSION["User_Kontak"]; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- Sidebar Menu -->
    <?php
        # include("sidebarMenu.php");
        $this->load->view('a_sidebarMenu');
    ?>
    <!-- End of Sidebar Menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Exit from dashboard?" href="<?php echo site_url("Dashboard/SignOut"); ?>" style="width: 100%;">
          <span class="glyphicon" aria-hidden="true">
              <label style="font-family: 'Arial'; font-size: 11px; margin-bottom: 12.50px;"><font color="#FFFFFF">Log Out</font></label>
          </span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
