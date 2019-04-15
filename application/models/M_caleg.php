<?php

    class M_caleg extends CI_Model
    {
        function ChipTipeCaleg ($IdPartai)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_pileg.id AS "Pileg_IdPileg",
                 tbl_pileg.tipe_pileg AS "Pileg_TipePileg"
                 FROM
                 tbl_pileg
                 WHERE
                 tbl_pileg.idpartai = \''.$IdPartai.'\'
                 ORDER BY
                 tbl_pileg.tipe_pileg ASC;'
            );

            $x = $result->num_rows();

            if ($x >= 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Pileg_IdPileg = $data->Pileg_IdPileg;
                    $Var_Pileg_TipePileg = $data->Pileg_TipePileg;

                    echo '<div id="chipxtipecaleg" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="AddIdTipeCaleg(\''.$Var_Pileg_IdPileg.'\')">';
                        echo '<input type="radio" class="flat" name="radio_User_TipeCaleg" id="icItemTipeCaleg" value="'.$Var_Pileg_IdPileg.'" style="margin-left: 0px;" onclick="AddIdTipePileg(\''.$Var_Pileg_IdPileg.'\')" />&nbsp;'.$Var_Pileg_TipePileg;
                    echo '</div>';
                }
            }

            return $result;
        }

        function ChipTipeCaleg_v2 ($IdPartai, $IdTipeCaleg)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_pileg.id AS "Pileg_IdPileg",
                 tbl_pileg.tipe_pileg AS "Pileg_TipePileg"
                 FROM
                 tbl_pileg
                 WHERE
                 tbl_pileg.idpartai = \''.$IdPartai.'\'
                 ORDER BY
                 tbl_pileg.tipe_pileg ASC;'
            );

            $x = $result->num_rows();

            if ($x >= 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Pileg_IdPileg = $data->Pileg_IdPileg;
                    $Var_Pileg_TipePileg = $data->Pileg_TipePileg;

                    if ($Var_Pileg_IdPileg == $IdTipeCaleg)
                    {
                        echo '<div id="chipxtipecaleg" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="AddIdTipeCaleg(\''.$Var_Pileg_IdPileg.'\')">';
                            echo '<input type="radio" class="flat" name="radio_User_TipeCaleg" id="icItemTipeCaleg" value="'.$Var_Pileg_IdPileg.'" style="margin-left: 0px;" onclick="AddIdTipePileg(\''.$Var_Pileg_IdPileg.'\')" checked />&nbsp;'.$Var_Pileg_TipePileg;
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div id="chipxtipecaleg" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="AddIdTipeCaleg(\''.$Var_Pileg_IdPileg.'\')">';
                            echo '<input type="radio" class="flat" name="radio_User_TipeCaleg" id="icItemTipeCaleg" value="'.$Var_Pileg_IdPileg.'" style="margin-left: 0px;" onclick="AddIdTipePileg(\''.$Var_Pileg_IdPileg.'\')" />&nbsp;'.$Var_Pileg_TipePileg;
                        echo '</div>';
                    }
                }
            }

            return $result;
        }

        function CreateNewCalegPerindo(
            $Caleg_NamaLengkap, $Caleg_JenisKelamin, $Caleg_NoKTP,
            $Caleg_IdTipeCaleg, $Dapil_IdDapil
        ) {
            #$Caleg_TempatLahir, $Caleg_TanggalLahirDD, $Caleg_TanggalLahirMM, $Caleg_TanggalLahirYYYY,
            #$Caleg_Agama

            if ($Caleg_NamaLengkap == NULL || is_numeric($Caleg_NamaLengkap))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Nama lengkap belum diisi."
                );
                return $result;
            }
            else if ($Caleg_JenisKelamin == NULL || ($Caleg_JenisKelamin != "Laki-laki" && $Caleg_JenisKelamin != "Perempuan"))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Jenis kelamin belum dipilih."
                );
                return $result;
            }
            else if ($Caleg_IdTipeCaleg == NULL || !is_numeric($Caleg_IdTipeCaleg))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Tipe caleg belum dipilih."
                );
                return $result;
            }
            else if ($Dapil_IdDapil == NULL || !is_numeric($Dapil_IdDapil))
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Dapil belum dipilih."
                );
                return $result;
            }
            #else if ($Caleg_TempatLahir == NULL || is_numeric($Caleg_TempatLahir))
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Tempat lahir belum diisi."
                #);
                #return $result;
            #}
            #else if ($Caleg_TanggalLahirDD == NULL || !is_numeric($Caleg_TanggalLahirDD) || strlen($Caleg_TanggalLahirDD) != 2)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Tanggal lahir belum diisi."
                #);
                #return $result;
            #}
            #else if ($Caleg_TanggalLahirMM == NULL || !is_numeric($Caleg_TanggalLahirMM) || strlen($Caleg_TanggalLahirMM) != 2)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Bulan lahir belum dipilih."
                #);
                #return $result;
            #}
            #else if ($Caleg_TanggallahirYYYY == NULL || !is_numeric($Caleg_TanggalLahirYYYY) || strlen($Caleg_TanggalLahirYYYY) != 4)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => "Tahun lahir belum diisi."
                #);
                #return $result;
            #}
            #else if ($Caleg_Agama == NULL)
            #{
                #$result = array(
                    #"Response_ID" => "0",
                    #"Response_Message" => ""
                #);
                #return $result;
            #}
            else
            {
                $result = $this->db->query(
                    'SELECT
                     tbl_caleg.noktp AS "Caleg_NoKTP"
                     FROM
                     tbl_caleg
                     WHERE
                     tbl_caleg.noktp = \''.$Caleg_NoKTP.'\';'
                );

                $x = $result->num_rows();

                if ($x == 0)
                {
                    $result = $this->db->query(
                        'INSERT INTO
                         tbl_caleg(iddapil, noktp, idtipecaleg)
                         VALUES(\''.$Dapil_IdDapil.'\', \''.$Caleg_NoKTP.'\', \''.$Caleg_IdTipeCaleg.'\');'
                    );

                    if ($result)
                    {
                        # decode jenis kelamin
                        if ($Caleg_JenisKelamin == "Laki-laki")
                        {
                            $Caleg_JenisKelamin = "1";
                        }
                        else
                        {
                            $Caleg_JenisKelamin = "0";
                        }

                        $resultA = $this->db->query(
                            'INSERT INTO
                             tbl_user(idulogin, noktp, namalengkap, jeniskelamin, iscaleg)
                             VALUES(\'0\', \''.$Caleg_NoKTP.'\', \''.$Caleg_NamaLengkap.'\', \''.$Caleg_JenisKelamin.'\', \'1\');'
                        );

                        if ($resultA)
                        {
                            # grab data caleg from other db
                            $this->otherdb = $this->load->database('otherdb', true);
                            $resultB = $this->otherdb->query(
                                "SELECT
                                 daftar_web_final.nik AS `User_NoKTP`,
                                 daftar_web_final.tempat_lahir AS `User_TmpLahir`,
                                 CONCAT(
                                    RIGHT(tanggal_lahir, 4), '-', MID(tanggal_lahir, 4, 2), '-', LEFT(tanggal_lahir, 2)
                                 ) AS `User_TglLahir`,
                                 daftar_web_final.Alamat AS `User_AlamatRumah`,
                                 daftar_web_final.Status AS `User_StatusPernikahan`,
                                 daftar_web_final.Handphone AS `User_NoHP`
                                 FROM
                                 daftar_web_final
                                 WHERE
                                 daftar_web_final.nik = '$Caleg_NoKTP';"
                            );

                            $xb = $resultB->num_rows();

                            if ($xb == 1)
                            {
                                foreach ($resultB->result() as $dataB)
                                {
                                    $vUser_NoKTP = $dataB->User_NoKTP;
                                    $vUser_TmpLahir = $dataB->User_TmpLahir;
                                    $vUser_TglLahir = $dataB->User_TglLahir;
                                    $vUser_AlamatRumah = $dataB->User_AlamatRumah;
                                    $vUser_StatusPernikahan = $dataB->User_StatusPernikahan;
                                    $vUser_NoHP = $dataB->User_NoHP;

                                    # update user on postgresql db by noktp
                                    $resultC = $this->db->query(
                                        'UPDATE
                                         public.tbl_user
                                         SET
                                         tmplahir = \''.$vUser_TmpLahir.'\',
                                         tgllahir = \''.$vUser_TglLahir.'\',
                                         alamat = \''.$vUser_AlamatRumah.'\',
                                         statuspernikahan = \''.$vUser_StatusPernikahan.'\'
                                         WHERE
                                         noktp = \''.$Caleg_NoKTP.'\';'
                                    );

                                    if ($resultC)
                                    {
                                        $resultC = array(
                                            "Response_ID" => "1",
                                            "Response_Message" => "Data caleg berhasil disimpan.",
                                            "Response_IdTipeCaleg" => $Caleg_IdTipeCaleg
                                        );
                                        return $resultC;
                                    }
                                    else
                                    {
                                        $resultC = array(
                                            "Response_ID" => "0",
                                            "Response_Message" => "Gagal menyimpan data caleg."
                                        );
                                        return $resultC;
                                    }
                                    # end of update user on postgresql db by noktp
                                }
                            }
                            else
                            {
                                $resultA = array(
                                    "Response_ID" => "1",
                                    "Response_Message" => "Data caleg berhasil disimpan.",
                                    "Response_IdTipeCaleg" => $Caleg_IdTipeCaleg
                                );
                                return $resultA;
                            }
                            # end of grab data caleg from other db
                        }
                        else
                        {
                            $resultA = array(
                                "Response_ID" => "0",
                                "Response_Message" => "Gagal menyimpan data caleg."
                            );
                            return $resultA;
                        }
                    }
                    else
                    {
                        $result = array(
                            "Response_ID" => "0",
                            "Response_Message" => "Gagal menyimpan data caleg."
                        );
                        return $result;
                    }
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Oops! Caleg sudah ada."
                    );
                    return $result;
                }
            }
        }

        function DeleteCaleg ($IdCaleg)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_caleg WHERE id = \''.$IdCaleg.'\';'
            );

            if ($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data caleg berhasil diperbaharui."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal memperbaharui data caleg."
                );
                return $result;
            }
        }

        function GetCalegForEdit($IdCaleg)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_caleg.id AS "Caleg_IdCaleg",
                 tbl_user.namalengkap AS "Caleg_NamaLengkap",
                 tbl_user.jeniskelamin AS "Caleg_JenisKelamin",
                 tbl_user.noktp AS "Caleg_NoKTP",
                 tbl_user.tmplahir AS "Caleg_TmpLahir",
                 LEFT(tbl_user.tgllahir, 4) AS "Caleg_TglLahirYYYY",
                 SUBSTRING(tbl_user.tgllahir, 6, 2) AS "Caleg_TglLahirMM",
                 RIGHT(tbl_user.tgllahir, 2) AS "Caleg_TglLahirDD",

                 tbl_dapil.idprovinsi AS "Caleg_IdProvinsiDapil",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi",
                 tbl_dapil.idkota AS "Caleg_IdKotaDapil",
                 tbl_dapil.namadapil AS "Caleg_NamaDapil",

                 tbl_caleg.iddapil AS "Caleg_IdDapil",
                 tbl_caleg.idtipecaleg AS "Caleg_IdTipeCaleg"
                 FROM
                 tbl_user
                 LEFT JOIN tbl_caleg ON tbl_caleg.noktp = tbl_user.noktp
                 LEFT JOIN tbl_dapil ON tbl_dapil.id = tbl_caleg.iddapil
                 LEFT JOIN tbl_provinsi ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_user.iscaleg = \'1\' AND
                 tbl_caleg.id = \''.$IdCaleg.'\'
                 LIMIT 1;'
            );

            $x = $result->num_rows();

            if ($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Identitas Caleg</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_User_IdCaleg" value="'.$data->Caleg_IdCaleg.'" hidden/>';

                    echo '<label for="fullname">Nama Lengkap</label>'.'<br/>';
                    echo '<label style="margin-bottom: 15px;">'.'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$data->Caleg_NamaLengkap.'</label>'.'<br/>';
                    #echo '<input type="text" id="fullname" name="text_User_NamaLengkap" class="form-control" style="margin-bottom: 15px;" value="'.$data->Caleg_NamaLengkap.'" placeholder="..." required autofocus disabled />';

                    echo '<label>Jenis Kelamin</label>'.'<br/>';
                    echo '<label style="margin-bottom: 15px;">'.'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.($data->Caleg_JenisKelamin == "1" ? 'Laki-laki' : 'Perempuan').'</label>'.'<br/>';
                    #echo '<p style="margin-bottom: 15px;">';
                        #$vCaleg_JenisKelamin = $data->Caleg_JenisKelamin;
                        #if ($vCaleg_JenisKelamin == "1")
                        #{
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" checked disabled />&nbsp;Laki-laki';
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" disabled />&nbsp;Perempuan';
                        #}
                        #else
                        #{
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderM" value="Laki-laki" disabled />&nbsp;Laki-laki';
                            #echo '<input type="radio" class="flat" name="radio_User_JenisKelamin" id="genderF" value="Perempuan" style="margin-left: 15px;" checked disabled />&nbsp;Perempuan';
                        #}
                    #echo '</p>';

                    echo '<label for="nomorktp">Nomor KTP</label>'.'<br/>';
                    echo '<label style="margin-bottom: 50px;">'.'<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$data->Caleg_NoKTP.'</label>'.'<br/>';
                    #echo '<input type="number" id="nomorktp" class="form-control" name="text_User_NomorKTP" data-parsley-trigger="change" value="'.$data->Caleg_NoKTP.'" style="width: 285px; margin-bottom: 50px;" disabled />';

                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Tipe Caleg</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<div id="dchiptipecaleg" style="margin-bottom: 50px;">';
                        echo '<div id="chiptipecaleg" class="flexp" style="margin-bottom: 0px;">';
                            #<!-- decode in here for js+html rewrite -->
                            $vCaleg_IdTipeCaleg = $data->Caleg_IdTipeCaleg;
                            $IdPartai = "9";
                            $this->m_caleg->ChipTipeCaleg_v2($IdPartai, $vCaleg_IdTipeCaleg);
                        echo '</div>';
                        echo '<input type="text" id="tchiptipecaleg" name="text_User_tChipTipeCaleg" class="form-control" style="text-align: left; margin-bottom: 15px;" value="" placeholder="..." hidden />';
                    echo '</div>';

                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Daerah Pemilihan</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<label for="spinnerprovinsi">Provinsi</label>';
                    echo '<select id="spinnerprovinsi" name="spinner_User_Provinsi" class="form-control" style="margin-bottom: 15px;" required onclick="LoadProvinsiOnSelected();">';
                        #$this->load->view('v_spinnerProvinsi2');
                        $this->m_wilayah->GetProvinsi3($data->Caleg_IdProvinsiDapil);
                    echo '</select>';

                    echo '<div id="dchipkota">';
                        echo '<label for="chipkota">Kab. / Kota</label>';
                        echo '<div id="chipkota" class="flexp" style="margin-bottom: 0px;">';
                            /*echo json_encode(array(
                                "idcaleg" => $IdCaleg,
                                "idprovinsi" => $data->Caleg_IdProvinsiDapil,
                                "idkotadapil" => $data->Caleg_IdKotaDapil
                            ));*/
                            $this->m_wilayah->GetKotaOnAjax_v5($data->Caleg_IdProvinsiDapil, $data->Caleg_IdDapil);
                            #$this->m_wilayah->SpinnerKotaOnAjax_v4($data->Caleg_IdProvinsiDapil);
                            #$this->m_wilayah->GetKotaOnAjax_v3($data->Caleg_IdProvinsiDapil, $data->Caleg_IdKotaDapil);

                            #<!--<div class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">
                            #    <input type="checkbox" value="Bekasi"/>
                            #    <label style="margin-right: 5px;margin-top: 1.50px;">Bekasi</label>
                            #</div>-->

                            #<!--<div id="chipkota" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">
                            #        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Person" width="96" height="96">
                            #        Depok<span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
                            #</div>-->
                        echo '</div>';
                        echo '<input type="text" id="tchipkota" name="text_User_tChipKota" class="form-control" style="text-align: left; margin-bottom: 15px;" value="" placeholder="..." hidden />';
                    echo '</div>';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function GetCalegForSpinner ()
        {
            $IdPartai = "9";

            $result = $this->db->query(
                'SELECT
                 tbl_caleg.id AS "Caleg_IdCaleg",
                 tbl_user.namalengkap AS "Caleg_NamaLengkap",
                
                 tbl_pileg.id AS "Caleg_IdTipeCaleg",
                 tbl_pileg.tipe_pileg AS "Caleg_TipeCaleg",
                
                 tbl_dapil.id AS "Caleg_IdDapil",
                 tbl_dapil.namadapil AS "Caleg_NamaDapil",
                
                 tbl_dapil.idprovinsi AS "Caleg_DapilIdProvinsi",
                 tbl_provinsi.provinsi AS "Caleg_DapilNamaProvinsi",
                 tbl_dapil.idkota AS "Caleg_DapilIdKota"
                 FROM
                 tbl_caleg
                 LEFT JOIN tbl_user ON tbl_user.noktp = tbl_caleg.noktp
                 LEFT join tbl_pileg on tbl_pileg.id = tbl_caleg.idtipecaleg
                 LEFT JOIN tbl_dapil ON tbl_dapil.id = tbl_caleg.iddapil
                 LEFT JOIN tbl_provinsi ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_user.iscaleg = \'1\' AND
                 tbl_pileg.idpartai = \''.$IdPartai.'\'
                 ORDER by
                 tbl_pileg.tipe_pileg asc,
                 tbl_dapil.namadapil asc,
                 tbl_user.namalengkap asc;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Provinsi_IdProvinsi`,
                    provinsi AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_provinsi
                 ORDER BY
                    provinsi ASC;"
            );*/

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Caleg_IdCaleg.'">'.$data->Caleg_NamaLengkap.'&nbsp;&nbsp;'.'-'.'&nbsp;&nbsp;'.$data->Caleg_TipeCaleg.'&nbsp;<i class="fa fa-angle-right"></i>&nbsp'.$data->Caleg_NamaDapil.'</option>';
                }
            }

            return $result;
        }

        function GetCalegForSpinner_v2 ($IdDapil)
        {
            $IdPartai = "9";

            $result = $this->db->query(
                'SELECT
                 tbl_caleg.id AS "Caleg_IdCaleg",
                 tbl_user.namalengkap AS "Caleg_NamaLengkap",
                 
                 tbl_caleg.idtipecaleg AS "Caleg_IdTipeCaleg",
                 tbl_pileg.tipe_pileg AS "Caleg_TipeCaleg"
                 FROM
                 tbl_caleg
                 LEFT JOIN tbl_pileg ON tbl_pileg.id = tbl_caleg.idtipecaleg
                 LEFT JOIN tbl_user ON tbl_user.noktp = tbl_caleg.noktp
                 WHERE
                 tbl_caleg.iddapil = \''.$IdDapil.'\' AND
                 tbl_pileg.idpartai = \''.$IdPartai.'\' AND
                 tbl_user.iscaleg = \'1\'
                 ORDER BY
                 tbl_pileg.tipe_pileg ASC,
                 tbl_user.namalengkap ASC;'
            );

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Caleg_IdCaleg.'">'.$data->Caleg_NamaLengkap.'&nbsp;&nbsp;'.'-'.'&nbsp;&nbsp;'.$data->Caleg_TipeCaleg.'</option>';
                }
            }

            return $result;
        }

        function GetTipeCalegForTitle ($IdTipeCaleg)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_pileg.id AS "Pileg_IdPileg",
                 tbl_pileg.tipe_pileg AS "Pileg_TipePileg"
                 FROM
                 tbl_pileg
                 WHERE
                 tbl_pileg.id = \''.$IdTipeCaleg.'\';'
            );

            $x = $result->num_rows();

            if ($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo $data->Pileg_TipePileg;
                }
            }
            else
            {
                echo "Unknown";
            }
        }

        function ListCalegByTipe($IdTipeCaleg, $IdPartai)
        {
            date_default_timezone_set("Asia/Jakarta");
            $datetime_yyyy = date("Y");

            $result = $this->db->query(
                'SELECT
                 tbl_caleg.id AS "Caleg_IdCaleg",
                 tbl_user.namalengkap AS "Caleg_NamaLengkap",
                 tbl_user.tmplahir AS "Caleg_TmpLahir",
                 LEFT(tbl_user.tgllahir, 4) AS "Caleg_TglLahirYYYY",
                 SUBSTRING(tbl_user.tgllahir, 6, 2) AS "Caleg_TglLahirMM",
                 RIGHT(tbl_user.tgllahir, 2) AS "Caleg_TglLahirDD",

                 tbl_dapil.idprovinsi AS "Caleg_IdProvinsiDapil",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi",
                 tbl_dapil.idkota AS "Caleg_IdKotaDapil",
                 tbl_dapil.namadapil AS "Caleg_NamaDapil"
                 FROM
                 tbl_user
                 LEFT JOIN tbl_caleg ON tbl_caleg.noktp = tbl_user.noktp
                 LEFT JOIN tbl_dapil ON tbl_dapil.id = tbl_caleg.iddapil
                 LEFT JOIN tbl_provinsi ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_user.iscaleg = \'1\' AND
                 tbl_caleg.idtipecaleg = \''.$IdTipeCaleg.'\'
                 ORDER BY
                 tbl_user.namalengkap ASC;'
            );

            $x = $result->num_rows();

            if ($x >= 0)
            {
                foreach ($result->result() as $data)
                {
                    $vCaleg_IdCaleg = $data->Caleg_IdCaleg;
                    $vCaleg_NamaLengkap = $data->Caleg_NamaLengkap;
                    $vCaleg_TmpLahir = ucwords(strtolower($data->Caleg_TmpLahir));
                    $vCaleg_TglLahirYYYY = $data->Caleg_TglLahirYYYY;
                    $vCaleg_TglLahirMM = $data->Caleg_TglLahirMM;
                    $vCaleg_TglLahirMM2;
                    $vCaleg_TglLahirDD = $data->Caleg_TglLahirDD;
                    $vProvinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;
                    $vCaleg_IdKotaDapil = "(".$data->Caleg_IdKotaDapil.")";
                    $vCaleg_NamaDapil = $data->Caleg_NamaDapil;

                    # generate date mm to short month
                    switch ($vCaleg_TglLahirMM)
                    {
                        case "01":
                            $vCaleg_TglLahirMM2 = "Jan";
                            break;
                        case "02":
                            $vCaleg_TglLahirMM2 = "Feb";
                            break;
                        case "03":
                            $vCaleg_TglLahirMM2 = "Mar";
                            break;
                        case "04":
                            $vCaleg_TglLahirMM2 = "Apr";
                            break;
                        case "05":
                            $vCaleg_TglLahirMM2 = "Mei";
                            break;
                        case "06":
                            $vCaleg_TglLahirMM2 = "Jun";
                            break;
                        case "07":
                            $vCaleg_TglLahirMM2 = "Jul";
                            break;
                        case "08":
                            $vCaleg_TglLahirMM2 = "Agt";
                            break;
                        case "09":
                            $vCaleg_TglLahirMM2 = "Sep";
                            break;
                        case "10":
                            $vCaleg_TglLahirMM2 = "Okt";
                            break;
                        case "11":
                            $vCaleg_TglLahirMM2 = "Nov";
                            break;
                        case "12":
                            $vCaleg_TglLahirMM2 = "Des";
                            break;
                        default:
                            $vCaleg_TglLahirMM2 = "Unk";
                            break;
                    }
                    # end of generate date mm to short month

                    echo '<tr>';
                        echo '<td>'.$vCaleg_NamaLengkap.'</td>';
                        echo '<td>';
                            echo '<strong>Kelahiran</strong>'.'<br/>';
                            echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$vCaleg_TmpLahir.', '.$vCaleg_TglLahirDD.' '.$vCaleg_TglLahirMM2.' '.$vCaleg_TglLahirYYYY.'<br/><br/>';

                            echo '<strong>Usia</strong>'.'<br/>';
                            echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.($datetime_yyyy - $vCaleg_TglLahirYYYY).' tahun';
                        echo '</td>';

                        echo '<td>';
                            echo '<strong>Dapil</strong>'.'<br/>';
                            echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$vCaleg_NamaDapil.'<br/><br/>';
                            
                            echo '<strong>Provinsi</strong>'.'<br/>';
                            echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.'Prov. '.$vProvinsi_NamaProvinsi.'<br/><br/>';
                            
                            echo '<strong>Meliputi daerah :</strong>'.'<br/>';
                            
                            # Get List Kab./Kota
                            /*$resultX = $this->db->query(
                                'SELECT
                                tbl_kota.kategori AS "Kota_KategoriKota",
                                tbl_kota.kota AS "Kota_NamaKota"
                                FROM
                                tbl_kota
                                WHERE
                                tbl_kota.id IN '.$vCaleg_IdKotaDapil.'
                                ORDER BY
                                tbl_kota.kota ASC,
                                tbl_kota.kategori DESC;'
                            );

                            $x2 = $resultX->num_rows();

                            if ($x2 > 0)
                            {
                                foreach ($resultX->result() as $dataX)
                                {
                                    $Var_Kota_KategoriKota = $dataX->Kota_KategoriKota;
                                    $Var_Kota_NamaKota = $dataX->Kota_NamaKota;

                                    echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$Var_Kota_KategoriKota.' '. $Var_Kota_NamaKota . '<br/>';
                                }
                            }*/
                            
                            $result = $this->db->query(
                                'SELECT
                                tbl_kota.kategori AS "Kota_KategoriKota",
                                tbl_kota.kota AS "Kota_NamaKota"
                                FROM
                                tbl_kota
                                WHERE
                                tbl_kota.id IN '.$vCaleg_IdKotaDapil.'
                                ORDER BY
                                tbl_kota.kota ASC,
                                tbl_kota.kategori DESC;'
                            );

                            $x = $result->num_rows();

                            if ($x > 0)
                            {
                                foreach ($result->result() as $data)
                                {
                                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                                    $Var_Kota_NamaKota = $data->Kota_NamaKota;

                                    echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.$Var_Kota_KategoriKota.' '. $Var_Kota_NamaKota . '<br/>';
                                }
                            }
                            #return $result;
                            # End of Get List Kab./Kota
                        echo '</td>';
                        
                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Dashboard/EditCaleg/'.$vCaleg_IdCaleg.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            echo '<a id="'.base64_encode(base64_encode(base64_encode($vCaleg_IdCaleg))).'" href="#" class="btn btn-primary" onclick="ClickDeleteCaleg(\'Hapus <strong>'.$vCaleg_NamaLengkap.'</strong> dari database?\', \''.$vCaleg_IdCaleg.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListTipeCaleg ($IdPartai)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_pileg.id AS "Pileg_IdPileg",
                 tbl_pileg.tipe_pileg AS "Pileg_TipePileg"
                 FROM
                 tbl_pileg
                 ORDER BY
                 tbl_pileg.idpartai = \''.$IdPartai.'\';'
            );

            $x = $result->num_rows();

            if ($x >= 0)
            {
                foreach ($result->result() as $data)
                {
                    echo '<li><a href="'.site_url("Dashboard/DbCaleg/".$data->Pileg_IdPileg).'" style="font-family: '."Arial".';"> '.$data->Pileg_TipePileg.' </a></li>';
                }
            }

            return $result;
        }

        function UpdateCalegPerindo ($Caleg_IdCaleg, $Caleg_IdTipeCaleg, $Caleg_IdDapil)
        {
            $result = $this->db->query(
                'UPDATE
                 public.tbl_caleg
                 SET
                 iddapil = \''.$Caleg_IdDapil.'\',
                 idtipecaleg = \''.$Caleg_IdTipeCaleg.'\'
                 WHERE
                 id = \''.$Caleg_IdCaleg.'\';'
            );

            if ($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data caleg berhasil diperbaharui.",
                    "Response_IdTipeCaleg" => $Caleg_IdTipeCaleg
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal memperbaharui data caleg."
                );
                return $result;
            }
        }
    }

?>