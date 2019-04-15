<?php

    class M_dapil extends CI_Model
    {
        function CreateNewDapil ($Provinsi_IdProvinsi, $Kota_IdKota, $Dapil_NamaDapil)
        {
            if ($Provinsi_IdProvinsi == NULL || !is_numeric($Provinsi_IdProvinsi) || $Provinsi_IdProvinsi == "0")
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Kota_IdKota == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Daerah belum dipilih."
                );
                return $result;
            }
            else if ($Dapil_NamaDapil == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Nama dapil belum diisi."
                );
                return $result;
            }
            else
            {
                # check nama dapil
                $result = $this->db->query(
                    'SELECT
                     tbl_dapil.id AS "Dapil_IdDapil",
                     tbl_dapil.namadapil AS "Dapil_NamaDapil"
                     FROM
                     tbl_dapil
                     WHERE
                     tbl_dapil.namadapil = \''.$Dapil_NamaDapil.'\';'
                );

                $x = $result->num_rows();

                switch ($x)
                {
                    case 0:
                        # insert new
                        $result = $this->db->query(
                            'INSERT INTO
                             tbl_dapil(idprovinsi, idkota, namadapil)
                             VALUES(\''.$Provinsi_IdProvinsi.'\', \''.$Kota_IdKota.'\', \''.$Dapil_NamaDapil.'\');'
                        );

                        if ($result)
                        {
                            $result = array(
                                "Response_ID" => "1",
                                "Response_Message" => "Data dapil berhasil disimpan."
                            );
                            return $result;
                        }
                        else
                        {
                            $result = array(
                                "Response_ID" => "0",
                                "Response_Message" => "Gagal menambahkan data dapil."
                            );
                            return $result;
                        }
                        break;
                    case 1:
                        # update existing
                        $result = $this->db->query(
                            'UPDATE
                             public.tbl_dapil
                             SET
                             idprovinsi = \''.$Provinsi_IdProvinsi.'\',
                             idkota = \''.$Kota_IdKota.'\',
                             namadapil = \''.$Dapil_NamaDapil.'\'
                             WHERE
                             namadapil = \''.$Dapil_NamaDapil.'\';'
                        );

                        if ($result)
                        {
                            $result = array(
                                "Response_ID" => "1",
                                "Response_Message" => "Data dapil berhasil diperbaharui."
                            );
                            return $result;
                        }
                        else
                        {
                            $result = array(
                                "Response_ID" => "0",
                                "Response_Message" => "Data gagal diupdate."
                            );
                            return $result;
                        }
                        break;
                    default:
                        $result = array(
                            "Response_ID" => "0",
                            "Response_Message" => "Dapil sudah ada."
                        );
                        return $result;
                        break;
                }
            }
        }

        function DeleteDapil ($IdDapil)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_dapil WHERE id = \''.$IdDapil.'\';'
            );
            /*$result = $this->db->query(
                "DELETE FROM tbl_dapil WHERE id = '$IdDapil';"
            );*/

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data dapil berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus data dapil."
                );
                return $result;
            }
        }

        function array_find($needle, array $haystack)
        {
            foreach ($haystack as $key => $value) {
                if (false !== stripos($value, $needle)) {
                    return $key;
                }
            }
            return false;
        }

        function GetDapil ($IdDapil)
        {
            echo '<label style="font-size: 20px; margin-bottom: 15px;">Edit Daerah Pemilihan</label>';
            echo '<div class="clearfix"></div>';

            echo '<input type="text" name="text_User_IdDapil" value="'.$IdDapil.'" hidden/>';

            $result = $this->db->query(
                'SELECT
                 id AS "Dapil_IdDapil",
                 idprovinsi AS "Provinsi_IdProvinsi",
                 idkota AS "Dapil_IdKota",
                 namadapil AS "Dapil_NamaDapil"
                 FROM
                 tbl_dapil
                 WHERE
                 id = \''.$IdDapil.'\';'
            );

            $x = $result->num_rows();

            if ($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label for="spinnerprovinsi">Provinsi</label>';
                    echo '<select id="spinnerprovinsi" name="spinner_User_Provinsi" class="form-control" style="margin-bottom: 15px;" onclick="LoadProvinsiOnSelected()" required>';
                            #$this->load->view('v_spinnerProvinsi2');
                            $this->m_wilayah->GetProvinsi3($data->Provinsi_IdProvinsi);
                    echo '</select>';

                    #echo '<div id="dchipkota">';
                        #echo '<label for="chipkota">Kab. / Kota</label>';
                        #echo '<div id="chipkota" class="flexp" style="margin-bottom: 0px;">';

                            $this->m_wilayah->GetKotaOnAjax_v3($data->Provinsi_IdProvinsi, $data->Dapil_IdKota);

                            #print_r($data->Dapil_IdKota);

                            /*$resultA = $this->db->query(
                                'SELECT
                                 tbl_kota.id AS "Kota_IdKota",
                                 tbl_kota.kategori AS "Kota_KategoriKota",
                                 tbl_kota.kota AS "Kota_NamaKota"
                                 FROM
                                 tbl_kota
                                 WHERE
                                 tbl_kota.idprovinsi = \''.$data->Provinsi_IdProvinsi.'\'
                                 ORDER BY
                                 tbl_kota.kota ASC,
                                 tbl_kota.kategori ASC;'
                            );

                            if($resultA->num_rows() >= 0)
                            {
                                foreach ($resultA->result() as $dataA)
                                {
                                    $IdKota = $dataA->Kota_IdKota;
                                    $KategoriKota = $dataA->Kota_KategoriKota;
                                    $NamaKota;
                                    if ($KategoriKota == NULL)
                                    {
                                        $NamaKota = "";
                                    }
                                    else
                                    {
                                        $NamaKota = $KategoriKota . " " . $dataA->Kota_NamaKota;
                                    }

                                    echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">';
                                        echo $IdKota;
                                        if (in_array($IdKota, array($data->Dapil_IdKota)))
                                        {
                                            echo 'Ada';
                                        }
                                        else
                                        {
                                            echo 'Kosong';
                                        }
                                        #$uu = array_filter(array($data->Dapil_IdKota));
                                        #$xi = '['.$data->Dapil_IdKota.']';
                                        #$xd = array($xi);
                                        #print_r([$data->Dapil_IdKota]);
                                        #$xu = array_find($IdKota, $xi); #array_search($IdKota, $xd);
                                        #echo $xu;
                                        #die();
                                        #if ($IdKota === $xu)
                                        #{
                                            #echo 'Ada';
                                        #}
                                        #else
                                        #{
                                            #echo 'Kosong';
                                        #}

                                        echo '<input id="icItemKota" name="checkbox_User_Kota" type="checkbox" style="margin-right: 10px;" value="'.$IdKota.'" onclick="AddIdKota(\''.$IdKota.'\')" />';
                                        echo '<label style="margin-right: 5px;margin-top: 1.50px;">'.$NamaKota.'</label>';
                                    echo '</div>';
                                }

                                echo '<div id="chipreset" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()">';
                                    echo '<label style="margin-right: 5px;margin-top: 1.50px;">Reset</label>';
                                echo '</div>';
                            }*/
                            #return $resultA;

                            # Unused
                            #echo '<!--<div class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">';
                                #echo '<input type="checkbox" value="Bekasi"/>';
                                #echo '<label style="margin-right: 5px;margin-top: 1.50px;">Bekasi</label>';
                            #echo '</div>-->';

                            #echo '<!--<div id="chipkota" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">';
                                #echo '<img src="https://www.w3schools.com/howto/img_avatar.png" alt="Person" width="96" height="96">';
                                #echo 'Depok<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
                            #echo '</div>-->';
                        #echo '</div>';
                        #echo '<div id="chipreset" class="chip2" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()" hidden>';
                            #echo '<label style="color:white; margin-right:0px; margin-top:0px;">Reset</label>';
                        #echo '</div>';
                        #echo '<input type="text" class="form-control"/>';
                        #echo '<input type="text" id="tchipkota" name="text_User_tChipKota" class="form-control" style="text-align: left; margin-bottom: 15px;" value="'.$data->Dapil_IdKota.'" placeholder="..." />';
                    #echo '</div>';

                    echo '<label for="dapil">Nama Dapil</label>';
                    echo '<input type="text" id="dapil" name="text_User_NamaDapil" class="form-control" style="margin-bottom: 15px;" value="'.$data->Dapil_NamaDapil.'" placeholder="..." required />';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function GetDapil_v2 ($IdProvinsi)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_dapil.id AS "Dapil_IdDapil",
                 tbl_dapil.namadapil AS "Dapil_NamaDapil",
                 tbl_dapil.idkota AS "Dapil_IdKotaDapil"
                 FROM
                 tbl_dapil
                 LEFT JOIN tbl_provinsi ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_dapil.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_provinsi.provinsi ASC,
                 tbl_dapil.namadapil ASC;'
            );

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Dapil_IdDapil.'">'.$data->Dapil_NamaDapil.'</option>';
                }
            }

            return $result;
        }

        function GetDapil_v3 ($IdKotaDapil)
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
                 kelurahan.kelurahan AS `Saksi_Kelurahan`,
                 kecamatan.kecamatan AS `Saksi_Kecamatan`,
                 IF(kota.id = NULL, '0', kota.id) AS `Saksi_IdKota`,
                 IF(provinsi.id = NULL, '0', provinsi.id) AS `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Saksi_IdProvinsi`,
                 kota.kota AS `Saksi_Kota`,
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
                 kelurahan.kelurahan AS `Saksi_Kelurahan`,
                 kecamatan.kecamatan AS `Saksi_Kecamatan`,
                 IF(kota.id = NULL, '0', kota.id) AS `Saksi_IdKota`,
                 IF(provinsi.id = NULL, '0', provinsi.id) AS `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Saksi_IdProvinsi`,
                 kota.kota AS `Saksi_Kota`,
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
            #  AND UCASE(kota.id) LIKE CONCAT('%', UCASE(saksitmp.kota), '%')

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

            $x = $result->num_rows();

            if($x >= 0)
            {
                #echo "alert('Data ada.');";
                #echo '<option value="0" selected>Pilih</option>';

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
                    echo '</tr>';
                    #echo '<option value="'.$data->Dapil_IdDapil.'">'.$data->Dapil_NamaDapil.'</option>';
                }
            }

            return $result;
        }

        function GetDapil_v4 ($IdDapil)
        {
            # query mysql
            $result = $this->db->query(
                "SELECT
                 tbl_dapil.idkota AS `Dapil_IdKotaDapil`
                 FROM
                 tbl_dapil
                 WHERE
                 tbl_dapil.id = '$IdDapil';"
            );

            # query postgresql
            /*$result = $this->db->query(
                'SELECT
                 tbl_dapil.idkota AS "Dapil_IdKotaDapil"
                 FROM
                 tbl_dapil
                 WHERE
                 tbl_dapil.id = \''.$IdDapil.'\';'
            );*/

            $x = $result->num_rows();

            if($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    $result = $data->Dapil_IdKotaDapil;
                }
            }

            return $result;
        }

        function GetDapil_v5 ($IdKotaDapil)
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
                 IF(provinsi.id = NULL, '0', provinsi.id) AS `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Saksi_IdProvinsi`,
                 saksitmp.kota AS `Saksi_Kota`,
                 saksitmp.tps AS `Saksi_TPS`,
                 saksitmp.nohp AS `Saksi_NoHP`,
                 saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(dapil.namadapil = NULL, '', dapil.namadapil) AS `Saksi_NamaDapil`,
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
                 saksitmp.namalengkap, saksitmp.nik,
                 saksitmp.alamatlengkap, saksitmp.kelurahan, saksitmp.kecamatan,
                 kota.id, saksitmp.kota,
                 provinsi.id, provinsi.provinsi,
                 saksitmp.tps, saksitmp.nohp, saksitmp.rekomendasi,
                 dapil.namadapil,
                 saksitmp.ulog, saksitmp.plog
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
                 IF(provinsi.id = NULL, '0', provinsi.id) AS `Saksi_IdProvinsi`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Saksi_IdProvinsi`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Saksi_Kota`,
                 saksitmp.tps AS `Saksi_TPS`,
                 saksitmp.nohp AS `Saksi_NoHP`,
                 saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(dapil.namadapil = NULL, '', dapil.namadapil) AS `Saksi_NamaDapil`,
                 saksitmp.ulog AS `Saksi_Ulog`,
                 saksitmp.plog AS `Saksi_Plog`
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
                 dapil.namadapil,
                 saksitmp.ulog, saksitmp.plog
                 ORDER BY
                 saksitmp.namalengkap ASC,
                 saksitmp.nik ASC,
                 kota.kota ASC,
                 kecamatan.kecamatan ASC,
                 kelurahan.kelurahan ASC;"
            );*/
            # ON UCASE(kota.kota) LIKE CONCAT('%', UCASE(saksitmp.kota), '%')

            /*"SELECT
                 tbl_saksitmp.id AS `Saksi_Id`,
                 tbl_saksitmp.namalengkap AS `Saksi_NamaLengkap`,
                 tbl_saksitmp.nik AS `Saksi_NoKTP`,
                 tbl_saksitmp.alamatlengkap AS `Saksi_AlamatLengkap`,
                 tbl_saksitmp.kelurahan AS `Saksi_Kelurahan`,
                 tbl_saksitmp.kecamatan AS `Saksi_Kecamatan`,
                 IF(tbl_kota.id = NULL, '0', tbl_kota.id) AS `Saksi_IdKota`,
                 IF(tbl_provinsi.id = NULL, '0', tbl_provinsi.id) AS `Saksi_IdProvinsi`,
                 IF(tbl_provinsi.provinsi = NULL, '', tbl_provinsi.provinsi) AS `Saksi_IdProvinsi`,
                 tbl_saksitmp.kota AS `Saksi_Kota`,
                 tbl_saksitmp.tps AS `Saksi_TPS`,
                 tbl_saksitmp.nohp AS `Saksi_NoHP`,
                 tbl_saksitmp.rekomendasi AS `Saksi_Rekomendasi`,
                 IF(tbl_dapil.namadapil = NULL, '', tbl_dapil.namadapil) AS `Saksi_NamaDapil`,
                 tbl_saksitmp.ulog AS `Saksi_Ulog`,
                 tbl_saksitmp.plog AS `Saksi_Plog`
                 FROM
                 tbl_saksitmp
                 LEFT JOIN
                 tbl_kota ON tbl_saksitmp.kota = tbl_kota.kota
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 LEFT JOIN
                 tbl_dapil ON tbl_provinsi.id = tbl_dapil.idprovinsi
                 WHERE
                 tbl_kota.id IN ('$IdKotaDapil')
                 GROUP BY
                 tbl_saksitmp.namalengkap, tbl_saksitmp.nik
                 ORDER BY
                 tbl_saksitmp.namalengkap ASC,
                 tbl_saksitmp.nik ASC,
                 tbl_saksitmp.kota ASC,
                 tbl_saksitmp.kecamatan ASC,
                 tbl_saksitmp.kelurahan ASC;"*/

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

            $x = $result->num_rows();

            if($x >= 0)
            {
                #echo "alert('Data ada.');";
                #echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<tr>';
                        echo '<td>'.$data->Saksi_NamaLengkap.'</td>';
                        echo '<td>'.$data->Saksi_NoKTP.'</td>';
                        echo '<td>'.$data->Saksi_Ulog.'</td>';
                        echo '<td>'.substr(base64_decode(base64_decode(base64_decode($data->Saksi_Plog))), 0, 3) . ' * * *' .'</td>';
                        #echo '<td>'.$data->Saksi_AlamatLengkap.'</td>';
                        #echo '<td>'.$data->Saksi_Kelurahan.'</td>';
                        #echo '<td>'.$data->Saksi_Kecamatan.'</td>';
                        #echo '<td>'.$data->Saksi_Kota.'</td>';
                        #echo '<td>'.$data->Saksi_TPS.'</td>';
                        #echo '<td>'.$data->Saksi_NoHP.'</td>';
                        #echo '<td>'.$data->Saksi_Rekomendasi.'</td>';
                    echo '</tr>';
                    #echo '<option value="'.$data->Dapil_IdDapil.'">'.$data->Dapil_NamaDapil.'</option>';
                }
            }

            return $result;
        }

        function ListDataDapil ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_dapil.id AS "Dapil_IdDapil",
                 tbl_dapil.namadapil AS "Dapil_NamaDapil",
                 tbl_dapil.idprovinsi AS "Provinsi_IdProvinsi",
                 tbl_dapil.idkota AS "Dapil_IdKota"
                 FROM
                 tbl_dapil
                 ORDER BY
                 tbl_dapil.id DESC;'
            );
            #COALESCE(tbl_provinsi.provinsi::varchar(50), \'\') AS "Provinsi_NamaProvinsi",
            #COALESCE(tbl_kota.kategori::varchar(50), \'\') AS "Kota_KategoriKota",
            #COALESCE(tbl_kota.kota::varchar(50), \'\') AS "Kota_NamaKota"
            #LEFT JOIN tbl_provinsi ON tbl_provinsi.id = tbl_dapil.idprovinsi
            #LEFT JOIN tbl_kota ON tbl_kota.id = tbl_dapil.idkota
            #tbl_kota.kota ASC,
            #tbl_kota.kategori DESC,
            #tbl_provinsi.provinsi ASC,
            #tbl_dapil.namadapil ASC
            #GROUP BY tbl_dapil.namadapil

            $x = $result->num_rows();

            if($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Dapil_IdDapil = $data->Dapil_IdDapil;
                    $Var_Dapil_NamaDapil = $data->Dapil_NamaDapil;
                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    #$Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;
                    $Var_Dapil_IdKota = "(".$data->Dapil_IdKota.")";

                    #echo json_encode($Var_Dapil_IdKota).'<br/>';
                    #echo count($Var_Dapil_IdKota).'<br/>';
                    #echo $Var_Dapil_IdKota[0][0].'<br/>';
                    #echo $Var_Dapil_IdKota[0][1].'<br/>';
                    #echo $Var_Dapil_IdKota[0][2].'<br/>';
                    #foreach ($Var_Dapil_IdKota as $xIdKota => $xDataKota)
                    #{
                        #echo $xDataKota . "," . $xIdKota;
                    #}
                    #$list = array($Var_Dapil_IdKota);
                    #$xArray = array_map(
                        #function($value)
                        #{
                            #return ' '.$value;
                        #}, $list
                    #); #implode($list); #json_encode($list); #.str_replace("\"", "", $list);
                    #echo $xArray;
                    #echo "<br/>";
                    #foreach ($list as $key => $value) {
                        #echo $value . " in " . $key . ", ";
                    #}

                    echo '<tr>';
                        echo '<td>' . $Var_Dapil_NamaDapil . '</td>';
                        echo '<td>';
                            
                            # Get Provinsi
                            $resultA = $this->db->query(
                                'SELECT
                                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi"
                                 FROM
                                 tbl_provinsi
                                 WHERE
                                 tbl_provinsi.id = \''.$Var_Provinsi_IdProvinsi.'\';'
                            );

                            $x1 = $resultA->num_rows();

                            $Var_Provinsi_NamaProvinsi;
                            if ($x1 == 1)
                            {
                                foreach ($resultA->result() as $dataA)
                                {
                                    $Var_Provinsi_NamaProvinsi = $dataA->Provinsi_NamaProvinsi;
                                }
                            }
                            else
                            {
                                $Var_Provinsi_NamaProvinsi = "";
                            }

                            echo '<i class="fa fa-angle-right"></i>&nbsp;&nbsp;'.'Prov. '. $Var_Provinsi_NamaProvinsi . '<br/>';
                            echo '<br/>';
                            echo '<strong>Meliputi daerah :</strong>'.'<br/>';
                            # End of Get Provinsi

                            # Get List Kab./Kota
                            $resultX = $this->db->query(
                                'SELECT
                                 tbl_kota.kategori AS "Kota_KategoriKota",
                                 tbl_kota.kota AS "Kota_NamaKota"
                                 FROM
                                 tbl_kota
                                 WHERE
                                 tbl_kota.id IN '.$Var_Dapil_IdKota.'
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
                            }
                            # End of Get List Kab./Kota
                        echo '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Dashboard/EditDapil/'.$Var_Dapil_IdDapil.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Dapil_IdDapil))).'" href="#" class="btn btn-primary" onclick="ClickDeleteDapil(\'Hapus <strong>'.$Var_Dapil_NamaDapil .'</strong> dari database?\', \''.$Var_Dapil_IdDapil.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function UpdateDapil ($Dapil_IdDapil, $Provinsi_IdProvinsi, $Dapil_IdKota, $Dapil_NamaDapil)
        {
            if ($Provinsi_IdProvinsi == NULL || !is_numeric($Provinsi_IdProvinsi) || $Provinsi_IdProvinsi == "0")
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Dapil_IdKota == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kota belum dipilih."
                );
                return $result;
            }
            else if ($Dapil_NamaDapil == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Nama dapil belum diisi."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'UPDATE
                     public.tbl_dapil
                     SET
                     idprovinsi = \''.$Provinsi_IdProvinsi.'\',
                     idkota = \''.$Dapil_IdKota.'\',
                     namadapil = \''.$Dapil_NamaDapil.'\'
                     WHERE
                     id = \''.$Dapil_IdDapil.'\';'
                );

                if ($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data berhasil diperbaharui."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Gagal memperbaharui data dapil."
                    );
                    return $result;
                }
            }
        }
    }

?>