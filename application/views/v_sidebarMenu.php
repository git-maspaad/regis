<?php

    echo '<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">';
        echo '<div class="menu_section"></div>';
        #echo '<div class="menu_section">';
            #echo '<h3 style="font-family: '."Arial".';">Data</h3>';
            #echo '<ul class="nav side-menu">';
                #echo '<li><a href="'.site_url("Dashboard/Profile").'" style="font-family: '."Arial".';"><i class="fa fa-user"></i> Edit Profile </a></li>';
            #echo '</ul>';
        #echo '</div>';

        echo '<div class="menu_section">';
            echo '<h3 style="font-family: '."Arial".';">Saksi</h3>';
            echo '<ul class="nav side-menu">';
                echo '<li><a href="'.site_url("Dashboard/ExcelSaksi").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> Upload Data Saksi </a></li>';
                echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> View Data Saksi </a></li>';
                echo '<li><a href="'.site_url("Dashboard/DbAksesSaksiPerindo").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> User & Password Saksi </a></li>';
                echo '<li><a href="'.site_url("upload/excel/FormRekruitmenSaksi.xlsx").'" style="font-family: '."Arial".';"><i class="fa fa-download"></i> Template Excel </a></li>';
            echo '</ul>';
        echo '</div>';

        echo '<div class="menu_section">';
            echo '<h3 style="font-family: '."Arial".';">User Management</h3>';
            echo '<ul class="nav side-menu">';
                echo '<li><a href="'.site_url("Dashboard/Admin").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Admin </a></li>';
                echo '<li><a href="'.site_url("Dashboard/DbAdminAll").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> View Data Admin </a></li>';
            echo '</ul>';
        echo '</div>';

        #echo '<div class="menu_section">';
            #echo '<h3 style="font-family: '."Arial".';">Form</h3>';
            #echo '<ul class="nav side-menu">';
                #echo '<li><a href="'.site_url("Dashboard/Admin").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Admin </a></li>';

                #echo '<li><a href="'.site_url("Dashboard/Caleg").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Caleg Perindo </a></li>';

                #echo '<li><a href="'.site_url("Dashboard/Dapil").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Dapil </a></li>';

                #echo '<li>';
                    #echo '<a style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Data Wilayah <span class="fa fa-chevron-down"></span></a>';
                    #echo '<ul class="nav child_menu">';
                        #echo '<li><a href="'.site_url("Dashboard/Provinsi").'" style="font-family: '."Arial".';"> Add Provinsi </a></li>';
                        #echo '<li><a href="'.site_url("Dashboard/Kota").'" style="font-family: '."Arial".';"> Add Kab. / Kota </a></li>';
                        #echo '<li><a href="'.site_url("Dashboard/Kecamatan").'" style="font-family: '."Arial".';"> Add Kecamatan </a></li>';
                        #echo '<li><a href="'.site_url("Dashboard/Kelurahan").'" style="font-family: '."Arial".';"> Add Kelurahan </a></li>';
                    #echo '</ul>';
                #echo '</li>';

                #echo '<li><a href="'.site_url("Dashboard/Saksi").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> New Saksi Perindo </a></li>';
            #echo '</ul>';
        #echo '</div>';

        #echo '<div class="menu_section">';
            #echo '<h3 style="font-family: '."Arial".';">Database</h3>';
            #echo '<ul class="nav side-menu">';
                #echo '<li><a href="'.site_url("Dashboard/DbAdminAll").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Admin </a></li>';
                #echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Saksi Perindo </a></li>';

                #echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Admin </a></li>';
                #echo '<li>';
                    #echo '<a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Admin <span class="fa fa-chevron-down"></span></a>';
                    #echo '<ul class="nav child_menu">';
                        #$this->m_wilayah->GetWilayahIndonesiaDbAdmin();
                    #echo '</ul>';
                #echo '</li>';

                #echo '<li>';
                    #echo '<a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Caleg Perindo <span class="fa fa-chevron-down"></span></a>';
                    #echo '<ul class="nav child_menu">';
                        #$IdPartai = "9";
                        #$this->m_caleg->ListTipeCaleg($IdPartai);
                    #echo '</ul>';
                #echo '</li>';

                #echo '<li><a href="'.site_url("Dashboard/DbDapil").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Dapil </a></li>';

                #echo '<li>';
                    #echo '<a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Data Wilayah <span class="fa fa-chevron-down"></span></a>';
                    #echo '<ul class="nav child_menu">';
                        #echo '<li><a href="'.site_url("Dashboard/DbProvinsi").'" style="font-family: '."Arial".';"> Provinsi </a></li>';
                        #echo '<li><a href="'.site_url("Dashboard/DbKota").'" style="font-family: '."Arial".';"> Kab. / Kota </a></li>';
                        #echo '<li><a href="'.site_url("Dashboard/DbKecamatan").'" style="font-family: '."Arial".';"> Kecamatan </a></li>';
                        #echo '<li><a href="'.site_url("Dashboard/DbKelurahan").'" style="font-family: '."Arial".';"> Kelurahan </a></li>';
                    #echo '</ul>';
                #echo '</li>';

                #echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Saksi Perindo </a></li>';

                #echo '<li>';
                    #echo '<a style="font-family: '."Arial".';"><i class="fa fa-database"></i> Saksi Perindo <span class="fa fa-chevron-down"></span></a>';
                    #echo '<ul class="nav child_menu">';
                        #$this->m_wilayah->GetWilayahIndonesiaDbSaksiPerindo();
                    #echo '</ul>';
                #echo '</li>';
            #echo '</ul>';

            #echo '<ul class="nav side-menu">';
                #echo '<li><a href="'.site_url("Dashboard/DbAdminAll").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Admin </a></li>';
            #echo '</ul>';

                #echo '<li><a href="#" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Saksi Perindo </a></li>';
                #echo '<ul class="nav child_menu">';
                    #echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"> Tampilkan Semua </a></li>';
                #echo '</ul>';
            #echo '</ul>';
        #echo '</div>';

        #echo '<div class="menu_section">';
            #echo '<h3 style="font-family: '."Arial".';">Upload Excel</h3>';
            #echo '<ul class="nav side-menu">';
                #echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoExcel").'" style="font-family: '."Arial".';"><i class="fa fa-database"></i> Saksi Perindo </a></li>';
                #echo '<li><a href="'.site_url("Dashboard/ExcelSaksi").'" style="font-family: '."Arial".';"><i class="fa fa-file-text"></i> Upload Data Saksi </a></li>';
            #echo '</ul>';
        #echo '</div>';
    echo '</div>';

?>
