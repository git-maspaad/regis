<?php

    class M_wilayah extends CI_Model
    {

        function CreateNewKecamatan ($Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_NamaKecamatan)
        {
            if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Kota_IdKota == NULL || $Kota_IdKota == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kab./kota belum dipilih."
                );
                return $result;
            }
            else if ($Kecamatan_NamaKecamatan == NULL || is_numeric($Kecamatan_NamaKecamatan) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kecamatan dengan benar."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'INSERT INTO tbl_kecamatan(idprovinsi, idkota, kecamatan)
                     VALUES(\''.$Provinsi_IdProvinsi.'\', \''.$Kota_IdKota.'\', \''.$Kecamatan_NamaKecamatan.'\');'
                );
                /*$result = $this->db->query(
                    "INSERT INTO
                     tbl_kecamatan
                     (
                        idprovinsi, idkota, kecamatan
                     )
                     VALUES
                     (
                        '$Provinsi_IdProvinsi', '$Kota_IdKota', '$Kecamatan_NamaKecamatan'
                     );"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Create kecamatan success."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Create kecamatan gagal."
                    );
                    return $result;
                }
            }
        }

        function CreateNewKelurahan ($Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_IdKecamatan, $Kelurahan_NamaKelurahan)
        {
            if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Kota_IdKota == NULL || $Kota_IdKota == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kab./kota belum dipilih."
                );
                return $result;
            }
            else if ($Kecamatan_IdKecamatan == NULL || $Kecamatan_IdKecamatan == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kecamatan belum dipilih."
                );
                return $result;
            }
            else if ($Kelurahan_NamaKelurahan == NULL || is_numeric($Kelurahan_NamaKelurahan) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kelurahan dengan benar."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'INSERT INTO tbl_kelurahan(idprovinsi, idkota, idkecamatan, kelurahan)
                     VALUES(\''.$Provinsi_IdProvinsi.'\', \''.$Kota_IdKota.'\', \''.$Kecamatan_IdKecamatan.'\', \''.$Kelurahan_NamaKelurahan.'\');'
                );
                /*$result = $this->db->query(
                    "INSERT INTO
                     tbl_kelurahan
                     (
                        idprovinsi, idkota, idkecamatan, kelurahan
                     )
                     VALUES
                     (
                        '$Provinsi_IdProvinsi', '$Kota_IdKota', '$Kecamatan_IdKecamatan', '$Kelurahan_NamaKelurahan'
                     );"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Create kelurahan success."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Create kelurahan gagal."
                    );
                    return $result;
                }
            }
        }

        function CreateNewKota ($Provinsi_IdProvinsi, $Kota_KategoriKota, $Kota_NamaKota)
        {
            if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Kota_KategoriKota == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kategori kab./kota belum dipilih."
                );
                return $result;
            }
            else if ($Kota_NamaKota == NULL || is_numeric($Kota_NamaKota) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Nama kab./kota belum diisi."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'INSERT INTO
                     tbl_kota(idprovinsi, kategori, kota)
                     VALUES(\''.$Provinsi_IdProvinsi.'\', \''.$Kota_KategoriKota.'\', \''.$Kota_NamaKota.'\');'
                );
                /*$result = $this->db->query(
                    "INSERT INTO
                     tbl_kota
                     (
                        idprovinsi, kategori, kota
                     )
                     VALUES
                     (
                        '$Provinsi_IdProvinsi', '$Kota_KategoriKota', '$Kota_NamaKota'
                     );"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Create kab./kota success."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Create kab./kota gagal."
                    );
                    return $result;
                }
            }
        }

        function CreateNewProvinsi ($Provinsi_NamaProvinsi, $Provinsi_IdWilayah)
        {
            if ($Provinsi_NamaProvinsi == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan nama provinsi dengan benar."
                );
                return $result;
            }
            else if ($Provinsi_IdWilayah == NULL || $Provinsi_IdWilayah == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Wilayah provinsi belum dipilih."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'INSERT INTO tbl_provinsi(provinsi, idwilayah)
                     VALUES (\''.$Provinsi_NamaProvinsi.'\', \''.$Provinsi_IdWilayah.'\');'
                );
                /*$result = $this->db->query(
                    "INSERT INTO
                     tbl_provinsi
                     (
                        provinsi, idwilayah
                     )
                     VALUES
                     (
                        '$Provinsi_NamaProvinsi', '$Provinsi_IdWilayah'
                     );"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Create provinsi success."
                    );
                    return $result;
                }
                else
                {
                    $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Create provinsi gagal."
                    );
                    return $result;
                }
            }
        }

        function DeleteKecamatan ($IdKecamatan)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_kecamatan WHERE id = \''.$IdKecamatan.'\';'
            );
            /*$result = $this->db->query(
                "DELETE FROM tbl_kecamatan WHERE id = '$IdKecamatan';"
            );*/

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data kecamatan berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus data kecamatan."
                );
                return $result;
            }
        }

        function DeleteKelurahan ($IdKelurahan)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_kelurahan WHERE id = \''.$IdKelurahan.'\';'
            );
            /*$result = $this->db->query(
                "DELETE FROM tbl_kelurahan WHERE id = '$IdKelurahan';"
            );*/

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data kelurahan berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus data kelurahan."
                );
                return $result;
            }
        }

        function DeleteKota ($IdKota)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_kota WHERE id = \''.$IdKota.'\';'
            );
            /*$result = $this->db->query(
                "DELETE FROM tbl_kota WHERE id = '$IdKota';"
            );*/

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data kab./kota berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus data kab./kota."
                );
                return $result;
            }
        }

        function DeleteProvinsi ($IdProvinsi)
        {
            $result = $this->db->query(
                'DELETE FROM tbl_provinsi WHERE id = \''.$IdProvinsi.'\';'
            );
            /*$result = $this->db->query(
                "DELETE FROM tbl_provinsi WHERE id = '$IdProvinsi';"
            );*/

            if($result)
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Provinsi berhasil dihapus."
                );
                return $result;
            }
            else
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Gagal menghapus data provinsi."
                );
                return $result;
            }
        }

        function GenerateDataWilayah ($Kelurahan, $Kecamatan, $Kota)
        {
            $result = $this->db->query(
                "SELECT
                 tbl_provinsi.id AS `IdProvinsi`,
                 tbl_provinsi.provinsi AS `Provinsi`,
                 tbl_kota.id AS `IdKota`,
                 tbl_kota.kota AS `Kota`,
                 tbl_kecamatan.id AS `IdKecamatan`,
                 tbl_kecamatan.kecamatan AS `Kecamatan`,
                 tbl_kelurahan.id AS `IdKelurahan`,
                 tbl_kelurahan.kelurahan AS `Kelurahan`
                 FROM
                 tbl_kelurahan
                 LEFT JOIN
                 tbl_kecamatan ON tbl_kelurahan.idkecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 WHERE
                 UCASE(tbl_kota.kota) LIKE '%$Kota%' AND
                 UCASE(tbl_kecamatan.kecamatan) LIKE '%$Kecamatan%' AND
                 UCASE(tbl_kelurahan.kelurahan) LIKE '%$Kelurahan%'
                 ORDER BY
                 tbl_kota.kota ASC,
                 tbl_kecamatan.kecamatan ASC,
                 tbl_kelurahan.kelurahan ASC
                 LIMIT 0, 1;"
            );

            $x = $result->num_rows();

            if ($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    $result = array(
                        "IdProvinsi" => $data->IdProvinsi,
                        "Provinsi" => $data->Provinsi,
                        "IdKota" => $data->IdKota,
                        "Kota" => ucwords(strtolower($data->Kota)),
                        "IdKecamatan" => $data->IdKecamatan,
                        "Kecamatan" => ucwords(strtolower($data->Kecamatan)),
                        "IdKelurahan" => $data->IdKelurahan,
                        "Kelurahan" => ucwords(strtolower($data->Kelurahan))
                    );
                }
            }
            else
            {
                $result = array(
                    "IdProvinsi" => "0",
                    "Provinsi" => "",
                    "IdKota" => "0",
                    "Kota" => $Kota,
                    "IdKecamatan" => "0",
                    "Kecamatan" => $Kecamatan,
                    "IdKelurahan" => "0",
                    "Kelurahan" => $Kelurahan
                );
            }

            return $result;
        }

        function GenerateDataWilayah2 ($IdKelurahan, $IdKecamatan, $IdKota)
        {
            $result = $this->db->query(
                "SELECT
                 tbl_provinsi.id AS `IdProvinsi`,
                 tbl_provinsi.provinsi AS `Provinsi`,
                 tbl_kota.id AS `IdKota`,
                 tbl_kota.kota AS `Kota`,
                 tbl_kecamatan.id AS `IdKecamatan`,
                 tbl_kecamatan.kecamatan AS `Kecamatan`,
                 tbl_kelurahan.id AS `IdKelurahan`,
                 tbl_kelurahan.kelurahan AS `Kelurahan`
                 FROM
                 tbl_kelurahan
                 LEFT JOIN
                 tbl_kecamatan ON tbl_kelurahan.idkecamatan = tbl_kecamatan.id
                 LEFT JOIN
                 tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 WHERE
                 tbl_kota.id = '$IdKota' AND
                 tbl_kecamatan.id = '$IdKecamatan' AND
                 tbl_kelurahan.id = '$IdKelurahan'
                 ORDER BY
                 tbl_kota.kota ASC,
                 tbl_kecamatan.kecamatan ASC,
                 tbl_kelurahan.kelurahan ASC
                 LIMIT 0, 1;"
            );

            $x = $result->num_rows();

            if ($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    $result = array(
                        "IdProvinsi" => $data->IdProvinsi,
                        "Provinsi" => $data->Provinsi,
                        "IdKota" => $data->IdKota,
                        "Kota" => ucwords(strtolower($data->Kota)),
                        "IdKecamatan" => $data->IdKecamatan,
                        "Kecamatan" => ucwords(strtolower($data->Kecamatan)),
                        "IdKelurahan" => $data->IdKelurahan,
                        "Kelurahan" => ucwords(strtolower($data->Kelurahan))
                    );
                }
            }
            else
            {
                $result = array(
                    "IdProvinsi" => "0",
                    "Provinsi" => "",
                    "IdKota" => "0",
                    "Kota" => $Kota,
                    "IdKecamatan" => "0",
                    "Kecamatan" => $Kecamatan,
                    "IdKelurahan" => "0",
                    "Kelurahan" => $Kelurahan
                );
            }

            return $result;
        }

        function GenerateDataWilayah3 ($IdKelurahan)
        {
            $result = $this->db->query(
                "SELECT
                 kelurahan.id AS `IdKelurahan`,
                 kelurahan.kelurahan AS `Kelurahan`,
                 kecamatan.id AS `IdKecamatan`,
                 kecamatan.kecamatan AS `Kecamatan`,
                 kota.id AS `IdKota`,
                 kota.kota AS `Kota`,
                 provinsi.id AS `IdProvinsi`,
                 provinsi.provinsi AS `Provinsi`
                 FROM
                 tbl_kelurahan AS kelurahan
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON kelurahan.idkecamatan = kecamatan.id
                 LEFT JOIN
                 tbl_kota AS kota ON kecamatan.idkota = kota.id
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 WHERE
                 kelurahan.id = '$IdKelurahan';"
            );

            $x = $result->num_rows();

            if ($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data wilayah ditemukan.",

                        "IdProvinsi" => $data->IdProvinsi,
                        "Provinsi" => $data->Provinsi,
                        "IdKota" => $data->IdKota,
                        "Kota" => ucwords(strtolower($data->Kota)),
                        "IdKecamatan" => $data->IdKecamatan,
                        "Kecamatan" => ucwords(strtolower($data->Kecamatan)),
                        "IdKelurahan" => $data->IdKelurahan,
                        "Kelurahan" => ucwords(strtolower($data->Kelurahan))
                    );
                }
            }
            else
            {
                $result = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Oops! Data not found.",

                    "IdProvinsi" => "",
                    "Provinsi" => "",
                    "IdKota" => "",
                    "Kota" => "",
                    "IdKecamatan" => "",
                    "Kecamatan" => "",
                    "IdKelurahan" => "",
                    "Kelurahan" => ""
                );
            }

            return $result;
        }

        function GenerateDataWilayah4 ($IdProvinsi)
        {
            $dataArrayProvinsi = array();

            $result = $this->db->query(
                "SELECT
                 provinsi.id AS `IdProvinsi`,
                 provinsi.provinsi AS `Provinsi`
                 FROM
                 tbl_provinsi AS provinsi
                 WHERE
                 provinsi.id = '$IdProvinsi'
                 ORDER BY
                 provinsi.id ASC;"
            );

            $xProvinsi = $result->num_rows();

            if ($xProvinsi > 0)
            {
                foreach ($result->result() as $dataProvinsi)
                {
                    $dataArrayKota = array();

                    $resultKota = $this->db->query(
                        "SELECT
                         kota.id AS `IdKota`,
                         kota.kota AS `Kota`
                         FROM
                         tbl_kota AS kota
                         WHERE
                         kota.idprovinsi = '$IdProvinsi'
                         ORDER BY
                         kota.kota ASC;"
                    );

                    $xKota = $resultKota->num_rows();

                    if ($xKota > 0)
                    {
                        foreach ($resultKota->result() as $dataKota)
                        {
                            $xIdKota = $dataKota->IdKota;
                            $dataArrayKecamatan = array();

                            #if ($xIdKota == "3209")
                            #{
                                $resultKecamatan = $this->db->query(
                                    "SELECT
                                     kecamatan.id AS `IdKecamatan`,
                                     kecamatan.kecamatan AS `Kecamatan`
                                     FROM
                                     tbl_kecamatan AS kecamatan
                                     WHERE
                                     kecamatan.idkota = '$xIdKota'
                                     ORDER BY
                                     kecamatan.kecamatan ASC;"
                                );

                                $xKecamatan = $resultKecamatan->num_rows();

                                if ($xKecamatan > 0)
                                {
                                    foreach ($resultKecamatan->result() as $dataKecamatan)
                                    {
                                        $xIdKecamatan = $dataKecamatan->IdKecamatan;
                                        $dataArrayKelurahan = array();

                                        $resultKelurahan = $this->db->query(
                                            "SELECT
                                             kelurahan.id AS `IdKelurahan`,
                                             kelurahan.kelurahan AS `Kelurahan`
                                             FROM
                                             tbl_kelurahan AS kelurahan
                                             WHERE
                                             kelurahan.idkecamatan = '$xIdKecamatan'
                                             ORDER BY
                                             kelurahan.kelurahan ASC;"
                                        );

                                        $xKelurahan = $resultKelurahan->num_rows();

                                        if ($xKelurahan > 0)
                                        {
                                            foreach ($resultKelurahan->result() as $dataKelurahan)
                                            {
                                                $dataArrayKelurahan[] = array(
                                                    "IdKelurahan" => $dataKelurahan->IdKelurahan,
                                                    "Kelurahan" => ucwords(strtolower($dataKelurahan->Kelurahan))
                                                );
                                            }
                                        }

                                        $dataArrayKecamatan[] = array(
                                            "IdKecamatan" => $dataKecamatan->IdKecamatan,
                                            "Kecamatan" => ucwords(strtolower($dataKecamatan->Kecamatan)),
                                            "DataKelurahan" => $dataArrayKelurahan
                                        );
                                    }
                                }

                                $dataArrayKota[] = array(
                                    "IdKota" => $dataKota->IdKota,
                                    "Kota" => ucwords(strtolower($dataKota->Kota)),
                                    "DataKecamatan" => $dataArrayKecamatan
                                );
                            #}
                        }
                    }

                    $dataArrayProvinsi[] = array(
                        "IdProvinsi" => $dataProvinsi->IdProvinsi,
                        "Provinsi" => $dataProvinsi->Provinsi,
                        "DataKota" => $dataArrayKota
                    );
                }
            }

            $result = $dataArrayProvinsi;
            return $result;
        }

        function GetDapil_v1 ()
        {
            # query mysql
            $result = $this->db->query(
                "SELECT
                 tbl_dapil.id AS `Dapil_IdDapil`,
                 tbl_dapil.idkota AS `Dapil_IdKotaDapil`,
                 tbl_dapil.namadapil AS `Dapil_NamaDapil`
                 FROM
                 tbl_dapil
                 ORDER BY
                 tbl_dapil.namadapil ASC;"
            );

            # query postgre sql
            /*$result = $this->db->query(
                'SELECT
                 tbl_dapil.id AS "Dapil_IdDapil",
                 tbl_dapil.idkota AS "Dapil_IdKotaDapil",
                 tbl_dapil.namadapil AS "Dapil_NamaDapil"
                 FROM
                 tbl_dapil
                 ORDER BY
                 tbl_dapil.namadapil ASC;'
            );*/

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Tampilkan Semua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Dapil_IdDapil.'">'.$data->Dapil_NamaDapil.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
                }
            }

            return $result;
        }

        function GetProvinsi ()
        {
            $result = $this->db->query(
                "SELECT
                    id AS `Provinsi_IdProvinsi`,
                    provinsi AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_provinsi
                 ORDER BY
                    provinsi ASC;"
            );

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Provinsi_IdProvinsi == @$_SESSION["User_IdProvinsi"])
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    echo '<option value="'.$data->Provinsi_IdProvinsi.'" '.$IsSelected.'>'.$data->Provinsi_NamaProvinsi.'</option>';
                }
            }

            return $result;
        }

        function GetProvinsi2 ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_provinsi.id AS "Provinsi_IdProvinsi",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_provinsi
                 ORDER BY
                 tbl_provinsi.provinsi ASC;'
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
                    echo '<option value="'.$data->Provinsi_IdProvinsi.'">'.$data->Provinsi_NamaProvinsi.'</option>';
                }
            }

            return $result;
        }

        function GetProvinsi3 ($IdProvinsi)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_provinsi.id AS "Provinsi_IdProvinsi",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_provinsi
                 ORDER BY
                 tbl_provinsi.provinsi ASC;'
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

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Provinsi_IdProvinsi == $IdProvinsi)
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    echo '<option value="'.$data->Provinsi_IdProvinsi.'" '.$IsSelected.'>'.$data->Provinsi_NamaProvinsi.'</option>';
                }
            }

            return $result;
        }

        function GetProvinsi4 ($IdProvinsi)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_provinsi.id AS "Provinsi_IdProvinsi",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi",
                 tbl_provinsi.idwilayah AS "Provinsi_IdWilayah"
                 FROM
                 tbl_provinsi
                 WHERE
                 tbl_provinsi.id = \''.$IdProvinsi.'\';'
            );
            /*$result = $this->db->query(
                "SELECT
                 id AS `Provinsi_IdProvinsi`,
                 provinsi AS `Provinsi_NamaProvinsi`,
                 idwilayah AS `Provinsi_IdWilayah`
                 FROM
                 tbl_provinsi
                 WHERE
                 id = '$IdProvinsi';"
            );*/

            if($result->num_rows() == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Form Provinsi</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_Provinsi_IdProvinsi" value="'.$data->Provinsi_IdProvinsi.'" hidden/>';

                    echo '<label for="idwilayah">Nama Provinsi</label>';
                    echo '<input type="text" id="provinsi" name="text_Provinsi_NamaProvinsi" class="form-control" style="margin-bottom: 15px;" value="'.$data->Provinsi_NamaProvinsi.'" placeholder="..." required autofocus />';

                    echo '<label for="idwilayah">Wilayah</label>';
                    echo '<select id="idwilayah" name="spinner_Provinsi_IdWilayah" class="form-control" style="width: 150px; margin-right: 10px;" required>';
                        echo '<option value="" selected>Pilih</option>';
                        switch ($data->Provinsi_IdWilayah)
                        {
                            case 1:
                                echo '<option value="1" selected>Sumatera</option>';
                                echo '<option value="2">Jawa - Bali</option>';
                                echo '<option value="3">Kalimantan</option>';
                                echo '<option value="4">Wilayah Timur</option>';
                                break;
                            case 2:
                                echo '<option value="1">Sumatera</option>';
                                echo '<option value="2" selected>Jawa - Bali</option>';
                                echo '<option value="3">Kalimantan</option>';
                                echo '<option value="4">Wilayah Timur</option>';
                                break;
                            case 3:
                                echo '<option value="1">Sumatera</option>';
                                echo '<option value="2">Jawa - Bali</option>';
                                echo '<option value="3" selected>Kalimantan</option>';
                                echo '<option value="4">Wilayah Timur</option>';
                                break;
                            case 4:
                                echo '<option value="1">Sumatera</option>';
                                echo '<option value="2">Jawa - Bali</option>';
                                echo '<option value="3">Kalimantan</option>';
                                echo '<option value="4" selected>Wilayah Timur</option>';
                                break;
                            default:
                                echo '<option value="1">Sumatera</option>';
                                echo '<option value="2">Jawa - Bali</option>';
                                echo '<option value="3">Kalimantan</option>';
                                echo '<option value="4">Wilayah Timur</option>';
                                break;
                        }
                    echo '</select>';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function GetProvinsi5 ($IdKota)
        {
            $result = $this->db->query(
                "SELECT
                    idprovinsi AS `Kota_IdProvinsi`
                 FROM
                    tbl_kota
                 WHERE
                    id = '$IdKota';"
            );

            if($result->num_rows() == 1)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Kota_IdProvinsi = $data->Kota_IdProvinsi;

                    $result = $this->db->query(
                        "SELECT
                            id AS `Provinsi_IdProvinsi`,
                            provinsi AS `Provinsi_NamaProvinsi`
                         FROM
                            tbl_provinsi
                         ORDER BY
                            provinsi ASC;"
                    );

                    echo '<option value="0" selected>Pilih</option>';

                    foreach ($result->result() as $data)
                    {
                        $IsSelected;
                        if ($data->Provinsi_IdProvinsi == $Var_Kota_IdProvinsi)
                        {
                            $IsSelected = "selected";
                        }
                        else
                        {
                            $IsSelected = "";
                        }

                        echo '<option value="'.$data->Provinsi_IdProvinsi.'" '.$IsSelected.'>'.$data->Provinsi_NamaProvinsi.'</option>';
                    }
                }
            }

            return $result;
        }

        function GetProvinsi6 ()
        {
            $result = $this->db->query(
                "SELECT
                 provinsi.id AS `Provinsi_Id`,
                 provinsi.provinsi AS `Provinsi_NamaProvinsi`
                 FROM
                 tbl_provinsi AS provinsi
                 ORDER BY
                 provinsi.provinsi ASC;"
            );

            $x = $result->num_rows();

            $xdata;
            $ydata = array();

            if ($x > 0)
            {
                $ydata[] = array(
                    "Provinsi_Id" => "0",
                    "Provinsi_NamaProvinsi" => "Pilih"
                );

                foreach ($result->result() as $data)
                {
                    $ydata[] = array(
                        "Provinsi_Id" => $data->Provinsi_Id,
                        "Provinsi_NamaProvinsi" => $data->Provinsi_NamaProvinsi
                    );
                    # ucwords(strtolower($data->Provinsi_NamaProvinsi))
                }

                $xdata = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data Provinsi se-Indonesia.",
                    "Response_Data" => $ydata
                );
            }
            else
            {
                $xdata = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Unable to load Provinsi."
                );
            }

            $result = $xdata;
            return $result;
            #return $result->result();
        }

        function GetKota ($IdProvinsi)
        {
            $result = $this->db->query(
                "SELECT
                    id AS `Kota_IdKota`,
                    kategori AS `Kota_KategoriKota`,
                    kota AS `Kota_NamaKota`
                 FROM
                    tbl_kota
                 WHERE
                    idprovinsi = '$IdProvinsi'
                 ORDER BY
                    kota ASC,
                    kategori ASC;"
            );

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Kota_IdKota == @$_SESSION["User_IdKota"])
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    $KategoriKota = $data->Kota_KategoriKota;
                    $NamaKota;
                    if ($KategoriKota == NULL)
                    {
                        $NamaKota = "";
                    }
                    else
                    {
                        $NamaKota = $KategoriKota . " " . $data->Kota_NamaKota;
                    }

                    echo '<option value="'.$data->Kota_IdKota.'" '.$IsSelected.'>'.$NamaKota.'</option>';
                }
            }

            return $result;
        }

        function GetKota2 ($IdProvinsi, $IdKota)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kota.id AS "Kota_IdKota",
                 tbl_kota.kategori AS "Kota_KategoriKota",
                 tbl_kota.kota AS "Kota_NamaKota"
                 FROM
                 tbl_kota
                 WHERE
                 tbl_kota.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kota_IdKota`,
                    kategori AS `Kota_KategoriKota`,
                    kota AS `Kota_NamaKota`
                 FROM
                    tbl_kota
                 WHERE
                    idprovinsi = '$IdProvinsi'
                 ORDER BY
                    kota ASC,
                    kategori ASC;"
            );*/

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Kota_IdKota == $IdKota)
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    $KategoriKota = $data->Kota_KategoriKota;
                    $NamaKota;
                    if ($KategoriKota == NULL)
                    {
                        $NamaKota = "";
                    }
                    else
                    {
                        $NamaKota = $KategoriKota . " " . $data->Kota_NamaKota;
                    }

                    echo '<option value="'.$data->Kota_IdKota.'" '.$IsSelected.'>'.$NamaKota.'</option>';
                }
            }

            return $result;
        }

        function GetKota3 ($IdKota)
        {
            $result = $this->db->query(
                'SELECT
                 id AS "Kota_IdKota",
                 kategori AS "Kota_KategoriKota",
                 kota AS "Kota_NamaKota",
                 idprovinsi AS "Provinsi_IdProvinsi"
                 FROM
                 tbl_kota
                 WHERE
                 id = \''.$IdKota.'\';'
            );
            /*$result = $this->db->query(
                "SELECT
                 id AS `Kota_IdKota`,
                 kategori AS `Kota_KategoriKota`,
                 kota AS `Kota_NamaKota`,
                 idprovinsi AS `Provinsi_IdProvinsi`
                 FROM
                 tbl_kota
                 WHERE
                 id = '$IdKota';"
            );*/

            if($result->num_rows() == 1)
            {
                foreach ($result->result() as $data)
                {
                    #
                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Form Kab./Kota</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_Kota_IdKota" value="'.$IdKota.'" hidden/>';

                    echo '<label for="provinsi">Provinsi</label>';
                    echo '<select id="provinsi" name="spinner_Provinsi_IdProvinsi" class="form-control" style="width: 100%; margin-bottom: 25px; margin-right: 0px;" required>';
                          $this->m_wilayah->GetProvinsi3($data->Provinsi_IdProvinsi);
                    echo '</select>';

                    echo '<label for="kota">Kategori</label>';
                    echo '<table style="margin-bottom: 0px;">';
                          echo '<th>';
                            echo '<select id="borndatemm" name="spinner_Kota_KategoriKota" class="form-control" style="width: 150px; margin-right: 10px;" required>';
                                  echo '<option value="" selected>Pilih</option>';
                                  switch ($data->Kota_KategoriKota)
                                  {
                                      case "Kab.":
                                          echo '<option value="Kab." selected>Kabupaten</option>';
                                          echo '<option value="Kota">Kota</option>';
                                          break;
                                      case "Kota":
                                          echo '<option value="Kab.">Kabupaten</option>';
                                          echo '<option value="Kota" selected>Kota</option>';
                                          break;
                                      default:
                                          echo '<option value="Kab.">Kabupaten</option>';
                                          echo '<option value="Kota">Kota</option>';
                                          break;
                                  }
                              echo '</select>';
                          echo '</th>';
                          echo '<th width="100%">';
                              echo '<input type="text" id="kota" class="form-control" name="text_Kota_NamaKota" data-parsley-trigger="change" value="'.$data->Kota_NamaKota.'" placeholder="nama kab. / kota" style="width: 100%; text-align: left;" required autofocus />';
                          echo '</th>';
                    echo '</table>';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function GetKota4 ($IdProvinsi)
        {
            $result = $this->db->query(
                "SELECT
                 kota.idprovinsi AS `Provinsi_Id`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                 kota.id AS `Kota_Id`,
                 kota.kota AS `Kota_NamaKota`
                 FROM
                 tbl_kota AS kota
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 WHERE
                 kota.idprovinsi = '$IdProvinsi'
                 ORDER BY
                 provinsi.provinsi ASC,
                 kota.kota ASC;"
            );

            $xdata;
            $ydata = array();

            $x = $result->num_rows();

            if ($x > 0)
            {
                $xidprovinsi = "";
                $xnamaprovinsi = "";

                $ydata[] = array(
                    "Kota_Id" => "0",
                    "Kota_NamaKota" => "Pilih"
                );

                foreach ($result->result() as $data)
                {
                    $xidprovinsi = $data->Provinsi_Id;
                    $xnamaprovinsi = $data->Provinsi_NamaProvinsi;

                    $ydata[] = array(
                        "Kota_Id" => $data->Kota_Id,
                        "Kota_NamaKota" => ucwords(strtolower($data->Kota_NamaKota))
                    );
                }

                $xnamaprovinsi = ucwords(strtolower($xnamaprovinsi));

                $xdata = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data Kab./Kota se-Prov. " . $xnamaprovinsi,
                    
                    "Provinsi_Id" => $xidprovinsi,
                    "Provinsi_NamaProvinsi" => $xnamaprovinsi,

                    "Response_Data" => $ydata
                );
            }
            else
            {
                $xdata = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Unable to load Kab/Kota."
                );
            }

            $result = $xdata;
            return $result;
        }

        function GetKotaOnAjax ($IdProvinsi)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kota.id AS "Kota_IdKota",
                 tbl_kota.kategori AS "Kota_KategoriKota",
                 tbl_kota.kota AS "Kota_NamaKota"
                 FROM
                 tbl_kota
                 WHERE
                 tbl_kota.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kota_IdKota`,
                    kategori AS `Kota_KategoriKota`,
                    kota AS `Kota_NamaKota`
                 FROM
                    tbl_kota
                 WHERE
                    idprovinsi = '$IdProvinsi'
                 ORDER BY
                    kota ASC,
                    kategori ASC;"
            );*/

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $KategoriKota = $data->Kota_KategoriKota;
                    $NamaKota;
                    if ($KategoriKota == NULL)
                    {
                        $NamaKota = "";
                    }
                    else
                    {
                        $NamaKota = $KategoriKota . " " . $data->Kota_NamaKota;
                    }

                    echo '<option value="'.$data->Kota_IdKota.'">'.$NamaKota.'</option>';
                }
            }

            return $result;
        }

        function GetKotaOnAjax_v2 ($IdProvinsi)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kota.id AS "Kota_IdKota",
                 tbl_kota.kategori AS "Kota_KategoriKota",
                 tbl_kota.kota AS "Kota_NamaKota"
                 FROM
                 tbl_kota
                 WHERE
                 tbl_kota.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kota_IdKota`,
                    kategori AS `Kota_KategoriKota`,
                    kota AS `Kota_NamaKota`
                 FROM
                    tbl_kota
                 WHERE
                    idprovinsi = '$IdProvinsi'
                 ORDER BY
                    kota ASC,
                    kategori ASC;"
            );*/

            if($result->num_rows() >= 0)
            {
                echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">';
                    echo '<input id="icItemKota" name="checkbox_User_Kota" type="checkbox" style="margin-right: 10px;" value="" checked />';
                    echo '<label style="margin-right: 5px;margin-top: 1.50px;">Default</label>';
                echo '</div>';

                foreach ($result->result() as $data)
                {
                    $IdKota = $data->Kota_IdKota;
                    $KategoriKota = $data->Kota_KategoriKota;
                    $NamaKota;
                    if ($KategoriKota == NULL)
                    {
                        $NamaKota = "";
                    }
                    else
                    {
                        $NamaKota = $KategoriKota . " " . $data->Kota_NamaKota;
                    }

                    echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">';
                        echo '<input id="icItemKota" name="checkbox_User_Kota" type="checkbox" style="margin-right: 10px;" value="'.$IdKota.'" onclick="AddIdKota(\''.$IdKota.'\')"/>';
                        echo '<label style="margin-right: 5px;margin-top: 1.50px;">'.$NamaKota.'</label>';
                    echo '</div>';
                }

                #echo '<div id="chipreset" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()">';
                    #echo '<label style="margin-right: 5px;margin-top: 1.50px;">Reset</label>';
                #echo '</div>';
            }

            return $result;
        }

        function GetKotaOnAjax_v3 ($IdProvinsi, $Dapil_IdKota)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kota.id AS "Kota_IdKota",
                 tbl_kota.kategori AS "Kota_KategoriKota",
                 tbl_kota.kota AS "Kota_NamaKota"
                 FROM
                 tbl_kota
                 WHERE
                 tbl_kota.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kota_IdKota`,
                    kategori AS `Kota_KategoriKota`,
                    kota AS `Kota_NamaKota`
                 FROM
                    tbl_kota
                 WHERE
                    idprovinsi = '$IdProvinsi'
                 ORDER BY
                    kota ASC,
                    kategori ASC;"
            );*/

            if($result->num_rows() >= 0)
            {
                echo '<div id="dchipkota">';
                    echo '<label for="chipkota">Kab. / Kota</label>';
                    echo '<div id="chipkota" class="flexp" style="margin-bottom: 0px;">';
                    foreach ($result->result() as $data)
                    {
                        $IdKota = $data->Kota_IdKota;
                        $KategoriKota = $data->Kota_KategoriKota;
                        $NamaKota;
                        if ($KategoriKota == NULL)
                        {
                            $NamaKota = "";
                        }
                        else
                        {
                            $NamaKota = $KategoriKota . " " . $data->Kota_NamaKota;
                        }

                        echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;">';
                            echo '<input id="icItemKota" name="checkbox_User_Kota" type="checkbox" style="margin-right: 10px;" value="'.$IdKota.'" onclick="AddIdKota(\''.$IdKota.'\')"/>';
                            echo '<label style="margin-right: 5px;margin-top: 1.50px;">'.$NamaKota.'</label>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '<div id="chipreset" class="chip2" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()" hidden>';
                        echo '<label style="color:white; margin-right:0px; margin-top:0px;">Reset</label>';
                    echo '</div>';
                    echo '<input type="text" id="tchipkota" name="text_User_tChipKota" class="form-control" style="text-align: left; margin-bottom: 15px;" value="'.$Dapil_IdKota.'" placeholder="..." hidden />';
                echo '</div>';

                #echo '<div id="chipreset" class="chip2" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()">';
                    #echo '<label style="color:white; margin-right:0px; margin-top:0px;">Reset</label>';
                #echo '</div>';
                #echo '<div id="chipreset" class="chip2" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()" hidden>';
                    #echo '<label style="color:white; margin-right:0px; margin-top:0px;">Reset</label>';
                #echo '</div>';
            }

            #return $result;
        }

        function GetKotaOnAjax_v4 ($IdProvinsi)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_dapil.id AS "Dapil_IdDapil",
                 tbl_dapil.namadapil AS "Dapil_NamaDapil"
                 FROM
                 tbl_dapil
                 WHERE
                 tbl_dapil.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_dapil.namadapil ASC;'
            );

            $x = $result->num_rows();

            if ($x >= 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Dapil_IdDapil = $data->Dapil_IdDapil;
                    $Var_Dapil_NamaDapil = $data->Dapil_NamaDapil;
                    #$IdKota = $data->Kota_IdKota;

                    echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="AddIdDapil(\''.$Var_Dapil_IdDapil.'\')">';
                        echo '<input type="radio" class="flat" name="radio_User_NamaDapil" id="icItemDapil" value="'.$Var_Dapil_IdDapil.'" style="margin-left: 0px;" onclick="AddIdDapil(\''.$Var_Dapil_IdDapil.'\')" />&nbsp;'.$Var_Dapil_NamaDapil;
                        #&nbsp;Perempuan
                        #echo '<input id="icItemKota" name="checkbox_User_Kota" type="checkbox" style="margin-right: 10px;" value="'.$IdKota.'" onclick="AddIdKota(\''.$IdKota.'\')"/>';
                        #echo '<label style="margin-right: 5px;margin-top: 1.50px;">'.$Var_Dapil_NamaDapil.'</label>';
                    echo '</div>';
                }

                #echo '<div id="chipreset" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="ResetChipsKota()">';
                    #echo '<label style="margin-right: 5px;margin-top: 1.50px;">Reset</label>';
                #echo '</div>';
            }

            return $result;
        }

        function GetKotaOnAjax_v5 ($IdProvinsi, $Caleg_IdDapil)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_dapil.id AS "Dapil_IdDapil",
                 tbl_dapil.namadapil AS "Dapil_NamaDapil"
                 FROM
                 tbl_dapil
                 WHERE
                 tbl_dapil.idprovinsi = \''.$IdProvinsi.'\'
                 ORDER BY
                 tbl_dapil.namadapil ASC;'
            );

            $x = $result->num_rows();

            if ($x >= 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Dapil_IdDapil = $data->Dapil_IdDapil;
                    $Var_Dapil_NamaDapil = $data->Dapil_NamaDapil;

                    if ($Var_Dapil_IdDapil == $Caleg_IdDapil)
                    {
                        echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="AddIdDapil(\''.$Var_Dapil_IdDapil.'\')">';
                            echo '<input type="radio" class="flat" name="radio_User_NamaDapil" id="icItemDapil" value="'.$Var_Dapil_IdDapil.'" style="margin-left: 0px;" onclick="AddIdDapil(\''.$Var_Dapil_IdDapil.'\')" checked />&nbsp;'.$Var_Dapil_NamaDapil;
                        echo '</div>';
                    }
                    else
                    {
                        echo '<div id="chipx" class="chip" style="font-size: 12px; margin-bottom: 15px; margin-right: 15px;" onclick="AddIdDapil(\''.$Var_Dapil_IdDapil.'\')">';
                            echo '<input type="radio" class="flat" name="radio_User_NamaDapil" id="icItemDapil" value="'.$Var_Dapil_IdDapil.'" style="margin-left: 0px;" onclick="AddIdDapil(\''.$Var_Dapil_IdDapil.'\')" />&nbsp;'.$Var_Dapil_NamaDapil;
                        echo '</div>';
                    }
                }
            }

            return $result;
        }

        function GetKecamatan ($IdProvinsi, $IdKota)
        {
            $result = $this->db->query(
                "SELECT
                    id AS `Kecamatan_IdKecamatan`,
                    kecamatan AS `Kecamatan_NamaKecamatan`
                 FROM
                    tbl_kecamatan
                 WHERE
                    idprovinsi = '$IdProvinsi' AND
                    idkota = '$IdKota'
                 ORDER BY
                    kecamatan ASC;"
            );

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Kecamatan_IdKecamatan == @$_SESSION["User_IdKecamatan"])
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    echo '<option value="'.$data->Kecamatan_IdKecamatan.'" '.$IsSelected.'>'.$data->Kecamatan_NamaKecamatan.'</option>';
                }
            }

            return $result;
        }

        function GetKecamatan2 ($IdProvinsi, $IdKota, $IdKecamatan)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kecamatan.id AS "Kecamatan_IdKecamatan",
                 tbl_kecamatan.kecamatan AS "Kecamatan_NamaKecamatan"
                 FROM
                 tbl_kecamatan
                 WHERE
                 tbl_kecamatan.idprovinsi = \''.$IdProvinsi.'\' AND
                 tbl_kecamatan.idkota = \''.$IdKota.'\'
                 ORDER BY
                 tbl_kecamatan.kecamatan ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kecamatan_IdKecamatan`,
                    kecamatan AS `Kecamatan_NamaKecamatan`
                 FROM
                    tbl_kecamatan
                 WHERE
                    idprovinsi = '$IdProvinsi' AND
                    idkota = '$IdKota'
                 ORDER BY
                    kecamatan ASC;"
            );*/

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Kecamatan_IdKecamatan == $IdKecamatan)
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    echo '<option value="'.$data->Kecamatan_IdKecamatan.'" '.$IsSelected.'>'.$data->Kecamatan_NamaKecamatan.'</option>';
                }
            }

            return $result;
        }

        function GetKecamatan3 ($IdKecamatan)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kecamatan.id AS "Kecamatan_IdKecamatan",
                 tbl_kecamatan.idprovinsi AS "Kecamatan_IdProvinsi",
                 tbl_kecamatan.idkota AS "Kecamatan_IdKota",
                 tbl_kecamatan.kecamatan AS "Kecamatan_NamaKecamatan"
                 FROM
                 tbl_kecamatan
                 WHERE
                 tbl_kecamatan.id = \''.$IdKecamatan.'\';'
            );
            /*$result = $this->db->query(
                "SELECT
                 id AS `Kecamatan_IdKecamatan`,
                 idprovinsi AS `Kecamatan_IdProvinsi`,
                 idkota AS `Kecamatan_IdKota`,
                 kecamatan AS `Kecamatan_NamaKecamatan`
                 FROM
                 tbl_kecamatan
                 WHERE
                 id = '$IdKecamatan';"
            );*/

            if ($result->num_rows() == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Form Kecamatan</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_Kecamatan_IdKecamatan" value="'.$data->Kecamatan_IdKecamatan.'" hidden/>';

                    echo '<label for="spinnerprovinsi">Provinsi</label>';
                    echo '<select id="spinnerprovinsi" name="spinner_Provinsi_IdProvinsi" class="form-control" style="width: 100%; margin-bottom: 25px; margin-right: 0px;" required onclick="LoadProvinsiOnSelected()">';
                          $this->m_wilayah->GetProvinsi3($data->Kecamatan_IdProvinsi);
                    echo '</select>';

                    echo '<label for="spinnerkota">Kab. / Kota</label>';
                    echo '<select id="spinnerkota" name="spinner_Kota_IdKota" class="form-control" style="margin-bottom: 15px;" required>';
                          $this->m_wilayah->GetKota2($data->Kecamatan_IdProvinsi, $data->Kecamatan_IdKota);
                    echo '</select>';

                    echo '<label for="kecamatan">Kecamatan</label>';
                    echo '<input type="text" id="kecamatan" name="text_Kecamatan_NamaKecamatan" class="form-control" style="margin-bottom: 15px;" value="'.$data->Kecamatan_NamaKecamatan.'" placeholder="..." required autofocus />';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function GetKecamatan4 ($IdProvinsi, $IdKota)
        {
            $result = $this->db->query(
                "SELECT
                 IF(provinsi.id = NULL, '0', provinsi.id) AS `Provinsi_Id`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                 kecamatan.idkota AS `Kota_Id`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Kota_NamaKota`,
                 kecamatan.id AS `Kecamatan_Id`,
                 kecamatan.kecamatan AS `Kecamatan_NamaKecamatan`
                 FROM
                 tbl_kecamatan AS kecamatan
                 LEFT JOIN
                 tbl_kota AS kota ON kecamatan.idkota = kota.id
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 WHERE
                 kecamatan.idkota = '$IdKota' AND
                 kota.idprovinsi = '$IdProvinsi'
                 ORDER BY
                 provinsi.provinsi ASC,
                 kota.kota ASC,
                 kecamatan.kecamatan ASC;"
            );

            $xdata;
            $ydata = array();

            $x = $result->num_rows();

            if ($x > 0)
            {
                $xidprovinsi = "";
                $xnamaprovinsi = "";

                $xidkota = "";
                $xnamakota = "";

                $ydata[] = array(
                    "Kecamatan_Id" => "0",
                    "Kecamatan_NamaKecamatan" => "Pilih"
                );

                foreach ($result->result() as $data)
                {
                    $xidprovinsi = $data->Provinsi_Id;
                    $xnamaprovinsi = $data->Provinsi_NamaProvinsi;

                    $xidkota = $data->Kota_Id;
                    $xnamakota = $data->Kota_NamaKota;

                    $ydata[] = array(
                        "Kecamatan_Id" => $data->Kecamatan_Id,
                        "Kecamatan_NamaKecamatan" => ucwords(strtolower($data->Kecamatan_NamaKecamatan))
                    );
                }

                $xnamaprovinsi = ucwords(strtolower($xnamaprovinsi));
                $xnamakota = ucwords(strtolower($xnamakota));

                $xdata = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data Kecamatan Se-" . $xnamakota . " di Prov. " . $xnamaprovinsi,
                    
                    "Provinsi_Id" => $xidprovinsi,
                    "Provinsi_NamaProvinsi" => $xnamaprovinsi,

                    "Kota_Id" => $xidkota,
                    "Kota_NamaKota" => $xnamakota,

                    "Response_Data" => $ydata
                );
            }
            else
            {
                $xdata = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Unable to load Kecamatan."
                );
            }

            $result = $xdata;
            return $result;
        }

        function GetKecamatanOnAjax ($IdProvinsi, $IdKota)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kecamatan.id AS "Kecamatan_IdKecamatan",
                 tbl_kecamatan.kecamatan AS "Kecamatan_NamaKecamatan"
                 FROM
                 tbl_kecamatan
                 WHERE
                 tbl_kecamatan.idprovinsi = \''.$IdProvinsi.'\' AND
                 tbl_kecamatan.idkota = \''.$IdKota.'\'
                 ORDER BY
                 tbl_kecamatan.kecamatan ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kecamatan_IdKecamatan`,
                    kecamatan AS `Kecamatan_NamaKecamatan`
                 FROM
                    tbl_kecamatan
                 WHERE
                    idprovinsi = '$IdProvinsi' AND
                    idkota = '$IdKota'
                 ORDER BY
                    kecamatan ASC;"
            );*/

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Kecamatan_IdKecamatan.'">'.$data->Kecamatan_NamaKecamatan.'</option>';
                }
            }

            return $result;
        }

        function GetKelurahan ($IdProvinsi, $IdKota, $IdKecamatan)
        {
            $result = $this->db->query(
                "SELECT
                    id AS `Kelurahan_IdKelurahan`,
                    kelurahan AS `Kelurahan_NamaKelurahan`
                 FROM
                    tbl_kelurahan
                 WHERE
                    idprovinsi = '$IdProvinsi' AND
                    idkota = '$IdKota' AND
                    idkecamatan = '$IdKecamatan'
                 ORDER BY
                    kelurahan ASC;"
            );

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Kelurahan_IdKelurahan == @$_SESSION["User_IdKelurahan"])
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    echo '<option value="'.$data->Kelurahan_IdKelurahan.'" '.$IsSelected.'>'.$data->Kelurahan_NamaKelurahan.'</option>';
                }
            }

            return $result;
        }

        function GetKelurahan2 ($IdProvinsi, $IdKota, $IdKecamatan, $IdKelurahan)
        {
            $result = $this->db->query(
                "SELECT
                    id AS `Kelurahan_IdKelurahan`,
                    kelurahan AS `Kelurahan_NamaKelurahan`
                 FROM
                    tbl_kelurahan
                 WHERE
                    idprovinsi = '$IdProvinsi' AND
                    idkota = '$IdKota' AND
                    idkecamatan = '$IdKecamatan'
                 ORDER BY
                    kelurahan ASC;"
            );

            if($result->num_rows() >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    $IsSelected;
                    if ($data->Kelurahan_IdKelurahan == $IdKelurahan)
                    {
                        $IsSelected = "selected";
                    }
                    else
                    {
                        $IsSelected = "";
                    }

                    echo '<option value="'.$data->Kelurahan_IdKelurahan.'" '.$IsSelected.'>'.$data->Kelurahan_NamaKelurahan.'</option>';
                }
            }

            return $result;
        }

        function GetKelurahan3 ($IdKelurahan)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kelurahan.id AS "Kelurahan_IdKelurahan",
                 tbl_kelurahan.idprovinsi AS "Kelurahan_IdProvinsi",
                 tbl_kelurahan.idkota AS "Kelurahan_IdKota",
                 tbl_kelurahan.idkecamatan AS "Kelurahan_IdKecamatan",
                 tbl_kelurahan.kelurahan AS "Kelurahan_NamaKelurahan"
                 FROM
                 tbl_kelurahan
                 WHERE
                 tbl_kelurahan.id = \''.$IdKelurahan.'\';'
            );
            /*$result = $this->db->query(
                "SELECT
                 id AS `Kelurahan_IdKelurahan`,
                 idprovinsi AS `Kelurahan_IdProvinsi`,
                 idkota AS `Kelurahan_IdKota`,
                 idkecamatan AS `Kelurahan_IdKecamatan`,
                 kelurahan AS `Kelurahan_NamaKelurahan`
                 FROM
                 tbl_kelurahan
                 WHERE
                 id = '$IdKelurahan';"
            );*/

            $x = $result->num_rows();

            if($x == 1)
            {
                foreach ($result->result() as $data)
                {
                    echo '<label style="font-size: 20px; margin-bottom: 15px;">Form Kelurahan</label>';
                    echo '<div class="clearfix"></div>';

                    echo '<input type="text" name="text_Kelurahan_IdKelurahan" value="'.$data->Kelurahan_IdKelurahan.'" hidden/>';

                    echo '<label for="spinnerprovinsi">Provinsi</label>';
                    echo '<select id="spinnerprovinsi" name="spinner_Provinsi_IdProvinsi" class="form-control" style="width: 100%; margin-bottom: 25px; margin-right: 0px;" onclick="LoadProvinsiOnSelected()" required>';
                        $this->m_wilayah->GetProvinsi3($data->Kelurahan_IdProvinsi);
                    echo '</select>';

                    echo '<label for="spinnerkota">Kab. / Kota</label>';
                    echo '<select id="spinnerkota" name="spinner_Kota_IdKota" class="form-control" style="margin-bottom: 15px;" required>';
                        $this->m_wilayah->GetKota2($data->Kelurahan_IdProvinsi, $data->Kelurahan_IdKota);
                    echo '</select>';

                    echo '<label for="spinnerkecamatan">Kecamatan</label>';
                    echo '<select id="spinnerkecamatan" name="spinner_Kecamatan_IdKecamatan" class="form-control" style="margin-bottom: 15px;" required>';
                        $this->m_wilayah->GetKecamatan2($data->Kelurahan_IdProvinsi, $data->Kelurahan_IdKota, $data->Kelurahan_IdKecamatan);
                    echo '</select>';

                    echo '<label for="kelurahan">Kelurahan</label>';
                    echo '<input type="text" id="kelurahan" name="text_Kelurahan_NamaKelurahan" class="form-control" style="margin-bottom: 15px;" value="'.$data->Kelurahan_NamaKelurahan.'" placeholder="..." required autofocus />';

                    echo '<br/>';
                    echo '<input type="submit" class="btn btn-primary" value="Update"/>';
                }
            }

            return $result;
        }

        function GetKelurahan4 ($IdProvinsi, $IdKota, $IdKecamatan)
        {
            $result = $this->db->query(
                "SELECT
                 IF(provinsi.id = NULL, '0', provinsi.id) AS `Provinsi_Id`,
                 IF(provinsi.provinsi = NULL, '', provinsi.provinsi) AS `Provinsi_NamaProvinsi`,
                 kecamatan.idkota AS `Kota_Id`,
                 IF(kota.kota = NULL, '', kota.kota) AS `Kota_NamaKota`,
                 kelurahan.idkecamatan AS `Kecamatan_Id`,
                 IF(kecamatan.kecamatan = NULL, '', kecamatan.kecamatan) AS `Kecamatan_NamaKecamatan`,
                 kelurahan.id AS `Kelurahan_Id`,
                 kelurahan.kelurahan AS `Kelurahan_NamaKelurahan`
                 FROM
                 tbl_kelurahan AS kelurahan
                 LEFT JOIN
                 tbl_kecamatan AS kecamatan ON kelurahan.idkecamatan = kecamatan.id
                 LEFT JOIN
                 tbl_kota AS kota ON kecamatan.idkota = kota.id
                 LEFT JOIN
                 tbl_provinsi AS provinsi ON kota.idprovinsi = provinsi.id
                 WHERE
                 kelurahan.idkecamatan = '$IdKecamatan' AND
                 kecamatan.idkota = '$IdKota' AND
                 kota.idprovinsi = '$IdProvinsi'
                 ORDER BY
                 provinsi.provinsi ASC,
                 kota.kota ASC,
                 kecamatan.kecamatan ASC,
                 kelurahan.kelurahan ASC;"
            );

            $xdata;
            $ydata = array();

            $x = $result->num_rows();

            if ($x > 0)
            {
                $xidprovinsi = "";
                $xnamaprovinsi = "";

                $xidkota = "";
                $xnamakota = "";

                $xidkecamatan = "";
                $xnamakecamatan = "";

                $ydata[] = array(
                    "Kelurahan_Id" => "0",
                    "Kelurahan_NamaKelurahan" => "Pilih"
                );

                foreach ($result->result() as $data)
                {
                    $xidprovinsi = $data->Provinsi_Id;
                    $xnamaprovinsi = $data->Provinsi_NamaProvinsi;

                    $xidkota = $data->Kota_Id;
                    $xnamakota = $data->Kota_NamaKota;

                    $xidkecamatan = $data->Kecamatan_Id;
                    $xnamakecamatan = $data->Kecamatan_NamaKecamatan;

                    $ydata[] = array(
                        "Kelurahan_Id" => $data->Kelurahan_Id,
                        "Kelurahan_NamaKelurahan" => ucwords(strtolower($data->Kelurahan_NamaKelurahan))
                    );
                }

                $xnamaprovinsi = ucwords(strtolower($xnamaprovinsi));
                $xnamakota = ucwords(strtolower($xnamakota));
                $xnamakecamatan = ucwords(strtolower($xnamakecamatan));

                $xdata = array(
                    "Response_ID" => "1",
                    "Response_Message" => "Data Kelurahan se-Kec. " . $xnamakecamatan . " di " . $xnamakota . ", Prov. " . $xnamaprovinsi,
                    
                    "Provinsi_Id" => $xidprovinsi,
                    "Provinsi_NamaProvinsi" => $xnamaprovinsi,

                    "Kota_Id" => $xidkota,
                    "Kota_NamaKota" => $xnamakota,

                    "Kecamatan_Id" => $xidkecamatan,
                    "Kecamatan_NamaKecamatan" => $xnamakecamatan,

                    "Response_Data" => $ydata
                );
            }
            else
            {
                $xdata = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Unable to load Kecamatan."
                );
            }

            $result = $xdata;
            return $result;
        }

        function GetKelurahanOnAjax ($IdProvinsi, $IdKota, $IdKecamatan)
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kelurahan.id AS "Kelurahan_IdKelurahan",
                 tbl_kelurahan.kelurahan AS "Kelurahan_NamaKelurahan"
                 FROM
                 tbl_kelurahan
                 WHERE
                 tbl_kelurahan.idprovinsi = \''.$IdProvinsi.'\' AND
                 tbl_kelurahan.idkota = \''.$IdKota.'\' AND
                 tbl_kelurahan.idkecamatan = \''.$IdKecamatan.'\'
                 ORDER BY
                 tbl_kelurahan.kelurahan ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Kelurahan_IdKelurahan`,
                    kelurahan AS `Kelurahan_NamaKelurahan`
                 FROM
                    tbl_kelurahan
                 WHERE
                    idprovinsi = '$IdProvinsi' AND
                    idkota = '$IdKota' AND
                    idkecamatan = '$IdKecamatan'
                 ORDER BY
                    kelurahan ASC;"
            );*/

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Kelurahan_IdKelurahan.'">'.$data->Kelurahan_NamaKelurahan.'</option>';
                }
            }

            return $result;
        }

        function GetWilayahIndonesia($IdWilayah)
        {
            $result = $this->db->query(
                'SELECT
                 provinsi AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_provinsi
                 WHERE
                 idwilayah = \''.$IdWilayah.'\'
                 ORDER BY
                 provinsi ASC;'
            );

            /*$result = $this->db->query(
                "SELECT
                    provinsi AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_provinsi
                 WHERE
                    idwilayah = '$IdWilayah'
                 ORDER BY
                    provinsi ASC;"
            );*/

            $x = $result->num_rows();

            /*die(
                'Count '.$x.
                'SELECT
                 provinsi AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_provinsi
                 WHERE
                 idwilayah = \''.$IdWilayah.'\'
                 ORDER BY
                 provinsi ASC;'
            );*/

            #if($result->num_rows() > 0)
            if ($x > 0)
            {
                $NamaWilayah;
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
                        $NamaWilayah = "Wil. Timur";
                        break;
                    default:
                        $NamaWilayah = "";
                        break;
                }

                echo
                '
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-users"></i></div>
                            <!-- <div class="icon"><i class="fa fa-caret-square-o-right"></i></div> -->
                            <h3 style="margin-top: 25px; margin-bottom: 25px;">'.$NamaWilayah.'</h3>
                            <p>';

                            $rowcount = 0;
                            foreach ($result->result() as $data)
                            {
                                if ($rowcount > 0)
                                {
                                    echo ", ";
                                }
                                $rowcount++;

                                echo $data->Provinsi_NamaProvinsi;
                            }

                echo        '</p>
                        </div>
                    </div>
                ';
            }

            return $result;
        }

        function GetWilayahIndonesiaDbAdmin ()
        {
            $result = $this->db->query(
                'SELECT
                 idwilayah AS "Provinsi_IdWilayah"
                 FROM
                 tbl_provinsi
                 GROUP BY
                 idwilayah
                 ORDER BY
                 idwilayah ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    idwilayah AS `Provinsi_IdWilayah`
                 FROM
                    tbl_provinsi
                 GROUP BY
                    idwilayah
                 ORDER BY
                    idwilayah ASC;"
            );*/

            if($result->num_rows() > 0)
            {
                echo '<li><a href="'.site_url("Dashboard/DbAdminAll").'" style="font-family: '."Arial".';"> Tampilkan Semua </a></li>';

                /*foreach ($result->result() as $data)
                {
                    $NamaWilayah;
                    switch ($data->Provinsi_IdWilayah)
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
                            $NamaWilayah = "Wil. Timur";
                            break;
                        default:
                            $NamaWilayah = "";
                            break;
                    }
                    echo '<li><a href="'.site_url("Dashboard/DbAdmin").'/'.$data->Provinsi_IdWilayah.'" style="font-family: '."Arial".';"> '.$NamaWilayah.' </a></li>';
                }*/
            }

            return $result;
        }

        function GetWilayahIndonesiaDbAdmin_v2 ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_provinsi.idwilayah AS "Provinsi_IdWilayah"
                 FROM
                 tbl_provinsi
                 GROUP BY
                 tbl_provinsi.idwilayah
                 ORDER BY
                 tbl_provinsi.idwilayah ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    idwilayah AS `Provinsi_IdWilayah`
                 FROM
                    tbl_provinsi
                 GROUP BY
                    idwilayah
                 ORDER BY
                    idwilayah ASC;"
            );*/

            $x = $result->num_rows();

            #if($result->num_rows() > 0)
            if ($x > 0)
            {
                echo '<li><a href="'.site_url("Admin/DbAdminAll").'" style="font-family: '."Arial".';"> Tampilkan Semua </a></li>';

                foreach ($result->result() as $data)
                {
                    $NamaWilayah;
                    switch ($data->Provinsi_IdWilayah)
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
                            $NamaWilayah = "Wil. Timur";
                            break;
                        default:
                            $NamaWilayah = "";
                            break;
                    }
                    echo '<li><a href="'.site_url("Admin/DbAdmin").'/'.$data->Provinsi_IdWilayah.'" style="font-family: '."Arial".';"> '.$NamaWilayah.' </a></li>';
                }
            }

            return $result;
        }

        function GetWilayahIndonesiaDbSaksiPerindo ()
        {
            $result = $this->db->query(
                'SELECT
                 idwilayah AS "Provinsi_IdWilayah"
                 FROM
                 tbl_provinsi
                 GROUP BY
                 idwilayah
                 ORDER BY
                 idwilayah ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    idwilayah AS `Provinsi_IdWilayah`
                 FROM
                    tbl_provinsi
                 GROUP BY
                    idwilayah
                 ORDER BY
                    idwilayah ASC;"
            );*/

            if($result->num_rows() > 0)
            {
                echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindoAll").'" style="font-family: '."Arial".';"> Tampilkan Semua </a></li>';

                foreach ($result->result() as $data)
                {
                    $NamaWilayah;
                    switch ($data->Provinsi_IdWilayah)
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
                            $NamaWilayah = "Wil. Timur";
                            break;
                        default:
                            $NamaWilayah = "";
                            break;
                    }
                    echo '<li><a href="'.site_url("Dashboard/DbSaksiPerindo").'/'.$data->Provinsi_IdWilayah.'" style="font-family: '."Arial".';"> '.$NamaWilayah.' </a></li>';
                }
            }

            return $result;
        }

        function GetWilayahIndonesiaDbSaksiPerindo_v2 ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_provinsi.idwilayah AS "Provinsi_IdWilayah"
                 FROM
                 tbl_provinsi
                 GROUP BY
                 tbl_provinsi.idwilayah
                 ORDER BY
                 tbl_provinsi.idwilayah ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    idwilayah AS `Provinsi_IdWilayah`
                 FROM
                    tbl_provinsi
                 GROUP BY
                    idwilayah
                 ORDER BY
                    idwilayah ASC;"
            );*/

            $x = $result->num_rows();

            #if($result->num_rows() > 0)
            if ($x > 0)
            {
                echo '<li><a href="'.site_url("Admin/DbSaksiPerindoAll").'" style="font-family: '."Arial".';"> Tampilkan Semua </a></li>';

                foreach ($result->result() as $data)
                {
                    $NamaWilayah;
                    switch ($data->Provinsi_IdWilayah)
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
                            $NamaWilayah = "Wil. Timur";
                            break;
                        default:
                            $NamaWilayah = "";
                            break;
                    }
                    echo '<li><a href="'.site_url("Admin/DbSaksiPerindo").'/'.$data->Provinsi_IdWilayah.'" style="font-family: '."Arial".';"> '.$NamaWilayah.' </a></li>';
                }
            }

            return $result;
        }

        function ListDataKecamatan ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kecamatan.id AS "Kecamatan_IdKecamatan",
                 tbl_kecamatan.kecamatan AS "Kecamatan_NamaKecamatan",

                 tbl_kecamatan.idkota AS "Kota_IdKota",
                 COALESCE(tbl_kota.kategori::varchar(50), \'\') AS "Kota_KategoriKota",
                 COALESCE(tbl_kota.kota::varchar(50), \'\') AS "Kota_NamaKota",

                 tbl_kecamatan.idprovinsi AS "Provinsi_IdProvinsi",
                 COALESCE(tbl_provinsi.provinsi::varchar(50), \'\') AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_kecamatan
                 LEFT JOIN tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                 LEFT JOIN tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 ORDER BY
                 tbl_provinsi.provinsi ASC,
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC,
                 tbl_kecamatan.kecamatan ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    tbl_kecamatan.id AS `Kecamatan_IdKecamatan`,
                    tbl_kecamatan.kecamatan AS `Kecamatan_NamaKecamatan`,

                    tbl_kecamatan.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,

                    tbl_kecamatan.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_kecamatan
                 LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_kecamatan.idprovinsi
                 LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_kecamatan.idkota
                 ORDER BY
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC;"
            );*/

            $x = $result->num_rows();

            if($x > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;

                    $Var_Kota_IdKota = $data->Kota_IdKota;
                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Kota_NamaKota2;
                    if ($Var_Kota_KategoriKota == NULL)
                    {
                        $Var_Kota_NamaKota2 = "" . $Var_Kota_NamaKota;
                    }
                    else
                    {
                        $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    }

                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                    echo '<tr>';
                        echo '<td>' . $Var_Kecamatan_NamaKecamatan . '</td>';
                        echo '<td>' . $Var_Kota_NamaKota2 . '</td>';
                        echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Dashboard/EditKecamatan/'.$Var_Kecamatan_IdKecamatan.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            $Var_Kecamatan_NamaKecamatan = "kec. " . " " . strtolower($Var_Kecamatan_NamaKecamatan);
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Kecamatan_IdKecamatan))).'" href="#" class="btn btn-primary" onclick="ClickDeleteKecamatan(\'Hapus '.$Var_Kecamatan_NamaKecamatan .' dari database?\', \''.$Var_Kecamatan_IdKecamatan.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataKecamatan_v2 ()
        {
            $result = $this->db->query(
                "SELECT
                    tbl_kecamatan.id AS `Kecamatan_IdKecamatan`,
                    tbl_kecamatan.kecamatan AS `Kecamatan_NamaKecamatan`,

                    tbl_kecamatan.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,

                    tbl_kecamatan.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_kecamatan
                 LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_kecamatan.idprovinsi
                 LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_kecamatan.idkota
                 ORDER BY
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC;"
            );

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;

                    $Var_Kota_IdKota = $data->Kota_IdKota;
                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Kota_NamaKota2;
                    if ($Var_Kota_KategoriKota == NULL)
                    {
                        $Var_Kota_NamaKota2 = "" . $Var_Kota_NamaKota;
                    }
                    else
                    {
                        $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    }

                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                    echo '<tr>';
                        echo '<td>' . $Var_Kecamatan_NamaKecamatan . '</td>';
                        echo '<td>' . $Var_Kota_NamaKota2 . '</td>';
                        echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Admin/EditKecamatan/'.$Var_Kecamatan_IdKecamatan.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            $Var_Kecamatan_NamaKecamatan = "kec. " . " " . strtolower($Var_Kecamatan_NamaKecamatan);
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Kecamatan_IdKecamatan))).'" href="#" class="btn btn-primary" onclick="ClickDeleteKecamatan(\'Hapus '.$Var_Kecamatan_NamaKecamatan .' dari database?\', \''.$Var_Kecamatan_IdKecamatan.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataKelurahan ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kelurahan.id AS "Kelurahan_IdKelurahan",
                 tbl_kelurahan.kelurahan AS "Kelurahan_NamaKelurahan",

                 tbl_kelurahan.idkecamatan AS "Kecamatan_IdKecamatan",
                 tbl_kecamatan.kecamatan AS "Kecamatan_NamaKecamatan",

                 tbl_kelurahan.idkota AS "Kota_IdKota",
                 COALESCE(tbl_kota.kategori::varchar(50), \'\') AS "Kota_KategoriKota",
                 COALESCE(tbl_kota.kota::varchar(50), \'\') AS "Kota_NamaKota",

                 tbl_kelurahan.idprovinsi AS "Provinsi_IdProvinsi",
                 COALESCE(tbl_provinsi.provinsi::varchar(50), \'\') AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_kelurahan
                 LEFT JOIN tbl_kecamatan ON tbl_kelurahan.idkecamatan = tbl_kecamatan.id
                 LEFT JOIN tbl_kota ON tbl_kecamatan.idkota = tbl_kota.id
                 LEFT JOIN tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 ORDER BY
                 tbl_provinsi.provinsi ASC,
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC,
                 tbl_kecamatan.kecamatan ASC,
                 tbl_kelurahan.kelurahan ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    tbl_kelurahan.id AS `Kelurahan_IdKelurahan`,
                    tbl_kelurahan.kelurahan AS `Kelurahan_NamaKelurahan`,

                    tbl_kelurahan.idkecamatan AS `Kecamatan_IdKecamatan`,
                    tbl_kecamatan.kecamatan AS `Kecamatan_NamaKecamatan`,

                    tbl_kelurahan.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,

                    tbl_kelurahan.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_kelurahan
                 LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_kelurahan.idprovinsi
                 LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_kelurahan.idkota
                 LEFT JOIN
                    tbl_kecamatan ON tbl_kecamatan.id = tbl_kelurahan.idkecamatan
                 ORDER BY
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC,
                    tbl_kelurahan.kelurahan ASC;"
            );*/

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Kelurahan_IdKelurahan = $data->Kelurahan_IdKelurahan;
                    $Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;

                    $Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;

                    $Var_Kota_IdKota = $data->Kota_IdKota;
                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Kota_NamaKota2;
                    if ($Var_Kota_KategoriKota == NULL)
                    {
                        $Var_Kota_NamaKota2 = "" . $Var_Kota_NamaKota;
                    }
                    else
                    {
                        $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    }

                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                    echo '<tr>';
                        echo '<td>' . $Var_Kelurahan_NamaKelurahan . '</td>';
                        echo '<td>' . 'Kec. ' .$Var_Kecamatan_NamaKecamatan . '</td>';
                        echo '<td>' . $Var_Kota_NamaKota2 . '</td>';
                        echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Dashboard/EditKelurahan/'.$Var_Kelurahan_IdKelurahan.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            $Var_Kelurahan_NamaKelurahan = "kel. " . " " . strtolower($Var_Kelurahan_NamaKelurahan);
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Kelurahan_IdKelurahan))).'" href="#" class="btn btn-primary" onclick="ClickDeleteKelurahan(\'Hapus '.$Var_Kelurahan_NamaKelurahan .' dari database?\', \''.$Var_Kelurahan_IdKelurahan.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataKelurahan_v2 ()
        {
            $result = $this->db->query(
                "SELECT
                    tbl_kelurahan.id AS `Kelurahan_IdKelurahan`,
                    tbl_kelurahan.kelurahan AS `Kelurahan_NamaKelurahan`,

                    tbl_kelurahan.idkecamatan AS `Kecamatan_IdKecamatan`,
                    tbl_kecamatan.kecamatan AS `Kecamatan_NamaKecamatan`,

                    tbl_kelurahan.idkota AS `Kota_IdKota`,
                    IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `Kota_KategoriKota`,
                    IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `Kota_NamaKota`,

                    tbl_kelurahan.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_kelurahan
                 LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_kelurahan.idprovinsi
                 LEFT JOIN
                    tbl_kota ON tbl_kota.id = tbl_kelurahan.idkota
                 LEFT JOIN
                    tbl_kecamatan ON tbl_kecamatan.id = tbl_kelurahan.idkecamatan
                 ORDER BY
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC,
                    tbl_kecamatan.kecamatan ASC,
                    tbl_kelurahan.kelurahan ASC;"
            );

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Kelurahan_IdKelurahan = $data->Kelurahan_IdKelurahan;
                    $Var_Kelurahan_NamaKelurahan = $data->Kelurahan_NamaKelurahan;

                    $Var_Kecamatan_IdKecamatan = $data->Kecamatan_IdKecamatan;
                    $Var_Kecamatan_NamaKecamatan = $data->Kecamatan_NamaKecamatan;

                    $Var_Kota_IdKota = $data->Kota_IdKota;
                    $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                    $Var_Kota_NamaKota = $data->Kota_NamaKota;
                    $Var_Kota_NamaKota2;
                    if ($Var_Kota_KategoriKota == NULL)
                    {
                        $Var_Kota_NamaKota2 = "" . $Var_Kota_NamaKota;
                    }
                    else
                    {
                        $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                    }

                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                    echo '<tr>';
                        echo '<td>' . $Var_Kelurahan_NamaKelurahan . '</td>';
                        echo '<td>' . 'Kec. ' .$Var_Kecamatan_NamaKecamatan . '</td>';
                        echo '<td>' . $Var_Kota_NamaKota2 . '</td>';
                        echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Admin/EditKelurahan/'.$Var_Kelurahan_IdKelurahan.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            $Var_Kelurahan_NamaKelurahan = "kel. " . " " . strtolower($Var_Kelurahan_NamaKelurahan);
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Kelurahan_IdKelurahan))).'" href="#" class="btn btn-primary" onclick="ClickDeleteKelurahan(\'Hapus '.$Var_Kelurahan_NamaKelurahan .' dari database?\', \''.$Var_Kelurahan_IdKelurahan.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataKota ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_kota.id AS "Kota_IdKota",
                 tbl_kota.kategori AS "Kota_KategoriKota",
                 tbl_kota.kota AS "Kota_NamaKota",

                 tbl_kota.idprovinsi AS "Provinsi_IdProvinsi",
                 COALESCE(tbl_provinsi.provinsi::varchar(50), \'Unknown\') AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_kota
                 LEFT JOIN
                 tbl_provinsi ON tbl_kota.idprovinsi = tbl_provinsi.id
                 ORDER BY
                 tbl_provinsi.provinsi ASC,
                 tbl_kota.kota ASC,
                 tbl_kota.kategori ASC;;'
            );
            /*$result = $this->db->query(
                "SELECT
                    tbl_kota.id AS `Kota_IdKota`,
                    tbl_kota.kategori AS `Kota_KategoriKota`,
                    tbl_kota.kota AS `Kota_NamaKota`,

                    tbl_kota.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_kota
                 LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_kota.idprovinsi
                 ORDER BY
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC;"
            );*/

            $x = $result->num_rows();

            if($x > 0)
            {
                foreach ($result->result() as $data)
                {
                  $Var_Kota_IdKota = $data->Kota_IdKota;
                  $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                  $Var_Kota_NamaKota = $data->Kota_NamaKota;
                  $Var_Kota_NamaKota2;
                  if ($Var_Kota_KategoriKota == NULL)
                  {
                      $Var_Kota_NamaKota2 = "" . $Var_Kota_NamaKota;
                  }
                  else
                  {
                      $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                  }

                  $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                  $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                  echo '<tr>';
                      echo '<td>' . $Var_Kota_NamaKota2 . '</td>';
                      echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                      echo '<td align="center">';
                          echo '<a href="'.base_url().'Dashboard/EditKota/'.$Var_Kota_IdKota.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                          $Var_Kota_NamaKota2 = strtolower($Var_Kota_NamaKota2);
                          echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Kota_IdKota))).'" href="#" class="btn btn-primary" onclick="ClickDeleteKota(\'Hapus '.$Var_Kota_NamaKota2 .' dari database?\', \''.$Var_Kota_IdKota.'\')"><i class="fa fa-trash-o"></i></a>';
                      echo '</td>';
                  echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataKota_v2 ()
        {
            $result = $this->db->query(
                "SELECT
                    tbl_kota.id AS `Kota_IdKota`,
                    tbl_kota.kategori AS `Kota_KategoriKota`,
                    tbl_kota.kota AS `Kota_NamaKota`,

                    tbl_kota.idprovinsi AS `Provinsi_IdProvinsi`,
                    IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_kota
                 LEFT JOIN
                    tbl_provinsi ON tbl_provinsi.id = tbl_kota.idprovinsi
                 ORDER BY
                    tbl_provinsi.provinsi ASC,
                    tbl_kota.kota ASC,
                    tbl_kota.kategori ASC;"
            );

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                  $Var_Kota_IdKota = $data->Kota_IdKota;
                  $Var_Kota_KategoriKota = $data->Kota_KategoriKota;
                  $Var_Kota_NamaKota = $data->Kota_NamaKota;
                  $Var_Kota_NamaKota2;
                  if ($Var_Kota_KategoriKota == NULL)
                  {
                      $Var_Kota_NamaKota2 = "" . $Var_Kota_NamaKota;
                  }
                  else
                  {
                      $Var_Kota_NamaKota2 = $Var_Kota_KategoriKota . " " . $Var_Kota_NamaKota;
                  }

                  $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                  $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                  echo '<tr>';
                      echo '<td>' . $Var_Kota_NamaKota2 . '</td>';
                      echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                      echo '<td align="center">';
                          echo '<a href="'.base_url().'Admin/EditKota/'.$Var_Kota_IdKota.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                          $Var_Kota_NamaKota2 = strtolower($Var_Kota_NamaKota2);
                          echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Kota_IdKota))).'" href="#" class="btn btn-primary" onclick="ClickDeleteKota(\'Hapus '.$Var_Kota_NamaKota2 .' dari database?\', \''.$Var_Kota_IdKota.'\')"><i class="fa fa-trash-o"></i></a>';
                      echo '</td>';
                  echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataProvinsi ()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_provinsi.id AS "Provinsi_IdProvinsi",
                 tbl_provinsi.idwilayah AS "Provinsi_IdWilayah",
                 tbl_provinsi.provinsi AS "Provinsi_NamaProvinsi"
                 FROM
                 tbl_provinsi
                 ORDER BY
                 tbl_provinsi.provinsi ASC;'
            );
            /*$result = $this->db->query(
                "SELECT
                    id AS `Provinsi_IdProvinsi`,
                    idwilayah AS `Provinsi_IdWilayah`,
                    provinsi AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_provinsi
                 ORDER BY
                    provinsi ASC;"
            );*/

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_IdWilayah = $data->Provinsi_IdWilayah;
                    $Var_Provinsi_NamaWilayah;
                    switch ($Var_Provinsi_IdWilayah)
                    {
                        case 1:
                            $Var_Provinsi_NamaWilayah = "Sumatera";
                            break;
                        case 2:
                            $Var_Provinsi_NamaWilayah = "Jawa - Bali";
                            break;
                        case 3:
                            $Var_Provinsi_NamaWilayah = "Kalimantan";
                            break;
                        case 4:
                            $Var_Provinsi_NamaWilayah = "Wilayah Timur";
                            break;
                        default:
                            $Var_Provinsi_NamaWilayah = "";
                            break;
                    }
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                    echo '<tr>';
                        echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                        echo '<td>' . $Var_Provinsi_NamaWilayah . '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Dashboard/EditProvinsi/'.$Var_Provinsi_IdProvinsi.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            $Var_Provinsi_NamaProvinsi = "prov. " . strtolower($Var_Provinsi_NamaProvinsi);
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Provinsi_IdProvinsi))).'" href="#" class="btn btn-primary" onclick="ClickDeleteProvinsi(\'Hapus '.$Var_Provinsi_NamaProvinsi .' dari database?\', \''.$Var_Provinsi_IdProvinsi.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function ListDataProvinsi_v2 ()
        {
            $result = $this->db->query(
                "SELECT
                    id AS `Provinsi_IdProvinsi`,
                    idwilayah AS `Provinsi_IdWilayah`,
                    provinsi AS `Provinsi_NamaProvinsi`
                 FROM
                    tbl_provinsi
                 ORDER BY
                    provinsi ASC;"
            );

            if($result->num_rows() > 0)
            {
                foreach ($result->result() as $data)
                {
                    $Var_Provinsi_IdProvinsi = $data->Provinsi_IdProvinsi;
                    $Var_Provinsi_IdWilayah = $data->Provinsi_IdWilayah;
                    $Var_Provinsi_NamaWilayah;
                    switch ($Var_Provinsi_IdWilayah)
                    {
                        case 1:
                            $Var_Provinsi_NamaWilayah = "Sumatera";
                            break;
                        case 2:
                            $Var_Provinsi_NamaWilayah = "Jawa - Bali";
                            break;
                        case 3:
                            $Var_Provinsi_NamaWilayah = "Kalimantan";
                            break;
                        case 4:
                            $Var_Provinsi_NamaWilayah = "Wilayah Timur";
                            break;
                        default:
                            $Var_Provinsi_NamaWilayah = "";
                            break;
                    }
                    $Var_Provinsi_NamaProvinsi = $data->Provinsi_NamaProvinsi;

                    echo '<tr>';
                        echo '<td>' . $Var_Provinsi_NamaProvinsi . '</td>';

                        echo '<td>' . $Var_Provinsi_NamaWilayah . '</td>';

                        echo '<td align="center">';
                            echo '<a href="'.base_url().'Admin/EditProvinsi/'.$Var_Provinsi_IdProvinsi.'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';

                            $Var_Provinsi_NamaProvinsi = "prov. " . strtolower($Var_Provinsi_NamaProvinsi);
                            echo '<a id="'.base64_encode(base64_encode(base64_encode($Var_Provinsi_IdProvinsi))).'" href="#" class="btn btn-primary" onclick="ClickDeleteProvinsi(\'Hapus '.$Var_Provinsi_NamaProvinsi .' dari database?\', \''.$Var_Provinsi_IdProvinsi.'\')"><i class="fa fa-trash-o"></i></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            }

            return $result;
        }

        function UpdateKecamatan ($Kecamatan_IdKecamatan, $Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_NamaKecamatan)
        {
            if ($Kecamatan_IdKecamatan == NULL || $Kecamatan_IdKecamatan == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Error id kecamatan."
                );
                return $result;
            }
            else if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Kota_IdKota == NULL || $Kota_IdKota == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kab./kota belum dipilih."
                );
                return $result;
            }
            else if ($Kecamatan_NamaKecamatan == NULL || is_numeric($Kecamatan_NamaKecamatan) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kecamatan dengan benar."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'UPDATE
                     public.tbl_kecamatan
                     SET
                     idprovinsi = \''.$Provinsi_IdProvinsi.'\',
                     idkota = \''.$Kota_IdKota.'\',
                     kecamatan = \''.$Kecamatan_NamaKecamatan.'\'
                     WHERE
                     id = \''.$Kecamatan_IdKecamatan.'\';'
                );
                /*$result = $this->db->query(
                    "UPDATE
                     tbl_kecamatan
                     SET
                     idprovinsi = '$Provinsi_IdProvinsi',
                     idkota = '$Kota_IdKota',
                     kecamatan = '$Kecamatan_NamaKecamatan'
                     WHERE
                     id = '$Kecamatan_IdKecamatan';"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data kecamatan berhasil diperbaharui."
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

        function UpdateKelurahan ($Kelurahan_IdKelurahan, $Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_IdKecamatan, $Kelurahan_NamaKelurahan)
        {
            if ($Kelurahan_IdKelurahan == NULL || $Kelurahan_IdKelurahan == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Error id kelurahan."
                );
                return $result;
            }
            else if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum diisi."
                );
                return $result;
            }
            else if ($Kota_IdKota == NULL || $Kota_IdKota == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kab./kota belum dipilih."
                );
                return $result;
            }
            else if ($Kecamatan_IdKecamatan == NULL || $Kecamatan_IdKecamatan == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kecamatan belum dipilih."
                );
                return $result;
            }
            else if ($Kelurahan_NamaKelurahan == NULL || is_numeric($Kelurahan_NamaKelurahan) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kelurahan dengan benar."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'UPDATE
                     public.tbl_kelurahan
                     SET
                     idprovinsi = \''.$Provinsi_IdProvinsi.'\',
                     idkota = \''.$Kota_IdKota.'\',
                     idkecamatan = \''.$Kecamatan_IdKecamatan.'\',
                     kelurahan = \''.$Kelurahan_NamaKelurahan.'\'
                     WHERE
                     id = \''.$Kelurahan_IdKelurahan.'\';'
                );
                /*$result = $this->db->query(
                    "UPDATE
                     tbl_kelurahan
                     SET
                     idprovinsi = '$Provinsi_IdProvinsi',
                     idkota = '$Kota_IdKota',
                     idkecamatan = '$Kecamatan_IdKecamatan',
                     kelurahan = '$Kelurahan_NamaKelurahan'
                     WHERE
                     id = '$Kelurahan_IdKelurahan';"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data kelurahan berhasil diperbaharui."
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

        function UpdateKota ($Kota_IdKota, $Provinsi_IdProvinsi, $Kota_KategoriKota, $Kota_NamaKota)
        {
            if ($Kota_IdKota == NULL || $Kota_IdKota == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Error id kota."
                );
                return $result;
            }
            else if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Provinsi belum dipilih."
                );
                return $result;
            }
            else if ($Kota_KategoriKota == NULL)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Kategori kab./kota belum dipilih."
                );
                return $result;
            }
            else if ($Kota_NamaKota == NULL || is_numeric($Kota_NamaKota) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan kab./kota dengan benar."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    "UPDATE
                     tbl_kota
                     SET
                     idprovinsi = '$Provinsi_IdProvinsi',
                     kategori = '$Kota_KategoriKota',
                     kota = '$Kota_NamaKota'
                     WHERE
                     id = '$Kota_IdKota';"
                );

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data kab./kota berhasil diperbaharui."
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

        function UpdateProvinsi ($Provinsi_IdProvinsi, $Provinsi_NamaProvinsi, $Provinsi_IdWilayah)
        {
            if ($Provinsi_IdProvinsi == NULL || $Provinsi_IdProvinsi == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Error id provinsi"
                );
                return $result;
            }
            else if ($Provinsi_NamaProvinsi == NULL || is_numeric($Provinsi_NamaProvinsi) == true)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Masukan nama provinsi dengan benar."
                );
                return $result;
            }
            else if ($Provinsi_IdWilayah == NULL || $Provinsi_IdWilayah == 0)
            {
                $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Wilayah belum dipilih."
                );
                return $result;
            }
            else
            {
                $result = $this->db->query(
                    'UPDATE
                     public.tbl_provinsi
                     SET
                     idwilayah = \''.$Provinsi_IdWilayah.'\',
                     provinsi = \''.$Provinsi_NamaProvinsi.'\'
                     WHERE
                     id = \''.$Provinsi_IdProvinsi.'\';'
                );
                /*$result = $this->db->query(
                    "UPDATE
                     tbl_provinsi
                     SET
                     idwilayah = '$Provinsi_IdWilayah',
                     provinsi = '$Provinsi_NamaProvinsi'
                     WHERE
                     id = '$Provinsi_IdProvinsi';"
                );*/

                if($result)
                {
                    $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Data provinsi berhasil diperbaharui."
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

?>
