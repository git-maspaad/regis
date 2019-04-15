<?php

  class M_profile extends CI_Model
  {
      function UpdateProfile (
        $User_NamaLengkap,
        #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
        #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
        #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
        $User_Kontak
        #$User_Email,
        #$User_NomorKTP
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
          else if ($User_Kontak == NULL || strpos($User_Kontak, " ") !== false || is_numeric($User_Kontak) == false)
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
              $User_ID = @$_SESSION["User_ID"];

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

              # query mysql
              $result = $this->db->query(
                  "UPDATE
                   tbl_ulogin
                   SET
                   unamalengkap = '$User_NamaLengkap',
                   kontak = '$User_Kontak'
                   WHERE
                   id = '$User_ID';"
              );

              # query postgresql
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
                  /*$result = $this->db->query(
                      'SELECT
                       tbl_ulogin.unamalengkap AS "User_NamaLengkap",
                       tbl_ulogin.kontak AS "User_Kontak"
                       FROM
                       tbl_ulogin
                       WHERE
                       tbl_ulogin.id = \''.$User_ID.'\';'
                  );*/
                  /*$result = $this->db->query(
                      "SELECT
                          tbl_users.id AS `User_ID`,

                          IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `User_NamaProvinsi`,
                          IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `User_KategoriKota`,
                          IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `User_NamaKota`,
                          IF(tbl_kecamatan.kecamatan IS NULL, '', tbl_kecamatan.kecamatan) AS `User_NamaKecamatan`,
                          IF(tbl_kelurahan.kelurahan IS NULL, '', tbl_kelurahan.kelurahan) AS `User_NamaKelurahan`
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
                          tbl_users.id = '$User_ID';"
                  );*/

                  #$y = $result->num_rows();

                  #if($result->num_rows() == 1)
                  #if ($y == 1)
                  #{
                      #foreach ($result->result() as $data)
                      #{
                          #$Var_User_NamaProvinsi = $data->User_NamaProvinsi;
                          #$Var_User_KategoriKota = $data->User_KategoriKota;
                          #$Var_User_NamaKota;
                          #if ($Var_User_KategoriKota == NULL)
                          #{
                              #$Var_User_NamaKota = "";
                          #}
                          #else
                          #{
                              #$Var_User_NamaKota = $Var_User_KategoriKota . " " . $data->User_NamaKota;
                          #}
                          #$Var_User_NamaKecamatan = $data->User_NamaKecamatan;
                          #$Var_User_NamaKelurahan = $data->User_NamaKelurahan;

                          $result = array(
                              "Response_ID" => "1",
                              "Response_Message" => "Update profile berhasil.",

                              "User_NamaLengkap" => $User_NamaLengkap,
                              #"User_NamaDepan" => $User_NamaDepan,
                              #"User_NamaBelakang" => $User_NamaBelakang,
                              #"User_JenisKelamin" => $User_JenisKelamin,
                              #"User_TempatLahir" => $User_TempatLahir,
                              #"User_TanggalLahirYYYY" => $User_TanggalLahirYYYY,
                              #"User_TanggalLahirMM" => $User_TanggalLahirMM,
                              #"User_TanggalLahirDD" => $User_TanggalLahirDD,

                              #"User_IdProvinsi" => $User_IdProvinsi,
                              #"User_NamaProvinsi" => $Var_User_NamaProvinsi,
                              #"User_IdKota" => $User_IdKota,
                              #"User_KategoriKota" => $Var_User_KategoriKota,
                              #"User_NamaKota" => $Var_User_NamaKota,
                              #"User_IdKecamatan" => $User_IdKecamatan,
                              #"User_NamaKecamatan" => $Var_User_NamaKecamatan,
                              #"User_IdKelurahan" => $User_IdKelurahan,
                              #"User_NamaKelurahan" => $Var_User_NamaKelurahan,
                              #"User_AlamatLengkap" => $User_AlamatLengkap,

                              "User_Kontak" => $User_Kontak,
                              #"User_Email" => $User_Email,
                              #"User_NomorKTP" => $User_NomorKTP
                          );
                          return $result;
                      #}
                  #}
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
