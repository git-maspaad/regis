<?php

  class M_signin extends CI_Model
  {

    function Signin ($UserLog, $KeyLog, $Recaptcha)
    {
      #die($UserLog ."\n". $KeyLog ."\n". $Recaptcha);
      if ($Recaptcha == NULL || $Recaptcha == "0" || strpos($Recaptcha, " ") !== false)
      {
        $result = array(
          "Response_ID" => "0",
          "Response_Message" => "Recaptcha salah."
        );
        return $result;
      }
      else if ($UserLog == NULL || strpos($UserLog, " ") !== false)
      {
        $result = array(
          "Response_ID" => "0",
          "Response_Message" => "Username salah."
        );
        return $result;
      }
      else if ($KeyLog == NULL || strpos($KeyLog, " ") !== false)
      {
        $result = array(
          "Response_ID" => "0",
          "Response_Message" => "Password salah."
        );
        return $result;
      }
      else
      {
        /*die(
          'SELECT
            tbl_ulogin.id as "User_ID",
            tbl_ulogin.ulog as "User_UserLog",
            tbl_ulogin.plog as "User_KeyLog",
            tbl_uloginlevel.id as "User_IdLevel",
            tbl_uloginlevel.ulevel as "User_Level"
            FROM
            tbl_ulogin
            LEFT JOIN tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
            WHERE
            tbl_ulogin.ulog = \''.$UserLog.'\';'
        );*/

        $Encode64KeyLog = base64_encode(base64_encode(base64_encode($KeyLog)));
        # query mysql
        $result = $this->db->query(
          "SELECT
           tbl_ulogin.id AS `User_ID`,
           tbl_ulogin.ulog AS `User_UserLog`,
           tbl_ulogin.plog AS `User_KeyLog`,
           tbl_ulogin.unamalengkap AS `User_NamaLengkap`,
           tbl_ulogin.kontak AS `User_Kontak`,
           tbl_ulogin.isactive AS `User_IsActive`,
           tbl_uloginlevel.id AS `User_IdLevel`,
           tbl_uloginlevel.ulevel AS `User_Level`
           FROM
           tbl_ulogin
           LEFT JOIN tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
           WHERE
           tbl_ulogin.ulog = '$UserLog';"
        );

        # query postgresql
        /*$result = $this->db->query(
          'SELECT
           tbl_ulogin.id AS "User_ID",
           tbl_ulogin.ulog AS "User_UserLog",
           tbl_ulogin.plog AS "User_KeyLog",
           tbl_ulogin.unamalengkap AS "User_NamaLengkap",
           tbl_ulogin.kontak AS "User_Kontak",
           tbl_ulogin.isactive AS "User_IsActive",
           tbl_uloginlevel.id AS "User_IdLevel",
           tbl_uloginlevel.ulevel AS "User_Level"
           FROM
           tbl_ulogin
           LEFT JOIN tbl_uloginlevel ON tbl_ulogin.iduloginlevel = tbl_uloginlevel.id
           WHERE
           tbl_ulogin.ulog = \''.$UserLog.'\';'
        );*/

        /*$result = $this->db->query(
          "SELECT
           tbl_users.id AS `User_ID`,
           tbl_users.idlevel AS `User_IdLevel`,
           IF(tbl_users_level.level IS NULL, '', tbl_users_level.level) AS `User_Level`,
           tbl_users.isactive AS `User_IsActive`,

           tbl_users.ulog AS `User_UserLog`,
           tbl_users.plog AS `User_KeyLog`,

           tbl_users.namadepan AS `User_NamaDepan`,
           tbl_users.namabelakang AS `User_NamaBelakang`,
           tbl_users.jeniskelamin AS `User_JenisKelamin`,
           tbl_users.tempatlahir AS `User_TempatLahir`,
           LEFT(tbl_users.tgllahir, 4) AS `User_TanggalLahirYYYY`,
           MID(tbl_users.tgllahir, 6, 2) AS `User_TanggalLahirMM`,
           RIGHT(tbl_users.tgllahir, 2) AS `User_TanggalLahirDD`,

           tbl_users.idprovinsi AS `User_IdProvinsi`,
           IF(tbl_provinsi.provinsi IS NULL, '', tbl_provinsi.provinsi) AS `User_NamaProvinsi`,
           tbl_users.idkota AS `User_IdKota`,
           IF(tbl_kota.kategori IS NULL, '', tbl_kota.kategori) AS `User_KategoriKota`,
           IF(tbl_kota.kota IS NULL, '', tbl_kota.kota) AS `User_NamaKota`,
           tbl_users.idkecamatan AS `User_IdKecamatan`,
           IF(tbl_kecamatan.kecamatan IS NULL, '', tbl_kecamatan.kecamatan) AS `User_NamaKecamatan`,
           tbl_users.idkelurahan AS `User_IdKelurahan`,
           IF(tbl_kelurahan.kelurahan IS NULL, '', tbl_kelurahan.kelurahan) AS `User_NamaKelurahan`,
           IF(tbl_users.alamatlengkap IS NULL, '', tbl_users.alamatlengkap) AS `User_AlamatLengkap`,

           tbl_users.kontak AS `User_Kontak`,
           tbl_users.email AS `User_Email`,
           tbl_users.noktp AS `User_NomorKTP`
           FROM
           tbl_users
           LEFT JOIN
           tbl_users_level ON tbl_users_level.id = tbl_users.idlevel
           LEFT JOIN
           tbl_provinsi ON tbl_provinsi.id = tbl_users.idprovinsi
           LEFT JOIN
           tbl_kota ON tbl_kota.id = tbl_users.idkota
           LEFT JOIN
           tbl_kecamatan ON tbl_kecamatan.id = tbl_users.idkecamatan
           LEFT JOIN
           tbl_kelurahan ON tbl_kelurahan.id = tbl_users.idkelurahan
           WHERE
           tbl_users.ulog = '$UserLog';"
        );*/

        $x = $result->num_rows();

        #die(json_encode(array(
            #"x" => $result->num_rows()
        #)));

        #if($result->num_rows() == 1)
        if ($x == 1)
        {
          /*$result = array(
            "Response_ID" => "0",
            "Response_Message" => "Count $x"
          );
          return $result;*/

          foreach ($result->result() as $data)
          {
            $Var_User_ID = $data->User_ID;
            $Var_User_IdLevel = $data->User_IdLevel;
            $Var_User_Level = $data->User_Level;
            $Var_User_IsActive = $data->User_IsActive;

            $Var_User_UserLog = $data->User_UserLog;
            $Var_User_KeyLog = $data->User_KeyLog;
            
            $Var_User_NamaLengkap = $data->User_NamaLengkap;
            $Var_User_Kontak = $data->User_Kontak;

            #$Var_User_NamaDepan = $data->User_NamaDepan;
            #$Var_User_NamaBelakang = $data->User_NamaBelakang;
            #$Var_User_JenisKelamin = $data->User_JenisKelamin;
            #$Var_User_TempatLahir = $data->User_TempatLahir;
            #$Var_User_TanggalLahirYYYY = $data->User_TanggalLahirYYYY;
            #$Var_User_TanggalLahirMM = $data->User_TanggalLahirMM;
            #$Var_User_TanggalLahirDD = $data->User_TanggalLahirDD;

            #$Var_User_IdProvinsi = $data->User_IdProvinsi;
            #$Var_User_NamaProvinsi = $data->User_NamaProvinsi;
            #$Var_User_IdKota = $data->User_IdKota;
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
            #$Var_User_IdKecamatan = $data->User_IdKecamatan;
            #$Var_User_NamaKecamatan = $data->User_NamaKecamatan;
            #$Var_User_IdKelurahan = $data->User_IdKelurahan;
            #$Var_User_NamaKelurahan = $data->User_NamaKelurahan;
            #$Var_User_AlamatLengkap = $data->User_AlamatLengkap;

            #$Var_User_Kontak = $data->User_Kontak;
            #$Var_User_Email = $data->User_Email;
            #$Var_User_NomorKTP = $data->User_NomorKTP;

            if ($Encode64KeyLog == $Var_User_KeyLog)
            {
              switch ($Var_User_IsActive)
              {
                case 1:
                  switch ($Var_User_IdLevel)
                  {
                    case 1:
                      $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Login berhasil.",

                        "User_ID" => $Var_User_ID,
                        "User_IdLevel" => $Var_User_IdLevel,
                        "User_Level" => $Var_User_Level,
                        "User_IsActive" => $Var_User_IsActive,

                        "User_UserLog" => $Var_User_UserLog,
                        "User_KeyLog" => base64_decode(base64_decode(base64_decode($Var_User_KeyLog))),

                        "User_NamaLengkap" => $Var_User_NamaLengkap,
                        "User_Kontak" => $Var_User_Kontak,

                        #"User_NamaDepan" => $Var_User_NamaDepan,
                        #"User_NamaBelakang" => $Var_User_NamaBelakang,
                        #"User_JenisKelamin" => $Var_User_JenisKelamin,
                        #"User_TempatLahir" => $Var_User_TempatLahir,
                        #"User_TanggalLahirYYYY" => $Var_User_TanggalLahirYYYY,
                        #"User_TanggalLahirMM" => $Var_User_TanggalLahirMM,
                        #"User_TanggalLahirDD" => $Var_User_TanggalLahirDD,

                        #"User_IdProvinsi" => $Var_User_IdProvinsi,
                        #"User_NamaProvinsi" => $Var_User_NamaProvinsi,
                        #"User_IdKota" => $Var_User_IdKota,
                        #"User_KategoriKota" => $Var_User_KategoriKota,
                        #"User_NamaKota" => $Var_User_NamaKota,
                        #"User_IdKecamatan" => $Var_User_IdKecamatan,
                        #"User_NamaKecamatan" => $Var_User_NamaKecamatan,
                        #"User_IdKelurahan" => $Var_User_IdKelurahan,
                        #"User_NamaKelurahan" => $Var_User_NamaKelurahan,
                        #"User_AlamatLengkap" => $Var_User_AlamatLengkap,

                        #"User_Kontak" => $Var_User_Kontak,
                        #"User_Email" => $Var_User_Email,
                        #"User_NomorKTP" => $Var_User_NomorKTP
                      );
                      return $result;
                      break;
                    case 2:
                      $result = array(
                        "Response_ID" => "1",
                        "Response_Message" => "Login berhasil.",

                        "User_ID" => $Var_User_ID,
                        "User_IdLevel" => $Var_User_IdLevel,
                        "User_Level" => $Var_User_Level,
                        "User_IsActive" => $Var_User_IsActive,

                        "User_UserLog" => $Var_User_UserLog,
                        "User_KeyLog" => base64_decode(base64_decode(base64_decode($Var_User_KeyLog))),

                        "User_NamaLengkap" => $Var_User_NamaLengkap,
                        "User_Kontak" => $Var_User_Kontak,

                        #"User_NamaDepan" => $Var_User_NamaDepan,
                        #"User_NamaBelakang" => $Var_User_NamaBelakang,
                        #"User_JenisKelamin" => $Var_User_JenisKelamin,
                        #"User_TempatLahir" => $Var_User_TempatLahir,
                        #"User_TanggalLahirYYYY" => $Var_User_TanggalLahirYYYY,
                        #"User_TanggalLahirMM" => $Var_User_TanggalLahirMM,
                        #"User_TanggalLahirDD" => $Var_User_TanggalLahirDD,

                        #"User_IdProvinsi" => $Var_User_IdProvinsi,
                        #"User_NamaProvinsi" => $Var_User_NamaProvinsi,
                        #"User_IdKota" => $Var_User_IdKota,
                        #"User_KategoriKota" => $Var_User_KategoriKota,
                        #"User_NamaKota" => $Var_User_NamaKota,
                        #"User_IdKecamatan" => $Var_User_IdKecamatan,
                        #"User_NamaKecamatan" => $Var_User_NamaKecamatan,
                        #"User_IdKelurahan" => $Var_User_IdKelurahan,
                        #"User_NamaKelurahan" => $Var_User_NamaKelurahan,
                        #"User_AlamatLengkap" => $Var_User_AlamatLengkap,

                        #"User_Kontak" => $Var_User_Kontak,
                        #"User_Email" => $Var_User_Email,
                        #"User_NomorKTP" => $Var_User_NomorKTP
                      );
                      return $result;
                      break;
                    default:
                      $result = array(
                        "Response_ID" => "0",
                        "Response_Message" => "Access denied."
                      );
                      return $result;
                      break;
                  }
                  break;
                default:
                  $result = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Akun dinonaktifkan oleh sistem."
                  );
                  return $result;
                  break;
              }
            }
            else
            {
              $result = array(
                "Response_ID" => "0",
                "Response_Message" => "Password salah."
              );
              return $result;
            }
          }
        }
        else
        {
          $result = array(
            "Response_ID" => "0",
            "Response_Message" => "Data tidak ditemukan."
          );
          return $result;
        }
      }
    }

  }

?>
