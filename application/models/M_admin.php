<?php

    class M_admin extends CI_Model
    {

        function CreateNewAdmin (
            $User_NamaLengkap,
            #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
            #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
            #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
            $User_Kontak
            #$User_Email, $User_NomorKTP
        ) {
            if ($User_NamaLengkap == NULL || is_numeric($User_NamaLengkap) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Lengkapi nama dengan benar."
                );
                return $result;
            }
            #if ($User_NamaDepan == NULL || is_numeric($User_NamaDepan) == true || is_numeric($User_NamaBelakang) == true)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Lengkapi nama dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_JenisKelamin == NULL || ($User_JenisKelamin != "Laki-laki" && $User_JenisKelamin != "Perempuan"))
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Invalid jenis kelamin."
                #);
                #return $result;
            #}
            #else if ($User_TempatLahir == NULL || is_numeric($User_TempatLahir) == true)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Lengkapi tempat lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_TanggalLahirDD == NULL || strlen($User_TanggalLahirDD) > 2 || (strlen($User_TanggalLahirDD) == 2 && $User_TanggalLahirDD > 31))
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan tanggal lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_TanggalLahirMM == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih bulan lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_TanggalLahirYYYY == NULL || strlen($User_TanggalLahirYYYY) > 4)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan tahun lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdProvinsi == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih provinsi dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdKota == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih kab./kota dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdKecamatan == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih kecamatan dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdKelurahan == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih kelurahan dengan benar."
                #);
                #return $result;
            #}
            else if ($User_Kontak == NULL || strpos($User_Kontak, " ") !== false)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kontak dengan benar."
                );
                return $result;
            }
            #else if ($User_Email == NULL || strpos($User_Email, " ") !== false)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan email dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_NomorKTP == NULL || strpos($User_NomorKTP, " ") !== false)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan nomor ktp dengan benar."
                #);
                #return $result;
            #}
            else
            {
                /*if (strlen($User_TanggalLahirDD) == 1 && ($User_TanggalLahirDD >= 1 || $User_TanggalLahirDD < 10))
                {
                    $User_TanggalLahirDD = "0" . $User_TanggalLahirDD;
                }
                else
                {
                    $User_TanggalLahirDD = "" . $User_TanggalLahirDD;
                }

                if (strlen($User_TanggalLahirYYYY) == 0)
                {
                    $User_TanggalLahirYYYY = "0000";
                }
                else if (strlen($User_TanggalLahirYYYY) >= 1 && strlen($User_TanggalLahirYYYY) < 4)
                {
                    $User_TanggalLahirYYYY = "000" . $User_TanggalLahirYYYY;
                }
                else if (strlen($User_TanggalLahirYYYY) >= 2 && strlen($User_TanggalLahirYYYY) < 4)
                {
                    $User_TanggalLahirYYYY = "00" . $User_TanggalLahirYYYY;
                }
                else if (strlen($User_TanggalLahirYYYY) >= 3 && strlen($User_TanggalLahirYYYY) < 4)
                {
                    $User_TanggalLahirYYYY = "0" . $User_TanggalLahirYYYY;
                }
                else
                {
                    $User_TanggalLahirYYYY = substr($User_TanggalLahirYYYY, 0, 4);
                }
                $User_TanggalLahirYYYYMMDD = $User_TanggalLahirYYYY . "-" . $User_TanggalLahirMM . "-" . $User_TanggalLahirDD;

                if (strlen($User_NomorKTP) == 1)
                {
                    $User_NomorKTP = "00000" . "00000" . "00000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 2)
                {
                    $User_NomorKTP = "00000" . "00000" . "0000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 3)
                {
                    $User_NomorKTP = "00000" . "00000" . "000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 4)
                {
                    $User_NomorKTP = "00000" . "00000" . "00" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 5)
                {
                    $User_NomorKTP = "00000" . "00000" . "0" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 6)
                {
                    $User_NomorKTP = "00000" . "00000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 7)
                {
                    $User_NomorKTP = "00000" . "0000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 8)
                {
                    $User_NomorKTP = "00000" . "000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 9)
                {
                    $User_NomorKTP = "00000" . "00" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 10)
                {
                    $User_NomorKTP = "00000" . "0" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 11)
                {
                    $User_NomorKTP = "00000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 12)
                {
                    $User_NomorKTP = "0000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 13)
                {
                    $User_NomorKTP = "000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 14)
                {
                    $User_NomorKTP = "00" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 15)
                {
                    $User_NomorKTP = "0" . $User_NomorKTP;
                }
                else
                {
                    $User_NomorKTP = "" . $User_NomorKTP;
                }

                $FrontName5;
                $FrontName5Length = strlen($User_NamaDepan);
                if ($FrontName5Length >= 5)
                {
                    $FrontName5 = substr($User_NamaDepan, 0, 5);
                }
                else
                {
                    switch ($FrontName5Length)
                    {
                        case 2:
                            $FrontName5 = $User_NamaDepan . RandomWords(3);
                            break;

                        case 3:
                            $FrontName5 = $User_NamaDepan . RandomWords(2);
                            break;

                        case 4:
                            $FrontName5 = $User_NamaDepan . RandomWords(1);
                            break;

                        default:
                            $FrontName5 = RandomWords(5);
                            break;
                    }
                }

                $BackName2;
                $BackName2Length = strlen($User_NamaBelakang);
                if ($BackName2Length >= 2)
                {
                    $BackName2 = substr($User_NamaBelakang, 0, 2);
                }
                else
                {
                    switch ($BackName2Length)
                    {
                        case 1:
                            $BackName2 = $User_NamaBelakang . RandomWords(1);
                            break;

                        default:
                            $BackName2 = RandomWords(2);
                            break;
                    }
                }*/

                $User_UserLog = (strlen($User_NamaLengkap) > 5 ? "admin-".trim(substr(strtolower($User_NamaLengkap), 0, 5)).".".RandomWords(5) : "admin-".trim(strtolower($User_NamaLengkap)).".".RandomWords(5)); #strtolower($FrontName5) . strtolower($BackName2) . $User_TanggalLahirDD . $User_TanggalLahirMM;
                $xpR5 = randomNumber(6);
                $User_KeyLog = base64_encode(base64_encode(base64_encode($xpR5))); #RandomWords(12)
                $User_KeyH = password_hash($xpR5, PASSWORD_DEFAULT);

                # query mysql
                $result = $this->db->query(
                    "INSERT INTO
                     tbl_ulogin
                     (
                         iduloginlevel,
                         ulog,
                         plog,
                         plog2,
                         plog2ori,
                         unamalengkap,
                         kontak
                     )
                     VALUES
                     (
                         '2',
                         '$User_UserLog',
                         '$User_KeyLog',
                         '$User_KeyH',
                         '$xpR5',
                         '$User_NamaLengkap',
                         '$User_Kontak'
                     );"
                );

                # query postgre sql
                /*$result = $this->db->query(
                    'INSERT INTO
                     tbl_ulogin
                     (
                         iduloginlevel,
                         ulog,
                         plog,
                         plog2,
                         plog2ori,
                         unamalengkap,
                         kontak
                     )
                     VALUES
                     (
                         \'2\',
                         \''.$User_UserLog.'\',
                         \''.$User_KeyLog.'\',
                         \''.$User_KeyH.'\',
                         \''.$xpR5.'\',
                         \''.$User_NamaLengkap.'\',
                         \''.$User_Kontak.'\'
                     );'
                );*/
                /*$result = $this->db->query(
                    "INSERT INTO
                     tbl_users
                     (
                        idlevel, ulog, plog,
                        namadepan, namabelakang, jeniskelamin,
                        tempatlahir, tgllahir,
                        idprovinsi, idkota, idkecamatan, idkelurahan, alamatlengkap,
                        kontak, email, noktp
                     )
                     VALUES
                     (
                        '3', '$User_UserLog', '$User_KeyLog',
                        '$User_NamaDepan', '$User_NamaBelakang', '$User_JenisKelamin',
                        '$User_TempatLahir', '$User_TanggalLahirYYYYMMDD',
                        '$User_IdProvinsi', '$User_IdKota', '$User_IdKecamatan', '$User_IdKelurahan', '$User_AlamatLengkap',
                        '$User_Kontak', '$User_Email', '$User_NomorKTP'
                     );"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Create admin success."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Create admin gagal."
                    );
                    return $result;
                }
            }
        }

        function DeleteAccount ($User_ID)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_ulogin WHERE id = \''.$User_ID.'\';'
            );
            /*$result = $this->db->query(
                "DELETE FROM tbl_users WHERE id = '$User_ID';"
            );*/

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Akun admin berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus akun admin."
                );
                return $result;
            }
        }

        function GetAccount ($User_ID)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_ulogin.unamalengkap AS "User_NamaLengkap",
                 tbl_ulogin.kontak AS "User_Kontak"
                 FROM
                 tbl_ulogin
                 WHERE
                 tbl_ulogin.id = \''.$User_ID.'\';'
            );
            /*$result = $this->db->query(
                "SELECT
                 tbl_users.namadepan AS `User_NamaDepan`,
                 tbl_users.namabelakang AS `User_NamaBelakang`,
                 tbl_users.jeniskelamin AS `User_JenisKelamin`,
                 tbl_users.tempatlahir AS `User_TempatLahir`,
                 LEFT(tbl_users.tgllahir, 4) AS `User_TanggalLahirYYYY`,
                 MID(tbl_users.tgllahir, 6, 2) AS `User_TanggalLahirMM`,
                 RIGHT(tbl_users.tgllahir, 2) AS `User_TanggalLahirDD`,

                 tbl_users.idprovinsi AS `User_IdProvinsi`,
                 tbl_users.idkota AS `User_IdKota`,
                 tbl_users.idkecamatan AS `User_IdKecamatan`,
                 tbl_users.idkelurahan AS `User_IdKelurahan`,
                 tbl_users.alamatlengkap AS `User_AlamatLengkap`,

                 tbl_users.kontak AS `User_Kontak`,
                 tbl_users.email AS `User_Email`,
                 tbl_users.noktp AS `User_NomorKTP`
                 FROM
                 tbl_users
                 WHERE
                 tbl_users.id = '$User_ID';"
            );*/

            if($result->num_rows() == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label style="font-size: 20px; margin-bott  om: 15px;">Identitas Admin</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_User_ID" value="'.$User_ID.'" hidden/>';

                    echo '<label for="fullname">Nama Lengkap</label>';
                    echo '<input type="text" id="fullname" name="text_User_NamaLengkap" class="form-control" style="margin-bottom: 15px;" value="'.$data->User_NamaLengkap.'" placeholder="..." required autofocus />';
                    #echo '<input type="text" id="fullname" name="text_User_NamaBelakang" class="form-control" style="margin-bottom: 15px;" value="'.$data->User_NamaBelakang.'" placeholder="nama belakang"/>';

                    #echo '<label>Jenis Kelamin</label>';
                    #echo '<p style="margin-bottom: 15px;">';
                        #if ($data->User_JenisKelamin == "Laki-laki")
                        #{
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" checked required />&nbsp;Laki-laki';
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" />&nbsp;Perempuan';
                        #}
                        #else if ($data->User_JenisKelamin == "Perempuan")
                        #{
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" required />&nbsp;Laki-laki';
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" checked style="margin-left: 15px;" />&nbsp;Perempuan';
                        #}
                        #else
                        #{
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" required />&nbsp;Laki-laki';
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" />&nbsp;Perempuan';
                        #}
                    #echo '</p>';

                    #echo '<label for="bornplace">Tempat Lahir</label>';
                    #echo '<input type="text" id="bornplace" class="form-control" name="text_User_Tempatlahir" data-parsley-trigger="change" value="'.$data->User_TempatLahir.'" style="margin-bottom: 15px;" required />';

                    #echo '<label for="borndate">Tanggal Lahir</label>';
                    #echo '<table style="margin-bottom: 50px;">';
                        #echo '<th>';
                            #echo '<input type="text" id="borndatedd" class="form-control" name="text_User_TanggalLahirDD" data-parsley-trigger="change" value="'.$data->User_TanggalLahirDD.'" style="width: 50px; margin-right: 10px; text-align: center;" required />';
                        #echo '</th>';
                        #echo '<th>';
                            #echo '<select id="borndatemm" name="spinner_User_TanggalLahir" class="form-control" style="width: 150px; margin-right: 10px;" required>';
                                #echo '<option value="" selected>Pilih</option>';
                                #for($i = 0; $i <= 12; $i++)
                                #{
                                    #$IsSelectedMonth;
                                    #if ($i == $data->User_TanggalLahirMM)
                                    #{
                                        #$IsSelectedMonth = "selected";
                                    #}
                                    #else
                                    #{
                                        #$IsSelectedMonth = "";
                                    #}

                                    #if ($i < 10)
                                    #{
                                        #$i = "0" . $i;

                                        #switch ($i)
                                        #{
                                            #case "01":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Januari</option>';
                                                #break;
                                            #case "02":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Februari</option>';
                                                #break;
                                            #case "03":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Maret</option>';
                                                #break;
                                            #case "04":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>April</option>';
                                                #break;
                                            #case "05":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Mei</option>';
                                                #break;
                                            #case "06":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Juni</option>';
                                                #break;
                                            #case "07":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Juli</option>';
                                                #break;
                                            #case "08":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Agustus</option>';
                                                #break;
                                            #case "09":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>September</option>';
                                                #break;
                                        #}
                                    #}
                                    #else
                                    #{
                                        #$i = "" . $i;

                                        #switch ($i)
                                        #{
                                            #case "10":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Oktober</option>';
                                                #break;
                                            #case "11":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>November</option>';
                                                #break;
                                            #case "12":
                                                #echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Desember</option>';
                                                #break;
                                        #}
                                    #}
                                #}
                            #echo '</select>';
                        #echo '</th>';
                        #echo '<th>';
                            #echo '<input type="text" id="borndateyyyy" class="form-control" name="text_User_TanggalLahirYYYY" data-parsley-trigger="change" value="'.$data->User_TanggalLahirYYYY.'" style="width: 65px; text-align: center;" required />';
                        #echo '</th>';
                    #echo '</table>';

                    #echo '<label style="font-size: 20px; margin-bottom: 15px;">Wilayah</label>';
                    #echo '<div class="clearfix"></div>';

                    #echo '<label for="spinnerprovinsi">Provinsi</label>';
                    #echo '<select id="spinnerprovinsi" name="spinner_User_Provinsi" class="form-control" style="margin-bottom: 15px;" required onclick="LoadProvinsiOnSelected();">';
                        #$this->m_wilayah->GetProvinsi3($data->User_IdProvinsi);
                    #echo '</select>';

                    #echo '<label for="spinnerkota">Kab. / Kota</label>';
                    #echo '<select id="spinnerkota" name="spinner_User_Kota" class="form-control" style="margin-bottom: 15px;" required onclick="LoadKotaOnSelected();">';
                        #$this->m_wilayah->GetKota2($data->User_IdProvinsi, $data->User_IdKota);
                    #echo '</select>';

                    #echo '<label for="spinnerkecamatan">Kecamatan</label>';
                    #echo '<select id="spinnerkecamatan" name="spinner_User_Kecamatan" class="form-control" style="margin-bottom: 15px;" required>';
                        #$this->m_wilayah->GetKecamatan2($data->User_IdProvinsi, $data->User_IdKota, $data->User_IdKecamatan);
                    #echo '</select>';

                    #echo '<label for="spinnerkelurahan">Kelurahan</label>';
                    #echo '<select id="spinnerkelurahan" name="spinner_User_Kelurahan" class="form-control" style="margin-bottom: 15px;" required>';
                        #$this->m_wilayah->GetKelurahan2($data->User_IdProvinsi, $data->User_IdKota, $data->User_IdKecamatan, $data->User_IdKelurahan);
                    #echo '</select>';

                    #echo '<label for="homeaddress">Alamat Lengkap</label>';
                    #echo '<textarea id="homeaddress" required="required" class="form-control" name="text_User_AlamatLengkap" data-parsley-trigger="keyup" data-parsley-minlength="12" data-parsley-maxlength="150" data-parsley-minlength-message="Min. 12 karakter!" data-parsley-validation-threshold="10" style="height: 150px; margin-bottom: 50px;">'.$data->User_AlamatLengkap.'</textarea>';

                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Data Unique</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<label for="contact">Kontak</label>';
                    echo '<input type="phone" id="contact" class="form-control" name="text_User_Kontak" data-parsley-trigger="change" value="'.$data->User_Kontak.'" style="margin-bottom: 15px;" required />';

                    #echo '<label for="email">Email</label>';
                    #echo '<input type="email" id="email" class="form-control" name="text_User_Email" data-parsley-trigger="change" value="'.$data->User_Email.'" style="margin-bottom: 15px;" required />';

                    #echo '<label for="nomorktp">Nomor KTP</label>';
                    #echo '<input type="number" id="nomorktp" class="form-control" name="text_User_NomorKTP" data-parsley-trigger="change" value="'.$data->User_NomorKTP.'" style="margin-bottom: 15px;" required />';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function PreparedExportAdminAll ()
        {
            $result = $this->db->query(
                "SELECT
                 tbl_ulogin.id AS `Admin_Id`,
                 tbl_ulogin.unamalengkap AS `Admin_NamaLengkap`,
                 tbl_ulogin.kontak AS `Admin_NoHP`,
                 tbl_ulogin.ulog AS `Admin_Ulog`,
                 tbl_ulogin.plog AS `Admin_Plog`
                 FROM
                 tbl_ulogin
                 WHERE
                 tbl_ulogin.iduloginlevel = '2' AND
                 tbl_ulogin.isactive = '1' AND
                 (tbl_ulogin.ulog != NULL OR tbl_ulogin.ulog != '') AND
                 (tbl_ulogin.plog != NULL OR tbl_ulogin.plog != '') AND
                 (tbl_ulogin.plog2 != NULL OR tbl_ulogin.plog2 != '') AND
                 (tbl_ulogin.plog2ori != NULL OR tbl_ulogin.plog2ori != '')
                 ORDER BY
                 tbl_ulogin.unamalengkap ASC;"
            );

            $xlog = $result->num_rows();

            $aData = array();

            if ($xlog > 0)
            {
                foreach ($result->result() as $data)
                {
                    $aData[] = array(
                        "namalengkap" => $data->Admin_NamaLengkap,
                        "nohp" => $data->Admin_NoHP,
                        "username" => $data->Admin_Ulog,
                        "password" => base64_decode(base64_decode(base64_decode($data->Admin_Plog)))
                    );
                }
            }

            $result = $aData;
            return $result;
        }

        function ListDataAdmin ()
        {
            #date_default_timezone_set("Asia/Jakarta");
            #$datetime_yyyy = date("Y");

            /*die(
                'SELECT
                 tbl_ulogin.unamalengkap AS "Users_NamaLengkap",
                 tbl_ulogin.isactive AS "Users_IsActive",
                 tbl_uloginlevel.ulevel AS "Users_Level"
                 FROM
                 tbl_ulogin
                 LEFT JOIN
                 tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
                 WHERE
                 tbl_ulogin.isactive = \'1\' AND
                 tbl_ulogin.iduloginlevel = \'3\'
                 ORDER BY
                 tbl_ulogin.unamalengkap
                 LIMIT 5;'
            );*/

            $result = $this->db->query(
                'SELECT
                 tbl_ulogin.unamalengkap AS "Users_NamaLengkap",
                 tbl_ulogin.isactive AS "Users_IsActive",
                 tbl_uloginlevel.ulevel AS "Users_Level"
                 FROM
                 tbl_ulogin
                 LEFT JOIN
                 tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
                 WHERE
                 tbl_ulogin.isactive = \'1\' AND
                 tbl_ulogin.iduloginlevel = \'2\'
                 ORDER BY
                 tbl_ulogin.unamalengkap
                 LIMIT 5;'
            );

            /*$result = $this->db->query(
                "SELECT
                    tbl_users.id AS `Users_ID`,
                    tbl_users.namadepan AS `Users_NamaDepan`,
                    tbl_users.namabelakang AS `Users_NamaBelakang`,
                    LEFT(tbl_users.tgllahir, 4) AS `Users_TanggalLahirYYYY`,
                    tbl_users.photourl AS `Users_PhotoUrl`,

                    tbl_users.idprovinsi AS `Users_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Users_NamaProvinsi`,
                    tbl_users.idkota AS `Users_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Users_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Users_NamaKota`
                FROM
                    tbl_users
                LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_users.idprovinsi
                LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_users.idkota
                WHERE
                    tbl_users.idlevel = '3' AND
                    tbl_users.isactive = '1'
                ORDER BY
                    tbl_users.namadepan ASC
                LIMIT 0, 5;"
            );*/

            $x = $result->num_rows();

            #if($result->num_rows() > 0)
            if ($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Users_NamaLengkap = $data->Users_NamaLengkap;
                    $Users_IsActive = $data->Users_IsActive;
                    $Users_Level = $data->Users_Level;
                    $Users_PhotoUrl = base_url()."/assets/images/img.jpg"; #"https://github.githubassets.com/images/modules/logos_page/Octocat.png";

                    #$Users_NamaDepan = $data->Users_NamaDepan;
                    #$Users_NamaBelakang = $data->Users_NamaBelakang;
                    #$Users_TanggalLahirYYYY = $data->Users_TanggalLahirYYYY;
                    #$Users_TanggalLahirYYYY = "Usia " . ($datetime_yyyy - $Users_TanggalLahirYYYY) . " tahun";
                    #$Users_PhotoUrl = $data->Users_PhotoUrl;
                    #if ($Users_PhotoUrl == NULL)
                    #{
                        #$Users_PhotoUrl = base_url()."/assets/images/img.jpg";
                    #}
                    #else
                    #{
                        #$Users_PhotoUrl = base_url()."/upload/images/" . $data->Users_PhotoUrl;
                    #}

                    #$Users_KategoriKota = $data->Users_KategoriKota;
                    #$Users_NamaKota;
                    #if ($Users_KategoriKota == NULL)
                    #{
                        #$Users_NamaKota = "";
                    #}
                    #else
                    #{
                        #$Users_NamaKota = $Users_KategoriKota . " " . $data->Users_NamaKota;
                    #}
                    #$Users_NamaProvinsi = $data->Users_NamaProvinsi;
                    #$Users_DataWilayah;
                    #if ($Users_NamaKota == NULL)
                    #{
                        #$Users_DataWilayah = "" . $Users_NamaProvinsi;
                    #}
                    #else
                    #{
                        #$Users_DataWilayah = $Users_NamaKota . ", " . $Users_NamaProvinsi;
                    #}

                    #if ($Users_DataWilayah == NULL)
                    #{
                        #$Users_DataWilayah = "-";
                    #}

                    echo
                    '
                        <li class="media event">
                            <a class="pull-left border-aero profile_thumb">
                                <img class="img-circle profile_img" src='.$Users_PhotoUrl.' style="width: 50px; height: 50px; margin-left: -13px; margin-top: -10px; object-fit: cover;">
                            </a>

                            <div class="media-body">
                                <a class="title" href="#" style="font-family: `Arial`;" ><font color="#263238">'.$Users_NamaLengkap.'</font></a>
                                <p style="font-family: `Arial`;" ><font color="#263238">'.$Users_Level.'</font></p>
                                <small style="font-family: `Arial`;" ><font color="#263238">'."Status : " . ($Users_IsActive == "1" ? "Aktif" : "Non-aktif").'</font></small>
                            </div>
                        </li>
                    ';
                }
            }

            return $result;
        }

        function ListDataAdminAll ()
        {
            #date_default_timezone_set("Asia/Jakarta");
            #$datetime_yyyy = date("Y");

            $result = $this->db->query(
                'SELECT
                 tbl_ulogin.id AS "User_ID",
                 tbl_ulogin.unamalengkap AS "User_NamaLengkap",
                 tbl_ulogin.kontak AS "User_Kontak",
                 tbl_ulogin.ulog AS "User_UserLog",
                 tbl_ulogin.isactive AS "User_IsActive",
                 tbl_uloginlevel.ulevel AS "User_Level"
                 FROM
                 tbl_ulogin
                 LEFT JOIN
                 tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
                 WHERE
                 tbl_uloginlevel.id = \'2\'
                 ORDER BY
                 tbl_ulogin.unamalengkap ASC,
                 tbl_ulogin.isactive DESC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    tbl_users.id AS `User_ID`,
                    tbl_users.isactive AS `User_IsActive`,

                    tbl_users.namadepan AS `User_NamaDepan`,
                    tbl_users.namabelakang AS `User_NamaBelakang`,
                    tbl_users.jeniskelamin AS `User_JenisKelamin`,
                    tbl_users.tempatlahir AS `User_TempatLahir`,
                    LEFT(tbl_users.tgllahir, 4) AS `User_TanggalLahirYYYY`,
                    MID(tbl_users.tgllahir, 6, 2) AS `User_TanggalLahirMM`,
                    RIGHT(tbl_users.tgllahir, 2) AS `User_TanggalLahirDD`,

                    tbl_users.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                    tbl_users.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,
                    tbl_users.idkecamatan AS `Kecamatan_IdKecamatan`,
                    IF(tbl_kecamatan.kecamatan IS NULL, '', tbl_kecamatan.kecamatan) AS `Kecamatan_NamaKecamatan`,
                    tbl_users.idkelurahan AS `Kelurahan_IdKelurahan`,
                    IF(tbl_kelurahan.kelurahan IS NULL, '', tbl_kelurahan.kelurahan) AS `Kelurahan_NamaKelurahan`,
                    tbl_users.alamatlengkap AS `User_AlamatLengkap`,

                    tbl_users.kontak AS `User_Kontak`,
                    tbl_users.email AS `User_Email`,
                    tbl_users.noktp AS `User_NomorKTP`
                FROM
                    tbl_users
                LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_users.idprovinsi
                LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_users.idkota
                LEFT JOIN
                    tbl_kecamatan ON tbl_kecamatan.id = tbl_users.idkecamatan
                LEFT JOIN
                    tbl_kelurahan ON tbl_kelurahan.id = tbl_users.idkelurahan
                WHERE
                    tbl_users.idlevel = '3'
                ORDER BY
                    tbl_provinsi.idwilayah ASC,
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC,
                    tbl_kelurahan.kelurahan ASC,
                    tbl_users.namadepan ASC,
                    tbl_users.namabelakang ASC;"
            );*/

            $x = $result->num_rows();

            #if($result->num_rows() > 0)
            if ($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_User_ID = $data->User_ID;
                    $Var_User_IsActive = $data->User_IsActive;
                    $Var_User_IsActive2;
                    switch ($Var_User_IsActive)
                    {
                        case 1:
                            $Var_User_IsActive2 = "Aktif";
                            break;
                        default:
                            $Var_User_IsActive2 = "Belum aktif";
                            break;
                    }

                    $Var_User_NamaLengkap = $data->User_NamaLengkap;
                    #$Var_User_NamaDepan = $data->User_NamaDepan;
                    #$Var_User_NamaBelakang = $data->User_NamaBelakang;
                    #$Var_User_JenisKelamin = $data->User_JenisKelamin;
                    #$Var_User_TempatLahir = $data->User_TempatLahir;
                    #$Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
                    #$Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
                    #$Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;

                    #$Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    #$Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;
                    #$Var_Kota_IdKota = $data->Kota_IdKota;
                    #$Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    #$Var_Kota_NamaKota = $data->Kota_NamaKota;
                    #$Var_Kota_NamaKota2;
                    #if ($Var_Kota_KategoriKota == NULL || $Var_Kota_NamaKota == NULL)
                    #{
                        #$Var_Kota_NamaKota2 = "";
                    #}
                    #else
                    #{
                        #$Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    #}
                    #$Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    #$Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;
                    #$Var_Kelurahan_IdKelurahan = $data->Kelurahan_IdKelurahan;
                    #$Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;
                    #$Var_User_AlamatLengkap = $data->User_AlamatLengkap;

                    $Var_User_Kontak = $data->User_Kontak;
                    $Var_User_UserLog = $data->User_UserLog;
                    #$Var_User_Email = $data->User_Email;
                    #$Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        echo '<td>'.$Var_User_NamaLengkap.'</td>';
                        #echo '<td>'.$Var_User_NamaDepan.'</td>';
                        #echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        #echo '<td>'.$Var_User_JenisKelamin.'</td>';
                        #echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        #echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        #echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        #echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        echo '<td>'.$Var_User_Kontak.'</td>';
                        echo '<td>'.$Var_User_UserLog.'</td>';
                        echo '<td>'.$Var_User_IsActive2.'</td>';

                        #$Var_User_NamaLengkapX;
                        #if ($Var_User_NamaBelakang == NULL)
                        #{
                            #$Var_User_NamaLengkapX = $Var_User_NamaDepan;
                        #}
                        #else
                        #{
                            #$Var_User_NamaLengkapX = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        #}
                        # $Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        echo '<td align="center">';
                            echo '<a href="'.site_url("Dashboard/EditAdmin").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteAdmin(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataAdminAll_v2 ()
        {
            #date_default_timezone_set("Asia/Jakarta");
            #$datetime_yyyy = date("Y");

            $result = $this->db->query(
                'SELECT
                 tbl_ulogin.id AS "User_ID",
                 tbl_ulogin.unamalengkap AS "User_NamaLengkap",
                 tbl_ulogin.kontak AS "User_Kontak",
                 tbl_ulogin.ulog AS "User_UserLog",
                 tbl_ulogin.isactive AS "User_IsActive",
                 tbl_uloginlevel.ulevel AS "User_Level"
                 FROM
                 tbl_ulogin
                 LEFT JOIN
                 tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
                 WHERE
                 tbl_uloginlevel.id = \'2\'
                 ORDER BY
                 tbl_ulogin.unamalengkap ASC,
                 tbl_ulogin.isactive DESC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    tbl_users.id AS `User_ID`,
                    tbl_users.isactive AS `User_IsActive`,

                    tbl_users.namadepan AS `User_NamaDepan`,
                    tbl_users.namabelakang AS `User_NamaBelakang`,
                    tbl_users.jeniskelamin AS `User_JenisKelamin`,
                    tbl_users.tempatlahir AS `User_TempatLahir`,
                    LEFT(tbl_users.tgllahir, 4) AS `User_TanggalLahirYYYY`,
                    MID(tbl_users.tgllahir, 6, 2) AS `User_TanggalLahirMM`,
                    RIGHT(tbl_users.tgllahir, 2) AS `User_TanggalLahirDD`,

                    tbl_users.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                    tbl_users.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,
                    tbl_users.idkecamatan AS `Kecamatan_IdKecamatan`,
                    IF(tbl_kecamatan.kecamatan IS NULL, '', tbl_kecamatan.kecamatan) AS `Kecamatan_NamaKecamatan`,
                    tbl_users.idkelurahan AS `Kelurahan_IdKelurahan`,
                    IF(tbl_kelurahan.kelurahan IS NULL, '', tbl_kelurahan.kelurahan) AS `Kelurahan_NamaKelurahan`,
                    tbl_users.alamatlengkap AS `User_AlamatLengkap`,

                    tbl_users.kontak AS `User_Kontak`,
                    tbl_users.email AS `User_Email`,
                    tbl_users.noktp AS `User_NomorKTP`
                FROM
                    tbl_users
                LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_users.idprovinsi
                LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_users.idkota
                LEFT JOIN
                    tbl_kecamatan ON tbl_kecamatan.id = tbl_users.idkecamatan
                LEFT JOIN
                    tbl_kelurahan ON tbl_kelurahan.id = tbl_users.idkelurahan
                WHERE
                    tbl_users.idlevel = '3'
                ORDER BY
                    tbl_provinsi.idwilayah ASC,
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC,
                    tbl_kelurahan.kelurahan ASC,
                    tbl_users.namadepan ASC,
                    tbl_users.namabelakang ASC;"
            );*/

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_User_ID = $data->User_ID;
                    $Var_User_IsActive = $data->User_IsActive;
                    $Var_User_IsActive2;
                    switch ($Var_User_IsActive)
                    {
                        case 1:
                            $Var_User_IsActive2 = "Aktif";
                            break;
                        default:
                            $Var_User_IsActive2 = "Belum aktif";
                            break;
                    }

                    $Var_User_NamaLengkap = $data->User_NamaLengkap;
                    #$Var_User_NamaDepan = $data->User_NamaDepan;
                    #$Var_User_NamaBelakang = $data->User_NamaBelakang;
                    #$Var_User_JenisKelamin = $data->User_JenisKelamin;
                    #$Var_User_TempatLahir = $data->User_TempatLahir;
                    #$Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
                    #$Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
                    #$Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;

                    #$Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    #$Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;
                    #$Var_Kota_IdKota = $data->Kota_IdKota;
                    #$Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    #$Var_Kota_NamaKota = $data->Kota_NamaKota;
                    #$Var_Kota_NamaKota2;
                    #if ($Var_Kota_KategoriKota == NULL || $Var_Kota_NamaKota == NULL)
                    #{
                        #$Var_Kota_NamaKota2 = "";
                    #}
                    #else
                    #{
                        #$Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    #}
                    #$Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    #$Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;
                    #$Var_Kelurahan_IdKelurahan = $data->Kelurahan_IdKelurahan;
                    #$Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;
                    #$Var_User_AlamatLengkap = $data->User_AlamatLengkap;

                    $Var_User_Kontak = $data->User_Kontak;
                    $Var_User_UserLog = $data->User_UserLog;
                    #$Var_User_Email = $data->User_Email;
                    #$Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        echo '<td>'.$Var_User_NamaLengkap.'</td>';
                        #echo '<td>'.$Var_User_NamaDepan.'</td>';
                        #echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        #echo '<td>'.$Var_User_JenisKelamin.'</td>';
                        #echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        #echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        #echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        #echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        echo '<td>'.$Var_User_Kontak.'</td>';
                        echo '<td>'.$Var_User_UserLog.'</td>';
                        echo '<td>'.$Var_User_IsActive2.'</td>';

                        # $Var_User_NamaLengkap;
                        # if ($Var_User_NamaBelakang == NULL)
                        # {
                            # $Var_User_NamaLengkap = $Var_User_NamaDepan;
                        # }
                        # else
                        # {
                            # $Var_User_NamaLengkap = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        # }
                        # $Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        echo '<td align="center">';
                            echo '<a href="'.site_url("Admin/EditAdmin").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteAdmin(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataAdminByIdWilayah ($IdWilayah)
        {
            date_default_timezone_set("Asia/Jakarta");
            $datetime_yyyy = date("Y");

            $result = $this->db->query(
                "SELECT
                    tbl_users.id AS `User_ID`,
                    tbl_users.isactive AS `User_IsActive`,

                    tbl_users.namadepan AS `User_NamaDepan`,
                    tbl_users.namabelakang AS `User_NamaBelakang`,
                    tbl_users.jeniskelamin AS `User_JenisKelamin`,
                    tbl_users.tempatlahir AS `User_TempatLahir`,
                    LEFT(tbl_users.tgllahir, 4) AS `User_TanggalLahirYYYY`,
                    MID(tbl_users.tgllahir, 6, 2) AS `User_TanggalLahirMM`,
                    RIGHT(tbl_users.tgllahir, 2) AS `User_TanggalLahirDD`,

                    tbl_users.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                    tbl_users.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,
                    tbl_users.idkecamatan AS `Kecamatan_IdKecamatan`,
                    IF(tbl_kecamatan.kecamatan IS NULL, '', tbl_kecamatan.kecamatan) AS `Kecamatan_NamaKecamatan`,
                    tbl_users.idkelurahan AS `Kelurahan_IdKelurahan`,
                    IF(tbl_kelurahan.kelurahan IS NULL, '', tbl_kelurahan.kelurahan) AS `Kelurahan_NamaKelurahan`,
                    tbl_users.alamatlengkap AS `User_AlamatLengkap`,

                    tbl_users.kontak AS `User_Kontak`,
                    tbl_users.email AS `User_Email`,
                    tbl_users.noktp AS `User_NomorKTP`
                FROM
                    tbl_users
                LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_users.idprovinsi
                LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_users.idkota
                LEFT JOIN
                    tbl_kecamatan ON tbl_kecamatan.id = tbl_users.idkecamatan
                LEFT JOIN
                    tbl_kelurahan ON tbl_kelurahan.id = tbl_users.idkelurahan
                WHERE
                    tbl_users.idlevel = '3' AND
                    tbl_provinsi.idwilayah = '$IdWilayah'
                ORDER BY
                    tbl_provinsi.idwilayah ASC,
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC,
                    tbl_kelurahan.kelurahan ASC,
                    tbl_users.namadepan ASC,
                    tbl_users.namabelakang ASC;"
            );

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_User_ID = $data->User_ID;
                    $Var_User_IsActive = $data->User_IsActive;
                    $Var_User_IsActive2;
                    switch ($Var_User_IsActive)
                    {
                        case 1:
                            $Var_User_IsActive2 = "Aktif";
                            break;
                        default:
                            $Var_User_IsActive2 = "Belum aktif";
                            break;
                    }

                    $Var_User_NamaDepan = $data->User_NamaDepan;
                    $Var_User_NamaBelakang = $data->User_NamaBelakang;
                    $Var_User_JenisKelamin = $data->User_JenisKelamin;
                    $Var_User_TempatLahir = $data->User_TempatLahir;
                    $Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
                    $Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
                    $Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;

                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;
                    $Var_Kota_IdKota = $data->Kota_IdKota;
                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Kota_NamaKota2;
                    if ($Var_Kota_KategoriKota == NULL || $Var_Kota_NamaKota == NULL)
                    {
                        $Var_Kota_NamaKota2 = "";
                    }
                    else
                    {
                        $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    }
                    $Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;
                    $Var_Kelurahan_IdKelurahan = $data->Kelurahan_IdKelurahan;
                    $Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;
                    $Var_User_AlamatLengkap = $data->User_AlamatLengkap;

                    $Var_User_Kontak = $data->User_Kontak;
                    $Var_User_Email = $data->User_Email;
                    $Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        echo '<td>'.$Var_User_NamaDepan.'</td>';
                        echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        echo '<td>'.$Var_User_JenisKelamin.'</td>';
                        # echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        echo '<td>'.$Var_User_Kontak.'</td>';
                        echo '<td>'.$Var_User_IsActive2.'</td>';

                        $Var_User_NamaLengkap;
                        if ($Var_User_NamaBelakang == NULL)
                        {
                            $Var_User_NamaLengkap = $Var_User_NamaDepan;
                        }
                        else
                        {
                            $Var_User_NamaLengkap = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        }
                        # $Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        echo '<td align="center">';
                            echo '<a href="'.site_url("Dashboard/EditAdmin").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteAdmin(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataAdminByIdWilayah_v2 ($IdWilayah)
        {
            date_default_timezone_set("Asia/Jakarta");
            $datetime_yyyy = date("Y");

            $result = $this->db->query(
                "SELECT
                    tbl_users.id AS `User_ID`,
                    tbl_users.isactive AS `User_IsActive`,

                    tbl_users.namadepan AS `User_NamaDepan`,
                    tbl_users.namabelakang AS `User_NamaBelakang`,
                    tbl_users.jeniskelamin AS `User_JenisKelamin`,
                    tbl_users.tempatlahir AS `User_TempatLahir`,
                    LEFT(tbl_users.tgllahir, 4) AS `User_TanggalLahirYYYY`,
                    MID(tbl_users.tgllahir, 6, 2) AS `User_TanggalLahirMM`,
                    RIGHT(tbl_users.tgllahir, 2) AS `User_TanggalLahirDD`,

                    tbl_users.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                    tbl_users.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,
                    tbl_users.idkecamatan AS `Kecamatan_IdKecamatan`,
                    IF(tbl_kecamatan.kecamatan IS NULL, '', tbl_kecamatan.kecamatan) AS `Kecamatan_NamaKecamatan`,
                    tbl_users.idkelurahan AS `Kelurahan_IdKelurahan`,
                    IF(tbl_kelurahan.kelurahan IS NULL, '', tbl_kelurahan.kelurahan) AS `Kelurahan_NamaKelurahan`,
                    tbl_users.alamatlengkap AS `User_AlamatLengkap`,

                    tbl_users.kontak AS `User_Kontak`,
                    tbl_users.email AS `User_Email`,
                    tbl_users.noktp AS `User_NomorKTP`
                FROM
                    tbl_users
                LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_users.idprovinsi
                LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_users.idkota
                LEFT JOIN
                    tbl_kecamatan ON tbl_kecamatan.id = tbl_users.idkecamatan
                LEFT JOIN
                    tbl_kelurahan ON tbl_kelurahan.id = tbl_users.idkelurahan
                WHERE
                    tbl_users.idlevel = '3' AND
                    tbl_provinsi.idwilayah = '$IdWilayah'
                ORDER BY
                    tbl_provinsi.idwilayah ASC,
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC,
                    tbl_kelurahan.kelurahan ASC,
                    tbl_users.namadepan ASC,
                    tbl_users.namabelakang ASC;"
            );

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_User_ID = $data->User_ID;
                    $Var_User_IsActive = $data->User_IsActive;
                    $Var_User_IsActive2;
                    switch ($Var_User_IsActive)
                    {
                        case 1:
                            $Var_User_IsActive2 = "Aktif";
                            break;
                        default:
                            $Var_User_IsActive2 = "Belum aktif";
                            break;
                    }

                    $Var_User_NamaDepan = $data->User_NamaDepan;
                    $Var_User_NamaBelakang = $data->User_NamaBelakang;
                    $Var_User_JenisKelamin = $data->User_JenisKelamin;
                    $Var_User_TempatLahir = $data->User_TempatLahir;
                    $Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
                    $Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
                    $Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;

                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;
                    $Var_Kota_IdKota = $data->Kota_IdKota;
                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Kota_NamaKota2;
                    if ($Var_Kota_KategoriKota == NULL || $Var_Kota_NamaKota == NULL)
                    {
                        $Var_Kota_NamaKota2 = "";
                    }
                    else
                    {
                        $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    }
                    $Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;
                    $Var_Kelurahan_IdKelurahan = $data->Kelurahan_IdKelurahan;
                    $Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;
                    $Var_User_AlamatLengkap = $data->User_AlamatLengkap;

                    $Var_User_Kontak = $data->User_Kontak;
                    $Var_User_Email = $data->User_Email;
                    $Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        echo '<td>'.$Var_User_NamaDepan.'</td>';
                        echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        echo '<td>'.$Var_User_JenisKelamin.'</td>';
                        # echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        echo '<td>'.$Var_User_Kontak.'</td>';
                        echo '<td>'.$Var_User_IsActive2.'</td>';

                        # $Var_User_NamaLengkap;
                        # if ($Var_User_NamaBelakang == NULL)
                        # {
                            # $Var_User_NamaLengkap = $Var_User_NamaDepan;
                        # }
                        # else
                        # {
                            # $Var_User_NamaLengkap = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        # }
                        # $Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        # echo '<td align="center">';
                            # echo '<a href="'.site_url("Dashboard/EditAdmin").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            # echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteAdmin(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        # echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function UpdateProfile (
            $User_ID, $User_NamaLengkap,
            #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
            #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
            #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
            $User_Kontak
            #$User_Email, $User_NomorKTP
        ) {
            if ($User_NamaLengkap == NULL || is_numeric($User_NamaLengkap) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Lengkapi nama dengan benar."
                );
                return $result;
            }
            #if ($User_NamaDepan == NULL || is_numeric($User_NamaDepan) == true || is_numeric($User_NamaBelakang) == true)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Lengkapi nama dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_JenisKelamin == NULL || ($User_JenisKelamin != "Laki-laki" && $User_JenisKelamin != "Perempuan"))
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Invalid jenis kelamin."
                #);
                #return $result;
            #}
            #else if ($User_TempatLahir == NULL || is_numeric($User_TempatLahir) == true)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Lengkapi tempat lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_TanggalLahirDD == NULL || strlen($User_TanggalLahirDD) > 2 || is_numeric($User_TanggalLahirDD) == false || (strlen($User_TanggalLahirDD) == 2 && $User_TanggalLahirDD > 31))
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan tanggal lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_TanggalLahirMM == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih bulan lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_TanggalLahirYYYY == NULL || strlen($User_TanggalLahirYYYY) > 4 || is_numeric($User_TanggalLahirYYYY) == false)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan tahun lahir dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdProvinsi == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih provinsi dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdKota == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih kab./kota dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdKecamatan == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih kecamatan dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_IdKelurahan == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Pilih kelurahan dengan benar."
                #);
                #return $result;
            #}
            else if ($User_Kontak == NULL || strpos($User_Kontak, " ") !== false)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kontak dengan benar."
                );
                return $result;
            }
            #else if ($User_Email == NULL || strpos($User_Email, " ") !== false)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan email dengan benar."
                #);
                #return $result;
            #}
            #else if ($User_NomorKTP == NULL || strpos($User_NomorKTP, " ") !== false)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan nomor ktp dengan benar."
                #);
                #return $result;
            #}
            else
            {
                /*if (strlen($User_TanggalLahirDD) == 1 && ($User_TanggalLahirDD >= 1 || $User_TanggalLahirDD < 10))
                {
                    $User_TanggalLahirDD = "0" . $User_TanggalLahirDD;
                }
                else
                {
                    $User_TanggalLahirDD = "" . $User_TanggalLahirDD;
                }

                if (strlen($User_TanggalLahirYYYY) == 0)
                {
                    $User_TanggalLahirYYYY = "0000";
                }
                else if (strlen($User_TanggalLahirYYYY) >= 1 && strlen($User_TanggalLahirYYYY) < 4)
                {
                    $User_TanggalLahirYYYY = "000" . $User_TanggalLahirYYYY;
                }
                else if (strlen($User_TanggalLahirYYYY) >= 2 && strlen($User_TanggalLahirYYYY) < 4)
                {
                    $User_TanggalLahirYYYY = "00" . $User_TanggalLahirYYYY;
                }
                else if (strlen($User_TanggalLahirYYYY) >= 3 && strlen($User_TanggalLahirYYYY) < 4)
                {
                    $User_TanggalLahirYYYY = "0" . $User_TanggalLahirYYYY;
                }
                else
                {
                    $User_TanggalLahirYYYY = substr($User_TanggalLahirYYYY, 0, 4);
                }
                $User_TanggalLahirYYYYMMDD = $User_TanggalLahirYYYY . "-" . $User_TanggalLahirMM . "-" . $User_TanggalLahirDD;

                if (strlen($User_NomorKTP) == 1)
                {
                    $User_NomorKTP = "00000" . "00000" . "00000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 2)
                {
                    $User_NomorKTP = "00000" . "00000" . "0000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 3)
                {
                    $User_NomorKTP = "00000" . "00000" . "000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 4)
                {
                    $User_NomorKTP = "00000" . "00000" . "00" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 5)
                {
                    $User_NomorKTP = "00000" . "00000" . "0" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 6)
                {
                    $User_NomorKTP = "00000" . "00000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 7)
                {
                    $User_NomorKTP = "00000" . "0000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 8)
                {
                    $User_NomorKTP = "00000" . "000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 9)
                {
                    $User_NomorKTP = "00000" . "00" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 10)
                {
                    $User_NomorKTP = "00000" . "0" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 11)
                {
                    $User_NomorKTP = "00000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 12)
                {
                    $User_NomorKTP = "0000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 13)
                {
                    $User_NomorKTP = "000" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 14)
                {
                    $User_NomorKTP = "00" . $User_NomorKTP;
                }
                else if (strlen($User_NomorKTP) == 15)
                {
                    $User_NomorKTP = "0" . $User_NomorKTP;
                }
                else
                {
                    $User_NomorKTP = "" . $User_NomorKTP;
                }*/

                $result = $this->db->query(
                    "UPDATE
                     tbl_ulogin
                     SET
                     unamalengkap = '$User_NamaLengkap',
                     kontak = '$User_Kontak'
                     WHERE
                     id = '$User_ID';"
                );
                /*$result = $this->db->query(
                    'UPDATE
                     public.tbl_ulogin
                     SET
                     unamalengkap = \''.$User_NamaLengkap.'\',
                     kontak = \''.$User_Kontak.'\'
                     WHERE
                     id = \''.$User_ID.'\';'
                );*/
                /*$result = $this->db->query(
                    "UPDATE
                        tbl_users
                     SET
                        namadepan = '$User_NamaDepan',
                        namabelakang = '$User_NamaBelakang',
                        jeniskelamin = '$User_JenisKelamin',
                        tempatlahir = '$User_TempatLahir',
                        tgllahir = '$User_TanggalLahirYYYYMMDD',

                        idprovinsi = '$User_IdProvinsi',
                        idkota = '$User_IdKota',
                        idkecamatan = '$User_IdKecamatan',
                        idkelurahan = '$User_IdKelurahan',
                        alamatlengkap = '$User_AlamatLengkap',

                        kontak = '$User_Kontak',
                        email = '$User_Email',
                        noktp = '$User_NomorKTP'
                     WHERE
                        id = '$User_ID';"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data admin berhasil diperbaharui."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Update gagal."
                    );
                    return $result;
                }
            }
        }

    }

    function randomNumber($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++)
        {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    function randomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function RandomWords ($id = 20)
    {
        $pool = '1234567890abcdefghijkmnpqrstuvwxyz';
        $word = '';
        for ($i = 0; $i < $id; $i++)
        {
            $word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        return $word;
    }

?>
