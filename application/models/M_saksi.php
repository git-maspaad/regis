<?php

    class M_saksi extends CI_Model
    {
        #function CheckNewSaksi ($User_NoKTP, $User_NamaLengkap, $User_TglLahirDD, $User_TglLahirMM, $User_TglLahirYYYY)
        #function CheckNewSaksi ($User_NoKTP)
        function CheckNewSaksi (
            $User_NoKTP,
            $User_TglLahirDD, $User_TglLahirMM, $User_TglLahirYYYY
        ){
            if ($User_NoKTP == NULL || !is_numeric($User_NoKTP))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan No.KTP dengan benar."
                );
                return $result;
            }
            else if ($User_TglLahirDD == NULL || !is_numeric($User_TglLahirDD) || strlen($User_TglLahirDD) != 2)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan tanggal lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TglLahirMM == NULL || !is_numeric($User_TglLahirMM) || strlen($User_TglLahirMM) != 2)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Bulan lahir belum dipilih."
                );
                return $result;
            }
            else if ($User_TglLahirYYYY == NULL || !is_numeric($User_TglLahirYYYY) || strlen($User_TglLahirYYYY) != 4)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan tahun lahir denga benar."
                );
                return $result;
            }
            else
            {
                $this->otherdb = $this->load->database('otherdb', true);
                $result = $this->otherdb->query(
                    "SELECT
                     daftar_web_final.nik AS `User_NoKTP`
                     FROM
                     daftar_web_final
                     WHERE
                     daftar_web_final.nik = '$User_NoKTP';"
                );

                $x = $result->num_rows();

                if ($x == 1)
                {
                    foreach ($result->result() as $data)
                    {
                        $Var_User_NoKTP = $data->User_NoKTP;

                        $result = array(
                            "Response_ID" => "0",
                            "Response_Message" => "Data sudah ada.",
                            "Response_Tmp_UserNoKTP" => $User_NoKTP,
                        );
                        $this->otherdb->close();
                        return $result;
                    }
                }
                else
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Silahkan lengkapi form registrasi pada layar.",
                        "Response_Tmp_UserNoKTP" => $User_NoKTP,
                    );
                    $this->otherdb->close();
                    return $result;
                }
            }
        }

        function CountTotalEntryTPS ()
        {
            $result = $this->db->query(
                'SELECT
                 COUNT(tbl_tps.id) AS "TPS_CountEntryTPSTotal"
                 FROM
                 tbl_tps
                 LEFT JOIN
                 tbl_user ON tbl_tps.iduser = tbl_user.id
                 WHERE
                 tbl_user.iscaleg = \'0\';'
            );
            /*$result = $this->db->query(
                "SELECT
                    COUNT(tbl_tps.id) AS `TPS_CountEntryTPSTotal`
                 FROM
                    tbl_tps
                 INNER JOIN
                    tbl_users ON tbl_users.id = tbl_tps.iduser
                 WHERE
                    tbl_users.idlevel = '1';"
            );*/

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    echo
                    '
                        <div class="col-md-4 tile">
                            <span>Total Entry TPS oleh Saksi</span>
                            <h2>'.$data->TPS_CountEntryTPSTotal.'</h2>
                        </div>
                    ';
                }
            }

            return $result;
        }

        function CountSaksi ($JenisKelamin)
        {
            if ($JenisKelamin == "Laki-laki")
            {
                $JenisKelamin = "1";
            }
            else
            {
                $JenisKelamin = "0";
            }
            
            $result = $this->db->query(
                'SELECT
                 COUNT(*) AS "TPS_CountSaksi"
                 FROM
                 tbl_user
                 WHERE
                 tbl_user.iscaleg = \'0\' AND
                 tbl_user.jeniskelamin = \''.$JenisKelamin.'\';'
            );
            /*$result = $this->db->query(
                "SELECT
                    COUNT(*) AS `TPS_CountSaksi`
                 FROM
                    tbl_users
                 LEFT JOIN
                    tbl_users_level ON tbl_users_level.id = tbl_users.idlevel
                 WHERE
                    tbl_users.jeniskelamin = '$JenisKelamin' AND
                    tbl_users_level.id = '1';"
            );*/

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    echo
                    '
                        <div class="col-md-4 tile">
                            <span>Total Saksi Pria</span>
                            <h2>'.$data->TPS_CountSaksi.'</h2>
                        </div>
                    ';
                }
            }

            return $result;
        }

        function CreateNewSaksiPerindo (
            $User_NamaLengkap, $User_JenisKelamin,
            $User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,

            $User_IdAgama, $User_StatusPernikahan,
            $User_PendidikanTerakhir, $User_NamaSekolah,
            $User_Pekerjaan, $User_PekerjaanLainnya,

            $User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
            $User_Kontak, $User_NomorKTP,

            $User_DataCalegProvinsi,
            $User_DataCalegDapil,
            $User_DataCaleg,
            $User_NoTPS
        ) {
            #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
            #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
            #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
            #$User_Kontak, $User_Email, $User_NomorKTP

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
            else if ($User_JenisKelamin == NULL || ($User_JenisKelamin != "Laki-laki" && $User_JenisKelamin != "Perempuan"))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Invalid jenis kelamin."
                );
                return $result;
            }
            else if ($User_TempatLahir == NULL || is_numeric($User_TempatLahir) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Lengkapi tempat lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TanggalLahirDD == NULL || strlen($User_TanggalLahirDD) > 2 || (strlen($User_TanggalLahirDD) == 2 && $User_TanggalLahirDD > 31))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan tanggal lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TanggalLahirMM == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih bulan lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TanggalLahirYYYY == NULL || strlen($User_TanggalLahirYYYY) > 4)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan tahun lahir dengan benar."
                );
                return $result;
            }
            else if ($User_IdAgama == NULL || !is_numeric($User_IdAgama))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Agama belum dipilih."
                );
                return $result;
            }
            else if ($User_StatusPernikahan == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Status pernikahan belum dipilih."
                );
                return $result;
            }
            else if ($User_PendidikanTerakhir == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pendidikan terakhir belum dipilih."
                );
                return $result;
            }
            else if ($User_NamaSekolah == NULL || is_numeric($User_NamaSekolah))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Nama sekolah belum diisi."
                );
                return $result;
            }
            else if ($User_Pekerjaan == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pekerjaan belum dipilih."
                );
                return $result;
            }
            else if ($User_IdProvinsi == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih provinsi dengan benar."
                );
                return $result;
            }
            else if ($User_IdKota == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih kab./kota dengan benar."
                );
                return $result;
            }
            else if ($User_IdKecamatan == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih kecamatan dengan benar."
                );
                return $result;
            }
            else if ($User_IdKelurahan == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih kelurahan dengan benar."
                );
                return $result;
            }
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
            #else if ($User_NomorKTP === '')
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Masukan nomor ktp dengan benar."
                #);
                #return $result;
            #}
            else if ($User_DataCalegProvinsi == NULL || !is_numeric($User_DataCalegProvinsi))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi caleg belum dipilih."
                );
                return $result;
            }
            else if ($User_DataCalegDapil == NULL || !is_numeric($User_DataCalegDapil))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Dapil caleg belum dipilih."
                );
                return $result;
            }
            else if ($User_DataCaleg == NULL || !is_numeric($User_DataCaleg))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Calegnya belum dipilih."
                );
                return $result;
            }
            else if ($User_NoTPS == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "No.TPS belum diisi."
                );
                return $result;
            }
            else
            {
                # jenis kelamin
                if ($User_JenisKelamin == "Laki-laki")
                {
                    $User_JenisKelamin = "1";
                }
                else
                {
                    $User_JenisKelamin = "0";
                }
                # end of jenis kelamin

                if (strlen($User_TanggalLahirDD) == 1 && ($User_TanggalLahirDD >= 1 || $User_TanggalLahirDD < 10))
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

                /*if (strlen($User_NomorKTP) == 1)
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

                /*$FrontName5;
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

                # pekerjaan
                $xPekerjaan;
                if ($User_PekerjaanLainnya == NULL)
                {
                    $xPekerjaan = $User_Pekerjaan;
                }
                else
                {
                    $xPekerjaan = $User_PekerjaanLainnya;
                }
                # end of pekerjaan

                $User_UserLog = (strlen($User_NamaLengkap) > 5 ? "admin-".trim(substr(strtolower($User_NamaLengkap), 0, 5)).".".RandomWords(5) : "admin-".trim(strtolower($User_NamaLengkap)).".".RandomWords(5)); #strtolower($FrontName5) . strtolower($BackName2) . $User_TanggalLahirDD . $User_TanggalLahirMM;
                $User_KeyLog = base64_encode(base64_encode(base64_encode(RandomWords(12))));
                #$User_UserLog = strtolower($FrontName5) . strtolower($BackName2) . $User_TanggalLahirDD . $User_TanggalLahirMM;
                #$User_KeyLog = base64_encode(base64_encode(base64_encode(RandomWords(12))));

                $result = $this->db->query(
                    'INSERT INTO
                     tbl_user
                     (
                         idulogin,

                         namalengkap, jeniskelamin,
                         tmplahir, tgllahir,
                         
                         idagama,
                         statuspernikahan,
                         
                         pendidikantingkat,
                         pendidikandi,

                         pekerjaan,

                         idprovinsi, idkota, idkecamatan, idkelurahan, alamat,
                         nohp, noktp,

                         iscaleg,
                         notps,
                         idcaleg
                     )
                     VALUES
                     (
                         \'0\',

                         \''.$User_NamaLengkap.'\', \''.$User_JenisKelamin.'\',
                         \''.$User_TempatLahir.'\', \''.$User_TanggalLahirYYYYMMDD.'\',

                         \''.$User_IdAgama.'\',
                         \''.$User_StatusPernikahan.'\',

                         \''.$User_PendidikanTerakhir.'\',
                         \''.$User_NamaSekolah.'\',

                         \''.$xPekerjaan.'\',

                         \''.$User_IdProvinsi.'\', \''.$User_IdKota.'\', \''.$User_IdKecamatan.'\', \''.$User_IdKelurahan.'\', \''.$User_AlamatLengkap.'\',
                         \''.$User_Kontak.'\', \''.$User_NomorKTP.'\',

                         \'0\',
                         \''.$User_NoTPS.'\',
                         \''.$User_DataCaleg.'\'
                     );'
                );

                #$User_DataCalegProvinsi,
                #$User_DataCalegDapil,
                #$User_DataCaleg,
                #$User_NoTPS

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
                        '1', '$User_UserLog', '$User_KeyLog',
                        '$User_NamaDepan', '$User_NamaBelakang', '$User_JenisKelamin',
                        '$User_TempatLahir', '$User_TanggalLahirYYYYMMDD',
                        '$User_IdProvinsi', '$User_IdKota', '$User_IdKecamatan', '$User_IdKelurahan', '$User_AlamatLengkap',
                        '$User_Kontak', '$User_Email', '$User_NomorKTP'
                     );"
                );*/

                if($result)
                {
                    #$result = array(
                        #"Response_ID" => "1",
                        #"Response_Message" => "Create saksi perindo success."
                    #);
                    #return $result;

                    $result = $this->db->query(
                        'INSERT INTO
                        tbl_ulogin
                        (
                            iduloginlevel,
                            ulog,
                            plog,
                            unamalengkap,
                            kontak
                        )
                        VALUES
                        (
                            \'3\',
                            \''.$User_UserLog.'\',
                            \''.$User_KeyLog.'\',
                            \''.$User_NamaLengkap.'\',
                            \''.$User_Kontak.'\'
                        );'
                    );

                    if ($result)
                    {
                        $result = $this->db->query(
                            'SELECT
                             tbl_ulogin.id AS "User_IdULogin"
                             FROM
                             tbl_ulogin
                             WHERE
                             tbl_ulogin.ulog = \''.$User_UserLog.'\';'
                        );

                        $x = $result->num_rows();

                        if ($x == 1)
                        {
                            foreach ($result->result() as $data)
                            {
                                $xidulogin = $data->User_IdULogin;

                                $result = $this->db->query(
                                    'UPDATE
                                     public.tbl_user
                                     SET
                                     idulogin = \''.$xidulogin.'\'
                                     WHERE
                                     noktp = \''.$User_NomorKTP.'\';'
                                );

                                if ($result)
                                {
                                    $result = array(
                                        "Response_ID" => "1",
                                        "Response_Message" => "Create saksi perindo berhasil."
                                    );
                                    return $result;
                                }
                                else
                                {
                                    $result = array(
                                        "Response_ID" => "0",
                                        "Response_Message" => "Create saksi perindo gagal."
                                    );
                                    return $result;
                                }
                            }
                        }
                        else
                        {
                            $result = array(
                                "Response_ID" => "0",
                                "Response_Message" => "Create saksi perindo gagal."
                            );
                            return $result;
                        }
                    }
                    else
                    {
                        $result = array(
                            "Response_ID" => "0",
                            "Response_Message" => "Create saksi perindo gagal."
                        );
                        return $result;
                    }
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Create saksi perindo gagal."
                    );
                    return $result;
                }
            }
        }

        function DeleteAccount ($User_ID)
        {
            $result = $this->db->query(
                "DELETE FROM tbl_users WHERE id = '$User_ID';"
            );

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Akun saksi perindo berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus akun saksi perindo."
                );
                return $result;
            }
        }

        function ExportSaksiPerindoTmpAll ()
        {
            # query mysql patch 1
            $result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                 tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                 tbl_saksitmp.kota AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;"
            );

            # query mysql patch 1
            /*$result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;"
            );*/

            # query postgre sql
            /*$result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );*/

            $xempty = $result->num_rows();

            $aData = array();

            if ($xempty > 0)
            {
                foreach ($result->result() as $data)
                {
                    # add to array
                    $aData[] = array(
                        'namalengkap' => $data->Saksi_NamaLengkap,
                        'nik' => $data->Saksi_NoKTP,
                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                        'kelurahan' => $data->Saksi_Kelurahan,
                        'kecamatan' => $data->Saksi_Kecamatan,
                        'kota' => $data->Saksi_Kota,
                        'tps' => $data->Saksi_TPS,
                        'nohp' => $data->Saksi_NoHP,
                        'rekomendasi' => $data->Saksi_Rekomendasi
                    );
                }
            }

            $result = $aData;
            return $result;
        }

        function ExportSaksiPerindoTmpAll_AksesLogin ()
        {
            # query mysql patch 2
            $result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                 tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                 tbl_saksitmp.kota AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 tbl_saksitmp.ulog AS `Saksi_Ulog`,
                 tbl_saksitmp.plog AS `Saksi_Plog`
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;"
            );

            # query mysql patch 1
            /*$result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 tbl_saksitmp.ulog AS `Saksi_Ulog`,
                 tbl_saksitmp.plog AS `Saksi_Plog`
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;"
            );*/

            # query postgresql
            /*$result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                 tbl_saksitmp.ulog AS "Saksi_Ulog",
                 tbl_saksitmp.plog AS "Saksi_Plog"
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );*/

            $xempty = $result->num_rows();

            $aData = array();

            if ($xempty > 0)
            {
                foreach ($result->result() as $data)
                {
                    $plog = base64_decode(base64_decode(base64_decode($data->Saksi_Plog)));

                    # add to array
                    $aData[] = array(
                        'namalengkap' => $data->Saksi_NamaLengkap,
                        'nik' => $data->Saksi_NoKTP,
                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                        'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                        'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                        'kota' => ucwords(strtolower($data->Saksi_Kota)),
                        'tps' => $data->Saksi_TPS,
                        'nohp' => $data->Saksi_NoHP,
                        'rekomendasi' => $data->Saksi_Rekomendasi,
                        'ulog' => $data->Saksi_Ulog,
                        'plog' => $plog
                    );
                }
            }

            $result = $aData;
            return $result;
        }

        function ExportSaksiPerindoTmpByDapil ($IdKotaDapil)
        {
            # query mysql patch 2
            $result = $this->db->query(
                "SELECT
                 (
                  SELECT
                  saksitmpx.id
                  FROM
                  tbl_saksitmp AS saksitmpx
                  WHERE
                  saksitmpx.namalengkap = saksitmp.namalengkap AND
                  saksitmpx.nik = saksitmp.nik
                  ORDER BY saksitmpx.id DESC
                  LIMIT 0, 1
                 ) AS `Saksi_Id`,
                 saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 saksitmp.nik AS `Saksi_NoKTP`,
                 saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 saksitmp.kelurahan AS `Saksi_Kelurahan`,
                 saksitmp.kecamatan AS `Saksi_Kecamatan`,
                 IF(kota.id = NULL, '0', kota.id) AS `Saksi_IdKota`,
                 IF(provinsi.id = NULL, '0', provinsi.id) as `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) as `Saksi_IdProvinsi`,
                 saksitmp.kota AS `Saksi_Kota`,
                 saksitmp.tps AS `Saksi_TPS`,
                 saksitmp.nohp AS `Saksi_NoHP`,
                 saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(dapil.namadapil = NULL, '', dapil.namadapil) AS `Saksi_NamaDapil`
                 FROM
                 tbl_saksitmp AS saksitmp
                 LEFT JOIN
                 tbl_kelurahan AS kelurahan ON UCASE(saksitmp.kelurahan) = UCASE(kelurahan.kelurahan)
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON UCASE(saksitmp.kecamatan) = UCASE(kecamatan.kecamatan)
                 LEFT JOIN
                 tbl_kota AS kota ON UCASE(saksitmp.kota) = UCASE(kota.kota)
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 LEFT JOIN
                 tbl_dapil AS dapil ON provinsi.id = dapil.idprovinsi
                 WHERE
                 kota.id IN ('$IdKotaDapil')
                 GROUP BY
                 saksitmp.namalengkap, saksitmp.nik,
                 saksitmp.alamatlengkap, saksitmp.kelurahan, saksitmp.kecamatan,
                 kota.id, saksitmp.kota,
                 provinsi.id, provinsi.provinsi,
                 saksitmp.tps, saksitmp.nohp, saksitmp.rekomendasi,
                 dapil.namadapil
                 ORDER BY
                 saksitmp.namalengkap ASC,
                 saksitmp.nik ASC,
                 saksitmp.kota ASC,
                 saksitmp.kecamatan ASC,
                 saksitmp.kelurahan ASC;"
            );

            # query mysql patch 1
            /*$result = $this->db->query(
                "SELECT
                 (
                  SELECT
                  saksitmpx.id
                  FROM
                  tbl_saksitmp AS saksitmpx
                  WHERE
                  saksitmpx.namalengkap = saksitmp.namalengkap AND
                  saksitmpx.nik = saksitmp.nik
                  ORDER BY saksitmpx.id DESC
                  LIMIT 0, 1
                 ) AS `Saksi_Id`,
                 saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 saksitmp.nik AS `Saksi_NoKTP`,
                 saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(kelurahan.kelurahan = NULL, '', kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(kecamatan.kecamatan = NULL, '', kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(kota.id = NULL, '0', kota.id) AS `Saksi_IdKota`,
                 IF(provinsi.id = NULL, '0', provinsi.id) as `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) as `Saksi_IdProvinsi`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Saksi_Kota`,
                 saksitmp.tps AS `Saksi_TPS`,
                 saksitmp.nohp AS `Saksi_NoHP`,
                 saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(dapil.namadapil = NULL, '', dapil.namadapil) AS `Saksi_NamaDapil`
                 FROM
                 tbl_saksitmp AS saksitmp
                 LEFT JOIN
                 tbl_kelurahan AS kelurahan ON saksitmp.kelurahan = kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON saksitmp.kecamatan = kecamatan.id
                 LEFT JOIN
                 tbl_kota AS kota ON saksitmp.kota = kota.id
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 LEFT JOIN
                 tbl_dapil AS dapil ON provinsi.id = dapil.idprovinsi
                 WHERE
                 kota.id IN ('$IdKotaDapil')
                 GROUP BY
                 saksitmp.namalengkap, saksitmp.nik,
                 saksitmp.alamatlengkap, kelurahan.kelurahan, kecamatan.kecamatan,
                 kota.id, kota.kota,
                 provinsi.id, provinsi.provinsi,
                 saksitmp.tps, saksitmp.nohp, saksitmp.rekomendasi,
                 dapil.namadapil
                 ORDER BY
                 saksitmp.namalengkap ASC,
                 saksitmp.nik ASC,
                 kota.kota ASC,
                 kecamatan.kecamatan ASC,
                 kelurahan.kelurahan ASC;"
            );*/

            # query postgresql
            /*$result = $this->db->query(
                'SELECT DISTINCT ON (tbl_saksitmp.namalengkap, tbl_saksitmp.nik)
                 tbl_saksitmp.id AS "Saksi_Id",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 COALESCE(tbl_kota.id::int, \'0\') AS "Saksi_IdKota",
                 COALESCE(tbl_provinsi.id::int, \'0\') as "Saksi_IdProvinsi",
                 COALESCE(tbl_provinsi.provinsi::varchar, \'\') as "Saksi_IdProvinsi",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                 COALESCE(tbl_dapil.namadapil::varchar, \'\') AS "Saksi_NamaDapil"
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.kota
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 LEFT JOIN
                 tbl_dapil ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_kota.id IN ('.$IdKotaDapil.')
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC,
                 tbl_saksitmp.nik ASC,
                 tbl_saksitmp.kota ASC,
                 tbl_saksitmp.kecamatan ASC,
                 tbl_saksitmp.kelurahan ASC;'
            );*/

            $xempty = $result->num_rows();

            $aData = array();

            if ($xempty > 0)
            {
                foreach ($result->result() as $data)
                {
                    # add to array
                    $aData[] = array(
                        'namalengkap' => $data->Saksi_NamaLengkap,
                        'nik' => $data->Saksi_NoKTP,
                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                        'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                        'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                        'kota' => ucwords(strtolower($data->Saksi_Kota)),
                        'tps' => $data->Saksi_TPS,
                        'nohp' => $data->Saksi_NoHP,
                        'rekomendasi' => $data->Saksi_Rekomendasi
                    );
                }
            }

            $result = $aData;
            return $result;
        }

        function ExportSaksiPerindoTmpByDapil_AksesLogin ($IdKotaDapil)
        {
            #die($IdKotaDapil);

            # query mysql patch 2
            $result = $this->db->query(
                "SELECT
                 (
                  SELECT
                  saksitmpx.id
                  FROM
                  tbl_saksitmp AS saksitmpx
                  WHERE
                  saksitmpx.namalengkap = saksitmp.namalengkap AND
                  saksitmpx.nik = saksitmp.nik
                  ORDER BY saksitmpx.id DESC
                  LIMIT 0, 1
                 ) AS `Saksi_Id`,
                 saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 saksitmp.nik AS `Saksi_NoKTP`,
                 saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 saksitmp.kelurahan AS `Saksi_Kelurahan`,
                 saksitmp.kecamatan AS `Saksi_Kecamatan`,
                 IF(kota.id = NULL, '0', kota.id) AS `Saksi_IdKota`,
                 IF(provinsi.id = NULL, '0', provinsi.id) as `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '0', provinsi.provinsi) as `Saksi_IdProvinsi`,
                 saksitmp.kota AS `Saksi_Kota`,
                 saksitmp.tps AS `Saksi_TPS`,
                 saksitmp.nohp AS `Saksi_NoHP`,
                 saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(dapil.namadapil = NULL, '0', dapil.namadapil) AS `Saksi_NamaDapil`,
                 saksitmp.ulog AS `Saksi_Ulog`,
                 saksitmp.plog AS `Saksi_Plog`
                 FROM
                 tbl_saksitmp AS saksitmp
                 LEFT JOIN
                 tbl_kelurahan AS kelurahan ON UCASE(saksitmp.kelurahan) = UCASE(kelurahan.kelurahan)
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON UCASE(saksitmp.kecamatan) = UCASE(kecamatan.kecamatan)
                 LEFT JOIN
                 tbl_kota AS kota ON UCASE(saksitmp.kota) = UCASE(kota.kota)
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 LEFT JOIN
                 tbl_dapil AS dapil ON provinsi.id = dapil.idprovinsi
                 WHERE
                 kota.id IN ('$IdKotaDapil')
                 GROUP BY
                 saksitmp.namalengkap,
                 saksitmp.nik,
                 saksitmp.alamatlengkap,
                 saksitmp.kelurahan,
                 saksitmp.kecamatan,
                 saksitmp.kota,
                 saksitmp.tps,
                 saksitmp.nohp,
                 saksitmp.rekomendasi,
                 dapil.namadapil,
                 saksitmp.ulog,
                 saksitmp.plog
                 ORDER BY
                 saksitmp.namalengkap ASC,
                 saksitmp.nik ASC,
                 saksitmp.kota ASC,
                 saksitmp.kecamatan ASC,
                 saksitmp.kelurahan ASC;"
            );

            # query mysql patch 1
            /*$result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_Id`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(tbl_kota.id = NULL, '0', tbl_kota.id) AS `Saksi_IdKota`,
                 IF(tbl_provinsi.id = NULL, '0', tbl_provinsi.id) as `Saksi_IdProvinsi`,
                 IF(tbl_provinsi.provinsi = NULL, '0', tbl_provinsi.provinsi) as `Saksi_IdProvinsi`,
                 IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(tbl_dapil.namadapil = NULL, '0', tbl_dapil.namadapil) AS `Saksi_NamaDapil`,
                 tbl_saksitmp.ulog AS `Saksi_Ulog`,
                 tbl_saksitmp.plog AS `Saksi_Plog`
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 LEFT JOIN
                 tbl_dapil ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_kota.id IN ('$IdKotaDapil')
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC,
                 tbl_saksitmp.nik ASC,
                 tbl_saksitmp.kota ASC,
                 tbl_saksitmp.kecamatan ASC,
                 tbl_saksitmp.kelurahan ASC;"
            );*/

            # query postgresql
            /*$result = $this->db->query(
                'SELECT DISTINCT ON (tbl_saksitmp.namalengkap, tbl_saksitmp.nik)
                 tbl_saksitmp.id AS "Saksi_Id",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 COALESCE(tbl_kota.id::int, \'0\') AS "Saksi_IdKota",
                 COALESCE(tbl_provinsi.id::int, \'0\') as "Saksi_IdProvinsi",
                 COALESCE(tbl_provinsi.provinsi::varchar, \'\') as "Saksi_IdProvinsi",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                 COALESCE(tbl_dapil.namadapil::varchar, \'\') AS "Saksi_NamaDapil",
                 tbl_saksitmp.ulog AS "Saksi_Ulog",
                 tbl_saksitmp.plog AS "Saksi_Plog"
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.kota
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 LEFT JOIN
                 tbl_dapil ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_kota.id IN ('.$IdKotaDapil.')
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC,
                 tbl_saksitmp.nik ASC,
                 tbl_saksitmp.kota ASC,
                 tbl_saksitmp.kecamatan ASC,
                 tbl_saksitmp.kelurahan ASC;'
            );*/

            #echo "<pre>";
            #print_r($this->db->last_query());
            #echo "</pre>";
            #die();

            $xempty = $result->num_rows();

            $aData = array();

            if ($xempty > 0)
            {
                foreach ($result->result() as $data)
                {
                    $plog = base64_decode(base64_decode(base64_decode($data->Saksi_Plog)));

                    # add to array
                    $aData[] = array(
                        'namalengkap' => $data->Saksi_NamaLengkap,
                        'nik' => $data->Saksi_NoKTP,
                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                        'kelurahan' => $data->Saksi_Kelurahan,
                        'kecamatan' => $data->Saksi_Kecamatan,
                        'kota' => $data->Saksi_Kota,
                        'tps' => $data->Saksi_TPS,
                        'nohp' => $data->Saksi_NoHP,
                        'rekomendasi' => $data->Saksi_Rekomendasi,
                        'ulog' => $data->Saksi_Ulog,
                        'plog' => $plog
                    );
                }
            }

            $result = $aData;
            return $result;
        }

        function GetAccount ($User_ID)
        {
            $result = $this->db->query(
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
            );

            if($result->num_rows() == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label style="font-size: 20px; margin-bott  om: 15px;">Identitas Saksi Perindo</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_User_ID" value="'.$User_ID.'" hidden/>';

                    echo '<label for="fullname">Nama Lengkap</label>';
                    echo '<input type="text" id="fullname" name="text_User_NamaDepan" class="form-control" style="margin-bottom: 15px;" value="'.$data->User_NamaDepan.'" placeholder="nama depan" required autofocus />';
                    echo '<input type="text" id="fullname" name="text_User_NamaBelakang" class="form-control" style="margin-bottom: 15px;" value="'.$data->User_NamaBelakang.'" placeholder="nama belakang"/>';

                    echo '<label>Jenis Kelamin</label>';
                    echo '<p style="margin-bottom: 15px;">';
                        if ($data->User_JenisKelamin == "Laki-laki")
                        {
                            echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" checked required />&nbsp;Laki-laki';
                            echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" />&nbsp;Perempuan';
                        }
                        else if ($data->User_JenisKelamin == "Perempuan")
                        {
                            echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" required />&nbsp;Laki-laki';
                            echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" checked style="margin-left: 15px;" />&nbsp;Perempuan';
                        }
                        else
                        {
                            echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" required />&nbsp;Laki-laki';
                            echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" />&nbsp;Perempuan';
                        }
                    echo '</p>';

                    echo '<label for="bornplace">Tempat Lahir</label>';
                    echo '<input type="text" id="bornplace" class="form-control" name="text_User_Tempatlahir" data-parsley-trigger="change" value="'.$data->User_TempatLahir.'" style="margin-bottom: 15px;" required />';

                    echo '<label for="borndate">Tanggal Lahir</label>';
                    echo '<table style="margin-bottom: 50px;">';
                        echo '<th>';
                            echo '<input type="text" id="borndatedd" class="form-control" name="text_User_TanggalLahirDD" data-parsley-trigger="change" value="'.$data->User_TanggalLahirDD.'" style="width: 50px; margin-right: 10px; text-align: center;" required />';
                        echo '</th>';
                        echo '<th>';
                            echo '<select id="borndatemm" name="spinner_User_TanggalLahir" class="form-control" style="width: 150px; margin-right: 10px;" required>';
                                echo '<option value="" selected>Pilih</option>';
                                for($i = 0; $i <= 12; $i++)
                                {
                                    $IsSelectedMonth;
                                    if ($i == $data->User_TanggalLahirMM)
                                    {
                                        $IsSelectedMonth = "selected";
                                    }
                                    else
                                    {
                                        $IsSelectedMonth = "";
                                    }

                                    if ($i < 10)
                                    {
                                        $i = "0" . $i;

                                        switch ($i)
                                        {
                                            case "01":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Januari</option>';
                                                break;
                                            case "02":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Februari</option>';
                                                break;
                                            case "03":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Maret</option>';
                                                break;
                                            case "04":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>April</option>';
                                                break;
                                            case "05":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Mei</option>';
                                                break;
                                            case "06":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Juni</option>';
                                                break;
                                            case "07":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Juli</option>';
                                                break;
                                            case "08":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Agustus</option>';
                                                break;
                                            case "09":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>September</option>';
                                                break;
                                        }
                                    }
                                    else
                                    {
                                        $i = "" . $i;

                                        switch ($i)
                                        {
                                            case "10":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Oktober</option>';
                                                break;
                                            case "11":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>November</option>';
                                                break;
                                            case "12":
                                                echo '<option value="'.$i.'" '.$IsSelectedMonth.'>Desember</option>';
                                                break;
                                        }
                                    }
                                }
                            echo '</select>';
                        echo '</th>';
                        echo '<th>';
                            echo '<input type="text" id="borndateyyyy" class="form-control" name="text_User_TanggalLahirYYYY" data-parsley-trigger="change" value="'.$data->User_TanggalLahirYYYY.'" style="width: 65px; text-align: center;" required />';
                        echo '</th>';
                    echo '</table>';

                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Wilayah</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<label for="spinnerprovinsi">Provinsi</label>';
                    echo '<select id="spinnerprovinsi" name="spinner_User_Provinsi" class="form-control" style="margin-bottom: 15px;" required onclick="LoadProvinsiOnSelected();">';
                        $this->m_wilayah->GetProvinsi3($data->User_IdProvinsi);
                    echo '</select>';

                    echo '<label for="spinnerkota">Kab. / Kota</label>';
                    echo '<select id="spinnerkota" name="spinner_User_Kota" class="form-control" style="margin-bottom: 15px;" required onclick="LoadKotaOnSelected();">';
                        $this->m_wilayah->GetKota2($data->User_IdProvinsi, $data->User_IdKota);
                    echo '</select>';

                    echo '<label for="spinnerkecamatan">Kecamatan</label>';
                    echo '<select id="spinnerkecamatan" name="spinner_User_Kecamatan" class="form-control" style="margin-bottom: 15px;" required>';
                        $this->m_wilayah->GetKecamatan2($data->User_IdProvinsi, $data->User_IdKota, $data->User_IdKecamatan);
                    echo '</select>';

                    echo '<label for="spinnerkelurahan">Kelurahan</label>';
                    echo '<select id="spinnerkelurahan" name="spinner_User_Kelurahan" class="form-control" style="margin-bottom: 15px;" required>';
                        $this->m_wilayah->GetKelurahan2($data->User_IdProvinsi, $data->User_IdKota, $data->User_IdKecamatan, $data->User_IdKelurahan);
                    echo '</select>';

                    echo '<label for="homeaddress">Alamat Lengkap</label>';
                    echo '<textarea id="homeaddress" required="required" class="form-control" name="text_User_AlamatLengkap" data-parsley-trigger="keyup" data-parsley-minlength="12" data-parsley-maxlength="150" data-parsley-minlength-message="Min. 12 karakter!" data-parsley-validation-threshold="10" style="height: 150px; margin-bottom: 50px;">'.$data->User_AlamatLengkap.'</textarea>';

                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Data Unique</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<label for="contact">Kontak</label>';
                    echo '<input type="phone" id="contact" class="form-control" name="text_User_Kontak" data-parsley-trigger="change" value="'.$data->User_Kontak.'" style="margin-bottom: 15px;" required />';

                    echo '<label for="email">Email</label>';
                    echo '<input type="email" id="email" class="form-control" name="text_User_Email" data-parsley-trigger="change" value="'.$data->User_Email.'" style="margin-bottom: 15px;" required />';

                    echo '<label for="nomorktp">Nomor KTP</label>';
                    echo '<input type="number" id="nomorktp" class="form-control" name="text_User_NomorKTP" data-parsley-trigger="change" value="'.$data->User_NomorKTP.'" style="margin-bottom: 15px;" required />';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function hasLetter($x)
        {
            if (preg_match("/[\p{L}]/u",$x))
            {
                return true;
            }
            return false;
        }

        function hasNumber($x)
        {
            if (preg_match("/[\p{N}]/u",$x))
            {
                return true;
            }
            return false; 
        }

        function ListDataSaksiPerindoAll ()
        {
            date_default_timezone_set("Asia/Jakarta");
            $datetime_yyyy = date("Y");

            $result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );
            /*$result = $this->db->query(
                'SELECT
                 tbl_user.id AS "User_ID",
                 tbl_ulogin.isactive AS "User_IsActive",
                
                 tbl_user.namalengkap AS "User_NamaLengkap",
                 tbl_user.jeniskelamin AS "User_JenisKelamin",
                 LEFT(tbl_user.tgllahir, 4) AS "User_TanggalLahirYYYY",
                 tbl_user.statuspernikahan AS "User_StatusPernikahan",
                 tbl_user.pekerjaan AS "User_Pekerjaan"
                 FROM
                 tbl_user
                 LEFT JOIN
                 tbl_ulogin ON tbl_user.idulogin = tbl_ulogin.id
                 LEFT JOIN
                 tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
                 LEFT JOIN
                 tbl_kelurahan ON tbl_user.idkelurahan = tbl_kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan ON tbl_kelurahan.idkecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 WHERE
                 tbl_uloginlevel.id = \'3\'
                 ORDER BY
                 tbl_provinsi.idwilayah asc,
                 tbl_provinsi.provinsi asc,
                 tbl_kota.kota asc,
                 tbl_kota.kategori asc,
                 tbl_kecamatan.kecamatan asc,
                 tbl_kelurahan.kelurahan asc,
                 tbl_user.namalengkap asc;'
            );*/
            /*   #tbl_user.tmplahir AS "User_TempatLahir",

                 #SUBSTRING(tbl_user.tgllahir, 6, 2) AS "User_TanggalLahirMM",
                 #RIGHT(tbl_user.tgllahir, 2) AS "User_TanggalLahirDD",

                 #tbl_user.idprovinsi AS "Provinsi_IdProvinsi",
                 #COALESCE(tbl_provinsi.provinsi::varchar(50), \'\') AS "Provinsi_NamaProvinsi",
                 #tbl_user.idkota AS "Kota_IdKota",
                 #COALESCE(tbl_kota.kategori::varchar(50), \'\') AS "Kota_KategoriKota",
                 #COALESCE(tbl_kota.kota::varchar(50), \'\') AS "Kota_NamaKota",
                 #tbl_user.idkecamatan AS "Kecamatan_IdKecamatan",
                 #COALESCE(tbl_kecamatan.kecamatan::varchar(50), \'\') AS "Kecamatan_NamaKecamatan",
                 #tbl_user.idkelurahan AS "Kelurahan_IdKelurahan",
                 #COALESCE(tbl_kelurahan.kelurahan::varchar(50), \'\') AS "Kelurahan_NamaKelurahan",
                 #tbl_user.alamat AS "User_AlamatLengkap",
                
                 #tbl_user.nohp AS "User_Kontak",
                 #tbl_user.noktp AS "User_NomorKTP"
             */
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
                    tbl_users.idlevel = '1'
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
                    /**
                     * <th>Nama Lengkap</th>
                     * <th>Jenis Kelamin</th>
                     * <th>Status Pernikahan</th>
                     * <th>Pekerjaan</th>
                     * <th>Usia</th>
                     */
                    #$Var_User_ID = $data->User_ID;
                    #$Var_User_IsActive = $data->User_IsActive;
                    #$Var_User_IsActive2;
                    #switch ($Var_User_IsActive)
                    #{
                        #case 1:
                            #$Var_User_IsActive2 = "Aktif";
                            #break;
                        #default:
                            #$Var_User_IsActive2 = "Belum aktif";
                            #break;
                    #}

                    #$Var_User_NamaLengkap = $data->User_NamaLengkap;
                    #$Var_User_NamaDepan = $data->User_NamaDepan;
                    #$Var_User_NamaBelakang = $data->User_NamaBelakang;
                    #$Var_User_JenisKelamin = $data->User_JenisKelamin;
                    #$Var_User_TempatLahir = $data->User_TempatLahir;
                    #$Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
                    #$Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
                    #$Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;
                    #$Var_User_StatusPernikahan = $data->User_StatusPernikahan;
                    #$Var_User_Pekerjaan = $data->User_Pekerjaan;

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

                    #$Var_User_Kontak = $data->User_Kontak;
                    #$Var_User_Email = $data->User_Email;
                    #$Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        echo '<td>'.$data->Saksi_NamaLengkap.'</td>';
                        echo '<td>'.$data->Saksi_NoKTP.'</td>';
                        echo '<td>';
                            echo $data->Saksi_AlamatLengkap.', Kel. '.$data->Saksi_Kelurahan.', Kec. '.$data->Saksi_Kecamatan.', '.$data->Saksi_Kota;
                        echo '</td>';

                        echo '<td>'.$data->Saksi_NoHP.'</td>';
                        echo '<td>'.$data->Saksi_Rekomendasi.'</td>';
                        echo '<td>'.$data->Saksi_TPS.'</td>';

                        #echo '<td>'.$Var_User_NamaLengkap.'</td>';
                        #echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        #echo '<td>'.($Var_User_JenisKelamin == "1" ? "Laki-laki" : "Perempuan").'</td>';
                        #echo '<td>'.$Var_User_StatusPernikahan.'</td>';
                        #echo '<td>'.$Var_User_Pekerjaan.'</td>';
                        #echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        #echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        #echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        #echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        #echo '<td>'.$Var_User_Kontak.'</td>';
                        #echo '<td>'.($datetime_yyyy - $Var_User_TanggalLahirYYYY)." tahun".'</td>';
                        #echo '<td>'.$Var_User_IsActive2.'</td>';

                        #$Var_User_NamaLengkap;
                        #if ($Var_User_NamaBelakang == NULL)
                        #{
                            #$Var_User_NamaLengkap = $Var_User_NamaDepan;
                        #}
                        #else
                        #{
                            #$Var_User_NamaLengkap = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        #}
                        # $Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        echo '<td align="center">';
                            echo '<a href="'.site_url("Dashboard/EditSaksiPerindo").'/'.$data->Saksi_IdSaksi.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($data->Saksi_IdSaksi))).'" href="#" class="btn btn-primary" onclick="ClickDeleteSaksiPerindo(\'Hapus <strong>'.$data->Saksi_NamaLengkap .'</strong> dari database?\', \''.$data->Saksi_IdSaksi.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataSaksiPerindoAll_v2 ()
        {
            date_default_timezone_set("Asia/Jakarta");
            $datetime_yyyy = date("Y");

            $result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
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
                    tbl_users.idlevel = '1'
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
                    #$Var_User_ID = $data->User_ID;
                    #$Var_User_IsActive = $data->User_IsActive;
                    #$Var_User_IsActive2;
                    #switch ($Var_User_IsActive)
                    #{
                        #case 1:
                            #$Var_User_IsActive2 = "Aktif";
                            #break;
                        #default:
                            #$Var_User_IsActive2 = "Belum aktif";
                            #break;
                    #}

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

                    #$Var_User_Kontak = $data->User_Kontak;
                    #$Var_User_Email = $data->User_Email;
                    #$Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        #<th>Nama Lengkap</th>
                        #<th style="width: 125px; text-align: left;">NIK</th>
                        #<th>Alamat Rumah</th>
                        #<th style="width: 75px; text-align: left;">No. Handphone</th>
                        #<th>Rekomendasi</th>
                        #<th style="width: 75px; text-align: left;">TPS</th>
                        
                        echo '<td>'.$data->Saksi_NamaLengkap.'</td>';
                        
                        echo '<td>';
                            echo $data->Saksi_AlamatLengkap.', '.$data->Saksi_Kelurahan.', '.$data->Saksi_Kecamatan.', '.$data->Saksi_Kota;
                        echo '</td>';

                        echo '<td>'.$data->Saksi_NoHP.'</td>';
                        echo '<td>'.$data->Saksi_Rekomendasi.'</td>';
                        echo '<td>'.$data->Saksi_TPS.'</td>';

                        #echo '<td>'.$Var_User_NamaDepan.'</td>';
                        #echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        #echo '<td>'.$Var_User_JenisKelamin.'</td>';
                        #echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        #echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        #echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        #echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        #echo '<td>'.$Var_User_Kontak.'</td>';
                        #echo '<td>'.$Var_User_IsActive2.'</td>';

                        #$Var_User_NamaLengkap;
                        #if ($Var_User_NamaBelakang == NULL)
                        #{
                            #$Var_User_NamaLengkap = $Var_User_NamaDepan;
                        #}
                        #else
                        #{
                            #$Var_User_NamaLengkap = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        #}
                        #$Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        echo '<td align="center">';
                            echo '<a href="'.site_url("Admin/EditSaksiPerindo").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteSaksiPerindo(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataSaksiPerindoByIdWilayah ($IdWilayah)
        {
            date_default_timezone_set("Asia/Jakarta");
            $datetime_yyyy = date("Y");

            $result = $this->db->query(
                'SELECT
                 tbl_user.id AS "User_ID",
                 tbl_ulogin.isactive AS "User_IsActive",
                
                 tbl_user.namalengkap AS "User_NamaLengkap",
                 tbl_user.jeniskelamin AS "User_JenisKelamin",
                 LEFT(tbl_user.tgllahir, 4) AS "User_TanggalLahirYYYY",
                 tbl_user.statuspernikahan AS "User_StatusPernikahan",
                 tbl_user.pekerjaan AS "User_Pekerjaan",
                 tbl_kelurahan.kelurahan AS "Kelurahan_NamaKelurahan",
                 tbl_kecamatan.kecamatan AS "Kecamatan_NamaKecamatan",
                 tbl_kota.kategori AS "Kota_NamaKategori",
                 tbl_kota.kota AS "Kota_NamaKota",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_user
                 LEFT JOIN
                 tbl_ulogin ON tbl_ulogin.id = tbl_user.idulogin
                 LEFT JOIN
                 tbl_kelurahan ON tbl_kelurahan.id = tbl_user.idkelurahan
                 LEFT JOIN
                 tbl_kecamatan ON tbl_kecamatan.id = tbl_user.idkecamatan
                 LEFT JOIN
                 tbl_kota ON tbl_kota.id = tbl_user.idkota
                 LEFT JOIN
                 tbl_provinsi ON tbl_provinsi.id = tbl_user.idprovinsi
                 LEFT JOIN
                 tbl_uloginlevel ON tbl_uloginlevel.id = tbl_ulogin.iduloginlevel
                 WHERE
                 tbl_uloginlevel.id = \'3\' AND
                 tbl_provinsi.idwilayah = \''.$IdWilayah.'\'
                 ORDER BY
                 tbl_provinsi.idwilayah asc,
                 tbl_provinsi.provinsi asc,
                 tbl_kota.kota asc,
                 tbl_kota.kategori asc,
                 tbl_kecamatan.kecamatan asc,
                 tbl_kelurahan.kelurahan asc,
                 tbl_user.namalengkap asc;'
            );
            # tbl_provinsi.idwilayah = \''.$IdWilayah.'\'
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
                    tbl_users.idlevel = '1' AND
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
            );*/

            $x = $result->num_rows();

            if($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    /**
                     * <th>Nama Lengkap</th>
                     * <th>Jenis Kelamin</th>
                     * <th>Status Pernikahan</th>
                     * <th>Pekerjaan</th>
                     * <th>Usia</th>
                     */
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
                    $Var_User_JenisKelamin = $data->User_JenisKelamin;
                    #$Var_User_TempatLahir = $data->User_TempatLahir;
                    $Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
                    #$Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
                    #$Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;
                    $Var_User_StatusPernikahan = $data->User_StatusPernikahan;
                    $Var_User_Pekerjaan = $data->User_Pekerjaan;
                    $Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;
                    $Var_Kota_NamaKategori = $data->Kota_NamaKategori;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

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

                    #$Var_User_Kontak = $data->User_Kontak;
                    #$Var_User_Email = $data->User_Email;
                    #$Var_User_NomorKTP = $data->User_NomorKTP;

                    echo '<tr>';
                        echo '<td>'.$Var_User_NamaLengkap.'</td>';
                        #echo '<td>'.$Var_User_NamaBelakang.'</td>';
                        echo '<td>'.($Var_User_JenisKelamin == "1" ? "Laki-laki" : "Perempuan").'</td>';
                        echo '<td>'.$Var_User_StatusPernikahan.'</td>';
                        echo '<td>'.$Var_User_Pekerjaan.'</td>';
                        #echo '<td>'.$Var_Provinsi_NamaProvinsi.'</td>';
                        #echo '<td>'.$Var_Kota_NamaKota2.'</td>';
                        #echo '<td>'.$Var_Kecamatan_NamaKecamatan.'</td>';
                        #echo '<td>'.$Var_Kelurahan_NamaKelurahan.'</td>';
                        #echo '<td>'.$Var_User_Kontak.'</td>';
                        echo '<td>'.($datetime_yyyy - $Var_User_TanggalLahirYYYY)." tahun".'</td>';
                        echo '<td>'
                                .'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.'Kel. '.$Var_Kelurahan_NamaKelurahan.'<br/>'
                                .'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.'Kec. '.$Var_Kecamatan_NamaKecamatan.'<br/>'
                                .'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$Var_Kota_NamaKategori.' '.$Var_Kota_NamaKota.'<br/>'
                                .'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.'Prov. '.$Var_Provinsi_NamaProvinsi.
                             '</td>';
                        echo '<td>'.$Var_User_IsActive2.'</td>';

                        #$Var_User_NamaLengkap;
                        #if ($Var_User_NamaBelakang == NULL)
                        #{
                            #$Var_User_NamaLengkap = $Var_User_NamaDepan;
                        #}
                        #else
                        #{
                            #$Var_User_NamaLengkap = $Var_User_NamaDepan . " " . $Var_User_NamaBelakang;
                        #}
                        # $Var_User_NamaLengkap = strtolower($Var_User_NamaLengkap);

                        echo '<td align="center">';
                            echo '<a href="'.site_url("Dashboard/EditSaksiPerindo").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteSaksiPerindo(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataSaksiPerindoByIdWilayah_v2 ($IdWilayah)
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
                    tbl_users.idlevel = '1' AND
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
                            echo '<a href="'.site_url("Admin/EditSaksiPerindo").'/'.$Var_User_ID.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_User_ID))).'" href="#" class="btn btn-primary" onclick="ClickDeleteSaksiPerindo(\'Hapus <strong>'.$Var_User_NamaLengkap .'</strong> dari database?\', \''.$Var_User_ID.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListExcelSaksi ()
        {
            #query mysql patch 1
            $result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                 tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                 tbl_saksitmp.kota AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;"
            );

            #query mysql patch 1
            /*$result = $this->db->query(
                "SELECT
                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;"
            );*/

            # query postgre sql
            /*$result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );*/

            $x = $result->num_rows();

            if ($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    echo '<tr>';
                        echo '<td>'.$data->Saksi_NamaLengkap.'</td>';
                        echo '<td>'.$data->Saksi_NoKTP.'</td>';
                        echo '<td>'.$data->Saksi_AlamatLengkap.'</td>';
                        echo '<td>'.ucwords(strtolower($data->Saksi_Kelurahan)).'</td>';
                        echo '<td>'.ucwords(strtolower($data->Saksi_Kecamatan)).'</td>';
                        echo '<td>'.ucwords(strtolower($data->Saksi_Kota)).'</td>';
                        echo '<td>'.$data->Saksi_TPS.'</td>';
                        echo '<td>'.$data->Saksi_NoHP.'</td>';
                        echo '<td>'.$data->Saksi_Rekomendasi.'</td>';

                        #echo '<td>';
                            #echo '<strong>NIK</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_NoKTP.'<br/><br/>';
                            
                            #echo '<strong>No.HP</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_NoHP;
                        #echo '</td>';

                        #echo '<td>';
                            #echo '<strong>Alamat Rumah</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_AlamatLengkap.'<br/><br/>';
                            
                            #echo '<strong>Kab./Kota</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Kota.'<br/><br/>';

                            #echo '<strong>Kecamatan</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Kecamatan.'<br/><br/>';

                            #echo '<strong>Kelurahan</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Kelurahan;
                        #echo '</td>';

                        #echo '<td>';
                            #echo '<strong>TPS</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_TPS.'<br/><br/>';
                            
                            #echo '<strong>Rekomendasi</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Rekomendasi;
                        #echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListExcelSaksiAksesLogin ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                 tbl_saksitmp.ulog AS "Saksi_Ulog",
                 tbl_saksitmp.plog AS "Saksi_Plog"
                 FROM
                 tbl_saksitmp
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );

            $x = $result->num_rows();

            if ($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    echo '<tr>';
                        echo '<td>'.$data->Saksi_NamaLengkap.'</td>';
                        echo '<td>'.$data->Saksi_NoKTP.'</td>';
                        echo '<td>'.$data->Saksi_Ulog.'</td>';

                        #$plog1 = base64_decode(base64_decode(base64_decode($data->Saksi_Plog)));
                        $plog2 = substr(base64_decode(base64_decode(base64_decode($data->Saksi_Plog))), 0, 3);
                        echo '<td>'.$plog2.' * * *'.'</td>';

                        #echo '<td>'.$data->Saksi_AlamatLengkap.'</td>';
                        #echo '<td>'.$data->Saksi_Kelurahan.'</td>';
                        #echo '<td>'.$data->Saksi_Kecamatan.'</td>';
                        #echo '<td>'.$data->Saksi_Kota.'</td>';
                        #echo '<td>'.$data->Saksi_TPS.'</td>';
                        #echo '<td>'.$data->Saksi_NoHP.'</td>';
                        #echo '<td>'.$data->Saksi_Rekomendasi.'</td>';

                        #echo '<td>';
                            #echo '<strong>NIK</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_NoKTP.'<br/><br/>';
                            
                            #echo '<strong>No.HP</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_NoHP;
                        #echo '</td>';

                        #echo '<td>';
                            #echo '<strong>Alamat Rumah</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_AlamatLengkap.'<br/><br/>';
                            
                            #echo '<strong>Kab./Kota</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Kota.'<br/><br/>';

                            #echo '<strong>Kecamatan</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Kecamatan.'<br/><br/>';

                            #echo '<strong>Kelurahan</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Kelurahan;
                        #echo '</td>';

                        #echo '<td>';
                            #echo '<strong>TPS</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_TPS.'<br/><br/>';
                            
                            #echo '<strong>Rekomendasi</strong>'.'<br/>';
                            #echo '<i class="fa fa-angle-right"></i>'.'&nbsp;&nbsp;'.$data->Saksi_Rekomendasi;
                        #echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        #function PreparedIntegrateSaksiToExistingDb (
            #$dataSaksi

            #$x_nik, $x_namalengkap, $x_alamatlengkap, $x_kelurahan, $x_kecamatan, $x_kota, $x_nohp,

            #$x_kode, $x_path, $x_pathcetak, $x_jeniskelamin, $x_tempatlahir, $x_tanggallahir, $x_rtrw, $x_kodepos,

            #$x_provinsi,

            #$x_agama, $x_statuspernikahan, $x_pekerjaan, $x_kewarganegaraan, $x_email, $x_facebook, $x_twitter, $x_notelepon, $x_posisi, $x_katasandi, $x_ipaddress, $x_domisili,

            #$x_lokasikode, $x_lokasiprovinsi, $x_lokasikota, $x_lokasikecamatan, $x_lokasikelurahan,

            #$x_file_foto, $x_file_nik, $x_file_cv
        #) {
        function PreparedIntegrateSaksiToExistingDb ($Query)
        {
            # create new anggota in existing db
            $this->otherdb = $this->load->database('otherdb', true);
            $this->otherdb->query($Query);
            $this->otherdb->close();
            /*$this->otherdb->query(
                "INSERT INTO
                 daftar_web_final
                 (
                    nik, nama,
                    Alamat, Kelurahan, Kecamatan, KotaKab,
                    Handphone, KTA,

                    DtInsert,
                    Kode, Path, PathCetak,
                    jenis_kelamin, tempat_lahir, tanggal_lahir,
                    RTRW, Kodepos, Provinsi,
                    Agama, Status, Pekerjaan, Kewarganegaraan,
                    Email, Facebook, Twitter, Telpon,
                    posisi, katasandi,
                    IpAddress, domisili,

                    lokasi_kode,
                    lokasi_propinsi,
                    lokasi_kabupatenkota,
                    lokasi_kecamatan,
                    lokasi_kelurahan,

                    file_foto, file_nik, file_cv,

                    dt_update
                 )
                 VALUES
                 (
                    '$x_nik', '$x_namalengkap',
                    '$x_alamatlengkap', '$x_kelurahan', '$x_kecamatan', '$x_kota',
                    '$x_nohp', '$x_nokta',

                    '$x_datetime_insert',
                    '$x_kode', '$x_path', '$x_pathcetak',
                    '$x_jeniskelamin', '$x_tempatlahir', '$x_tanggallahir',
                    '$x_rtrw', '$x_kodepos', '$x_provinsi',
                    '$x_agama', '$x_statuspernikahan', '$x_pekerjaan', '$x_kewarganegaraan',
                    '$x_email', '$x_facebook', '$x_twitter', '$x_notelepon',
                    '$x_posisi', '$x_katasandi',
                    '$x_ipaddress', '$x_domisili',

                    '$x_lokasikode',
                    '$x_lokasiprovinsi',
                    '$x_lokasikota',
                    '$x_lokasikecamatan',
                    '$x_lokasikelurahan',

                    '$x_file_foto', '$x_file_nik', '$x_file_cv',

                    '$x_datetime_update'
                 );"
            );*/
            #$this->otherdb->close();

            #
            #
            #
            #if ($dataSaksi == null || $dataSaksi == "")
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "No data to integrate."
                #);
                #return $result;
            #}
            #else
            #{
                #$lDataSaksi = sizeof($dataSaksi);

                #if ($lDataSaksi == 0)
                #{
                    #$result = array(
                        #"Response_ID" => "0",
                        #"Response_Message" => "No data to integrate."
                    #);
                    #return $result;
                #}
                #else
                #{
                    #$icSuccess = "0";

                    #for ($i = 0; $i < $lDataSaksi; $i++)
                    #{
                        #echo "<pre>";
                        #echo "{" . "<br/>";
                        #echo "&#9;" . "index" . " : " . $i . "<br/>";
                        #echo "&#9;" . "namalengkap" . " : " . $dataSaksi[$i]["namalengkap"] . "<br/>";
                        #echo ($lDataSaksi > 0 ? "}," : "}");
                        #echo "</pre>";

                        #$aData[] = array(
                            #'namalengkap' => $data->Saksi_NamaLengkap,
                            #'nik' => $data->Saksi_NoKTP,
                            #'alamatlengkap' => $data->Saksi_AlamatLengkap,
                            #'kelurahan' => $data->Saksi_Kelurahan,
                            #'kecamatan' => $data->Saksi_Kecamatan,
                            #'kota' => $data->Saksi_Kota,
                            #'tps' => $data->Saksi_TPS,
                            #'nohp' => $data->Saksi_NoHP,
                            #'rekomendasi' => $data->Saksi_Rekomendasi,
                            #'status' => 'Data baru'
                        #);

                        #$x_nik = $dataSaksi[$i]["nik"];
                        #$x_namalengkap = $dataSaksi[$i]["namalengkap"];
                        #$x_alamatlengkap = $dataSaksi[$i]["alamatlengkap"];
                        #$x_kelurahan = $dataSaksi[$i]["kelurahan"];
                        #$x_kecamatan = $dataSaksi[$i]["kecamatan"];
                        #$x_kota = $dataSaksi[$i]["kota"];
                        #$x_nohp = $dataSaksi[$i]["nohp"];

                        #$this->otherdb = $this->load->database('otherdb', true);
                        #$result = $this->otherdb->query(
                            #"SELECT
                             #daftar_web_final.nik AS `User_NoKTP`
                             #FROM
                             #daftar_web_final
                             #WHERE
                             #daftar_web_final.nik = '$x_nik';"
                        #);

                        #$x = $result->num_rows();

                        #if ($x == 0)
                        #{
                            # generate nokta
                            #$x_nokta = substr($x_nik, 0, 6) . $this->randomNumber(10);

                            # check nokta to existing db
                            #$result2 = $this->otherdb->query(
                                #"SELECT
                                 #KTA AS `User_NoKTA`
                                 #FROM
                                 #daftar_web_final
                                 #WHERE
                                 #daftar_web_final.KTA = '$x_nokta';"
                            #);

                            #$x2 = $result2->num_rows();

                            #if ($x2 == 0)
                            #{
                                # save / create new anggota in existing db
                                #date_default_timezone_set("Asia/Jakarta");
                                #$x_datetime_insert = date("Y-m-d H:i:s");

                                #$x_kode = "";
                                #$x_path = "";
                                #$x_pathcetak = "";
                                #$x_jeniskelamin = "";
                                #$x_tempatlahir = "";
                                #$x_tanggallahir = "";
                                #$x_rtrw = "";
                                #$x_kodepos = "";
                                
                                # get provinsi
                                #$this->otherdb2 = $this->load->database('otherdb2', true);

                                #$result3provinsi = $this->otherdb2->query(
                                    #"SELECT
                                     #tbl_wilayah.id AS `Provinsi_ID`,
                                     #tbl_wilayah.provinsi_name AS `Provinsi_NamaProvinsi`
                                     #FROM
                                     #perindowebsite_wilayah_provinsi AS tbl_wilayah
                                     #WHERE
                                     #tbl_wilayah = '';"
                                #);

                                #$x3 = $result3provinsi->num_rows();

                                #$x_provinsi;
                                #if ($x3 == 0)
                                #{
                                    #$x_provinsi = "";
                                #}
                                #else
                                #{
                                    #foreach ($result3provinsi->result() as $data3provinsi)
                                    #{
                                        #$x_provinsi = $data3provinsi->Provinsi_NamaProvinsi;
                                    #}
                                #}
                                # end of get provinsi

                                #$x_provinsi = "";

                                #$x_agama = "";
                                #$x_statuspernikahan = "";
                                #$x_pekerjaan = "";
                                #$x_kewarganegaraan = "";
                                #$x_email = "";
                                #$x_facebook = "";
                                #$x_twitter = "";
                                #$x_notelepon = "";
                                #$x_posisi = "";
                                #$x_katasandi = "";
                                #$x_ipaddress = "";
                                #$x_domisili = "";

                                #$x_lokasikode = "";
                                #$x_lokasiprovinsi = "0";
                                #$x_lokasikota = "0";
                                #$x_lokasikecamatan = "0";
                                #$x_lokasikelurahan = "0";

                                #$x_file_foto = "";
                                #$x_file_nik = "";
                                #$x_file_cv = "";

                                #$x_datetime_update = date("Y-m-d H:i:s");

                                # create new anggota in existing db
                                #$result = $this->otherdb->query(
                                    #"INSERT INTO
                                     #daftar_web_final
                                     #(
                                        #nik, nama,
                                        #Alamat, Kelurahan, Kecamatan, KotaKab,
                                        #Handphone, KTA,

                                        #DtInsert,
                                        #Kode, Path, PathCetak,
                                        #jenis_kelamin, tempat_lahir, tanggal_lahir,
                                        #RTRW, Kodepos, Provinsi,
                                        #Agama, Status, Pekerjaan, Kewarganegaraan,
                                        #Email, Facebook, Twitter, Telpon,
                                        #posisi, katasandi,
                                        #IpAddress, domisili,

                                        #lokasi_kode,
                                        #lokasi_propinsi,
                                        #lokasi_kabupatenkota,
                                        #lokasi_kecamatan,
                                        #lokasi_kelurahan,

                                        #file_foto, file_nik, file_cv,

                                        #dt_update
                                     #)
                                     #VALUES
                                     #(
                                        #'$x_nik', '$x_namalengkap',
                                        #'$x_alamatlengkap', '$x_kelurahan', '$x_kecamatan', '$x_kota',
                                        #'$x_nohp', '$x_nokta',

                                        #'$x_datetime_insert',
                                        #'$x_kode', '$x_path', '$x_pathcetak',
                                        #'$x_jeniskelamin', '$x_tempatlahir', '$x_tanggallahir',
                                        #'$x_rtrw', '$x_kodepos', '$x_provinsi',
                                        #'$x_agama', '$x_statuspernikahan', '$x_pekerjaan', '$x_kewarganegaraan',
                                        #'$x_email', '$x_facebook', '$x_twitter', '$x_notelepon',
                                        #'$x_posisi', '$x_katasandi',
                                        #'$x_ipaddress', '$x_domisili',

                                        #'$x_lokasikode',
                                        #'$x_lokasiprovinsi',
                                        #'$x_lokasikota',
                                        #'$x_lokasikecamatan',
                                        #'$x_lokasikelurahan',

                                        #'$x_file_foto', '$x_file_nik', '$x_file_cv',

                                        #'$x_datetime_update'
                                     #);"
                                #);

                                #if ($result)
                                #{
                                    #$icSuccess = ($icSuccess + 1);
                                #}
                                #else
                                #{
                                    # failed to insert new anggota to existing db
                                #}

                                #$this->otherdb->close();
                            #}
                            #else
                            #{
                                # found nokta anggota in existing db
                                # no action require
                            #}

                            #$this->otherdb->close();
                        #}
                        #else if ($x == 1)
                        #{
                            # found anggota in existing db
                            # no require to insert
                        #}
                        #else
                        #{
                            # duplicated anggota in existing db
                            # no require to insert
                        #}

                        #$this->otherdb->close();
                    #}

                    #$result = array(
                        #"Response_ID" => "1",
                        #"Response_Message" => "Upload & integrasi data saksi berhasil"
                    #);
                    #return $result;
                    #die();

                    #foreach ($result->$dataSaksi as $data)
                    #{
                        #
                    #}
                    #die();
                #}
            #}
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

        function UpdateProfile (
            $User_ID,
            $User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
            $User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
            $User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
            $User_Kontak, $User_Email, $User_NomorKTP
        ) {
            if ($User_NamaDepan == NULL || is_numeric($User_NamaDepan) == true || is_numeric($User_NamaBelakang) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Lengkapi nama dengan benar."
                );
                return $result;
            }
            else if ($User_JenisKelamin == NULL || ($User_JenisKelamin != "Laki-laki" && $User_JenisKelamin != "Perempuan"))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Invalid jenis kelamin."
                );
                return $result;
            }
            else if ($User_TempatLahir == NULL || is_numeric($User_TempatLahir) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Lengkapi tempat lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TanggalLahirDD == NULL || strlen($User_TanggalLahirDD) > 2 || is_numeric($User_TanggalLahirDD) == false || (strlen($User_TanggalLahirDD) == 2 && $User_TanggalLahirDD > 31))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan tanggal lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TanggalLahirMM == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih bulan lahir dengan benar."
                );
                return $result;
            }
            else if ($User_TanggalLahirYYYY == NULL || strlen($User_TanggalLahirYYYY) > 4 || is_numeric($User_TanggalLahirYYYY) == false)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan tahun lahir dengan benar."
                );
                return $result;
            }
            else if ($User_IdProvinsi == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih provinsi dengan benar."
                );
                return $result;
            }
            else if ($User_IdKota == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih kab./kota dengan benar."
                );
                return $result;
            }
            else if ($User_IdKecamatan == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih kecamatan dengan benar."
                );
                return $result;
            }
            else if ($User_IdKelurahan == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Pilih kelurahan dengan benar."
                );
                return $result;
            }
            else if ($User_Kontak == NULL || strpos($User_Kontak, " ") !== false)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kontak dengan benar."
                );
                return $result;
            }
            else if ($User_Email == NULL || strpos($User_Email, " ") !== false)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan email dengan benar."
                );
                return $result;
            }
            else if ($User_NomorKTP == NULL || strpos($User_NomorKTP, " ") !== false)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan nomor ktp dengan benar."
                );
                return $result;
            }
            else
            {
                if (strlen($User_TanggalLahirDD) == 1 && ($User_TanggalLahirDD >= 1 || $User_TanggalLahirDD < 10))
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

                $result = $this->db->query(
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
                );

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

        function UploadExcelSaksiLog ($dataSaksi)
        {
            $IdAdmin = (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"]);

            $countDataSaksi = count($dataSaksi);

            if ($dataSaksi == NULL || $countDataSaksi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Cek kembali data saksi pada file excel anda."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'DELETE FROM tbl_saksilog WHERE idadmin = \''.$IdAdmin.'\';'
                );

                if ($result)
                {
                    $result = $this->db->insert_batch('tbl_saksilog',$dataSaksi);

                    if ($result)
                    {
                        $result = $this->db->query(
                            'SELECT
                             tbl_saksilog.id AS "Saksi_IdSaksi",
                             tbl_saksilog.namalengkap AS "Saksi_NamaLengkap",
                             tbl_saksilog.nik AS "Saksi_NoKTP",
                             tbl_saksilog.alamatlengkap AS "Saksi_AlamatLengkap",
                             tbl_saksilog.kelurahan AS "Saksi_Kelurahan",
                             tbl_saksilog.kecamatan AS "Saksi_Kecamatan",
                             tbl_saksilog.kota AS "Saksi_Kota",
                             tbl_saksilog.tps AS "Saksi_TPS",
                             tbl_saksilog.nohp AS "Saksi_NoHP",
                             tbl_saksilog.rekomendasi AS "Saksi_Rekomendasi"
                             FROM
                             tbl_saksilog
                             WHERE
                             tbl_saksilog.idadmin = \''.$IdAdmin.'\'
                             ORDER BY
                             tbl_saksilog.namalengkap ASC;'
                        );

                        $xlog = $result->num_rows();

                        if ($xlog > 0)
                        {
                            $aData = array();

                            foreach ($result->result() as $data)
                            {
                                $xnik = $data->Saksi_NoKTP;
                                $xnamalengkap = $data->Saksi_NamaLengkap;
                                
                                $resultB = $this->db->query(
                                    'SELECT
                                     tbl_saksitmp.id AS "Saksi_IdSaksi",
                                     tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                                     tbl_saksitmp.nik AS "Saksi_NoKTP",
                                     tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                                     tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                                     tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                                     tbl_saksitmp.kota AS "Saksi_Kota",
                                     tbl_saksitmp.tps AS "Saksi_TPS",
                                     tbl_saksitmp.nohp AS "Saksi_NoHP",
                                     tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                                     FROM
                                     tbl_saksitmp
                                     WHERE
                                     tbl_saksitmp.nik = \''.$xnik.'\' AND
                                     tbl_saksitmp.namalengkap = \''.$xnamalengkap.'\';'
                                );

                                $xtmp = $resultB->num_rows();

                                if ($xtmp == 1)
                                {
                                    foreach ($resultB->result() as $dataB)
                                    {
                                        $aData[] = array(
                                            'namalengkap' => $dataB->Saksi_NamaLengkap, # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' ( Update )'),
                                            'nik' => $dataB->Saksi_NoKTP, # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' ( Update )'),
                                            'alamatlengkap' => $dataB->Saksi_AlamatLengkap, # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' ( Update )'),
                                            'kelurahan' => $dataB->Saksi_Kelurahan, # . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' ( Update )'),
                                            'kecamatan' => $dataB->Saksi_Kecamatan, # . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' ( Update )'),
                                            'kota' => $dataB->Saksi_Kota, # . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' ( Update )'),
                                            'tps' => $dataB->Saksi_TPS, # . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' ( Update )'),
                                            'nohp' => $dataB->Saksi_NoHP, # . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : ' ( Update )'),
                                            'rekomendasi' => $dataB->Saksi_Rekomendasi, # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' ( Update )'),
                                            'status' => 'Data lama'
                                        );
                                    }

                                    foreach ($resultB->result() as $dataB)
                                    {
                                        $aData[] = array(
                                            'namalengkap' => $data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' (data berubah)'),
                                            'nik' => $data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' (data berubah)'),
                                            'alamatlengkap' => $data->Saksi_AlamatLengkap . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' (data berubah)'),
                                            'kelurahan' => $data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' (data berubah)'),
                                            'kecamatan' => $data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' (data berubah)'),
                                            'kota' => $data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' (data berubah)'),
                                            'tps' => $data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                            'nohp' => $data->Saksi_NoHP . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                            'rekomendasi' => $data->Saksi_Rekomendasi . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' (data berubah)'),
                                            'status' => 'Data berubah'
                                        );
                                    }
                                }
                                else
                                {
                                    $aData[] = array(
                                        'namalengkap' => $data->Saksi_NamaLengkap,
                                        'nik' => $data->Saksi_NoKTP,
                                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                        'kelurahan' => $data->Saksi_Kelurahan,
                                        'kecamatan' => $data->Saksi_Kecamatan,
                                        'kota' => $data->Saksi_Kota,
                                        'tps' => $data->Saksi_TPS,
                                        'nohp' => $data->Saksi_NoHP,
                                        'rekomendasi' => $data->Saksi_Rekomendasi,
                                        'status' => 'Data baru'
                                    );
                                }
                            }

                            $result = array(
                                "Response_ID" => "2",
                                "Response_Message" => "Upload data saksi success.",
                                "Response_Array" => $aData
                            );
                            return $result;
                        }
                        else
                        {
                            $result = array(
                                "Response_ID" => "1",
                                "Response_Message" => "Upload data saksi berhasil."
                            );
                            return $result;
                        }
                    }
                    else
                    {
                        $result = array(
                            "Response_ID" => "0",
                            "Response_Message" => "Terjadi kesalahan ekstraksi data saksi.\nCek kembali format kolom pada excel anda."
                        );
                        return $result;
                    }
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Empty log data error."
                    );
                    return $result;
                }
            }
        }

        function UploadExcelSaksiTmp1 ($filepath, $filename)
        {
            echo "filepath : ".$filepath."<br/>";
            echo "filename : ".$filename."<br/>";

            include 'excel/excel_reader.php'; // include the class
            $excel = new PhpExcelReader(); // creates object instance of the class
            
            #if(!is_readable($filepath))
            #{
                #echo $this->error = 1;
                #return false;
            #}

            if (file_exists($filepath))
            {
                echo "Upload file success.<br/>";

                $excel->read($filename); #$excel->read('excel_file.xls'); // reads and stores the excel file data

                // this function creates and returns a HTML table with excel rows and columns data
                // Parameter - array with excel worksheet data
                $nr_sheets = count($excel->sheets); // gets the number of worksheets
                $excel_data = ''; // to store the the html tables with data of each sheet

                // traverses the number of sheets and sets html table with each sheet data in $excel_data
                for($i=0; $i<$nr_sheets; $i++)
                {
                    $excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>'; 
                }

                echo $excel_data; // outputs HTML tables with excel file data
            }
            else
            {
                #echo "File e null.<br/>";
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal mengupload file. Coba lagi!"
                );
                return $result;
            }

            #$excel->read($filepath); #$excel->read('excel_file.xls'); // reads and stores the excel file data

            // Test to see the excel data stored in $sheets property
            #echo '<pre>';
            #var_export($excel->sheets[0]);
            #echo '</pre>';

            // this function creates and returns a HTML table with excel rows and columns data
            // Parameter - array with excel worksheet data
            #$nr_sheets = count($excel->sheets); // gets the number of worksheets
            #$excel_data = ''; // to store the the html tables with data of each sheet

            // traverses the number of sheets and sets html table with each sheet data in $excel_data
            #for($i=0; $i<$nr_sheets; $i++)
            #{
                #$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>'; 
            #}

            #echo $excel_data; // outputs HTML tables with excel file data

            #while ($cond == false)
            #{
                #$rand = $this->randomNumber(10);
                #$kta = ''.substr($value->nik, 2, 4).$rand;
                #$cond1 = $this->m_penerima->selectkta($kta);
                
                #if (empty($cond1))
                #{
            
                    #$value->kta = $kta;
                    #$cond = true;
                #}
            #}
        }

        function UploadExcelSaksiTmp2 ()
        {
            $IdAdmin = (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"]);

            # query mysql patch 2
            /*$result = $this->db->query(
                "SELECT
                 (
                    SELECT
                    x.id
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.namalengkap = l.namalengkap AND
                    x.nik = l.nik
                    ORDER BY x.id DESC
                    LIMIT 0, 1
                 ) AS `Saksi_IdSaksi`,

                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(kelurahan.kelurahan = NULL, '', kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 l.kelurahan AS `Saksi_Kelurahan2`,
                 IF(kecamatan.kecamatan = NULL, '', kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 l.kecamatan AS `Saksi_Kecamatan2`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Saksi_Kota`,
                 l.kota AS `Saksi_Kota2`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,

                 COUNT(l.nik)-1 AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 LEFT JOIN
                 tbl_kelurahan AS kelurahan ON l.kelurahan = kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON l.kecamatan = kecamatan.id
                 LEFT JOIN
                 tbl_kota AS kota ON l.kota = kota.id
                 WHERE
                 l.idadmin = '$IdAdmin'
                 GROUP BY
                 l.namalengkap, l.nik, l.alamatlengkap,
                 kelurahan.kelurahan, l.kelurahan,
                 kecamatan.kecamatan, l.kecamatan,
                 kota.kota, l.kota,
                 l.tps, l.nohp, l.rekomendasi
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;"
            );*/

            # query mysql patch 1
            $result = $this->db->query(
                "SELECT
                 (
                    SELECT
                    x.id
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.namalengkap = l.namalengkap AND
                    x.nik = l.nik AND
                    x.kelurahan = l.kelurahan AND
                    x.kecamatan = l.kecamatan AND
                    x.kota = l.kota AND
                    x.tps = l.tps
                    ORDER BY x.id DESC
                    LIMIT 0, 1
                 ) AS `Saksi_IdSaksi`,
                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 l.kelurahan AS `Saksi_Kelurahan`,
                 l.kecamatan AS `Saksi_Kecamatan`,
                 l.kota AS `Saksi_Kota`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = '$IdAdmin'
                 GROUP BY
                 l.namalengkap, l.nik,
                 l.alamatlengkap, l.kelurahan, l.kecamatan, l.kota,
                 l.tps, l.nohp, l.rekomendasi
                 ORDER BY
                 l.kota ASC, l.kecamatan ASC, l.kelurahan ASC,
                 l.namalengkap ASC,
                 l.nik DESC;"
            );

            # query postgresql
            /*$result = $this->db->query(
                'SELECT DISTINCT ON (l.namalengkap, l.nik)
                 l.id AS "Saksi_IdSaksi",
                 l.namalengkap AS "Saksi_NamaLengkap",
                 l.nik AS "Saksi_NoKTP",
                 l.alamatlengkap AS "Saksi_AlamatLengkap",
                 l.kelurahan AS "Saksi_Kelurahan",
                 l.kecamatan AS "Saksi_Kecamatan",
                 l.kota AS "Saksi_Kota",
                 l.tps AS "Saksi_TPS",
                 l.nohp AS "Saksi_NoHP",
                 l.rekomendasi AS "Saksi_Rekomendasi",
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS "Saksi_CountDuplicated"
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = \''.$IdAdmin.'\'
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;'
            );*/

            $xlog = $result->num_rows();

            if ($xlog > 0)
            {
                #$aData = array();

                foreach ($result->result() as $data)
                {
                    $xnik = $data->Saksi_NoKTP;
                    $xnamalengkap = $data->Saksi_NamaLengkap;

                    $xkelurahan = $data->Saksi_Kelurahan;
                    $xkecamatan = $data->Saksi_Kecamatan;
                    $xkota = $data->Saksi_Kota;
                    $xNomorTPS = $data->Saksi_TPS;
                    
                    # query mysql patch 2
                    $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                         tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                         tbl_saksitmp.kota AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    );

                    # query mysql patch 1
                    /*$resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                         IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                         IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         LEFT JOIN
                         tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                         LEFT JOIN
                         tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                         LEFT JOIN
                         tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    );*/

                    # query postgresql
                    /*$resultB = $this->db->query(
                        'SELECT
                         tbl_saksitmp.id AS "Saksi_IdSaksi",
                         tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                         tbl_saksitmp.nik AS "Saksi_NoKTP",
                         tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                         tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                         tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                         tbl_saksitmp.kota AS "Saksi_Kota",
                         tbl_saksitmp.tps AS "Saksi_TPS",
                         tbl_saksitmp.nohp AS "Saksi_NoHP",
                         tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = \''.$xnik.'\' AND
                         tbl_saksitmp.namalengkap = \''.$xnamalengkap.'\';'
                    );*/

                    $xtmp = $resultB->num_rows();

                    if ($xtmp == 1)
                    {
                        #foreach ($resultB->result() as $dataB)
                        #{
                            #echo '<tr>';
                                #echo '<td>'.$dataB->Saksi_NamaLengkap.'</td>';
                                #echo '<td>'.$dataB->Saksi_NoKTP.'</td>';
                                #echo '<td>'.$dataB->Saksi_AlamatLengkap.'</td>';
                                #echo '<td>'.$dataB->Saksi_Kelurahan.'</td>';
                                #echo '<td>'.$dataB->Saksi_Kecamatan.'</td>';
                                #echo '<td>'.$dataB->Saksi_Kota.'</td>';
                                #echo '<td>'.$dataB->Saksi_TPS.'</td>';
                                #echo '<td>'.$dataB->Saksi_NoHP.'</td>';
                                #echo '<td>'.$dataB->Saksi_Rekomendasi.'</td>';
                                #echo '<td>'.'Data lama'.'</td>';
                            #echo '</tr>';

                            #$aData[] = array(
                                #'namalengkap' => $dataB->Saksi_NamaLengkap, # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' ( Update )'),
                                #'nik' => $dataB->Saksi_NoKTP, # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' ( Update )'),
                                #'alamatlengkap' => $dataB->Saksi_AlamatLengkap, # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' ( Update )'),
                                #'kelurahan' => $dataB->Saksi_Kelurahan, # . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' ( Update )'),
                                #'kecamatan' => $dataB->Saksi_Kecamatan, # . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' ( Update )'),
                                #'kota' => $dataB->Saksi_Kota, # . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' ( Update )'),
                                #'tps' => $dataB->Saksi_TPS, # . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' ( Update )'),
                                #'nohp' => $dataB->Saksi_NoHP, # . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : ' ( Update )'),
                                #'rekomendasi' => $dataB->Saksi_Rekomendasi, # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' ( Update )'),
                                #'status' => 'Data lama'
                            #);
                        #}

                        foreach ($resultB->result() as $dataB)
                        {
                            if (($data->Saksi_Kelurahan == NULL || $this->hasNumber($data->Saksi_Kelurahan)) || ($data->Saksi_Kecamatan == NULL || $this->hasNumber($data->Saksi_Kecamatan)) || ($data->Saksi_Kota == NULL || $this->hasNumber($data->Saksi_Kota)) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP))
                            {
                                # data error
                                echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)) . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) == 16 && $this->hasNumber($data->Saksi_NoKTP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)) . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : ($data->Saksi_Kelurahan == NULL ? '<strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>')).'</td>';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)) . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : ($data->Saksi_Kecamatan == NULL ? '<strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>')).'</td>';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)) . ($this->hasLetter($data->Saksi_Kota) ? '' : ($data->Saksi_Kota == NULL ? '<strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>')).'</td>';
                                    
                                    echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td>'.'Data berubah'.'</td>';
                                echo '</tr>';
                            }
                            else
                            {
                                $resultC1 = $this->db->query(
                                    "SELECT
                                     (
                                        SELECT
                                        x.id
                                        FROM
                                        tbl_saksilog AS x
                                        WHERE
                                        x.idadmin = l.idadmin AND
                                        x.namalengkap = l.namalengkap AND
                                        x.nik = l.nik AND
                                        x.kelurahan = l.kelurahan AND
                                        x.kecamatan = l.kecamatan AND
                                        x.kota = l.kota AND
                                        x.tps = l.tps
                                        ORDER BY x.id DESC
                                        LIMIT 0, 1
                                     ) AS `Saksi_IdSaksi`,
                                     l.namalengkap AS `Saksi_NamaLengkap`,
                                     l.nik AS `Saksi_NoKTP`,
                                     l.alamatlengkap AS `Saksi_AlamatLengkap`,
                                     l.kelurahan AS `Saksi_Kelurahan`,
                                     l.kecamatan AS `Saksi_Kecamatan`,
                                     l.kota AS `Saksi_Kota`,
                                     l.tps AS `Saksi_TPS`,
                                     l.nohp AS `Saksi_NoHP`,
                                     l.rekomendasi AS `Saksi_Rekomendasi`,
                                     (
                                        SELECT
                                        COUNT(x.nik)-1
                                        FROM
                                        tbl_saksilog AS x
                                        WHERE
                                        x.idadmin = l.idadmin AND
                                        x.nik = l.nik AND
                                        x.namalengkap = l.namalengkap
                                     ) AS `Saksi_CountDuplicated`
                                     FROM
                                     tbl_saksilog AS l
                                     WHERE
                                     l.idadmin = '$IdAdmin' AND
                                     l.kelurahan = '$xkelurahan' AND
                                     l.kecamatan = '$xkecamatan' AND
                                     l.kota = '$xkota' AND
                                     l.tps = '$xNomorTPS'
                                     GROUP BY
                                     l.namalengkap, l.nik,
                                     l.alamatlengkap, l.kelurahan, l.kecamatan, l.kota,
                                     l.tps, l.nohp, l.rekomendasi
                                     ORDER BY
                                     l.kota ASC, l.kecamatan ASC, l.kelurahan ASC,
                                     l.namalengkap ASC,
                                     l.nik DESC;"
                                );

                                $xrC1 = $resultC1->num_rows();

                                if ($xrC1 > 1)
                                {
                                    # data baru tapi terduplikasi -> Kelurahan, Kecamatan, Kab. / Kota, TPS -> Sama
                                    #echo '<tr style="background-color: #2196F3; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                        #echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)).'</td>';
                                        #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                        #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                        #echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)).'</td>';
                                        #echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)).'</td>';
                                        #echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)).'</td>';
                                        #echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                        #echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                        #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                        #echo '<td>'.'Data baru'.'</td>';
                                    #echo '</tr>';

                                    $xbgcolor = "#2196F3";

                                    # data berubah tapi terduplikasi -> Kelurahan, Kecamatan, Kab. / Kota, TPS -> Sama
                                    echo '<tr style="background-color: '.$xbgcolor.'; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)) . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap .  ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)) . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)) . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)) . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        #echo '<td>'.'Data berubah'.'</td>';
                                    echo '</tr>';
                                }
                                else
                                {
                                    $xbgcolor;
                                    if ( ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap) &&
                                         ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP) &&
                                         ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap) &&
                                         ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan) &&
                                         ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan) &&
                                         ($dataB->Saksi_Kota == $data->Saksi_Kota) &&
                                         ($dataB->Saksi_TPS == $data->Saksi_TPS) &&
                                         ($dataB->Saksi_NoHP == $data->Saksi_NoHP) &&
                                         ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi)
                                    ) {
                                        $xbgcolor = "#FFFFFF";
                                    }
                                    else
                                    {
                                        $xbgcolor = "#FFC107";
                                    }

                                    # decode -> data baru dan data update (if available)
                                    echo '<tr style="background-color: '.$xbgcolor.'; border-collapse: collapse; spacing: 1; color: #000000;">';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)) . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap .  ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)) . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)) . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)) . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                        #echo '<td>'.'Data berubah'.'</td>';
                                    echo '</tr>';
                                }
                            }

                            #$aData[] = array(
                                #'namalengkap' => $data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' (data berubah)'),
                                #'nik' => $data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' (data berubah)'),
                                #'alamatlengkap' => $data->Saksi_AlamatLengkap . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' (data berubah)'),
                                #'kelurahan' => $data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' (data berubah)'),
                                #'kecamatan' => $data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' (data berubah)'),
                                #'kota' => $data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' (data berubah)'),
                                #'tps' => $data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                #'nohp' => $data->Saksi_NoHP . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                #'rekomendasi' => $data->Saksi_Rekomendasi . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' (data berubah)'),
                                #'status' => 'Data berubah'
                            #);
                        }
                    }
                    else
                    {
                        /*$resultC = $this->db->query(
                            "SELECT
                             (SELECT
                              tbl_kota.kota
                              FROM
                              tbl_kota
                              WHERE
                              tbl_kota.kota LIKE CONCAT('%', tbl_saksilog.kota, '%')
                              ORDER BY
                              tbl_kota.kota ASC
                              LIMIT 0, 1
                             ) AS `Wilayah_Kota`,
                             (SELECT
                              tbl_kecamatan.kecamatan
                              FROM
                              tbl_kecamatan
                              #LEFT JOIN
                              #tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                              WHERE
                              tbl_kecamatan.kecamatan LIKE CONCAT('%', tbl_saksilog.kecamatan, '%')
                              #tbl_kota.kota LIKE CONCAT('%', tbl_saksilog.kota, '%')
                              ORDER BY
                              tbl_kecamatan.kecamatan ASC
                              LIMIT 0, 1
                             ) AS `Wilayah_Kecamatan`,
                             (SELECT
                              tbl_kelurahan.kelurahan
                              FROM
                              tbl_kelurahan
                              #LEFT JOIN
                              #tbl_kecamatan ON tbl_kelurahan.idkecamatan = tbl_kecamatan.id
                              #LEFT JOIN
                              #tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                              WHERE
                              tbl_kelurahan.kelurahan LIKE CONCAT('%', tbl_saksilog.kelurahan, '%')
                              #tbl_kecamatan.kecamatan LIKE CONCAT('%', tbl_saksilog.kecamatan, '%') AND
                              #tbl_kota.kota LIKE CONCAT('%', tbl_saksilog.kota, '%')
                              ORDER BY
                              tbl_kelurahan.kelurahan ASC
                              LIMIT 0, 1
                             ) AS `Wilayah_Kelurahan`
                             FROM
                             tbl_saksilog
                             WHERE
                             tbl_saksilog.idadmin = '1';"
                        );

                        $xrC = $resultC->num_rows();

                        if ($xrC == 1)
                        {
                            # data wilayah valid
                        }
                        else
                        {
                            # data wilayah error
                            echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) == 16 && $this->hasNumber($data->Saksi_NoKTP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>'; # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>'; # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # .'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                
                                echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>'.'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>'.'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_Kota . '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>'.'</td>';

                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';

                                echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td>'.'Data berubah'.'</td>';
                            echo '</tr>';
                        }*/

                        if ((strlen($data->Saksi_NoKTP) <> 16) || ($data->Saksi_Kelurahan == NULL || $this->hasNumber($data->Saksi_Kelurahan)) || ($data->Saksi_Kecamatan == NULL || $this->hasNumber($data->Saksi_Kecamatan)) || ($data->Saksi_Kota == NULL || $this->hasNumber($data->Saksi_Kota)) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP) ||
                            (substr($data->Saksi_NoKTP, 0, 2) != "11" && substr($data->Saksi_NoKTP, 0, 2) != "12" && substr($data->Saksi_NoKTP, 0, 2) != "13" && substr($data->Saksi_NoKTP, 0, 2) != "14" && substr($data->Saksi_NoKTP, 0, 2) != "15" && substr($data->Saksi_NoKTP, 0, 2) != "16" && substr($data->Saksi_NoKTP, 0, 2) != "17" && substr($data->Saksi_NoKTP, 0, 2) != "18" && substr($data->Saksi_NoKTP, 0, 2) != "19" && substr($data->Saksi_NoKTP, 0, 2) != "21" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "31" && substr($data->Saksi_NoKTP, 0, 2) != "32" && substr($data->Saksi_NoKTP, 0, 2) != "33" && substr($data->Saksi_NoKTP, 0, 2) != "34" && substr($data->Saksi_NoKTP, 0, 2) != "35" && substr($data->Saksi_NoKTP, 0, 2) != "36" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "51" && substr($data->Saksi_NoKTP, 0, 2) != "52" && substr($data->Saksi_NoKTP, 0, 2) != "53" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "61" && substr($data->Saksi_NoKTP, 0, 2) != "62" && substr($data->Saksi_NoKTP, 0, 2) != "63" && substr($data->Saksi_NoKTP, 0, 2) != "64" && substr($data->Saksi_NoKTP, 0, 2) != "65" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "71" && substr($data->Saksi_NoKTP, 0, 2) != "72" && substr($data->Saksi_NoKTP, 0, 2) != "73" && substr($data->Saksi_NoKTP, 0, 2) != "74" && substr($data->Saksi_NoKTP, 0, 2) != "75" && substr($data->Saksi_NoKTP, 0, 2) != "76" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "81" && substr($data->Saksi_NoKTP, 0, 2) != "82" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "91" && substr($data->Saksi_NoKTP, 0, 2) != "91"
                            )
                        ) {
                            # data error
                            echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)) . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) != 16 || $this->hasNumber($data->Saksi_NoKTP) == false ||
                                    (substr($data->Saksi_NoKTP, 0, 2) != "11" && substr($data->Saksi_NoKTP, 0, 2) != "12" && substr($data->Saksi_NoKTP, 0, 2) != "13" && substr($data->Saksi_NoKTP, 0, 2) != "14" && substr($data->Saksi_NoKTP, 0, 2) != "15" && substr($data->Saksi_NoKTP, 0, 2) != "16" && substr($data->Saksi_NoKTP, 0, 2) != "17" && substr($data->Saksi_NoKTP, 0, 2) != "18" && substr($data->Saksi_NoKTP, 0, 2) != "19" && substr($data->Saksi_NoKTP, 0, 2) != "21" &&
                                     substr($data->Saksi_NoKTP, 0, 2) != "31" && substr($data->Saksi_NoKTP, 0, 2) != "32" && substr($data->Saksi_NoKTP, 0, 2) != "33" && substr($data->Saksi_NoKTP, 0, 2) != "34" && substr($data->Saksi_NoKTP, 0, 2) != "35" && substr($data->Saksi_NoKTP, 0, 2) != "36" &&
                                     substr($data->Saksi_NoKTP, 0, 2) != "51" && substr($data->Saksi_NoKTP, 0, 2) != "52" && substr($data->Saksi_NoKTP, 0, 2) != "53" &&
                                     substr($data->Saksi_NoKTP, 0, 2) != "61" && substr($data->Saksi_NoKTP, 0, 2) != "62" && substr($data->Saksi_NoKTP, 0, 2) != "63" && substr($data->Saksi_NoKTP, 0, 2) != "64" && substr($data->Saksi_NoKTP, 0, 2) != "65" &&
                                     substr($data->Saksi_NoKTP, 0, 2) != "71" && substr($data->Saksi_NoKTP, 0, 2) != "72" && substr($data->Saksi_NoKTP, 0, 2) != "73" && substr($data->Saksi_NoKTP, 0, 2) != "74" && substr($data->Saksi_NoKTP, 0, 2) != "75" && substr($data->Saksi_NoKTP, 0, 2) != "76" &&
                                     substr($data->Saksi_NoKTP, 0, 2) != "81" && substr($data->Saksi_NoKTP, 0, 2) != "82" &&
                                     substr($data->Saksi_NoKTP, 0, 2) != "91" && substr($data->Saksi_NoKTP, 0, 2) != "91"
                                    ) ? '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>'; # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>'; # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # .'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                
                                echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)) . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : ($data->Saksi_Kelurahan == NULL ? '<strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>')).'</td>';
                                echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)) . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : ($data->Saksi_Kecamatan == NULL ? '<strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>')).'</td>';
                                echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)) . ($this->hasLetter($data->Saksi_Kota) ? '' : ($data->Saksi_Kelurahan == NULL ? '<strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>')).'</td>';
                                
                                echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td>'.'Data berubah'.'</td>';
                            echo '</tr>';
                        }
                        else
                        {
                            if ($data->Saksi_CountDuplicated >= 1)
                            {
                                $resultC = $this->db->query(
                                    "SELECT
                                     (
                                        SELECT
                                        x.id
                                        FROM
                                        tbl_saksilog AS x
                                        WHERE
                                        x.idadmin = l.idadmin AND
                                        x.namalengkap = l.namalengkap AND
                                        x.nik = l.nik AND
                                        x.kelurahan = l.kelurahan AND
                                        x.kecamatan = l.kecamatan AND
                                        x.kota = l.kota AND
                                        x.tps = l.tps
                                        ORDER BY x.id DESC
                                        LIMIT 0, 1
                                     ) AS `Saksi_IdSaksi`,
                                     l.namalengkap AS `Saksi_NamaLengkap`,
                                     l.nik AS `Saksi_NoKTP`,
                                     l.alamatlengkap AS `Saksi_AlamatLengkap`,
                                     l.kelurahan AS `Saksi_Kelurahan`,
                                     l.kecamatan AS `Saksi_Kecamatan`,
                                     l.kota AS `Saksi_Kota`,
                                     l.tps AS `Saksi_TPS`,
                                     l.nohp AS `Saksi_NoHP`,
                                     l.rekomendasi AS `Saksi_Rekomendasi`,
                                     (
                                        SELECT
                                        COUNT(x.nik)-1
                                        FROM
                                        tbl_saksilog AS x
                                        WHERE
                                        x.idadmin = l.idadmin AND
                                        x.nik = l.nik AND
                                        x.namalengkap = l.namalengkap
                                     ) AS `Saksi_CountDuplicated`
                                     FROM
                                     tbl_saksilog AS l
                                     WHERE
                                     l.idadmin = '$IdAdmin' AND
                                     l.kelurahan = '$xkelurahan' AND
                                     l.kecamatan = '$xkecamatan' AND
                                     l.kota = '$xkota' AND
                                     l.tps = '$xNomorTPS'
                                     GROUP BY
                                     l.namalengkap, l.nik,
                                     l.alamatlengkap, l.kelurahan, l.kecamatan, l.kota,
                                     l.tps, l.nohp, l.rekomendasi
                                     ORDER BY
                                     l.kota ASC, l.kecamatan ASC, l.kelurahan ASC,
                                     l.namalengkap ASC,
                                     l.nik DESC;"
                                );

                                $xrC = $resultC->num_rows();

                                if ($xrC > 1)
                                {
                                    # data baru tapi terduplikasi -> Kelurahan, Kecamatan, Kab. / Kota, TPS -> Sama
                                    echo '<tr style="background-color: #2196F3; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)).'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)).'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)).'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)).'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                        #echo '<td>'.'Data baru'.'</td>';
                                    echo '</tr>';
                                }
                                else
                                {
                                    # data baru tapi terduplikasi -> Kelurahan, Kecamatan, Kab. / Kota, TPS -> Berbeda
                                    echo '<tr style="background-color: #9C27B0; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)).'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)).'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)).'</td>';
                                        echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)).'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                        echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                        #echo '<td>'.'Data baru'.'</td>';
                                    echo '</tr>';
                                }
                            }
                            else
                            {
                                # data baru
                                echo '<tr style="background-color: #43A047; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_NamaLengkap)).'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kelurahan)).'</td>';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kecamatan)).'</td>';
                                    echo '<td style="border: 1;">'.ucwords(strtolower($data->Saksi_Kota)).'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                    echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                    #echo '<td>'.'Data baru'.'</td>';
                                echo '</tr>';
                            }

                            # $resultC = $this->db->query(
                                #'SELECT
                                # l.id AS "Saksi_IdSaksi",
                                # l.namalengkap AS "Saksi_NamaLengkap",
                                # l.nik AS "Saksi_NoKTP",
                                # l.alamatlengkap AS "Saksi_AlamatLengkap",
                                # l.kelurahan AS "Saksi_Kelurahan",
                                # l.kecamatan AS "Saksi_Kecamatan",
                                # l.kota AS "Saksi_Kota",
                                # l.tps AS "Saksi_TPS",
                                # l.nohp AS "Saksi_NoHP",
                                # l.rekomendasi AS "Saksi_Rekomendasi",
                                # (
                                    # SELECT
                                    # COUNT(x.nik)-1
                                    # FROM
                                    # tbl_saksilog AS x
                                    # WHERE
                                    # x.idadmin = l.idadmin AND
                                    # x.nik = l.nik AND
                                    # x.namalengkap = l.namalengkap
                                # ) AS "Saksi_CountDuplicated"
                                # FROM
                                # tbl_saksilog AS l
                                # WHERE
                                # l.idadmin = \''.$IdAdmin.'\'
                                # ORDER BY
                                # l.namalengkap ASC;'
                            # );

                            # $xlog2 = $resultB->num_rows();

                            # if ($xlog > 1)
                            # {
                                # data baru tapi duplikat
                                # echo '<tr style="background-color: #9C27B0; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    # echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Kelurahan.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Kecamatan.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Kota.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                    # echo '<td>'.'Data baru'.'</td>';
                                # echo '</tr>';
                            # }
                            # else
                            # {
                                # data baru
                                # echo '<tr style="background-color: #43A047; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    # echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Kelurahan.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Kecamatan.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Kota.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                    # echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                    # echo '<td>'.'Data baru'.'</td>';
                                # echo '</tr>';
                            # }
                        }

                        #$aData[] = array(
                            #'namalengkap' => $data->Saksi_NamaLengkap,
                            #'nik' => $data->Saksi_NoKTP,
                            #'alamatlengkap' => $data->Saksi_AlamatLengkap,
                            #'kelurahan' => $data->Saksi_Kelurahan,
                            #'kecamatan' => $data->Saksi_Kecamatan,
                            #'kota' => $data->Saksi_Kota,
                            #'tps' => $data->Saksi_TPS,
                            #'nohp' => $data->Saksi_NoHP,
                            #'rekomendasi' => $data->Saksi_Rekomendasi,
                            #'status' => 'Data baru'
                        #);
                    }
                }

                #$result = array(
                    #"Response_ID" => "2",
                    #"Response_Message" => "Decrypt excel success.",
                    #"Response_Array" => $aData
                #);
                #return $result;
            }

            return $result;
        }

        function UploadExcelSaksiTmp3 ()
        {
            $IdAdmin = (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"]);

            # query mysql patch 2
            /*$result = $this->db->query(
                "SELECT
                 l.id AS `Saksi_IdSaksi`,
                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(kelurahan.kelurahan = NULL, '', kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(kecamatan.kecamatan = NULL, '', kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Saksi_Kota`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 LEFT JOIN
                 tbl_kelurahan AS kelurahan ON l.kelurahan = kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON l.kecamatan = kecamatan.id
                 LEFT JOIN
                 tbl_kota AS kota ON l.kota = kota.id
                 WHERE
                 l.idadmin = '$IdAdmin'
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;"
            ); */

            # query mysql patch 1
            $result = $this->db->query(
                "SELECT
                 l.id AS `Saksi_IdSaksi`,
                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 l.kelurahan AS `Saksi_Kelurahan`,
                 l.kecamatan AS `Saksi_Kecamatan`,
                 l.kota AS `Saksi_Kota`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = '$IdAdmin'
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;"
            );

            # query postgresql
            /*$result = $this->db->query(
                'SELECT
                 l.id AS "Saksi_IdSaksi",
                 l.namalengkap AS "Saksi_NamaLengkap",
                 l.nik AS "Saksi_NoKTP",
                 l.alamatlengkap AS "Saksi_AlamatLengkap",
                 l.kelurahan AS "Saksi_Kelurahan",
                 l.kecamatan AS "Saksi_Kecamatan",
                 l.kota AS "Saksi_Kota",
                 l.tps AS "Saksi_TPS",
                 l.nohp AS "Saksi_NoHP",
                 l.rekomendasi AS "Saksi_Rekomendasi",
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS "Saksi_CountDuplicated"
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = \''.$IdAdmin.'\'
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;'
            );*/

            /*$result = $this->db->query(
                'SELECT
                 tbl_saksilog.id AS "Saksi_IdSaksi",
                 tbl_saksilog.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksilog.nik AS "Saksi_NoKTP",
                 tbl_saksilog.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksilog.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksilog.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksilog.kota AS "Saksi_Kota",
                 tbl_saksilog.tps AS "Saksi_TPS",
                 tbl_saksilog.nohp AS "Saksi_NoHP",
                 tbl_saksilog.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksilog
                 WHERE
                 tbl_saksilog.idadmin = \''.$IdAdmin.'\'
                 ORDER BY
                 tbl_saksilog.namalengkap ASC;'
            );*/

            $xlog = $result->num_rows();

            $aData = array();

            if ($xlog > 0)
            {
                foreach ($result->result() as $data)
                {
                    $xnik = $data->Saksi_NoKTP;
                    $xnamalengkap = $data->Saksi_NamaLengkap;
                    
                    # query mysql patch 2
                    /* $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                         IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                         IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         LEFT JOIN
                         tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                         LEFT JOIN
                         tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                         LEFT JOIN
                         tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    ); */

                    # query mysql patch 1
                    $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                         tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                         tbl_saksitmp.kota AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    );

                    # query postgresql
                    /*$resultB = $this->db->query(
                        'SELECT
                         tbl_saksitmp.id AS "Saksi_IdSaksi",
                         tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                         tbl_saksitmp.nik AS "Saksi_NoKTP",
                         tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                         tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                         tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                         tbl_saksitmp.kota AS "Saksi_Kota",
                         tbl_saksitmp.tps AS "Saksi_TPS",
                         tbl_saksitmp.nohp AS "Saksi_NoHP",
                         tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = \''.$xnik.'\' AND
                         tbl_saksitmp.namalengkap = \''.$xnamalengkap.'\';'
                    );*/

                    $xtmp = $resultB->num_rows();

                    if ($xtmp == 1)
                    {
                        foreach ($resultB->result() as $dataB)
                        {
                            if ($this->hasNumber($data->Saksi_Kelurahan) || $this->hasNumber($data->Saksi_Kecamatan) || $this->hasNumber($data->Saksi_Kota) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP))
                            {
                                # add to array
                                $aData[] = array(
                                    'namalengkap' => ucwords(strtolower($data->Saksi_NamaLengkap)),
                                    'nik' => $data->Saksi_NoKTP,
                                    'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                    'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                                    'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                                    'kota' => ucwords(strtolower($data->Saksi_Kota)),
                                    'tps' => $data->Saksi_TPS,
                                    'nohp' => $data->Saksi_NoHP,
                                    'rekomendasi' => $data->Saksi_Rekomendasi,
                                    'status' => 'Data Invalid'
                                );

                                # data error
                                #echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '</tr>';
                            }
                            else
                            {
                                if ( ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap) &&
                                     ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP) &&
                                     ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap) &&
                                     ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan) &&
                                     ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan) &&
                                     ($dataB->Saksi_Kota == $data->Saksi_Kota) &&
                                     ($dataB->Saksi_TPS == $data->Saksi_TPS) &&
                                     ($dataB->Saksi_NoHP == $data->Saksi_NoHP) &&
                                     ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi)
                                ){
                                    # add to array
                                    $aData[] = array(
                                        'namalengkap' => ucwords(strtolower($data->Saksi_NamaLengkap)),
                                        'nik' => $data->Saksi_NoKTP,
                                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                        'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                                        'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                                        'kota' => ucwords(strtolower($data->Saksi_Kota)),
                                        'tps' => $data->Saksi_TPS,
                                        'nohp' => $data->Saksi_NoHP,
                                        'rekomendasi' => $data->Saksi_Rekomendasi,
                                        'status' => 'Tidak Ada Perubahan'
                                    );
                                }
                                else
                                {
                                    # add to array
                                    $aData[] = array(
                                        'namalengkap' => ucwords(strtolower($data->Saksi_NamaLengkap)),
                                        'nik' => $data->Saksi_NoKTP,
                                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                        'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                                        'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                                        'kota' => ucwords(strtolower($data->Saksi_Kota)),
                                        'tps' => $data->Saksi_TPS,
                                        'nohp' => $data->Saksi_NoHP,
                                        'rekomendasi' => $data->Saksi_Rekomendasi,
                                        'status' => 'Data Update'
                                    );
                                }

                                # decode -> data baru dan data update (if available)
                                #echo '<tr style="background-color: #FFC107; border-collapse: collapse; spacing: 1; color: #000000;">';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '</tr>';
                            }
                        }
                    }
                    else
                    {
                        if ($this->hasNumber($data->Saksi_Kelurahan) || $this->hasNumber($data->Saksi_Kecamatan) || $this->hasNumber($data->Saksi_Kota) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP))
                        {
                            # add to array
                            $aData[] = array(
                                'namalengkap' => ucwords(strtolower($data->Saksi_NamaLengkap)),
                                'nik' => $data->Saksi_NoKTP,
                                'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                                'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                                'kota' => ucwords(strtolower($data->Saksi_Kota)),
                                'tps' => $data->Saksi_TPS,
                                'nohp' => $data->Saksi_NoHP,
                                'rekomendasi' => $data->Saksi_Rekomendasi,
                                'status' => 'Data Invalid'
                            );

                            # data error
                            #echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>'; # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>'; # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # .'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td>'.'Data berubah'.'</td>';
                            #echo '</tr>';
                        }
                        else
                        {
                            if ($data->Saksi_CountDuplicated >= 1)
                            {
                                # add to array
                                $aData[] = array(
                                    'namalengkap' => ucwords(strtolower($data->Saksi_NamaLengkap)),
                                    'nik' => $data->Saksi_NoKTP,
                                    'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                    'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                                    'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                                    'kota' => ucwords(strtolower($data->Saksi_Kota)),
                                    'tps' => $data->Saksi_TPS,
                                    'nohp' => $data->Saksi_NoHP,
                                    'rekomendasi' => $data->Saksi_Rekomendasi,
                                    'status' => 'Data Baru (Terduplikasi)'
                                );
                            }
                            else
                            {
                                # add to array
                                $aData[] = array(
                                    'namalengkap' => ucwords(strtolower($data->Saksi_NamaLengkap)),
                                    'nik' => $data->Saksi_NoKTP,
                                    'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                    'kelurahan' => ucwords(strtolower($data->Saksi_Kelurahan)),
                                    'kecamatan' => ucwords(strtolower($data->Saksi_Kecamatan)),
                                    'kota' => ucwords(strtolower($data->Saksi_Kota)),
                                    'tps' => $data->Saksi_TPS,
                                    'nohp' => $data->Saksi_NoHP,
                                    'rekomendasi' => $data->Saksi_Rekomendasi,
                                    'status' => 'Data Baru'
                                );
                            }

                            # data baru
                            #echo '<tr style="background-color: #43A047; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                #echo '<td>'.'Data baru'.'</td>';
                            #echo '</tr>';
                        }
                    }
                }
            }

            $result = $aData;
            return $result;
        }

        function UploadExcelSaksiTmp4 ()
        {
            $IdAdmin = (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"]);

            # query mysql patch 2
            /*$result = $this->db->query(
                "SELECT
                 tbl_saksilog.id AS `Saksi_IdSaksi`,
                 tbl_saksilog.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksilog.nik AS `Saksi_NoKTP`,
                 tbl_saksilog.alamatlengkap AS `Saksi_AlamatLengkap`,
                 tbl_saksilog.kelurahan AS `Saksi_Kelurahan`,
                 tbl_saksilog.kecamatan AS `Saksi_Kecamatan`,
                 tbl_saksilog.kota AS `Saksi_Kota`,
                 tbl_saksilog.tps AS `Saksi_TPS`,
                 tbl_saksilog.nohp AS `Saksi_NoHP`,
                 tbl_saksilog.rekomendasi AS `Saksi_Rekomendasi`
                 FROM
                 tbl_saksilog
                 LEFT JOIN
                 tbl_kelurahan ON tbl_saksilog.kelurahan = tbl_kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan ON tbl_saksilog.kecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_saksilog.kota = tbl_kota.id
                 WHERE
                 tbl_saksilog.idadmin = '$IdAdmin'
                 ORDER BY
                 tbl_saksilog.namalengkap ASC;"
            );*/
            #IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
            #IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
            #IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,

            # query mysql patch 1
            $result = $this->db->query(
                "SELECT
                 tbl_saksilog.id AS `Saksi_IdSaksi`,
                 tbl_saksilog.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksilog.nik AS `Saksi_NoKTP`,
                 tbl_saksilog.alamatlengkap AS `Saksi_AlamatLengkap`,
                 tbl_saksilog.kelurahan AS `Saksi_Kelurahan`,
                 tbl_saksilog.kecamatan AS `Saksi_Kecamatan`,
                 tbl_saksilog.kota AS `Saksi_Kota`,
                 tbl_saksilog.tps AS `Saksi_TPS`,
                 tbl_saksilog.nohp AS `Saksi_NoHP`,
                 tbl_saksilog.rekomendasi AS `Saksi_Rekomendasi`
                 FROM
                 tbl_saksilog
                 WHERE
                 tbl_saksilog.idadmin = '$IdAdmin'
                 ORDER BY
                 tbl_saksilog.namalengkap ASC;"
            );

            # query postgresql
            /*$result = $this->db->query(
                'SELECT
                 tbl_saksilog.id AS "Saksi_IdSaksi",
                 tbl_saksilog.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksilog.nik AS "Saksi_NoKTP",
                 tbl_saksilog.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksilog.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksilog.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksilog.kota AS "Saksi_Kota",
                 tbl_saksilog.tps AS "Saksi_TPS",
                 tbl_saksilog.nohp AS "Saksi_NoHP",
                 tbl_saksilog.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksilog
                 WHERE
                 tbl_saksilog.idadmin = \''.$IdAdmin.'\'
                 ORDER BY
                 tbl_saksilog.namalengkap ASC;'
            );*/

            $xlog = $result->num_rows();

            $aData = array();

            if ($xlog > 0)
            {
                foreach ($result->result() as $data)
                {
                    $xnik = $data->Saksi_NoKTP;
                    $xnamalengkap = $data->Saksi_NamaLengkap;
                    
                    # query mysql patch 2
                    /* $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                         tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                         tbl_saksitmp.kota AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         LEFT JOIN
                         tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                         LEFT JOIN
                         tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                         LEFT JOIN
                         tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    ); */
                    #IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                    #IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                    #IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,

                    # query mysql patch 1
                    $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                         tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                         tbl_saksitmp.kota AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    );

                    # query postgresql
                    /*$resultB = $this->db->query(
                        'SELECT
                         tbl_saksitmp.id AS "Saksi_IdSaksi",
                         tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                         tbl_saksitmp.nik AS "Saksi_NoKTP",
                         tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                         tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                         tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                         tbl_saksitmp.kota AS "Saksi_Kota",
                         tbl_saksitmp.tps AS "Saksi_TPS",
                         tbl_saksitmp.nohp AS "Saksi_NoHP",
                         tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = \''.$xnik.'\' AND
                         tbl_saksitmp.namalengkap = \''.$xnamalengkap.'\';'
                    );*/

                    $xtmp = $resultB->num_rows();

                    if ($xtmp == 1)
                    {
                        foreach ($resultB->result() as $dataB)
                        {
                            #if ($this->hasNumber($data->Saksi_Kelurahan) || $this->hasNumber($data->Saksi_Kecamatan) || $this->hasNumber($data->Saksi_Kota) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP))
                            #{
                                # data error
                                #echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) == 16 && $this->hasNumber($data->Saksi_NoKTP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td>'.'Data berubah'.'</td>';
                                #echo '</tr>';
                            #}
                            
                            if ($this->hasNumber($data->Saksi_NoKTP) && $this->hasLetter($data->Saksi_Kelurahan) && $this->hasLetter($data->Saksi_Kecamatan) && $this->hasLetter($data->Saksi_Kota) && $this->hasNumber($data->Saksi_TPS) && $this->hasNumber($data->Saksi_NoHP))
                            #if ($this->hasNumber($data->Saksi_NoKTP) && $this->hasNumber($data->Saksi_Kelurahan) && $this->hasNumber($data->Saksi_Kecamatan) && $this->hasNumber($data->Saksi_Kota) && $this->hasNumber($data->Saksi_TPS) && $this->hasNumber($data->Saksi_NoHP))
                            {
                                #$xbgcolor;
                                if ( ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap) &&
                                     ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP) &&
                                     ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap) &&
                                     ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan) &&
                                     ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan) &&
                                     ($dataB->Saksi_Kota == $data->Saksi_Kota) &&
                                     ($dataB->Saksi_TPS == $data->Saksi_TPS) &&
                                     ($dataB->Saksi_NoHP == $data->Saksi_NoHP) &&
                                     ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi)
                                ) {
                                    #$xbgcolor = "#FFFFFF";
                                }
                                else
                                {
                                    #$xbgcolor = "#FFC107";

                                    $aData[] = array(
                                        'namalengkap' => $data->Saksi_NamaLengkap,
                                        'nik' => $data->Saksi_NoKTP,
                                        'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                        'kelurahan' => $data->Saksi_Kelurahan,
                                        'kecamatan' => $data->Saksi_Kecamatan,
                                        'kota' => $data->Saksi_Kota,
                                        'tps' => $data->Saksi_TPS,
                                        'nohp' => $data->Saksi_NoHP,
                                        'rekomendasi' => $data->Saksi_Rekomendasi,
                                        #'ulog' => (strlen($data->Saksi_NamaLengkap) >= 3 ? substr($data->Saksi_NamaLengkap, 0, 3).$this->randomNumber(5) : $data->Saksi_NamaLengkap.$this->randomNumber(6)),
                                        'ulog' => (strlen($data->Saksi_NamaLengkap) >= 3 ? strtolower(substr($data->Saksi_NamaLengkap, 0, 3)).$this->randomNumber(4) : strtolower($data->Saksi_NamaLengkap).$this->randomNumber(5)),
                                        'plog' => $this->randomNumber(6), #$this->randomString(6),
                                    );
                                    #base64_encode(base64_encode(base64_encode())),
                                }

                                # decode -> data baru dan data update (if available)
                                #echo '<tr style="background-color: '.$xbgcolor.'; border-collapse: collapse; spacing: 1; color: #000000;">';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td>'.'Data berubah'.'</td>';
                                #echo '</tr>';
                            }

                            #$aData[] = array(
                                #'namalengkap' => $data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' (data berubah)'),
                                #'nik' => $data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' (data berubah)'),
                                #'alamatlengkap' => $data->Saksi_AlamatLengkap . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' (data berubah)'),
                                #'kelurahan' => $data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' (data berubah)'),
                                #'kecamatan' => $data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' (data berubah)'),
                                #'kota' => $data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' (data berubah)'),
                                #'tps' => $data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                #'nohp' => $data->Saksi_NoHP . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                #'rekomendasi' => $data->Saksi_Rekomendasi . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' (data berubah)'),
                                #'status' => 'Data berubah'
                            #);
                        }
                    }
                    else
                    {
                        #if ($this->hasNumber($data->Saksi_Kelurahan) || $this->hasNumber($data->Saksi_Kecamatan) || $this->hasNumber($data->Saksi_Kota) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP))
                        #{
                            # data error
                            #echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) == 16 && $this->hasNumber($data->Saksi_NoKTP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>'; # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>'; # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # .'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td>'.'Data berubah'.'</td>';
                            #echo '</tr>';
                        #}
                        
                        #if ($this->hasNumber($data->Saksi_NoKTP) && $this->hasNumber($data->Saksi_Kelurahan) && $this->hasNumber($data->Saksi_Kecamatan) && $this->hasNumber($data->Saksi_Kota) && $this->hasNumber($data->Saksi_TPS) && $this->hasNumber($data->Saksi_NoHP))
                        if ($this->hasNumber($data->Saksi_NoKTP) && $this->hasLetter($data->Saksi_Kelurahan) && $this->hasLetter($data->Saksi_Kecamatan) && $this->hasLetter($data->Saksi_Kota) && $this->hasNumber($data->Saksi_TPS) && $this->hasNumber($data->Saksi_NoHP) &&
                            (substr($data->Saksi_NoKTP, 0, 2) == "11" || substr($data->Saksi_NoKTP, 0, 2) == "12" || substr($data->Saksi_NoKTP, 0, 2) == "13" || substr($data->Saksi_NoKTP, 0, 2) == "14" || substr($data->Saksi_NoKTP, 0, 2) == "15" || substr($data->Saksi_NoKTP, 0, 2) == "16" || substr($data->Saksi_NoKTP, 0, 2) == "17" || substr($data->Saksi_NoKTP, 0, 2) == "18" || substr($data->Saksi_NoKTP, 0, 2) == "19" || substr($data->Saksi_NoKTP, 0, 2) == "21" ||
                             substr($data->Saksi_NoKTP, 0, 2) == "31" || substr($data->Saksi_NoKTP, 0, 2) == "32" || substr($data->Saksi_NoKTP, 0, 2) == "33" || substr($data->Saksi_NoKTP, 0, 2) == "34" || substr($data->Saksi_NoKTP, 0, 2) == "35" || substr($data->Saksi_NoKTP, 0, 2) == "36" ||
                             substr($data->Saksi_NoKTP, 0, 2) == "51" || substr($data->Saksi_NoKTP, 0, 2) == "52" || substr($data->Saksi_NoKTP, 0, 2) == "53" ||
                             substr($data->Saksi_NoKTP, 0, 2) == "61" || substr($data->Saksi_NoKTP, 0, 2) == "62" || substr($data->Saksi_NoKTP, 0, 2) == "63" || substr($data->Saksi_NoKTP, 0, 2) == "64" || substr($data->Saksi_NoKTP, 0, 2) == "65" ||
                             substr($data->Saksi_NoKTP, 0, 2) == "71" || substr($data->Saksi_NoKTP, 0, 2) == "72" || substr($data->Saksi_NoKTP, 0, 2) == "73" || substr($data->Saksi_NoKTP, 0, 2) == "74" || substr($data->Saksi_NoKTP, 0, 2) == "75" || substr($data->Saksi_NoKTP, 0, 2) == "76" ||
                             substr($data->Saksi_NoKTP, 0, 2) == "81" || substr($data->Saksi_NoKTP, 0, 2) == "82" ||
                             substr($data->Saksi_NoKTP, 0, 2) == "91" || substr($data->Saksi_NoKTP, 0, 2) == "91"
                            )
                        ) {
                            $aData[] = array(
                                'namalengkap' => $data->Saksi_NamaLengkap,
                                'nik' => $data->Saksi_NoKTP,
                                'alamatlengkap' => $data->Saksi_AlamatLengkap,
                                'kelurahan' => $data->Saksi_Kelurahan,
                                'kecamatan' => $data->Saksi_Kecamatan,
                                'kota' => $data->Saksi_Kota,
                                'tps' => $data->Saksi_TPS,
                                'nohp' => $data->Saksi_NoHP,
                                'rekomendasi' => $data->Saksi_Rekomendasi,
                                #'ulog' => (strlen($data->Saksi_NamaLengkap) >= 3 ? substr($data->Saksi_NamaLengkap, 0, 3).$this->randomNumber(5) : $data->Saksi_NamaLengkap.$this->randomNumber(6)),
                                'ulog' => (strlen($data->Saksi_NamaLengkap) >= 3 ? strtolower(substr($data->Saksi_NamaLengkap, 0, 3)).$this->randomNumber(4) : strtolower($data->Saksi_NamaLengkap).$this->randomNumber(5)),
                                'plog' => $this->randomNumber(6), #$this->randomString(6),
                            );
                            #base64_encode(base64_encode(base64_encode())),

                            # data baru
                            #echo '<tr style="background-color: #43A047; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                #echo '<td>'.'Data baru'.'</td>';
                            #echo '</tr>';
                        }

                        #$aData[] = array(
                            #'namalengkap' => $data->Saksi_NamaLengkap,
                            #'nik' => $data->Saksi_NoKTP,
                            #'alamatlengkap' => $data->Saksi_AlamatLengkap,
                            #'kelurahan' => $data->Saksi_Kelurahan,
                            #'kecamatan' => $data->Saksi_Kecamatan,
                            #'kota' => $data->Saksi_Kota,
                            #'tps' => $data->Saksi_TPS,
                            #'nohp' => $data->Saksi_NoHP,
                            #'rekomendasi' => $data->Saksi_Rekomendasi,
                            #'status' => 'Data baru'
                        #);
                    }
                }
            }

            $result = $aData;
            return $result;
        }

        function UploadExcelSaksiTmp5 ($dataSaksi)
        {
            $IdAdmin = (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"]);

            $countDataSaksi = count($dataSaksi);

            if ($dataSaksi == NULL || $countDataSaksi == 0)
            {
                echo "0";

                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Cek kembali data saksi pada file excel anda."
                );
                return $result;
            }
            else
            {
                /*$this->PreparedIntegrateSaksiToExistingDb(
                    $x_nik, $x_namalengkap, $x_alamatlengkap, $x_kelurahan, $x_kecamatan, $x_kota, $x_nohp,

                    $x_kode, $x_path, $x_pathcetak, $x_jeniskelamin, $x_tempatlahir, $x_tanggallahir, $x_rtrw, $x_kodepos,

                    $x_provinsi,

                    $x_agama, $x_statuspernikahan, $x_pekerjaan, $x_kewarganegaraan, $x_email, $x_facebook, $x_twitter, $x_notelepon, $x_posisi, $x_katasandi, $x_ipaddress, $x_domisili,

                    $x_lokasikode, $x_lokasiprovinsi, $x_lokasikota, $x_lokasikecamatan, $x_lokasikelurahan,

                    $x_file_foto, $x_file_nik, $x_file_cv
                );*/

                /*echo "<pre>";
                    echo "["."<br/>";
                    for ($i = 0; $i < $countDataSaksi; $i++)
                    {
                        if (($i+1) < $countDataSaksi)
                        {
                            echo "&#09;"."{"."<br/>";
                                echo "&#09;&#09;"."id"." : ".$i."<br/>";
                                echo "&#09;&#09;"."namalengkap"." : ".$dataSaksi[$i]['namalengkap']."<br/>";
                                echo "&#09;&#09;"."nik"." : ".$dataSaksi[$i]['nik']."<br/>";
                                echo "&#09;&#09;"."alamatlengkap"." : ".$dataSaksi[$i]['alamatlengkap']."<br/>";
                                echo "&#09;&#09;"."kelurahan"." : ".$dataSaksi[$i]['kelurahan']."<br/>";
                                echo "&#09;&#09;"."kecamatan"." : ".$dataSaksi[$i]['kecamatan']."<br/>";
                                echo "&#09;&#09;"."kota"." : ".$dataSaksi[$i]['kota']."<br/>";
                                echo "&#09;&#09;"."tps"." : ".$dataSaksi[$i]['tps']."<br/>";
                                echo "&#09;&#09;"."nohp"." : ".$dataSaksi[$i]['nohp']."<br/>";
                                echo "&#09;&#09;"."rekomendasi"." : ".$dataSaksi[$i]['rekomendasi']."<br/>";
                                echo "&#09;&#09;"."ulog"." : ".$dataSaksi[$i]['ulog']."<br/>";
                                echo "&#09;&#09;"."plog"." : ".$dataSaksi[$i]['plog']."<br/>";
                            echo "&#09;"."}".","."<br/>";
                        }
                        else
                        {
                            echo "&#09;"."{"."<br/>";
                                echo "&#09;&#09;"."id"." : ".$i."<br/>";
                                echo "&#09;&#09;"."namalengkap"." : ".$dataSaksi[$i]['namalengkap']."<br/>";
                                echo "&#09;&#09;"."nik"." : ".$dataSaksi[$i]['nik']."<br/>";
                                echo "&#09;&#09;"."alamatlengkap"." : ".$dataSaksi[$i]['alamatlengkap']."<br/>";
                                echo "&#09;&#09;"."kelurahan"." : ".$dataSaksi[$i]['kelurahan']."<br/>";
                                echo "&#09;&#09;"."kecamatan"." : ".$dataSaksi[$i]['kecamatan']."<br/>";
                                echo "&#09;&#09;"."kota"." : ".$dataSaksi[$i]['kota']."<br/>";
                                echo "&#09;&#09;"."tps"." : ".$dataSaksi[$i]['tps']."<br/>";
                                echo "&#09;&#09;"."nohp"." : ".$dataSaksi[$i]['nohp']."<br/>";
                                echo "&#09;&#09;"."rekomendasi"." : ".$dataSaksi[$i]['rekomendasi']."<br/>";
                                echo "&#09;&#09;"."ulog"." : ".$dataSaksi[$i]['ulog']."<br/>";
                                echo "&#09;&#09;"."plog"." : ".$dataSaksi[$i]['plog']."<br/>";
                            echo "&#09;"."}".""."<br/>";
                        }
                    }
                    echo "]";
                echo "</pre>";
                die();*/

                # query mysql
                $result = $this->db->query(
                    "DELETE FROM tbl_saksilog WHERE idadmin = '$IdAdmin';"
                );

                # query postgresql
                /*$result = $this->db->query(
                    'DELETE FROM tbl_saksilog WHERE idadmin = \''.$IdAdmin.'\';'
                );*/

                if ($result)
                {
                    for ($i = 0; $i < $countDataSaksi; $i++)
                    {
                        # check nik, if equals then update, either insert new item into db
                        # query mysql
                        $result = $this->db->query(
                            "SELECT
                             tbl_saksitmp.id AS `Saksi_IdSaksi`,
                             tbl_saksitmp.nik AS `Saksi_NoKTP`,
                             tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                             tbl_saksitmp.ulog AS `Saksi_Ulog`,
                             tbl_saksitmp.plog AS `Saksi_Plog`
                             FROM
                             tbl_saksitmp
                             WHERE
                             tbl_saksitmp.nik = '".$dataSaksi[$i]['nik']."';"
                        );

                        # query postgresql
                        /*$result = $this->db->query(
                            'SELECT
                             tbl_saksitmp.id AS "Saksi_IdSaksi",
                             tbl_saksitmp.nik AS "Saksi_NoKTP",
                             tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                             tbl_saksitmp.ulog AS "Saksi_Ulog",
                             tbl_saksitmp.plog AS "Saksi_Plog"
                             FROM
                             tbl_saksitmp
                             WHERE
                             tbl_saksitmp.nik = \''.$dataSaksi[$i]['nik'].'\';'
                        );*/

                        $xcnik = $result->num_rows();

                        if ($xcnik == 1)
                        {
                            foreach ($result->result() as $data)
                            {
                                if ($data->Saksi_Ulog == NULL && $data->Saksi_Plog == NULL)
                                {
                                    # update data existing if ulog and plog empty
                                    $plog = base64_encode(base64_encode(base64_encode($dataSaksi[$i]['plog'])));
                                    $this->db->query(
                                        "UPDATE
                                         tbl_saksitmp
                                         SET
                                         namalengkap = '".$dataSaksi[$i]['namalengkap']."',
                                         alamatlengkap = '".$dataSaksi[$i]['alamatlengkap']."',
                                         kelurahan = '".$dataSaksi[$i]['kelurahan']."',
                                         kecamatan = '".$dataSaksi[$i]['kecamatan']."',
                                         kota = '".$dataSaksi[$i]['kota']."',
                                         tps = '".$dataSaksi[$i]['tps']."',
                                         nohp = '".$dataSaksi[$i]['nohp']."',
                                         rekomendasi = '".$dataSaksi[$i]['rekomendasi']."',
                                         ulog = '".$dataSaksi[$i]['ulog']."',
                                         plog = '$plog'
                                         WHERE
                                         id = '".$data->Saksi_IdSaksi."';"
                                    );

                                    # query postgresql
                                    /*$this->db->query(
                                        'UPDATE
                                         public.tbl_saksitmp
                                         SET
                                         namalengkap = \''.$dataSaksi[$i]['namalengkap'].'\',
                                         alamatlengkap = \''.$dataSaksi[$i]['alamatlengkap'].'\',
                                         kelurahan = \''.$dataSaksi[$i]['kelurahan'].'\',
                                         kecamatan = \''.$dataSaksi[$i]['kecamatan'].'\',
                                         kota = \''.$dataSaksi[$i]['kota'].'\',
                                         tps = \''.$dataSaksi[$i]['tps'].'\',
                                         nohp = \''.$dataSaksi[$i]['nohp'].'\',
                                         rekomendasi = \''.$dataSaksi[$i]['rekomendasi'].'\',
                                         ulog = \''.$dataSaksi[$i]['ulog'].'\',
                                         plog = \''.$plog.'\'
                                         WHERE
                                         id = \''.$data->Saksi_IdSaksi.'\';'
                                    );*/
                                }
                                else
                                {
                                    # update data existing without ulog and plog
                                    $this->db->query(
                                        "UPDATE
                                         tbl_saksitmp
                                         SET
                                         namalengkap = '".$dataSaksi[$i]['namalengkap']."',
                                         alamatlengkap = '".$dataSaksi[$i]['alamatlengkap']."',
                                         kelurahan = '".$dataSaksi[$i]['kelurahan']."',
                                         kecamatan = '".$dataSaksi[$i]['kecamatan']."',
                                         kota = '".$dataSaksi[$i]['kota']."',
                                         tps = '".$dataSaksi[$i]['tps']."',
                                         nohp = '".$dataSaksi[$i]['nohp']."',
                                         rekomendasi = '".$dataSaksi[$i]['rekomendasi']."'
                                         WHERE
                                         id = '".$data->Saksi_IdSaksi."';"
                                    );

                                    # query postgresql
                                    /*$this->db->query(
                                        'UPDATE
                                         public.tbl_saksitmp
                                         SET
                                         namalengkap = \''.$dataSaksi[$i]['namalengkap'].'\',
                                         alamatlengkap = \''.$dataSaksi[$i]['alamatlengkap'].'\',
                                         kelurahan = \''.$dataSaksi[$i]['kelurahan'].'\',
                                         kecamatan = \''.$dataSaksi[$i]['kecamatan'].'\',
                                         kota = \''.$dataSaksi[$i]['kota'].'\',
                                         tps = \''.$dataSaksi[$i]['tps'].'\',
                                         nohp = \''.$dataSaksi[$i]['nohp'].'\',
                                         rekomendasi = \''.$dataSaksi[$i]['rekomendasi'].'\'
                                         WHERE
                                         id = \''.$data->Saksi_IdSaksi.'\';'
                                    );*/
                                }
                                # nik = \''.$dataSaksi[$i]['nik'].'\'
                            }
                        }
                        else
                        {
                            # insert new data into db
                            $plog = base64_encode(base64_encode(base64_encode($dataSaksi[$i]['plog'])));
                            $phash = password_hash($dataSaksi[$i]['plog'], PASSWORD_DEFAULT);
                            $this->db->query(
                                "INSERT INTO
                                 tbl_saksitmp
                                 (
                                     namalengkap, nik,
                                     alamatlengkap, kelurahan, kecamatan, kota,
                                     tps, nohp, rekomendasi,
                                     ulog, plog
                                 )
                                 VALUES
                                 (
                                     '".$dataSaksi[$i]['namalengkap']."', '".$dataSaksi[$i]['nik']."',
                                     '".$dataSaksi[$i]['alamatlengkap']."', '".$dataSaksi[$i]['kelurahan']."', '".$dataSaksi[$i]['kecamatan']."', '".$dataSaksi[$i]['kota']."',
                                     '".$dataSaksi[$i]['tps']."', '".$dataSaksi[$i]['nohp']."', '".$dataSaksi[$i]['rekomendasi']."',
                                     '".$dataSaksi[$i]['ulog']."', '$plog'
                                 );"
                            );

                            # create saksi login at tbl_ulogin
                            #$phash = password_hash($dataSaksi[$i]['plog'], PASSWORD_DEFAULT);
                            $this->db->query(
                                "INSERT INTO
                                 tbl_ulogin
                                 (
                                    iduloginlevel, ulog, plog,
                                    plog2, plog2ori,
                                    unamalengkap, kontak
                                 )
                                 VALUES
                                 (
                                    '3', '".$dataSaksi[$i]['ulog']."', '$plog',
                                    '$phash', '".$dataSaksi[$i]['plog']."',
                                    '".$dataSaksi[$i]['namalengkap']."', '".$dataSaksi[$i]['nohp']."'
                                 );"
                            );

                            # query postgresql
                            /*$this->db->query(
                                'INSERT INTO
                                 tbl_saksitmp
                                 (
                                     namalengkap, nik,
                                     alamatlengkap, kelurahan, kecamatan, kota,
                                     tps, nohp, rekomendasi,
                                     ulog, plog
                                 )
                                 VALUES
                                 (
                                     \''.$dataSaksi[$i]['namalengkap'].'\', \''.$dataSaksi[$i]['nik'].'\',
                                     \''.$dataSaksi[$i]['alamatlengkap'].'\', \''.$dataSaksi[$i]['kelurahan'].'\', \''.$dataSaksi[$i]['kecamatan'].'\', \''.$dataSaksi[$i]['kota'].'\',
                                     \''.$dataSaksi[$i]['tps'].'\', \''.$dataSaksi[$i]['nohp'].'\', \''.$dataSaksi[$i]['rekomendasi'].'\',
                                     \''.$dataSaksi[$i]['ulog'].'\', \''.$plog.'\'
                                 );'
                            );*/

                            # fill completely empty ulog and plog, means CI will generate ulog and plog when fields were empty
                            $result = $this->db->query(
                                "SELECT
                                 tbl_saksitmp.id AS `Saksi_IdSaksi`,
                                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`
                                 FROM
                                 tbl_saksitmp
                                 WHERE
                                 (tbl_saksitmp.ulog = '' OR tbl_saksitmp.ulog IS NULL) OR
                                 (tbl_saksitmp.plog = '' OR tbl_saksitmp.plog IS NULL);"
                            );

                            # query postgresql
                            /*$result = $this->db->query(
                                'SELECT
                                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap"
                                 FROM
                                 tbl_saksitmp
                                 WHERE
                                 (tbl_saksitmp.ulog = \'\' OR tbl_saksitmp.ulog IS NULL) OR
                                 (tbl_saksitmp.plog = \'\' OR tbl_saksitmp.plog IS NULL);'
                            );*/

                            $xcsaksitmp = $result->num_rows();

                            if ($xcsaksitmp > 0)
                            {
                                foreach ($result->result() as $data)
                                {
                                    #$ulog = (strlen($data->Saksi_NamaLengkap) >= 3 ? substr($data->Saksi_NamaLengkap, 0, 3).$this->randomNumber(5) : $data->Saksi_NamaLengkap.$this->randomNumber(6));
                                    $ulog = (strlen($data->Saksi_NamaLengkap) >= 3 ? strtolower(substr($data->Saksi_NamaLengkap, 0, 3)).$this->randomNumber(4) : strtolower($data->Saksi_NamaLengkap).$this->randomNumber(5));
                                    $plog2 = base64_encode(base64_encode(base64_encode($this->randomNumber(6)))); #base64_encode(base64_encode(base64_encode($this->randomString(6))));

                                    $this->db->query(
                                        "UPDATE
                                         tbl_saksitmp
                                         SET
                                         ulog = '$ulog',
                                         plog = '$plog2'
                                         WHERE
                                         id = '".$data->Saksi_IdSaksi."';"
                                    );

                                    # query postgresql
                                    /*$this->db->query(
                                        'UPDATE
                                         public.tbl_saksitmp
                                         SET
                                         ulog = \''.$ulog.'\',
                                         plog = \''.$plog2.'\'
                                         WHERE
                                         id = \''.$data->Saksi_IdSaksi.'\';'
                                    );*/
                                }
                            }
                        }
                    }

                    # integrate new anggota to existing db
                    # $this->PreparedIntegrateSaksiToExistingDb($dataSaksi);
                    /*$Query;
                    if ($countDataSaksi == 1)
                    {
                        #$xDataWilayah = $this->m_wilayah->GenerateDataWilayah2(
                            #$dataSaksi[0]["kelurahan"],
                            #$dataSaksi[0]["kecamatan"],
                            #$dataSaksi[0]["kota"]
                        #);

                        $x_nik = $dataSaksi[0]["nik"];
                        $x_namalengkap = $dataSaksi[0]["namalengkap"];
                        $x_alamatlengkap = $dataSaksi[0]["alamatlengkap"];
                        $x_kelurahan = $dataSaksi[0]["kelurahan"]; #$xDataWilayah["Kelurahan"];
                        $x_kecamatan = $dataSaksi[0]["kecamatan"]; #$xDataWilayah["Kecamatan"];
                        $x_kota = $dataSaksi[0]["kota"]; #$xDataWilayah["Kota"];
                        $x_nohp = $dataSaksi[0]["nohp"];

                        $x_kode = "0";
                        $x_path = "";
                        $x_pathcetak = "";
                        $x_jeniskelamin = "";
                        $x_tempatlahir = "";
                        $x_tanggallahir = "";
                        $x_rtrw = "";
                        $x_kodepos = "";

                        $x_provinsi = ""; #$xDataWilayah["Provinsi"];

                        $x_agama = "";
                        $x_statuspernikahan = "";
                        $x_pekerjaan = "";
                        $x_kewarganegaraan = "WNI";
                        $x_email = "";
                        $x_facebook = "";
                        $x_twitter = "";
                        $x_notelepon = "";
                        $x_posisi = "";
                        $x_katasandi = "";
                        $x_ipaddress = "";
                        $x_domisili = "";

                        $x_lokasikode = "";
                        $x_lokasiprovinsi = "0"; #$xDataWilayah["IdProvinsi"];
                        $x_lokasikota = "0"; #$xDataWilayah["IdKota"];
                        $x_lokasikecamatan = "0"; #$xDataWilayah["IdKecamatan"];
                        $x_lokasikelurahan = "0"; #$xDataWilayah["IdKelurahan"];

                        $x_file_foto = "";
                        $x_file_nik = "";
                        $x_file_cv = "";

                        # generate nokta
                        $x_nokta = substr($dataSaksi[0]["nik"], 0, 6) . $this->randomNumber(10);

                        date_default_timezone_set("Asia/Jakarta");
                        $x_datetime_insert = date("Y-m-d H:i:s");
                        $x_datetime_update = date("Y-m-d H:i:s");

                        $Query =
                        "INSERT INTO
                         daftar_web_final
                         (
                            nik, nama,
                            Alamat, Kelurahan, Kecamatan, KotaKab,
                            Handphone, KTA,

                            DtInsert,
                            Kode, Path, PathCetak,
                            jenis_kelamin, tempat_lahir, tanggal_lahir,
                            RTRW, Kodepos, Provinsi,
                            Agama, Status, Pekerjaan, Kewarganegaraan,
                            Email, Facebook, Twitter, Telpon,
                            posisi, katasandi,
                            IpAddress, domisili,

                            lokasi_kode,
                            lokasi_propinsi,
                            lokasi_kabupatenkota,
                            lokasi_kecamatan,
                            lokasi_kelurahan,

                            file_foto, file_nik, file_cv,

                            dt_update
                         )
                         VALUES
                         (
                            '$x_nik', '$x_namalengkap',
                            '$x_alamatlengkap', '$x_kelurahan', '$x_kecamatan', '$x_kota',
                            '$x_nohp', '$x_nokta',

                            '$x_datetime_insert',
                            '$x_kode', '$x_path', '$x_pathcetak',
                            '$x_jeniskelamin', '$x_tempatlahir', '$x_tanggallahir',
                            '$x_rtrw', '$x_kodepos', '$x_provinsi',
                            '$x_agama', '$x_statuspernikahan', '$x_pekerjaan', '$x_kewarganegaraan',
                            '$x_email', '$x_facebook', '$x_twitter', '$x_notelepon',
                            '$x_posisi', '$x_katasandi',
                            '$x_ipaddress', '$x_domisili',

                            '$x_lokasikode',
                            '$x_lokasiprovinsi',
                            '$x_lokasikota',
                            '$x_lokasikecamatan',
                            '$x_lokasikelurahan',

                            '$x_file_foto', '$x_file_nik', '$x_file_cv',

                            '$x_datetime_update'
                         );";

                        $this->PreparedIntegrateSaksiToExistingDb($Query);
                    }
                    else
                    {
                        date_default_timezone_set("Asia/Jakarta");
                        $x_datetime_insert = date("Y-m-d H:i:s");
                        $x_datetime_update = date("Y-m-d H:i:s");

                        $Query =
                        "INSERT INTO
                         daftar_web_final
                         (
                            nik, nama,
                            Alamat, Kelurahan, Kecamatan, KotaKab,
                            Handphone, KTA,

                            DtInsert,
                            Kode, Path, PathCetak,
                            jenis_kelamin, tempat_lahir, tanggal_lahir,
                            RTRW, Kodepos, Provinsi,
                            Agama, Status, Pekerjaan, Kewarganegaraan,
                            Email, Facebook, Twitter, Telpon,
                            posisi, katasandi,
                            IpAddress, domisili,

                            lokasi_kode,
                            lokasi_propinsi,
                            lokasi_kabupatenkota,
                            lokasi_kecamatan,
                            lokasi_kelurahan,

                            file_foto, file_nik, file_cv,

                            dt_update
                         )
                         VALUES";

                        $QueryValues = "";

                        for ($i = 0; $i < $countDataSaksi; $i++)
                        {
                            #$xDataWilayah = $this->m_wilayah->GenerateDataWilayah2(
                                #$dataSaksi[$i]["kelurahan"],
                                #$dataSaksi[$i]["kecamatan"],
                                #$dataSaksi[$i]["kota"]
                            #);

                            $x_nik = $dataSaksi[$i]["nik"];
                            $x_namalengkap = $dataSaksi[$i]["namalengkap"];
                            $x_alamatlengkap = $dataSaksi[$i]["alamatlengkap"];
                            $x_kelurahan = $dataSaksi[$i]["kelurahan"]; #$xDataWilayah["Kelurahan"];
                            $x_kecamatan = $dataSaksi[$i]["kecamatan"]; #$xDataWilayah["Kecamatan"];
                            $x_kota = $dataSaksi[$i]["kota"]; #$xDataWilayah["Kota"];
                            $x_nohp = $dataSaksi[$i]["nohp"];

                            $x_kode = "0";
                            $x_path = "";
                            $x_pathcetak = "";
                            $x_jeniskelamin = "";
                            $x_tempatlahir = "";
                            $x_tanggallahir = "";
                            $x_rtrw = "";
                            $x_kodepos = "";

                            $x_provinsi = ""; #$xDataWilayah["Provinsi"];

                            $x_agama = "";
                            $x_statuspernikahan = "";
                            $x_pekerjaan = "";
                            $x_kewarganegaraan = "WNI";
                            $x_email = "";
                            $x_facebook = "";
                            $x_twitter = "";
                            $x_notelepon = "";
                            $x_posisi = "";
                            $x_katasandi = "";
                            $x_ipaddress = "";
                            $x_domisili = "";

                            $x_lokasikode = "";
                            $x_lokasiprovinsi = "0"; #$xDataWilayah["IdProvinsi"];
                            $x_lokasikota = "0"; #$xDataWilayah["IdKota"];
                            $x_lokasikecamatan = "0"; #$xDataWilayah["IdKecamatan"];
                            $x_lokasikelurahan = "0"; #$xDataWilayah["IdKelurahan"];

                            $x_file_foto = "";
                            $x_file_nik = "";
                            $x_file_cv = "";

                            # generate nokta
                            $x_nokta = substr($dataSaksi[$i]["nik"], 0, 6) . $this->randomNumber(10);

                            $QueryValues = $QueryValues .
                            "(
                                '$x_nik', '$x_namalengkap',
                                '$x_alamatlengkap', '$x_kelurahan', '$x_kecamatan', '$x_kota',
                                '$x_nohp', '$x_nokta',

                                '$x_datetime_insert',
                                '$x_kode', '$x_path', '$x_pathcetak',
                                '$x_jeniskelamin', '$x_tempatlahir', '$x_tanggallahir',
                                '$x_rtrw', '$x_kodepos', '$x_provinsi',
                                '$x_agama', '$x_statuspernikahan', '$x_pekerjaan', '$x_kewarganegaraan',
                                '$x_email', '$x_facebook', '$x_twitter', '$x_notelepon',
                                '$x_posisi', '$x_katasandi',
                                '$x_ipaddress', '$x_domisili',

                                '$x_lokasikode',
                                '$x_lokasiprovinsi',
                                '$x_lokasikota',
                                '$x_lokasikecamatan',
                                '$x_lokasikelurahan',

                                '$x_file_foto', '$x_file_nik', '$x_file_cv',

                                '$x_datetime_update'
                             )" . ($i < ($countDataSaksi-1) ? "," : ";");

                             #echo "Index : " . $i . "<br/>";
                        }

                        $QueryXS = $Query . $QueryValues;

                        #echo "Count : " . $countDataSaksi;
                        #echo "<br/><br/>";
                        #echo "Query :" . $QueryXS;
                        #die();

                        $this->PreparedIntegrateSaksiToExistingDb($QueryXS);
                    }*/

                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Submit data saksi berhasil."
                    );
                    return $result;

                    # break

                    /*$result = $this->db->insert_batch('tbl_saksitmp',$dataSaksi);

                    if ($result)
                    {
                        $result = array(
                            "Response_ID" => "1",
                            "Response_Message" => "Submit data saksi berhasil."
                        );
                        return $result;
                    }
                    else
                    {
                        $result = array(
                            "Response_ID" => "0",
                            "Response_Message" => "Terjadi kesalahan dalam proses submit."
                        );
                        return $result;
                    }*/
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Terjadi kesalahan dalam proses submit."
                    );
                    return $result;
                }
            }
        }

        function UploadExcelSaksiTmp6 ()
        {
            $IdAdmin = (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"]);

            $aData = array();

            $dcNoChange = 0;
            $dcNewValid = 0;
            $dcNewDuplicated = 0;
            $dcInvalid = 0;
            $dcUpdate = 0;

            # query mysql patch 3
            $result = $this->db->query(
                "SELECT
                 (
                    SELECT
                    x.id
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.namalengkap = l.namalengkap AND
                    x.nik = l.nik
                    ORDER BY x.id DESC
                    LIMIT 0, 1
                 ) AS `Saksi_IdSaksi`,

                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 l.kelurahan AS `Saksi_Kelurahan`,
                 l.kecamatan AS `Saksi_Kecamatan`,
                 l.kota AS `Saksi_Kota`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,

                 COUNT(l.nik)-1 AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = '$IdAdmin'
                 GROUP BY
                 l.namalengkap, l.nik, l.alamatlengkap,
                 l.kelurahan, l.kecamatan, l.kota,
                 l.tps, l.nohp, l.rekomendasi
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;"
            );

            # query mysql patch 2
            /*$result = $this->db->query(
                "SELECT
                 (
                    SELECT
                    x.id
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.namalengkap = l.namalengkap AND
                    x.nik = l.nik
                    ORDER BY x.id DESC
                    LIMIT 0, 1
                 ) AS `Saksi_IdSaksi`,

                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 IF(kelurahan.kelurahan = NULL, '', kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                 IF(kecamatan.kecamatan = NULL, '', kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Saksi_Kota`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,

                 COUNT(l.nik)-1 AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 LEFT JOIN
                 tbl_kelurahan AS kelurahan ON l.kelurahan = kelurahan.id
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON l.kecamatan = kecamatan.id
                 LEFT JOIN
                 tbl_kota AS kota ON l.kota = kota.id
                 WHERE
                 l.idadmin = '$IdAdmin'
                 GROUP BY
                 l.namalengkap, l.nik, l.alamatlengkap,
                 kelurahan.kelurahan, kecamatan.kecamatan, kota.kota,
                 l.tps, l.nohp, l.rekomendasi
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;"
            );*/

            # query mysql patch 1
            /*$result = $this->db->query(
                "SELECT
                 l.id AS `Saksi_IdSaksi`,
                 l.namalengkap AS `Saksi_NamaLengkap`,
                 l.nik AS `Saksi_NoKTP`,
                 l.alamatlengkap AS `Saksi_AlamatLengkap`,
                 l.kelurahan AS `Saksi_Kelurahan`,
                 l.kecamatan AS `Saksi_Kecamatan`,
                 l.kota AS `Saksi_Kota`,
                 l.tps AS `Saksi_TPS`,
                 l.nohp AS `Saksi_NoHP`,
                 l.rekomendasi AS `Saksi_Rekomendasi`,
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS `Saksi_CountDuplicated`
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = '$IdAdmin'
                 GROUP BY
                 l.namalengkap, l.nik
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;"
            );*/

            # query postgresql
            /*$result = $this->db->query(
                'SELECT DISTINCT ON (l.namalengkap, l.nik)
                 l.id AS "Saksi_IdSaksi",
                 l.namalengkap AS "Saksi_NamaLengkap",
                 l.nik AS "Saksi_NoKTP",
                 l.alamatlengkap AS "Saksi_AlamatLengkap",
                 l.kelurahan AS "Saksi_Kelurahan",
                 l.kecamatan AS "Saksi_Kecamatan",
                 l.kota AS "Saksi_Kota",
                 l.tps AS "Saksi_TPS",
                 l.nohp AS "Saksi_NoHP",
                 l.rekomendasi AS "Saksi_Rekomendasi",
                 (
                    SELECT
                    COUNT(x.nik)-1
                    FROM
                    tbl_saksilog AS x
                    WHERE
                    x.idadmin = l.idadmin AND
                    x.nik = l.nik AND
                    x.namalengkap = l.namalengkap
                 ) AS "Saksi_CountDuplicated"
                 FROM
                 tbl_saksilog AS l
                 WHERE
                 l.idadmin = \''.$IdAdmin.'\'
                 ORDER BY
                 l.namalengkap ASC,
                 l.nik DESC;'
            );*/

            /*$result = $this->db->query(
                'SELECT
                 tbl_saksilog.id AS "Saksi_IdSaksi",
                 tbl_saksilog.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksilog.nik AS "Saksi_NoKTP",
                 tbl_saksilog.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksilog.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksilog.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksilog.kota AS "Saksi_Kota",
                 tbl_saksilog.tps AS "Saksi_TPS",
                 tbl_saksilog.nohp AS "Saksi_NoHP",
                 tbl_saksilog.rekomendasi AS "Saksi_Rekomendasi"
                 FROM
                 tbl_saksilog
                 WHERE
                 tbl_saksilog.idadmin = \''.$IdAdmin.'\'
                 ORDER BY
                 tbl_saksilog.namalengkap ASC;'
            );*/

            $xlog = $result->num_rows();

            if ($xlog > 0)
            {
                foreach ($result->result() as $data)
                {
                    $xnik = $data->Saksi_NoKTP;
                    $xnamalengkap = $data->Saksi_NamaLengkap;

                    # query mysql patch 2
                    $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                         tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                         tbl_saksitmp.kota AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    );
                    
                    # query mysql patch 1
                    /* $resultB = $this->db->query(
                        "SELECT
                         tbl_saksitmp.id AS `Saksi_IdSaksi`,
                         tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                         tbl_saksitmp.nik AS `Saksi_NoKTP`,
                         tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                         IF(tbl_kelurahan.kelurahan = NULL, '', tbl_kelurahan.kelurahan) AS `Saksi_Kelurahan`,
                         IF(tbl_kecamatan.kecamatan = NULL, '', tbl_kecamatan.kecamatan) AS `Saksi_Kecamatan`,
                         IF(tbl_kota.kota = NULL, '', tbl_kota.kota) AS `Saksi_Kota`,
                         tbl_saksitmp.tps AS `Saksi_TPS`,
                         tbl_saksitmp.nohp AS `Saksi_NoHP`,
                         tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`
                         FROM
                         tbl_saksitmp
                         LEFT JOIN
                         tbl_kelurahan ON tbl_saksitmp.kelurahan = tbl_kelurahan.id
                         LEFT JOIN
                         tbl_kecamatan ON tbl_saksitmp.kecamatan = tbl_kecamatan.id
                         LEFT JOIN
                         tbl_kota ON tbl_saksitmp.kota = tbl_kota.id
                         WHERE
                         tbl_saksitmp.nik = '$xnik' AND
                         tbl_saksitmp.namalengkap = '$xnamalengkap';"
                    ); */

                    # query postgresql
                    /*$resultB = $this->db->query(
                        'SELECT
                         tbl_saksitmp.id AS "Saksi_IdSaksi",
                         tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                         tbl_saksitmp.nik AS "Saksi_NoKTP",
                         tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                         tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                         tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                         tbl_saksitmp.kota AS "Saksi_Kota",
                         tbl_saksitmp.tps AS "Saksi_TPS",
                         tbl_saksitmp.nohp AS "Saksi_NoHP",
                         tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi"
                         FROM
                         tbl_saksitmp
                         WHERE
                         tbl_saksitmp.nik = \''.$xnik.'\' AND
                         tbl_saksitmp.namalengkap = \''.$xnamalengkap.'\';'
                    );*/

                    $xtmp = $resultB->num_rows();

                    if ($xtmp == 1)
                    {
                        #foreach ($resultB->result() as $dataB)
                        #{
                            #echo '<tr>';
                                #echo '<td>'.$dataB->Saksi_NamaLengkap.'</td>';
                                #echo '<td>'.$dataB->Saksi_NoKTP.'</td>';
                                #echo '<td>'.$dataB->Saksi_AlamatLengkap.'</td>';
                                #echo '<td>'.$dataB->Saksi_Kelurahan.'</td>';
                                #echo '<td>'.$dataB->Saksi_Kecamatan.'</td>';
                                #echo '<td>'.$dataB->Saksi_Kota.'</td>';
                                #echo '<td>'.$dataB->Saksi_TPS.'</td>';
                                #echo '<td>'.$dataB->Saksi_NoHP.'</td>';
                                #echo '<td>'.$dataB->Saksi_Rekomendasi.'</td>';
                                #echo '<td>'.'Data lama'.'</td>';
                            #echo '</tr>';

                            #$aData[] = array(
                                #'namalengkap' => $dataB->Saksi_NamaLengkap, # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' ( Update )'),
                                #'nik' => $dataB->Saksi_NoKTP, # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' ( Update )'),
                                #'alamatlengkap' => $dataB->Saksi_AlamatLengkap, # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' ( Update )'),
                                #'kelurahan' => $dataB->Saksi_Kelurahan, # . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' ( Update )'),
                                #'kecamatan' => $dataB->Saksi_Kecamatan, # . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' ( Update )'),
                                #'kota' => $dataB->Saksi_Kota, # . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' ( Update )'),
                                #'tps' => $dataB->Saksi_TPS, # . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' ( Update )'),
                                #'nohp' => $dataB->Saksi_NoHP, # . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : ' ( Update )'),
                                #'rekomendasi' => $dataB->Saksi_Rekomendasi, # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' ( Update )'),
                                #'status' => 'Data lama'
                            #);
                        #}

                        foreach ($resultB->result() as $dataB)
                        {
                            if ($this->hasNumber($data->Saksi_Kelurahan) || $this->hasNumber($data->Saksi_Kecamatan) || $this->hasNumber($data->Saksi_Kota) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP))
                            {
                                $dcInvalid = ($dcInvalid+1);

                                # data error
                                #echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) == 16 && $this->hasNumber($data->Saksi_NoKTP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td>'.'Data berubah'.'</td>';
                                #echo '</tr>';
                            }
                            else
                            {
                                $xbgcolor;
                                if ( ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap) &&
                                     ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP) &&
                                     ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap) &&
                                     ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan) &&
                                     ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan) &&
                                     ($dataB->Saksi_Kota == $data->Saksi_Kota) &&
                                     ($dataB->Saksi_TPS == $data->Saksi_TPS) &&
                                     ($dataB->Saksi_NoHP == $data->Saksi_NoHP) &&
                                     ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi)
                                ) {
                                    $dcNoChange = ($dcNoChange+1);
                                    #$xbgcolor = "#FFFFFF";
                                }
                                else
                                {
                                    $dcUpdate = ($dcUpdate+1);
                                    #$xbgcolor = "#FFC107";
                                }

                                # decode -> data baru dan data update (if available)
                                #echo '<tr style="background-color: '.$xbgcolor.'; border-collapse: collapse; spacing: 1; color: #000000;">';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($dataB->Saksi_NoHP == $data->Saksi_NoHP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                    #echo '<td>'.'Data berubah'.'</td>';
                                #echo '</tr>';
                            }

                            #$aData[] = array(
                                #'namalengkap' => $data->Saksi_NamaLengkap . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : ' (data berubah)'),
                                #'nik' => $data->Saksi_NoKTP . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : ' (data berubah)'),
                                #'alamatlengkap' => $data->Saksi_AlamatLengkap . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : ' (data berubah)'),
                                #'kelurahan' => $data->Saksi_Kelurahan . ($dataB->Saksi_Kelurahan == $data->Saksi_Kelurahan ? '' : ' (data berubah)'),
                                #'kecamatan' => $data->Saksi_Kecamatan . ($dataB->Saksi_Kecamatan == $data->Saksi_Kecamatan ? '' : ' (data berubah)'),
                                #'kota' => $data->Saksi_Kota . ($dataB->Saksi_Kota == $data->Saksi_Kota ? '' : ' (data berubah)'),
                                #'tps' => $data->Saksi_TPS . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                #'nohp' => $data->Saksi_NoHP . ($dataB->Saksi_TPS == $data->Saksi_TPS ? '' : ' (data berubah)'),
                                #'rekomendasi' => $data->Saksi_Rekomendasi . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : ' (data berubah)'),
                                #'status' => 'Data berubah'
                            #);
                        }
                    }
                    else
                    {
                        if ($this->hasLetter($data->Saksi_NoKTP) || $this->hasNumber($data->Saksi_Kelurahan) || $this->hasNumber($data->Saksi_Kecamatan) || $this->hasNumber($data->Saksi_Kota) || $this->hasLetter($data->Saksi_TPS) || $this->hasLetter($data->Saksi_NoHP) ||
                            (substr($data->Saksi_NoKTP, 0, 2) != "11" && substr($data->Saksi_NoKTP, 0, 2) != "12" && substr($data->Saksi_NoKTP, 0, 2) != "13" && substr($data->Saksi_NoKTP, 0, 2) != "14" && substr($data->Saksi_NoKTP, 0, 2) != "15" && substr($data->Saksi_NoKTP, 0, 2) != "16" && substr($data->Saksi_NoKTP, 0, 2) != "17" && substr($data->Saksi_NoKTP, 0, 2) != "18" && substr($data->Saksi_NoKTP, 0, 2) != "19" && substr($data->Saksi_NoKTP, 0, 2) != "21" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "31" && substr($data->Saksi_NoKTP, 0, 2) != "32" && substr($data->Saksi_NoKTP, 0, 2) != "33" && substr($data->Saksi_NoKTP, 0, 2) != "34" && substr($data->Saksi_NoKTP, 0, 2) != "35" && substr($data->Saksi_NoKTP, 0, 2) != "36" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "51" && substr($data->Saksi_NoKTP, 0, 2) != "52" && substr($data->Saksi_NoKTP, 0, 2) != "53" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "61" && substr($data->Saksi_NoKTP, 0, 2) != "62" && substr($data->Saksi_NoKTP, 0, 2) != "63" && substr($data->Saksi_NoKTP, 0, 2) != "64" && substr($data->Saksi_NoKTP, 0, 2) != "65" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "71" && substr($data->Saksi_NoKTP, 0, 2) != "72" && substr($data->Saksi_NoKTP, 0, 2) != "73" && substr($data->Saksi_NoKTP, 0, 2) != "74" && substr($data->Saksi_NoKTP, 0, 2) != "75" && substr($data->Saksi_NoKTP, 0, 2) != "76" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "81" && substr($data->Saksi_NoKTP, 0, 2) != "82" &&
                             substr($data->Saksi_NoKTP, 0, 2) != "91" && substr($data->Saksi_NoKTP, 0, 2) != "91"
                            )
                        ) {
                            $dcInvalid = ($dcInvalid+1);

                            # data error
                            #echo '<tr style="background-color: #F44336; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap . ($this->hasLetter($data->Saksi_NamaLengkap) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP . (strlen($data->Saksi_NoKTP) == 16 && $this->hasNumber($data->Saksi_NoKTP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>'; # . ($dataB->Saksi_NamaLengkap == $data->Saksi_NamaLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>'; # . ($dataB->Saksi_NoKTP == $data->Saksi_NoKTP ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>'; # .'</td>'; # . ($dataB->Saksi_AlamatLengkap == $data->Saksi_AlamatLengkap ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan . ($this->hasLetter($data->Saksi_Kelurahan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan . ($this->hasLetter($data->Saksi_Kecamatan) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota . ($this->hasLetter($data->Saksi_Kota) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_TPS . ($this->hasNumber($data->Saksi_TPS) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoHP . ($this->hasNumber($data->Saksi_NoHP) ? '' : '<br/><br/><strong><small>Invalid</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-times-circle-o"></i></span>').'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>'; # . ($dataB->Saksi_Rekomendasi == $data->Saksi_Rekomendasi ? '' : '<br/><br/><strong><small>Update</small></strong><span style="float:right; margin-top: -3px;"><i class="fa fa-check-circle-o"></i></span>').'</td>';
                                #echo '<td>'.'Data berubah'.'</td>';
                            #echo '</tr>';
                        }
                        else
                        {
                            if ($data->Saksi_CountDuplicated >= 1)
                            {
                                $dcNewDuplicated = ($dcNewDuplicated+1);
                            }
                            else
                            {
                                $dcNewValid = ($dcNewValid+1);
                            }

                            # data baru
                            #echo '<tr style="background-color: #43A047; border-collapse: collapse; spacing: 1; color: #FFFFFF;">';
                                #echo '<td style="border: 1;">'.$data->Saksi_NamaLengkap.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoKTP.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_AlamatLengkap.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kelurahan.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kecamatan.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Kota.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_TPS.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_NoHP.'</td>';
                                #echo '<td style="border: 1;">'.$data->Saksi_Rekomendasi.'</td>';
                                #echo '<td>'.'Data baru'.'</td>';
                            #echo '</tr>';
                        }

                        #$aData[] = array(
                            #'namalengkap' => $data->Saksi_NamaLengkap,
                            #'nik' => $data->Saksi_NoKTP,
                            #'alamatlengkap' => $data->Saksi_AlamatLengkap,
                            #'kelurahan' => $data->Saksi_Kelurahan,
                            #'kecamatan' => $data->Saksi_Kecamatan,
                            #'kota' => $data->Saksi_Kota,
                            #'tps' => $data->Saksi_TPS,
                            #'nohp' => $data->Saksi_NoHP,
                            #'rekomendasi' => $data->Saksi_Rekomendasi,
                            #'status' => 'Data baru'
                        #);
                    }
                }

                #$result = array(
                    #"Response_ID" => "2",
                    #"Response_Message" => "Decrypt excel success.",
                    #"Response_Array" => $aData
                #);
                #return $result;
            }
            
            #$dcNoChange = 0;
            #$dcNewValid = 0;
            #$dcNewDuplicated = 0;
            #$dcInvalid = 0;
            #$dcUpdate = 0;

            $result = array(
                "Response_ID" => "1",
                "Response_Message" => "",
                
                "Response_DataCountNoChange" => $dcNoChange,
                "Response_DataCountNewValid" => $dcNewValid,
                "Response_DataCountNewDuplicated" => $dcNewDuplicated,
                "Response_DataCountInvalid" => $dcInvalid,
                "Response_DataCountUpdate" => $dcUpdate
            );

            echo '<a href="#" class="btn btn-primary" style="margin-right: -5px;" onclick="ClickDialogSubmitSaksiPerindo(\'Proses data saksi sekarang?<br/><br/>Keterangan :<br/>1. Tidak ada perubahan '.$dcNoChange.' data<br/>2. Data baru '.$dcNewValid.' data<br/>3. Data duplicated '.$dcNewDuplicated.' data<br/>4. Data invalid '.$dcInvalid.' data<br/>5. Data update '.$dcUpdate.' data\')"><i class="fa fa-check-circle-o"></i><small>&nbsp;&nbsp;&nbsp;Submit</small></a>';

            return $result;
        }

        function UploadExcelSaksiTmp7 ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                 tbl_saksitmp.ulog AS "Saksi_Ulog",
                 tbl_saksitmp.plog AS "Saksi_Plog"
                 FROM
                 tbl_saksitmp
                 WHERE
                 (tbl_saksitmp.ulog = \'\' OR tbl_saksitmp.ulog = NULL) AND
                 (tbl_saksitmp.plog = \'\' OR tbl_saksitmp.plog = NULL)
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );
            #(COALESCE(tbl_saksitmp.ulog::varchar(50), \'\') == \'\') AND
            #(COALESCE(tbl_saksitmp.plog::varchar(50), \'\') == \'\')
            #(tbl_saksitmp.ulog == \'\' OR tbl_saksitmp.ulog == NULL) AND
            #(tbl_saksitmp.plog == \'\' OR tbl_saksitmp.plog == NULL)

            $xempty = $result->num_rows();

            $aData = array();

            if ($xempty > 0)
            {
                foreach ($result->result() as $data)
                {
                    #$ulog = (strlen($data->Saksi_NamaLengkap) >= 3 ? substr($data->Saksi_NamaLengkap, 0, 3).$this->randomNumber(5) : $data->Saksi_NamaLengkap.$this->randomNumber(6));
                    $ulog = (strlen($data->Saksi_NamaLengkap) >= 3 ? strtolower(substr($data->Saksi_NamaLengkap, 0, 3)).$this->randomNumber(4) : strtolower($data->Saksi_NamaLengkap).$this->randomNumber(5));
                    $plog = base64_encode(base64_encode(base64_encode($this->randomNumber(6)))); #base64_encode(base64_encode(base64_encode($this->randomString(6))));

                    $this->db->query(
                        'UPDATE
                         public.tbl_saksitmp
                         SET
                         ulog = \''.$ulog.'\',
                         plog = \''.$plog.'\'
                         WHERE
                         id = \''.$data->Saksi_IdSaksi.'\';'
                    );
                }

                # all data was ready
                # get all data saksi to prepare export into excel file
                $result = $this->db->query(
                    'SELECT
                     tbl_saksitmp.id AS "Saksi_IdSaksi",
                     tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                     tbl_saksitmp.nik AS "Saksi_NoKTP",
                     tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                     tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                     tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                     tbl_saksitmp.kota AS "Saksi_Kota",
                     tbl_saksitmp.tps AS "Saksi_TPS",
                     tbl_saksitmp.nohp AS "Saksi_NoHP",
                     tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                     tbl_saksitmp.ulog AS "Saksi_Ulog",
                     tbl_saksitmp.plog AS "Saksi_Plog"
                     FROM
                     tbl_saksitmp
                     ORDER BY
                     tbl_saksitmp.namalengkap ASC;'
                );

                $xcomplete = $result->num_rows();

                if ($xcomplete > 0)
                {
                    foreach ($result->result() as $datax)
                    {
                        # add to array
                        $aData[] = array(
                            'namalengkap' => $datax->Saksi_NamaLengkap,
                            'nik' => $datax->Saksi_NoKTP,
                            'alamatlengkap' => $datax->Saksi_AlamatLengkap,
                            'kelurahan' => $datax->Saksi_Kelurahan,
                            'kecamatan' => $datax->Saksi_Kecamatan,
                            'kota' => $datax->Saksi_Kota,
                            'tps' => $datax->Saksi_TPS,
                            'nohp' => $datax->Saksi_NoHP,
                            'rekomendasi' => $datax->Saksi_Rekomendasi,
                            'ulog' => $datax->Saksi_Ulog,
                            'plog' => base64_decode(base64_decode(base64_decode($datax->Saksi_Plog)))
                        );
                    }
                }
            }
            else
            {
                # if ulog and plog was clear, move get all data saksi
                # all data was ready
                # get all data saksi to prepare export into excel file
                $result = $this->db->query(
                    'SELECT
                     tbl_saksitmp.id AS "Saksi_IdSaksi",
                     tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                     tbl_saksitmp.nik AS "Saksi_NoKTP",
                     tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                     tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                     tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                     tbl_saksitmp.kota AS "Saksi_Kota",
                     tbl_saksitmp.tps AS "Saksi_TPS",
                     tbl_saksitmp.nohp AS "Saksi_NoHP",
                     tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                     tbl_saksitmp.ulog AS "Saksi_Ulog",
                     tbl_saksitmp.plog AS "Saksi_Plog"
                     FROM
                     tbl_saksitmp
                     ORDER BY
                     tbl_saksitmp.namalengkap ASC;'
                );

                $xcomplete = $result->num_rows();

                if ($xcomplete > 0)
                {
                    foreach ($result->result() as $datax)
                    {
                        # add to array
                        $aData[] = array(
                            'namalengkap' => $datax->Saksi_NamaLengkap,
                            'nik' => $datax->Saksi_NoKTP,
                            'alamatlengkap' => $datax->Saksi_AlamatLengkap,
                            'kelurahan' => $datax->Saksi_Kelurahan,
                            'kecamatan' => $datax->Saksi_Kecamatan,
                            'kota' => $datax->Saksi_Kota,
                            'tps' => $datax->Saksi_TPS,
                            'nohp' => $datax->Saksi_NoHP,
                            'rekomendasi' => $datax->Saksi_Rekomendasi,
                            'ulog' => $datax->Saksi_Ulog,
                            'plog' => base64_decode(base64_decode(base64_decode($datax->Saksi_Plog)))
                        );
                    }
                }
            }

            $result = $aData;
            return $result;
        }

        function UploadExcelSaksiTmp8 ($IdDapil)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_saksitmp.id AS "Saksi_IdSaksi",
                 tbl_saksitmp.namalengkap AS "Saksi_NamaLengkap",
                 tbl_saksitmp.nik AS "Saksi_NoKTP",
                 tbl_saksitmp.alamatlengkap AS "Saksi_AlamatLengkap",
                 tbl_saksitmp.kelurahan AS "Saksi_Kelurahan",
                 tbl_saksitmp.kecamatan AS "Saksi_Kecamatan",
                 tbl_saksitmp.kota AS "Saksi_Kota",
                 tbl_saksitmp.tps AS "Saksi_TPS",
                 tbl_saksitmp.nohp AS "Saksi_NoHP",
                 tbl_saksitmp.rekomendasi AS "Saksi_Rekomendasi",
                 tbl_saksitmp.ulog AS "Saksi_Ulog",
                 tbl_saksitmp.plog AS "Saksi_Plog"
                 FROM
                 tbl_saksitmp
                 WHERE
                 (tbl_saksitmp.ulog = \'\' OR tbl_saksitmp.ulog = NULL) AND
                 (tbl_saksitmp.plog = \'\' OR tbl_saksitmp.plog = NULL)
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC;'
            );

            $xempty = $result->num_rows();

            $aData = array();

            if ($xempty > 0)
            {
                #
            }
            else
            {
                #
            }

            $result = $aData;
            return $result;
        }

        function sheetData($sheet)
        {
            $re = '<table>'; // starts html table
           
            $x = 1;
            while($x <= $sheet['numRows'])
            {
                $re .= "<tr>\n";
                $y = 1;

                while($y <= $sheet['numCols'])
                {
                    $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
                    $re .= " <td>$cell</td>\n"; 
                    $y++;
                } 
                $re .= "</tr>\n";
                $x++;
            }
           
            return $re .'</table>'; // ends and returns the html table
        }

    }

?>
