<?php
    
    echo '<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">';
        echo '<div class="menu_section"></div>';

        echo '<div class="menu_section">';
            echo '<h3 style="font-family: '."Arial".';">Saksi</h3>';
            echo '<ul class="nav side-menu">';
                echo '<li><a href="'.site_url("Admin/ExcelSaksi").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> Upload Data Saksi </a></li>';
                echo '<li><a href="'.site_url("Admin/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> View Data Saksi </a></li>';
                echo '<li><a href="'.site_url("Admin/DbAksesSaksiPerindo").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> User & Password Saksi </a></li>';
                echo '<li><a href="'.site_url("upload/excel/FormRekruitmenSaksi.xlsx").'" style="font-family: '."Arial".';"><i class="fa fa-download"></i> Template Excel </a></li>';
            echo '</ul>';
        echo '</div>';

        echo '<div class="menu_section">';
            echo '<h3 style="font-family: '."Arial".';">User Management</h3>';
            echo '<ul class="nav side-menu">';
                echo '<li><a href="'.site_url("Admin/NewAdmin").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Admin </a></li>';
                echo '<li><a href="'.site_url("Admin/DbAdminAll").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> View Data Admin </a></li>';
            echo '</ul>';
        echo '</div>';
    echo '</div>';

    /*echo
    '
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section"></div>
      <div class="menu_section">
        <h3 style="font-family: '."Arial".';">Data</h3>
        <ul class="nav side-menu">
          <li><a href="'.site_url("Admin/Profile").'" style="font-family: '."Arial".';"><i class="fa fa-user"></i> Edit Profile </a></li>
        </ul>
      </div>

      <div class="menu_section">
        <h3 style="font-family: '."Arial".';">Form</h3>
        <ul class="nav side-menu">
          <li><a href="'.site_url("Admin/Admin").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Admin </a></li>

          <li>
              <a style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Data Wilayah <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="'.site_url("Admin/Provinsi").'" style="font-family: '."Arial".';"> Add Provinsi </a></li>
                <li><a href="'.site_url("Admin/Kota").'" style="font-family: '."Arial".';"> Add Kab. / Kota </a></li>
                <li><a href="'.site_url("Admin/Kecamatan").'" style="font-family: '."Arial".';"> Add Kecamatan </a></li>
                <li><a href="'.site_url("Admin/Kelurahan").'" style="font-family: '."Arial".';"> Add Kelurahan </a></li>
              </ul>
          </li>

          <li><a href="'.site_url("Admin/Saksi").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Saksi Perindo </a></li>
        </ul>
      </div>

      <div class="menu_section">
        <h3 style="font-family: '."Arial".';">Database</h3>
        <ul class="nav side-menu">
          <li>
              <a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Admin <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
              ';*/
              #$this->m_wilayah->GetWilayahIndonesiaDbAdmin_v2();
    /*echo      '
              </ul>
          </li>

          <li>
              <a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Data Wilayah <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="'.site_url("Admin/DbProvinsi").'" style="font-family: '."Arial".';"> Provinsi </a></li>
                <li><a href="'.site_url("Admin/DbKota").'" style="font-family: '."Arial".';"> Kab. / Kota </a></li>
                <li><a href="'.site_url("Admin/DbKecamatan").'" style="font-family: '."Arial".';"> Kecamatan </a></li>
                <li><a href="'.site_url("Admin/DbKelurahan").'" style="font-family: '."Arial".';"> Kelurahan </a></li>
              </ul>
          </li>

          <li>
              <a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Saksi Perindo <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                ';*/
                #$this->m_wilayah->GetWilayahIndonesiaDbSaksiPerindo_v2();
    /*echo        '
              </ul>
          </li>
        </ul>
      </div>
    </div>
    ';*/

?>
